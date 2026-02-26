<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('partners_home') ?? [
    'title' => 'Gana Ingresos Pasivos 2026: Programa de Partners TI en México | ARDO',
    'description' => 'Monetiza tu red de contactos de negocio. Gana hasta 50% de comisión y hasta 20% recurrente mensual. Sin inversión en infraestructura. Nosotros nos encargamos de todo.',
    'og_image' => 'https://ardo.technology/images/inicio.jpg'
];
// Debug: echo "<!-- SEO Mode: " . (SeoHelper::load('partners_home') ? 'JSON' : 'Fallback') . " -->";
$basePath = '../';
include '../includes/header.php';
?>

<div class="main-content-redesign internal-page-redesign">

    <!-- Hero Section: Premium Dark Style -->
    <section class="hero-section"
        style="padding: 140px 0; background: linear-gradient(rgba(5, 5, 5, 0.8), rgba(5, 5, 5, 1)), url('images/hero.jpg'); background-size: cover; background-position: center; color: white; border-bottom: 1px solid var(--ardo-border); overflow: hidden;">
        <div class="container">
            <div class="hero-content" style="max-width: 900px;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 2rem;">Affiliate & Partner
                    Program 2026</p>
                <h1 class="text-huge" style="margin-bottom: 2.5rem; line-height: 0.85;">Gana <br><span class="text-cyan"
                        style="text-shadow: 0 0 30px rgba(0, 240, 255, 0.4);">Ingresos Pasivos</span> <br>vendiendo
                    Telefonía IP.</h1>
                <p
                    style="font-size: 1.35rem; color: rgba(255,255,255,0.7); margin-bottom: 3.5rem; line-height: 1.6; max-width: 700px;">
                    ¿Buscas <strong>trabajo online</strong> o ingresos extra en TI? Únete al programa de socios de
                    <strong>ARDO Technology</strong>. Monetiza tu red de contactos ofreciendo soluciones de telefonía
                    empresarial de alto nivel.
                </p>
                <div class="hero-cta" style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <a href="#contacto" class="btn-primary" style="padding: 1rem 2.5rem; font-size: 12px;">
                        <i class="lni lni-rocket"></i> EMPEZAR AHORA
                    </a>
                    <a href="https://wa.me/524429803200" target="_blank" class="btn-dark"
                        style="border: 1px solid rgba(255,255,255,0.2); padding: 1rem 2.5rem; display: flex; align-items: center; gap: 0.8rem;">
                        <i class="lni lni-whatsapp" style="color: #25D366;"></i> WHATSAPP
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Metrics Strip -->
    <section class="metrics-strip"
        style="background: var(--ardo-midnight); border-bottom: 1px solid rgba(255,255,255,0.1);">
        <div class="container" style="padding: 0;">
            <div
                style="display: grid; grid-template-columns: repeat(4, 1fr); divide-x: 1px solid rgba(255,255,255,0.1);">
                <div style="padding: 3rem 2rem; border-right: 1px solid rgba(255,255,255,0.1); text-align: center;">
                    <p class="text-mono-label"
                        style="color: rgba(255,255,255,0.4); margin-bottom: 1rem; font-size: 9px;">COMISIÓN INICIAL</p>
                    <h3 class="text-huge" style="font-size: 3rem; color: white;">50<span class="text-cyan">%</span></h3>
                </div>
                <div style="padding: 3rem 2rem; border-right: 1px solid rgba(255,255,255,0.1); text-align: center;">
                    <p class="text-mono-label"
                        style="color: rgba(255,255,255,0.4); margin-bottom: 1rem; font-size: 9px;">INGRESO RECURRENTE
                        HASTA
                    </p>
                    <h3 class="text-huge" style="font-size: 3rem; color: white;">20<span class="text-cyan">%</span></h3>
                </div>
                <div style="padding: 3rem 2rem; border-right: 1px solid rgba(255,255,255,0.1); text-align: center;">
                    <p class="text-mono-label"
                        style="color: rgba(255,255,255,0.4); margin-bottom: 1rem; font-size: 9px;">INFRAESTRUCTURA</p>
                    <h3 class="text-huge" style="font-size: 2rem; color: white; margin-top: 0.5rem;">CERO COSTO</h3>
                </div>
                <div style="padding: 3rem 2rem; text-align: center;">
                    <p class="text-mono-label"
                        style="color: rgba(255,255,255,0.4); margin-bottom: 1rem; font-size: 9px;">ESTILO DE VIDA</p>
                    <h3 class="text-huge" style="font-size: 2rem; color: white; margin-top: 0.5rem;">100% REMOTO</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Bento Grid -->
    <section class="benefits-section" id="beneficios" style="padding: 120px 0; background: var(--ardo-surface);">
        <div class="container">
            <div class="section-header" style="margin-bottom: 6rem; text-align: center;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Oportunidades de
                    Negocio TI</p>
                <h2 class="text-huge" style="font-size: 4rem;">¿Por qué elegir el <br><span class="text-cyan">Programa
                        de Partners</span>?
                </h2>
            </div>

            <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 2rem;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                    <div class="bento-card" style="padding: 3rem;">
                        <div class="benefit-icon"
                            style="background: var(--ardo-midnight); color: var(--ardo-primary); border: none; margin-bottom: 2rem;">
                            <i class="lni lni-dollar" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1.5rem;">Liderazgo Financiero
                        </h3>
                        <p style="color: var(--ardo-text-muted); line-height: 1.7;">Cada cliente que traes es un flujo
                            constante. Construye activos recurrentes mes a mes sin techo de ingresos.</p>
                    </div>
                    <div class="bento-card" style="padding: 3rem;">
                        <div class="benefit-icon"
                            style="background: var(--ardo-midnight); color: var(--ardo-primary); border: none; margin-bottom: 2rem;">
                            <i class="lni lni-shield-2" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1.5rem;">Cero Riesgo</h3>
                        <p style="color: var(--ardo-text-muted); line-height: 1.7;">Nosotros operamos los servidores y
                            el soporte técnico. Tú te enfocas en la estrategia comercial.</p>
                    </div>
                    <div class="bento-card" style="padding: 3rem;">
                        <div class="benefit-icon"
                            style="background: var(--ardo-midnight); color: var(--ardo-primary); border: none; margin-bottom: 2rem;">
                            <i class="lni lni-gears-3" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1.5rem;">Pre-Ingeniería</h3>
                        <p style="color: var(--ardo-text-muted); line-height: 1.7;">Acceso directo a especialistas para
                            cierre de proyectos complejos y validación de arquitectura.</p>
                    </div>
                    <div class="bento-card" style="padding: 3rem;">
                        <div class="benefit-icon"
                            style="background: var(--ardo-midnight); color: var(--ardo-primary); border: none; margin-bottom: 2rem;">
                            <i class="lni lni-trophy-1" style="font-size: 1.5rem;"></i>
                        </div>
                        <h3 style="font-size: 1.5rem; font-weight: 900; margin-bottom: 1.5rem;">Track de Éxito</h3>
                        <p style="color: var(--ardo-text-muted); line-height: 1.7;">Utiliza nuestro simulador y
                            herramientas de seguimiento para proyectar tu crecimiento anual.</p>
                    </div>
                </div>

                <!-- Incentive Sidebar -->
                <div class="bento-card"
                    style="background: var(--ardo-midnight); color: white; padding: 4rem; display: flex; flex-direction: column; justify-content: center; position: relative; overflow: hidden;">
                    <div
                        style="position: absolute; top: 0; right: 0; padding: 1rem 2rem; background: var(--ardo-primary); color: var(--ardo-midnight); font-weight: 900; font-family: var(--font-mono); font-size: 10px; letter-spacing: 0.2em;">
                        PREMIUM ACTION</div>
                    <div style="margin-bottom: 3rem;">
                        <i class="lni lni-revenue"
                            style="color: var(--ardo-primary); font-size: 4rem; margin-bottom: 2rem; display: block;"></i>
                        <h3 class="text-huge" style="font-size: 2.2rem; color: white; margin-bottom: 1.5rem;">Gana
                            Dinero <br>con tu <span class="text-cyan">Red B2B</span></h3>
                        <p style="color: rgba(255,255,255,0.5); line-height: 1.7;">¿Eres freelance o tienes una cartera
                            de clientes B2B? No dejes pasar la oportunidad de generar <strong>ingresos pasivos
                                recurrentes</strong> con nosotros.</p>
                    </div>
                    <ul
                        style="list-style: none; padding: 0; margin-bottom: 4rem; display: flex; flex-direction: column; gap: 1.5rem;">
                        <li
                            style="display: flex; gap: 1rem; align-items: center; font-size: 0.9rem; color: rgba(255,255,255,0.7);">
                            <i class="lni lni-angle-double-right" style="color: var(--ardo-primary);"></i> Sin cuotas de
                            mantenimiento
                        </li>
                        <li
                            style="display: flex; gap: 1rem; align-items: center; font-size: 0.9rem; color: rgba(255,255,255,0.7);">
                            <i class="lni lni-angle-double-right" style="color: var(--ardo-primary);"></i> Pagos vía
                            transferencia directa
                        </li>
                        <li
                            style="display: flex; gap: 1rem; align-items: center; font-size: 0.9rem; color: rgba(255,255,255,0.7);">
                            <i class="lni lni-angle-double-right" style="color: var(--ardo-primary);"></i> Capacitación
                            técnica continua
                        </li>
                    </ul>
                    <a href="sales_simulator_individual.html" target="_blank" class="btn-primary"
                        style="width: 100%; justify-content: center; padding: 1.25rem;">PROBAR SIMULADOR</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Program Details Section -->
    <section class="program-details" id="programa"
        style="padding: 120px 0; background: white; position: relative; overflow: hidden;">
        <div class="grid-overlay" style="opacity: 0.05;"></div>
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 2rem;">Socio
                        Estratégico Ardo</p>
                    <h2 class="text-huge" style="font-size: 3.5rem; margin-bottom: 2rem; color: var(--ardo-midnight);">
                        Tus éxitos <br>son <span class="text-cyan">nuestros éxitos</span>.</h2>
                    <p
                        style="color: var(--ardo-text-muted); font-size: 1.15rem; line-height: 1.8; margin-bottom: 3rem; max-width: 90%;">
                        Convertirse en socio comercial de ARDO Technology significa unirse a la vanguardia de las
                        telecomunicaciones críticas en México. Nuestra plataforma está diseñada para escalar contigo.
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 4rem;">
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <i class="lni lni-angle-double-right"
                                style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label" style="font-size: 9px; opacity: 0.8;">Cierre Rápido</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <i class="lni lni-angle-double-right"
                                style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label" style="font-size: 9px; opacity: 0.8;">Modelo White
                                Label</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <i class="lni lni-angle-double-right"
                                style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label" style="font-size: 9px; opacity: 0.8;">Soporte Nivel 3</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 1rem;">
                            <i class="lni lni-angle-double-right"
                                style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label" style="font-size: 9px; opacity: 0.8;">Escala Global</span>
                        </div>
                    </div>
                </div>
                <div class="bento-card" style="padding: 0; border: none; box-shadow: 0 40px 100px rgba(0,0,0,0.1);">
                    <img src="https://images.pexels.com/photos/3182811/pexels-photo-3182811.jpeg" alt="Partner Meeting"
                        style="width: 100%; height: auto; display: block; filter: contrast(1.1) brightness(0.9);">
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements Section: Dark Premium -->
    <section class="requirements-section" style="padding: 120px 0; background: var(--ardo-midnight); color: white;">
        <div class="container">
            <div class="section-header" style="text-align: center; margin-bottom: 6rem;">
                <h2 class="text-huge" style="color: white; font-size: 3.5rem;">Perfil del <span
                        class="text-cyan">Partner Ideal</span>.</h2>
                <p style="color: rgba(255,255,255,1); margin-top: 1rem;">Buscamos relaciones de alto desempeño con
                    profesionales que valoran la calidad.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="bento-card"
                    style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: white; padding: 3rem;">
                    <span class="text-mono-label"
                        style="color: var(--ardo-primary); margin-bottom: 2rem; display: block;">01 / CARTERA</span>
                    <h3 style="font-size: 1.4rem; font-weight: 900; margin-bottom: 1.5rem; text-transform: uppercase;">
                        Red Activa</h3>
                    <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; line-height: 1.6;">Deseable contar con
                        una base de clientes corporativos que busquen modernizar su infraestructura TI.</p>
                </div>
                <div class="bento-card"
                    style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: white; padding: 3rem;">
                    <span class="text-mono-label"
                        style="color: var(--ardo-primary); margin-bottom: 2rem; display: block;">02 / LEGAL</span>
                    <h3 style="font-size: 1.4rem; font-weight: 900; margin-bottom: 1.5rem; text-transform: uppercase;">
                        Capacidad Fiscal</h3>
                    <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; line-height: 1.6;">Persona física o
                        moral con capacidad de recibir comisiones bajo los marcos legales vigentes.</p>
                </div>
                <div class="bento-card"
                    style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); color: white; padding: 3rem;">
                    <span class="text-mono-label"
                        style="color: var(--ardo-primary); margin-bottom: 2rem; display: block;">03 / VISIÓN</span>
                    <h3 style="font-size: 1.4rem; font-weight: 900; margin-bottom: 1.5rem; text-transform: uppercase;">
                        Crecimiento</h3>
                    <p style="color: rgba(255,255,255,0.5); font-size: 0.95rem; line-height: 1.6;">Mentalidad orientada
                        a resultados para construir un catálogo sólido de ingresos pasivos crecientes.</p>
                </div>
            </div>

            <!-- Recognition Badges -->
            <div style="margin-top: 100px; text-align: center;">
                <h4 class="text-mono-label" style="color: white; opacity: 0.3; margin-bottom: 4rem;">Niveles de
                    Reconocimiento</h4>
                <div style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap; margin-top: 3rem;">
                    <!-- Bronze Badge -->
                    <div class="partner-badge-premium badge-bronze">
                        <div class="badge-header-strip">
                            <div class="badge-level-label">BRONZE</div>
                            <div class="badge-ardo-logo">
                                <img src="../images/logo.svg" alt="ARDO Logo">
                            </div>
                        </div>
                        <div class="badge-main-content">
                            <i class="lni lni-checkmark-circle badge-main-icon"></i>
                            <div class="badge-partner-info">
                                <span class="badge-company-name">ARDO TECHNOLOGY</span>
                                <span class="badge-partner-tag">PARTNER</span>
                            </div>
                        </div>
                    </div>

                    <!-- Silver Badge -->
                    <div class="partner-badge-premium badge-silver">
                        <div class="badge-header-strip">
                            <div class="badge-level-label">SILVER</div>
                            <div class="badge-ardo-logo">
                                <img src="../images/logo.svg" alt="ARDO Logo">
                            </div>
                        </div>
                        <div class="badge-main-content">
                            <i class="lni lni-checkmark-circle badge-main-icon"></i>
                            <div class="badge-partner-info">
                                <span class="badge-company-name">ARDO TECHNOLOGY</span>
                                <span class="badge-partner-tag">PARTNER</span>
                            </div>
                        </div>
                    </div>

                    <!-- Gold Badge -->
                    <div class="partner-badge-premium badge-gold">
                        <div class="badge-header-strip">
                            <div class="badge-level-label">GOLD</div>
                            <div class="badge-ardo-logo">
                                <img src="../images/logo.svg" alt="ARDO Logo">
                            </div>
                        </div>
                        <div class="badge-main-content">
                            <i class="lni lni-checkmark-circle badge-main-icon"></i>
                            <div class="badge-partner-info">
                                <span class="badge-company-name">ARDO TECHNOLOGY</span>
                                <span class="badge-partner-tag">PARTNER</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <?php include '../includes/contact.php'; ?>
