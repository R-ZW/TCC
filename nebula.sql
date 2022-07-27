-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27-Jul-2022 às 02:52
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `nebula`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alternativas`
--

CREATE TABLE `alternativas` (
  `id_alternativa` int(10) NOT NULL,
  `id_questao` int(10) NOT NULL,
  `desenvolvimento_alternativa` varchar(255) NOT NULL,
  `validade_alternativa` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `alternativas`
--

INSERT INTO `alternativas` (`id_alternativa`, `id_questao`, `desenvolvimento_alternativa`, `validade_alternativa`) VALUES
(1, 1, 'Alternativa 1 - Questão 1', 'correta'),
(2, 1, 'Alternativa 2 - Questão 3', 'incorreta');

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
  `visibilidade_aula` varchar(11) NOT NULL,
  `data_criacao_aula` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id_aula`, `id_modulo`, `nome_aula`, `descricao_aula`, `endereco_imagem_aula`, `visibilidade_aula`, `data_criacao_aula`) VALUES
(41, 36, 'Aula 01 - Módulo 1 ', '[*Descrição Aula 01 - Módulo 1*]', '../../_.imgs_default/sem_imagem.png', 'visível', '2022-07-26 20:37:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(10) NOT NULL,
  `nome_curso` varchar(100) NOT NULL,
  `descricao_curso` longtext NOT NULL,
  `endereco_imagem_curso` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem.png',
  `endereco_certificado_curso` varchar(100) NOT NULL,
  `visibilidade_curso` varchar(11) NOT NULL,
  `data_criacao_curso` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nome_curso`, `descricao_curso`, `endereco_imagem_curso`, `endereco_certificado_curso`, `visibilidade_curso`, `data_criacao_curso`) VALUES
(36, 'Curso 1 - Teste', '[*Descrição Curso 1*]', 'arquivos/____imgs_curso/51b175f2a6d44848f7c3719723a2660a.webp', '', '', '2022-07-10 14:14:28'),
(40, 'Curso 1 - Teste123123', 'werewrerwewrreerer', '../../_____cursos/imgs_curso/35e9ba211a49152cd73201cedbe90300.png', '../../_____cursos/certificados_curso/35e9ba211a49152cd73201cedbe90300.pdf', 'visível', '2022-07-26 20:21:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

CREATE TABLE `materiais` (
  `id_material` int(10) NOT NULL,
  `id_aula` int(10) NOT NULL,
  `nome_material` varchar(100) NOT NULL,
  `endereco_material` varchar(100) NOT NULL,
  `visibilidade_material` varchar(11) NOT NULL,
  `data_criacao_material` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id_material`, `id_aula`, `nome_material`, `endereco_material`, `visibilidade_material`, `data_criacao_material`) VALUES
(54, 41, 'Material 1 - Aula 12', '../../__materiais/materiais/fbaa69f73d54d0bbc89f926a05e802b3.png', 'visível', '2022-07-26 21:04:26');

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
  `visibilidade_modulo` varchar(11) NOT NULL,
  `data_criacao_modulo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `id_curso`, `nome_modulo`, `descricao_modulo`, `endereco_imagem_modulo`, `visibilidade_modulo`, `data_criacao_modulo`) VALUES
(35, 36, 'MÓDULO 1', '		Lorem ipsum convallis euismod mi laoreet vehicula ligula eget malesuada, nisl quisque rutrum quam tempor ante rutrum suspendisse, bibendum morbi felis facilisis ipsum rhoncus duis ad. semper nulla vel ad tempus ultrices quis luctus, dolor dictum auctor etiam rutrum lorem vel vivamus, justo nisl interdum vivamus nostra curabitur. sociosqu mattis vivamus massa nisl urna bibendum facilisis cras enim rutrum, justo mi primis lacinia scelerisque libero erat diam torquent, ornare erat diam sollicitudin sociosqu nunc consectetur mattis lectus. arcu lacinia molestie aliquam ligula dui pharetra suspendisse, cursus elit malesuada integer odio curabitur molestie nisi, amet lacinia senectus curabitur felis pellentesque. Lorem ipsum convallis euismod mi laoreet vehicula ligula eget malesuada, nisl quisque rutrum quam tempor ante rutrum suspendisse, bibendum morbi felis facilisis ipsum rhoncus duis ad. semper nulla vel ad tempus ultrices quis luctus, dolor dictum auctor etiam rutrum lorem vel vivamus, justo nisl interdum vivamus nostra curabitur. sociosqu mattis vivamus massa nisl urna bibendum facilisis cras enim rutrum, justo mi primis lacinia scelerisque libero erat diam torquent, ornare erat diam sollicitudin sociosqu nunc consectetur mattis lectus. arcu lacinia molestie aliquam ligula dui pharetra suspendisse, cursus elit malesuada integer odio curabitur molestie nisi, amet lacinia senectus curabitur felis pellentesque. ', 'arquivos/_imgs_default/sem_imagem.png', '', '2022-07-10 19:12:18'),
(36, 40, 'módulo 1 - curso 1 - teste', '[*Descrição módulo 1 - exemplo*]', '../../____modulos/imgs_modulo/f9682a510600f0691de07da3479f8924.jpg', 'visível', '2022-07-26 20:24:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarios`
--

