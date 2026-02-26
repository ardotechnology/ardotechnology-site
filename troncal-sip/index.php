<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('troncal-sip', [
    'city' => 'Querétaro',
    'image_path' => '../images/sip.mp4'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Video Hero -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline
            poster="https://images.unsplash.com/photo-1558494949-efc5e60c94ef?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/3141207/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">TRONCALES SIP (SIP
                    TRUNKING)</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Conectividad VoIP <br> <span class="text-cyan">de Alta Disponibilidad</span>.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    La potencia que su <strong>Conmutador IP</strong> necesita. Conecte su negocio al mundo con nuestras
                    <strong>Troncales SIP</strong> sin importar si usa Asterisk, 3CX, VitalPBX o Yeastar. <br>Calidad de
                    voz
                    Premium y soporte local en Querétaro.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20me%20gustar%C3%ADa%20cotizar%20Troncales%20SIP%20para%20mi%20empresa."
                    target="_blank" class="btn-primary">Probar Troncal Gratis <i class="lni lni-network"></i></a>
            </div>
        </div>
    </section>

    <!-- Info Section: Split Content -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Carrier Grade</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Seguridad y <span
                            class="text-cyan">Continuidad</span> <br>para su Telefonía.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">En el entorno crítico de hoy, una llamada perdida es un
                            cliente perdido. Nuestras <strong>Troncales SIP</strong> ofrecen la robustez que su empresa
                            demanda, funcionando como un enlace <strong>Principal</strong> o como una solución de
                            <strong>Failover (Respaldo)</strong> automático.
                        </p>
                        <p>Optimice sus costos operativos migrando de líneas E1/PRI obsoletas a nuestra tecnología
                            <strong>VoIP Empresarial</strong>. Gracias a nuestra conexión con carriers
                            Tier-1 en México, garantizamos estabilidad y baja latencia.
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Rutas Tier-1</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Rutas premium
                                que aseguran CLI correcto y máxima calidad de audio
                                (G.711/G.729).</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Bursting Elástico</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Aumente su
                                capacidad de llamadas simultáneas según la demanda de su Call Center en minutos.</p>
                        </div>
                    </div>
                </div>
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/siptrunk.jpg" alt="SIP Trunking Reliability"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">Signal
                                Health: <span style="color: #FFFFFF;">Encrypted TLS</span></p>
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
                    <img src="../images/team-support.png" alt="VoIP Support Team"
                        style="width: 100%; border-radius: 2rem;">
                </div>
                <div>
                    <h2 class="text-huge" style="font-size: 2.8rem; margin-bottom: 2rem;">CONOCEMOS <span
                            class="text-cyan">Asterisk, 3CX,YEASTAR Y MÁS</span>.</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8;">
                        Hablamos su idioma técnico. Nuestro equipo de ingenieros en Querétaro son expertos en la
                        configuración segura de <strong>Troncales SIP</strong> en las plataformas PBX líderes del
                        mercado. Lo asistimos desde la configuración del firewall hasta las pruebas de audio (RTP).
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Capabilities: Knowledge Grid -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Especificaciones
                    Técnicas</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Especificaciones de <span class="text-cyan">Grado
                        Carrier</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Tecnología sólida para comunicaciones críticas y Call Centers.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-volume-high"></i></div>
                    <h3>Codecs HD</h3>
                    <p>Soporte completo para G.711 u/a law (calidad toll) y G.729 para ancho de banda optimizado.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>Seguridad TLS/SRTP</h3>
                    <p>Encriptación de señalización y flujos de media para proteger sus conversaciones corporativas.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-microsoft-teams"></i></div>
                    <h3>Compatibilidad PBX</h3>
                    <p>Interoperabilidad probada con Grandstream, Yeastar, Issabel, FreePBX, VitalPBX y Microsoft Teams.
                    </p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>CLI Garantizado</h3>
                    <p>Presentación correcta de su número en la pantalla del cliente, mejorando sus tasas de contacto
                        (ASR).</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-spinner-2-sacle"></i></div>
                    <h3>Anti-Fraude VoIP</h3>
                    <p>Monitoreo 24/7 con algoritmos inteligentes para detectar y bloquear patrones de tráfico
                        inusuales.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-bar-chart-4"></i></div>
                    <h3>Portal CDR Real-time</h3>
                    <p>Control total. Acceda a sus registros de llamadas (CDRs) y administre sus DIDs en tiempo real.
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