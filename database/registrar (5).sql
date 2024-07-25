-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-07-2024 a las 19:25:54
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `registrar`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_menu`
--

CREATE TABLE `categorias_menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `restaurantes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_menu`
--

INSERT INTO `categorias_menu` (`id`, `nombre`, `restaurantes_id`) VALUES
(1, 'STARTERS', 1),
(2, 'MAIN DISHES', 1),
(3, 'DESERTS', 1),
(4, 'DRINKS', 1),
(5, 'STARTERS', 2),
(6, 'MAIN DISHES', 2),
(7, 'DESERTS', 2),
(8, 'DRINKS', 2),
(11, 'Bebidas', 1),
(12, 'Kid', 1),
(13, 'Promociones ', 1),
(14, 'STARTERS', 3),
(15, 'MAIN DISHES', 3),
(16, 'DESERTS', 3),
(17, 'VEGAN', 3),
(18, 'DRINKS', 3),
(19, 'STARTERS', 4),
(20, 'MAIN DISHES', 4),
(21, 'DRINKS', 4),
(22, 'STARTERS', 5),
(23, 'MAIN DISHES', 5),
(24, 'DESERTS', 5),
(25, 'DRINKS', 5),
(26, 'STARTERS', 6),
(27, 'MAIN DISHES', 6),
(28, 'DESERTS', 6),
(29, 'DESERTS', 6),
(30, 'DESERTS', 6),
(31, 'DESERTS', 6),
(32, 'DESERTS', 6),
(33, 'DESERTS', 6),
(34, 'DRINKS', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles_restaurante`
--

CREATE TABLE `detalles_restaurante` (
  `id` int(11) NOT NULL,
  `restaurantes_id` int(11) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `precio` varchar(50) DEFAULT NULL,
  `calificacion` decimal(2,1) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalles_restaurante`
--

INSERT INTO `detalles_restaurante` (`id`, `restaurantes_id`, `direccion`, `precio`, `calificacion`, `url`, `descripcion`) VALUES
(1, 1, 'Dirección A', '$$$', 5.0, '../restaurante1/index.php', 'Informacion sobre el restaurante '),
(2, 2, 'Dirección B', '$$$', 4.5, '../restaurante2/index.php', 'lorem ipsum'),
(3, 3, 'Dirección C', '$$$', 4.0, '../restaurante3/index.php', '    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic, at ab, asperiores commodi dolores culpa soluta et sequi ad nesciunt dicta placeat, incidunt quasi fuga laboriosam facilis repellendus quod. Aliquid?\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic, at ab, asperiores commodi dolores culpa soluta et sequi ad nesciunt dicta placeat, incidunt quasi fuga laboriosam facilis repellendus quod. Aliquid?\n    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic, at ab, asperiores commodi dolores culpa soluta et sequi ad nesciunt dicta placeat, incidunt quasi fuga laboriosam facilis repellendus quod. Aliquid?\nLorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium facere debitis quo accusamus dolorem ea culpa quisquam. Quo fuga enim, quia nemo, reprehenderit voluptates adipisci in eum, voluptas eligendi vitae.\nLorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium facere debitis quo accusamus dolorem ea culpa quisquam. Quo fuga enim, quia nemo, reprehenderit voluptates adipisci in eum, voluptas eligendi vi'),
(4, 4, 'Dirección A', '$$$', 3.5, '../restaurante4/index.php', 'Lorem ipsum dolor sit amet consectetur adipisi'),
(5, 5, 'Dirección B', '$$$', 3.0, '../restaurante5/index.php', 'Lorem ip'),
(6, 6, 'Dirección C', '$$$', 2.5, '../restaurante6/index.php', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium facere debitis quo accusamus dolorem ea culpa quisquam.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galeria`
--

CREATE TABLE `galeria` (
  `id` int(11) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `restaurantes_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `galeria`
--

INSERT INTO `galeria` (`id`, `imagen`, `descripcion`, `restaurantes_id`) VALUES
(1, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 1),
(2, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 1),
(3, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 1),
(4, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 1),
(5, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 1),
(6, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 1),
(7, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 1),
(8, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 1),
(9, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 1),
(10, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 1),
(11, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 2),
(12, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 2),
(13, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 2),
(14, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 2),
(15, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 2),
(16, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 2),
(17, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 2),
(18, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 2),
(19, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 2),
(20, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 2),
(21, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 3),
(22, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 3),
(23, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 3),
(24, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 3),
(25, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 3),
(26, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 3),
(27, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 3),
(28, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 3),
(29, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 3),
(30, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 3),
(31, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 4),
(32, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 4),
(33, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 4),
(34, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 4),
(35, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 4),
(36, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 4),
(37, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 4),
(38, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 4),
(39, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 4),
(40, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 4),
(41, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 5),
(42, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 5),
(43, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 5),
(44, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 5),
(45, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 5),
(46, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 5),
(47, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 5),
(48, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 5),
(49, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 5),
(50, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 5),
(51, 'images/gallery_01.jpg', 'This is the 1 one on my Gallery', 6),
(52, 'images/gallery_02.jpg', 'This is the 2 one on my Gallery', 6),
(53, 'images/gallery_03.jpg', 'This is the 3 one on my Gallery', 6),
(54, 'images/gallery_04.jpg', 'This is the 4 one on my Gallery', 6),
(55, 'images/gallery_05.jpg', 'This is the 5 one on my Gallery', 6),
(56, 'images/gallery_06.jpg', 'This is the 6 one on my Gallery', 6),
(57, 'images/gallery_07.jpg', 'This is the 7 one on my Gallery', 6),
(58, 'images/gallery_08.jpg', 'This is the 8 one on my Gallery', 6),
(59, 'images/gallery_09.jpg', 'This is the 9 one on my Gallery', 6),
(60, 'images/gallery_10.jpg', 'This is the 10 one on my Gallery', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items_menu`
--

CREATE TABLE `items_menu` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `items_menu`
--

INSERT INTO `items_menu` (`id`, `nombre`, `descripcion`, `precio`, `imagen`, `categoria_id`) VALUES
(1, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 1),
(2, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 1),
(3, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 1),
(4, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 2),
(5, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 2),
(6, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 3),
(7, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 4),
(15, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 5),
(16, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 5),
(17, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 6),
(18, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 6),
(19, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 7),
(20, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 8),
(21, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 8),
(22, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 14),
(23, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 15),
(24, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 16),
(25, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 17),
(26, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 18),
(27, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 18),
(28, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 17),
(29, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 19),
(30, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 19),
(31, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 19),
(32, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 20),
(33, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 20),
(34, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 21),
(35, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 21),
(36, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 22),
(37, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 23),
(38, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 23),
(39, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 23),
(40, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 23),
(41, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 24),
(42, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 25),
(43, 'GARLIC BREAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 8.50, 'images/menu-item-thumbnail-01.jpg', 26),
(44, 'MIXED SALAD', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 25.00, 'images/menu-item-thumbnail-02.jpg', 27),
(45, 'BBQ CHICKEN WINGS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 10.00, 'images/menu-item-thumbnail-03.jpg', 28),
(46, 'MEAT FEAST PIZZA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 5.00, 'images/menu-item-thumbnail-04.jpg', 29),
(47, 'CHICKEN TIKKA MASALA', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 15.00, 'images/menu-item-thumbnail-05.jpg', 29),
(48, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 30),
(49, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 31),
(50, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 32),
(51, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 33),
(52, 'SPICY MEATBALLS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 6.50, 'images/menu-item-thumbnail-06.jpg', 34),
(53, 'CHOCOLATE FUDGECAKE', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc mollis eleifend dapibus.', 4.50, 'images/menu-item-thumbnail-07.jpg', 34);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `platillos_del_dia`
--

CREATE TABLE `platillos_del_dia` (
  `id` int(11) NOT NULL,
  `restaurantes_id` int(11) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `imagen_url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `platillos_del_dia`
--

INSERT INTO `platillos_del_dia` (`id`, `restaurantes_id`, `nombre`, `descripcion`, `imagen_url`) VALUES
(1, 1, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(2, 1, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(3, 1, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(4, 1, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(5, 1, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(6, 2, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(7, 2, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(8, 2, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(9, 2, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(10, 2, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(11, 3, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(12, 3, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(13, 3, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(14, 3, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(15, 3, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(16, 2, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(17, 2, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(18, 2, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(19, 2, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(20, 2, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(21, 3, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(22, 3, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(23, 3, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(24, 3, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(25, 3, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(26, 4, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(27, 4, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(28, 4, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(29, 4, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(30, 4, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(31, 5, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(32, 5, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(33, 5, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(34, 5, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(35, 5, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(36, 6, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(37, 6, 'ITALIAN PIZZA', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg'),
(38, 6, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-3.jpg'),
(39, 6, 'SALMON STEAK', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-1.jpg'),
(40, 6, 'VEG. ROLL', 'Lorem ipsum dolor sit amet, consectetur adip aliqua. Ut enim ad minim venia.', 'special-menu-2.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservaciones`
--

CREATE TABLE `reservaciones` (
  `id` int(11) NOT NULL,
  `restaurantes_id` int(11) DEFAULT NULL,
  `usuarios_id` int(11) DEFAULT NULL,
  `fecha_reserva` date DEFAULT NULL,
  `hora_reserva` time DEFAULT NULL,
  `numero_personas` int(11) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `estado` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reservaciones`
--

INSERT INTO `reservaciones` (`id`, `restaurantes_id`, `usuarios_id`, `fecha_reserva`, `hora_reserva`, `numero_personas`, `observaciones`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2024-07-14', '19:15:00', 6, 'Comida preferida: Colombian, Ocasión: Normal', 'Pendiente', '2024-07-14 03:11:45', '2024-07-14 03:11:45'),
(2, 2, 1, '2024-07-31', '15:00:00', 2, 'Comida preferida: Indian, Ocasión: Wedding', 'Pendiente', '2024-07-23 01:53:58', '2024-07-23 01:53:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen_url` varchar(255) NOT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `lat` float DEFAULT NULL,
  `lon` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`id`, `nombre`, `imagen_url`, `facebook_url`, `twitter_url`, `instagram_url`, `lat`, `lon`) VALUES
(1, 'Nombre del Restaurante', 'images/restaurante.jpg', 'https://facebook.com/restaurante', 'https://twitter.com/restaurante', 'https://instagram.com/restaurante', 5.68382, -76.6582),
(2, 'Nombre del Restaurante1', 'images/restaurante1.jpg', 'https://facebook.com/restaurante1', 'https://twitter.com/restaurante1', 'https://instagram.com/restaurante1', 5.68676, -76.6519),
(3, 'Nombre del Restaurante2', 'images/restaurante2.jpg', 'https://facebook.com/restaurante2', 'https://twitter.com/restaurante2', 'https://instagram.com/restaurante2', 5.69023, -76.655),
(4, 'Nombre del Restaurante3', 'images/restaurante3.jpg', 'https://facebook.com/restaurante', 'https://twitter.com/restaurante', 'https://instagram.com/restaurante', 5.68976, -76.6584),
(5, 'Nombre del Restaurante4', 'images/restaurante4.jpg', 'https://facebook.com/restaurante1', 'https://twitter.com/restaurante1', 'https://instagram.com/restaurante1', 5.69148, -76.6577),
(6, 'Nombre del Restaurante5', 'images/restaurante5.jpg', 'https://facebook.com/restaurante2', 'https://twitter.com/restaurante2', 'https://instagram.com/restaurante2', 5.6962, -76.6606);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `direccion` varchar(20) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `fecha` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `direccion`, `telefono`, `contraseña`, `fecha`) VALUES
(1, 'Linda', 'linda@gmail.com', 'cra 19 n 0-92', '3137852373', '$2y$10$FTMtG1E0EDXFkCmpPyhGoeEVOK6PQZdUAMsOfzVMzyqGw0bHkh0HG', '10/07/24'),
(2, 'Gustavo', 'gus434@gmail.com', 'cra 19 n 0-92', '3137852373', '$2y$10$n9YZ5jbxYBQWxtQKZ9TgMuA27PYucnOfijUVt5yvdBKpktdFIO3eK', '11/07/24'),
(3, 'Gus', 'gustavo@gmail.com', 'cra 19 n 0-92', '3137852373', '$2y$10$7kBAL8W.RAdtK2lBqV4lEOnFZcQen30t3A5/FJVpA3fpoAmFOmMD.', '13/07/24'),
(4, 'Samuel', 'samuel@gmail.com', 'cra 19 n 0-92', '3137852373', '$2y$10$v7f.zVNiOCkCMCQzJ2kUeeOgCy5hap5wtbiZ3h5yDDZc.hjugofbS', '13/07/24');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias_menu`
--
ALTER TABLE `categorias_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantes_id` (`restaurantes_id`);

--
-- Indices de la tabla `detalles_restaurante`
--
ALTER TABLE `detalles_restaurante`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantes_id` (`restaurantes_id`);

--
-- Indices de la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantes_id` (`restaurantes_id`);

--
-- Indices de la tabla `items_menu`
--
ALTER TABLE `items_menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `platillos_del_dia`
--
ALTER TABLE `platillos_del_dia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `restaurantes_id` (`restaurantes_id`);

--
-- Indices de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias_menu`
--
ALTER TABLE `categorias_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `detalles_restaurante`
--
ALTER TABLE `detalles_restaurante`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `galeria`
--
ALTER TABLE `galeria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT de la tabla `items_menu`
--
ALTER TABLE `items_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de la tabla `platillos_del_dia`
--
ALTER TABLE `platillos_del_dia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `reservaciones`
--
ALTER TABLE `reservaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `categorias_menu`
--
ALTER TABLE `categorias_menu`
  ADD CONSTRAINT `categorias_menu_ibfk_1` FOREIGN KEY (`restaurantes_id`) REFERENCES `restaurantes` (`id`);

--
-- Filtros para la tabla `detalles_restaurante`
--
ALTER TABLE `detalles_restaurante`
  ADD CONSTRAINT `detalles_restaurante_ibfk_1` FOREIGN KEY (`restaurantes_id`) REFERENCES `restaurantes` (`id`);

--
-- Filtros para la tabla `galeria`
--
ALTER TABLE `galeria`
  ADD CONSTRAINT `galeria_ibfk_1` FOREIGN KEY (`restaurantes_id`) REFERENCES `restaurantes` (`id`);

--
-- Filtros para la tabla `items_menu`
--
ALTER TABLE `items_menu`
  ADD CONSTRAINT `items_menu_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_menu` (`id`);

--
-- Filtros para la tabla `platillos_del_dia`
--
ALTER TABLE `platillos_del_dia`
  ADD CONSTRAINT `platillos_del_dia_ibfk_1` FOREIGN KEY (`restaurantes_id`) REFERENCES `restaurantes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
