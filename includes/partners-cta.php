<!-- Partners CTA: Refined Premium Style -->
<section class="partners-cta-section" style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div class="glass-panel"
            style="padding: 5rem; border-radius: 2.5rem; background: var(--ardo-surface); border: 1px solid var(--ardo-border); position: relative; overflow: hidden; display: flex; justify-content: space-between; align-items: center; gap: 3rem;">
            <!-- Glow background effect -->
            <div
                style="position: absolute; top: -50%; left: -20%; width: 100%; height: 200%; background: radial-gradient(circle, rgba(0,240,255,0.05) 0%, transparent 70%); pointer-events: none;">
            </div>

            <div style="max-width: 650px; position: relative; z-index: 2;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Ecosistema de
                    Valor</p>
                <h2 class="text-huge"
                    style="font-size: clamp(2rem, 4vw, 3rem); line-height: 1.1; margin-bottom: 2rem; color: var(--ardo-midnight);">
                    Arquitectura global<br><span class="text-cyan">Resultados Locales</span>.
                </h2>
                <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.6; margin-bottom: 0;">
                    Formamos alianzas con los proveedores más disruptivos del mercado para entregar soluciones llave en
                    mano respaldadas por soporte de élite.
                </p>
            </div>

            <div style="position: relative; z-index: 2;">
                <a href="<?php echo $basePath; ?>ardo-partners/" class="btn-dark"
                    style="padding: 1.2rem 2.5rem; display: inline-flex; align-items: center; gap: 10px;">
                    Explorar Red de Partners <i class="lni lni-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width: 1024px) {
        .partners-cta-section .glass-panel {
            flex-direction: column;
            text-align: center;
            padding: 3rem 2rem;
        }

        .partners-cta-section .glass-panel div[style*="max-width: 650px"] {
            max-width: 100% !important;
        }
    }
</style>