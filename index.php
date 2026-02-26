<?php
require_once 'includes/SeoHelper.php';
$seoConfig = SeoHelper::load('home');
$basePath = './';
include './includes/header.php';
include __DIR__ . '/casos-de-estudio/data.php';
?>

<div class="main-content-redesign">

    <?php include 'includes/hero.php'; ?>

    <?php include 'includes/trusted.php'; ?>

    <!-- Benefits Section: Redesigned with Bento-inspired flow -->
    <section class="benefits-section" style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div class="section-header" style="margin-bottom: 4rem; text-align: center;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Valor Agregado</p>
                <h2 class="text-huge" style="font-size: 3rem;">Por qué elegir <span class="text-cyan">Ardo</span>.</h2>
            </div>

            <style>
                .benefits-grid-fixed {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 1.5rem;
                }

                @media (max-width: 1024px) {
                    .benefits-grid-fixed {
                        grid-template-columns: repeat(2, 1fr);
                    }
                }

                @media (max-width: 768px) {
                    .benefits-grid-fixed {
                        grid-template-columns: 1fr;
                    }
                }

                /* Refinement for benefit item text to fit 1 line better */
                .benefit-item h3 {
                    font-size: 1.2rem !important;
                    margin-bottom: 1.25rem !important;
                }

                .benefit-item p {
                    font-size: 0.9rem !important;
                    line-height: 1.6;
                }
            </style>

            <div class="benefits-grid-fixed">
                <!-- 1. Costos -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <img src="images/costos.svg" alt="Ahorro en Costos" style="width: 28px;">
                    </div>
                    <h3>Optimización de Costos</h3>
                    <p>Adapta tu presupuesto operativo a las exigencias reales. Paga solo por la capacidad que utiliza
                        en su infraestructura.</p>
                </div>

                <!-- 2. Seguridad -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <img src="images/seguridad.svg" alt="Seguridad" style="width: 28px;">
                    </div>
                    <h3>Seguridad Robusta</h3>
                    <p>Detección proactiva y encriptación de grado militar. Protegemos el activo más valioso de su
                        empresa: la información.</p>
                </div>

                <!-- 3. Escalabilidad -->
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <img src="images/escalabilidad.svg" alt="Escalabilidad" style="width: 28px;">
                    </div>
                    <h3>Escalabilidad Ágil</h3>
                    <p>Despliegue nodos y terminales de forma instantánea. Su comunicación crece al mismo ritmo que sus
                        metas globales.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services-section" id="servicios" style="padding: 120px 0;">
        <div class="container">
            <div class="section-header" style="margin-bottom: 5rem;">
                <p class="text-mono-label" style="opacity: 0.5;">Portafolio de Ingeniería</p>
                <h2 class="text-huge" style="font-size: 4rem;">Protocolos & <br> <span
                        class="text-cyan">Sistemas</span>.</h2>
            </div>

            <div class="services-grid">
                <!-- Service 1: Servicios Administrados -->
                <a href="<?php echo $basePath; ?>servicios-administrados/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-shield-2"></i>
                    </div>
                    <h3>Servicios Administrados</h3>
                    <p>Optimización y gestión proactiva de su infraestructura tecnológica por especialistas
                        certificados.</p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>

                <!-- Service 2: Consultoría en TI -->
                <a href="<?php echo $basePath; ?>consultoria-ti/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-bulb-2"></i>
                    </div>
                    <h3>Consultoría en TI</h3>
                    <p>Estrategia y arquitectura TI orientada a resultados de negocio y eficiencia operativa.</p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>

                <!-- Service 3: Comunicaciones Unificadas -->
                <a href="<?php echo $basePath; ?>comunicaciones-unificadas/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-headphone-1"></i>
                    </div>
                    <h3>Comunicaciones Unificadas</h3>
                    <p>Omnicanalidad absoluta: voz, video, chat y WhatsApp Business en un solo ecosistema seguro.</p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>

                <!-- Service 4: Números Virtuales -->
                <a href="<?php echo $basePath; ?>numeros-virtuales/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-globe-1"></i>
                    </div>
                    <h3>Números Virtuales</h3>
                    <p>Presencia global instantánea en más de 140 países para conectar con sus clientes locales.</p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>

                <!-- Service 5: Troncales SIP -->
                <a href="<?php echo $basePath; ?>troncal-sip/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-vector-nodes-6"></i>
                    </div>
                    <h3>Troncales SIP</h3>
                    <p>Modernización de telefonía legacy mediante protocolos IP de alta disponibilidad y bajo costo.</p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>

                <!-- Service 6: Servidores Cloud -->
                <a href="<?php echo $basePath; ?>servidores-cloud/" class="service-card">
                    <div class="service-card-icon">
                        <i class="lni lni-database-2"></i>
                    </div>
                    <h3>Servidores Cloud</h3>
                    <p>Cómputo escalable y servidores dedicados de alto rendimiento sin inversión en hardware físico.
                    </p>
                    <span class="text-mono-label"
                        style="margin-top: auto; color: var(--ardo-primary); font-size: 9px;">Detalles <i
                            class="lni lni-arrow-right"></i></span>
                </a>
            </div>
        </div>
    </section>

    <!-- Casos de Estudio Section -->
    <section class="cases-section" id="casos" style="padding: 100px 0; background: var(--ardo-midnight); color: white;">
        <div class="container">
            <div class="section-header" style="margin-bottom: 5rem; text-align: center;">
                <p class="text-mono-label" style="color: var(--ardo-primary);">Implementaciones Exitosas</p>
                <h2 class="text-huge" style="color: white; font-size: 3rem;">Casos de <span
                        class="text-cyan">Estudio</span>.</h2>
            </div>

            <div class="cases-grid"
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
                <?php foreach ($casos as $case): ?>
                    <article class="bento-card"
                        onclick="window.location.href='<?php echo $basePath; ?>casos-de-estudio/detalle.php?slug=<?php echo $case['slug']; ?>';"
                        style="background: rgba(255,255,255,0.05); border-color: rgba(255,255,255,0.1); cursor: pointer; color: white; padding: 0;">
                        <div
                            style="height: 250px; background-image: url('<?php echo $case['image']; ?>'); background-size: cover; background-position: center; opacity: 0.6;">
                        </div>
                        <div style="padding: 2.5rem;">
                            <span class="text-mono-label"
                                style="color: var(--ardo-primary); font-size: 9px;"><?php echo $case['category']; ?></span>
                            <h3 style="font-size: 1.5rem; margin: 1rem 0; font-weight: 900;"><?php echo $case['title']; ?>
                            </h3>
                            <p style="color: rgba(255,255,255,0.5); font-size: 14px; margin-bottom: 2rem;">
                                <?php echo $case['short_description']; ?>
                            </p>
                            <span class="btn-primary" style="padding: 0.5rem 1rem; font-size: 9px;">Analizar Solución</span>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</div>

<?php
include $basePath . 'includes/partners.php';
include $basePath . 'includes/partners-cta.php';
include $basePath . 'includes/telco.php';
include $basePath . 'includes/contact.php';
include $basePath . 'includes/footer.php';
?>