<?php
session_start();

// Verifica si el usuarios ha iniciado sesión
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

// Conectar a la base de usuarioss
$servername = "162.240.236.205";
$username = "saludclasespiti_saludclasespiti";
$password = "bmXg8+g9hu)2";
$dbname = "saludclasespiti_restaurante";


$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_error) {
    die("Connection failed: " . $conexion->connect_error);
}

$usuarios_id = $_SESSION['id'];

// Ejemplo de cómo recuperar el nombre del usuarios desde la base de usuarioss
$sql_usuarios = "SELECT nombre, email, direccion, telefono FROM usuarios WHERE id = ?";
$stmt_usuarios = $conexion->prepare($sql_usuarios);
$stmt_usuarios->bind_param("i", $usuarios_id);
$stmt_usuarios->execute();
$result_usuarios = $stmt_usuarios->get_result();

if ($result_usuarios->num_rows > 0) {
    $row_usuarios = $result_usuarios->fetch_assoc();
    $nombre = $row_usuarios['nombre'];
    $email = $row_usuarios['email'];
    $direccion = $row_usuarios['direccion'];
    $telefono = $row_usuarios['telefono'];
} else {
    echo "No se encontraron usuarioss para el usuarios.";
}

$stmt_usuarios->close();

$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];
$direccion = $_SESSION['direccion'];
$telefono = $_SESSION['telefono'];
$fecha = $_SESSION['fecha'];


// Obtener la información de los restaurantes
$sql_restaurantes = "SELECT r.nombre, r.imagen_url, r.facebook_url, r.twitter_url, r.instagram_url, d.url
                     FROM restaurantes r
                     JOIN detalles_restaurante d ON r.id = d.restaurantes_id";
$result_restaurantes = $conexion->query($sql_restaurantes);

if ($result_restaurantes === false) {
    die("Error en la consulta de restaurantes: " . $conexion->error);
}

// Obtener los usuarioss de los restaurantes
$sql_ranking = "SELECT r.nombre, d.direccion, d.precio, d.calificacion, d.url
                FROM detalles_restaurante d
                JOIN restaurantes r ON d.restaurantes_id = r.id";
$result_ranking = $conexion->query($sql_ranking);

if ($result_ranking === false) {
    die("Error en la consulta del ranking: " . $conexion->error);
}

$alguna_condicion = false;
if ($alguna_condicion) {
    // Redireccionar a la carpeta restaurante1
    header("Location: ../restaurante1/index.php");
    header("Location: ../restaurante2/index.php");
    header("Location: ../restaurante3/index.php");

    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ranking De Restaurantes</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/G.png">
    <script src="https://kit.fontawesome.com/6dde98c905.js" crossorigin="anonymous"></script>

</head>
<body>

    <header>
        <div class="header-content">
            <img src="images/G.png" alt="Icono" class="header-icon">
            <h1>Restaurant Reservations</h1>
            <div class="segundo-header">
                <form method="post" action="pagina.php">
                    <button type="submit" name="cerrar_sesion">Inicio</button>
                </form>
                <form method="post" action="pagina1.php">
                    <button type="submit" name="cerrar_sesion">Restaurantes</button>
                </form>
                <form method="post" action="pagina2.php">
                    <button type="submit" name="cerrar_sesion">Lugares Cercanos</button>
                </form>
                <form method="post" action="pagina3.php">
                    <button type="submit" name="cerrar_sesion">Ranking De Restaurantes</button>
                </form>
                <button id="btnusuarios" onclick="mostrarInformacionusuarios()">
                    <i class="fas fa-user"></i> <!-- Icono de usuarios -->
                </button>
            </div>
        </div>
    </header>

    <div id="infousuarios" class="info-usuarios-container">
        <h3><i class="fas fa-user"></i> Información del usuarios</h3>
        <p><strong>Nombre:</strong> <?php echo $nombre; ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>Dirección:</strong> <?php echo $direccion; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $telefono; ?></p>
        <p><strong>Fecha de Registro:</strong> <?php echo $fecha; ?></p>

        <form method="post" action="cerrar.php">
            <button type="submit" name="cerrar_sesion">
            <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesion
            </button>
        </form>

    </div>


    <div class="ranking-restaurantes">
        <h2>Ranking de los Mejores Restaurantes</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Ubicación</th>
                    <th>Precio</th>
                    <th>Calificación</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if ($result_ranking->num_rows > 0) {
                while($row = $result_ranking->fetch_assoc()) {
                    echo "<tr onclick=\"window.open('" . $row['url'] . "', '_blank')\">";
                    echo "<td>" . $row["nombre"] . "</td>";
                    echo "<td>" . $row["direccion"] . "</td>";
                    echo "<td>" . $row["precio"] . "</td>";
                    echo "<td><span class='estrellas'>";
                    echo str_repeat('&#9733;', floor($row["calificacion"]));
                    echo str_repeat('&#9734;', 5 - floor($row["calificacion"]));
                    echo "</span></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No hay resultados.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>


    <?php $conexion->close(); ?>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            let index = 0;
            const imagenes = document.querySelectorAll('.carrusel img');
            const intervalo = 3000; // Cambia la imagen cada 3 segundos (3000 milisegundos)

            function cambiarImagen() {
                imagenes.forEach(img => img.style.display = 'none');
                index = (index + 1) % imagenes.length;
                imagenes[index].style.display = 'block';
            }

            cambiarImagen(); // Muestra la primera imagen al cargar la página

            setInterval(cambiarImagen, intervalo); // Cambia la imagen cada intervalo de tiempo
        });
    </script>

    <script>
        function mostrarInformacionusuarios() {
            var infousuarios = document.getElementById('infousuarios');
            infousuarios.style.display = (infousuarios.style.display === 'block') ? 'none' : 'block';
        }
    </script>


    <footer>
        <div class="footer-container">
            <div class="footer-section">
                <h3>Contacto</h3>
                <ul>
                    <li>Dirección: ***/***/***</li>
                    <li>Teléfono: 123-456-7890</li>
                    <li>Email: info@Restaurantes.com</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Enlaces útiles</h3>
                <ul>
                    <li><a href="pagina.php">Inicio</a></li>
                    <li><a href="pagina1.php">Restaurantes</a></li>
                    <li><a href="pagina2.php">Lugares Cercanos</a></li>
                    <li><a href="pagina3.php">Ranking De Restaurantes</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Redes Sociales</h3>
                <ul>
                    <li><a href="https://www.facebook.com/">Facebook</a></li>
                    <li><a href="https://www.google.com/">Google</a></li>
                    <li><a href="https://www.instagram.com/">Instagram</a></li>
                    <li><a href="https://twitter.com/">Twitter</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-line"></div> <!-- Nueva línea -->
            <div class="opciones">
            <h2>Opciones predeterminadas</h2>
                <a href="pagina.php" class="icono-btn"><i class="fas fa-home"></i></a>
                <a href="https://www.facebook.com/" class="icono-btn"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.google.com/" class="icono-btn"><i class="fa-brands fa-google"></i></a>
                <a href="https://www.instagram.com/" class="icono-btn"><i class="fa-brands fa-instagram"></i></a>
                <a href="mailto:correo@example.com" class="icono-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://twitter.com/" class="icono-btn"><i class="fa-brands fa-twitter"></i></a>
        </div>
    </footer>

</body>
</html>
