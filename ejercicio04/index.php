<?php
session_start();

function nuevoJuego()
{
    $_SESSION["secreto"]  = rand(1, 100);
    $_SESSION["intentos"] = 0;
    $_SESSION["acertado"] = false;
    $_SESSION["mensaje"]  = "";
    $_SESSION["tipo"]     = "";
}

if (!isset($_SESSION["secreto"])) {
    nuevoJuego();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["reiniciar"])) {
        nuevoJuego();
    } elseif (!$_SESSION["acertado"]) {
        $intento = filter_var($_POST["numero"] ?? "", FILTER_VALIDATE_INT);

        if ($intento === false || $intento < 1 || $intento > 100) {
            $_SESSION["mensaje"] = "Escribe un número entero entre 1 y 100.";
            $_SESSION["tipo"] = "aviso";
        } else {
            $_SESSION["intentos"]++;

            if ($intento === $_SESSION["secreto"]) {
                $_SESSION["acertado"] = true;
                $_SESSION["mensaje"] = "¡Felicidades! Adivinaste el número {$intento} en {$_SESSION["intentos"]} intento(s).";
                $_SESSION["tipo"] = "exito";
            } elseif ($intento < $_SESSION["secreto"]) {
                $_SESSION["mensaje"] = "El {$intento} es muy bajo. Prueba con un número más alto.";
                $_SESSION["tipo"] = "pista";
            } else {
                $_SESSION["mensaje"] = "El {$intento} es muy alto. Prueba con un número más bajo.";
                $_SESSION["tipo"] = "pista";
            }
        }
    }

    header("Location: ./");
    exit;
}

$mensaje  = $_SESSION["mensaje"];
$tipo     = $_SESSION["tipo"];
$intentos = $_SESSION["intentos"];
$acertado = $_SESSION["acertado"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4 - Juego de adivinanzas</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="juego.css">
</head>
<body>
    <header>
        <h1>Ejercicio 4: Juego de adivinanzas</h1>
        <p>Estoy pensando en un número del 1 al 100.</p>
    </header>

    <main>
        <section class="tarjeta">
            <p class="intentos">Intentos: <strong><?= $intentos ?></strong></p>

            <?php if ($mensaje !== ""): ?>
                <p class="mensaje <?= $tipo ?>"><?= htmlspecialchars($mensaje) ?></p>
            <?php endif; ?>

            <?php if (!$acertado): ?>
                <form id="formJuego" method="post" action="" novalidate>
                    <input type="number" id="numero" name="numero"
                           min="1" max="100" placeholder="Tu número" autofocus>
                    <button type="submit">Adivinar</button>
                </form>
                <span class="error" id="error-numero"></span>
            <?php endif; ?>

            <form method="post" action="" class="reinicio">
                <button type="submit" name="reiniciar" value="1" class="secundario">
                    <?= $acertado ? "Jugar de nuevo" : "Reiniciar juego" ?>
                </button>
            </form>
        </section>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>

    <script src="juego.js"></script>
</body>
</html>