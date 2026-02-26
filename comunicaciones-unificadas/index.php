<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('comunicaciones-unificadas', [
    'city' => 'Querétaro',
    'image_path' => '../images/ucaas.mp4'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline
            poster="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/4629173/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">COMUNICACIONES
                    UNIFICADAS (UCaaS)</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Colaboración Empresarial <br> <span class="text-cyan">Sin Fronteras</span> en Querétaro.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    La evolución de la <strong>VoIP Empresarial</strong>. Unifique voz, video, chat y movilidad en una
                    sola plataforma Cloud PBX. Empodere el <strong>trabajo híbrido</strong> de su equipo con la
                    tecnología de ARDO UCaaS.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20quisiera%20m%C3%A1s%20informaci%C3%B3n%20sobre%20sus%20Comunicaciones%20Unificadas."
                    target="_blank" class="btn-primary">Solicitar Demo UCaaS <i class="lni lni-play"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Protocolos de Colaboración</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Más que Telefonía IP. <br>Un
                        <span class="text-cyan">Ecosistema</span> Total.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">El entorno corporativo actual exige agilidad. Las empresas
                            líderes en Querétaro y México ya no dependen de conmutadores físicos limitados. Nuestras
                            soluciones de <strong>Comunicaciones Unificadas (UCaaS)</strong> transforman su manera de
                            operar, integrando Telefonía Cloud, videoconferencias HD y mensajería corporativa.</p>
                        <p>Reduzca costos operativos eliminando hardware obsoleto. Con ARDO Technology, su
                            <strong>extensión telefónica empresarial</strong> viaja con usted en su smartphone o laptop,
                            garantizando continuidad de negocio y presencia profesional.
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Movilidad Empresarial</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Lleve su
                                oficina en el bolsillo. App nativa para iOS y Android para gestionar llamadas desde
                                cualquier lugar.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Integración CRM</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Conecte su
                                telefonía con Salesforce, Zoho o Hubspot. Automatice el registro para mejorar ventas.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/ucaas.jpg" alt="Plataforma UCaaS"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">System
                                Mode: <span style="color: #FFFFFF;">Global Sync</span></p>
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
                    <img src="../images/team-support.png" alt="Soporte UCaaS" style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Implementación <span
                            class="text-cyan">sin fricción</span>, Soporte Local.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        La migración a la nube no tiene por qué ser compleja. Nuestro equipo de ingenieros en Querétaro
                        gestiona todo el proceso, desde la portabilidad numérica hasta la configuración de su
                        <strong>Cloud PBX</strong>. Ofrecemos capacitación personalizada para asegurar que su personal
                        aproveche al máximo todas las herramientas.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Arquitectura de
                    Colaboración</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Funcionalidades de <span class="text-cyan">Clase
                        Mundial</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">Todo
                    lo que su empresa necesita para competir en la era digital.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-cloud-iot-2"></i></div>
                    <h3>Cloud PBX Avanzado</h3>
                    <p>Conmutador virtual robusto, escalable y siempre actualizado, sin inversión en hardware (CAPEX).
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-camera-movie-1"></i></div>
                    <h3>Tecnología WebRTC</h3>
                    <p>Comunicaciones de voz y video de alta calidad directamente desde el navegador web, sin apps.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-laptop-phone"></i></div>
                    <h3>Multi-Dispositivo</h3>
                    <p>Experiencia de usuario consistente en Desktop, Tablet y Móvil para productividad en movimiento.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-telephone-1"></i></div>
                    <h3>Call Center Features</h3>
                    <p>Colas de atención, grabación de llamadas y monitoreo en vivo para equipos de soporte y ventas.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-file-multiple"></i></div>
                    <h3>Fax Virtual</h3>
                    <p>Modernice el envío de documentos importantes. Reciba y envíe faxes digitales desde su correo.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-bar-chart-4"></i></div>
                    <h3>Analítica y Reportes</h3>
                    <p>Dashboards detallados para medir el rendimiento de su equipo, volumen de llamadas y niveles de
                        servicio.</p>
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