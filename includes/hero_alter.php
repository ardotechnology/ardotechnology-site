<!-- Hero Redesign: Ardo Next Gen -->
<section class="hero-redesign"
    style="position: relative; padding: 2rem 0; overflow: hidden; min-height: calc(100vh - 120px); display: flex; align-items: center; box-sizing: border-box;">

    <!-- Background Video with Overlay -->
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;">
        <video autoplay loop muted playsinline
            style="width: 100%; height: 100%; object-fit: cover; object-position: center;">
            <source src="https://www.pexels.com/download/video/3163534/" type="video/mp4">
        </video>
        <div
            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, rgba(0, 0, 0, 1) 0%, rgba(0, 0, 0, 0) 100%);">
        </div>
    </div>

    <div class="container" style="position: relative; z-index: 2;">
        <div class="hero-content" style="text-align: left; max-width: 850px;">

            <div class="status-indicator"
                style="margin-bottom: 2rem; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); padding: 8px 24px; border-radius: 30px; display: inline-flex; align-items: center; gap: 12px; border: 1px solid rgba(255, 255, 255, 0.15);">
                <span class="dot pulse"
                    style="background: var(--ardo-cyan, #00BCD4); width: 8px; height: 8px; border-radius: 50%; box-shadow: 0 0 10px var(--ardo-cyan, #00BCD4);"></span>
                <span
                    style="color: #ffffff; font-size: 0.65rem; font-weight: 600; font-family: var(--font-mono, monospace); text-transform: uppercase; letter-spacing: 1.5px;">Solución
                    Todo en Uno</span>
            </div>

            <h1 class="text-huge"
                style="margin-bottom: 1.5rem; color: #ffffff; font-size: clamp(2rem, 3.8vw, 4rem); text-transform: uppercase; line-height: 1.1; letter-spacing: -1px;">
                Todo lo que necesitas <br>
                para tu <span class="text-cyan">Telefonía VoIP</span> <br>
                en un solo lugar.
            </h1>

            <p
                style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.85); margin-bottom: 3rem; line-height: 1.6; max-width: 650px;">
                Elige el PBX de tu preferencia (VitalPBX, Yeastar, FreePBX, 3CX, etc.), administra tus troncales SIP,
                números virtuales y minutos, todo desde un mismo lugar. Gestiona tu infraestructura y decide cómo y
                cuándo gastar con total libertad.
            </p>

            <div class="hero-actions" style="display: flex; gap: 1.5rem; align-items: center;">
                <a href="<?php echo isset($basePath) ? $basePath : '/'; ?>registro/" class="btn-primary">Iniciar
                    Proyecto</a>
                <a href="<?php echo isset($basePath) ? $basePath : '/'; ?>casos-de-estudio/" class="btn-dark"
                    style="padding: 0.75rem 1.5rem; font-size: 11px; background: rgba(255, 255, 255, 0.1); color: #fff; border: 1px solid rgba(255,255,255,0.2);">Hablar
                    con un Asesor</a>
            </div>

        </div>
    </div>
</section>

<style>
    .hero-actions a:hover {
        transform: translateY(-2px);
    }

    .hero-actions .btn-primary:hover {
        box-shadow: 0 10px 25px rgba(0, 208, 156, 0.4);
    }

    .hero-actions .btn-dark:hover {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: #ffffff !important;
    }

    .pulse {
        animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0% {
            box-shadow: 0 0 0 0 rgba(0, 208, 156, 0.7);
        }

        70% {
            box-shadow: 0 0 0 10px rgba(0, 208, 156, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(0, 208, 156, 0);
        }
    }
</style>