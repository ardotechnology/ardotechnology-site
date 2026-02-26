<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Design System CSS (Relative Path) -->
    <link rel="stylesheet" href="<?php echo $basePath; ?>css/design_system.css?v=<?php echo time(); ?>">

    <!-- LineIcons 5.0 -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">

    <?php if (isset($seoConfig)): ?>
        <?php SeoHelper::render($seoConfig); ?>
    <?php else: ?>
        <title><?php echo isset($pageTitle) ? $pageTitle : 'Telefonía VOIP y Conmutadores Virtuales | ARDO Technology'; ?>
        </title>
        <meta name="description"
            content="<?php echo isset($pageDescription) ? $pageDescription : 'Infraestructura de comunicación crítica para empresas. Soluciones de VoIP y Cloud PBX con estándares globales.'; ?>">
    <?php endif; ?>

    <style>
        /* CRITICAL BASE STYLES */
        :root {
            --ardo-primary: #00F0FF;
            --ardo-midnight: #050505;
            --ardo-deep-blue: #0A192F;
            --ardo-border: #E2E8F0;
            --font-display: 'Inter', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
        }

        body {
            font-family: var(--font-display);
            margin: 0;
            color: #050505;
            background: #fff;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
            box-sizing: border-box;
        }

        header {
            background: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--ardo-border);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
        }

        .nav-menu {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-menu a {
            text-decoration: none;
            color: rgba(10, 25, 47, 0.6);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-family: var(--font-mono);
            transition: color 0.2s;
        }

        .nav-menu a:hover {
            color: var(--ardo-midnight);
        }

        .header-auth-links {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-auth-links .btn-login {
            text-decoration: none;
            color: var(--ardo-midnight);
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            font-family: var(--font-mono);
            transition: opacity 0.2s;
        }

        .header-auth-links .btn-login:hover {
            opacity: 0.7;
        }

        .btn-register {
            background: var(--ardo-primary);
            color: var(--ardo-midnight);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            text-decoration: none;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            font-family: var(--font-mono);
            letter-spacing: 0.1em;
            box-shadow: 0 4px 14px 0 rgba(0, 240, 255, 0.3);
            display: inline-block;
        }

        .header-top-bar {
            background: #000000;
            /* Deepest black for max contrast */
            padding: 10px 0;
            color: #FFFFFF;
            /* Pure white for accessibility */
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header-top-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            justify-content: flex-end;
            gap: 2.5rem;
            font-family: var(--font-mono);
            font-size: 10px;
            /* Increased size */
            font-weight: 800;
            /* Max weight for readability */
            text-transform: uppercase;
            letter-spacing: 0.12em;
        }

        .header-top-container a {
            color: #FFFFFF;
            /* Force white */
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }

        .header-top-container a:hover {
            color: var(--ardo-primary);
        }

        .header-top-container i {
            color: var(--ardo-primary);
            font-size: 12px;
        }

        /* Primary color icons for better recognition */

        /* Typography Utilities */
        .text-huge {
            font-size: clamp(2.5rem, 8vw, 6rem);
            font-weight: 900;
            line-height: 0.9;
            letter-spacing: -0.04em;
            text-transform: uppercase;
        }

        .text-cyan {
            color: var(--ardo-primary);
        }

        /* MEGA MENU SYSTEM */
        .nav-menu li.has-mega {
            position: static;
        }

        .mega-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: #FFFFFF;
            border-bottom: 1px solid var(--ardo-border);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            z-index: 999;
            padding: 3rem 0;
            box-shadow: 0 40px 80px rgba(0, 0, 0, 0.1);
        }

        .nav-menu li.has-mega:hover .mega-dropdown {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .mega-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4rem;
        }

        .mega-col-title {
            color: var(--ardo-midnight);
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 2rem;
            display: block;
            font-family: var(--font-mono);
            opacity: 0.4;
        }

        .mega-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mega-list li {
            margin-bottom: 1rem;
        }

        .mega-list a {
            text-decoration: none;
            color: var(--ardo-midnight);
            font-size: 14px;
            font-weight: 600;
            transition: color 0.2s;
            text-transform: none !important;
            letter-spacing: normal !important;
            font-family: var(--font-display) !important;
        }

        .mega-list a:hover {
            color: var(--ardo-primary);
        }

        .mega-card {
            background: var(--ardo-surface);
            padding: 1.5rem;
            border-radius: 1rem;
            border: 1px solid var(--ardo-border);
            transition: all 0.2s;
        }

        .mega-card:hover {
            border-color: var(--ardo-primary);
        }

        .mega-card i {
            color: var(--ardo-primary);
            font-size: 20px;
            margin-bottom: 1rem;
            display: block;
        }

        .mega-card span {
            font-size: 13px;
            font-weight: 700;
            color: var(--ardo-midnight);
        }

        /* Typography Utilities */
        .text-huge {
            font-size: clamp(2.5rem, 8vw, 6rem);
            font-weight: 900;
            line-height: 0.9;
            letter-spacing: -0.04em;
            text-transform: uppercase;
        }

        .text-cyan {
            color: var(--ardo-primary);
        }

        /* MOBILE MENU TOGGLE ICON */
        .mobile-menu-toggle {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            z-index: 1001;
            padding: 10px;
        }

        .mobile-menu-toggle span {
            display: block;
            width: 25px;
            height: 2px;
            background: var(--ardo-midnight);
            transition: all 0.3s;
        }

        .mobile-menu-toggle.active span:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }

        .mobile-menu-toggle.active span:nth-child(2) {
            opacity: 0;
        }

        .mobile-menu-toggle.active span:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }

        /* MOBILE AUTH WRAPPER (HIDDEN ON DESKTOP) */
        .nav-mobile-auth {
            display: none;
        }

        @media (max-width: 1024px) {
            .mobile-menu-toggle {
                display: flex;
            }

            .nav-menu {
                position: fixed;
                top: 0;
                right: -100%;
                width: 100%;
                height: 100vh;
                background: #FFFFFF;
                flex-direction: column;
                justify-content: flex-start;
                align-items: stretch;
                gap: 0;
                transition: right 0.4s cubic-bezier(0.16, 1, 0.3, 1);
                z-index: 1000;
                display: flex;
                padding: 6rem 0;
                overflow-y: auto;
            }

            nav.active .nav-menu {
                right: 0;
            }

            .nav-menu>li {
                width: 100%;
                border-bottom: 1px solid rgba(0, 0, 0, 0.03);
            }

            .nav-menu>li>a {
                padding: 1.5rem 2rem;
                font-size: 1.1rem;
                letter-spacing: 0.05em;
                color: var(--ardo-midnight);
                display: flex;
                justify-content: space-between;
                align-items: center;
                width: 100%;
                text-align: left;
            }

            .nav-mobile-auth {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 1rem;
                padding: 1rem 2rem 2rem;
            }

            .header-auth-links {
                display: none;
            }

            .mega-card {
                padding: 1rem !important;
            }

            /* Submenu Logic for Mobile */
            .nav-menu .mega-dropdown {
                display: none !important;
                position: static !important;
                width: 100% !important;
                background: #fbfcfd !important;
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
                margin: 0 !important;
                border-radius: 0 !important;
            }

            .nav-menu li.has-mega.mm-open .mega-dropdown {
                display: block !important;
            }

            .nav-menu li.has-mega.mm-open>a i {
                transform: rotate(180deg);
            }

            .mega-container {
                display: flex !important;
                flex-direction: column !important;
                gap: 2rem !important;
                padding: 2rem !important;
                max-width: none !important;
                /* Force wide */
            }

            .mega-col-title {
                display: block !important;
                margin-bottom: 1rem !important;
                font-size: 10px !important;
                opacity: 0.5;
            }

            .mega-list li {
                margin-bottom: 0.75rem !important;
            }

            .mega-list a {
                font-size: 14px !important;
                font-weight: 600 !important;
            }

            .nav-menu li.has-mega.mm-open>a i {
                transform: rotate(180deg) !important;
            }

            /* Prevent hover from hiding active submenus on mobile */
            .nav-menu li.has-mega:hover .mega-dropdown {
                display: none !important;
            }

            .nav-menu li.has-mega.mm-open:hover .mega-dropdown {
                display: block !important;
            }

            .hide-on-mobile {
                display: none !important;
            }
        }
    </style>

    <?php if (isset($customHead))
        echo $customHead; ?>
    <!-- External Scripts (Analytics, Chat) -->
    <?php include $basePath . 'includes/external-scripts.php'; ?>
