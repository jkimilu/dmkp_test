-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 08, 2018 at 06:19 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wviems`
--

-- --------------------------------------------------------

--
-- Table structure for table `bf_countries`
--

CREATE TABLE `bf_countries` (
  `iso` char(2) NOT NULL DEFAULT 'US',
  `name` varchar(80) NOT NULL,
  `printable_name` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_countries`
--

INSERT INTO `bf_countries` (`iso`, `name`, `printable_name`, `iso3`, `numcode`) VALUES
('AD', 'ANDORRA', 'Andorra', 'AND', 20),
('AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784),
('AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4),
('AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28),
('AI', 'ANGUILLA', 'Anguilla', 'AIA', 660),
('AL', 'ALBANIA', 'Albania', 'ALB', 8),
('AM', 'ARMENIA', 'Armenia', 'ARM', 51),
('AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530),
('AO', 'ANGOLA', 'Angola', 'AGO', 24),
('AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL),
('AR', 'ARGENTINA', 'Argentina', 'ARG', 32),
('AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16),
('AT', 'AUSTRIA', 'Austria', 'AUT', 40),
('AU', 'AUSTRALIA', 'Australia', 'AUS', 36),
('AW', 'ARUBA', 'Aruba', 'ABW', 533),
('AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31),
('BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70),
('BB', 'BARBADOS', 'Barbados', 'BRB', 52),
('BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50),
('BE', 'BELGIUM', 'Belgium', 'BEL', 56),
('BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854),
('BG', 'BULGARIA', 'Bulgaria', 'BGR', 100),
('BH', 'BAHRAIN', 'Bahrain', 'BHR', 48),
('BI', 'BURUNDI', 'Burundi', 'BDI', 108),
('BJ', 'BENIN', 'Benin', 'BEN', 204),
('BM', 'BERMUDA', 'Bermuda', 'BMU', 60),
('BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96),
('BO', 'BOLIVIA', 'Bolivia', 'BOL', 68),
('BR', 'BRAZIL', 'Brazil', 'BRA', 76),
('BS', 'BAHAMAS', 'Bahamas', 'BHS', 44),
('BT', 'BHUTAN', 'Bhutan', 'BTN', 64),
('BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL),
('BW', 'BOTSWANA', 'Botswana', 'BWA', 72),
('BY', 'BELARUS', 'Belarus', 'BLR', 112),
('BZ', 'BELIZE', 'Belize', 'BLZ', 84),
('CA', 'CANADA', 'Canada', 'CAN', 124),
('CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL),
('CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180),
('CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140),
('CG', 'CONGO', 'Congo', 'COG', 178),
('CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756),
('CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384),
('CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184),
('CL', 'CHILE', 'Chile', 'CHL', 152),
('CM', 'CAMEROON', 'Cameroon', 'CMR', 120),
('CN', 'CHINA', 'China', 'CHN', 156),
('CO', 'COLOMBIA', 'Colombia', 'COL', 170),
('CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188),
('CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL),
('CU', 'CUBA', 'Cuba', 'CUB', 192),
('CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132),
('CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL),
('CY', 'CYPRUS', 'Cyprus', 'CYP', 196),
('CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203),
('DE', 'GERMANY', 'Germany', 'DEU', 276),
('DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262),
('DK', 'DENMARK', 'Denmark', 'DNK', 208),
('DM', 'DOMINICA', 'Dominica', 'DMA', 212),
('DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214),
('DZ', 'ALGERIA', 'Algeria', 'DZA', 12),
('EC', 'ECUADOR', 'Ecuador', 'ECU', 218),
('EE', 'ESTONIA', 'Estonia', 'EST', 233),
('EG', 'EGYPT', 'Egypt', 'EGY', 818),
('EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732),
('ER', 'ERITREA', 'Eritrea', 'ERI', 232),
('ES', 'SPAIN', 'Spain', 'ESP', 724),
('ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231),
('FI', 'FINLAND', 'Finland', 'FIN', 246),
('FJ', 'FIJI', 'Fiji', 'FJI', 242),
('FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238),
('FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583),
('FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234),
('FR', 'FRANCE', 'France', 'FRA', 250),
('GA', 'GABON', 'Gabon', 'GAB', 266),
('GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826),
('GD', 'GRENADA', 'Grenada', 'GRD', 308),
('GE', 'GEORGIA', 'Georgia', 'GEO', 268),
('GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254),
('GH', 'GHANA', 'Ghana', 'GHA', 288),
('GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292),
('GL', 'GREENLAND', 'Greenland', 'GRL', 304),
('GM', 'GAMBIA', 'Gambia', 'GMB', 270),
('GN', 'GUINEA', 'Guinea', 'GIN', 324),
('GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312),
('GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226),
('GR', 'GREECE', 'Greece', 'GRC', 300),
('GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL),
('GT', 'GUATEMALA', 'Guatemala', 'GTM', 320),
('GU', 'GUAM', 'Guam', 'GUM', 316),
('GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624),
('GY', 'GUYANA', 'Guyana', 'GUY', 328),
('HK', 'HONG KONG', 'Hong Kong', 'HKG', 344),
('HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL),
('HN', 'HONDURAS', 'Honduras', 'HND', 340),
('HR', 'CROATIA', 'Croatia', 'HRV', 191),
('HT', 'HAITI', 'Haiti', 'HTI', 332),
('HU', 'HUNGARY', 'Hungary', 'HUN', 348),
('ID', 'INDONESIA', 'Indonesia', 'IDN', 360),
('IE', 'IRELAND', 'Ireland', 'IRL', 372),
('IL', 'ISRAEL', 'Israel', 'ISR', 376),
('IN', 'INDIA', 'India', 'IND', 356),
('IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL),
('IQ', 'IRAQ', 'Iraq', 'IRQ', 368),
('IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364),
('IS', 'ICELAND', 'Iceland', 'ISL', 352),
('IT', 'ITALY', 'Italy', 'ITA', 380),
('JM', 'JAMAICA', 'Jamaica', 'JAM', 388),
('JO', 'JORDAN', 'Jordan', 'JOR', 400),
('JP', 'JAPAN', 'Japan', 'JPN', 392),
('KE', 'KENYA', 'Kenya', 'KEN', 404),
('KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417),
('KH', 'CAMBODIA', 'Cambodia', 'KHM', 116),
('KI', 'KIRIBATI', 'Kiribati', 'KIR', 296),
('KM', 'COMOROS', 'Comoros', 'COM', 174),
('KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659),
('KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408),
('KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410),
('KW', 'KUWAIT', 'Kuwait', 'KWT', 414),
('KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136),
('KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398),
('LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418),
('LB', 'LEBANON', 'Lebanon', 'LBN', 422),
('LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662),
('LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438),
('LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144),
('LR', 'LIBERIA', 'Liberia', 'LBR', 430),
('LS', 'LESOTHO', 'Lesotho', 'LSO', 426),
('LT', 'LITHUANIA', 'Lithuania', 'LTU', 440),
('LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442),
('LV', 'LATVIA', 'Latvia', 'LVA', 428),
('LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434),
('MA', 'MOROCCO', 'Morocco', 'MAR', 504),
('MC', 'MONACO', 'Monaco', 'MCO', 492),
('MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498),
('MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450),
('MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584),
('MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807),
('ML', 'MALI', 'Mali', 'MLI', 466),
('MM', 'MYANMAR', 'Myanmar', 'MMR', 104),
('MN', 'MONGOLIA', 'Mongolia', 'MNG', 496),
('MO', 'MACAO', 'Macao', 'MAC', 446),
('MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580),
('MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474),
('MR', 'MAURITANIA', 'Mauritania', 'MRT', 478),
('MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500),
('MT', 'MALTA', 'Malta', 'MLT', 470),
('MU', 'MAURITIUS', 'Mauritius', 'MUS', 480),
('MV', 'MALDIVES', 'Maldives', 'MDV', 462),
('MW', 'MALAWI', 'Malawi', 'MWI', 454),
('MX', 'MEXICO', 'Mexico', 'MEX', 484),
('MY', 'MALAYSIA', 'Malaysia', 'MYS', 458),
('MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508),
('NA', 'NAMIBIA', 'Namibia', 'NAM', 516),
('NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540),
('NE', 'NIGER', 'Niger', 'NER', 562),
('NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574),
('NG', 'NIGERIA', 'Nigeria', 'NGA', 566),
('NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558),
('NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528),
('NO', 'NORWAY', 'Norway', 'NOR', 578),
('NP', 'NEPAL', 'Nepal', 'NPL', 524),
('NR', 'NAURU', 'Nauru', 'NRU', 520),
('NU', 'NIUE', 'Niue', 'NIU', 570),
('NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554),
('OM', 'OMAN', 'Oman', 'OMN', 512),
('PA', 'PANAMA', 'Panama', 'PAN', 591),
('PE', 'PERU', 'Peru', 'PER', 604),
('PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258),
('PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598),
('PH', 'PHILIPPINES', 'Philippines', 'PHL', 608),
('PK', 'PAKISTAN', 'Pakistan', 'PAK', 586),
('PL', 'POLAND', 'Poland', 'POL', 616),
('PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666),
('PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612),
('PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630),
('PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL),
('PT', 'PORTUGAL', 'Portugal', 'PRT', 620),
('PW', 'PALAU', 'Palau', 'PLW', 585),
('PY', 'PARAGUAY', 'Paraguay', 'PRY', 600),
('QA', 'QATAR', 'Qatar', 'QAT', 634),
('RE', 'REUNION', 'Reunion', 'REU', 638),
('RO', 'ROMANIA', 'Romania', 'ROM', 642),
('RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643),
('RW', 'RWANDA', 'Rwanda', 'RWA', 646),
('SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682),
('SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90),
('SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690),
('SD', 'SUDAN', 'Sudan', 'SDN', 736),
('SE', 'SWEDEN', 'Sweden', 'SWE', 752),
('SG', 'SINGAPORE', 'Singapore', 'SGP', 702),
('SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654),
('SI', 'SLOVENIA', 'Slovenia', 'SVN', 705),
('SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744),
('SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703),
('SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694),
('SM', 'SAN MARINO', 'San Marino', 'SMR', 674),
('SN', 'SENEGAL', 'Senegal', 'SEN', 686),
('SO', 'SOMALIA', 'Somalia', 'SOM', 706),
('SR', 'SURINAME', 'Suriname', 'SUR', 740),
('ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678),
('SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222),
('SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760),
('SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748),
('TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796),
('TD', 'CHAD', 'Chad', 'TCD', 148),
('TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL),
('TG', 'TOGO', 'Togo', 'TGO', 768),
('TH', 'THAILAND', 'Thailand', 'THA', 764),
('TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762),
('TK', 'TOKELAU', 'Tokelau', 'TKL', 772),
('TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL),
('TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795),
('TN', 'TUNISIA', 'Tunisia', 'TUN', 788),
('TO', 'TONGA', 'Tonga', 'TON', 776),
('TR', 'TURKEY', 'Turkey', 'TUR', 792),
('TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780),
('TV', 'TUVALU', 'Tuvalu', 'TUV', 798),
('TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158),
('TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834),
('UA', 'UKRAINE', 'Ukraine', 'UKR', 804),
('UG', 'UGANDA', 'Uganda', 'UGA', 800),
('UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL),
('US', 'UNITED STATES', 'United States', 'USA', 840),
('UY', 'URUGUAY', 'Uruguay', 'URY', 858),
('UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860),
('VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336),
('VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670),
('VE', 'VENEZUELA', 'Venezuela', 'VEN', 862),
('VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92),
('VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850),
('VN', 'VIET NAM', 'Viet Nam', 'VNM', 704),
('VU', 'VANUATU', 'Vanuatu', 'VUT', 548),
('WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876),
('WS', 'SAMOA', 'Samoa', 'WSM', 882),
('YE', 'YEMEN', 'Yemen', 'YEM', 887),
('YT', 'MAYOTTE', 'Mayotte', NULL, NULL),
('ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710),
('ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894),
('ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716);

-- --------------------------------------------------------

--
-- Table structure for table `bf_courses`
--

CREATE TABLE `bf_courses` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `url` text NOT NULL,
  `description` text NOT NULL,
  `duration` varchar(32) NOT NULL,
  `course_provider_id` int(10) NOT NULL,
  `course_category_id` int(10) NOT NULL DEFAULT '0',
  `language` varchar(255) NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bf_courses`
--

INSERT INTO `bf_courses` (`id`, `name`, `url`, `description`, `duration`, `course_provider_id`, `course_category_id`, `language`, `active`, `created`, `modified`) VALUES
(1, 'Self-Awareness: Leadership Styles', 'https://kayaconnect.org/course/info.php?id=376', '', '20 Mins', 1, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(2, 'Different Management Styles', 'https://kayaconnect.org/course/info.php?id=337', '', '60 min', 6, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(3, 'Making a Success of your First Mngt Role', 'https://kayaconnect.org/course/info.php?id=309', '', '6-8 hours', 6, 3, 'English,French, Arabic', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(4, 'Balancing the Duel Roles of People Manager and Technical Expert', 'https://kayaconnect.org/course/info.php?id=392', '', '30 min', 6, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(5, 'Building Win-Win Relationships with your team', 'https://kayaconnect.org/course/info.php?id=346', '', '3.5 hours', 6, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(6, 'Becoming a Manager-Coach', 'https://kayaconnect.org/course/info.php?id=296', '', '?', 6, 3, 'Arabic', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(7, 'Cash Learning Hub', 'https://kayaconnect.org/course/info.php?id=241 and https://kayaconnect.org/course/info.php?id=295 and https://kayaconnect.org/course/info.php?id=297', '', '?', 17, 3, 'English,Spanish,French', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(8, 'Transferencias de efectivo y meios de visa en contextos urbanos', 'https://kayaconnect.org/course/info.php?id=252', '', '2 hours', 11, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(9, 'Communication is Aid', 'https://kayaconnect.org/course/info.php?id=389', '', '30 min', 10, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(10, 'Handling Stress', 'https://kayaconnect.org/course/info.php?id=390', '', '30min', 16, 3, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(11, 'Emotional Intelligence Fundamentals', 'https://kayaconnect.org/course/info.php?id=260', '', '1-2 hours', 16, 1, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(12, 'Three essential levers for building winning co-operation', 'https://kayaconnect.org/course/info.php?id=375', '', '6 hours', 16, 15, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(13, 'Three routes to good communication', 'https://kayaconnect.org/course/info.php?id=399', '', '30 min', 16, 18, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(14, 'Constructing and Managing a Budget', 'https://kayaconnect.org/course/info.php?id=417', '', '30 min', 16, 18, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(15, 'Successfully Adapt Your Message', 'https://kayaconnect.org/course/info.php?id=391', '', '30 min', 16, 18, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(16, 'Building a Better Response', 'https://kayaconnect.org/course/info.php?id=351', '', '30 min', 5, 18, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(17, 'Introduction to the Core Humanitarian Standard', 'https://kayaconnect.org/course/info.php?id=353', '', '30 min', 8, 20, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(18, 'Managing in the Humanitarian Sector', 'https://kayaconnect.org/course/info.php?id=418', 'The Spelling, Grammar and Punctuation e-learning module covers common mistakes in written English, from puzzling punctuation to sneaky spellings.', '30 min', 8, 6, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(19, 'Learning Design', 'https://kayaconnect.org/course/info.php?id=255', 'Módulos diseñados para ayudar a los usuarios a obtener una visión general de una serie de temas importantes sobre los derechos de la niñez, normas y principios.', '7-9 hours', 8, 6, 'Spanish  ', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(20, 'Learning Design and Facilitation', 'https://kayaconnect.org/course/info.php?id=427', 'Gain an overview of critical child rights issues, standards and principles, and build skills for main-streaming child rights in different sectors and phases of development cooperation programming.', '7-9 hours', 8, 6, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(21, 'Humanitarian Context, System and Standards', 'https://kayaconnect.org/course/info.php?id=432', 'Principes et des processus communs pour la gestion des transferts de fonds entre les organismes des Nations Unies qui ont adopté l\'approche dans tous les pays et contextes opérationnels.', '90 min', 4, 6, 'Spanish', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(22, 'Cross-Cutting Themes and Future directions', 'https://kayaconnect.org/course/view.php?id=491', 'A collection of learning resources brought together by The Cash Learning Partnership (CaLP)', '', 4, 10, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(23, 'Shelter and Settlement', 'https://kayaconnect.org/course/info.php?id=312', 'The goals, programmes, challenges and achievements of UNICEF\'s child protection work.', '30min', 3, 1, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(24, 'Conflict Resolution', 'https://kayaconnect.org/course/info.php?id=340', 'The issues explored in this course include gender, disability, environment, protection, HIV/AIDS and DRR (disaster risk reduction)', '90 min', 12, 1, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(25, 'Facilitation Skills', 'https://kayaconnect.org/course/info.php?id=270', 'Make sure everyone is included in everyone you do. Diversity isn\'t just an add-on!', '2 modules=?', 12, 7, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(26, 'Influencing, Assertiveness and Negotiation', 'https://kayaconnect.org/course/info.php?id=371', 'This module aims to improve your financial awareness to benefit the people you serve by introducing you to financial reporting systems and explaining why they benefit managers and leaders in their decision-making.', '1 module=?', 12, 7, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(27, 'Solving Problems by Making Effective Decisions', 'https://kayaconnect.org/course/info.php?id=370', 'This module introduces managers to the building blocks of financial management, namely resource management, risk management, strategic management and organisational management.', '1 module=?', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(28, 'Giving and Receiving Feedback', 'https://kayaconnect.org/course/info.php?id=458', 'How to create an organisational culture of applying the Sphere approach.', '60 min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(29, 'Developing Individual Mental Toughness', 'https://kayaconnect.org/course/info.php?id=318', 'This course looks at different management styles and how to adapt them to your needs and your team\'s needs.', '20 min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(30, 'Spelling, Grammer and Punctuation', 'https://kayaconnect.org/course/info.php?id=319', 'This course is for those new to management looking for advice on managing teams successfully', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(31, 'Becoming an Effective Leader', 'https://kayaconnect.org/course/info.php?id=323', 'Most people who have a team to manage also have specialist or technical responsibilities themselves. This course looks at how to balance the demands of these different work roles.', '30 min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(32, 'Understanding the Organisational Environment', 'https://kayaconnect.org/course/info.php?id=377', 'This course looks at a manager\'s duty of care towards their team, including caring management styles, ensuring work-life balance, managing emotions, and dealing withh stress and burnout.', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(33, 'Coaching', 'https://kayaconnect.org/course/info.php?id=378', 'This module looks at performance management, setting objectives, and preparing for and delivering appraisals.', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(34, 'Developing People in the Workplace', 'https://kayaconnect.org/course/info.php?id=379', 'Learn the skills required to be a good and understanding listener', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(35, 'Dignity at Work', 'https://kayaconnect.org/course/info.php?id=382', 'Learn to give effective and honest feedback.', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(36, 'Finance for Non-Financial Managers', 'https://kayaconnect.org/course/info.php?id=320', 'Building mutually-beneficial relationships and negotiation', '30 min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(37, 'Managing Recruitment', 'https://kayaconnect.org/course/info.php?id=406', 'Learn the attitudes and best practises of a manager / coach.', '30min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(38, 'Presentation Skills', 'https://kayaconnect.org/course/info.php?id=329', 'Leadership styles, team development and empowerment.', '45min', 12, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(39, 'PMD Pro: Project Mngt', 'https://kayaconnect.org/course/info.php?id=413', 'Learn the basic elements needed for building a winning co-operation with others.', '30 min', 15, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(40, 'Stress Management for Everyone', 'https://kayaconnect.org/course/info.php?id=412', 'This course has practical tools and recommendations for you to learn how to communicate better. ', '30 min', 15, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(41, 'Financial Management Reporting', 'https://kayaconnect.org/course/info.php?id=420', 'Learn how the make up, and the environment of your organisation can themselves become a strategic planning tool.', '30 min', 7, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(42, 'Financial Management ', 'https://kayaconnect.org/course/info.php?id=419', 'Learn the benefits of coaching, and the skills needed to be an effective coach', '30 min', 7, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(43, 'Shere for Managers: how to champion the Sphere approach in your organization', 'https://kayaconnect.org/course/info.php?id=445', 'Learn how to be an effective leader and good manager in humanitarian response.', '?', 2, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(44, 'Preventing Corruption in Humanitarian Aid', 'https://kayaconnect.org/course/info.php?id=302', 'PMDPro is a project management qualification for the development/humanitarian sector. It was developed by LINGOS.', '6 hours', 13, 12, 'English, French, Spanish', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(45, 'Personal Development', 'https://kayaconnect.org/course/info.php?id=396', 'This module looks at the importance of promoting personal development, and the role that you as a manager can play in helping to plan and manage an individual\'s professional progression.', '30 min', 13, 16, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(46, 'Evaluation in Humanitarian Settings', 'https://kayaconnect.org/course/info.php?id=387', 'This module looks at how managers can help create a positive work environment in which everyone is treated with dignity and respect.', '30 min', 1, 16, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(47, 'Sexual & Gender Based Violence', 'https://kayaconnect.org/course/info.php?id=364', 'Learn effective methods to prepare your budget, perform reforecasts and monitor the budget.', '30 min', 9, 12, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(48, 'Managing Individuals: Duty of Care', 'https://kayaconnect.org/course/info.php?id=384', 'Learn the basics of finance management and financial planning', '30 min', 9, 17, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(49, 'Managing Individuals: Managing Performance', 'https://kayaconnect.org/course/info.php?id=372', 'This module provides a quick orientation to stress, what it is, how to recognise it in yourself, and how to manage it both short term and long term.', '1 module=?', 9, 8, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(50, 'Managing Individuals:  Active Listening', 'https://kayaconnect.org/course/info.php?id=383', 'Learn to recognise and counter-balance unconscious bias.', '30min', 9, 8, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(51, 'Managing Individuals:  Feedback', 'https://kayaconnect.org/course/info.php?id=393', 'Understanding your own influences and motivations.', '30min', 9, 8, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(52, 'Self Awareness: Managing Biases', 'https://kayaconnect.org/course/info.php?id=394', 'Understanding and managing emotions.', '30min', 9, 8, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(53, 'Self-Awareness: Know yourself', 'https://kayaconnect.org/course/info.php?id=415', 'Explore how the areas of human resource planning and recruitment apply to the modern business environment, and where you - as a manager - fit in to the process.', '30 min', 9, 4, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(54, 'Self Awareness:  Emotional Intelligence', 'https://kayaconnect.org/course/info.php?id=271 and https://kayaconnect.org/course/info.php?id=272', 'Advice on writing effectively from UNHCR', '5 modules = ?', 9, 9, 'English,French', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(55, 'Writing Effectively', 'https://kayaconnect.org/course/info.php?id=425', 'Learn to adapt your message to suit each audience', '30 min', 9, 9, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(56, 'Core Commitments for Children (CCC)', 'https://kayaconnect.org/course/info.php?id=416', 'Develop your knowledge of good practice in learning and development of learning design', '30 Mins', 1, 16, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(57, 'Integración de los Derechos de la Niñez en la Cooperación para el Desarrollo', 'https://kayaconnect.org/course/info.php?id=258', 'UNICEF\'s Harmonized Approach to Cash Transfers (HACT) establishes common principles and processes for managing cash transfers between organisations. This course describes the principles and processes of HACT and how they work in UNICEF.', '90 min', 1, 13, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(58, 'Integrating Child Rights in Development Cooperation', 'https://kayaconnect.org/course/info.php?id=253', 'An introduction to the evaluation process in humanitarian situations.', '1-2 hours', 1, 11, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(59, 'El método Armonizado para las Transferencias de Efectivo (HACT)', 'https://kayaconnect.org/course/view.php?id=304', 'This course will support you in developing an understanding and knowledge of good practice in learning and development.', '4 modules=?', 1, 6, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(60, 'Introduction to Child Protection', 'https://kayaconnect.org/course/info.php?id=330', 'Writing, preparing and delivering presentations', '40min', 1, 6, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(61, 'Harmonized Approach to Cash Transfers (HACT) ', 'https://kayaconnect.org/course/info.php?id=307', 'La programación de transferencias de efectivo para medios de vida en contextos urbano', '3 hours', 1, 6, 'Spanish, English, French', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(62, 'Psychosocial Support Programming', 'https://kayaconnect.org/course/info.php?id=243', 'This module from UNICEF is an introduction to psychosocial support: what it is, why it is important and what a holistic psychosocial support programme looks like.', '45 min', 1, 6, 'English', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(63, 'Age, Gender and Diversity Approach', 'https://kayaconnect.org/course/info.php?id=266', 'Introduction to shelter and settlement', '5 hours', 1, 5, 'English,Spanish', 1, '2018-01-26 16:36:20', '0000-00-00 00:00:00'),
(67, 'Bsc Science BioChemistry', 'http://www.jkuat.ac.ke/departments/biochemistry/wp-content/uploads/2014/08/BSc.-in-Biochemistry-and-Molecular-Biology.pdf', 'Biochemistry is a subject in life sciences whose objective entails understanding the\nMolecular Basis of life in plants and animals. It is a multi-disciplinary subject that\nfocuses on structure and function of molecules as well as their interplay to create the\nphenomenon of life. The subject particularly looks at how molecular interplay is\ntranslated into basic metabolism, energy transduction, defense and physical responses\nfor purposes of growth and development.', '4 Years', 18, 20, 'English', 1, '2018-02-14 17:38:13', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bf_course_categories`
--

CREATE TABLE `bf_course_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bf_course_categories`
--

INSERT INTO `bf_course_categories` (`id`, `name`) VALUES
(1, 'Cross-cutting Issues'),
(3, 'Basic'),
(4, 'Management'),
(5, 'Technical Sectors'),
(6, 'Sectors'),
(7, 'Financial'),
(8, 'P&C/HR'),
(9, 'programmes'),
(10, 'basics/sectors'),
(11, 'programmes/ sectors'),
(12, 'Management Programmes'),
(13, 'Programmes Sectors'),
(14, 'P&C/HR Management'),
(15, 'Basics P&C/HR'),
(16, 'Management P&C/HR'),
(17, 'Operations Management'),
(18, 'Basics Management'),
(19, 'Basics Cross Cutting'),
(20, 'Basics Programmes'),
(21, 'Test Category2');

-- --------------------------------------------------------

--
-- Table structure for table `bf_course_categories_pivot`
--

CREATE TABLE `bf_course_categories_pivot` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bf_course_categories_pivot`
--

INSERT INTO `bf_course_categories_pivot` (`id`, `course_id`, `category_id`) VALUES
(51, 1, 3),
(52, 2, 3),
(53, 3, 3),
(50, 4, 3),
(59, 5, 3),
(60, 6, 3),
(61, 7, 3),
(62, 8, 3),
(63, 9, 3),
(64, 10, 3),
(65, 11, 1),
(66, 12, 15),
(67, 13, 18),
(68, 14, 18),
(69, 15, 18),
(70, 16, 18),
(71, 17, 20),
(72, 18, 6),
(73, 19, 6),
(74, 20, 6),
(75, 21, 6),
(76, 22, 10),
(77, 23, 1),
(78, 24, 1),
(79, 25, 7),
(80, 26, 7),
(81, 27, 4),
(82, 28, 4),
(83, 29, 4),
(84, 30, 4),
(85, 31, 4),
(86, 32, 4),
(87, 33, 4),
(88, 34, 4),
(89, 35, 4),
(90, 36, 4),
(91, 37, 4),
(92, 38, 4),
(93, 39, 4),
(94, 40, 4),
(95, 41, 4),
(96, 42, 4),
(97, 43, 4),
(98, 44, 12),
(99, 45, 16),
(100, 46, 16),
(101, 47, 12),
(102, 48, 17),
(103, 49, 8),
(104, 50, 8),
(105, 51, 8),
(106, 52, 8),
(107, 53, 4),
(108, 54, 9),
(109, 55, 9),
(110, 56, 16),
(111, 57, 13),
(112, 58, 11),
(113, 59, 6),
(114, 60, 6),
(115, 61, 6),
(116, 62, 6),
(190, 63, 9),
(118, 67, 20),
(119, 69, 21),
(47, 70, 3),
(48, 70, 19);

-- --------------------------------------------------------

--
-- Table structure for table `bf_course_languages`
--

CREATE TABLE `bf_course_languages` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bf_course_languages`
--

INSERT INTO `bf_course_languages` (`id`, `course_id`, `language_id`) VALUES
(1, 1, 1),
(3, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `bf_course_links`
--

CREATE TABLE `bf_course_links` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bf_course_providers`
--

CREATE TABLE `bf_course_providers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bf_course_providers`
--

INSERT INTO `bf_course_providers` (`id`, `name`) VALUES
(1, 'UNICEF'),
(2, 'Sphere Project/HIA'),
(3, 'Interaction'),
(4, 'Humanitarian University'),
(5, 'Harvard Humanitarian Initiative'),
(6, 'Beyond Knowledge'),
(7, 'Mango/LINGOS'),
(8, 'HLA'),
(9, 'UNHCR'),
(10, 'CDAC Network'),
(11, 'Cash Learning Programme'),
(12, 'Learning Pool'),
(13, 'Transparency International/IFRC'),
(14, 'UNICEF'),
(15, 'LINGOS'),
(16, 'Cegos'),
(17, 'CaLP'),
(18, 'JKUAT');

-- --------------------------------------------------------

--
-- Table structure for table `bf_resource_tracker`
--

CREATE TABLE `bf_resource_tracker` (
  `id` int(11) NOT NULL,
  `resource_type` varchar(20) NOT NULL,
  `resource_category` varchar(20) NOT NULL,
  `resource_id` int(11) NOT NULL,
  `resource_url` varchar(500) NOT NULL,
  `resource_name` varchar(150) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bf_resource_tracker`
--

INSERT INTO `bf_resource_tracker` (`id`, `resource_type`, `resource_category`, `resource_id`, `resource_url`, `resource_name`, `deleted`, `created_on`, `modified_on`) VALUES
(1, 'document', 'dm_policies', 2, 'https://www.wvcentral.org/HEA/HEA%20Test%20Library/Disaster%20Management%20Standards%202nd%20Edition%202011.pdf', 'Disaster Management Standards', 0, '2016-09-30 01:21:04', NULL),
(2, 'document', 'dm_policies', 1, 'https://www.wvcentral.org/HEA/HEA%20Test%20Library/Partnership%20Board%20Policy%20on%20Disaster%20Management.pdf', 'Disaster Management Policy', 0, '2016-09-30 01:24:25', NULL),
(3, 'link', 'dm_policies', 3, 'https://www.wvcentral.org/pc/_layouts/15/WopiFrame.aspx?sourcedoc=/pc/People%20and%20Culture%20Policies1/Corporate%20Code%20of%20Conduct.doc&action=default&DefaultItemOpen=1', 'WVI Corporate Code of Conduct ', 0, '2016-09-30 01:26:16', NULL),
(4, 'link', 'dm_policies', 4, 'https://www.wvcentral.org/wvipolicy/_layouts/15/WopiFrame.aspx?sourcedoc=/wvipolicy/Document%20Library/Relief%20Funding%20pp.doc&action=default', 'Partnership Board Policy on Relief Funding', 0, '2016-09-30 01:29:42', NULL),
(5, 'link', 'dm_policies', 5, 'https://www.wvcentral.org/GlobalFinance/FinanceManual/Documents/EMR06%20Partnership%20Management%20Policy%20on%20Disaster%20Management%20Funding.pdf#search=Disaster%20Management%20Funding%20Policy', 'Disaster Management Funding Policy', 0, '2016-09-30 01:32:17', NULL),
(6, 'link', 'dm_policies', 6, 'https://www.wvcentral.org/wvipolicy/Document%20Library/Design,%20Monitoring%20and%20Evaluation%20Policy.pdf#search=Partnership%20Design%20Monitoring%20Evaluation%20Management%20Policy', 'Partnership Design Monitoring Evaluation Management Policy', 0, '2016-09-30 01:34:40', NULL),
(7, 'link', 'dm_policies', 7, 'http://www.ifrc.org/en/publications-and-reports/code-of-conduct/', 'Principles of Conduct for the International Red Cross and Red Crescent Movement and NGOs in Disaster Response Programmes ', 0, '2016-09-30 01:36:01', NULL),
(8, 'document', 'dm_policies', 8, 'https://www.wvcentral.org/HEA/HEA Test Library/Policy and Standards on Child Protection, Relief C Policy 2001.doc', 'Policy and Standards on Child Protection', 0, '2016-09-30 01:38:13', NULL),
(9, 'link', 'dm_policies', 9, 'https://www.wvcentral.org/community/health/_layouts/15/WopiFrame.aspx?sourcedoc=/community/health/Documents/Reports%20and%20Publications/Policy%20Positions/Reproductive%20Health%20Board%20policy%20draft%20shorter.doc&action=default&DefaultItemOpen=1', 'WVI  Reproductive Health Policy ', 0, '2016-09-30 01:39:53', NULL),
(10, 'link', 'dm_policies', 10, 'https://www.wvcentral.org/civmil/Pages/default.aspx', 'Civil-Military and Police Engagement Policy', 0, '2016-09-30 01:41:41', NULL),
(11, 'link', 'dm_preparedness', 1, 'https://www.wvcentral.org/HEA/Documents_81/NO%20Strategy%2C%20Planning%20and%20Disaster%20Preparedness/Tools/Revised%20WV%20Tools/Disaster%20Preparedness%20Plan/2012%20Disaster%20Preparedness%20Plan%20Template-v5.doc', 'National Office Disaster Preparedness Plan', 0, '2016-09-30 01:55:27', '2017-06-23 15:37:24'),
(12, 'link', 'dm_preparedness', 3, 'https://www.wvcentral.org/HEA/Pages/ResearchLearning.aspx', 'Disaster Information Sheets', 0, '2016-09-30 01:56:45', NULL),
(13, 'link', 'capacity_building', 1, 'http://www.wvecampus.com/course/index.php?categoryid=27', 'WV eCampus', 0, '2016-09-30 02:01:46', NULL),
(14, 'link', 'capacity_building', 2, 'http://www.wvecampus.com/course/index.php?categoryid=40', 'Disaster Management Foundations', 0, '2016-09-30 02:02:51', '2018-01-25 19:37:47'),
(15, 'link', 'capacity_building', 3, 'http://www.wvecampus.com/course/index.php?categoryid=45', 'HEA Regional Programmes', 0, '2016-09-30 02:03:34', NULL),
(16, 'link', 'capacity_building', 4, 'http://www.wvecampus.com/course/index.php?categoryid=46', 'HEA Training Courses', 0, '2016-09-30 02:04:21', '2016-09-30 02:43:24'),
(17, 'link', 'capacity_building', 5, 'http://www.wvecampus.com/course/index.php?categoryid=44', 'Leadership in Emergencies', 0, '2016-09-30 02:04:53', NULL),
(18, 'link', 'capacity_building', 6, 'http://www.wvecampus.com/course/index.php?categoryid=41', 'NO Disaster Management Processes in Depth', 0, '2016-09-30 02:05:42', NULL),
(19, 'link', 'capacity_building', 7, 'http://www.wvecampus.com/course/index.php?categoryid=42', 'Standards in Depth', 0, '2016-09-30 02:06:20', NULL),
(20, 'link', 'capacity_building', 8, 'http://www.wvecampus.com/course/index.php?categoryid=43', 'Technical Areas', 0, '2016-09-30 02:06:53', NULL),
(21, 'link', 'capacity_building', 9, 'https://www.disasterready.org/', 'Disaster Ready', 0, '2016-09-30 02:07:47', NULL),
(22, 'link', 'capacity_building', 10, 'http://www.buildingabetterresponse.org/', 'Building Better Response', 0, '2016-09-30 02:09:17', NULL),
(23, 'link', 'dm_preparedness', 4, 'http://www.3ieimpact.org/media/filer_public/2016/09/20/srs7-education-report.pdf?ct=t%28EER_LAUNCH_EMILER9_28_2016%29&mc_cid=2ad94fe9ec&mc_eid=d809ea085b', 'restest', 1, '2016-09-30 09:56:02', NULL),
(24, 'document', 'dm_preparedness', 4, 'example.com', 'estr', 1, '2016-09-30 09:56:34', NULL),
(25, 'link', 'dm_policies', 19, 'https://www.icrc.org/eng/resources/documents/article/review/review-871-p751.htm', 'ICRC Protection Policy', 0, '2016-10-02 18:42:04', NULL),
(26, 'link', 'dm_policies', 18, 'https://www.wvcentral.org/community/food/_layouts/15/WopiFrame.aspx?sourcedoc=/community/food/Food%20CoP%20Main%20Library/Local%20and%20Regional%20Procurement%20Commodities%20management%20policy%20(8%20April%202010).doc&action=default&DefaultItemOpen=1', 'Management Policy on Local and Regional Procurement (LRP) of Food Commodities', 0, '2016-10-02 18:42:56', NULL),
(27, 'link', 'dm_policies', 17, 'https://www.wvcentral.org/HEA/_layouts/15/WopiFrame.aspx?sourcedoc=/HEA/HEA%20Test%20Library/Vehicle%20Fleet%20Safety%20and%20Management.doc&action=default&DefaultItemOpen=1', 'Vehicle Fleet Safety and Management Partnership Policy', 0, '2016-10-02 18:43:43', NULL),
(28, 'link', 'dm_policies', 16, 'https://www.wvcentral.org/GlobalFinance/FinanceManual/_layouts/15/WopiFrame.aspx?sourcedoc=/GlobalFinance/FinanceManual/Grant%20and%20Donor%20Regulations/Food%20Aid%20Management%20Policy,%2025Aug08.doc&action=default&DefaultItemOpen=1', 'Management Policy on Food Aid', 0, '2016-10-02 18:44:24', NULL),
(29, 'document', 'dm_policies', 15, 'https://www.wvcentral.org/wvipolicy/Document%20Library/WV%20Milk%20Policy.pdf#search=WV%20Milk%20Policy', 'WV Milk Policy', 0, '2016-10-02 18:44:57', NULL),
(30, 'link', 'dm_policies', 14, 'https://www.wvcentral.org/GlobalFinance/FinanceManual/_layouts/15/WopiFrame.aspx?sourcedoc=/GlobalFinance/FinanceManual/Grant%20and%20Donor%20Regulations/Final%20Consolidated%20Booking%20document%20For%20Audit,%202014.doc&action=default&DefaultItemOpen=1', 'WV Food Booking Policy', 0, '2016-10-02 18:45:39', NULL),
(31, 'link', 'dm_policies', 13, 'https://www.wvcentral.org/HEA/_layouts/15/WopiFrame.aspx?sourcedoc=/HEA/HEA%20Test%20Library/Management%20Policy%20on%20CC%20in%20HEA%20incl%20WtJC.doc&action=default', 'Management Policy on Christian Commitments in Emergency Response and Disaster Management', 0, '2016-10-02 18:46:22', NULL),
(32, 'document', 'dm_policies', 12, 'https://www.wvcentral.org/HEA/HEA%20Test%20Library/EMR04%20Release%20of%20ADP%20Funds%20for%20Disaster%20Response.pdf#search=Management%20Policy%20on%20Release%20of%20ADP%20Funds%20for%20Disaster%20Response%20%28EMR%2E04%29', 'Management Policy on Release of ADP Funds for Disaster Response (EMR.04)', 0, '2016-10-02 18:47:15', NULL),
(33, 'document', 'dm_policies', 11, 'https://www.wvcentral.org/HEA/HEA%20Test%20Library/EPRF%20Manual.pdf#search=EPRF%20Policy', 'EPRF Manual and Policy', 0, '2016-10-02 18:48:06', NULL),
(34, 'document', 'dm_preparedness', 5, 'https://www.wvcentral.org/Grants/Pages/NO_GAM_Business_Plans.aspx', 'GAM business plan and template', 0, '2017-01-20 09:04:41', '2017-01-20 09:04:47'),
(35, 'document', 'dm_policies', 20, ' https://www.wvcentral.org/Grants/Pages/HEA.aspx ', 'GAM and HEA protocol: Fundraising roles and  responsibilities in emergencies ', 0, '2017-01-20 09:08:06', '2017-01-20 09:08:09'),
(36, 'link', 'dm_preparedness', 2, 'https://www.wvcentral.org/HEA/HEA%20Test%20Library/NO%20DM%20Scorecard-final2016-v3.xlsx', 'National Office Disaster Management Scorecard', 0, '2017-05-22 11:39:29', '2017-05-22 11:40:02'),
(37, 'Link', 'capacity_building', 63, 'http://aasad.com', 'qwqqwq', 0, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bf_countries`
--
ALTER TABLE `bf_countries`
  ADD PRIMARY KEY (`iso`);

--
-- Indexes for table `bf_courses`
--
ALTER TABLE `bf_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bf_course_categories`
--
ALTER TABLE `bf_course_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bf_course_categories_pivot`
--
ALTER TABLE `bf_course_categories_pivot`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_id` (`course_id`,`category_id`);

--
-- Indexes for table `bf_course_languages`
--
ALTER TABLE `bf_course_languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq` (`course_id`,`language_id`);

--
-- Indexes for table `bf_course_links`
--
ALTER TABLE `bf_course_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bf_course_providers`
--
ALTER TABLE `bf_course_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bf_resource_tracker`
--
ALTER TABLE `bf_resource_tracker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bf_courses`
--
ALTER TABLE `bf_courses`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `bf_course_categories`
--
ALTER TABLE `bf_course_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `bf_course_categories_pivot`
--
ALTER TABLE `bf_course_categories_pivot`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `bf_course_languages`
--
ALTER TABLE `bf_course_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bf_course_providers`
--
ALTER TABLE `bf_course_providers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bf_resource_tracker`
--
ALTER TABLE `bf_resource_tracker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
