-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2023 a las 00:04:35
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tablaphp`
--
CREATE DATABASE IF NOT EXISTS `tablaphp` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish2_ci;
USE `tablaphp`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE `menu` (
  `id_Opcion` int(11) NOT NULL,
  `optionName` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `permission` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `optionLevel` int(11) DEFAULT NULL,
  `metodos` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`id_Opcion`, `optionName`, `permission`, `optionLevel`, `metodos`, `orden`) VALUES
(1, 'Inicio', 'public', 0, NULL, 1),
(2, 'Mantenimiento', 'private', 0, NULL, 8),
(3, 'Usuarios', 'private', 2, 'getVista(\'Usuarios\',\'vistaFiltrosUsuarios\');', 10),
(4, 'Menu', 'private', 2, 'getVistaMenuFiltros()', 11);

--
-- Disparadores `menu`
--
DELIMITER $$
CREATE TRIGGER `onMenuInsertTrigger` AFTER INSERT ON `menu` FOR EACH ROW BEGIN
  INSERT INTO permisos(id_Opcion,num_Permiso, permiso)
  VALUES(NEW.id_Opcion,1,'consultar');
  INSERT INTO permisos(id_Opcion,num_Permiso, permiso)
  VALUES(NEW.id_Opcion,2,'crear');
  INSERT INTO permisos(id_Opcion,num_Permiso, permiso)
  VALUES(NEW.id_Opcion,3,'editar');
  INSERT INTO permisos(id_Opcion,num_Permiso, permiso)
  VALUES(NEW.id_Opcion,4,'eliminar');
  INSERT INTO permisos(id_Opcion,num_Permiso, permiso)
  VALUES(NEW.id_Opcion,5,'estado');
  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id_Permiso` int(11) NOT NULL,
  `id_Opcion` int(11) NOT NULL,
  `num_Permiso` int(2) NOT NULL,
  `permiso` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id_Permiso`, `id_Opcion`, `num_Permiso`, `permiso`) VALUES
(21, 1, 1, 'consultar'),
(22, 1, 2, 'crear'),
(23, 1, 3, 'editar'),
(24, 1, 4, 'eliminar'),
(25, 1, 5, 'estado'),
(26, 2, 1, 'consultar'),
(27, 2, 2, 'crear'),
(28, 2, 3, 'editar'),
(29, 2, 4, 'eliminar'),
(30, 2, 5, 'estado'),
(31, 3, 1, 'consultar'),
(32, 3, 2, 'crear'),
(33, 3, 3, 'editar'),
(34, 3, 4, 'eliminar'),
(35, 3, 5, 'estado'),
(36, 4, 1, 'consultar'),
(37, 4, 2, 'crear'),
(38, 4, 3, 'editar'),
(39, 4, 4, 'eliminar'),
(40, 4, 5, 'estado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisosrol`
--

CREATE TABLE `permisosrol` (
  `id_Permiso` int(11) NOT NULL,
  `id_Rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `permisosrol`
--

INSERT INTO `permisosrol` (`id_Permiso`, `id_Rol`) VALUES
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisosusuario`
--

CREATE TABLE `permisosusuario` (
  `id_Permiso` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_Rol` int(11) NOT NULL,
  `rol` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_Rol`, `rol`) VALUES
(1, 'Guest'),
(2, 'Administrator');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rolesusuario`
--

CREATE TABLE `rolesusuario` (
  `id_Rol` int(11) NOT NULL,
  `id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rolesusuario`
--

INSERT INTO `rolesusuario` (`id_Rol`, `id_Usuario`) VALUES
(2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_Usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_1` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido_2` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `sexo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha_Alta` date DEFAULT NULL,
  `mail` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `movil` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `login` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `activo` char(1) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_Usuario`, `nombre`, `apellido_1`, `apellido_2`, `sexo`, `fecha_Alta`, `mail`, `movil`, `login`, `pass`, `activo`) VALUES
