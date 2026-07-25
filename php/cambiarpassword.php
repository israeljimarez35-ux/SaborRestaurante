<?php
session_start();
require_once("conexion.php");
if (!isset($_SESSION["id"])) {
    echo "<script>
            alert('Debes iniciar sesión.');
            window.location='../login.html';
          </script>";
    exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idUsuario = $_SESSION["id"];
    $actual = $_POST["actual"];
    $nueva = $_POST["nueva"];
    $confirmar = $_POST["confirmar"];
    if ($nueva != $confirmar) {
        echo "<script>
                alert('Las nuevas contraseñas no coinciden.');
                window.history.back();
              </script>";
        exit();
    }
    $consulta = $conexion->prepare("
        SELECT password
        FROM usuarios
        WHERE id = ?
    ");
    $consulta->execute([$idUsuario]);
    $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    if (!$usuario) {
        echo "<script>
                alert('Usuario no encontrado.');
                window.history.back();
              </script>";
        exit();
    }
    if (!password_verify($actual, $usuario["password"])) {
        echo "<script>
                alert('La contraseña actual es incorrecta.');
                window.history.back();
              </script>";
        exit();
    }
    $passwordHash = password_hash($nueva, PASSWORD_DEFAULT);
    $actualizar = $conexion->prepare("
        UPDATE usuarios
        SET password = ?
        WHERE id = ?
    ");
    $resultado = $actualizar->execute([
        $passwordHash,
        $idUsuario
    ]);
    if ($resultado) {
        echo "<script>
                alert('Contraseña actualizada correctamente.');
                window.location='../perfil.html';
              </script>";
    } else {
        echo "<script>
                alert('No se pudo actualizar la contraseña.');
                window.history.back();
              </script>";
    }
} else {
    header("Location: ../perfil.html");
    exit();
}
?>