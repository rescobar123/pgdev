-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-08-2021 a las 04:40:28
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
-- Base de datos: `pgdb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bitacora`
--

CREATE TABLE `bitacora` (
  `id` int(10) NOT NULL,
  `BitacoraCodigo` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraFecha` date NOT NULL,
  `BitacoraHoraInicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraHoraFinal` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraTipo` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `BitacoraYear` int(4) NOT NULL,
  `BitacoraDescripcion` varchar(70) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `ClienteNit` varchar(15) NOT NULL,
  `ClienteNombres` varchar(50) NOT NULL,
  `ClienteApellidos` varchar(50) NOT NULL,
  `ClienteCantidadCompras` int(4) NOT NULL,
  `ClienteCorreo` varchar(30) NOT NULL,
  `ClienteUltimaDireccion` varchar(200) NOT NULL,
  `ClienteTelefono` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `id` int(10) NOT NULL,
  `CuentaCodigo` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaNombreCompleto` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaPrivilegio` varchar(18) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaUsuario` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaClave` varchar(535) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEmail` varchar(70) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaEstado` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaGenero` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `CuentaFoto` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `SucursalId` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id` int(11) NOT NULL,
  `FacturaCodigo` varchar(30) NOT NULL,
  `VentaId` int(11) NOT NULL,
  `FacturaFechaHora` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `id` int(11) NOT NULL,
  `PedidoCodigo` varchar(15) NOT NULL,
  `PedidoSucursalId` int(3) NOT NULL,
  `PedidoProductoId` int(10) NOT NULL,
  `PedidoClienteId` int(11) NOT NULL,
  `PedidoFechaHora` datetime NOT NULL,
  `PedidoTipoPago` varchar(10) NOT NULL,
  `PedidoTracking` varchar(20) NOT NULL,
  `PedidoTipoMensajeria` varchar(10) NOT NULL,
  `PedidoDireccionCliente` varchar(200) NOT NULL,
  `PedidoComentario` varchar(8) NOT NULL,
  `PedidoRepartidor` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(10) NOT NULL,
  `ProductoNombre` varchar(50) NOT NULL,
  `ProductoDescripcion` varchar(300) NOT NULL,
  `ProductoCodigo` varchar(20) NOT NULL,
  `ProductoPrecioUni` decimal(6,2) NOT NULL,
  `ProductoExistencia` int(10) NOT NULL,
  `ProductoCategoria` varchar(15) NOT NULL,
  `ProductoCantVenta` int(10) NOT NULL,
  `ProductoUbicaFisica` varchar(200) NOT NULL,
  `ProductoDescuento` decimal(3,2) NOT NULL,
  `ProductoImagen` longtext NOT NULL,
  `ProductoMarca` varchar(30) NOT NULL,
  `ProductoTotal` int(10) NOT NULL,
  `ProductoFechaCreado` date NOT NULL,
  `ProductoEstado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productosucursal`
--

CREATE TABLE `productosucursal` (
  `id` int(11) NOT NULL,
  `ProductoId` int(10) NOT NULL,
  `SucursalId` int(3) NOT NULL,
  `CantidadProducto` int(10) NOT NULL,
  `FechaAgregado` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `id` int(3) NOT NULL,
  `SucursalNombre` varchar(30) NOT NULL,
  `SucursalDireccion` varchar(50) NOT NULL,
  `SucursalGerente` varchar(50) NOT NULL,
  `SucursalFechaCreo` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trakingpedido`
--

CREATE TABLE `trakingpedido` (
  `id` int(11) NOT NULL,
  `TrackingPedidoId` int(11) NOT NULL,
  `TrackingEstado` varchar(15) NOT NULL,
  `TrackingFechaHoraInicio` datetime NOT NULL,
  `TrackingFechaHoraFin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `PedidoId` int(11) NOT NULL,
  `ClienteId` int(11) NOT NULL,
  `VentaFechaHora` datetime NOT NULL,
  `VentaIngreso` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CuentaCodigo` (`CuentaCodigo`),
  ADD UNIQUE KEY `CuentaUsuario` (`CuentaUsuario`),
  ADD KEY `SucursalId` (`SucursalId`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `VentaId` (`VentaId`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PedidoClienteId` (`PedidoClienteId`),
  ADD KEY `PedidoSucursalId` (`PedidoSucursalId`),
  ADD KEY `PedidoProductoId` (`PedidoProductoId`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ProductoCodigo` (`ProductoCodigo`);

--
-- Indices de la tabla `productosucursal`
--
ALTER TABLE `productosucursal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ProductoIdIndice` (`ProductoId`) USING BTREE,
  ADD KEY `SucursalIdIndice` (`SucursalId`) USING BTREE;

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `trakingpedido`
--
ALTER TABLE `trakingpedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TrackingPedidoId` (`TrackingPedidoId`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `PedidoId` (`PedidoId`),
  ADD KEY `ClienteId` (`ClienteId`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `bitacora`
--
ALTER TABLE `bitacora`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productosucursal`
--
ALTER TABLE `productosucursal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `trakingpedido`
--
ALTER TABLE `trakingpedido`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pedido` (`PedidoClienteId`);

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`VentaId`) REFERENCES `ventas` (`id`);

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`PedidoSucursalId`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`id`) REFERENCES `pedido` (`PedidoProductoId`);

--
-- Filtros para la tabla `productosucursal`
--
ALTER TABLE `productosucursal`
  ADD CONSTRAINT `productosucursal_ibfk_1` FOREIGN KEY (`id`) REFERENCES `producto` (`id`),
  ADD CONSTRAINT `productosucursal_ibfk_2` FOREIGN KEY (`SucursalId`) REFERENCES `sucursal` (`id`);

--
-- Filtros para la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD CONSTRAINT `sucursal_ibfk_1` FOREIGN KEY (`id`) REFERENCES `cuenta` (`SucursalId`);

--
-- Filtros para la tabla `trakingpedido`
--
ALTER TABLE `trakingpedido`
  ADD CONSTRAINT `trakingpedido_ibfk_1` FOREIGN KEY (`TrackingPedidoId`) REFERENCES `pedido` (`id`);

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`PedidoId`) REFERENCES `pedido` (`id`),
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`ClienteId`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
INSERT INTO `cuenta` (`id`, `CuentaCodigo`, `CuentaNombreCompleto`, `CuentaPrivilegio`, `CuentaUsuario`, `CuentaClave`, `CuentaEmail`, `CuentaEstado`, `CuentaGenero`, `CuentaFoto`) VALUES
(14, 'USR85-14', 'administrador general', 'Administrador', 'administrador', 'dnIzSmlNUlhKZ2hGd0MzYytRa1dFQUVvU29DOGNaazRHbFZPZnJoVUxFWT0=', 'admin@prod.com', '1', 'M', 'data:image/jpeg;base64,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');
