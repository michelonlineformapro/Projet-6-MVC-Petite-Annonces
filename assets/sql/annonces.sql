-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 21 mars 2021 à 12:14
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `annonces`
--

-- --------------------------------------------------------

--
-- Structure de la table `administration`
--

DROP TABLE IF EXISTS `administration`;
CREATE TABLE IF NOT EXISTS `administration` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(255) NOT NULL,
  `password_admin` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administration`
--

INSERT INTO `administration` (`id_admin`, `email_admin`, `password_admin`) VALUES
(10, 'micpiwo@hotmail.fr', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id_article` int(11) NOT NULL AUTO_INCREMENT,
  `nom_article` varchar(255) NOT NULL,
  `description_article` text NOT NULL,
  `prix_article` float NOT NULL,
  `photo_article` varchar(255) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `utilisateur_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id_article`),
  KEY `cle etrangere catégorie` (`categorie_id`),
  KEY `cle etrangere utilisateur` (`utilisateur_id`),
  KEY `id de la region` (`region_id`),
  KEY `region_id` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id_article`, `nom_article`, `description_article`, `prix_article`, `photo_article`, `categorie_id`, `utilisateur_id`, `region_id`) VALUES
(1, 'Table basse', 'Vends table basse design avec rangement', 12.25, '../assets/img/table.jpg', 3, 1, 1),
(3, 'Frigidaire Hight-Tech', 'Vend frigidaire gris métallisé \r\nHauteur 1,45 m\r\nLargeur 0,55 m\r\nProfondeur 0,55m\r\nPartie haute congélateur \r\nAppareil en très bon état \r\nNe répond pas au mail \r\n', 1253.25, '../assets/img/table.jpg', 2, 4, 2),
(4, 'Robe Grise', ' Ces modèles se portent indépendamment de la saison et des occasions, grâce à un look élégant et intemporel.', 452.25, '../assets/img/robe.jpg', 5, 5, 11),
(11, 'Clavier pouris', 'Je vend mon clavier pouris car il est mort', 0.25, '../assets/img/clavier.jpg', 6, 1, 1),
(12, 'Pc portable Mac Book', 'Je le mets en vente car plus nécessaire pour moi,  disque dur de 500g changé par Apple pour plus de stockage. Il est sans aucun défaut et tourne impeccable. Je laisse une coque de protection et une prise rallonge.', 4125.25, '../assets/img/apple.jpg', 1, 1, 1),
(14, 'Chaise bébé', 'Vends chaise pour bébé rare!\r\nCe fixe sur une chaise normale.\r\nTrès pratique, ne prends pas de place.\r\nEn très très bonne état.\r\nAcheter 60€', 74.25, '../assets/img/chaise.jpg', 5, 6, 10),
(15, 'Gant de cuir', 'Gant de moto en cuir souple, protège du froid', 412.25, '../assets/img/gant.jpg', 5, 1, 1),
(16, 'rgreg', 'ergrege', 564, '../assets/img/robe.jpg', 2, 4, 2),
(17, 'Tetst ', 'tetststs dtef d', 5445, '../assets/img/gant.jpg', 2, 5, 11),
(20, 'fef', 'efefe', 45451, '../assets/img/robe.jpg', 2, 4, 2),
(21, 'god', 'god', 4512.25, '../assets/img/gant.jpg', 2, 1, 1),
(28, 'efzef', 'zefzef', 546, '../assets/img/robe.jpg', 2, 1, 1),
(29, 'Gant de cuir moustache', 'Gant de cuir moustache souple pour la moto', 7412.25, '../assets/img/gant.jpg', 5, 4, 2),
(30, 'Neo geo', 'La tolls sooeo fre des console', 12.25, '../assets/img/neo-geo-aes-console.jpg', 2, 4, 2),
(31, 'PLaysation 5', 'La console de jeux vidéo moderne', 1242.25, '../assets/img/play.jpg', 1, 5, 11),
(32, 'grgr', 'regerg', 4512, '../assets/img/play2.jpg', 3, 5, 11),
(33, 'rfgv', 'rgegr', 84, '../assets/img/jue.jpg', 2, 5, 11),
(34, 'table', 'gregrgerg', 4512, '../assets/img/table.jpg', 3, 5, 11),
(35, 'Moto Cross', 'Bonjour je vends ma 250 yzf de 2012 model a carbu comptabilisant environ 120h. \r\nUtilisée uniquement pour balade en forêt. Toujours lavée et graissée après chaque sortie \r\n\r\n', 4512.25, '../assets/img/moto.jpg', 4, 5, 11),
(36, 'Vélo de course', 'Vélo en bon etat 10 an s vendu avec un antivol 35 €', 35, '../assets/img/velo.jpg', 4, 6, 10),
(37, 'Enceinte Hifi', 'enceintes boiserie et hp en très bonne etat fonctionnent parfaitement pas d envoie a prendre a paris', 125.25, '../assets/img/enceinte.jpg', 1, 7, 7),
(38, 'Nes mini', 'Je vend ma NES version mini, avec 600 jeux à l\'intérieur, avec boîte d\'origine et deux manettes, 60 euros négociable dans la limite du raisonnable.', 235.25, '../assets/img/nes.jpg', 1, 7, 7),
(39, 'Four a bois', 'Fourneau en excellent état. Sert de cheminée four et table de cuisson \r\nPeut servir de mode de chauffage\r\nÀ venir chercher sur maure de Bretagne Val d\'anast\r\n1200 euros en espèces uniquement', 1200, '../assets/img/four.jpg', 6, 7, 7),
(40, 'Location', 'Résidence le britania\r\nAppartement - 4 personnes - 2 pièces - 1 chambre - 26 m²\r\nPistes de ski <  100 m - Alimentation < 100 m - Télévision - Lave vaisselle . . .\r\n480 € / semaine\r\nAPPARTEMENT PLEIN CENTRE SKIS AUX PIEDS AVEC PLACE DE PARKING COUVERT', 480, '../assets/img/loc.jpg', 6, 8, 8),
(41, 'Casserole', 'Vends très belle série de 7 casseroles en cuivre.\r\nAncienne et complète.\r\n\r\nAvec en plus \r\n- 2 louches\r\n- 1 passoire', 35, '../assets/img/case.jpg', 6, 8, 8),
(42, 'Carburateur', 'Bonjour je vende mon carburateur 17,5 que j\'ai utiliser que une fois mais vue que ma 50 était morte il n\'a servi a rien.\r\nJe le vende pour 50€ négociable', 50, '../assets/img/carbu.jpg', 4, 8, 8),
(43, 'Siège auto Bébé', 'Siège auto de marque Bébé confort, de couleur noir.\r\nPratique, tourne sur lui même pour installer votre enfant confortablement et en toute simplicité.\r\nEst également disponible un siège  de couleur brune, avec les mêmes caractéristiques de fonctionnement.\r\nPrix d\'un siège auto = 40€\r\nSi vous prenez les deux, 70€.', 40, '../assets/img/siegebb.jpg', 6, 9, 9),
(44, 'Chemise Homme', 'Bonjour, je vend une chemise Homme de la marque Springfield, que l\'on m\'a offert mais jamais porté car pas à ma taille.', 20, '../assets/img/chemiseh.jpg', 5, 9, 9),
(45, 'Jeux SNES', 'Jeux sur SNES, tous originaux :\r\n\r\nTurrican 2 90e Fah\r\nTerranigma 80e Fah\r\nSoul Blazer 75e Fah\r\nMetroid 45e Fah\r\nCastlevania IV 35e Fah\r\n\r\n5 € par jeux', 5, '../assets/img/jeussnes.jpg', 1, 9, 9),
(46, 'Bocaux', 'Lot de bocaux en verre pour conserverie\r\nlot de 10 =  20 €', 20, '../assets/img/boc.jpg', 6, 10, 10),
(47, 'Cocotte Riz', 'Vd cocotte à riz \r\ndiamètre 24 cm\r\nprix 10 euros\r\n\r\nà prendre sur place', 10.5, '../assets/img/cocoteriz.jpg', 6, 10, 10),
(48, 'Vynil Dorothé', 'Vynil collector signé de Dorothé', 1245.25, '../assets/img/doro.jpg', 6, 10, 10),
(49, '407', 'Peugeot 407 hdi 136 chevaux boîte automatique finition executive féline\r\nKilometrage : 325 000 km\r\n\r\nLe contrôle technique ok, il a été fait le 12 août 2020. Avec double des clés', 1650, '../assets/img/honda.jpg', 4, 11, 11),
(50, 'Escarpin', 'Bonjour \r\nJe vend mes chaussure de marque Guess couleur corail en très bonne état dans leur boîte d’origine !! \r\nPorter très peu de fois !! \r\nPointure 38 \r\nA venir chercher sur place', 50.5, '../assets/img/shoe.jpg', 5, 11, 11),
(51, 'Pigeaon reproducteur', 'Je vends des jeunes couples de pigeons prêts à reproduire,ils sont issus de plusieurs races : Texan - Hubbel - Sotto.\r\nPigeonneaux entre 500 et 600 grammes.\r\nProduction garantie ou échangées.\r\nPrix 25 euros le couple.\r\nJe ne réponds pas aux mails.', 25, '../assets/img/pigeaon.jpg', 6, 11, 11),
(52, 'Trench Coat Beige', 'Trench mi long en bon état de la marque Osley \r\nCouleur : gris clair\r\nTaille 36\r\n\r\nA venir chercher sur place ou à récupérer Place Saint Marc Rouen rive droite', 10, '../assets/img/trench.jpg', 5, 12, 12),
(53, 'Bac peinture', 'Bac à peinture grand format 32,5 x 40,5, \r\n2 euros pièce ou 10 euros les 6', 2, '../assets/img/bac.jpg', 6, 12, 12),
(54, 'Commode Bois', 'Commode en bon état \r\nLg : 82 cm\r\nPrf : 44 cm\r\nHt : 80 cm', 50, '../assets/img/meublebois.jpg', 3, 12, 12),
(55, 'Bouilloire 1.8L inox neuve', 'Bouilloire inox neuf.\r\nJamais utiliser. Dans sa boite d\'origine\r\n1.8l\r\nArret automqtique.\r\n15€', 15, '../assets/img/boi.jpg', 6, 13, 13),
(56, 'Buro PC', 'largeur  80  cm\r\nrepose  pieds\r\npratique et simple', 10, '../assets/img/buro.jpg', 3, 13, 13),
(57, 'Service à café', 'vends service à café très bon état blanc galon fleuri et doré.\r\ncomposé de:\r\n11 tasses et soucoupes\r\n pot à lait\r\n sucrier et verseuse', 15, '../assets/img/cafe.jpg', 6, 13, 13),
(58, 'Lampe original', 'Lampe du créateur DRIMER achetée dans un magasin luminaire à Mulhouse .', 152.25, '../assets/img/lamp.jpg', 3, 13, 13),
(68, 'Jeux DS', 'Jeux pour Nintendo DS', 125.25, '../assets/img/juju.jpg', 1, 14, 3),
(69, 'Cd Commodores', 'COMMODORES : Machine Gun\r\nédition 1998\r\nEn parfait état', 15, '../assets/img/cd.jpg', 1, 14, 3),
(70, 'Porte cle tgv', '******************** TGV ORANGE *****************\r\n\r\nMes autres ventes taper MLCA\r\nRef  386    (815 A\r\n******************  FRAIS DE PORT COMPRIS', 25.15, '../assets/img/portecle.jpg', 6, 14, 3),
(71, 'Recepteur TNT', 'Bonjour vend récepteur satellites multimédia hdmi  Usb.', 4125.25, '../assets/img/tnt.jpg', 1, 15, 4),
(72, 'Micro Onde', 'Micro onde Samsung trés bon etat peu utilisé', 125.25, '../assets/img/microonde.jpg', 2, 15, 4),
(73, 'Trotinette', 'trottinette enfant bon etat pneu gonflé', 45.25, '../assets/img/tro.jpg', 4, 15, 4),
(74, '2 CV', 'vend ma 2cv spécial 6 de 81,car je n\'ai plus le temps et pas de garage pour la rénover !!!\r\nj\'ai changé:\r\nl\'allumage\r\n la pompe a essence\r\nbobine\r\nles durites du réservoir au moteur\r\nla capote\r\nje  fourni le faisceau neuf du cite ami de la 2cv il faut le changer\r\nJe la vend en état et je n\'ai pas passer le contrôle technique, le moteur tourne bien !', 125.25, '../assets/img/2cv.jpg', 4, 16, 5),
(75, 'Tourne Disque', 'Beau tourne disque bon état', 224.25, '../assets/img/dik.jpg', 1, 16, 5),
(76, 'Living Blanc', 'ENSEMBLE  d\'éléments modulables composants ce LIVING.\r\nCOULEUR: rose  très clair\r\n6 éléments  avec tiroirs,niches ouvertes,rangements avec portes.\r\nnombreuses étagères.\r\nDIMENSION: Hors tout selon photo L 350 cm  X  H 205 cm X l 43cm .\r\n  Largeurs détaillées de chacun des éléments sur photo.\r\nCONTACT  UNIQUEMENT PAR TELEPHONE', 1452.35, '../assets/img/armoire.jpg', 3, 16, 5),
(77, 'Salon jardin', 'Vend salon de jardin 8 places + 1 pouf.\r\nCoussins blanc bon état.\r\nplateau en verre.\r\nDimension 2.29 ml x 1.15 ml.\r\nfauteuils confortable.', 417.75, '../assets/img/jardin.jpg', 3, 17, 6),
(78, 'Imprimante', 'Bonjour \r\nJe vends mon imprimante Canon 3650 PIXMA.\r\nElle ne scanne pas. D\'où son prix.\r\nImprimante très fonctionnelle et très facile d\'utilisation. \r\nLes cartouches compatibles peuvent être utilisées pour éviter les prix exorbitants des cartouches d\'origine.\r\n\r\nÀ venir chercher. \r\nCordialement', 745.25, '../assets/img/imp.jpg', 1, 17, 6),
(79, 'Pièce de monaie', '9 pièces de monnaies anciennes anglaises Grande Bretagne / Angleterre / Royaume Uni\r\n3 pence :\r\n1942 * 1\r\n1944 * 1\r\n1945 * 1\r\n1960 * 1\r\n1965 * 1\r\n1967 * 4\r\n\r\n5€ le lot\r\n\r\nVente à l’unité possible, faire offre\r\n\r\nN\'hésitez pas à m\'envoyer un message, je réponds dans la journée', 4512.25, '../assets/img/piece.jpg', 6, 17, 6);

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id_categorie`, `type_categorie`) VALUES
(1, 'Multimedias'),
(2, 'Electro-menager'),
(3, 'Meubles'),
(4, 'Véhicules'),
(5, 'Modes'),
(6, 'Divers');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_regions` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) NOT NULL,
  PRIMARY KEY (`id_regions`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_regions`, `nom_region`) VALUES
