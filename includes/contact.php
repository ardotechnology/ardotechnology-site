<?php
// contact.php - Premium Redesign for Ardo Design System
?>
<section class="ardo-contact-redesign" id="contacto"
    style="padding: 80px 0; background: var(--ardo-surface); position: relative; overflow: hidden;">
    <!-- Decorative background elements -->
    <div class="grid-overlay" style="opacity: 0.05;"></div>

    <div class="container"
        style="position: relative; z-index: 2; max-width: 1280px; margin: 0 auto; padding: 0 1.5rem;">

        <div class="contact-grid-wrapper">

            <!-- Left Content: Info & Methodology -->
            <div class="contact-info-panel">
                <div class="contact-intro">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">Protocolo de
                        Inicio</p>
                    <h2 class="text-huge">¿Listo para el <br> <span class="text-cyan">Siguiente Nivel</span>?</h2>
                    <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.7; max-width: 90%;">
                        Estaremos encantados de resolver sus dudas técnicas y estratégicas para determinar la mejor
                        arquitectura para su negocio.
                    </p>
                </div>

                <!-- Methodology / Procedure -->
                <div class="bento-card methodology-card">
                    <h4 class="text-mono-label"
                        style="margin-bottom: 2rem; border-bottom: 1px solid var(--ardo-border); padding-bottom: 1rem;">
                        Nuestra Metodología</h4>

                    <div class="methodology-steps">
                        <!-- Step 1 -->
                        <div class="step">
                            <div class="step-num">01</div>
                            <div class="step-content">
                                <p class="step-title">Conexión Inicial</p>
                                <p class="step-desc">Agendamos una breve llamada de contextualización.</p>
                            </div>
                        </div>

                        <!-- Step 2 -->
                        <div class="step">
                            <div class="step-num">02</div>
                            <div class="step-content">
                                <p class="step-title">Discovery Technical</p>
                                <p class="step-desc">Análisis profundo de sus retos y requerimientos técnicos.</p>
                            </div>
                        </div>

                        <!-- Step 3 -->
                        <div class="step">
                            <div class="step-num">03</div>
                            <div class="step-content">
                                <p class="step-title">High-Fidelity Proposal</p>
                                <p class="step-desc">Envío de propuesta personalizada con arquitectura de solución.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="contact-quick-links">
                    <div class="link-item">
                        <p class="text-mono-label" style="opacity: 0.4;">Central Local</p>
                        <a href="tel:4429803200"
                            style="color: var(--ardo-midnight); text-decoration: none; font-weight: 700; font-family: var(--font-mono);">+52
                            442 980 3200</a>
                    </div>
                    <div class="link-item">
                        <p class="text-mono-label" style="opacity: 0.4;">Soporte Global</p>
                        <a href="mailto:soporte@ardo.technology"
                            style="color: var(--ardo-midnight); text-decoration: none; font-weight: 700; font-family: var(--font-mono);">800-953-0017</a>
                    </div>
                </div>
            </div>

            <!-- Right Content: Form Card -->
            <div class="contact-form-panel">
                <div class="form-wrapper">
                    <?php
                    // Using the existing form proxy for internal functionality
                    if (file_exists(__DIR__ . '/form-proxy.php')) {
                        include __DIR__ . '/form-proxy.php';
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    /* Ardo Design System Essentials for Contact Component */
    :root {
        --ardo-primary: #00F0FF;
        --ardo-midnight: #050505;
        --ardo-deep-blue: #0A192F;
        --ardo-surface: #F8FAFB;
        --ardo-border: #E2E8F0;
        --ardo-text-main: #050505;
        --ardo-text-muted: rgba(10, 25, 47, 0.6);
        --font-display: 'Inter', -apple-system, sans-serif;
        --font-mono: 'JetBrains Mono', monospace;
    }

    /* Support for pages without the variables */
    .ardo-contact-redesign {
        --ardo-primary: #00F0FF;
        --ardo-midnight: #050505;
        --ardo-deep-blue: #0A192F;
        --ardo-surface: #F8FAFB;
        --ardo-border: #E2E8F0;
        --ardo-text-muted: rgba(10, 25, 47, 0.6);
        --font-mono: 'JetBrains Mono', monospace;
    }

    /* Utility Classes from Design System */
    .ardo-contact-redesign .text-huge {
        font-size: clamp(2.5rem, 6vw, 4rem);
        font-weight: 900;
        line-height: 0.95;
        letter-spacing: -0.05em;
        text-transform: uppercase;
    }

    .ardo-contact-redesign .text-mono-label {
        font-family: var(--font-mono);
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.2em;
    }

    .ardo-contact-redesign .text-cyan {
        color: var(--ardo-primary);
    }

    .ardo-contact-redesign .bento-card {
        background: #FFFFFF;
        border: 1px solid var(--ardo-border);
        border-radius: 1.5rem;
        padding: 2rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .ardo-contact-redesign .grid-overlay {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(var(--ardo-deep-blue) 0.5px, transparent 0.5px);
        background-size: 40px 40px;
        opacity: 0.03;
        pointer-events: none;
        z-index: 1;
    }

    .contact-grid-wrapper {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
        align-items: start;
    }

    .contact-intro {
        margin-bottom: 4rem;
    }

    .methodology-card {
        padding: 2.5rem;
        background: #fff;
        margin-bottom: 3rem;
    }

    .methodology-steps {
        display: flex;
        flex-direction: column;
        gap: 2rem;
    }

    .contact-grid-wrapper .step {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .contact-grid-wrapper .step-num {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: var(--ardo-midnight);
        color: var(--ardo-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: var(--font-mono);
        font-weight: 700;
        flex-shrink: 0;
    }

    .contact-grid-wrapper .step-title {
        font-weight: 700;
        margin: 0;
        font-size: 15px;
    }

    .contact-grid-wrapper .step-desc {
        color: var(--ardo-text-muted);
        font-size: 13px;
        margin: 0;
    }

    .contact-quick-links {
        display: flex;
        gap: 3rem;
    }

    @media (max-width: 1024px) {
        .ardo-contact-redesign {
            padding: 60px 0 !important;
        }

        .contact-grid-wrapper {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }

        .contact-info-panel {
            text-align: center;
        }

        .contact-intro {
            margin-bottom: 3rem !important;
        }

        .contact-intro h2.text-huge {
            font-size: 2.2rem !important;
            line-height: 1.1 !important;
        }

        .contact-intro p {
            margin-left: auto;
            margin-right: auto;
        }

        .methodology-card {
            padding: 1.5rem !important;
            text-align: left;
        }

        .contact-quick-links {
            flex-direction: column;
            gap: 2rem;
            align-items: center;
        }
    }

    @media (max-width: 480px) {
        .contact-intro h2.text-huge {
            font-size: 1.8rem !important;
        }

        .methodology-steps .step {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
    }
</style>