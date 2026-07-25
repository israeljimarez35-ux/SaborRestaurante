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
    header("Location: ../html/menu.html");
    exit();
}

$idUsuario = $_SESSION["id"];

// Obtener el producto enviado desde el menú
$idProducto = filter_input(INPUT_POST, "id_producto", FILTER_VALIDATE_INT);

if (!$idProducto) {
    header("Location: ../html/menu.html");
    exit();
}

// Verificar si el producto ya existe en el carrito
$consulta = $conexion->prepare("
    SELECT id_carrito, cantidad
    FROM carrito
    WHERE id_usuario = ? AND id_producto = ?
");

$consulta->execute([$idUsuario, $idProducto]);

if ($consulta->rowCount() > 0) {

    // Si ya existe, aumentar la cantidad
    $actualizar = $conexion->prepare("
        UPDATE carrito
        SET cantidad = cantidad + 1
        WHERE id_usuario = ? AND id_producto = ?
    ");

    $actualizar->execute([$idUsuario, $idProducto]);

} else {

    // Si no existe, agregarlo
    $insertar = $conexion->prepare("
        INSERT INTO carrito (id_usuario, id_producto, cantidad)
        VALUES (?, ?, 1)
    ");

    $insertar->execute([$idUsuario, $idProducto]);
}

// Regresar al menú
header("Location: ../html/menu.html");
exit();

?>