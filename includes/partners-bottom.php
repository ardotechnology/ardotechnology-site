<!-- Brand Partners Section: Unified Design System -->
<section class="brand-partners-redesign"
    style="padding: 100px 0; background: #fff; border-top: 1px solid var(--ardo-border);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 4rem; align-items: center;">

            <!-- Left Info Block -->
            <div class="brand-partners-info">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 1.5rem;">Ecosistema de
                    Confianza</p>
                <h2 class="text-huge" style="font-size: 3.5rem; margin-bottom: 2rem;">Trabajamos con <br>los <span
                        class="text-cyan">Mejores</span>.</h2>
                <p style="color: var(--ardo-text-muted); font-size: 1.1rem; line-height: 1.8; max-width: 450px;">
                    Para garantizar la continuidad operativa y el máximo rendimiento, nos aliamos con los líderes
                    globales en infraestructura y telecomunicaciones.
                </p>
            </div>

            <!-- Right Logos Grid: Bento style mini-cards -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">

                <!-- Logo 1: Oracle -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/oci-med.webp" alt="Oracle Cloud"
                        style="max-width: 100%; max-height: 40px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

                <!-- Logo 2: Yeastar -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/yeastar-768x308-1-300x120.webp" alt="Yeastar"
                        style="max-width: 100%; max-height: 35px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

                <!-- Logo 3: Alestra -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/alestra-300x300.webp" alt="Alestra"
                        style="max-width: 100%; max-height: 40px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

                <!-- Logo 4: Microsoft -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/microsoft-300x78.webp" alt="Microsoft"
                        style="max-width: 100%; max-height: 25px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

                <!-- Logo 5: Awards -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/Award_logoConnect_Professional_-Products_of_the_Year_2024_Best_PBX_System.webp"
                        alt="Award 2024"
                        style="max-width: 100%; max-height: 50px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

                <!-- Logo 6: Zoiper -->
                <div class="bento-card"
                    style="padding: 2rem; display: flex; align-items: center; justify-content: center; height: 120px;">
                    <img src="https://ardo.technology/images/Tested-with-Zoiper-300px.webp" alt="Zoiper"
                        style="max-width: 100%; max-height: 40px; filter: grayscale(100%); opacity: 0.6; transition: all 0.3s;"
                        onmouseover="this.style.filter='grayscale(0%)'; this.style.opacity='1';"
                        onmouseout="this.style.filter='grayscale(100%)'; this.style.opacity='0.6';">
                </div>

            </div>
        </div>
    </div>
</section>

<style>
    @media (max-width: 1024px) {
        .brand-partners-redesign div[style*="grid-template-columns: 1fr 1.5fr"] {
            grid-template-columns: 1fr !important;
            text-align: center;
        }

        .brand-partners-info {
            margin-bottom: 3rem;
        }

        .brand-partners-info p {
            margin-left: auto;
            margin-right: auto;
        }

        .brand-partners-redesign div[style*="grid-template-columns: repeat(3, 1fr)"] {
            grid-template-columns: repeat(2, 1fr) !important;
        }
    }

    @media (max-width: 600px) {
        .brand-partners-redesign div[style*="grid-template-columns: repeat(2, 1fr)"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>