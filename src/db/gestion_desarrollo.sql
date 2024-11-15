-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2024 a las 17:51:05
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_desarrollo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registros`
--

CREATE TABLE `registros` (
  `id` int(11) NOT NULL,
  `nombre_y_apellido` varchar(255) NOT NULL,
  `tipo_de_proyecto` varchar(255) NOT NULL,
  `descripcion_de_lo_realizado` text NOT NULL,
  `horas_diarias_realizadas` time NOT NULL,
  `fecha_actual` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `registros`
--

INSERT INTO `registros` (`id`, `nombre_y_apellido`, `tipo_de_proyecto`, `descripcion_de_lo_realizado`, `horas_diarias_realizadas`, `fecha_actual`) VALUES
(18, 'Mauro_Ortiz_Davalos', 'Asesoramientos', 'xdd', '00:00:06', '2024-11-11'),
(19, 'Juan_Manuel_Messina', 'Proyecto_de_Mejora', 'awdasdw', '00:00:04', '2024-11-12'),
(20, 'Matias_Ezequiel', 'Proyecto_de_Mejora', 'wadsdw', '00:00:05', '2024-11-12'),
(21, 'Maximo Giron', 'Desarrollo_de_Producto', 'wadsdw', '00:00:07', '2024-11-12'),
(22, 'uwu', 'XD', 'wdasdw', '00:00:03', '2024-11-14'),
(23, 'uwu', 'XD', 'wadasdw', '00:00:03', '2024-11-14'),
(24, 'uwu', 'XD', 'wdadswdasdwdasd', '00:00:02', '2024-11-14'),
(25, 'uwu', 'XD', 'weasdwadas', '00:00:02', '2024-11-14'),
(26, 'uwu', 'Pagina_local_DMD', 'wdasdwdasd', '00:00:03', '2024-11-14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('supervisor','operador') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `role`) VALUES
(1, 'maximo', '$2y$10$ox1uO2dp9zPlulC2bi/6sObmTVRb780xO9.hsZ/G0paZFD.dEZI.C', 'supervisor'),
(3, 'liandro', '$2y$10$dH8tFJs6Cxe3wDKuEpNXKeotw.4MPBR03hKATWN6A0/JGsCd/esuq', 'supervisor'),
(4, 'nico', '$2y$10$7r4O/hvRSKpi5T9vVeMGm./9QVLSgCvd2PQLRXWfT5.wwTIqOAKhO', 'operador'),
(5, 'xd', '$2y$10$VGtleQhsrCSWCI5iCsWlVeHwHNVJBJgjxZmjoAz3wYAQCY0i2P/i6', 'operador');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `registros`
--
ALTER TABLE `registros`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `registros`
--
ALTER TABLE `registros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
