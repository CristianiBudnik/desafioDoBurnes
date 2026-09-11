-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/09/2026 às 03:09
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
-- Banco de dados: `imdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) DEFAULT NULL,
  `banner` varchar(50) DEFAULT NULL,
  `ativo` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `banner`
--

INSERT INTO `banner` (`id`, `descricao`, `banner`, `ativo`) VALUES
(1, '<p>Avengers</p>', '1789087598.jpg', 'S'),
(2, '<p>Homem Aranha</p>', '1789087642.jpg', 'S'),
(3, '<p>Super Girl</p>', '1789087667.jpg', 'S');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `categoria`
--

INSERT INTO `categoria` (`id`, `categoria`) VALUES
(3, 'Ação'),
(5, 'Aventura'),
(7, 'Biografia'),
(2, 'Comédia'),
(4, 'Drama'),
(6, 'Ficção Científica'),
(8, 'Infantil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `filme`
--

CREATE TABLE `filme` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `original` varchar(100) NOT NULL,
  `ano` year(4) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `youtube` varchar(50) NOT NULL,
  `capa` varchar(50) NOT NULL,
  `sinopse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `filme`
--

INSERT INTO `filme` (`id`, `titulo`, `original`, `ano`, `categoria_id`, `youtube`, `capa`, `sinopse`) VALUES
(2, 'O Mandaloriano e Grogu', 'Mandalorian and Grogu', '2026', 3, 'VM4svpk07UU', '1_1779562407.jpeg', '\r\n\r\nO filme Star Wars: O Mandaloriano e Grogu acompanha o caçador de recompensas solitário Din Djarin e seu jovem aprendiz sensível à Força, Grogu, em uma nova aventura pela galáxia.A trama se passa após a queda do Império e foca na dinâmica de pai e filho.\r\n\r\nEnquanto a jovem Nova República tenta estabelecer a ordem, a dupla embarca em uma missão para caçar os esconderijos dos remanescentes imperiais espalhados pelo universo.\r\n\r\n'),
(3, 'Jogos Vorazes: A Cantiga dos Pássaros e das Serpentes', 'The Hunger Games: The Ballad of Songbirds and Snakes', '2026', 3, 'psF5B6jJBV4', '1_1779562498.jpg', '\r\nAnos após a guerra de Panem, a família de Coriolanus Snow enfrenta graves dificuldades financeiras e escassez de comida na Capital. Para salvar o nome da família, ele é selecionado para atuar como mentor durante a 10ª edição dos Jogos Vorazes. A sua tarefa, no entanto, não é fácil: ele recebe a missão de orientar Lucy Grey Baird, a garota tributo do empobrecido Distrito 12\r\n\r\n'),
(4, 'Michael', 'Michael', '2026', 7, '14YXeHKOBUY', '1_1779562574.jpg', '\r\nMichael é uma cinebiografia musical que narra a vida e o legado de Michael Jackson. O longa acompanha sua jornada desde a descoberta de seu talento como líder do Jackson Five até se consolidar como o \"Rei do Pop\", explorando suas ambições criativas e sua busca incansável para se tornar o maior artista do mundo.\r\n\r\n'),
(5, 'Mortal Kombat II', 'Mortal Kombat II', '2026', 3, 'mXHanabYyOg', '1_1779562683.jpg', '\r\nMortal Kombat 2 acompanha os defensores do Plano Terreno em uma batalha decisiva contra o imperador Shao Kahn da Exoterra no décimo e último torneio Mortal Kombat. Com o destino da Terra em jogo, Lorde Raiden convoca Johnny Cage, um astro de ação arrogante de Hollywood, para se juntar aos demais guerreiros e lutar pelo equilíbrio dos reinos.\r\n\r\n'),
(6, 'Todo mundo em Pânico 6', 'Scary Movie', '2026', 2, 'bO_APd0MNVU', '1_1779562774.jpg', '\r\nEm Todo Mundo em Pânico 6, Shorty (Marlon Wayans), Ray (Shawn Wayans), Cindy (Anna Faris) e Brenda (Hall) estão de volta na mira do assassino mascarado. Vinte seis anos após escaparem, o grupo se vê envolvido em mais uma trama repleta de ironia. Nenhum remake, prequel, requel, spin-off e sequência estará a salvo.\r\n\r\n'),
(7, 'O Diabo Veste Prada 2', 'The Devil Wears Prada 2', '2026', 4, 'QYfzd3o5XzI', '1_1779562854.jpg', '\r\nEm O Diabo Veste Prada 2, Miranda Priestly enfrenta o declínio da tradicional revista Runway em meio à crise da mídia impressa. Ela precisa negociar verbas publicitárias com Emily Charlton, sua ex-assistente que agora é uma poderosa executiva de luxo. Andy Sachs retorna como consultora para ajudar a revista.\r\n\r\n'),
(8, 'Street Fighter', 'Strete Fighter', '2026', 3, 'wgeXFqlISzc', '1_1779562915.jpg', '\r\nAmbientado em 1993, o filme live-action de Street Fighter acompanha Ryu (Andrew Koji) e Ken Masters (Noah Centineo) quando são recrutados pela misteriosa Chun-Li (Callina Liang) para o World Warrior Tournament. A jornada revela uma conspiração mortal por trás do torneio, forçando os lutadores a confrontarem seus passados para salvar o mundo.\r\n\r\n'),
(9, 'Supergirl', 'Supergirl', '2026', 5, 'XvaUMy2LcOQ', '1_1779562980.jpg', '\r\nA sinopse oficial do filme Supergirl (baseado na HQ A Mulher do Amanhã) acompanha Kara Zor-El. Enquanto lida com suas origens e traumas, ela é forçada a unir forças com uma companheira improvável em uma jornada cósmica épica de vingança e justiça contra um adversário inesperado e implacável\r\n\r\n'),
(10, 'Toy Story 5', 'Toy Story 5', '2026', 8, '-YbiBclEEgo', '1_1779563034.jpg', '\r\nEm Toy Story 5, Woody, Buzz Lightyear e Jessie enfrentam um novo e desafiador inimigo: a tecnologia. Quando a atenção de Bonnie é totalmente desviada por um novo e inteligente tablet interativo chamado Lilypad (ou Lily Ped), os brinquedos precisam lidar com a dura realidade da era digital.\r\n\r\n'),
(11, 'Vingadores: Doutor Destino', 'Avengers: Doomsday', '2026', 3, '3k9vXZ1A2O0', '1_1779563146.jpg', '\r\nVingadores: Doomsday (lançado no Brasil como Vingadores: Doutor Destino) é o quinto filme da equipe, com direção dos irmãos Russo. A sinopse oficial revelada pela Marvel Studios confirma que o Doutor Destino chegou oficialmente ao MCU, sendo um mestre da ciência e magia que desencadeará uma crise em cascata por todo o multiverso.\r\n\r\n'),
(12, 'Titanic', 'Titanic', '2023', 4, 'https://youtu.be/IH6_CA_ocqY', '1789088714.jpg', '&lt;p&gt;Titanic&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `salario` double NOT NULL,
  `datanascimento` date NOT NULL,
  `ativo` enum('Sim','Não') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `cpf`, `salario`, `datanascimento`, `ativo`) VALUES
(1, 'Administrador', 'admin@gmail.com', '$2y$10$UlRENRQON2SjaSYAxmYs4OydOa5NkiJTqdZMbKiJbH75yZ5Xfebom', '094.650.100-90', 3500, '1980-07-22', 'Sim'),
(2, 'Bill Gates', 'teste@teste.com', '$2y$10$ineMFivFCCHdP3gGGWfoR.RRqt.3jYDbIi.mXDPLjIM0vvYps9j7G', '424.454.180-20', 3500, '2000-10-20', 'Sim');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categoria` (`categoria`);

--
-- Índices de tabela `filme`
--
ALTER TABLE `filme`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `filme`
--
ALTER TABLE `filme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
