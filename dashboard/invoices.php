<?php
// dashboard/invoices.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// Common user variables ($fullName, $company, $clientId, $displayClientId) are globally available from auth.php

// Fetch all Invoices for the user
$allInvoices = api_call('invoices');
$userInvoices = [];

// Handle API errors or unexpected response formats
if (is_array($allInvoices)) {
    // If the API returns ['status' => false, 'message' => '...']
    if (isset($allInvoices['status']) && $allInvoices['status'] === false) {
        error_log("[Dashboard Invoices] API Error: " . ($allInvoices['message'] ?? 'Unknown error'));
        $allInvoices = []; // Treat as empty
    }

    foreach ($allInvoices as $inv) {
        // Ensure $inv is an array before accessing keys (fixes the reported Fatal Error)
        if (is_array($inv) && isset($inv['clientid']) && $inv['clientid'] == $user['client_id']) {
            $userInvoices[] = $inv;
        }
    }
} else {
    error_log("[Dashboard Invoices] API returned non-array response: " . print_r($allInvoices, true));
}
// Sort by date desc (Most recent first) and folio desc (secondary)
usort($userInvoices, function ($a, $b) {
    if ($a['date'] == $b['date']) {
        return strcmp($b['formatted_number'], $a['formatted_number']);
    }
    return strtotime($b['date']) - strtotime($a['date']);
});

// Pagination Logic
$perPage = 10;
$totalInvoices = count($userInvoices);
$totalPages = ceil($totalInvoices / $perPage);
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $perPage;

$pagedInvoices = array_slice($userInvoices, $offset, $perPage);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Invoices - ARDO Technology</title>
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

        .status-badge {
            font-family: 'JetBrains Mono', monospace;
            font-size: 10px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .status-1 {
            background: #FEF3C7;
            color: #92400E;
        }

        /* Unpaid */
        .status-2 {
            background: #D1FAE5;
            color: #065F46;
        }

        /* Paid */
        .status-3 {
            background: #DBEAFE;
            color: #1E40AF;
        }

        /* Partial */
        .status-4 {
            background: #FEE2E2;
            color: #991B1B;
        }

        /* Overdue */
        .status-5 {
            background: #F3F4F6;
            color: #374151;
        }

        /* Cancelled */
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
            $pageHeaderTitle = "Account Invoices";
            include 'header.php';
            ?>

            <!-- Content -->
            <div class="p-8 max-w-7xl mx-auto w-full">
                <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Billing History</h3>
                            <p class="text-sm text-gray-500 mt-1">Manage and download your service invoices</p>
                        </div>
                        <div class="flex gap-4">
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">search</span>
                                <input type="text" placeholder="Search invoices..."
                                    class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all w-64"
                                    style="border-radius: 8px;">
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4">Invoice #</th>
                                    <th class="pb-4 px-4">Issue Date</th>
                                    <th class="pb-4 px-4">Due Date</th>
                                    <th class="pb-4 px-4 text-right">Amount</th>
                                    <th class="pb-4 px-4 text-center">Status</th>
                                    <th class="pb-4 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($pagedInvoices)): ?>
                                    <tr>
                                        <td colspan="6"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No invoices found for this account</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($pagedInvoices as $invoice): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                            <td class="py-5 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined text-sm">description</span>
                                                    </div>
                                                    <span class="font-mono font-bold text-gray-900">
                                                        <?php echo htmlspecialchars($invoice['formatted_number']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-500">
                                                <?php echo date('M d, Y', strtotime($invoice['date'])); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-500">
                                                <?php echo date('M d, Y', strtotime($invoice['duedate'])); ?>
                                            </td>
                                            <td class="py-5 px-4 text-right font-mono font-bold text-gray-900">$
                                                <?php echo number_format($invoice['total'], 2); ?>
                                            </td>
                                            <td class="py-5 px-4 text-center">
                                                <span class="status-badge status-<?php echo $invoice['status']; ?>">
                                                    <?php
                                                    $statuses = [1 => 'Unpaid', 2 => 'Paid', 3 => 'Partial', 4 => 'Overdue', 5 => 'Cancelled'];
                                                    echo $statuses[$invoice['status']] ?? 'Unknown';
                                                    ?>
                                                </span>
                                            </td>
                                            <td class="py-5 px-4 text-right">
                                                <div class="flex justify-end gap-2">
                                                    <a href="invoice_preview.php?id=<?php echo $invoice['id']; ?>"
                                                        class="p-2 hover:bg-primary/10 hover:text-primary rounded-lg transition-colors text-gray-400"
                                                        title="Preview">
                                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                    </a>
                                                    <a href="<?php echo get_crm_url(); ?>invoice/<?php echo $invoice['id']; ?>/<?php echo $invoice['hash']; ?>"
                                                        target="_blank"
                                                        class="p-2 hover:bg-gray-100 rounded-lg transition-colors text-gray-400"
                                                        title="Download">
                                                        <span class="material-symbols-outlined text-[20px]">download</span>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <?php if ($totalPages > 1): ?>
                        <div class="mt-8 flex items-center justify-between border-t border-gray-100 pt-6">
                            <div class="text-xs text-gray-400 font-mono uppercase tracking-widest">
                                Showing <?php echo $offset + 1; ?> to <?php echo min($offset + $perPage, $totalInvoices); ?>
                                of <?php echo $totalInvoices; ?> invoices
                            </div>
                            <div class="flex gap-2">
                                <?php if ($currentPage > 1): ?>
                                    <a href="?page=<?php echo $currentPage - 1; ?>"
                                        class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-bold hover:bg-gray-50 transition-colors flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">chevron_left</span> Previous
                                    </a>
                                <?php endif; ?>

                                <?php if ($currentPage < $totalPages): ?>
                                    <a href="?page=<?php echo $currentPage + 1; ?>"
                                        class="px-4 py-2 bg-black text-white rounded-lg text-xs font-bold hover:bg-gray-900 transition-colors flex items-center gap-2 shadow-lg shadow-black/10">
                                        Next <span class="material-symbols-outlined text-sm">chevron_right</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
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
</body>

</html>