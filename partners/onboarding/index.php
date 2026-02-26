<?php
require_once '../../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('onboarding') ?? [
    'title' => 'Bienvenido al Programa de Resellers - Ardo Technology',
    'description' => 'Estas a un paso de formar parte de nuestro programa de socios y comenzar a generar ingresos recurrentes.'
];
$basePath = '../../';
include '../../includes/header.php';
?>

<div class="main-content-redesign internal-page-redesign">

    <!-- Hero Section: Premium Dark Style -->
    <section class="hero-section"
        style="padding: 120px 0; background: linear-gradient(rgba(5, 5, 5, 0.8), rgba(5, 5, 5, 1)), url('images/hero.jpg'); background-size: cover; background-position: center; color: white;">
        <div class="container">
            <div class="hero-content" style="max-width: 800px;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Partner Affinity
                    Program</p>
                <h1 class="text-huge" style="margin-bottom: 2rem;">¡Bienvenido al <br><span class="text-cyan">Programa
                        de Partners</span>!</h1>
                <p style="font-size: 1.25rem; color: rgba(255,255,255,0.7); margin-bottom: 3rem; line-height: 1.6;">
                    Estás a un paso de formar parte de nuestro ecosistema de socios de ingeniería y comenzar a generar
                    ingresos recurrentes con soluciones de telefonía empresarial.
                </p>
                <div class="hero-cta" style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                    <a href="#recursos" class="btn-primary">
                        <i class="lni lni-download"></i> Descargar Recursos
                    </a>
                    <a href="#programa" class="btn-dark" style="border: 1px solid rgba(255,255,255,0.2);">
                        Ver Programa
                    </a>
                </div>
            </div>
        </div>
    </section>



    <!-- Benefits Section: Bento Grid -->
    <section class="benefits-section" id="beneficios" style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div class="section-header" style="margin-bottom: 5rem; text-align: center;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Ecosistema Ardo</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Beneficios de <br><span class="text-cyan">Convertirte
                        en Partner</span>.</h2>
            </div>

            <div class="benefits-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="lni lni-dollar"></i>
                    </div>
                    <h3>Comisiones Competitivas</h3>
                    <p>Gana hasta 50% de comisión inicial y hasta el 20% recurrente mensual. Ingresos predecibles y
                        escalables en un mercado de alta demanda.</p>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="lni lni-gears-3"></i>
                    </div>
                    <h3>Soporte Dedicado</h3>
                    <p>Acceso directo a nuestro centro de ingeniería y soporte comercial para cierre de proyectos
                        complejos y resolución técnica inmediata.</p>
                </div>

                <div class="benefit-item">
                    <div class="benefit-icon">
                        <i class="lni lni-megaphone-1"></i>
                    </div>
                    <h3>Recursos de Marketing</h3>
                    <p>Acceso a librerías de diseño, presentaciones técnicas de alto nivel y material comercial listo
                        para proyectar profesionalismo total.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Program Steps Section -->
    <section class="program-section" id="programa" style="padding: 120px 0;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Protocolo de
                        Inicio</p>
                    <h2 class="text-huge" style="font-size: 3.5rem; margin-bottom: 3rem;">Ruta de <br><span
                            class="text-cyan">Activación</span>.</h2>

                    <div style="display: flex; flex-direction: column; gap: 2.5rem;">
                        <div style="display: flex; gap: 2rem;">
                            <span class="text-mono-label"
                                style="color: white; background: var(--ardo-midnight); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 4px; flex-shrink: 0;">01</span>
                            <div>
                                <h4
                                    style="font-weight: 900; text-transform: uppercase; letter-spacing: -0.01em; margin-bottom: 0.5rem;">
                                    Onboarding</h4>
                                <p style="color: var(--ardo-text-muted); font-size: 0.95rem;">Registro oficial y
                                    formalización del contrato de comisión mercantil para protección mutua.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 2rem;">
                            <span class="text-mono-label"
                                style="color: white; background: var(--ardo-midnight); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 4px; flex-shrink: 0;">02</span>
                            <div>
                                <h4
                                    style="font-weight: 900; text-transform: uppercase; letter-spacing: -0.01em; margin-bottom: 0.5rem;">
                                    Certificación</h4>
                                <p style="color: var(--ardo-text-muted); font-size: 0.95rem;">Acceso a documentación
                                    técnica, casos de uso y capacitación en soluciones de conectividad.</p>
                            </div>
                        </div>
                        <div style="display: flex; gap: 2rem;">
                            <span class="text-mono-label"
                                style="color: white; background: var(--ardo-midnight); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; border-radius: 4px; flex-shrink: 0;">03</span>
                            <div>
                                <h4
                                    style="font-weight: 900; text-transform: uppercase; letter-spacing: -0.01em; margin-bottom: 0.5rem;">
                                    Ejecución</h4>
                                <p style="color: var(--ardo-text-muted); font-size: 0.95rem;">Despliegue de propuestas
                                    utilizando nuestros recursos de preventa y validación técnica.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bento-card"
                    style="padding: 0; height: 600px; background-image: url('images/partner.jpg'); background-size: cover; background-position: center; border: 1px solid var(--ardo-border);">
                    <div
                        style="position: absolute; inset: 0; background: linear-gradient(to top, var(--ardo-midnight), transparent); opacity: 0.6;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Resources Section: Grid of Cards -->
    <section class="resources-section" id="recursos"
        style="padding: 100px 0; background: var(--ardo-midnight); color: white;">
        <div class="container">
            <div class="section-header" style="margin-bottom: 5rem; text-align: center;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Kit de Herramientas
                </p>
                <h2 class="text-huge" style="color: white; font-size: 3.5rem;">Recursos & <br><span class="text-cyan"
                        style="text-shadow: 0 0 20px rgba(0, 240, 255, 0.3);">Documentación</span>.</h2>
            </div>

            <!-- Category: Legal -->
            <div style="margin-bottom: 5rem;">
                <span class="text-mono-label"
                    style="color: var(--ardo-primary); border-bottom: 1px solid rgba(255,255,255,0.1); display: block; padding-bottom: 1rem; margin-bottom: 2rem;">Protocolos
                    Legales</span>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <a href="docs/resumen_cm.pdf" target="_blank" rel="noopener noreferrer" class="bento-card"
                        style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); color: white; text-decoration: none; padding: 2rem;">
                        <div class="benefit-icon"
                            style="background: rgba(0, 240, 255, 0.15); border: none; margin-bottom: 1.5rem;">
                            <i class="lni lni-file-multiple" style="color: var(--ardo-primary);"></i>
                        </div>
                        <h4
                            style="font-weight: 900; text-transform: uppercase; font-size: 0.95rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Resumen del Contrato</h4>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-bottom: 1.5rem;">PDF • PUNTOS
                            CLAVE</p>
                        <span class="text-mono-label"
                            style="color: var(--ardo-primary); font-size: 10px; font-weight: 800;">Abrir Documento <i
                                class="lni lni-arrow-right"></i></span>
                    </a>

                    <a href="docs/Contrato-de-Comision-Mercantil-PF.pdf" target="_blank" rel="noopener noreferrer"
                        class="bento-card"
                        style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); color: white; text-decoration: none; padding: 2rem;">
                        <div class="benefit-icon"
                            style="background: rgba(0, 240, 255, 0.15); border: none; margin-bottom: 1.5rem;">
                            <i class="lni lni-file-multiple" style="color: var(--ardo-primary);"></i>
                        </div>
                        <h4
                            style="font-weight: 900; text-transform: uppercase; font-size: 0.95rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Contrato Persona Física</h4>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-bottom: 1.5rem;">PDF •
                            VERSIÓN FORMAL</p>
                        <span class="text-mono-label"
                            style="color: var(--ardo-primary); font-size: 10px; font-weight: 800;">Abrir Documento <i
                                class="lni lni-arrow-right"></i></span>
                    </a>

                    <a href="docs/Contrato-de-Comision-Mercantil-PM.pdf" target="_blank" rel="noopener noreferrer"
                        class="bento-card"
                        style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); color: white; text-decoration: none; padding: 2rem;">
                        <div class="benefit-icon"
                            style="background: rgba(0, 240, 255, 0.15); border: none; margin-bottom: 1.5rem;">
                            <i class="lni lni-file-multiple" style="color: var(--ardo-primary);"></i>
                        </div>
                        <h4
                            style="font-weight: 900; text-transform: uppercase; font-size: 0.95rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Contrato Persona Moral</h4>
                        <p style="font-size: 0.85rem; color: rgba(255,255,255,0.6); margin-bottom: 1.5rem;">PDF •
                            VERSIÓN FORMAL</p>
                        <span class="text-mono-label"
                            style="color: var(--ardo-primary); font-size: 10px; font-weight: 800;">Abrir Documento <i
                                class="lni lni-arrow-right"></i></span>
                    </a>
                </div>
            </div>

            <!-- Category: Marketing -->
            <div style="margin-bottom: 5rem;">
                <span class="text-mono-label"
                    style="color: var(--ardo-primary); border-bottom: 1px solid rgba(255,255,255,0.1); display: block; padding-bottom: 1rem; margin-bottom: 2rem;">Protocolos
                    de Ingeniería & Ventas</span>
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                    <a href="docs/Affinity-Program.pdf" target="_blank" rel="noopener noreferrer" class="bento-card"
                        style="background: rgba(255,255,255,0.05); border-color: rgba(0, 240, 255, 0.2); color: white; text-decoration: none; padding: 1.5rem; transition: all 0.3s;">
                        <h4
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Programa Affinity</h4>
                        <div style="display: flex; align-items: center; gap: 0.8rem; margin-top: auto;">
                            <i class="lni lni-eye" style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label"
                                style="color: var(--ardo-primary); font-size: 10px; font-weight: 800; letter-spacing: 0.1em;">VER
                                DOCUMENTO</span>
                        </div>
                    </a>
                    <a href="docs/Decalogo.pdf" target="_blank" rel="noopener noreferrer" class="bento-card"
                        style="background: rgba(255,255,255,0.05); border-color: rgba(0, 240, 255, 0.2); color: white; text-decoration: none; padding: 1.5rem; transition: all 0.3s;">
                        <h4
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Decálogo Reseller</h4>
                        <div style="display: flex; align-items: center; gap: 0.8rem; margin-top: auto;">
                            <i class="lni lni-eye" style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label"
                                style="color: var(--ardo-primary); font-size: 10px; font-weight: 800; letter-spacing: 0.1em;">VER
                                DOCUMENTO</span>
                        </div>
                    </a>
                    <a href="docs/ardo_comercial.pdf" target="_blank" rel="noopener noreferrer" class="bento-card"
                        style="background: rgba(255,255,255,0.05); border-color: rgba(0, 240, 255, 0.2); color: white; text-decoration: none; padding: 1.5rem; transition: all 0.3s;">
                        <h4
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Presentación</h4>
                        <div style="display: flex; align-items: center; gap: 0.8rem; margin-top: auto;">
                            <i class="lni lni-eye" style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label"
                                style="color: var(--ardo-primary); font-size: 10px; font-weight: 800; letter-spacing: 0.1em;">VER
                                DOCUMENTO</span>
                        </div>
                    </a>
                    <a href="docs/onboarding.pdf" target="_blank" rel="noopener noreferrer" class="bento-card"
                        style="background: rgba(255,255,255,0.05); border-color: rgba(0, 240, 255, 0.2); color: white; text-decoration: none; padding: 1.5rem; transition: all 0.3s;">
                        <h4
                            style="font-weight: 800; text-transform: uppercase; font-size: 0.8rem; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                            Guía Onboarding</h4>
                        <div style="display: flex; align-items: center; gap: 0.8rem; margin-top: auto;">
                            <i class="lni lni-eye" style="color: var(--ardo-primary); font-size: 1.2rem;"></i>
                            <span class="text-mono-label"
                                style="color: var(--ardo-primary); font-size: 10px; font-weight: 800; letter-spacing: 0.1em;">VER
                                DOCUMENTO</span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Category: Promo -->
            <div style="margin-bottom: 5rem;">
                <span class="text-mono-label"
                    style="color: var(--ardo-primary); border-bottom: 1px solid rgba(255,255,255,0.1); display: block; padding-bottom: 1rem; margin-bottom: 2rem;">Material
                    Gráfico</span>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                    <div class="bento-card"
                        style="background: rgba(255,255,255,0.08); border-color: rgba(255,255,255,0.15); color: white; padding: 0; overflow: hidden; display: flex; flex-direction: column;">
                        <img src="images/promo_feb.jpg" alt="Promoción Febrero"
                            style="width: 100%; height: 200px; object-fit: cover; display: block; filter: brightness(0.9); transition: filter 0.3s;"
                            onmouseover="this.style.filter='brightness(1)'"
                            onmouseout="this.style.filter='brightness(0.9)'">
                        <div
                            style="padding: 1.5rem; background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between; gap: 1rem;">
                            <div>
                                <h4
                                    style="font-weight: 900; text-transform: uppercase; font-size: 0.85rem; margin: 0; letter-spacing: 0.05em;">
                                    Promoción Mensual</h4>
                                <p style="font-size: 0.75rem; color: rgba(255,255,255,0.5); margin: 0.25rem 0 0 0;">JPG
                                    • ALTA RESOLUCIÓN
                                </p>
                            </div>
                            <a href="images/promo_feb.jpg" download class="btn-primary"
                                style="padding: 0.5rem 1.5rem; font-size: 10px; width: fit-content; font-weight: 800;">
                                <i class="lni lni-download"></i> Descargar
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Badges Integration -->
            <div class="bento-card"
                style="background: var(--ardo-surface); color: var(--ardo-midnight); padding: 4rem;">
                <div style="text-align: center; margin-bottom: 4rem;">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Validación de
                        Autoridad</p>
                    <h3 style="font-size: 2.5rem; font-weight: 900; text-transform: uppercase; margin: 0;">Insignias
                        Certificadas</h3>
                </div>
                <div
                    style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 3rem; max-width: 900px; margin: 0 auto;">
                    <div style="text-align: center;">
                        <img src="images/badge_bronze.png" alt="Bronze"
                            style="height: 120px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
                        <p class="text-mono-label" style="margin-top: 2rem;">Partner Bronze</p>
                    </div>
                    <div style="text-align: center;">
                        <img src="images/badge_silver.png" alt="Silver"
                            style="height: 120px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
                        <p class="text-mono-label" style="margin-top: 2rem;">Partner Silver</p>
                    </div>
                    <div style="text-align: center;">
                        <img src="images/badge_gold.png" alt="Gold"
                            style="height: 120px; filter: drop-shadow(0 10px 20px rgba(0,0,0,0.1));">
                        <p class="text-mono-label" style="margin-top: 2rem;">Partner Gold</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Closing CTA -->
    <section class="cta-section" id="contacto" style="padding: 120px 0; background: #fff; text-align: center;">
        <div class="container">
            <div style="max-width: 700px; margin: 0 auto;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Cierre de
                    Protocolo</p>
                <h2 class="text-huge" style="font-size: 4rem; margin-bottom: 2rem;">¿Listo para <br><span
                        class="text-cyan">Escalar</span>?</h2>
                <p style="color: var(--ardo-text-muted); font-size: 1.1rem; margin-bottom: 3rem; line-height: 1.6;">
                    Accede a las herramientas, certifica tus conocimientos y comienza a construir activos recurrentes
                    con la mayor tecnología de telecomunicaciones hoy mismo.
                </p>
                <div style="display: flex; gap: 1.5rem; justify-content: center;">
                    <a href="#recursos" class="btn-primary">Ver Documentación</a>
                    <a href="https://wa.me/524429803200" target="_blank" rel="noopener noreferrer"
                        class="btn-dark">Contactar Soporte</a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include '../../includes/footer.php';
?>