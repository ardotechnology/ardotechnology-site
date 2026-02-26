<!-- Brand Partners Section: Premium 2-Column Layout -->
<section class="brand-partners-redesign"
    style="padding: 120px 0; background: #fff; border-top: 1px solid var(--ardo-border);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 5rem; align-items: flex-start;">

            <!-- Left Header Block -->
            <div class="brand-partners-info">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Ecosistema de
                    Confianza</p>
                <h2 class="text-huge"
                    style="font-size: clamp(2.5rem, 4vw, 3.5rem); color: var(--ardo-midnight); margin-bottom: 2rem; line-height: 1.1;">
                    Trabajamos con <br>los <span class="text-cyan">Mejores</span>.
                </h2>
                <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; max-width: 480px;">
                    Para garantizar la continuidad operativa y el máximo rendimiento, nos aliamos con los líderes
                    globales en infraestructura y telecomunicaciones.
                </p>
            </div>

            <!-- Right Content Block -->
            <div class="brand-partners-content">
                <!-- Featured Image / Case Study Image (Above logos) -->
                <div
                    style="margin-bottom: 3rem; border-radius: 2rem; overflow: hidden; box-shadow: 0 30px 60px rgba(0,0,0,0.06); border: 1px solid rgba(0,0,0,0.03);">
                    <img src="https://ardo.technology/images/oracle.jpg" alt="Oracle & ARDO Case Study"
                        style="width: 100%; display: block;">
                </div>

                <!-- Logo Grid -->
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
                    <?php
                    $partners = [
                        ['name' => 'Oracle Cloud', 'url' => 'https://ardo.technology/images/oci-med.webp', 'height' => '40px'],
                        ['name' => 'Yeastar', 'url' => 'https://ardo.technology/images/yeastar-768x308-1-300x120.webp', 'height' => '35px'],
                        ['name' => 'Alestra', 'url' => 'https://ardo.technology/images/alestra-300x300.webp', 'height' => '40px'],
                        ['name' => 'Microsoft', 'url' => 'https://ardo.technology/images/microsoft-300x78.webp', 'height' => '25px'],
                        ['name' => 'Award 2024', 'url' => 'https://ardo.technology/images/Award_logoConnect_Professional_-Products_of_the_Year_2024_Best_PBX_System.webp', 'height' => '50px'],
                        ['name' => 'Zoiper', 'url' => 'https://ardo.technology/images/Tested-with-Zoiper-300px.webp', 'height' => '40px'],
                    ];
                    foreach ($partners as $partner):
                        ?>
                        <div class="partner-logo-box"
                            style="background: var(--ardo-surface); border: 1px solid var(--ardo-border); border-radius: 1.5rem; height: 110px; display: flex; align-items: center; justify-content: center; padding: 1.5rem; transition: all 0.3s ease;">
                            <img src="<?php echo $partner['url']; ?>" alt="<?php echo $partner['name']; ?>"
                                style="max-width: 85%; max-height: <?php echo $partner['height']; ?>; filter: grayscale(100%); opacity: 0.5; transition: all 0.3s;">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
    .partner-logo-box:hover {
        background: #fff !important;
        border-color: var(--ardo-primary) !important;
        box-shadow: 0 10px 25px rgba(0, 240, 255, 0.1);
        transform: translateY(-3px);
    }

    .partner-logo-box:hover img {
        filter: grayscale(0%) !important;
        opacity: 1 !important;
    }

    @media (max-width: 1024px) {
        .brand-partners-redesign div[style*="grid-template-columns: 1fr 1.5fr"] {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }

        .brand-partners-info {
            position: static !important;
            text-align: center;
            margin-bottom: 3rem;
        }

        .brand-partners-info p {
            margin-left: auto;
            margin-right: auto;
        }
    }

    @media (max-width: 600px) {
        .brand-partners-content div[style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }
</style>