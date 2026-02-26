<?php
include 'data.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$currentCase = null;

foreach ($casos as $case) {
    if ($case['slug'] === $slug) {
        $currentCase = $case;
        break;
    }
}

if (!$currentCase) {
    header("Location: ../index.php");
    exit;
}

$pageTitle = $currentCase['title'] . " | Casos de Estudio ARDO";
$pageDescription = $currentCase['short_description'];
$basePath = '../';
include '../includes/header.php';
?>

<div class="header-spacer"></div>

<article class="case-detail">
    <!-- Hero Section (2 Column Refactor) -->
    <!-- Hero Section -->
    <section class="hero-internal"
        style="position: relative; padding: 60px 0 60px; display: flex; align-items: center; background: #fff;">
        <div class="container">
            <div style="text-align: center; max-width: 900px; margin: 0 auto;">
                <a href="index.php" class="text-mono-label"
                    style="text-decoration: none; color: var(--ardo-text-muted); margin-bottom: 2rem; display: inline-block;">&larr;
                    VOLVER A CASOS</a>
                <h1 class="text-huge"
                    style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                    <?php echo $currentCase['title']; ?>
                </h1>
                <p
                    style="color: var(--ardo-text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto; line-height: 1.6; font-weight: 500;">
                    <?php echo $currentCase['short_description']; ?>
                </p>
                <div class="hero-tags"
                    style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin-top: 2rem;">
                    <?php foreach ($currentCase['features'] as $feature): ?>
                        <span class="status-indicator">
                            <span class="dot pulse"></span> <?php echo $feature; ?>
                        </span>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="hero-visual" style="margin-top: 4rem;">
                <div class="bento-card"
                    style="padding: 0; overflow: hidden; border-radius: 2rem; height: 500px; box-shadow: var(--ardo-shadow-lg);">
                    <img src="<?php echo $currentCase['image']; ?>" alt="<?php echo $currentCase['title']; ?>"
                        style="width: 100%; height: 100%; object-fit: cover;">
                </div>
            </div>
        </div>
    </section>

    <!-- About Client Section -->
    <!-- About Client Section -->
    <section style="padding: 60px 0; background: var(--ardo-surface);">
        <div class="container">
            <div style="background: #fff; padding: 3rem; border-radius: 1.5rem; border: 1px solid var(--ardo-border);">
                <span class="text-mono-label"
                    style="color: var(--ardo-primary); display: block; margin-bottom: 1rem;">ACERCA DE
                    <?php echo strtoupper($currentCase['title']); ?></span>
                <p style="font-size: 1.1rem; color: var(--ardo-text-main); line-height: 1.8;">
                    La empresa es una multinacional que se especializa en el diseño y operación de proyectos enfocados a
                    la generación y almacenamiento de energía en todo el planeta.
                </p>
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--ardo-border);">
                    <?php include '../includes/trusted.php'; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Sections -->
    <div class="case-detail-content">



        <!-- Combined Sticky Section: El Reto & La Solución -->
        <!-- Combined Sticky Section: El Reto & La Solución -->
        <section style="padding: 80px 0;">
            <div class="container">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 4rem;">
                    <!-- Left Column: Text -->
                    <div>
                        <div style="margin-bottom: 4rem;">
                            <h2
                                style="font-size: 2rem; font-weight: 800; color: var(--ardo-midnight); margin-bottom: 1.5rem;">
                                El Reto</h2>
                            <div style="font-size: 1.1rem; color: var(--ardo-text-muted); line-height: 1.8;">
                                <?php echo $currentCase['challenge_html']; ?>
                            </div>
                        </div>

                        <div>
                            <h2
                                style="font-size: 2rem; font-weight: 800; color: var(--ardo-midnight); margin-bottom: 1.5rem;">
                                La Solución</h2>
                            <div style="font-size: 1.1rem; color: var(--ardo-text-muted); line-height: 1.8;">
                                <?php echo $currentCase['solution_html']; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Sticky Image -->
                    <div style="position: relative;">
                        <div style="position: sticky; top: 120px;">
                            <div class="bento-card" style="padding: 0; overflow: hidden; height: 500px;">
                                <img src="<?php echo $currentCase['challenge_image']; ?>" alt="El Reto"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Los Resultados Section -->
        <!-- Los Resultados Section -->
        <section style="padding: 80px 0; background: var(--ardo-surface);">
            <div class="container">
                <div style="text-align: center; margin-bottom: 3rem;">
                    <h2 class="text-huge" style="font-size: 3rem; color: var(--ardo-midnight);">Los Resultados</h2>
                </div>

                <div class="bento-grid"
                    style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                    <?php foreach ($currentCase['results'] as $result): ?>
                        <div class="bento-card" style="display: flex; gap: 1rem; align-items: start;">
                            <i class="lni lni-checkmark-circle"
                                style="color: var(--ardo-primary); font-size: 1.5rem; flex-shrink: 0; margin-top: 2px;"></i>
                            <span
                                style="font-size: 1rem; color: var(--ardo-text-main); font-weight: 500; line-height: 1.5;"><?php echo $result; ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Technologies & CTA Split Section -->
        <!-- Technologies & CTA Split Section -->
        <section style="padding: 80px 0;">
            <div class="container">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                    <!-- Technologies Column -->
                    <div class="bento-card">
                        <h2
                            style="font-size: 1.8rem; font-weight: 800; color: var(--ardo-midnight); margin-bottom: 2rem;">
                            La tecnología que usamos para ayudar a <span
                                class="text-cyan"><?php echo isset($currentCase['client_name']) ? $currentCase['client_name'] : $currentCase['title']; ?></span>.
                        </h2>
                        <div style="display: flex; flex-wrap: wrap; gap: 0.8rem;">
                            <?php if (isset($currentCase['technologies'])): ?>
                                <?php foreach ($currentCase['technologies'] as $tech): ?>
                                    <span class="status-indicator"><?php echo $tech; ?></span>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- CTA Column -->
                    <div class="bento-card"
                        style="background: var(--ardo-midnight); color: white; border: none; position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center;">
                        <div style="position: relative; z-index: 2;">
                            <h2 style="font-size: 1.8rem; font-weight: 800; margin-bottom: 2rem; color: white;">¿Está
                                listo para llegar al siguiente nivel?</h2>
                            <a href="https://wa.me/524429803200?text=<?php echo urlencode('¡Me interesa la solución que aplicaron en ' . $currentCase['title'] . '!'); ?>"
                                class="btn-primary" target="_blank">Hablemos <i class="lni lni-whatsapp"></i></a>
                        </div>
                        <!-- Background effect -->
                        <div class="scan-line"></div>
                        <img src="<?php echo $currentCase['image']; ?>"
                            style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; opacity: 0.2; mix-blend-mode: luminosity;"
                            alt="Background">
                    </div>
                </div>
            </div>
        </section>

        <!-- See More Case Studies -->
        <!-- See More Case Studies -->
        <section style="padding: 80px 0; background: var(--ardo-surface);">
            <div class="container">
                <div style="margin-bottom: 3rem; text-align: center;">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1rem;">CASOS DE ESTUDIO
                    </p>
                    <h2 class="text-huge" style="font-size: 2.5rem; color: var(--ardo-midnight);">Ver más Casos de
                        Estudio</h2>
                </div>

                <div class="bento-grid" style="grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
                    <?php
                    $count = 0;
                    foreach ($casos as $case):
                        if ($case['id'] === $currentCase['id'])
                            continue; // Skip current
                        if ($count >= 3)
                            break;
                        ?>
                        <article class="bento-card"
                            onclick="window.location.href='detalle.php?slug=<?php echo $case['slug']; ?>';"
                            style="cursor: pointer; padding: 0; display: flex; flex-direction: column; overflow: hidden; height: 100%; transition: transform 0.3s ease;">

                            <div style="height: 200px; overflow: hidden; position: relative;">
                                <img src="<?php echo str_replace('images/', '../images/', $case['image']); ?>"
                                    alt="<?php echo $case['title']; ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                                <div class="glass-panel"
                                    style="position: absolute; top: 1rem; left: 1rem; padding: 0.5rem 1rem; border-radius: 99px; background: rgba(255,255,255,0.8);">
                                    <span class="text-mono-label"
                                        style="font-size: 0.7rem; color: var(--ardo-midnight);"><?php echo $case['category']; ?></span>
                                </div>
                            </div>

                            <div style="padding: 1.5rem; display: flex; flex-direction: column; flex-grow: 1;">
                                <h3
                                    style="font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; color: var(--ardo-midnight);">
                                    <?php echo $case['title']; ?>
                                </h3>
                                <p
                                    style="color: var(--ardo-text-muted); font-size: 0.9rem; line-height: 1.5; margin-bottom: 1rem; flex-grow: 1;">
                                    <?php echo $case['short_description']; ?>
                                </p>

                                <span class="btn-dark" style="width: 100%; text-align: center; display: block;">Ver
                                    Más</span>
                            </div>
                        </article>
                        <?php
                        $count++;
                    endforeach;
                    ?>
                </div>
            </div>
        </section>

    </div>
</article>

<?php
include '../includes/contact.php';
$showCityLinks = true;
include '../includes/footer.php';
?>