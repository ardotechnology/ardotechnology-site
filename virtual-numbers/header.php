<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts: Manrope -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&display=swap" rel="stylesheet">

    <?php if (isset($seoConfig)): ?>
        <?php SeoHelper::render($seoConfig); ?>
    <?php else: ?>
        <title>Mexico Virtual Phone Numbers for US Businesses</title>
    <?php endif; ?>

    <!-- LineIcons 5.0 -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">

    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>styles.css?v=15">

    <?php if (isset($customHead))
        echo $customHead; ?>

    <!-- External Scripts (Analytics, Chat) -->
    <?php include $basePath . 'includes/external-scripts.php'; ?>
</head>

<body>
    <!-- Header -->
    <header id="header" class="<?php echo isset($headerClass) ? $headerClass : ''; ?>">
        <div class="header-container">
            <a href="<?php echo $basePath; ?>" class="logo-link">
                <img src="<?php echo $basePath; ?>images/Logo.webp" alt="Ardo Technology Logo" class="logo">
            </a>

            <div class="mobile-menu-toggle" id="mobileMenuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav id="nav">
                <!-- Mobile Logo -->
                <div class="mobile-nav-header">
                    <img src="<?php echo $basePath; ?>images/logo-white.webp" alt="Ardo Technology" class="mobile-logo">
                </div>

                <ul class="nav-menu">
                    <li><a href="#benefits">Benefits</a></li>
                    <li><a href="#cities">Mexico Cities</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#pricing">Pricing</a></li>
                    <li class="phone-number">
                        <a href="tel:+524429803200"
                            style="color: inherit; text-decoration: none; display: flex; align-items: center; gap: 6px;">
                            <i class="lni lni-phone"></i>
                            <span>+52 442 980 3200</span>
                        </a>
                    </li>
                </ul>

                    <a href="https://wa.me/524429803200" class="btn btn-primary"
                        style="padding: 8px 20px; border-radius: 50px; font-weight: 700; text-decoration: none; color: white; background-color: #25D366; border-color: #25D366;"><i class="lni lni-whatsapp" style="margin-right: 5px;"></i> Get
                        Started</a>
                </div>
            </nav>
        </div>
    </header>

    <script>
        // Use the same script logic as the main site if possible, or a compatible simple toggle
        const mobileMenuToggle = document.getElementById('mobileMenuToggle');
        const nav = document.getElementById('nav');

        if (mobileMenuToggle && nav) {
            mobileMenuToggle.addEventListener('click', function () {
                nav.classList.toggle('active');
                this.classList.toggle('active');
            });
        }
    </script>