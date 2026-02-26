<?php
// dashboard/infrastructure.php
require_once 'auth.php';
require_login();

// Handle Logout
if (isset($_GET['logout'])) {
    portal_logout();
}

// User data
$fullName = $user['firstname'] . ' ' . $user['lastname'];
$company = $user['company_name'];
$clientId = "ARDO-" . str_pad($user['client_id'], 4, '0', STR_PAD_LEFT);

// Handle Droplet Creation and API Calls
$message = '';
$error = '';


// Fetch Options
$options = api_call('infrastructure/options');
if (isset($options['status']) && $options['status']) {
    $os_images = $options['data']['os_images'] ?? [];
    $app_images = $options['data']['app_images'] ?? [];


    $regions = $options['data']['regions'] ?? [];
    $sizes = $options['data']['sizes'] ?? [];
} else {
    $os_images = [];
    $app_images = [];
    $regions = [];
    $sizes = [];
    $error = "Failed to load options from API.";
}


// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_droplet') {
    $data = [
        'name' => $_POST['hostname'],
        'region' => $_POST['region'],
        'size' => $_POST['size'],
        'image' => $_POST['image'],
        'clientid' => $user['client_id'], // Pass client ID for mapping
        'ssh_keys' => [], // Implement Key selection later
        'user_data' => null
    ];

    $response = api_call('infrastructure/droplet', 'POST', $data);

    if (isset($response['status']) && $response['status']) {
        $message = "Droplet '" . htmlspecialchars($response['data']['name']) . "' created successfully!";
    } else {
        $error = "Failed to create droplet: " . ($response['message'] ?? 'Unknown error');
    }
}


