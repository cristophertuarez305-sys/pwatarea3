<?php
require "config.php";

$mensajes = [];
$ok = true;

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    try {
        $pdo->exec("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET utf8mb4");
        $mensajes[] = "Base de datos «" . DB_NAME . "» lista.";
    } catch (PDOException $e) {
        $mensajes[] = "No se pudo crear la base de datos (puede que ya exista).";
    }

    $pdo->exec("USE `" . DB_NAME . "`");

    $pdo->exec("CREATE TABLE IF NOT EXISTS usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario VARCHAR(50) NOT NULL UNIQUE,
        nombre VARCHAR(100) NOT NULL,
        clave VARCHAR(255) NOT NULL
    )");
    $mensajes[] = "Tabla «usuarios» lista.";

    $insertar = $pdo->prepare(
        "INSERT INTO usuarios (usuario, nombre, clave) VALUES (?, ?, ?)
         ON DUPLICATE KEY UPDATE nombre = VALUES(nombre), clave = VALUES(clave)"
    );
    foreach ($usuarios as $login => $datos) {
        $insertar->execute([$login, $datos["nombre"], $datos["clave"]]);
        $mensajes[] = "Usuario «{$login}» guardado.";
    }
} catch (PDOException $e) {
    $ok = false;
    $mensajes[] = "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalación - Ejercicio 6</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>Instalación de la base de datos</h1>
    </header>
    <main>
        <section class="tarjeta">
            <ul class="lista-mensajes">
                <?php foreach ($mensajes as $m): ?>
                    <li><?= htmlspecialchars($m) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php if ($ok): ?>
                <p class="mensaje exito">Listo. Ya puedes iniciar sesión.</p>
                <p><a href="login.php">Ir al login</a></p>
            <?php else: ?>
                <p class="mensaje error">Revisa que MySQL esté encendido y los datos de config.php.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>