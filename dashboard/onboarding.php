<?php
// dashboard/onboarding.php
require_once 'auth.php';

if (!is_logged_in()) {
    header("Location: login.php");
    exit;
}

// User data is already available in $user from auth.php
$fullName = $_SESSION['contact_name'] ?? ($user['firstname'] . ' ' . $user['lastname']);
$company = $user['company_name'];
$clientId = "ARDO-" . str_pad($user['client_id'], 4, '0', STR_PAD_LEFT);

// Fetch current data from API for pre-filling
$customerData = api_call("customers/{$user['client_id']}");
$countriesJson = file_get_contents('countries.json');
$countries = json_decode($countriesJson, true);

$onboarding_status = $user['onboarding_status'] ?? 'pending_info';

if ($onboarding_status === 'verified') {
    header("Location: index.php");
    exit;
}

// Handle Form Submission
$success_msg = '';
$error_msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    file_put_contents('onboarding_debug.log', date('[Y-m-d H:i:s] ') . "POST received: " . print_r($_POST, true) . "\n", FILE_APPEND);
    if (isset($_POST['action']) && $_POST['action'] === 'save_info') {
        $fields = [
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

        $response = api_call("customers/{$user['client_id']}", 'PUT', $fields);
        file_put_contents('onboarding_debug.log', date('[Y-m-d H:i:s] ') . "API Response for client {$user['client_id']}: " . print_r($response, true) . "\n", FILE_APPEND);

        if (isset($response['status']) && ($response['status'] === true || $response['status'] === 1)) {
            // Update local onboarding status
            $conn = get_db_connection();
            $stmt = $conn->prepare("UPDATE users SET onboarding_status = 'pending_identity' WHERE id = ?");
            if ($stmt) {
                $stmt->bind_param("i", $_SESSION['user_id']);
                $success = $stmt->execute();
                $stmt->close();
                $conn->close();
                
                if ($success) {
                    // Update user session to avoid fetching old status immediately if needed
                    $_SESSION['onboarding_status'] = 'pending_identity';
                    
                    // Refresh local user data
                    header("Location: onboarding.php");
                    exit;
                } else {
                    $error_msg = "Database update failed.";
                }
            } else {
                $error_msg = "Database prepare failed: " . $conn->error;
            }
        } else {
            $error_msg = $response['message'] ?? "API error: " . print_r($response, true);
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'start_verification') {
        // 1. Update local DB to indicate pending identity
        $conn = get_db_connection();
        $stmt = $conn->prepare("UPDATE users SET onboarding_status = 'pending_identity' WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $stmt->close();
        $conn->close();

        // 2. Call Stripe Identity API to create session
        $stripeResponse = api_call("stripe_id/create_session", 'POST', [
            'client_id' => $user['client_id'],
            'email' => $user['email'] ?? '',
            'firstname' => $user['firstname'] ?? '',
            'lastname' => $user['lastname'] ?? ''
        ]);

        // 3. Redirect to Stripe or show error
        if (isset($stripeResponse['status']) && $stripeResponse['status'] === true && !empty($stripeResponse['url'])) {
            header("Location: " . $stripeResponse['url']);
            exit;
        } else {
            $error_msg = "Could not create identity session: " . ($stripeResponse['message'] ?? 'Unknown error');
            // If API fails, revert status? Or keep it as pending? Keeping it as pending is safer as they can try again.
        }
    }

    if (isset($_POST['action']) && $_POST['action'] === 'delegate_verification') {
        $email = $_POST['rep_email'] ?? '';
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Log this in the CRM via API if possible
            $response = api_call("stripe_id/delegate", 'POST', [
                'client_id' => $user['client_id'],
                'email' => $email,
                'rep_firstname' => $_POST['rep_firstname'] ?? '',
                'rep_lastname' => $_POST['rep_lastname'] ?? ''
            ]);

            if (isset($response['status']) && $response['status'] === true) {
                $success_msg = "Verification link sent to " . htmlspecialchars($email);
            } else {
                $error_msg = $response['message'] ?? "Failed to send verification email. Please contact support.";
            }
        } else {
            $error_msg = "Please provide a valid email address.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Account Setup - Ardo</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#00F0FF",
                        "obsidian": "#050505",
                        "slate-gray": "#64748b",
                        "background-light": "#ffffff",
                        "background-dark": "#050505",
                        "neutral-border": "rgba(5, 5, 5, 0.05)",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "mono": ["JetBrains Mono", "monospace"]
                    },
                },
            },
        }
    </script>
    <style>
        .headline-font { font-family: "Inter", sans-serif; font-weight: 900; letter-spacing: -0.03em; }
        .mono-font { font-family: "JetBrains Mono", monospace; }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(15, 34, 35, 0.1);
        }

        .grid-bg {
            background-color: #ffffff;
            background-size: 32px 32px;
            background-image: linear-gradient(to right, rgba(15, 34, 35, 0.03) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(15, 34, 35, 0.03) 1px, transparent 1px);
        }

        .step-active { color: #00F0FF; border-color: #00F0FF; box-shadow: 0 0 15px rgba(0, 240, 255, 0.2); }
        .step-pending { color: #cbd5e1; border-color: #e2e8f0; }
        .step-done { color: #10B981; border-color: #10B981; }

        input[type="text"], input[type="email"], input[type="tel"], select {
            border-radius: 8px !important;
            border-color: rgba(5, 5, 5, 0.1);
            font-size: 0.875rem;
            transition: all 0.2s;
        }
        input:focus { 
            ring-color: #00F0FF !important; 
            border-color: #00F0FF !important; 
            box-shadow: 0 0 0 4px rgba(0, 240, 255, 0.1) !important;
        }

        .sub-step-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body class="text-obsidian font-display min-h-screen flex flex-col grid-bg antialiased">
    <!-- Header -->
    <header class="h-20 border-b border-obsidian/5 bg-white/80 backdrop-blur-md flex items-center justify-between px-8 sticky top-0 z-50">
        <div class="flex items-center gap-6">
            <a href="index.php">
                <img src="../images/logo.svg" alt="Ardo Logo" class="h-8 w-auto">
            </a>
            <div class="h-6 w-[1px] bg-obsidian/10"></div>
            <span class="mono-font text-[10px] font-bold text-slate-gray uppercase tracking-[0.2em]">Protocolo_Onboarding_v2</span>
        </div>
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block border-r border-obsidian/10 pr-4 mr-1">
                <p class="text-xs font-black uppercase text-obsidian leading-none"><?php echo htmlspecialchars($fullName); ?></p>
                <p class="mono-font text-[9px] text-slate-gray mt-1 uppercase tracking-wider">ID: <?php echo htmlspecialchars($clientId); ?></p>
            </div>
            <a href="?logout=1" class="size-10 flex items-center justify-center hover:bg-red-50 text-slate-gray hover:text-red-500 rounded-xl transition-all">
                <span class="material-symbols-outlined text-[20px]">logout</span>
            </a>
        </div>
    </header>

    <main class="flex-1 flex flex-col items-center py-16 px-4 max-w-5xl mx-auto w-full">
        <!-- Progress Steps -->
        <div class="flex items-center gap-4 mb-16 w-full max-w-2xl px-8">
            <div class="flex flex-col items-center gap-3 flex-1">
                <div class="size-12 rounded-2xl border-2 flex items-center justify-center font-black transition-all <?php echo ($onboarding_status === 'pending_info') ? 'step-active' : 'step-done'; ?>" id="main_step_1_indicator">
                    <?php if ($onboarding_status !== 'pending_info'): ?>
                        <span class="material-symbols-outlined text-base">check</span>
                    <?php else: ?>
                        1
                    <?php endif; ?>
                </div>
                <span class="mono-font text-[9px] font-bold uppercase tracking-[0.2em] <?php echo ($onboarding_status === 'pending_info') ? 'text-primary' : 'text-green-500'; ?>">INFORMACIÓN</span>
            </div>
            <div class="h-[1px] bg-obsidian/5 flex-1 -mt-8"></div>
            <div class="flex flex-col items-center gap-3 flex-1">
                <div class="size-12 rounded-2xl border-2 flex items-center justify-center font-black transition-all <?php echo ($onboarding_status === 'pending_identity') ? 'step-active' : 'step-pending'; ?>">
                    2
                </div>
                <span class="mono-font text-[9px] font-bold uppercase tracking-[0.2em] <?php echo ($onboarding_status === 'pending_identity') ? 'text-primary' : 'text-slate-gray'; ?>">IDENTIDAD</span>
            </div>
        </div>

        <?php if ($error_msg): ?>
            <div class="w-full max-w-2xl mb-12 p-5 bg-red-50 border border-red-100 text-red-600 rounded-2xl text-sm font-medium animate-in fade-in slide-in-from-top-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-lg">error</span>
                    <?php echo htmlspecialchars($error_msg); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($success_msg): ?>
            <div class="w-full max-w-2xl mb-12 p-5 bg-green-50 border border-green-100 text-green-600 rounded-2xl text-sm font-medium animate-in fade-in slide-in-from-top-4">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-lg">check_circle</span>
                    <?php echo htmlspecialchars($success_msg); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($onboarding_status === 'pending_info'): ?>
            <!-- STEP 1: ACCOUNT INFORMATION (MULTI-SCREEN) -->
            <div class="w-full space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
                <div class="text-center mb-16">
                    <h1 class="headline-font text-4xl lg:text-5xl text-obsidian mb-4 leading-tight">Configuración de <br/><span class="text-primary italic">Perfil Empresarial</span></h1>
                    <p class="mono-font text-[10px] text-slate-gray tracking-[0.1em] uppercase">PASO <span id="sub-step-num" class="text-obsidian font-bold">1</span> DE 4 &nbsp;|&nbsp; <span id="sub-step-title" class="text-primary font-bold">DETALLES DE LA EMPRESA</span></p>
                    
                    <!-- Sub-step Dots -->
                    <div class="flex justify-center gap-3 mt-8">
                        <div class="w-4 h-1.5 rounded-full bg-primary" id="dot-1"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-obsidian/10" id="dot-2"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-obsidian/10" id="dot-3"></div>
                        <div class="w-1.5 h-1.5 rounded-full bg-obsidian/10" id="dot-4"></div>
                    </div>
                </div>

                <form method="POST" class="max-w-xl mx-auto w-full" id="onboarding-form">
                    <input type="hidden" name="action" value="save_info">
                    
                    <!-- Sub-Step 1: Company Card -->
                    <div class="sub-step-card" id="card-1">
                        <div class="glass-card rounded-2xl p-8 bg-white/70 relative overflow-hidden group">
                            <div class="absolute top-0 right-0 w-32 h-32 bg-primary/5 -mr-16 -mt-16 rounded-full transition-all group-hover:bg-primary/10"></div>
                            <div class="flex items-center gap-4 mb-8">
                                <div class="size-12 rounded-xl bg-obsidian flex items-center justify-center text-primary group-hover:shadow-[0_0_15px_rgba(0,238,255,0.3)] transition-all">
                                    <span class="material-symbols-outlined">business</span>
                                </div>
                                <h3 class="headline-font text-lg text-obsidian uppercase tracking-wider">Información de la Empresa</h3>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Razón Social / Entidad Legal</label>
                                    <input type="text" name="company" value="<?php echo htmlspecialchars($customerData['company'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm" placeholder="Ej. Ardo Technology S.A." required>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">RFC / Tax ID</label>
                                        <input type="text" name="vat" value="<?php echo htmlspecialchars($customerData['vat'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm" placeholder="Opcional">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Teléfono Comercial</label>
                                        <input type="text" name="company_phone" value="<?php echo htmlspecialchars($customerData['phonenumber'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm" placeholder="+52 ...">
                                    </div>
                                </div>
                                <div>
                                    <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Sitio Web</label>
                                    <input type="text" name="website" value="<?php echo htmlspecialchars($customerData['website'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm" placeholder="https://...">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Step 2: Business Address Card -->
                    <div class="sub-step-card hidden" id="card-2">
                        <div class="glass-card rounded-2xl p-8 bg-white/70 group">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="size-12 rounded-xl bg-obsidian flex items-center justify-center text-primary group-hover:shadow-[0_0_15px_rgba(0,238,255,0.3)] transition-all">
                                    <span class="material-symbols-outlined">location_on</span>
                                </div>
                                <h3 class="headline-font text-lg text-obsidian uppercase tracking-wider">Dirección Fiscal</h3>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Calle y Número</label>
                                    <input type="text" name="address" id="main_address" value="<?php echo htmlspecialchars($customerData['address'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Ciudad</label>
                                        <input type="text" name="city" id="main_city" value="<?php echo htmlspecialchars($customerData['city'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Estado / Provincia</label>
                                        <input type="text" name="state" id="main_state" value="<?php echo htmlspecialchars($customerData['state'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Código Postal</label>
                                        <input type="text" name="zip" id="main_zip" value="<?php echo htmlspecialchars($customerData['zip'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">País</label>
                                        <select name="country" id="main_country" class="w-full bg-white/50 backdrop-blur-sm">
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($countries as $country): ?>
                                                <option value="<?php echo $country['id']; ?>" <?php echo (($customerData['country'] ?? '') == $country['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($country['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Step 3: Billing Address Card -->
                    <div class="sub-step-card hidden" id="card-3">
                        <div class="glass-card rounded-2xl p-8 bg-white/70 group">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-4">
                                    <div class="size-12 rounded-xl bg-obsidian flex items-center justify-center text-primary group-hover:shadow-[0_0_15px_rgba(0,238,255,0.3)] transition-all">
                                        <span class="material-symbols-outlined">payments</span>
                                    </div>
                                    <h3 class="headline-font text-lg text-obsidian uppercase tracking-wider">Dirección de Facturación</h3>
                                </div>
                                <label class="flex items-center gap-2 cursor-pointer group/label">
                                    <input type="checkbox" id="copy_billing" class="size-4 text-primary border-obsidian/10 rounded focus:ring-primary">
                                    <span class="mono-font text-[9px] font-bold text-slate-gray group-hover/label:text-primary transition-colors uppercase tracking-wider">IGUAL QUE FISCAL</span>
                                </label>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Calle y Número</label>
                                    <input type="text" name="billing_street" id="billing_address" value="<?php echo htmlspecialchars($customerData['billing_street'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Ciudad</label>
                                        <input type="text" name="billing_city" id="billing_city" value="<?php echo htmlspecialchars($customerData['billing_city'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Estado / Provincia</label>
                                        <input type="text" name="billing_state" id="billing_state" value="<?php echo htmlspecialchars($customerData['billing_state'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Código Postal</label>
                                        <input type="text" name="billing_zip" id="billing_zip" value="<?php echo htmlspecialchars($customerData['billing_zip'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">País</label>
                                        <select name="billing_country" id="billing_country" class="w-full bg-white/50 backdrop-blur-sm">
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($countries as $country): ?>
                                                <option value="<?php echo $country['id']; ?>" <?php echo (($customerData['billing_country'] ?? '') == $country['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($country['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sub-Step 4: Shipping Address Card -->
                    <div class="sub-step-card hidden" id="card-4">
                        <div class="glass-card rounded-2xl p-8 bg-white/70 group">
                            <div class="flex items-center justify-between mb-8">
                                <div class="flex items-center gap-4">
                                    <div class="size-12 rounded-xl bg-obsidian flex items-center justify-center text-primary group-hover:shadow-[0_0_15px_rgba(0,238,255,0.3)] transition-all">
                                        <span class="material-symbols-outlined">local_shipping</span>
                                    </div>
                                    <h3 class="headline-font text-lg text-obsidian uppercase tracking-wider">Punto de Servicio</h3>
                                </div>
                                <label class="flex items-center gap-2 cursor-pointer group/label">
                                    <input type="checkbox" id="copy_shipping" class="size-4 text-primary border-obsidian/10 rounded focus:ring-primary">
                                    <span class="mono-font text-[9px] font-bold text-slate-gray group-hover/label:text-primary transition-colors uppercase tracking-wider">IGUAL QUE FISCAL</span>
                                </label>
                            </div>
                            <div class="space-y-6">
                                <div>
                                    <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Calle y Número</label>
                                    <input type="text" name="shipping_street" id="shipping_address" value="<?php echo htmlspecialchars($customerData['shipping_street'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Ciudad</label>
                                        <input type="text" name="shipping_city" id="shipping_city" value="<?php echo htmlspecialchars($customerData['shipping_city'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Estado / Provincia</label>
                                        <input type="text" name="shipping_state" id="shipping_state" value="<?php echo htmlspecialchars($customerData['shipping_state'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Código Postal</label>
                                        <input type="text" name="shipping_zip" id="shipping_zip" value="<?php echo htmlspecialchars($customerData['shipping_zip'] ?? ''); ?>" class="w-full bg-white/50 backdrop-blur-sm">
                                    </div>
                                    <div>
                                        <label class="mono-font block text-[9px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">País</label>
                                        <select name="shipping_country" id="shipping_country" class="w-full bg-white/50 backdrop-blur-sm">
                                            <option value="">Seleccionar</option>
                                            <?php foreach ($countries as $country): ?>
                                                <option value="<?php echo $country['id']; ?>" <?php echo (($customerData['country'] ?? '') == $country['id']) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($country['name']); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex items-center justify-between pt-12 gap-6">
                        <button type="button" id="prev-btn" class="hidden flex items-center gap-3 text-slate-gray hover:text-obsidian transition-all mono-font text-[10px] font-bold uppercase tracking-[0.2em]">
                            <span class="material-symbols-outlined text-base">arrow_back</span>
                            ANTERIOR
                        </button>
                        <div class="flex-1"></div>
                        <button type="button" id="next-btn" class="bg-obsidian hover:bg-obsidian/90 text-white font-black py-4 px-10 rounded-xl transition-all flex items-center gap-3 headline-font text-[11px] tracking-[0.1em] uppercase group">
                            SIGUIENTE PASO
                            <span class="material-symbols-outlined text-base text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                        <button type="submit" id="submit-btn" class="hidden bg-obsidian hover:bg-obsidian/90 text-white font-black py-4 px-10 rounded-xl transition-all flex items-center gap-3 headline-font text-[11px] tracking-[0.1em] uppercase group">
                            FINALIZAR PASO
                            <span class="material-symbols-outlined text-base text-primary group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
            
            <script>
                // Multi-step Logic
                let currentSubStep = 1;
                const totalSubSteps = 4;
                const titles = [
                    'Company Details',
                    'Business Address',
                    'Billing Address',
                    'Service Delivery'
                ];

                function updateUI() {
                    // Update Title & Number
                    document.getElementById('sub-step-num').textContent = currentSubStep;
                    document.getElementById('sub-step-title').textContent = titles[currentSubStep - 1];

                    // Update Cards
                    document.querySelectorAll('.sub-step-card').forEach((card, idx) => {
                        card.classList.toggle('hidden', idx + 1 !== currentSubStep);
                    });

                    // Update Dots
                    for (let i = 1; i <= totalSubSteps; i++) {
                        const dot = document.getElementById('dot-' + i);
                        dot.className = `w-1.5 h-1.5 rounded-full transition-all ${i === currentSubStep ? 'bg-primary w-4' : (i < currentSubStep ? 'bg-green-400' : 'bg-gray-200')}`;
                    }

                    // Update Buttons
                    document.getElementById('prev-btn').classList.toggle('hidden', currentSubStep === 1);
                    document.getElementById('next-btn').classList.toggle('hidden', currentSubStep === totalSubSteps);
                    document.getElementById('submit-btn').classList.toggle('hidden', currentSubStep !== totalSubSteps);
                }

                document.getElementById('next-btn').addEventListener('click', () => {
                    if (currentSubStep < totalSubSteps) {
                        currentSubStep++;
                        updateUI();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });

                document.getElementById('prev-btn').addEventListener('click', () => {
                    if (currentSubStep > 1) {
                        currentSubStep--;
                        updateUI();
                        window.scrollTo({ top: 0, behavior: 'smooth' });
                    }
                });

                // Address Sync Logic
                const addressFields = ['address', 'city', 'state', 'zip', 'country'];
                
                function sync(type, checked) {
                    addressFields.forEach(f => {
                        const main = document.getElementById('main_' + f);
                        const target = document.getElementById(type + '_' + (f === 'address' ? 'address' : f));
                        if (checked && main && target) {
                            target.value = main.value;
                        }
                    });
                }

                document.getElementById('copy_billing').addEventListener('change', (e) => sync('billing', e.target.checked));
                document.getElementById('copy_shipping').addEventListener('change', (e) => sync('shipping', e.target.checked));

                addressFields.forEach(f => {
                    const el = document.getElementById('main_' + f);
                    if (el) {
                        el.addEventListener('input', () => {
                            if (document.getElementById('copy_billing').checked) sync('billing', true);
                            if (document.getElementById('copy_shipping').checked) sync('shipping', true);
                        });
                    }
                });

                // Initialize UI
                updateUI();
            </script>

        <?php elseif ($onboarding_status === 'pending_identity'): ?>
            <!-- STEP 2: IDENTITY VERIFICATION -->
            <div class="w-full max-w-2xl space-y-12 animate-in fade-in slide-in-from-bottom-8 duration-700">
                <div class="text-center mb-16">
                    <div class="inline-flex items-center justify-center size-20 rounded-3xl bg-primary/10 text-primary mb-8 shadow-[0_0_30px_rgba(0,240,255,0.1)]">
                        <span class="material-symbols-outlined text-4xl">fingerprint</span>
                    </div>
                    <h1 class="headline-font text-4xl text-obsidian mb-4 uppercase tracking-tighter">Verificación de Identidad</h1>
                    <p class="mono-font text-[10px] text-slate-gray tracking-[0.1em] uppercase">MÉTODO SEGURO VÍA <span class="text-primary font-bold">STRIPE IDENTITY</span></p>
                </div>

                <div class="glass-card rounded-3xl p-10 bg-white/70 text-center relative overflow-hidden group">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/5 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    <div class="space-y-8">
                        <?php
                            // Check for existing delegation
                            $verification_status = api_call("stripe_id/status?client_id={$user['client_id']}");
                            
                            $delegate_email = '';
                            $delegate_firstname = '';
                            $delegate_lastname = '';
                            $has_delegated = false;
                            $requires_manual_review = false;
                            
                            if (isset($verification_status['status']) && $verification_status['status'] === true) {
                                $data = $verification_status['data'];
                                $delegate_email = $data['representative_email'] ?? '';
                                $delegate_firstname = $data['firstname'] ?? '';
                                $delegate_lastname = $data['lastname'] ?? '';
                                
                                if ($data['status'] === 'verified') {
                                    $conn = get_db_connection();
                                    $stmt = $conn->prepare("UPDATE users SET onboarding_status = 'verified' WHERE id = ?");
                                    $stmt->bind_param("i", $_SESSION['user_id']);
                                    $stmt->execute();
                                    $stmt->close();
                                    $conn->close();

                                    echo "<script>window.location.href = 'index.php';</script>";
                                    exit;
                                }

                                $has_delegated = ($data['status'] === 'pending');
                                $requires_manual_review = ($data['status'] === 'requires_manual_review' || $data['status'] === 'processing');
                            }
                        ?>

                        <?php if ($requires_manual_review): ?>
                            <!-- STATUS: IN REVIEW (Premium) -->
                            <div class="py-12 flex flex-col items-center justify-center text-center space-y-8 animate-in fade-in zoom-in duration-500">
                                <div class="relative">
                                    <div class="absolute inset-0 bg-primary/20 blur-2xl rounded-full"></div>
                                    <div class="relative size-16 bg-obsidian rounded-2xl flex items-center justify-center shadow-2xl">
                                        <div class="w-10 h-4 bg-primary" style="-webkit-mask-image: url(../images/logo.svg); mask-image: url(../images/logo.svg); -webkit-mask-size: contain; mask-size: contain; -webkit-mask-repeat: no-repeat; mask-repeat: no-repeat; -webkit-mask-position: center; mask-position: center;"></div>
                                    </div>
                                </div>
                                
                                <div class="space-y-3">
                                    <h3 class="headline-font text-xl text-obsidian uppercase tracking-wider">Verificación en Revisión</h3>
                                    <p class="text-slate-gray text-sm max-w-md mx-auto leading-relaxed">
                                        Nuestro equipo legal está revisando tus documentos. Este proceso toma habitualmente de <span class="text-obsidian font-bold">24 a 48 horas</span> hábiles.
                                    </p>
                                </div>

                                <div class="inline-flex items-center gap-3 px-4 py-2 bg-primary/5 border border-primary/20 rounded-full">
                                    <div class="size-2 rounded-full bg-primary animate-pulse"></div>
                                    <span class="mono-font text-[9px] font-bold uppercase tracking-[0.2em] text-primary">ESTADO: REVISIÓN MANUAL</span>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- VERIFICATION OPTIONS -->
                            <div class="space-y-6">
                                <p class="text-slate-gray mb-6 leading-relaxed">Para garantizar la seguridad de tu infraestructura, requerimos la verificación de identidad del representante legal.</p>
                                
                                <!-- Option 1: Self Verify -->
                                <form method="POST" id="form-self-verify" class="transition-all duration-300">
                                    <input type="hidden" name="action" value="start_verification">
                                    <button type="submit" class="w-full p-6 border border-obsidian/10 rounded-2xl flex items-center gap-6 hover:border-primary hover:bg-primary/5 transition-all group text-left bg-white/50 backdrop-blur-sm">
                                        <div class="size-14 rounded-xl bg-obsidian flex items-center justify-center text-primary group-hover:shadow-[0_0_15px_rgba(0,238,255,0.3)] transition-all">
                                            <span class="material-symbols-outlined text-2xl">person</span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="headline-font text-sm text-obsidian uppercase tracking-wider">Soy el Representante Legal</p>
                                            <p class="mono-font text-[9px] text-slate-gray uppercase tracking-[0.2em] mt-1">INICIAR CHECK BIOMÉTRICO</p>
                                        </div>
                                        <span class="material-symbols-outlined text-primary opacity-0 group-hover:opacity-100 group-hover:translate-x-1 transition-all">arrow_forward</span>
                                    </button>
                                </form>

                                <!-- Option 2: Delegate -->
                                <div id="delegate-section" class="border border-obsidian/5 rounded-2xl bg-obsidian/[0.02] overflow-hidden transition-all duration-500">
                                    <div class="p-6 flex items-center gap-6 cursor-pointer hover:bg-white/80 transition-all" onclick="toggleDelegateForm()">
                                        <div class="size-14 rounded-xl bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-white transition-all">
                                            <span class="material-symbols-outlined text-2xl">mail</span>
                                        </div>
                                        <div class="flex-1 text-left">
                                            <p class="headline-font text-sm text-obsidian uppercase tracking-wider">Otra persona es el representante</p>
                                            <p class="mono-font text-[9px] text-slate-gray uppercase tracking-[0.2em] mt-1">ENVIAR ENLACE POR CORREO</p>
                                        </div>
                                        <span class="material-symbols-outlined text-slate-400 transform transition-transform duration-500" id="delegate-arrow">expand_more</span>
                                    </div>
                                    
                                    <form method="POST" class="hidden p-6 pt-2 space-y-6 border-t border-obsidian/5 bg-white/40" id="delegate-form">
                                        <input type="hidden" name="action" value="delegate_verification">
                                        <div class="space-y-4">
                                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="mono-font block text-[8px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Nombre</label>
                                                    <input type="text" name="rep_firstname" value="<?php echo htmlspecialchars($delegate_firstname); ?>" class="w-full bg-white/80" required>
                                                </div>
                                                <div>
                                                    <label class="mono-font block text-[8px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Apellidos</label>
                                                    <input type="text" name="rep_lastname" value="<?php echo htmlspecialchars($delegate_lastname); ?>" class="w-full bg-white/80" required>
                                                </div>
                                            </div>
                                            <div>
                                                <label class="mono-font block text-[8px] font-bold text-slate-gray uppercase tracking-[0.2em] mb-2">Correo Electrónico</label>
                                                <div class="flex flex-col sm:flex-row gap-4">
                                                    <input type="email" name="rep_email" value="<?php echo htmlspecialchars($delegate_email); ?>" class="flex-1 bg-white/80" placeholder="ejemplo@empresa.com" required>
                                                    <button type="submit" class="bg-obsidian hover:bg-obsidian/90 text-white font-black py-3 px-8 rounded-xl transition-all mono-font text-[9px] tracking-[0.2em] uppercase">
                                                        <?php echo $has_delegated ? 'REENVIAR' : 'ENVIAR'; ?>
                                                    </button>
                                                </div>
                                            </div>
                                            <?php if ($has_delegated): ?>
                                                <div class="bg-primary/5 p-4 rounded-xl border border-primary/20 flex flex-col sm:flex-row items-center justify-between gap-4">
                                                    <p class="mono-font text-[8px] text-slate-gray uppercase tracking-widest text-center sm:text-left">EL ENLACE DE VERIFICACIÓN FUE ENVIADO PREVIAMENTE</p>
                                                    <button type="submit" class="text-primary font-black text-[9px] uppercase hover:underline tracking-widest">VOLVER A ENVIAR</button>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </form>
                                </div>
                <script>
                    function toggleDelegateForm() {
                        const form = document.getElementById('delegate-form');
                        const arrow = document.getElementById('delegate-arrow');
                        const selfVerifyForm = document.getElementById('form-self-verify');
                        const section = document.getElementById('delegate-section');
                        const isHidden = form.classList.contains('hidden');
                        
                        if (isHidden) {
                            form.classList.remove('hidden');
                            arrow.style.transform = 'rotate(180deg)';
                            selfVerifyForm.classList.add('opacity-30', 'pointer-events-none', 'grayscale');
                            section.classList.add('ring-2', 'ring-primary/20', 'bg-white');
                        } else {
                            form.classList.add('hidden');
                            arrow.style.transform = 'rotate(0deg)';
                            selfVerifyForm.classList.remove('opacity-30', 'pointer-events-none', 'grayscale');
                            section.classList.remove('ring-2', 'ring-primary/20', 'bg-white');
                        }
                    }
                </script>
            </div>
        <?php endif; ?>
    </main>

    <!-- Footer -->
    <footer class="h-12 border-t border-neutral-border bg-white flex items-center justify-center px-8 text-[10px] text-gray-400 font-mono tracking-widest uppercase">
        &copy; <?php echo date('Y'); ?> ARDO DE MEXICO, S.A.P.I DE C.V. &bull; PREMIUM SECURITY LAYER
    </footer>
</body>
</html>
