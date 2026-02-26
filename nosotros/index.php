<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('nosotros', [
    'city' => 'Querétaro',
    'image_path' => '../images/nosotros.jpg'
]);
$basePath = '../';
include '../includes/header.php';
?>

<!-- About Hero Section -->
<section class="hero-internal"
    style="position: relative; padding: 10px 0 60px; display: flex; align-items: center; background: #fff;">
    <div class="container">
        <div style="text-align: center; max-width: 900px; margin: 0 auto;">
            <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">¿POR QUÉ ARDO
                TECHNOLOGY?</p>
            <h1 class="text-huge"
                style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                Más que proveedores, somos el<br> <span class="text-cyan">Socio Tecnológico</span> en el que confía.
            </h1>
            <p style="color: var(--ardo-text-muted); font-size: 1.2rem; margin-bottom: 3rem; font-weight: 500;">
                En un mundo digital complejo, somos su aliado estratégico. Esta es nuestra historia.
            </p>
        </div>

        <div class="hero-visual" style="position: relative; margin-top: 3rem;">
            <div class="bento-card"
                style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative; box-shadow: var(--ardo-shadow-lg);">
                <img src="../images/nosotros.jpg" alt="Equipo de Consultores TI ARDO Technology"
                    style="width: 100%; height: 100%; object-fit: cover;">
                <div class="glass-panel"
                    style="position: absolute; bottom: 30px; right: 30px; padding: 1.5rem; border-radius: 1rem; max-width: 400px;">
                    <p style="color: var(--ardo-midnight); font-size: 0.95rem; font-weight: 600; line-height: 1.5;">
                        "La tecnología no es un fin, sino el medio para potenciar el talento humano."
                    </p>
                </div>
            </div>
        </div>

        <div style="max-width: 800px; margin: 4rem auto 0; text-align: center;">
            <p style="color: var(--ardo-text-main); font-size: 1.15rem; line-height: 1.8;">
                En ARDO Technology, redefinimos el rol del <strong>Integrador de Telecomunicaciones</strong>. Creemos
                firmemente que la tecnología no es un fin, sino el medio para potenciar el talento humano y acelerar el
                crecimiento de su negocio.
            </p>
        </div>
    </div>
</section>

<!-- Values Section (Personas, Proposito, Proceso) -->
<!-- Values Section (Personas, Proposito, Proceso) -->
<section style="padding: 100px 0; background: var(--ardo-surface);">
    <div class="container">
        <div class="bento-grid" style="grid-template-columns: repeat(3, 1fr); gap: 2rem;">
            <!-- Column 1: Personas -->
            <div class="bento-card">
                <i class="lni lni-user-multiple-4"
                    style="font-size: 2.5rem; color: var(--ardo-primary); margin-bottom: 1.5rem; display: block;"></i>
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">Personas</h3>
                <p style="color: var(--ardo-text-muted); font-size: 1rem; line-height: 1.6;">
                    Su empresa merece expertos, no sólo técnicos. Nuestro equipo de <strong>Consultoría TI</strong> se
                    integra con su personal, entendiendo sus desafíos desde adentro para ofrecer soluciones humanas a
                    problemas tecnológicos.
                </p>
            </div>
            <!-- Column 2: Proposito -->
            <div class="bento-card">
                <i class="lni lni-shield-2-check"
                    style="font-size: 2.5rem; color: var(--ardo-primary); margin-bottom: 1.5rem; display: block;"></i>
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">Propósito</h3>
                <p style="color: var(--ardo-text-muted); font-size: 1rem; line-height: 1.6;">
                    Su tranquilidad operativa es nuestra meta. Como su socio de confianza, simplificamos la adopción de
                    tecnologías complejas como Cloud y VoIP, permitiéndole enfocarse en lo que realmente importa: su
                    negocio.
                </p>
            </div>
            <!-- Column 3: Proceso -->
            <div class="bento-card">
                <i class="lni lni-spinner-2-sacle"
                    style="font-size: 2.5rem; color: var(--ardo-primary); margin-bottom: 1.5rem; display: block;"></i>
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">Proceso</h3>
                <p style="color: var(--ardo-text-muted); font-size: 1rem; line-height: 1.6;">
                    La excelencia no es un acto, es un hábito. Implementamos metodologías ágiles y estándares
                    internacionales en cada despliegue, asegurando resultados predecibles, seguros y escalables.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Innovation Section (Split Layout) -->
