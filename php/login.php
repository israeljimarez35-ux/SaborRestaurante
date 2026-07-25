<?php

session_start();

require_once("../php/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener datos del formulario
    $correo = trim($_POST["correo"]);
    $password = $_POST["password"];

    $consulta = $conexion->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $consulta->execute([$correo]);

    if ($consulta->rowCount() == 1) {

        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if (password_verify($password, $usuario["password"])) {

            $_SESSION["id"] = $usuario["id"];
            $_SESSION["nombre"] = $usuario["nombre"];
            $_SESSION["correo"] = $usuario["correo"];

            header("Location: ../html/inicio.html");
            exit();

        } else {

            echo "<script>
                    alert('Contraseña incorrecta.');
                    window.location='/login.html';
                  </script>";

        }

    } else {

        echo "<script>
                alert('El correo no está registrado.');
                window.location='../html/login.html';
              </script>";

    }

} else {

    header("Location: ../html/login.html");
    exit();

}

?>