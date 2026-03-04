<?php
$pageTitle = "Responsabilidad Social | ARDO Technology";
$pageDescription = "En ARDO Technology creemos en construir un futuro mejor. Apoyamos a Ayuda en Acción México apadrinando niños para que tengan alimentación, educación y un futuro digno.";
$basePath = '../';
include '../includes/header.php';
?>

<style>
    /* ================================
       RESPONSABILIDAD SOCIAL PAGE
       ================================ */

    .rs-hero {
        background: #fff;
        padding: 80px 0 60px;
        text-align: center;
    }

    .rs-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(0, 240, 255, 0.08);
        border: 1px solid rgba(0, 240, 255, 0.3);
        color: var(--ardo-primary);
        font-size: 10px;
        font-weight: 800;
        padding: 6px 14px;
        border-radius: 4px;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        font-family: var(--font-mono);
        margin-bottom: 2rem;
    }

    .rs-badge i {
        font-size: 12px;
    }

    .rs-hero h1 {
        font-size: clamp(2.5rem, 5vw, 4.5rem);
        font-weight: 900;
        color: var(--ardo-midnight);
        line-height: 1.05;
        letter-spacing: -0.03em;
        text-transform: uppercase;
        margin-bottom: 1.5rem;
    }

    .rs-hero p.lead {
        font-size: 1.2rem;
        color: var(--ardo-text-muted);
        max-width: 650px;
        margin: 0 auto 3rem;
        line-height: 1.7;
        font-weight: 400;
    }

    /* Hero Image */
    .rs-hero-image {
        border-radius: 1.5rem;
        overflow: hidden;
        max-height: 520px;
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.1);
        position: relative;
    }

    .rs-hero-image img {
        width: 100%;
        height: 520px;
        object-fit: cover;
        display: block;
    }

    .rs-hero-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(5, 5, 5, 0.5) 0%, transparent 60%);
        display: flex;
        align-items: flex-end;
        padding: 2.5rem;
    }

    .rs-hero-image-caption {
        display: inline-block;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
        font-family: var(--font-mono);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 8px 16px;
        border-radius: 4px;
    }

    /* Commitment Section */
    .rs-commitment {
        padding: 100px 0;
        background: var(--ardo-surface, #f8f9fb);
    }

    .rs-commitment .section-label {
        font-family: var(--font-mono);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ardo-primary);
        display: block;
        margin-bottom: 1.5rem;
    }

    .rs-commitment h2 {
        font-size: clamp(2rem, 3.5vw, 3rem);
        font-weight: 900;
        color: var(--ardo-midnight);
        line-height: 1.1;
        text-transform: uppercase;
        letter-spacing: -0.03em;
        margin-bottom: 1.5rem;
    }

    .rs-commitment p {
        font-size: 1.1rem;
        color: var(--ardo-text-muted, #64748b);
        line-height: 1.75;
        margin-bottom: 1.5rem;
        max-width: 580px;
    }

    /* Pillars */
    .rs-pillars {
        padding: 0 0 100px;
        background: var(--ardo-surface, #f8f9fb);
    }

    .rs-pillar-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .rs-pillar-card {
        background: #fff;
        border: 1px solid var(--ardo-border, #E2E8F0);
        border-radius: 1rem;
        padding: 2rem;
        transition: border-color 0.2s, box-shadow 0.2s, transform 0.2s;
    }

    .rs-pillar-card:hover {
        border-color: var(--ardo-primary);
        box-shadow: 0 12px 40px rgba(0, 240, 255, 0.1);
        transform: translateY(-4px);
    }

    .rs-pillar-card i {
        font-size: 2rem;
        color: var(--ardo-primary);
        display: block;
        margin-bottom: 1.25rem;
    }

    .rs-pillar-card h3 {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--ardo-midnight);
        margin-bottom: 0.75rem;
        text-transform: uppercase;
        letter-spacing: -0.01em;
    }

    .rs-pillar-card p {
        font-size: 0.95rem;
        color: var(--ardo-text-muted, #64748b);
        line-height: 1.6;
        margin: 0;
    }

    /* Ayuda en Acción Feature Section */
    .rs-feature {
        padding: 100px 0;
        background: #fff;
    }

    .rs-feature-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6rem;
        align-items: center;
    }

    .rs-feature-logo-block {
        background: #f8f9fb;
        border-radius: 1.5rem;
        border: 1px solid var(--ardo-border, #E2E8F0);
        padding: 3rem;
        text-align: center;
        margin-bottom: 2rem;
    }

    .rs-feature-logo-block .org-name {
        font-family: var(--font-mono);
        font-size: 1.6rem;
        font-weight: 900;
        color: var(--ardo-midnight);
        letter-spacing: -0.02em;
        display: block;
        margin-bottom: 0.5rem;
    }

    .rs-feature-logo-block .org-domain {
        font-family: var(--font-mono);
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--ardo-primary);
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .rs-impact-stat {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 0;
        border-bottom: 1px solid var(--ardo-border, #E2E8F0);
    }

    .rs-impact-stat:last-child {
        border-bottom: none;
    }

    .rs-impact-stat i {
        font-size: 1.5rem;
        color: var(--ardo-primary);
        flex-shrink: 0;
    }

    .rs-impact-stat-text strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--ardo-midnight);
    }

    .rs-impact-stat-text span {
        font-size: 0.85rem;
        color: var(--ardo-text-muted, #64748b);
    }

    .rs-cta-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 2rem;
        background: var(--ardo-midnight);
        color: #fff;
        text-decoration: none;
        font-family: var(--font-mono);
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        padding: 0.75rem 1.5rem;
        border-radius: 4px;
        transition: background 0.2s, color 0.2s;
    }

    .rs-cta-link:hover {
        background: var(--ardo-primary);
        color: var(--ardo-midnight);
    }

    /* CTA Banner */
    .rs-banner {
        padding: 40px 20px 100px;
    }

    .rs-banner-inner {
        background: var(--ardo-midnight);
        border-radius: 2rem;
        padding: 5rem 4rem;
        position: relative;
        overflow: hidden;
        text-align: center;
        color: #fff;
    }

    .rs-banner-inner::before {
        content: '';
        position: absolute;
        top: -100px;
        right: -100px;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(0, 240, 255, 0.12) 0%, transparent 70%);
        pointer-events: none;
    }

    .rs-banner-inner p.label {
        font-family: var(--font-mono);
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--ardo-primary);
        margin-bottom: 1.5rem;
    }

    .rs-banner-inner h2 {
        font-size: clamp(2rem, 3.5vw, 3rem);
        font-weight: 900;
        line-height: 1.1;
        text-transform: uppercase;
        letter-spacing: -0.03em;
        margin-bottom: 2rem;
        color: #fff;
    }

    /* RESPONSIVE */
    @media (max-width: 1024px) {
        .rs-pillar-grid {
            grid-template-columns: 1fr 1fr;
        }

        .rs-feature-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }

        .rs-banner-inner {
            padding: 3rem 2rem;
        }
    }

    @media (max-width: 640px) {
        .rs-pillar-grid {
            grid-template-columns: 1fr;
        }

        .rs-hero h1 {
            font-size: 2.2rem;
        }
    }
