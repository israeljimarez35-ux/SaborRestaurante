<?php
session_start();
require_once("conexion.php");
if (!isset($_SESSION["id"])) {
    echo "Debes iniciar sesión.";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_SESSION["id"];
    $nombre = trim($_POST["nombre"]);
    $telefono = trim($_POST["telefono"]);
    if (empty($nombre) || empty($telefono)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }
    if (!preg_match('/^[0-9]{10}$/', $telefono)) {

        echo "El teléfono debe tener 10 dígitos.";
        exit();
    }
    $consulta = $conexion->prepare("
        UPDATE usuarios
        SET nombre = ?, telefono = ?
        WHERE id = ?
    ");
    $resultado = $consulta->execute([
        $nombre,
        $telefono,
        $idUsuario
    ]);
    if ($resultado) {
        $_SESSION["nombre"] = $nombre;
        echo "Perfil actualizado correctamente.";
    } else {
        echo "No se pudo actualizar el perfil.";
    }
} else {
    echo "Solicitud no válida.";
}
?>