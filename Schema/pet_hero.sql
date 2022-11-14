-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2022 a las 13:30:31
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pet_hero`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bank_account`
--

CREATE TABLE `bank_account` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `balance` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `bank_account`
--

INSERT INTO `bank_account` (`id`, `user_id`, `balance`) VALUES
(1, 2, 10000),
(2, 6, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `keeper_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `message` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pet_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `booking`
--

INSERT INTO `booking` (`id`, `owner_id`, `keeper_id`, `start_date`, `end_date`, `message`, `pet_id`, `price`, `status`) VALUES
(1, 2, 3, '2022-11-13', '2022-11-13', 'asd', 3, 5000, 'finished'),
(2, 2, 3, '2022-11-14', '2022-11-14', 'sdgs', 3, 5000, 'approved'),
(3, 2, 3, '2022-11-15', '2022-11-15', 'asfas', 3, 5000, 'approved'),
(4, 2, 3, '2022-11-16', '2022-11-16', 'zczxc', 3, 5000, 'approved'),
(5, 2, 3, '2022-11-17', '2022-11-17', 'asdasd', 3, 5000, 'approved'),
(6, 2, 3, '2022-11-18', '2022-11-18', 'asd', 3, 5000, 'approved'),
(7, 2, 3, '2022-11-20', '2022-11-20', 'asd', 4, 5000, 'approved'),
(8, 2, 3, '2022-11-22', '2022-11-22', 'asdas', 4, 5000, 'approved');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credit_card`
--

CREATE TABLE `credit_card` (
  `id` int(11) NOT NULL,
  `number` bigint(20) NOT NULL,
  `ccv` int(3) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `credit_card`
--

INSERT INTO `credit_card` (`id`, `number`, `ccv`, `user_id`) VALUES
(1, 1234432112344321, 123, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `keeper`
--

CREATE TABLE `keeper` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_size_id` int(11) NOT NULL,
  `remuneration` int(11) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `keeper`
--

INSERT INTO `keeper` (`id`, `user_id`, `pet_size_id`, `remuneration`, `start_date`) VALUES
(1, 2, 3, 10000, '2022-11-03'),
(2, 4, 3, 15000, '2022-11-03'),
(3, 6, 1, 5000, '2022-11-06'),
(4, 7, 3, 5000, '2022-11-06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `pet_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `vaccine_cert` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pet_size_id` int(11) NOT NULL,
  `pet_pics` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pet_video` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pet_breed` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pet_specie_id` int(11) NOT NULL,
  `observation` varchar(250) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pet`
--

INSERT INTO `pet` (`id`, `pet_name`, `user_id`, `vaccine_cert`, `pet_size_id`, `pet_pics`, `pet_video`, `pet_breed`, `pet_specie_id`, `observation`) VALUES
(1, 'Patan', 1, 'Views/uploads/cert_vac5_1667412588.jpeg', 3, 'Views/uploads/patan_1667412588.jpg', 'Views/uploads/patan_1667412588.mp4', 'Rottweiler', 1, 'Nice on kids'),
(2, 'Darky', 1, 'Views/uploads/cert_vac5_1667412730.jpeg', 1, 'Views/uploads/oscuro_1667412730.png', 'Views/uploads/oscuro_1667412730.mp4', 'common', 2, 'Sleepy cat'),
(3, 'Casper', 2, 'Views/uploads/certVac3_1667413848.jpg', 1, 'Views/uploads/casper_1667413848.jpg', 'Views/uploads/casper_1667413848.mp4', 'common', 2, 'Nice to people'),
(4, 'Tina', 2, 'Views/uploads/certVac3_1667413920.jpg', 1, 'Views/uploads/gato4_1667413920.jpg', 'Views/uploads/tigre_1667413920.mp4', 'persian', 2, 'Water lover'),
(5, 'Rocky', 7, 'Views/uploads/certVac3_1667715499.jpg', 1, 'Views/uploads/perro5_1667715499.jpg', 'Views/uploads/perritoGris_1667715499.mp4', 'Delacalle', 1, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet_size`
--

CREATE TABLE `pet_size` (
  `id` int(11) NOT NULL,
  `pet_size` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pet_size`
--

INSERT INTO `pet_size` (`id`, `pet_size`) VALUES
(3, 'Big'),
(2, 'Medium'),
(1, 'Small');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pet_specie`
--

CREATE TABLE `pet_specie` (
  `id` int(11) NOT NULL,
  `pet_specie` varchar(250) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pet_specie`
--

INSERT INTO `pet_specie` (`id`, `pet_specie`) VALUES
(2, 'Cat'),
(1, 'Dog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` varchar(100) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `service`
--

INSERT INTO `service` (`id`, `user_id`, `start_date`, `end_date`, `status`) VALUES
(1, 6, '2022-11-13', '2022-11-30', 'available'),
(2, 6, '2022-11-13', '2022-11-13', 'pending'),
(3, 6, '2022-11-14', '2022-11-14', 'pending'),
(4, 6, '2022-11-15', '2022-11-15', 'pending'),
(5, 6, '2022-11-16', '2022-11-16', 'pending'),
(6, 6, '2022-11-17', '2022-11-17', 'pending'),
(7, 6, '2022-11-18', '2022-11-18', 'pending'),
(8, 6, '2022-11-20', '2022-11-20', 'pending'),
(9, 6, '2022-11-22', '2022-11-22', 'pending');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `lastname` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `user_name` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `phone_number` bigint(18) NOT NULL,
  `birth_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `user_type_id`, `name`, `lastname`, `user_name`, `password`, `email`, `phone_number`, `birth_date`) VALUES
(1, 1, 'Victor', 'Silva', 'vicsil', '1234', 'victorsilva1978@gmail.com', 2234565578, '1982-10-20'),
(2, 2, 'Marcos', 'Rosti', 'rocksti', '1234', 'rockandrost@gmail.com', 2234632587, '1986-03-08'),
(3, 1, 'Camila', 'Silva', 'camsil', '1234', 'victors.it78@gmail.com', 2234748364, '2008-10-23'),
(4, 2, 'Lorena', 'Sola', 'lore', '1234', 'rosti_marcos@hotmail.com', 2236781114, '1988-10-30'),
(5, 1, 'Carolina', 'Gallo', 'caro', '1234', 'slumdesarrollos@gmail.com', 2236252998, '1985-10-12'),
(6, 2, 'Rodrigo', 'Eulloque', 'rodrieu', '1234', 'rodri@eu', 2944163556, '1992-07-16'),
(7, 2, 'Marcos', 'Rosti', 'marc', '1234', 'marcos@rosti', 2235164525, '1985-12-21'),
(8, 1, 'as', 'as', 'as', '1234', 'as@as', 2944163556, '1995-05-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(50) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(3, 'Admin'),
(2, 'Keeper'),
(1, 'Owner');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bank_account`
--
ALTER TABLE `bank_account`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_id` (`owner_id`),
  ADD KEY `keeper_id` (`keeper_id`),
  ADD KEY `pet_id` (`pet_id`);

--
-- Indices de la tabla `credit_card`
--
ALTER TABLE `credit_card`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `keeper`
--
ALTER TABLE `keeper`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `pet_size_id` (`pet_size_id`);

--
-- Indices de la tabla `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `vaccine_cert_id` (`vaccine_cert`),
  ADD KEY `pet_size_id` (`pet_size_id`),
  ADD KEY `pet_specie_id` (`pet_specie_id`);

--
-- Indices de la tabla `pet_size`
--
ALTER TABLE `pet_size`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pet_size` (`pet_size`);

--
-- Indices de la tabla `pet_specie`
--
ALTER TABLE `pet_specie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pet_specie` (`pet_specie`);

--
-- Indices de la tabla `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `user_type_id` (`user_type_id`);

--
-- Indices de la tabla `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bank_account`
--
ALTER TABLE `bank_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `credit_card`
--
ALTER TABLE `credit_card`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `keeper`
--
ALTER TABLE `keeper`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `pet_size`
--
ALTER TABLE `pet_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pet_specie`
--
ALTER TABLE `pet_specie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `bank_account`
--
ALTER TABLE `bank_account`
  ADD CONSTRAINT `bank_account_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`keeper_id`) REFERENCES `keeper` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `credit_card`
--
ALTER TABLE `credit_card`
  ADD CONSTRAINT `credit_card_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `keeper`
--
ALTER TABLE `keeper`
  ADD CONSTRAINT `keeper_ibfk_1` FOREIGN KEY (`pet_size_id`) REFERENCES `pet_size` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `keeper_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `pet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_ibfk_2` FOREIGN KEY (`pet_size_id`) REFERENCES `pet_size` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pet_ibfk_3` FOREIGN KEY (`pet_specie_id`) REFERENCES `pet_specie` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
