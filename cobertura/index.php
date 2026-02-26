<?php
$pageTitle = "Mapa de Cobertura | ARDO Technology";
$pageDescription = "ARDO Technology mantiene una cobertura en más de 90 ciudades en México a través de infraestructura propia.";
$basePath = '../';
include '../includes/header.php';
?>

<section class="hero-internal"
    style="position: relative; padding: 10px 0 40px; display: flex; align-items: center; background: #fff;">
    <div class="container">
        <div style="text-align: center; max-width: 900px; margin: 0 auto;">
            <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">INFRAESTRUCTURA
                NACIONAL</p>
            <h1 class="text-huge"
                style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                Mapa de <span class="text-cyan">Cobertura</span>.
            </h1>
            <p
                style="color: var(--ardo-text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                ARDO Technology mantiene una cobertura en más de 90 ciudades en México a través de infraestructura
                propia.
            </p>
        </div>
    </div>
</section>

<section class="coverage-map-section" style="width: 100%; height: 600px; background: #e5e5e5; position: relative;">
    <iframe src="../includes/cobertura/map.html" style="width: 100%; height: 100%; border: none;"></iframe>
</section>

<style>
    @media (max-width: 1024px) {
        .hero-internal {
            padding: 60px 0 !important;
        }

        .coverage-map-section {
            height: 400px !important;
        }
    }
</style>

<?php
include '../includes/contact.php';
$showCityLinks = true;
include '../includes/footer.php';
?>