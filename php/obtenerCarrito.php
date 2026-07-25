<?php

session_start();
require_once("conexion.php");

if (!isset($_SESSION["id"])) {
    exit("Debes iniciar sesión.");
}

$idUsuario = $_SESSION["id"];

$consulta = $conexion->prepare("
SELECT
    c.id_carrito,
    c.cantidad,
    p.id_producto,
    p.nombre,
    p.precio,
    p.imagen
FROM carrito c
INNER JOIN productos p
ON c.id_producto = p.id_producto
WHERE c.id_usuario = ?
");

$consulta->execute([$idUsuario]);

$productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

header("Content-Type: application/json");
echo json_encode($productos);

?>