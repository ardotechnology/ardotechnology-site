<?php
// ardotechnology/registro/debug_production.php

// 1. Configuración de errores para ver todo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Diagnóstico de Registro en Producción</h1>";
echo "<p>Versión de PHP: " . phpversion() . "</p>";

// 2. Verificar archivos requeridos
$configPath = __DIR__ . '/../dashboard/config.php';
if (file_exists($configPath)) {
    echo "<p style='color:green'>✔ config.php encontrado.</p>";
    require_once $configPath;
} else {
    die("<p style='color:red'>✖ ERROR CRÍTICO: config.php no encontrado en $configPath</p>");
}

// 3. Probar Conexión a Base de Datos (Holding para buscar contacto)
echo "<h2>Probar Conexión DB Holding</h2>";
try {
    $conn_holding = new mysqli(DB_HOST, DB_USER, DB_PASS, 'holding');
    if ($conn_holding->connect_error) {
        throw new Exception($conn_holding->connect_error);
    }
    echo "<p style='color:green'>✔ Conexión a 'holding' exitosa.</p>";

    // Verificar tabla contacts
    $result = $conn_holding->query("SELECT id, userid, email FROM tblcontacts LIMIT 1");
    if ($result) {
        $row = $result->fetch_assoc();
        echo "<p style='color:green'>✔ Tabla tblcontacts accesible. Primer contacto: " . ($row['email'] ?? 'N/A') . "</p>";
    } else {
        echo "<p style='color:red'>✖ Error consultando tblcontacts: " . $conn_holding->error . "</p>";
    }
    $conn_holding->close();

} catch (Exception $e) {
    echo "<p style='color:red'>✖ Error conectando a DB Holding: " . $e->getMessage() . "</p>";
}

// 4. Probar Conexión a Base de Datos Local (Webapp para guardar usuario)
echo "<h2>Probar Conexión DB Local (webapp)</h2>";
try {
    $conn_webapp = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn_webapp->connect_error) {
        throw new Exception($conn_webapp->connect_error);
    }
    echo "<p style='color:green'>✔ Conexión a '" . DB_NAME . "' exitosa.</p>";

    // Verificar estructura de tabla users
    $result = $conn_webapp->query("DESCRIBE users");
    $columns = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $columns[] = $row['Field'];
        }
        echo "<p>Columnas en 'users': " . implode(", ", $columns) . "</p>";

        // Verificar columnas críticas
        $required_cols = ['active', 'onboarding_status'];
        foreach ($required_cols as $col) {
            if (in_array($col, $columns)) {
                echo "<p style='color:green'>✔ Columna '$col' existe.</p>";
            } else {
                echo "<p style='color:red'>✖ FALTANTE: Columna '$col' NO existe en la tabla 'users'. Esto causará error 500 al insertar.</p>";
            }
        }
    } else {
        echo "<p style='color:red'>✖ Error describiendo tabla users: " . $conn_webapp->error . "</p>";
    }
    $conn_webapp->close();

} catch (Exception $e) {
    echo "<p style='color:red'>✖ Error conectando a DB Local: " . $e->getMessage() . "</p>";
}

// 5. Probar Conectividad API CRM
echo "<h2>Probar Conexión API CRM</h2>";
$apiUrl = API_URL . '/customers'; // Asegurarse que API_URL es correcto
$apiToken = API_TOKEN;

echo "<p>Intentando conectar a: $apiUrl</p>";

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true, // Importante para no imprimir directamente
    CURLOPT_CUSTOMREQUEST => 'GET', // Usar GET para listar y probar auth
    CURLOPT_HTTPHEADER => array(
        'authtoken: ' . $apiToken,
        'Content-Type: application/json'
    ),
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_TIMEOUT => 10 // Timeout corto para prueba
));

$response = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "<p style='color:red'>✖ Error CURL: $err</p>";
} else {
    echo "<p>Código HTTP: $httpCode</p>";
    if ($httpCode >= 200 && $httpCode < 300) {
        echo "<p style='color:green'>✔ Conexión API exitosa.</p>";
        $data = json_decode($response, true);
        echo "<p>Respuesta (breve): " . substr($response, 0, 100) . "...</p>";
    } else {
        echo "<p style='color:orange'>⚠ API respondió pero con código no exitoso. Probable error de token o permisos.</p>";
        echo "<p>Respuesta: " . htmlspecialchars($response) . "</p>";
    }
}

echo "<h2>Fin del Diagnóstico</h2>";
?>