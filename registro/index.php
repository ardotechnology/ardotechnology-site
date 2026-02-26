<?php
require_once '../includes/SeoHelper.php';
$seoConfig = SeoHelper::load('home'); // Adjust SEO as needed or create a new one
$basePath = '../';
include '../includes/header.php';
?>

<style>
    /* Registration Page Specific Overrides */
    .promo-link {
        display: inline-block;
        margin-top: 0.1rem;
        color: var(--ardo-midnight);
        text-decoration: underline;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
    }

    /* Toggle Switch */
    .account-toggle {
        display: flex;
        background: var(--ardo-surface);
        padding: 4px;
        border-radius: 99px;
        margin-bottom: 1.5rem;
        width: 100%;
        border: 1px solid var(--ardo-border);
    }

    .toggle-btn {
        flex: 1;
        border: none;
        background: transparent;
        padding: 0.75rem 0;
        border-radius: 99px;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
        cursor: pointer;
        transition: all 0.3s ease;
        color: var(--ardo-text-muted);
        letter-spacing: 0.1em;
    }

    .toggle-btn.active {
        background-color: var(--ardo-midnight);
        color: #fff;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    /* Custom Input Styles matching Design System */
    .form-group-custom {
        margin-bottom: 0.75rem;
    }

    .form-label-custom {
        display: block;
        font-family: var(--font-mono);
        font-weight: 700;
        font-size: 0.7rem;
        margin-bottom: 0.3rem;
        color: var(--ardo-text-muted);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .form-control-custom {
        width: 100%;
        background-color: #fff;
        border: 1px solid var(--ardo-border);
        border-radius: 0.4rem;
        padding: 0.6rem 0.8rem;
        font-size: 0.9rem;
        transition: all 0.2s;
        font-family: var(--font-display);
        color: var(--ardo-midnight);
    }

    .form-control-custom:focus {
        outline: none;
        border-color: var(--ardo-primary);
        box-shadow: 0 0 0 4px rgba(0, 240, 255, 0.1);
    }

    /* Checkboxes */
    .checkbox-group {
        margin-top: 1rem;
    }

    .custom-check {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        margin-bottom: 0.5rem;
        font-size: 0.8rem;
        color: var(--ardo-text-muted);
        line-height: 1.4;
        cursor: pointer;
    }

    .custom-check input[type="checkbox"] {
        margin-top: 3px;
        accent-color: var(--ardo-midnight);
        width: 16px;
        height: 16px;
    }

    .custom-check a {
        color: var(--ardo-midnight);
        text-decoration: underline;
        font-weight: 600;
    }

    /* Mobile Adjustments */
    @media (max-width: 768px) {
        .registration-flex-container {
            flex-direction: column !important;
        }

        .registration-info-side {
            display: none !important;
        }

        .registration-form-side {
            padding: 1.5rem !important;
        }

        .name-row {
            flex-direction: column !important;
            gap: 0 !important;
        }
    }
</style>

<section
    style="min-height: 100vh; display: flex; align-items: center; padding: 40px 20px 40px; background: var(--ardo-surface);">
    <div class="container" style="max-width: 1000px;">
        <div class="bento-card registration-flex-container"
            style="padding: 0; display: flex; flex-direction: row; overflow: hidden; box-shadow: var(--ardo-shadow-lg);">

            <!-- Left Side: Form -->
            <div class="registration-form-side" style="flex: 1; padding: 2rem 2.5rem; background: #fff;">
                <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 0.5rem;">BIENVENIDO</p>
                <h1
                    style="font-size: 1.8rem; font-weight: 900; margin-bottom: 0.25rem; color: var(--ardo-midnight); letter-spacing: -0.05em; text-transform: uppercase;">
                    Crea tu cuenta</h1>
                <p style="color: var(--ardo-text-muted); margin-bottom: 1.5rem; font-size: 0.9rem;">Elige la opción que
                    mejor funcione para
                    ti.</p>

                <div class="account-toggle">
                    <button type="button" class="toggle-btn active" data-type="business">Empresarial</button>
                    <button type="button" class="toggle-btn" data-type="personal">Personal</button>
                </div>

                <form id="registroForm" action="process.php" method="POST">
                    <input type="hidden" name="account_type" id="accountType" value="business">

                    <div class="form-group-custom" id="companyGroup">
                        <label class="form-label-custom">Nombre de la empresa <span style="color:red">*</span></label>
                        <input type="text" name="company" id="companyInput" class="form-control-custom"
                            placeholder="Tu Empresa SA de CV" required>
                    </div>

                    <div class="name-row" style="display: flex; gap: 1rem;">
                        <div style="flex: 1;">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Nombre <span style="color:red">*</span></label>
                                <input type="text" name="firstname" class="form-control-custom" required>
                            </div>
                        </div>
                        <div style="flex: 1;">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Apellido <span style="color:red">*</span></label>
                                <input type="text" name="lastname" class="form-control-custom" required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Email <span style="color:red">*</span></label>
                        <input type="email" name="email" class="form-control-custom" placeholder="tucorreo@ejemplo.com"
                            required>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Teléfono <span style="color:red">*</span></label>
                        <input type="tel" name="phonenumber" class="form-control-custom" placeholder="55 1234 5678"
                            required>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Contraseña <span style="color:red">*</span></label>
                        <input type="password" name="password" class="form-control-custom" required>
                    </div>

                    <div class="checkbox-group">
                        <label class="custom-check">
                            <input type="checkbox" required>
                            <span>Acepto los <a href="https://ardo.technology/tyc/" target="_blank">Términos y
                                    Condiciones</a> y la <a href="https://ardo.technology/aviso-de-privacidad/"
                                    target="_blank">Política de
                                    Privacidad</a>.</span>
                        </label>
                        <label class="custom-check">
                            <input type="checkbox">
                            <span>Quiero recibir noticias importantes.</span>
                        </label>
                    </div>

                    <div id="formMessage"></div>

                    <button type="submit" class="btn-dark" id="btnSubmit"
                        style="width: 100%; justify-content: center; margin-top: 1.5rem; padding: 0.8rem;">
                        <span class="btn-text">REGISTRARME</span>
                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                            style="margin-left:8px; border: 2px solid #fff; border-right-color: transparent; border-radius: 50%; width: 1rem; height: 1rem; animation: spinner-border .75s linear infinite;"></span>
                    </button>

                    <div
                        style="text-align: center; margin-top: 1rem; font-size: 0.85rem; color: var(--ardo-text-muted);">
                        ¿Ya tienes cuenta? <a href="https://dashboard.ardo.technology"
                            style="color: var(--ardo-midnight); font-weight: 700; text-decoration: none;">Inicia sesión
                            &rarr;</a>
                    </div>
                </form>
            </div>

            <!-- Right Side: Info (Dynamic Stripe-like Gradient) -->
            <div class="registration-info-side"
                style="flex: 1; position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center; padding: 3rem; color: #fff;">

                <!-- Dynamic Gradient Canvas -->
                <canvas id="gradient-canvas"
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; --gradient-color-1: #0A192F; --gradient-color-2: #00F0FF; --gradient-color-3: #20458C; --gradient-color-4: #050505;"></canvas>

                <!-- Content Overlay -->
                <div style="position: relative; z-index: 2; max-width: 400px; margin: 0 auto; padding: 2rem;">
                    <i class="lni lni-rocket"
                        style="font-size: 2.5rem; color: var(--ardo-primary); margin-bottom: 1.5rem;"></i>
                    <h2 class="text-huge" style="font-size: 2.2rem; margin-bottom: 1rem; color: #fff; line-height: 1;">
                        Impulsa Tu <span class="text-cyan">Negocio</span>.</h2>
                    <p style="font-size: 1rem; line-height: 1.5; color: rgba(255,255,255,0.9); margin-bottom: 2rem;">
                        Todo lo que necesitas para escalar tus operaciones de manera segura y eficiente.
                    </p>

                    <ul style="list-style: none; padding: 0; margin-bottom: 2rem;">
                        <li style="display: flex; gap: 10px; margin-bottom: 1rem; align-items: center; color: #fff;">
                            <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                            Números virtuales globales
                        </li>
                        <li style="display: flex; gap: 10px; margin-bottom: 1rem; align-items: center; color: #fff;">
                            <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                            Soporte prioritario 24/7
                        </li>
                        <li style="display: flex; gap: 10px; margin-bottom: 1rem; align-items: center; color: #fff;">
                            <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                            Seguridad empresarial
                        </li>
                    </ul>

                    <div>
                        <p class="text-mono-label" style="opacity: 0.7; margin-bottom: 1rem; color: #fff;">CONFIAN EN
                            NOSOTROS</p>
                        <div
                            style="display: flex; gap: 20px; opacity: 0.9; font-family: var(--font-mono); font-weight: 700;">
                            <span>TSK</span>
                            <span>KROW</span>
                            <span>XELEX</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- MiniGradient V1 Script (Lightweight Stripe-like Mesh) -->
<script>
    (function () {
        const canvas = document.getElementById('gradient-canvas');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        let width, height;
        let time = 0;

        // Configuration
        const colors = [
            [10, 25, 47],    // Deep Blue
            [0, 240, 255],   // Cyan
            [32, 69, 140],   // Medium Blue
            [5, 5, 5]        // Midnight
        ];

        function resize() {
            width = canvas.width = canvas.offsetWidth;
            height = canvas.height = canvas.offsetHeight;
        }

        function loop() {
            time += 0.005;

            // Create gradient
            // We draw large moving circles to simulate mesh
            ctx.fillStyle = `rgb(${colors[3][0]}, ${colors[3][1]}, ${colors[3][2]})`;
            ctx.fillRect(0, 0, width, height);

            // Orb 1
            const x1 = Math.sin(time) * width * 0.5 + width * 0.5;
            const y1 = Math.cos(time * 0.5) * height * 0.5 + height * 0.5;
            const r1 = width * 0.8;

            const g1 = ctx.createRadialGradient(x1, y1, 0, x1, y1, r1);
            g1.addColorStop(0, `rgba(${colors[1][0]}, ${colors[1][1]}, ${colors[1][2]}, 0.4)`);
            g1.addColorStop(1, `rgba(${colors[1][0]}, ${colors[1][1]}, ${colors[1][2]}, 0)`);
            ctx.fillStyle = g1;
            ctx.beginPath(); ctx.arc(x1, y1, r1, 0, Math.PI * 2); ctx.fill();

            // Orb 2
            const x2 = Math.cos(time * 0.8) * width * 0.5 + width * 0.5;
            const y2 = Math.sin(time * 0.3) * height * 0.5 + height * 0.5;
            const r2 = width * 0.6;

            const g2 = ctx.createRadialGradient(x2, y2, 0, x2, y2, r2);
            g2.addColorStop(0, `rgba(${colors[2][0]}, ${colors[2][1]}, ${colors[2][2]}, 0.4)`);
            g2.addColorStop(1, `rgba(${colors[2][0]}, ${colors[2][1]}, ${colors[2][2]}, 0)`);
            ctx.fillStyle = g2;
            ctx.beginPath(); ctx.arc(x2, y2, r2, 0, Math.PI * 2); ctx.fill();

            // Orb 3
            const x3 = Math.sin(time * 1.2) * width * 0.3 + width * 0.7;
            const y3 = Math.cos(time * 1.1) * height * 0.3 + height * 0.3;
            const r3 = width * 0.9;

            const g3 = ctx.createRadialGradient(x3, y3, 0, x3, y3, r3);
            g3.addColorStop(0, `rgba(${colors[0][0]}, ${colors[0][1]}, ${colors[0][2]}, 0.5)`);
            g3.addColorStop(1, `rgba(${colors[0][0]}, ${colors[0][1]}, ${colors[0][2]}, 0)`);
            ctx.fillStyle = g3;
            ctx.beginPath(); ctx.arc(x3, y3, r3, 0, Math.PI * 2); ctx.fill();


            requestAnimationFrame(loop);
        }

        window.addEventListener('resize', resize);
        resize();
        loop();
    })();
</script>

<script>
    // Toggle Logic
    const toggles = document.querySelectorAll('.toggle-btn');
    const companyGroup = document.getElementById('companyGroup');
    const companyInput = document.getElementById('companyInput');
    const accountTypeInput = document.getElementById('accountType');

    toggles.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active from all
            toggles.forEach(t => t.classList.remove('active'));
            // Add active to clicked
            btn.classList.add('active');

            const type = btn.dataset.type;
            accountTypeInput.value = type;

            if (type === 'personal') {
                companyGroup.style.display = 'none';
                companyInput.required = false;
                companyInput.value = ''; // clear data? or allow keeping it? Better clear or ignore.
            } else {
                companyGroup.style.display = 'block';
                companyInput.required = true;
            }
        });
    });

    // Form Submit Logic
    document.getElementById('registroForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const form = this;
        const btn = document.getElementById('btnSubmit');
        const msgDiv = document.getElementById('formMessage');
        const btnText = btn.querySelector('.btn-text');
        const spinner = btn.querySelector('.spinner-border');

        // Reset styles
        msgDiv.innerHTML = '';
        msgDiv.className = 'mt-3 text-center';
        btn.disabled = true;
        btnText.style.display = 'none';

        // Ensure spinner is visible
        spinner.classList.remove('d-none');
        spinner.style.display = 'inline-block'; // explicit fallback

        const formData = new FormData(form);

        fetch('process.php', {
            method: 'POST',
            body: formData
        })
            .then(response => response.text())
            .then(text => {
                try {
                    const data = JSON.parse(text);
                    if (data.status === 'success') {
                        msgDiv.innerHTML = '<div class="alert alert-success" style="color: green; margin-bottom: 20px; font-weight: bold;">' + data.message + '</div><p class="text-sm text-gray-500 mb-4">Redirigiendo al dashboard...</p>';
                        form.reset();

                        // Redirect to dashboard after a short delay
                        setTimeout(() => {
                            window.location.href = '../dashboard/';
                        }, 2000);
                    } else {
                        msgDiv.innerHTML = '<div class="alert alert-danger" style="color: red; margin-bottom: 10px;">' + (data.message || 'Ocurrió un error') + '</div>';
                    }
                } catch (e) {
                    console.error('Invalid JSON:', text);
                    msgDiv.innerHTML = '<div class="alert alert-danger" style="color: red; margin-bottom: 10px;">Error del servidor (Respuesta inválida).</div>';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                msgDiv.innerHTML = '<div class="alert alert-danger" style="color: red; margin-bottom: 10px;">Error de conexión.</div>';
            })
            .finally(() => {
                // Always reset button state
                btn.disabled = false;
                btnText.style.display = 'inline-block';
                spinner.classList.add('d-none');
                spinner.style.display = 'none'; // explicit fallback
            });
    });
</script>

<!-- Spinner Animation and Utilities -->
<style>
    @keyframes spinner-border {
        to {
            transform: rotate(360deg);
        }
    }

    .d-none {
        display: none !important;
    }
</style>

<?php include '../includes/footer.php'; ?>