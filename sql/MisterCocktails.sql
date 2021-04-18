-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 10, 2021 at 03:42 PM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `MisterCocktails`
--
CREATE DATABASE IF NOT EXISTS `MisterCocktails` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `MisterCocktails`;

-- --------------------------------------------------------

--
-- Table structure for table `Cocktail`
--

CREATE TABLE `Cocktail` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `description` text,
  `urlPhoto` varchar(255) DEFAULT NULL,
  `dateConception` date DEFAULT NULL,
  `prixMoyen` float DEFAULT NULL,
  `idFamille` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cocktail`
--

INSERT INTO `Cocktail` (`id`, `nom`, `description`, `urlPhoto`, `dateConception`, `prixMoyen`, `idFamille`) VALUES
(1, 'Aperol Spritz', 'Le Spritz est un cocktail datant du siècle dernier. Il aurait été inventé par des soldats autrichiens qui trouvaient le vin italien trop chargé en alcool.<br><br>L’auriez-vous deviné ?', 'aperol-spritz.jpg', '1938-01-01', 9.75, 6),
(2, 'Mojito', 'La création du Mojito remonte au XVIe siècle lorsque Francis Draque, le célèbre corsaire anglais, avait pour habitude de célébrer ses pillages en sirotant à La Havane, du tafia (l’ancêtre du rhum), aromatisé de quelques feuilles de menthe et de citron.', 'mojito.jpg', '1583-01-01', 10, 2),
(3, 'Piña Colada', 'Le cocktail Piña Colada puise ses origines à Puerto Rico où il a été inventé par un barman de l’hôtel Caribe Hilton en 1954. Décrétée 30 ans plus tard boisson nationale, cet élixir doux et fruité concentre dans le verre toutes les saveurs ensoleillées des Caraïbes.', 'pina-colada.jpg', '1954-01-01', 8.85, 2),
(6, 'Punch', 'Historiquement, le punch date du XVIe siècle. Il aurait été créé par des marins britanniques en mélangeant du Tafia (un genre de rhum brut) qui était embarqué sur les navires, avec d’autres ingrédients.', 'punch.jpg', '1532-01-01', 9, 2),
(7, 'Punch Exotique', 'Historiquement, le punch date du XVIe siècle. Il aurait été créé par des marins britanniques en mélangeant du Tafia (un genre de rhum brut) qui était embarqué sur les navires, avec d’autres ingrédients.', 'punch-exotique.jpg', '1532-01-01', 10.55, 2),
(8, 'Soupe de Champagne', 'À l’origine, c’était Pierre «Dom» Pérignon (1635-1713) qui dirigeait un monastère à Reims et qui a marqué l’histoire du champagne tout en contribuant beaucoup à sa renommée.', 'soupe-champagne.jpg', '1621-01-01', 12.35, 4),
(9, 'Caipirinha', 'La caïpirinha est un cocktail brésilien préparé à base de cachaça, de sucre de canne et de citron vert. Créé par les paysans dont il tirerait l\'origine de son nom, ce cocktail est très populaire et largement consommé dans les restaurants, bars et boîtes de nuit.', 'caipirinha.webp', '1918-01-01', 10, 7),
(10, 'Blue Lagoon ', 'Le Blue Lagoon est un cocktail à base de vodka, de curaçao bleu et de jus de citron. Il est aussi appelé le « lagon bleu » par sa traduction. Il fut créé par Andy MacElhone au Harry\'s New York Bar à Paris, en 1960.', 'blue_lagoon.webp', '1960-01-01', 11, 1),
(11, 'Vodka martini', 'Ce cocktail est réalisé en combinant vodka, vermouth sec, et glace, dans un shaker, ou dans un verre mélangeur, avec deux dosages répandus : quatre doses, ou six doses de vodka, pour une de vermouth.', 'vodka_martini.webp', '1933-01-01', 14, 1),
(16, 'Ace', 'De la carotte, de la carotte et de la carotte', '6022b082a2ef0-carot.webp', '2020-01-01', 5, 5),
(17, 'Sex On The Beach', 'L\'origine du Sex on the Beach, comme la plupart des cocktails, est plutôt légendaire. En 1987, en Floride, lors du Spring Break, un distributeur d\'alcool voulait commercialiser son nouveau produit : du schnaps à la pêche. ... Il répondit alors « Sex on The Beach ». Ce fut la naissance du célébrissime cocktail.', '6022b2320803f-sexonthebeach.webp', '1987-01-01', 10, 1),
(18, 'Cosmopolitan', 'Le Cosmopolitan, composé à l\'origine de vodka aromatisée au citron, de jus de canneberge, de jus de citron vert frais et de Cointreau, est sans doute l\'un des cocktails les plus connus au monde. Créé en 1988, il a intégré le panthéon de la pop culture quelques années plus tard grâce à la série Sex and the City.', '6022b2c40e913-cosmo.webp', '1988-01-01', 12, 1),
(19, 'Black Velvet', 'Selon certaines sources, ce cocktail aurait été créé en 1861 par le barman du Brooks\'s Club  à Londres ou par un de ses clients, pour rendre hommage au prince Albert, époux de la reine Victoria récemment décédé. Il aurait donc rempli une flûte à champagne avec une bière (peut-être de la Guinness) et du champagne.', '6022b716ab4eb-blackVelvet.webp', '1861-01-01', 15, 4),
(20, 'Marquisette', 'La recette du cocktail marquisette trouve son origine dans le Sud-Est de la France, notamment en Ardèche, dans la Haute-Loire et dans la Drôme. On consomme cette boisson lors de fêtes organisées par les villes et les villages, quand il faut désaltérer de nombreuses personnes.', '6022b81b5f3aa-marquisette.webp', '1954-01-01', 7, 2),
(21, 'B52', 'Le B-52 est un cocktail composé en proportions égales de Kahlua (liqueur de café), de Baileys (crème de whisky) et de Cointreau (liqueur d\'oranges douces et amères), nommé en hommage au bombardier B-52,\r\nLorsqu\'il est correctement préparé, ses ingrédients se séparent en trois couches visibles : la liqueur de café en bas, puis le Bailey\'s et enfin le Cointreau. Cette séparation est due aux densités relatives de ses ingrédients.', '6023a03f5335a-B52.webp', '1977-01-01', 7.7, 3),
(22, 'Daiquiri', 'Daiquirí est le nom d\'un village cubain (en) située non loin de Santiago de Cuba ainsi que celui d\'une mine de fer. Le terme serait un mot d\'origine taïno. Le cocktail aurait été inventé par un ingénieur américain, Jennings Cox, qui était à Cuba au moment de la guerre hispano-américaine.', '6023a0f0ec81f-Daiquiri.webp', '1932-01-01', 9.7, 2),
(32, 'test12', 'test', '6023b6d1a2e0c-Daiquiri.webp', '1369-01-01', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Famille`
--

CREATE TABLE `Famille` (
  `id` int(11) NOT NULL,
  `nomFamille` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Famille`
--

INSERT INTO `Famille` (`id`, `nomFamille`) VALUES
(1, 'Vodka'),
(2, 'Rhum'),
(3, 'Whisky'),
(4, 'Champagne'),
(5, 'Sans alcool'),
(6, 'Aperol'),
(7, 'Cachaça');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cocktail`
--
ALTER TABLE `Cocktail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idFamille` (`idFamille`);

--
-- Indexes for table `Famille`
--
ALTER TABLE `Famille`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cocktail`
--
ALTER TABLE `Cocktail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `Famille`
--
ALTER TABLE `Famille`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Cocktail`
--
ALTER TABLE `Cocktail`
  ADD CONSTRAINT `cocktail_ibfk_1` FOREIGN KEY (`idFamille`) REFERENCES `Famille` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