</div>

<style>
    /* Partner Badges Premium CSS */
    .partner-badge-premium {
        width: 280px;
        height: 110px;
        background: #000;
        position: relative;
        clip-path: polygon(0 0, 92% 0, 100% 25%, 100% 100%, 8% 100%, 0 75%);
        display: flex;
        flex-direction: column;
        padding: 0;
        border: 1px solid rgba(255, 255, 255, 0.1);
        font-family: var(--font-display);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        margin: 0 auto;
    }

    .partner-badge-premium:hover {
        transform: translateY(-8px) rotateX(4deg);
        border-color: var(--badge-color);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6), 0 0 25px var(--badge-glow);
    }

    .badge-header-strip {
        height: 35px;
        display: flex;
        align-items: center;
        padding: 0 15px;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .badge-level-label {
        background: var(--badge-color);
        color: #000;
        font-weight: 900;
        font-size: 10px;
        padding: 6px 15px;
        margin-left: -15px;
        clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
        letter-spacing: 0.15em;
        text-transform: uppercase;
    }

    .badge-ardo-logo {
        margin-left: auto;
    }

    .badge-ardo-logo img {
        height: 14px;
        width: auto;
        filter: brightness(0) invert(1);
        display: block;
        opacity: 0.9;
    }

    .badge-main-content {
        flex-grow: 1;
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 0 25px;
    }

    .badge-main-icon {
        font-size: 2rem;
        color: #fff;
        opacity: 0.9;
    }

    .badge-partner-info {
        display: flex;
        flex-direction: column;
        text-align: left;
    }

    .badge-company-name {
        color: #fff;
        font-weight: 800;
        font-size: 11px;
        letter-spacing: 0.1em;
        line-height: 1.1;
        text-transform: uppercase;
    }

    .badge-partner-tag {
        color: rgba(255, 255, 255, 0.9);
        font-size: 9px;
        font-weight: 500;
        letter-spacing: 0.25em;
        margin-top: 3px;
        text-transform: uppercase;
    }

    /* Tiers */
    .badge-bronze {
        --badge-color: #CD7F32;
        --badge-glow: rgba(205, 127, 50, 0.4);
    }

    .badge-silver {
        --badge-color: #C0C0C0;
        --badge-glow: rgba(192, 192, 192, 0.4);
    }

    .badge-gold {
        --badge-color: #FFD700;
        --badge-glow: rgba(255, 215, 0, 0.5);
    }

    @media (max-width: 1024px) {
        .metrics-strip div[style*="grid-template-columns"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }

        .metrics-strip div[style*="border-right"] {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .benefits-section div[style*="grid-template-columns: 1.5fr 1fr"] {
            grid-template-columns: 1fr !important;
        }

        .program-details div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }

        .requirements-section div[style*="grid-template-columns"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>

<?php include '../includes/footer.php'; ?>