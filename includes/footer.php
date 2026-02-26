<?php
/**
 * Main Footer Redesign - High Precision Edition
 * Integrated legacy navigation with exact texts and improved spacious 3-column layout.
 */
?>

<footer class="footer-premium"
    style="padding: 100px 0 0; background: #FFFFFF; border-top: 1px solid var(--ardo-border); overflow: hidden;">
    <div class="container">

        <!-- Top Section: 3-column Navigation Grid -->
        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 6rem; margin-bottom: 80px;">

            <!-- Col 1: Servicios -->
            <div class="footer-nav-col">
                <h3 style="margin-bottom: 2.5rem; color: var(--ardo-midnight); font-size: 1.3rem; font-weight: 800;">
                    Servicios</h3>
                <ul class="footer-nav-list">
                    <li><a href="<?php echo $basePath; ?>servicios-administrados/">Servicios Administrados de TI</a>
                    </li>
                    <li><a href="<?php echo $basePath; ?>consultoria-ti/">Consultoría TI</a></li>
                    <li><a href="<?php echo $basePath; ?>comunicaciones-unificadas/">Comunicaciones Unificadas</a></li>
                    <li><a href="<?php echo $basePath; ?>numeros-virtuales/">Números Virtuales</a></li>
                    <li><a href="<?php echo $basePath; ?>troncal-sip/">Troncales SIP</a></li>
                    <li><a href="<?php echo $basePath; ?>servidores-cloud/">Servidores Cloud</a></li>
                    <li><a href="<?php echo $basePath; ?>index.php#casos">Casos de Estudio</a></li>
                </ul>
            </div>

            <!-- Col 2: Acerca de -->
            <div class="footer-nav-col">
                <h3 style="margin-bottom: 2.5rem; color: var(--ardo-midnight); font-size: 1.3rem; font-weight: 800;">
                    Acerca de</h3>
                <ul class="footer-nav-list">
                    <li><a href="<?php echo $basePath; ?>nosotros/">Nosotros</a></li>
                    <li><a href="<?php echo $basePath; ?>cobertura/">Mapa de Cobertura</a></li>
                    <li><a href="<?php echo $basePath; ?>ardo-partners/index.php">Red de ARDO Partners</a></li>
                    <li><a href="<?php echo $basePath; ?>contacto/">Contacto</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="<?php echo $basePath; ?>politica-de-uso-justo/">Políticas de Uso Justo (PUJ)</a></li>
                    <li><a href="<?php echo $basePath; ?>colaboracion-con-la-justicia/">Colaboración con la Justicia</a>
                    </li>
                    <li><a href="#">IFT/223/UCS/AUT-COM-002/2023</a></li>
                </ul>
            </div>

            <!-- Col 3: Newsletter & Action -->
            <div class="footer-nav-col">
                <p style="color: var(--ardo-text-muted); font-size: 13px; margin-bottom: 1.5rem; line-height: 1.6;">No
                    te pierdas nuestras mas recientes noticias</p>
                <form class="footer-newsletter-form">
                    <div style="margin-bottom: 1rem; position: relative;">
                        <input type="email" placeholder="Email institucional"
                            style="width: 100%; padding: 1rem 1.25rem; background: var(--ardo-surface); border: 1px solid var(--ardo-border); border-radius: 0.75rem; font-size: 13px; outline: none; transition: all 0.3s;"
                            onfocus="this.style.borderColor='var(--ardo-primary)';"
                            onblur="this.style.borderColor='var(--ardo-border)';">
                    </div>
                    <div style="margin-bottom: 1.5rem; display: flex; gap: 10px; align-items: flex-start;">
                        <input type="checkbox" id="privacy-policy" style="margin-top: 4px;">
                        <label for="privacy-policy"
                            style="font-size: 11px; color: var(--ardo-text-muted); line-height: 1.4; cursor: pointer;">
                            Acepto la Política de Privacidad y doy mi consentimiento para que mis datos personales sean
                            procesados para los fines especificados en el Aviso de Privacidad.
                        </label>
                    </div>
                    <button type="submit" class="btn-dark"
                        style="width: 100%; padding: 1rem; border: none; border-radius: 0.75rem; font-weight: 700; cursor: pointer; transition: all 0.3s; margin-bottom: 1rem;"
                        onmouseover="this.style.transform='translateY(-2px)';"
                        onmouseout="this.style.transform='translateY(0)';">
                        <span>Enviar</span>
                    </button>
                </form>

                <!-- WhatsApp Button moved below Send button -->
                <a href="https://wa.me/524429803200" target="_blank" class="btn-dark"
                    style="width: 100%; padding: 1rem 1.5rem; display: inline-flex; align-items: center; justify-content: center; gap: 10px; text-decoration: none; border-radius: 0.75rem; background: var(--ardo-midnight); color: #fff; font-weight: 700; transition: all 0.3s;"
                    onmouseover="this.style.background='var(--ardo-primary)'; this.style.color='#fff';"
                    onmouseout="this.style.background='var(--ardo-midnight)'; this.style.color='#fff';">
                    <span>Envíanos un Mensaje</span>
                    <i class="lni lni-whatsapp"></i>
                </a>
            </div>

        </div>

        <!-- Middle Section: Trust & Contact Strip -->
        <div
            style="padding: 40px 0; border-top: 1px solid var(--ardo-border); border-bottom: 1px solid var(--ardo-border); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 2rem;">

            <!-- Clutch Integration (Integrous) -->
            <a href="https://clutch.co/profile/ardo-technology" target="_blank"
                style="text-decoration: none; display: flex; align-items: center; gap: 1.25rem;">
                <div
                    style="font-family: var(--font-mono); font-size: 9px; font-weight: 800; color: var(--ardo-midnight); letter-spacing: 0.08em;">
                    RESEÑAS EN CLUTCH</div>
                <div style="display: flex; gap: 2px;">
                    <i class="lni lni-star-fat-fill" style="color: #FF5A5F; font-size: 12px;"></i>
                    <i class="lni lni-star-fat-fill" style="color: #FF5A5F; font-size: 12px;"></i>
                    <i class="lni lni-star-fat-fill" style="color: #FF5A5F; font-size: 12px;"></i>
                    <i class="lni lni-star-fat-fill" style="color: #FF5A5F; font-size: 12px;"></i>
                    <i class="lni lni-star-fat-fill" style="color: #FF5A5F; font-size: 12px;"></i>
                </div>
                <span style="font-family: var(--font-mono); font-size: 9px; font-weight: 700; opacity: 0.4;">31
                    REVIEWS</span>
            </a>

            <!-- Contact Strip (Integrous) -->
            <div style="display: flex; gap: 3rem; align-items: center;">
                <div style="text-align: right;">
                    <p class="text-mono-label"
                        style="font-size: 9px; opacity: 0.4; margin-bottom: 4px; letter-spacing: 0.05em;">TELÉFONO</p>
                    <p style="font-size: 14px; font-weight: 700; color: var(--ardo-midnight); margin: 0;">800-953-0017
                    </p>
                </div>
                <div style="text-align: right;">
                    <p class="text-mono-label"
                        style="font-size: 9px; opacity: 0.4; margin-bottom: 4px; letter-spacing: 0.05em;">UBICACIÓN</p>
                    <p
                        style="font-size: 11px; font-weight: 500; color: var(--ardo-text-muted); margin: 0; line-height: 1.3;">
                        Av. Antea 1088 Piso 3, Col. Jurica,<br>
                        Querétaro, Qro. México 76100
                    </p>
                </div>
            </div>

            <!-- Social Links -->
            <div style="display: flex; gap: 1rem;">
                <a href="https://mx.linkedin.com/company/ardotechnology" class="footer-social-link"><i
                        class="lni lni-linkedin"></i></a>
                <a href="https://github.com/ardotechnology" class="footer-social-link"><i
                        class="lni lni-github"></i></a>
                <a href="https://www.facebook.com/ardo.technology" class="footer-social-link"><i
                        class="lni lni-facebook"></i></a>
                <a href="https://youtube.com/@ardo.technology" class="footer-social-link"><i
                        class="lni lni-youtube"></i></a>
            </div>
        </div>
        <!-- City Links Section: Presencia Nacional -->
        <?php include $basePath . 'includes/city_links.php'; ?>

        <!-- Bottom Section: Legal Footer -->
        <div
            style="padding: 40px 0; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <p
                style="font-family: var(--font-mono); font-size: 9px; font-weight: 700; opacity: 0.4; letter-spacing: 0.02em;">
                © 2026 ARDO DE MEXICO, S.A.P.I. DE C.V. TODOS LOS DERECHOS RESERVADOS.
            </p>

            <div style="display: flex; gap: 2rem;">
                <a href="<?php echo $basePath; ?>aviso-de-privacidad/"
                    style="text-decoration: none; color: var(--ardo-text-muted); font-size: 10px; font-family: var(--font-mono); font-weight: 700; opacity: 0.5; transition: opacity 0.3s;"
                    onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.5';">AVISO DE PRIVACIDAD</a>
                <a href="<?php echo $basePath; ?>tyc/"
                    style="text-decoration: none; color: var(--ardo-text-muted); font-size: 10px; font-family: var(--font-mono); font-weight: 700; opacity: 0.5; transition: opacity 0.3s;"
                    onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.5';">TÉRMINOS Y
                    CONDICIONES</a>
                <a href="<?php echo $basePath; ?>politica-de-uso-justo/"
                    style="text-decoration: none; color: var(--ardo-text-muted); font-size: 10px; font-family: var(--font-mono); font-weight: 700; opacity: 0.5; transition: opacity 0.3s;"
                    onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.5';">POLÍTICAS DE USO
                    JUSTO</a>
            </div>
        </div>

    </div>
