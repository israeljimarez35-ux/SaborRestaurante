<?php
session_start();
require_once("conexion.php");
if (!isset($_SESSION["id"])) {
    echo json_encode([
        "error" => "Debes iniciar sesión."
    ]);
    exit();
}
$idUsuario = $_SESSION["id"];
$consulta = $conexion->prepare("
    SELECT
        nombre,
        correo,
        telefono
    FROM usuarios
    WHERE id = ?
");
$consulta->execute([$idUsuario]);
$usuario = $consulta->fetch(PDO::FETCH_ASSOC);
if ($usuario) {
    header("Content-Type: application/json");
    echo json_encode($usuario);
} else {
    header("Content-Type: application/json");
    echo json_encode([
        "error" => "Usuario no encontrado."
    ]);
}
?>