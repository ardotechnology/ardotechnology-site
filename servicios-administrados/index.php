<?php
// Dynamic SEO System Initialization
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('servicios-administrados', [
    'city' => 'Querétaro',
    'image_path' => '../images/it-experts.png'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline
            poster="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/6804123/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">OUTSOURCING Y
                    GESTIÓN TI</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Servicios Administrados y <br> <span class="text-cyan">Equipos de TI</span> en Querétaro.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Garantice la continuidad operativa de su empresa con un <strong>Soporte Técnico Empresarial</strong>
                    de clase mundial. Gestión proactiva de infraestructura, servidores y redes sin la carga
                    administrativa de personal interno.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20me%20interesa%20contratar%20sus%20Servicios%20Administrados."
                    target="_blank" class="btn-primary">Solicitar Consultoría Gratuita <i
                        class="lni lni-whatsapp"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Managed Services</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Su negocio crece. <br>Nosotros
                        <span class="text-cyan">Blindamos</span> su Tecnología.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">En el dinámico mercado industrial del Bajío, la
                            <strong>Estabilidad Tecnológica</strong> no es un lujo, es una necesidad. A través de
                            nuestros <strong>Servicios Administrados de TI (Managed Services)</strong>, actuamos como su
                            departamento de sistemas externo, encargándonos del monitoreo 24/7 y mantenimiento
                            preventivo.
                        </p>
                        <p>Diferénciese de la competencia al externalizar su TI con ARDO Technology. Obtenga un socio
                            estratégico enfocado en la <strong>optimización de costos operativos</strong>,
                            implementación de <strong>Ciberseguridad Gestionada</strong> y la escalabilidad digital que
                            su empresa necesita para expandirse en México.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Continuidad Operativa 24/7</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Monitoreo
                                proactivo de servidores y redes críticas. Detectamos y resolvemos incidentes antes de
                                que afecten su operación.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Ciberseguridad Gestionada</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Blindaje de
                                datos corporativos contra ransomware y amenazas avanzadas. Implementación de firewalls
                                robustos.</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/it-experts.jpg" alt="TI Experts"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">Node
                                Status: <span style="color: #FFFFFF;">Active Management</span></p>
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
                    <img src="../images/team-support.png" alt="Equipo de Soporte"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Ingenieros Certificados
                        <br>listos para <span class="text-cyan">integrarse</span>.
                    </h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Más que un proveedor de soporte, somos su aliado en <strong>Transformación Digital</strong>.
                        ARDO Technology le ofrece la certeza de contar con un equipo de expertos respaldando cada
                        decisión tecnológica, asegurando que su infraestructura de TI impulse la productividad y la
                        innovación constante.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Protocolos de
                    Ingeniería</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Soluciones Integrales <br>de <span class="text-cyan">TI
                        y Consultoría</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Herramientas de monitoreo de vanguardia y personal calificado para brindar tranquilidad operativa
                    absoluta.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>Telecomunicaciones</h3>
                    <p>Gestión experta de Cloud PBX, Troncales SIP y conmutadores para una comunicación fluida.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-vector-nodes-6"></i></div>
                    <h3>Redes LAN/WAN</h3>
                    <p>Diseño de arquitectura de red, monitoreo de tráfico y optimización de conectividad empresarial.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-database-2"></i></div>
                    <h3>Infraestructura</h3>
                    <p>Configuración y mantenimiento de Switches, Routers y Access Points de alto rendimiento.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-oracle"></i></div>
                    <h3>Gestión Multi-Cloud</h3>
                    <p>Administración segura de sus servicios en AWS, Oracle Cloud o Google Cloud con monitoreo
                        constante.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-service-bell-1"></i></div>
                    <h3>Helpdesk Ágil</h3>
                    <p>Atención inmediata a usuarios finales (Nivel 1, 2 y 3) para resolver incidencias de hardware y
                        software.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-target-user"></i></div>
                    <h3>Staffing de TI</h3>
                    <p>Provisión de talento especializado y perfiles técnicos para proyectos específicos o de largo
                        plazo.</p>
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