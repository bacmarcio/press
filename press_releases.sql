-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2023 at 08:49 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `press_releases`
--

-- --------------------------------------------------------

--
-- Table structure for table `artigos`
--

CREATE TABLE `artigos` (
  `id` int NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `conteudo` text,
  `foto` varchar(150) DEFAULT NULL,
  `resumo` text,
  `postado_por` varchar(255) NOT NULL,
  `id_categoria` int DEFAULT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'N',
  `url_amigavel` varchar(255) DEFAULT NULL,
  `destaque` enum('S','N') NOT NULL DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` int NOT NULL,
  `foto` varchar(200) DEFAULT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `posicao` varchar(4) DEFAULT NULL,
  `descricao` text,
  `link` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banners`
--

INSERT INTO `banners` (`id`, `foto`, `titulo`, `posicao`, `descricao`, `link`) VALUES
(28, '1701198296.0705-foto-N.jpeg', 'teste', 'D', 'teste', 'dsdasdasd');

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `ordem` int DEFAULT NULL,
  `url_amigavel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id`, `titulo`, `ordem`, `url_amigavel`) VALUES
(11, 'Direito e Justiça', 1, 'direito-e-justica'),
(12, 'Saúde', 2, 'saude'),
(13, 'Eventos e Cursos', 3, 'eventos-e-concursos'),
(14, 'Seguros', 4, 'seguros'),
(15, 'Livros e Editoras', 5, 'livros-e-editoras'),
(16, 'Esporte', 6, 'esporte'),
(17, 'Franquias', 7, 'franquias'),
(18, 'Educação', 8, 'educacao'),
(19, 'Economia e Empresa', 9, 'economia-e-empresas'),
(20, 'Ciência e Meio Ambiente', 10, 'ciencia-meio-ambiente'),
(21, 'Geral', 11, 'geral'),
(22, 'Hotelaria', 12, 'hotelaria'),
(23, 'Transportes', 13, 'transportes'),
(24, 'Entretenimento e Arte', 14, 'entretenimento-e-arte'),
(25, 'Tecnologia e Serviços', 15, 'tecnologia-e-servicos'),
(26, 'Direito e Justiça', 1, 'direito-e-justica'),
(27, 'Saúde', 2, 'saude'),
(28, 'Eventos e Cursos', 3, 'eventos-e-concursos'),
(29, 'Seguros', 4, 'seguros'),
(30, 'Livros e Editoras', 5, 'livros-e-editoras'),
(31, 'Esporte', 6, 'esporte'),
(32, 'Franquias', 7, 'franquias'),
(33, 'Educação', 8, 'educacao'),
(34, 'Economia e Empresa', 9, 'economia-e-empresas'),
(35, 'Ciência e Meio Ambiente', 10, 'ciencia-meio-ambiente'),
(36, 'Geral', 11, 'geral'),
(37, 'Hotelaria', 12, 'hotelaria'),
(38, 'Transportes', 13, 'transportes'),
(39, 'Entretenimento e Arte', 14, 'entretenimento-e-arte'),
(40, 'Tecnologia e Serviços', 15, 'tecnologia-e-servicos');

-- --------------------------------------------------------

--
-- Table structure for table `colunistas`
--

CREATE TABLE `colunistas` (
  `id` int NOT NULL,
  `nome` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telefone` varchar(30) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `descricao` text,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int NOT NULL,
  `favicon` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `linkedln` varchar(255) DEFAULT NULL,
  `tiktok` varchar(255) DEFAULT NULL,
  `nome_empresa` varchar(255) DEFAULT NULL,
  `endereco` varchar(255) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `cep` varchar(255) DEFAULT NULL,
  `cnpj` varchar(250) NOT NULL,
  `logo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `favicon`, `facebook`, `twitter`, `instagram`, `youtube`, `linkedln`, `tiktok`, `nome_empresa`, `endereco`, `telefone`, `email1`, `email2`, `cep`, `cnpj`, `logo`) VALUES
