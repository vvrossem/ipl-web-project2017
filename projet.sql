-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 08 Mai 2017 à 12:32
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `attendances`
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
-- Structure de la table `attendances_sheets`
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
-- Structure de la table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `code` varchar(5) NOT NULL,
  `name` varchar(65) NOT NULL,
  `term` varchar(2) NOT NULL,
  `course_unit` varchar(2) NOT NULL,
  `credit` decimal(10,0) NOT NULL,
  `abbreviation` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `courses`
--

INSERT INTO `courses` (`code`, `name`, `term`, `course_unit`, `credit`, `abbreviation`) VALUES
('I1010', 'Algorithmique', 'Q1', 'UE', '6', 'Algo'),
('I106B', 'Introduction à Linux', 'Q2', 'AA', '5', 'Linux'),
('I1100', 'Mathématiques 2 : Structures Avancées', 'Q2', 'UE', '6', 'Math 2'),
('I202B', 'Structures de données', 'Q1', 'AA', '2', 'SD'),
('I2080', 'Organisation des Entreprises', 'Q2', 'UE', '6', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `code_serie` varchar(3) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  PRIMARY KEY (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `series`
--

INSERT INTO `series` (`code_serie`, `bloc`) VALUES
('1I1', 'Bloc1'),
('1I2', 'Bloc1'),
('1I3', 'Bloc1'),
('1I4', 'Bloc1'),
('1I5', 'Bloc1'),
('1I6', 'Bloc1'),
('2I1', 'Bloc2'),
('2I2', 'Bloc2'),
('2I3', 'Bloc2'),
('2I4', 'Bloc2'),
('3I1', 'Bloc3'),
('3I2', 'Bloc3'),
('3I3', 'Bloc3');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `bloc` varchar(5) NOT NULL,
  `code_serie` varchar(3) NOT NULL,
  PRIMARY KEY (`email`),
  KEY `code_serie` (`code_serie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `students`
--

INSERT INTO `students` (`email`, `name`, `first_name`, `bloc`, `code_serie`) VALUES
('abdelhak.bakalem@student.vinci.be', 'BAKALEM', 'Abdelhak', 'Bloc2', '2I1'),
('adeline.duterre@student.vinci.be', 'DUTERRE', 'Adeline', 'Bloc2', '2I2'),
('adnan.jlassi@student.vinci.be', 'JLASSI', 'Adnan', 'Bloc1', '1I1'),
('adrian.dellavallemorinigo@student.vinci.be', 'DELLAVALLE MORINIGO', 'Adrian', 'Bloc1', '1I2'),
('adrian.gajda@student.vinci.be', 'GAJDA', 'Adrian', 'Bloc1', '1I3'),
('ahmad.bashir@student.vinci.be', 'BASHIR', 'Ahmad', 'Bloc2', '2I3'),
('alan.buelinckx@student.vinci.be', 'BUELINCKX', 'Alan', 'Bloc1', '1I4'),
('albinot.fetahi@student.vinci.be', 'Fetahi', 'Albinot', 'Bloc1', '1I5'),
('alexandre.coste-gandrey@student.vinci.be', 'COSTE-GANDREY', 'Alexandre', 'Bloc2', '2I4'),
('alexandre.hardi@student.vinci.be', 'HARDI', 'Alexandre', 'Bloc2', '2I3'),
('alexandre.maniet@student.vinci.be', 'MANIET', 'Alexandre', 'Bloc2', '2I2'),
('alexandre.maroun@student.vinci.be', 'Maroun', 'Alexandre', 'Bloc1', '1I6'),
('alexandre.sousadossantos@student.vinci.be', 'SOUSA DOS SANTOS', 'Alexandre', 'Bloc2', '2I1'),
('alexandre.wacquier@student.vinci.be', 'WACQUIER', 'Alexandre', 'Bloc1', '1I5'),
('alexis.rifaut@student.vinci.be', 'RIFAUT', 'Alexis', 'Bloc1', '1I4'),
('ali.godazendeh@student.vinci.be', 'GODAZENDEH', 'Ali', 'Bloc1', '1I3'),
('amandine.vangrunderbeeck@student.vinci.be', 'VAN GRUNDERBEECK', 'Amandine', 'Bloc2', '2I2'),
('amatus.umugabe@student.vinci.be', 'UMUGABE', 'Amatus', 'Bloc1', '1I2'),
('amaury.evrard@student.vinci.be', 'EVRARD', 'Amaury', 'Bloc3', '3I1'),
('anas.hammani@student.vinci.be', 'HAMMANI', 'Anas', 'Bloc1', '1I1'),
('andre.daspremont@student.vinci.be', 'DASPREMONT', 'André', 'Bloc3', '3I2'),
('andrea.occhilupo@student.vinci.be', 'OCCHILUPO', 'Andrea', 'Bloc1', '1I2'),
('andy.desmedt@student.vinci.be', 'De Smedt', 'Andy', 'Bloc1', '1I3'),
('andy.voiturier@student.vinci.be', 'VOITURIER', 'Andy', 'Bloc1', '1I4'),
('angecedrick.angaman@student.vinci.be', 'ANGAMAN', 'Ange Cedrick', 'Bloc1', '1I5'),
('anthony.maton@student.vinci.be', 'MATON', 'Anthony', 'Bloc3', '3I3'),
('anthony.pierre@student.vinci.be', 'PIERRE', 'Anthony', 'Bloc2', '2I3'),
('anthony.pyck@student.vinci.be', 'PYCK', 'Anthony', 'Bloc2', '2I4'),
('anthony.vancampenhault@student.vinci.be', 'VANCAMPENHAULT', 'Anthony', 'Bloc2', '2I3'),
('antoine.colet@student.vinci.be', 'COLET', 'Antoine', 'Bloc3', '3I2'),
('antoine.debroux@student.vinci.be', 'DEBROUX', 'Antoine', 'Bloc1', '1I6'),
('antoine.deroose@student.vinci.be', 'DE ROOSE', 'Antoine', 'Bloc1', '1I5'),
('antoine.lambricht@student.vinci.be', 'LAMBRICHT', 'Antoine', 'Bloc2', '2I2'),
('antoine.maniet@student.vinci.be', 'MANIET', 'Antoine', 'Bloc2', '2I1'),
('antoine.ramelot@student.vinci.be', 'RAMELOT', 'Antoine', 'Bloc1', '1I4'),
('antoine.verlant@student.vinci.be', 'VERLANT', 'Antoine', 'Bloc3', '3I1'),
('antonin.riche@student.vinci.be', 'RICHE', 'Antonin', 'Bloc2', '2I2'),
('arnaud.bourez@student.vinci.be', 'BOUREZ', 'Arnaud', 'Bloc1', '1I3'),
('arnaud.deboeck@student.vinci.be', 'DE BOECK', 'Arnaud', 'Bloc1', '1I2'),
('arnaud.etienne@student.vinci.be', 'ETIENNE', 'Arnaud', 'Bloc2', '2I3'),
('arnaud.poullet@student.vinci.be', 'POULLET', 'Arnaud', 'Bloc1', '1I1'),
('arnaud.rochez@student.vinci.be', 'ROCHEZ', 'Arnaud', 'Bloc3', '3I2'),
('arnaud.terryn@student.vinci.be', 'TERRYN', 'Arnaud', 'Bloc1', '1I2'),
('arthur.speicher@student.vinci.be', 'SPEICHER', 'Arthur', 'Bloc1', '1I3'),
('artjam.umanyan@student.vinci.be', 'Umanyan', 'Artjam', 'Bloc1', '1I4'),
('arturo.mozzon@student.vinci.be', 'MOZZON', 'Arturo', 'Bloc1', '1I5'),
('augustin.demeeusdargenteuil@student.vinci.be', 'de MEEuS d''ARGENTEUIL', 'Augustin', 'Bloc1', '1I6'),
('aurelien.lefebvre@student.vinci.be', 'LEFEBVRE', 'Aurélien', 'Bloc3', '3I3'),
('azeddine.mansour@student.vinci.be', 'Mansour', 'Azeddine', 'Bloc1', '1I5'),
('badreddine.lahrichi@student.vinci.be', 'LAHRICHI', 'Badreddine', 'Bloc1', '1I4'),
('bastien.dessy@student.vinci.be', 'DESSY', 'Bastien', 'Bloc1', '1I3'),
('bastien.dossantos@student.vinci.be', 'DOS SANTOS', 'Bastien', 'Bloc3', '3I2'),
('benjamin.berge@student.vinci.be', 'BERGÉ', 'Benjamin', 'Bloc2', '2I4'),
('benjamin.debosscher@student.vinci.be', 'De Bosscher', 'Benjamin', 'Bloc1', '1I2'),
('benjamin.declercq@student.vinci.be', 'DECLERCQ', 'Benjamin', 'Bloc2', '2I3'),
('benjamin.pierre@student.vinci.be', 'PIERRE', 'Benjamin', 'Bloc2', '2I2'),
('bill.brancart@student.vinci.be', 'BRANCART', 'Bill', 'Bloc3', '3I1'),
('bouchra.kh''leeh@student.vinci.be', 'KH'' LEEH', 'Bouchra', 'Bloc1', '1I1'),
('brian.diazalvarez@student.vinci.be', 'Diaz Alvarez', 'Brian', 'Bloc1', '1I2'),
('brieuc.seeger@student.vinci.be', 'SEEGER', 'Brieuc', 'Bloc1', '1I3'),
('bunyamin.aslan@student.vinci.be', 'ASLAN', 'Bunyamin', 'Bloc1', '1I4'),
('burim.kastrati@student.vinci.be', 'KASTRATI', 'Burim', 'Bloc1', '1I5'),
('cedric.martin@student.vinci.be', 'MARTIN', 'Cedric', 'Bloc1', '1I6'),
('cedric.tavernier@student.vinci.be', 'TAVERNIER', 'Cedric', 'Bloc2', '2I1'),
('chamil.chakhabov@student.vinci.be', 'CHAKHABOV', 'Chamil', 'Bloc1', '1I5'),
('christian.mendesrosa@student.vinci.be', 'MENDES ROSA', 'Christian', 'Bloc3', '3I2'),
('christophe.bortier@student.vinci.be', 'BORTIER', 'Christophe', 'Bloc2', '2I2'),
('christophe.driessen@student.vinci.be', 'DRIESSEN', 'Christophe', 'Bloc2', '2I3'),
('christophe.jabbour@student.vinci.be', 'Jabbour', 'Christophe', 'Bloc1', '1I4'),
('christopher.castel@student.vinci.be', 'CASTEL', 'Christopher', 'Bloc1', '1I3'),
('christopher.sacre@student.vinci.be', 'SACRÉ', 'Christopher', 'Bloc2', '2I4'),
('clement.dujardin@student.vinci.be', 'du JARDIN', 'Clément', 'Bloc2', '2I3'),
('colin.vandenbrande@student.vinci.be', 'VAN DEN BRANDE', 'Colin', 'Bloc1', '1I2'),
('corenthin.dubois@student.vinci.be', 'DUBOIS', 'Corenthin', 'Bloc2', '2I2'),
('cyril.hennen@student.vinci.be', 'HENNEN', 'Cyril', 'Bloc1', '1I1'),
('cyrille.hourant@student.vinci.be', 'HOURANT', 'Cyrille', 'Bloc1', '1I2'),
('damian.szacun@student.vinci.be', 'SZACUN', 'Damian', 'Bloc1', '1I3'),
('damien.kech@student.vinci.be', 'KECH', 'Damien', 'Bloc3', '3I3'),
('damien.meur@student.vinci.be', 'MEUR', 'Damien', 'Bloc2', '2I1'),
('damien.syemons@student.vinci.be', 'SYEMONS', 'Damien', 'Bloc3', '3I2'),
('dani.rochaazevedo@student.vinci.be', 'Rocha Azevedo', 'Dani', 'Bloc1', '1I4'),
('dattoan.nguyen@student.vinci.be', 'NGUYEN', 'Dat Toan', 'Bloc2', '2I2'),
('dawid.tararuj@student.vinci.be', 'Tararuj', 'Dawid', 'Bloc1', '1I5'),
('debrah.tinsia@student.vinci.be', 'TINSIA', 'Debrah', 'Bloc2', '2I3'),
('dejvi.kurti@student.vinci.be', 'KURTI', 'Dejvi', 'Bloc1', '1I6'),
('delanoe.pirard@student.vinci.be', 'PIRARD', 'Delanoe', 'Bloc3', '3I1'),
('diana.grama@student.vinci.be', 'Grama', 'Diana', 'Bloc1', '1I5'),
('diego.nuezsoriano@student.vinci.be', 'NUEZ SORIANO', 'Diego', 'Bloc2', '2I4'),
('djama.omar@student.vinci.be', 'OMAR', 'Djama', 'Bloc1', '1I4'),
('dorian.gruselin@student.vinci.be', 'GRUSELIN', 'Dorian', 'Bloc1', '1I3'),
('driss.bengeloune@student.vinci.be', 'BEN GELOUNE', 'Driss', 'Bloc1', '1I2'),
('driss.vandenheede@student.vinci.be', 'VANDENHEEDE', 'Driss', 'Bloc1', '1I1'),
('dylan.divito@student.vinci.be', 'DI VITO', 'Dylan', 'Bloc3', '3I2'),
('egide.kabanza@student.vinci.be', 'KABANZA', 'Egide', 'Bloc1', '1I2'),
('ekrem.ozturk@student.vinci.be', 'Özturk', 'Ekrem', 'Bloc1', '1I3'),
('emanuel.peroni@student.vinci.be', 'PERONI', 'Emanuel', 'Bloc1', '1I4'),
('emilien.durieu@student.vinci.be', 'DURIEU', 'Emilien', 'Bloc3', '3I3'),
('emre.tasyurek@student.vinci.be', 'TASYuREK', 'Emre', 'Bloc2', '2I3'),
('fabian.teichmann@student.vinci.be', 'TEICHMANN', 'Fabian', 'Bloc1', '1I5'),
('fabio.grumiro@student.vinci.be', 'GRUMIRO', 'Fabio', 'Bloc3', '3I2'),
('fany.bottemanne@student.vinci.be', 'BOTTEMANNE', 'Fany', 'Bloc3', '3I1'),
('felix.jacoby@student.vinci.be', 'JACOBY', 'Félix', 'Bloc2', '2I2'),
('filip.lolic@student.vinci.be', 'Lolic', 'Filip', 'Bloc1', '1I6'),
('florian.morel@student.vinci.be', 'MOREL', 'Florian', 'Bloc3', '3I2'),
('florian.sollami@student.vinci.be', 'SOLLAMI', 'Florian', 'Bloc1', '1I5'),
('florian.timmermans@student.vinci.be', 'TIMMERMANS', 'Florian', 'Bloc1', '1I4'),
('florian.verdonck@student.vinci.be', 'VERDONCK', 'Florian', 'Bloc1', '1I3'),
('françois.pecheur@student.vinci.be', 'Pecheur', 'François', 'Bloc1', '1I2'),
('françois.pochet@student.vinci.be', 'Pochet', 'François', 'Bloc1', '1I1'),
('frederic.hubert@student.vinci.be', 'HUBERT', 'Frédéric', 'Bloc2', '2I1'),
('gabriel.curatolo@student.vinci.be', 'CURATOLO', 'Gabriel', 'Bloc1', '1I2'),
('gabriel.delhaye@student.vinci.be', 'DELHAYE', 'Gabriel', 'Bloc2', '2I2'),
('gabriel.haba@student.vinci.be', 'HABA', 'Gabriel', 'Bloc2', '2I3'),
('gael.kifoumbi@student.vinci.be', 'KIFOUMBI', 'Gael', 'Bloc1', '1I3'),
('gael.leroy@student.vinci.be', 'LEROY', 'Gael', 'Bloc3', '3I3'),
('gaspard.devillenfagnedevogelsanck@student.vinci.be', 'de VILLENFAGNE de VOGELSANCK', 'Gaspard', 'Bloc2', '2I4'),
('gauthier.grandhenry@student.vinci.be', 'GRANDHENRY', 'Gauthier', 'Bloc1', '1I4'),
('gauthier.lallemand@student.vinci.be', 'LALLEMAND', 'Gauthier', 'Bloc2', '2I3'),
('geoffroy.frennet@student.vinci.be', 'FRENNET', 'Geoffroy', 'Bloc1', '1I5'),
('gilles.renson@student.vinci.be', 'RENSON', 'Gilles', 'Bloc2', '2I2'),
('gorgis.yaramis@student.vinci.be', 'YARAMIS', 'Gorgis', 'Bloc1', '1I6'),
('gregory.decraemer@student.vinci.be', 'DECRAEMER', 'Grégory', 'Bloc1', '1I5'),
('guillaume.lion@student.vinci.be', 'LION', 'Guillaume', 'Bloc1', '1I4'),
('guillaume.wery@student.vinci.be', 'WERY', 'Guillaume', 'Bloc1', '1I3'),
('guy.vassart@student.vinci.be', 'VASSART', 'Guy', 'Bloc1', '1I2'),
('hakan.poyraz@student.vinci.be', 'POYRAZ', 'Hakan', 'Bloc1', '1I1'),
('halil.top@student.vinci.be', 'TOP', 'Halil', 'Bloc1', '1I2'),
('hamza.guerrouaj@student.vinci.be', 'GUERROUAJ', 'Hamza', 'Bloc1', '1I3'),
('hamza.mahmoudi@student.vinci.be', 'MAHMOUDI', 'Hamza', 'Bloc1', '1I4'),
('hamza.mounir@student.vinci.be', 'MOUNIR', 'Hamza', 'Bloc3', '3I2'),
('hicham.elasri@student.vinci.be', 'EL ASRI', 'Hicham', 'Bloc1', '1I5'),
('hugues.demathelindepapigny@student.vinci.be', 'de Mathelin de Papigny', 'Hugues', 'Bloc1', '1I6'),
('ibrahim.mourade@student.vinci.be', 'MOURADE', 'Ibrahim', 'Bloc2', '2I1'),
('ikram.noorzaai@student.vinci.be', 'NOORZAAI', 'Ikram', 'Bloc1', '1I5'),
('ilias.barrani@student.vinci.be', 'BARRANI', 'Ilias', 'Bloc1', '1I4'),
('ilias.jafar@student.vinci.be', 'JAFAR', 'Ilias', 'Bloc1', '1I3'),
('ilias.tellihi@student.vinci.be', 'TELLIHI', 'Ilias', 'Bloc1', '1I2'),
('ismael.elfkihbenahmed@student.vinci.be', 'El F''Kih Ben Ahmed', 'Ismael', 'Bloc1', '1I1'),
('ismaila.abdoulahiadamou@student.vinci.be', 'ABDOULAHI ADAMOU', 'Ismaila', 'Bloc1', '1I2'),
('iulian.avram@student.vinci.be', 'Avram', 'Iulian', 'Bloc1', '1I3'),
('ivan.pessers@student.vinci.be', 'PESSERS', 'Ivan', 'Bloc3', '3I1'),
('jacques.yakoub@student.vinci.be', 'YAKOUB', 'Jacques', 'Bloc3', '3I2'),
('jean-bosco.rwibutso@student.vinci.be', 'RWIBUTSO', 'Jean-Bosco', 'Bloc2', '2I2'),
('jean-françois.cochart@student.vinci.be', 'COCHART', 'Jean-François', 'Bloc2', '2I3'),
('jean-françois.schweisthal@student.vinci.be', 'SCHWEISTHAL', 'Jean-François', 'Bloc3', '3I3'),
('jean-pacifique.mbonyincungu@student.vinci.be', 'MBONYINCUNGU', 'Jean-Pacifique', 'Bloc3', '3I2'),
('jean.dubuisson@student.vinci.be', 'DUBUISSON', 'Jean', 'Bloc1', '1I4'),
('jeremy.balcinhasgodinho@student.vinci.be', 'BALCINHAS GODINHO', 'Jérémy', 'Bloc1', '1I5'),
('jeremy.holodiline@student.vinci.be', 'Holodiline', 'Jeremy', 'Bloc1', '1I6'),
('jeremy.vandermotte@student.vinci.be', 'VANDER MOTTE', 'Jérémy', 'Bloc1', '1I5'),
('jerome.deborsu@student.vinci.be', 'DEBORSU', 'Jérome', 'Bloc1', '1I4'),
('jimmy.delacruzmallada@student.vinci.be', 'DE LA CRUZ MALLADA', 'Jimmy', 'Bloc3', '3I1'),
('joachim.vranken@student.vinci.be', 'VRANKEN', 'Joachim', 'Bloc1', '1I3'),
('joelle.maffomeleu@student.vinci.be', 'MAFFO MELEU', 'Joelle', 'Bloc1', '1I2'),
('johann.buxant@student.vinci.be', 'BUXANT', 'Johann', 'Bloc2', '2I4'),
('johnny.la@student.vinci.be', 'LA', 'Johnny', 'Bloc2', '2I3'),
('johnny.steutgens@student.vinci.be', 'STEUTGENS', 'Johnny', 'Bloc1', '1I1'),
('jolan.wathelet@student.vinci.be', 'WATHELET', 'Jolan', 'Bloc2', '2I2'),
('jonathan.visiedogil@student.vinci.be', 'Visiedo Gil', 'Jonathan', 'Bloc1', '1I2'),
('joris.pluton@student.vinci.be', 'PLUTON', 'Joris', 'Bloc1', '1I3'),
('jozef.sako@student.vinci.be', 'SAKO', 'Jozef', 'Bloc1', '1I4'),
('julien.doyen@student.vinci.be', 'DOYEN', 'Julien', 'Bloc1', '1I5'),
('julien.solinas@student.vinci.be', 'SOLINAS', 'Julien', 'Bloc2', '2I1'),
('julien.wets@student.vinci.be', 'WETS', 'Julien', 'Bloc1', '1I6'),
('junior.maduka@student.vinci.be', 'MADUKA', 'Junior', 'Bloc3', '3I2'),
('kadir.dagyaran@student.vinci.be', 'DAGYARAN', 'Kadir', 'Bloc1', '1I5'),
('kamil.arszagivelharszagi@student.vinci.be', 'ARSZAGI VEL HARSZAGI', 'Kamil', 'Bloc2', '2I2'),
('kamil.kowalczyk@student.vinci.be', 'KOWALCZYK', 'Kamil', 'Bloc1', '1I4'),
('kawtar.oumghar@student.vinci.be', 'OUMGHAR', 'kawtar', 'Bloc1', '1I3'),
('kei-jyu.hama@student.vinci.be', 'HAMA', 'Kei-Jyu', 'Bloc1', '1I2'),
('kevin.heylbroeck@student.vinci.be', 'HEYLBROECK', 'Kevin', 'Bloc2', '2I3'),
('kevin.merovallas@student.vinci.be', 'MERO VALLAS', 'Kevin', 'Bloc1', '1I1'),
('kevin.tang@student.vinci.be', 'Tang', 'Kevin', 'Bloc1', '1I2'),
('khalil.benazzouz@student.vinci.be', 'BENAZZOUZ', 'Khalil', 'Bloc1', '1I3'),
('klevis.xhakollari@student.vinci.be', 'XHAKOLLARI', 'Klevis', 'Bloc1', '1I4'),
('kodjo.adegnon@student.vinci.be', 'ADEGNON', 'Kodjo', 'Bloc3', '3I3'),
('konstantin.romanov@student.vinci.be', 'ROMANOV', 'Konstantin', 'Bloc3', '3I2'),
('kyrill.tircher@student.vinci.be', 'TIRCHER', 'Kyrill', 'Bloc2', '2I4'),
('lancelot.dewoutersdebouchout@student.vinci.be', 'de WOUTERS de BOUCHOUT', 'Lancelot', 'Bloc2', '2I3'),
('laurent.batsle@student.vinci.be', 'BATSLÉ', 'Laurent', 'Bloc3', '3I1'),
('leo.descamps@student.vinci.be', 'DESCAMPS', 'Léo', 'Bloc1', '1I5'),
('lionel.ovaert@student.vinci.be', 'OVAERT', 'Lionel', 'Bloc3', '3I2'),
('liseta.carcani@student.vinci.be', 'CARCANI', 'Liseta', 'Bloc1', '1I6'),
('logan.bauduin@student.vinci.be', 'BAUDUIN', 'Logan', 'Bloc1', '1I5'),
('logan.bourez@student.vinci.be', 'BOUREZ', 'Logan', 'Bloc1', '1I4'),
('loic.defosse@student.vinci.be', 'Defossé', 'Loïc', 'Bloc1', '1I3'),
('loic.stevens@student.vinci.be', 'STEVENS', 'Loïc', 'Bloc3', '3I3'),
('loic.willems@student.vinci.be', 'WILLEMS', 'Loic', 'Bloc1', '1I2'),
('lopodi.gaza@student.vinci.be', 'GAZA', 'Lopodi', 'Bloc1', '1I1'),
('lorenzo.lapage@student.vinci.be', 'LAPAGE', 'Lorenzo', 'Bloc1', '1I2'),
('lorenzo.lauricella@student.vinci.be', 'LAURICELLA', 'Lorenzo', 'Bloc1', '1I3'),
('louis.vanaken@student.vinci.be', 'VAN AKEN', 'Louis', 'Bloc1', '1I4'),
('loury.jacob@student.vinci.be', 'JACOB', 'Loury', 'Bloc1', '1I5'),
('lucas.malmport@student.vinci.be', 'Malmport', 'Lucas', 'Bloc1', '1I6'),
('lukas.greif@student.vinci.be', 'GREIF', 'Lukas', 'Bloc1', '1I5'),
('macblair.ballecer@student.vinci.be', 'BALLECER', 'Mac Blair', 'Bloc1', '1I4'),
('majd.fahmi@student.vinci.be', 'FAHMI', 'Majd', 'Bloc1', '1I3'),
('malo.misson@student.vinci.be', 'MISSON', 'Malo', 'Bloc1', '1I2'),
('mamadou.cisse@student.vinci.be', 'CISSÉ', 'Mamadou', 'Bloc2', '2I2'),
('marc.deburlet@student.vinci.be', 'de BURLET', 'Marc', 'Bloc3', '3I2'),
('marc.meganck@student.vinci.be', 'MEGANCK', 'Marc', 'Bloc1', '1I1'),
('marco.amory@student.vinci.be', 'AMORY', 'Marco', 'Bloc1', '1I2'),
('marcos.garciaaugusto@student.vinci.be', 'GARCIA AUGUSTO', 'Marcos', 'Bloc2', '2I1'),
('martin.d’hoedt@student.vinci.be', 'D’HOEDT', 'Martin', 'Bloc1', '1I3'),
('martin.kutzner@student.vinci.be', 'KUTZNER', 'Martin', 'Bloc1', '1I4'),
('martin.techy@student.vinci.be', 'TECHY', 'Martin', 'Bloc3', '3I1'),
('mathieu.descantonsdemontblanc@student.vinci.be', 'DESCANTONS de MONTBLANC', 'Mathieu', 'Bloc3', '3I2'),
('mathieu.marcq@student.vinci.be', 'MARCQ', 'Mathieu', 'Bloc1', '1I5'),
('mathieu.steenput@student.vinci.be', 'STEENPUT', 'Mathieu', 'Bloc3', '3I3'),
('max.marin@student.vinci.be', 'Marin', 'Max', 'Bloc1', '1I6'),
('maxime.demaubeuge@student.vinci.be', 'DE MAUBEUGE', 'Maxime', 'Bloc3', '3I2'),
('maxime.denuit@student.vinci.be', 'DENUIT', 'Maxime', 'Bloc2', '2I2'),
('maxime.pirlet@student.vinci.be', 'PIRLET', 'Maxime', 'Bloc2', '2I3'),
('maxime.poelaert@student.vinci.be', 'POELAERT', 'Maxime', 'Bloc1', '1I5'),
('maxime.verwilghen@student.vinci.be', 'VERWILGHEN', 'Maxime', 'Bloc3', '3I1'),
('mehdi.ibnlfassi@student.vinci.be', 'IBNLFASSI', 'Mehdi', 'Bloc1', '1I4'),
('melissa.strauven@student.vinci.be', 'STRAUVEN', 'Mélissa', 'Bloc3', '3I2'),
('meriam.mzoughi@student.vinci.be', 'MZOUGHI', 'Meriam', 'Bloc2', '2I4'),
('michael.andre@student.vinci.be', 'ANDRE', 'Michael', 'Bloc2', '2I3'),
('michel.debroux@student.vinci.be', 'De Broux', 'Michel', 'Bloc2', '2I2'),
('mickael.marlard@student.vinci.be', 'MARLARD', 'Mickael', 'Bloc2', '2I1'),
('mike.gaillet@student.vinci.be', 'GAILLET', 'Mike', 'Bloc3', '3I3'),
('milenko.vorkapic@student.vinci.be', 'VORKAPIC', 'Milenko', 'Bloc3', '3I2'),
('mohamed.hassouni@student.vinci.be', 'HASSOUNI', 'Mohamed', 'Bloc1', '1I3'),
('mohammed.chairibounekoub@student.vinci.be', 'Chairi Bounekoub', 'Mohammed', 'Bloc1', '1I2'),
('mohammed.elkhattabi@student.vinci.be', 'EL KHATTABI', 'Mohammed', 'Bloc1', '1I1'),
('morgan.bossin@student.vinci.be', 'BOSSIN', 'Morgan', 'Bloc1', '1I2'),
('mustafa.alp@student.vinci.be', 'ALP', 'Mustafa', 'Bloc3', '3I1'),
('nathan.ayele@student.vinci.be', 'AYELE', 'Nathan', 'Bloc2', '2I2'),
('nawfal.boujtat@student.vinci.be', 'BOUJTAT', 'Nawfal', 'Bloc1', '1I3'),
('nestor.debiesme@student.vinci.be', 'Debiesme', 'Nestor', 'Bloc1', '1I4'),
('nicolas.bertolini@student.vinci.be', 'BERTOLINI', 'Nicolas', 'Bloc2', '2I3'),
('nicolas.chapelle@student.vinci.be', 'CHAPELLE', 'Nicolas', 'Bloc1', '1I5'),
('nicolas.christodouloudegraillet@student.vinci.be', 'CHRISTODOULOU de GRAILLET', 'Nicolas', 'Bloc2', '2I4'),
('nicolas.delannoy@student.vinci.be', 'DELANNOY', 'Nicolas', 'Bloc1', '1I6'),
('nicolas.gasia@student.vinci.be', 'GASIA', 'Nicolas', 'Bloc1', '1I5'),
('nicolas.lecoq@student.vinci.be', 'LECOQ', 'Nicolas', 'Bloc1', '1I4'),
('nicolas.lorphelin@student.vinci.be', 'LORPHELIN', 'Nicolas', 'Bloc1', '1I3'),
('nicolas.marcq@student.vinci.be', 'Marcq', 'Nicolas', 'Bloc1', '1I2'),
('nicolas.oste@student.vinci.be', 'OSTE', 'Nicolas', 'Bloc3', '3I2'),
('nicolas.tremerie@student.vinci.be', 'Tremerie', 'Nicolas', 'Bloc1', '1I1'),
('nicolas.vangelder@student.vinci.be', 'van GELDER', 'Nicolas', 'Bloc1', '1I2'),
('nolan.vanmoortel@student.vinci.be', 'VANMOORTEL', 'Nolan', 'Bloc2', '2I3'),
('olivier.degreve@student.vinci.be', 'DEGRÈVE', 'Olivier', 'Bloc2', '2I2'),
('othmane.echagdalizahri@student.vinci.be', 'ECHAGDALI ZAHRI', 'Othmane', 'Bloc1', '1I3'),
('otman.lachkar@student.vinci.be', 'LACHKAR', 'Otman', 'Bloc1', '1I4'),
('patrick.bikorimana@student.vinci.be', 'BIKORIMANA', 'Patrick', 'Bloc1', '1I5'),
('patrick.mazur@student.vinci.be', 'MAZUR', 'Patrick', 'Bloc2', '2I1'),
('patrycjusz.dolega@student.vinci.be', 'DOLEGA', 'Patrycjusz', 'Bloc3', '3I3'),
('paul-edouard.fouquet@student.vinci.be', 'FOUQUET', 'Paul-Edouard', 'Bloc1', '1I6'),
('pawel.jalbrzykowski@student.vinci.be', 'JALBRZYKOWSKI', 'Pawel', 'Bloc1', '1I5'),
('philipp.shevtchenko@student.vinci.be', 'SHEVTCHENKO', 'Philipp', 'Bloc3', '3I2'),
('philippe.dragomir@student.vinci.be', 'DRAGOMIR', 'Philippe', 'Bloc3', '3I1'),
('philippe.giuge@student.vinci.be', 'GIUGE', 'Philippe', 'Bloc3', '3I2'),
('pierre-paul.gaillet@student.vinci.be', 'GAILLET', 'Pierre-Paul', 'Bloc2', '2I2'),
('pierre.michiels@student.vinci.be', 'MICHIELS', 'Pierre', 'Bloc1', '1I4'),
('pierric.cotton@student.vinci.be', 'COTTON', 'Pierric', 'Bloc3', '3I3'),
('quentin.denis@student.vinci.be', 'DENIS', 'Quentin', 'Bloc2', '2I3'),
('quentin.gilmart@student.vinci.be', 'GILMART', 'Quentin', 'Bloc2', '2I4'),
('quocdat.nguyen@student.vinci.be', 'NGUYEN', 'Quoc Dat', 'Bloc3', '3I2'),
('rachid.asli@student.vinci.be', 'ASLI', 'Rachid', 'Bloc2', '2I3'),
('rachid.mabrouk@student.vinci.be', 'MABROUK', 'Rachid', 'Bloc1', '1I3'),
('ralph.urbach@student.vinci.be', 'URBACH', 'Ralph', 'Bloc1', '1I2'),
('risaci-deogratias.faizi@student.vinci.be', 'FAIZI', 'Risaci-Deogratias', 'Bloc1', '1I1'),
('robert.woronko@student.vinci.be', 'WORONKO', 'Robert', 'Bloc2', '2I2'),
('robin.lefebvre@student.vinci.be', 'LEFEBVRE', 'Robin', 'Bloc1', '1I2'),
('robin.louis@student.vinci.be', 'LOUIS', 'Robin', 'Bloc1', '1I3'),
('rocco.cauchi@student.vinci.be', 'CAUCHI', 'Rocco', 'Bloc1', '1I4'),
('roland.bura@student.vinci.be', 'BURA', 'Roland', 'Bloc2', '2I1'),
('romain.descamps@student.vinci.be', 'DESCAMPS', 'Romain', 'Bloc2', '2I2'),
('romain.donck@student.vinci.be', 'DONCK', 'Romain', 'Bloc1', '1I5'),
('romain.duvillier@student.vinci.be', 'DUVILLIER', 'Romain', 'Bloc3', '3I1'),
('romain.grimmonpre@student.vinci.be', 'GRIMMONPRÉ', 'Romain', 'Bloc2', '2I3'),
('romain.vanlithaut@student.vinci.be', 'VAN LITHAUT', 'Romain', 'Bloc2', '2I4'),
('romain.weynand@student.vinci.be', 'WEYNAND', 'Romain', 'Bloc1', '1I6'),
('roman.skubiszewski@student.vinci.be', 'SKUBISZEWSKI', 'Roman', 'Bloc2', '2I3'),
('romaric.honorez@student.vinci.be', 'HONOREZ', 'Romaric', 'Bloc1', '1I5'),
('rubain.kamegnesonwabo@student.vinci.be', 'KAMEGNESON WABO', 'Rubain', 'Bloc1', '1I4'),
('sacha.maricau@student.vinci.be', 'MARICAU', 'Sacha', 'Bloc1', '1I3'),
('said.imran@student.vinci.be', 'IMRAN', 'Said', 'Bloc1', '1I2'),
('salim.bouchbouk@student.vinci.be', 'Bouchbouk', 'Salim', 'Bloc1', '1I1'),
('sam.ndagano@student.vinci.be', 'NDAGANO', 'Sam', 'Bloc3', '3I2'),
('sami.barchid@student.vinci.be', 'BARCHID', 'Sami', 'Bloc2', '2I2'),
('sami.farhat@student.vinci.be', 'FARHAT', 'Sami', 'Bloc1', '1I2'),
('samir.bacha@student.vinci.be', 'BACHA', 'Samir', 'Bloc1', '1I3'),
('samuel.camus@student.vinci.be', 'CAMUS', 'Samuel', 'Bloc1', '1I4'),
('sandra.kwibuka@student.vinci.be', 'KWIBUKA', 'Sandra', 'Bloc1', '1I5'),
('sebastian.gonzalezmoran@student.vinci.be', 'GONZALEZ MORAN', 'Sebastian', 'Bloc1', '1I6'),
('sebastien.croonen@student.vinci.be', 'CROONEN', 'Sébastien', 'Bloc1', '1I5'),
('sebastien.pauwels@student.vinci.be', 'PAUWELS', 'Sébastien', 'Bloc1', '1I4'),
('sebastien.place@student.vinci.be', 'PLACE', 'Sébastien', 'Bloc2', '2I1'),
('sebastien.riga@student.vinci.be', 'RIGA', 'Sébastien', 'Bloc1', '1I3'),
('sebastien.serre@student.vinci.be', 'SERRÉ', 'Sébastien', 'Bloc1', '1I2'),
('shahadat.sadeque@student.vinci.be', 'SADEQUE', 'Shahadat', 'Bloc1', '1I1'),
('shayan.amini@student.vinci.be', 'AMINI', 'Shayan', 'Bloc1', '1I2'),
('shenghao.ye@student.vinci.be', 'YE', 'Sheng Hao', 'Bloc3', '3I3'),
('simon.guilmot@student.vinci.be', 'GUILMOT', 'Simon', 'Bloc1', '1I3'),
('simon.oldenhovedeguertechin@student.vinci.be', 'OLDENHOVE de GUERTECHIN', 'Simon', 'Bloc2', '2I2'),
('sohaib.boulbanyousrani@student.vinci.be', 'BOULBAN YOUSRANI', 'Sohaib', 'Bloc1', '1I4'),
('sophie.paligot@student.vinci.be', 'PALIGOT', 'Sophie', 'Bloc1', '1I5'),
('soufiane.chelaghmi@student.vinci.be', 'CHELAGHMI', 'Soufiane', 'Bloc1', '1I6'),
('soufiane.haidour@student.vinci.be', 'HAIDOUR', 'Soufiane', 'Bloc1', '1I5'),
('stefan.bogdanovic@student.vinci.be', 'BOGDANOVIC', 'Stefan', 'Bloc3', '3I2'),
('tahir.bashir@student.vinci.be', 'BASHIR', 'Tahir', 'Bloc1', '1I4'),
('tanguy.snoeck@student.vinci.be', 'SNOECK', 'Tanguy', 'Bloc2', '2I3'),
('tarik.yuksel@student.vinci.be', 'Yuksel', 'Tarik', 'Bloc1', '1I3'),
('theodor.dimov@student.vinci.be', 'DIMOV', 'Theodor', 'Bloc3', '3I1'),
('thibault.andersson@student.vinci.be', 'ANDERSSON', 'Thibault', 'Bloc1', '1I2'),
('thibault.devaleriola@student.vinci.be', 'DEVALERIOLA', 'Thibault', 'Bloc1', '1I1'),
('thibaut.janssens@student.vinci.be', 'JANSSENS', 'Thibaut', 'Bloc1', '1I2'),
('thomas.boon@student.vinci.be', 'BOON', 'Thomas', 'Bloc1', '1I3'),
('thomas.lion@student.vinci.be', 'LION', 'Thomas', 'Bloc1', '1I4'),
('thomas.ronsmans@student.vinci.be', 'RONSMANS', 'Thomas', 'Bloc2', '2I4'),
('thomas.vangelder@student.vinci.be', 'van GELDER', 'Thomas', 'Bloc2', '2I3'),
('thomas.verelst@student.vinci.be', 'Verelst', 'Thomas', 'Bloc1', '1I5'),
('timothee.bouvin@student.vinci.be', 'BOUVIN', 'Timothée', 'Bloc2', '2I2'),
('tom.conneelymcinerney@student.vinci.be', 'CONNEELY MCINERNEY', 'Tom', 'Bloc1', '1I6'),
('tomasz.trykozko@student.vinci.be', 'Trykozko', 'Tomasz', 'Bloc1', '1I5'),
('tran.nguyen@student.vinci.be', 'NGUYEN', 'Tran', 'Bloc2', '2I1'),
('tuan.bui@student.vinci.be', 'BUI', 'Tuan', 'Bloc1', '1I4'),
('valentin.delwart@student.vinci.be', 'DELWART', 'Valentin', 'Bloc2', '2I2'),
('valentin.desenepart@student.vinci.be', 'DESÉNÉPART', 'Valentin', 'Bloc2', '2I3'),
('victor.pierrot@student.vinci.be', 'Pierrot', 'Victor', 'Bloc1', '1I3'),
('viken.afsar@student.vinci.be', 'AFSAR', 'Viken', 'Bloc1', '1I2'),
('vincent.franchomme@student.vinci.be', 'FRANCHOMME', 'Vincent', 'Bloc1', '1I1'),
('vincent.vanrossem@student.vinci.be', 'VAN ROSSEM', 'Vincent', 'Bloc1', '1I2'),
('vinhkien.truong@student.vinci.be', 'TRUONG', 'Vinh Kien', 'Bloc3', '3I2'),
('virginia.dabrowski@student.vinci.be', 'DABROWSKI', 'Virginia', 'Bloc2', '2I4'),
('wim.vanderschueren@student.vinci.be', 'Van der Schueren', 'Wim', 'Bloc1', '1I3'),
('xavier.hoffmann@student.vinci.be', 'HOFFMANN', 'Xavier', 'Bloc3', '3I3'),
('xavier.mouffo@student.vinci.be', 'Mouffo', 'Xavier', 'Bloc1', '1I4'),
('yahya.bennaghmouch@student.vinci.be', 'BENNAGHMOUCH', 'Yahya', 'Bloc1', '1I5'),
('yannick.molinghen@student.vinci.be', 'MOLINGHEN', 'Yannick', 'Bloc3', '3I2'),
('yannis.manguin@student.vinci.be', 'MANGUIN', 'Yannis', 'Bloc1', '1I6'),
('yassin.assecoum@student.vinci.be', 'ASSECOUM', 'Yassin', 'Bloc1', '1I5'),
('yassine.elhadouchi@student.vinci.be', 'EL HADOUCHI', 'Yassine', 'Bloc1', '1I4'),
('yiwei.chen@student.vinci.be', 'CHEN', 'Yiwei', 'Bloc1', '1I3'),
('younes.erraide@student.vinci.be', 'Erraide', 'Younes', 'Bloc1', '1I2'),
('younes.moulila@student.vinci.be', 'MOULILA', 'Younes', 'Bloc1', '1I1'),
('youness.belhassnaoui@student.vinci.be', 'BELHASSNAOUI', 'Youness', 'Bloc1', '1I2'),
('youssef.astitou@student.vinci.be', 'ASTITOU', 'Youssef', 'Bloc1', '1I3'),
('youssef.larbi@student.vinci.be', 'LARBI', 'Youssef', 'Bloc1', '1I4'),
('yvetteroseline.noulafonkou@student.vinci.be', 'NOULA FONKOU', 'Yvette Roseline', 'Bloc1', '1I5'),
('zakaria.lamrini@student.vinci.be', 'LAMRINI', 'Zakaria', 'Bloc2', '2I3'),
('zakaria.oulji@student.vinci.be', 'OULJI', 'Zakaria', 'Bloc1', '1I6'),
('zineb.elmokadem@student.vinci.be', 'EL MOKADEM', 'Zineb', 'Bloc1', '1I5'),
('zohaib.muhammad@student.vinci.be', 'MUHAMMAD', 'Zohaib', 'Bloc1', '1I4');

-- --------------------------------------------------------

--
-- Structure de la table `teachers`
--

CREATE TABLE IF NOT EXISTS `teachers` (
  `email` varchar(100) NOT NULL,
  `name` varchar(65) NOT NULL,
  `first_name` varchar(65) NOT NULL,
  `person_in_charge` varchar(5) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `teachers`
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
-- Structure de la table `type_sessions`
--

CREATE TABLE IF NOT EXISTS `type_sessions` (
  `id_type_session` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `name_type_sessions` varchar(25) DEFAULT NULL,
  `attendance_taking_type` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_type_session`),
  KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `type_sessions`
--

INSERT INTO `type_sessions` (`id_type_session`, `code`, `name_type_sessions`, `attendance_taking_type`) VALUES
(1, 'I1010', 'algo1', 'x'),
(2, 'I1010', 'algo2', 'x'),
(3, 'I1010', NULL, 'note'),
(11, 'I1100', 'math2-1', 'x'),
(12, 'I1100', 'math2-2', 'x');

-- --------------------------------------------------------

--
-- Structure de la table `type_sessions_serie`
--

CREATE TABLE IF NOT EXISTS `type_sessions_serie` (
  `id_type_session_serie` int(11) NOT NULL AUTO_INCREMENT,
  `code_serie` varchar(3) NOT NULL,
  `id_type_session` int(11) NOT NULL,
  PRIMARY KEY (`id_type_session_serie`),
  KEY `code_serie` (`code_serie`,`id_type_session`),
  KEY `id_type_session` (`id_type_session`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_sessions_serie`
--

INSERT INTO `type_sessions_serie` (`id_type_session_serie`, `code_serie`, `id_type_session`) VALUES
(1, '1I1', 1),
(2, '1I2', 1);

-- --------------------------------------------------------

--
-- Structure de la table `weeks`
--

CREATE TABLE IF NOT EXISTS `weeks` (
  `week_number` int(2) NOT NULL,
  `term` varchar(2) NOT NULL,
  `week_name` varchar(13) NOT NULL,
  `date_monday` date NOT NULL,
  PRIMARY KEY (`week_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `weeks`
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
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `attendances`
--
ALTER TABLE `attendances`
  ADD CONSTRAINT `attendances_ibfk_2` FOREIGN KEY (`id_attendance_sheet`) REFERENCES `attendances_sheets` (`id_attendance_sheet`),
  ADD CONSTRAINT `attendances_ibfk_1` FOREIGN KEY (`email`) REFERENCES `students` (`email`);

--
-- Contraintes pour la table `attendances_sheets`
--
ALTER TABLE `attendances_sheets`
  ADD CONSTRAINT `attendances_sheets_ibfk_4` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`),
  ADD CONSTRAINT `attendances_sheets_ibfk_2` FOREIGN KEY (`week_number`) REFERENCES `weeks` (`week_number`),
  ADD CONSTRAINT `attendances_sheets_ibfk_3` FOREIGN KEY (`email`) REFERENCES `teachers` (`email`);

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `FK` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Contraintes pour la table `type_sessions`
--
ALTER TABLE `type_sessions`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`code`) REFERENCES `courses` (`code`);

--
-- Contraintes pour la table `type_sessions_serie`
--
ALTER TABLE `type_sessions_serie`
  ADD CONSTRAINT `type_sessions_serie_ibfk_2` FOREIGN KEY (`id_type_session`) REFERENCES `type_sessions` (`id_type_session`),
  ADD CONSTRAINT `type_sessions_serie_ibfk_1` FOREIGN KEY (`code_serie`) REFERENCES `series` (`code_serie`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
