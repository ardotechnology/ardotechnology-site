<?php
// dashboard/index.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// Common user variables ($fullName, $company, $clientId, $displayClientId) are globally available from auth.php

$error = null;
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['top_up'])) {
    $amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    if ($amount < 10) {
        $error = "Minimum top-up amount is $10.00.";
    } else {
        $postData = [
            'clientid' => $clientId,
            'amount' => $amount
        ];
        $topupResponse = api_call('switches/topup', 'POST', $postData);
        if (isset($topupResponse['status']) && $topupResponse['status']) {
            $success = "Top-up invoice created successfully! Redirecting...";
            if (!empty($topupResponse['invoice_id'])) {
                header("Location: invoice_preview.php?id=" . $topupResponse['invoice_id']);
                exit;
            }
        } else {
            $error = $topupResponse['message'] ?? "Failed to create top-up invoice.";
        }
    }
}

// Fetch Recent Invoices for the user
// Since we don't have a direct "search by client_id" in the general GET invoices, 
// we will fetch all and filter, or use direct DB for this view if the list is long.
// BUT for this task, I'll use the API as requested, and since it's a test env, it's fine.
$allInvoices = api_call('invoices');
$userInvoices = [];

// Validate API response before processing
if (is_array($allInvoices) && !empty($allInvoices)) {
    foreach ($allInvoices as $inv) {
        // Ensure $inv is an array and has required fields
        if (is_array($inv) && isset($inv['clientid']) && $inv['clientid'] == $user['client_id']) {
            $userInvoices[] = $inv;
        }
    }
} else {
    // Log API error for debugging
    error_log("[Dashboard Index] API call to 'invoices' failed or returned non-array: " . json_encode($allInvoices));
}

// Sort by folio desc (only if we have invoices)
if (!empty($userInvoices)) {
    usort($userInvoices, function ($a, $b) {
        return $b['number'] <=> $a['number'];
    });
}

// 1. Fetch Dashboard Summary (Consolidated)
$summaryResponse = api_call('switches/summary?clientid=' . $user['client_id'] . '&magnus_user=' . urlencode($selectedMagnusUser));

$balance = 0;
$totalNumbers = 0;
$monthlyMinutes = 0;
$chartData = [];