// Fetch User's Droplets
$my_droplets_response = api_call('infrastructure/list?clientid=' . $user['client_id']);
$my_droplets = ($my_droplets_response['status'] ?? false) ? $my_droplets_response['data'] : [];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Infrastructure - ARDO Technology</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&amp;family=JetBrains+Mono:wght@500;700&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

        [x-cloak] {
            display: none !important;
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
    </style>
    <script>
        function dropletWizard() {
            return {
                showWizard: false,
                currentStep: 1,
                imageTab: 'app',

                osImages: <?php echo json_encode($os_images); ?>,
                appImages: [
                    { slug: 'aplitel-vitalpbx-7', name: 'VitalPBX', min_disk_size: 20 },
                    { slug: 'simontelephonics-freepbx-7-8', name: 'FreePBX', min_disk_size: 20 },
                    { slug: '3cxcommunication-3cx', name: '3CX', min_disk_size: 20 },
                    { slug: 'ringq', name: 'RingQ', min_disk_size: 20 },
                    { slug: 'yeastar-yeastarpseriesph', name: 'Yeastar', min_disk_size: 20 },
                    { slug: 'vodianetworks-vodiapbxprepaido', name: 'Vodia', min_disk_size: 20 }
                ],
                regions: <?php echo json_encode($regions); ?>,
                sizes: <?php echo json_encode($sizes); ?>,

                selectedImage: '',
                selectedRegion: '',
                selectedSize: '',
                groupedDistros: [],

                init() {
                    const groups = {};
                    this.osImages.forEach(img => {
                        const dist = img.distribution || 'Other';
                        if (!groups[dist]) {
                            groups[dist] = { name: dist, versions: [] };
                        }
                        groups[dist].versions.push(img);
                    });
                    this.groupedDistros = Object.values(groups);

                    // Watchers to maintain validity
                    this.$watch('selectedImage', () => this.checkSizeValidity());
                    this.$watch('selectedRegion', () => this.checkSizeValidity());
                },

                checkSizeValidity() {
                    if (!this.selectedSize) return;
                    const valid = this.filteredSizes.some(s => s.slug === this.selectedSize);
                    if (!valid) this.selectedSize = '';
                },

                get filteredSizes() {
                    let eligible = this.sizes;

                    // 1. Filter by Region availability
                    if (this.selectedRegion) {
                        const region = this.regions.find(r => r.slug === this.selectedRegion);
                        if (region && region.sizes) {
                            eligible = eligible.filter(s => region.sizes.includes(s.slug));
                        }
                    }

                    // 2. Filter by Image Minimum Disk Size
                    if (this.selectedImage) {
                        let img = this.osImages.find(i => i.slug === this.selectedImage);
                        if (!img) {
                            img = this.appImages.find(i => i.slug === this.selectedImage);
                        }
                        if (img && img.min_disk_size) {
                            eligible = eligible.filter(s => s.disk >= img.min_disk_size);
                        }
                    }

                    return eligible;
                },

                getAppLogo(appName) {
                    const name = appName.toLowerCase();
                    if (name.includes('vitalpbx')) return '../images/vitalpbx-logo-white-variant.png';
                    if (name.includes('freepbx')) return '../images/Sangoma_FreePBX_Logo_RGB_hori-pos-e1588854523908.png';
                    if (name.includes('issabel')) return '../images/65698eb840bd54b62e90e1d2_logo2 (1).svg';
                    if (name.includes('3cx')) return '../images/3CX-Logo.wine_.png';
                    if (name.includes('ringq')) return '../images/ringQ-logo-blue.png';
                    if (name.includes('yeastar')) return '../images/yeastar-logo.svg';
                    if (name.includes('vodia')) return '../images/vodia.svg';
                    return null;
                },

                startDeploy(imageSlug) {
                    this.showWizard = true;
                    this.imageTab = 'app';
                    this.selectedImage = imageSlug;
                    this.currentStep = 2; // Jump immediately to Region/Size steps
                },

                resetDeploy() {
                    this.showWizard = true;
                    this.imageTab = 'app';
                    this.selectedImage = '';
                    this.currentStep = 1;
                },

                validateStep() {
                    if (this.currentStep === 1) {
                        if (!this.selectedImage) { alert('Please select an image'); return false; }
                    }
                    if (this.currentStep === 2) {
                        if (!this.selectedRegion) { alert('Please select a region'); return false; }
                    }
                    if (this.currentStep === 3) {
                        if (!this.selectedSize) { alert('Please select a size plan'); return false; }
                    }
                    return true;
                }
            }
        }
    </script>
</head>

<body class="bg-background-light text-[#050505] font-display">
    <div class="flex h-screen overflow-hidden" x-data="dropletWizard()">
        <!-- Sidebar and Nav (Copied from support.php) -->
        <?php include 'sidebar.php'; ?>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-y-auto bg-gray-50/30">
            <!-- Header -->
            <?php
            $pageHeaderTitle = "Infrastructure";
            include 'header.php';
            ?>

            <!-- Inner Content Frame -->
            <div class="p-8 max-w-7xl mx-auto w-full">

                <!-- Easy VoIP Launch Header -->
                <div class="mb-8">
                    <div class="flex justify-between items-start">
                        <div class="max-w-3xl">
                            <h2 class="text-2xl font-bold geist-heading mb-2">Easy VoIP Launch</h2>
                            <p class="text-gray-600">
                                We make it easy to launch instances with market-leading VoIP brands.
                                Deploy dedicated resources in seconds, fully optimized for your communication needs.
                            </p>
                        </div>
                        <button @click="resetDeploy()"
                            class="bg-[#050505] text-white px-5 py-2.5 rounded-lg text-sm font-medium hover:bg-gray-900 transition-all shadow-lg hover:shadow-xl flex items-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">add_circle</span>
                            <span>Deploy New Instance</span>
                        </button>
                    </div>
                </div>

                <!-- Brand Logos Grid -->
                <div class="mb-10">
                    <h3 class="text-xs font-semibold text-gray-400 uppercase tracking-widest font-mono mb-4">Supported
                        Platforms</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                        <!-- VitalPBX -->
                        <div @click="startDeploy('aplitel-vitalpbx-7')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all group">
                            <img src="../images/vitalpbx-logo-white-variant.png" alt="VitalPBX"
                                class="max-h-10 w-auto object-contain filter invert opacity-80 group-hover:opacity-100 transition-opacity">
                        </div>
                        <!-- FreePBX -->
                        <div @click="startDeploy('simontelephonics-freepbx-7-8')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all">
                            <img src="../images/Sangoma_FreePBX_Logo_RGB_hori-pos-e1588854523908.png" alt="FreePBX"
                                class="max-h-12 w-auto object-contain">
                        </div>
                        <!-- 3CX -->
                        <div @click="startDeploy('3cxcommunication-3cx')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all">
                            <img src="../images/3CX-Logo.wine_.png" alt="3CX" class="max-h-14 w-auto object-contain">
                        </div>
                        <!-- RingQ -->
                        <div @click="startDeploy('ringq')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all">
                            <img src="../images/ringQ-logo-blue.png" alt="RingQ" class="max-h-10 w-auto object-contain">
                        </div>
                        <!-- Yeastar -->
                        <div @click="startDeploy('yeastar-yeastarpseriesph')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all">
                            <img src="../images/yeastar-logo.svg" alt="Yeastar" class="max-h-9 w-auto object-contain">
                        </div>
                        <!-- Vodia -->
                        <div @click="startDeploy('vodianetworks-vodiapbxprepaido')"
                            class="cursor-pointer bg-white border boundary-gray-200 rounded-xl p-4 flex items-center justify-center h-24 shadow-sm hover:shadow-md hover:border-primary transition-all">
                            <img src="../images/vodia.svg" alt="Vodia" class="max-h-9 w-auto object-contain">
                        </div>
                    </div>
                </div>

                <!-- Messages -->
                <?php if ($message): ?>
                    <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded relative mb-6"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline"><?php echo $message; ?></span>
                    </div>
                <?php endif; ?>
                <?php if ($error): ?>
                    <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline"><?php echo $error; ?></span>
                    </div>
                <?php endif; ?>

                <!-- Droplets List -->
                <div class="glass-card rounded-lg p-8" style="border-radius: 8px;">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h3 class="text-xl font-bold geist-heading font-black">Active Instances</h3>
                            <p class="text-sm text-gray-500 mt-1">Manage your deployed resources</p>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead
                                class="border-b border-gray-100 text-gray-400 text-[10px] uppercase font-mono tracking-widest">
                                <tr>
                                    <th class="pb-4 px-4">Name</th>
                                    <th class="pb-4 px-4">IP Address</th>
                                    <th class="pb-4 px-4">Region</th>
                                    <th class="pb-4 px-4">Size</th>
                                    <th class="pb-4 px-4">Image</th>
                                    <th class="pb-4 px-4">Status</th>
                                    <th class="pb-4 px-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                <?php if (empty($my_droplets)): ?>
                                    <tr>
                                        <td colspan="7"
                                            class="py-20 text-center text-gray-400 font-mono text-xs uppercase tracking-widest">
                                            No active instances found
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($my_droplets as $droplet): ?>
                                        <tr class="hover:bg-gray-50/50 transition-colors">
                                            <td class="py-5 px-4 font-bold text-gray-900">
                                                <?php echo htmlspecialchars($droplet['name']); ?>
                                            </td>
                                            <td class="py-5 px-4 font-mono text-sm text-gray-600">
                                                <?php echo htmlspecialchars($droplet['ip_address'] ?? 'Pending'); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600 uppercase">
                                                <?php echo htmlspecialchars($droplet['region']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600 uppercase">
                                                <?php echo htmlspecialchars($droplet['size_slug']); ?>
                                            </td>
                                            <td class="py-5 px-4 text-sm text-gray-600">
                                                <?php echo htmlspecialchars($droplet['image_slug']); ?>
                                            </td>
                                            <td class="py-5 px-4">
                                                <span
                                                    class="status-badge <?php echo ($droplet['status'] === 'active') ? 'status-2' : 'status-5'; ?>">
                                                    <?php echo htmlspecialchars($droplet['status']); ?>
                                                </span>
                                            </td>
                                            <td class="py-5 px-4 text-right">
                                                <button class="text-gray-400 hover:text-gray-600 transition-colors">
                                                    <span class="material-symbols-outlined text-[20px]">more_vert</span>
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

            <!-- Footer (Copied from support.php) -->
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


        <!-- Creation Wizard Modal (Keep logic but match style) -->
        <div x-show="showWizard"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm" x-cloak>
            <div class="bg-white rounded-xl shadow-2xl w-full max-w-4xl max-h-[90vh] overflow-y-auto"
                @click.away="showWizard = false">
                <!-- Header -->
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h3 class="text-xl font-bold geist-heading">Deploy New Instance</h3>
                        <p class="text-sm text-gray-500 mt-1">Configure your cloud resource</p>
                    </div>
                    <button @click="showWizard = false" class="text-gray-400 hover:text-gray-600 transition-colors">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div class="p-8">
                    <!-- Steps Indicator -->
                    <div class="flex items-center justify-between mb-8 relative">
                        <div class="absolute left-0 top-1/2 -translate-y-1/2 w-full h-0.5 bg-gray-100 -z-10"></div>
                        <template x-for="(label, index) in ['Image', 'Region', 'Size', 'Finalize']">
                            <div class="flex flex-col items-center gap-2 bg-white px-2">
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-sm font-bold transition-colors"
                                    :class="currentStep > index + 1 ? 'bg-green-100 text-green-600' : (currentStep === index + 1 ? 'bg-black text-white' : 'bg-gray-100 text-gray-400')">
                                    <template x-if="currentStep > index + 1">
                                        <span class="material-symbols-outlined text-sm">check</span>
                                    </template>
                                    <template x-if="currentStep <= index + 1">
                                        <span x-text="index + 1"></span>
                                    </template>
                                </div>
                                <span class="text-xs font-medium uppercase tracking-wider"
                                    :class="currentStep === index + 1 ? 'text-gray-900' : 'text-gray-400'"
                                    x-text="label"></span>
                            </div>
                        </template>
                    </div>

                    <form method="POST" action="">
                        <input type="hidden" name="action" value="create_droplet">

                        <!-- Step 1: Image -->
                        <div x-show="currentStep === 1">
                            <div class="mb-6 flex gap-4 border-b border-gray-100">
                                <button type="button" class="pb-2 text-sm font-medium border-b-2 transition-colors px-4"
                                    :class="imageTab === 'app' ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    @click="imageTab = 'app'">PBX Platforms</button>
                                <button type="button" class="pb-2 text-sm font-medium border-b-2 transition-colors px-4"
                                    :class="imageTab === 'distro' ? 'border-primary text-gray-900' : 'border-transparent text-gray-500 hover:text-gray-700'"
                                    @click="imageTab = 'distro'">OS Distributions</button>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 gap-4 max-h-[400px] overflow-y-auto">
                                <template x-if="imageTab === 'app'">
                                    <template x-for="img in appImages" :key="img.slug">
                                        <label class="cursor-pointer group">
                                            <input type="radio" name="image" :value="img.slug" x-model="selectedImage"
                                                class="peer sr-only">
                                            <div
                                                class="border border-gray-200 rounded-lg p-4 hover:border-primary peer-checked:border-primary peer-checked:bg-primary/5 transition-all text-center h-full flex flex-col items-center justify-center">

                                                <template x-if="getAppLogo(img.name)">
                                                    <img :src="getAppLogo(img.name)" :alt="img.name"
                                                        class="h-10 w-auto mb-3 object-contain transition-all drop-shadow-sm">
                                                </template>

                                                <template x-if="!getAppLogo(img.name)">
                                                    <div
                                                        class="w-10 h-10 bg-gray-100 rounded-full mx-auto mb-3 flex items-center justify-center text-lg font-bold text-gray-600 group-hover:bg-white group-hover:shadow-sm">
                                                        <span class="material-symbols-outlined">apps</span>
                                                    </div>
                                                </template>

                                                <span class="block font-medium text-sm text-gray-900"
                                                    x-text="img.name"></span>
                                            </div>
                                        </label>
                                    </template>
                                </template>
                                <template x-if="imageTab === 'distro'">
                                    <template x-for="distro in groupedDistros" :key="distro.name">
                                        <div class="border rounded-lg p-4 transition-all h-full"
                                            :class="distro.versions.some(v => v.slug === selectedImage) ? 'border-primary bg-primary/5' : 'border-gray-200 hover:border-primary'">

                                            <div
                                                class="w-10 h-10 bg-gray-100 rounded-full mx-auto mb-3 flex items-center justify-center text-lg font-bold text-gray-600">
                                                <span x-text="distro.name.substring(0,2)"></span>
                                            </div>

                                            <span class="block font-medium text-sm text-gray-900 text-center mb-3"
                                                x-text="distro.name"></span>

                                            <select x-model="selectedImage"
                                                class="w-full text-xs border-gray-200 rounded focus:border-primary focus:ring-primary">
                                                <option value="" disabled selected>Select Version</option>
                                                <template x-for="ver in distro.versions" :key="ver.slug">
                                                    <option :value="ver.slug" x-text="ver.name"></option>
                                                </template>
                                            </select>
                                        </div>
                                    </template>
                                </template>
                            </div>
                        </div>

                        <!-- Step 2: Region -->
                        <div x-show="currentStep === 2">
                            <h4 class="text-sm font-bold uppercase tracking-wide mb-4">Select Region</h4>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                <template x-for="region in regions" :key="region.slug">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="region" :value="region.slug" x-model="selectedRegion"
                                            class="peer sr-only">
                                        <div
                                            class="border border-gray-200 rounded-lg p-4 hover:border-primary peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                            <span class="block font-bold text-gray-900" x-text="region.name"></span>
                                            <span class="block text-xs text-gray-500" x-text="region.slug"></span>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Step 3: Size -->
                        <div x-show="currentStep === 3">
                            <h4 class="text-sm font-bold uppercase tracking-wide mb-4">Select Resources</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <template x-for="size in filteredSizes" :key="size.slug">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="size" :value="size.slug" x-model="selectedSize"
                                            class="peer sr-only">
                                        <div
                                            class="border border-gray-200 rounded-lg p-6 hover:border-primary peer-checked:border-primary peer-checked:bg-primary/5 transition-all">
                                            <div class="flex justify-between items-start mb-4">
                                                <span class="font-mono text-xs bg-gray-100 px-2 py-1 rounded"
                                                    x-text="size.slug"></span>
                                                <span class="font-bold text-lg"
                                                    x-text="'$' + parseFloat(size.price_monthly).toFixed(2) + '/mo'"></span>
                                            </div>
                                            <ul class="space-y-2 text-sm text-gray-600">
                                                <li class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-[16px]">memory</span>
                                                    <span x-text="size.vcpus + ' vCPUs'"></span>
                                                </li>
                                                <li class="flex items-center gap-2">
                                                    <span class="material-symbols-outlined text-[16px]">database</span>
                                                    <span x-text="size.memory + ' MB Memory'"></span>
                                                </li>
                                                <li class="flex items-center gap-2">
                                                    <span
                                                        class="material-symbols-outlined text-[16px]">hard_drive</span>
                                                    <span x-text="size.disk + ' GB SSD'"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </label>
                                </template>
                            </div>
                        </div>

                        <!-- Step 4: Finalize -->
                        <div x-show="currentStep === 4">
                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <h4 class="text-sm font-bold uppercase tracking-wide mb-4 text-gray-500">Summary</h4>
                                <dl class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <dt class="text-gray-500">Image</dt>
                                        <dd class="font-medium text-gray-900" x-text="selectedImage"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500">Region</dt>
                                        <dd class="font-medium text-gray-900" x-text="selectedRegion"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500">Size</dt>
                                        <dd class="font-medium text-gray-900" x-text="selectedSize"></dd>
                                    </div>
                                </dl>
                            </div>

                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-900 uppercase tracking-wide mb-2">Hostname</label>
                                <input type="text" name="hostname" required
                                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all font-mono text-sm"
                                    placeholder="e.g. web-server-01">
                                <p class="mt-2 text-xs text-gray-500">Give your droplet a unique name to identify it
                                    easily.</p>
                            </div>
                        </div>


                        <!-- Footer Actions -->
                        <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                            <button type="button" x-show="currentStep > 1" @click="currentStep--"
                                class="px-5 py-2.5 text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                                Back
                            </button>
                            <div class="flex-1"></div> <!-- Spacer -->
                            <button type="button" x-show="currentStep < 4" @click="if(validateStep()) currentStep++"
                                class="px-5 py-2.5 text-sm font-medium text-white bg-black hover:bg-gray-900 rounded-lg transition-all shadow-lg">
                                Next Step
                            </button>
                            <button type="submit" x-show="currentStep === 4"
                                class="px-5 py-2.5 text-sm font-bold text-black bg-primary hover:bg-cyan-400 rounded-lg transition-all shadow-lg hover:shadow-cyan-400/50">
                                Launch Droplet
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</body>

</html>