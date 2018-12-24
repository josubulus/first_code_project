-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2018 at 11:35 AM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demarchage`
--

-- --------------------------------------------------------

--
-- Table structure for table `conseils`
--

CREATE TABLE `conseils` (
  `id` int(11) NOT NULL,
  `date_conseil` datetime DEFAULT NULL,
  `conseil` text NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `conseils`
--

INSERT INTO `conseils` (`id`, `date_conseil`, `conseil`, `id_membre`) VALUES
(19, '2018-12-23 19:22:27', '   a faire : \r\nsurveiller les réponse de néo soft poei candidature envoyé\r\nrelancer formatin ADRAR en janvier\r\nrelancer adaming mi-janvier \r\n\r\n   en cours :\r\nAttente réponse adaming \r\nattente que lestage soit effectuer \r\n\r\ndemande de POEI pour neosoft envoyer a adaming \r\n\r\n-Objectif : trouver un stage d\'observation : voir les agence de com certain photographe graphiste et imprimerie\r\n\r\n--afficher les erreurs de php quand code movais dans ubuntu', 4),
(21, '2018-12-21 11:52:10', 'chaussette', 6);

-- --------------------------------------------------------

--
-- Table structure for table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int(11) NOT NULL,
  `nom` varchar(256) NOT NULL,
  `tel` varchar(256) NOT NULL,
  `mail` varchar(256) NOT NULL,
  `site` varchar(255) NOT NULL,
  `adresse` varchar(256) NOT NULL,
  `activite` varchar(256) DEFAULT NULL,
  `date_ajout` datetime DEFAULT NULL,
  `statut` int(11) NOT NULL,
  `statut_mail` int(11) NOT NULL,
  `date_mail` datetime DEFAULT NULL,
  `notes` text,
  `interret` int(11) NOT NULL DEFAULT '1',
  `id_membre` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `entreprises`
--

INSERT INTO `entreprises` (`id`, `nom`, `tel`, `mail`, `site`, `adresse`, `activite`, `date_ajout`, `statut`, `statut_mail`, `date_mail`, `notes`, `interret`, `id_membre`) VALUES
(9, 'PRODIRIS', '05 34 46 14 48', 'rien', '', '34 Boulevard de Peyramont, 31600 Muret', NULL, '2018-10-18 23:06:40', 4, 1, '2018-10-23 21:49:33', 'l\'entreprise ne prend pas de stagiaire', 1, 4),
(10, 'pixbulle', '+33 (0)5 82 95 18 14', 'pas de mail', '', '24 avenue du grand tétras 31860 Labarthe-sur-Lèze', 'dev web', '2018-10-19 00:41:01', 1, 1, NULL, 'Peut être un particulié, l\'adresse du siège social mène a une maison ', 1, 4),
(11, 'ALGO FACTORY', '(0) 582 955 345', 'contact@algo-factory.com', '', '35 Chemin du Chapitre  31100 Toulouse', NULL, '2018-10-19 00:43:53', 4, 2, '2018-10-23 21:47:14', 'Bonjour M. Cambus,\r\n\r\nMerci pour l\'intérêt porté à notre entreprise, malheureusement, nous ne pouvons donner suite à votre demande.\r\n\r\nBon courage dans votre recherche.\r\n\r\nBien cordialement,\r\nFrédéric Bonain ', 2, 4),
(12, 'la rookerie', '0000', 'contact@larookerie.fr', '', 'toulouse', NULL, '2018-10-19 00:44:55', 4, 1, NULL, 'A répondu très gentiement', 1, 4),
(13, 'digigeek', '+33 (0)5 31 98 08 02 port :+33 (0)6 51 60 65 23 ', 'contact@digeek.fr', '', '29 boulevard de Strasbourg  31000 Toulouse', NULL, '2018-10-19 00:47:20', 4, 2, NULL, 'A dis des stagiaire arrivent a la fin de l\'année', 1, 4),
(14, 'lounce', '05 82 95 00 24', 'contact@lounce.com    https://www.lounce.com/', '', '8 rue Maryse Hilsz, 31500 Toulouse', NULL, '2018-10-19 00:50:33', 3, 2, '2018-10-24 10:32:16', 'La boite a l\'air vraiment branché, par contre mail envoyé il y a un moment ce rendre a l\'entreprise pour aller plu loin dans la démarche\r\nle 26/10 j\'y suis passé mais répondra au mail directement n\'apprécie pas trop être démarché', 2, 4),
(15, 'ws interactive', '05 62 30 80 70 ', 'formulaire sur : https://www.ws-interactive.fr/contact/', '', '15 quai lucien lombard 31 toulouse', NULL, '2018-10-19 00:53:18', 1, 2, '2018-10-24 10:42:03', 'Bonjour,\r\nMerci de votre candidature. Compte tenu du nombre important de candidatures, nous vous prions de bien vouloir nous excuser de ne pas toujours pouvoir vous répondre.\r\n\r\nNom * : CAMBUS Damien\r\n\r\nCandidature spontanée', 2, 4),
(16, 'agoralys', ' (0)5 61 50 54 04 ', 'https://www.agoralys.com/contact-digital/', '', '32 allées Jean Jaurès 31000 Toulouse', 'a renseigné', '2018-10-19 00:54:45', 3, 2, '2018-10-22 13:32:46', 'très grosse société a allez voir ! ', 2, 4),
(20, 'izianet', ' 05 61 09 29 17 ', 'contact@izianet.com', '', 'IZIANET TOULOUSE [Siège]\r\nAgence web à Toulouse\r\n18 chemin de la violette 31240 L\'UNION\r\nTél. 05 61 09 29 17', 'agence web : site web\r\ne-commerce etc', '2018-10-23 17:42:31', 3, 2, '2018-10-24 10:25:18', 'Très intéressant note il recrute des stagiaires voir site : https://www.izianet.com/\r\nle : 26/10 : J\'y suis passé le : 26/11/2018 il ont pris mon contact le patron me rappelle', 1, 4),
(21, 'apformation', '05 34 61 26 23', 'contact@apformation.com', '', '150 rue Nicolas Louis Vauquelin\r\n31100 Toulouse', 'RÉSEAUX INFORMATIQUES\r\nCAO/DAO\r\nTERTIAIRE\r\nDEVELOPPEUR\r\n', '2018-10-23 17:49:47', 1, 2, '2018-10-24 10:35:46', '<h1>Javscript doit être maitrisé</h1>\r\n<p><em>Financé par la région !</em>\r\ncontact effectué par un formulaire sur le site\r\ncontrat de professionnalisation. demande niveau bac + 2 ou otodidacte demande niveau javascript minimum, on doit passer des test avant .</p>', 2, 4),
(22, '3wa', 'aller sur le site pour etre rapelé', 'aller sur le site pour etre rapelé', '', 'aller sur le site pour etre rapelé ', 'formation devellopeur', '2018-10-23 17:53:31', 1, 1, '2018-10-26 13:55:39', 'pas de news  a retest après le 30/10/2018 ça marche', 1, 4),
(23, 'web-6', '05 34 63 01 32', 'contact@web-6.fr', '', ' 7 Allée Jean Jaures toulouse // 13 Bis rue des Briquetiers. blagnac / http://web-6.fr/', 'développement web e-commerce etc', '2018-10-23 18:03:33', 3, 2, '2018-10-26 13:41:19', NULL, 1, 4),
(24, 'devidia', '05 32 02 39 75', 'contact@devidia.net', '', '77 Rue Pargaminières, 31000 Toulouse', 'développement web', '2018-10-23 19:22:58', 3, 2, '2018-10-24 10:23:00', 'il reste a démarcher sur place', 1, 4),
(25, 'jalis', '04 91 35 70 00', 'https://www.jalis.fr/recrutement-1.html', '', 'Delta center, 15 chemin de la Crabe\r\n31300\r\nTOULOUSE\r\n04 91 35 70 00 ', 'Développement web grosse boite', '2018-10-23 19:26:07', 3, 2, '2018-11-09 11:20:56', 'Mail envoyé via formulaire entreprise a démarcher sur place mais ils ne veulent pas de stagiaire', 1, 4),
(26, 'cosiweb', '05 61 80 31 65', 'https://www.cosiweb.fr/contactez-nous/', '', '1110 avenue l’Occitane, Technoparc 1 Bâtiment 4, 31670 Labège', 'développement wordpress etc.', '2018-10-23 19:32:16', 4, 2, '2018-10-24 10:14:56', 'message envoyé via formulaire de contact, il reste a démarcher sur place', 1, 4),
(27, 'dawan', 'rien', 'rien', '', 'carbonne 31390', 'FORMATION DEV', '2018-10-25 15:35:13', 3, 2, '2018-10-25 15:36:48', 'Contact fait sur le site : https://www.maformation-sudouest.fr/rebond?IdDi=3700492&IdDi1=0&IdDi2=0&IdDi3=0&MultiDI=False&Origine=professionnelle&DiCree=True&TypeDemande=Nonspecifie&ResultatDi=Ok&TypeActionDi=Postage\r\npas de retour voir entreprise adrar', 1, 4),
(28, 'ADRAR || relancer en janvier !!', 'rien', 'https://www.adrar-formation.com/contact-ok', 'https://www.adrar-formation.com/contact-ok', 'Parc Technologique du Canal, 2 Rue Irène Joliot Curie, 31520 Ramonville-Saint-Agne', 'formations', '2018-10-25 17:03:39', 1, 1, '2018-12-24 10:48:59', 'Dev web : 10 moi et peut commencer le 17/12/2018 ou avant avril 2019\r\nconcepteur : 9 moi peut etre pris en alternance, 9 moi \r\nprescrition = pas besoin de stage d\'observation. \r\n\r\nReunion d\'information confirmer très grande chance de financement ! passe devans wcs pour l\'instant \r\nvoir le contact adrar toulouse dans le téléphone gmail \r\n\r\nLaura KREBS\r\nAssistante administrative\r\n           \r\nTel: 05 34 31 38 10\r\nwww.adrar-formation.com\r\n\r\nMerci de me confirmer votre présence afin de vous inscrire.', 3, 4),
(33, 'docteur it', '05 82 95 40 22', 'portet@docteur-it.com', '', '80 route d\'Espagne\r\n31120 Portet-sur-Garonne', 'reparation mobile et autre', '2018-12-06 13:18:23', 4, 1, NULL, 'Trop de stagiaire actuellement trop débordé', 1, 4),
(34, 'pixolutions || MURET', '05 61 40 31 31', 'contact@pixolutions.fr', '', '54 bis avenue jacques Douzans\r\n31600 Muret – France', 'com dévellopement web photo', '2018-12-06 13:26:23', 3, 2, '2018-12-07 14:32:57', 'pas refusé mais formation signé doonc plu besoin pour le stage \r\nenvoyer un mail avec mon cv après coup de tel le 07/12/2018\r\nje dois y passer c\'est a coté de l\'appart', 1, 4),
(29, 'neo soft ||POE probable voir Adaming ||', '05 34 40 21 85', 'drhtoulouse@neo-soft.fr', 'https://www.neo-soft.fr/', 'Technoparc 8\r\n55 rue Jean Bart\r\n31 670 Labège', 'Développement logiciel : Angular...wx', '2018-10-26 13:10:09', 3, 2, '2018-12-21 11:56:47', '<em>mail envoyé a admaing a la date du mail attente retour </em>\r\nPOE : contact Vous pouvez envoyer votre CV + LM fcezera@adaming.fr ou la contacter au 07.86.40.78.23 :société Adaming\r\n\r\nréponse bien engager pour une poe récupérer les infos a pole emplois et tanté une demande chez néo soft \r\n\r\nLa demande de stage a été refusé tantative de demande de poei par mail le 26/11\r\n\r\nJ\'y suis passer le 26/10/2018 bien reçu j\'ai pu leur expliquer mes intentions. Il ont pris mon cv. ne prend pas de stagiaire habituellement\r\nA répondu, demande des détail sur le déroulement du stage coordonée du recruteur : \r\nMathieu Delzenne\r\n\r\nRecruteur\r\n\r\n06.70.91.71.14 | 05.34.40.21.86\r\n06/11/2018 delphin est sur le coup avec mathieu \r\n\r\nNéo-Soft Toulouse : \r\nTechnoparc 8, 55 rue Jean Bart \r\n31 670 Labège', 3, 4),
(30, 'wide code school', 'rien', 'https://wildcodeschool.fr/toulouse/', '', 'At Home - 32 rue des Marchands - Toulouse, fr', 'formation', '2018-10-26 14:24:52', 2, 1, '2018-12-23 12:14:04', 'Un rendez vous pour plus d\'information aura lieu  : le 30/10/2018 a 9h00 evenemenent reporter au planing vérifier l\'impact du site : Meetup : https://www.meetup.com/fr-FR/\r\nattention lier a mon compte facebook', 3, 4),
(31, 'DIGIKARE', '05 61 51 51 51 ', 'rien', '', 'blagnac https://www.digikare.com/#contact', 'dev mais a refusé', '2018-10-27 22:46:45', 4, 1, '2018-11-03 19:13:50', 'Damien,\r\n\r\nExcusez-nous, nous avons tardé à vous répondre.\r\nMalheureusement, notre structure est peu adaptée à un tel stage.\r\nNous sommes une jeune société, disposons de peu de salariés et avons une \"énorme\" ambition.\r\nJ\'espère que vous aurez reçu des réponses en temps et en heure et positives.\r\n\r\nEn vous souhaitant réussite !\r\nJe citerai Erik Meijer, \"le code l\'emportera !\"\r\n\r\nBien à vous,\r\nPascal Recchia\r\nDIGIKARE', 1, 4),
(35, 'agiteo', '05 61 73 63 31 //  06 25 73 19 63', 'contact@agiteo.fr', '', '1355 Route d’Ox\r\n31600 SEYSSES', 'stratégie com internet etc ', '2018-12-06 13:30:08', 4, 1, NULL, 'ne fait plu de site internet', 1, 4),
(36, 'bf production || MURET ', '05 61 56 48 02', 'info@bfproduction.com', '', '4 Quai St Marcet,\r\n31600 MURET', 'dev web com', '2018-12-07 13:22:27', 2, 2, '2018-12-07 14:49:48', 'C\'est bon convention signé \r\nplutot mercredi 12/12 passer avec pré convention a partir de 11h00 du matin \r\nJ\'ai envoyé un mail suite a sont contact téléphonique il doit me rappeler et il est peut être interressé', 1, 4),
(50, 'caca', '05 61 87 09 40', 'caca', 'caca', 'caca', 'caca', '2018-12-24 10:45:35', 2, 1, NULL, '<em>j\'ai chi&</em>', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `groupes`
--

CREATE TABLE `groupes` (
  `id` int(11) NOT NULL,
  `nom-groupes` varchar(255) NOT NULL,
  `droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `liens_entreprises_membres`
--

CREATE TABLE `liens_entreprises_membres` (
  `id_entreprise` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `membres`
--

CREATE TABLE `membres` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_inscription` date NOT NULL,
  `status_membre` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membres`
--

INSERT INTO `membres` (`id`, `pseudo`, `pass`, `email`, `date_inscription`, `status_membre`) VALUES
(4, 'josubulus', '$2y$10$fIACICWqX1RqcV2.nOm/XuYsd.shAirQetxh7okr.x4ABapSQZECS', 'damien.cambus@gmail.com', '2018-12-20', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `conseils`
--
ALTER TABLE `conseils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membres`
--
ALTER TABLE `membres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `conseils`
--
ALTER TABLE `conseils`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT for table `membres`
--
ALTER TABLE `membres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
