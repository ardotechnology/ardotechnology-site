<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('servidores-cloud', [
    'city' => 'Querétaro',
    'image_path' => '../images/vps.mp4'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline
            poster="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/7140928/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">INFRAESTRUCTURA
                    CLOUD (VPS Y DEDICADOS)</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Potencia y Escalabilidad <br> con <span class="text-cyan">lo mejor de la nube</span>.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Lleve sus operaciones al siguiente nivel con la nube de segunda generación. ARDO Technology
                    implementa, migra y gestiona <strong>Servidores Cloud</strong> y bases de datos críticas para un
                    rendimiento superior.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20necesito%20m%C3%A1s%20informaci%C3%B3n%20sobre%20Servidores%20Cloud."
                    target="_blank" class="btn-primary">Consultar Arquitectura <i class="lni lni-cloud-network"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Protocolos de Infraestructura
                    </p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">El Futuro es Autónomo. <br>La
                        Nube es <span class="text-cyan">Oracle</span>.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">Las empresas ya no eligen entre flexibilidad y rendimiento.
                            Con <strong>Oracle Cloud Infrastructure (OCI)</strong>, obtenemos lo mejor de ambos mundos:
                            la elasticidad de los <strong>Cloud VPS</strong> y la potencia bruta de los
                            <strong>Servidores Dedicados (Bare Metal)</strong>.
                        </p>
                        <p>Deje atrás los servidores físicos obsoletos. Le ayudamos a transicionar de un modelo de
                            inversión en hardware (CAPEX) a un modelo operativo eficiente (OPEX). Sea para ERP o bases
                            de datos masivas, nuestra infraestructura crece con usted.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                OCI & DO</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Integramos en
                                un mismo lugar lo mejor de la nube, la resiliencia y confianza de OCI y la versatilidad
                                de Digital Ocean.
                            </p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Compute Standard & Flex</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Instancias
                                virtuales con procesadores de última generación. Pague solo por los cores que realmente
                                utiliza.</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/vps.jpg" alt="Oracle Cloud Experts"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">Cloud
                                Status: <span style="color: #FFFFFF;">High Performance</span></p>
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
                    <img src="../images/team-support.png" alt="Cloud Architects"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Arquitectura Cloud, <br><span
                            class="text-cyan">no solo Hosting</span>.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Migrar a la nube es más que "subir archivos". Es un proceso estratégico. Nuestro equipo de
                        <strong>Arquitectos Certificados </strong> diseña su topología de red, define
                        políticas de seguridad y establece planes de Recuperación ante Desastres (DR).
                        Transformamos su infraestructura legacy en un entorno resiliente.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Ecosistema Cloud OCI
                </p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Dominio Total <br>del <span
                        class="text-cyan">Ecosistema Cloud</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Soluciones empresariales complejas, simplificadas para su operación diaria.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-docker"></i></div>
                    <h3>DIGITAL OCEAN</h3>
                    <p>Integración con DigitalOcean para despliegue de contenedores y servidores. Soporte en español.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2-check"></i></div>
                    <h3>VPN Site-to-Site</h3>
                    <p>Túneles encriptados (IPsec) que conectan su oficina física con sus servidores cloud, extendiendo
                        su red local.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-vector-nodes-6"></i></div>
                    <h3>Balanceadores</h3>
                    <p>Distribución de tráfico inteligente para evitar saturaciones y garantizar que su servicio esté
                        siempre online.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>Cloud Guard</h3>
                    <p>Postura de seguridad unificada. Detectamos configuraciones erróneas y amenazas potenciales
                        proactivamente.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-database-2"></i></div>
                    <h3>Migración DB</h3>
                    <p>Movemos sus datos críticos (Oracle, MySQL, PostgreSQL) a la nube con estrategias de cero pérdida
                        de datos.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-dollar"></i></div>
                    <h3>Optimización OPEX</h3>
                    <p>Auditoría continua de recursos. Aseguramos que su factura mensual sea predecible y pague solo por
                        lo que usa.</p>
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