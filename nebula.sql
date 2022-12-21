-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Dez-2022 às 15:28
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
  `desenvolvimento_alternativa` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `validade_alternativa` varchar(9) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_alternativa`),
  KEY `fk_id_questao` (`id_questao`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `alternativas`
--

INSERT INTO `alternativas` (`id_alternativa`, `id_questao`, `desenvolvimento_alternativa`, `validade_alternativa`) VALUES
(59, 32, 'Elétrons mergulhados numa massa homogênea de carga positiva.', 'incorreta'),
(60, 32, 'uma estrutura altamente compactada de prótons e elétrons.', 'incorreta'),
(61, 32, 'um núcleo de massa desprezível comparada com a massa do elétron.', 'incorreta'),
(62, 32, 'uma região central com carga negativa chamada núcleo.', 'incorreta'),
(63, 32, 'um núcleo muito pequeno de carga positiva, cercada por elétrons. (C)', 'correta'),
(64, 33, ' contém as partículas de carga elétrica negativa. (C)', 'correta'),
(65, 33, 'contém as partículas de carga elétrica positiva.', 'incorreta'),
(66, 33, 'contém nêutrons.', 'incorreta'),
(67, 33, ' concentra praticamente toda a massa do átomo.', 'incorreta'),
(68, 34, 'I - Dalton, II - Rutherford, III - Thomson.\r\n', 'incorreta'),
(69, 34, 'I - Thomson, II - Dalton, III - Rutherford. (C)', 'correta'),
(70, 34, 'I - Dalton, II - Thomson, III - Rutherford.', 'incorreta'),
(71, 34, 'I - Rutherford, II - Thomson, III - Dalton.', 'incorreta'),
(72, 35, ' 10', 'incorreta'),
(73, 35, '10,5', 'incorreta'),
(74, 35, '10,8 (C)', 'correta'),
(75, 35, '11', 'incorreta'),
(76, 36, '25%', 'incorreta'),
(77, 36, '40%', 'incorreta'),
(78, 36, '50% (C)', 'correta'),
(79, 36, ' 80%', 'incorreta'),
(80, 36, ' 125%', 'incorreta'),
(81, 37, 'Beribéri - dificuldade na coagulação sanguínea - raquitismo - escorbuto e cegueira noturna', 'incorreta'),
(82, 37, 'Raquitismo - dificuldade na coagulação sanguínea - cegueira noturna - beribéri e escorbuto', 'incorreta'),
(83, 37, 'Cegueira noturna - dificuldade na coagulação sanguínea - raquitismo - escorbuto e beribéri', 'incorreta'),
(84, 37, 'Dificuldade na coagulação sanguínea - raquitismo - beribéri - escorbuto e cegueira noturna (C)', 'correta'),
(85, 37, 'Escorbuto - beribéri - dificuldade na coagulação sanguínea - raquitismo e cegueira noturna', 'incorreta'),
(86, 38, 'Ácidos nucléicos são polímeros de monossacarídeos unidos por ligações glicosídicas, com funções estruturais. (C)', 'correta'),
(87, 38, 'Os lipídeos são compostos formados por ácidos graxos, que podem constituir membranas celulares e exercer papéis importantes como hormônios.', 'incorreta'),
(88, 38, 'Proteínas são polímeros de aminoácidos unidos por ligações peptídicas e que podem exercer funções enzimáticas, estruturais e energéticas.', 'incorreta'),
(89, 38, 'Carboidratos são conhecidos como açúcares, constituídos por carbono, hidrogênio e oxigênio, sendo as principais fontes de energia da célula.', 'incorreta'),
(90, 38, 'Alguns tipos de polissacarídeos podem ser encontrados na estrutura da parede celular dos vegetais e também ser estocados como reservas energéticas em vegetais.', 'incorreta'),
(91, 39, 'os carboidratos são as macromoléculas encontradas em maior quantidade nos tecidos vivos.', 'incorreta'),
(92, 39, 'os carboidratos podem ter função estrutural como, por exemplo, a quitina presente nos artrópodes. (C)', 'correta'),
(93, 39, 'os monômeros das proteínas são os aminoácidos cujas diversificadas funções incluem o armazenamento de energia.', 'incorreta'),
(94, 39, '	\r\nos ácidos graxos saturados são encontrados somente em animais, pois as plantas não produzem colesterol.', 'incorreta'),
(95, 39, '	\r\nas bases nitrogenadas encontradas no DNA e no RNA são as mesmas.', 'incorreta');

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

DROP TABLE IF EXISTS `aulas`;
CREATE TABLE IF NOT EXISTS `aulas` (
  `id_aula` int NOT NULL AUTO_INCREMENT,
  `id_modulo` int NOT NULL,
  `nome_aula` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_aula` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `endereco_imagem_aula` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `visibilidade_aula` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_aula` datetime NOT NULL,
  PRIMARY KEY (`id_aula`),
  KEY `fk_id_modulo` (`id_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=154 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id_aula`, `id_modulo`, `nome_aula`, `descricao_aula`, `endereco_imagem_aula`, `visibilidade_aula`, `data_criacao_aula`) VALUES
(135, 107, 'Aula 01 - Introdução à química', 'Química é o ramo da ciência que estuda a matéria, as transformações da matéria e a enerfia envolvida nessas transformações, e é isso que abordamos nesta aula.', '../../___aulas/imgs_aula/44849beaff5928f4804713b0bf4e286c.jpg', 'visível', '2022-11-14 12:22:12'),
(136, 107, 'Aula 02 - Modelos atômicos e sua evolução', 'Nesta aula serão abordados os modelos atômicos e sua evolução, desde o modelo atômico de Dalton até Rutherford-Bohr', '../../___aulas/imgs_aula/3ec1912011eb133ba5224e421947fdd4.jpg', 'visível', '2022-11-14 15:26:41'),
(137, 107, 'Aula 03 - Eletrosfera e distribuição eletrônica', 'Nesta aula serão abordados os conceitos da eletrosfera e da configuração eletrônica dos átomos e como elas influênciam na criação de substâncias, entre outros pontos.', '../../___aulas/imgs_aula/c2e75fcc11ee064e74b2a3e2361aeaa5.jpg', 'visível', '2022-11-14 15:51:50'),
(138, 107, 'Aula 04 - Tabela Periódica', 'Nesta aula abordaremos a tabela periódica e suas propriedades e como as vezes podemos obter diversas informações sobre determinado elemento apenas olhando sua posição na tabela.', '../../___aulas/imgs_aula/de841f1bcde7daed6cfcc09fb1c24728.jpg', 'visível', '2022-11-14 16:00:21'),
(139, 108, 'Aula 01 - Grandezas químicas', 'Nesta aula serão abordadas as grandezas químicas, entre elas: massa atômica, massa molecular, constante do Avogrado e o mol.', '../../___aulas/imgs_aula/e5d1e10e298ee0b5bf27dfdc8acbbe43.jpg', 'visível', '2022-11-14 21:13:51'),
(140, 108, 'Aula 02 - Cálculos Estequiométricos', 'Nesta aula serão abordados os cálculos estequiométricos e os casos particulares dos cálculos estequiométricos', '../../___aulas/imgs_aula/e18ac4ae645817a9ea058f90bfc0ed74.jpg', 'visível', '2022-11-14 21:18:31'),
(141, 108, 'Aula 03 - Estudo dos gases + Soluções', 'Nesta aula são abordados os conteúdos do estudo dos gases e o conteúdo de soluções.', '../../___aulas/imgs_aula/353c4087b015b153037cbdefe741d450.jpg', 'visível', '2022-11-14 21:26:03'),
(142, 108, 'Aula 04 - Físico-química', 'Nesta aula serão abordados os conteúdos de termoquímica, cinética química, eletroquímica e eletrólise.', '../../___aulas/imgs_aula/29c545877777396d74c97997200e5f89.jpg', 'visível', '2022-11-14 21:44:33'),
(143, 109, 'Aula 01 - Átomo de carbono', 'Nesta aula serão abordados os conteúdos sobre o átomo de carbono, sua capacidade de formação de cadeias e a classificação das mesmas.', '../../___aulas/imgs_aula/c4da29a51cfe1cf196a2373a9e3088c0.jpg', 'visível', '2022-11-14 21:53:01'),
(144, 109, 'Aula 02 - Hidrocarbonetos', 'Nesta aula serão abordados os hidrocarbonetos, formação orgânica criada a partir da ligações entre átomos de carbono. Abordaremos também suas propriedades.', '../../___aulas/imgs_aula/16cfcc8112f69be54808a6b6d6230fbc.jpg', 'visível', '2022-11-14 21:58:38'),
(145, 109, 'Aula 03 - Grupos funcionais', 'Nesta aula serão abordados os grupos funcionais orgânicos: os oxigenados e os nitrogenados.', '../../___aulas/imgs_aula/a6a830ff540fbffb66df172464b14737.jpg', 'visível', '2022-11-14 22:02:32'),
(146, 109, 'Aula 04 - Bioquímica', 'Nesta aula serão abordados os principais tópicos de bioquímica: carboidratos, proteínas e lipídeos.', '../../___aulas/imgs_aula/40ccc7eb4e59e6af319ed065cc3f3ad0.jpg', 'visível', '2022-11-14 22:09:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

DROP TABLE IF EXISTS `cursos`;
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int NOT NULL AUTO_INCREMENT,
  `nome_curso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_curso` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `endereco_imagem_curso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'arquivos/imagens/sem_imagem.png',
  `certificado_curso` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `visibilidade_curso` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_curso` datetime NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id_curso`, `nome_curso`, `descricao_curso`, `endereco_imagem_curso`, `certificado_curso`, `visibilidade_curso`, `data_criacao_curso`) VALUES
