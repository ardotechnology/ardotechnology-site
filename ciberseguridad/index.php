<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('ciberseguridad', [
    'city' => 'México',
    'image_path' => '../images/cybersecurity.jpg'
]);

$basePath = '../';
include '../includes/header.php';
?>

<div class="internal-page-redesign">

    <!-- Premium Hero Section -->
    <section class="hero-internal"
        style="position: relative; height: 70vh; min-height: 500px; display: flex; align-items: center; overflow: hidden; background: var(--ardo-midnight);">
        <video autoplay muted loop playsinline
            poster="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=1600&h=900&fit=crop"
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.4;">
            <source src="https://www.pexels.com/download/video/6963744/" type="video/mp4">
        </video>
        <div class="scan-line" style="opacity: 0.1;"></div>

        <div class="container" style="position: relative; z-index: 10;">
            <div class="glass-panel"
                style="max-width: 900px; padding: 3rem; border-radius: 2rem; background: rgba(255,255,255,0.02); color: white; border-color: rgba(255,255,255,0.05); backdrop-filter: blur(3px); -webkit-backdrop-filter: blur(3px);">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">CIBERSEGURIDAD
                    EMPRESARIAL</p>
                <h1 class="text-huge"
                    style="color: white; font-size: clamp(2rem, 4vw, 2.8rem); margin-bottom: 1.5rem; line-height: 1.1;">
                    Protección DNS con <br> <span class="text-cyan">FlashStart AI</span>.</h1>
                <p
                    style="color: rgba(255,255,255,0.7); font-size: 1.05rem; line-height: 1.6; max-width: 750px; margin-bottom: 2rem;">
                    Solución de <strong>seguridad informática</strong> con filtrado DNS inteligente que bloquea
                    <strong>malware, ransomware, phishing</strong> y amenazas cibernéticas antes de que lleguen a tu
                    red. <br>Protección con IA y precisión del <strong>92.5%</strong>.
                </p>
                <a href="https://wa.me/524429803200?text=Hola,%20quiero%20información%20sobre%20FlashStart%20DNS"
                    target="_blank" class="btn-primary">Solicitar Demostración <i class="lni lni-shield-2"></i></a>
            </div>
        </div>
    </section>

    <!-- Benefits Grid Section -->
    <section style="padding: 120px 0; background: #fff;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Beneficios Clave
                </p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Ciberseguridad <span class="text-cyan">Avanzada</span>
                    para tu Empresa.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Una solución completa que protege contra amenazas, optimiza tu red y simplifica la gestión de
                    seguridad informática.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem;">
                <!-- Benefit 1: Security -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>Protección Avanzada</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Malware y Ransomware</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Phishing y Robo de Datos</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> DDoS y Botnets</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> IA con 92.5% de
                            precisión</li>
                    </ul>
                </div>

                <!-- Benefit 2: Performance -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-telephone-3"></i></div>
                    <h3>Alto Rendimiento</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Red global Anycast</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Latencia casi nula</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> DNS más rápido del mundo</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> Disponibilidad
                            24/7</li>
                    </ul>
                </div>

                <!-- Benefit 3: Management -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-database-2"></i></div>
                    <h3>Gestión Simplificada</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> 100% Cloud</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Dashboard centralizado</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Integración Active Directory</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> Reportes en
                            tiempo real</li>
                    </ul>
                </div>

                <!-- Benefit 4: Content Control -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-vector-nodes-6"></i></div>
                    <h3>Control de Contenido</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> 200 categorías de sitios</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Bloqueo de contenido explícito</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Geoblocking de países</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> Políticas por
                            usuario/grupo</li>
                    </ul>
                </div>

                <!-- Benefit 5: Productivity -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-target-user"></i></div>
                    <h3>Productividad</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Bloqueo redes sociales</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Control de streaming</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Horarios personalizados</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> App Blocker</li>
                    </ul>
                </div>

                <!-- Benefit 6: Cost Savings -->
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>Ahorro y Eficiencia</h3>
                    <ul style="text-align: left; list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Sin inversión inicial</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Cero mantenimiento</li>
                        <li style="margin-bottom: 0.5rem;"><i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary);"></i> Actualizaciones automáticas</li>
                        <li><i class="lni lni-check-square-2" style="color: var(--ardo-primary);"></i> Reducción de
                            soporte</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Split Content: AI Protection -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
                <div class="hero-visual">
                    <div class="bento-card"
                        style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; position: relative;">
                        <img src="../images/team-support.png" alt="AI Protection"
                            style="width: 100%; height: 100%; object-fit: cover; opacity: 0.9;">
                        <div class="glass-panel"
                            style="position: absolute; bottom: 20px; left: 20px; right: 20px; padding: 1.5rem; border-radius: 1rem;">
                            <p class="text-mono-label" style="font-size: 12px; color: var(--ardo-midnight);">IA Status:
                                <span style="color: #FFFFFF;">Active & Learning</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1rem;">Inteligencia Artificial</p>
                    <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Protección <span
                            class="text-cyan">Predictiva</span> <br>con IA Avanzada.
                    </h2>
                    <div
                        style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; margin-bottom: 2rem;">
                        <p style="margin-bottom: 1.5rem;">FlashStart utiliza <strong>Inteligencia Artificial</strong>
                            para escanear y categorizar millones de sitios web diariamente. Nuestro motor de IA detecta
                            amenazas emergentes con una precisión del <strong>92.5%</strong>, bloqueando ataques antes
                            de que lleguen a tu red.
                        </p>
                        <p>La red global <strong>Anycast</strong> distribuida en múltiples continentes garantiza
                            latencia casi nula y disponibilidad 24/7, protegiendo tu empresa sin afectar el rendimiento.
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-top: 3rem;">
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Machine Learning</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">Análisis
                                continuo de patrones y comportamientos maliciosos.</p>
                        </div>
                        <div class="bento-card" style="padding: 1.5rem; border-radius: 1.25rem;">
                            <i class="lni lni-check-square-2"
                                style="color: var(--ardo-primary); margin-bottom: 1rem; display: block;"></i>
                            <h4
                                style="font-size: 14px; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                                Red Anycast</h4>
                            <p style="font-size: 12px; color: var(--ardo-text-muted); line-height: 1.5;">
                                Infraestructura distribuida para máxima velocidad y resiliencia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Grid -->
    <section style="padding: 100px 0; background: #fff;">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Funciones
                    Principales</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Herramientas de <span
                        class="text-cyan">Seguridad</span> Avanzada.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    Protección integral para gestionar el acceso a internet de tu organización.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>Anti-Malware</h3>
                    <p>Bloqueo proactivo de malware, ransomware y botnets.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-target-user"></i></div>
                    <h3>Anti-Phishing</h3>
                    <p>Protección contra phishing, spoofing e ingeniería social.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-vector-nodes-6"></i></div>
                    <h3>200 Categorías</h3>
                    <p>Filtrado granular por categorías de contenido web.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-database-2"></i></div>
                    <h3>Geoblocking</h3>
                    <p>Bloqueo de países de alto riesgo cibernético.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-telephone-3"></i></div>
                    <h3>Safe Search</h3>
                    <p>Búsqueda segura forzada en Google, Bing y YouTube.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-phone"></i></div>
                    <h3>ClientShield</h3>
                    <p>Protección para Windows, Mac, Android, iOS y Chromebook.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-check-square-2"></i></div>
                    <h3>Reportes</h3>
                    <p>Informes históricos e instantáneos con visibilidad completa.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-shield-2"></i></div>
                    <h3>App Blocker</h3>
                    <p>Bloqueo de aplicaciones con control por horarios.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Use Cases Section -->
    <section style="padding: 100px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="text-align: center; margin-bottom: 5rem;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Casos de Uso</p>
                <h2 class="text-huge" style="font-size: 3.5rem;">Soluciones para <span class="text-cyan">Todos los
                        Sectores</span>.</h2>
                <p style="color: var(--ardo-text-muted); max-width: 700px; margin: 2rem auto 0; font-size: 1.1rem;">
                    FlashStart se adapta a las necesidades de diferentes organizaciones.</p>
            </div>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem;">
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Empresas</h3>
                    <p>Protección contra amenazas y control de productividad.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Escuelas K-12</h3>
                    <p>Protección de menores y cumplimiento normativo.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>ISPs</h3>
                    <p>Servicio de valor agregado para clientes.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>MSPs</h3>
                    <p>Solución escalable multi-tenant.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Gobierno</h3>
                    <p>Seguridad integral para entidades públicas.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Retail</h3>
                    <p>Protección de redes en puntos de venta.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Hogares</h3>
                    <p>Control parental y navegación segura.</p>
                </div>
                <div class="service-card">
                    <div class="service-card-icon"><i class="lni lni-arrow-right-circle"></i></div>
                    <h3>Trabajo Remoto</h3>
                    <p>Protección de dispositivos fuera de oficina.</p>
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