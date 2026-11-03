<?php
$errores = [];
$enviado = false;
$nombre = $correo = $mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre  = trim($_POST["nombre"] ?? "");
    $correo  = trim($_POST["correo"] ?? "");
    $mensaje = trim($_POST["mensaje"] ?? "");

    if ($nombre === "") {
        $errores["nombre"] = "El nombre es obligatorio.";
    }
    if ($correo === "") {
        $errores["correo"] = "El correo es obligatorio.";
    } elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores["correo"] = "El correo no tiene un formato válido.";
    }
    if ($mensaje === "") {
        $errores["mensaje"] = "El mensaje es obligatorio.";
    }

    if (empty($errores)) {
        $enviado = true;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2 - Formulario de contacto</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="formulario.css">
</head>
<body>
    <header>
        <h1>Ejercicio 2: Formulario de contacto</h1>
        <p>Completa todos los campos para enviar tu mensaje</p>
    </header>

    <main>
        <?php if ($enviado): ?>
            <section class="exito">
                <h2>¡Mensaje recibido!</h2>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
                <p><strong>Correo:</strong> <?= htmlspecialchars($correo) ?></p>
                <p><strong>Mensaje:</strong> <?= nl2br(htmlspecialchars($mensaje)) ?></p>
                <p><a href="./">Enviar otro mensaje</a></p>
            </section>
        <?php else: ?>
            <form id="formContacto" method="post" action="" novalidate>
                <div class="campo">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre"
                           value="<?= htmlspecialchars($nombre) ?>">
                    <span class="error" id="error-nombre"><?= $errores["nombre"] ?? "" ?></span>
                </div>

                <div class="campo">
                    <label for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo"
                           value="<?= htmlspecialchars($correo) ?>">
                    <span class="error" id="error-correo"><?= $errores["correo"] ?? "" ?></span>
                </div>

                <div class="campo">
                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5"><?= htmlspecialchars($mensaje) ?></textarea>
                    <span class="error" id="error-mensaje"><?= $errores["mensaje"] ?? "" ?></span>
                </div>

                <button type="submit">Enviar</button>
            </form>
        <?php endif; ?>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>

    <script src="validar.js"></script>
</body>
</html>