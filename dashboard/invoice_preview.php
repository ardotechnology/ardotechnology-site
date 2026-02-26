<?php
// dashboard/invoice_preview.php
require_once 'auth.php';
require_login();

$invoice_id = $_GET['id'] ?? null;
if (!$invoice_id) {
    die("ID de factura no proporcionado.");
}

// Fetch invoice from API
$invoice = api_call("invoices/$invoice_id");

if (!$invoice || !isset($invoice['id'])) {
    die("Factura no encontrada.");
}

// Security: Check if this invoice belongs to the logged-in client
if ($invoice['clientid'] != $user['client_id']) {
    die("Acceso denegado.");
}

$fullName = $user['firstname'] . ' ' . $user['lastname'];
$company = $user['company_name'];
$clientId = "ARDO-" . str_pad($user['client_id'], 4, '0', STR_PAD_LEFT);
$invoiceNumber = $invoice['prefix'] . str_pad($invoice['number'], 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Invoice
        <?php echo $invoiceNumber; ?> - ARDO Technology
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@500;700&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
        }

        .geist-heading {
            font-weight: 900;
            letter-spacing: -0.02em;
            text-transform: uppercase;
        }

        .tech-label {
            font-family: 'JetBrains Mono', monospace;
            letter-spacing: 0.05em;
        }
    </style>
</head>

<div class="h-screen flex flex-col">
    <div class="flex items-center justify-between p-4 bg-white border-b border-gray-200 no-print">
        <a href="invoices.php"
            class="flex items-center gap-2 text-gray-500 hover:text-primary transition-colors font-bold text-sm uppercase tracking-widest tech-label">
            <span class="material-symbols-outlined">arrow_back</span> Back to Invoices
        </a>
        <div class="text-right">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest tech-label">Invoice Preview</p>
            <p class="text-sm font-bold text-gray-900"><?php echo $invoiceNumber; ?></p>
        </div>
    </div>

    <div class="flex-1 w-full bg-gray-100 overflow-hidden">
        <iframe src="<?php echo get_crm_url(); ?>invoice/<?php echo $invoice['id']; ?>/<?php echo $invoice['hash']; ?>"
            class="w-full h-full border-0" allowfullscreen>
        </iframe>
    </div>
</div>
</body>

</html>