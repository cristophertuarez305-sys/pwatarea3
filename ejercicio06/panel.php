<?php
require "config.php";

if (!estaAutenticado()) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel - Ejercicio 6</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>Panel privado</h1>
        <p>Solo se ve si has iniciado sesión</p>
    </header>

    <main>
        <section class="tarjeta">
            <h2>¡Bienvenido, <?= htmlspecialchars($_SESSION["nombre"]) ?>!</h2>
            <p>Sesión iniciada como <strong><?= htmlspecialchars($_SESSION["usuario"]) ?></strong>.</p>
            <p>Datos validados desde: <strong><?= htmlspecialchars($_SESSION["fuente"]) ?></strong></p>
            <p><a href="logout.php" class="boton">Cerrar sesión</a></p>
        </section>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>
</body>
</html>