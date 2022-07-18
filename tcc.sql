-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11-Jul-2022 às 02:09
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `taurum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id_aula` int(10) NOT NULL,
  `id_modulo` int(10) NOT NULL,
  `nome_aula` varchar(100) NOT NULL,
  `descricao_aula` longtext NOT NULL,
  `endereco_imagem_aula` varchar(100) DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `data_criacao_aula` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(10) NOT NULL,
  `nome_curso` varchar(100) NOT NULL,
  `descricao_curso` longtext NOT NULL,
  `endereco_imagem_curso` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem.png',
  `data_criacao_curso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nome_curso`, `descricao_curso`, `endereco_imagem_curso`, `data_criacao_curso`) VALUES
(36, 'Curso 1 - Teste', '[*Descrição Curso 1*]', 'arquivos/____imgs_curso/51b175f2a6d44848f7c3719723a2660a.webp', '2022-07-10 14:14:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id_material` int(10) NOT NULL,
  `id_aula` int(10) NOT NULL,
  `nome_material` varchar(100) NOT NULL,
  `endereco_material` varchar(100) NOT NULL,
  `data_criacao_material` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(10) NOT NULL,
  `id_curso` int(10) NOT NULL,
  `nome_modulo` varchar(100) NOT NULL,
  `descricao_modulo` longtext NOT NULL,
  `endereco_imagem_modulo` varchar(100) DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `data_criacao_modulo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `id_curso`, `nome_modulo`, `descricao_modulo`, `endereco_imagem_modulo`, `data_criacao_modulo`) VALUES
(35, 36, 'MÓDULO 1', '		Lorem ipsum convallis euismod mi laoreet vehicula ligula eget malesuada, nisl quisque rutrum quam tempor ante rutrum suspendisse, bibendum morbi felis facilisis ipsum rhoncus duis ad. semper nulla vel ad tempus ultrices quis luctus, dolor dictum auctor etiam rutrum lorem vel vivamus, justo nisl interdum vivamus nostra curabitur. sociosqu mattis vivamus massa nisl urna bibendum facilisis cras enim rutrum, justo mi primis lacinia scelerisque libero erat diam torquent, ornare erat diam sollicitudin sociosqu nunc consectetur mattis lectus. arcu lacinia molestie aliquam ligula dui pharetra suspendisse, cursus elit malesuada integer odio curabitur molestie nisi, amet lacinia senectus curabitur felis pellentesque. Lorem ipsum convallis euismod mi laoreet vehicula ligula eget malesuada, nisl quisque rutrum quam tempor ante rutrum suspendisse, bibendum morbi felis facilisis ipsum rhoncus duis ad. semper nulla vel ad tempus ultrices quis luctus, dolor dictum auctor etiam rutrum lorem vel vivamus, justo nisl interdum vivamus nostra curabitur. sociosqu mattis vivamus massa nisl urna bibendum facilisis cras enim rutrum, justo mi primis lacinia scelerisque libero erat diam torquent, ornare erat diam sollicitudin sociosqu nunc consectetur mattis lectus. arcu lacinia molestie aliquam ligula dui pharetra suspendisse, cursus elit malesuada integer odio curabitur molestie nisi, amet lacinia senectus curabitur felis pellentesque. ', 'arquivos/_imgs_default/sem_imagem.png', '2022-07-10 19:12:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_curso`
--

CREATE TABLE `relacao_usuario_curso` (
  `id_relacao` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_curso` int(10) NOT NULL,
  `tipo_relacao` varchar(10) NOT NULL,
  `data_relacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `relacao_usuario_curso`
--

INSERT INTO `relacao_usuario_curso` (`id_relacao`, `email`, `id_curso`, `tipo_relacao`, `data_relacao`) VALUES
(35, 'reinaldozimmerwendt@mail', 36, 'produtor', '2022-07-10 14:14:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `senha` varchar(16) NOT NULL,
  `endereco_imagem_usuario` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem_usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`email`, `nome_usuario`, `senha`, `endereco_imagem_usuario`) VALUES
('pedro@mail.com', 'pedro', '123456789', 'arquivos/imagens/sem_imagem_usuario'),
('reinaldozimmerwendt@gmail.com', 'ReinaldoZW', '123456789', 'arquivos/imagens/sem_imagem_usuario');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aula`),
  ADD KEY `fk_id_modulo` (`id_modulo`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `materiais`
--
ALTER TABLE `materiais`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `fk_id_aula` (`id_aula`);

--
-- Índices para tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Índices para tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  ADD PRIMARY KEY (`id_relacao`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id_material` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  MODIFY `id_relacao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  ADD CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
