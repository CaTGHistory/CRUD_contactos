-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-05-2025 a las 10:30:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agendausers`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contactos`
--

CREATE TABLE `contactos` (
  `Id` int(6) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellidop` varchar(40) NOT NULL,
  `apellidom` varchar(40) NOT NULL,
  `direccion` varchar(40) NOT NULL,
  `telefono` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `CveUser` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contactos`
--

INSERT INTO `contactos` (`Id`, `nombre`, `apellidop`, `apellidom`, `direccion`, `telefono`, `email`, `CveUser`) VALUES
(1, 'Pedrito', 'Magos', 'Pereira', 'San Juan Tululuto', '222 456 7898', 'magosm4gicos@magia.magico', 2),
(2, 'Alfonso', 'Gutierrez', 'Patrocinio', 'Granjas Granjeras', '555 555 5555', 'granjas4al4alcane@gob.gr', 3),
(3, 'Tulio', 'Cardenas', 'Lopez', 'Avenida Gringolandia', '444 123 2121', 'elemneta56folclore@gorogor.gor', 2),
(4, 'Fabricio', 'Guzman', 'Peniques', 'Calle Rovianda', '456 789 1235', 'yoto89kalel@mael.mail', 2),
(5, 'Aurelio', 'Foreman', 'Brocas', 'Hospital Psiquiatrico No.12', '111 111 1110', 'Foreman23Dr@doctor.med', 3),
(13, 'Marcos', 'Paletruska', 'Vakuvver', 'RUSSIA', '5656 522 525224', 'Russia3sgrande@russia.gob', 3),
(21, 'Pedro', '1', '1', '1', '1', '1', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `CveUser` int(6) NOT NULL,
  `Password` varchar(16) NOT NULL,
  `NameUser` varchar(40) NOT NULL,
  `TypeUser` int(1) NOT NULL COMMENT '1: administrador, 2:vistante/contactos propios'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`CveUser`, `Password`, `NameUser`, `TypeUser`) VALUES
(1, '12345678', 'Gorgory', 1),
(2, '12345678', 'Lluvia', 2),
(3, '12345678', 'Aristoteles', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `contactos_users_fk` (`CveUser`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`CveUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contactos`
--
ALTER TABLE `contactos`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `CveUser` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contactos`
--
ALTER TABLE `contactos`
  ADD CONSTRAINT `contactos_users_fk` FOREIGN KEY (`CveUser`) REFERENCES `users` (`CveUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
