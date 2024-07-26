<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include("../Inicio/conexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $required_fields = ['restaurantes_id', 'form_name', 'email', 'phone', 'no_of_persons', 'date_picker', 'time_picker', 'preferred_food', 'occasion'];
    foreach ($required_fields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Error</title>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            </head>
            <body>
            <script>
                    Swal.fire({
                      icon: "error",
                      title: "Error...",
                      text: "Por favor complete todos los campos requeridos.",
                    }).then(function() {
                        window.location = "index.php";
                    });
            </script>
            </body>
            </html>';
            exit();
        }
    }

    $restaurantes_id = $_POST['restaurantes_id'];
    $nombre_reservacion = $_POST['form_name'];
    $email_reservacion = $_POST['email'];
    $telefono_reservacion = $_POST['phone'];
    $no_of_persons = $_POST['no_of_persons'];
    $date_picker = $_POST['date_picker'];
    $time_picker = $_POST['time_picker'];
    $preferred_food = $_POST['preferred_food'];
    $occasion = $_POST['occasion'];

    if (!isset($_SESSION['usuarios_id'])) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        </head>
        <body>
        <script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Usuario no autenticado.",
                }).then(function() {
                    window.location = "index.php";
                });
        </script>
        </body>
        </html>';
        exit();
    }

    $usuarios_id = $_SESSION['usuarios_id'];

    $observaciones = "Comida preferida: $preferred_food, Ocasión: $occasion";
    $estado = "Pendiente"; // Definir el estado deseado para la reserva

    $sql = "INSERT INTO reservaciones (usuarios_id, restaurantes_id, fecha_reserva, hora_reserva, numero_personas, observaciones, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    if ($stmt === false) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        </head>
        <body>
        <script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Ocurrió un error al registrar la reserva.",
                }).then(function() {
                    window.location = "index.php";
                });
        </script>
        </body>
        </html>';
        exit();
    }

    if (!$stmt->bind_param("iisssss", $usuarios_id, $restaurantes_id, $date_picker, $time_picker, $no_of_persons, $observaciones, $estado)) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        </head>
        <body>
        <script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Ocurrió un error al asignar los parámetros.",
                }).then(function() {
                    window.location = "index.php";
                });
        </script>
        </body>
        </html>';
        exit();
    }

    if (!$stmt->execute()) {
        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Error</title>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
        </head>
        <body>
        <script>
                Swal.fire({
                  icon: "error",
                  title: "Error...",
                  text: "Ocurrió un error al ejecutar la reserva.",
                }).then(function() {
                    window.location = "index.php";
                });
        </script>
        </body>
        </html>';
        exit();
    }

    // Si la inserción fue exitosa, mostrar un SweetAlert de éxito
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Reserva realizada</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body>
    <script>
            Swal.fire({
              icon: "success",
              title: "¡Reserva realizada!",
              text: "Su reserva está pendiente de confirmación. Nos comunicaremos con usted pronto.",
            }).then(function() {
                window.location = "index.php"; // Redirigir a la página de reserva o a donde desees
            });
    </script>
    </body>
    </html>';

    $stmt->close();
    $conexion->close();
} else {
    echo '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Error</title>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    </head>
    <body>
    <script>
            Swal.fire({
              icon: "error",
              title: "Error...",
              text: "No se recibieron datos del formulario.",
            }).then(function() {
                window.location = "index.php";
            });
    </script>
    </body>
    </html>';
}
?>
