<?php
// dashboard/login.php
require_once 'auth.php';

if (is_logged_in()) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        // API-BASED AUTHENTICATION
        // We validate credentials against the central CRM API.
        try {
            $response = api_call('login/login_api', 'POST', ['email' => $email, 'password' => $password]);

            // Log API response for debugging (production)
            error_log("[Dashboard Login] API Response: " . json_encode($response));

            if (isset($response['status']) && $response['status'] === true && !empty($response['data'])) {
                $apiUser = $response['data'];

                // Sync with local DB
                $conn = get_db_connection();

                // Check if user exists locally
                $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $localRes = $stmt->get_result();

                if ($localUser = $localRes->fetch_assoc()) {
                    // Update existing user (Sync)
                    // We re-hash the password to keep it in sync locally (optional but good for redundancy)
                    // Actually, we should just update the ID ref or session.
                    // But let's update password so old auth (if ever reverted) works, or for completeness.
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $updateStmt = $conn->prepare("UPDATE users SET password = ?, firstname = ?, lastname = ?, active = 1, updated_at = NOW() WHERE id = ?");
                    $updateStmt->bind_param("sssi", $newHash, $apiUser['firstname'], $apiUser['lastname'], $localUser['id']);
                    $updateStmt->execute();
                    $updateStmt->close();

                    $_SESSION['user_id'] = $localUser['id'];
                } else {
                    // Create new local user (Auto-Provision)
                    $newHash = password_hash($password, PASSWORD_DEFAULT);
                    $insertStmt = $conn->prepare("INSERT INTO users (email, password, firstname, lastname, company_name, client_id, contact_id, active, created_at, updated_at, onboarding_status) VALUES (?, ?, ?, ?, ?, ?, ?, 1, NOW(), NOW(), 'verified')");

                    // Fields from API might differ slightly, map carefully
                    $company = $apiUser['company'] ?? 'Unknown';
                    $clientId = $apiUser['userid'] ?? 0;
                    $contactId = $apiUser['id'] ?? 0;

                    $insertStmt->bind_param("sssssii", $email, $newHash, $apiUser['firstname'], $apiUser['lastname'], $company, $clientId, $contactId);
                    $insertStmt->execute();
                    $_SESSION['user_id'] = $insertStmt->insert_id;
                    $insertStmt->close();
                }

                $stmt->close();
                $conn->close();

                // Set authoritative session IDs immediately
                $_SESSION['real_client_id'] = $apiUser['userid'];
                $_SESSION['real_contact_id'] = $apiUser['id'];

                header("Location: index.php");
                exit;

            } else {
                $error = $response['message'] ?? "Credenciales incorrectas.";
                // Log failed login attempt
                error_log("[Dashboard Login] Failed login for: $email | Response: " . json_encode($response));
            }
        } catch (Exception $e) {
            $error = "Error de conexión con el servidor. Intenta nuevamente.";
            error_log("[Dashboard Login] Exception during login: " . $e->getMessage());
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso al Sistema | ARDO Technology</title>

    <!-- Google Fonts: Inter & JetBrains Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&family=JetBrains+Mono:wght@400;500;700&display=swap"
        rel="stylesheet">

    <!-- Design System CSS -->
    <link rel="stylesheet" href="../css/design_system.css?v=<?php echo time(); ?>">

    <!-- LineIcons 5.0 -->
    <link rel="stylesheet" href="https://cdn.lineicons.com/5.0/lineicons.css">

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
                style="padding: 0; display: flex; flex-direction: row; overflow: hidden; box-shadow: var(--ardo-shadow-lg); border-radius: 2rem; background: #fff;">

                <!-- Left Side: Login Form -->
                <div class="registration-form-side" style="flex: 1; padding: 3.5rem; background: #fff;">
                    <p class="text-mono-label" style="color: var(--ardo-primary); margin-bottom: 0.5rem;">BIENVENIDO</p>
                    <h1
                        style="font-size: 2.2rem; font-weight: 900; margin-bottom: 0.5rem; color: var(--ardo-midnight); letter-spacing: -0.05em; text-transform: uppercase;">
                        Inicia Sesión
                    </h1>
                    <p style="color: var(--ardo-text-muted); margin-bottom: 2.5rem; font-size: 0.95rem;">
                        Accede a tu cuenta institucional y gestiona tu infraestructura.
                    </p>

                    <?php if ($error): ?>
                        <div
                            style="margin-bottom: 2rem; padding: 1rem; border-radius: 0.5rem; background: #FEF2F2; border: 1px solid #FCA5A5; color: #991B1B; font-size: 0.85rem; font-weight: 600; font-family: var(--font-mono); text-transform: uppercase;">
                            <i class="lni lni-warning" style="margin-right: 8px;"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" id="login-form">
                        <div class="form-group-custom">
                            <label class="form-label-custom">Email / Usuario <span style="color:red">*</span></label>
                            <input type="email" name="email" class="form-control-custom"
                                placeholder="tucorreo@ejemplo.com" required>
                        </div>

                        <div class="form-group-custom">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.4rem;">
                                <label class="form-label-custom" style="margin-bottom: 0;">Contraseña <span
                                        style="color:red">*</span></label>
                                <a href="forgot_password.php"
                                    style="font-size: 0.7rem; font-family: var(--font-mono); color: var(--ardo-text-muted); text-transform: uppercase; text-decoration: none; font-weight: 700;">¿Olvidaste
                                    la contraseña?</a>
                            </div>
                            <input type="password" name="password" class="form-control-custom" placeholder="••••••••"
                                required>
                        </div>

                        <button type="submit" class="btn-dark" style="margin-top: 2rem; padding: 1rem 0;">
                            INGRESAR AL GRID <i class="lni lni-arrow-right-circle" style="font-size: 1.2rem;"></i>
                        </button>

                        <div
                            style="text-align: center; margin-top: 2rem; font-size: 0.85rem; color: var(--ardo-text-muted);">
                            ¿No tienes cuenta? <a href="../registro/"
                                style="color: var(--ardo-midnight); font-weight: 700; text-decoration: none;">Crea una
                                ahora &rarr;</a>
                        </div>
                    </form>
                </div>

                <!-- Right Side: Info Panel (Stripe-like Gradient) -->
                <div class="registration-info-side"
                    style="flex: 1.1; position: relative; overflow: hidden; display: flex; flex-direction: column; justify-content: center; padding: 4rem; background: var(--ardo-midnight); color: #fff;">

                    <!-- Mesh Gradient Canvas -->
                    <canvas id="gradient-canvas"
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 1;"></canvas>

                    <div style="position: relative; z-index: 2;">
                        <i class="lni lni-pulse"
                            style="font-size: 3rem; color: var(--ardo-primary); margin-bottom: 2rem;"></i>
                        <h2
                            style="font-size: 2.8rem; font-weight: 900; margin-bottom: 1.5rem; line-height: 1; letter-spacing: -0.04em; text-transform: uppercase;">
                            Control <br><span class="text-cyan">Total</span> de Red.
                        </h2>
                        <p
                            style="font-size: 1.1rem; line-height: 1.6; color: rgba(255,255,255,0.85); margin-bottom: 2.5rem;">
                            Monitorea el estado de tus servicios, gestiona facturación y escala tu red global en tiempo
                            real.
                        </p>

                        <ul style="list-style: none; padding: 0; margin-bottom: 3.5rem;">
                            <li
                                style="display: flex; gap: 15px; margin-bottom: 1.25rem; align-items: center; font-weight: 600; font-size: 0.95rem;">
                                <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                                Gestión Centralizada de VoIP
                            </li>
                            <li
                                style="display: flex; gap: 15px; margin-bottom: 1.25rem; align-items: center; font-weight: 600; font-size: 0.95rem;">
                                <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                                Nodos Cloud de Alta Disponibilidad
                            </li>
                            <li
                                style="display: flex; gap: 15px; align-items: center; font-weight: 600; font-size: 0.95rem;">
                                <i class="lni lni-checkmark-circle" style="color: var(--ardo-primary);"></i>
                                Seguridad Perimetral Avanzada
                            </li>
                        </ul>

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

    <!-- Mesh Gradient V1 Script -->
    <script>
        (function () {
            const canvas = document.getElementById('gradient-canvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width, height, time = 0;

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
                ctx.fillStyle = `rgb(${colors[3][0]}, ${colors[3][1]}, ${colors[3][2]})`;
                ctx.fillRect(0, 0, width, height);

                const drawOrb = (xMod, yMod, rMod, colorIdx, alpha) => {
                    const x = xMod * width;
                    const y = yMod * height;
                    const r = rMod * width;
                    const g = ctx.createRadialGradient(x, y, 0, x, y, r);
                    const c = colors[colorIdx];
                    g.addColorStop(0, `rgba(${c[0]}, ${c[1]}, ${c[2]}, ${alpha})`);
                    g.addColorStop(1, `rgba(${c[0]}, ${c[1]}, ${c[2]}, 0)`);
                    ctx.fillStyle = g;
                    ctx.beginPath(); ctx.arc(x, y, r, 0, Math.PI * 2); ctx.fill();
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