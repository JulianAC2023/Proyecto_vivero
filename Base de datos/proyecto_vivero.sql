-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2024 a las 04:32:09
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
-- Base de datos: `proyecto_vivero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_categorias`
--

CREATE TABLE `viv_categorias` (
  `CategoriaID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_categorias`
--

INSERT INTO `viv_categorias` (`CategoriaID`, `Nombre`, `Descripcion`) VALUES
(1, 'Plantas', 'Todo tipo de plantas para jardín y hogar'),
(2, 'Herramientas', 'Herramientas y equipos para jardinería'),
(3, 'Abonos', 'Abonos y fertilizantes para plantas'),
(4, 'Semillas', 'Semillas para cultivo de diferentes plantas'),
(5, 'Accesorios', 'Todo tipo de accesorios para plantas y jardines');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_comentarios`
--

CREATE TABLE `viv_comentarios` (
  `ComentarioID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `Comentario` text NOT NULL,
  `Calificacion` int(11) DEFAULT NULL CHECK (`Calificacion` between 1 and 5),
  `FechaComentario` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_inventario`
--

CREATE TABLE `viv_inventario` (
  `InventarioID` int(11) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `Fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `TipoMovimiento` enum('Entrada','Salida') NOT NULL,
  `Cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_inventario`
--

INSERT INTO `viv_inventario` (`InventarioID`, `ProductoID`, `Fecha`, `TipoMovimiento`, `Cantidad`) VALUES
(1, 1, '2024-08-14 05:19:06', 'Entrada', 50),
(2, 2, '2024-08-14 05:19:06', 'Entrada', 20),
(3, 3, '2024-08-14 05:19:06', 'Entrada', 30),
(4, 4, '2024-08-14 05:19:06', 'Entrada', 100),
(5, 5, '2024-08-14 05:19:06', 'Entrada', 25),
(6, 6, '2024-08-14 05:19:06', 'Entrada', 15),
(7, 7, '2024-08-14 05:19:06', 'Entrada', 10),
(8, 8, '2024-08-14 05:19:06', 'Entrada', 8),
(9, 9, '2024-08-14 05:19:06', 'Entrada', 12),
(10, 10, '2024-08-14 05:19:06', 'Entrada', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_pagos`
--

CREATE TABLE `viv_pagos` (
  `PagoID` int(11) NOT NULL,
  `PedidoID` int(11) NOT NULL,
  `Monto` decimal(10,2) NOT NULL,
  `FechaPago` timestamp NOT NULL DEFAULT current_timestamp(),
  `MetodoPago` enum('Efectivo','Tarjeta de Crédito','Transferencia','Otro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_pedidos`
--

CREATE TABLE `viv_pedidos` (
  `PedidoID` int(11) NOT NULL,
  `UsuarioID` int(11) NOT NULL,
  `ProductoID` int(11) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `FechaPedido` timestamp NOT NULL DEFAULT current_timestamp(),
  `Total` decimal(10,2) NOT NULL,
  `Estado` enum('Pendiente','Enviado','Entregado','Cancelado') DEFAULT 'Pendiente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_pedidos`
--

INSERT INTO `viv_pedidos` (`PedidoID`, `UsuarioID`, `ProductoID`, `Cantidad`, `FechaPedido`, `Total`, `Estado`) VALUES
(1, 1, 1, 5, '2024-08-14 05:00:11', 45000.00, 'Pendiente'),
(2, 1, 2, 2, '2024-08-14 05:00:11', 30000.00, 'Enviado'),
(3, 1, 3, 1, '2024-08-14 05:00:11', 12500.00, 'Pendiente'),
(4, 1, 4, 4, '2024-08-14 05:00:11', 24000.00, 'Pendiente'),
(6, 1, 1, 5, '2024-08-14 05:02:19', 75000.00, 'Pendiente'),
(7, 1, 2, 2, '2024-08-14 05:02:19', 50000.00, 'Pendiente'),
(8, 1, 3, 1, '2024-08-14 05:02:19', 10000.00, 'Pendiente'),
(9, 1, 4, 4, '2024-08-14 05:02:19', 20000.00, 'Pendiente'),
(10, 1, 5, 3, '2024-08-14 05:02:19', 24000.00, 'Pendiente'),
(11, 1, 6, 10, '2024-08-14 05:02:19', 120000.00, 'Pendiente'),
(12, 1, 7, 6, '2024-08-14 05:02:19', 120000.00, 'Pendiente'),
(13, 1, 8, 7, '2024-08-14 05:02:19', 245000.00, 'Pendiente'),
(14, 1, 9, 8, '2024-08-14 05:02:19', 120000.00, 'Pendiente'),
(15, 1, 10, 1, '2024-08-14 05:02:20', 45000.00, 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_perfilesusuario`
--

CREATE TABLE `viv_perfilesusuario` (
  `UsuarioID` int(11) NOT NULL,
  `NombreUsuario` varchar(50) NOT NULL,
  `NombreCompleto` varchar(100) DEFAULT NULL,
  `CorreoElectronico` varchar(100) NOT NULL,
  `Direccion` varchar(50) NOT NULL,
  `Telefono` int(11) NOT NULL,
  `ContrasenaHash` char(64) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `FechaUltimoAcceso` timestamp NULL DEFAULT NULL,
  `Rol` enum('admin','usuario','invitado') DEFAULT 'usuario',
  `Activo` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_perfilesusuario`
--

INSERT INTO `viv_perfilesusuario` (`UsuarioID`, `NombreUsuario`, `NombreCompleto`, `CorreoElectronico`, `Direccion`, `Telefono`, `ContrasenaHash`, `FechaRegistro`, `FechaUltimoAcceso`, `Rol`, `Activo`) VALUES
(1, 'admin', 'Administrador', 'admin@ejemplo.com', '', 0, '$2y$10$xm4UblYcK0yIXWdqdCHQ.OHOm7heeQcCLX3I97cbmZLA9pC6j0s/W', '2024-08-14 03:59:16', NULL, 'admin', 1),
(19, 'Julian_ Andres', 'Julian Andres Cardona Londoño', 'cont.julian@gmail.com', 'Cll 105a # 23- 59', 0, '$2y$10$xm4UblYcK0yIXWdqdCHQ.OHOm7heeQcCLX3I97cbmZLA9pC6j0s/W', '2024-08-24 22:19:04', NULL, 'usuario', 1),
(20, 'pruebas', 'pruebas1', 'pruebas@pruebas.com', 'Cll 105a # 23- 59', 0, '$2y$10$TpCaiHSz6yaEkNmGY9.Xq.VnFbxBbUz3xDz5jG11vaLobjDURdt5i', '2024-08-24 23:28:32', NULL, 'usuario', 1),
(22, 'copes', 'Camilo Gonzalez', 'gonzales@prueba.com', 'Cll63B # 105 A 57', 0, '$2y$10$Y6emYwx59CbAHpTrZ.rcX.sHwuKnpBexT0NYOe22OIq.5BcvaHlnu', '2024-08-25 03:46:09', NULL, 'usuario', 1),
(23, 'maurotroll', 'Mauricio Osorio', 'mauro@pruebas.com', 'Enrique segoviano', 0, '$2y$10$FRomO1UjBcGoR4gjtzNFbuDXEmcD898xw7dttvYbnbvxi03KoPGwi', '2024-08-27 01:11:09', NULL, 'usuario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_productos`
--

CREATE TABLE `viv_productos` (
  `ProductoID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `CantidadDisponible` int(11) NOT NULL,
  `FechaRegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `CategoriaID` int(11) DEFAULT NULL,
  `ProveedorID` int(11) DEFAULT NULL,
  `URL_Imagen` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_productos`
--

INSERT INTO `viv_productos` (`ProductoID`, `Nombre`, `Descripcion`, `Valor`, `CantidadDisponible`, `FechaRegistro`, `CategoriaID`, `ProveedorID`, `URL_Imagen`) VALUES
(1, 'Girasol', 'Los girasoles son flores que irradian vitalidad y alegría con sus brillantes pétalos dorados que siguen el movimiento del sol.', 37000.00, 10, '2024-08-14 04:16:22', 1, NULL, 'Girasol.jpg'),
(2, 'Clavel', 'Los claveles son flores que destacan por su elegancia y gracia. Con una amplia gama de colores y variedades, cada clavel es una expresión de belleza cultivada con cuidado y atención al detalle.', 18500.00, 15, '2024-08-14 04:16:22', 1, NULL, 'Clavel.jpg'),
(3, 'Bonsai', 'Los bonsáis son árboles cultivados en macetas que representan la belleza y la armonía de la naturaleza en miniatura. Cada bonsái es una expresión única de cuidado y paciencia, capturando la majestuosidad de árboles más grandes en un espacio reducido.', 74000.00, 5, '2024-08-14 04:16:22', 1, NULL, 'Bonsai.jpg'),
(4, 'Anturio', 'El anturio es una planta exótica conocida por sus llamativas inflorescencias y brillantes hojas. Originario de las selvas tropicales, el anturio agrega un toque de sofisticación a cualquier entorno. Cultivado con esmero, cada anturio es una obra de arte viviente lista para embellecer tu hogar con su singular belleza.', 55500.00, 8, '2024-08-14 04:16:22', 1, NULL, 'Anturio.jpg'),
(5, 'Rosas', 'Belleza y elegancia en una flor, ideal para expresar sentimientos profundos o añadir un toque clásico al jardín.', 18500.00, 20, '2024-08-14 05:02:07', 1, NULL, 'Rosas.jpg'),
(6, 'Orquidea', 'Exótica y sofisticada, la orquídea aporta un toque de lujo y color vibrante a cualquier espacio, ideal para ocasiones especiales.', 35000.00, 12, '2024-08-14 05:02:07', 1, NULL, 'Orquidea.jpg'),
(7, 'Etiqueta plastica', 'Información esencial para identificar y cuidar tus plantas con precisión.', 5000.00, 20, '2024-08-14 05:02:07', 5, NULL, 'Etiqueta plastica.jpg'),
(8, 'Dispensador de cemillas', 'Facilita la siembra ordenada y precisa de semillas, optimizando el proceso de cultivo y garantizando un crecimiento saludable de las plantas.', 8000.00, 15, '2024-08-14 05:02:07', 5, NULL, 'Dispensador cemillas.jpg'),
(9, 'Regadera plastica', 'Herramienta ligera y resistente, ideal para el riego de plantas en interiores y exteriores. Su diseño ergonómico facilita el manejo y distribución del agua de manera eficiente.', 12000.00, 12, '2024-08-14 05:02:07', 5, NULL, 'Regadera plastica.jpg'),
(10, 'Pistola de riego', 'Herramienta esencial para el riego de plantas, ofrece control y precisión en la aplicación del agua.', 14000.00, 8, '2024-08-14 05:02:07', 5, NULL, 'Pistola de riego.jpg'),
(11, 'Kit riego de goteo', 'Solución completa y eficiente para mantener tus plantas hidratadas con precisión y bajo consumo de agua.', 25000.00, 6, '2024-08-14 05:17:30', 5, NULL, 'Kit riego.jpg'),
(12, 'Guantes', 'Protege tus manos mientras trabajas en el jardín con comodidad y durabilidad.', 12000.00, 25, '2024-08-14 05:17:30', 5, NULL, 'Guantes.jpg'),
(13, 'Delantal de jardinería', 'Mantén tu ropa limpia y protegida mientras trabajas en el jardín con este práctico delantal resistente.', 20000.00, 10, '2024-08-14 05:17:30', 5, NULL, 'Delantal.jpg'),
(14, 'Maceta barro #16', 'Ideal para tus plantas favoritas, esta maceta de barro de tamaño #16 ofrece un ambiente saludable y natural para el crecimiento óptimo de tus plantas.', 12000.00, 18, '2024-08-14 05:17:30', 5, NULL, 'Maceta 14.jpg'),
(15, 'Maceta barro #14', 'Perfecta para plantas de tamaño mediano, esta maceta de barro #14 proporciona un entorno acogedor y saludable para el desarrollo óptimo de tus plantas en interiores o exteriores.', 6000.00, 22, '2024-08-14 05:17:30', 5, NULL, 'Maceta 14.jpg'),
(16, 'Maceta barro #12', 'Ideal para plantas más pequeñas, esta maceta de barro #12 es perfecta para cultivar tus plantas favoritas en espacios reducidos o para dar un toque de naturaleza a tu hogar con elegancia y estilo.', 3000.00, 30, '2024-08-14 05:17:30', 5, NULL, 'Maceta 12.jpg'),
(17, 'Clip gancho de amarre de plantas', 'Conveniente y versátil, este clip gancho de amarre es la solución perfecta para mantener tus plantas seguras y bien sujetas. Su diseño resistente y fácil de usar te permite cuidar tus plantas de manera efectiva mientras mantienes un ambiente ordenado y organizado en tu jardín o espacio interior.', 10000.00, 14, '2024-08-14 05:17:30', 5, NULL, 'Clip.jpg'),
(18, 'Termómetro Higrómetro Digital', 'Termómetro higrómetro digital que mide tanto la temperatura como la humedad del ambiente, ideal para mantener las condiciones óptimas para el crecimiento de tus plantas. Su pantalla LCD fácil de leer y su diseño compacto permiten un uso práctico y eficiente.', 15000.00, 8, '2024-08-14 05:17:30', 5, NULL, 'Higometro.jpg'),
(19, 'Fertilizante triple 15', 'El fertilizante triple 15 proporciona nutrientes vitales en una proporción equilibrada para un crecimiento vigoroso de tus plantas.', 10000.00, 10, '2024-08-14 05:17:30', 3, NULL, 'Triple 15.jpg'),
(20, 'Tierra abonada', 'La tierra abonada es un sustrato enriquecido con nutrientes esenciales para promover un crecimiento saludable de las plantas.', 12000.00, 15, '2024-08-14 05:17:30', 3, NULL, 'Tierra abonada.jpg'),
(21, 'Fertox insecticida', 'Fertox es un insecticida efectivo para combatir una amplia variedad de plagas en plantas, garantizando un ambiente saludable para su crecimiento.', 8000.00, 12, '2024-09-12 21:44:41', 3, NULL, 'Fertox.jpg'),
(22, 'Sustrato especial orquídeas', 'El sustrato especial para orquídeas proporciona el ambiente ideal para el crecimiento y desarrollo óptimo de estas plantas, ofreciendo una combinación equilibrada de nutrientes y una excelente capacidad de drenaje.', 15000.00, 8, '2024-09-12 21:44:41', 3, NULL, 'Sustrato.jpg'),
(23, 'Nutriente Líquido Universal', 'Nutriente líquido universal ideal para todo tipo de plantas. Proporciona un equilibrio perfecto de nutrientes esenciales que ayudan al desarrollo óptimo y la floración vigorosa.', 18000.00, 6, '2024-09-12 21:44:41', 3, NULL, 'Nutriente universal.png'),
(24, 'Abono Orgánico en Granulado', 'Abono orgánico en granulado ideal para enriquecer el suelo con nutrientes naturales. Favorece el crecimiento de las plantas y mejora la estructura del suelo.', 15000.00, 5, '2024-09-12 21:44:41', 3, NULL, 'Abono granulado.jpg'),
(25, 'Snapdragon', 'Flor perenne que se asemeja a un dragón, conocida por sus colores vibrantes y su forma peculiar.', 32500.00, 20, '2024-09-12 21:47:12', 4, NULL, 'Snapdragon.jpg'),
(26, 'Lavanda', 'Planta aromática con flores púrpuras, apreciada por su fragancia relajante y propiedades medicinales.', 32500.00, 18, '2024-09-12 21:47:12', 4, NULL, 'Lavanda.jpg'),
(27, 'Girasol Azul', 'Girasoles de color azul vibrante, una rareza en la naturaleza que añade un toque único a tu jardín.', 35000.00, 5, '2024-09-12 21:47:13', 4, NULL, 'Girasol azul.jpg'),
(28, 'Girasol Amarillo', 'Girasoles de tonos dorados y amarillos brillantes, símbolos de alegría y vitalidad.', 20000.00, 12, '2024-09-12 21:47:13', 4, NULL, 'Girasol amarillo.jpg'),
(29, 'Cartuchos', 'Flores en forma de embudo con colores brillantes que añaden un toque de exotismo a tu jardín.', 18000.00, 8, '2024-09-12 21:47:13', 4, NULL, 'Cartuchos.jpg'),
(30, 'Rosas', 'Rosas clásicas en una variedad de colores, que representan el amor, la pasión y la elegancia.', 22000.00, 15, '2024-09-12 21:47:13', 4, NULL, 'Rosa.jpg'),
(31, 'Passiflora', 'Planta trepadora con flores exóticas, conocida por sus propiedades medicinales y ornamentalidad.', 28000.00, 10, '2024-09-12 21:47:13', 4, NULL, 'Passiflora.jpg'),
(32, 'Amarilis', 'Planta bulbosa con flores grandes y vistosas en una variedad de colores, ideal para jardinería y decoración.', 40000.00, 7, '2024-09-12 21:47:13', 4, NULL, 'Amarilis.jpg'),
(33, 'Botas', 'Botas resistentes y duraderas para proteger tus pies mientras trabajas en el jardín.', 50000.00, 30, '2024-09-12 21:54:09', 2, NULL, 'Botas.jpg'),
(34, 'Pala', 'Herramienta esencial para cavar y trasladar tierra, ideal para labores de jardinería y construcción.', 35000.00, 25, '2024-09-12 21:54:09', 2, NULL, 'Pala.jpg'),
(35, 'Llana', 'Instrumento para sembrar tus más hermosas flores pequeñas en macetas o superficies pequeñas.', 20000.00, 15, '2024-09-12 21:54:09', 2, NULL, 'Llana.jpg'),
(36, 'Tijeras', 'Tijeras de podar afiladas y resistentes para recortar plantas y arbustos con precisión.', 25000.00, 20, '2024-09-12 21:54:09', 2, NULL, 'Tijeras.jpg'),
(37, 'Sopla Hojas', 'Herramienta eléctrica para limpiar hojas y residuos de jardines y patios de manera rápida y eficiente.', 80000.00, 10, '2024-09-12 21:54:09', 2, NULL, 'Sopla hojas.jpg'),
(38, 'Azada', 'Herramienta manual para cavar, romper terrones y remover la tierra en labores de jardinería y agricultura.', 30000.00, 22, '2024-09-12 21:54:09', 2, NULL, 'Azada.jpg'),
(39, 'Podadora', 'Herramienta eléctrica para cortar y dar forma a setos, arbustos y bordes de césped con precisión.', 120000.00, 8, '2024-09-12 21:54:09', 2, NULL, 'Podadora.jpg'),
(40, 'Rastrillo', 'Herramienta manual para recoger hojas, esparcir tierra y nivelar superficies en el jardín.', 20000.00, 18, '2024-09-12 21:54:09', 2, NULL, 'Rastrillo.jpg'),
(41, 'Desbrozadora', 'Herramienta potente para cortar hierbas, malezas y arbustos en áreas grandes y difíciles de alcanzar.', 180000.00, 12, '2024-09-12 21:54:09', 2, NULL, 'Desbrozadora.jpg'),
(42, 'Tenedor de Jardinería', 'Tenedor de jardinería de acero con cuatro dientes, ideal para airear el suelo, remover malas hierbas y trabajar en áreas pequeñas del jardín. Su diseño robusto garantiza durabilidad y facilidad de uso.', 270000.00, 5, '2024-09-12 21:54:09', 2, NULL, 'Tenedor.jpg'),
(43, 'Cubo de Jardinería', 'Cubo de jardinería de plástico resistente para transportar tierra, agua y otros materiales. Su diseño ergonómico y duradero es perfecto para diversas tareas en el jardín.', 30000.00, 20, '2024-09-12 21:54:09', 2, NULL, 'Cubo.jpg'),
(44, 'Set de herramientas en acero inoxidable', 'Juego de herramientas de jardinería de acero inoxidable, con pala, azada y garra. Ergonómicas y resistentes, ideales para preparar, plantar y mantener tu jardín con facilidad.', 80000.00, 15, '2024-09-12 21:54:09', 2, NULL, 'Set herramientas.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viv_proveedores`
--

CREATE TABLE `viv_proveedores` (
  `ProveedorID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Contacto` varchar(100) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Direccion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `viv_proveedores`
--

INSERT INTO `viv_proveedores` (`ProveedorID`, `Nombre`, `Contacto`, `Telefono`, `Email`, `Direccion`) VALUES
(1, 'Vivero Verde', 'Laura Fernández', '555-1234', 'contacto@viveroverde.com', 'Calle 123, Bogotá'),
(2, 'Jardines del Norte', 'Carlos Ramírez', '555-5678', 'info@jardinesdelnorte.com', 'Avenida 456, Medellín'),
(3, 'Abonos Naturales S.A.', 'Marta Pérez', '555-8765', 'ventas@abonosnaturales.com', 'Carrera 789, Cali'),
(4, 'Semillas y Más', 'Juan Gómez', '555-4321', 'atencion@semillasymas.com', 'Diagonal 101, Barranquilla');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `viv_categorias`
--
ALTER TABLE `viv_categorias`
  ADD PRIMARY KEY (`CategoriaID`);

--
-- Indices de la tabla `viv_comentarios`
--
ALTER TABLE `viv_comentarios`
  ADD PRIMARY KEY (`ComentarioID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `viv_inventario`
--
ALTER TABLE `viv_inventario`
  ADD PRIMARY KEY (`InventarioID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `viv_pagos`
--
ALTER TABLE `viv_pagos`
  ADD PRIMARY KEY (`PagoID`),
  ADD KEY `PedidoID` (`PedidoID`);

--
-- Indices de la tabla `viv_pedidos`
--
ALTER TABLE `viv_pedidos`
  ADD PRIMARY KEY (`PedidoID`),
  ADD KEY `UsuarioID` (`UsuarioID`),
  ADD KEY `ProductoID` (`ProductoID`);

--
-- Indices de la tabla `viv_perfilesusuario`
--
ALTER TABLE `viv_perfilesusuario`
  ADD PRIMARY KEY (`UsuarioID`),
  ADD UNIQUE KEY `NombreUsuario` (`NombreUsuario`),
  ADD UNIQUE KEY `CorreoElectronico` (`CorreoElectronico`);

--
-- Indices de la tabla `viv_productos`
--
ALTER TABLE `viv_productos`
  ADD PRIMARY KEY (`ProductoID`),
  ADD KEY `CategoriaID` (`CategoriaID`),
  ADD KEY `ProveedorID` (`ProveedorID`);

--
-- Indices de la tabla `viv_proveedores`
--
ALTER TABLE `viv_proveedores`
  ADD PRIMARY KEY (`ProveedorID`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `viv_categorias`
--
ALTER TABLE `viv_categorias`
  MODIFY `CategoriaID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viv_comentarios`
--
ALTER TABLE `viv_comentarios`
  MODIFY `ComentarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `viv_inventario`
--
ALTER TABLE `viv_inventario`
  MODIFY `InventarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `viv_pagos`
--
ALTER TABLE `viv_pagos`
  MODIFY `PagoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viv_pedidos`
--
ALTER TABLE `viv_pedidos`
  MODIFY `PedidoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `viv_perfilesusuario`
--
ALTER TABLE `viv_perfilesusuario`
  MODIFY `UsuarioID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `viv_productos`
--
ALTER TABLE `viv_productos`
  MODIFY `ProductoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `viv_proveedores`
--
ALTER TABLE `viv_proveedores`
  MODIFY `ProveedorID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `viv_comentarios`
--
ALTER TABLE `viv_comentarios`
  ADD CONSTRAINT `viv_comentarios_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `viv_perfilesusuario` (`UsuarioID`),
  ADD CONSTRAINT `viv_comentarios_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `viv_productos` (`ProductoID`);

--
-- Filtros para la tabla `viv_inventario`
--
ALTER TABLE `viv_inventario`
  ADD CONSTRAINT `viv_inventario_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `viv_productos` (`ProductoID`);

--
-- Filtros para la tabla `viv_pagos`
--
ALTER TABLE `viv_pagos`
  ADD CONSTRAINT `viv_pagos_ibfk_1` FOREIGN KEY (`PedidoID`) REFERENCES `viv_pedidos` (`PedidoID`);

--
-- Filtros para la tabla `viv_pedidos`
--
ALTER TABLE `viv_pedidos`
  ADD CONSTRAINT `viv_pedidos_ibfk_1` FOREIGN KEY (`UsuarioID`) REFERENCES `viv_perfilesusuario` (`UsuarioID`),
  ADD CONSTRAINT `viv_pedidos_ibfk_2` FOREIGN KEY (`ProductoID`) REFERENCES `viv_productos` (`ProductoID`);

--
-- Filtros para la tabla `viv_productos`
--
ALTER TABLE `viv_productos`
  ADD CONSTRAINT `viv_productos_ibfk_1` FOREIGN KEY (`CategoriaID`) REFERENCES `viv_categorias` (`CategoriaID`),
  ADD CONSTRAINT `viv_productos_ibfk_2` FOREIGN KEY (`ProveedorID`) REFERENCES `viv_proveedores` (`ProveedorID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
