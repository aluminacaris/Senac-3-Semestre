-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/09/2025 às 04:19
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `agendasenac2025`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `contatos`
--

CREATE TABLE `contatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `sociais` text DEFAULT NULL,
  `profissao` varchar(100) DEFAULT NULL,
  `dataNasc` date DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `ativo` enum('S','N') DEFAULT 'S',
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `contatos`
--

INSERT INTO `contatos` (`id`, `nome`, `endereco`, `email`, `telefone`, `sociais`, `profissao`, `dataNasc`, `foto`, `ativo`, `data_cadastro`, `usuario_id`) VALUES
(2, 'rafella', 'qweqwe', 'maibuk.apsenac@gmail.com', '12312312312', 'qweqwe', 'qweqwe', '1234-12-12', 'nao', 'S', '2025-09-17 23:02:20', 3),
(4, 'wi', 'sc da silva 12', 'wi@overwat', '12312312312', 'nao tem', 'juno', '1234-12-12', 'nao', 'S', '2025-09-18 00:04:37', 3);

-- --------------------------------------------------------

--
-- Estrutura para tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `nome`, `descricao`) VALUES
(1, 'contatos.ver', 'Visualizar contatos'),
(2, 'contatos.criar', 'Criar contatos'),
(3, 'contatos.editar', 'Editar contatos'),
(4, 'contatos.excluir', 'Excluir contatos'),
(5, 'usuarios.ver', 'Visualizar usuários'),
(6, 'usuarios.criar', 'Criar usuários'),
(7, 'usuarios.editar', 'Editar usuários'),
(8, 'usuarios.excluir', 'Excluir usuários'),
(9, 'admin', 'Acesso total ao sistema');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `permissao` varchar(50) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ultimo_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `permissao`, `ativo`, `data_criacao`, `data_atualizacao`, `ultimo_login`) VALUES
(2, 'Administrador', 'admin@agenda.com', '$2y$10$Y.92V4L.H89C/qGyMNcbUu64tEfkLUa45JsZS6xyk.hUpneomUP8a', 'super', 1, '2025-09-17 23:16:32', '2025-09-18 02:02:56', '2025-09-18 04:02:56'),
(3, 'rafis', 'rafis@senac', '$2y$10$EuCa6EtZv49gMsJVztVly.EwKpMa6fePB5Kjgq7BVxhrg9dWu.FKa', 'user', 1, '2025-09-17 23:18:50', '2025-09-18 02:03:14', '2025-09-18 04:01:57'),
(4, 'benio', 'benio@gmail.com', '$2y$10$J2e6fQcp6wWM5Kn0Q/BL/eRbxNM95D6Uq9/ZK.R.OmCJH2SgbL4Lm', 'user', 1, '2025-09-17 23:50:34', '2025-09-18 01:50:36', '2025-09-18 03:50:36'),
(6, 'rodrigo', 'rodrigo@senac', '$2y$10$mrjTduxurh780iAaASDCmOl70/JFxhGltuINJnvP6xeexNJokQgUO', 'user', 1, '2025-09-18 00:21:35', '2025-09-18 00:21:35', NULL),
(7, 'pao', 'queijo@presunto', '$2y$10$5JG6FzucbKZSVfbnLbyaCejBXCxfdFucYnpsmuCKF3jiXbVB0GaCW', 'user', 1, '2025-09-18 00:37:44', '2025-09-18 00:39:29', NULL),
(8, 'teste', 'teste@teste', '$2y$10$x6witlIoP2yC3HJ3NOknQeQZrhRmq5g3gl.IJm/4bK4X3vkEXtQZC', 'user', 1, '2025-09-18 02:03:41', '2025-09-18 02:03:51', '2025-09-18 04:03:51');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_permissoes`
--

CREATE TABLE `usuario_permissoes` (
  `usuario_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `contatos`
--
ALTER TABLE `contatos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `usuario_permissoes`
--
ALTER TABLE `usuario_permissoes`
  ADD PRIMARY KEY (`usuario_id`,`permissao_id`),
  ADD KEY `permissao_id` (`permissao_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `contatos`
--
ALTER TABLE `contatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `usuario_permissoes`
--
ALTER TABLE `usuario_permissoes`
  ADD CONSTRAINT `usuario_permissoes_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`),
  ADD CONSTRAINT `usuario_permissoes_ibfk_2` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
