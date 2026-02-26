<?php
// dashboard/auth.php
session_start();
require_once 'app_config.php';
require_once 'config.php';

// Database connection helper

function get_db_connection()
{
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        // Log error for production debugging
        error_log("[Dashboard Auth] Database connection failed: " . $conn->connect_error);
        error_log("[Dashboard Auth] Attempted connection to: " . DB_HOST . " with user: " . DB_USER);
        die("Connection failed: " . $conn->connect_error);
    }
    $conn->set_charset("utf8mb4");
    return $conn;
}

function is_logged_in()
{
    return isset($_SESSION['user_id']);
}

function require_login()
{
    if (!is_logged_in()) {
        header("Location: login.php");
        exit;
    }

    // Onboarding Enforcement
    global $user;
    $currentPage = basename($_SERVER['PHP_SELF']);
    if ($user && $user['onboarding_status'] !== 'verified' && $currentPage !== 'onboarding.php' && $user['active'] == 1) {
        header("Location: onboarding.php");
        exit;
    }
}

function portal_logout()
{
    session_destroy();
    header("Location: login.php");
    exit;
}

// Get user data if logged in
if (is_logged_in()) {
    $conn = get_db_connection();
    $stmt = $conn->prepare("
        SELECT * FROM users WHERE id = ?
    ");
    $stmt->bind_param("i", $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    $conn->close();

    // IDENTITY REFACTOR: Dynamic Client ID Lookup via API
    // Solves environment inconsistencies by using the CRM's authoritative ID based on Email.
    if ($user && isset($user['email'])) {
        // Only fetch if not already in session (caching)
        if (!isset($_SESSION['real_client_id']) || !isset($_SESSION['real_contact_id'])) {
            // Search for contact by email
            // Note: api_call is defined below, but PHP function hoisting allows this.
            // Using contacts/search/EMAIL endpoint which returns a list
            $apiSearch = api_call('contacts/search/' . urlencode($user['email']));

            if (is_array($apiSearch) && !empty($apiSearch) && isset($apiSearch[0]['userid'])) {
                // Found match
                $_SESSION['real_client_id'] = $apiSearch[0]['userid']; // CRM Client ID
                $_SESSION['real_contact_id'] = $apiSearch[0]['id'];    // CRM Contact ID

                // Debug log
                error_log("Identity Refactor: Mapped local user {$user['email']} to Client ID: " . $apiSearch[0]['userid']);
            }
        }

        // Apply authoritative IDs if successful
        if (isset($_SESSION['real_client_id'])) {
            $user['client_id'] = $_SESSION['real_client_id'];
        }
        if (isset($_SESSION['real_contact_id'])) {
            $user['contact_id'] = $_SESSION['real_contact_id'];
        }
    }

    // Global variables for templates (Header/Sidebar)
    $fullName = $_SESSION['contact_name'] ?? (($user['firstname'] ?? '') . ' ' . ($user['lastname'] ?? ''));
    $company = $user['company_name'] ?? '';
    // Raw ID for API calls
    $clientId = $user['client_id'] ?? 0;
    // Formatted ID for display: ARDO-0003
    $displayClientId = "ARDO-" . str_pad($clientId, 4, '0', STR_PAD_LEFT);

    // Fetch available Magnus User profiles if not already set
    if (!isset($_SESSION['available_magnus_users']) && $clientId > 0) {
        $usersResponse = api_call('switches/users?clientid=' . $clientId);
        if (isset($usersResponse['status']) && $usersResponse['status'] && is_array($usersResponse['data'])) {
            $_SESSION['available_magnus_users'] = $usersResponse['data'];
            // Select first by default if not previously selected
            if (!empty($usersResponse['data']) && !isset($_SESSION['selected_magnus_user'])) {
                $_SESSION['selected_magnus_user'] = $usersResponse['data'][0];
            }
        } else {
            $_SESSION['available_magnus_users'] = [];
        }
    }

    // Handle switching Magnus User Profile
    if (isset($_GET['switch_magnus_user'])) {
        $switch_user = $_GET['switch_magnus_user'];
        if (isset($_SESSION['available_magnus_users']) && in_array($switch_user, $_SESSION['available_magnus_users'])) {
            $_SESSION['selected_magnus_user'] = $switch_user;
            // Clear API cache to ensure fresh data for new profile
            $_SESSION['api_cache'] = [];
        }

        // Redirect to clean URL
        $current_url = $_SERVER['PHP_SELF'];
        header("Location: " . $current_url);
        exit;
    }

    $selectedMagnusUser = $_SESSION['selected_magnus_user'] ?? '';
}

/**
 * Helper to call the holding API
 */
function api_call($endpoint, $method = 'GET', $data = null, $files = [])
{
    // Implementation of temporary session caching for GET requests
    if ($method === 'GET' && empty($files)) {
        $cacheKey = md5($endpoint . serialize($data));
        if (isset($_SESSION['api_cache'][$cacheKey])) {
            $cached = $_SESSION['api_cache'][$cacheKey];
            if ($cached['expiry'] > time()) {
                return $cached['data'];
            }
        }
    }

    $apiToken = API_TOKEN;
    $apiToken = API_TOKEN;

    // Use configured API URL if available (best practice)
    if (defined('API_URL')) {
        $api_base = API_URL . '/';
    } else {
        // Fallback: Dynamic API Base Detection
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http');
        $host = $_SERVER['HTTP_HOST'];
        $script_path = $_SERVER['SCRIPT_NAME'];

        if (strpos($script_path, '/ardotechnology/') !== false) {
            $api_base = $protocol . '://' . $host . '/holding/api/';
        } elseif ($host === 'ardo.technology' || $host === 'www.ardo.technology') {
            $api_base = $protocol . '://app.ardo.technology/api/';
        } else {
            $api_base = $protocol . '://' . $host . '/api/';
        }
    }

    $url = rtrim($api_base, '/') . '/' . ltrim($endpoint, '/');

    // DEBUG LOG
    // Logging removed for production stability
    // file_put_contents('api_debug.log', date('[Y-m-d H:i:s] ') . "API Call: $method $url | ScriptPath: $script_path\n", FILE_APPEND);

    $curl = curl_init();
    $headers = [
        'authtoken: ' . $apiToken,
    ];

    $options = [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_TIMEOUT => 15,         // Increased from 10
        CURLOPT_CONNECTTIMEOUT => 10,   // Increased from 5
    ];

    if (!empty($files)) {
        // Multipart form data
        $postData = $data ?: [];
        foreach ($files as $key => $file) {
            if (isset($file['tmp_name']) && !empty($file['tmp_name'])) {
                $postData[$key] = new CURLFile($file['tmp_name'], $file['type'], $file['name']);
            }
        }
        $options[CURLOPT_POSTFIELDS] = $postData;
        // Content-Type is set automatically for multipart/form-data
    } elseif ($data) {
        $options[CURLOPT_POSTFIELDS] = json_encode($data);
        $headers[] = 'Content-Type: application/json';
    }

    $options[CURLOPT_HTTPHEADER] = $headers;

    curl_setopt_array($curl, $options);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    file_put_contents('api_debug.log', date('[Y-m-d H:i:s] ') . "API Call: $method " . get_crm_url() . "api/$endpoint | Response: $response | Error: $err\n", FILE_APPEND);

    $result = json_decode($response, true);

    // Cache the result for GET requests for 60 seconds
    if ($method === 'GET' && empty($files) && isset($result['status']) && $result['status']) {
        $cacheKey = md5($endpoint . serialize($data));
        $_SESSION['api_cache'][$cacheKey] = [
            'data' => $result,
            'expiry' => time() + 60
        ];
    }

    return $result;
}

/**
 * Returns the CRM base URL dynamically
 */
function get_crm_url()
{
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http');
    $host = $_SERVER['HTTP_HOST'];
    $script_path = $_SERVER['SCRIPT_NAME'];

    if (strpos($script_path, '/ardotechnology/') !== false) {
        // LOCAL DEVELOPMENT (ServBay sandbox)
        return $protocol . '://' . $host . '/holding/';
    } elseif ($host === 'ardo.technology' || $host === 'www.ardo.technology') {
        // PRODUCTION (Main domain)
        return $protocol . '://app.ardo.technology/';
    } else {
        // FALLBACK
        return $protocol . '://' . $host . '/';
    }
}

// Handle Public Actions (AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] === 'create_stripe_session') {
        $token = $_POST['token'] ?? '';
        if (empty($token)) {
            echo json_encode(['status' => false, 'message' => 'Token is required']);
            exit;
        }

        $response = api_call("stripe_id/create_session", 'POST', ['token' => $token]);
        echo json_encode($response);
        exit;
    }

    if ($_POST['action'] === 'update_stripe_status') {
        $token = $_POST['token'] ?? '';
        $status = $_POST['status'] ?? 'verified';
        if (empty($token)) {
            echo json_encode(['status' => false, 'message' => 'Token is required']);
            exit;
        }

        $response = api_call("stripe_id/update_status", 'POST', ['token' => $token, 'status' => $status]);

        if (isset($response['status']) && $response['status'] === true && isset($response['client_id'])) {
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE users SET onboarding_status = ? WHERE client_id = ?");
            if ($stmt) {
                $status_to_set = ($status === 'verified') ? 'verified' : 'pending_identity';
                $stmt->bind_param("si", $status_to_set, $response['client_id']);
                $stmt->execute();
                $stmt->close();
            }
            $conn->close();
        }

        echo json_encode($response);
        exit;
    }
}