(1, '1700758175.412-favicon-N.png', '#ertretert', '#retretr', '#ertretert', '#ertertret', '#ertretert', '#retretert', '#retretert', NULL, '#ertretret', '#retretert', '#ertertret', NULL, '#ertretret', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `depoimentos`
--

CREATE TABLE `depoimentos` (
  `id` int NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `depoimento` text,
  `foto` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `newsletters`
--

CREATE TABLE `newsletters` (
  `id` int NOT NULL,
  `nome` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `planos`
--

CREATE TABLE `planos` (
  `id` int NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `conteudo` text,
  `foto` varchar(255) DEFAULT NULL,
  `creditos` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `planos`
--

INSERT INTO `planos` (`id`, `titulo`, `valor`, `conteudo`, `foto`, `creditos`, `id_usuario`) VALUES
(1, 'Gratis', 0, '&amp;lt;p&amp;gt;teste&amp;lt;/p&amp;gt;\r\n', '1698268306.2835-foto-N.png', 5, NULL),
(2, 'teste1', 500, '&amp;lt;p&amp;gt;teste&amp;lt;/p&amp;gt;\r\n', '1700655917.3112-foto-N.png', 100, NULL),
(3, 'teste 3', 500, '&amp;lt;p&amp;gt;teste&amp;lt;/p&amp;gt;\r\n', '1700655949.4816-foto-N.png', 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `titulo` varchar(150) DEFAULT NULL,
  `conteudo` text,
  `foto` varchar(150) DEFAULT NULL,
  `resumo` text,
  `id_categoria` int DEFAULT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'N',
  `legenda` varchar(255) DEFAULT NULL,
  `destaque` enum('S','N') NOT NULL DEFAULT 'N',
  `url_amigavel` varchar(255) DEFAULT NULL,
  `postado_por` varchar(255) DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `excluido` enum('S','N') NOT NULL DEFAULT 'N',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `titulo`, `conteudo`, `foto`, `resumo`, `id_categoria`, `ativo`, `legenda`, `destaque`, `url_amigavel`, `postado_por`, `id_usuario`, `excluido`, `created_at`, `updated_at`) VALUES
(5, 'teste1', '&amp;lt;p&amp;gt;teste&amp;lt;/p&amp;gt;\r\n', '1698438542.4362-foto-N.png', 'teste', 14, 'S', 'teste', 'N', 'teste1', 'teste', 1, 'N', '2023-10-27 22:29:02', '2023-11-22 19:58:46'),
(6, 'teste 2', '&amp;lt;p&amp;gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos itaque expedita temporibus at non error, molestiae dolorum illo commodi, harum porro labore explicabo inventore repellat aspernatur fugiat ad sequi. Velit architecto recusandae aliquid necessitatibus porro repudiandae? Expedita aspernatur iusto impedit labore, magnam suscipit ab odit officiis perspiciatis molestias nisi, fugiat, ad natus cum sint sed neque voluptate asperiores nulla! Esse qui temporibus consectetur iusto corrupti? Molestias aliquid tenetur, beatae obcaecati porro sit nemo! Fugiat repellendus dolor in nemo rerum dolorum distinctio eligendi laboriosam cum illo obcaecati voluptatibus mollitia earum, perferendis culpa tempora facere impedit dolores veritatis deleniti quas doloremque adipisci.&amp;lt;/p&amp;gt;\r\n', '1699978814.9566-foto-N.jpeg', 'teste', 11, 'S', 'teste', 'N', 'teste-2', 'teste', 4, 'N', '2023-11-14 16:20:14', '2023-11-22 19:59:03'),
(7, 'teste 3', '&amp;lt;p&amp;gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos itaque expedita temporibus at non error, molestiae dolorum illo commodi, harum porro labore explicabo inventore repellat aspernatur fugiat ad sequi. Velit architecto recusandae aliquid necessitatibus porro repudiandae? Expedita aspernatur iusto impedit labore, magnam suscipit ab odit officiis perspiciatis molestias nisi, fugiat, ad natus cum sint sed neque voluptate asperiores nulla! Esse qui temporibus consectetur iusto corrupti? Molestias aliquid tenetur, beatae obcaecati porro sit nemo! Fugiat repellendus dolor in nemo rerum dolorum distinctio eligendi laboriosam cum illo obcaecati voluptatibus mollitia earum, perferendis culpa tempora facere impedit dolores veritatis deleniti quas doloremque adipisci.&amp;lt;/p&amp;gt;\r\n', '1699979258.313-foto-N.jpeg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos itaque expedita temporibus at non error, molestiae dolorum illo commodi, harum porro labore explicabo inventore repellat aspernatur fugiat ad sequi. Velit architecto recusandae aliquid necessitatibus porro repudiandae? Expedita aspernatur iusto impedit labore, magnam suscipit ab odit officiis perspiciatis molestias nisi, fugiat, ad natus cum sint sed neque voluptate asperiores nulla! Esse qui temporibus consectetur iusto corrupti? Molestias aliquid tenetur, beatae obcaecati porro sit nemo! Fugiat repellendus dolor in nemo rerum dolorum distinctio eligendi laboriosam cum illo obcaecati voluptatibus mollitia earum, perferendis culpa tempora facere impedit dolores veritatis deleniti quas doloremque adipisci.', 15, 'S', 'teste', 'N', 'teste-3', 'teste', 4, 'N', '2023-11-14 16:27:38', '2023-11-22 19:59:27'),
(8, 'teste 4', '&amp;lt;p&amp;gt;Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente libero nobis vel natus, at laborum doloribus quo ducimus nam veritatis ab sunt obcaecati culpa maiores facere, harum et perspiciatis neque possimus hic esse! Minus voluptatum, officiis reprehenderit impedit amet ipsum sed aut. Iure debitis voluptatum vitae? Libero doloribus pariatur ea hic rem ad vitae, labore id dolor expedita sed numquam! Aliquam iure vero expedita obcaecati esse at accusamus perferendis totam modi laudantium. Molestias cupiditate molestiae, dicta ipsam blanditiis odio iusto. Optio error vitae aliquid voluptatum rerum consequuntur commodi cum quo harum, fuga qui excepturi aut velit ducimus est laudantium quasi?&amp;lt;/p&amp;gt;\r\n', '1699979510.9711-foto-N.jpeg', 'teste', 20, 'S', 'teste', 'N', 'teste-4', 'teste', 4, 'N', '2023-11-14 16:31:50', '2023-11-22 19:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `publicados`
--

CREATE TABLE `publicados` (
  `id` int NOT NULL,
  `id_post` int DEFAULT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `publicados`
--

INSERT INTO `publicados` (`id`, `id_post`, `titulo`, `link`) VALUES
(1, 6, 'Justiça em Foco', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(2, 6, 'Jornal Brasil', 'https://jornalbrasil.com.br/noticias/presidente-lula-recebe-brasileiros-resgatados-faixa-gaza--entre-eles-17-criancas-adolescentes'),
(3, 6, 'Revista Brasilia', 'https://revistabrasilia.com.br/desc-noticia.php?id=2944'),
(4, 6, 'Rede News', 'https://rede.news/desc-noticia.php?id=980&nome=Uni%C3%A3o%20Brasil:%20Luciano%20Bivar%20anuncia%20candidatura%20%C3%A0%20reelei%C3%A7%C3%A3o'),
(13, 7, 'Justiça em Foco', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(14, 7, 'Jornal Brasil', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(15, 7, 'Revista Brasilia', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(16, 7, 'Rede News', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(17, 8, 'Justiça em Foco', '#'),
(18, 8, 'Jornal Brasil', '#'),
(19, 8, 'Revista Brasilia', ''),
(20, 8, 'Rede News', ''),
(21, 8, 'Justiça em Foco', '#'),
(22, 8, 'Jornal Brasil', '#'),
(23, 8, 'Revista Brasilia', '#'),
(24, 8, 'Rede News', '#'),
(25, 5, 'Justiça em Foco', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(26, 5, 'Jornal Brasil', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(27, 5, 'Revista Brasilia', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados'),
(28, 5, 'Rede News', 'https://www.justicaemfoco.com.br/desc-noticia.php?id=147476&nome=jfsc_encerra_xviii_semana_nacional_da_conciliacao_com_mais_de_r_21_milhoes_em_acordos_homologados');

-- --------------------------------------------------------

--
-- Table structure for table `textos`
--

CREATE TABLE `textos` (
  `id` int NOT NULL,
  `titulo` varchar(250) DEFAULT NULL,
  `conteudo` text,
  `foto` varchar(150) DEFAULT NULL,
  `ativo` enum('S','N') NOT NULL DEFAULT 'N',
  `url_amigavel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `textos`
--

INSERT INTO `textos` (`id`, `titulo`, `conteudo`, `foto`, `ativo`, `url_amigavel`) VALUES
(5, 'Teste 2', 'teste', '1698177348.2428-foto-N.png', 'S', 'teste-2');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `cpf` varchar(80) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `plano_ativo` enum('S','N') NOT NULL DEFAULT 'N',
  `id_plano` int DEFAULT NULL,
  `creditos` int DEFAULT NULL,
  `adm` enum('S','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `cpf`, `telefone`, `senha`, `plano_ativo`, `id_plano`, `creditos`, `adm`) VALUES
(1, 'Marcio Maia', 'adm@grupoavs.com', NULL, NULL, '$2y$10$t.s.qDHhP4Jyvo0pPNluxufJjlSahpd55HM3o58MR5LUQ1XXDJNdC', 'N', NULL, NULL, 'S'),
(4, 'Teste 2', 'teste@teste.com', NULL, NULL, '$2y$10$zPg2VEyM/lberTyEV0v9UOpg/wxz434PD8f5wWhIcJ/SKJMn5iLj2', 'S', 1, 2, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colunistas`
--
ALTER TABLE `colunistas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newsletters`
--
ALTER TABLE `newsletters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `planos`
--
ALTER TABLE `planos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `publicados`
--
ALTER TABLE `publicados`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `textos`
--
ALTER TABLE `textos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `colunistas`
--
ALTER TABLE `colunistas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `newsletters`
--
ALTER TABLE `newsletters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `planos`
--
ALTER TABLE `planos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `publicados`
--
ALTER TABLE `publicados`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `textos`
--
ALTER TABLE `textos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
