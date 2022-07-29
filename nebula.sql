-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jul-2022 às 04:19
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_aula`
--

CREATE TABLE `favoritos_aula` (
  `id_favoritos_aula` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_aula` int(10) NOT NULL,
  `situacao_favorito_aula` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_curso`
--

CREATE TABLE `favoritos_curso` (
  `id_favoritos_curso` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_curso` int(10) NOT NULL,
  `situacao_favorito_curso` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_modulo`
--

CREATE TABLE `favoritos_modulo` (
  `id_favoritos_modulo` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_modulo` int(10) NOT NULL,
  `situacao_favorito_modulo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Índices para tabela `favoritos_aula`
--
ALTER TABLE `favoritos_aula`
  ADD PRIMARY KEY (`id_favoritos_aula`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_aula` (`id_aula`);

--
-- Índices para tabela `favoritos_curso`
--
ALTER TABLE `favoritos_curso`
  ADD PRIMARY KEY (`id_favoritos_curso`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_curso` (`id_curso`);

--
-- Índices para tabela `favoritos_modulo`
--
ALTER TABLE `favoritos_modulo`
  ADD PRIMARY KEY (`id_favoritos_modulo`),
  ADD KEY `fk_email` (`email`),
  ADD KEY `fk_id_modulo` (`id_modulo`);

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
  MODIFY `id_aula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `favoritos_aula`
--
ALTER TABLE `favoritos_aula`
  MODIFY `id_favoritos_aula` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `favoritos_curso`
--
ALTER TABLE `favoritos_curso`
  MODIFY `id_favoritos_curso` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `favoritos_modulo`
--
ALTER TABLE `favoritos_modulo`
  MODIFY `id_favoritos_modulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `materiais`
--
ALTER TABLE `materiais`
  MODIFY `id_material` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

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
  MODIFY `id_relacao` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `relacao_usuario_questionario`
--
ALTER TABLE `relacao_usuario_questionario`
  MODIFY `id_relacao_usuario_questionario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