(1, 'grand_est'),
(2, 'aquitaine'),
(3, 'ra_auvergne'),
(4, 'normandie'),
(5, 'bourgogne_fc'),
(6, 'bretagne'),
(7, 'centre'),
(8, 'corse'),
(9, 'ile_france'),
(10, 'occitanie'),
(11, 'haut_france'),
(12, 'pays_loire'),
(13, 'paca');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `nom_utilisateur` varchar(255) NOT NULL,
  `email_utilisateur` varchar(255) NOT NULL,
  `password_utilisateur` varchar(255) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom_utilisateur`, `email_utilisateur`, `password_utilisateur`) VALUES
(1, 'micpiwo', 'micpiwo@hotmail.fr', 'admin'),
(4, 'robert', 'robert@lavente.fr', 'lavente'),
(5, 'sophie', 'sophie@cool.fr', 'cool'),
(6, 'tom', 'tom@vendeur.fr', 'tomtom'),
(7, 'laurent', 'laurent@hotmail.fr', 'laurent'),
(8, 'marie', 'marie@cok.fr', 'marie'),
(9, 'paul', 'paul@cmoi.fr', 'paul'),
(10, 'jeanne', 'jeanne@gmail.com', 'jeanne'),
(11, 'hubert', 'hubert@hotmail.fr', 'hubert'),
(12, 'celine', 'celine@yahoo.com', 'celine'),
(13, 'ledernier', 'ledernier@okgood.fr', 'ledernier'),
(14, 'bobdu3', 'bobdu3@hotmail.fr', 'bobdu3'),
(15, 'leanormande', 'leanormande@gmail.com', 'leanormande'),
(16, 'jeniferbougogne', 'jenifferbougogne@hotmail.fr', 'jenifer'),
(17, 'marcbreton', 'marcbreton@gmail.com', 'marc');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`utilisateur_id`) REFERENCES `utilisateurs` (`id_utilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id_regions`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