<!-- Innovation Section (Split Layout) -->
<section style="padding: 100px 0; background: #fff;">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
            <div>
                <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">EVOLUCIÓN</p>
                <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">
                    Innovación continua: <br> De Desarrolladores a <span class="text-cyan">Carrier Digital</span>.
                </h2>
                <div style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                    <p style="margin-bottom: 1.5rem;">Lo que comenzó en 2018 como una <strong>Empresa de
                            Tecnología</strong> enfocada en desarrollo, ha evolucionado para convertirse en un
                        ecosistema integral de soluciones.</p>
                    <p>Hoy, no solo escribimos código; desplegamos infraestructuras críticas, diseñamos arquitecturas
                        Cloud y conectamos empresas como un <strong>Carrier de Telecomunicaciones</strong> de nueva
                        generación.</p>
                </div>
                <a href="<?php echo $basePath; ?>servicios-administrados/" class="btn-primary">
                    Explore nuestras capacidades <i class="lni lni-arrow-right"></i>
                </a>
            </div>
            <div class="hero-visual">
                <div class="bento-card" style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px;">
                    <img src="../images/team-support.png" alt="Innovación Tecnológica ARDO"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Impact Section -->
<!-- Impact Section -->
<section style="padding: 40px 20px;">
    <div class="container">
        <div
            style="background: var(--ardo-midnight); border-radius: 2rem; padding: 4rem; position: relative; overflow: hidden; color: white; display: flex; align-items: center; justify-content: space-between;">
            <div style="position: relative; z-index: 2; max-width: 700px;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">NUESTRO IMPACTO
                </p>
                <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem; color: white;">
                    Eliminamos ineficiencias tecnológicas para maximizar su rentabilidad.
                </h2>
                <a href="https://wa.me/524429803200?text=%C2%A1Hola%2C+me+interesan+los+servicios+de+ARDO+Technology%21"
                    target="_blank" class="btn-primary">
                    Hablemos de Negocios <i class="lni lni-whatsapp"></i>
                </a>
            </div>
            <!-- Decorative Scan Line -->
            <div class="scan-line" style="opacity: 0.2;"></div>
            <div
                style="position: absolute; right: -50px; bottom: -50px; opacity: 0.1; font-size: 200px; color: var(--ardo-primary);">
                <i class="lni lni-stats-up"></i>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<?php include '../includes/trusted.php'; ?>

<?php include '../includes/partners.php'; ?>


<!-- Timeline Intro Section -->
<!-- Timeline Intro Section -->
<section style="padding: 100px 0 20px; background: #fff; text-align: center;">
    <div class="container">
        <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">TRAYECTORIA</p>
        <h2 class="text-huge"
            style="font-size: 3.5rem; color: var(--ardo-midnight); margin-bottom: 1.5rem; line-height: 1.1;">
            Construyendo el futuro<br><span class="text-cyan">paso a paso</span>.
        </h2>
        <p style="color: var(--ardo-text-muted); font-size: 1.2rem; margin-bottom: 0;">De una startup local a un
            operador tecnológico regional.</p>
    </div>
</section>