</style>

<!-- ===========================
     HERO
     =========================== -->
<section class="rs-hero">
    <div class="container">
        <span class="rs-badge"><i class="lni lni-heart"></i> Responsabilidad Social</span>
        <h1>La Tecnología <br>al servicio de la <span class="text-cyan">Sociedad</span>.</h1>
        <p class="lead">
            Creemos que construir empresa y construir comunidad no son objetivos distintos.
            Son el mismo camino.
        </p>
        <div class="rs-hero-image">
            <img src="../images/responsabilidad-social.jpg"
                alt="Niños apoyados por ARDO Technology y Ayuda en Acción en México">
            <div class="rs-hero-image-overlay">
                <span class="rs-hero-image-caption"><i class="lni lni-map-marker" style="margin-right: 6px;"></i> México
                    · Programa de Apadrinamiento Infantil</span>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
     COMPROMISO INTRO
     =========================== -->
<section class="rs-commitment">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 6rem; align-items: center;">
            <div>
                <span class="section-label"><i class="lni lni-leaf" style="margin-right: 6px;"></i> Nuestro
                    Compromiso</span>
                <h2>Impacto real,<br> más allá del <span class="text-cyan">negocio</span>.</h2>
                <p>
                    En ARDO Technology sabemos que el éxito empresarial trae consigo una responsabilidad: la de devolver
                    algo a la sociedad que nos impulsa a crecer cada día.
                </p>
                <p>
                    Por eso, parte de lo que generamos como empresa lo destinamos a apoyar a quienes más lo necesitan,
                    especialmente a los niños y niñas que son el futuro de México.
                </p>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <!-- Stat cards -->
                <div
                    style="background:#fff; border:1px solid var(--ardo-border,#E2E8F0); border-radius:1rem; padding:2rem; text-align:center;">
                    <i class="lni lni-children"
                        style="font-size:2rem; color:var(--ardo-primary); display:block; margin-bottom:1rem;"></i>
                    <strong
                        style="font-size:2.2rem; font-weight:900; color:var(--ardo-midnight); display:block; line-height:1;">Niños</strong>
                    <span
                        style="font-size:0.8rem; color:var(--ardo-text-muted,#64748b); font-family:var(--font-mono); text-transform:uppercase; font-weight:700; letter-spacing:0.1em;">Apadrinados</span>
                </div>
                <div
                    style="background:#fff; border:1px solid var(--ardo-border,#E2E8F0); border-radius:1rem; padding:2rem; text-align:center;">
                    <i class="lni lni-school"
                        style="font-size:2rem; color:var(--ardo-primary); display:block; margin-bottom:1rem;"></i>
                    <strong
                        style="font-size:2.2rem; font-weight:900; color:var(--ardo-midnight); display:block; line-height:1;">Educación</strong>
                    <span
                        style="font-size:0.8rem; color:var(--ardo-text-muted,#64748b); font-family:var(--font-mono); text-transform:uppercase; font-weight:700; letter-spacing:0.1em;">+
                        Salud + Alimentos</span>
                </div>
                <div
                    style="background:var(--ardo-midnight); border-radius:1rem; padding:2rem; text-align:center; grid-column:span 2;">
                    <i class="lni lni-mexico"
                        style="font-size:2rem; color:var(--ardo-primary); display:block; margin-bottom:1rem;"></i>
                    <strong
                        style="font-size:1.1rem; font-weight:800; color:#fff; display:block; margin-bottom:0.5rem; text-transform:uppercase; letter-spacing:-0.01em;">Comunidades
                        rurales</strong>
                    <span
                        style="font-size:0.8rem; color:rgba(255,255,255,0.5); font-family:var(--font-mono); text-transform:uppercase; font-weight:700; letter-spacing:0.08em;">de
                        alta marginación en México</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
     3 PILLARS
     =========================== -->