(1, 'Marius', 'WALLLEEE', NULL, 'H', '2020-10-01', 'mariusbroza@gmail.com', '665098613', 'Blancas', '242aa1a97769109065e3b4df359bcfc9', 'S'),
(2, 'admin', 'adminn', 'ad', 'H', '2020-10-02', 'admin@2si2021.es', '976466590', 'admin', '202cb962ac59075b964b07152d234b70', 'S'),
(7, 'Maria', 'Fernandez', 'Castro', 'H', '0000-00-00', 'mfernandez@2si2021.es', '2342423', 'safdfa', 'e10adc3949ba59abbe56e057f20f883e', 'S'),
(8, 'Felipe', 'Smit', 'Fernandez', 'H', '2020-11-23', 'fsmit@2si2021.com', '976466599', 'fperez', 'e10adc3949ba59abbe56e057f20f883e', 'S'),
(103, 'Carine ', 'Schmitt', '', 'M', '2020-02-15', 'Schmitt@2si2021.es', '64103103', 'Schmitt', '202cb962ac59075b964b07152d234b70', 'S'),
(112, 'Jean', 'King', '', 'H', '2020-02-15', 'King@2si2021.es', '64112112', 'King', '202cb962ac59075b964b07152d234b70', 'S'),
(114, 'Peter', 'Ferguson', '', 'H', '2020-02-15', 'Ferguson@2si2021.es', '64114114', 'Ferguson', '202cb962ac59075b964b07152d234b70', 'S'),
(119, 'Janine ', 'Labrune', '', 'M', '2020-02-15', 'Labrune@2si2021.es', '64119119', 'Labrune', '202cb962ac59075b964b07152d234b70', 'S'),
(121, 'Jonas ', 'Bergulfsen', '', 'H', '2020-02-15', 'Bergulfsen@2si2021.es', '64121121', 'Bergulfsen', '202cb962ac59075b964b07152d234b70', 'S'),
(124, 'Susan', 'Nelson', '', 'H', '2020-02-15', 'Nelson@2si2021.es', '64124124', 'Nelson', '202cb962ac59075b964b07152d234b70', 'S'),
(125, 'Zbyszek ', 'Piestrzeniewicz', '', 'H', '2020-02-15', 'Piestrzeniewicz@2si2021.es', '64125125', 'Piestrzeniewicz', '202cb962ac59075b964b07152d234b70', 'N'),
(128, 'Roland', 'Keitel', '', 'H', '2020-02-15', 'Keitel@2si2021.es', '64128128', 'Keitel', '202cb962ac59075b964b07152d234b70', 'S'),
(129, 'Julie', 'Murphy', '', 'M', '2020-02-15', 'Murphy@2si2021.es', '64129129', 'Murphy', '202cb962ac59075b964b07152d234b70', 'S'),
(131, 'Kwai', 'Lee', '', 'H', '2020-02-15', 'Lee@2si2021.es', '64131131', 'Lee', '202cb962ac59075b964b07152d234b70', 'N'),
(141, 'Diego ', 'Freyre', '', 'H', '2020-02-15', 'Freyre@2si2021.es', '64141141', 'Freyre', '202cb962ac59075b964b07152d234b70', 'S'),
(144, 'Christina ', 'Berglund', '', 'M', '2020-02-15', 'Berglund@2si2021.es', '64144144', 'Berglund', '202cb962ac59075b964b07152d234b70', 'N'),
(145, 'Jytte ', 'Petersen', '', 'H', '2020-02-15', 'Petersen@2si2021.es', '64145145', 'Petersen', '202cb962ac59075b964b07152d234b70', 'S'),
(146, 'Mary ', 'Saveley', '', 'M', '2020-02-15', 'Saveley@2si2021.es', '64146146', 'Saveley', '202cb962ac59075b964b07152d234b70', 'S'),
(148, 'Eric', 'Natividad', '', 'H', '2020-02-15', 'Natividad@2si2021.es', '64148148', 'Natividad', '202cb962ac59075b964b07152d234b70', 'N'),
(151, 'Jeff', 'Young', '', 'H', '2020-02-15', 'Young@2si2021.es', '64151151', 'Young', '202cb962ac59075b964b07152d234b70', 'S'),
(157, 'Kelvin', 'Leong', '', 'H', '2020-02-15', 'Leong@2si2021.es', '64157157', 'Leong', '202cb962ac59075b964b07152d234b70', 'S'),
(161, 'Juri', 'Hashimoto', '', 'H', '2020-02-15', 'Hashimoto@2si2021.es', '64161161', 'Hashimoto', '202cb962ac59075b964b07152d234b70', 'S'),
(166, 'Wendy', 'Victorino', '', 'M', '2020-02-15', 'Victorino@2si2021.es', '64166166', 'Victorino', '202cb962ac59075b964b07152d234b70', 'S'),
(167, 'Veysel', 'Oeztan', '', 'H', '2020-02-15', 'Oeztan@2si2021.es', '64167167', 'Oeztan', '202cb962ac59075b964b07152d234b70', 'N'),
(168, 'Keith', 'Franco', '', 'H', '2020-02-15', 'Franco@2si2021.es', '64168168', 'Franco', '202cb962ac59075b964b07152d234b70', 'S'),
(169, 'Isabel ', 'de Castro', '', 'M', '2020-02-15', 'de Castro@2si2021.es', '64169169', 'de Castro', '202cb962ac59075b964b07152d234b70', 'S'),
(171, 'Martine ', 'Ranc', '', 'H', '2020-02-15', 'Ranc@2si2021.es', '64171171', 'Ranc', '202cb962ac59075b964b07152d234b70', 'S'),
(172, 'Marie', 'Bertrand', '', 'M', '2020-02-15', 'Bertrand@2si2021.es', '64172172', 'Bertrand', '202cb962ac59075b964b07152d234b70', 'N'),
(173, 'Jerry', 'Tseng', '', 'H', '2020-02-15', 'Tseng@2si2021.es', '64173173', 'Tseng', '202cb962ac59075b964b07152d234b70', 'N'),
(175, 'Julie', 'King2', '', 'M', '2020-02-15', 'King2@2si2021.es', '64175175', 'King2', '202cb962ac59075b964b07152d234b70', 'S'),
(177, 'Mory', 'Kentary', '', 'H', '2020-02-15', 'Kentary@2si2021.es', '64177177', 'Kentary', '202cb962ac59075b964b07152d234b70', 'S'),
(181, 'Michael', 'Frick', '', 'H', '2020-02-15', 'Frick4@2si2021.es', '64181181', 'Frick4', '202cb962ac59075b964b07152d234b70', 'S'),
(186, 'Matti', 'Karttunen', '', 'H', '2020-02-15', 'Karttunen@2si2021.es', '64186186', 'Karttunen', '202cb962ac59075b964b07152d234b70', 'S'),
(187, 'Rachel', 'Ashworth', '', 'M', '2020-02-15', 'Ashworth@2si2021.es', '64187187', 'Ashworth', '202cb962ac59075b964b07152d234b70', 'S'),
(189, 'Dean', 'Cassidy', '', 'H', '2020-02-15', 'Cassidy@2si2021.es', '64189189', 'Cassidy', '202cb962ac59075b964b07152d234b70', 'S'),
(198, 'Leslie', 'Taylor', '', 'M', '2020-02-15', 'Taylor@2si2021.es', '64198198', 'Taylor', '202cb962ac59075b964b07152d234b70', 'S'),
(201, 'Elizabeth', 'Devon', '', 'H', '2020-02-15', 'Devon@2si2021.es', '64201201', 'Devon', '202cb962ac59075b964b07152d234b70', 'S'),
(202, 'Yoshi ', 'Tamuri', '', 'H', '2020-02-15', 'Tamuri@2si2021.es', '64202202', 'Tamuri', '202cb962ac59075b964b07152d234b70', 'S'),
(204, 'Miguel', 'Barajas', '', 'H', '2020-02-15', 'Barajas@2si2021.es', '64204204', 'Barajas', '202cb962ac59075b964b07152d234b70', 'S'),
(205, 'Julie', 'Young', '', 'M', '2020-02-15', 'Young2@2si2021.es', '64205205', 'Young2', '202cb962ac59075b964b07152d234b70', 'S'),
(206, 'Brydey', 'Walker', '', 'H', '2020-02-15', 'Walker@2si2021.es', '64206206', 'Walker', '202cb962ac59075b964b07152d234b70', 'N'),
(209, 'Fréderique ', 'Citeaux', '', 'H', '2020-02-15', 'Citeaux@2si2021.es', '64209209', 'Citeaux', '202cb962ac59075b964b07152d234b70', 'S'),
(211, 'Mike', 'Gao', '', 'H', '2020-02-15', 'Gao@2si2021.es', '64211211', 'Gao', '202cb962ac59075b964b07152d234b70', 'S'),
(216, 'Eduardo ', 'Saavedra', '', 'H', '2020-02-15', 'Saavedra@2si2021.es', '64216216', 'Saavedra', '202cb962ac59075b964b07152d234b70', 'N'),
(219, 'Mary', 'Young', 'y', 'M', '2020-02-15', 'Young3@2si2021.es', '64219219', 'Young3', '202cb962ac59075b964b07152d234b70', 'S'),
(223, 'Horst ', 'Kloss', '', 'H', '2020-02-15', 'Kloss@2si2021.es', '64223223', 'Kloss', '202cb962ac59075b964b07152d234b70', 'N'),
(227, 'Palle', 'Ibsen', '', 'H', '2020-02-15', 'Ibsen@2si2021.es', '64227227', 'Ibsen', '202cb962ac59075b964b07152d234b70', 'S'),
(233, 'Jean ', 'Fresni?re', '', 'H', '2020-02-15', 'Fresni?re@2si2021.es', '64233233', 'Fresni?re', '202cb962ac59075b964b07152d234b70', 'S'),
(237, 'Alejandra ', 'Camino', '', 'M', '2020-02-15', 'Camino@2si2021.es', '64237237', 'Camino', '202cb962ac59075b964b07152d234b70', 'S'),
(239, 'Valarie', 'Thompson', '', 'M', '2020-02-15', 'Thompson2@2si2021.es', '64239239', 'Thompson2', '202cb962ac59075b964b07152d234b70', 'S'),
(240, 'Helen ', 'Bennett', '', 'M', '2020-02-15', 'Bennett@2si2021.es', '6424024067', 'Bennett', '202cb962ac59075b964b07152d234b70', 'S'),
(242, 'Annette ', 'Roulet', '', 'M', '2020-02-15', 'Roulet@2si2021.es', '64242242', 'Roulet', '202cb962ac59075b964b07152d234b70', 'S'),
(247, 'Renate ', 'Messner', '', 'H', '2020-02-15', 'Messner@2si2021.es', '64247247', 'Messner', '202cb962ac59075b964b07152d234b70', 'S'),
(249, 'Paolo ', 'Accorti', '', 'H', '2020-02-15', 'Accorti@2si2021.es', '642492497', 'accorti', '202cb962ac59075b964b07152d234b70', 'S'),
(250, 'Daniel', 'Da Silva', '', 'H', '2020-02-15', 'Da Silva@2si2021.es', '64250250', 'Da Silva', '202cb962ac59075b964b07152d234b70', 'S'),
(256, 'Daniel ', 'Tonini', '', 'H', '2020-02-15', 'Tonini@2si2021.es', '64256256', 'Tonini', '202cb962ac59075b964b07152d234b70', 'S'),
(259, 'Henriette ', 'Pfalzheim', '', 'H', '2020-02-15', 'Pfalzheim@2si2021.es', '64259259', 'Pfalzheim', '202cb962ac59075b964b07152d234b70', 'S'),
(260, 'Elizabeth ', 'Lincoln', '', 'M', '2020-02-15', 'Lincoln@2si2021.es', '64260260', 'Lincoln', '202cb962ac59075b964b07152d234b70', 'S'),
(273, 'Peter ', 'Franken', '', 'H', '2020-02-15', 'Franken@2si2021.es', '64273273', 'Franken', '202cb962ac59075b964b07152d234b70', 'S'),
(276, 'Anna', 'O\'Hara', '', 'M', '2020-02-15', 'O\'Hara@2si2021.es', '64276276', 'O\'Hara', '202cb962ac59075b964b07152d234b70', 'S'),
(278, 'Giovanni ', 'Rovelli', '', 'H', '2020-02-15', 'Rovelli@2si2021.es', '64278278', 'Rovelli', '202cb962ac59075b964b07152d234b70', 'S'),
(282, 'Adrian', 'Huxley', '', 'H', '2020-02-15', 'Huxley@2si2021.es', '64282282', 'Huxley', '202cb962ac59075b964b07152d234b70', 'S'),
(286, 'Marta', 'Hernandez', '', 'M', '2020-02-15', 'Hernandez3@2si2021.es', '64286286', 'Hernandez3', '202cb962ac59075b964b07152d234b70', 'N'),
(293, 'Ed', 'Harrison', '', 'H', '2020-02-15', 'Harrison@2si2021.es', '64293293', 'Harrison', '202cb962ac59075b964b07152d234b70', 'N'),
(298, 'Mihael', 'Holz', '', 'H', '2020-02-15', 'Holz@2si2021.es', '64298298', 'Holz', '202cb962ac59075b964b07152d234b70', 'S'),
(299, 'Jan', 'Klaeboe', '', 'H', '2020-02-15', 'Klaeboe@2si2021.es', '64299299', 'Klaeboe', '202cb962ac59075b964b07152d234b70', 'S'),
(303, 'Bradley', 'Schuyler', '', 'H', '2020-02-15', 'Schuyler@2si2021.es', '64303303', 'Schuyler', '202cb962ac59075b964b07152d234b70', 'S'),
(307, 'Mel', 'Andersen', '', 'H', '2020-02-15', 'Andersen@2si2021.es', '643073079', 'Andersen', '202cb962ac59075b964b07152d234b70', 'S'),
(311, 'Pirkko', 'Koskitalo', '', 'H', '2020-02-15', 'Koskitalo@2si2021.es', '64311311', 'Koskitalo', '202cb962ac59075b964b07152d234b70', 'S'),
(314, 'Catherine ', 'Dewey', '', 'H', '2020-02-15', 'Dewey@2si2021.es', '64314314', 'Dewey', '202cb962ac59075b964b07152d234b70', 'S'),
(319, 'Steve', 'Frick', '', 'H', '2020-02-15', 'Frick2@2si2021.es', '64319319', 'Frick2', '202cb962ac59075b964b07152d234b70', 'S'),
(320, 'Wing', 'Huang', '', 'H', '2020-02-15', 'Huang@2si2021.es', '64320320', 'Huang', '202cb962ac59075b964b07152d234b70', 'S'),
(321, 'Julie', 'Brown', '', 'M', '2020-02-15', 'Brown@2si2021.es', '64321321', 'Brown', '202cb962ac59075b964b07152d234b70', 'S'),
(323, 'Mike', 'Graham', '', 'H', '2020-02-15', 'Graham@2si2021.es', '64323323', 'Graham', '202cb962ac59075b964b07152d234b70', 'S'),
(324, 'Ann ', 'Brown', '', 'M', '2020-02-15', 'Brown2@2si2021.es', '64324324', 'Brown2', '202cb962ac59075b964b07152d234b70', 'S'),
(328, 'William', 'Brown', '', 'H', '2020-02-15', 'Brown3@2si2021.es', '64328328', 'Brown3', '202cb962ac59075b964b07152d234b70', 'S'),
(333, 'Ben', 'Calaghan', '', 'H', '2020-02-15', 'Calaghan@2si2021.es', '64333333', 'Calaghan', '202cb962ac59075b964b07152d234b70', 'S'),
(334, 'Kalle', 'Suominen', '', 'H', '2020-02-15', 'Suominen@2si2021.es', '64334334', 'Suominen', '202cb962ac59075b964b07152d234b70', 'S'),
(335, 'Philip ', 'Cramer', '', 'H', '2020-02-15', 'Cramer@2si2021.es', '64335335', 'Cramer', '202cb962ac59075b964b07152d234b70', 'S'),
(339, 'Francisca', 'Cervantes', '', 'M', '2020-02-15', 'Cervantes@2si2021.es', '64339339', 'Cervantes', '202cb962ac59075b964b07152d234b70', 'S'),
(344, 'Jesus', 'Fernandez', '', 'H', '2020-02-15', 'Fernandez@2si2021.es', '64344344', 'Fernandez', '202cb962ac59075b964b07152d234b70', 'S'),
(347, 'Brian', 'Chandler', '', 'H', '2020-02-15', 'Chandler@2si2021.es', '64347347', 'Chandler', '202cb962ac59075b964b07152d234b70', 'S'),
(348, 'Patricia ', 'McKenna', '', 'M', '2020-02-15', 'McKenna@2si2021.es', '64348348', 'McKenna', '202cb962ac59075b964b07152d234b70', 'S'),
(350, 'Laurence ', 'Lebihan', '', 'H', '2020-02-15', 'Lebihan@2si2021.es', '64350350', 'Lebihan', '202cb962ac59075b964b07152d234b70', 'N'),
(353, 'Paul ', 'Henriot', '', 'H', '2020-02-15', 'Henriot@2si2021.es', '64353353', 'Henriot', '202cb962ac59075b964b07152d234b70', 'S'),
(356, 'Armand', 'Kuger', '', 'H', '2020-02-15', 'Kuger@2si2021.es', '64356356', 'Kuger', '202cb962ac59075b964b07152d234b70', 'S'),
(357, 'Wales', 'MacKinlay', '', 'H', '2020-02-15', 'MacKinlay@2si2021.es', '64357357', 'MacKinlay', '202cb962ac59075b964b07152d234b70', 'S'),
(361, 'Karin', 'Josephs', '', 'H', '2020-02-15', 'Josephs@2si2021.es', '64361361', 'Josephs', '202cb962ac59075b964b07152d234b70', 'S'),
(362, 'Juri', 'Yoshido', '', 'H', '2020-02-15', 'Yoshido@2si2021.es', '64362362', 'Yoshido', '202cb962ac59075b964b07152d234b70', 'N'),
(363, 'Dorothy', 'Young', '', 'M', '2020-02-15', 'Young4@2si2021.es', '64363363', 'Young4', '202cb962ac59075b964b07152d234b70', 'S'),
(369, 'Lino ', 'Rodriguez', '', 'H', '2020-02-15', 'Rodriguez@2si2021.es', '64369369', 'Rodriguez', '202cb962ac59075b964b07152d234b70', 'S'),
(376, 'Braun', 'Urs', '', 'H', '2020-02-15', 'Urs@2si2021.es', '64376376', 'Urs', '202cb962ac59075b964b07152d234b70', 'S'),
(379, 'Allen', 'Nelson', '', 'H', '2020-02-15', 'Nelson2@2si2021.es', '64379379', 'Nelson2', '202cb962ac59075b964b07152d234b70', 'S'),
(381, 'Pascale ', 'Cartrain', '', 'H', '2020-02-15', 'Cartrain@2si2021.es', '64381381', 'Cartrain', '202cb962ac59075b964b07152d234b70', 'S'),
(382, 'Georg ', 'Pipps', '', 'H', '2020-02-15', 'Pipps@2si2021.es', '64382382', 'Pipps', '202cb962ac59075b964b07152d234b70', 'S'),
(385, 'Arnold', 'Cruz', '', 'H', '2020-02-15', 'Cruz@2si2021.es', '64385385', 'Cruz', '202cb962ac59075b964b07152d234b70', 'S'),
(386, 'Maurizio ', 'Moroni', '', 'H', '2020-02-15', 'Moroni@2si2021.es', '64386386', 'Moroni', '202cb962ac59075b964b07152d234b70', 'S'),
(398, 'Akiko', 'Shimamura', '', 'H', '2020-02-15', 'Shimamura@2si2021.es', '64398398', 'Shimamura', '202cb962ac59075b964b07152d234b70', 'S'),
(406, 'Dominique', 'Perrier', '', 'H', '2020-02-15', 'Perrier@2si2021.es', '64406406', 'Perrier', '202cb962ac59075b964b07152d234b70', 'S'),
(409, 'Rita ', 'MÍller', '', 'M', '2020-02-15', 'M?ller@2si2021.es', '64409409', 'MIller', '202cb962ac59075b964b07152d234b70', 'S'),
(412, 'Sarah', 'McRoy', '', 'M', '2020-02-15', 'McRoy@2si2021.es', '64412412', 'McRoy', '202cb962ac59075b964b07152d234b70', 'S'),
(415, 'Michael', 'Donnermeyer', '', 'H', '2020-02-15', 'Donnermeyer@2si2021.es', '64415415', 'Donnermeyer', '202cb962ac59075b964b07152d234b70', 'S'),
(424, 'Maria', 'Hernandez', '', 'M', '2020-02-15', 'Hernandez2@2si2021.es', '64424424', 'Hernandez2', '202cb962ac59075b964b07152d234b70', 'S'),
(443, 'Alexander ', 'Feuer', '', 'H', '2020-02-15', 'Feuer@2si2021.es', '64443443', 'Feuer', '202cb962ac59075b964b07152d234b70', 'S'),
(447, 'Dan', 'Lewis', '', 'H', '2020-02-15', 'Lewis@2si2021.es', '64447447', 'Lewis', '202cb962ac59075b964b07152d234b70', 'S'),
(448, 'Martha', 'Larsson', '', 'M', '2020-02-15', 'Larsson@2si2021.es', '64448448', 'Larsson', '202cb962ac59075b964b07152d234b70', 'S'),
(450, 'Sue', 'Frick', '', '', '2020-02-15', 'Frick3@2si2021.es', '64450450', 'Frick3', '202cb962ac59075b964b07152d234b70', 'S'),
(452, 'Roland ', 'Mendel', '', 'H', '2020-02-15', 'Mendel@2si2021.es', '64452452', 'Mendel', '202cb962ac59075b964b07152d234b70', 'S'),
(455, 'Leslie', 'Murphy', '', 'M', '2020-02-15', 'Murphy2@2si2021.es', '64455455', 'Murphy2', '202cb962ac59075b964b07152d234b70', 'S'),
(456, 'Yu', 'Choi', '', 'H', '2020-02-15', 'Choi@2si2021.es', '64456456', 'Choi', '202cb962ac59075b964b07152d234b70', 'S'),
(458, 'Martín ', 'Sommer', '', 'H', '2020-02-15', 'Sommer@2si2021.es', '64458458', 'Sommer', '202cb962ac59075b964b07152d234b70', 'S'),
(459, 'Sven ', 'Ottlieb', '', 'H', '2020-02-15', 'Ottlieb@2si2021.es', '64459459', 'Ottlieb', '202cb962ac59075b964b07152d234b70', 'S'),
(462, 'Violeta', 'Benitez', '', 'M', '2020-02-15', 'Benitez@2si2021.es', '64462462', 'Benitez', '202cb962ac59075b964b07152d234b70', 'S'),
(465, 'Carmen', 'Anton', '', 'H', '2020-02-15', 'Anton@2si2021.es', '644654657', 'Anton', '202cb962ac59075b964b07152d234b70', 'S'),
(471, 'Sean', 'Clenahan', '', 'H', '2020-02-15', 'Clenahan@2si2021.es', '64471471', 'Clenahan', '202cb962ac59075b964b07152d234b70', 'S'),
(473, 'Franco', 'Ricotti', '', 'H', '2020-02-15', 'Ricotti@2si2021.es', '64473473', 'Ricotti', '202cb962ac59075b964b07152d234b70', 'S'),
(475, 'Steve', 'Thompson', '', 'H', '2020-02-15', 'Thompson3@2si2021.es', '64475475', 'Thompson3', '202cb962ac59075b964b07152d234b70', 'S'),
(477, 'Hanna ', 'Moos', '', 'M', '2020-02-15', 'Moos@2si2021.es', '64477477', 'Moos', '202cb962ac59075b964b07152d234b70', 'S'),
(480, 'Alexander ', 'Semenov', '', 'H', '2020-02-15', 'Semenov@2si2021.es', '64480480', 'Semenov', '202cb962ac59075b964b07152d234b70', 'S'),
(481, 'Raanan', 'Altagar,G M', '', 'H', '2020-02-15', 'Altagar,G M@2si2021.es', '64481481', 'Altagar,G M', '202cb962ac59075b964b07152d234b70', 'N'),
(484, 'José Pedro ', 'Roel', '', 'H', '2020-02-15', 'Roel@2si2021.es', '64484484', 'Roel', '202cb962ac59075b964b07152d234b70', 'S'),
(486, 'Rosa', 'Salazar', '', 'M', '2020-02-15', 'Salazar@2si2021.es', '64486486', 'Salazar', '202cb962ac59075b964b07152d234b70', 'S'),
(487, 'Sue', 'Taylor', '', 'M', '2020-02-15', 'Taylor2@2si2021.es', '64487487', 'Taylor2', '202cb962ac59075b964b07152d234b70', 'S'),
(489, 'Thomas ', 'Smith', '', 'H', '2020-02-15', 'Smith@2si2021.es', '64489489', 'Smith', '202cb962ac59075b964b07152d234b70', 'S'),
(495, 'Valarie', 'Franco', '', 'M', '2020-02-15', 'Franco2@2si2021.es', '64495495', 'Franco2', '202cb962ac59075b964b07152d234b70', 'S'),
(496, 'Tony', 'Snowden', '', 'H', '2020-02-15', 'Snowden@2si2021.es', '64496496', 'Snowden', '202cb962ac59075b964b07152d234b70', 'N'),
(497, 'Test1', 'Panchez', '', 'M', '2022-11-19', 'test@test2.com', '123456789', 'Antonion', 'testtest', 'S'),
(501, 'Testtttewq', 'Testteqw', 'Testteqw', 'H', '2022-11-19', 'adasdas@dasdsaas.com', '123456773', 'Test42', '9939a51a810f126ec39838130fe4d45d', 'S'),
(503, 'testUser', 'testUser', 'testUser', 'H', '2022-11-30', 'testUser@testUser.com', '123123123', 'testUser', '33ef37db24f3a27fb520847dcd549e9f', 'S'),
(504, 'lastTest', 'lastTest', '', 'M', '2022-12-03', 'lastTest@test.com', '111111111', 'lastTest', 'f89c3b74ce62334ff3cabb682058961a', 'S');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_Opcion`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id_Permiso`),
  ADD KEY `id_Opcion` (`id_Opcion`);

