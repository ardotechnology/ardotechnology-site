<?php
// dashboard/account.php
require_once 'auth.php';
require_login();

$success_msg = '';
$error_msg = '';

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// Fetch current data from API
$contactData = api_call("contacts/{$user['client_id']}/{$user['contact_id']}");
$customerData = api_call("customers/{$user['client_id']}");
$thresholdData = api_call("switches/threshold?clientid={$user['client_id']}");
$threshold_val = $thresholdData['threshold'] ?? '0.00';

// Load countries list
$countriesJson = file_get_contents('countries.json');
$countries = json_decode($countriesJson, true);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'update_profile') {
        // Personal Profile Update
        $profile_fields = [
            'firstname' => $_POST['firstname'] ?? '',
            'lastname' => $_POST['lastname'] ?? '',
            'email' => $_POST['email'] ?? '',
            'phonenumber' => $_POST['phonenumber'] ?? '',
            'title' => $_POST['title'] ?? '',
        ];

        $response = api_call("contacts/{$user['contact_id']}", 'PUT', $profile_fields);

        if (isset($response['status']) && $response['status']) {
            $success_msg = "Profile updated successfully.";
            // Refresh local session name if changed
            $_SESSION['contact_name'] = $profile_fields['firstname'] . ' ' . $profile_fields['lastname'];

            // Sync with local users table
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?");
            $stmt->bind_param("sssi", $profile_fields['firstname'], $profile_fields['lastname'], $profile_fields['email'], $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            $contactData = api_call("contacts/{$user['client_id']}/{$user['contact_id']}");
        } else {
            $error_msg = $response['message'] ?? "Failed to update profile.";
        }
    } elseif ($action === 'update_company') {
        // Company Information Update
        $company_fields = [
            'company' => $_POST['company'] ?? '',
            'vat' => $_POST['vat'] ?? '',
            'phonenumber' => $_POST['company_phone'] ?? '',
            'website' => $_POST['website'] ?? '',
            'address' => $_POST['address'] ?? '',
            'city' => $_POST['city'] ?? '',
            'state' => $_POST['state'] ?? '',
            'zip' => $_POST['zip'] ?? '',
            'country' => $_POST['country'] ?? '',
            'billing_street' => $_POST['billing_street'] ?? '',
            'billing_city' => $_POST['billing_city'] ?? '',
            'billing_state' => $_POST['billing_state'] ?? '',
            'billing_zip' => $_POST['billing_zip'] ?? '',
            'billing_country' => $_POST['billing_country'] ?? '',
            'shipping_street' => $_POST['shipping_street'] ?? '',
            'shipping_city' => $_POST['shipping_city'] ?? '',
            'shipping_state' => $_POST['shipping_state'] ?? '',
            'shipping_zip' => $_POST['shipping_zip'] ?? '',
            'shipping_country' => $_POST['shipping_country'] ?? '',
        ];

        $response = api_call("customers/{$user['client_id']}", 'PUT', $company_fields);

        if (isset($response['status']) && $response['status']) {
            $success_msg = "Company information updated successfully.";

            // Sync with local users table company name
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE users SET company_name = ? WHERE id = ?");
            $stmt->bind_param("si", $company_fields['company'], $_SESSION['user_id']);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            $customerData = api_call("customers/{$user['client_id']}");
        } else {
            $error_msg = $response['message'] ?? "Failed to update company information.";
        }
    } elseif ($action === 'update_billing_alerts') {
        $threshold = $_POST['low_balance_threshold'] ?? 0;
        $response = api_call('switches/threshold', 'POST', [
            'clientid' => $user['client_id'],
            'threshold' => $threshold
        ]);
        if (isset($response['status']) && $response['status']) {
            $success_msg = "Billing alerts updated successfully.";
            $threshold_val = $threshold;
        } else {
            $error_msg = $response['message'] ?? "Failed to update billing alerts.";
        }
    }
}

