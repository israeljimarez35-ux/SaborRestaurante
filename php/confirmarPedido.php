<?php

session_start();
require_once("conexion.php");

if (!isset($_SESSION["id"])) {
    exit("Debes iniciar sesión.");
}

$idUsuario = $_SESSION["id"];

try {

    $conexion->beginTransaction();

    // Obtener productos del carrito
    $consulta = $conexion->prepare("
        SELECT
            carrito.id_producto,
            carrito.cantidad,
            productos.precio
        FROM carrito
        INNER JOIN productos
        ON carrito.id_producto = productos.id_producto
        WHERE carrito.id_usuario = ?
    ");

    $consulta->execute([$idUsuario]);

    $productos = $consulta->fetchAll(PDO::FETCH_ASSOC);

    if (count($productos) == 0) {
        exit("El carrito está vacío.");
    }

    // Calcular total
    $total = 0;

    foreach ($productos as $producto) {
        $total += $producto["precio"] * $producto["cantidad"];
    }

    // Guardar pedido
    $insertPedido = $conexion->prepare("
        INSERT INTO pedidos
        (id_usuario,total,fecha,estado)
        VALUES (?, ?, NOW(), ?)
    ");

    $estado = "Pendiente";

    $insertPedido->execute([
        $idUsuario,
        $total,
        $estado
    ]);

    $idPedido = $conexion->lastInsertId();

    // Guardar detalle del pedido
    $insertDetalle = $conexion->prepare("
        INSERT INTO detalle_pedido
        (id_pedido,id_producto,cantidad,precio)
        VALUES (?,?,?,?)
    ");

    foreach ($productos as $producto) {

        $insertDetalle->execute([
            $idPedido,
            $producto["id_producto"],
            $producto["cantidad"],
            $producto["precio"]
        ]);

    }

    // Vaciar carrito
    $eliminar = $conexion->prepare("
        DELETE FROM carrito
        WHERE id_usuario = ?
    ");

    $eliminar->execute([$idUsuario]);

    $conexion->commit();

    echo "<script>
            alert('Pedido realizado correctamente');
            window.location='../html/inicio.html';
          </script>";

} catch (Exception $e) {

    $conexion->rollBack();

    echo "Error: ".$e->getMessage();

}

?>