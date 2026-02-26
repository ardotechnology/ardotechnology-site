<?php
$pageTitle = "Soporte Técnico | ARDO Technology";
$pageDescription = "Centro de Soporte Técnico de ARDO Technology.";
$basePath = '../';
include '../includes/header.php';
?>


<section class="hero-internal" style="background: #fff; padding: 60px 0 60px;">
    <div class="container" style="text-align: center;">
        <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">CENTRO DE AYUDA</p>
        <h1 class="text-huge"
            style="color: var(--ardo-midnight); font-size: clamp(3rem, 6vw, 5rem); margin-bottom: 1.5rem; line-height: 1;">
            Soporte <span class="text-cyan">Técnico</span>.
        </h1>
        <p
            style="font-size: 1.25rem; color: var(--ardo-text-muted); max-width: 800px; margin: 0 auto 4rem; line-height: 1.6;">
            Nos esforzamos por hacer que el soporte sea lo más ágil y organizado posible. Utilice los siguientes canales
            exclusivamente para incidencias técnicas.
        </p>

        <div class="bento-grid"
            style="grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; max-width: 1000px; margin: 0 auto;">
            <!-- Phone Support -->
            <div class="bento-card" style="text-align: left; padding: 2rem;">
                <i class="lni lni-phone" style="font-size: 2rem; color: var(--ardo-primary); margin-bottom: 1rem;"></i>
                <h3
                    style="font-size: 0.9rem; font-weight: 700; color: var(--ardo-text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                    Línea Directa</h3>
                <a href="tel:4429803200"
                    style="font-size: 1.5rem; font-weight: 800; color: var(--ardo-midnight); text-decoration: none;">+52
                    442 980 3200</a>
            </div>

            <!-- Email Support -->
            <div class="bento-card" style="text-align: left; padding: 2rem;">
                <i class="lni lni-envelope-1"
                    style="font-size: 2rem; color: var(--ardo-primary); margin-bottom: 1rem;"></i>
                <h3
                    style="font-size: 0.9rem; font-weight: 700; color: var(--ardo-text-muted); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                    Correo Electrónico</h3>
                <a href="mailto:soporte@ardo.technology"
                    style="font-size: 1.25rem; font-weight: 800; color: var(--ardo-midnight); text-decoration: none;">soporte@ardo.technology</a>
            </div>

            <!-- WhatsApp Support -->
            <div class="bento-card"
                style="text-align: left; padding: 2rem; background: var(--ardo-midnight); border-color: var(--ardo-midnight);">
                <i class="lni lni-whatsapp" style="font-size: 2rem; color: #fff; margin-bottom: 1rem;"></i>
                <h3
                    style="font-size: 0.9rem; font-weight: 700; color: rgba(255,255,255,0.7); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 0.05em;">
                    Chat 24/7</h3>
                <a href="https://wa.me/524429803200" target="_blank"
                    style="font-size: 1.5rem; font-weight: 800; color: #fff; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    Iniciar Chat <i class="lni lni-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Placeholder for Contact Form or additional content if requested later, keeping it clean for now as per image -->


<section style="padding: 0 0 100px; background: #fff;">
    <div class="container">
        <div class="bento-card"
            style="padding: 0; display: flex; box-shadow: var(--ardo-shadow-lg); overflow: hidden; background: linear-gradient(135deg, #f8fafb 0%, #e2e8f0 100%);">

            <!-- Left: Ticket Form -->
            <div style="flex: 2; padding: 3rem; background: #fff;">
                <div style="margin-bottom: 2rem;">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">TICKETS</p>
                    <h2 style="font-size: 2rem; font-weight: 800; color: var(--ardo-midnight);">Abrir Solicitud</h2>
                </div>

                <iframe src="https://aoi.ardo.technology/forms/ticket" frameborder="0"
                    style="width: 100%; height: 800px; border: none; border-radius: 1rem; background: #fff;"
                    allowfullscreen></iframe>
            </div>

            <!-- Right: Stats -->
            <div
                style="flex: 1; padding: 3rem; border-left: 1px solid var(--ardo-border); background: rgba(255,255,255,0.5);">
                <!-- Clutch -->
                <div style="border-bottom: 1px solid var(--ardo-border); padding-bottom: 2rem; margin-bottom: 2rem;">
                    <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 0.5rem;">RESEÑAS EN CLUTCH</p>
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <span style="font-weight: 900; font-size: 1.5rem; color: var(--ardo-midnight);">4.9</span>
                        <div style="display: flex; gap: 2px;">
                            <i class="lni lni-star-fill" style="color: #FF5A5F;"></i>
                            <i class="lni lni-star-fill" style="color: #FF5A5F;"></i>
                            <i class="lni lni-star-fill" style="color: #FF5A5F;"></i>
                            <i class="lni lni-star-fill" style="color: #FF5A5F;"></i>
                            <i class="lni lni-star-fill" style="color: #FF5A5F;"></i>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div style="display: flex; flex-direction: column; gap: 2.5rem;">
                    <div>
                        <span class="text-huge"
                            style="display: block; font-size: 3.5rem; color: var(--ardo-midnight); margin-bottom: 0.5rem;">8<span
                                style="font-size: 1.5rem; color: var(--ardo-text-muted);">+</span></span>
                        <span style="font-weight: 700; color: var(--ardo-text-muted); font-size: 1rem;">Años de
                            Experiencia</span>
                    </div>

                    <div>
                        <span class="text-huge"
                            style="display: block; font-size: 3.5rem; color: var(--ardo-midnight); margin-bottom: 0.5rem;">99<span
                                style="font-size: 1.5rem; color: var(--ardo-text-muted);">%</span></span>
                        <span style="font-weight: 700; color: var(--ardo-text-muted); font-size: 1rem;">Satisfacción
                            (CSAT)</span>
                    </div>

                    <div>
                        <span class="text-huge"
                            style="display: block; font-size: 3.5rem; color: var(--ardo-midnight); margin-bottom: 0.5rem;">7<span
                                style="font-size: 1.5rem; color: var(--ardo-text-muted);">+</span></span>
                        <span style="font-weight: 700; color: var(--ardo-text-muted); font-size: 1rem;">Países
                            Operando</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<?php
$showCityLinks = true;
include '../includes/footer.php';
?>