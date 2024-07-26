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
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registrar";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los parámetros de la solicitud
$lat = isset($_GET['lat']) ? floatval($_GET['lat']) : null;
$lon = isset($_GET['lon']) ? floatval($_GET['lon']) : null;
$radius = isset($_GET['radius']) ? intval($_GET['radius']) : 5; // Radio en km, puedes ajustarlo

// Validar latitud y longitud
if ($lat === null || $lon === null) {
    die(json_encode(['error' => 'Latitud y longitud son requeridas', 'debug' => $_GET]));
}

// Convertir el radio a grados (aproximado)
$radiusInDegrees = $radius / 111.045;

// Consultar los restaurantes cercanos
$sql = $conn->prepare("SELECT nombre, lat, lon FROM restaurantes WHERE (lat BETWEEN ? AND ?) AND (lon BETWEEN ? AND ?)");

$latMin = $lat - $radiusInDegrees;
$latMax = $lat + $radiusInDegrees;
$lonMin = $lon - $radiusInDegrees;
$lonMax = $lon + $radiusInDegrees;

$sql->bind_param("dddd", $latMin, $latMax, $lonMin, $lonMax);
$sql->execute();
$result = $sql->get_result();

$restaurantes = [];
while ($row = $result->fetch_assoc()) {
    $restaurantes[] = $row;
}

echo json_encode(['restaurantes' => $restaurantes]);

$conn->close();
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

    <div class="informacion-adicional">
        <h2>Lugares Cercanos</h2>

        <!-- Formulario para ingresar ubicación manualmente -->
        <div>
            <label for="ubicacion-manual">Ingresar ubicación:</label>
            <input type="text" id="ubicacion-manual" placeholder="Ciudad, País">
            <button onclick="buscarUbicacion()">Buscar</button>
        </div>

        <!-- Botón para obtener la ubicación automáticamente -->
        <div>
            <button onclick="obtenerUbicacion()">Usar mi ubicación</button>
        </div>

        <!-- Mapa -->
        <div id="mapa" style="height: 500px; width: 900px;"></div>
    </div>

    <!-- Resto del contenido del cuerpo -->

    <script>
        var map = L.map('mapa').setView([5.6904667, -76.6528579], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        function obtenerUbicacion() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lon = position.coords.longitude;
                    actualizarMapa(lat, lon);
                }, function(error) {
                    alert("No se pudo obtener la ubicación: " + error.message);
                });
            } else {
                alert("La geolocalización no es soportada por este navegador.");
            }
        }

        function buscarUbicacion() {
            var direccion = document.getElementById('ubicacion-manual').value;
            if (direccion) {
                fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${direccion}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            var lat = data[0].lat;
                            var lon = data[0].lon;
                            actualizarMapa(lat, lon);
                        } else {
                            alert("No se pudo encontrar la ubicación.");
                        }
                    })
                    .catch(error => {
                        alert("Error al buscar la ubicación: " + error.message);
                    });
            } else {
                alert("Por favor, ingrese una ubicación.");
            }
        }

        function actualizarMapa(lat, lon) {
            map.setView([lat, lon], 13);

            // Limpiar marcadores anteriores
            map.eachLayer(function (layer) {
                if (layer instanceof L.Marker) {
                    map.removeLayer(layer);
                }
            });

            // Añadir marcador para la ubicación actual
            L.marker([lat, lon]).addTo(map)
                .bindPopup('Ubicación seleccionada')
                .openPopup();

            // Solicitar restaurantes cercanos
            fetch(`pagina2.php?lat=${lat}&lon=${lon}`)
                .then(response => response.json())
                .then(data => {
                    if (data.restaurantes) {
                        data.restaurantes.forEach(function(restaurante) {
                            L.marker([restaurante.lat, restaurante.lon]).addTo(map)
                                .bindPopup(`<b>${restaurante.nombre}</b><br>${restaurante.direccion}`);
                        });
                    }
                })
                .catch(error => {
                    alert("Error al obtener restaurantes: " + error.message);
                });

        }
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
