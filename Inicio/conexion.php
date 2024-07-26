<?php
$conexion = mysqli_connect("162.240.236.205", "saludclasespiti_saludclasespiti", "bmXg8+g9hu)2", "saludclasespiti_restaurante");

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