<section class="rs-pillars">
    <div class="container">
        <div class="rs-pillar-grid">
            <div class="rs-pillar-card">
                <i class="lni lni-knife-fork-1"></i>
                <h3>Alimentación</h3>
                <p>
                    Garantizamos que los niños apadrinados reciban una nutrición adecuada y balanceada,
                    base fundamental para su desarrollo físico y cognitivo.
                </p>
            </div>
            <div class="rs-pillar-card">
                <i class="lni lni-book-1"></i>
                <h3>Educación</h3>
                <p>
                    Apoyamos el acceso a la educación de calidad, desde útiles escolares hasta programas de
                    refuerzo académico, para que ningún niño se quede sin aprender.
                </p>
            </div>
            <div class="rs-pillar-card">
                <i class="lni lni-hospital-2"></i>
                <h3>Salud</h3>
                <p>
                    Contribuimos a que los niños cuenten con atención médica básica, vacunas y seguimiento
                    de su salud para crecer fuertes y sanos.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
     AYUDA EN ACCIÓN FEATURE
     =========================== -->
<section class="rs-feature">
    <div class="container">
        <div class="rs-feature-grid">
            <!-- Left: Org info -->
            <div>
                <div class="rs-feature-logo-block">
                    <img src="https://ayudaenaccion.org.mx/uploads/2022/09/LOGO_AEA-1.png" alt="Ayuda en Acción México"
                        style="max-width: 220px; width: 100%; height: auto; display: block; margin: 0 auto 1rem;">
                    <span class="org-domain">ayudaenaccion.org.mx</span>
                </div>

                <div class="rs-impact-stat">
                    <i class="lni lni-checkmark-circle"></i>
                    <div class="rs-impact-stat-text">
                        <strong>Organización Internacional</strong>
                        <span>Con presencia en México y más de 20 países en el mundo</span>
                    </div>
                </div>
                <div class="rs-impact-stat">
                    <i class="lni lni-checkmark-circle"></i>
                    <div class="rs-impact-stat-text">
                        <strong>Programa de Apadrinamiento</strong>
                        <span>Un donativo mensual que cambia la vida de un niño</span>
                    </div>
                </div>
                <div class="rs-impact-stat">
                    <i class="lni lni-checkmark-circle"></i>
                    <div class="rs-impact-stat-text">
                        <strong>Comunidades de alta marginación</strong>
                        <span>Llegan a donde más se necesita</span>
                    </div>
                </div>

                <a href="https://ayudaenaccion.org.mx/" target="_blank" rel="noopener noreferrer" class="rs-cta-link">
                    Conoce Ayuda en Acción <i class="lni lni-arrow-right"></i>
                </a>
            </div>

            <!-- Right: Copy -->
            <div>
                <span
                    style="font-family:var(--font-mono); font-size:10px; font-weight:800; letter-spacing:0.15em; text-transform:uppercase; color:var(--ardo-primary); display:block; margin-bottom:1.5rem;">
                    Nuestra Apoyo
                </span>
                <h2
                    style="font-size:clamp(2rem,3.5vw,3rem); font-weight:900; color:var(--ardo-midnight); line-height:1.1; text-transform:uppercase; letter-spacing:-0.03em; margin-bottom:1.5rem;">
                    Apadrinamos niños <br> con <span class="text-cyan">Ayuda en Acción</span>.
                </h2>
                <p
                    style="font-size:1.1rem; color:var(--ardo-text-muted,#64748b); line-height:1.75; margin-bottom:1.5rem;">
                    Elegimos a <strong>Ayuda en Acción México</strong> porque creemos en organizaciones que trabajan
                    directamente en las comunidades, con transparencia y resultados medibles.
                </p>
                <p
                    style="font-size:1.1rem; color:var(--ardo-text-muted,#64748b); line-height:1.75; margin-bottom:1.5rem;">
                    A través de su programa de apadrinamiento, realizamos un <strong>donativo mensual</strong> que
                    asegura que niñas y niños en zonas de alta marginación en México puedan <strong>alimentarse,
                        estudiar y recibir atención médica</strong>.
                </p>
                <p style="font-size:1.1rem; color:var(--ardo-text-muted,#64748b); line-height:1.75;">
                    Es una forma simple, pero concreta, de poner nuestra tecnología al servicio de algo más grande:
                    el bienestar de las personas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- ===========================
     CLOSING CTA BANNER
     =========================== -->
<section class="rs-banner">
    <div class="container">
        <div class="rs-banner-inner">
            <p class="label"><i class="lni lni-heart" style="margin-right:6px;"></i> Más que tecnología</p>
            <h2>Construimos futuro,<br> un niño a la vez.</h2>
            <p
                style="font-size:1.1rem; color:rgba(255,255,255,0.65); max-width:560px; margin:0 auto 2.5rem; line-height:1.7;">
                Porque cada empresa tiene el poder de hacer una diferencia. Esta es la nuestra.
            </p>
            <a href="https://ayudaenaccion.org.mx/" target="_blank" rel="noopener noreferrer"
                style="display:inline-flex; align-items:center; gap:8px; background:var(--ardo-primary); color:var(--ardo-midnight); text-decoration:none; font-family:var(--font-mono); font-size:11px; font-weight:800; letter-spacing:0.1em; text-transform:uppercase; padding:0.85rem 2rem; border-radius:4px; box-shadow:0 4px 20px rgba(0,240,255,0.35); transition:opacity 0.2s;">
                Descubre Ayuda en Acción <i class="lni lni-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<?php
$showCityLinks = true;
include '../includes/footer.php';
?>