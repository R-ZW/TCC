-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27-Ago-2022 às 13:15
-- Versão do servidor: 8.0.27
-- versão do PHP: 7.4.26

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

DROP TABLE IF EXISTS `alternativas`;
CREATE TABLE IF NOT EXISTS `alternativas` (
  `id_alternativa` int NOT NULL AUTO_INCREMENT,
  `id_questao` int NOT NULL,
  `desenvolvimento_alternativa` varchar(255) NOT NULL,
  `validade_alternativa` varchar(9) NOT NULL,
  PRIMARY KEY (`id_alternativa`),
  KEY `fk_id_questao` (`id_questao`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `id_aula` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int NOT NULL,
  `nome_aula` varchar(100) NOT NULL,
  `descricao_aula` longtext NOT NULL,
  `endereco_imagem_aula` varchar(100) DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `visibilidade_aula` varchar(11) NOT NULL,
  `data_criacao_aula` datetime NOT NULL,
  PRIMARY KEY (`id_aula`),
  KEY `fk_id_modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(100) NOT NULL,
  `descricao_curso` longtext NOT NULL,
  `endereco_imagem_curso` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem.png',
  `endereco_certificado_curso` varchar(100) NOT NULL,
  `visibilidade_curso` varchar(11) NOT NULL,
  `data_criacao_curso` datetime NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_aula`
--

DROP TABLE IF EXISTS `favoritos_aula`;
CREATE TABLE IF NOT EXISTS `favoritos_aula` (
  `id_favoritos_aula` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_aula` int NOT NULL,
  `situacao_favorito_aula` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_curso`
--

DROP TABLE IF EXISTS `favoritos_curso`;
CREATE TABLE IF NOT EXISTS `favoritos_curso` (
  `id_favoritos_curso` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_curso` int NOT NULL,
  `situacao_favorito_curso` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_modulo`
--

DROP TABLE IF EXISTS `favoritos_modulo`;
CREATE TABLE IF NOT EXISTS `favoritos_modulo` (
  `id_favoritos_modulo` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_modulo` int NOT NULL,
  `situacao_favorito_modulo` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

DROP TABLE IF EXISTS `materiais`;
CREATE TABLE IF NOT EXISTS `materiais` (
  `id_material` int NOT NULL AUTO_INCREMENT,
  `id_aula` int NOT NULL,
  `nome_material` varchar(100) NOT NULL,
  `endereco_material` varchar(100) NOT NULL,
  `visibilidade_material` varchar(11) NOT NULL,
  `data_criacao_material` datetime NOT NULL,
  PRIMARY KEY (`id_material`),
  KEY `fk_id_aula` (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `id_curso` int NOT NULL,
  `nome_modulo` varchar(100) NOT NULL,
  `descricao_modulo` longtext NOT NULL,
  `endereco_imagem_modulo` varchar(100) DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `visibilidade_modulo` varchar(11) NOT NULL,
  `data_criacao_modulo` datetime NOT NULL,
  PRIMARY KEY (`id_modulo`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarios`
--

DROP TABLE IF EXISTS `questionarios`;
CREATE TABLE IF NOT EXISTS `questionarios` (
  `id_questionario` int NOT NULL AUTO_INCREMENT,
  `id_aula` int NOT NULL,
  `nome_questionario` varchar(255) NOT NULL,
  `distribuicao_questoes` varchar(11) NOT NULL,
  `tempo_proxima_realizacao` varchar(255) NOT NULL,
  `visibilidade_questionario` varchar(11) NOT NULL,
  PRIMARY KEY (`id_questionario`),
  KEY `fk_id_aula` (`id_aula`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

DROP TABLE IF EXISTS `questoes`;
CREATE TABLE IF NOT EXISTS `questoes` (
  `id_questao` int NOT NULL AUTO_INCREMENT,
  `id_questionario` int NOT NULL,
  `desenvolvimento_questao` varchar(255) NOT NULL,
  `distribuicao_alternativas` varchar(11) NOT NULL,
  PRIMARY KEY (`id_questao`),
  KEY `fk_id_questionario` (`id_questionario`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_curso`
--

DROP TABLE IF EXISTS `relacao_usuario_curso`;
CREATE TABLE IF NOT EXISTS `relacao_usuario_curso` (
  `id_relacao_usuario_curso` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `id_curso` int NOT NULL,
  `tipo_relacao` varchar(10) NOT NULL,
  `data_relacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_relacao_usuario_curso`),
  KEY `fk_email` (`email`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_questionario`
--

DROP TABLE IF EXISTS `relacao_usuario_questionario`;
CREATE TABLE IF NOT EXISTS `relacao_usuario_questionario` (
  `id_relacao_usuario_questionario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `id_questionario` int NOT NULL,
  `id_curso` int NOT NULL,
  `nota_usuario` varchar(255) NOT NULL,
  `data_proxima_realizacao` datetime NOT NULL,
  PRIMARY KEY (`id_relacao_usuario_questionario`),
  KEY `fk_email` (`email`),
  KEY `fk_id_questionario` (`id_questionario`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `nome_usuario` varchar(100) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `endereco_imagem_usuario` varchar(100) DEFAULT 'arquivos/imagens/sem_imagem_usuario',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `relacao_usuario_curso`
--
ALTER TABLE `relacao_usuario_curso`
  ADD CONSTRAINT `fk_id_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
