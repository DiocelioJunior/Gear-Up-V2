-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/10/2023 às 04:57
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_item` varchar(255) NOT NULL,
  `data_validade` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id`, `usuario_id`, `nome_item`, `data_validade`, `status`) VALUES
(1, 1, 'Teste', '2023-09-21', 'Novo'),
(13, 2, 'Pão', '2023-11-23', '23'),
(22, 2, 'Teste 4', '2023-09-29', '1'),
(23, 2, 'Teste 4', '2023-10-03', '1'),
(31, 1, 'Teste 4', '2023-10-08', '1'),
(32, 1, 'Teste 1', '2023-10-08', '1'),
(33, 1, 'Teste 2', '2023-10-17', '1');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `telefone_pessoal` varchar(20) DEFAULT NULL,
  `numero_emergencia_1` varchar(20) DEFAULT NULL,
  `numero_emergencia_2` varchar(20) DEFAULT NULL,
  `endereco_casa` varchar(255) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`) VALUES
(1, 'Diow', 'jdiocelio@gmail.com', '$2y$10$C1d/MWiB.BDME/D.iU.WXOPFrM3h7xYGpURPV/W6Ty3vvxQar0sP.'),
(2, 'Karen', 'karen_fefa@hotmail.com', '$2y$10$kFs3cOc/oG4k6t/F1qB4jeij8rpxgnFK2owNcwiJWENSViLVKl9BC'),
(4, 'Teste', 'teste@gmail.com', '$2y$10$Rc3YLpQ7/k0yBE5boiv0mOMawk/B9Di81MjnnzRqUzHBsT4VtIpi2'),
(5, 'Naruto', 'konoha@gmail.com', '$2y$10$HPL2MPM7qNaol7uSAQr5quIyjp4OoIUd7wYhJMZmGTd6jAVqz9m6W');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