if (isset($summaryResponse['status']) && $summaryResponse['status']) {
    $summary = $summaryResponse['data'];

    // Balance
    $balanceStr = $summary['balance'] ?? '0.00';
    $balance = (float) str_replace(['$', ' ', ','], '', $balanceStr);

    // Active Numbers
    $totalNumbers = $summary['dids']['total'] ?? 0;

    // Monthly Minutes
    $monthlyMinutes = floor(($summary['stats']['total_duration'] ?? 0) / 60);

    // Analytics Data
    if (isset($summary['analytics']) && is_array($summary['analytics'])) {
        foreach ($summary['analytics'] as $day) {
            $chartData[] = [
                'day' => date('d M', strtotime($day['day'])),
                'count' => (int) $day['count']
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>ARDO Technology - Customer Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

<body class="bg-background-light text-[#050505] font-display" x-data="{ showTopUpModal: false }">
    <div class="flex h-screen overflow-hidden">
        <!-- Left Sidebar Navigation -->
        <?php include 'sidebar.php'; ?>
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <!-- Header -->
            <?php
            $pageHeaderTitle = "Welcome back, " . htmlspecialchars($user['firstname']);
            include 'header.php';
            ?>
            <!-- Content Grid -->
            <div class="p-8 space-y-8 max-w-7xl mx-auto w-full">
                <!-- Notifications -->
                <?php if ($error): ?>
                    <div
                        class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div
                        class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-lg text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <!-- Top Row (Bento Stats) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="glass-card rounded-lg p-6 flex flex-col justify-between" style="border-radius: 8px;">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Account Balance</p>
                            <h3 class="text-3xl font-bold font-mono mt-2">$<?php echo number_format($balance, 2); ?>
                            </h3>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-xs font-mono text-green-500 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">trending_up</span> +10.5%
                            </span>
                            <button @click="showTopUpModal = true"
                                class="bg-primary text-background-dark text-xs font-bold px-4 py-2 rounded-lg hover:shadow-lg hover:shadow-primary/20 transition-all"
                                style="border-radius: 8px;">Top Up</button>
                        </div>
                    </div>
                    <div class="glass-card rounded-lg p-6 flex flex-col justify-between" style="border-radius: 8px;">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Active Numbers</p>
                            <h3 class="text-3xl font-bold font-mono mt-2"><?php echo $totalNumbers; ?></h3>
                        </div>
                        <div class="mt-4">
                            <div class="w-full bg-gray-100 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-primary h-full w-[<?php echo min(100, ($totalNumbers / 10) * 100); ?>%]">
                                </div>
                            </div>
                            <p class="text-[10px] text-gray-400 mt-2">
                                <?php echo min(100, ($totalNumbers / 10) * 100); ?>% of provisioned capacity
                            </p>
                        </div>
                    </div>
                    <div class="glass-card rounded-lg p-6 flex flex-col justify-between" style="border-radius: 8px;">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Monthly Minutes Used</p>
                            <h3 class="text-3xl font-bold font-mono mt-2"><?php echo number_format($monthlyMinutes); ?>
                                <span class="text-sm text-gray-400">min</span>
                            </h3>
                        </div>
                        <div class="mt-4 flex items-center gap-2">
                            <span class="px-2 py-0.5 rounded bg-primary/10 text-primary text-[10px] font-bold">UNLIMITED
                                PLAN</span>
                            <span class="text-[10px] text-gray-400">Current Period</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Invoices Row -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div class="glass-card rounded-lg p-6" style="border-radius: 8px;">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-md font-bold geist-heading font-black">Recent Invoices</h3>
                            <a href="invoices.php" class="text-xs text-primary hover:underline font-bold">View All</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm">
                                <thead class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono">
                                    <tr>
                                        <th class="pb-3 px-2">Number</th>
                                        <th class="pb-3 px-2">Date</th>
                                        <th class="pb-3 px-2 text-right">Amount</th>
                                        <th class="pb-3 px-2 text-center">Status</th>
                                        <th class="pb-3 px-2"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    <?php if (empty($userInvoices)): ?>
                                        <tr>
                                            <td colspan="5" class="py-12 text-center text-gray-400 font-mono text-xs">NO
                                                INVOICES FOUND</td>
                                        </tr>
                                    <?php else: ?>
                                        <?php foreach ($userInvoices as $invoice): ?>
                                            <tr class="hover:bg-gray-50 transition-colors">
                                                <td class="py-4 px-2 font-mono font-bold">
                                                    <?php echo htmlspecialchars($invoice['prefix'] . str_pad($invoice['number'], 4, '0', STR_PAD_LEFT)); ?>
                                                </td>
                                                <td class="py-4 px-2 text-gray-500">
                                                    <?php echo date('M d, Y', strtotime($invoice['date'])); ?>
                                                </td>
                                                <td class="py-4 px-2 text-right font-mono font-bold">
                                                    $<?php echo number_format($invoice['total'], 2); ?></td>
                                                <td class="py-4 px-2 text-center">
                                                    <span class="status-badge status-<?php echo $invoice['status']; ?>">
                                                        <?php
                                                        $statuses = [1 => 'Unpaid', 2 => 'Paid', 3 => 'Partial', 4 => 'Overdue', 5 => 'Cancelled'];
                                                        echo $statuses[$invoice['status']] ?? 'Unknown';
                                                        ?>
                                                    </span>
                                                </td>
                                                <td class="py-4 px-2 text-right">
                                                    <a href="invoice_preview.php?id=<?php echo $invoice['id']; ?>"
                                                        class="p-1 hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined text-[20px]">visibility</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="glass-card rounded-lg p-6 flex flex-col" style="border-radius: 8px;">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-md font-bold geist-heading font-black">Call Volume Analytics</h3>
                            <button class="text-xs text-gray-400 font-mono">CURRENT MONTH</button>
                        </div>
                        <div class="flex-1 relative min-h-[150px]">
                            <?php if (empty($chartData)): ?>
                                <div
                                    class="absolute inset-0 flex flex-col items-center justify-center border-2 border-dashed border-gray-100 rounded-lg p-4 text-center">
                                    <p class="text-gray-400 font-mono text-xs uppercase tracking-widest mb-2">No data
                                        available
                                        for this period</p>
                                    <p class="text-gray-300 text-[10px] font-mono italic">If you recently added numbers,
                                        synchronization may take a few minutes. <a href="javascript:location.reload()"
                                            class="text-primary hover:underline">Refresh dashboard</a></p>
                                </div>
                            <?php else: ?>
                                <canvas id="callVolumeChart"></canvas>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                        const chartEl = document.getElementById('callVolumeChart');
                                        if (!chartEl) return;
                                        const ctx = chartEl.getContext('2d');
                                        const labels = <?php echo json_encode(array_column($chartData, 'day')); ?>;
                                        const data = <?php echo json_encode(array_column($chartData, 'count')); ?>;

                                        new Chart(ctx, {
                                            type: 'bar',
                                            data: {
                                                labels: labels,
                                                datasets: [{
                                                    label: 'Calls',
                                                    data: data,
                                                    backgroundColor: '#00F0FF',
                                                    borderRadius: 4,
                                                    maxBarThickness: 10
                                                }]
                                            },
                                            options: {
                                                responsive: true,
                                                maintainAspectRatio: false,
                                                plugins: {
                                                    legend: { display: false }
                                                },
                                                scales: {
                                                    y: {
                                                        beginAtZero: true,
                                                        grid: { display: false },
                                                        ticks: {
                                                            font: { family: 'JetBrains Mono', size: 9 },
                                                            color: '#9ca3af'
                                                        }
                                                    },
                                                    x: {
                                                        grid: { display: false },
                                                        ticks: {
                                                            font: { family: 'JetBrains Mono', size: 9 },
                                                            color: '#9ca3af'
                                                        }
                                                    }
                                                }
                                            }
                                        });
                                    });
                                </script>
                            <?php endif; ?>
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

    <!-- Top-Up Modal -->
    <div x-show="showTopUpModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        style="display: none;">
        <div x-show="showTopUpModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showTopUpModal" @click.away="showTopUpModal = false"
                    x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-primary/10 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="material-symbols-outlined text-primary">account_balance_wallet</span>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Top Up
                                    Wallet</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Enter the amount you wish to add to your pre-paid
                                        balance. A payment invoice will be generated.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="index.php">
                        <input type="hidden" name="top_up" value="1">
                        <div class="px-6 py-4 space-y-4">
                            <!-- Amount Input -->
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Amount
                                    (MXN) <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 font-mono">$</span>
                                    </div>
                                    <input type="number" step="0.01" min="10" name="amount" required
                                        placeholder="100.00"
                                        class="w-full pl-8 pr-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-mono focus:ring-primary focus:border-primary transition-all shadow-sm">
                                </div>
                                <p class="text-[10px] text-gray-400 mt-1">Minimum amount is $100.00</p>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 mt-2">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-lg bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 sm:ml-3 sm:w-auto">Generate
                                Invoice</button>
                            <button type="button" @click="showTopUpModal = false"
                                class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>