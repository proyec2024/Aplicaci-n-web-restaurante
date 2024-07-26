<?php
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['nombre'])) {
    header("Location: ../index.php");
    exit();
}

// Conectar a la base de datos
require '../Inicio/conexion.php';

// Obtén la información del usuario desde la sesión
$usuarios_id = isset($_SESSION['usuarios_id']) ? $_SESSION['usuarios_id'] : '';
$nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : '';
$email = isset($_SESSION['email']) ? $_SESSION['email'] : '';
$telefono = isset($_SESSION['telefono']) ? $_SESSION['telefono'] : '';

// Obtener el ID del restaurante desde el nombre de la carpeta
$path = realpath(dirname(__FILE__));
$folder_name = basename($path);
preg_match('/\d+/', $folder_name, $matches);
$restaurantes_id = $matches[0];

// Guardar restaurante_id en la sesión
$_SESSION['restaurantes_id'] = $restaurantes_id;


// Obtener datos de la tabla 'restaurantes' y 'detalles_restaurante'
$sql_restaurante = "SELECT r.nombre AS nombre_restaurante, r.imagen_url, r.facebook_url, r.twitter_url, r.instagram_url, d.descripcion
                    FROM restaurantes r
                    JOIN detalles_restaurante d ON r.id = d.restaurantes_id
                    WHERE r.id = ?";

$stmt_restaurante = $conexion->prepare($sql_restaurante);
$stmt_restaurante->bind_param("i", $restaurantes_id);
$stmt_restaurante->execute();
$result_restaurante = $stmt_restaurante->get_result();

// Verificar si se encontraron resultados
if ($result_restaurante->num_rows > 0) {
    // Obtener los datos del restaurante
    $row_restaurante = $result_restaurante->fetch_assoc();
    $Nombre = $row_restaurante['nombre_restaurante']; // Aquí cambia a $Nombre
    $imagen_url = '../Inicio/' . $row_restaurante['imagen_url']; // Ruta a la imagen del restaurante
    $descripcion = $row_restaurante['descripcion'];
} else {
    echo "No se encontraron resultados.";
    $Nombre = "Nombre por defecto"; // Aquí cambia a $Nombre
    $imagen_url = "../Inicio/images/default_image.jpg"; // Ruta a una imagen por defecto
    $descripcion = "Descripción por defecto.";
}

// Obtener los platillos del día
$sql_platillos = "SELECT nombre, descripcion, imagen_url FROM platillos_del_dia WHERE restaurantes_id = ?";
$stmt_platillos = $conexion->prepare($sql_platillos);
$stmt_platillos->bind_param("i", $restaurantes_id);
$stmt_platillos->execute();
$result_platillos = $stmt_platillos->get_result();

$platillos = [];
if ($result_platillos->num_rows > 0) {
    while ($row_platillo = $result_platillos->fetch_assoc()) {
        $platillos[] = $row_platillo;
    }
} else {
    echo "No se encontraron platillos del día.";
}

// Obtener las categorías del menú
$sql_categorias = "SELECT id, nombre FROM categorias_menu WHERE restaurantes_id = ?";
$stmt_categorias = $conexion->prepare($sql_categorias);
$stmt_categorias->bind_param("i", $restaurantes_id);
$stmt_categorias->execute();
$result_categorias = $stmt_categorias->get_result();

$categorias = [];
if ($result_categorias->num_rows > 0) {
    while ($row_categoria = $result_categorias->fetch_assoc()) {
        $categorias[] = $row_categoria;
    }
} else {
    echo "No se encontraron categorías del menú.";
}

// Obtener los items del menú para cada categoría
$items_menu = [];
foreach ($categorias as $categoria) {
    $categoria_id = $categoria['id'];
    $sql_items = "SELECT id, nombre, descripcion, precio, imagen FROM items_menu WHERE categoria_id = ?";
    $stmt_items = $conexion->prepare($sql_items);
    $stmt_items->bind_param("i", $categoria_id);
    $stmt_items->execute();
    $result_items = $stmt_items->get_result();

    $items = [];
    if ($result_items->num_rows > 0) {
        while ($row_item = $result_items->fetch_assoc()) {
            $items[] = $row_item;
        }
    }
    $items_menu[$categoria_id] = $items;
}

