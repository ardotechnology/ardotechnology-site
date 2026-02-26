<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-64 flex-shrink-0 border-r border-neutral-border bg-white flex flex-col">
    <div class="p-6 flex items-center">
        <img src="../images/logo.svg" alt="Ardo Logo" class="h-10 w-auto">
    </div>
    <nav class="flex-1 px-4 py-4 space-y-1">
        <!-- Dashboard -->
        <a href="index.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'index.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">grid_view</span>
            <p class="text-sm font-bold <?php echo $current_page == 'index.php' ? 'font-black' : ''; ?>">Dashboard
            </p>
        </a>

        <!-- PBX Cloud -->
        <a href="infrastructure.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'infrastructure.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">settings_input_component</span>
            <p class="text-sm font-bold <?php echo $current_page == 'infrastructure.php' ? 'font-black' : ''; ?>">
                PBX Cloud</p>
        </a>





        <!-- Trunks -->
        <a href="sip_trunks.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'sip_trunks.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">router</span>
            <p class="text-sm font-bold <?php echo $current_page == 'sip_trunks.php' ? 'font-black' : ''; ?>">My Trunks
            </p>
        </a>

        <!-- Numbers Accordion -->
        <div
            x-data="{ open: <?php echo in_array($current_page, ['numbers.php', 'buy_numbers.php']) ? 'true' : 'false'; ?> }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-3 py-2.5 rounded-lg <?php echo in_array($current_page, ['numbers.php', 'buy_numbers.php']) ? 'bg-primary/5 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
                style="border-radius: 8px;">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-[20px]">tag</span>
                    <p
                        class="text-sm font-bold <?php echo in_array($current_page, ['numbers.php', 'buy_numbers.php']) ? 'font-black' : ''; ?>">
                        Numbers</p>
                </div>
                <span class="material-symbols-outlined text-[18px] transition-transform duration-200"
                    :class="open ? 'rotate-180' : ''">expand_more</span>
            </button>
            <div x-show="open" x-cloak class="pl-9 pr-3 py-1 space-y-1 mt-1">
                <a href="numbers.php"
                    class="block py-2 text-sm <?php echo $current_page == 'numbers.php' ? 'text-primary font-bold' : 'text-gray-600 hover:text-black hover:bg-gray-50'; ?> rounded-md px-3 border-l-2 <?php echo $current_page == 'numbers.php' ? 'border-primary' : 'border-transparent hover:border-gray-300'; ?> transition-colors">My
                    Numbers</a>
                <a href="buy_numbers.php"
                    class="block py-2 text-sm <?php echo $current_page == 'buy_numbers.php' ? 'text-primary font-bold' : 'text-gray-600 hover:text-black hover:bg-gray-50'; ?> rounded-md px-3 border-l-2 <?php echo $current_page == 'buy_numbers.php' ? 'border-primary' : 'border-transparent hover:border-gray-300'; ?> transition-colors">Buy
                    Numbers</a>
            </div>
        </div>

        <!-- Reports -->
        <a href="reports.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'reports.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">bar_chart</span>
            <p class="text-sm font-bold <?php echo $current_page == 'reports.php' ? 'font-black' : ''; ?>">Reports</p>
        </a>

        <!-- Invoices -->
        <a href="invoices.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'invoices.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">description</span>
            <p class="text-sm font-bold <?php echo $current_page == 'invoices.php' ? 'font-black' : ''; ?>">
                Invoices</p>
        </a>

        <!-- Support -->
        <a href="support.php"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?php echo $current_page == 'support.php' ? 'bg-primary/10 text-black' : 'text-black hover:bg-gray-50 transition-colors cursor-pointer'; ?>"
            style="border-radius: 8px;">
            <span class="material-symbols-outlined text-[20px]">help_outline</span>
            <p class="text-sm font-bold <?php echo $current_page == 'support.php' ? 'font-black' : ''; ?>">Support
            </p>
        </a>
    </nav>

    <!-- Support / WhatsApp -->
    <div class="p-4 mt-auto border-t border-gray-100">
        <a href="https://wa.me/524429803200" target="_blank"
            class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-[#25D366]/10 text-[#075E54] hover:bg-[#25D366]/20 transition-colors border border-[#25D366]/30 cursor-pointer"
            style="border-radius: 8px;">
            <svg class="w-5 h-5 text-[#25D366]" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.878-.788-1.47-1.761-1.643-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
            </svg>
            <p class="text-sm font-bold">¿Necesitas algo?</p>
        </a>
    </div>

</aside>