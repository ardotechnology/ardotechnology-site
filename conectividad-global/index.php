<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('conectividad-global', [
    'city' => 'Querétaro',
    'title' => 'eSIM-as-a-Service | Conectividad Global Embedida | ARDO Technology',
    'description' => 'Integre eSIMs globales en su app o dispositivo. Cobertura en +180 países, control total vía API y soluciones de marca blanca para empresas.',
    'image_path' => '../images/airport.mp4'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline poster="../images/nosotros.jpg"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/6700091/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.05); color: white; border-color: rgba(255,255,255,0.1);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">INFRAESTRUCTURA
                    MÓVIL GLOBAL</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    eSIM-as-a-Service: <br> <span class="text-cyan">Conectividad Global</span> en su App.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Ofrezca conectividad bajo su propia marca. Acceso a <strong>650+ redes premium</strong> en
                    <strong>180+ países</strong>. Integre y aprovisione eSIMs programáticamente con nuestra API.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20me%20interesa%20conocer%20m%C3%A1s%20sobre%20su%20API%20de%20eSIM."
                    target="_blank" class="btn-primary">Documentación API <i class="lni lni-code-alt"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Embedded Connectivity</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Global, Personalizada <br>y a
                        <span class="text-cyan">Escala Enterprise</span>.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">Olvídese de los acuerdos de roaming complejos. Nuestra
                            plataforma le permite integrar conectividad celular directamente en sus productos digitales,
                            dispositivos IoT o fuerza laboral móvil.</p>
                        <p>Desarrolle nuevas fuentes de ingresos convirtiéndose en un Operador Móvil Virtual (MVNO)
                            ligero o simplemente asegure que su equipo esté siempre conectado, 100% programable.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-world"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                180+ Países</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Acceso a 650+
                                redes Tier-1 globales. Conexión automática a la mejor red disponible localmente.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-layers"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Total Marca Blanca</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Usted es dueño
                                de la relación. Personalice planes de datos y experiencia bajo su propia marca.</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/conectividad.jpg" alt="eSIM API"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">API
                                Status: <span class="text-cyan">Live & Encrypted</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Support Section -->
    <section style="padding: 100px 0; background: #fff; border-top: 1px solid var(--ardo-border);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div class="hero-visual">
                    <img src="../images/team-support.png" alt="Ingenieros eSIM"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Infraestructura <span
                            class="text-cyan">Cloud-Native</span> era 5G.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Nuestra red es privada, segura y construida para la velocidad. Al evitar el internet público
                        para el enrutamiento, garantizamos menor latencia. Contamos con Ingenieros de Soluciones listos
                        para ayudarle a diseñar su integración, de experto a experto.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Casos de Uso Globais
                </p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Casos de Uso <br><span
                        class="text-cyan">Ilimitados</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">La
                    conectividad embedida está transformando industrias enteras.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-aeroplane-1"></i></div>
                    <h3>Viajes y Turismo</h3>
                    <p>Agencias y aerolíneas pueden ofrecer planes de datos locales directamente en su app de reserva.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-dollar"></i></div>
                    <h3>Fintech y Banca</h3>
                    <p>Conectividad segura para usuarios premium, lejos de redes Wi-Fi públicas riesgosas.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-truck-delivery-1"></i></div>
                    <h3>Logística e IoT</h3>
                    <p>Gestione flotas globales con una sola SKU. Cambie de operador 'Over-the-Air' instantáneamente.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-connectdevelop"></i></div>
                    <h3>Redes Privadas LTE</h3>
                    <p>Construya su propia red celular para fábricas o campus con control total sobre el acceso.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-user-multiple-4"></i></div>
                    <h3>Marcas Digitales</h3>
                    <p>Aumente la retención ofreciendo conectividad como parte de su programa de lealtad.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-refresh-dollar-1"></i></div>
                    <h3>Resellers y MSPs</h3>
                    <p>Agregue servicios móviles a su portafolio de TI. Gestione miles de líneas desde un solo panel.
                    </p>
                </div>
            </div>
        </div>
    </section>

</div>

<?php
include '../includes/partners.php';
include '../includes/partners-cta.php';
include '../includes/contact.php';
$showCityLinks = true;
include '../includes/footer.php';
?>