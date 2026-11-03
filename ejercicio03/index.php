<?php
$visitas = 0;

$archivo = __DIR__ . "/contador.txt";

function actualizarVisitas()
{
    global $visitas, $archivo;

    if (!file_exists($archivo)) {
        file_put_contents($archivo, "0");
    }

    $f = fopen($archivo, "c+");
    flock($f, LOCK_EX);

    $visitas = (int) stream_get_contents($f);
    $visitas++;

    ftruncate($f, 0);
    rewind($f);
    fwrite($f, (string) $visitas);

    flock($f, LOCK_UN);
    fclose($f);
}

actualizarVisitas();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3 - Contador de visitas</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="contador.css">
</head>
<body>
    <header>
        <h1>Ejercicio 3: Contador de visitas</h1>
        <p>Recarga la página para aumentar el contador</p>
    </header>

    <main>
        <section class="tarjeta">
            <p class="etiqueta">Número de visitas</p>
            <p class="contador"><?= number_format($visitas) ?></p>
            <p class="detalle">
                Eres el visitante número <strong><?= $visitas ?></strong> de este sitio.
            </p>
        </section>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>
</body>
</html>