<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('partners') ?? [
    'title' => "Partners | ARDO Technology",
    'description' => "Nuestra amplia red de distribuidores en toda la república mexicana nos permite ofrecer soluciones innovadoras."
];
$basePath = '../';
include '../includes/header.php';
?>

<div class="main-content-redesign internal-page-redesign">
    <section class="hero-internal"
        style="position: relative; padding: 10px 0 40px; display: flex; align-items: center; background: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 900px; margin: 0 auto;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">RED DE
                    DISTRIBUCIÓN
                </p>
                <h1 class="text-huge"
                    style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                    ARDO <span class="text-cyan">Partners</span>.
                </h1>
                <p
                    style="color: var(--ardo-text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                    Nuestra amplia red de distribuidores en toda la república mexicana nos permite poder ofrecer a
                    nuestros
                    clientes soluciones innovadoras y con enfoque de negocio.
                </p>
            </div>
        </div>
    </section>

    <section class="partners-map-section" style="width: 100%; height: 600px; background: #e5e5e5; position: relative;">
        <iframe src="../includes/mapa_distribuidores/map.html"
            style="width: 100%; height: 100%; border: none;"></iframe>
    </section>

    <?php include '../includes/contact.php'; ?>
</div>

<style>
    @media (max-width: 1024px) {
        .hero-internal {
            padding: 60px 0 !important;
        }

        .partners-map-section {
            height: 400px !important;
        }
    }
</style>

<?php
$showCityLinks = true;
include '../includes/footer.php';
?>