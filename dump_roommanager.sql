-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Abr 15, 2015 as 08:54 AM
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `roommanager`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_sala` int(5) DEFAULT NULL,
  `id_usuario` int(5) DEFAULT NULL,
  `data_age` date DEFAULT NULL,
  `hora_age` time DEFAULT NULL,
  `data_uso` date DEFAULT NULL,
  `hora_uso` time DEFAULT NULL,
  `tempo_uso` int(2) DEFAULT NULL,
  `motivo` varchar(140) DEFAULT NULL,
  `obs` varchar(280) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_sala` (`id_sala`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `agenda`
--

INSERT INTO `agenda` (`id`, `id_sala`, `id_usuario`, `data_age`, `hora_age`, `data_uso`, `hora_uso`, `tempo_uso`, `motivo`, `obs`) VALUES
(1, 1, 1, '2014-10-20', '19:00:00', '2014-10-20', '20:30:00', 1, 'Aula', 'Aula de Programação'),
(4, 2, 1, '2014-11-12', '20:16:00', '2014-11-12', '10:45:00', 2, 'teste', 'teste'),
(5, 2, 1, '2014-11-12', '20:16:00', '2014-11-12', '11:30:00', 0, 'teste', 'teste'),
(7, 3, 1, '2014-11-12', '20:23:00', '2014-11-12', '09:00:00', 2, 'apresentação', ''),
(8, 3, 1, '2014-11-12', '20:23:00', '2014-11-12', '10:00:00', 0, 'apresentação', ''),
(9, 1, 1, '2014-11-12', '20:25:00', '2014-11-13', '07:30:00', 2, 'aula de android', ''),
(10, 1, 1, '2014-11-12', '20:25:00', '2014-11-13', '08:15:00', 0, 'aula de android', ''),
(11, 3, 1, '2014-11-12', '20:27:00', '2014-11-13', '10:00:00', 3, 'apresentação TCC', 'TSI 5AN'),
(12, 3, 1, '2014-11-12', '20:27:00', '2014-11-13', '10:45:00', 0, 'apresentação TCC', 'TSI 5AN'),
(13, 3, 1, '2014-11-12', '20:27:00', '2014-11-13', '11:30:00', 0, 'apresentação TCC', 'TSI 5AN'),
(14, 2, 1, '2014-11-12', '20:31:00', '2014-11-13', '13:30:00', 1, 'aula', ''),
(15, 1, 1, '2014-12-02', '22:23:00', '2014-12-01', '19:00:00', 3, 'teste de agenda', 'obs'),
(16, 1, 1, '2014-12-02', '22:23:00', '2014-12-01', '19:45:00', 0, 'teste de agenda', 'obs'),
(17, 1, 1, '2014-12-02', '22:23:00', '2014-12-01', '20:30:00', 0, 'teste de agenda', 'obs'),
(19, 1, 1, '2014-12-30', '14:43:00', '2014-12-30', '19:00:00', 2, 'teste', 'novo layout'),
(20, 1, 1, '2014-12-30', '14:43:00', '2014-12-30', '19:45:00', 0, 'teste', 'novo layout'),
(21, 1, 1, '2015-01-05', '10:45:00', '2015-01-05', '09:00:00', 2, 'teste', 'teste'),
(22, 1, 1, '2015-01-05', '10:45:00', '2015-01-05', '10:00:00', 0, 'teste', 'teste'),
(23, 1, 1, '2015-03-23', '21:00:00', '2015-03-23', '09:00:00', 2, 'aula PDM', ''),
(24, 1, 1, '2015-03-23', '21:00:00', '2015-03-23', '10:00:00', 0, 'aula PDM', '');

-- --------------------------------------------------------

--
-- Estrutura da tabela `blocos`
--

CREATE TABLE IF NOT EXISTS `blocos` (
  `id` int(5) NOT NULL,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `blocos`
--

INSERT INTO `blocos` (`id`, `descricao`) VALUES
(1, 'Bloco 1'),
(2, 'Bloco 2'),
(3, 'Bloco 3'),
(4, 'Bloco 4'),
(5, 'Bloco 5'),
(6, 'Bloco 6');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE IF NOT EXISTS `estoque` (
  `id_patrimonio` int(5) NOT NULL,
  `saldo_atual` int(5) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id_patrimonio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estoque`
--

INSERT INTO `estoque` (`id_patrimonio`, `saldo_atual`, `data`, `hora`) VALUES
(1, 2, '2015-03-09', '12:40:00'),
(4, 7, '2015-03-11', '19:29:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `horario`
--

CREATE TABLE IF NOT EXISTS `horario` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `horario` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `horario`
--

INSERT INTO `horario` (`id`, `horario`) VALUES
(1, '07:30:00'),
(2, '08:15:00'),
(3, '09:00:00'),
(4, '10:00:00'),
(5, '10:45:00'),
(6, '11:30:00'),
(7, '13:30:00'),
(8, '14:15:00'),
(9, '15:00:00'),
(10, '16:00:00'),
(11, '16:45:00'),
(12, '17:30:00'),
(13, '18:15:00'),
(14, '19:00:00'),
(15, '19:45:00'),
(16, '20:30:00'),
(17, '21:30:00'),
(18, '22:15:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

CREATE TABLE IF NOT EXISTS `movimentacoes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) DEFAULT NULL,
  `id_patrimonio` int(5) DEFAULT NULL,
  `quantidade` int(5) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `operador` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_patrimonio` (`id_patrimonio`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `tipo`, `id_patrimonio`, `quantidade`, `obs`, `data`, `hora`, `operador`) VALUES
(8, 'entrada', 1, 3, 'teste movimentação', '2015-03-09', '12:39:00', NULL),
(9, 'saida', 1, 1, 'teste saída', '2015-03-09', '12:40:00', NULL),
(10, 'entrada', 4, 8, '8 monitores LG comprados ontem', '2015-03-11', '19:24:00', NULL),
(11, 'saida', 4, 1, 'foi para conserto', '2015-03-11', '19:29:00', 'Lucas Leote');

-- --------------------------------------------------------

--
-- Estrutura da tabela `patrimonios`
--

CREATE TABLE IF NOT EXISTS `patrimonios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `id_tipo` int(5) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `patrimonios`
--

INSERT INTO `patrimonios` (`id`, `nome`, `id_tipo`, `obs`, `data`, `hora`) VALUES
(1, 'Positivo All In One', 1, 'teste', '2015-02-25', '22:18:00'),
(4, 'Monitor', 2, 'alterado', '2015-03-11', '19:24:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `recursos`
--

INSERT INTO `recursos` (`id`, `nome`) VALUES
(1, 'Quadro branco'),
(2, 'Projetor'),
(3, 'Sistema de som'),
(4, 'Computador'),
(5, 'Mesa para reunião'),
(6, 'Bancada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `salarecurso`
--

CREATE TABLE IF NOT EXISTS `salarecurso` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `id_recurso` int(5) DEFAULT NULL,
  `id_sala` int(5) DEFAULT NULL,
  `quantidade` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_recurso` (`id_recurso`),
  KEY `id_sala` (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Extraindo dados da tabela `salarecurso`
--

INSERT INTO `salarecurso` (`id`, `id_recurso`, `id_sala`, `quantidade`) VALUES
(4, 2, 11, 1),
(5, 3, 11, 1),
(6, 4, 11, 1),
(10, 4, 12, 1),
(11, 5, 12, 1),
(12, 1, 1, 1),
(13, 2, 1, 1),
(14, 1, 2, 1),
(15, 2, 2, 1),
(16, 4, 2, 1),
(17, 2, 3, 1),
(18, 3, 3, 1),
(19, 4, 3, 1),
(22, 4, 13, 30),
(28, 4, 14, 15),
(40, 4, 16, 1),
(46, 4, 17, 30),
(52, 2, 19, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `salas`
--

CREATE TABLE IF NOT EXISTS `salas` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `id_tipo` int(5) DEFAULT NULL,
  `capacidade` int(5) DEFAULT NULL,
  `id_bloco` int(5) DEFAULT NULL,
  `obs` varchar(140) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`),
  KEY `id_bloco` (`id_bloco`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `salas`
--

INSERT INTO `salas` (`id`, `nome`, `id_tipo`, `capacidade`, `id_bloco`, `obs`, `data`, `hora`) VALUES
(1, 'Sala de aula 1', 1, 30, 1, 'sala de aula 1 do bloco 1', '2014-10-13', '20:09:00'),
(2, 'Laboratório 1', 2, 25, 1, 'laboratório 1 do bloco 1', '2014-10-13', '20:23:00'),
(3, 'Auditório', 3, 200, 1, 'teste', '2014-10-21', '19:43:00'),
(11, 'Mini auditório', 3, 55, 2, '', '2015-03-19', '16:59:00'),
(12, 'Sala de reunião 1', 4, 8, 3, '', '2015-03-19', '17:03:00'),
(13, 'teste lucas', 2, 35, 3, 'teste lucas 01042015', '2015-04-01', '20:49:00'),
(14, 'teeeeste', 2, 23, 3, 'teste lucas 01042015', '2015-04-01', '20:51:00'),
(16, 'teste claiton', 2, 30, 4, 'teste 01042015', '2015-04-01', '21:07:00'),
(17, 'teste claiton 2', 2, 35, 5, 'teste claiton 2 01042015', '2015-04-01', '21:09:00'),
(19, 'sdadassadads', 3, 34, 3, 'la la la la la', '2015-04-01', '22:34:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_patrimonio`
--

CREATE TABLE IF NOT EXISTS `tipo_patrimonio` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  `obs` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tipo_patrimonio`
--

INSERT INTO `tipo_patrimonio` (`id`, `descricao`, `obs`) VALUES
(1, 'Computador', 'Computador completo'),
(2, 'Monitor', 'Monitor avulso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_sala`
--

CREATE TABLE IF NOT EXISTS `tipo_sala` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `tipo_sala`
--

INSERT INTO `tipo_sala` (`id`, `descricao`) VALUES
(1, 'Sala de aula'),
(2, 'Laboratório de informática'),
(3, 'Auditório'),
(4, 'Sala de reunião P'),
(5, 'Sala de reunião M'),
(6, 'Sala de reunião G'),
(7, 'Sala multiuso');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_usuario`
--

CREATE TABLE IF NOT EXISTS `tipo_usuario` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`id`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Professor'),
(3, 'Servidor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `telefone` varchar(12) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(15) DEFAULT NULL,
  `passwd` varchar(32) DEFAULT NULL,
  `obs` varchar(140) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `id_tipo` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_tipo` (`id_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `cpf`, `telefone`, `email`, `username`, `passwd`, `obs`, `data`, `hora`, `id_tipo`) VALUES
(1, 'Lucas Leote', '444.444.444-44', '(99)9999-999', 'leote.vasconcellos@gmail.com', 'lucas.leote', '698dc19d489c4e4db73e28a713eab07b', 'meu perfil', '2014-09-29', '21:56:00', 1),
(2, 'teste', '000.000.000-00', '(99)9999-999', 'teste@teste.com', 'teste', '698dc19d489c4e4db73e28a713eab07b', 'teste', '2014-09-30', '20:32:00', 2),
(3, 'Fulano', '666.666.666-66', '(51)1111-111', 'fulano@ifsul.com', 'fulano', 'b6be974ce0ae010e92a4fed999942ef5', 'alterado', '2014-09-30', '20:54:00', 2);

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `agenda`
--
ALTER TABLE `agenda`
  ADD CONSTRAINT `agenda_ibfk_1` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`),
  ADD CONSTRAINT `agenda_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Restrições para a tabela `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `estoque_ibfk_1` FOREIGN KEY (`id_patrimonio`) REFERENCES `patrimonios` (`id`);

--
-- Restrições para a tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD CONSTRAINT `movimentacoes_ibfk_1` FOREIGN KEY (`id_patrimonio`) REFERENCES `patrimonios` (`id`);

--
-- Restrições para a tabela `patrimonios`
--
ALTER TABLE `patrimonios`
  ADD CONSTRAINT `patrimonios_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_patrimonio` (`id`);

--
-- Restrições para a tabela `salarecurso`
--
ALTER TABLE `salarecurso`
  ADD CONSTRAINT `salarecurso_ibfk_1` FOREIGN KEY (`id_recurso`) REFERENCES `recursos` (`id`),
  ADD CONSTRAINT `salarecurso_ibfk_2` FOREIGN KEY (`id_sala`) REFERENCES `salas` (`id`);

--
-- Restrições para a tabela `salas`
--
ALTER TABLE `salas`
  ADD CONSTRAINT `salas_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_sala` (`id`),
  ADD CONSTRAINT `salas_ibfk_2` FOREIGN KEY (`id_bloco`) REFERENCES `blocos` (`id`);

--
-- Restrições para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_usuario` (`id`);
