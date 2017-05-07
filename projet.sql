-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2017 at 01:08 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE IF NOT EXISTS `attendances` (
  `id_attendance` int(11) NOT NULL AUTO_INCREMENT,
  `attendance` varchar(1) NOT NULL,
  `medical_certificate` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id_attendance_sheet` int(11) NOT NULL,
  `note` int(2) DEFAULT NULL,
  PRIMARY KEY (`id_attendance`),
  KEY `email` (`email`,`id_attendance_sheet`),
  KEY `id_attendance_sheet` (`id_attendance_sheet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendances_sheets`
--

CREATE TABLE IF NOT EXISTS `attendances_sheets` (
  `id_attendance_sheet` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_session` int(11) NOT NULL,
  `week_number` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id_attendance_sheet`),
  KEY `id_type_session` (`id_type_session`,`week_number`,`email`),
  KEY `week_number` (`week_number`),
  KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `code` varchar(5) NOT NULL,
  `name` varchar(65) NOT NULL,
  `term` varchar(2) NOT NULL,
  `course_unit` varchar(2) NOT NULL,
  `credit` int(11) NOT NULL,
  `abbreviation` varchar(25) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code`, `name`, `term`, `course_unit`, `credit`, `abbreviation`, `bloc`) VALUES
('I1010', 'Algorithmique', 'Q1', 'UE', 6, 'Algo', 'Bloc1'),
('I1020', 'Analyse et Programmation Orientée Objet', 'Q1', 'UE', 5, 'APOO', 'Bloc1'),
('I1030', 'Analyse et Architecture des Données', 'Q2', 'UE', 5, 'Ianarch', 'Bloc1'),
('I1040', 'Structures de Données', 'Q2', 'UE', 6, 'SD', 'Bloc1'),
('I1050', 'Programmation Web : Bases', 'Q2', 'UE', 5, 'Web 1', 'Bloc1'),
('I1060', 'Introduction aux Systèmes d''Exploitation', 'Q2', 'UE', 5, 'OS 1', 'Bloc1'),
('I106A', 'Théorie des systèmes d’exploitation', 'Q2', 'AA', 2, 'OS (Th)', 'Bloc1'),
('I106B', 'Introduction à Linux', 'Q2', 'AA', 2, 'Linux', 'Bloc1'),
('I1070', 'Fonctionnement des Ordinateurs', 'Q1', 'UE', 6, 'FO', 'Bloc1'),
('I1080', 'L’Entreprise et ses Relations avec le Monde Economique', 'Q1', 'UE', 5, '', 'Bloc1'),
('I108A', 'Comptabilité', 'Q1', 'AA', 3, 'Comptabilité', 'Bloc1'),
('I108B', 'Economie et Fonctionnement de l''entreprise', 'Q1', 'AA', 3, 'Economie', 'Bloc1'),
('I1090', 'Mathématiques 1 : Outils Fondamentaux', 'Q1', 'UE', 4, 'Math 1', 'Bloc1'),
('I1100', 'Mathématiques 2 : Structures Avancées', 'Q2', 'UE', 6, 'Math 2', 'Bloc1'),
('I1110', 'Projet de Développement Web', 'Q2', 'UE', 3, 'Projet Web', 'Bloc1'),
('I1120', 'Anglais 1', 'Q1', 'UE', 4, 'Anglais 1', 'Bloc1');

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `code_serie` varchar(3) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  PRIMARY KEY (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `series`
--

INSERT INTO `series` (`code_serie`, `bloc`) VALUES
('1I1', 'Bloc1'),
('1I2', 'Bloc1'),
('1I3', 'Bloc1'),
('1I4', 'Bloc1');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  `code_serie` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `code_serie` (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`email`, `name`, `first_name`, `bloc`, `code_serie`) VALUES
('abdelhak.bakalem@student.vinci.be', 'BAKALEM', 'Abdelhak', 'Bloc2', NULL),
('adeline.duterre@student.vinci.be', 'DUTERRE', 'Adeline', 'Bloc2', NULL),
('adnan.jlassi@student.vinci.be', 'JLASSI', 'Adnan', 'Bloc1', NULL),
('adrian.dellavallemorinigo@student.vinci.be', 'DELLAVALLE MORINIGO', 'Adrian', 'Bloc1', NULL),
('adrian.gajda@student.vinci.be', 'GAJDA', 'Adrian', 'Bloc1', NULL),
('ahmad.bashir@student.vinci.be', 'BASHIR', 'Ahmad', 'Bloc2', NULL),
('alan.buelinckx@student.vinci.be', 'BUELINCKX', 'Alan', 'Bloc1', NULL),
('albinot.fetahi@student.vinci.be', 'Fetahi', 'Albinot', 'Bloc1', NULL),
('alexandre.coste-gandrey@student.vinci.be', 'COSTE-GANDREY', 'Alexandre', 'Bloc2', NULL),
('alexandre.hardi@student.vinci.be', 'HARDI', 'Alexandre', 'Bloc2', NULL),
('alexandre.maniet@student.vinci.be', 'MANIET', 'Alexandre', 'Bloc2', NULL),
('alexandre.maroun@student.vinci.be', 'Maroun', 'Alexandre', 'Bloc1', NULL),
('alexandre.sousadossantos@student.vinci.be', 'SOUSA DOS SANTOS', 'Alexandre', 'Bloc2', NULL),
('alexandre.wacquier@student.vinci.be', 'WACQUIER', 'Alexandre', 'Bloc1', NULL),
('alexis.rifaut@student.vinci.be', 'RIFAUT', 'Alexis', 'Bloc1', NULL),
('ali.godazendeh@student.vinci.be', 'GODAZENDEH', 'Ali', 'Bloc1', NULL),
('amandine.vangrunderbeeck@student.vinci.be', 'VAN GRUNDERBEECK', 'Amandine', 'Bloc2', NULL),
('amatus.umugabe@student.vinci.be', 'UMUGABE', 'Amatus', 'Bloc1', NULL),
('amaury.evrard@student.vinci.be', 'EVRARD', 'Amaury', 'Bloc3', NULL),
('anas.hammani@student.vinci.be', 'HAMMANI', 'Anas', 'Bloc1', NULL),
('andre.daspremont@student.vinci.be', 'DASPREMONT', 'André', 'Bloc3', NULL),
('andrea.occhilupo@student.vinci.be', 'OCCHILUPO', 'Andrea', 'Bloc1', NULL),
('andy.desmedt@student.vinci.be', 'De Smedt', 'Andy', 'Bloc1', NULL),
('andy.voiturier@student.vinci.be', 'VOITURIER', 'Andy', 'Bloc1', NULL),
('angecedrick.angaman@student.vinci.be', 'ANGAMAN', 'Ange Cedrick', 'Bloc1', NULL),
('anthony.maton@student.vinci.be', 'MATON', 'Anthony', 'Bloc3', NULL),
('anthony.pierre@student.vinci.be', 'PIERRE', 'Anthony', 'Bloc2', NULL),
('anthony.pyck@student.vinci.be', 'PYCK', 'Anthony', 'Bloc2', NULL),
('anthony.vancampenhault@student.vinci.be', 'VANCAMPENHAULT', 'Anthony', 'Bloc2', NULL),
('antoine.colet@student.vinci.be', 'COLET', 'Antoine', 'Bloc3', NULL),
('antoine.debroux@student.vinci.be', 'DEBROUX', 'Antoine', 'Bloc1', NULL),
('antoine.deroose@student.vinci.be', 'DE ROOSE', 'Antoine', 'Bloc1', NULL),
('antoine.lambricht@student.vinci.be', 'LAMBRICHT', 'Antoine', 'Bloc2', NULL),
('antoine.maniet@student.vinci.be', 'MANIET', 'Antoine', 'Bloc2', NULL),
('antoine.ramelot@student.vinci.be', 'RAMELOT', 'Antoine', 'Bloc1', NULL),
('antoine.verlant@student.vinci.be', 'VERLANT', 'Antoine', 'Bloc3', NULL),
('antonin.riche@student.vinci.be', 'RICHE', 'Antonin', 'Bloc2', NULL),
('arnaud.bourez@student.vinci.be', 'BOUREZ', 'Arnaud', 'Bloc1', NULL),
('arnaud.deboeck@student.vinci.be', 'DE BOECK', 'Arnaud', 'Bloc1', NULL),
('arnaud.etienne@student.vinci.be', 'ETIENNE', 'Arnaud', 'Bloc2', NULL),
('arnaud.poullet@student.vinci.be', 'POULLET', 'Arnaud', 'Bloc1', NULL),
('arnaud.rochez@student.vinci.be', 'ROCHEZ', 'Arnaud', 'Bloc3', NULL),
('arnaud.terryn@student.vinci.be', 'TERRYN', 'Arnaud', 'Bloc1', NULL),
('arthur.speicher@student.vinci.be', 'SPEICHER', 'Arthur', 'Bloc1', NULL),
('artjam.umanyan@student.vinci.be', 'Umanyan', 'Artjam', 'Bloc1', NULL),
('arturo.mozzon@student.vinci.be', 'MOZZON', 'Arturo', 'Bloc1', NULL),
('augustin.demeeusdargenteuil@student.vinci.be', 'de MEEuS d''ARGENTEUIL', 'Augustin', 'Bloc1', NULL),
('aurelien.lefebvre@student.vinci.be', 'LEFEBVRE', 'Aurélien', 'Bloc3', NULL),
('azeddine.mansour@student.vinci.be', 'Mansour', 'Azeddine', 'Bloc1', NULL),
('badreddine.lahrichi@student.vinci.be', 'LAHRICHI', 'Badreddine', 'Bloc1', NULL),
('bastien.dessy@student.vinci.be', 'DESSY', 'Bastien', 'Bloc1', NULL),
('bastien.dossantos@student.vinci.be', 'DOS SANTOS', 'Bastien', 'Bloc3', NULL),
('benjamin.berge@student.vinci.be', 'BERGÉ', 'Benjamin', 'Bloc2', NULL),
('benjamin.debosscher@student.vinci.be', 'De Bosscher', 'Benjamin', 'Bloc1', NULL),
('benjamin.declercq@student.vinci.be', 'DECLERCQ', 'Benjamin', 'Bloc2', NULL),
('benjamin.pierre@student.vinci.be', 'PIERRE', 'Benjamin', 'Bloc2', NULL),
('bill.brancart@student.vinci.be', 'BRANCART', 'Bill', 'Bloc3', NULL),
('bouchra.kh''leeh@student.vinci.be', 'KH'' LEEH', 'Bouchra', 'Bloc1', NULL),
('brian.diazalvarez@student.vinci.be', 'Diaz Alvarez', 'Brian', 'Bloc1', NULL),
('brieuc.seeger@student.vinci.be', 'SEEGER', 'Brieuc', 'Bloc1', NULL),
('bunyamin.aslan@student.vinci.be', 'ASLAN', 'Bunyamin', 'Bloc1', NULL),
('burim.kastrati@student.vinci.be', 'KASTRATI', 'Burim', 'Bloc1', NULL),
('cedric.martin@student.vinci.be', 'MARTIN', 'Cedric', 'Bloc1', NULL),
('cedric.tavernier@student.vinci.be', 'TAVERNIER', 'Cedric', 'Bloc2', NULL),
('chamil.chakhabov@student.vinci.be', 'CHAKHABOV', 'Chamil', 'Bloc1', NULL),
('christian.mendesrosa@student.vinci.be', 'MENDES ROSA', 'Christian', 'Bloc3', NULL),
('christophe.bortier@student.vinci.be', 'BORTIER', 'Christophe', 'Bloc2', NULL),
('christophe.driessen@student.vinci.be', 'DRIESSEN', 'Christophe', 'Bloc2', NULL),
('christophe.jabbour@student.vinci.be', 'Jabbour', 'Christophe', 'Bloc1', NULL),
('christopher.castel@student.vinci.be', 'CASTEL', 'Christopher', 'Bloc1', NULL),
('christopher.sacre@student.vinci.be', 'SACRÉ', 'Christopher', 'Bloc2', NULL),
('clement.dujardin@student.vinci.be', 'du JARDIN', 'Clément', 'Bloc2', NULL),
('colin.vandenbrande@student.vinci.be', 'VAN DEN BRANDE', 'Colin', 'Bloc1', NULL),
('corenthin.dubois@student.vinci.be', 'DUBOIS', 'Corenthin', 'Bloc2', NULL),
('cyril.hennen@student.vinci.be', 'HENNEN', 'Cyril', 'Bloc1', NULL),
('cyrille.hourant@student.vinci.be', 'HOURANT', 'Cyrille', 'Bloc1', NULL),
('damian.szacun@student.vinci.be', 'SZACUN', 'Damian', 'Bloc1', NULL),
('damien.kech@student.vinci.be', 'KECH', 'Damien', 'Bloc3', NULL),
('damien.meur@student.vinci.be', 'MEUR', 'Damien', 'Bloc2', NULL),
('damien.syemons@student.vinci.be', 'SYEMONS', 'Damien', 'Bloc3', NULL),
('dani.rochaazevedo@student.vinci.be', 'Rocha Azevedo', 'Dani', 'Bloc1', NULL),
('dattoan.nguyen@student.vinci.be', 'NGUYEN', 'Dat Toan', 'Bloc2', NULL),
('dawid.tararuj@student.vinci.be', 'Tararuj', 'Dawid', 'Bloc1', NULL),
('debrah.tinsia@student.vinci.be', 'TINSIA', 'Debrah', 'Bloc2', NULL),
('dejvi.kurti@student.vinci.be', 'KURTI', 'Dejvi', 'Bloc1', NULL),
('delanoe.pirard@student.vinci.be', 'PIRARD', 'Delanoe', 'Bloc3', NULL),
('diana.grama@student.vinci.be', 'Grama', 'Diana', 'Bloc1', NULL),
('diego.nuezsoriano@student.vinci.be', 'NUEZ SORIANO', 'Diego', 'Bloc2', NULL),
('djama.omar@student.vinci.be', 'OMAR', 'Djama', 'Bloc1', NULL),
('dorian.gruselin@student.vinci.be', 'GRUSELIN', 'Dorian', 'Bloc1', NULL),
('driss.bengeloune@student.vinci.be', 'BEN GELOUNE', 'Driss', 'Bloc1', NULL),
('driss.vandenheede@student.vinci.be', 'VANDENHEEDE', 'Driss', 'Bloc1', NULL),
('dylan.divito@student.vinci.be', 'DI VITO', 'Dylan', 'Bloc3', NULL),
('egide.kabanza@student.vinci.be', 'KABANZA', 'Egide', 'Bloc1', NULL),
('ekrem.ozturk@student.vinci.be', 'Özturk', 'Ekrem', 'Bloc1', NULL),
('emanuel.peroni@student.vinci.be', 'PERONI', 'Emanuel', 'Bloc1', NULL),
('emilien.durieu@student.vinci.be', 'DURIEU', 'Emilien', 'Bloc3', NULL),
('emre.tasyurek@student.vinci.be', 'TASYuREK', 'Emre', 'Bloc2', NULL),
('fabian.teichmann@student.vinci.be', 'TEICHMANN', 'Fabian', 'Bloc1', NULL),
('fabio.grumiro@student.vinci.be', 'GRUMIRO', 'Fabio', 'Bloc3', NULL),
('fany.bottemanne@student.vinci.be', 'BOTTEMANNE', 'Fany', 'Bloc3', NULL),
('felix.jacoby@student.vinci.be', 'JACOBY', 'Félix', 'Bloc2', NULL),
('filip.lolic@student.vinci.be', 'Lolic', 'Filip', 'Bloc1', NULL),
('florian.morel@student.vinci.be', 'MOREL', 'Florian', 'Bloc3', NULL),
('florian.sollami@student.vinci.be', 'SOLLAMI', 'Florian', 'Bloc1', NULL),
('florian.timmermans@student.vinci.be', 'TIMMERMANS', 'Florian', 'Bloc1', NULL),
('florian.verdonck@student.vinci.be', 'VERDONCK', 'Florian', 'Bloc1', NULL),
('françois.pecheur@student.vinci.be', 'Pecheur', 'François', 'Bloc1', NULL),
('françois.pochet@student.vinci.be', 'Pochet', 'François', 'Bloc1', NULL),
('frederic.hubert@student.vinci.be', 'HUBERT', 'Frédéric', 'Bloc2', NULL),
('gabriel.curatolo@student.vinci.be', 'CURATOLO', 'Gabriel', 'Bloc1', NULL),
('gabriel.delhaye@student.vinci.be', 'DELHAYE', 'Gabriel', 'Bloc2', NULL),
('gabriel.haba@student.vinci.be', 'HABA', 'Gabriel', 'Bloc2', NULL),
('gael.kifoumbi@student.vinci.be', 'KIFOUMBI', 'Gael', 'Bloc1', NULL),
('gael.leroy@student.vinci.be', 'LEROY', 'Gael', 'Bloc3', NULL),
('gaspard.devillenfagnedevogelsanck@student.vinci.be', 'de VILLENFAGNE de VOGELSANCK', 'Gaspard', 'Bloc2', NULL),
('gauthier.grandhenry@student.vinci.be', 'GRANDHENRY', 'Gauthier', 'Bloc1', NULL),
('gauthier.lallemand@student.vinci.be', 'LALLEMAND', 'Gauthier', 'Bloc2', NULL),
('geoffroy.frennet@student.vinci.be', 'FRENNET', 'Geoffroy', 'Bloc1', NULL),
('gilles.renson@student.vinci.be', 'RENSON', 'Gilles', 'Bloc2', NULL),
('gorgis.yaramis@student.vinci.be', 'YARAMIS', 'Gorgis', 'Bloc1', NULL),
('gregory.decraemer@student.vinci.be', 'DECRAEMER', 'Grégory', 'Bloc1', NULL),
('guillaume.lion@student.vinci.be', 'LION', 'Guillaume', 'Bloc1', NULL),
('guillaume.wery@student.vinci.be', 'WERY', 'Guillaume', 'Bloc1', NULL),
('guy.vassart@student.vinci.be', 'VASSART', 'Guy', 'Bloc1', NULL),
('hakan.poyraz@student.vinci.be', 'POYRAZ', 'Hakan', 'Bloc1', NULL),
('halil.top@student.vinci.be', 'TOP', 'Halil', 'Bloc1', NULL),
('hamza.guerrouaj@student.vinci.be', 'GUERROUAJ', 'Hamza', 'Bloc1', NULL),
('hamza.mahmoudi@student.vinci.be', 'MAHMOUDI', 'Hamza', 'Bloc1', NULL),
('hamza.mounir@student.vinci.be', 'MOUNIR', 'Hamza', 'Bloc3', NULL),
('hicham.elasri@student.vinci.be', 'EL ASRI', 'Hicham', 'Bloc1', NULL),
('hugues.demathelindepapigny@student.vinci.be', 'de Mathelin de Papigny', 'Hugues', 'Bloc1', NULL),
('ibrahim.mourade@student.vinci.be', 'MOURADE', 'Ibrahim', 'Bloc2', NULL),
('ikram.noorzaai@student.vinci.be', 'NOORZAAI', 'Ikram', 'Bloc1', NULL),
('ilias.barrani@student.vinci.be', 'BARRANI', 'Ilias', 'Bloc1', NULL),
('ilias.jafar@student.vinci.be', 'JAFAR', 'Ilias', 'Bloc1', NULL),
('ilias.tellihi@student.vinci.be', 'TELLIHI', 'Ilias', 'Bloc1', NULL),
('ismael.elfkihbenahmed@student.vinci.be', 'El F''Kih Ben Ahmed', 'Ismael', 'Bloc1', NULL),
('ismaila.abdoulahiadamou@student.vinci.be', 'ABDOULAHI ADAMOU', 'Ismaila', 'Bloc1', NULL),
('iulian.avram@student.vinci.be', 'Avram', 'Iulian', 'Bloc1', NULL),
('ivan.pessers@student.vinci.be', 'PESSERS', 'Ivan', 'Bloc3', NULL),
('jacques.yakoub@student.vinci.be', 'YAKOUB', 'Jacques', 'Bloc3', NULL),
('jean-bosco.rwibutso@student.vinci.be', 'RWIBUTSO', 'Jean-Bosco', 'Bloc2', NULL),
('jean-françois.cochart@student.vinci.be', 'COCHART', 'Jean-François', 'Bloc2', NULL),
('jean-françois.schweisthal@student.vinci.be', 'SCHWEISTHAL', 'Jean-François', 'Bloc3', NULL),
('jean-pacifique.mbonyincungu@student.vinci.be', 'MBONYINCUNGU', 'Jean-Pacifique', 'Bloc3', NULL),
('jean.dubuisson@student.vinci.be', 'DUBUISSON', 'Jean', 'Bloc1', NULL),
('jeremy.balcinhasgodinho@student.vinci.be', 'BALCINHAS GODINHO', 'Jérémy', 'Bloc1', NULL),
('jeremy.holodiline@student.vinci.be', 'Holodiline', 'Jeremy', 'Bloc1', NULL),
('jeremy.vandermotte@student.vinci.be', 'VANDER MOTTE', 'Jérémy', 'Bloc1', NULL),
('jerome.deborsu@student.vinci.be', 'DEBORSU', 'Jérome', 'Bloc1', NULL),
('jimmy.delacruzmallada@student.vinci.be', 'DE LA CRUZ MALLADA', 'Jimmy', 'Bloc3', NULL),
('joachim.vranken@student.vinci.be', 'VRANKEN', 'Joachim', 'Bloc1', NULL),
('joelle.maffomeleu@student.vinci.be', 'MAFFO MELEU', 'Joelle', 'Bloc1', NULL),
('johann.buxant@student.vinci.be', 'BUXANT', 'Johann', 'Bloc2', NULL),
('johnny.la@student.vinci.be', 'LA', 'Johnny', 'Bloc2', NULL),
('johnny.steutgens@student.vinci.be', 'STEUTGENS', 'Johnny', 'Bloc1', NULL),
('jolan.wathelet@student.vinci.be', 'WATHELET', 'Jolan', 'Bloc2', NULL),
('jonathan.visiedogil@student.vinci.be', 'Visiedo Gil', 'Jonathan', 'Bloc1', NULL),
('joris.pluton@student.vinci.be', 'PLUTON', 'Joris', 'Bloc1', NULL),
('jozef.sako@student.vinci.be', 'SAKO', 'Jozef', 'Bloc1', NULL),
('julien.doyen@student.vinci.be', 'DOYEN', 'Julien', 'Bloc1', NULL),
('julien.solinas@student.vinci.be', 'SOLINAS', 'Julien', 'Bloc2', NULL),
('julien.wets@student.vinci.be', 'WETS', 'Julien', 'Bloc1', NULL),
('junior.maduka@student.vinci.be', 'MADUKA', 'Junior', 'Bloc3', NULL),
('kadir.dagyaran@student.vinci.be', 'DAGYARAN', 'Kadir', 'Bloc1', NULL),
('kamil.arszagivelharszagi@student.vinci.be', 'ARSZAGI VEL HARSZAGI', 'Kamil', 'Bloc2', NULL),
('kamil.kowalczyk@student.vinci.be', 'KOWALCZYK', 'Kamil', 'Bloc1', NULL),
('kawtar.oumghar@student.vinci.be', 'OUMGHAR', 'kawtar', 'Bloc1', NULL),
('kei-jyu.hama@student.vinci.be', 'HAMA', 'Kei-Jyu', 'Bloc1', NULL),
('kevin.heylbroeck@student.vinci.be', 'HEYLBROECK', 'Kevin', 'Bloc2', NULL),
('kevin.merovallas@student.vinci.be', 'MERO VALLAS', 'Kevin', 'Bloc1', NULL),
('kevin.tang@student.vinci.be', 'Tang', 'Kevin', 'Bloc1', NULL),
('khalil.benazzouz@student.vinci.be', 'BENAZZOUZ', 'Khalil', 'Bloc1', NULL),
('klevis.xhakollari@student.vinci.be', 'XHAKOLLARI', 'Klevis', 'Bloc1', NULL),
('kodjo.adegnon@student.vinci.be', 'ADEGNON', 'Kodjo', 'Bloc3', NULL),
('konstantin.romanov@student.vinci.be', 'ROMANOV', 'Konstantin', 'Bloc3', NULL),
('kyrill.tircher@student.vinci.be', 'TIRCHER', 'Kyrill', 'Bloc2', NULL),
('lancelot.dewoutersdebouchout@student.vinci.be', 'de WOUTERS de BOUCHOUT', 'Lancelot', 'Bloc2', NULL),
('laurent.batsle@student.vinci.be', 'BATSLÉ', 'Laurent', 'Bloc3', NULL),
('leo.descamps@student.vinci.be', 'DESCAMPS', 'Léo', 'Bloc1', NULL),
('lionel.ovaert@student.vinci.be', 'OVAERT', 'Lionel', 'Bloc3', NULL),
('liseta.carcani@student.vinci.be', 'CARCANI', 'Liseta', 'Bloc1', NULL),
('logan.bauduin@student.vinci.be', 'BAUDUIN', 'Logan', 'Bloc1', NULL),
('logan.bourez@student.vinci.be', 'BOUREZ', 'Logan', 'Bloc1', NULL),
('loic.defosse@student.vinci.be', 'Defossé', 'Loïc', 'Bloc1', NULL),
('loic.stevens@student.vinci.be', 'STEVENS', 'Loïc', 'Bloc3', NULL),
('loic.willems@student.vinci.be', 'WILLEMS', 'Loic', 'Bloc1', NULL),
('lopodi.gaza@student.vinci.be', 'GAZA', 'Lopodi', 'Bloc1', NULL),
('lorenzo.lapage@student.vinci.be', 'LAPAGE', 'Lorenzo', 'Bloc1', NULL),
('lorenzo.lauricella@student.vinci.be', 'LAURICELLA', 'Lorenzo', 'Bloc1', NULL),
('louis.vanaken@student.vinci.be', 'VAN AKEN', 'Louis', 'Bloc1', NULL),
('loury.jacob@student.vinci.be', 'JACOB', 'Loury', 'Bloc1', NULL),
('lucas.malmport@student.vinci.be', 'Malmport', 'Lucas', 'Bloc1', NULL),
('lukas.greif@student.vinci.be', 'GREIF', 'Lukas', 'Bloc1', NULL),
('macblair.ballecer@student.vinci.be', 'BALLECER', 'Mac Blair', 'Bloc1', NULL),
('majd.fahmi@student.vinci.be', 'FAHMI', 'Majd', 'Bloc1', NULL),
('malo.misson@student.vinci.be', 'MISSON', 'Malo', 'Bloc1', NULL),
('mamadou.cisse@student.vinci.be', 'CISSÉ', 'Mamadou', 'Bloc2', NULL),
('marc.deburlet@student.vinci.be', 'de BURLET', 'Marc', 'Bloc3', NULL),
('marc.meganck@student.vinci.be', 'MEGANCK', 'Marc', 'Bloc1', NULL),
('marco.amory@student.vinci.be', 'AMORY', 'Marco', 'Bloc1', NULL),
('marcos.garciaaugusto@student.vinci.be', 'GARCIA AUGUSTO', 'Marcos', 'Bloc2', NULL),
('martin.d’hoedt@student.vinci.be', 'D’HOEDT', 'Martin', 'Bloc1', NULL),
('martin.kutzner@student.vinci.be', 'KUTZNER', 'Martin', 'Bloc1', NULL),
('martin.techy@student.vinci.be', 'TECHY', 'Martin', 'Bloc3', NULL),
('mathieu.descantonsdemontblanc@student.vinci.be', 'DESCANTONS de MONTBLANC', 'Mathieu', 'Bloc3', NULL),
('mathieu.marcq@student.vinci.be', 'MARCQ', 'Mathieu', 'Bloc1', NULL),
('mathieu.steenput@student.vinci.be', 'STEENPUT', 'Mathieu', 'Bloc3', NULL),
('max.marin@student.vinci.be', 'Marin', 'Max', 'Bloc1', NULL),
('maxime.demaubeuge@student.vinci.be', 'DE MAUBEUGE', 'Maxime', 'Bloc3', NULL),
('maxime.denuit@student.vinci.be', 'DENUIT', 'Maxime', 'Bloc2', NULL),
('maxime.pirlet@student.vinci.be', 'PIRLET', 'Maxime', 'Bloc2', NULL),
('maxime.poelaert@student.vinci.be', 'POELAERT', 'Maxime', 'Bloc1', NULL),
('maxime.verwilghen@student.vinci.be', 'VERWILGHEN', 'Maxime', 'Bloc3', NULL),
('mehdi.ibnlfassi@student.vinci.be', 'IBNLFASSI', 'Mehdi', 'Bloc1', NULL),
('melissa.strauven@student.vinci.be', 'STRAUVEN', 'Mélissa', 'Bloc3', NULL),
('meriam.mzoughi@student.vinci.be', 'MZOUGHI', 'Meriam', 'Bloc2', NULL),
('michael.andre@student.vinci.be', 'ANDRE', 'Michael', 'Bloc2', NULL),
('michel.debroux@student.vinci.be', 'De Broux', 'Michel', 'Bloc2', NULL),
('mickael.marlard@student.vinci.be', 'MARLARD', 'Mickael', 'Bloc2', NULL),
('mike.gaillet@student.vinci.be', 'GAILLET', 'Mike', 'Bloc3', NULL),
('milenko.vorkapic@student.vinci.be', 'VORKAPIC', 'Milenko', 'Bloc3', NULL),
('mohamed.hassouni@student.vinci.be', 'HASSOUNI', 'Mohamed', 'Bloc1', NULL),
('mohammed.chairibounekoub@student.vinci.be', 'Chairi Bounekoub', 'Mohammed', 'Bloc1', NULL),
('mohammed.elkhattabi@student.vinci.be', 'EL KHATTABI', 'Mohammed', 'Bloc1', NULL),
('morgan.bossin@student.vinci.be', 'BOSSIN', 'Morgan', 'Bloc1', NULL),
('mustafa.alp@student.vinci.be', 'ALP', 'Mustafa', 'Bloc3', NULL),
('nathan.ayele@student.vinci.be', 'AYELE', 'Nathan', 'Bloc2', NULL),
('nawfal.boujtat@student.vinci.be', 'BOUJTAT', 'Nawfal', 'Bloc1', NULL),
('nestor.debiesme@student.vinci.be', 'Debiesme', 'Nestor', 'Bloc1', NULL),
('nicolas.bertolini@student.vinci.be', 'BERTOLINI', 'Nicolas', 'Bloc2', NULL),
('nicolas.chapelle@student.vinci.be', 'CHAPELLE', 'Nicolas', 'Bloc1', NULL),
('nicolas.christodouloudegraillet@student.vinci.be', 'CHRISTODOULOU de GRAILLET', 'Nicolas', 'Bloc2', NULL),
('nicolas.delannoy@student.vinci.be', 'DELANNOY', 'Nicolas', 'Bloc1', NULL),
('nicolas.gasia@student.vinci.be', 'GASIA', 'Nicolas', 'Bloc1', NULL),
('nicolas.lecoq@student.vinci.be', 'LECOQ', 'Nicolas', 'Bloc1', NULL),
('nicolas.lorphelin@student.vinci.be', 'LORPHELIN', 'Nicolas', 'Bloc1', NULL),
('nicolas.marcq@student.vinci.be', 'Marcq', 'Nicolas', 'Bloc1', NULL),
('nicolas.oste@student.vinci.be', 'OSTE', 'Nicolas', 'Bloc3', NULL),
('nicolas.tremerie@student.vinci.be', 'Tremerie', 'Nicolas', 'Bloc1', NULL),
('nicolas.vangelder@student.vinci.be', 'van GELDER', 'Nicolas', 'Bloc1', NULL),
('nolan.vanmoortel@student.vinci.be', 'VANMOORTEL', 'Nolan', 'Bloc2', NULL),
('olivier.degreve@student.vinci.be', 'DEGRÈVE', 'Olivier', 'Bloc2', NULL),
('othmane.echagdalizahri@student.vinci.be', 'ECHAGDALI ZAHRI', 'Othmane', 'Bloc1', NULL),
('otman.lachkar@student.vinci.be', 'LACHKAR', 'Otman', 'Bloc1', NULL),
('patrick.bikorimana@student.vinci.be', 'BIKORIMANA', 'Patrick', 'Bloc1', NULL),
('patrick.mazur@student.vinci.be', 'MAZUR', 'Patrick', 'Bloc2', NULL),
('patrycjusz.dolega@student.vinci.be', 'DOLEGA', 'Patrycjusz', 'Bloc3', NULL),
('paul-edouard.fouquet@student.vinci.be', 'FOUQUET', 'Paul-Edouard', 'Bloc1', NULL),
('pawel.jalbrzykowski@student.vinci.be', 'JALBRZYKOWSKI', 'Pawel', 'Bloc1', NULL),
('philipp.shevtchenko@student.vinci.be', 'SHEVTCHENKO', 'Philipp', 'Bloc3', NULL),
('philippe.dragomir@student.vinci.be', 'DRAGOMIR', 'Philippe', 'Bloc3', NULL),
('philippe.giuge@student.vinci.be', 'GIUGE', 'Philippe', 'Bloc3', NULL),
('pierre-paul.gaillet@student.vinci.be', 'GAILLET', 'Pierre-Paul', 'Bloc2', NULL),
('pierre.michiels@student.vinci.be', 'MICHIELS', 'Pierre', 'Bloc1', NULL),
('pierric.cotton@student.vinci.be', 'COTTON', 'Pierric', 'Bloc3', NULL),
('quentin.denis@student.vinci.be', 'DENIS', 'Quentin', 'Bloc2', NULL),
('quentin.gilmart@student.vinci.be', 'GILMART', 'Quentin', 'Bloc2', NULL),
('quocdat.nguyen@student.vinci.be', 'NGUYEN', 'Quoc Dat', 'Bloc3', NULL),
('rachid.asli@student.vinci.be', 'ASLI', 'Rachid', 'Bloc2', NULL),
('rachid.mabrouk@student.vinci.be', 'MABROUK', 'Rachid', 'Bloc1', NULL),
('ralph.urbach@student.vinci.be', 'URBACH', 'Ralph', 'Bloc1', NULL),
('risaci-deogratias.faizi@student.vinci.be', 'FAIZI', 'Risaci-Deogratias', 'Bloc1', NULL),
('robert.woronko@student.vinci.be', 'WORONKO', 'Robert', 'Bloc2', NULL),
('robin.lefebvre@student.vinci.be', 'LEFEBVRE', 'Robin', 'Bloc1', NULL),
('robin.louis@student.vinci.be', 'LOUIS', 'Robin', 'Bloc1', NULL),
('rocco.cauchi@student.vinci.be', 'CAUCHI', 'Rocco', 'Bloc1', NULL),
('roland.bura@student.vinci.be', 'BURA', 'Roland', 'Bloc2', NULL),
('romain.descamps@student.vinci.be', 'DESCAMPS', 'Romain', 'Bloc2', NULL),
('romain.donck@student.vinci.be', 'DONCK', 'Romain', 'Bloc1', NULL),
('romain.duvillier@student.vinci.be', 'DUVILLIER', 'Romain', 'Bloc3', NULL),
('romain.grimmonpre@student.vinci.be', 'GRIMMONPRÉ', 'Romain', 'Bloc2', NULL),
('romain.vanlithaut@student.vinci.be', 'VAN LITHAUT', 'Romain', 'Bloc2', NULL),
('romain.weynand@student.vinci.be', 'WEYNAND', 'Romain', 'Bloc1', NULL),
('roman.skubiszewski@student.vinci.be', 'SKUBISZEWSKI', 'Roman', 'Bloc2', NULL),
('romaric.honorez@student.vinci.be', 'HONOREZ', 'Romaric', 'Bloc1', NULL),
('rubain.kamegnesonwabo@student.vinci.be', 'KAMEGNESON WABO', 'Rubain', 'Bloc1', NULL),
('sacha.maricau@student.vinci.be', 'MARICAU', 'Sacha', 'Bloc1', NULL),
('said.imran@student.vinci.be', 'IMRAN', 'Said', 'Bloc1', NULL),
('salim.bouchbouk@student.vinci.be', 'Bouchbouk', 'Salim', 'Bloc1', NULL),
('sam.ndagano@student.vinci.be', 'NDAGANO', 'Sam', 'Bloc3', NULL),
('sami.barchid@student.vinci.be', 'BARCHID', 'Sami', 'Bloc2', NULL),
('sami.farhat@student.vinci.be', 'FARHAT', 'Sami', 'Bloc1', NULL),
('samir.bacha@student.vinci.be', 'BACHA', 'Samir', 'Bloc1', NULL),
('samuel.camus@student.vinci.be', 'CAMUS', 'Samuel', 'Bloc1', NULL),
('sandra.kwibuka@student.vinci.be', 'KWIBUKA', 'Sandra', 'Bloc1', NULL),
('sebastian.gonzalezmoran@student.vinci.be', 'GONZALEZ MORAN', 'Sebastian', 'Bloc1', NULL),
('sebastien.croonen@student.vinci.be', 'CROONEN', 'Sébastien', 'Bloc1', NULL),
('sebastien.pauwels@student.vinci.be', 'PAUWELS', 'Sébastien', 'Bloc1', NULL),
('sebastien.place@student.vinci.be', 'PLACE', 'Sébastien', 'Bloc2', NULL),
('sebastien.riga@student.vinci.be', 'RIGA', 'Sébastien', 'Bloc1', NULL),
('sebastien.serre@student.vinci.be', 'SERRÉ', 'Sébastien', 'Bloc1', NULL),
('shahadat.sadeque@student.vinci.be', 'SADEQUE', 'Shahadat', 'Bloc1', NULL),
('shayan.amini@student.vinci.be', 'AMINI', 'Shayan', 'Bloc1', NULL),
('shenghao.ye@student.vinci.be', 'YE', 'Sheng Hao', 'Bloc3', NULL),
('simon.guilmot@student.vinci.be', 'GUILMOT', 'Simon', 'Bloc1', NULL),
('simon.oldenhovedeguertechin@student.vinci.be', 'OLDENHOVE de GUERTECHIN', 'Simon', 'Bloc2', NULL),
('sohaib.boulbanyousrani@student.vinci.be', 'BOULBAN YOUSRANI', 'Sohaib', 'Bloc1', NULL),
('sophie.paligot@student.vinci.be', 'PALIGOT', 'Sophie', 'Bloc1', NULL),
('soufiane.chelaghmi@student.vinci.be', 'CHELAGHMI', 'Soufiane', 'Bloc1', NULL),
('soufiane.haidour@student.vinci.be', 'HAIDOUR', 'Soufiane', 'Bloc1', NULL),
('stefan.bogdanovic@student.vinci.be', 'BOGDANOVIC', 'Stefan', 'Bloc3', NULL),
('tahir.bashir@student.vinci.be', 'BASHIR', 'Tahir', 'Bloc1', NULL),
('tanguy.snoeck@student.vinci.be', 'SNOECK', 'Tanguy', 'Bloc2', NULL),
('tarik.yuksel@student.vinci.be', 'Yuksel', 'Tarik', 'Bloc1', NULL),
('theodor.dimov@student.vinci.be', 'DIMOV', 'Theodor', 'Bloc3', NULL),
('thibault.andersson@student.vinci.be', 'ANDERSSON', 'Thibault', 'Bloc1', NULL),
('thibault.devaleriola@student.vinci.be', 'DEVALERIOLA', 'Thibault', 'Bloc1', NULL),
('thibaut.janssens@student.vinci.be', 'JANSSENS', 'Thibaut', 'Bloc1', NULL),
('thomas.boon@student.vinci.be', 'BOON', 'Thomas', 'Bloc1', NULL),
('thomas.lion@student.vinci.be', 'LION', 'Thomas', 'Bloc1', NULL),
('thomas.ronsmans@student.vinci.be', 'RONSMANS', 'Thomas', 'Bloc2', NULL),
('thomas.vangelder@student.vinci.be', 'van GELDER', 'Thomas', 'Bloc2', NULL),
('thomas.verelst@student.vinci.be', 'Verelst', 'Thomas', 'Bloc1', NULL),
('timothee.bouvin@student.vinci.be', 'BOUVIN', 'Timothée', 'Bloc2', NULL),
('tom.conneelymcinerney@student.vinci.be', 'CONNEELY MCINERNEY', 'Tom', 'Bloc1', NULL),
('tomasz.trykozko@student.vinci.be', 'Trykozko', 'Tomasz', 'Bloc1', NULL),
('tran.nguyen@student.vinci.be', 'NGUYEN', 'Tran', 'Bloc2', NULL),
('tuan.bui@student.vinci.be', 'BUI', 'Tuan', 'Bloc1', NULL),
('valentin.delwart@student.vinci.be', 'DELWART', 'Valentin', 'Bloc2', NULL),
('valentin.desenepart@student.vinci.be', 'DESÉNÉPART', 'Valentin', 'Bloc2', NULL),
('victor.pierrot@student.vinci.be', 'Pierrot', 'Victor', 'Bloc1', NULL),
('viken.afsar@student.vinci.be', 'AFSAR', 'Viken', 'Bloc1', NULL),
('vincent.franchomme@student.vinci.be', 'FRANCHOMME', 'Vincent', 'Bloc1', NULL),
('vincent.vanrossem@student.vinci.be', 'VAN ROSSEM', 'Vincent', 'Bloc1', NULL),
('vinhkien.truong@student.vinci.be', 'TRUONG', 'Vinh Kien', 'Bloc3', NULL),
('virginia.dabrowski@student.vinci.be', 'DABROWSKI', 'Virginia', 'Bloc2', NULL),
('wim.vanderschueren@student.vinci.be', 'Van der Schueren', 'Wim', 'Bloc1', NULL),
('xavier.hoffmann@student.vinci.be', 'HOFFMANN', 'Xavier', 'Bloc3', NULL),
('xavier.mouffo@student.vinci.be', 'Mouffo', 'Xavier', 'Bloc1', NULL),
('yahya.bennaghmouch@student.vinci.be', 'BENNAGHMOUCH', 'Yahya', 'Bloc1', NULL),
('yannick.molinghen@student.vinci.be', 'MOLINGHEN', 'Yannick', 'Bloc3', NULL),
('yannis.manguin@student.vinci.be', 'MANGUIN', 'Yannis', 'Bloc1', NULL),
('yassin.assecoum@student.vinci.be', 'ASSECOUM', 'Yassin', 'Bloc1', NULL),
('yassine.elhadouchi@student.vinci.be', 'EL HADOUCHI', 'Yassine', 'Bloc1', NULL),
('yiwei.chen@student.vinci.be', 'CHEN', 'Yiwei', 'Bloc1', NULL),
('younes.erraide@student.vinci.be', 'Erraide', 'Younes', 'Bloc1', NULL),
('younes.moulila@student.vinci.be', 'MOULILA', 'Younes', 'Bloc1', NULL),
('youness.belhassnaoui@student.vinci.be', 'BELHASSNAOUI', 'Youness', 'Bloc1', NULL),
('youssef.astitou@student.vinci.be', 'ASTITOU', 'Youssef', 'Bloc1', NULL),
('youssef.larbi@student.vinci.be', 'LARBI', 'Youssef', 'Bloc1', NULL),
('yvetteroseline.noulafonkou@student.vinci.be', 'NOULA FONKOU', 'Yvette Roseline', 'Bloc1', NULL),
('zakaria.lamrini@student.vinci.be', 'LAMRINI', 'Zakaria', 'Bloc2', NULL),
('zakaria.oulji@student.vinci.be', 'OULJI', 'Zakaria', 'Bloc1', NULL),
('zineb.elmokadem@student.vinci.be', 'EL MOKADEM', 'Zineb', 'Bloc1', NULL),
('zohaib.muhammad@student.vinci.be', 'MUHAMMAD', 'Zohaib', 'Bloc1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `person_in_charge` varchar(5) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`email`, `name`, `first_name`, `person_in_charge`) VALUES
('annick.dupont@vinci.be', 'Dupont', 'Annick', 'false'),
('anthony.legrand@vinci.be', 'Legrand', 'Anthony', 'false'),
('bernard.frank@vinci.be', 'Frank', 'Bernard', 'false'),
('bernard.henriet@vinci.be', 'Henriet', 'Bernard', 'blocs'),
('brigitte.binot@vinci.be', 'Binot', 'Brigitte', 'false'),
('brigitte.lehmann@vinci.be', 'Lehmann', 'Brigitte', 'false'),
('christophe.damas@vinci.be', 'Damas', 'Christophe', 'bloc2'),
('colette.demuylder@vinci.be', 'De Muylder', 'Colette', 'false'),
('donatien.grolaux@vinci.be', 'Grolaux', 'Donatien', 'bloc3'),
('emmeline.leconte@vinci.be', 'Leconte', 'Emmeline', 'blocs'),
('gregory.seront@vinci.be', 'Seront', 'Gregory', 'true\r'),
('jeanluc.collinet@ipl.be', 'Collinet', 'Jean-Luc', 'bloc1'),
('jose.vandermeulen@vinci.be', 'Vandermeulen', 'José', 'false'),
('julien.federinov@vinci.be', 'Federinov', 'Julien', 'false'),
('laurent.leleux@vinci.be', 'Leleux', 'Laurent', 'false'),
('michel.debacker@vinci.be', 'Debacker', 'Michel', 'false'),
('olivier.choquet@vinci.be', 'Choquet', 'Olivier', 'false'),
('philippe.vaneerdenbrugghe@vinci.be', 'Vaneerdenbrugghe', 'Philippe', 'false'),
('sonia.belina@vinci.be', 'Belina-Podgaetsky', 'Sonia', 'false'),
('stephanie.ferneeuw@vinci.be', 'Ferneeuw', 'Stéphanie', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `type_sessions`
--

CREATE TABLE IF NOT EXISTS `type_sessions` (
  `id_type_session` int(11) NOT NULL,
  `code` varchar(5) NOT NULL,
  `name_type_sessions` varchar(25) DEFAULT NULL,
  `attendance_taking_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_type_session`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `type_sessions_serie`
--

CREATE TABLE IF NOT EXISTS `type_sessions_serie` (
  `id_type_session_serie` int(11) NOT NULL AUTO_INCREMENT,
  `code_serie` varchar(3) NOT NULL,
  `id_type_session` int(11) NOT NULL,
  PRIMARY KEY (`id_type_session_serie`),
  KEY `code_serie` (`code_serie`,`id_type_session`),
  KEY `id_type_session` (`id_type_session`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

CREATE TABLE IF NOT EXISTS `weeks` (
  `week_number` int(2) NOT NULL,
  `term` varchar(2) NOT NULL,
  `week_name` varchar(10) NOT NULL,
  `date_monday` date NOT NULL,
  PRIMARY KEY (`week_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `weeks`
--

INSERT INTO `weeks` (`week_number`, `term`, `week_name`, `date_monday`) VALUES
(1, 'q1', 'q1_semaine', '2016-09-19'),
(2, 'q1', 'q1_semaine', '2016-09-26'),
(3, 'q1', 'q1_semaine', '2016-10-03'),
(4, 'q1', 'q1_semaine', '2016-10-10'),
(5, 'q1', 'q1_semaine', '2016-10-17'),
(6, 'q1', 'q1_semaine', '2016-10-24'),
(7, 'q1', 'q1_semaine', '2016-11-07');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`email`) REFERENCES `students` (`email`),
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`id_attendance_sheet`) REFERENCES `attendances_sheets` (`id_attendance_sheet`);

--
-- Constraints for table `attendances_sheets`
--
ALTER TABLE `attendances_sheets`
  ADD CONSTRAINT `attendances_sheets_ibfk_1` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`),
  ADD CONSTRAINT `attendances_sheets_ibfk_2` FOREIGN KEY (`week_number`) REFERENCES `weeks` (`week_number`),
  ADD CONSTRAINT `attendances_sheets_ibfk_3` FOREIGN KEY (`email`) REFERENCES `teachers` (`email`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`);

--
-- Constraints for table `type_sessions`
--
ALTER TABLE `type_sessions`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`code`) REFERENCES `courses` (`code`);

--
-- Constraints for table `type_sessions_serie`
--
ALTER TABLE `type_sessions_serie`
  ADD CONSTRAINT `type_sessions_serie_ibfk_1` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`),
  ADD CONSTRAINT `type_sessions_serie_ibfk_2` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
