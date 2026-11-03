<?php
$ejercicios = [
    "ejercicio01" => "Menú desplegable",
    "ejercicio02" => "Formulario de contacto",
    "ejercicio03" => "Contador de visitas",
    "ejercicio04" => "Juego de adivinanzas",
    "ejercicio05" => "Galería de imágenes",
    "ejercicio06" => "Sistema de login",
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tarea 3 - Programación Web</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <header>
        <h1>Tarea 3: HTML, CSS, JavaScript y PHP</h1>
        <p>· Programación Web Avanzada</p>
    </header>

    <main>
        <h2>Ejercicios</h2>
        <nav class="menu-ejercicios">
            <?php $numero = 1; ?>
            <?php foreach ($ejercicios as $carpeta => $titulo): ?>
                <a href="<?= $carpeta ?>/">
                    <span class="numero"><?= $numero++ ?></span>
                    <?= $titulo ?>
                </a>
            <?php endforeach; ?>
        </nav>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> · Todos los derechos reservados.</p>
    </footer>
</body>
</html>