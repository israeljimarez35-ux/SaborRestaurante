<?php

require_once("conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = htmlspecialchars(trim($_POST["nombre"]));
    $correo = htmlspecialchars(trim($_POST["correo"]));
    $telefono = htmlspecialchars(trim($_POST["telefono"]));
    $password = $_POST["password"];
    $confirmar = $_POST["confirmar"];

    if ($password != $confirmar) {
        echo "<script>
                alert('Las contraseñas no coinciden.');
                window.history.back();
              </script>";
        exit();
    }

    $consulta = $conexion->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $consulta->execute([$correo]);

    if ($consulta->rowCount() > 0) {
        echo "<script>
                alert('El correo ya está registrado.');
                window.history.back();
              </script>";
        exit();
    }

    $passwordEncriptada = password_hash($password, PASSWORD_DEFAULT);

    $insertar = $conexion->prepare("INSERT INTO usuarios(nombre, correo, telefono, password)
                                    VALUES(?, ?, ?, ?)");

    $resultado = $insertar->execute([
        $nombre,
        $correo,
        $telefono,
        $passwordEncriptada
    ]);

    if ($resultado) {

        echo "<script>
                alert('Cuenta creada correctamente.');
                window.location='../html/login.html';
              </script>";

    } else {

        echo "<script>
                alert('Error al registrar.');
                window.history.back();
              </script>";

    }

} else {

    header("Location: ../index.html");
    exit();

}

?>