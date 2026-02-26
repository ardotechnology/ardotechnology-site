<?php
// dashboard/reports.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// User data
$fullName = $user['firstname'] . ' ' . $user['lastname'];
$clientId = $user['client_id'];

// Pagination & Filtering
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$from_date = $_GET['from_date'] ?? date('Y-m-d', strtotime('-1 month'));
$to_date = $_GET['to_date'] ?? date('Y-m-d');
$search = $_GET['search'] ?? '';

// Fetch Stats
$statsResponse = api_call("switches/stats?clientid=$clientId&magnus_user=" . urlencode($selectedMagnusUser) . "&from_date=$from_date&to_date=$to_date&search=" . urlencode($search));
$stats = ($statsResponse['status'] ?? false) ? $statsResponse['data'] : ['total_calls' => 0, 'total_duration' => 0, 'total_billed' => 0];

// Fetch Calls
$callsResponse = api_call("switches/calls?clientid=$clientId&magnus_user=" . urlencode($selectedMagnusUser) . "&page=$page&limit=$limit&from_date=$from_date&to_date=$to_date&search=" . urlencode($search));

$calls = [];
$totalCalls = 0;
$totalPages = 0;

if (isset($callsResponse['status']) && $callsResponse['status']) {
    $calls = $callsResponse['data']['rows'] ?? [];
    $totalCalls = $callsResponse['data']['total'] ?? 0;
    $totalPages = ceil($totalCalls / $limit);
} else {
    $error = $callsResponse['message'] ?? 'Unable to load call records.';
}

function formatDuration($seconds)
{
    $h = floor($seconds / 3600);
    $m = floor(($seconds % 3600) / 60);
    $s = $seconds % 60;
    return ($h > 0 ? $h . "h " : "") . ($m > 0 ? $m . "m " : "") . $s . "s";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Reports - ARDO Technology</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
            padding: 2px 8px;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .dir-in {
            background: #DBEAFE;
            color: #1E40AF;
        }

        .dir-out {
            background: #F3F4F6;
            color: #374151;
        }
    </style>
</head>

<body class="bg-background-light text-[#050505] font-display">
    <div class="flex h-screen overflow-hidden">
        <?php include 'sidebar.php'; ?>

        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <?php
            $pageHeaderTitle = "Communication Reports";
            include 'header.php';
            ?>

            <div class="p-8 max-w-7xl mx-auto w-full">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="glass-card rounded-lg p-6">
                        <p class="text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-1">Total Calls</p>
                        <h4 class="text-3xl font-black geist-heading">
                            <?php echo number_format($stats['total_calls']); ?>
                        </h4>
                        <div class="mt-2 text-[10px] text-gray-500 font-mono">Records in period</div>
                    </div>
                    <div class="glass-card rounded-lg p-6">
                        <p class="text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-1">Total Duration</p>
                        <h4 class="text-3xl font-black geist-heading">
                            <?php echo formatDuration($stats['total_duration']); ?>
                        </h4>
                        <div class="mt-2 text-[10px] text-gray-500 font-mono">Airtime used</div>
                    </div>
                    <div class="glass-card rounded-lg p-6">
                        <p class="text-[10px] font-mono text-gray-400 uppercase tracking-widest mb-1">Period Billing</p>
                        <h4 class="text-3xl font-black geist-heading">$
                            <?php echo number_format($stats['total_billed'], 2); ?>
                        </h4>
                        <div class="mt-2 text-[10px] text-gray-500 font-mono">Estimated cost</div>
                    </div>
                </div>

                <!-- Main Card -->
                <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Call History</h3>
                            <p class="text-sm text-gray-500 mt-1">Detailed Call Detail Records (CDR)</p>
                        </div>
                        <form method="GET" class="flex flex-wrap gap-4">
                            <div class="flex items-center gap-2">
                                <label class="text-[10px] font-mono text-gray-400 uppercase">From</label>
                                <input type="date" name="from_date" value="<?php echo htmlspecialchars($from_date); ?>"
                                    class="px-3 py-1.5 bg-gray-50 border border-gray-100 rounded-lg text-xs focus:ring-primary transition-all">
                            </div>
                            <div class="flex items-center gap-2">
                                <label class="text-[10px] font-mono text-gray-400 uppercase">To</label>
                                <input type="date" name="to_date" value="<?php echo htmlspecialchars($to_date); ?>"
                                    class="px-3 py-1.5 bg-gray-50 border border-gray-100 rounded-lg text-xs focus:ring-primary transition-all">
                            </div>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">search</span>
                                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                                    placeholder="Search number..."
                                    class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-primary transition-all w-48">
                            </div>
                            <button type="submit"
                                class="bg-black text-white px-5 py-2 rounded-lg text-xs font-bold hover:bg-gray-900 transition-colors">Apply
                                Filters</button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4">Date & Time</th>
                                    <th class="pb-4 px-4">Source</th>
                                    <th class="pb-4 px-4">Destination</th>
                                    <th class="pb-4 px-4 text-center">Dir</th>
                                    <th class="pb-4 px-4">Duration</th>
                                    <th class="pb-4 px-4 text-right">Cost</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($calls)): ?>
                                    <tr>
                                        <td colspan="6"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No call records found for this period
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($calls as $call): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="py-4 px-4">
                                                <div class="text-sm text-gray-900 font-medium">
                                                    <?php echo date('M d, Y', strtotime($call['starttime'])); ?>
                                                </div>
                                                <div class="text-[10px] font-mono text-gray-400 uppercase">
                                                    <?php echo date('H:i:s', strtotime($call['starttime'])); ?>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 font-mono text-xs text-gray-600">
                                                <?php echo htmlspecialchars($call['callerid'] ?: $call['src'] ?: 'Anonymous'); ?>
                                            </td>
                                            <td class="py-4 px-4 font-mono text-xs text-gray-900 font-bold">
                                                <?php echo htmlspecialchars($call['calledstation']); ?>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <span
                                                    class="status-badge <?php echo $call['direction'] == 'incoming' ? 'dir-in' : 'dir-out'; ?>">
                                                    <?php echo $call['direction']; ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 text-sm text-gray-600 font-mono">
                                                <?php echo formatDuration($call['sessiontime']); ?>
                                            </td>
                                            <td class="py-4 px-4 text-right font-mono font-bold text-gray-900">
                                                $
                                                <?php echo number_format($call['sessionbill'], 4); ?>
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
                                Showing page
                                <?php echo $page; ?> of
                                <?php echo $totalPages; ?>
                            </div>
                            <div class="flex gap-2">
                                <?php if ($page > 1): ?>
                                    <a href="?page=<?php echo $page - 1; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&search=<?php echo urlencode($search); ?>"
                                        class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-bold hover:bg-gray-50 transition-colors">Previous</a>
                                <?php endif; ?>
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?php echo $page + 1; ?>&from_date=<?php echo $from_date; ?>&to_date=<?php echo $to_date; ?>&search=<?php echo urlencode($search); ?>"
                                        class="px-4 py-2 bg-black text-white rounded-lg text-xs font-bold hover:bg-gray-900 transition-colors shadow-lg shadow-black/10">Next</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <footer
                class="p-8 mt-auto flex justify-between items-center text-[10px] text-gray-400 font-mono border-t border-neutral-border bg-white tech-label">
                <p>
                    <?php echo APP_FOOTER_TEXT; ?>
                </p>
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