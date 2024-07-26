<?php
include("conexion.php");

if (isset($_POST['registrar'])) {
    if (
        strlen($_POST['name']) >= 1 &&
        strlen($_POST['email']) >= 1 &&
        strlen($_POST['direction']) >= 1 &&
        strlen($_POST['phone']) >= 1 &&
        strlen($_POST['password']) >= 1
    ) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $direction = trim($_POST['direction']);
        $phone = trim($_POST['phone']);
        $password = trim($_POST['password']);
        $fecha = date("d/m/y");

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $consulta = "INSERT INTO usuarios(nombre,email,direccion,telefono,contraseña, fecha)
                VALUES('$name','$email','$direction','$phone','$hashed_password','$fecha')";

        $resultado = mysqli_query($conexion, $consulta);

        if ($resultado) {

            // Muestra SweetAlert si el registro es exitoso
            echo '<script>
                    Swal.fire({
                      icon: "success",
                      title: "¡Registro exitoso!",
                      text: "Bienvenido ' . $name . '",
                    }).then((result) => {
                      if (result.isConfirmed) {
                        window.location.href = "../index.php";
                      }
                    });
                  </script>';
            exit();
        } else {
            // Muestra SweetAlert si ocurre un error
            echo '<script>
                    Swal.fire({
                      icon: "error",
                      title: "Error...",
                      text: "Ocurrió un error al registrar.",
                    });
                  </script>';
        }
    } else {
        // Muestra SweetAlert si hay campos vacíos
        echo '<script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Hay campos vacíos.",
                });
              </script>';
    }
}
