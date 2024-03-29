-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 14, 2019 at 12:12 PM
-- Server version: 5.7.25
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `gigis`
--
CREATE DATABASE IF NOT EXISTS `gigis` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gigis`;

-- --------------------------------------------------------

--
-- Table structure for table `Actividad`
--

CREATE TABLE `Actividad` (
  `idActividad` int(2) NOT NULL,
  `dia` varchar(15) NOT NULL,
  `horaInicio` int(4) NOT NULL,
  `horaFin` int(4) NOT NULL,
  `edadMin` int(2) NOT NULL,
  `edadMax` int(2) NOT NULL,
  `tipoActividad` varchar(20) NOT NULL,
  `cupoAlumnos` int(3) NOT NULL DEFAULT '1',
  `cupoColaboradores` int(3) NOT NULL DEFAULT '1',
  `nombreCiclo` varchar(20) NOT NULL,
  `idPrograma` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Actividad`
--

INSERT INTO `Actividad` (`idActividad`, `dia`, `horaInicio`, `horaFin`, `edadMin`, `edadMax`, `tipoActividad`, `cupoAlumnos`, `cupoColaboradores`, `nombreCiclo`, `idPrograma`) VALUES
(45, 'Martes', 900, 1100, 10, 40, 'Grupal', 8, 4, 'Spring-Summer', 56);

-- --------------------------------------------------------

--
-- Table structure for table `Alumno`
--

