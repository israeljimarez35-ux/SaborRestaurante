<?php

session_start();
require_once("conexion.php");

// Verificar que el usuario haya iniciado sesión
if (!isset($_SESSION["id"])) {
    header("Location: ../html/login.html");
    exit();
}

// Verificar que la petición sea POST
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: ../html/reservas.html");
    exit();
}

$idUsuario = $_SESSION["id"];

$fecha = trim($_POST["fecha"]);
$hora = trim($_POST["hora"]);
$personas = intval($_POST["personas"]);
$telefono = trim($_POST["telefono"]);

// Validar datos
if (empty($fecha) || empty($hora) || empty($telefono) || $personas <= 0) {
    header("Location: ../html/reservas.html");
    exit();
}

// Guardar reserva
$consulta = $conexion->prepare("
    INSERT INTO reservas
    (id_usuario, fecha, hora, personas, telefono)
    VALUES (?, ?, ?, ?, ?)
");

$resultado = $consulta->execute([
    $idUsuario,
    $fecha,
    $hora,
    $personas,
    $telefono
]);

if ($resultado) {

    // Regresar al inicio
    header("Location: ../html/inicio.html");
    exit();

} else {

    // Si ocurre un error, volver a reservas
    header("Location: ../html/reservas.html");
    exit();

}

?>