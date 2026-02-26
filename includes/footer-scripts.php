<?php
/**
 * Footer Scripts: Core Interactions
 */
?>

<!-- Core Scripts -->
<script>
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Header Scroll Effect
        const header = document.querySelector('.header-premium');
        if (header) {
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            });
        }

        // 2. Mobile Menu Toggle
        const mobileToggle = document.querySelector('.mobile-menu-toggle');
        const nav = document.querySelector('nav');
        if (mobileToggle && nav) {
            mobileToggle.addEventListener('click', () => {
                nav.classList.toggle('active');
                mobileToggle.classList.toggle('active');
                document.body.style.overflow = nav.classList.contains('active') ? 'hidden' : '';
            });
        }

        // 2b. Mobile Submenu Toggle (Mega Menu items)
        const megaLinks = document.querySelectorAll('.nav-menu li.has-mega > a');
        megaLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                if (window.innerWidth <= 1024) {
                    e.preventDefault();
                    e.stopPropagation();
                    const parentLi = this.parentElement;
                    const wasOpen = parentLi.classList.contains('mm-open');
                    
                    // Close all mega menus first
                    document.querySelectorAll('.nav-menu li.has-mega').forEach(li => {
                        li.classList.remove('mm-open');
                    });
                    
                    // If it wasn't open, open it
                    if (!wasOpen) {
                        parentLi.classList.add('mm-open');
                    }
                }
            });
        });

        // 3. Telco Section Interactions (if applicable)
        const telcoGrid = document.getElementById('telcoGrid');
        const expandBtns = document.querySelectorAll('.btn-expand');
        if (telcoGrid && expandBtns.length > 0) {
            expandBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const isExpanded = telcoGrid.classList.toggle('all-expanded');
                    const allIcons = document.querySelectorAll('.icon-circle i');
                    const allTexts = document.querySelectorAll('.expand-text');

                    allIcons.forEach(icon => {
                        icon.className = isExpanded ? 'lni lni-minus' : 'lni lni-plus';
                    });

                    allTexts.forEach(text => {
                        text.innerText = isExpanded ? 'Ver Menos' : 'Ver Más';
                    });
                });
            });
        }
    });
</script>

<!-- Live Chat & Analytics -->
<script src="https://74686.usw.ycmcloud.com/live_chat.v1.0.0.js?channelNumber=LC00000"></script>