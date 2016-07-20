DROP TABLE IF EXISTS calendar;

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(160) NOT NULL,
  `description` text NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `allDay` varchar(5) NOT NULL,
  `color` varchar(7) NOT NULL,
  `url` varchar(255) NOT NULL,
  `category` varchar(200) NOT NULL,
  `repeat_type` varchar(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `repeat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO calendar VALUES("1","Agnes","hhhh","2016-05-05 00:00:00","0000-00-00 00:00:00","false","#63fa3d","false","General","no","0","1"),
("2","sssh","hshs","2016-05-12 00:15:00","2016-05-25 09:00:00","false","#9417a8","false","General","no","13423","2"),
("3","Ahgnes","d;sd","2016-05-11 05:00:00","2016-05-17 08:00:00","false","#c72f2f","false","General","no","13423","3"),
("4","Ama Wedding","smsm","2016-05-03 02:00:00","2016-05-04 06:00:00","false","#a6d12b","false","General","no","0","4"),
("5","ghhh","","2016-07-01 00:00:00","2016-07-01 00:00:00","false","#587ca3","false","Work","no","0","5");



DROP TABLE IF EXISTS jobs;

CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_reserved_reserved_at_index` (`queue`,`reserved`,`reserved_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS migrations;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO migrations VALUES("2014_10_12_000000_create_users_table","1"),
("2014_10_12_100000_create_password_resets_table","1"),
("2015_10_28_133521_create_tasks_table","1");



DROP TABLE IF EXISTS oauth_session;

CREATE TABLE `oauth_session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session` char(32) NOT NULL DEFAULT '',
  `state` char(32) NOT NULL DEFAULT '',
  `access_token` mediumtext NOT NULL,
  `expiry` datetime DEFAULT NULL,
  `type` char(12) NOT NULL DEFAULT '',
  `server` char(12) NOT NULL DEFAULT '',
  `creation` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `access_token_secret` mediumtext NOT NULL,
  `authorized` char(1) DEFAULT NULL,
  `user` int(10) unsigned NOT NULL DEFAULT '0',
  `refresh_token` mediumtext NOT NULL,
  `access_token_response` mediumtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `social_oauth_session_index` (`session`,`server`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS password_resets;

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




DROP TABLE IF EXISTS perez_auth;

CREATE TABLE `perez_auth` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER` int(11) NOT NULL COMMENT 'links to workers table',
  `USERNAME` varchar(100) NOT NULL,
  `USER_SINCE` varchar(100) DEFAULT NULL,
  `USER_TYPE` varchar(30) DEFAULT NULL,
  `EMAIL` text,
  `PASSWORD` text,
  `ACTIVE` int(11) NOT NULL DEFAULT '1' COMMENT '1 means enabled,0 means disabled',
  `NET_ADD` text,
  `LAST_LOGIN` varchar(90) NOT NULL,
  `LAST_LOGOUT` varchar(90) NOT NULL,
  `CREATED_AT` varchar(100) NOT NULL,
  `UPDATED_AT` varchar(100) NOT NULL,
  `REMEMBER_TOKEN` varchar(300) NOT NULL,
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `USER` (`USER`)
) ENGINE=InnoDB AUTO_INCREMENT=13427 DEFAULT CHARSET=latin1;

INSERT INTO perez_auth VALUES("13416","4","","1435788000","Teacher","gadocansey@yahoo.com","c4ca4238a0b923820dcc509a6f75849b","1","Any","1453193858","1453193961","","","","2016-02-02 22:54:40"),
("13423","3","agnes","1438117854","Administrator","agnes","c4ca4238a0b923820dcc509a6f75849b","1","Any","1468957429","1468956056","","","","2016-07-19 12:43:49"),
("13424","0","Gad","","","gadocansey@gmail.com","$2y$10$ZwrEEVOZeCbPN5ZMg5oI7.Cwl1qBlYZeBxp2jsQbU1CO6fTPZDXQ2","1","","","","2016-02-03 07:09:46","2016-02-03 07:09:46","","2016-05-03 09:49:03"),
("13426","2","gadoo","1462203740","Head Pastor","gad@gmail.com","ace99638b3861a1c689f9f1db3224c08","1","","","","","","","2016-05-02 08:42:20");



DROP TABLE IF EXISTS perez_branches;

CREATE TABLE `perez_branches` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `HEAD` int(11) NOT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `CIRCUIT` varchar(100) NOT NULL,
  `DISTRICT` varchar(100) NOT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `PHONE` varchar(20) DEFAULT NULL,
  `REGION` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_branches VALUES("2","East Legon","0","12345","University of Ghana","1","2","dnsdnsd","","GR"),
("3","Achimota","0","1236","ABC","","","","","GR"),
("4","Winneba","0","2314","SSNIT","","","","","CR");



DROP TABLE IF EXISTS perez_children;

CREATE TABLE `perez_children` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `CODE` varchar(100) DEFAULT NULL,
  `PARENT_ID` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO perez_children VALUES("3","Gad Ocansey","12/11/1990","","9"),
("4","Ama","8/8/6788","100","9"),
("5","Amasjjs","8/8/6788","101","9"),
("7","Gaddddd","8/8/6788","103","2"),
("8","bnmb","5/6/9990","104","2"),
("9","nnbv","12/11/1990","105","2"),
("10","nmjjjj","12/12/1909","106","2"),
("11","Ama","4/7/1990","107","2"),
("12","Joe","2/6/1890","108","2");



DROP TABLE IF EXISTS perez_church_payment_type_info;

CREATE TABLE `perez_church_payment_type_info` (
  `payment_type_id` int(50) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`payment_type_id`),
  UNIQUE KEY `payment_type_name` (`payment_type_name`),
  UNIQUE KEY `payment_type_name_2` (`payment_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

INSERT INTO perez_church_payment_type_info VALUES("4","fundraising","enabled"),
("8","sunday_offetory","enabled"),
("9","ggdd","enabled"),
("10","gadddd","enabled"),
("11","gad","enabled"),
("12","mmmm","enabled");



DROP TABLE IF EXISTS perez_church_payments;

CREATE TABLE `perez_church_payments` (
  `amount` decimal(20,2) NOT NULL,
  `date` date NOT NULL,
  `entered_by_username` varchar(200) NOT NULL,
  `entered_by_real_name` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id` bigint(244) unsigned NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(50) NOT NULL,
  `payment_form_name` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_type_name` (`payment_type_name`),
  KEY `entered_by` (`entered_by_username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO perez_church_payments VALUES("83.00","2016-03-09","1","KOFI BOAKYE","2016-03-23 08:43:49","1","fundraising","Fundraising","enabled"),
("3332.00","2016-03-09","1","KOFI BOAKYE","2016-03-23 08:43:49","2","fundraising","Fundraising","enabled"),
("999.00","2016-03-22","1","KOFI BOAKYE","2016-03-23 08:48:05","3","sunday_offetory","Sunday Offetory","enabled");



DROP TABLE IF EXISTS perez_circuits;

CREATE TABLE `perez_circuits` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `DISTRICT` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS perez_code_gen;

CREATE TABLE `perez_code_gen` (
  `no` varchar(11) NOT NULL,
  `year` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO perez_code_gen VALUES("113","2015");



DROP TABLE IF EXISTS perez_codes;

CREATE TABLE `perez_codes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUPS` int(11) DEFAULT NULL,
  `SERVICE` int(11) DEFAULT NULL,
  `ASSET_CODE` varchar(40) DEFAULT NULL,
  `ACCOUNT` int(11) DEFAULT NULL,
  `TRANSACTION` int(11) DEFAULT NULL,
  `RECEIPT` int(11) DEFAULT NULL,
  `MEMO` int(11) DEFAULT NULL,
  `SERVICETYPE` int(11) NOT NULL,
  `CHILD` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO perez_codes VALUES("1","102","100","100","106","100","100","104","103","109");



DROP TABLE IF EXISTS perez_config;

CREATE TABLE `perez_config` (
  `ID` int(11) NOT NULL,
  `code` int(11) NOT NULL DEFAULT '1',
  `CHURCH_NAME` varchar(100) DEFAULT NULL,
  `CHURCH_LOGO` int(11) DEFAULT NULL,
  `CHURCH_ADDRESS` varchar(100) DEFAULT NULL,
  `CHURCH_PHONE` varchar(100) DEFAULT NULL,
  `CHURCH_PHONE2` varchar(11) NOT NULL,
  `CHURCH_FACEBOOK` varchar(100) DEFAULT NULL,
  `CHURCH_FACEBOOK_PASSWORD` varchar(200) NOT NULL,
  `SMS_URL` varchar(200) NOT NULL,
  `CHURCH_WHATSAPP` varchar(100) DEFAULT NULL,
  `CHURCH_EMAIL` varchar(100) DEFAULT NULL,
  `CHURCH_LETHERHEAD` int(11) DEFAULT NULL,
  `CHURCH_HEAD_PASTOR` varchar(100) DEFAULT NULL,
  `CHURCH_ASSISTANT_PASTOR` varchar(100) DEFAULT NULL,
  `CHURCH_ACCOUNTANT` varchar(100) DEFAULT NULL,
  `CHURCH_FINANCE_DIRECTOR` varchar(100) DEFAULT NULL,
  `CHURCH_HEAD_PASTOR_SIGN_FILE` int(11) DEFAULT NULL,
  `CHURCH_ASSISTANT_PASTOR_SIGN_FILE` int(11) DEFAULT NULL,
  `CHURCH_ACCOUNTANT_SIGN` int(11) NOT NULL,
  `CHURCH_FINANCE_SIGN` int(11) NOT NULL,
  `SMS_ALERT` int(11) NOT NULL,
  `EMAIL_ALERT` int(11) NOT NULL,
  `MEMBER_ID_GEN` int(11) NOT NULL,
  `UPDATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UPDATED_BY` int(11) NOT NULL,
  `INSTALLED` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`,`code`),
  UNIQUE KEY `ID` (`ID`,`code`),
  KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO perez_config VALUES("4","1","Bible Believing Church ,,","0","P.O.BOX UC,13,Cape Coast","022020020","0243348522","gadocansey@gmail.com","1","http://www.gadtxt/gad","0505284060","gadocansey@gmail.com","0","Pastor JF Aggrey","Emmanuel Ahiatordze","Emma Alabi","Eliezer Ajorlolo","0","0","0","0","1","1","1","2015-10-02 22:47:44","13423","1");



DROP TABLE IF EXISTS perez_country;

CREATE TABLE `perez_country` (
  `Code` char(3) NOT NULL DEFAULT '',
  `Name` char(52) NOT NULL DEFAULT '',
  `Continent` enum('Asia','Europe','North America','Africa','Oceania','Antarctica','South America') NOT NULL DEFAULT 'Asia',
  `Region` char(26) NOT NULL DEFAULT '',
  `SurfaceArea` float(10,2) NOT NULL DEFAULT '0.00',
  `IndepYear` smallint(6) DEFAULT NULL,
  `Population` int(11) NOT NULL DEFAULT '0',
  `LifeExpectancy` float(3,1) DEFAULT NULL,
  `GNP` float(10,2) DEFAULT NULL,
  `GNPOld` float(10,2) DEFAULT NULL,
  `LocalName` char(45) NOT NULL DEFAULT '',
  `GovernmentForm` char(45) NOT NULL DEFAULT '',
  `HeadOfState` char(60) DEFAULT NULL,
  `Capital` int(11) DEFAULT NULL,
  `Code2` char(2) NOT NULL DEFAULT '',
  PRIMARY KEY (`Code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO perez_country VALUES("ABW","Aruba","North America","Caribbean","193.00","","103000","78.4","828.00","793.00","Aruba","Nonmetropolitan Territory of The Netherlands","Beatrix","129","AW"),
("AFG","Afghanistan","Asia","Southern and Central Asia","652090.00","1919","22720000","45.9","5976.00","","Afganistan/Afqanestan","Islamic Emirate","Mohammad Omar","1","AF"),
("AGO","Angola","Africa","Central Africa","1246700.00","1975","12878000","38.3","6648.00","7984.00","Angola","Republic","José Eduardo dos Santos","56","AO"),
("AIA","Anguilla","North America","Caribbean","96.00","","8000","76.1","63.20","","Anguilla","Dependent Territory of the UK","Elisabeth II","62","AI"),
("ALB","Albania","Europe","Southern Europe","28748.00","1912","3401200","71.6","3205.00","2500.00","Shqipëria","Republic","Rexhep Mejdani","34","AL"),
("AND","Andorra","Europe","Southern Europe","468.00","1278","78000","83.5","1630.00","","Andorra","Parliamentary Coprincipality","","55","AD"),
("ANT","Netherlands Antilles","North America","Caribbean","800.00","","217000","74.7","1941.00","","Nederlandse Antillen","Nonmetropolitan Territory of The Netherlands","Beatrix","33","AN"),
("ARE","United Arab Emirates","Asia","Middle East","83600.00","1971","2441000","74.1","37966.00","36846.00","Al-Imarat al-´Arabiya al-Muttahida","Emirate Federation","Zayid bin Sultan al-Nahayan","65","AE"),
("ARG","Argentina","South America","South America","2780400.00","1816","37032000","75.1","340238.00","323310.00","Argentina","Federal Republic","Fernando de la Rúa","69","AR"),
("ARM","Armenia","Asia","Middle East","29800.00","1991","3520000","66.4","1813.00","1627.00","Hajastan","Republic","Robert Kotšarjan","126","AM"),
("ASM","American Samoa","Oceania","Polynesia","199.00","","68000","75.1","334.00","","Amerika Samoa","US Territory","George W. Bush","54","AS"),
("ATA","Antarctica","Antarctica","Antarctica","13120000.00","","0","","0.00","","–","Co-administrated","","","AQ"),
("ATF","French Southern territories","Antarctica","Antarctica","7780.00","","0","","0.00","","Terres australes françaises","Nonmetropolitan Territory of France","Jacques Chirac","","TF"),
("ATG","Antigua and Barbuda","North America","Caribbean","442.00","1981","68000","70.5","612.00","584.00","Antigua and Barbuda","Constitutional Monarchy","Elisabeth II","63","AG"),
("AUS","Australia","Oceania","Australia and New Zealand","7741220.00","1901","18886000","79.8","351182.00","392911.00","Australia","Constitutional Monarchy, Federation","Elisabeth II","135","AU"),
("AUT","Austria","Europe","Western Europe","83859.00","1918","8091800","77.7","211860.00","206025.00","Österreich","Federal Republic","Thomas Klestil","1523","AT"),
("AZE","Azerbaijan","Asia","Middle East","86600.00","1991","7734000","62.9","4127.00","4100.00","Azärbaycan","Federal Republic","Heydär Äliyev","144","AZ"),
("BDI","Burundi","Africa","Eastern Africa","27834.00","1962","6695000","46.2","903.00","982.00","Burundi/Uburundi","Republic","Pierre Buyoya","552","BI"),
("BEL","Belgium","Europe","Western Europe","30518.00","1830","10239000","77.8","249704.00","243948.00","België/Belgique","Constitutional Monarchy, Federation","Albert II","179","BE"),
("BEN","Benin","Africa","Western Africa","112622.00","1960","6097000","50.2","2357.00","2141.00","Bénin","Republic","Mathieu Kérékou","187","BJ"),
("BFA","Burkina Faso","Africa","Western Africa","274000.00","1960","11937000","46.7","2425.00","2201.00","Burkina Faso","Republic","Blaise Compaoré","549","BF"),
("BGD","Bangladesh","Asia","Southern and Central Asia","143998.00","1971","129155000","60.2","32852.00","31966.00","Bangladesh","Republic","Shahabuddin Ahmad","150","BD"),
("BGR","Bulgaria","Europe","Eastern Europe","110994.00","1908","8190900","70.9","12178.00","10169.00","Balgarija","Republic","Petar Stojanov","539","BG"),
("BHR","Bahrain","Asia","Middle East","694.00","1971","617000","73.0","6366.00","6097.00","Al-Bahrayn","Monarchy (Emirate)","Hamad ibn Isa al-Khalifa","149","BH"),
("BHS","Bahamas","North America","Caribbean","13878.00","1973","307000","71.1","3527.00","3347.00","The Bahamas","Constitutional Monarchy","Elisabeth II","148","BS"),
("BIH","Bosnia and Herzegovina","Europe","Southern Europe","51197.00","1992","3972000","71.5","2841.00","","Bosna i Hercegovina","Federal Republic","Ante Jelavic","201","BA"),
("BLR","Belarus","Europe","Eastern Europe","207600.00","1991","10236000","68.0","13714.00","","Belarus","Republic","Aljaksandr Lukašenka","3520","BY"),
("BLZ","Belize","North America","Central America","22696.00","1981","241000","70.9","630.00","616.00","Belize","Constitutional Monarchy","Elisabeth II","185","BZ"),
("BMU","Bermuda","North America","North America","53.00","","65000","76.9","2328.00","2190.00","Bermuda","Dependent Territory of the UK","Elisabeth II","191","BM"),
("BOL","Bolivia","South America","South America","1098581.00","1825","8329000","63.7","8571.00","7967.00","Bolivia","Republic","Hugo Bánzer Suárez","194","BO"),
("BRA","Brazil","South America","South America","8547403.00","1822","170115000","62.9","776739.00","804108.00","Brasil","Federal Republic","Fernando Henrique Cardoso","211","BR"),
("BRB","Barbados","North America","Caribbean","430.00","1966","270000","73.0","2223.00","2186.00","Barbados","Constitutional Monarchy","Elisabeth II","174","BB"),
("BRN","Brunei","Asia","Southeast Asia","5765.00","1984","328000","73.6","11705.00","12460.00","Brunei Darussalam","Monarchy (Sultanate)","Haji Hassan al-Bolkiah","538","BN"),
("BTN","Bhutan","Asia","Southern and Central Asia","47000.00","1910","2124000","52.4","372.00","383.00","Druk-Yul","Monarchy","Jigme Singye Wangchuk","192","BT"),
("BVT","Bouvet Island","Antarctica","Antarctica","59.00","","0","","0.00","","Bouvetøya","Dependent Territory of Norway","Harald V","","BV"),
("BWA","Botswana","Africa","Southern Africa","581730.00","1966","1622000","39.3","4834.00","4935.00","Botswana","Republic","Festus G. Mogae","204","BW"),
("CAF","Central African Republic","Africa","Central Africa","622984.00","1960","3615000","44.0","1054.00","993.00","Centrafrique/Bê-Afrîka","Republic","Ange-Félix Patassé","1889","CF"),
("CAN","Canada","North America","North America","9970610.00","1867","31147000","79.4","598862.00","625626.00","Canada","Constitutional Monarchy, Federation","Elisabeth II","1822","CA"),
("CCK","Cocos (Keeling) Islands","Oceania","Australia and New Zealand","14.00","","600","","0.00","","Cocos (Keeling) Islands","Territory of Australia","Elisabeth II","2317","CC"),
("CHE","Switzerland","Europe","Western Europe","41284.00","1499","7160400","79.6","264478.00","256092.00","Schweiz/Suisse/Svizzera/Svizra","Federation","Adolf Ogi","3248","CH"),
("CHL","Chile","South America","South America","756626.00","1810","15211000","75.7","72949.00","75780.00","Chile","Republic","Ricardo Lagos Escobar","554","CL"),
("CHN","China","Asia","Eastern Asia","9572900.00","-1523","1277558000","71.4","982268.00","917719.00","Zhongquo","People\'sRepublic","Jiang Zemin","1891","CN"),
("CIV","Côte d’Ivoire","Africa","Western Africa","322463.00","1960","14786000","45.2","11345.00","10285.00","Côte d’Ivoire","Republic","Laurent Gbagbo","2814","CI"),
("CMR","Cameroon","Africa","Central Africa","475442.00","1960","15085000","54.8","9174.00","8596.00","Cameroun/Cameroon","Republic","Paul Biya","1804","CM"),
("COD","Congo, The Democratic Republic of the","Africa","Central Africa","2344858.00","1960","51654000","48.8","6964.00","2474.00","République Démocratique du Congo","Republic","Joseph Kabila","2298","CD"),
("COG","Congo","Africa","Central Africa","342000.00","1960","2943000","47.4","2108.00","2287.00","Congo","Republic","Denis Sassou-Nguesso","2296","CG"),
("COK","Cook Islands","Oceania","Polynesia","236.00","","20000","71.1","100.00","","The Cook Islands","Nonmetropolitan Territory of New Zealand","Elisabeth II","583","CK"),
("COL","Colombia","South America","South America","1138914.00","1810","42321000","70.3","102896.00","105116.00","Colombia","Republic","Andrés Pastrana Arango","2257","CO"),
("COM","Comoros","Africa","Eastern Africa","1862.00","1975","578000","60.0","4401.00","4361.00","Komori/Comores","Republic","Azali Assoumani","2295","KM"),
("CPV","Cape Verde","Africa","Western Africa","4033.00","1975","428000","68.9","435.00","420.00","Cabo Verde","Republic","António Mascarenhas Monteiro","1859","CV"),
("CRI","Costa Rica","North America","Central America","51100.00","1821","4023000","75.8","10226.00","9757.00","Costa Rica","Republic","Miguel Ángel Rodríguez Echeverría","584","CR"),
("CUB","Cuba","North America","Caribbean","110861.00","1902","11201000","76.2","17843.00","18862.00","Cuba","Socialistic Republic","Fidel Castro Ruz","2413","CU"),
("CXR","Christmas Island","Oceania","Australia and New Zealand","135.00","","2500","","0.00","","Christmas Island","Territory of Australia","Elisabeth II","1791","CX"),
("CYM","Cayman Islands","North America","Caribbean","264.00","","38000","78.9","1263.00","1186.00","Cayman Islands","Dependent Territory of the UK","Elisabeth II","553","KY"),
("CYP","Cyprus","Asia","Middle East","9251.00","1960","754700","76.7","9333.00","8246.00","Kýpros/Kibris","Republic","Glafkos Klerides","2430","CY"),
("CZE","Czech Republic","Europe","Eastern Europe","78866.00","1993","10278100","74.5","55017.00","52037.00","¸esko","Republic","Václav Havel","3339","CZ"),
("DEU","Germany","Europe","Western Europe","357022.00","1955","82164700","77.4","2133367.00","2102826.00","Deutschland","Federal Republic","Johannes Rau","3068","DE"),
("DJI","Djibouti","Africa","Eastern Africa","23200.00","1977","638000","50.8","382.00","373.00","Djibouti/Jibuti","Republic","Ismail Omar Guelleh","585","DJ"),
("DMA","Dominica","North America","Caribbean","751.00","1978","71000","73.4","256.00","243.00","Dominica","Republic","Vernon Shaw","586","DM"),
("DNK","Denmark","Europe","Nordic Countries","43094.00","800","5330000","76.5","174099.00","169264.00","Danmark","Constitutional Monarchy","Margrethe II","3315","DK"),
("DOM","Dominican Republic","North America","Caribbean","48511.00","1844","8495000","73.2","15846.00","15076.00","República Dominicana","Republic","Hipólito Mejía Domínguez","587","DO"),
("DZA","Algeria","Africa","Northern Africa","2381741.00","1962","31471000","69.7","49982.00","46966.00","Al-Jaza’ir/Algérie","Republic","Abdelaziz Bouteflika","35","DZ"),
("ECU","Ecuador","South America","South America","283561.00","1822","12646000","71.1","19770.00","19769.00","Ecuador","Republic","Gustavo Noboa Bejarano","594","EC"),
("EGY","Egypt","Africa","Northern Africa","1001449.00","1922","68470000","63.3","82710.00","75617.00","Misr","Republic","Hosni Mubarak","608","EG"),
("ERI","Eritrea","Africa","Eastern Africa","117600.00","1993","3850000","55.8","650.00","755.00","Ertra","Republic","Isayas Afewerki [Isaias Afwerki]","652","ER"),
("ESH","Western Sahara","Africa","Northern Africa","266000.00","","293000","49.8","60.00","","As-Sahrawiya","Occupied by Marocco","Mohammed Abdel Aziz","2453","EH"),
("ESP","Spain","Europe","Southern Europe","505992.00","1492","39441700","78.8","553233.00","532031.00","España","Constitutional Monarchy","Juan Carlos I","653","ES"),
("EST","Estonia","Europe","Baltic Countries","45227.00","1991","1439200","69.5","5328.00","3371.00","Eesti","Republic","Lennart Meri","3791","EE"),
("ETH","Ethiopia","Africa","Eastern Africa","1104300.00","-1000","62565000","45.2","6353.00","6180.00","YeItyop´iya","Republic","Negasso Gidada","756","ET"),
("FIN","Finland","Europe","Nordic Countries","338145.00","1917","5171300","77.4","121914.00","119833.00","Suomi","Republic","Tarja Halonen","3236","FI"),
("FJI","Fiji Islands","Oceania","Melanesia","18274.00","1970","817000","67.9","1536.00","2149.00","Fiji Islands","Republic","Josefa Iloilo","764","FJ"),
("FLK","Falkland Islands","South America","South America","12173.00","","2000","","0.00","","Falkland Islands","Dependent Territory of the UK","Elisabeth II","763","FK"),
("FRA","France","Europe","Western Europe","551500.00","843","59225700","78.8","1424285.00","1392448.00","France","Republic","Jacques Chirac","2974","FR"),
("FRO","Faroe Islands","Europe","Nordic Countries","1399.00","","43000","78.4","0.00","","Føroyar","Part of Denmark","Margrethe II","901","FO"),
("FSM","Micronesia, Federated States of","Oceania","Micronesia","702.00","1990","119000","68.6","212.00","","Micronesia","Federal Republic","Leo A. Falcam","2689","FM"),
("GAB","Gabon","Africa","Central Africa","267668.00","1960","1226000","50.1","5493.00","5279.00","Le Gabon","Republic","Omar Bongo","902","GA"),
("GBR","United Kingdom","Europe","British Islands","242900.00","1066","59623400","77.7","1378330.00","1296830.00","United Kingdom","Constitutional Monarchy","Elisabeth II","456","GB"),
("GEO","Georgia","Asia","Middle East","69700.00","1991","4968000","64.5","6064.00","5924.00","Sakartvelo","Republic","Eduard Ševardnadze","905","GE"),
("GIB","Gibraltar","Europe","Southern Europe","6.00","","25000","79.0","258.00","","Gibraltar","Dependent Territory of the UK","Elisabeth II","915","GI"),
("GIN","Guinea","Africa","Western Africa","245857.00","1958","7430000","45.6","2352.00","2383.00","Guinée","Republic","Lansana Conté","926","GN"),
("GLP","Guadeloupe","North America","Caribbean","1705.00","","456000","77.0","3501.00","","Guadeloupe","Overseas Department of France","Jacques Chirac","919","GP"),
("GMB","Gambia","Africa","Western Africa","11295.00","1965","1305000","53.2","320.00","325.00","The Gambia","Republic","Yahya Jammeh","904","GM"),
("GNB","Guinea-Bissau","Africa","Western Africa","36125.00","1974","1213000","49.0","293.00","272.00","Guiné-Bissau","Republic","Kumba Ialá","927","GW"),
("GNQ","Equatorial Guinea","Africa","Central Africa","28051.00","1968","453000","53.6","283.00","542.00","Guinea Ecuatorial","Republic","Teodoro Obiang Nguema Mbasogo","2972","GQ"),
("GRC","Greece","Europe","Southern Europe","131626.00","1830","10545700","78.4","120724.00","119946.00","Elláda","Republic","Kostis Stefanopoulos","2401","GR"),
("GRD","Grenada","North America","Caribbean","344.00","1974","94000","64.5","318.00","","Grenada","Constitutional Monarchy","Elisabeth II","916","GD"),
("GRL","Greenland","North America","North America","2166090.00","","56000","68.1","0.00","","Kalaallit Nunaat/Grønland","Part of Denmark","Margrethe II","917","GL"),
("GTM","Guatemala","North America","Central America","108889.00","1821","11385000","66.2","19008.00","17797.00","Guatemala","Republic","Alfonso Portillo Cabrera","922","GT"),
("GUF","French Guiana","South America","South America","90000.00","","181000","76.1","681.00","","Guyane française","Overseas Department of France","Jacques Chirac","3014","GF"),
("GUM","Guam","Oceania","Micronesia","549.00","","168000","77.8","1197.00","1136.00","Guam","US Territory","George W. Bush","921","GU"),
("GUY","Guyana","South America","South America","214969.00","1966","861000","64.0","722.00","743.00","Guyana","Republic","Bharrat Jagdeo","928","GY"),
("HKG","Hong Kong","Asia","Eastern Asia","1075.00","","6782000","79.5","166448.00","173610.00","Xianggang/Hong Kong","Special Administrative Region of China","Jiang Zemin","937","HK"),
("HMD","Heard Island and McDonald Islands","Antarctica","Antarctica","359.00","","0","","0.00","","Heard and McDonald Islands","Territory of Australia","Elisabeth II","","HM"),
("HND","Honduras","North America","Central America","112088.00","1838","6485000","69.9","5333.00","4697.00","Honduras","Republic","Carlos Roberto Flores Facussé","933","HN"),
("HRV","Croatia","Europe","Southern Europe","56538.00","1991","4473000","73.7","20208.00","19300.00","Hrvatska","Republic","Štipe Mesic","2409","HR"),
("HTI","Haiti","North America","Caribbean","27750.00","1804","8222000","49.2","3459.00","3107.00","Haïti/Dayti","Republic","Jean-Bertrand Aristide","929","HT"),
("HUN","Hungary","Europe","Eastern Europe","93030.00","1918","10043200","71.4","48267.00","45914.00","Magyarország","Republic","Ferenc Mádl","3483","HU"),
("IDN","Indonesia","Asia","Southeast Asia","1904569.00","1945","212107000","68.0","84982.00","215002.00","Indonesia","Republic","Abdurrahman Wahid","939","ID"),
("IND","India","Asia","Southern and Central Asia","3287263.00","1947","1013662000","62.5","447114.00","430572.00","Bharat/India","Federal Republic","Kocheril Raman Narayanan","1109","IN"),
("IOT","British Indian Ocean Territory","Africa","Eastern Africa","78.00","","0","","0.00","","British Indian Ocean Territory","Dependent Territory of the UK","Elisabeth II","","IO"),
("IRL","Ireland","Europe","British Islands","70273.00","1921","3775100","76.8","75921.00","73132.00","Ireland/Éire","Republic","Mary McAleese","1447","IE"),
("IRN","Iran","Asia","Southern and Central Asia","1648195.00","1906","67702000","69.7","195746.00","160151.00","Iran","Islamic Republic","Ali Mohammad Khatami-Ardakani","1380","IR"),
("IRQ","Iraq","Asia","Middle East","438317.00","1932","23115000","66.5","11500.00","","Al-´Iraq","Republic","Saddam Hussein al-Takriti","1365","IQ"),
("ISL","Iceland","Europe","Nordic Countries","103000.00","1944","279000","79.4","8255.00","7474.00","Ísland","Republic","Ólafur Ragnar Grímsson","1449","IS"),
("ISR","Israel","Asia","Middle East","21056.00","1948","6217000","78.6","97477.00","98577.00","Yisra’el/Isra’il","Republic","Moshe Katzav","1450","IL"),
("ITA","Italy","Europe","Southern Europe","301316.00","1861","57680000","79.0","1161755.00","1145372.00","Italia","Republic","Carlo Azeglio Ciampi","1464","IT"),
("JAM","Jamaica","North America","Caribbean","10990.00","1962","2583000","75.2","6871.00","6722.00","Jamaica","Constitutional Monarchy","Elisabeth II","1530","JM"),
("JOR","Jordan","Asia","Middle East","88946.00","1946","5083000","77.4","7526.00","7051.00","Al-Urdunn","Constitutional Monarchy","Abdullah II","1786","JO"),
("JPN","Japan","Asia","Eastern Asia","377829.00","-660","126714000","80.7","3787042.00","4192638.00","Nihon/Nippon","Constitutional Monarchy","Akihito","1532","JP"),
("KAZ","Kazakstan","Asia","Southern and Central Asia","2724900.00","1991","16223000","63.2","24375.00","23383.00","Qazaqstan","Republic","Nursultan Nazarbajev","1864","KZ"),
("KEN","Kenya","Africa","Eastern Africa","580367.00","1963","30080000","48.0","9217.00","10241.00","Kenya","Republic","Daniel arap Moi","1881","KE"),
("KGZ","Kyrgyzstan","Asia","Southern and Central Asia","199900.00","1991","4699000","63.4","1626.00","1767.00","Kyrgyzstan","Republic","Askar Akajev","2253","KG"),
("KHM","Cambodia","Asia","Southeast Asia","181035.00","1953","11168000","56.5","5121.00","5670.00","Kâmpuchéa","Constitutional Monarchy","Norodom Sihanouk","1800","KH"),
("KIR","Kiribati","Oceania","Micronesia","726.00","1979","83000","59.8","40.70","","Kiribati","Republic","Teburoro Tito","2256","KI"),
("KNA","Saint Kitts and Nevis","North America","Caribbean","261.00","1983","38000","70.7","299.00","","Saint Kitts and Nevis","Constitutional Monarchy","Elisabeth II","3064","KN"),
("KOR","South Korea","Asia","Eastern Asia","99434.00","1948","46844000","74.4","320749.00","442544.00","Taehan Min’guk (Namhan)","Republic","Kim Dae-jung","2331","KR"),
("KWT","Kuwait","Asia","Middle East","17818.00","1961","1972000","76.1","27037.00","30373.00","Al-Kuwayt","Constitutional Monarchy (Emirate)","Jabir al-Ahmad al-Jabir al-Sabah","2429","KW"),
("LAO","Laos","Asia","Southeast Asia","236800.00","1953","5433000","53.1","1292.00","1746.00","Lao","Republic","Khamtay Siphandone","2432","LA"),
("LBN","Lebanon","Asia","Middle East","10400.00","1941","3282000","71.3","17121.00","15129.00","Lubnan","Republic","Émile Lahoud","2438","LB"),
("LBR","Liberia","Africa","Western Africa","111369.00","1847","3154000","51.0","2012.00","","Liberia","Republic","Charles Taylor","2440","LR"),
("LBY","Libyan Arab Jamahiriya","Africa","Northern Africa","1759540.00","1951","5605000","75.5","44806.00","40562.00","Libiya","Socialistic State","Muammar al-Qadhafi","2441","LY"),
("LCA","Saint Lucia","North America","Caribbean","622.00","1979","154000","72.3","571.00","","Saint Lucia","Constitutional Monarchy","Elisabeth II","3065","LC"),
("LIE","Liechtenstein","Europe","Western Europe","160.00","1806","32300","78.8","1119.00","1084.00","Liechtenstein","Constitutional Monarchy","Hans-Adam II","2446","LI"),
("LKA","Sri Lanka","Asia","Southern and Central Asia","65610.00","1948","18827000","71.8","15706.00","15091.00","Sri Lanka/Ilankai","Republic","Chandrika Kumaratunga","3217","LK"),
("LSO","Lesotho","Africa","Southern Africa","30355.00","1966","2153000","50.8","1061.00","1161.00","Lesotho","Constitutional Monarchy","Letsie III","2437","LS"),
("LTU","Lithuania","Europe","Baltic Countries","65301.00","1991","3698500","69.1","10692.00","9585.00","Lietuva","Republic","Valdas Adamkus","2447","LT"),
("LUX","Luxembourg","Europe","Western Europe","2586.00","1867","435700","77.1","16321.00","15519.00","Luxembourg/Lëtzebuerg","Constitutional Monarchy","Henri","2452","LU"),
("LVA","Latvia","Europe","Baltic Countries","64589.00","1991","2424200","68.4","6398.00","5639.00","Latvija","Republic","Vaira Vike-Freiberga","2434","LV"),
("MAC","Macao","Asia","Eastern Asia","18.00","","473000","81.6","5749.00","5940.00","Macau/Aomen","Special Administrative Region of China","Jiang Zemin","2454","MO"),
("MAR","Morocco","Africa","Northern Africa","446550.00","1956","28351000","69.1","36124.00","33514.00","Al-Maghrib","Constitutional Monarchy","Mohammed VI","2486","MA"),
("MCO","Monaco","Europe","Western Europe","1.50","1861","34000","78.8","776.00","","Monaco","Constitutional Monarchy","Rainier III","2695","MC"),
("MDA","Moldova","Europe","Eastern Europe","33851.00","1991","4380000","64.5","1579.00","1872.00","Moldova","Republic","Vladimir Voronin","2690","MD"),
("MDG","Madagascar","Africa","Eastern Africa","587041.00","1960","15942000","55.0","3750.00","3545.00","Madagasikara/Madagascar","Federal Republic","Didier Ratsiraka","2455","MG"),
("MDV","Maldives","Asia","Southern and Central Asia","298.00","1965","286000","62.2","199.00","","Dhivehi Raajje/Maldives","Republic","Maumoon Abdul Gayoom","2463","MV"),
("MEX","Mexico","North America","Central America","1958201.00","1810","98881000","71.5","414972.00","401461.00","México","Federal Republic","Vicente Fox Quesada","2515","MX"),
("MHL","Marshall Islands","Oceania","Micronesia","181.00","1990","64000","65.5","97.00","","Marshall Islands/Majol","Republic","Kessai Note","2507","MH"),
("MKD","Macedonia","Europe","Southern Europe","25713.00","1991","2024000","73.8","1694.00","1915.00","Makedonija","Republic","Boris Trajkovski","2460","MK"),
("MLI","Mali","Africa","Western Africa","1240192.00","1960","11234000","46.7","2642.00","2453.00","Mali","Republic","Alpha Oumar Konaré","2482","ML"),
("MLT","Malta","Europe","Southern Europe","316.00","1964","380200","77.9","3512.00","3338.00","Malta","Republic","Guido de Marco","2484","MT"),
("MMR","Myanmar","Asia","Southeast Asia","676578.00","1948","45611000","54.9","180375.00","171028.00","Myanma Pye","Republic","kenraali Than Shwe","2710","MM"),
("MNG","Mongolia","Asia","Eastern Asia","1566500.00","1921","2662000","67.3","1043.00","933.00","Mongol Uls","Republic","Natsagiin Bagabandi","2696","MN"),
("MNP","Northern Mariana Islands","Oceania","Micronesia","464.00","","78000","75.5","0.00","","Northern Mariana Islands","Commonwealth of the US","George W. Bush","2913","MP"),
("MOZ","Mozambique","Africa","Eastern Africa","801590.00","1975","19680000","37.5","2891.00","2711.00","Moçambique","Republic","Joaquím A. Chissano","2698","MZ"),
("MRT","Mauritania","Africa","Western Africa","1025520.00","1960","2670000","50.8","998.00","1081.00","Muritaniya/Mauritanie","Republic","Maaouiya Ould Sid´Ahmad Taya","2509","MR"),
("MSR","Montserrat","North America","Caribbean","102.00","","11000","78.0","109.00","","Montserrat","Dependent Territory of the UK","Elisabeth II","2697","MS"),
("MTQ","Martinique","North America","Caribbean","1102.00","","395000","78.3","2731.00","2559.00","Martinique","Overseas Department of France","Jacques Chirac","2508","MQ"),
("MUS","Mauritius","Africa","Eastern Africa","2040.00","1968","1158000","71.0","4251.00","4186.00","Mauritius","Republic","Cassam Uteem","2511","MU"),
("MWI","Malawi","Africa","Eastern Africa","118484.00","1964","10925000","37.6","1687.00","2527.00","Malawi","Republic","Bakili Muluzi","2462","MW"),
("MYS","Malaysia","Asia","Southeast Asia","329758.00","1957","22244000","70.8","69213.00","97884.00","Malaysia","Constitutional Monarchy, Federation","Salahuddin Abdul Aziz Shah Alhaj","2464","MY"),
("MYT","Mayotte","Africa","Eastern Africa","373.00","","149000","59.5","0.00","","Mayotte","Territorial Collectivity of France","Jacques Chirac","2514","YT"),
("NAM","Namibia","Africa","Southern Africa","824292.00","1990","1726000","42.5","3101.00","3384.00","Namibia","Republic","Sam Nujoma","2726","NA"),
("NCL","New Caledonia","Oceania","Melanesia","18575.00","","214000","72.8","3563.00","","Nouvelle-Calédonie","Nonmetropolitan Territory of France","Jacques Chirac","3493","NC"),
("NER","Niger","Africa","Western Africa","1267000.00","1960","10730000","41.3","1706.00","1580.00","Niger","Republic","Mamadou Tandja","2738","NE"),
("NFK","Norfolk Island","Oceania","Australia and New Zealand","36.00","","2000","","0.00","","Norfolk Island","Territory of Australia","Elisabeth II","2806","NF"),
("NGA","Nigeria","Africa","Western Africa","923768.00","1960","111506000","51.6","65707.00","58623.00","Nigeria","Federal Republic","Olusegun Obasanjo","2754","NG"),
("NIC","Nicaragua","North America","Central America","130000.00","1838","5074000","68.7","1988.00","2023.00","Nicaragua","Republic","Arnoldo Alemán Lacayo","2734","NI"),
("NIU","Niue","Oceania","Polynesia","260.00","","2000","","0.00","","Niue","Nonmetropolitan Territory of New Zealand","Elisabeth II","2805","NU"),
("NLD","Netherlands","Europe","Western Europe","41526.00","1581","15864000","78.3","371362.00","360478.00","Nederland","Constitutional Monarchy","Beatrix","5","NL"),
("NOR","Norway","Europe","Nordic Countries","323877.00","1905","4478500","78.7","145895.00","153370.00","Norge","Constitutional Monarchy","Harald V","2807","NO"),
("NPL","Nepal","Asia","Southern and Central Asia","147181.00","1769","23930000","57.8","4768.00","4837.00","Nepal","Constitutional Monarchy","Gyanendra Bir Bikram","2729","NP"),
("NRU","Nauru","Oceania","Micronesia","21.00","1968","12000","60.8","197.00","","Naoero/Nauru","Republic","Bernard Dowiyogo","2728","NR"),
("NZL","New Zealand","Oceania","Australia and New Zealand","270534.00","1907","3862000","77.8","54669.00","64960.00","New Zealand/Aotearoa","Constitutional Monarchy","Elisabeth II","3499","NZ"),
("OMN","Oman","Asia","Middle East","309500.00","1951","2542000","71.8","16904.00","16153.00","´Uman","Monarchy (Sultanate)","Qabus ibn Sa´id","2821","OM"),
("PAK","Pakistan","Asia","Southern and Central Asia","796095.00","1947","156483000","61.1","61289.00","58549.00","Pakistan","Republic","Mohammad Rafiq Tarar","2831","PK"),
("PAN","Panama","North America","Central America","75517.00","1903","2856000","75.5","9131.00","8700.00","Panamá","Republic","Mireya Elisa Moscoso Rodríguez","2882","PA"),
("PCN","Pitcairn","Oceania","Polynesia","49.00","","50","","0.00","","Pitcairn","Dependent Territory of the UK","Elisabeth II","2912","PN"),
("PER","Peru","South America","South America","1285216.00","1821","25662000","70.0","64140.00","65186.00","Perú/Piruw","Republic","Valentin Paniagua Corazao","2890","PE"),
("PHL","Philippines","Asia","Southeast Asia","300000.00","1946","75967000","67.5","65107.00","82239.00","Pilipinas","Republic","Gloria Macapagal-Arroyo","766","PH"),
("PLW","Palau","Oceania","Micronesia","459.00","1994","19000","68.6","105.00","","Belau/Palau","Republic","Kuniwo Nakamura","2881","PW"),
("PNG","Papua New Guinea","Oceania","Melanesia","462840.00","1975","4807000","63.1","4988.00","6328.00","Papua New Guinea/Papua Niugini","Constitutional Monarchy","Elisabeth II","2884","PG"),
("POL","Poland","Europe","Eastern Europe","323250.00","1918","38653600","73.2","151697.00","135636.00","Polska","Republic","Aleksander Kwasniewski","2928","PL"),
("PRI","Puerto Rico","North America","Caribbean","8875.00","","3869000","75.6","34100.00","32100.00","Puerto Rico","Commonwealth of the US","George W. Bush","2919","PR"),
("PRK","North Korea","Asia","Eastern Asia","120538.00","1948","24039000","70.7","5332.00","","Choson Minjujuui In´min Konghwaguk (Bukhan)","Socialistic Republic","Kim Jong-il","2318","KP"),
("PRT","Portugal","Europe","Southern Europe","91982.00","1143","9997600","75.8","105954.00","102133.00","Portugal","Republic","Jorge Sampãio","2914","PT"),
("PRY","Paraguay","South America","South America","406752.00","1811","5496000","73.7","8444.00","9555.00","Paraguay","Republic","Luis Ángel González Macchi","2885","PY"),
("PSE","Palestine","Asia","Middle East","6257.00","","3101000","71.4","4173.00","","Filastin","Autonomous Area","Yasser (Yasir) Arafat","4074","PS"),
("PYF","French Polynesia","Oceania","Polynesia","4000.00","","235000","74.8","818.00","781.00","Polynésie française","Nonmetropolitan Territory of France","Jacques Chirac","3016","PF"),
("QAT","Qatar","Asia","Middle East","11000.00","1971","599000","72.4","9472.00","8920.00","Qatar","Monarchy","Hamad ibn Khalifa al-Thani","2973","QA"),
("REU","Réunion","Africa","Eastern Africa","2510.00","","699000","72.7","8287.00","7988.00","Réunion","Overseas Department of France","Jacques Chirac","3017","RE"),
("ROM","Romania","Europe","Eastern Europe","238391.00","1878","22455500","69.9","38158.00","34843.00","România","Republic","Ion Iliescu","3018","RO"),
("RUS","Russian Federation","Europe","Eastern Europe","17075400.00","1991","146934000","67.2","276608.00","442989.00","Rossija","Federal Republic","Vladimir Putin","3580","RU"),
("RWA","Rwanda","Africa","Eastern Africa","26338.00","1962","7733000","39.3","2036.00","1863.00","Rwanda/Urwanda","Republic","Paul Kagame","3047","RW"),
("SAU","Saudi Arabia","Asia","Middle East","2149690.00","1932","21607000","67.8","137635.00","146171.00","Al-´Arabiya as-Sa´udiya","Monarchy","Fahd ibn Abdul-Aziz al-Sa´ud","3173","SA"),
("SDN","Sudan","Africa","Northern Africa","2505813.00","1956","29490000","56.6","10162.00","","As-Sudan","Islamic Republic","Omar Hassan Ahmad al-Bashir","3225","SD"),
("SEN","Senegal","Africa","Western Africa","196722.00","1960","9481000","62.2","4787.00","4542.00","Sénégal/Sounougal","Republic","Abdoulaye Wade","3198","SN"),
("SGP","Singapore","Asia","Southeast Asia","618.00","1965","3567000","80.1","86503.00","96318.00","Singapore/Singapura/Xinjiapo/Singapur","Republic","Sellapan Rama Nathan","3208","SG"),
("SGS","South Georgia and the South Sandwich Islands","Antarctica","Antarctica","3903.00","","0","","0.00","","South Georgia and the South Sandwich Islands","Dependent Territory of the UK","Elisabeth II","","GS"),
("SHN","Saint Helena","Africa","Western Africa","314.00","","6000","76.8","0.00","","Saint Helena","Dependent Territory of the UK","Elisabeth II","3063","SH"),
("SJM","Svalbard and Jan Mayen","Europe","Nordic Countries","62422.00","","3200","","0.00","","Svalbard og Jan Mayen","Dependent Territory of Norway","Harald V","938","SJ"),
("SLB","Solomon Islands","Oceania","Melanesia","28896.00","1978","444000","71.3","182.00","220.00","Solomon Islands","Constitutional Monarchy","Elisabeth II","3161","SB"),
("SLE","Sierra Leone","Africa","Western Africa","71740.00","1961","4854000","45.3","746.00","858.00","Sierra Leone","Republic","Ahmed Tejan Kabbah","3207","SL"),
("SLV","El Salvador","North America","Central America","21041.00","1841","6276000","69.7","11863.00","11203.00","El Salvador","Republic","Francisco Guillermo Flores Pérez","645","SV"),
("SMR","San Marino","Europe","Southern Europe","61.00","885","27000","81.1","510.00","","San Marino","Republic","","3171","SM"),
("SOM","Somalia","Africa","Eastern Africa","637657.00","1960","10097000","46.2","935.00","","Soomaaliya","Republic","Abdiqassim Salad Hassan","3214","SO"),
("SPM","Saint Pierre and Miquelon","North America","North America","242.00","","7000","77.6","0.00","","Saint-Pierre-et-Miquelon","Territorial Collectivity of France","Jacques Chirac","3067","PM"),
("STP","Sao Tome and Principe","Africa","Central Africa","964.00","1975","147000","65.3","6.00","","São Tomé e Príncipe","Republic","Miguel Trovoada","3172","ST"),
("SUR","Suriname","South America","South America","163265.00","1975","417000","71.4","870.00","706.00","Suriname","Republic","Ronald Venetiaan","3243","SR"),
("SVK","Slovakia","Europe","Eastern Europe","49012.00","1993","5398700","73.7","20594.00","19452.00","Slovensko","Republic","Rudolf Schuster","3209","SK"),
("SVN","Slovenia","Europe","Southern Europe","20256.00","1991","1987800","74.9","19756.00","18202.00","Slovenija","Republic","Milan Kucan","3212","SI"),
("SWE","Sweden","Europe","Nordic Countries","449964.00","836","8861400","79.6","226492.00","227757.00","Sverige","Constitutional Monarchy","Carl XVI Gustaf","3048","SE"),
("SWZ","Swaziland","Africa","Southern Africa","17364.00","1968","1008000","40.4","1206.00","1312.00","kaNgwane","Monarchy","Mswati III","3244","SZ"),
("SYC","Seychelles","Africa","Eastern Africa","455.00","1976","77000","70.4","536.00","539.00","Sesel/Seychelles","Republic","France-Albert René","3206","SC"),
("SYR","Syria","Asia","Middle East","185180.00","1941","16125000","68.5","65984.00","64926.00","Suriya","Republic","Bashar al-Assad","3250","SY"),
("TCA","Turks and Caicos Islands","North America","Caribbean","430.00","","17000","73.3","96.00","","The Turks and Caicos Islands","Dependent Territory of the UK","Elisabeth II","3423","TC"),
("TCD","Chad","Africa","Central Africa","1284000.00","1960","7651000","50.5","1208.00","1102.00","Tchad/Tshad","Republic","Idriss Déby","3337","TD"),
("TGO","Togo","Africa","Western Africa","56785.00","1960","4629000","54.7","1449.00","1400.00","Togo","Republic","Gnassingbé Eyadéma","3332","TG"),
("THA","Thailand","Asia","Southeast Asia","513115.00","1350","61399000","68.6","116416.00","153907.00","Prathet Thai","Constitutional Monarchy","Bhumibol Adulyadej","3320","TH"),
("TJK","Tajikistan","Asia","Southern and Central Asia","143100.00","1991","6188000","64.1","1990.00","1056.00","Toçikiston","Republic","Emomali Rahmonov","3261","TJ"),
("TKL","Tokelau","Oceania","Polynesia","12.00","","2000","","0.00","","Tokelau","Nonmetropolitan Territory of New Zealand","Elisabeth II","3333","TK"),
("TKM","Turkmenistan","Asia","Southern and Central Asia","488100.00","1991","4459000","60.9","4397.00","2000.00","Türkmenostan","Republic","Saparmurad Nijazov","3419","TM"),
("TMP","East Timor","Asia","Southeast Asia","14874.00","","885000","46.0","0.00","","Timor Timur","Administrated by the UN","José Alexandre Gusmão","1522","TP"),
("TON","Tonga","Oceania","Polynesia","650.00","1970","99000","67.9","146.00","170.00","Tonga","Monarchy","Taufa\'ahau Tupou IV","3334","TO"),
("TTO","Trinidad and Tobago","North America","Caribbean","5130.00","1962","1295000","68.0","6232.00","5867.00","Trinidad and Tobago","Republic","Arthur N. R. Robinson","3336","TT"),
("TUN","Tunisia","Africa","Northern Africa","163610.00","1956","9586000","73.7","20026.00","18898.00","Tunis/Tunisie","Republic","Zine al-Abidine Ben Ali","3349","TN"),
("TUR","Turkey","Asia","Middle East","774815.00","1923","66591000","71.0","210721.00","189122.00","Türkiye","Republic","Ahmet Necdet Sezer","3358","TR"),
("TUV","Tuvalu","Oceania","Polynesia","26.00","1978","12000","66.3","6.00","","Tuvalu","Constitutional Monarchy","Elisabeth II","3424","TV"),
("TWN","Taiwan","Asia","Eastern Asia","36188.00","1945","22256000","76.4","256254.00","263451.00","T’ai-wan","Republic","Chen Shui-bian","3263","TW"),
("TZA","Tanzania","Africa","Eastern Africa","883749.00","1961","33517000","52.3","8005.00","7388.00","Tanzania","Republic","Benjamin William Mkapa","3306","TZ"),
("UGA","Uganda","Africa","Eastern Africa","241038.00","1962","21778000","42.9","6313.00","6887.00","Uganda","Republic","Yoweri Museveni","3425","UG"),
("UKR","Ukraine","Europe","Eastern Europe","603700.00","1991","50456000","66.0","42168.00","49677.00","Ukrajina","Republic","Leonid Kutšma","3426","UA"),
("UMI","United States Minor Outlying Islands","Oceania","Micronesia/Caribbean","16.00","","0","","0.00","","United States Minor Outlying Islands","Dependent Territory of the US","George W. Bush","","UM"),
("URY","Uruguay","South America","South America","175016.00","1828","3337000","75.2","20831.00","19967.00","Uruguay","Republic","Jorge Batlle Ibáñez","3492","UY"),
("USA","United States","North America","North America","9363520.00","1776","278357000","77.1","8510700.00","8110900.00","United States","Federal Republic","George W. Bush","3813","US"),
("UZB","Uzbekistan","Asia","Southern and Central Asia","447400.00","1991","24318000","63.7","14194.00","21300.00","Uzbekiston","Republic","Islam Karimov","3503","UZ"),
("VAT","Holy See (Vatican City State)","Europe","Southern Europe","0.40","1929","1000","","9.00","","Santa Sede/Città del Vaticano","Independent Church State","Johannes Paavali II","3538","VA"),
("VCT","Saint Vincent and the Grenadines","North America","Caribbean","388.00","1979","114000","72.3","285.00","","Saint Vincent and the Grenadines","Constitutional Monarchy","Elisabeth II","3066","VC"),
("VEN","Venezuela","South America","South America","912050.00","1811","24170000","73.1","95023.00","88434.00","Venezuela","Federal Republic","Hugo Chávez Frías","3539","VE"),
("VGB","Virgin Islands, British","North America","Caribbean","151.00","","21000","75.4","612.00","573.00","British Virgin Islands","Dependent Territory of the UK","Elisabeth II","537","VG"),
("VIR","Virgin Islands, U.S.","North America","Caribbean","347.00","","93000","78.1","0.00","","Virgin Islands of the United States","US Territory","George W. Bush","4067","VI"),
("VNM","Vietnam","Asia","Southeast Asia","331689.00","1945","79832000","69.3","21929.00","22834.00","Viêt Nam","Socialistic Republic","Trân Duc Luong","3770","VN"),
("VUT","Vanuatu","Oceania","Melanesia","12189.00","1980","190000","60.6","261.00","246.00","Vanuatu","Republic","John Bani","3537","VU"),
("WLF","Wallis and Futuna","Oceania","Polynesia","200.00","","15000","","0.00","","Wallis-et-Futuna","Nonmetropolitan Territory of France","Jacques Chirac","3536","WF"),
("WSM","Samoa","Oceania","Polynesia","2831.00","1962","180000","69.2","141.00","157.00","Samoa","Parlementary Monarchy","Malietoa Tanumafili II","3169","WS"),
("YEM","Yemen","Asia","Middle East","527968.00","1918","18112000","59.8","6041.00","5729.00","Al-Yaman","Republic","Ali Abdallah Salih","1780","YE"),
("YUG","Yugoslavia","Europe","Southern Europe","102173.00","1918","10640000","72.4","17000.00","","Jugoslavija","Federal Republic","Vojislav Koštunica","1792","YU"),
("ZAF","South Africa","Africa","Southern Africa","1221037.00","1910","40377000","51.1","116729.00","129092.00","South Africa","Republic","Thabo Mbeki","716","ZA"),
("ZMB","Zambia","Africa","Eastern Africa","752618.00","1964","9169000","37.2","3377.00","3922.00","Zambia","Republic","Frederick Chiluba","3162","ZM"),
("ZWE","Zimbabwe","Africa","Eastern Africa","390757.00","1980","11669000","37.8","5951.00","8670.00","Zimbabwe","Republic","Robert G. Mugabe","4068","ZW"),
("GHA","Ghana","Africa","","0.00","","0","","","","","","","","");



DROP TABLE IF EXISTS perez_demographics;

CREATE TABLE `perez_demographics` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_demographics VALUES("1","Adults"),
("2","Youlth"),
("3","Children"),
("4","Oldies");



DROP TABLE IF EXISTS perez_departments;

CREATE TABLE `perez_departments` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `PARENT` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

INSERT INTO perez_departments VALUES("2","Vocals","0"),
("4","Acoustic Guiternmnmm","7"),
("6","Lead Guiter","1"),
("7","Piano","1"),
("8","Violin","1"),
("9","Drums","1"),
("11","Keyboard","1"),
("12","Conka","1"),
("13","Worship Leader","2"),
("14","Alto","2"),
("15","Worship Leader","2"),
("16","Tenor","2"),
("18","Soprano","2"),
("19","Producer","3"),
("20","Sound Engineer","3"),
("21","Words","3"),
("22","Camera","3"),
("23","Lights","3"),
("24","Video Switcher","3"),
("25","Preachers","2"),
("27","Acoustic Guiternmnmm","0"),
("28","iuiuiuiuiu","2"),
("29","nnnnn","0"),
("30","nnnnn","0"),
("31","nb b bn nb nb","0"),
("32","nmnb","0");



DROP TABLE IF EXISTS perez_districts;

CREATE TABLE `perez_districts` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `REGION` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_districts VALUES("1","Sege District","Greater Accra"),
("2","Ada West","Greater Accra"),
("3","kjjj","Greater Accra"),
("4","dsdsdsd","Volta ");



DROP TABLE IF EXISTS perez_ethnic;

CREATE TABLE `perez_ethnic` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_ethnic VALUES("1","Ashanti"),
("2","Ewe"),
("3","Ga-Adangbe"),
("4","Gaun");



DROP TABLE IF EXISTS perez_family;

CREATE TABLE `perez_family` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(100) DEFAULT NULL,
  `LASTNAME` varchar(100) DEFAULT NULL,
  `PHONE` varchar(13) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `CITY` varchar(100) DEFAULT NULL,
  `REGION` varchar(30) DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO perez_family VALUES("1","BBC2323","Ocansey","0243348522","gadocansey@gmail.com","UC13,Cape Coast","Cape Coast","Central","Ghana"),
("2","BIB/FAM/2015/107","Sam","0505284060","sammo@gmail.com","UC23","Cape Coast","Upper East","Ghana"),
("3","BIB/FAM/2015/112","Hanyo","0502038558","julius@gmail.com","Klick","Accra","Volta ","Ghana");



DROP TABLE IF EXISTS perez_gen_ledger;

CREATE TABLE `perez_gen_ledger` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `RECEIPT` int(11) NOT NULL,
  `CLASS` varchar(11) NOT NULL,
  `STUDENT` varchar(50) DEFAULT NULL,
  `FEE_TYPE` varchar(50) DEFAULT NULL,
  `AMOUNT` decimal(2,0) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `CHEQUE_NO` varchar(32) NOT NULL,
  `BANK` int(11) NOT NULL COMMENT 'represent bank',
  `TERM` int(11) DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  `RECEIVED_BY` int(11) NOT NULL,
  `NULLIFIER` double NOT NULL,
  `VIEW` int(11) NOT NULL DEFAULT '1' COMMENT '1 means visible,0 means invisble',
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

INSERT INTO perez_gen_ledger VALUES("1","100","BASIC 6","4","Academic","-10","Fees Payment","DSDSD","0","1","2014/2015","13423","0","0","2015-08-22 07:58:23"),
("2","100","BASIC 6","4","Academic","16","Fees Payment","JJJ","0","1","2014/2015","13423","10","1","2015-08-22 08:14:29"),
("3","100","BASIC 6","4","Academic","46","Fees Payment","HV","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("4","100","BASIC 6","4","Academic","-20","Fees Payment","dsd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("5","100","BASIC 6","4","Academic","-4","Fees Payment","jdsjd22","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("6","100","BASIC 6","4","PTA","56","Fees Payment","hjhjhj","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("7","100","BASIC 6","","PTA","93","Fees Payment","djskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("8","100","BASIC 6","","PTA","99","Fees Payment","dsdsd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("9","100","BASIC 6","","PTA","99","Fees Payment","dsdsd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("10","100","BASIC 6","4","PTA","56","Fees Payment","3i300333","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("11","100","BASIC 6","","Academic","99","Fees Payment","sdjskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("12","100","BASIC 6","","Academic","99","Fees Payment","sdjskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("13","100","BASIC 6","","Academic","99","Fees Payment","sdjskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("14","100","BASIC 6","","Academic","99","Fees Payment","sdjskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("15","100","BASIC 6","","Academic","99","Fees Payment","sdjskd","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("16","101","BASIC 6","","PTA","99","Fees Payment","339339","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("17","102","BASIC 6","","Academic","99","Fees Payment","d338383","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02"),
("18","103","BASIC 5","","Academic","88","Fees Payment","8989","0","1","2014/2015","13423","0","1","2015-08-22 07:25:02");



DROP TABLE IF EXISTS perez_group;

CREATE TABLE `perez_group` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `GROUP_CODE` varchar(50) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `LEADER` int(11) DEFAULT NULL,
  `CATEGORIES` varchar(100) DEFAULT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `END_DATE` int(11) DEFAULT NULL,
  `START_DATE` int(11) DEFAULT NULL,
  `DAYS` varchar(50) DEFAULT NULL,
  `END_TIME` varchar(50) DEFAULT NULL,
  `START_TIME` varchar(50) DEFAULT NULL,
  `FREQUENCY` varchar(100) DEFAULT NULL,
  `DEPARTMENTS` varchar(100) DEFAULT NULL,
  `DEMOGRAPHICS` varchar(100) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `STATUS` int(5) DEFAULT '1' COMMENT '1 means active, 0 means inactive',
  `DATE_CREATED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `GROUP_CODE` (`GROUP_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_group VALUES("3","BIB2015107","Prayer Only","2","1","4","2329200","1897200","Mondays,Wednesdays,Thursdays","5:01 AM","5:01 AM","Daily","6,9","Adults,Families,Youlth,Children","UXX 12,Ada","1","2015-11-03 05:12:05"),
("4","","Gad udusuududd","9","7","3","-3600","-3600","Wednesdays,Thursdays","10:30 AM","10:12 PM","Weekly","15,16","Adults,Families,Youlth,Children","bbbbb","0","2016-07-14 10:14:33");



DROP TABLE IF EXISTS perez_group_category;

CREATE TABLE `perez_group_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DETAILS` varchar(400) DEFAULT NULL,
  `NAME` varchar(100) DEFAULT NULL,
  `NOTIFY_LEADER` int(11) DEFAULT NULL,
  `POSITION` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `NAME` (`NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO perez_group_category VALUES("5","ssff","ssff","1","ssfffs  ssss"),
("6","ddd","ddd","1","dsdsd"),
("7","mmmm","mmmm","1","mmmm");



DROP TABLE IF EXISTS perez_ipblocked;

CREATE TABLE `perez_ipblocked` (
  `id_ip` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(15) NOT NULL,
  `tryConnection` int(1) NOT NULL DEFAULT '1',
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




DROP TABLE IF EXISTS perez_languages;

CREATE TABLE `perez_languages` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO perez_languages VALUES("1","AKAN"),
("2","Ewe"),
("3","Dangbe"),
("4","DAGAARE / WAALE	"),
("5","KASEM"),
("6","Nzema"),
("7","Gonja"),
("8","Ga"),
("9","French"),
("10","English");



DROP TABLE IF EXISTS perez_member_category;

CREATE TABLE `perez_member_category` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CATEGORY` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO perez_member_category VALUES("1","Church Membersssssssssssssssssss"),
("2","Guests"),
("3","Inactive"),
("4","Newly Joined"),
("5","Follow up"),
("6","Deceased");



DROP TABLE IF EXISTS perez_member_payment_type;

CREATE TABLE `perez_member_payment_type` (
  `payment_type_id` int(50) NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`payment_type_id`),
  UNIQUE KEY `payment_type_name` (`payment_type_name`),
  UNIQUE KEY `payment_type_name_2` (`payment_type_name`),
  UNIQUE KEY `payment_type_name_3` (`payment_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

INSERT INTO perez_member_payment_type VALUES("1","tithe","enabled"),
("7","welfare","enabled"),
("10"," mam","enabled"),
("11","","enabled"),
("12","mmmmmm","enabled"),
("14","e","enabled"),
("15","Offers","enabled");



DROP TABLE IF EXISTS perez_member_payments;

CREATE TABLE `perez_member_payments` (
  `system_id` varchar(100) NOT NULL,
  `amount` decimal(20,2) NOT NULL,
  `month` varchar(200) NOT NULL,
  `entered_by_username` varchar(100) NOT NULL,
  `entered_by_real_name` varchar(200) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `year` year(4) NOT NULL,
  `id` bigint(244) unsigned NOT NULL AUTO_INCREMENT,
  `payment_type_name` varchar(50) NOT NULL,
  `date_of_payment` date NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`system_id`),
  KEY `payment_type_name` (`payment_type_name`),
  KEY `entered_by` (`entered_by_username`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO perez_member_payments VALUES("14","90.00","April","13423","agnes","2016-04-30 13:35:16","2016","1","1","2016-04-30","enabled"),
("14","7888.00","September","13423","agnes","2016-04-30 13:37:54","2016","2","10","2016-04-30","enabled"),
("14","78.00","April","13423","agnes","2016-04-30 13:37:54","2016","3","1","2016-04-30","enabled"),
("14","677.00","October","13423","agnes","2016-04-30 13:40:34","2016","4","7","2016-04-30","enabled"),
("14","90.00","July","13423","agnes","2016-04-30 13:41:35","2016","5","7","2016-04-30","enabled"),
("2","8999.00","March","13423","agnes","2016-05-02 08:50:47","2015","6","7","2016-05-02","enabled"),
("2","998.00","July","13423","admin","2016-07-11 18:09:10","2016","7","1","2016-07-11","enabled");



DROP TABLE IF EXISTS perez_members;

CREATE TABLE `perez_members` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `MEMBER_CODE` varchar(100) DEFAULT NULL,
  `FAMILY` int(11) DEFAULT NULL,
  `GROUPS` varchar(100) DEFAULT NULL,
  `PEOPLE_FLOW` varchar(100) DEFAULT NULL,
  `BARCODE` varchar(100) DEFAULT NULL,
  `DATE_JOINED` varchar(100) DEFAULT NULL,
  `DATE_BAPTISTED` varchar(100) NOT NULL,
  `TITLE` varchar(50) DEFAULT NULL,
  `FIRSTNAME` varchar(100) DEFAULT NULL,
  `LASTNAME` varchar(100) DEFAULT NULL,
  `OTHERNAMES` varchar(100) DEFAULT NULL,
  `ARCHIVED` char(3) DEFAULT NULL,
  `CONTACT` varchar(50) DEFAULT NULL,
  `DECEASED` char(3) DEFAULT NULL,
  `GENDER` varchar(10) DEFAULT NULL,
  `DOB` varchar(100) DEFAULT NULL,
  `AGE` int(11) DEFAULT NULL,
  `MARITAL_STATUS` varchar(20) DEFAULT NULL,
  `ANNIVERSARY` varchar(100) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `PHONE` char(20) DEFAULT NULL,
  `TELEPHONE` char(10) DEFAULT NULL,
  `VOLUNTEER` char(3) DEFAULT NULL,
  `RESIDENTIAL_ADDRESS` varchar(100) DEFAULT NULL,
  `CONTACT_ADDRESS` varchar(100) DEFAULT NULL,
  `HOMETOWN` varchar(100) DEFAULT NULL,
  `REGION` varchar(30) DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `SECURITY_CODE` varchar(100) DEFAULT NULL,
  `RECEIPT` varchar(50) DEFAULT NULL,
  `GIVING_NUMBER` int(11) DEFAULT NULL,
  `FAMILY_RELATIONSHIP` varchar(100) DEFAULT NULL,
  `MUSIC_TEAM` varchar(100) DEFAULT NULL,
  `DEMOGRAPHICS` varchar(50) DEFAULT NULL,
  `SERVICE_TYPE` varchar(100) DEFAULT NULL,
  `LOCATION` varchar(100) DEFAULT NULL,
  `BRANCH` int(11) DEFAULT NULL,
  `OCCUPATION` varchar(100) DEFAULT NULL,
  `PLACE_OF_WORK` varchar(100) NOT NULL,
  `NEXT_OF_KIN` varchar(100) DEFAULT NULL,
  `NEXT_OF_KIN_ADDRESS` varchar(100) NOT NULL,
  `NEXT_OF_KIN_PHONE` varchar(10) NOT NULL,
  `PEOPLE_CATEGORY` varchar(100) DEFAULT NULL,
  `MINISTRY` int(11) NOT NULL COMMENT 'represent ministry',
  `LANGUAGES` varchar(100) NOT NULL,
  `ETHNIC` varchar(100) NOT NULL,
  `ACCESS` varchar(100) NOT NULL,
  `DEPARTMENT` varchar(100) NOT NULL,
  `EMAIL_UNSUBSCRIBE` varchar(10) NOT NULL,
  `EMAIL_UNSUBSCRIBE_SCHEDULES` varchar(10) NOT NULL,
  `SMS_SUBSCRIBE` varchar(10) NOT NULL,
  `SMS_SUBSCRIBE_SCHEDULES` varchar(10) NOT NULL,
  `SUNDAY_SCHOOL_GRADE` varchar(50) NOT NULL,
  `REPORT` int(11) NOT NULL,
  `CREATED_BY` int(11) DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `UPDATED_AT` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `MEMBER_CODE` (`MEMBER_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

INSERT INTO perez_members VALUES("2","BIB2015102","1","3","","","163810800","-3600","Mrs","Gad","Ocansey","Kartey","","","No","Female","18282828","45","","","","0505284060","202022002","yes","ad","sdsd","skakas","Upper East","Angola","","djsdjksd","1212","Father","","1","1,3,4","4","3","sdnsdmnsd                      ","SKSKKS","dnsmdnmsdn","0222","dnmsdnmsd","3","3","AKAN,Dangbe","Ashanti","Admins,Members","5,6,7","yes","yes","yes","yes","Adult","2","1","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("7","BIB2015103","","1","","","-3600","-3600","Mr","dnsdnsdm","ndmsnmdn","ndmsndmn","","","No","Male","-3600","45","","","ej@nn.com","0505284060","djw33","yes","ndsmndm","ndsdmnsmdn","ndmsndmd","Upper East","Anguilla","","nsnsn","222","Father","","","1","4","2"," ewehwjhej","hdsjhdj",";dsjkdsdjkd","djskjksdj","2u2i2u2i","3","3","","Gaun","","6","","yes","yes","yes","Nursery/Pre-school","2","2","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("8","BIB2015104","","2","","","-3600","-3600","Miss","dndnnd","nms,ldnmd","sndm","","","","Male","-3600","45","","","","0505284060","38383832","yes","dnsmdnm","sdnsmd","dnsmndmsd","Upper West","Angola","","jsjdj","0","Wife","","","2","3","4"," sjkswej ","hjsehjeh","jdshehj","djskd;skdj","29829829","3","2","DAGAARE / WAALE","Gaun","","7","","yes","yes","","Primary","7","1","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("9","BIB2015105","","1","","","1439848800","23670000","Bishop","Gabriel","Dotcherty","Wallace","","","No","Male","-760237200","69","","","john@ymail.com","0505284060","0243348522","yes","P.O.BOX 232,Ada","P.O.BOX 232,Ada","Sege-Ada","Ashanti","Afghanistan","","GWD Family","291029","Father","","1,2,3","2","5","3","Director    ","G.E.S","Gad","ucc","2030203030","2","2","DAGAARE / WAALE	","Ga-Adangbe","Admins,Leaders,Members","9","","yes","yes","yes","Adult","7","","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("11","BIB2015108","","1","","","","","Mrs","Agnes","Sam","Segua","","","","Female","","","","","cashallsam@gmail.com","243348522","","","","","","","","","","","","","2","","","2","","","","","","1","2","","","","","","","","","","0","","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("12","BIB2015109","","","","","631148400","","Mrs","Godfred","Sam","Namb","","","","Male","","","","","gfsam@gmail.com","505284060","","","","","","","","","","","","","1,2,4","","","3","","","","","","2","1","","","","","","","","","","0","","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("13","BIB2015110","","","","","631148400","","Miss","Juliana","Sam","Maame Esi","","","","Female","3728738738","","","","maamesi@yahoo.com","24593049","","","","","","","","","","","","","","","","4","","","","","","5","2","","","","","","","","","","0","","0000-00-00 00:00:00","0000-00-00 00:00:00"),
("14","BIB2015111","0","3","","","631148400","631148400","Mr","Jay","Jaz","Kofi","","","No","Male","-3600","45","","","","0502038558","098772662","yes","AL close","AP close","Ho","Greater Accra","Ghana","","","0","Father","","Adults","2","3","3"," Lecturer ","WEUC","Japper","Ap close","0993939","4","2","AKAN,Ewe,English","Ewe","Members","","","yes","","","Senior","9","","0000-00-00 00:00:00","0000-00-00 00:00:00");



DROP TABLE IF EXISTS perez_members_auth;

CREATE TABLE `perez_members_auth` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER` varchar(100) DEFAULT NULL,
  `USERNAME` varchar(100) DEFAULT NULL,
  `PASSWORD` varchar(100) DEFAULT NULL,
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO perez_members_auth VALUES("2","BIB2015100","","83df6797","2015-10-06 01:52:46"),
("3","$_POST[member_code]","$_POST[member_username]","$password","2015-10-06 02:08:37"),
("4","BIB2015101","ddndn","d6677369597c55ba812621d9e888cc6e","2015-10-06 02:15:34"),
("5","BIB2015102","","109993f8","2015-11-06 22:46:36"),
("6","BIB2015103","habsh","f0d09a12","2015-10-06 05:16:16"),
("7","BIB2015103","english","aaee8107","2015-10-06 05:19:54"),
("8","BIB2015104","","8af72f35","2015-10-06 05:25:41"),
("9","BIB2015105","","b52b96fd","2015-10-06 21:55:28"),
("10","BIB2015111","","132563be","2015-11-07 10:04:32");



DROP TABLE IF EXISTS perez_menu;

CREATE TABLE `perez_menu` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(900) NOT NULL,
  `link` varchar(900) NOT NULL,
  `icon` varchar(900) NOT NULL,
  `target` varchar(90) NOT NULL,
  `position` int(2) NOT NULL,
  `parentid` int(50) NOT NULL,
  `type` int(11) NOT NULL COMMENT 'whether a module or just a menu',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=895 DEFAULT CHARSET=latin1;

INSERT INTO perez_menu VALUES("1","Administration","","ion ion-document-text","main","0","0","1"),
("2","Group Management","","images/addusers.png","main","1","0","1"),
("3","Services","","","","0","0","0"),
("4","Finance","","","","0","0","0"),
("5","Add New Member","addMember?new=1","images/addusers.png","main","2","1","0"),
("8","System Setup","setup","images/addusers.png","main","0","607","1"),
("11","Add Transactions","add_transactions","","","0","4","0"),
("101","View Members","members","images/addusers.png","main","2","1","1"),
("129","People Flows","flows","","","0","1","0"),
("192","Events Management","","","","0","0","0"),
("204","View Branches","branch","images/addusers.png","main","3","1","0"),
("205","View Groups","group","images/addusers.png","main","4","2","0"),
("213","Team Management","team","","","0","190","0"),
("262","Group Categories","group_category","","203","0","2","0"),
("303","Transactions","transactions_jounal","images/addusers.png","main","3","4","0"),
("304","Charts of Account","chart_account","images/addusers.png","main","4","4","0"),
("306","Pledges","ledger","images/addusers.png","main","6","4","0"),
("501","Accounts","users","images/addusers.png","main","1","606","0"),
("503","View Access Log","system_logs","images/addusers.png","main","3","606","0"),
("504","Logout","logout","images/addusers.png","main","4","606","0"),
("599","Add Service","add_service","","","0","3","0"),
("606","Users","import_finance","","","0","0","0"),
("607","Settings","","","","0","0","0"),
("660","Upcoming Services","due_services","","","0","3","0"),
("661","Past Services","past_services","","","0","3","0"),
("662","Service Categories","service_category","","","0","3","0"),
("663","View Services","view_services","","","0","3","0"),
("664","Service Teams","service_team","","","0","3","0"),
("890","Reports","batch","","","0","4","0"),
("891","Add Service Type","add_service_type","","","0","3","0"),
("892","View Service Types","service_types","","","0","3","0"),
("893","Add member payment","member_payment","","","0","4","0"),
("894","Create Payment Types","create_payment_types","","","0","4","0");



DROP TABLE IF EXISTS perez_ministries;

CREATE TABLE `perez_ministries` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO perez_ministries VALUES("1","Women Ministry"),
("2","Men Ministry"),
("3","Youth Ministry");



DROP TABLE IF EXISTS perez_modules;

CREATE TABLE `perez_modules` (
  `ID` int(20) NOT NULL,
  `USER_ID` int(20) NOT NULL,
  `MODULES` varchar(1000) NOT NULL COMMENT 'Specific areas permission has been granted',
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Handles permission on various system modules';

INSERT INTO perez_modules VALUES("20","13423","80,100,101,102,121,150,204,205,206,301,302,303,304,306,307,123,401,402,151,601,603,501,503,504,1,2,3,4,6,8,231,142,121,141,142,192,1000,1001,606,607,129","2015-10-07 06:06:41");



DROP TABLE IF EXISTS perez_notes;

CREATE TABLE `perez_notes` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NOTE` text,
  `DATE_ADDED` int(11) DEFAULT NULL,
  `NOTE_TYPE` varchar(20) DEFAULT NULL,
  `PERSON` int(11) DEFAULT NULL,
  `CREATED_BILL` int(11) DEFAULT NULL,
  `SCHEDULE_FOR` int(11) DEFAULT NULL,
  `DATED_COMPLETED` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO perez_notes VALUES("1","You\'ll notice that on every page you have a small menu at the top right-hand corner. This menu contains links to the main user and account functions, and is also where you log out.\n\nTo the left is a dark gray menu. This is the main menu and contains links to different features in your account. When you mouse over each item, a popout menu will appear.\n\nOn a lot of pages, you\'ll notice on the top, a \'Filter\' menu, which allows you to filter the results (e.g. filter people).","8219289","privatr","2","8","22282828","22323333");



DROP TABLE IF EXISTS perez_receipt_gen;

CREATE TABLE `perez_receipt_gen` (
  `id` int(11) NOT NULL,
  `no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='generates receipts';

INSERT INTO perez_receipt_gen VALUES("1","100");



DROP TABLE IF EXISTS perez_regions;

CREATE TABLE `perez_regions` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(30) DEFAULT NULL,
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO perez_regions VALUES("1","Greater Accra","2014-01-31 18:29:07"),
("2","Volta ","2014-01-31 18:29:07"),
("3","Ashanti","2014-01-31 18:29:22"),
("4","Upper West","2014-01-31 18:29:22"),
("5","Upper East","2014-01-31 18:29:40"),
("6","Brong Ahafo","2014-01-31 18:29:40"),
("7","Northern","2014-01-31 18:29:56"),
("8","Eastern","2014-01-31 18:29:56"),
("9","Central","2014-01-31 18:30:07"),
("10","Western","2014-01-31 18:30:07");



DROP TABLE IF EXISTS perez_service_type;

CREATE TABLE `perez_service_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CODE` varchar(50) NOT NULL,
  `ADMIN_NAME` varchar(500) DEFAULT NULL,
  `VOLUNTEERS_NAME` varchar(400) DEFAULT NULL,
  `DEFAULT_TIME_NAME` varchar(50) DEFAULT NULL,
  `DEFAULT_TIME_FROM` varchar(50) DEFAULT NULL,
  `DEFAULT_TIME_TO` varchar(50) DEFAULT NULL,
  `OTHER_TIME_NAME` varchar(100) DEFAULT NULL,
  `OTHER_TIME_FROM` varchar(50) DEFAULT NULL,
  `OTHER_TIME_TO` varchar(50) DEFAULT NULL,
  `SERVICE_PLAN_DEPARTMENT` varchar(10) DEFAULT NULL,
  `ACTOR` int(11) NOT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO perez_service_type VALUES("2","ST101","Gaddddddddddddddddddddddddddd","Aggggggggggggggggggggggggggg","nxnn","","","nnxnxnx","11:57 AM","10:55 AM","9]","0","2016-02-29 15:56:40"),
("3","ST102","JKDJKSJDKJ","DJSK","NNN","12:59 AM","11:59 PM","IDNSMND","11:59 PM","11:58 PM","9]","13423","2016-02-29 15:59:35");



DROP TABLE IF EXISTS perez_services;

CREATE TABLE `perez_services` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `SERVICE` varchar(100) DEFAULT NULL,
  `START` varchar(100) NOT NULL,
  `END` varchar(40) NOT NULL,
  `FREQUENCY` varchar(40) NOT NULL,
  `EXPIRE` char(5) NOT NULL,
  `CREATED_AT` varchar(40) NOT NULL,
  `UPDATED_AT` varchar(40) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO perez_services VALUES("1","Celebration Sundays","","","","","",""),
("2","Communion Sundays","","","","","",""),
("3","Missions Sunday","","","","","",""),
("4","Kids Church","","","","","",""),
("6","mmmm","","","","","2016-02-04 22:37:25","2016-02-04 22:37:25"),
("7","mmuu","","","","","2016-02-04 22:37:35","2016-02-04 22:37:35");



DROP TABLE IF EXISTS perez_sms_sent;

CREATE TABLE `perez_sms_sent` (
  `id` int(200) NOT NULL AUTO_INCREMENT,
  `number` varchar(20) NOT NULL,
  `message` varchar(9000) NOT NULL,
  `status` varchar(900) NOT NULL,
  `dates` varchar(900) NOT NULL,
  `type` varchar(200) NOT NULL,
  `name` mediumtext NOT NULL,
  `term` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

INSERT INTO perez_sms_sent VALUES("1","+233505284060","perez is meeting today","Delivered","1444736053","","13423","0",""),
("2","+233505284060","","Not Delivered","1444737937","","13423","0",""),
("3","+233505284060","Here is your member portal login details Username=\',Password=","Not Delivered","1446878795","","13423","0",""),
("4","+2339822345","Here is your member portal login details Username=\',Password=","Not Delivered","1446918837","","13423","0",""),
("5","+233502038558","Here is your member portal login details Username=\',Password=","Delivered","1446919472","","13423","0",""),
("6","+233502038558","","Not Delivered","1446919516","","13423","0",""),
("7","+233502038558","","Not Delivered","1446919798","","13423","0",""),
("8","+233502038558","","Not Delivered","1446920187","","13423","0",""),
("9","+233502038558","","Not Delivered","1446920277","","13423","0",""),
("10","+233505284060","","Not Delivered","1446920334","","13423","0",""),
("11","+233505284060","","Not Delivered","1446920336","","13423","0",""),
("12","+233505284060","","Not Delivered","1446920338","","13423","0",""),
("13","+233505284060","","Not Delivered","1446920349","","13423","0",""),
("14","+23343348522","","Not Delivered","1446920351","","13423","0",""),
("15","+23305284060","","Not Delivered","1446920354","","13423","0",""),
("16","+2334593049","","Not Delivered","1446920358","","13423","0",""),
("17","+233502038558","","Not Delivered","1446920361","","13423","0",""),
("18","+233505284060","","Not Delivered","1446920393","","13423","0",""),
("19","+233505284060","","Not Delivered","1446920394","","13423","0",""),
("20","+233505284060","","Not Delivered","1446920395","","13423","0",""),
("21","+233505284060","","Not Delivered","1446920396","","13423","0",""),
("22","+23343348522","","Not Delivered","1446920397","","13423","0",""),
("23","+23305284060","","Not Delivered","1446920404","","13423","0",""),
("24","+2334593049","","Not Delivered","1446920404","","13423","0",""),
("25","+233502038558","","Not Delivered","1446920405","","13423","0",""),
("26","+233502038558","","Not Delivered","1446920445","","13423","0",""),
("27","+233502038558","xcxcxc","Delivered","1446920506","","13423","0",""),
("28","+233","fdfdfdfdfdfdf","Not Delivered","1446927302","","13423","0",""),
("29","+233","hi","Not Delivered","1446927393","","13423","0",""),
("30","+233502038558","HIsjskjsks","Delivered","1446927454","","13423","0","");



DROP TABLE IF EXISTS perez_system_log;

CREATE TABLE `perez_system_log` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(30) DEFAULT NULL,
  `EVENT_TYPE` varchar(50) DEFAULT NULL,
  `ACTIVITIES` varchar(300) DEFAULT NULL,
  `HOSTNAME` varchar(30) DEFAULT NULL,
  `IP` varchar(20) DEFAULT NULL,
  `BROWSER_VERSION` varchar(80) DEFAULT NULL,
  `MAC_ADDRESS` text NOT NULL,
  `SESSION_ID` text NOT NULL,
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=258 DEFAULT CHARSET=latin1;

INSERT INTO perez_system_log VALUES("1","13423","Logout","agnes has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 03:49:54"),
("2","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 03:55:56"),
("3","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 04:00:09"),
("4","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 04:06:59"),
("5","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 04:10:25"),
("6","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 08:10:22"),
("7","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","d3mricmd1a0ccbjag0vm618b31","2015-09-23 15:00:45"),
("8","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","d3mricmd1a0ccbjag0vm618b31","2015-09-23 15:54:25"),
("9","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","d3mricmd1a0ccbjag0vm618b31","2015-09-23 15:54:34"),
("10","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","d3mricmd1a0ccbjag0vm618b31","2015-09-23 23:23:40"),
("11","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-23 23:25:10"),
("12","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-24 01:15:41"),
("13","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-24 01:53:13"),
("14","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-24 01:55:43"),
("15","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-24 02:17:25"),
("16","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8dp0b91g5alcf38htf3fhg8oa3","2015-09-24 03:07:24"),
("17","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","u8r24tam0apc2asgft84ccud94","2015-09-24 04:04:02"),
("18","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8dp0b91g5alcf38htf3fhg8oa3","2015-09-24 05:58:28"),
("19","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8dp0b91g5alcf38htf3fhg8oa3","2015-09-24 05:58:46"),
("20","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","3lcv4qchph4ablgpdusapn1rp2","2015-09-24 12:01:12"),
("21","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-01 13:26:59"),
("22","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-02 00:02:13"),
("23","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-02 03:07:20"),
("24","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-02 21:25:01"),
("25","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-02 21:25:10"),
("26","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-02 22:18:51"),
("27","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","8348raloagdchuj7spufknj344","2015-10-03 11:51:40"),
("28","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","2riba2uthsip1asocksvssjbm0","2015-10-04 13:15:52"),
("29","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A4-DB-30-DE-1E-7B","2riba2uthsip1asocksvssjbm0","2015-10-04 18:11:20"),
("30","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A4-DB-30-DE-1E-7B","2riba2uthsip1asocksvssjbm0","2015-10-04 19:04:37"),
("31","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","2riba2uthsip1asocksvssjbm0","2015-10-05 02:15:33"),
("32","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","2riba2uthsip1asocksvssjbm0","2015-10-05 02:59:59"),
("33","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","2riba2uthsip1asocksvssjbm0","2015-10-05 04:10:49"),
("34","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-05 07:09:54"),
("35","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-05 12:51:46"),
("36","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-06 00:15:59"),
("37","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-06 04:06:33"),
("38","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-06 21:25:03"),
("39","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-07 02:43:04"),
("40","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-07 05:14:49"),
("41","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-07 15:41:12"),
("42","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","13kkajjm8f7khg6u1dgcsdhfl6","2015-10-08 01:44:06"),
("43","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 14:14:42"),
("44","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 14:52:36"),
("45","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 15:29:20"),
("46","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 15:30:07"),
("47","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 15:30:12"),
("48","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-08 15:30:20"),
("49","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","88c21140snon1lr1v29ok28cn3","2015-10-09 06:20:40"),
("50","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-12 03:40:46"),
("51","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-12 13:04:39"),
("52","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-12 14:17:06"),
("53","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-12 22:20:51"),
("54","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-13 03:34:52"),
("55","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-13 05:53:59"),
("56","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","16-DB-30-DE-1E-7B","eukscsgujhp0s3pl3n4efionp7","2015-10-13 11:04:20"),
("57","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","16-DB-30-DE-1E-7B","eukscsgujhp0s3pl3n4efionp7","2015-10-13 11:04:31"),
("58","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-13 13:25:12"),
("59","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:41.0) Gecko/20100101 Firefox/41.0","A0-1D-48-6E-47-38","eukscsgujhp0s3pl3n4efionp7","2015-10-13 21:53:44"),
("60","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0","A0-1D-48-6E-47-38","kvfimt3v5jb00lfggdd97j44n3","2015-10-27 03:15:08"),
("61","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","m84d8586gvefq810cmo95hv8i0","2015-10-27 18:54:52"),
("62","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","m84d8586gvefq810cmo95hv8i0","2015-10-27 18:55:07"),
("63","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-10-29 20:15:12"),
("64","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-10-31 12:09:57"),
("65","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-10-31 14:09:16"),
("66","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-11-01 04:12:33"),
("67","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-11-01 04:12:53"),
("68","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","vgg0jmorqkuivbis107pamd6n1","2015-11-01 20:32:38"),
("69","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","4pj2udoloq7mhactusnvjb6ep7","2015-11-02 22:37:18"),
("70","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","4pj2udoloq7mhactusnvjb6ep7","2015-11-02 22:37:28"),
("71","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0","A0-1D-48-6E-47-38","g9ii3n745b1d59pg9dqfhp9654","2015-11-02 22:44:41"),
("72","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","4pj2udoloq7mhactusnvjb6ep7","2015-11-03 03:17:18"),
("73","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:36.0) Gecko/20100101 Firefox/36.0","A0-1D-48-6E-47-38","hd3j5fm9gn0jr7r5u67crlqtp6","2015-11-06 09:44:47"),
("74","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-06 10:22:08"),
("75","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-06 13:26:10"),
("76","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-06 22:09:50"),
("77","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-06 22:30:36"),
("78","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 05:28:29"),
("79","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 07:56:16"),
("80","13423","Login","agnes has login into the system  ","192.168.1.5","192.168.1.2","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","qlqjrcj687lh2mtqtl2pa40mn0","2015-11-07 09:45:44"),
("81","13423","Login","agnes has login into the system  ","192.168.1.5","192.168.1.4","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.","A0-1D-48-6E-47-38","monv03t153vtm7uegaea306g32","2015-11-07 09:58:17"),
("82","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 10:24:37"),
("83","13423","Ledger/Account Creation","agnes has Created  Tithes ledger with amount GHC 0","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 10:32:20"),
("84","13423","Login","agnes has login into the system  ","192.168.1.5","192.168.1.4","Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/46.0.","A0-1D-48-6E-47-38","monv03t153vtm7uegaea306g32","2015-11-07 10:48:07"),
("85","13423","Ledger/Account Creation","agnes has Created  BIB2015111 ledger with amount GHC 90","192.168.1.5","192.168.1.2","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","qlqjrcj687lh2mtqtl2pa40mn0","2015-11-07 11:02:38"),
("86","13423","Transaction","agnes has DDD    GHC 222  from  to ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 11:10:26"),
("87","13423","Login","agnes has login into the system  ","192.168.1.5","192.168.1.8","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","ibdupaarp6gjim9hdfp5f9cal3","2015-11-07 11:11:22"),
("88","13423","Transaction","agnes has Import Fixed Assets    GHC 900  from BIB2015111 to Tithes","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","6hv5ava6lbk3ijk3r174sckfm6","2015-11-07 11:18:19"),
("89","13423","Transaction","agnes has Tithe Payment    GHC 100  from Tithes to BIB2015111","192.168.1.5","192.168.1.8","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","ibdupaarp6gjim9hdfp5f9cal3","2015-11-07 12:43:28"),
("90","13423","Transaction","agnes has Tithe Payment    GHC 600  from  to ","192.168.1.5","192.168.1.8","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","ibdupaarp6gjim9hdfp5f9cal3","2015-11-07 12:45:06"),
("91","13423","Login","agnes has login into the system  ","192.168.1.5","192.168.1.8","Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrom","A0-1D-48-6E-47-38","ibdupaarp6gjim9hdfp5f9cal3","2015-11-07 13:03:46"),
("92","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:40.0) Gecko/20100101 Firefox/40.0","A0-1D-48-6E-47-38","nlq0t8pg38mj0298a29ko1ivu5","2015-11-23 12:53:45"),
("93","1","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","pdsfbqte39finv7cj3844vak31","2015-11-25 08:52:38"),
("94","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","pdsfbqte39finv7cj3844vak31","2015-11-25 08:52:44"),
("95","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","A0-1D-48-6E-47-38","pdsfbqte39finv7cj3844vak31","2015-11-25 08:52:48"),
("96","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","96d1gaqo146n7vhroshonlf050","2016-01-02 09:59:34"),
("97","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:43.0) Gecko/20100101 Firefox/43.0","A0-1D-48-6E-47-38","96d1gaqo146n7vhroshonlf050","2016-01-02 09:59:45"),
("98","","Logout"," has logout   from the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0","","59cqe9idckht3qglq4j55e7qp7","2016-01-19 00:56:49"),
("99","","Logout"," has logout   from the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0","","59cqe9idckht3qglq4j55e7qp7","2016-01-19 00:57:10"),
("100","13416","Login","sirgas has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0","","59cqe9idckht3qglq4j55e7qp7","2016-01-19 00:57:37"),
("101","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:39.0) Gecko/20100101 Firefox/39.0","","59cqe9idckht3qglq4j55e7qp7","2016-01-19 00:59:26"),
("102","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","veb16sil1vebd6j3h02tnmjrt4","2016-02-01 13:17:13"),
("103","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","veb16sil1vebd6j3h02tnmjrt4","2016-02-01 14:16:12"),
("104","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","veb16sil1vebd6j3h02tnmjrt4","2016-02-01 15:43:48"),
("105","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","veb16sil1vebd6j3h02tnmjrt4","2016-02-01 18:53:24"),
("106","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","veb16sil1vebd6j3h02tnmjrt4","2016-02-02 00:06:17"),
("107","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","5eimb2beh6nu0n0g8cu82okem2","2016-02-10 15:17:22"),
("108","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","5eimb2beh6nu0n0g8cu82okem2","2016-02-10 23:25:12"),
("109","13423","Login","agnes has login into the system  ","localhost","127.0.0.1","Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:44.0) Gecko/20100101 Firefox/44.0","","5eimb2beh6nu0n0g8cu82okem2","2016-02-11 03:34:51"),
("110","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","raoa8f1vp7vte1dalsp9het2h6","2016-02-14 18:22:48"),
("111","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","g2r626mr5bllmd2ecssbvhim55","2016-02-15 12:53:21"),
("112","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","g2r626mr5bllmd2ecssbvhim55","2016-02-15 12:53:27"),
("113","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","f43ifuasgevdo9bltmoj6j0751","2016-02-22 12:44:52"),
("114","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","ou7nd925ipialk4g3c2vtrsp02","2016-02-24 04:54:27"),
("115","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","au2ijej919c603afj3s3ncmu25","2016-02-25 09:47:02"),
("116","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8s8kv7l3tkr01k5t5jth2fd862","2016-02-29 10:37:46"),
("117","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8s8kv7l3tkr01k5t5jth2fd862","2016-02-29 13:15:47"),
("118","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","gmhc5mm1lnhsn2moof391lfn36","2016-03-15 13:47:15"),
("119","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","349l6cc7q8udtmm9cttfk6obs6","2016-03-23 15:13:19"),
("120","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","349l6cc7q8udtmm9cttfk6obs6","2016-03-23 16:06:11"),
("121","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:25:17"),
("122","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:42:25"),
("123","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:43:17"),
("124","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:43:22"),
("125","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:43:22"),
("126","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:43:27"),
("127","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:43:54"),
("128","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:46:05"),
("129","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:47:09"),
("130","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:56:46"),
("131","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 00:58:01"),
("132","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","8qq1a9veboqr3b1rio0ru9apv5","2016-03-24 01:36:11"),
("133","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","j2i120b44b4m9h7jdalv5teot6","2016-03-24 01:44:53"),
("134","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","j2i120b44b4m9h7jdalv5teot6","2016-03-24 01:45:00"),
("135","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","j2i120b44b4m9h7jdalv5teot6","2016-03-24 04:26:06"),
("136","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","j2i120b44b4m9h7jdalv5teot6","2016-03-24 04:26:12"),
("137","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","j2i120b44b4m9h7jdalv5teot6","2016-03-24 06:05:16"),
("138","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","c25r1rqq1g3ijr1vnk762fhs05","2016-03-24 18:40:58"),
("139","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","c25r1rqq1g3ijr1vnk762fhs05","2016-03-24 18:50:24"),
("140","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","c25r1rqq1g3ijr1vnk762fhs05","2016-03-24 18:50:29"),
("141","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","9iff3dg8r8f7coe5odvo4v4nq0","2016-03-26 05:45:42"),
("142","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","9iff3dg8r8f7coe5odvo4v4nq0","2016-03-26 05:50:08"),
("143","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","9iff3dg8r8f7coe5odvo4v4nq0","2016-03-26 05:50:43"),
("144","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","9iff3dg8r8f7coe5odvo4v4nq0","2016-03-26 08:59:40"),
("145","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","bfih6n60jmqbpjolu6q30tjfl0","2016-03-26 12:29:12"),
("146","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","bfih6n60jmqbpjolu6q30tjfl0","2016-03-26 19:12:25"),
("147","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","bfih6n60jmqbpjolu6q30tjfl0","2016-03-26 20:24:12"),
("148","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (X11; Linux x86_64; rv:43.0) Gecko/20100101 Firefox/43.0","","bfih6n60jmqbpjolu6q30tjfl0","2016-03-27 12:15:55"),
("149","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 6.3; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0","16-DB-30-DE-1E-7B","taactkgfuidt48soj5r7gfa3j4","2016-04-11 20:48:57"),
("150","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 6.3; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0","16-DB-30-DE-1E-7B","taactkgfuidt48soj5r7gfa3j4","2016-04-11 20:49:04"),
("151","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 6.3; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0","16-DB-30-DE-1E-7B","taactkgfuidt48soj5r7gfa3j4","2016-04-11 20:49:13"),
("152","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 6.3; WOW64; rv:45.0) Gecko/20100101 Firefox/45.0","16-DB-30-DE-1E-7B","taactkgfuidt48soj5r7gfa3j4","2016-04-11 21:58:15"),
("153","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","j2so235oc2hk1rp7juvi34dqj2","2016-04-15 20:25:05"),
("154","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","j2so235oc2hk1rp7juvi34dqj2","2016-04-15 20:25:14"),
("155","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","j2so235oc2hk1rp7juvi34dqj2","2016-04-16 07:58:48"),
("156","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)","5C-B9-01-B4-00-BD","747cs4n4s7890uv3vvrg85the2","2016-04-16 08:36:35"),
("157","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","9gs6hklfqckuq5oc72g7ul5gl7","2016-04-17 22:47:03"),
("158","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","up9608tdrth1bgfsm3ameq4jp2","2016-04-18 17:11:08"),
("159","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","up9608tdrth1bgfsm3ameq4jp2","2016-04-18 20:59:29"),
("160","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","up9608tdrth1bgfsm3ameq4jp2","2016-04-18 22:55:42"),
("161","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","up9608tdrth1bgfsm3ameq4jp2","2016-04-19 08:07:44"),
("162","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","up9608tdrth1bgfsm3ameq4jp2","2016-04-19 08:10:43"),
("163","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","l4p3g9smsek076b60f8bii5413","2016-04-22 09:59:38"),
("164","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","l4p3g9smsek076b60f8bii5413","2016-04-22 10:09:33"),
("165","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","72-77-81-0B-62-B0","l4p3g9smsek076b60f8bii5413","2016-04-22 13:28:05"),
("166","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","72-77-81-0B-62-B0","l4p3g9smsek076b60f8bii5413","2016-04-22 15:13:39"),
("167","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 12:19:45"),
("168","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 12:20:01"),
("169","\".$_SESSION[ID].\"","$event","$activity","\".$hashkey.\"","\".$remoteip.\"","\".$useragent.\"","\".$mac.\"","\".$sessionId.\"","2016-04-30 13:29:32"),
("170","13423","Payments","agnes has received GHC from ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:30:08"),
("171","13423","Payments","agnes has received GHC90 from 14","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:34:31"),
("172","13423","Payments","agnes has received GHC90 from 14","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:35:16"),
("173","13423","Payments","agnes has received GHC7888 from 14","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:37:54"),
("174","13423","Payments","agnes has received GHC78 from 14","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:37:54"),
("175","13423","Payments","agnes has received GHC677 from 14","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:40:34"),
("176","13423","Payments","agnes has received GHC90 from Mr Jay Jaz Kofi","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-04-30 13:41:35"),
("177","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-01 05:05:55"),
("178","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-01 16:41:13"),
("179","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-01 20:37:13"),
("180","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-02 08:00:18"),
("181","13423","Payments","agnes has received GHC8999 from Mrs Gad Ocansey Kartey","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-02 08:50:47"),
("182","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-02 09:28:23"),
("183","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","0h4lgdiu8cuuv3kq7g4cubfli1","2016-05-02 13:04:51"),
("184","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","o1leuvvc4ve38n434abdv44273","2016-05-03 07:58:53"),
("185","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","5C-B9-01-B4-00-BD","ugdqq22su4g5b222p8csq2vvh0","2016-05-03 08:12:17"),
("186","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","5C-B9-01-B4-00-BD","ugdqq22su4g5b222p8csq2vvh0","2016-05-03 09:03:03"),
("187","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chro","5C-B9-01-B4-00-BD","ugdqq22su4g5b222p8csq2vvh0","2016-05-03 13:36:06"),
("188","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","emklhs2br6e2nujodfi0u3m952","2016-05-03 13:49:31"),
("189","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","1p7or5ks1hrgavqcbq5rgvbe76","2016-05-03 16:30:19"),
("190","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","1p7or5ks1hrgavqcbq5rgvbe76","2016-05-04 07:32:47"),
("191","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","j0s54re7ucgsrn6tn7bth9t5b0","2016-05-11 06:35:36"),
("192","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:35.0) Gecko/20100101 Firefox/35.0","5C-B9-01-B4-00-BD","iq84q2di34lbi1cu1otn6g1mk7","2016-05-17 20:20:47"),
("193","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-19 17:53:06"),
("194","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-19 17:53:26"),
("195","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 11:43:35"),
("196","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 11:43:52"),
("197","13423","Deletes","agnes has delete No parent department department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 13:32:50"),
("198","13423","Deletes","agnes has delete No parent department department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 13:35:13"),
("199","13423","Deletes","agnes has delete No parent department department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 13:37:06"),
("200","13423","Deletes","agnes has delete No parent department department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 13:48:32"),
("201","13423","Creation","agnes has added Aged demographics","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 13:55:29"),
("202","13423","Deletes","agnes has delete 5 demography","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 14:01:38"),
("203","13423","Creation","agnes has updated Acoustic Guiternmnmnmnmnm department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 14:09:08"),
("204","\".$_SESSION[ID].\"","$event","$activity","\".$hashkey.\"","\".$remoteip.\"","\".$useragent.\"","\".$mac.\"","\".$sessionId.\"","2016-05-21 14:11:09"),
("205","13423","Creation","agnes has updated Cameramnmnm department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 14:11:55"),
("206","13423","Creation","agnes has updated Acoustic Guiternmnmm department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 14:14:35"),
("207","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:15:42"),
("208","13423","Creation","agnes has added Adultsmmmmmmmm demographics","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:21:49"),
("209","13423","Creation","agnes has added Youlthmmmmmmmmmmmmm demographics","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:23:56"),
("210","13423","Creation","agnes has updated Youlthmmmmm demography","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:25:50"),
("211","13423","Creation","agnes has updated Youlth demography","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:26:42"),
("212","13423","Creation","agnes has added gad demographics","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:27:20"),
("213","13423","Creation","agnes has added ghghghghgh demographics","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:30:10"),
("214","13423","Creation","agnes has updated Acoustic Guiternmnmm demography","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:30:37"),
("215","13423","Deletes","agnes has delete 6 demography","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:30:48"),
("216","13423","Creation","agnes has added DDFFDDFF category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:42:11"),
("217","13423","Creation","agnes has updated Church Membersssssssssssssssssss category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 15:51:33"),
("218","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 16:47:21"),
("219","13423","Creation","agnes has updated Church Membersssssssssssssssssss category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 16:50:19"),
("220","13423","Deletes","agnes has delete  category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 16:50:30"),
("221","13423","Deletes","agnes has delete  category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 16:51:17"),
("222","13423","Deletes","agnes has delete  category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-21 16:53:34"),
("223","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 05:38:43"),
("224","","Logout"," has logout   from the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 05:39:46"),
("225","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 05:40:09"),
("226","13423","Creation","agnes has added Sege District district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 06:06:18"),
("227","13423","Creation","agnes has added Ada West district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 06:12:26"),
("228","13423","Creation","agnes has updated Ada Westnnn district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 06:17:31"),
("229","13423","Creation","agnes has updated Sege District district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 06:17:48"),
("230","13423","Creation","agnes has updated Ada West district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","v6b7pfadn7us9j3880qiuctec1","2016-05-22 06:18:02"),
("231","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","mupp41a1aimh7kdblqlrcn8742","2016-05-28 23:40:21"),
("232","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:46.0) Gecko/20100101 Firefox/46.0","5C-B9-01-B4-00-BD","4foupr348c09b2ral585p0qrd5","2016-05-31 13:44:33"),
("233","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 16:50:06"),
("234","13423","Creation","agnes has added iuiuiuiuiu department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:10:47"),
("235","13423","Creation","agnes has added nnnnn department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:10:53"),
("236","13423","Creation","agnes has added nnnnn department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:11:47"),
("237","13423","Creation","agnes has added nb b bn nb nb department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:11:54"),
("238","13423","Creation","agnes has added nmnb department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:12:43"),
("239","13423","Creation","agnes has updated Acoustic Guiternmnmm department","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:27:28"),
("240","13423","Creation","admin has added nbj category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:46:50"),
("241","13423","Deletes","admin has delete  category","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:46:58"),
("242","13423","Creation","admin has added kjjj district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 17:47:56"),
("243","13423","Payments","admin has received GHC998 from Mrs Gad Ocansey Kartey","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 18:09:10"),
("244","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-11 23:54:40"),
("245","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-12 13:23:45"),
("246","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-13 20:23:41"),
("247","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-13 21:35:53"),
("248","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-13 23:59:21"),
("249","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","39760jhucer2bkru5makl36836","2016-07-14 10:10:20"),
("250","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","32jt52f35on8mk4qgv77p8sm70","2016-07-18 20:48:58"),
("251","13423","Creation","agnes has added dsdsdsd district","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","32jt52f35on8mk4qgv77p8sm70","2016-07-18 20:54:22"),
("252","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","32jt52f35on8mk4qgv77p8sm70","2016-07-18 22:20:09"),
("253","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","5C-B9-01-B4-00-BD","32jt52f35on8mk4qgv77p8sm70","2016-07-19 07:13:08"),
("254","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","72-77-81-0B-62-B0","32jt52f35on8mk4qgv77p8sm70","2016-07-19 12:17:53"),
("255","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","72-77-81-0B-62-B0","32jt52f35on8mk4qgv77p8sm70","2016-07-19 12:19:47"),
("256","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","72-77-81-0B-62-B0","32jt52f35on8mk4qgv77p8sm70","2016-07-19 12:20:26"),
("257","13423","Login","agnes has login into the system  ","localhost","::1","Mozilla/5.0 (Windows NT 10.0; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0","72-77-81-0B-62-B0","32jt52f35on8mk4qgv77p8sm70","2016-07-19 12:43:49");



DROP TABLE IF EXISTS perez_team;

CREATE TABLE `perez_team` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(100) DEFAULT NULL,
  `LEADER` varchar(100) DEFAULT NULL,
  `PURPOSE` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO perez_team VALUES("1","Singing Band","2","Lean new songs"),
("2","Chorography","3","Learn more dance"),
("3","Instrumentalists","5","Rehearse latest rocks"),
("4","Choiristers","19","Sing hymns");



DROP TABLE IF EXISTS perez_workers;

CREATE TABLE `perez_workers` (
  `ids` int(11) NOT NULL AUTO_INCREMENT,
  `emp_number` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `surname` varchar(200) NOT NULL,
  `designation` varchar(200) NOT NULL,
  `position` varchar(50) NOT NULL,
  `grade` varchar(200) NOT NULL,
  `ssnit` varchar(40) NOT NULL,
  `placeofresidence` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` text NOT NULL,
  `dob` varchar(20) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `marital` varchar(15) NOT NULL,
  `education` varchar(100) NOT NULL,
  `hometown` varchar(100) NOT NULL,
  `mother` varchar(100) NOT NULL,
  `father` varchar(100) NOT NULL,
  `dependentsNo` varchar(5) NOT NULL,
  `salary` decimal(20,2) NOT NULL,
  `dateHired` varchar(20) NOT NULL,
  `leaves` varchar(20) NOT NULL,
  `empStatus` varchar(50) NOT NULL,
  `title` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `teaches` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `INPUTEDDATE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ids`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE IF EXISTS tasks;

CREATE TABLE `tasks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `tasks_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO tasks VALUES("1","1","Gad","2016-01-17 18:06:49","2016-01-17 18:06:49"),
("2","1","dkdkkd","2016-01-17 18:06:54","2016-01-17 18:06:54");



DROP TABLE IF EXISTS tbl_accounts;

CREATE TABLE `tbl_accounts` (
  `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `ACCOUNT_NAME` varchar(400) DEFAULT NULL,
  `PARENT_ACCOUNT` int(11) NOT NULL COMMENT 'Represent the parent account table',
  `ACCOUNT_DESCRIPTION` varchar(200) NOT NULL,
  `AFFECTS` varchar(50) DEFAULT NULL COMMENT 'Yes means affect profit , No means it affects balance sheet',
  `ACCOUNT_BALANCE` double NOT NULL DEFAULT '0',
  `ACCOUNT_CODE` varchar(11) NOT NULL,
  `BALANCE_TYPE` varchar(20) NOT NULL,
  `BANK_ACCOUNT_NUM` int(11) NOT NULL,
  `ACTION` int(11) NOT NULL COMMENT '1 means deleted',
  `TRANSFERED` int(11) DEFAULT NULL,
  `PERIOD` varchar(50) DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  `STATUS` varchar(100) NOT NULL DEFAULT 'Enabled',
  PRIMARY KEY (`ACCOUNT_ID`,`ACCOUNT_CODE`),
  UNIQUE KEY `ACCOUNT_CODE` (`ACCOUNT_CODE`),
  UNIQUE KEY `ACCOUNT_NAME` (`ACCOUNT_NAME`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tbl_accounts VALUES("1","Tithes","22","nbbb","Income and Expenditure,Receipts and Payments","0","104","Credit","0","0","","30/11/2015","","0"),
("2","BIB2015111","2","","Balance Sheet,Receipts and Payments","90","105","Debit","0","0","","30/11/2015","","0");



DROP TABLE IF EXISTS tbl_accountsection;

CREATE TABLE `tbl_accountsection` (
  `sectionid` int(11) NOT NULL DEFAULT '0',
  `sectionname` text NOT NULL,
  PRIMARY KEY (`sectionid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_accountsection VALUES("1","Income"),
("2","Cost Of Sales"),
("5","Overheads"),
("10","Asset"),
("15","Inventory"),
("20","Liability"),
("25","Capital"),
("30","Drawing");



DROP TABLE IF EXISTS tbl_balances;

CREATE TABLE `tbl_balances` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `REPORT` varchar(100) DEFAULT NULL,
  `START` date DEFAULT NULL,
  `END` date DEFAULT NULL,
  `PERIOD` date DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PERIOD` (`PERIOD`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tbl_balances VALUES("1","Balance b/d Income and Expenditure","0000-00-00","0000-00-00","2015-01-31","","2850"),
("2","Balance b/d Income and Expenditure","0000-00-00","0000-00-00","2015-10-31","","2210"),
("3","Balance b/d Income and Expenditure","0000-00-00","0000-00-00","0000-00-00","","0");



DROP TABLE IF EXISTS tbl_bank_account;

CREATE TABLE `tbl_bank_account` (
  `BANK_ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `BANK_ACCOUNT_NAME` varchar(100) DEFAULT NULL,
  `BANK_ACCOUNT_NUMBER` int(20) DEFAULT NULL,
  `BANK_ACCOUNT_OPENING_BALANCE` double DEFAULT NULL,
  `BANK_ACCOUNT_OPENING_BALANCE_DATE` date DEFAULT NULL,
  `BANK_ACCOUNT_DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`BANK_ACCOUNT_ID`),
  UNIQUE KEY `BANK_ACCOUNT_NAME` (`BANK_ACCOUNT_NAME`),
  UNIQUE KEY `BANK_ACCOUNT_NUMBER` (`BANK_ACCOUNT_NUMBER`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbl_bank_account VALUES("1","Barclays","9029200","9000","2015-01-21","2015-01-21 02:08:43");



DROP TABLE IF EXISTS tbl_cashbook;

CREATE TABLE `tbl_cashbook` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` varchar(100) NOT NULL,
  `REFERENCE_NO` varchar(20) NOT NULL,
  `CASHBOOK_TYPE` int(11) NOT NULL COMMENT 'represents various bankbooks',
  `PAYEE` int(11) DEFAULT NULL COMMENT 'Represent who paid the money or from which account',
  `PAYMENT_TYPE` int(11) DEFAULT NULL,
  `MEMO` varchar(500) NOT NULL,
  `CHEQUE` int(11) NOT NULL,
  `DEBIT` double DEFAULT NULL,
  `CREDIT` double DEFAULT NULL,
  `TAG` int(11) NOT NULL,
  `RUNNING_BALANCE` double DEFAULT NULL,
  `TRANSACTION_ID` int(11) NOT NULL,
  `TRANSACTION_TYPE` int(11) NOT NULL,
  `SOURCE_ID` varchar(18) NOT NULL,
  `PERIOD` varchar(20) DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  `ACTOR` int(1) DEFAULT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `MEMO` (`MEMO`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

INSERT INTO tbl_cashbook VALUES("2","2015-01-12","3333","0","1","3","sasasas","3333333","8900","","1","","330","19","CHB7041","","","1","2015-01-21 02:18:55"),
("3","2015-01-20","3333","2","1","3","dsdsdsd","3333","4444","","1","","331","19","CHB7042","","","1","2015-01-21 02:21:55"),
("4","2015-01-08","998888","2","1","3","payments","56565656","8000","","1","","332","19","CHB7043","","","1","2015-01-21 04:35:17"),
("11","2015-01-22","3333","0","1","3","Payments of fees","3333","900","","1","","329","19","CHB7040","","","1","2015-06-29 09:13:56"),
("12","1435536000","CMYXHW9VF3","6","1","2","gad","97978998","8900","","1","","371","21","CHB7061","","","1","2015-06-29 09:14:30"),
("13","1435536000","WNPH19O3RV","6","1","2","gadjj","97978998","8900","","1","","371","21","CHB7061","","","1","2015-06-29 09:21:05"),
("16","1435536000","2QB5O7CZM3","6","1","2","jjjj","9890","9090","","1","","372","21","CHB7062","","","1","2015-06-29 09:26:30"),
("20","1435190400","DUOSB6MP2W","6","1","3","kkkk","89898989","7000","","1","","376","21","CHB7066","","","1","2015-06-29 09:42:22"),
("21","1435622400","TNFM5HIKL8","2","6","1","sdsdsd","32323234","2122","","1","","379","54","CHB7067","","","1","2015-06-29 13:43:07"),
("22","1435622400","WE1IYJFGON","2","1","3","Payment of tithes<br>","8900","7688","","1","","380","21","CHB7068","","","1","2015-06-29 22:23:17"),
("23","","QV81J2K4LP","2","1","2","paid tithes<br>","7878787","8900","","1","","382","21","CHB7069","","","1","2015-06-29 22:34:50"),
("24","2015-10-01","RAG4MB16SN","4","15","1","nnn","1128299292","900","","1","","436","10","CHB7070","","","1","2015-10-29 12:50:49");



DROP TABLE IF EXISTS tbl_depreciation_calculation;

CREATE TABLE `tbl_depreciation_calculation` (
  `ID` int(11) NOT NULL,
  `ASSET` int(11) DEFAULT NULL,
  `METHOD` int(11) DEFAULT NULL,
  `CALCULATION` double DEFAULT NULL,
  `PERIOD` date DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ASSET` (`ASSET`,`PERIOD`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_depreciation_calculation VALUES("1","2","2","500","2015-01-31",""),
("2","3","2","2000","2015-01-31",""),
("3","4","2","400","2015-01-31",""),
("4","7","2","11040","2015-01-31",""),
("5","8","2","320","2015-01-31","");



DROP TABLE IF EXISTS tbl_depreciation_method;

CREATE TABLE `tbl_depreciation_method` (
  `ID` int(11) NOT NULL,
  `DEPRECIATION_METHOD` varchar(200) DEFAULT NULL,
  `DEPRECIATION_RATE` double DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_depreciation_method VALUES("1","Straight Line","1.3"),
("2","Reducing Balance","0.9");



DROP TABLE IF EXISTS tbl_fixed_assets_manager;

CREATE TABLE `tbl_fixed_assets_manager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `FIXED_ASSET_CODE` varchar(100) DEFAULT NULL,
  `FIXED_ASSET_NAME` varchar(100) NOT NULL,
  `FIXED_ASSET_CATEGORY` varchar(100) DEFAULT NULL,
  `FIXED_ASSET_LOCATION` varchar(200) DEFAULT NULL COMMENT 'represent departments',
  `FIXED_ASSET_DESCRIPTION` text,
  `FIXED_ASSET_COST` text COMMENT 'represent general ledger account',
  `FIXED_ASSET_SERIAL_NUMBER` text,
  `FIXED_ASSETS_DATE_PURCHASE` varchar(100) NOT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `FIXED_ASSET_CODE` (`FIXED_ASSET_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO tbl_fixed_assets_manager VALUES("10","100","Keyboard","Electronics","30","38383838","400","38383838","07/28/2016","2016-07-13 23:08:15");



DROP TABLE IF EXISTS tbl_general_ledger;

CREATE TABLE `tbl_general_ledger` (
  `GENERAL_LEDGER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `GENERAL_LEDGER_DESC` varchar(100) NOT NULL,
  `GENERAL_LEDGER_DATE` date DEFAULT NULL,
  `ACCOUNT_ID` int(11) DEFAULT NULL COMMENT 'represent table accounts',
  `GENERAL_LEDGER_DEBIT` double DEFAULT NULL,
  `GENERAL_LEDGER_CREDIT` double DEFAULT NULL,
  `GENERAL_LEDGER_TAG` text,
  `GENERAL_LEDGER_MEMO` varchar(200) NOT NULL COMMENT 'represent memo table',
  `ACTION` int(11) NOT NULL COMMENT '1 means deleted',
  `TRANSFERED` int(11) NOT NULL DEFAULT '0' COMMENT '1 means transfered to general ledger, 0 means not transfered',
  `PERIOD` varchar(50) DEFAULT NULL,
  `YEAR` varchar(20) DEFAULT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`GENERAL_LEDGER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tbl_general_ledger VALUES("1","Opening Balances","","1","900","","","","1","1","31/10/2015","","2015-10-31 12:09:04"),
("2","Opening Balances","","2","90","","","","0","0","31/10/2015","","2015-10-31 17:43:00"),
("3","Opening Balances","","1","","0","","","0","0","30/11/2015","","2015-11-07 10:32:19"),
("4","Opening Balances","","2","90","","","","0","0","30/11/2015","","2015-11-07 11:02:38");



DROP TABLE IF EXISTS tbl_general_ledger_tag;

CREATE TABLE `tbl_general_ledger_tag` (
  `ID` int(11) NOT NULL,
  `TAG` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_general_ledger_tag VALUES("1","Administration"),
("2","Marketing"),
("3","Transport"),
("4","Overhead Expenses");



DROP TABLE IF EXISTS tbl_general_ledger_transactions;

CREATE TABLE `tbl_general_ledger_transactions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `CHEQUE_NUMBER` int(11) DEFAULT NULL,
  `TRANS_DATE` varchar(100) DEFAULT NULL,
  `PERIOD` date DEFAULT NULL,
  `ACCOUNT` int(11) DEFAULT NULL,
  `NARRATIVE` varchar(300) DEFAULT NULL,
  `DEBIT` double DEFAULT '0',
  `CREDIT` double DEFAULT '0',
  `TAG` int(11) DEFAULT NULL,
  `TRANSACTION_ID` varchar(11) NOT NULL,
  `TRANSACTION_TYPE` varchar(40) NOT NULL,
  `YEAR` varchar(40) DEFAULT NULL,
  `DATE_MODIFIED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ACTOR` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tbl_general_ledger_transactions VALUES("1","0","07/11/2015","0000-00-00","0","DDD","222","0","1","100","0","","2015-11-07 11:10:26","13423"),
("2","0","07/11/2015","0000-00-00","0","DDD","0","222","1","100","0","","2015-11-07 11:10:26","13423"),
("3","0","07/11/2015","0000-00-00","1","nnn","900","0","1","101","0","","2015-11-07 11:18:19","13423"),
("4","0","07/11/2015","0000-00-00","2","nnn","0","900","1","101","0","","2015-11-07 11:18:19","13423"),
("5","0","07/11/2015","0000-00-00","2","","100","0","1","102","Tithe Payment","","2015-11-07 12:43:27","13423"),
("6","0","07/11/2015","0000-00-00","1","","0","100","1","102","Tithe Payment","","2015-11-07 12:43:27","13423"),
("7","0","07/11/2015","0000-00-00","0","","600","0","0","103","Tithe Payment","","2015-11-07 12:45:06","13423"),
("8","0","07/11/2015","0000-00-00","0","","0","600","0","103","Tithe Payment","","2015-11-07 12:45:06","13423");



DROP TABLE IF EXISTS tbl_parent_account;

CREATE TABLE `tbl_parent_account` (
  `PARENT_ACCOUNT_ID` int(11) NOT NULL,
  `PARENT_NAME` text,
  `TYPE` varchar(20) NOT NULL COMMENT '1 means assets,2 means liability,3 means capital, 4 means drawings,5 means income,6 means affect assets',
  `BAL_SHEET/P&L` varchar(100) NOT NULL,
  PRIMARY KEY (`PARENT_ACCOUNT_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO tbl_parent_account VALUES("2","Current Asset","10","Balance Sheet"),
("3","Current Liability","20","Balance Sheet"),
("4","Long Term Liability","20","Balance Sheet"),
("7","Accounts Receivable","","Balance Sheet"),
("8","Accounts Payable","","Balance Sheet"),
("9","Fixed Asset","","Balance Sheet"),
("13","Revenue","","Profit And Loss"),
("14","Operating Expenses","","Profit And Loss"),
("15","Bank","","Profit And Loss"),
("17","Financed By","","Balance Sheet"),
("18","Income Tax","","Profit And Loss"),
("19","Creditor","","Balance Sheet"),
("20","Debtor","","Balance Sheet"),
("21","Provisions","6","Balance Sheet"),
("22","Income","",""),
("23","Expenditure","","");



DROP TABLE IF EXISTS tbl_transaction_type;

CREATE TABLE `tbl_transaction_type` (
  `typeid` int(11) NOT NULL,
  `typename` char(50) NOT NULL DEFAULT '',
  `typeno` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`typeid`),
  KEY `TypeNo` (`typeno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO tbl_transaction_type VALUES("1","Tithe Payment","7"),
("2","First fruit offering","0"),
("3","Standing Journal","0"),
("10","Sales Invoice","2"),
("11","Credit Note","0"),
("15","Journal - Debtors","0"),
("16","Location Transfer","27"),
("17","Stock Adjustment","28"),
("18","Purchase Order","38"),
("19","Fees Payment","0"),
("20","Purchase Invoice","45"),
("21","Bank Deposits","8"),
("22","Creditors Payment","11"),
("23","Creditors Journal","0"),
("25","Purchase Order Delivery","58"),
("26","Work Order Receipt","8"),
("28","Work Order Issue","17"),
("29","Work Order Variance","1"),
("30","Sales Order","7"),
("31","Shipment Close","28"),
("32","Contract Close","6"),
("35","Cost Update","26"),
("36","Exchange Difference","1"),
("37","Tenders","0"),
("38","Stock Requests","2"),
("40","Ledgers Update","32"),
("41","Asset Addition","1"),
("42","Asset Category Change","1"),
("43","Ledger Creation","1"),
("44","Depreciation","2"),
("49","Import Fixed Assets","1"),
("50","Opening Balance","0"),
("53","Transfer","53"),
("54","Contra Entry","54"),
("500","Auto Debtor Number","17"),
("501","System Access","1");



DROP TABLE IF EXISTS uploads;

CREATE TABLE `uploads` (
  `id` bigint(200) NOT NULL AUTO_INCREMENT,
  `filename` varchar(200) COLLATE utf8_bin NOT NULL,
  `filetype` varchar(200) COLLATE utf8_bin NOT NULL,
  `inserted_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

INSERT INTO uploads VALUES("3","WvIoMP__members.csv","text/comma-separated-values","2015-11-20 11:30:06","2015-11-20 11:30:06"),
("4","RUtVOf__gaua_list.csv","text/comma-separated-values","2015-11-20 11:58:19","2015-11-20 11:58:19"),
("5","FDU3gy__gaua_list.csv","text/comma-separated-values","2015-11-20 11:58:36","2015-11-20 11:58:36"),
("6","RkyXDO__gaua_list.csv","text/comma-separated-values","2015-11-20 11:59:10","2015-11-20 11:59:10"),
("7","Do7p0R__medical_school_list-1.csv","text/comma-separated-values","2015-11-20 12:07:31","2015-11-20 12:07:31"),
("8","l2qYeM__medical_school_list-2.csv","text/comma-separated-values","2015-11-20 12:20:37","2015-11-20 12:20:37"),
("9","vhvEYJ__school_full_list.csv","text/comma-separated-values","2015-11-20 13:30:21","2015-11-20 13:30:21"),
("10","k4Azzm__school_full_list.csv","text/comma-separated-values","2015-11-20 13:31:06","2015-11-20 13:31:06"),
("11","D1x1sE__school_full_list.csv","text/comma-separated-values","2015-11-20 13:41:40","2015-11-20 13:41:40"),
("12","ym2ykg__school_full_list.csv","text/comma-separated-values","2015-11-20 13:41:51","2015-11-20 13:41:51"),
("13","I8yv9T__school_full_list.csv","text/comma-separated-values","2015-11-20 13:42:44","2015-11-20 13:42:44"),
("14","Xz4f1q__school_full_list.csv","text/comma-separated-values","2015-11-20 13:47:31","2015-11-20 13:47:31"),
("15","JQ2IE9__school_full_list.csv","text/comma-separated-values","2015-11-20 13:57:49","2015-11-20 13:57:49"),
("16","UOy1mU__school_full_list.csv","text/comma-separated-values","2015-11-20 13:58:23","2015-11-20 13:58:23"),
("17","tDQNNG__school_full_list.csv","text/comma-separated-values","2015-11-20 13:59:45","2015-11-20 13:59:45"),
("18","NF2TKX__school_full_list.csv","text/comma-separated-values","2015-11-20 14:00:42","2015-11-20 14:00:42"),
("19","CqeA4J__school_full_list.csv","text/comma-separated-values","2015-11-20 14:01:11","2015-11-20 14:01:11"),
("20","WameA1__school_full_list.csv","text/comma-separated-values","2015-11-20 14:02:45","2015-11-20 14:02:45"),
("21","MKCLSR__school_full_list.csv","text/comma-separated-values","2015-11-20 14:04:33","2015-11-20 14:04:33"),
("22","BBrrVn__composer.json","application/json","2016-02-04 10:06:09","2016-02-04 10:06:09");



DROP TABLE IF EXISTS users;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO users VALUES("1","dkdkkd","gadocansey@yahoo.com","$2y$10$/4DFtD5Byh52YukQzuutYuwAOhPEhzZAKRyOYOFkdvtVo09GDrpM6","ES0LhTCCgcUACdjr657LevIuAGVP9M12S3hvfyMSA3n3vThjY8oNZIfLzRUl","2016-01-17 18:05:46","2016-02-02 10:52:56"),
("2","aggie","cashallsam@gmail.com","$2y$10$AZIwxXgsu/7oxyqRy0A4QO6XbOVirTgoDfDCyvmWmOZ4HAbZuVHAK","5m3oN1RK9YwbJaASWGsjFg6ZuCMV5T7ut8ZKXuiDm0CnH9IRACQcd9fd1Ldl","2016-01-18 12:35:51","2016-01-18 12:36:33"),
("3","Maami Esi","maame@gmail.com","$2y$10$ByxzqBzijAkx4JOzlrVsseBPTgee.ItOaYDBxLO2TxyvSDmp4bSUe","QYlrfqmraaFQDMrTE6tHSzdWVfXoJK2NOcWlMnuhwndWK1o0YByd71iOLfcS","2016-02-03 01:56:54","2016-02-07 09:46:28");