// Obtener las imágenes y descripciones de la galería
$sql_galeria = "SELECT id, imagen, descripcion FROM galeria WHERE restaurantes_id = ?";
$stmt_galeria = $conexion->prepare($sql_galeria);
$stmt_galeria->bind_param("i", $restaurantes_id);
$stmt_galeria->execute();
$result_galeria = $stmt_galeria->get_result();

$galeria = [];
if ($result_galeria->num_rows > 0) {
    while ($row_galeria = $result_galeria->fetch_assoc()) {
        $galeria[] = $row_galeria;
    }
} else {
    echo "No se encontraron imágenes en la galería.";
}

$conexion->close();
?>




<!DOCTYPE html>
<html lang="en">

<head>

 <!-- Basic -->
 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title>Food Funday Restaurant - One page HTML Responsive</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- SweetAlert2 CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="css/colors/orange.css" />

    <!-- Modernizer -->
    <script src="js/modernizer.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.min.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Slick Slider -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="loader">
        <div id="status"></div>
    </div>
    <div id="site-header">
        <header id="header" class="header-block-top">
            <div class="container">
                <div class="row">
                    <div class="main-menu">
                        <!-- navbar -->
                        <nav class="navbar navbar-default" id="mainNav">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <div class="logo">
                                    <a class="navbar-brand js-scroll-trigger logo-header" href="#">
                                        <img src="images/logo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div id="navbar" class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li class="active"><a href="#banner">Home</a></li>
                                    <li><a href="#about">About us</a></li>
                                    <li><a href="#menu">Menu</a></li>
                                    <li><a href="#gallery">Gallery</a></li>
                                    <li><a href="#reservation">Reservation</a></li>
                                    <li id="cart-icon" style="display: none;">
                                        <a href="#cart" id="cart-link">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span id="cart-count">0</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end nav-collapse -->
                        </nav>
                        <!-- end navbar -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </header>
        <!-- end header -->
    </div>
    <!-- end site-header -->


    <div id="banner" class="banner full-screen-mode parallax" style="background-image: url('<?php echo htmlspecialchars($imagen_url); ?>');">
        <div class="container pr">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-static">
                    <div class="banner-text">
                        <div class="banner-cell">
                            <h1>Cena con nosotros <span class="typer" id="some-id" data-delay="200" data-delim=":" data-words="<?php echo htmlspecialchars($Nombre); ?>" data-colors="red"></span><span class="cursor" data-cursorDisplay="_" data-owner="some-id"></span></h1>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diem nonummy nibh euismod</p>
                            <div class="book-btn">
                                <a href="#reservation" class="table-btn hvr-underline-from-center">Reservar mi Mesa</a>
                            </div>
                            <a href="#about">
                                <div class="mouse"></div>
                            </a>
                        </div>
                        <!-- end banner-cell -->
                    </div>
                    <!-- end banner-text -->
                </div>
                <!-- end banner-static -->
            </div>
            <!-- end col -->
        </div>
        <!-- end container -->
    </div>
    <!-- end banner -->

    <div id="about" class="about-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title"> About Us </h2>
                        <h3>IT STARTED, QUITE SIMPLY, LIKE THIS...</h3>
                        <p><?php echo htmlspecialchars($descripcion); ?></p>
                    </div>
                </div>
                <!-- end col -->
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <div class="about-images">
                            <img class="about-main" src="images/about-main.jpg" alt="About Main Image">
                            <img class="about-inset" src="images/about-inset.jpg" alt="About Inset Image">
                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end about-main -->

    <!-- Today's Special Section -->
    <div class="special-menu pad-top-100 parallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title color-white text-center"> Today's Special </h2>
                        <h5 class="title-caption text-center"> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusm incididunt ut labore et dolore magna aliqua. Ut enim ad minim venia,nostrud exercitation ullamco. </h5>
                    </div>
                    <div class="special-box">
                        <div id="owl-demo" class="owl-carousel owl-theme">
                            <?php foreach ($platillos as $platillo): ?>
                                <div class="item item-type-zoom">
                                    <a href="#" class="item-hover">
                                        <div class="item-info">
                                            <div class="headline">
                                                <?php echo htmlspecialchars($platillo['nombre']); ?>
                                                <div class="line"></div>
                                                <div class="dit-line"><?php echo htmlspecialchars($platillo['descripcion']); ?></div>
                                            </div>
                                        </div>
                                    </a>
                                    <div class="item-img">
                                        <img src="images/<?php echo htmlspecialchars($platillo['imagen_url']); ?>" alt="special menu">
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- End special-box -->
                </div>
                <!-- End col -->
            </div>
            <!-- End row -->
        </div>
        <!-- End container -->
    </div>
    <!-- End special-menu -->


    <div id="menu" class="menu-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">Our Menu</h2>
                        <p class="title-caption text-center"><?php echo htmlspecialchars($descripcion, ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                    <div class="tab-menu">
                        <div class="slider slider-nav">
                            <?php foreach ($categorias as $categoria): ?>
                                <div class="tab-title-menu">
                                    <h2><?php echo htmlspecialchars($categoria['nombre'], ENT_QUOTES, 'UTF-8'); ?></h2>
                                    <p><i class="flaticon-canape"></i></p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="slider slider-single">
                            <?php foreach ($categorias as $categoria): ?>
                                <div>
                                    <div class="row">
                                        <?php if (!empty($items_menu[$categoria['id']])): ?>
                                            <?php foreach ($items_menu[$categoria['id']] as $item): ?>
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <div class="offer-item">
                                                        <button class="add-to-cart"
                                                            data-id="<?php echo htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-name="<?php echo htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-price="<?php echo htmlspecialchars($item['precio'], ENT_QUOTES, 'UTF-8'); ?>"
                                                            data-image="<?php echo htmlspecialchars($item['imagen'], ENT_QUOTES, 'UTF-8'); ?>">
                                                            <img src="<?php echo htmlspecialchars($item['imagen'], ENT_QUOTES, 'UTF-8'); ?>" alt="" class="img-responsive">
                                                            <div>
                                                                <h3><?php echo htmlspecialchars($item['nombre'], ENT_QUOTES, 'UTF-8'); ?></h3>
                                                                <p><?php echo htmlspecialchars($item['descripcion'], ENT_QUOTES, 'UTF-8'); ?></p>
                                                            </div>
                                                            <span class="offer-price"><?php echo htmlspecialchars($item['precio'], ENT_QUOTES, 'UTF-8'); ?></span>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <p class="text-center">No items available in this category.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
    $(document).ready(function(){
        $('.slider-nav').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            asNavFor: '.slider-single',
            dots: true,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1,
                        arrows: true // Habilitar flechas en pantallas más pequeñas
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: true // Habilitar flechas en pantallas más pequeñas
                    }
                }
            ]
        });

        $('.slider-single').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            asNavFor: '.slider-nav',
            dots: true,
            arrows: false,
            fade: true,
            adaptiveHeight: true
        });
    });

    </script>


    <div id="cartDetails" style="display: none; position: fixed; right: 10px; top: 50px; z-index: 1000; background-color: white; border: 1px solid #ccc; padding: 10px; max-width: 300px; overflow-y: auto;"></div>
    <a href="#" id="cart-link"><img id="cart-icon" src="path-to-cart-icon.png" style="display: none;" alt="Cart"><span id="cart-count">0</span></a>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cart = [];
            const cartIcon = document.getElementById('cart-icon');
            const cartCount = document.getElementById('cart-count');
            const cartLink = document.getElementById('cart-link');
            const cartDetails = document.getElementById('cartDetails');

            // Función para renderizar el carrito
            function renderCart() {
                cartDetails.innerHTML = '';
                cart.forEach(item => {
                    const div = document.createElement('div');
                    div.classList.add('cart-item');
                    div.innerHTML = `<p>${item.name} - $${item.price.toFixed(2)} <span class="item-quantity">x${item.quantity}</span></p>
                                    <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">-</button>
                                    <button class="btn btn-sm btn-primary add-item" data-id="${item.id}">+</button>`;
                    cartDetails.appendChild(div);
                });

                const totalPrice = cart.reduce((total, item) => total + item.price * item.quantity, 0);
                cartDetails.innerHTML += `<p>Total: $${totalPrice.toFixed(2)}</p>
                                        <button id="placeOrderBtn" class="btn btn-primary">Place Order</button>`;
                cartDetails.style.display = 'block';
            }

            // Función para actualizar el contador del carrito
            function updateCartCount() {
                cartCount.textContent = cart.reduce((total, item) => total + item.quantity, 0);
                cartIcon.style.display = 'inline';
            }

            // Función para agregar un item al carrito
            function addItemToCart(id, name, price, image) {
                const existingItem = cart.find(item => item.id === id);
                if (existingItem) {
                    existingItem.quantity++;
                } else {
                    const item = { id, name, price, image, quantity: 1 };
                    cart.push(item);
                }
                updateCartCount();
                renderCart();
            }

            // Función para eliminar un item del carrito
            function removeItemFromCart(id) {
                const itemIndex = cart.findIndex(item => item.id === id);
                if (itemIndex !== -1) {
                    cart[itemIndex].quantity--;
                    if (cart[itemIndex].quantity === 0) {
                        cart.splice(itemIndex, 1);
                    }
                }
                updateCartCount();
                renderCart();
            }

            // Agregar event listeners a los botones de añadir al carrito
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const price = parseFloat(this.getAttribute('data-price'));
                    const image = this.getAttribute('data-image');
                    addItemToCart(id, name, price, image);
                });
            });

            // Mostrar/ocultar detalles del carrito al hacer clic en el icono del carrito
            cartLink.addEventListener('click', function (event) {
                event.preventDefault();
                if (cartDetails.style.display === 'block') {
                    cartDetails.style.display = 'none';
                } else {
                    renderCart();
                }
            });

            // Agregar event listeners para incrementar/decrementar la cantidad de un ítem
            document.addEventListener('click', function (event) {
                if (event.target.classList.contains('add-item')) {
                    const itemId = event.target.getAttribute('data-id');
                    const item = cart.find(item => item.id === itemId);
                    addItemToCart(item.id, item.name, item.price, item.image);
                }
                if (event.target.classList.contains('remove-item')) {
                    const itemId = event.target.getAttribute('data-id');
                    removeItemFromCart(itemId);
                }
                if (event.target.id === 'placeOrderBtn') {
                    alert('Order placed!');
                    // Aquí puedes añadir la lógica para imprimir la factura
                }
            });
        });
    </script>






    <div id="gallery" class="gallery-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                        <h2 class="block-title text-center">
                            Our Gallery
                        </h2>
                        <p class="title-caption text-center">There are many variations of passages of Lorem Ipsum available </p>
                    </div>
                    <div class="gal-container clearfix">
                        <?php
                        $colSizes = [
                            1 => '8',
                            2 => '4',
                            3 => '4',
                            4 => '4',
                            5 => '4',
                            6 => '4',
                            7 => '8',
                            8 => '4',
                            9 => '4',
                            10 => '4'
                        ];

                        foreach ($galeria as $index => $imagen):
                            $colSize = $colSizes[$index + 1] ?? '4'; // Fallback to '4' if index is not in colSizes
                        ?>
                            <div class="col-md-<?php echo $colSize; ?> col-sm-6 col-xs-12 gal-item">
                                <div class="box">
                                    <a href="#" data-toggle="modal" data-target="#gallery_<?php echo $imagen['id']; ?>">
                                        <img src="<?php echo $imagen['imagen']; ?>" alt="" />
                                    </a>
                                    <div class="modal fade" id="gallery_<?php echo $imagen['id']; ?>" tabindex="-1" role="dialog">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                <div class="modal-body">
                                                    <img src="<?php echo $imagen['imagen']; ?>" alt="" />
                                                </div>
                                                <div class="col-md-12 description">
                                                    <h4><?php echo $imagen['descripcion']; ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- end gal-container -->
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end gallery-main -->


    <div id="reservation" class="reservations-main pad-top-100 pad-bottom-100">
        <div class="container">
            <div class="row">
                <div class="form-reservations-box">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2 class="block-title text-center">Reservations</h2>
                        <h4 class="form-title">BOOKING FORM</h4>
                        <p>PLEASE FILL OUT ALL REQUIRED* FIELDS. THANKS!</p>

                        <form method="post" class="reservations-box" name="contactform" action="process_reservation.php">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="form_name" id="form_name" placeholder="Name" value="<?php echo htmlspecialchars($nombre_usuario); ?>" required="required" class="form-control">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="E-Mail ID" value="<?php echo htmlspecialchars($email); ?>" required="required" class="form-control">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" placeholder="Contact no." value="<?php echo htmlspecialchars($telefono); ?>" required="required" class="form-control">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <select name="no_of_persons" id="no_of_persons" required="required" class="form-control">
                                        <option value="" disabled selected>No. Of persons</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">More than 7</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="date_picker">Fecha de reservación</label>
                                    <input type="date" id="date_picker" name="date_picker" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="time_picker">Hora de reservación</label>
                                    <input type="time" id="time_picker" name="time_picker" required="required" class="form-control">
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <select name="preferred_food" id="preferred_food" required="required" class="form-control">
                                        <option value="" disabled selected>Preferred food</option>
                                        <option value="Indian">Indian</option>
                                        <option value="Continental">Continental</option>
                                        <option value="Mexican">Mexican</option>
                                        <option value="Colombian">Colombian</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <select name="occasion" id="occasion" required="required" class="form-control">
                                        <option value="" disabled selected>Occasion</option>
                                        <option value="Wedding">Wedding</option>
                                        <option value="Birthday">Birthday</option>
                                        <option value="Anniversary">Anniversary</option>
                                        <option value="Executive">Executive</option>
                                        <option value="Normal">Normal</option>
                                    </select>
                                </div>
                            </div>
                            <!-- end col -->

                            <!-- Hidden fields for restaurant and user IDs -->
                            <input type="hidden" name="usuarios_id" value="<?php echo htmlspecialchars($usuarios_id); ?>">
                            <input type="hidden" name="restaurantes_id" value="<?php echo htmlspecialchars($restaurantes_id); ?>">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="reserve-book-btn text-center">
                                    <button type="submit" value="SEND" id="submit" class="btn btn-primary">BOOK MY TABLE</button>
                                </div>
                            </div>
                            <!-- end col -->
                        </form>
                        <!-- end form -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end reservations-box -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end reservations-main -->


    <div class="footer-box pad-top-70">
        <div class="container">
            <div class="row">
                <div class="footer-in-main">
                    <div class="footer-logo">
                        <div class="text-center">
                            <img src="images/logo.png" alt="" />
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="footer-box-a">
                            <h3>About Us</h3>
                            <p>Aenean commodo ligula eget dolor aenean massa. Cum sociis nat penatibu set magnis dis parturient montes.</p>
                            <ul class="socials-box footer-socials pull-left">
                                <?php if (!empty($row_restaurante['facebook_url'])): ?>
                                    <li>
                                        <a href="<?php echo $row_restaurante['facebook_url']; ?>" target="_blank">
                                            <div class="social-circle-border"><i class="fa  fa-facebook"></i></div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($row_restaurante['twitter_url'])): ?>
                                    <li>
                                        <a href="<?php echo $row_restaurante['twitter_url']; ?>" target="_blank">
                                            <div class="social-circle-border"><i class="fa fa-twitter"></i></div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if (!empty($row_restaurante['instagram_url'])): ?>
                                    <li>
                                        <a href="<?php echo $row_restaurante['instagram_url']; ?>" target="_blank">
                                            <div class="social-circle-border"><i class="fa fa-instagram"></i></div>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        <!-- end footer-box-a -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="footer-box-b">
                            <h3>New Menu</h3>
                            <ul>
                                <li><a href="#">Italian Bomba Sandwich</a></li>
                                <li><a href="#">Double Dose of Pork Belly</a></li>
                                <li><a href="#">Spicy Thai Noodles</a></li>
                                <li><a href="#">Triple Truffle Trotters</a></li>
                            </ul>
                        </div>
                        <!-- end footer-box-b -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="footer-box-c">
                            <h3>Contact Us</h3>
                            <p>
                                <i class="fa fa-map-signs" aria-hidden="true"></i>
                                <span>6 E Esplanade, St Albans VIC 3021, Australia</span>
                            </p>
                            <p>
                                <i class="fa fa-mobile" aria-hidden="true"></i>
                                <span>+91 80005 89080</span>
                            </p>
                            <p>
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span><a href="#">support@foodfunday.com</a></span>
                            </p>
                        </div>
                        <!-- end footer-box-c -->
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="footer-box-d">
                            <h3>Opening Hours</h3>
                            <ul>
                                <li>
                                    <p>Monday - Thursday </p>
                                    <span> 11:00 AM - 9:00 PM</span>
                                </li>
                                <li>
                                    <p>Friday - Saturday </p>
                                    <span>  11:00 AM - 5:00 PM</span>
                                </li>
                            </ul>
                        </div>
                        <!-- end footer-box-d -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end footer-in-main -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end footer-box -->

    <div id="copyright" class="copyright-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <h6 class="copy-title">Copyright &copy; 2017 Food Funday is powered by <a href="#" target="_blank"></a></h6>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end copyright-main -->



    <!-- ALL JS FILES -->
    <script src="js/all.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- ALL PLUGINS -->
    <script src="js/custom.js"></script>

    <!-- Modal -->
    <div id="cartDetails"></div>


</body>

</html>
