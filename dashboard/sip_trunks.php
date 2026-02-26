<?php
// dashboard/sip_trunks.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

$error = null;
$success = null;

// Handle Form Submission for Creating Trunk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_trunk'])) {
    $ip_address = filter_var($_POST['ip_address'], FILTER_SANITIZE_STRING);
    $port = filter_var($_POST['port'], FILTER_SANITIZE_NUMBER_INT);

    if (empty($ip_address)) {
        $error = "IP Address is required.";
    } else {
        $postData = [
            'clientid' => $clientId,
            'magnus_user' => $selectedMagnusUser,
            'ip_address' => $ip_address,
            'port' => $port ?: 5060
        ];

        $createResponse = api_call('switches/trunks', 'POST', $postData);
        if (isset($createResponse['status']) && $createResponse['status']) {
            $success = "Trunk created successfully!";
        } else {
            $error = $createResponse['message'] ?? "Failed to create trunk.";
        }
    }
}

// Fetch existing trunks
$trunks = [];
$apiEndpoint = 'switches/trunks?clientid=' . $clientId . '&magnus_user=' . urlencode($selectedMagnusUser);
$apiResponse = api_call($apiEndpoint);

if (isset($apiResponse['status']) && $apiResponse['status']) {
    $trunks = $apiResponse['data'] ?? [];
} else {
    $error = $error ?: ($apiResponse['message'] ?? 'Unable to load trunks.');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>My Trunks - ARDO Technology</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@500;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
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

        .status-active {
            background: #D1FAE5;
            color: #065F46;
        }
    </style>
</head>

<body class="bg-background-light text-[#050505] font-display" x-data="{ showModal: false }">
    <div class="flex h-screen overflow-hidden">
        <?php include 'sidebar.php'; ?>

        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <?php
            $pageHeaderTitle = "SIP Trunks";
            include 'header.php';
            ?>

            <div class="p-8 max-w-7xl mx-auto w-full">
                <!-- Notifications -->
                <?php if ($error): ?>
                    <div
                        class="bg-red-50 border border-red-100 text-red-600 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">error</span>
                        <?php echo htmlspecialchars($error); ?>
                    </div>
                <?php endif; ?>
                <?php if ($success): ?>
                    <div
                        class="bg-green-50 border border-green-100 text-green-600 px-4 py-3 rounded-lg mb-6 text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">check_circle</span>
                        <?php echo htmlspecialchars($success); ?>
                    </div>
                <?php endif; ?>

                <div class="glass-card p-8">
                    <div class="flex flex-col md:flex-row md:items-start justify-between gap-6 mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">My active trunks</h3>
                            <p class="text-sm text-gray-500 mt-1">Manage your SIP Trunks connections</p>
                        </div>
                        <button @click="showModal = true"
                            class="bg-black text-white px-6 py-2 h-[38px] rounded-lg text-sm font-medium hover:bg-gray-900 transition-colors shadow-lg shadow-black/10 flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-sm">add</span> Create New Trunk
                        </button>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4 pl-0">Trunk Name</th>
                                    <th class="pb-4 px-4">Host / IP</th>
                                    <th class="pb-4 px-4">Port</th>
                                    <th class="pb-4 px-4">Codecs</th>
                                    <th class="pb-4 px-4 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($trunks)): ?>
                                    <tr>
                                        <td colspan="5"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No active trunks found. Create one above.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($trunks as $trunk): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors group">
                                            <td class="py-5 px-4 pl-0">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded bg-gray-50 flex items-center justify-center text-gray-400 group-hover:bg-primary/10 group-hover:text-primary transition-colors">
                                                        <span class="material-symbols-outlined text-sm">router</span>
                                                    </div>
                                                    <span class="font-mono font-bold text-gray-900 tracking-tight">
                                                        <?php echo htmlspecialchars($trunk['name']); ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="py-5 px-4 text-sm font-mono text-gray-600">
                                                <?php echo htmlspecialchars($trunk['host']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm font-mono text-gray-600">
                                                <?php echo htmlspecialchars($trunk['port'] ?: '5060'); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600">
                                                <?php echo htmlspecialchars($trunk['allow']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-center">
                                                <span class="status-badge status-active">Active</span>
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

    <!-- Create Trunk Modal -->
    <div x-show="showModal" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true"
        style="display: none;">
        <div x-show="showModal" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-gray-900/40 backdrop-blur-sm transition-opacity"></div>
        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div x-show="showModal" @click.away="showModal = false" x-transition:enter="ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave="ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    class="relative transform overflow-hidden rounded-xl bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg border border-gray-100">
                    <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4 border-b border-gray-100">
                        <div class="sm:flex sm:items-start">
                            <div
                                class="mx-auto flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-full bg-primary/10 sm:mx-0 sm:h-10 sm:w-10">
                                <span class="material-symbols-outlined text-primary">add_link</span>
                            </div>
                            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left">
                                <h3 class="text-base font-semibold leading-6 text-gray-900" id="modal-title">Create New
                                    Trunk</h3>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500">Configure your PBX connection details. The name is
                                        auto-generated based on your account ID.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form method="POST" action="sip_trunks.php">
                        <input type="hidden" name="create_trunk" value="1">
                        <div class="px-6 py-4 space-y-4">
                            <!-- Readonly Trunk Name -->
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2">Trunk
                                    Name</label>
                                <input type="text" disabled
                                    value="C-<?php echo htmlspecialchars($selectedMagnusUser); ?>"
                                    class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-500 font-mono">
                            </div>

                            <!-- IP Address Input -->
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Client
                                    PBX IP <span class="text-red-500">*</span></label>
                                <input type="text" name="ip_address" required placeholder="e.g. 192.168.1.100"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all shadow-sm">
                            </div>

                            <!-- Port Input -->
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Port</label>
                                <input type="number" name="port" value="5060"
                                    class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm focus:ring-primary focus:border-primary transition-all shadow-sm">
                            </div>

                            <div class="grid grid-cols-2 gap-4 pt-2">
                                <!-- Codecs Readonly -->
                                <div>
                                    <label
                                        class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">Allowed
                                        Codecs</label>
                                    <div
                                        class="px-3 py-2 bg-gray-50 border border-gray-100 rounded text-xs text-gray-500 font-mono">
                                        ulaw, alaw</div>
                                </div>

                                <!-- Max Use Readonly -->
                                <div>
                                    <div class="flex items-center justify-between mb-1">
                                        <label
                                            class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider">Max
                                            Simultaneous</label>
                                        <a href="support.php"
                                            class="text-[10px] font-medium text-primary hover:text-black transition-colors hover:underline">Need
                                            more?</a>
                                    </div>
                                    <div
                                        class="px-3 py-2 bg-gray-50 border border-gray-100 rounded text-xs text-gray-500 font-mono">
                                        5 Calls</div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6 border-t border-gray-100 mt-2">
                            <button type="submit"
                                class="inline-flex w-full justify-center rounded-lg bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 sm:ml-3 sm:w-auto">Create
                                Trunk</button>
                            <button type="button" @click="showModal = false"
                                class="mt-3 inline-flex w-full justify-center rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>