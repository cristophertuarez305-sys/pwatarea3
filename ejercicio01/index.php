<?php
$menu = [
    "Cursos" => ["HTML", "CSS", "JavaScript", "PHP"],
    "Herramientas" => ["VS Code", "XAMPP", "GitHub"],
    "Contacto" => ["Correo", "Teléfono"],
];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1 - Menú desplegable</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header>
        <h1>Ejercicio 1: Menú desplegable</h1>
        <p>Haz clic en un elemento para ver sus opciones</p>
    </header>

    <main>
        <nav class="menu">
            <ul class="menu-principal">
                <?php foreach ($menu as $titulo => $opciones): ?>
                    <li class="item">
                        <button class="item-boton" type="button">
                            <?= $titulo ?> <span class="flecha">▾</span>
                        </button>
                        <ul class="submenu">
                            <?php foreach ($opciones as $opcion): ?>
                                <li><a href="#"><?= $opcion ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php endforeach; ?>
            </ul>
        </nav>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>

    <script src="menu.js"></script>
</body>
</html>