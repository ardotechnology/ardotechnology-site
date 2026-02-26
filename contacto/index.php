<?php
$pageTitle = "Contacto | ARDO Technology - Soluciones TI en Querétaro";
$pageDescription = "Contacte a ARDO Technology. Estamos en Querétaro para ayudarle con telefonía VoIP, servicios cloud y consultoría estratégica de TI. Agende su asesoría hoy.";
$basePath = '../';

$customHead = <<<EOT
    <!-- Leaflet Map CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style>
        /* Specific Styles for Contact Page Hero */
        .contact-hero {
            background: #fff;
            padding: 60px 20px 60px;
            text-align: center;
        }

        .contact-tag {
            display: inline-block;
            background: #f4f4f4;
            color: #666;
            padding: 6px 16px;
            border-radius: 0;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .contact-title {
            font-size: 64px;
            color: #111b24;
            font-weight: 700;
            margin-bottom: 40px;
            letter-spacing: -1.5px;
        }

        .contact-info-strip {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-item {
            text-align: left;
        }

        .info-label {
            display: block;
            font-size: 15px;
            color: #555;
            margin-bottom: 4px;
        }

        .info-value {
            font-size: 18px;
            font-weight: 600;
            color: #111b24;
        }

        .info-divider {
            width: 1px;
            height: 60px;
            background: #e0e0e0;
            transform: skewX(-15deg);
        }

        .contact-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 12px 28px;
            background: rgba(3, 38, 66, 0.85);
            color: #ffffff;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 800;
            font-size: 14px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 15px rgba(3, 38, 66, 0.3);
        }

        .contact-cta-btn:hover {
            transform: translateY(-2px);
            background: rgba(3, 38, 66, 0.2);
            box-shadow: 0 6px 20px rgba(3, 38, 66, 0.2);
            color: #242627;
        }

        .contact-banner-img {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
            margin-bottom: 20px;
        }

        .contact-banner-img img {
            width: 100%;
            display: block;
        }

        /* Localization Section Styles */
        .location-section {
            padding: 40px 0 100px;
            background: #fff;
        }

        .location-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 80px;
            position: relative;
        }

        .location-header-content {
            max-width: 600px;
        }

        .location-tag-title {
            font-size: 56px;
            color: #111b24;
            font-weight: 700;
            margin-bottom: 30px;
            letter-spacing: -1px;
        }

        .location-header-desc {
            font-size: 18px;
            color: #666;
            line-height: 1.6;
            margin: 0;
        }

        .location-grid {
            display: flex;
            border-top: 1px solid #f0f0f0;
            padding-top: 60px;
        }

        .location-col {
            flex: 1;
            padding: 0 40px;
        }

        /* Map Section Styles */
        .map-section {
            padding: 40px 0 80px;
            background: #fff;
        }

        .map-wrapper {
            width: 100%;
            height: 500px;
            border-radius: 0;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid #eee;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        @media (max-width: 1024px) {
            .contact-title {
                font-size: 38px;
            }

            /* Stack Hero Info Strip */
            .contact-info-grid {
                flex-direction: column !important;
                gap: 2rem !important;
                margin-bottom: 2rem !important;
            }

            .contact-info-item {
                text-align: center !important;
                width: 100% !important;
            }

            .contact-info-divider {
                display: none !important;
            }

            .internal-page-redesign section, 
            section[style*="padding: 100px 0"] {
                padding: 20px 0 !important;
            }

            /* Location Grid - Bento stacking */
            .bento-grid {
                grid-template-columns: 1fr !important;
            }

            /* Location section header stack */
            section[style*="background: var(--ardo-surface)"] .container > div[style*="display: grid"] {
                grid-template-columns: 1fr !important;
                gap: 2rem !important;
            }

            .map-wrapper {
                height: 350px !important;
            }

            .hero-visual {
                display: none !important;
            }
        }
    </style>
EOT;

include '../includes/header.php';
?>

<!-- Contact Hero Section (Image Replication) -->
<!-- Contact Hero Section -->
<section class="hero-internal"
    style="position: relative; padding: 0px 0 40px; display: flex; align-items: center; background: #fff;">
    <div class="container">
        <div style="text-align: center; max-width: 900px; margin: 0 auto;">
            <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">CONTACTO</p>
            <h1 class="text-huge"
                style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                Estamos aquí <br><span class="text-cyan">para ayudar</span>.
            </h1>

            <div class="contact-info-grid"
                style="display: flex; justify-content: center; align-items: center; gap: 4rem; margin-bottom: 3rem;">
                <div class="contact-info-item" style="text-align: left;">
                    <span
                        style="display: block; font-size: 14px; color: var(--ardo-text-muted); margin-bottom: 5px;">Llámenos</span>
                    <span style="font-size: 1.2rem; font-weight: 700; color: var(--ardo-midnight);"><a
                            href="tel:4429803200"
                            style="color: inherit; text-decoration: none;">+52-442-980-3200</a></span>
                </div>
                <div class="contact-info-divider" style="width: 1px; height: 50px; background: var(--ardo-border);">
                </div>
                <div class="contact-info-item" style="text-align: left;">
                    <span
                        style="display: block; font-size: 14px; color: var(--ardo-text-muted); margin-bottom: 5px;">Escríbanos:</span>
                    <span
                        style="font-size: 1.2rem; font-weight: 700; color: var(--ardo-midnight);">contacto@ardo.technology</span>
                </div>
            </div>

            <a href="https://wa.me/524429803200?text=%C2%A1Hola%2C+me+gustar%C3%ADa+agendar+una+llamada+con+ARDO+Technology%21"
                class="btn-primary" target="_blank" style="margin-bottom: 4rem;">
                <span>Deseo agendar una consultoría</span> <i class="lni lni-whatsapp"></i>
            </a>
        </div>

        <div class="hero-visual">
            <!-- Using the contact image but full width and styled -->
            <div class="bento-card"
                style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; box-shadow: var(--ardo-shadow-lg);">
                <img src="../images/contacto.jpg" alt="Oficinas ARDO Technology Querétaro"
                    style="width: 100%; height: 100%; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- Location Section -->
