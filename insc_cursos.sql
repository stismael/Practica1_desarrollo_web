-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 30-11-2024 a las 17:01:06
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `insc_cursos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date DEFAULT NULL,
  `fecha_fin` date DEFAULT NULL,
  `cupos` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `nombre`, `descripcion`, `fecha_inicio`, `fecha_fin`, `cupos`) VALUES
(1, 'Curso de PHP Básico', 'Curso introductorio a PHP y MySQL', '2024-01-15', '2024-02-15', 29),
(2, 'Curso de Python', 'Curso introductorio a Python y su uso', '2024-02-15', '2024-03-15', 29),
(3, 'Curso de Desarrollo Web', 'Desarrollo de sitios web con HTML, CSS, y JavaScript', '2024-03-01', '2024-04-01', 24),
(4, 'Curso de MySQL Avanzado', 'Aprende MySQL a nivel avanzado', '2024-05-10', '2024-06-10', 20),
(5, 'Curso de Flask', 'Curso avanzado de Flask con SQLAlchemy', '2024-06-15', '2024-07-15', 30);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscritos`
--

CREATE TABLE `inscritos` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `curso_id` int NOT NULL,
  `fecha_inscripcion` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `inscritos`
--

INSERT INTO `inscritos` (`id`, `usuario_id`, `curso_id`, `fecha_inscripcion`) VALUES
(1, 1, 2, '2024-11-30 15:14:27'),
(2, 2, 3, '2024-11-30 15:24:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `email`, `password`) VALUES
(1, 'prueba', 'prueba@gmail.com', '$2y$10$JHo4jojRqNxl8/pqnW0T9u4IGfKe4DQ4j5qh6kGpowTa7qXo6ASPG'),
(2, 'prueba2', 'prueba2@gmail.com', '$2y$10$cIndNR.8gJkJn6iWsDr03e9N4kw2EhsL7s4AnwLeiDCUrNnDHmNmW'),
(3, 'prueba3', 'prueba3@gmail.com', '$2y$10$PXv4LfDpoGz23IplExSc8OXXnOeF0/bv1zSdS/AssESy.AmhMOf8i'),
(4, 'prueba4', 'prueba4@gmail.com', '$2y$10$dT2Jfi23OLL8/DDm61VpbeNl6dtYht96BoGWvK7UF5FDnDJxxR5Pq'),
(5, 'prueba5', 'prueba5@gmail.com', '$2y$10$w3tEgVy21evdk26UbAaY4OHIpvQbTh1gVShA.QHA5CdzTvAVDd9my');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inscritos`
--
ALTER TABLE `inscritos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `curso_id` (`curso_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `inscritos`
--
ALTER TABLE `inscritos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `inscritos`
--
ALTER TABLE `inscritos`
  ADD CONSTRAINT `inscritos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `inscritos_ibfk_2` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