</head>

<body class="antialiased">
    <!-- Top System Bar -->
    <div class="header-top-bar">
        <div class="header-top-container">
            <a href="tel:8009530017"><i class="lni lni-phone"></i> 800 953 0017</a>
            <a href="https://wa.me/524429803200" target="_blank"><i class="lni lni-whatsapp"></i> WhatsApp</a>
            <a href="<?php echo $basePath; ?>soporte-tecnico/"><i class="lni lni-life-ring"></i> Soporte</a>
        </div>
    </div>

    <header class="header-premium">
        <div class="header-container">
            <a href="<?php echo $basePath; ?>" class="logo-link">
                <img src="<?php echo $basePath; ?>images/logo.svg" alt="Ardo Technology"
                    style="height: 36px; width: auto; display: block;">
            </a>

            <nav id="nav">
                <ul class="nav-menu">
                    <li class="has-mega">
                        <a href="#">Servicios <i class="lni lni-chevron-down"
                                style="font-size: 8px; margin-left: 5px;"></i></a>
                        <!-- Mega Menu Soluciones -->
                        <div class="mega-dropdown">
                            <div class="mega-container">
                                <div>
                                    <span class="mega-col-title">Infraestructura</span>
                                    <ul class="mega-list">
                                        <li><a href="<?php echo $basePath; ?>servicios-administrados/">Servicios
                                                Administrados</a></li>
                                        <li><a href="<?php echo $basePath; ?>consultoria-ti/">Consultoría TI</a></li>
                                        <li><a href="<?php echo $basePath; ?>servidores-cloud/">Servidores Cloud</a>
                                        </li>
                                        <li><a href="<?php echo $basePath; ?>conectividad-global/">Conectividad
                                                Global</a></li>
                                        <li><a href="<?php echo $basePath; ?>ciberseguridad/">Ciberseguridad</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <span class="mega-col-title">Comunicaciones</span>
                                    <ul class="mega-list">
                                        <li><a href="<?php echo $basePath; ?>comunicaciones-unificadas/">Comunicaciones
                                                Unificadas</a></li>
                                        <li><a href="<?php echo $basePath; ?>numeros-virtuales/">Números Virtuales</a>
                                        </li>
                                        <li><a href="<?php echo $basePath; ?>troncal-sip/">Troncales SIP</a></li>
                                    </ul>
                                </div>
                                <div style="grid-column: span 2;" class="hide-on-mobile">
                                    <span class="mega-col-title">Propósito Técnico</span>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                        <div class="mega-card">
                                            <i class="lni lni-shield-2"></i>
                                            <span>Seguridad Crítica</span>
                                        </div>
                                        <div class="mega-card">
                                            <i class="lni lni-target-user"></i>
                                            <span>Alta Disponibilidad</span>
                                        </div>
                                        <div class="mega-card">
                                            <i class="lni lni-customer"></i>
                                            <span>SLA 99.99%</span>
                                        </div>
                                        <div class="mega-card">
                                            <i class="lni lni-vector-nodes-6"></i>
                                            <span>Escala Global</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="has-mega">
                        <a href="#">Compañía <i class="lni lni-chevron-down"
                                style="font-size: 8px; margin-left: 5px;"></i></a>
                        <!-- Mega Menu Compañía -->
                        <div class="mega-dropdown">
                            <div class="mega-container">
                                <div style="grid-column: span 2;" class="hide-on-mobile">
                                    <span class="mega-col-title">Narrativa</span>
                                    <h3
                                        style="font-size: 2rem; font-weight: 900; line-height: 1.1; margin-bottom: 2rem; text-transform: uppercase;">
                                        Simplificamos la <br><span class="text-cyan">Comunicación</span> en <br>entornos
                                        de alta complejidad.
                                    </h3>
                                    <p style="color: var(--ardo-text-muted); font-size: 14px; max-width: 400px;">
                                        Construimos el puente entre la tecnología de vanguardia y las necesidades
                                        operativas de la industria moderna.
                                    </p>
                                </div>
                                <div>
                                    <span class="mega-col-title">Institucional</span>
                                    <ul class="mega-list">
                                        <li><a href="<?php echo $basePath; ?>nosotros/">Sobre Nosotros</a></li>
                                        <li><a href="<?php echo $basePath; ?>cobertura/">Cobertura Nacional</a></li>
                                        <li><a href="<?php echo $basePath; ?>ardo-partners/">Red de ARDO Partners</a>
                                        </li>
                                        <li><a href="<?php echo $basePath; ?>contacto/">Contacto</a></li>
                                    </ul>
                                </div>
                                <div>
                                    <span class="mega-col-title">Tech Partners</span>
                                    <div style="display: flex; flex-direction: column; gap: 1rem; opacity: 0.5;">
                                        <div
                                            style="display: flex; align-items: center; gap: 10px; font-family: var(--font-mono); font-size: 11px; font-weight: 700;">
                                            <i class="lni lni-aws" style="font-size: 20px;"></i> AWS INFRA
                                        </div>
                                        <div
                                            style="display: flex; align-items: center; gap: 10px; font-family: var(--font-mono); font-size: 11px; font-weight: 700;">
                                            <i class="lni lni-google-cloud" style="font-size: 20px;"></i> GOOGLE CLOUD
                                        </div>
                                        <div
                                            style="display: flex; align-items: center; gap: 10px; font-family: var(--font-mono); font-size: 11px; font-weight: 700;">
                                            <i class="lni lni-oracle" style="font-size: 20px;"></i> ORACLE CLOUD
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li><a href="<?php echo $basePath; ?>casos-de-estudio/index.php">Casos de Estudio</a></li>
                    <li><a href="<?php echo $basePath; ?>blog/">Blog</a></li>
                    <li><a href="<?php echo $basePath; ?>contacto/">Contacto</a></li>

                    <!-- Mobile specific auth links -->
                    <div class="nav-mobile-auth">
                        <a href="https://ardo.dev/ardotechnology/dashboard/login.php" class="btn-login"
                            style="margin-bottom: 1rem;">Ingresar</a>
                        <a href="<?php echo $basePath; ?>registro/" class="btn-register">Empieza Ahora</a>
                    </div>
                </ul>
            </nav>
            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="header-auth-links">
                <a href="https://ardo.dev/ardotechnology/dashboard/login.php" class="btn-login">Ingresar</a>
                <span style="color: var(--ardo-border);">|</span>
                <a href="<?php echo $basePath; ?>registro/" class="btn-register">Empieza Ahora</a>
            </div>
        </div>
    </header>