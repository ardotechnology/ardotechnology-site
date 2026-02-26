<!-- Header -->
<?php
// Fetch Balance for Global Display
$headerBalance = '0.00';
if (isset($user['client_id'])) {
    $balResponse = api_call('switches/balance?clientid=' . $user['client_id'] . '&magnus_user=' . urlencode($selectedMagnusUser));
    if (isset($balResponse['status']) && $balResponse['status']) {
        $balStr = $balResponse['data']['formatted'] ?? '0.00';
        $headerBalance = str_replace(['$', ' ', ','], '', $balStr);
    }
}
?>
<header
    class="h-16 min-h-[64px] flex-shrink-0 border-b border-neutral-border bg-white/80 backdrop-blur-md flex items-center justify-between px-8 sticky top-0 z-10">
    <div class="flex items-center gap-2">
        <h2 class="text-lg font-bold geist-heading text-[#0c1b1d] font-black uppercase tracking-tight">
            <?php echo $pageHeaderTitle; ?>
        </h2>
        <span
            class="text-[10px] font-mono bg-gray-100 text-gray-500 px-2 py-0.5 rounded border border-gray-200/50 uppercase tracking-widest">ID:
            <?php echo htmlspecialchars($displayClientId); ?></span>
    </div>
    <div class="flex items-center gap-4">
        <!-- Global Balance Indicator -->
        <div class="flex items-center gap-2 px-3 py-1.5 rounded-md bg-gray-900 border border-gray-800 shadow-sm"
            title="Prepaid Wallet Balance">
            <span class="material-symbols-outlined text-[16px] text-gray-400">account_balance_wallet</span>
            <span
                class="text-xs font-bold text-primary font-mono tracking-wide">$<?php echo number_format((float) $headerBalance, 2); ?></span>
        </div>

        <?php if (isset($_SESSION['available_magnus_users']) && count($_SESSION['available_magnus_users']) > 1): ?>
            <div class="relative" x-data="{ openProfile: false }">
                <button @click="openProfile = !openProfile" @click.away="openProfile = false"
                    class="flex items-center gap-2 px-3 py-1.5 rounded-md border border-gray-200 bg-gray-50 hover:bg-gray-100 transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-[16px] text-gray-500">switch_account</span>
                    <span class="text-xs font-semibold text-gray-700">Account:
                        <?php echo htmlspecialchars($selectedMagnusUser); ?></span>
                    <span class="material-symbols-outlined text-[16px] text-gray-400">expand_more</span>
                </button>
                <div x-show="openProfile" x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-75"
                    x-transition:leave-start="transform opacity-100 scale-100"
                    x-transition:leave-end="transform opacity-0 scale-95"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50 origin-top-right focus:outline-none"
                    style="display: none;">
                    <div
                        class="px-4 py-2 text-[10px] tracking-wider font-bold text-gray-400 uppercase bg-gray-50/50 border-b border-gray-50 mb-1">
                        Select Profile
                    </div>
                    <?php foreach ($_SESSION['available_magnus_users'] as $mUser): ?>
                        <a href="?switch_magnus_user=<?php echo urlencode($mUser); ?>"
                            class="block px-4 py-2 text-sm <?php echo $mUser === $selectedMagnusUser ? 'bg-primary/5 text-primary font-medium' : 'text-gray-700 hover:bg-gray-50'; ?>">
                            <?php echo htmlspecialchars($mUser); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="h-6 w-[1px] bg-neutral-border mx-1"></div>
        <?php endif; ?>

        <button class="p-2 hover:bg-gray-100 rounded-full relative transition-colors">
            <span class="material-symbols-outlined text-gray-600 text-[20px]">notifications</span>
            <span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full border-2 border-white"></span>
        </button>
        <div class="h-8 w-[1px] bg-neutral-border mx-2"></div>
        <div class="relative" x-data="{ open: false }">
            <button @click="open = !open" @click.away="open = false"
                class="flex items-center gap-3 cursor-pointer group focus:outline-none">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-semibold text-gray-900 leading-none">
                        <?php echo htmlspecialchars($fullName); ?>
                    </p>
                    <p class="text-[10px] text-gray-400 mt-1 uppercase font-mono tracking-wider">
                        <?php echo htmlspecialchars($company); ?>
                    </p>
                </div>
                <div
                    class="w-9 h-9 rounded-full bg-primary/20 flex items-center justify-center border border-primary/30 overflow-hidden transition-all group-hover:border-primary/50">
                    <?php if (isset($user['profile_image']) && $user['profile_image']): ?>
                        <img class="w-full h-full object-cover"
                            src="<?php echo htmlspecialchars($user['profile_image']); ?>" />
                    <?php else: ?>
                        <span class="material-symbols-outlined text-primary">person</span>
                    <?php endif; ?>
                </div>
            </button>

            <!-- Dropdown Menu -->
            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-1 z-50 origin-top-right focus:outline-none"
                style="display: none;">

                <a href="account.php"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">person</span>
                    My Account
                </a>
                <a href="account.php"
                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">settings</span>
                    Settings
                </a>
                <div class="border-t border-gray-100 my-1"></div>
                <a href="?logout=1"
                    class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                    Logout
                </a>
            </div>
        </div>
    </div>
</header>