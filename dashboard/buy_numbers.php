<?php
// dashboard/buy_numbers.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// Search Parameters
$country = $_GET['country'] ?? '52'; // Default MX
$lada = $_GET['lada'] ?? '';
$city = $_GET['city'] ?? '';

$availableNumbers = [];
$error = null;

// Only fetch if a search was initiated
if (isset($_GET['search_submitted']) || !empty($lada) || !empty($city)) {
    // Append the selected profile parameter
    $apiEndpoint = 'switches/available_dids?clientid=' . $clientId . '&country=' . urlencode($country) . '&lada=' . urlencode($lada) . '&city=' . urlencode($city);

    $apiResponse = api_call($apiEndpoint);

    if (isset($apiResponse['status']) && $apiResponse['status']) {
        $availableNumbers = $apiResponse['data'] ?? [];
    } else {
        $error = $apiResponse['message'] ?? 'Unable to load available numbers.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Buy Numbers - ARDO Technology</title>
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
            border-radius: 8px;
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

        .status-available {
            background: #E0F2FE;
            color: #0369A1;
        }
    </style>
</head>

<body class="bg-background-light text-[#050505] font-display">
    <div class="flex h-screen overflow-hidden">
        <?php include 'sidebar.php'; ?>

        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <?php
            $pageHeaderTitle = "Buy Numbers";
            include 'header.php';
            ?>

            <div class="p-8 max-w-7xl mx-auto w-full">
                <div class="glass-card p-8">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Search DIDs</h3>
                            <p class="text-sm text-gray-500 mt-1">Find and provision new numbers for your account</p>
                        </div>
                    </div>

                    <form method="GET"
                        class="border border-gray-100 rounded-lg p-6 bg-gray-50/50 mb-8 flex flex-wrap gap-4 items-end">
                        <input type="hidden" name="search_submitted" value="1">

                        <div class="w-full md:w-auto flex-1 min-w-[150px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Country
                                Code</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">public</span>
                                <input type="text" name="country" value="<?php echo htmlspecialchars($country); ?>"
                                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="w-full md:w-auto flex-1 min-w-[150px]">
                            <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Area Code
                                (Lada)</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">dialpad</span>
                                <input type="text" name="lada" value="<?php echo htmlspecialchars($lada); ?>"
                                    placeholder="E.g. 442"
                                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all shadow-sm">
                            </div>
                        </div>

                        <div class="w-full md:w-auto flex-1 min-w-[150px]">
                            <label
                                class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">City</label>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-gray-400 text-sm">location_city</span>
                                <input type="text" name="city" value="<?php echo htmlspecialchars($city); ?>"
                                    placeholder="E.g. Queretaro"
                                    class="w-full pl-10 pr-4 py-2 bg-white border border-gray-200 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all shadow-sm">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full md:w-auto bg-black text-white px-6 py-2 h-[38px] rounded-lg text-sm font-medium hover:bg-gray-900 transition-colors shadow-lg shadow-black/10 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">search</span> Search
                        </button>
                    </form>

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
                                    <th class="pb-4 px-4 pl-0">DID Number</th>
                                    <th class="pb-4 px-4">Location</th>
                                    <th class="pb-4 px-4 text-center">Status</th>
                                    <th class="pb-4 px-4 text-right">Setup Fee</th>
                                    <th class="pb-4 px-4 text-right">Monthly</th>
                                    <th class="pb-4 px-4 pr-0"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (!isset($_GET['search_submitted']) && empty($lada) && empty($city)): ?>
                                    <tr>
                                        <td colspan="6"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            Enter search criteria above to find available numbers
                                        </td>
                                    </tr>
                                <?php elseif (empty($availableNumbers)): ?>
                                    <tr>
                                        <td colspan="6"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No available numbers found matching your criteria
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($availableNumbers as $did): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                            <td class="py-5 px-4 pl-0">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined text-sm">add_call</span>
                                                    </div>
                                                    <span class="font-mono font-bold text-gray-900 tracking-tight">
                                                        <?php echo htmlspecialchars($did['did']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600">
                                                <div class="flex flex-col">
                                                    <span class="font-medium text-gray-900">
                                                        <?php echo htmlspecialchars($did['city']); ?>
                                                    </span>
                                                    <span class="text-[10px] uppercase font-mono text-gray-400">Country:
                                                        <?php echo htmlspecialchars($did['country']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-center">
                                                <span class="status-badge status-available">Available</span>
                                            </td>
                                            <td class="py-5 px-4 text-right font-mono font-bold text-gray-900">
                                                $
                                                <?php echo number_format((float) ($did['connection_charge'] ?? 0), 2); ?>
                                            </td>
                                            <td class="py-5 px-4 text-right font-mono font-bold text-gray-900">
                                                $
                                                <?php echo number_format((float) ($did['fixrate'] ?? 0), 2); ?>
                                                <span class="text-[10px] text-gray-400 font-normal ml-1">/ mo</span>
                                            </td>
                                            <td class="py-5 px-4 pr-0 flex justify-end">
                                                <!-- Action button for future integration -->
                                                <button
                                                    class="px-4 py-2 bg-primary/10 text-primary font-bold rounded-lg text-xs hover:bg-primary hover:text-black transition-colors flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-[16px]">shopping_cart</span> Buy
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <footer
                class="p-8 mt-auto flex justify-between items-center text-[10px] text-gray-400 font-mono border-t border-neutral-border bg-white tech-label">
                <p>
                    <?php echo APP_FOOTER_TEXT ?? '© ' . date('Y') . ' ARDO Technology'; ?>
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