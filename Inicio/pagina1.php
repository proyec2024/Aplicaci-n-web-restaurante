<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: index.php");
    exit();
}

// Obtén la información del usuario desde la sesión
$nombre = $_SESSION['nombre'];
$email = $_SESSION['email'];
$direccion = $_SESSION['direccion'];
$telefono = $_SESSION['telefono'];
$fecha = $_SESSION['fecha'];

// Conectar a la base de usuarioss
$servername = "162.240.236.205";
$username = "saludclasespiti_saludclasespiti";
$password = "bmXg8+g9hu)2";
$dbname = "saludclasespiti_restaurante";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener la información de los restaurantes
// Inicializar la variable de búsqueda
$searchTerm = '';
if (isset($_POST['buscar'])) {
    $searchTerm = $_POST['search'];
}

// Modificar la consulta para incluir el término de búsqueda si se proporciona
$sql_restaurantes = "SELECT r.nombre, r.imagen_url, r.facebook_url, r.twitter_url, r.instagram_url, d.url
                     FROM restaurantes r
                     JOIN detalles_restaurante d ON r.id = d.restaurantes_id";
if ($searchTerm) {
    $sql_restaurantes .= " WHERE r.nombre LIKE '%" . $conn->real_escape_string($searchTerm) . "%'";
}
$result_restaurantes = $conn->query($sql_restaurantes);

if ($result_restaurantes === false) {
    die("Error en la consulta de restaurantes: " . $conn->error);
}

// Obtener los datos de los restaurantes
$sql_ranking = "SELECT r.nombre, d.direccion, d.precio, d.calificacion, d.url
                FROM detalles_restaurante d
                JOIN restaurantes r ON d.restaurantes_id = r.id";
$result_ranking = $conn->query($sql_ranking);

if ($result_ranking === false) {
    die("Error en la consulta del ranking: " . $conn->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurantes</title>
    <link rel="stylesheet" href="estilos1.css">
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
                <button id="btnUsuario" onclick="mostrarInformacionUsuario()">
                    <i class="fas fa-user"></i> <!-- Icono de usuario -->
                </button>
            </div>
        </div>
    </header>

    <div id="infoUsuario" class="info-usuario-container">
        <h3><i class="fas fa-user"></i> Información del Usuario</h3>
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

    <h2 class="titulo-centrado">Restaurantes Recomendados</h2>
    <!-- Formulario de búsqueda -->
    <form method="post" action="">
        <input type="text" name="search" placeholder="Buscar restaurante por nombre" value="<?php echo htmlspecialchars($searchTerm); ?>">
        <button type="submit" name="buscar"><i class="fas fa-search"></i></button>
    </form>

    <div class="recuadros-container">
        <?php
        if ($result_restaurantes->num_rows > 0) {
            while($row = $result_restaurantes->fetch_assoc()) {
                echo '<div class="carta-doctor">';
                echo '<a href="' . $row['url'] . '" class="carta-link" target="_blank">';
                echo '<img src="' . $row["imagen_url"] . '" alt="Imagen del restaurante">';
                echo '<div class="informacion-doctor">';
                echo '<h3>' . $row["nombre"] . '</h3>';
                echo '<div class="redes-sociales">';
                echo '<a href="' . $row["facebook_url"] . '" class="icono-"><i class="fab fa-facebook"></i></a>';
                echo '<a href="' . $row["twitter_url"] . '" class="icono-"><i class="fab fa-twitter"></i></a>';
                echo '<a href="' . $row["instagram_url"] . '" class="icono-"><i class="fab fa-instagram"></i></a>';
                echo '</div>';
                echo '</div>';
                echo '</a>';
                echo '</div>';
            }
        } else {
            echo "<p>No se encontró ningún restaurante con ese nombre.</p>";
        }
        ?>
    </div>


    <?php $conn->close(); ?>


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
        function mostrarInformacionUsuario() {
            var infoUsuario = document.getElementById('infoUsuario');
            infoUsuario.style.display = (infoUsuario.style.display === 'block') ? 'none' : 'block';
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