// Common user variables ($fullName, $company, $clientId, $displayClientId) are globally available from auth.php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>My Account - Ardo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00F0FF",
                        "background-light": "#ffffff",
                        "background-dark": "#050505",
                        "neutral-border": "#E5E5E5",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    },
                    borderRadius: {
                        "DEFAULT": "4px",
                        "lg": "8px",
                        "xl": "8px",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
        }

        .geist-heading {
            font-weight: 900;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }

        .glass-card {
            background: #ffffff;
            border: 1px solid #E5E5E5;
        }

        .tech-label {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.05em;
        }

        input[type="text"],
        input[type="email"],
        input[type="tel"],
        select,
        textarea {
            border-radius: 6px !important;
            border-color: #E5E5E5;
            font-size: 0.875rem;
        }

        input:focus {
            ring-color: #00F0FF !important;
            border-color: #00F0FF !important;
        }

        .section-header {
            position: relative;
            padding-left: 1rem;
        }

        .section-header::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: #00F0FF;
            border-radius: 999px;
        }
    </style>
</head>

<body class="bg-background-light text-[#050505] font-display">
    <div class="flex h-screen overflow-hidden">
        <!-- Left Sidebar Navigation -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <!-- Header -->
            <?php
            $pageHeaderTitle = "My Account";
            include 'header.php';
            ?>

            <!-- Content -->
            <div class="p-8 max-w-5xl mx-auto w-full">
                <?php if ($success_msg): ?>
                    <div
                        class="mb-6 p-4 bg-green-50 border border-green-100 text-green-700 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined text-green-500">check_circle</span>
                        <p class="text-sm font-medium"><?php echo $success_msg; ?></p>
                    </div>
                <?php endif; ?>

                <?php if ($error_msg): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 text-red-700 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined text-red-500">error</span>
                        <p class="text-sm font-medium"><?php echo $error_msg; ?></p>
                    </div>
                <?php endif; ?>

                <div class="w-full" x-data="{ view: 'personal' }">
                    <!-- Top Level Tabs -->
                    <div class="flex border-b border-gray-200 mb-8 w-full">
                        <button type="button" @click="view = 'personal'"
                            class="px-6 py-3 text-sm font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 flex items-center gap-2 outline-none focus:outline-none"
                            :class="view === 'personal' ? 'border-primary text-gray-900 bg-gray-50/50' : 'border-transparent text-gray-400 hover:text-gray-600 hover:bg-gray-50/30'">
                            <span class="material-symbols-outlined text-[20px]">person</span>
                            Personal Profile
                        </button>
                        <button type="button" @click="view = 'company'"
                            class="px-6 py-3 text-sm font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 flex items-center gap-2 outline-none focus:outline-none"
                            :class="view === 'company' ? 'border-primary text-gray-900 bg-gray-50/50' : 'border-transparent text-gray-400 hover:text-gray-600 hover:bg-gray-50/30'">
                            <span class="material-symbols-outlined text-[20px]">business</span>
                            Company Information
                        </button>
                        <button type="button" @click="view = 'billing_alerts'"
                            class="px-6 py-3 text-sm font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 flex items-center gap-2 outline-none focus:outline-none"
                            :class="view === 'billing_alerts' ? 'border-primary text-gray-900 bg-gray-50/50' : 'border-transparent text-gray-400 hover:text-gray-600 hover:bg-gray-50/30'">
                            <span class="material-symbols-outlined text-[20px]">notifications_active</span>
                            Billing & Alerts
                        </button>
                    </div>

                    <!-- Personal Profile Content -->
                    <div x-show="view === 'personal'" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                            <div class="section-header mb-8">
                                <h3 class="text-lg font-bold geist-heading font-black">Personal Profile</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage your personal contact information</p>
                            </div>

                            <form method="POST" class="space-y-6">
                                <input type="hidden" name="action" value="update_profile">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">First
                                            Name</label>
                                        <input type="text" name="firstname"
                                            value="<?php echo htmlspecialchars($contactData['firstname'] ?? ''); ?>"
                                            required class="w-full">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Last
                                            Name</label>
                                        <input type="text" name="lastname"
                                            value="<?php echo htmlspecialchars($contactData['lastname'] ?? ''); ?>"
                                            required class="w-full">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Email
                                            Address</label>
                                        <input type="email" name="email"
                                            value="<?php echo htmlspecialchars($contactData['email'] ?? ''); ?>"
                                            required class="w-full">
                                    </div>
                                    <div>
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Phone
                                            Number</label>
                                        <input type="tel" name="phonenumber"
                                            value="<?php echo htmlspecialchars($contactData['phonenumber'] ?? ''); ?>"
                                            class="w-full">
                                    </div>
                                    <div class="md:col-span-2">
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Position
                                            / Title</label>
                                        <input type="text" name="title"
                                            value="<?php echo htmlspecialchars($contactData['title'] ?? ''); ?>"
                                            placeholder="e.g. CEO, CTO, Manager" class="w-full">
                                    </div>
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="bg-primary text-background-dark px-6 py-2.5 rounded-lg font-bold text-sm geist-heading hover:brightness-110 transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">save</span>
                                        Update Profile
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Company Information Content -->
                    <div x-show="view === 'company'" style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                            <div class="section-header mb-8">
                                <h3 class="text-lg font-bold geist-heading font-black">Company Information</h3>
                                <p class="text-sm text-gray-500 mt-1">Manage your organization's legal and contact data
                                </p>
                            </div>

                            <form method="POST" class="space-y-8" x-data="{ activeTab: 'general' }">
                                <input type="hidden" name="action" value="update_company">

                                <!-- Tab Navigation -->
                                <div class="flex border-b border-gray-100 mb-6 overflow-x-auto">
                                    <button type="button" @click="activeTab = 'general'"
                                        class="px-4 py-2 text-xs font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 whitespace-nowrap"
                                        :class="activeTab === 'general' ? 'border-primary text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                                        Company Details
                                    </button>
                                    <button type="button" @click="activeTab = 'registered'"
                                        class="px-4 py-2 text-xs font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 whitespace-nowrap"
                                        :class="activeTab === 'registered' ? 'border-primary text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                                        Registered Address
                                    </button>
                                    <button type="button" @click="activeTab = 'billing'"
                                        class="px-4 py-2 text-xs font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 whitespace-nowrap"
                                        :class="activeTab === 'billing' ? 'border-primary text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                                        Billing Address
                                    </button>
                                    <button type="button" @click="activeTab = 'shipping'"
                                        class="px-4 py-2 text-xs font-bold font-mono uppercase tracking-wider border-b-2 transition-colors duration-200 whitespace-nowrap"
                                        :class="activeTab === 'shipping' ? 'border-primary text-gray-900' : 'border-transparent text-gray-400 hover:text-gray-600'">
                                        Shipping Address
                                    </button>
                                </div>

                                <!-- Basic Info (General Tab) -->
                                <div x-show="activeTab === 'general'"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-1"
                                    x-transition:enter-end="opacity-100 translate-y-0">
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Company
                                                Name</label>
                                            <input type="text" name="company"
                                                value="<?php echo htmlspecialchars($customerData['company'] ?? ''); ?>"
                                                required class="w-full">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">VAT
                                                Number</label>
                                            <input type="text" name="vat"
                                                value="<?php echo htmlspecialchars($customerData['vat'] ?? ''); ?>"
                                                class="w-full">
                                        </div>
                                        <div>
                                            <label
                                                class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Company
                                                Phone</label>
                                            <input type="tel" name="company_phone"
                                                value="<?php echo htmlspecialchars($customerData['phonenumber'] ?? ''); ?>"
                                                class="w-full">
                                        </div>
                                        <div class="md:col-span-2">
                                            <label
                                                class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Website</label>
                                            <input type="text" name="website"
                                                value="<?php echo htmlspecialchars($customerData['website'] ?? ''); ?>"
                                                placeholder="https://..." class="w-full">
                                        </div>
                                    </div>
                                </div>

                                <!-- Address Tabs Content Wrapper -->
                                <div class="mt-8">

                                    <!-- Registered Address Content -->
                                    <div x-show="activeTab === 'registered'"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Street
                                                    Address</label>
                                                <input type="text" name="address" id="main_address"
                                                    value="<?php echo htmlspecialchars($customerData['address'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">City</label>
                                                <input type="text" name="city" id="main_city"
                                                    value="<?php echo htmlspecialchars($customerData['city'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">State
                                                    / Province</label>
                                                <input type="text" name="state" id="main_state"
                                                    value="<?php echo htmlspecialchars($customerData['state'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">ZIP
                                                    / Postal Code</label>
                                                <input type="text" name="zip" id="main_zip"
                                                    value="<?php echo htmlspecialchars($customerData['zip'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Country</label>
                                                <select name="country" id="main_country" class="w-full">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?php echo $country['id']; ?>" <?php echo (isset($customerData['country']) && $customerData['country'] == $country['id']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($country['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Billing Address -->
                                    <div x-show="activeTab === 'billing'"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                                        <div
                                            class="flex items-center justify-end mb-4 border-b border-gray-100 pb-2 text-gray-900 uppercase tracking-wider">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" id="copy_to_billing"
                                                    class="rounded text-primary focus:ring-primary w-3 h-3">
                                                <span class="text-[9px] font-bold font-mono text-gray-400">SAME AS
                                                    CUSTOMER
                                                    INFO</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Street
                                                    Address</label>
                                                <input type="text" name="billing_street" id="billing_address"
                                                    value="<?php echo htmlspecialchars($customerData['billing_street'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">City</label>
                                                <input type="text" name="billing_city" id="billing_city"
                                                    value="<?php echo htmlspecialchars($customerData['billing_city'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">State</label>
                                                <input type="text" name="billing_state" id="billing_state"
                                                    value="<?php echo htmlspecialchars($customerData['billing_state'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">ZIP</label>
                                                <input type="text" name="billing_zip" id="billing_zip"
                                                    value="<?php echo htmlspecialchars($customerData['billing_zip'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Country</label>
                                                <select name="billing_country" id="billing_country" class="w-full">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?php echo $country['id']; ?>" <?php echo (isset($customerData['billing_country']) && $customerData['billing_country'] == $country['id']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($country['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Shipping Address -->
                                    <div x-show="activeTab === 'shipping'"
                                        x-transition:enter="transition ease-out duration-200"
                                        x-transition:enter-start="opacity-0 translate-y-1"
                                        x-transition:enter-end="opacity-100 translate-y-0" style="display: none;">
                                        <div
                                            class="flex items-center justify-end mb-4 border-b border-gray-100 pb-2 text-gray-900 uppercase tracking-wider">
                                            <label class="flex items-center gap-2 cursor-pointer">
                                                <input type="checkbox" id="copy_to_shipping"
                                                    class="rounded text-primary focus:ring-primary w-3 h-3">
                                                <span class="text-[9px] font-bold font-mono text-gray-400">SAME AS
                                                    CUSTOMER
                                                    INFO</span>
                                            </label>
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                            <div class="md:col-span-2">
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Street
                                                    Address</label>
                                                <input type="text" name="shipping_street" id="shipping_address"
                                                    value="<?php echo htmlspecialchars($customerData['shipping_street'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">City</label>
                                                <input type="text" name="shipping_city" id="shipping_city"
                                                    value="<?php echo htmlspecialchars($customerData['shipping_city'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">State</label>
                                                <input type="text" name="shipping_state" id="shipping_state"
                                                    value="<?php echo htmlspecialchars($customerData['shipping_state'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">ZIP</label>
                                                <input type="text" name="shipping_zip" id="shipping_zip"
                                                    value="<?php echo htmlspecialchars($customerData['shipping_zip'] ?? ''); ?>"
                                                    class="w-full">
                                            </div>
                                            <div>
                                                <label
                                                    class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Country</label>
                                                <select name="shipping_country" id="shipping_country" class="w-full">
                                                    <option value="">Select Country</option>
                                                    <?php foreach ($countries as $country): ?>
                                                        <option value="<?php echo $country['id']; ?>" <?php echo (isset($customerData['shipping_country']) && $customerData['shipping_country'] == $country['id']) ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($country['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="bg-primary text-background-dark px-6 py-2.5 rounded-lg font-bold text-sm geist-heading hover:brightness-110 transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">business</span>
                                        Update Company
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Billing & Alerts Content -->
                    <div x-show="view === 'billing_alerts'" style="display: none;"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0">
                        <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                            <div class="section-header mb-8">
                                <h3 class="text-lg font-bold geist-heading font-black">Billing Alerts</h3>
                                <p class="text-sm text-gray-500 mt-1">Configure your low balance threshold to avoid
                                    service suspensions.</p>
                            </div>

                            <form method="POST" class="space-y-6">
                                <input type="hidden" name="action" value="update_billing_alerts">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-1">
                                        <label
                                            class="block text-xs font-mono text-gray-400 uppercase tracking-widest mb-2">Low
                                            Balance Alert Threshold (USD)</label>
                                        <input type="number" step="0.01" name="low_balance_threshold"
                                            value="<?php echo htmlspecialchars($threshold_val); ?>" placeholder="10.00"
                                            class="w-full">
                                    </div>
                                    <div class="md:col-span-1 flex items-center text-xs text-gray-500">
                                        You will receive an email notification when your prepaid balance drops below
                                        this amount.
                                    </div>
                                </div>
                                <div class="flex justify-end pt-4">
                                    <button type="submit"
                                        class="bg-primary text-background-dark px-6 py-2.5 rounded-lg font-bold text-sm geist-heading hover:brightness-110 transition-all flex items-center gap-2">
                                        <span class="material-symbols-outlined text-[18px]">save</span>
                                        Save Alerts Settings
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer
                class="p-8 mt-auto flex justify-between items-center text-[10px] text-gray-400 font-mono border-t border-neutral-border bg-white tech-label">
                <p><?php echo APP_FOOTER_TEXT; ?></p>
                <div class="flex gap-4">
                    <a class="hover:text-primary transition-colors" href="#">API STATUS: ONLINE</a>
                    <a class="hover:text-primary transition-colors" href="#">PRIVACY POLICY</a>
                    <a class="hover:text-primary transition-colors" href="#">SERVICE TERMS</a>
                </div>
            </footer>
        </main>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const copyToBilling = document.getElementById('copy_to_billing');
            const copyToShipping = document.getElementById('copy_to_shipping');

            const mainFields = {
                address: document.getElementById('main_address'),
                city: document.getElementById('main_city'),
                state: document.getElementById('main_state'),
                zip: document.getElementById('main_zip'),
                country: document.getElementById('main_country')
            };

            const billingFields = {
                address: document.getElementById('billing_address'),
                city: document.getElementById('billing_city'),
                state: document.getElementById('billing_state'),
                zip: document.getElementById('billing_zip'),
                country: document.getElementById('billing_country')
            };

            const shippingFields = {
                address: document.getElementById('shipping_address'),
                city: document.getElementById('shipping_city'),
                state: document.getElementById('shipping_state'),
                zip: document.getElementById('shipping_zip'),
                country: document.getElementById('shipping_country')
            };

            function syncFields(source, target) {
                target.address.value = source.address.value;
                target.city.value = source.city.value;
                target.state.value = source.state.value;
                target.zip.value = source.zip.value;
                target.country.value = source.country.value;
            }

            copyToBilling.addEventListener('change', function () {
                if (this.checked) {
                    syncFields(mainFields, billingFields);
                }
            });

            copyToShipping.addEventListener('change', function () {
                if (this.checked) {
                    syncFields(mainFields, shippingFields);
                }
            });

            // Optional: Keep in sync if main address changes while checked
            Object.values(mainFields).forEach(field => {
                field.addEventListener('input', () => {
                    if (copyToBilling.checked) syncFields(mainFields, billingFields);
                    if (copyToShipping.checked) syncFields(mainFields, shippingFields);
                });
                field.addEventListener('change', () => {
                    if (copyToBilling.checked) syncFields(mainFields, billingFields);
                    if (copyToShipping.checked) syncFields(mainFields, shippingFields);
                });
            });
        });
    </script>
</body>

</html>