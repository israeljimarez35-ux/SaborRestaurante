<?php
$host = "localhost";
$bd = "sabor_restaurante";
$usuario = "root";
$password = "";
try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8",
        $usuario,
        $password
    );
    $conexion->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

?>