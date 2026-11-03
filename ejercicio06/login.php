<?php
require "config.php";

if (estaAutenticado()) {
    header("Location: panel.php");
    exit;
}

$error = "";
$usuario = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"] ?? "");
    $clave   = $_POST["clave"] ?? "";

    if ($usuario === "" || $clave === "") {
        $error = "Completa el usuario y la contraseña.";
    } else {
        $datos = buscarUsuario($usuario);

        if ($datos && password_verify($clave, $datos["clave"])) {
            session_regenerate_id(true);
            $_SESSION["usuario"] = $datos["usuario"];
            $_SESSION["nombre"]  = $datos["nombre"];
            $_SESSION["fuente"]  = $datos["fuente"];
            header("Location: panel.php");
            exit;
        }

        $error = "Usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 6 - Iniciar sesión</title>
    <link rel="stylesheet" href="../estilos.css">
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <header>
        <h1>Ejercicio 6: Sistema de login</h1>
        <p>Inicia sesión para entrar al panel</p>
    </header>

    <main>
        <form method="post" action="" class="tarjeta">
            <?php if ($error !== ""): ?>
                <p class="mensaje error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>

            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario"
                       value="<?= htmlspecialchars($usuario) ?>" autofocus>
            </div>

            <div class="campo">
                <label for="clave">Contraseña</label>
                <input type="password" id="clave" name="clave">
            </div>

            <button type="submit">Entrar</button>

            <p class="ayuda">
                Usuarios de prueba: <code>admin / admin123</code>
                o <code>estudiante / clave123</code>
            </p>
        </form>

        <p class="volver"><a href="../">← Volver a la portada</a></p>
    </main>
</body>
</html>