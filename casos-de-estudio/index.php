<?php
$pageTitle = "Casos de Estudio | ARDO Technology";
$pageDescription = "Descubre cómo hemos ayudado a empresas a transformar sus comunicaciones y operaciones con nuestras soluciones tecnológicas.";
$basePath = '../';
include '../includes/header.php';
include 'data.php';
?>

<div class="header-spacer"></div>

<section class="hero-internal"
    style="position: relative; padding: 60px 0 60px; display: flex; align-items: center; background: #fff;">
    <div class="container">
        <div style="text-align: center; max-width: 900px; margin: 0 auto;">
            <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">IMPLEMENTACIONES</p>
            <h1 class="text-huge"
                style="color: var(--ardo-midnight); font-size: clamp(2.5rem, 5vw, 4rem); margin-bottom: 2rem; line-height: 1.1;">
                Casos de <span class="text-cyan">Estudio</span>.
            </h1>
            <p
                style="color: var(--ardo-text-muted); font-size: 1.2rem; max-width: 700px; margin: 0 auto; line-height: 1.6;">
                Explora nuestros proyectos más destacados y conoce cómo nuestras soluciones de infraestructura, VOIP y
                desarrollo de software generan resultados reales.
            </p>
        </div>
    </div>
</section>

<section style="padding-bottom: 80px; background: #fff;">
    <div class="container">
        <div class="bento-grid" style="grid-template-columns: repeat(auto-fit, minmax(350px, 1fr)); gap: 2rem;">
            <?php foreach ($casos as $case): ?>
                <article class="bento-card" onclick="window.location.href='detalle.php?slug=<?php echo $case['slug']; ?>';"
                    style="cursor: pointer; padding: 0; display: flex; flex-direction: column; height: 100%; transition: transform 0.3s ease;">

                    <div style="height: 240px; overflow: hidden; position: relative;">
                        <img src="<?php echo $case['image']; ?>" alt="<?php echo $case['title']; ?>"
                            style="width: 100%; height: 100%; object-fit: cover;">
                        <div class="glass-panel"
                            style="position: absolute; top: 1rem; left: 1rem; padding: 0.5rem 1rem; border-radius: 99px; background: rgba(255,255,255,0.8);">
                            <span class="text-mono-label"
                                style="font-size: 0.7rem; color: var(--ardo-midnight);"><?php echo $case['category']; ?></span>
                        </div>
                    </div>

                    <div style="padding: 2rem; display: flex; flex-direction: column; flex-grow: 1;">
                        <h3 style="font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem; color: var(--ardo-midnight);">
                            <?php echo $case['title']; ?>
                        </h3>
                        <p
                            style="color: var(--ardo-text-muted); font-size: 0.95rem; line-height: 1.6; margin-bottom: 1.5rem; flex-grow: 1;">
                            <?php echo $case['short_description']; ?>
                        </p>

                        <div style="margin-top: auto;">
                            <?php if (isset($case['features']) && is_array($case['features'])): ?>
                                <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                                    <?php foreach (array_slice($case['features'], 0, 3) as $feature): // Show max 3 features ?>
                                        <li
                                            style="display: flex; align-items: start; gap: 0.5rem; font-size: 0.85rem; color: var(--ardo-text-muted); margin-bottom: 0.5rem;">
                                            <i class="lni lni-check-circle"
                                                style="color: var(--ardo-primary); margin-top: 2px;"></i> <?php echo $feature; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>

                            <span class="btn-dark"
                                style="padding: 0.75rem 1.5rem; width: 100%; text-align: center; display: block;">
                                Ver Caso Completo
                            </span>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php
include '../includes/contact.php';
$showCityLinks = true;
include '../includes/footer.php';
?>