CREATE TABLE `questionarios` (
  `id_questionario` int(10) NOT NULL,
  `id_aula` int(10) NOT NULL,
  `nome_questionario` varchar(255) NOT NULL,
  `distribuicao_questoes` varchar(11) NOT NULL,
  `tempo_proxima_realizacao` varchar(255) NOT NULL,
  `visibilidade_questionario` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `questionarios`
--

INSERT INTO `questionarios` (`id_questionario`, `id_aula`, `nome_questionario`, `distribuicao_questoes`, `tempo_proxima_realizacao`, `visibilidade_questionario`) VALUES
(1, 41, 'QUESTIONARIO FODA', 'aleatoria', '1-M', 'visível');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

CREATE TABLE `questoes` (
  `id_questao` int(10) NOT NULL,
  `id_questionario` int(10) NOT NULL,
  `desenvolvimento_questao` varchar(255) NOT NULL,
  `distribuicao_alternativas` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id_questao`, `id_questionario`, `desenvolvimento_questao`, `distribuicao_alternativas`) VALUES
(1, 1, 'Questão 1 - exemplo', 'aleatoria');

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
(35, 'reinaldozimmerwendt@mail', 36, 'produtor', '2022-07-10 14:14:28'),
(43, 'pedro@mail.com', 40, 'produtor', '2022-07-26 20:21:38'),
(44, 'pedro@mail.com', 40, 'consumidor', '2022-07-26 20:22:36');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_questionario`
--

CREATE TABLE `relacao_usuario_questionario` (
  `id_relacao_usuario_questionario` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_questionario` int(10) NOT NULL,
  `id_curso` int(10) NOT NULL,
  `nota_usuario` varchar(255) NOT NULL,
  `data_proxima_realizacao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `relacao_usuario_questionario`
--

INSERT INTO `relacao_usuario_questionario` (`id_relacao_usuario_questionario`, `email`, `id_questionario`, `id_curso`, `nota_usuario`, `data_proxima_realizacao`) VALUES
(1, 'pedro@mail.com', 1, 40, '100', '2022-07-26 21:51:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco_imagem_usuario` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem_usuario'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nome_usuario`, `senha`, `endereco_imagem_usuario`) VALUES
(3, 'pedro@mail.com', 'PEDRO', '202cb962ac59075b964b07152d234b70', '../../______usuarios/imgs_usuarios/9927d320bbd4ed0b5530ec741deb12ff.jpg');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alternativas`
--
ALTER TABLE `alternativas`
  ADD PRIMARY KEY (`id_alternativa`),
  ADD KEY `fk_id_questao` (`id_questao`);

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
-- Índices para tabela `questionarios`
--
ALTER TABLE `questionarios`
  ADD PRIMARY KEY (`id_questionario`),
  ADD KEY `fk_id_aula` (`id_aula`) USING BTREE;

--
-- Índices para tabela `questoes`
--
ALTER TABLE `questoes`
  ADD PRIMARY KEY (`id_questao`),
  ADD KEY `fk_id_questionario` (`id_questionario`);

--
-- Índices para tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  ADD PRIMARY KEY (`id_relacao`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Índices para tabela `relacao_usuario_questionario`
--
ALTER TABLE `relacao_usuario_questionario`
  ADD PRIMARY KEY (`id_relacao_usuario_questionario`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_questionario` (`id_questionario`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alternativas`
--
ALTER TABLE `alternativas`
  MODIFY `id_alternativa` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id_aula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id_material` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `questionarios`
--
ALTER TABLE `questionarios`
  MODIFY `id_questionario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `questoes`
--
ALTER TABLE `questoes`
  MODIFY `id_questao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  MODIFY `id_relacao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de tabela `relacao_usuario_questionario`
--
ALTER TABLE `relacao_usuario_questionario`
  MODIFY `id_relacao_usuario_questionario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
