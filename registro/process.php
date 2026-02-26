<?php
// process.php
require_once __DIR__ . '/../dashboard/config.php';

// Prevent HTML errors from breaking JSON
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');
header('Content-Type: application/json');

try {
    // 1. Definition of Credentials
    // User provided specific token for this environment
    if (!defined('API_TOKEN')) {
        throw new Exception('API_TOKEN no está definido en config.php');
    }
    $apiToken = API_TOKEN;

    // 2. Define Test Environment URL
    // Updated to holding API
    $apiUrl = API_URL . '/customers';

    // 3. Process POST Data
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Método no permitido.');
    }

    // Sanitize input
    $company = filter_var($_POST['company'] ?? '', FILTER_SANITIZE_STRING);
    $firstname = filter_var($_POST['firstname'] ?? '', FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['lastname'] ?? '', FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $phonenumber = filter_var($_POST['phonenumber'] ?? '', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    $accountType = $_POST['account_type'] ?? 'business';

    // Auto-fill company for Personal accounts
    if (empty($company) || $accountType === 'personal') {
        $company = $firstname . ' ' . $lastname;
    }

    // Basic Validation
    if (empty($company) || empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Por favor complete todos los campos obligatorios.']);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['status' => 'error', 'message' => 'El correo electrónico no es válido.']);
        exit;
    }

    // --- DATA PREPARATION ---

    // 1. Store Contact Information in a Temporary Variable (as requested)
    $contactDataTemp = [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'phonenumber' => $phonenumber,
        'password' => $password,
        'is_primary' => 1,
        'active' => 1, // Set to 1 for immediate dashboard access as requested
        'permissions' => ['1', '4', '5'] // Invoices, Proposals, Support
    ];

    // Start session for auto-login
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // 2. Prepare Company Data for API
    $companyData = [
        'company' => $company,
        'website' => '',
        'default_currency' => 1,
        'default_language' => 'spanish',
    ];

    // --- STEP 1: CREATE COMPANY (CUSTOMER) ---
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $apiUrl, // e.g., .../api/customers
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => http_build_query($companyData),
        CURLOPT_HTTPHEADER => array(
            'authtoken: ' . $apiToken,
            'Content-Type: application/x-www-form-urlencoded'
        ),
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_FRESH_CONNECT => true,
        CURLOPT_FORBID_REUSE => true,
    ));

    $response = curl_exec($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        error_log("CURL Error (Empresa): " . $err);
        echo json_encode(['status' => 'error', 'message' => 'Error de conexión (Empresa).']);
        exit;
    }

    $responseData = json_decode($response, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        error_log("JSON Decode Error (Empresa): " . json_last_error_msg() . " Response: " . $response);
        echo json_encode(['status' => 'error', 'message' => 'Error en respuesta del servidor remoto.']);
        exit;
    }

    // Validate Company Creation
    if ($httpCode >= 200 && $httpCode < 300 && isset($responseData['status']) && $responseData['status'] === true) {

        // Retrieve New Client ID
        $clientId = $responseData['id'] ?? $responseData['record_id'] ?? null;

        if (!$clientId) {
            error_log("API Error: No ID returned. Response: " . print_r($responseData, true));
            echo json_encode(['status' => 'error', 'message' => 'API Error: ID de empresa no recibido.']);
            exit;
        }

        // --- STEP 2: CREATE CONTACT ---

        // Inject Client ID into the Temporary Contact Data
        $contactDataTemp['customer_id'] = $clientId; // Changed from clientid to customer_id to match API requirement

        // Construct Contact API URL
        // Ensure we are targeting /api/contacts/
        $contactUrl = str_replace('customers', 'contacts', $apiUrl);

        $curlContact = curl_init();
        curl_setopt_array($curlContact, array(
            CURLOPT_URL => $contactUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => http_build_query($contactDataTemp),
            CURLOPT_HTTPHEADER => array(
                'authtoken: ' . $apiToken,
                'Content-Type: application/x-www-form-urlencoded'
            ),
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_FRESH_CONNECT => true,
            CURLOPT_FORBID_REUSE => true,
        ));

        $contactResponse = curl_exec($curlContact);
        $contactErr = curl_error($curlContact);
        curl_close($curlContact);

        if ($contactErr) {
            error_log("CURL Error (Contacto): " . $contactErr);
            echo json_encode(['status' => 'error', 'message' => 'Error de conexión (Contacto).']);
            exit;
        }

        $contactResponseData = json_decode($contactResponse, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            error_log("JSON Decode Error (Contacto): " . json_last_error_msg() . " Response: " . $contactResponse);
            echo json_encode(['status' => 'error', 'message' => 'Error en respuesta de contacto del servidor remoto.']);
            exit;
        }

        if (isset($contactResponseData['status']) && $contactResponseData['status'] === true) {
            // 1. Get IDs from API Response or Context (No DB Access to 'holding')
            $contact_id = $contactResponseData['id'] ?? null;
            $client_id = $clientId; // From Company Create Step

            // If contact_id is missing, search via API
            if (!$contact_id) {
                error_log("Warning: API did not return contact ID directly. Searching by email...");

                // Construct search URL for contacts
                $searchUrl = defined('API_URL') ? API_URL . '/contacts/search/' . urlencode($email) : '';

                if ($searchUrl) {
                    $curlSearch = curl_init();
                    curl_setopt_array($curlSearch, array(
                        CURLOPT_URL => $searchUrl,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_HTTPHEADER => array(
                            'authtoken: ' . $apiToken,
                            'Content-Type: application/json'
                        ),
                        CURLOPT_SSL_VERIFYPEER => false
                    ));
                    $searchRes = curl_exec($curlSearch);
                    $searchData = json_decode($searchRes, true);
                    curl_close($curlSearch);

                    if (is_array($searchData) && !empty($searchData) && isset($searchData[0]['id'])) {
                        $contact_id = $searchData[0]['id'];
                        error_log("Contact found via API Search: ID " . $contact_id);
                    } else {
                        error_log("API Search failed or returned empty: " . substr($searchRes, 0, 100));
                    }
                }
            }

            if (!$contact_id || !$client_id) {
                throw new Exception("Could not determine Contact ID or Client ID via API. ContactID: " . ($contact_id ?: 'NULL') . ", ClientID: $client_id");
            }

            // 2. Insert into webapp_ardo DB (using DB_NAME from config)
            if ($contact_id && $client_id) {
                $conn_webapp = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
                if ($conn_webapp->connect_error) {
                    throw new Exception("Connection failed (webapp): " . $conn_webapp->connect_error);
                }

                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $active = 1;
                $onboarding_status = 'pending_info'; // Correct enum value

                $stmt_ins = $conn_webapp->prepare("INSERT INTO users (contact_id, client_id, email, firstname, lastname, company_name, password, active, onboarding_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                if (!$stmt_ins) {
                    throw new Exception("Prepare failed (webapp): " . $conn_webapp->error);
                }

                $stmt_ins->bind_param("iisssssis", $contact_id, $client_id, $email, $firstname, $lastname, $company, $hashed_password, $active, $onboarding_status);
                if ($stmt_ins->execute()) {
                    $new_user_id = $stmt_ins->insert_id;
                    $_SESSION['user_id'] = $new_user_id;
                    error_log("User inserted into webapp_ardo.users. New UserID: " . $new_user_id . ". Session set.");
                } else {
                    error_log("Execute failed (webapp insert): " . $stmt_ins->error);
                }
                $stmt_ins->close();
                $conn_webapp->close();
            } else {
                error_log("Warning: Could not find created contact in holding DB. Email: $email. ContactID: $contact_id, ClientID: $client_id");
            }

            error_log("Registration process completed successfully.");
            echo json_encode(['status' => 'success', 'message' => '¡Registro exitoso!']);
        } else {
            error_log("API Error (Create Contact): " . print_r($contactResponseData, true));
            echo json_encode(['status' => 'error', 'message' => 'Error al crear contacto: ' . ($contactResponseData['message'] ?? 'Desconocido')]);
        }

    } else {
        error_log("API Error (Create Company): " . print_r($responseData, true));
        echo json_encode(['status' => 'error', 'message' => 'Error al crear la empresa: ' . ($responseData['message'] ?? 'Desconocido')]);
    }

} catch (Throwable $e) {
    // Catch-all for any PHP errors/exceptions
    error_log("CRITICAL ERROR in process.php: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
    echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
}
?>