(120, 'Química do Ensino Médio', 'Este curso é um exemplo de utilização da plataforma, para o qual foi pedido à docente Vanize a permissão para utilização dos conteúdos de química do ensino médio para utilização como exemplar do sistema.', '../../_____cursos/imgs_curso/e6c868fbe4f1226689e701d40cf21745.webp', '15', 'visível', '2022-11-14 12:14:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_aula`
--

DROP TABLE IF EXISTS `favoritos_aula`;
CREATE TABLE IF NOT EXISTS `favoritos_aula` (
  `id_favoritos_aula` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_aula` int NOT NULL,
  `situacao_favorito_aula` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_favoritos_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_curso`
--

DROP TABLE IF EXISTS `favoritos_curso`;
CREATE TABLE IF NOT EXISTS `favoritos_curso` (
  `id_favoritos_curso` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_curso` int NOT NULL,
  `situacao_favorito_curso` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_favoritos_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos_modulo`
--

DROP TABLE IF EXISTS `favoritos_modulo`;
CREATE TABLE IF NOT EXISTS `favoritos_modulo` (
  `id_favoritos_modulo` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_modulo` int NOT NULL,
  `situacao_favorito_modulo` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_favoritos_modulo`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `materiais`
--

DROP TABLE IF EXISTS `materiais`;
CREATE TABLE IF NOT EXISTS `materiais` (
  `id_material` int NOT NULL AUTO_INCREMENT,
  `id_aula` int NOT NULL,
  `nome_material` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco_material` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `visibilidade_material` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_material` datetime NOT NULL,
  PRIMARY KEY (`id_material`),
  KEY `fk_id_aula` (`id_aula`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `materiais`
--

INSERT INTO `materiais` (`id_material`, `id_aula`, `nome_material`, `endereco_material`, `visibilidade_material`, `data_criacao_material`) VALUES
(124, 135, 'PDF - Aula 01 - Introdução à química', '../../__materiais/materiais/ff598372daa769b0216ef0e711993620.pdf', 'visível', '2022-11-14 15:19:41'),
(125, 135, 'Figura 01 - Matéria, Corpo e Objeto', '../../__materiais/materiais/14660228e9e222eff22ca8319df11a3b.png', 'visível', '2022-11-14 15:21:32'),
(126, 135, 'Figura 02 - Estados físicos da matéria', '../../__materiais/materiais/bbc6c340b58031c7e47fecd41a9c0c8b.png', 'visível', '2022-11-14 15:22:36'),
(129, 136, 'PDF - Aula 02 - Modelos atômicos e sua evolução', '../../__materiais/materiais/86de4bfcb9a5bb98578c831bc3fa4ac1.pdf', 'visível', '2022-11-14 15:36:45'),
(130, 136, 'Videoaula - Evolução dos Modelos Atômicos', '../../__materiais/materiais/7893dc9478be0b7e7da09cbee397bc09.mp4', 'visível', '2022-11-14 15:39:34'),
(131, 136, 'Imagem - Evolução dos Modelos Atômicos', '../../__materiais/materiais/fbe03f6e773d8076f68dee9e6cd6087b.png', 'visível', '2022-11-14 15:41:03'),
(132, 137, 'PDF 1 - Aula 03 - Eletrosfera', '../../__materiais/materiais/d4718cfb0b47462fd63431c2224818b6.pdf', 'visível', '2022-11-14 15:52:37'),
(133, 137, 'PDF 2 - Aula 03 - Distribuição eletrônica', '../../__materiais/materiais/0ebe3f4f8d6066f71e86a3de98951221.pdf', 'visível', '2022-11-14 15:52:59'),
(134, 137, 'Figura 01 - Distribuição eletrônica', '../../__materiais/materiais/94479b73c367eb45a91eb825888da56b.webp', 'visível', '2022-11-14 15:56:04'),
(135, 137, 'Videoaula - Eletrosfera', '../../__materiais/materiais/36b0057b50955fd99ecaea620d5a19ae.mp4', 'visível', '2022-11-14 15:57:08'),
(136, 138, 'PDF 1 - Organização e classificação dos elementos químicos na tabela periódicas', '../../__materiais/materiais/91c63e9cccde0fa5bd80f286a1ac420e.pdf', 'visível', '2022-11-14 16:00:51'),
(137, 138, 'PDF 2 - Propriedades Periódicas', '../../__materiais/materiais/0cee0abbfd4ac56982fd3c5b1a941d72.pdf', 'visível', '2022-11-14 16:01:10'),
(138, 138, 'Figura 01 - Tabela Periódica', '../../__materiais/materiais/352489724fb054ff4e7cb61e3353b49e.webp', 'visível', '2022-11-14 16:02:54'),
(139, 139, 'PDF - Aula 01 - Grandezas químicas', '../../__materiais/materiais/38f53fba9ceb05cca1d08b95b74d26e0.pdf', 'visível', '2022-11-14 21:14:36'),
(140, 139, 'Figura 01 - Mapa Mental sobre grandezas químicas', '../../__materiais/materiais/3838ae58cba41bd1ecc27562ee913a39.jpg', 'visível', '2022-11-14 21:15:37'),
(141, 140, 'PDF 1 - Aula 02 - Cálculos estequiométricos', '../../__materiais/materiais/9e2adabdc5054aec90d1012334cd4ce5.pdf', 'visível', '2022-11-14 21:19:24'),
(142, 140, 'PDF 2 - Aula 02 - Casos particulares dos cálculos estequiométricos', '../../__materiais/materiais/6c0f89bff3f7cab6aeb0a55e72b1118e.pdf', 'visível', '2022-11-14 21:19:49'),
(143, 140, 'Videoaula - Cálculos estequiométricos', '../../__materiais/materiais/06f2963dd76c0a2821c6a319e8c8b0a9.mp4', 'visível', '2022-11-14 21:23:08'),
(144, 141, 'PDF 1 - Estudo dos gases', '../../__materiais/materiais/61e1e805bf8dbf340e9146c31ce33921.pdf', 'visível', '2022-11-14 21:27:18'),
(145, 141, 'PDF 2 - Soluções', '../../__materiais/materiais/b00cf4dc1efc5c134ea68e104e6eebe5.pdf', 'visível', '2022-11-14 21:27:51'),
(146, 142, 'PDF 1 - Termoquímica', '../../__materiais/materiais/b64929a5202645ad06871be5d8da2ac1.pdf', 'visível', '2022-11-14 21:44:55'),
(147, 142, 'PDF 2 - Cinética Química', '../../__materiais/materiais/c2d05c43c7e99ec51258eede8636b6dc.pdf', 'visível', '2022-11-14 21:45:12'),
(148, 142, 'PDF 3 - Eletroquímica - Células Galvânicas', '../../__materiais/materiais/59049c8bc64aa43dbd5bed44d0022189.pdf', 'visível', '2022-11-14 21:45:40'),
(149, 142, 'PDF 4 - Eletrólise (células eletrolíticas)', '../../__materiais/materiais/644dd84af289bd1d396cf5744fbfcae6.pdf', 'visível', '2022-11-14 21:46:00'),
(150, 143, 'PDF 1 - Átomo de carono - características, classificação e tipos de ligação', '../../__materiais/materiais/6076accc3dc3ca6d1aadf3f2decac6bd.pdf', 'visível', '2022-11-14 21:53:49'),
(151, 143, 'PDF 2 - Classificação e representação das cadeias carbônicas', '../../__materiais/materiais/07a415fe4111c879e7902b8fd0bf370b.pdf', 'visível', '2022-11-14 21:54:15'),
(152, 143, 'Figura 01 - Tabela da hibridização do carbono', '../../__materiais/materiais/118e754f803e032b3811b846b4e31cb3.jpg', 'visível', '2022-11-14 21:55:59'),
(153, 144, 'PDF 1 - Hidrocarbonetos (classificação, nomenclatura e aplicações)', '../../__materiais/materiais/6e24a3b78fd2a7afc2546feda303efd0.pdf', 'visível', '2022-11-14 21:59:11'),
(154, 144, 'PDF 2 - Propriedades dos Hidrocarbonetos', '../../__materiais/materiais/720396f11b28c77f459be15250c8e65f.pdf', 'visível', '2022-11-14 21:59:31'),
(155, 144, 'Figura 01 - Hidrocarbonetos básicos', '../../__materiais/materiais/bf538ba2ef57afbd20aeb6dd4f301884.jpg', 'visível', '2022-11-14 22:00:22'),
(156, 145, 'PDF 1 - Grupos funcionais oxigenados, definição, propriedades e nomenclatura', '../../__materiais/materiais/da78c4da0aff217a1a8789452f797981.pdf', 'visível', '2022-11-14 22:03:11'),
(157, 145, 'PDF 2 - Grupos funcionais nitrogenados, definição, propriedades e nomenclatura', '../../__materiais/materiais/1b6902d5f8fdfc1777d779b4832f3c7a.pdf', 'visível', '2022-11-14 22:03:42'),
(158, 145, 'Figura 01 - Principais grupos funcionais oxigenados', '../../__materiais/materiais/c69a70f4475716e7bdfc1cbb754bf2ec.jpg', 'visível', '2022-11-14 22:04:47'),
(159, 145, 'Figura 02 - Processo de formação de uma amida', '../../__materiais/materiais/15c796f9024db52ccbda5d242cfff240.jpg', 'visível', '2022-11-14 22:06:26'),
(160, 146, 'PDF 1 - Bioquímica', '../../__materiais/materiais/67674948d37001436c0481c1668152ed.pdf', 'visível', '2022-11-14 22:09:58'),
(161, 146, 'Figura 01 - Processo de formação de uma proteína', '../../__materiais/materiais/fcc14c40be331dbabb5d68b7877787f7.jpg', 'visível', '2022-11-14 22:10:51'),
(162, 146, 'Artigo sobre proteínas', '../../__materiais/materiais/1ede7112b6fe967ea3b345181c651919.pdf', 'visível', '2022-11-14 22:11:29'),
(163, 146, 'Artigo sobre carboidratos', '../../__materiais/materiais/20bb20c7478c28ec5a668fd723e69f8b.pdf', 'visível', '2022-11-14 22:11:45'),
(164, 146, 'Artigo sobre triacilgliceróis', '../../__materiais/materiais/660e2e09d5fe13caf1340286b8596286.pdf', 'visível', '2022-11-14 22:12:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int NOT NULL AUTO_INCREMENT,
  `id_curso` int NOT NULL,
  `nome_modulo` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_modulo` longtext COLLATE utf8mb4_general_ci NOT NULL,
  `endereco_imagem_modulo` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'arquivos\\imagens\\sem_imagem.png',
  `visibilidade_modulo` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao_modulo` datetime NOT NULL,
  PRIMARY KEY (`id_modulo`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `id_curso`, `nome_modulo`, `descricao_modulo`, `endereco_imagem_modulo`, `visibilidade_modulo`, `data_criacao_modulo`) VALUES
(107, 120, '1º Ano - Introdução à química', 'Neste módulo são introduzidos os conceitos fundamentais da química, tais conceitos essenciais para a compreensão da disciplina no início e no decorrer do ensino médio.', '../../____modulos/imgs_modulo/dbbbe92f89403375eff7412b053ec13d.png', 'visível', '2022-11-14 12:18:39'),
(108, 120, '2º Ano - Grandezas químicas, estequiometria e fisico-química', 'Neste módulo serão abordados os conteúdos de grandezas químicas, cálculos estequiométricos, estudos dos gases e soluções e a fisico-química.', '../../____modulos/imgs_modulo/098648ffbe6732f25f422f4c210bcd5f.png', 'visível', '2022-11-14 21:06:31'),
(109, 120, '3º Ano - Química orgânica e bioquímica', 'Neste módulo serão abordados os conteúdos de química orgânica desde o átomo de carbono até os grupos funcionais e isomerial, além do conteúdo de bioquímica.', '../../____modulos/imgs_modulo/a3f5d6cb6dee42bf0a142a49cc57b7f0.png', 'visível', '2022-11-14 21:50:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset`
--

DROP TABLE IF EXISTS `password_reset`;
CREATE TABLE IF NOT EXISTS `password_reset` (
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_expiracao` datetime NOT NULL,
  `usado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `password_reset`
--

INSERT INTO `password_reset` (`email`, `token`, `data_expiracao`, `usado`) VALUES
('reinaldozimmerwendt@gmail.com', 'ac0fd65ae3438045d92852141a1230190027ecb9619a31d8b3c919861792a9a3653c165835530b2b9e78dcd25d78851e0a21', '2022-11-17 02:33:32', 0),
('reinaldozimmerwendt@gmail.com', 'f493274d971aaf4c3222f86bb455e69f1df976c2f55f58d9fb47de246f7cf774deb7589c81d37583013f6ce8a0b8e2273424', '2022-11-25 19:50:59', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `questionarios`
--

DROP TABLE IF EXISTS `questionarios`;
CREATE TABLE IF NOT EXISTS `questionarios` (
  `id_questionario` int NOT NULL AUTO_INCREMENT,
  `id_aula` int NOT NULL,
  `nome_questionario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `distribuicao_questoes` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `tempo_proxima_realizacao` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `visibilidade_questionario` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_questionario`),
  KEY `fk_id_aula` (`id_aula`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `questionarios`
--

INSERT INTO `questionarios` (`id_questionario`, `id_aula`, `nome_questionario`, `distribuicao_questoes`, `tempo_proxima_realizacao`, `visibilidade_questionario`) VALUES
(26, 136, 'Questionário 01', 'padronizada', '1-M', 'visível'),
(27, 139, 'Questionário 01', 'aleatoria', '1-M', 'visível'),
(28, 146, 'Questionário 01', 'padronizada', '01-M', 'visível');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questoes`
--

DROP TABLE IF EXISTS `questoes`;
CREATE TABLE IF NOT EXISTS `questoes` (
  `id_questao` int NOT NULL AUTO_INCREMENT,
  `id_questionario` int NOT NULL,
  `desenvolvimento_questao` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `distribuicao_alternativas` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id_questao`),
  KEY `fk_id_questionario` (`id_questionario`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `questoes`
--

INSERT INTO `questoes` (`id_questao`, `id_questionario`, `desenvolvimento_questao`, `distribuicao_alternativas`) VALUES
(32, 26, 'Uma importante contribuição do modelo de Rutherford foi considerar o átomo constituído de:', 'padronizada'),
(33, 26, 'O átomo de Rutherford (1911) foi comparado ao sistema planetário (o núcleo atômico representa o sol e a eletrosfera, os planetas):\r\n\r\nEletrosfera é a região do átomo que:', 'padronizada'),
(34, 26, '(UFJF-MG) Associe as afirmações a seus respectivos responsáveis:\r\n\r\nI- O átomo não é indivisível e a matéria possui propriedades elétricas (1897).\r\nII- O átomo é uma esfera maciça (1808).\r\nIII- O átomo é formado por duas regiões denominadas núcleo e eletrosfera (1911).', 'padronizada'),
(35, 27, 'Na Natureza, de cada 5 átomos de boro, 1 tem massa atômica igual a 10 u.m.a (unidade de massa atômica) e 4 têm massa atômica igual a 11 u.m.a. Com base nestes dados, a massa atômica do boro, expressa em u.m.a, é igual a:', 'padronizada'),
(36, 27, 'A dose diária recomendada do elemento cálcio para um adulto é de 800 mg. Suponha certo suplemento nutricional a base de casca de ostras que seja 100% CaCO3. Se um adulto tomar diariamente dois tabletes desse suplemento de 500 mg cada, qual porcentagem de cálcio da quantidade recomendada essa pessoa está ingerindo? (Ca=40g/mol; O=16g/mol; C=12g/mol)', 'padronizada'),
(37, 28, 'Assinale a alternativa correta quanto ao resultado da carência das vitaminas K, D, B1, C e A, respectivamente.', 'padronizada'),
(38, 28, '(UDESC 2008)\r\nOs organismos vivos são constituídos de várias macromoléculas orgânicas, conhecidas como polímeros biológicos. Sobre essas macromoléculas, é incorreto afirmar:', 'padronizada'),
(39, 28, '(UFRGS 2017) Sobre as macromoléculas biológicas presentes em todos os organismos, é correto afirmar que:', 'padronizada');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_curso`
--

DROP TABLE IF EXISTS `relacao_usuario_curso`;
CREATE TABLE IF NOT EXISTS `relacao_usuario_curso` (
  `id_relacao_usuario_curso` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_curso` int NOT NULL,
  `tipo_relacao` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `data_relacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_relacao_usuario_curso`),
  KEY `fk_email` (`email`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=188 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `relacao_usuario_curso`
--

INSERT INTO `relacao_usuario_curso` (`id_relacao_usuario_curso`, `email`, `id_curso`, `tipo_relacao`, `data_relacao`) VALUES
(171, 'reinaldozimmerwendt@gmail.com', 120, 'produtor', '2022-11-14 12:14:05'),
(187, 'reinaldozimmerwendt@gmail.com', 120, 'consumidor', '2022-12-10 12:26:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `relacao_usuario_questionario`
--

DROP TABLE IF EXISTS `relacao_usuario_questionario`;
CREATE TABLE IF NOT EXISTS `relacao_usuario_questionario` (
  `id_relacao_usuario_questionario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `id_questionario` int NOT NULL,
  `id_curso` int NOT NULL,
  `nota_usuario` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data_proxima_realizacao` datetime NOT NULL,
  PRIMARY KEY (`id_relacao_usuario_questionario`),
  KEY `fk_email` (`email`),
  KEY `fk_id_questionario` (`id_questionario`),
  KEY `fk_id_curso` (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `relacao_usuario_questionario`
--

INSERT INTO `relacao_usuario_questionario` (`id_relacao_usuario_questionario`, `email`, `id_questionario`, `id_curso`, `nota_usuario`, `data_proxima_realizacao`) VALUES
(46, 'reinaldozimmerwendt@gmail.com', 26, 120, 'não-realizado', '2022-12-10 12:26:52'),
(47, 'reinaldozimmerwendt@gmail.com', 27, 120, 'não-realizado', '2022-12-10 12:26:52'),
(48, 'reinaldozimmerwendt@gmail.com', 28, 120, 'não-realizado', '2022-12-10 12:26:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `nome_usuario` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `endereco_imagem_usuario` varchar(100) COLLATE utf8mb4_general_ci DEFAULT 'arquivos/imagens/sem_imagem_usuario',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `email`, `nome_usuario`, `senha`, `endereco_imagem_usuario`) VALUES
(32, 'reinaldozimmerwendt@gmail.com', 'Reinaldo Zimmer Wendt', '202cb962ac59075b964b07152d234b70', '../../______usuarios/imgs_usuarios/ff5ded429530fff22dcbef102c60f1dd.jpg');

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
