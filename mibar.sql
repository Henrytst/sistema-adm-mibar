-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Out-2023 às 18:20
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `mibar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `redes` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `texto` mediumtext NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `coqueteis`
--

CREATE TABLE `coqueteis` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `baseAlcoolica` varchar(255) NOT NULL,
  `origem` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `receita` mediumtext NOT NULL,
  `historia` mediumtext NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `quantidade` varchar(255) NOT NULL,
  `indisponiveis` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `texto` mediumtext NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `precoMedio` decimal(10,2) NOT NULL,
  `fornecedor` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `produto` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(255) NOT NULL,
  `nome_arquivo` varchar(255) NOT NULL,
  `diretorio` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nascimento` varchar(50) NOT NULL,
  `idade` varchar(50) NOT NULL,
  `sexo` varchar(50) NOT NULL,
  `rg` varchar(50) NOT NULL,
  `cpf` varchar(50) DEFAULT NULL,
  `tatuagem` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `cb` varchar(50) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `camisa` varchar(50) DEFAULT NULL,
  `calca` varchar(50) NOT NULL,
  `terno` varchar(50) NOT NULL,
  `calcado` varchar(50) NOT NULL,
  `peso` varchar(50) NOT NULL,
  `altura` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `funcao` varchar(50) NOT NULL,
  `idiomas` varchar(255) DEFAULT NULL,
  `escolaridade` varchar(255) NOT NULL,
  `disponibilidade` varchar(255) NOT NULL,
  `observacoes` mediumtext NOT NULL,
  `complemento` mediumtext NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `preparo`
--

CREATE TABLE `preparo` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `texto` mediumtext NOT NULL,
  `mo` decimal(10,2) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` varchar(255) DEFAULT NULL,
  `update_at` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `coqueteis`
--
ALTER TABLE `coqueteis`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `preparo`
--
ALTER TABLE `preparo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `coqueteis`
--
ALTER TABLE `coqueteis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `preparo`
--
ALTER TABLE `preparo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