<!-- History/Mission Timeline Section -->
<section class="about-timeline-section" style="padding: 60px 0 100px; background: #fff; position: relative;">
    <div class="container" style="position: relative;">
        <!-- Central Line -->
        <div class="timeline-line"
            style="position: absolute; left: 50%; top: 0; bottom: 0; width: 1px; background: #e0e0e0; transform: translateX(-50%); z-index: 1;">
        </div>

        <!-- Start Dot -->
        <div class="timeline-dot-start"
            style="position: absolute; left: 50%; top: 0; width: 20px; height: 20px; background: #032642; border-radius: 50%; transform: translateX(-50%); z-index: 2; border: 4px solid #fff; box-shadow: 0 0 0 1px #e0e0e0;">
        </div>

        <!-- Item 1: El Inicio (Left Image, Right Text) -->
        <div class="timeline-item"
            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 60px; position: relative; z-index: 2;">
            <!-- Left: Image -->
            <div class="timeline-media" style="width: 45%; padding-right: 40px; text-align: right;">
                <div
                    style="width: 100%; height: 300px; background: #f0f0f0; border-radius: 8px; overflow: hidden; display: inline-block; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <img src="../images/inicio.jpg" alt="El Inicio de ARDO"
                        style="width: 100%; height: 100%; object-fit: cover; filter: grayscale(100%);">
                </div>
            </div>

            <!-- Center Dot -->
            <div class="timeline-dot"
                style="position: absolute; left: 50%; width: 14px; height: 14px; background: #fff; border: 2px solid #032642; border-radius: 50%; transform: translateX(-50%); z-index: 3;">
                <div
                    style="position: absolute; top: 50%; left: 50%; width: 4px; height: 4px; background: #032642; border-radius: 50%; transform: translate(-50%, -50%);">
                </div>
            </div>

            <!-- Right: Text -->
            <div class="timeline-content" style="width: 45%; padding-left: 60px;">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #032642; margin-bottom: 20px;">El Inicio</h2>
                <p style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                    Nacimos en 2018 con una visión clara: democratizar el acceso a software de alta calidad para las
                    PyMEs mexicanas, comenzando nuestro viaje como desarrolladores a la medida.
                </p>
            </div>
        </div>

        <!-- Item 2: Misión (Left Text, Right Image) -->
        <div class="timeline-item"
            style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 2;">
            <!-- Left: Text -->
            <div class="timeline-content" style="width: 45%; padding-right: 60px; text-align: right;">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #032642; margin-bottom: 20px;">Misión</h2>
                <p style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                    Nuestra misión evolucionó hacia la <strong>Transformación Digital</strong> integral. Ayudamos a las
                    empresas a escalar mediante la convergencia de Software, Telecomunicaciones y Cloud Computing.
                </p>
            </div>

            <!-- Center Dot -->
            <div class="timeline-dot"
                style="position: absolute; left: 50%; width: 14px; height: 14px; background: #fff; border: 2px solid #032642; border-radius: 50%; transform: translateX(-50%); z-index: 3;">
                <div
                    style="position: absolute; top: 50%; left: 50%; width: 4px; height: 4px; background: #032642; border-radius: 50%; transform: translate(-50%, -50%);">
                </div>
            </div>

            <!-- Right: Image -->
            <div class="timeline-media" style="width: 45%; padding-left: 40px; text-align: left;">
                <div
                    style="width: 100%; height: 350px; background: #f0f0f0; border-radius: 8px; overflow: hidden; display: inline-block; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <img src="../images/cdmx.jpg" alt="Nuestra Misión"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Item 3: Internacionalización (Left Image, Right Text) -->
        <div class="timeline-item"
            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 60px; position: relative; z-index: 2;">
            <!-- Left: Image -->
            <div class="timeline-media" style="width: 45%; padding-right: 40px; text-align: right;">
                <div
                    style="width: 100%; height: 300px; background: #f0f0f0; border-radius: 8px; overflow: hidden; display: inline-block; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <img src="../images/usa.jpg" alt="Expansión Internacional"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            <!-- Center Dot -->
            <div class="timeline-dot"
                style="position: absolute; left: 50%; width: 14px; height: 14px; background: #fff; border: 2px solid #032642; border-radius: 50%; transform: translateX(-50%); z-index: 3;">
                <div
                    style="position: absolute; top: 50%; left: 50%; width: 4px; height: 4px; background: #032642; border-radius: 50%; transform: translate(-50%, -50%);">
                </div>
            </div>

            <!-- Right: Text -->
            <div class="timeline-content" style="width: 45%; padding-left: 60px;">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #032642; margin-bottom: 20px;">
                    Internacionalización</h2>
                <p style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                    En 2019 cruzamos fronteras, estableciendo operaciones en Miami, FL. para servir como puente
                    tecnológico entre Latinoamérica y el mercado global.
                </p>
            </div>
        </div>

        <!-- Item 4: Crecimiento (Left Text, Right Image) -->
        <div class="timeline-item"
            style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 60px; position: relative; z-index: 2;">
            <!-- Left: Text -->
            <div class="timeline-content" style="width: 45%; padding-right: 60px; text-align: right;">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #032642; margin-bottom: 20px;">Consolidación</h2>
                <p style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                    Para 2023, nos consolidamos como <strong>Carrier de Telecomunicaciones</strong> con infraestructura
                    Cloud propia. Cubrimos el 90% del territorio en México, brindando conectividad robusta y confiable.
                </p>
            </div>

            <!-- Center Dot -->
            <div class="timeline-dot"
                style="position: absolute; left: 50%; width: 14px; height: 14px; background: #fff; border: 2px solid #032642; border-radius: 50%; transform: translateX(-50%); z-index: 3;">
                <div
                    style="position: absolute; top: 50%; left: 50%; width: 4px; height: 4px; background: #032642; border-radius: 50%; transform: translate(-50%, -50%);">
                </div>
            </div>

            <!-- Right: Image -->
            <div class="timeline-media" style="width: 45%; padding-left: 40px; text-align: left;">
                <div
                    style="width: 100%; height: 350px; background: #f0f0f0; border-radius: 8px; overflow: hidden; display: inline-block; box-shadow: 0 10px 30px rgba(0,0,0,0.08);">
                    <img src="../images/consolidacion.jpg" alt="Crecimiento Sostenido"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>

        <!-- Item 5: Digitalización Total (Left Image, Right Text) -->
        <div class="timeline-item"
            style="display: flex; align-items: center; justify-content: space-between; position: relative; z-index: 2;">
            <!-- Left: Image -->
            <div class="timeline-media" style="width: 45%; padding-right: 40px; text-align: right;">
                <div
                    style="width: 100%; height: 300px; background: #f0f0f0; border-radius: 8px; overflow: hidden; display: inline-block; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                    <img src="../images/carrier.jpg" alt="Carrier Digital"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>

            <!-- Center Dot -->
            <div class="timeline-dot"
                style="position: absolute; left: 50%; width: 14px; height: 14px; background: #fff; border: 2px solid #032642; border-radius: 50%; transform: translateX(-50%); z-index: 3;">
                <div
                    style="position: absolute; top: 50%; left: 50%; width: 4px; height: 4px; background: #032642; border-radius: 50%; transform: translate(-50%, -50%);">
                </div>
            </div>

            <!-- Right: Text -->
            <div class="timeline-content" style="width: 45%; padding-left: 60px;">
                <h2 style="font-size: 2.2rem; font-weight: 800; color: #032642; margin-bottom: 20px;">Carrier 100%
                    Digital</h2>
                <p style="font-size: 1.1rem; color: #555; line-height: 1.6;">
                    2025 marca un hito. Hemos digitalizado el 100% de nuestros procesos. Somos el primer Carrier Digital
                    nativo, ofreciendo agilidad y eficiencia sin precedentes en la industria.
                </p>
            </div>
        </div>


    </div>

