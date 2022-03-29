DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `email` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `phone` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) COLLATE utf8_unicode_ci NOT NULL,
  `username` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` boolean COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
    primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `user_id` int(11) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `last_name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `profile_image` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthday` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_verified` boolean COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_verified` boolean COLLATE utf8_unicode_ci DEFAULT NULL,
  `language` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` boolean COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
    primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mobilesessions`;
CREATE TABLE `mobilesessions` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `user_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` datetime COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
    primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `mobileemailotp`;
CREATE TABLE `mobileemailotp` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `user_id` int(11) NOT NULL,
  `tokenforemail` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expiry_date` datetime COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
    primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `userroles`;
CREATE TABLE `userroles` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `role_name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` boolean COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `userroles`(
    `role_name`,
    `status`,
    `updated_at`,
    `created_at`
)
VALUES(
    "superadmin",
    1,
    "2019-10-14",
    "2019-10-14"
);
INSERT INTO `userroles`(
    `role_name`,
    `status`,
    `updated_at`,
    `created_at`
)
VALUES(
    "merchant",
    1,
    "2019-10-14",
    "2019-10-14"
);
INSERT INTO `userroles`(
    `role_name`,
    `status`,
    `updated_at`,
    `created_at`
)
VALUES(
    "user",
    1,
    "2019-10-14",
    "2019-10-14"
);


DROP TABLE IF EXISTS `main_category`;
CREATE TABLE `main_category` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `category_name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `image` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` boolean COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `sub_category`;
CREATE TABLE `sub_category` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `main_cat_id` int(11) NOT NULL,
  `category_name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `image` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` boolean COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` date NOT NULL,
  `created_at` date NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `main_category`(
    `category_name`,
    `image`,
    `status`,
    `updated_at`,
    `created_at`
)
VALUES(
    "Groceries",
    "categoryImages/groceries.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
),(
    "Shopping",
    "categoryImages/shopping.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
),(
    "Services",
    "categoryImages/services.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
),(
    "Banking",
    "categoryImages/banking.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
),(
    "Health Care",
    "categoryImages/healthcare.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
),(
    "Restaurant",
    "categoryImages/restaurant.jpg",
    1,
    "2020-09-14 12:51:51",
    "2020-09-14 12:51:51"
);

INSERT INTO `sub_category`(
    `main_cat_id`,
    `category_name`,
    `image`,
    `status`,
    `updated_at`,
    `created_at`
)
VALUES(
    1,
    "Dairy Products",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
),(
    1,
    "Fruits",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
),(
    1,
    "Household Items",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
),(
    3,
    "Plumbing",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
),(
    3,
    "Cleaning",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
),(
    3,
    "Car Wash",
    "",
    1,
    "2020-09-14 01:57:57",
    "2020-09-14 01:57:57"
);

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `main_cat_id` int(11) NOT NULL,
  `sub_cat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sp_id` int(11) DEFAULT NULL,
  `title` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `details` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `location` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `latitude` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `longitude` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `urgent` boolean COLLATE utf8_unicode_ci NOT NULL,
  `min_price` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `max_price` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` int COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_ratings`;
CREATE TABLE `user_ratings` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating_user_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `rating` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `job_images`;
CREATE TABLE `job_images` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `job_id` int(11) NOT NULL,
  `image` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` boolean COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE IF EXISTS `job_requests`;