</footer>

<style>
    .footer-nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .footer-cities-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 0.75rem 1.5rem;
    }

    .footer-cities-grid a {
        text-decoration: none;
        color: var(--ardo-text-muted);
        font-size: 10px;
        font-weight: 500;
        transition: all 0.2s;
        white-space: nowrap;
        opacity: 0.6;
    }

    .footer-cities-grid a:hover {
        color: var(--ardo-primary);
        opacity: 1;
    }

    .footer-nav-list a {
        text-decoration: none;
        color: var(--ardo-text-muted);
        font-size: 14px;
        transition: all 0.3s;
        display: inline-block;
    }

    .footer-nav-list a:hover {
        color: var(--ardo-primary);
        transform: translateX(4px);
    }

    .footer-social-link {
        width: 38px;
        height: 38px;
        border: 1px solid var(--ardo-border);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--ardo-midnight);
        font-size: 16px;
        text-decoration: none;
        transition: all 0.3s;
    }

    .footer-social-link:hover {
        background: var(--ardo-primary);
        color: #fff;
        border-color: var(--ardo-primary);
        transform: translateY(-2px);
    }

    @media (max-width: 1024px) {
        .footer-premium>.container>div:first-child {
            grid-template-columns: 1fr 1fr !important;
            gap: 4rem !important;
        }

        .footer-cities-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media (max-width: 768px) {
        .footer-premium>.container>div:first-child {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }

        .footer-cities-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .footer-nav-col {
            text-align: center;
        }

        .footer-nav-list {
            align-items: center;
        }

        .footer-premium>.container>div:nth-child(2) {
            flex-direction: column;
            text-align: center;
        }
    }
</style>

<?php include 'footer-scripts.php'; ?>
<?php if (isset($customScripts))
    echo $customScripts; ?>
</body>

</html>