</section>

<style>
    @media (max-width: 1024px) {
        .hero-internal {
            padding: 60px 0 !important;
        }

        .hero-internal .container>div:first-child {
            padding: 0 !important;
        }

        /* Stack bento grid columns */
        .bento-grid {
            grid-template-columns: 1fr !important;
        }

        /* Timeline Responsiveness */
        .timeline-line,
        .timeline-dot-start,
        .timeline-dot {
            display: none !important;
        }

        .timeline-item {
            flex-direction: column !important;
            margin-bottom: 60px !important;
            text-align: left !important;
            align-items: flex-start !important;
        }

        .timeline-media,
        .timeline-content {
            width: 100% !important;
            padding: 0 !important;
            text-align: left !important;
        }

        .timeline-media {
            margin-bottom: 2rem !important;
            order: -1 !important;
            /* Image always above text */
        }

        .timeline-media div {
            height: 250px !important;
        }

        /* Innovation Section Stack */
        section>.container>div[style*="display: grid"] {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }

        .hero-visual .bento-card {
            height: 350px !important;
        }

        /* Impact Section Refinement */
        div[style*="background: var(--ardo-midnight)"] {
            flex-direction: column !important;
            padding: 3rem 2rem !important;
            text-align: center !important;
        }

        div[style*="background: var(--ardo-midnight)"] h2 {
            font-size: 2rem !important;
        }

        div[style*="background: var(--ardo-midnight)"] a {
            width: 100% !important;
        }
    }
</style>

<?php
include '../includes/contact.php';
$showCityLinks = true;
include '../includes/footer.php';
?>