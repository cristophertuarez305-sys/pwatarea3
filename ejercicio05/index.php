<?php
$directorio = __DIR__ . "/imagenes/";

$imagenes = glob($directorio . "*.{jpg,jpeg,png,gif,webp,JPG,JPEG,PNG,GIF,WEBP}", GLOB_BRACE);

if ($imagenes === false) {
    $imagenes = [];
}

sort($imagenes);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5 - Galería de imágenes</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="galeria.css">
</head>
<body>
    <header>
        <h1>Ejercicio 5: Galería de imágenes</h1>
    </header>

    <main>
        <?php if (empty($imagenes)): ?>
            <p class="vacio">
                No hay imágenes todavía. Agrega archivos .jpg, .png, .gif o .webp
                en la carpeta <code>ejercicio05/imagenes/</code>.
            </p>
        <?php else: ?>
            <ul class="galeria">
                <?php foreach ($imagenes as $ruta): ?>
                    <?php
                    $archivo = basename($ruta);
                    $titulo  = ucfirst(str_replace(["-", "_"], " ", pathinfo($archivo, PATHINFO_FILENAME)));
                    ?>
                    <li>
                        <figure>
                            <img src="imagenes/<?= rawurlencode($archivo) ?>"
                                 alt="<?= htmlspecialchars($titulo) ?>"
                                 loading="lazy">
                            <figcaption><?= htmlspecialchars($titulo) ?></figcaption>
                        </figure>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>
</body>
</html>