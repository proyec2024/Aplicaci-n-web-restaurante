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

// Conectar a la base de datos
// Conectar a la base de usuarioss
$servername = "162.240.236.205";
$username = "saludclasespiti_saludclasespiti";
$password = "bmXg8+g9hu)2";
$dbname = "saludclasespiti_restaurante";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lugares Cercanos</title>
    <link rel="stylesheet" href="estilos2.css">
    <link rel="icon" type="image/png" sizes="16x16" href="images/G.png">
    <script src="https://kit.fontawesome.com/6dde98c905.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
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

    </div>
        <div class="informacion-adicional">
            <h2>Lugares Cercanos</h2>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d13353.962557131572!2d-76.65285788371962!3d5.690466731962015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1srestaurantes!5e0!3m2!1ses-419!2sco!4v1719935956588!5m2!1ses-419!2sco"
                width="900"
                height="500"
                style="border:0;"
                allowfullscreen
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>

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