CREATE TABLE `job_requests` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` LONGTEXT COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
    primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



DROP TABLE IF EXISTS `country`;
CREATE TABLE `country` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `name` LONGTEXT COLLATE utf8_unicode_ci NOT NULL,
  `status` boolean COLLATE utf8_unicode_ci DEFAULT 1,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  primary key (id)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO country
(name)
VALUES
('Afghanistan'),
('Albania'),
('Algeria'),
('Andorra'),
('Angola'),
('Antigua and Barbuda'),
('Argentina'),
('Armenia'),
('Australia'),
('Austria'),
('Azerbaijan'),
('Bahamas, The'),
('Bahrain'),
('Bangladesh'),
('Barbados'),
('Belarus'),
('Belgium'),
('Belize'),
('Benin'),
('Bhutan'),
('Bolivia'),
('Bosnia and Herzegovina'),
('Botswana'),
('Brazil'),
('Brunei'),
('Bulgaria'),
('Burkina Faso'),
('Burma'),
('Burundi'),
('Cambodia'),
('Cameroon'),
('Canada'),
('Cape Verde'),
('Central Africa'),
('Chad'),
('Chile'),
('China'),
('Colombia'),
('Comoros'),
('Congo, Democratic Republic of the'),
('Costa Rica'),
('Cote dIvoire'),
('Crete'),
('Croatia'),
('Cuba'),
('Cyprus'),
('Czech Republic'),
('Denmark'),
('Djibouti'),
('Dominican Republic'),
('East Timor'),
('Ecuador'),
('Egypt'),
('El Salvador'),
('Equatorial Guinea'),
('Eritrea'),
('Estonia'),
('Ethiopia'),
('Fiji'),
('Finland'),
('France'),
('Gabon'),
('Gambia, The'),
('Georgia'),
('Germany'),
('Ghana'),
('Greece'),
('Grenada'),
('Guadeloupe'),
('Guatemala'),
('Guinea'),
('Guinea-Bissau'),
('Guyana'),
('Haiti'),
('Holy See'),
('Honduras'),
('Hong Kong'),
('Hungary'),
('Iceland'),
('India'),
('Indonesia'),
('Iran'),
('Iraq'),
('Ireland'),
('Israel'),
('Italy'),
('Ivory Coast'),
('Jamaica'),
('Japan'),
('Jordan'),
('Kazakhstan'),
('Kenya'),
('Kiribati'),
('Korea, North'),
('Korea, South'),
('Kosovo'),
('Kuwait'),
('Kyrgyzstan'),
('Laos'),
('Latvia'),
('Lebanon'),
('Lesotho'),
('Liberia'),
('Libya'),
('Liechtenstein'),
('Lithuania'),
('Macau'),
('Macedonia'),
('Madagascar'),
('Malawi'),
('Malaysia'),
('Maldives'),
('Mali'),
('Malta'),
('Marshall Islands'),
('Mauritania'),
('Mauritius'),
('Mexico'),
('Micronesia'),
('Moldova'),
('Monaco'),
('Mongolia'),
('Montenegro'),
('Morocco'),
('Mozambique'),
('Namibia'),
('Nauru'),
('Nepal'),
('Netherlands'),
('New Zealand'),
('Nicaragua'),
('Niger'),
('Nigeria'),
('North Korea'),
('Norway'),
('Oman'),
('Pakistan'),
('Palau'),
('Panama'),
('Papua New Guinea'),
('Paraguay'),
('Peru'),
('Philippines'),
('Poland'),
('Portugal'),
('Qatar'),
('Romania'),
('Russia'),
('Rwanda'),
('Saint Lucia'),
('Saint Vincent and the Grenadines'),
('Samoa'),
('San Marino'),
('Sao Tome and Principe'),
('Saudi Arabia'),
('Scotland'),
('Senegal'),
('Serbia'),
('Seychelles'),
('Sierra Leone'),
('Singapore'),
('Slovakia'),
('Slovenia'),
('Solomon Islands'),
('Somalia'),
('South Africa'),
('South Korea'),
('Spain'),
('Sri Lanka'),
('Sudan'),
('Suriname'),
('Swaziland'),
('Sweden'),
('Switzerland'),
('Syria'),
('Taiwan'),
('Tajikistan'),
('Tanzania'),
('Thailand'),
('Tibet'),
('Timor-Leste'),
('Togo'),
('Tonga'),
('Trinidad and Tobago'),
('Tunisia'),
('Turkey'),
('Turkmenistan'),
('Tuvalu'),
('Uganda'),
('Ukraine'),
('United Arab Emirates'),
('United Kingdom'),
('United States'),
('Uruguay'),
('Uzbekistan'),
('Vanuatu'),
('Venezuela'),
('Vietnam'),
('Yemen'),
('Zambia'),
('Zimbabwe');


