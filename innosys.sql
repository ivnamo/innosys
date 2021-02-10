-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-02-2021 a las 11:53:50
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `innosys`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libretalider`
--

CREATE TABLE `libretalider` (
  `idlibreta` bigint(20) NOT NULL,
  `liderid` bigint(20) NOT NULL,
  `colaboradorid` bigint(20) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp(),
  `evento` text NOT NULL,
  `tipoevento` varchar(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `libretalider`
--

INSERT INTO `libretalider` (`idlibreta`, `liderid`, `colaboradorid`, `fecha`, `evento`, `tipoevento`, `status`) VALUES
(73, 1, 2, '2021-01-01 13:10:24', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(75, 19, 4, '2021-01-05 13:13:08', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(76, 1, 2, '2019-11-08 13:13:29', 'gfgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2', 1),
(77, 1, 2, '2021-01-02 13:13:29', 'gfgggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggggg', '2', 1),
(78, 1, 2, '2021-02-02 23:00:00', 'bbbbaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '2', 1),
(79, 1, 2, '2021-02-02 23:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(80, 1, 2, '2021-02-02 23:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(81, 1, 2, '2021-02-02 23:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(82, 1, 2, '2021-02-02 23:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(83, 1, 2, '2021-02-02 23:00:00', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', '1', 1),
(84, 7, 100, '2021-02-04 23:00:00', 'jhjjjghjjhjhjhjhjhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', '1', 1),
(85, 7, 3, '2021-02-04 23:00:00', 'kljjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', '2', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard de innosys', 1),
(2, 'Usuarios', 'Usuarios de innosys', 1),
(3, 'Roles', 'Roles', 1),
(4, 'Coffee time', 'Juegos', 1),
(5, 'Libreta lider', 'Libreta del Lider', 1),
(6, 'InnoSys', 'Front de InnoSys', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(231, 6, 1, 1, 0, 0, 0),
(232, 6, 2, 1, 0, 0, 0),
(233, 6, 3, 1, 0, 0, 0),
(234, 6, 4, 0, 0, 0, 0),
(235, 6, 5, 1, 1, 1, 1),
(236, 6, 6, 0, 0, 0, 0),
(237, 1, 1, 1, 1, 1, 1),
(238, 1, 2, 1, 1, 1, 1),
(239, 1, 3, 1, 1, 1, 1),
(240, 1, 4, 1, 1, 1, 1),
(241, 1, 5, 1, 1, 1, 1),
(242, 1, 6, 1, 1, 1, 1),
(303, 5, 1, 1, 0, 0, 0),
(304, 5, 2, 0, 0, 0, 0),
(305, 5, 3, 0, 0, 0, 0),
(306, 5, 4, 0, 0, 0, 0),
(307, 5, 5, 0, 0, 0, 0),
(308, 5, 6, 1, 1, 0, 0),
(315, 3, 1, 1, 0, 0, 0),
(316, 3, 2, 0, 0, 0, 0),
(317, 3, 3, 0, 0, 0, 0),
(318, 3, 4, 0, 0, 0, 0),
(319, 3, 5, 1, 1, 1, 0),
(320, 3, 6, 0, 0, 1, 0),
(321, 4, 1, 1, 0, 0, 0),
(322, 4, 2, 0, 0, 0, 0),
(323, 4, 3, 0, 0, 0, 0),
(324, 4, 4, 0, 0, 0, 0),
(325, 4, 5, 0, 0, 0, 0),
(326, 4, 6, 0, 0, 1, 0),
(327, 2, 1, 1, 1, 1, 1),
(328, 2, 2, 1, 1, 1, 0),
(329, 2, 3, 1, 0, 0, 0),
(330, 2, 4, 0, 0, 0, 0),
(331, 2, 5, 1, 1, 1, 1),
(332, 2, 6, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `password` varchar(12) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `fechareg` datetime NOT NULL DEFAULT current_timestamp(),
  `user` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `departamento` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL DEFAULT 'avatar.jpg',
  `superiorid` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `nombre`, `apellidos`, `password`, `rolid`, `status`, `fechareg`, `user`, `email`, `departamento`, `avatar`, `superiorid`) VALUES
(1, 'aaa', 'aaa', 'ae4pauzi', 1, 1, '2021-01-08 10:49:18', 'INM', 'aaa@aaa.com', 'I+D', 'avatar_1.jpg', 0),
(2, 'bbb', 'bbb', '12345', 4, 1, '2021-01-08 10:49:18', 'RPM', 'rpm@rpm.com', 'I+D', 'avatar.jpg', 100),
(3, 'ccc', 'ccc', '12345', 3, 1, '2021-01-18 09:00:33', 'EZG', 'ezg@ezg.com', 'I+D', 'avatar.jpg', 7),
(4, 'ddd', 'ddd', '12345', 4, 1, '2021-01-18 10:13:23', 'AAM', 'aam@aam.com', 'I+D', 'avatar.jpg', 3),
(5, 'eee', 'eee', '12345', 5, 1, '2021-01-19 18:14:14', 'JJJ', 'juan@juan.com', 'Comercial', 'avatar.jpg', 0),
(6, 'fff', 'fff', '12345', 4, 1, '2021-01-17 17:55:46', 'KKK', 'kkk@kkk.com', 'I+D', 'avatar.jpg', 3),
(7, 'Director', 'I+D', 'ae4pauzi', 2, 1, '2021-02-04 08:28:09', 'DIR', 'dir@dir.com', 'I+D', 'avatar.jpg', 0),
(99, 'Pp', 'Ppaa', '12345', 5, 1, '2021-01-13 15:04:01', 'PPP', 'p@p.com', 'Otro', 'avatar_17.jpg', 0),
(100, 'Iv', 'Na', '12345', 3, 1, '2021-02-05 10:56:37', 'III', 'inm@inm.com', '', 'avatar.jpg', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Super Administrador', 'Super Admin', 1),
(2, 'Director I+D', 'Coordina todo como admin', 1),
(3, 'Resp. I+D+i', 'Visualizar, Crear y Editar', 1),
(4, 'Técnico I+D+i', 'crear', 1),
(5, 'Usuario', 'Visualizar y Crear', 1),
(6, 'pruebas', 'wsss', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idsolicitud` bigint(20) NOT NULL,
  `personaid` bigint(20) NOT NULL,
  `seccion` int(11) NOT NULL,
  `categoria` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `prioridad` int(11) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `dategest` datetime NOT NULL,
  `datedeleg` datetime NOT NULL,
  `dateongo` datetime NOT NULL,
  `datefin` datetime NOT NULL,
  `responsableid` bigint(20) NOT NULL DEFAULT 0,
  `solucion` text NOT NULL,
  `valuser` int(11) NOT NULL DEFAULT 0 COMMENT '0 - no valorado\r\n1 - me gusta\r\n2 - no me gusta',
  `comentarios` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idsolicitud`, `personaid`, `seccion`, `categoria`, `descripcion`, `prioridad`, `datecreated`, `dategest`, `datedeleg`, `dateongo`, `datefin`, `responsableid`, `solucion`, `valuser`, `comentarios`, `status`) VALUES
(79, 5, 1, 1, 'dldslldd', 2, '2021-02-07 11:33:29', '2021-02-07 11:53:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-07 11:53:45', 7, 'aa', 2, '', 6),
(80, 5, 2, 4, 'cvvvdssd', 2, '2021-02-07 11:33:38', '2021-02-07 11:34:05', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-07 11:34:10', 7, 'ffffffffffffffffffffffffffffffff', 1, '', 6),
(81, 5, 1, 1, 'sasccsc', 3, '2021-02-07 11:33:44', '2021-02-07 11:33:56', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-07 11:34:03', 7, 'aaaaaaaaaaaaaaaaaa', 2, '', 6),
(82, 5, 1, 1, 'ddddddddddddddddd', 1, '2021-02-08 08:52:56', '2021-02-08 09:09:49', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-08 12:35:46', 7, 'aaa', 2, '', 6),
(83, 5, 1, 5, 'hhhhhhhhhhhhhhhhhhhhhhhh', 1, '2021-02-08 08:53:04', '2021-02-08 09:08:34', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-08 09:09:47', 7, 'aaaaa', 2, '', 6),
(84, 5, 2, 3, 'gggggggggggggggggggggggggg', 2, '2021-02-08 08:53:15', '2021-02-08 08:53:26', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-08 09:08:31', 7, 'aaaa', 1, '', 6),
(85, 99, 1, 4, 'ssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss', 1, '2021-02-08 16:33:43', '2021-02-08 16:40:09', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-08 16:40:18', 7, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 2, '', 6),
(86, 99, 2, 2, 'aaaaaaaaaaaaaaaaaaaaaaa', 3, '2021-02-08 16:38:21', '2021-02-08 16:38:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2021-02-08 16:39:35', 7, 'ññ', 1, '', 0),
(87, 99, 1, 2, 'dfsdgfg', 1, '2021-02-08 17:41:09', '2021-02-08 17:41:55', '2021-02-08 17:44:57', '2021-02-08 17:45:13', '2021-02-08 17:47:38', 4, 'aaaaa', 1, '', 6),
(88, 5, 1, 1, 'fsdfdsfgsdfsd', 2, '2021-02-08 17:47:58', '2021-02-08 17:48:11', '2021-02-08 17:48:18', '2021-02-08 17:48:41', '2021-02-08 17:48:50', 3, 'aaaaaaaaaa', 2, '', 6);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `libretalider`
--
ALTER TABLE `libretalider`
  ADD PRIMARY KEY (`idlibreta`),
  ADD KEY `FK_COLID_IDPERSONA` (`colaboradorid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `FK_ROLID_IDROL` (`rolid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idsolicitud`),
  ADD KEY `FK_IDPERS_PERSID` (`personaid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `libretalider`
--
ALTER TABLE `libretalider`
  MODIFY `idlibreta` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=333;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idsolicitud` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `libretalider`
--
ALTER TABLE `libretalider`
  ADD CONSTRAINT `FK_COLID_IDPERSONA` FOREIGN KEY (`colaboradorid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `FK_ROLID_IDROL` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `FK_IDPERS_PERSID` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