CREATE TABLE `Alumno` (
  `NombreTutor` varchar(30) NOT NULL,
  `Matricula` varchar(15) NOT NULL,
  `idUsuario` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Alumno`
--

INSERT INTO `Alumno` (`NombreTutor`, `Matricula`, `idUsuario`) VALUES
('Jorge', 'QWY1245-89', 2029),
('Maria Stevens', '55268', 2051);

-- --------------------------------------------------------

--
-- Table structure for table `Ciclo`
--

CREATE TABLE `Ciclo` (
  `nombreCiclo` varchar(40) NOT NULL DEFAULT '',
  `fechaInicio` date NOT NULL,
  `fechaTermino` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Ciclo`
--

INSERT INTO `Ciclo` (`nombreCiclo`, `fechaInicio`, `fechaTermino`) VALUES
('Spring-Summer', '2019-02-01', '2019-07-15');

-- --------------------------------------------------------

--
-- Table structure for table `Organizacion`
--

CREATE TABLE `Organizacion` (
  `idOrganizacion` int(10) NOT NULL,
  `nombreOrganizacion` varchar(30) NOT NULL,
  `tipoOrganizacion` int(1) NOT NULL DEFAULT '2' COMMENT '1:Prepa , 2:Universidad',
  `claveAcceso` varchar(8) NOT NULL,
  `horasCubiertas` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Organizacion`
--

INSERT INTO `Organizacion` (`idOrganizacion`, `nombreOrganizacion`, `tipoOrganizacion`, `claveAcceso`, `horasCubiertas`) VALUES
(1002, 'ITESM', 2, 'Itesm019', 280),
(1003, 'FHICT', 2, 'Fontys19', 280);

-- --------------------------------------------------------

--
-- Table structure for table `Permiso`
--

CREATE TABLE `Permiso` (
  `idPermisos` int(10) NOT NULL DEFAULT '0',
  `NombrePermiso` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Permiso`
--

INSERT INTO `Permiso` (`idPermisos`, `NombrePermiso`) VALUES
(3200, 'Registrar Ciclo'),
(3201, 'Editar Ciclo'),
(3202, 'Eliminar Ciclo'),
(3203, 'Consultar Ciclo'),
(3204, 'Registrar Actividad'),
(3205, 'Consultar Actividades'),
(3206, 'Editar Actividad'),
(3207, 'Eliminar Actividad'),
(3208, 'Registrar Programa'),
(3209, 'Consultar Programas'),
(3210, 'Editar Programa'),
(3211, 'Eliminar Programa'),
(3212, 'Registrar Organización'),
(3213, 'Consultar Organizaciones'),
(3214, 'Editar Organización'),
(3215, 'Eliminar Organización'),
(3216, 'Registrar Usuario'),
(3217, 'Consultar Usuarios'),
(3218, 'Editar Usuario'),
(3219, 'Eliminar Usuario'),
(3220, 'Registrar Rol'),
(3221, 'Editar Rol'),
(3222, 'Eliminar Rol'),
(3223, 'Asignar Rol'),
(3224, 'Registrar Permiso'),
(3225, 'Editar Permiso'),
(3226, 'Asignar Permiso'),
(3227, 'Eliminar Permiso'),
(3228, 'Iniciar Sesión'),
(3229, 'Cerrar Sesión'),
(3230, 'Completar Registro Inicial'),
(3231, 'Inscribir Actividad Individual'),
(3232, 'Inscribir Actividad Grupal'),
(3233, 'Eliminar Registro de Inscripción En Actividad '),
(3234, 'Consultar Alumnos para Actividad Individual'),
(3235, 'Asignar Alumnos Para Actividad Individual'),
(3236, 'Consultar Reporte de Voluntarios Colaborando en el Ciclo'),
(3237, 'Consultar Reporte de Alumnos Colaborando en el Ciclo'),
(3238, 'Consultar Reporte de Alumnos Colaborando por Actividad'),
(3239, 'Consultar Ayuda del Sistema');

-- --------------------------------------------------------

--
-- Table structure for table `Programa`
--

CREATE TABLE `Programa` (
  `idPrograma` int(3) NOT NULL,
  `nombrePrograma` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcionPrograma` varchar(140) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Programa`
--

INSERT INTO `Programa` (`idPrograma`, `nombrePrograma`, `descripcionPrograma`) VALUES
(56, 'Cooking', 'Cooking class'),
(57, 'Spanish', 'Foreign language'),
(58, 'Writting', 'Writting class');

-- --------------------------------------------------------

--
-- Table structure for table `Rol`
--

CREATE TABLE `Rol` (
  `idRoles` varchar(2) NOT NULL,
  `NombreRoles` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Rol`
--

INSERT INTO `Rol` (`idRoles`, `NombreRoles`) VALUES
('A', 'Alumno'),
('B', 'Servicio Social'),
('C', 'Voluntario'),
('D', 'Administrador');

-- --------------------------------------------------------

--
-- Table structure for table `RolesPermisos`
--

CREATE TABLE `RolesPermisos` (
  `idRoles` varchar(2) NOT NULL,
  `idPermisos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RolesPermisos`
--

INSERT INTO `RolesPermisos` (`idRoles`, `idPermisos`) VALUES
('D', 3200),
('D', 3201),
('D', 3202),
('A', 3203),
('B', 3203),
('C', 3203),
('D', 3203),
('D', 3204),
('A', 3205),
('B', 3205),
('C', 3205),
('D', 3205),
('D', 3206),
('D', 3207),
('D', 3208),
('D', 3209),
('D', 3210),
('D', 3211),
('D', 3212),
('D', 3213),
('D', 3214),
('D', 3215),
('A', 3216),
('B', 3216),
('D', 3216),
('D', 3217),
('D', 3218),
('D', 3219),
('D', 3220),
('D', 3221),
('D', 3222),
('D', 3223),
('D', 3224),
('D', 3225),
('D', 3226),
('D', 3227),
('A', 3228),
('B', 3228),
('C', 3228),
('D', 3228),
('A', 3229),
('B', 3229),
('C', 3229),
('D', 3229),
('A', 3230),
('B', 3230),
('C', 3230),
('D', 3230),
('C', 3231),
('D', 3231),
('A', 3232),
('B', 3232),
('C', 3232),
('D', 3232),
('B', 3233),
('C', 3233),
('D', 3233),
('D', 3234),
('D', 3235),
('D', 3236),
('D', 3237),
('D', 3238),
('D', 3239);

-- --------------------------------------------------------

--
-- Table structure for table `ServicioSocial`
--

CREATE TABLE `ServicioSocial` (
  `idUsuario` int(11) NOT NULL,
  `Semestre` int(2) NOT NULL,
  `Matricula` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ServicioSocial`
--

INSERT INTO `ServicioSocial` (`idUsuario`, `Semestre`, `Matricula`) VALUES
(2000, 3, 'a01206138');

-- --------------------------------------------------------

--
-- Table structure for table `Usuario`
--

CREATE TABLE `Usuario` (
  `idUsuario` int(4) NOT NULL,
  `Nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoPaterno` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `ApellidoMaterno` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `CorreoElectronico` varchar(50) CHARACTER SET latin1 NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `Telefono` varchar(15) CHARACTER SET latin1 NOT NULL,
  `idRoles` varchar(2) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Usuario`
--

INSERT INTO `Usuario` (`idUsuario`, `Nombre`, `ApellidoPaterno`, `ApellidoMaterno`, `fechaNacimiento`, `CorreoElectronico`, `Password`, `Telefono`, `idRoles`) VALUES
(2000, 'Valter', 'Núñez', 'Vazquez', '1996-10-19', 'b@b.com', '$2y$10$ai9wq7b8SUa5Au/OLqKj6e8Tp1V5FMPc19eg5Ba5RGu9hYmdyFHyq', '4422471344', 'B'),
(2003, 'Johanna', 'Lampard', 'W.', '1992-05-02', 'c@c.com', '$2y$10$irUHvM293P3SWOkfpnq4jO1flnuDxib28LINwgDy3gwlPKtEBO6IO', '4421141523', 'C'),
(2029, 'Juan', 'Alivaba', 'Shrowddinger', '1992-09-07', 'a@a.com', '$2y$10$6rAUFGlb86wm7xI7IE.ZgeB..dk5j29ht564tinNbN/lLMauMCdpy', '7222468957', 'A'),
(2041, 'Admin', 'Last', 'Name', '1987-11-05', 'admin@mail.com', '$2y$10$unOAFu8Acz2aUcST3hsWXunyzXnTyKdlCXvxwSQ5NhkZtXZEWaNii', '064421591100', 'D'),
(2051, 'Student#1', 'Wilkings', 'Shëppard', '1994-01-26', 'maria@gigismexico.com', '$2y$10$oHm7KGWQ.ftSnRY0NGb3neseS0mx2krPElGto.I96Rg.J/XBVUHVa', '981277232', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `UsuarioActividad`
--

CREATE TABLE `UsuarioActividad` (
  `idUsuario` int(4) NOT NULL,
  `idActividad` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UsuarioActividad`
--

INSERT INTO `UsuarioActividad` (`idUsuario`, `idActividad`) VALUES
(2000, 45),
(2003, 45),
(2029, 45);

-- --------------------------------------------------------

--
-- Table structure for table `UsuarioOrganizacion`
--

CREATE TABLE `UsuarioOrganizacion` (
  `idUsuario` int(4) NOT NULL,
  `idOrganizacion` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `UsuarioOrganizacion`
--

INSERT INTO `UsuarioOrganizacion` (`idUsuario`, `idOrganizacion`) VALUES
(2000, 1002);

-- --------------------------------------------------------

--
-- Table structure for table `Voluntario`
--

CREATE TABLE `Voluntario` (
  `idUsuario` int(4) NOT NULL,
  `Ocupacion` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Voluntario`
--

INSERT INTO `Voluntario` (`idUsuario`, `Ocupacion`) VALUES
(2003, 'Therapist');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Actividad`
--
ALTER TABLE `Actividad`
  ADD PRIMARY KEY (`idActividad`),
  ADD KEY `fk_nombreCiclo` (`nombreCiclo`),
  ADD KEY `Actividad_ibfk_1` (`idPrograma`);

--
-- Indexes for table `Alumno`
--
ALTER TABLE `Alumno`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `Ciclo`
--
ALTER TABLE `Ciclo`
  ADD PRIMARY KEY (`nombreCiclo`);

--
-- Indexes for table `Organizacion`
--
ALTER TABLE `Organizacion`
  ADD PRIMARY KEY (`idOrganizacion`);

--
-- Indexes for table `Permiso`
--
ALTER TABLE `Permiso`
  ADD PRIMARY KEY (`idPermisos`);

--
-- Indexes for table `Programa`
--
ALTER TABLE `Programa`
  ADD PRIMARY KEY (`idPrograma`);

--
-- Indexes for table `Rol`
--
ALTER TABLE `Rol`
  ADD PRIMARY KEY (`idRoles`);

--
-- Indexes for table `RolesPermisos`
--
ALTER TABLE `RolesPermisos`
  ADD PRIMARY KEY (`idRoles`,`idPermisos`),
  ADD KEY `fk_permisos` (`idPermisos`);

--
-- Indexes for table `ServicioSocial`
--
ALTER TABLE `ServicioSocial`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_idRoles` (`idRoles`);

--
-- Indexes for table `UsuarioActividad`
--
ALTER TABLE `UsuarioActividad`
  ADD PRIMARY KEY (`idUsuario`,`idActividad`),
  ADD KEY `UsuarioActividad_ibfk_2` (`idActividad`);

--
-- Indexes for table `UsuarioOrganizacion`
--
ALTER TABLE `UsuarioOrganizacion`
  ADD PRIMARY KEY (`idUsuario`,`idOrganizacion`),
  ADD KEY `fk_organizacion` (`idOrganizacion`);

--
-- Indexes for table `Voluntario`
--
ALTER TABLE `Voluntario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Actividad`
--
ALTER TABLE `Actividad`
  MODIFY `idActividad` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `Organizacion`
--
ALTER TABLE `Organizacion`
  MODIFY `idOrganizacion` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1039;

--
-- AUTO_INCREMENT for table `Programa`
--
ALTER TABLE `Programa`
  MODIFY `idPrograma` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `Usuario`
--
ALTER TABLE `Usuario`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2052;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Actividad`
--
ALTER TABLE `Actividad`
  ADD CONSTRAINT `Actividad_ibfk_1` FOREIGN KEY (`idPrograma`) REFERENCES `Programa` (`idPrograma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_nombreCiclo` FOREIGN KEY (`nombreCiclo`) REFERENCES `Ciclo` (`nombreCiclo`) ON UPDATE CASCADE;

--
-- Constraints for table `Alumno`
--
ALTER TABLE `Alumno`
  ADD CONSTRAINT `Alumno_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `RolesPermisos`
--
ALTER TABLE `RolesPermisos`
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`idRoles`) REFERENCES `Rol` (`idRoles`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ServicioSocial`
--
ALTER TABLE `ServicioSocial`
  ADD CONSTRAINT `ServicioSocial_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Usuario`
--
ALTER TABLE `Usuario`
  ADD CONSTRAINT `fk_idRoles` FOREIGN KEY (`idRoles`) REFERENCES `Rol` (`idRoles`);

--
-- Constraints for table `UsuarioActividad`
--
ALTER TABLE `UsuarioActividad`
  ADD CONSTRAINT `UsuarioActividad_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UsuarioActividad_ibfk_2` FOREIGN KEY (`idActividad`) REFERENCES `Actividad` (`idActividad`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `UsuarioOrganizacion`
--
ALTER TABLE `UsuarioOrganizacion`
  ADD CONSTRAINT `fk_organizacion` FOREIGN KEY (`idOrganizacion`) REFERENCES `Organizacion` (`idOrganizacion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Voluntario`
--
ALTER TABLE `Voluntario`
  ADD CONSTRAINT `Voluntario_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `Usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
