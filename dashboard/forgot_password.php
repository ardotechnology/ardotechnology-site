<?php
require_once 'auth.php';

// Handle AJAX recovery request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email']) && !empty($_POST['email'])) {
    header('Content-Type: application/json');
    $email = trim($_POST['email']);

    // 1. Call CRM API directly for password reset
    // This allows recovery for both synced and non-synced (CRM-only) users.
    $apiResult = api_call('login/forgot_password', 'POST', ['email' => $email]);

    if (isset($apiResult['status']) && $apiResult['status'] === true) {
        echo json_encode(['status' => true, 'message' => 'Se han enviado las instrucciones de recuperación a tu correo.']);
    } else {
        // If the CRM says it's not found or inactive, report it.
        $msg = $apiResult['message'] ?? 'El correo electrónico no está registrado o la cuenta está inactiva.';
        echo json_encode(['status' => false, 'message' => $msg]);
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña | ARDO Technology</title>

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- LineIcons 5.0 -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --ardo-primary: #00F0FF;
            --ardo-midnight: #050505;
            --ardo-border: #E2E8F0;
            --ardo-surface: #F8FAFC;
            --ardo-text-muted: #64748B;
            --font-display: 'Inter', sans-serif;
            --font-mono: 'JetBrains Mono', monospace;
            --ardo-shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: var(--font-display);
            margin: 0;
            background: var(--ardo-surface);
            color: var(--ardo-midnight);
        }

        .form-group-custom {
            margin-bottom: 1.25rem;
        }

        .form-label-custom {
            display: block;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 0.7rem;
            margin-bottom: 0.4rem;
            color: var(--ardo-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control-custom {
            width: 100%;
            background-color: #fff;
            border: 1px solid var(--ardo-border);
            border-radius: 0.4rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            transition: all 0.2s;
            font-family: var(--font-display);
            color: var(--ardo-midnight);
            box-sizing: border-box;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: var(--ardo-primary);
            box-shadow: 0 0 0 4px rgba(0, 240, 255, 0.1);
        }

        .btn-dark {
            background: var(--ardo-midnight);
            color: #fff;
            padding: 1rem;
            border-radius: 4px;
            font-family: var(--font-mono);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: opacity 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .btn-dark:hover {
            opacity: 0.9;
        }

        .btn-dark:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .text-mono-label {
            font-family: var(--font-mono);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        .text-cyan {
            color: var(--ardo-primary);
        }

        @media (max-width: 768px) {
            .registration-info-side {
                display: none !important;
            }

            .registration-form-side {
                padding: 2rem !important;
            }
        }
    </style>
</head>

<body class="antialiased">
    <section
        style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;">
        <div style="width: 100%; max-width: 1000px; transform: translateY(-50px);">

            <div style="margin-bottom: 2.5rem; display: flex; justify-content: center;">
                <a href="../">
                    <img src="../images/logo.svg" alt="Ardo Technology" style="height: 42px;">
                </a>
            </div>

            <div class="bento-card"
                style="padding: 0; display: flex; flex-direction: row; overflow: hidden; box-shadow: var(--ardo-shadow-lg); border-radius: 2rem; background: #fff;"
                x-data="{ email: '', loading: false, msg: '', error: false }">

                <!-- Left Side: Recovery Form -->
                <div class="registration-form-side" style="flex: 1; padding: 4rem 3.5rem; background: #fff;">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 0.5rem;">SEGURIDAD</p>
                    <h1
                        style="font-size: 2.2rem; font-weight: 900; margin-bottom: 0.5rem; color: var(--ardo-midnight); letter-spacing: -0.05em; text-transform: uppercase;">
                        Recuperar
                    </h1>
                    <p style="color: var(--ardo-text-muted); margin-bottom: 2.5rem; font-size: 0.95rem;">
                        Ingresa tu correo para recibir las instrucciones de acceso.
                    </p>

                    <!-- Feedback Legend -->
                    <div x-show="msg" x-transition
                        :class="error ? 'bg-red-50 border-red-200 text-red-700' : 'bg-green-50 border-green-200 text-green-700'"
                        style="margin-bottom: 2rem; padding: 1.25rem; border-radius: 0.5rem; border: 1px solid; font-size: 0.85rem; font-weight: 600; font-family: var(--font-mono); text-transform: uppercase;"
                        x-cloak>
                        <i :class="error ? 'lni lni-warning' : 'lni lni-checkmark-circle'"
                            style="margin-right: 10px;"></i>
                        <span x-text="msg"></span>
                    </div>

                    <form @submit.prevent="
                        loading = true;
                        msg = 'Procesando...';
                        error = false;
                        
                        const params = new URLSearchParams();
                        params.append('email', email);

                        fetch('', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                            body: params
                        })
                        .then(async r => {
                            const data = await r.json().catch(() => null);
                            if (!r.ok) {
                                throw new Error(data?.message || `Error del servidor (${r.status})`);
                            }
                            return data;
                        })
                        .then(data => {
                            loading = false;
                            msg = data?.message || 'Solicitud procesada';
                            error = !data?.status;
                        })
                        .catch(e => {
                            loading = false;
                            console.error('Local Recovery Error:', e);
                            msg = e.message;
                            error = true;
                        });
                    ">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Correo Electrónico <span style="color:red">*</span></label>
                            <input type="email" x-model="email" class="form-control-custom"
                                placeholder="tucorreo@ejemplo.com" required :disabled="loading">
                        </div>

                        <button type="submit" class="btn-dark" style="margin-top: 2rem; padding: 1.1rem 0;"
                            :disabled="loading">
                            <span x-show="!loading">RECUPERAR CONTRASEÑA <i class="lni lni-reload"
                                    style="margin-left:8px"></i></span>
                            <span x-show="loading">ENVIANDO...</span>
                        </button>

                        <div
                            style="text-align: center; margin-top: 2.5rem; font-size: 0.85rem; color: var(--ardo-text-muted);">
                            <a href="login.php"
                                style="color: var(--ardo-midnight); font-weight: 700; text-decoration: none; font-family: var(--font-mono); text-transform: uppercase;">&larr;
                                Volver al Inicio</a>
                        </div>
                    </form>
                </div>

                <!-- Right Side: Info Panel -->
                <div class="registration-info-side"
                    style="flex: 1.1; position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center; padding: 4rem; background: var(--ardo-midnight); color: #fff;">

                    <canvas id="gradient-canvas"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></canvas>

                    <div style="position: relative; z-index: 2;">
                        <i class="lni lni-lock"
                            style="font-size: 3rem; color: var(--ardo-primary); margin-bottom: 2rem;"></i>
                        <h2
                            style="font-size: 2.8rem; font-weight: 900; margin-bottom: 1.5rem; line-height: 1; letter-spacing: -0.04em; text-transform: uppercase;">
                            Acceso <br><span class="text-cyan">Seguro</span>.
                        </h2>
                        <p
                            style="font-size: 1.1rem; line-height: 1.6; color: rgba(255,255,255,0.85); margin-bottom: 2.5rem;">
                            Tu seguridad es nuestra prioridad. Sigue los pasos enviados a tu correo para restablecer tu
                            llave de acceso al Grid.
                        </p>

                        <div>
                            <p class="text-mono-label" style="opacity: 0.5; margin-bottom: 1.25rem; color: #fff;">TECH
                                STACK PARTNERS</p>
                            <div
                                style="display: flex; gap: 2.5rem; font-family: var(--font-mono); font-size: 0.8rem; font-weight: 700; opacity: 0.8; color: #fff;">
                                <span>ORACLE CLOUD INFRAESTRUCTURE</span>
                                <span>DIGITAL OCEAN</span>
                                <span>YEASTAR</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gradient Script -->
    <script>
        (function () {
            const canvas = document.getElementById('gradient-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width, height, time = 0;
            const colors = [[10, 25, 47], [0, 240, 255], [32, 69, 140], [5, 5, 5]];

            function resize() {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
            }

            function loop() {
                time += 0.005;
                ctx.fillStyle = `rgb(${colors[3][0]}, ${colors[3][1]}, ${colors[3][2]})`;
                ctx.fillRect(0, 0, width, height);

                const drawOrb = (xMod, yMod, rMod, colorIdx, alpha) => {
                    const x = xMod * width; const y = yMod * height; const r = rMod * width;
                    const g = ctx.createRadialGradient(x, y, 0, x, y, r);
                    const c = colors[colorIdx];
                    g.addColorStop(0, `rgba(${c[0]}, ${c[1]}, ${c[2]}, ${alpha})`);
                    g.addColorStop(1, `rgba(${c[0]}, ${c[1]}, ${c[2]}, 0)`);
                    ctx.fillStyle = g; ctx.beginPath(); ctx.arc(x, y, r, 0, Math.PI * 2); ctx.fill();
                };

                drawOrb(Math.sin(time) * 0.5 + 0.5, Math.cos(time * 0.5) * 0.5 + 0.5, 0.8, 1, 0.4);
                drawOrb(Math.cos(time * 0.8) * 0.5 + 0.5, Math.sin(time * 0.3) * 0.5 + 0.5, 0.6, 2, 0.3);
                drawOrb(Math.sin(time * 1.2) * 0.3 + 0.7, Math.cos(time * 1.1) * 0.3 + 0.3, 0.9, 0, 0.5);

                requestAnimationFrame(loop);
            }

            window.addEventListener('resize', resize);
            resize();
            loop();
        })();
    </script>
</body>

</html>