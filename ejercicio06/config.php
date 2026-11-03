<?php
session_start();

define("DB_HOST", "localhost");
define("DB_NAME", "pwatarea3");
define("DB_USER", "root");
define("DB_PASS", "");

$usuarios = [
    "admin" => [
        "nombre" => "Administrador",
        "clave"  => password_hash("admin123", PASSWORD_DEFAULT),
    ],
    "estudiante" => [
        "nombre" => "Estudiante",
        "clave"  => password_hash("clave123", PASSWORD_DEFAULT),
    ],
];

function conectar()
{
    try {
        return new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
            DB_USER,
            DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        return null;
    }
}

function buscarUsuario($usuario)
{
    global $usuarios;

    $pdo = conectar();
    if ($pdo) {
        try {
            $consulta = $pdo->prepare("SELECT usuario, nombre, clave FROM usuarios WHERE usuario = ?");
            $consulta->execute([$usuario]);
            $fila = $consulta->fetch(PDO::FETCH_ASSOC);
            if ($fila) {
                $fila["fuente"] = "MySQL";
                return $fila;
            }
            return null;
        } catch (PDOException $e) {
        }
    }

    if (isset($usuarios[$usuario])) {
        return [
            "usuario" => $usuario,
            "nombre"  => $usuarios[$usuario]["nombre"],
            "clave"   => $usuarios[$usuario]["clave"],
            "fuente"  => "arreglo PHP",
        ];
    }
    return null;
}

function estaAutenticado()
{
    return isset($_SESSION["usuario"]);
}