--
-- Indices de la tabla `permisosrol`
--
ALTER TABLE `permisosrol`
  ADD PRIMARY KEY (`id_Permiso`,`id_Rol`),
  ADD KEY `id_Rol` (`id_Rol`);

--
-- Indices de la tabla `permisosusuario`
--
ALTER TABLE `permisosusuario`
  ADD PRIMARY KEY (`id_Permiso`,`id_Usuario`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_Rol`);

--
-- Indices de la tabla `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD PRIMARY KEY (`id_Rol`,`id_Usuario`),
  ADD KEY `id_Usuario` (`id_Usuario`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_Usuario`),
  ADD UNIQUE KEY `UQ_login` (`login`),
  ADD UNIQUE KEY `UQ_mail` (`mail`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `menu`
--
ALTER TABLE `menu`
  MODIFY `id_Opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id_Permiso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`id_Opcion`) REFERENCES `menu` (`id_Opcion`);

--
-- Filtros para la tabla `permisosrol`
--
ALTER TABLE `permisosrol`
  ADD CONSTRAINT `permisosrol_ibfk_2` FOREIGN KEY (`id_Permiso`) REFERENCES `permisos` (`id_Permiso`),
  ADD CONSTRAINT `permisosrol_ibfk_3` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`);

--
-- Filtros para la tabla `permisosusuario`
--
ALTER TABLE `permisosusuario`
  ADD CONSTRAINT `permisosusuario_ibfk_1` FOREIGN KEY (`id_Permiso`) REFERENCES `permisos` (`id_Permiso`),
  ADD CONSTRAINT `permisosusuario_ibfk_2` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`);

--
-- Filtros para la tabla `rolesusuario`
--
ALTER TABLE `rolesusuario`
  ADD CONSTRAINT `rolesusuario_ibfk_1` FOREIGN KEY (`id_Usuario`) REFERENCES `usuarios` (`id_Usuario`),
  ADD CONSTRAINT `rolesusuario_ibfk_2` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`id_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
