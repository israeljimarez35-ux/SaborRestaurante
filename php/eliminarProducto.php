<?php

session_start();
require_once("conexion.php");

if (!isset($_SESSION["id"])) {
    exit("Debes iniciar sesión.");
}

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    exit("Método no permitido.");
}

$idUsuario = $_SESSION["id"];
$idCarrito = filter_input(INPUT_POST, "id_carrito", FILTER_VALIDATE_INT);

if (!$idCarrito) {
    exit("Producto no válido.");
}

$eliminar = $conexion->prepare("
DELETE FROM carrito
WHERE id_carrito = ?
AND id_usuario = ?
");

if ($eliminar->execute([$idCarrito, $idUsuario])) {

    echo "Producto eliminado correctamente.";

} else {

    echo "No se pudo eliminar el producto.";

}

?>