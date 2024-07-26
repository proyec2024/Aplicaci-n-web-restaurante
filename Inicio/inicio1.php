<?php
session_start();
include("conexion.php");

// Verifica si se envió el formulario de inicio de sesión //
if (isset($_POST['iniciar'])) {
    function validate($data) {
        $data = stripslashes($data);
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $contrasena = validate($_POST['password']);

    if (empty($email) || empty($contrasena)) {
        // Muestra SweetAlert si hay campos vacíos//
        echo '<script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Hay campos vacíos.",
                });
              </script>';
    } else {
        // Utiliza mysqli_real_escape_string para prevenir SQL injection //
        $email = mysqli_real_escape_string($conexion, $email);

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $result = mysqli_query($conexion, $sql);

        if ($result) {
            if (mysqli_num_rows($result) === 1) {
                $row = mysqli_fetch_assoc($result);

                if (password_verify($contrasena, $row['contraseña'])) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['direccion'] = $row['direccion'];
                    $_SESSION['telefono'] = $row['telefono'];
                    $_SESSION['contraseña'] = $row['contraseña'];
                    $_SESSION['fecha'] = $row['fecha'];

                    // Establecer $_SESSION['usuarios_id'] aquí
                    $_SESSION['usuarios_id'] = $row['id'];


                    header("Location: Inicio/pagina.php");
                    exit();
                } else {
                    // Muestra SweetAlert si la contraseña es incorrecta
                    echo '<script>
                            Swal.fire({
                              icon: "error",
                              title: "Error...",
                              text: "El nombre o la contraseña es incorrecta.",
                            });
                          </script>';
                }
            } else {
                // Muestra SweetAlert si el email de usuario no está registrado
                echo '<script>
                        Swal.fire({
                          icon: "error",
                          title: "Error...",
                          text: "El email de usuario no está registrado.",
                        });
                      </script>';
            }
        } else {
            // Muestra SweetAlert si hubo un error al procesar la solicitud
            echo '<script>
                    Swal.fire({
                      icon: "error",
                      title: "Error...",
                      text: "Hubo un error al procesar la solicitud.",
                    });
                  </script>';
        }
    }
}