<!-- Location Section -->
<section style="padding: 100px 0; background: var(--ardo-surface);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; margin-bottom: 4rem;">
            <div>
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">PRESENCIA GLOBAL
                </p>
                <h2 class="text-huge" style="font-size: 3rem; margin-bottom: 2rem;">Localización.</h2>
            </div>
            <div>
                <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.6;">
                    Tenemos oficinas en México y Estados Unidos; nos encantaría mostrártelas en algún momento. ¿No ves
                    una oficina en tu zona? Tenemos la capacidad de apoyar tu negocio, sin importar la ubicación.
                </p>
            </div>
        </div>

        <div class="bento-grid" style="grid-template-columns: repeat(3, 1fr); gap: 2rem;">
            <!-- Florida -->
            <div class="bento-card">
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--ardo-midnight);">
                    Florida</h3>
                <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--ardo-primary); margin-bottom: 1.5rem;">St.
                    Petersburg</h4>
                <p style="color: var(--ardo-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                    7901 4TH. ST. N STE. 300<br>St. Petersburg, FL, USA 33702
                </p>
                <p style="font-weight: 700; margin-bottom: 1.5rem;">+1 (786) 591-0022</p>
                <a href="#"
                    style="color: var(--ardo-midnight); font-size: 0.9rem; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--ardo-midnight);">Ver
                    Dirección</a>
            </div>

            <!-- Querétaro -->
            <div class="bento-card">
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--ardo-midnight);">
                    Querétaro</h3>
                <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--ardo-primary); margin-bottom: 1.5rem;">
                    Querétaro</h4>
                <p style="color: var(--ardo-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                    Av. Antea 1088 Piso 3<br>Col. Jurica, Querétaro, Qro. 76100
                </p>
                <p style="font-weight: 700; margin-bottom: 1.5rem;">+52 (442) 980-3200</p>
                <a href="#"
                    style="color: var(--ardo-midnight); font-size: 0.9rem; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--ardo-midnight);">Ver
                    Dirección</a>
            </div>

            <!-- Chihuahua -->
            <div class="bento-card">
                <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--ardo-midnight);">
                    Chihuahua</h3>
                <h4 style="font-size: 1.1rem; font-weight: 600; color: var(--ardo-primary); margin-bottom: 1.5rem;">
                    Chihuahua</h4>
                <p style="color: var(--ardo-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1rem;">
                    Atención Remota<br>24/7 Support Center
                </p>
                <p style="font-weight: 700; margin-bottom: 1.5rem;">+ 52 (614) 925 7176</p>
                <a href="#"
                    style="color: var(--ardo-midnight); font-size: 0.9rem; font-weight: 700; text-decoration: none; border-bottom: 1px solid var(--ardo-midnight);">WhatsApp
                    <i class="lni lni-whatsapp"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- Interactive Map Section -->
<!-- Interactive Map Section -->
<section class="map-section" style="padding: 0; background: #fff;">
    <div class="container" style="max-width: 100%; padding: 0;">
        <div class="map-wrapper" style="height: 500px; width: 100%; border-radius: 0; border: none;">
            <div id="map" style="width: 100%; height: 100%;"></div>
        </div>
    </div>
</section>

<!-- Standard Contact Form Section -->
<?php
$showCityLinks = true;
include '../includes/contact.php';
?>

<?php
$customScripts = <<<EOT
    <!-- Scripts -->
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script>
        // Initialize Map
        const map = L.map('map', {
            scrollWheelZoom: false
        }).setView([24.26, -94.35], 5);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Click to enable scroll zoom
        map.on('click', () => {
            if (map.scrollWheelZoom.enabled()) {
                map.scrollWheelZoom.disable();
            } else {
                map.scrollWheelZoom.enable();
            }
        });

        // Custom Icon
        const customIcon = L.icon({
            iconUrl: '../includes/cobertura/images/icon-1.png',
            iconSize: [20, 20],
            iconAnchor: [10, 20],
            popupAnchor: [0, -20]
        });

        const locations = [
            {
                coords: [27.8441, -82.6395],
                title: "ARDO International LLC",
                address: "7901 4TH. ST. N STE. 300 St. Petersburg, FL, USA 33702"
            },
            {
                coords: [20.6738, -100.4335],
                title: "Querétaro Business Park",
                address: "Av. Antea 1088 Piso 3, Col. Jurica, Qro. 76100"
            },
            {
                coords: [28.633, -106.069],
                title: "Chihuahua Support",
                address: "Atención Remota - 24/7 Support Center"
            }
        ];

        locations.forEach(loc => {
            var marker = L.marker(loc.coords, { icon: customIcon }).addTo(map)
                .bindPopup("<b>" + loc.title + "</b><br>" + loc.address);
            
            // Only open Querétaro popup by default
            if (loc.title.includes('Querétaro')) {
                marker.openPopup();
            }
        });

        // Fit bounds to show all markers
        const group = new L.featureGroup(locations.map(l => L.marker(l.coords)));
        map.fitBounds(group.getBounds().pad(0.1));
    </script>
EOT;

include '../includes/footer.php';
?>