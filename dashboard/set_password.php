<?php
// dashboard/set_password.php
require_once 'auth.php';

$id = $_GET['id'] ?? null;
$token = $_GET['token'] ?? null;

$error = "";
$success = "";
$isValidToken = false;

if (!$id || !$token) {
    $error = "Faltan parámetros de seguridad. Por favor, solicita un nuevo enlace de recuperación.";
} else {
    // Validate token via CRM API
    $response = api_call('login/validate_token_api', 'POST', [
        'userid' => $id,
        'token' => $token
    ]);

    if (isset($response['status']) && $response['status'] === true) {
        $isValidToken = true;
    } else {
        $error = "El enlace de recuperación es inválido o ha expirado.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $isValidToken) {
    $password = $_POST['password'] ?? '';
    $password_repeat = $_POST['password_repeat'] ?? '';

    if (empty($password) || empty($password_repeat)) {
        $error = "Todos los campos son obligatorios.";
    } elseif ($password !== $password_repeat) {
        $error = "Las contraseñas no coinciden.";
    } elseif (strlen($password) < 6) {
        $error = "La contraseña debe tener al menos 6 caracteres.";
    } else {
        // Fetch email from local DB to include in API call (CRM API requires it for validation)
        $conn = get_db_connection();
        $stmt = $conn->prepare("SELECT email FROM users WHERE contact_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $res = $stmt->get_result();
        $userEmail = "";
        if ($userRow = $res->fetch_assoc()) {
            $userEmail = $userRow['email'];
        }
        $stmt->close();

        if (empty($userEmail)) {
            $error = "No se pudo encontrar el usuario localmente. Por favor, contacta a soporte.";
        } else {
            // 1. Update password in CRM via API
            $updateResponse = api_call('contacts/' . $id, 'PUT', [
                'password' => $password,
                'email' => $userEmail // CRM PUT requires email
            ]);

            if (isset($updateResponse['status']) && $updateResponse['status'] === true) {
                // 2. Update local database hash to keep in sync
                $newHash = password_hash($password, PASSWORD_DEFAULT);
                $updateLocal = $conn->prepare("UPDATE users SET password = ?, updated_at = NOW() WHERE contact_id = ?");
                $updateLocal->bind_param("si", $newHash, $id);
                $updateLocal->execute();
                $updateLocal->close();

                $success = "Contraseña actualizada con éxito. Ya puedes iniciar sesión.";
                header("refresh:3;url=login.php");
            } else {
                $error = "No se pudo actualizar la contraseña en el sistema central. Error: " . ($updateResponse['message'] ?? 'Desconocido');
            }
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Establecer Contraseña | ARDO Technology</title>

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
        }

        body {
            font-family: var(--font-display);
            margin: 0;
            background: var(--ardo-surface);
            color: var(--ardo-midnight);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-card {
            width: 100%;
            max-width: 450px;
            background: #fff;
            padding: 3rem;
            border-radius: 2rem;
            box-shadow: 0 40px 60px -15px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .form-group-custom {
            margin-bottom: 1.5rem;
            text-align: left;
        }

        .form-label-custom {
            display: block;
            font-family: var(--font-mono);
            font-weight: 700;
            font-size: 0.75rem;
            margin-bottom: 0.5rem;
            color: var(--ardo-text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .form-control-custom {
            width: 100%;
            background-color: #fff;
            border: 1px solid var(--ardo-border);
            border-radius: 0.6rem;
            padding: 0.85rem 1rem;
            font-size: 1rem;
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

        .btn-ardo {
            background: var(--ardo-midnight);
            color: #fff;
            padding: 1rem;
            border-radius: 0.6rem;
            font-family: var(--font-mono);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: all 0.2s;
            margin-top: 1rem;
        }

        .btn-ardo:hover {
            opacity: 0.9;
            transform: translateY(-2px);
        }

        .alert {
            padding: 1rem;
            border-radius: 0.8rem;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 2rem;
            text-align: left;
            font-family: var(--font-mono);
            text-transform: uppercase;
        }

        .alert-danger {
            background: #FEF2F2;
            border: 1px solid #FCA5A5;
            color: #991B1B;
        }

        .alert-success {
            background: #F0FDF4;
            border: 1px solid #86EFAC;
            color: #166534;
        }

        .logo {
            height: 38px;
            margin-bottom: 2.5rem;
        }

        .title {
            font-size: 1.8rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .subtitle {
            color: var(--ardo-text-muted);
            font-size: 0.95rem;
            margin-bottom: 2.5rem;
        }
    </style>
</head>

<body>
    <div class="auth-card">
        <img src="../images/logo.svg" alt="Ardo" class="logo">

        <?php if ($success): ?>
            <div class="alert alert-success">
                <i class="lni lni-checkmark-circle" style="margin-right: 8px;"></i>
                <?php echo $success; ?>
            </div>
            <p style="color: var(--ardo-text-muted); font-size: 0.85rem;">Redirigiendo al login...</p>
        <?php else: ?>
            <h1 class="title">Establecer Contraseña</h1>
            <p class="subtitle">Crea una nueva contraseña segura para acceder a tu plataforma.</p>

            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="lni lni-warning" style="margin-right: 8px;"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($isValidToken): ?>
                <form method="POST">
                    <div class="form-group-custom">
                        <label class="form-label-custom">Nueva Contraseña</label>
                        <input type="password" name="password" class="form-control-custom" placeholder="••••••••" required
                            minlength="6">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom">Confirmar Contraseña</label>
                        <input type="password" name="password_repeat" class="form-control-custom" placeholder="••••••••"
                            required minlength="6">
                    </div>

                    <button type="submit" class="btn-ardo">ACTUALIZAR CONTRASEÑA</button>
                </form>
            <?php else: ?>
                <a href="login.php" class="btn-ardo" style="display: block; text-decoration: none; text-align: center;">VOLVER
                    AL LOGIN</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

</html>