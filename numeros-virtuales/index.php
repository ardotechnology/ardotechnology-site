<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('numeros-virtuales', [
    'city' => 'Querétaro',
    'image_path' => '../images/numbers.mp4'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline poster="https://www.pexels.com/download/video/30163656/"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/30163656/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">NÚMEROS VIRTUALES
                    DID</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Presencia Local <br> <span class="text-cyan">Inmediata</span> en todo México.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Expanda su negocio sin abrir oficinas físicas. Adquiera <strong>Números Virtuales (DIDs)</strong> de
                    cualquier ciudad y active su <strong>Portabilidad Numérica</strong> hoy mismo con ARDO Technology.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20quisiera%20consultar%20cobertura%20de%20N%C3%BAmeros%20Virtuales."
                    target="_blank" class="btn-primary">Consultar Cobertura DID <i class="lni lni-whatsapp"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Global Presence</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Sea local, donde <br>quiera que
                        <span class="text-cyan">esté</span> su negocio.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">La confianza empieza con un número local. Con nuestros
                            <strong>Números Virtuales (DIDs)</strong>, su empresa puede tener presencia telefónica con
                            lada de Monterrey, Guadalajara, CDMX o Cancún, gestionando todas las llamadas centralizadas.
                        </p>
                        <p>Como Carrier de Voz interconectado, garantizamos la <strong>Portabilidad Numérica</strong>
                            más rápida del mercado. Traiga sus líneas actuales de Telmex, Izzi o Totalplay sin
                            complicaciones administrativas.</p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Lada Sin Costo (800)</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Proyecte una
                                imagen nacional eliminando barreras de contacto. Ideal para atención al cliente.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Activación Express</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Aprovisionamos
                                sus DIDs y Troncales SIP en minutos para que empiece a recibir llamadas de inmediato.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/did.jpg" alt="Virtual Number Infrastructure"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">Node
                                Sync: <span style="color: #FFFFFF;">DID Active</span></p>
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
                    <img src="../images/team-support.png" alt="Portability Support Team"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">Trámites <span
                            class="text-cyan">simplificados</span>, gestión experta.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Olvídese de la burocracia de los operadores tradicionales. En ARDO Technology, nuestro equipo
                        especializado se encarga de todos los aspectos técnicos y administrativos de su
                        <strong>telefonía virtual</strong>. Desde el enrutamiento inteligente hasta la gestión de su
                        portabilidad, aseguramos continuidad total.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Funcionalidades DID
                </p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Potencia para su <span
                        class="text-cyan">Comunicación</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Funcionalidades avanzadas de VoIP para maximizar cada interacción.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>Canales Ilimitados</h3>
                    <p>Olvídese del tono de ocupado. Reciba múltiples llamadas simultáneas en su número DID sin perder
                        ventas.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-volume-high"></i></div>
                    <h3>Audio HD</h3>
                    <p>Rutas de voz directas y premium que aseguran claridad cristalina y latencia mínima en cada
                        conversación.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-globe-1"></i></div>
                    <h3>DIDs Mundiales</h3>
                    <p>Expanda su mercado globalmente: números virtuales de USA, Canadá, Europa y Latam con activación
                        rápida.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-route-1"></i></div>
                    <h3>Enrutamiento Pro</h3>
                    <p>Dirija llamadas por horario, región geográfica o disponibilidad de agentes para optimizar su
                        atención.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-message-2"></i></div>
                    <h3>SMS Habilitado</h3>
                    <p>Conecte mejor. Capacidad para enviar y recibir mensajes de texto (SMS) directamente en sus
                        números de negocio.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-whatsapp"></i></div>
                    <h3>Interoperabilidad</h3>
                    <p>Compatible con cualquier conmutador IP (Asterisk, 3CX, Grandstream) o plataformas de Cloud PBX.
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