-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 18-Nov-2021 às 23:41
-- Versão do servidor: 5.7.26
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `almoxarifado`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cli` int(11) NOT NULL AUTO_INCREMENT,
  `nome_cli` varchar(255) NOT NULL,
  PRIMARY KEY (`id_cli`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`id_cli`, `nome_cli`) VALUES
(5, 'Leilson');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `cnpj` varchar(50) DEFAULT NULL,
  `uf` varchar(3) DEFAULT NULL,
  `tipo_estabelecimento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `nome`, `cnpj`, `uf`, `tipo_estabelecimento`) VALUES
(1, 'Process', '54.916.283/0001-45', 'SP', 'Loja');

-- --------------------------------------------------------

--
-- Estrutura da tabela `grupos`
--

DROP TABLE IF EXISTS `grupos`;
CREATE TABLE IF NOT EXISTS `grupos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `grupos`
--

INSERT INTO `grupos` (`id`, `nome`) VALUES
(1, 'Material de InformÃ¡tica'),
(2, 'Material de EscritÃ³rio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
CREATE TABLE IF NOT EXISTS `movimentacoes` (
  `entrada` int(11) DEFAULT NULL,
<<<<<<< HEAD
  `saida` int(11) DEFAULT NULL,
  `devolucao` int(11) DEFAULT NULL
=======
  `saida` int(11) DEFAULT NULL
>>>>>>> bfa1ad08ce36367632172a80fa17a441ac4a7048
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`entrada`, `saida`) VALUES
(0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes_estoque`
--

DROP TABLE IF EXISTS `movimentacoes_estoque`;
CREATE TABLE IF NOT EXISTS `movimentacoes_estoque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `produto` int(11) DEFAULT NULL,
  `cliente` int(11) DEFAULT NULL,
  `quant_mov` decimal(10,0) DEFAULT NULL,
  `motivo` varchar(500) DEFAULT NULL,
  `data_mov` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `movimentacao` int(11) NOT NULL,
  `responsavel` varchar(80) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `produto_id_fk_mov` (`produto`) USING BTREE,
  KEY `cliente_id_fk_mov` (`cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `movimentacoes_estoque`
--

INSERT INTO `movimentacoes_estoque` (`id`, `produto`, `cliente`, `quant_mov`, `motivo`, `data_mov`, `movimentacao`, `responsavel`) VALUES
(4, 1, NULL, '1', 'compra', '2021-10-14 21:14:47', 0, 'admin'),
(9, 1, NULL, '9', 'compra', '2021-11-16 23:29:27', 0, 'admin'),
(10, 1, 5, '1', 'retirada', '2021-11-18 20:36:11', 1, 'admin');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) DEFAULT NULL,
  `quantidade` varchar(60) DEFAULT NULL,
  `unidade` varchar(60) DEFAULT NULL,
  `fornecedor` int(11) NOT NULL,
  `grupo` int(11) NOT NULL,
  `data_cadastro` datetime DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` datetime DEFAULT NULL,
  `responsavel` varchar(80) DEFAULT NULL,
  `valor_unidade` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`codigo`),
  KEY `fornecedor_id_fk_prod` (`fornecedor`) USING BTREE,
  KEY `grupo_id_fk_prod` (`grupo`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`codigo`, `descricao`, `quantidade`, `unidade`, `fornecedor`, `grupo`, `data_cadastro`, `data_alteracao`, `responsavel`, `valor_unidade`) VALUES
(1, 'Placa mÃ£e', '5', '    Unidade', 1, 1, '2021-09-23 22:46:25', NULL, 'admin', '0.03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(80) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `senha`) VALUES
(2, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `movimentacoes_estoque`
--
ALTER TABLE `movimentacoes_estoque`
  ADD CONSTRAINT `cliente_id_fk_mov` FOREIGN KEY (`cliente`) REFERENCES `clientes` (`id_cli`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `produto_id_fk_mov` FOREIGN KEY (`produto`) REFERENCES `produtos` (`codigo`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `fornecedor_id_fk_prod` FOREIGN KEY (`fornecedor`) REFERENCES `fornecedores` (`id`),
  ADD CONSTRAINT `grupo_id_fk_prod` FOREIGN KEY (`grupo`) REFERENCES `grupos` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
