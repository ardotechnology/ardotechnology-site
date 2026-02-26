<?php
// dashboard/numbers.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// Common user variables ($fullName, $company, $clientId, $displayClientId) are globally available from auth.php

// Pagination & Filtering
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$limit = 20;
$search = $_GET['search'] ?? '';

// Fetch Numbers from CRM API (indirectly from Magnus)
$apiResponse = api_call('switches/dids?clientid=' . $clientId . '&magnus_user=' . urlencode($selectedMagnusUser) . '&page=' . $page . '&limit=' . $limit . '&search=' . urlencode($search));

$numbers = [];
$totalNumbers = 0;
$totalPages = 0;

if (isset($apiResponse['status']) && $apiResponse['status']) {
    $numbers = $apiResponse['data']['rows'] ?? [];
    $totalNumbers = $apiResponse['data']['total'] ?? 0;
    $totalPages = ceil($totalNumbers / $limit);
} else {
    $error = $apiResponse['message'] ?? 'Unable to load numbers.';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>My Numbers - ARDO Technology</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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

        .status-active {
            background: #D1FAE5;
            color: #065F46;
        }

        .status-inactive {
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
            $pageHeaderTitle = "Assigned Numbers";
            include 'header.php';
            ?>

            <div class="p-8 max-w-7xl mx-auto w-full">
                <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Virtual Numbers</h3>
                            <p class="text-sm text-gray-500 mt-1">Manage your active DID inventory</p>
                        </div>
                        <form method="GET" class="flex gap-4">
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">search</span>
                                <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                                    placeholder="Search DIDs..."
                                    class="pl-10 pr-4 py-2 bg-gray-50 border border-gray-100 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all w-64"
                                    style="border-radius: 8px;">
                            </div>
                            <button type="submit"
                                class="bg-black text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-900 transition-colors">Filter</button>
                        </form>
                    </div>

                    <?php if (isset($error)): ?>
                        <div
                            class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px]">error</span>
                            <?php echo htmlspecialchars($error); ?>
                        </div>
                    <?php endif; ?>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4">DID Number</th>
                                    <th class="pb-4 px-4 text-center">Status</th>
                                    <th class="pb-4 px-4">Destination</th>
                                    <th class="pb-4 px-4">Plan</th>
                                    <th class="pb-4 px-4 text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($numbers)): ?>
                                    <tr>
                                        <td colspan="5"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No numbers found for this account
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($numbers as $did): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                            <td class="py-5 px-4">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined text-sm">tag</span>
                                                    </div>
                                                    <span class="font-mono font-bold text-gray-900 tracking-tight">
                                                        <?php echo htmlspecialchars($did['did']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-center">
                                                <span
                                                    class="status-badge <?php echo ($did['active'] ?? 1) ? 'status-active' : 'status-inactive'; ?>">
                                                    <?php echo ($did['active'] ?? 1) ? 'Active' : 'Inactive'; ?>
                                                </span>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($did['destination'] ?? 'Not set'); ?>
                                                    </span>
                                                    <span class="text-[10px] uppercase font-mono text-gray-400">Route</span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-500">
                                                <?php echo htmlspecialchars($did['idPlanname'] ?? 'Standard'); ?>
                                            </td>
                                            <td class="py-5 px-4 text-right font-mono font-bold text-gray-900">
                                                $
                                                <?php echo number_format((float) ($did['billing_amount'] ?? 0), 2); ?>
                                                <span class="text-[10px] text-gray-400 font-normal ml-1">/ mo</span>
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
                                    <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>"
                                        class="px-4 py-2 border border-gray-200 rounded-lg text-xs font-bold hover:bg-gray-50 transition-colors flex items-center gap-2">
                                        <span class="material-symbols-outlined text-sm">chevron_left</span> Previous
                                    </a>
                                <?php endif; ?>
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>"
                                        class="px-4 py-2 bg-black text-white rounded-lg text-xs font-bold hover:bg-gray-900 transition-colors flex items-center gap-2 shadow-lg shadow-black/10">
                                        Next <span class="material-symbols-outlined text-sm">chevron_right</span>
                                    </a>
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