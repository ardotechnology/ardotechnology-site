<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('consultoria-ti', [
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
            poster="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/35402301/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">CONSULTORÍA
                    ESTRATÉGICA</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Consultoría de TI y <br> <span class="text-cyan">Transformación Digital</span> en Querétaro.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Modernice su negocio con una <strong>Estrategia Tecnológica</strong> sólida. Auditamos, diseñamos y
                    optimizamos su infraestructura para garantizar el éxito de su Transformación Digital.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20estoy%20interesado%20en%20una%20Consultor%C3%ADa%20de%20TI."
                    target="_blank" class="btn-primary">Solicitar Diagnóstico TI <i class="lni lni-whatsapp"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Estrategia Global</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Tecnología con <span
                            class="text-cyan">Propósito</span>. <br>Resultados Reales.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">En el competitivo mercado de Querétaro y el Bajío, la
                            tecnología debe ser su mayor ventaja competitiva. Nuestra <strong>Consultoría de TI</strong>
                            alinea sus sistemas informáticos con sus objetivos comerciales, eliminando la brecha entre
                            la operación técnica y la visión directiva.</p>
                        <p>Como especialistas en <strong>Arquitectura de Sistemas</strong> y Cloud, realizamos
                            auditorías profundas para detectar ineficiencias. Diseñamos hojas de ruta claras para la
                            adopción de Telefonía VoIP, migración a la nube y trabajo híbrido.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Auditoría de Sistemas TI</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Diagnóstico
                                integral identificando vulnerabilidades y áreas de optimización inmediata.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Estrategia Cloud</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Planificación
                                segura para migrar sus servidores a la nube minimizando riesgos operativos.</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/consulting.jpg" alt="Consulting Strategy"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">Strategic
                                Focus: <span style="color: #FFFFFF;">Digital Growth</span></p>
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
                    <img src="../images/team-support.png" alt="Asesores Tecnológicos"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Tome decisiones con <span
                            class="text-cyan">certeza financiera</span>.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Evite gastos innecesarios y proyectos fallidos. Nuestros <strong>Consultores Senior</strong> le
                        brindan el análisis técnico y financiero necesario para validar cada inversión. Desde la
                        selección de proveedores hasta la gobernanza de datos, somos su blindaje tecnológico.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid REDESIGNED -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Especialización
                    Técnica</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Especialización <br>Técnica <span
                        class="text-cyan">Avanzada</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Dominio de estándares globales para potenciar la madurez digital de su empresa.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-vector-nodes-6"></i></div>
                    <h3>Redes LAN/WAN</h3>
                    <p>Segmentación VLAN, seguridad perimetral y optimización de latencia para aplicaciones críticas.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-oracle"></i></div>
                    <h3>Consultoría Cloud</h3>
                    <p>Arquitecturas flexibles que combinan lo mejor de la nube pública y la infraestructura local.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>Ciberdefensa</h3>
                    <p>Análisis de brechas, hardening de servidores y políticas de acceso Zero Trust.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>Ingeniería de VoIP</h3>
                    <p>Implementación experta de Troncales SIP, SBCs y comunicaciones unificadas seguras.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-trend-up-1"></i></div>
                    <h3>Gerencia de Proyectos</h3>
                    <p>Metodologías ágiles para asegurar la entrega exitosa de implementaciones complejas.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-database-2"></i></div>
                    <h3>Resiliencia (BCP)</h3>
                    <p>Estrategias de Backup & Disaster Recovery para garantizar la continuidad de su operación.</p>
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