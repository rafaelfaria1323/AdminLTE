-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Ago-2021 às 00:02
-- Versão do servidor: 10.4.19-MariaDB
-- versão do PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bd_requisicoes_esco`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ano_letivo`
--

CREATE TABLE `ano_letivo` (
  `id` int(11) NOT NULL,
  `descricao_ano_letivo` varchar(100) NOT NULL,
  `id_estado_ano_letivo` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ano_letivo`
--

INSERT INTO `ano_letivo` (`id`, `descricao_ano_letivo`, `id_estado_ano_letivo`) VALUES
(1, '2020/2021', 1),
(2, '2021/2022', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas_compras`
--

CREATE TABLE `areas_compras` (
  `id` int(11) NOT NULL,
  `descricao_area_compra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `areas_compras`
--

INSERT INTO `areas_compras` (`id`, `descricao_area_compra`) VALUES
(1, 'Publicidade'),
(2, 'Informática');

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_setor`
--

CREATE TABLE `area_setor` (
  `id` int(11) NOT NULL,
  `id_area_compra` int(11) NOT NULL,
  `id_setor_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `area_setor`
--

INSERT INTO `area_setor` (`id`, `id_area_compra`, `id_setor_compra`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 3),
(4, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cacifos`
--

CREATE TABLE `cacifos` (
  `id` int(11) NOT NULL,
  `id_proprio` int(11) NOT NULL,
  `id_piso` int(11) NOT NULL,
  `id_estado_cacifo` int(11) NOT NULL DEFAULT 1,
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cacifos`
--

INSERT INTO `cacifos` (`id`, `id_proprio`, `id_piso`, `id_estado_cacifo`, `id_status`) VALUES
(34, 1, 1, 1, 1),
(35, 2, 1, 1, 1),
(36, 3, 1, 1, 1),
(37, 4, 1, 1, 1),
(38, 5, 1, 1, 1),
(39, 6, 1, 1, 1),
(40, 7, 1, 1, 1),
(41, 8, 1, 1, 1),
(42, 9, 1, 1, 1),
(43, 10, 1, 1, 1),
(44, 11, 1, 1, 1),
(45, 12, 1, 1, 1),
(46, 13, 1, 1, 1),
(47, 14, 1, 1, 1),
(48, 15, 1, 1, 1),
(49, 16, 1, 1, 1),
(50, 17, 1, 1, 1),
(51, 18, 1, 1, 1),
(52, 19, 1, 1, 1),
(53, 20, 1, 1, 1),
(54, 21, 1, 1, 1),
(55, 22, 1, 1, 1),
(56, 23, 1, 1, 1),
(57, 24, 1, 1, 1),
(58, 25, 1, 1, 1),
(59, 26, 1, 1, 1),
(60, 27, 1, 1, 1),
(61, 28, 1, 1, 1),
(62, 29, 1, 1, 1),
(63, 30, 1, 1, 1),
(64, 31, 1, 1, 1),
(65, 32, 1, 1, 1),
(66, 33, 1, 1, 1),
(67, 34, 1, 1, 1),
(68, 35, 1, 1, 1),
(69, 36, 1, 1, 1),
(70, 37, 1, 1, 1),
(71, 38, 1, 1, 1),
(72, 39, 1, 1, 1),
(73, 40, 1, 1, 1),
(74, 41, 1, 1, 1),
(75, 42, 1, 1, 1),
(76, 43, 1, 1, 1),
(77, 44, 1, 1, 1),
(78, 45, 1, 1, 1),
(79, 46, 1, 1, 1),
(80, 47, 1, 1, 1),
(81, 48, 1, 1, 1),
(82, 49, 1, 1, 1),
(83, 50, 1, 1, 1),
(84, 51, 1, 1, 1),
(85, 52, 1, 1, 1),
(86, 53, 1, 1, 1),
(87, 54, 1, 1, 1),
(88, 55, 1, 1, 1),
(89, 56, 1, 1, 1),
(90, 57, 1, 1, 1),
(91, 58, 1, 1, 1),
(92, 59, 1, 1, 1),
(93, 60, 1, 1, 1),
(94, 61, 1, 1, 1),
(95, 62, 1, 1, 1),
(96, 63, 1, 1, 1),
(97, 64, 1, 1, 1),
(98, 65, 1, 1, 1),
(99, 66, 1, 1, 1),
(100, 67, 1, 1, 1),
(101, 68, 1, 1, 1),
(102, 69, 1, 1, 1),
(103, 70, 1, 1, 1),
(104, 71, 1, 1, 1),
(105, 72, 1, 1, 1),
(106, 73, 1, 1, 1),
(107, 74, 1, 1, 1),
(108, 75, 1, 1, 1),
(109, 76, 1, 1, 1),
(110, 77, 1, 1, 1),
(111, 78, 1, 1, 1),
(112, 79, 1, 1, 1),
(113, 80, 1, 1, 1),
(114, 81, 1, 1, 1),
(115, 82, 1, 1, 1),
(116, 1, 2, 1, 1),
(117, 2, 2, 1, 1),
(118, 3, 2, 1, 1),
(119, 4, 2, 1, 1),
(120, 5, 2, 1, 1),
(121, 6, 2, 1, 1),
(122, 7, 2, 1, 1),
(123, 8, 2, 1, 1),
(124, 9, 2, 1, 1),
(125, 10, 2, 1, 1),
(126, 11, 2, 1, 1),
(127, 12, 2, 1, 1),
(128, 13, 2, 1, 1),
(129, 14, 2, 1, 1),
(130, 15, 2, 1, 1),
(131, 16, 2, 1, 1),
(132, 17, 2, 1, 1),
(133, 18, 2, 1, 1),
(134, 19, 2, 1, 1),
(135, 20, 2, 1, 1),
(136, 21, 2, 1, 1),
(137, 22, 2, 1, 1),
(138, 23, 2, 1, 1),
(139, 24, 2, 1, 1),
(140, 25, 2, 1, 1),
(141, 26, 2, 1, 1),
(142, 27, 2, 1, 1),
(143, 28, 2, 1, 1),
(144, 29, 2, 1, 1),
(145, 30, 2, 1, 1),
(146, 31, 2, 1, 1),
(147, 32, 2, 1, 1),
(148, 33, 2, 1, 1),
(149, 34, 2, 1, 1),
(150, 35, 2, 1, 1),
(151, 36, 2, 1, 1),
(152, 93, 2, 1, 1),
(153, 94, 2, 1, 1),
(154, 95, 2, 1, 1),
(155, 96, 2, 1, 1),
(156, 97, 2, 1, 1),
(157, 98, 2, 1, 1),
(158, 99, 2, 1, 1),
(159, 100, 2, 1, 1),
(160, 101, 2, 1, 1),
(161, 102, 2, 1, 1),
(162, 103, 2, 1, 1),
(163, 104, 2, 1, 1),
(164, 105, 2, 1, 1),
(165, 106, 2, 1, 1),
(166, 37, 3, 1, 1),
(167, 38, 3, 1, 1),
(168, 39, 3, 1, 1),
(169, 40, 3, 1, 1),
(170, 41, 3, 1, 1),
(171, 42, 3, 1, 1),
(172, 43, 3, 1, 1),
(173, 44, 3, 1, 1),
(174, 45, 3, 1, 1),
(175, 46, 3, 1, 1),
(176, 47, 3, 1, 1),
(177, 48, 3, 1, 1),
(178, 49, 3, 1, 1),
(179, 50, 3, 1, 1),
(180, 51, 3, 1, 1),
(181, 52, 3, 1, 1),
(182, 53, 3, 1, 1),
(183, 54, 3, 1, 1),
(184, 55, 3, 1, 1),
(185, 56, 3, 1, 1),
(186, 57, 3, 1, 1),
(187, 58, 3, 1, 1),
(188, 59, 3, 1, 1),
(189, 60, 3, 1, 1),
(190, 61, 3, 1, 1),
(191, 62, 3, 1, 1),
(192, 63, 3, 1, 1),
(193, 64, 3, 1, 1),
(194, 65, 3, 1, 1),
(195, 66, 3, 1, 1),
(196, 67, 3, 1, 1),
(197, 68, 3, 1, 1),
(198, 69, 3, 1, 1),
(199, 70, 3, 1, 1),
(200, 71, 3, 1, 1),
(201, 72, 3, 1, 1),
(202, 73, 3, 1, 1),
(203, 74, 3, 1, 1),
(204, 75, 3, 1, 1),
(205, 76, 3, 1, 1),
(206, 77, 3, 1, 1),
(207, 78, 3, 1, 1),
(208, 79, 3, 1, 1),
(209, 80, 3, 1, 1),
(210, 81, 3, 1, 1),
(211, 82, 3, 1, 1),
(212, 83, 3, 1, 1),
(213, 84, 3, 1, 1),
(214, 85, 3, 1, 1),
(215, 86, 3, 1, 1),
(216, 87, 3, 1, 1),
(217, 88, 3, 1, 1),
(218, 89, 3, 1, 1),
(219, 90, 3, 1, 1),
(220, 91, 3, 1, 1),
(221, 92, 3, 1, 1),
(222, 107, 3, 1, 1),
(223, 108, 3, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cacifo_piso`
--

CREATE TABLE `cacifo_piso` (
  `id` int(11) NOT NULL,
  `descricao_cacifo_piso` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cacifo_piso`
--

INSERT INTO `cacifo_piso` (`id`, `descricao_cacifo_piso`) VALUES
(1, '0'),
(2, '2'),
(3, '3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias_materiais`
--

CREATE TABLE `categorias_materiais` (
  `id` int(11) NOT NULL,
  `descricao_categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `categorias_materiais`
--

INSERT INTO `categorias_materiais` (`id`, `descricao_categoria`) VALUES
(1, 'Centro de Recursos'),
(2, 'Manutenção');

-- --------------------------------------------------------

--
-- Estrutura da tabela `decisoes_req`
--

CREATE TABLE `decisoes_req` (
  `id` int(11) NOT NULL,
  `descricao_decisao_req` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `decisoes_req`
--

INSERT INTO `decisoes_req` (`id`, `descricao_decisao_req`) VALUES
(1, 'Aprovado'),
(2, 'Recusado'),
(3, 'Pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_ano_letivo`
--

CREATE TABLE `estados_ano_letivo` (
  `id` int(11) NOT NULL,
  `descricao_estado_ano_letivo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_ano_letivo`
--

INSERT INTO `estados_ano_letivo` (`id`, `descricao_estado_ano_letivo`) VALUES
(1, 'Terminado'),
(2, 'Ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_cacifos`
--

CREATE TABLE `estados_cacifos` (
  `id` int(11) NOT NULL,
  `descricao_estado_cacifo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_cacifos`
--

INSERT INTO `estados_cacifos` (`id`, `descricao_estado_cacifo`) VALUES
(1, 'Disponível'),
(2, 'Ocupado'),
(3, 'Avariado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_cacifos_delete`
--

CREATE TABLE `estados_cacifos_delete` (
  `id` int(11) NOT NULL,
  `descricao_estado_delete_cacifo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_cacifos_delete`
--

INSERT INTO `estados_cacifos_delete` (`id`, `descricao_estado_delete_cacifo`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_dinheiro_cacifo`
--

CREATE TABLE `estados_dinheiro_cacifo` (
  `id` int(11) NOT NULL,
  `descricao_estado_dinheiro_cacifo` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_dinheiro_cacifo`
--

INSERT INTO `estados_dinheiro_cacifo` (`id`, `descricao_estado_dinheiro_cacifo`) VALUES
(1, 'Sim'),
(2, 'Não');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_liq_req_cacifos`
--

CREATE TABLE `estados_liq_req_cacifos` (
  `id` int(11) NOT NULL,
  `descricao_estado_req_cacifos` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_liq_req_cacifos`
--

INSERT INTO `estados_liq_req_cacifos` (`id`, `descricao_estado_req_cacifos`) VALUES
(1, 'Liquidado'),
(2, 'Por Liquidar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_materiais`
--

CREATE TABLE `estados_materiais` (
  `id` int(11) NOT NULL,
  `descricao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_materiais`
--

INSERT INTO `estados_materiais` (`id`, `descricao`) VALUES
(1, 'Disponível'),
(3, 'Avariado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_materiais_delete`
--

CREATE TABLE `estados_materiais_delete` (
  `id` int(11) NOT NULL,
  `descricao_estado_material_delete` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_materiais_delete`
--

INSERT INTO `estados_materiais_delete` (`id`, `descricao_estado_material_delete`) VALUES
(1, 'Active'),
(2, 'Inactive');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_req_cacifos`
--

CREATE TABLE `estados_req_cacifos` (
  `id` int(11) NOT NULL,
  `descricao_estado_req_cacifos_` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_req_cacifos`
--

INSERT INTO `estados_req_cacifos` (`id`, `descricao_estado_req_cacifos_`) VALUES
(1, 'Ativa'),
(2, 'Finalizada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_req_compras`
--

CREATE TABLE `estados_req_compras` (
  `id` int(11) NOT NULL,
  `descricao_estado_req_compras` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_req_compras`
--

INSERT INTO `estados_req_compras` (`id`, `descricao_estado_req_compras`) VALUES
(1, 'Ativa'),
(2, 'Finalizada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estados_req_materiais`
--

CREATE TABLE `estados_req_materiais` (
  `id` int(11) NOT NULL,
  `descricao_estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `estados_req_materiais`
--

INSERT INTO `estados_req_materiais` (`id`, `descricao_estado`) VALUES
(1, 'Ativa'),
(2, 'Finalizada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id` int(11) NOT NULL,
  `id_proprio` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `id_estado` int(11) NOT NULL DEFAULT 1,
  `id_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id`, `id_proprio`, `id_tipo`, `id_estado`, `id_status`) VALUES
(71, 1, 19, 1, 1),
(72, 2, 19, 3, 2),
(73, 3, 19, 1, 1),
(74, 4, 19, 1, 1),
(75, 5, 19, 1, 1),
(76, 6, 19, 1, 1),
(77, 7, 19, 1, 1),
(78, 8, 19, 1, 1),
(79, 9, 19, 1, 1),
(80, 10, 19, 1, 1),
(81, 11, 19, 1, 1),
(82, 12, 19, 1, 1),
(83, 13, 19, 1, 1),
(84, 14, 19, 1, 1),
(85, 15, 19, 1, 1),
(86, 1, 18, 1, 1),
(87, 2, 18, 1, 1),
(88, 3, 18, 1, 1),
(89, 4, 18, 1, 1),
(90, 5, 18, 1, 1),
(91, 6, 18, 1, 1),
(92, 7, 18, 1, 1),
(93, 8, 18, 1, 1),
(94, 9, 18, 1, 1),
(95, 10, 18, 1, 1),
(96, 11, 18, 1, 1),
(97, 12, 18, 1, 1),
(98, 13, 18, 1, 1),
(99, 14, 18, 1, 1),
(100, 15, 18, 1, 1),
(101, 16, 18, 1, 1),
(102, 17, 18, 1, 1),
(103, 18, 18, 1, 1),
(104, 19, 18, 1, 1),
(105, 20, 18, 1, 1),
(106, 21, 18, 1, 1),
(107, 22, 18, 1, 1),
(108, 23, 18, 1, 1),
(109, 24, 18, 1, 1),
(110, 25, 18, 1, 1),
(111, 26, 18, 1, 1),
(112, 27, 18, 1, 1),
(113, 28, 18, 1, 1),
(114, 29, 18, 1, 1),
(115, 30, 18, 1, 1),
(116, 31, 18, 1, 1),
(117, 32, 18, 1, 1),
(118, 1, 20, 1, 1),
(119, 2, 20, 1, 1),
(120, 3, 20, 1, 1),
(121, 4, 20, 1, 1),
(122, 5, 20, 1, 1),
(123, 6, 20, 1, 1),
(124, 7, 20, 1, 1),
(125, 8, 20, 1, 1),
(126, 9, 20, 1, 1),
(127, 10, 20, 1, 1),
(128, 11, 20, 1, 1),
(129, 12, 20, 1, 1),
(130, 1, 21, 1, 1),
(131, 2, 21, 1, 1),
(132, 3, 21, 1, 1),
(133, 4, 21, 1, 1),
(134, 5, 21, 1, 1),
(135, 6, 21, 1, 1),
(136, 7, 21, 1, 1),
(137, 8, 21, 1, 1),
(138, 9, 21, 1, 1),
(139, 10, 21, 1, 1),
(140, 11, 21, 1, 1),
(141, 12, 21, 1, 1),
(142, 13, 21, 1, 1),
(145, 14, 21, 1, 1),
(149, 1, 23, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `req_cacifos`
--

CREATE TABLE `req_cacifos` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_requisitante` varchar(30) NOT NULL,
  `id_parceiro` varchar(100) DEFAULT NULL,
  `id_cacifo` int(11) NOT NULL,
  `id_ano_letivo` int(11) NOT NULL,
  `id_estado_req` int(11) NOT NULL DEFAULT 2,
  `id_estado_req_cacifo` int(11) NOT NULL DEFAULT 1,
  `id_estado_dinheiro_cacifo` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `req_compras`
--

CREATE TABLE `req_compras` (
  `id` int(11) NOT NULL,
  `turma` varchar(15) NOT NULL,
  `pedido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pedido`)),
  `data_requerido` date NOT NULL,
  `data_requisicao` date NOT NULL,
  `data_decisao` date DEFAULT NULL,
  `data_devolver` date DEFAULT NULL,
  `atividade` varchar(50) DEFAULT NULL,
  `disciplina` varchar(100) DEFAULT NULL,
  `modulo` varchar(255) DEFAULT NULL,
  `id_requisitante` varchar(30) NOT NULL,
  `id_area` int(11) NOT NULL,
  `id_setor` int(11) NOT NULL,
  `id_decisao` int(11) NOT NULL DEFAULT 3,
  `id_devolvedor` varchar(50) DEFAULT NULL,
  `id_estado_req` int(11) NOT NULL DEFAULT 1,
  `id_ano_letivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `req_materiais`
--

CREATE TABLE `req_materiais` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `id_requisitante` varchar(30) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_estado_req` int(11) NOT NULL DEFAULT 1,
  `id_ano_letivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis_area`
--

CREATE TABLE `responsaveis_area` (
  `id` int(11) NOT NULL,
  `id_responsavel_area` varchar(30) NOT NULL,
  `id_area_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsaveis_area`
--

INSERT INTO `responsaveis_area` (`id`, `id_responsavel_area`, `id_area_material`) VALUES
(34, 'test', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis_cacifos`
--

CREATE TABLE `responsaveis_cacifos` (
  `id` int(11) NOT NULL,
  `id_responsavel` varchar(30) NOT NULL,
  `id_piso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsaveis_cacifos`
--

INSERT INTO `responsaveis_cacifos` (`id`, `id_responsavel`, `id_piso`) VALUES
(26, 'test', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis_compras`
--

CREATE TABLE `responsaveis_compras` (
  `id` int(11) NOT NULL,
  `id_responsavel` varchar(30) NOT NULL,
  `id_area_compras` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsaveis_compras`
--

INSERT INTO `responsaveis_compras` (`id`, `id_responsavel`, `id_area_compras`) VALUES
(6, 'test', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsaveis_site`
--

CREATE TABLE `responsaveis_site` (
  `id` int(11) NOT NULL,
  `id_responsavel_site` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `responsaveis_site`
--

INSERT INTO `responsaveis_site` (`id`, `id_responsavel_site`) VALUES
(8, 'test');

-- --------------------------------------------------------

--
-- Estrutura da tabela `setores_compras`
--

CREATE TABLE `setores_compras` (
  `id` int(11) NOT NULL,
  `descricao_setor_compra` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `setores_compras`
--

INSERT INTO `setores_compras` (`id`, `descricao_setor_compra`) VALUES
(1, 'Técnica'),
(2, 'Serviço Especial'),
(3, 'Almoço Pedagógico');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_materiais`
--

CREATE TABLE `tipo_materiais` (
  `id` int(11) NOT NULL,
  `descricao_materiais` varchar(100) NOT NULL,
  `id_categoria_material` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `tipo_materiais`
--

INSERT INTO `tipo_materiais` (`id`, `descricao_materiais`, `id_categoria_material`) VALUES
(18, 'Calculadora Gráfica', 1),
(19, 'Calculadora Científica', 1),
(20, 'Extensões', 1),
(21, 'Portáteis', 1),
(23, 'Prego', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens_req`
--

CREATE TABLE `tokens_req` (
  `id` int(11) NOT NULL,
  `id_requisicao` int(11) NOT NULL,
  `token` text NOT NULL,
  `usado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turmas_acesso`
--

CREATE TABLE `turmas_acesso` (
  `id` int(11) NOT NULL,
  `descricao_nome_turma` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` varchar(200) NOT NULL,
  `nome_user` varchar(50) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `user_departamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome_user`, `email_user`, `user_departamento`) VALUES
('test', 'Test User', 'test@test.com', 'T1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `ano_letivo`
--
ALTER TABLE `ano_letivo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_esatdo_ano_letivo` (`id_estado_ano_letivo`);

--
-- Índices para tabela `areas_compras`
--
ALTER TABLE `areas_compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `area_setor`
--
ALTER TABLE `area_setor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_area_compra` (`id_area_compra`),
  ADD KEY `id_setor_compra` (`id_setor_compra`);

--
-- Índices para tabela `cacifos`
--
ALTER TABLE `cacifos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_piso` (`id_piso`),
  ADD KEY `id_estado_cacifo` (`id_estado_cacifo`),
  ADD KEY `id_status_cacifos` (`id_status`);

--
-- Índices para tabela `cacifo_piso`
--
ALTER TABLE `cacifo_piso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `categorias_materiais`
--
ALTER TABLE `categorias_materiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `decisoes_req`
--
ALTER TABLE `decisoes_req`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_ano_letivo`
--
ALTER TABLE `estados_ano_letivo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_cacifos`
--
ALTER TABLE `estados_cacifos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_cacifos_delete`
--
ALTER TABLE `estados_cacifos_delete`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_dinheiro_cacifo`
--
ALTER TABLE `estados_dinheiro_cacifo`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_liq_req_cacifos`
--
ALTER TABLE `estados_liq_req_cacifos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_materiais`
--
ALTER TABLE `estados_materiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_materiais_delete`
--
ALTER TABLE `estados_materiais_delete`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_req_cacifos`
--
ALTER TABLE `estados_req_cacifos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_req_compras`
--
ALTER TABLE `estados_req_compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estados_req_materiais`
--
ALTER TABLE `estados_req_materiais`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo_material` (`id_tipo`),
  ADD KEY `id_estado_material` (`id_estado`),
  ADD KEY `id_status` (`id_status`);

--
-- Índices para tabela `req_cacifos`
--
ALTER TABLE `req_cacifos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cacifo` (`id_cacifo`),
  ADD KEY `id_parceiro_cacifo` (`id_parceiro`),
  ADD KEY `id_ano_letivo_cacifo` (`id_ano_letivo`),
  ADD KEY `id_estado_req_cacifo` (`id_estado_req`),
  ADD KEY `id_requisitante_cacifo` (`id_requisitante`),
  ADD KEY `id_estado_req_cacifos` (`id_estado_req_cacifo`),
  ADD KEY `id_estado_dinheiro_cacifo` (`id_estado_dinheiro_cacifo`);

--
-- Índices para tabela `req_compras`
--
ALTER TABLE `req_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_requisitante_compra` (`id_requisitante`),
  ADD KEY `id_devolvedor` (`id_devolvedor`),
  ADD KEY `id_decisao` (`id_decisao`),
  ADD KEY `id_area` (`id_area`),
  ADD KEY `id_setor` (`id_setor`),
  ADD KEY `id_estado` (`id_estado_req`),
  ADD KEY `id_ano` (`id_ano_letivo`);

--
-- Índices para tabela `req_materiais`
--
ALTER TABLE `req_materiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ano_letivo` (`id_ano_letivo`),
  ADD KEY `id_estado_req` (`id_estado_req`),
  ADD KEY `id_material` (`id_material`),
  ADD KEY `id_requisitante` (`id_requisitante`);

--
-- Índices para tabela `responsaveis_area`
--
ALTER TABLE `responsaveis_area`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_responsavel_area_material` (`id_area_material`),
  ADD KEY `id_responsavel_area` (`id_responsavel_area`);

--
-- Índices para tabela `responsaveis_cacifos`
--
ALTER TABLE `responsaveis_cacifos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_responsavel_cacifo` (`id_responsavel`),
  ADD KEY `id_piso_responsavel` (`id_piso`);

--
-- Índices para tabela `responsaveis_compras`
--
ALTER TABLE `responsaveis_compras`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_responsavel_compras` (`id_responsavel`),
  ADD KEY `id_area_compras` (`id_area_compras`);

--
-- Índices para tabela `responsaveis_site`
--
ALTER TABLE `responsaveis_site`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_responsavel_site` (`id_responsavel_site`);

--
-- Índices para tabela `setores_compras`
--
ALTER TABLE `setores_compras`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_materiais`
--
ALTER TABLE `tipo_materiais`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria_material`);

--
-- Índices para tabela `tokens_req`
--
ALTER TABLE `tokens_req`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_requisicao` (`id_requisicao`);

--
-- Índices para tabela `turmas_acesso`
--
ALTER TABLE `turmas_acesso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `ano_letivo`
--
ALTER TABLE `ano_letivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `areas_compras`
--
ALTER TABLE `areas_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `area_setor`
--
ALTER TABLE `area_setor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cacifos`
--
ALTER TABLE `cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=224;

--
-- AUTO_INCREMENT de tabela `cacifo_piso`
--
ALTER TABLE `cacifo_piso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categorias_materiais`
--
ALTER TABLE `categorias_materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `decisoes_req`
--
ALTER TABLE `decisoes_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estados_ano_letivo`
--
ALTER TABLE `estados_ano_letivo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_cacifos`
--
ALTER TABLE `estados_cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estados_cacifos_delete`
--
ALTER TABLE `estados_cacifos_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_dinheiro_cacifo`
--
ALTER TABLE `estados_dinheiro_cacifo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_liq_req_cacifos`
--
ALTER TABLE `estados_liq_req_cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_materiais`
--
ALTER TABLE `estados_materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `estados_materiais_delete`
--
ALTER TABLE `estados_materiais_delete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_req_cacifos`
--
ALTER TABLE `estados_req_cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_req_compras`
--
ALTER TABLE `estados_req_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `estados_req_materiais`
--
ALTER TABLE `estados_req_materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=150;

--
-- AUTO_INCREMENT de tabela `req_cacifos`
--
ALTER TABLE `req_cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de tabela `req_compras`
--
ALTER TABLE `req_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `req_materiais`
--
ALTER TABLE `req_materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT de tabela `responsaveis_area`
--
ALTER TABLE `responsaveis_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `responsaveis_cacifos`
--
ALTER TABLE `responsaveis_cacifos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `responsaveis_compras`
--
ALTER TABLE `responsaveis_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `responsaveis_site`
--
ALTER TABLE `responsaveis_site`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `setores_compras`
--
ALTER TABLE `setores_compras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `tipo_materiais`
--
ALTER TABLE `tipo_materiais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `tokens_req`
--
ALTER TABLE `tokens_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de tabela `turmas_acesso`
--
ALTER TABLE `turmas_acesso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ano_letivo`
--
ALTER TABLE `ano_letivo`
  ADD CONSTRAINT `id_esatdo_ano_letivo` FOREIGN KEY (`id_estado_ano_letivo`) REFERENCES `estados_ano_letivo` (`id`);

--
-- Limitadores para a tabela `area_setor`
--
ALTER TABLE `area_setor`
  ADD CONSTRAINT `id_area_compra` FOREIGN KEY (`id_area_compra`) REFERENCES `areas_compras` (`id`),
  ADD CONSTRAINT `id_setor_compra` FOREIGN KEY (`id_setor_compra`) REFERENCES `setores_compras` (`id`);

--
-- Limitadores para a tabela `cacifos`
--
ALTER TABLE `cacifos`
  ADD CONSTRAINT `id_estado_cacifo` FOREIGN KEY (`id_estado_cacifo`) REFERENCES `estados_cacifos` (`id`),
  ADD CONSTRAINT `id_piso` FOREIGN KEY (`id_piso`) REFERENCES `cacifo_piso` (`id`),
  ADD CONSTRAINT `id_status_cacifos` FOREIGN KEY (`id_status`) REFERENCES `estados_cacifos_delete` (`id`);

--
-- Limitadores para a tabela `materiais`
--
ALTER TABLE `materiais`
  ADD CONSTRAINT `id_estado_material` FOREIGN KEY (`id_estado`) REFERENCES `estados_materiais` (`id`),
  ADD CONSTRAINT `id_status` FOREIGN KEY (`id_status`) REFERENCES `estados_materiais_delete` (`id`),
  ADD CONSTRAINT `id_tipo_material` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `req_cacifos`
--
ALTER TABLE `req_cacifos`
  ADD CONSTRAINT `id_ano_letivo_cacifo` FOREIGN KEY (`id_ano_letivo`) REFERENCES `ano_letivo` (`id`),
  ADD CONSTRAINT `id_cacifo` FOREIGN KEY (`id_cacifo`) REFERENCES `cacifos` (`id`),
  ADD CONSTRAINT `id_estado_dinheiro_cacifo` FOREIGN KEY (`id_estado_dinheiro_cacifo`) REFERENCES `estados_dinheiro_cacifo` (`id`),
  ADD CONSTRAINT `id_estado_req_cacifo` FOREIGN KEY (`id_estado_req`) REFERENCES `estados_liq_req_cacifos` (`id`),
  ADD CONSTRAINT `id_estado_req_cacifos` FOREIGN KEY (`id_estado_req_cacifo`) REFERENCES `estados_req_cacifos` (`id`),
  ADD CONSTRAINT `id_parceiro` FOREIGN KEY (`id_parceiro`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `id_requisitante_cacifo` FOREIGN KEY (`id_requisitante`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `req_compras`
--
ALTER TABLE `req_compras`
  ADD CONSTRAINT `id_ano` FOREIGN KEY (`id_ano_letivo`) REFERENCES `ano_letivo` (`id`),
  ADD CONSTRAINT `id_area` FOREIGN KEY (`id_area`) REFERENCES `areas_compras` (`id`),
  ADD CONSTRAINT `id_decisao` FOREIGN KEY (`id_decisao`) REFERENCES `decisoes_req` (`id`),
  ADD CONSTRAINT `id_estado` FOREIGN KEY (`id_estado_req`) REFERENCES `estados_req_compras` (`id`),
  ADD CONSTRAINT `id_requisitante_compra` FOREIGN KEY (`id_requisitante`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `id_setor` FOREIGN KEY (`id_setor`) REFERENCES `setores_compras` (`id`);

--
-- Limitadores para a tabela `req_materiais`
--
ALTER TABLE `req_materiais`
  ADD CONSTRAINT `id_ano_letivo` FOREIGN KEY (`id_ano_letivo`) REFERENCES `ano_letivo` (`id`),
  ADD CONSTRAINT `id_estado_req` FOREIGN KEY (`id_estado_req`) REFERENCES `estados_req_materiais` (`id`),
  ADD CONSTRAINT `id_material` FOREIGN KEY (`id_material`) REFERENCES `materiais` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_requisitante` FOREIGN KEY (`id_requisitante`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `responsaveis_area`
--
ALTER TABLE `responsaveis_area`
  ADD CONSTRAINT `id_responsavel_area` FOREIGN KEY (`id_responsavel_area`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `id_responsavel_area_material` FOREIGN KEY (`id_area_material`) REFERENCES `categorias_materiais` (`id`);

--
-- Limitadores para a tabela `responsaveis_cacifos`
--
ALTER TABLE `responsaveis_cacifos`
  ADD CONSTRAINT `id_piso_responsavel` FOREIGN KEY (`id_piso`) REFERENCES `cacifo_piso` (`id`),
  ADD CONSTRAINT `id_responsavel_cacifo` FOREIGN KEY (`id_responsavel`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `responsaveis_compras`
--
ALTER TABLE `responsaveis_compras`
  ADD CONSTRAINT `id_area_compras` FOREIGN KEY (`id_area_compras`) REFERENCES `areas_compras` (`id`),
  ADD CONSTRAINT `id_responsavel_compras` FOREIGN KEY (`id_responsavel`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `responsaveis_site`
--
ALTER TABLE `responsaveis_site`
  ADD CONSTRAINT `id_responsavel_site` FOREIGN KEY (`id_responsavel_site`) REFERENCES `users` (`id`);

--
-- Limitadores para a tabela `tipo_materiais`
--
ALTER TABLE `tipo_materiais`
  ADD CONSTRAINT `id_categoria` FOREIGN KEY (`id_categoria_material`) REFERENCES `categorias_materiais` (`id`);

--
-- Limitadores para a tabela `tokens_req`
--
ALTER TABLE `tokens_req`
  ADD CONSTRAINT `id_requisicao` FOREIGN KEY (`id_requisicao`) REFERENCES `req_compras` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
