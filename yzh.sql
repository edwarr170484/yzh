-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Янв 15 2019 г., 14:58
-- Версия сервера: 10.1.9-MariaDB
-- Версия PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `yzh`
--

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `translit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `tieser` longtext COLLATE utf8_unicode_ci,
  `text` longtext COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `background_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `sortorder` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `type` int(11) DEFAULT NULL,
  `meta_tag_title` longtext COLLATE utf8_unicode_ci,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `meta_tag_robots` longtext COLLATE utf8_unicode_ci,
  `meta_tag_author` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `blog`
--

INSERT INTO `blog` (`id`, `locale_id`, `title`, `translit`, `date`, `tieser`, `text`, `image`, `background_image`, `sortorder`, `is_active`, `type`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `meta_tag_robots`, `meta_tag_author`) VALUES
(1, 5, 'Свадебная съемка в стиле Бохо', 'Svadebnaya-semka-v-stile-Bokho', '2018-09-28 15:17:40', 'Свадебная съемка в стиле Бохо', 'Стиль Бохо - один из самых популярных и любимых стилей в свадьбе. Это совершенно эклектичное сочетание стиля хиппи, кочевников и цыган с художественным чутьем. Это смешивание полюбили многие, особенно дизайнеры, декораторы. <br /><br />Чтобы глубже проникнуться идеей Бохо, я провела некоторое исследование, немного изучила историю происхождения этого слова и стиля. Итак, слово Boho - это аббревиатура от Bohemian Homeless, что значит богемный бомж. В современном мире это толкуется как: нарочитая небрежность, аутентичность, экологичность, вольность в подборе предметов наряда, и все это переплетено нитью яркого акцента. Ну а стиль Boho Chic, был заимствован у французов в конце 19 века и преобразил цыганский бохо в более стильный, элегантный европейский стиль. Этот стиль так часто путают с хиппи 60-х, однако культура богемы в отличие от стиля хиппи отличается буржуазностью и изысканностью. Слово богемность была присвоена творческим личностям, мнения которых прислушиваются в культурных кругах. <br />Нет одного творца или первооткрывателя этого стиля. Этот собирательный стиль на протяжении нескольких столетий. Богемный стиль, который мы видим сейчас - результат работы дизайнеров, деятелей исскуства, это голливудские звезды, история. Бохо - это больше, чем стиль. Это культура.', '37283.png', NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `kurs` double NOT NULL,
  `is_default` tinyint(1) DEFAULT '0',
  `sortorder` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`, `code`, `kurs`, `is_default`, `sortorder`) VALUES
(1, 'Бел. руб.', 'BYN', 2, 0, 2),
(2, 'Долл. США', 'USD', 1, 1, 1),
(3, 'Евро', 'Euro', 0.83, 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `locale`
--

CREATE TABLE `locale` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `code` varchar(10) COLLATE utf8_unicode_ci DEFAULT 'null',
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `sortorder` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '0',
  `is_default` tinyint(1) DEFAULT '0',
  `currency_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `locale`
--

INSERT INTO `locale` (`id`, `name`, `code`, `country`, `sortorder`, `is_active`, `is_default`, `currency_id`) VALUES
(1, 'Английский', 'en', 'United-Kingdom.png', 2, 1, 0, 2),
(5, 'Русский', 'ru', 'Russia.png', 1, 1, 1, 1),
(7, 'Французский', 'fr', 'France.png', 3, 1, 0, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `locale_id`, `name`, `title`, `position`, `sort`) VALUES
(1, 5, 'main_menu', 'Главное меню', 'left', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `menu_items`
--

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `sort` int(11) DEFAULT NULL,
  `block` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `menu_items`
--

INSERT INTO `menu_items` (`id`, `page_id`, `menu_id`, `parent_id`, `title`, `link`, `sort`, `block`) VALUES
(1, 9, 1, NULL, 'О нас', NULL, 1, NULL),
(2, 18, 1, NULL, 'Услуги', NULL, 3, NULL),
(3, 17, 1, NULL, 'Блог', NULL, 4, NULL),
(4, 10, 1, NULL, 'Контакты', NULL, 5, NULL),
(5, 19, 1, NULL, 'Портфолио', NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `message` longtext COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `date` datetime NOT NULL,
  `is_new` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `page_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `page_route` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `page_content` longtext COLLATE utf8_unicode_ci,
  `meta_tag_title` longtext COLLATE utf8_unicode_ci,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `meta_tag_robots` longtext COLLATE utf8_unicode_ci,
  `meta_tag_author` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `locale_id`, `page_name`, `page_route`, `page_content`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `meta_tag_robots`, `meta_tag_author`) VALUES
(1, 1, 'Home', '/', '<section id="index-additional-services-section">\r\n<div class="index-addservice-left-block visible-lg visible-md"></div>\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6">\r\n<div class="index-additional-service-foto"><img src="../../../bundles/images/index-additional-servie-foto.jpg" caption="false" width="554" height="353" /></div>\r\n</div>\r\n<div class="col-lg-6 col-md-6 index-additional-services-block">\r\n<div class="yellow-border"></div>\r\n<div class="index-additional-services-block-inner">\r\n<div class="index-additional-services-block-header bold">Дополнительные услуги</div>\r\n<ul class="list-unstyled index-additional-services-list">\r\n<li><a class="regular">Трансфер из аэропорта</a></li>\r\n<li><a class="regular">Возможность аредны авто без водителя</a></li>\r\n<li><a class="regular">Украшения для праздников</a></li>\r\n<li><a class="regular">Туристические направления</a></li>\r\n<li><a class="regular">Бар + лимузин</a></li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', NULL, NULL, NULL, NULL, NULL),
(2, 1, 'About Us', '/about', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Feedback', '/feedback', NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, '404', '/notfound', NULL, NULL, NULL, NULL, NULL, NULL),
(8, 5, 'Главная', '/', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 5, 'О компании', '/about', 'Хороший цветочный салон - это, к тому же, красочный интерьер, опрятный и убранный магазин, в котором товары расположены таким образом, чтобы любой покупатель мог легко определится с выбором. Половина этого залога - это компетентные и мотивированные флористы, вежливые, которые подскажут, какой букет подобрать для человека конкретного возраста и пола. В салоне на работу принимаются только опытные сотрудники, через руки которых прошел не один букет, в том числе, они с легкостью справляются с таким сложным продуктом флористики, как свадебные букеты невесты.<br /><br />Достойный салон цветов отличает также и ассортимент товаров. Помимо ходовых срезанных цветов, таких, как, розы, тюльпаны, герберы и хризантемы, в ассорименте должны присутствовать и редкие, экзотические цветы для составления букетов. Некоторую долю ассоримента должны занимать горшечные цветы - орихдеи, бонсаи, фикусы и многие другие. Скоропортящуюся цветочную продукцию должны дополнять более "стойкие" товары, например, аксессуары для праздников - открытки, подарочные пакетики, упаковочная бумага, а также дополняющие товары - вазоны, удобрения, грунт и прочие средства ухода за цветами. В салоне все это имеется с лихвой.', 'О компании', 'О компании', 'О компании', 'О компании', 'О компании'),
(10, 5, 'Контакты', '/contact', 'Индивидуальный предприниматель<br />Жизневская Юлия<br />УНП: 123331123, регистрация в торговом реестре № 31233321', NULL, NULL, NULL, NULL, NULL),
(12, 5, '404', '/notfound', '<br />страница не найдена', NULL, NULL, NULL, NULL, NULL),
(13, 7, 'Главная', '/', NULL, NULL, NULL, NULL, NULL, NULL),
(14, 7, 'О компании', '/about', NULL, 'О компании', 'О компании', 'О компании', 'О компании', 'О компании'),
(15, 7, 'Контакты', '/feedback', NULL, NULL, NULL, NULL, NULL, NULL),
(16, 7, '404', '/notfound', NULL, NULL, NULL, NULL, NULL, NULL),
(17, 5, 'Блог', '/blog', NULL, 'Блог', 'Блог', 'Блог', NULL, NULL),
(18, 5, 'Услуги', '/service', NULL, 'Услуги', NULL, NULL, NULL, NULL),
(19, 5, 'Портфолио', '/portfolio', NULL, 'Портфолио', 'Портфолио', 'Портфолио', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `page_block`
--

CREATE TABLE `page_block` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `block_content` longtext COLLATE utf8_unicode_ci,
  `sortorder` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `page_block`
--

INSERT INTO `page_block` (`id`, `page_id`, `block_content`, `sortorder`) VALUES
(1, 1, '<section id="index-why-section">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-12">\r\n<div class="index-pageplock-header ">\r\n<h1>Почему <b>выбирают нас?</b></h1>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="row">\r\n<div class="col-lg-12">\r\n<ul class="index-why-blocks list-unstyled clearfix">\r\n<li>\r\n<div class="index-why-inner regular why-1">Более 10 лет на рынке услуг</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-2">Более 50 000 довольных клиентов</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-3">Опытные<br />водители</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-4">Собственный автопарк</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-5">Выгодные цены</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-6">Оперативная работа</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-7">Офис в центре города</div>\r\n</li>\r\n<li>\r\n<div class="index-why-inner regular why-8">Бесплатные украшения</div>\r\n</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', 1),
(4, 2, '<section id="index-why-section">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-12">\r\n<ul class="list-unstyled why-list clearfix">\r\n<li class="why-1">More than 15 years of successful work of the company in the international market</li>\r\n<li class="why-2">Excellent knowledge of the<br /> market of consumer <br /> accessories</li>\r\n<li class="why-3">Successful cooperation with many retail and wholesale partners</li>\r\n<li class="why-4">Continuous improvement of technology and the pursuit of innovation</li>\r\n</ul>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', 1),
(5, 2, '<section id="about-history-section">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-12">\r\n<div class="about-history-section-header regular">History of the company</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="history-line">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-5 col-md-5 about-line-date-block">\r\n<div class="about-line-date gray italic">1992</div>\r\n</div>\r\n<div class="col-lg-7 col-md-7 about-line-text regular">\r\n<div class="about-line-text-header">Company open</div>\r\nThe supplier of consumer accessories in Canada for 5 years, our main goal is build strong relationships with retailers and partners in the supply chain.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="history-line">\r\n<div class="history-line-background"></div>\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-5 col-md-5 about-line-date-block">\r\n<div class="about-line-date italic">2001</div>\r\n</div>\r\n<div class="col-lg-7 col-md-7 about-line-text gray regular">\r\n<div class="about-line-text-header">Company open</div>\r\nThe supplier of consumer accessories in Canada for 5 years, our main goal is build strong relationships with retailers and partners in the supply chain.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="history-line">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-5 col-md-5 about-line-date-block">\r\n<div class="about-line-date gray italic">2012</div>\r\n</div>\r\n<div class="col-lg-7 col-md-7 about-line-text regular">\r\n<div class="about-line-text-header">Company open</div>\r\nThe supplier of consumer accessories in Canada for 5 years, our main goal is build strong relationships with retailers and partners in the supply chain.</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="history-line">\r\n<div class="history-line-background red"></div>\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-5 col-md-5 about-line-date-block hidden-sm hidden-xs">\r\n<div class="about-line-date italic no-text"></div>\r\n</div>\r\n<div class="col-lg-7 col-md-7 about-line-text regular no-text">\r\n<section id="index-become-dealer"><a href="../../../brands" class="regular"> <span>Our brands</span> </a></section>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n<div class="history-line hidden-sm hidden-xs">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-5 col-md-5 about-line-date gray italic no-text"></div>\r\n<div class="col-lg-7 col-md-7 about-line-text regular no-text"></div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', 2),
(6, 2, '<section id="about-review-section">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-12">\r\n<div class="about-review-block">\r\n<div class="about-review-block-inner bold">New brand in the market with juicy ideas, brand in the market with juicy ideas!\r\n<div class="about-review-author regular">Vladimir Putilkin, President of Forus Corporation</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', 3),
(7, 2, '<section id="index-information-section">\r\n<div class="index-information-section-left"></div>\r\n<div class="index-information-section-right"></div>\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6 regular index-information-block left">\r\n<div class="information-header bold">BECOME A DEALER</div>\r\n<div class="information-text">Gentec dealers enjoy access to a wide range of top-tier brands spanning the imaging, electronics, wireless, audio, sporting goods, sporting goods, electronics, wireless, and mobile electronics markets.</div>\r\n<div class="information-link"><a data-toggle="modal" data-target="#myModal" class="arrow-link">Write to us</a></div>\r\n</div>\r\n<div class="col-lg-6 col-md-6 regular index-information-block right gray">\r\n<div class="information-header bold shadow">BECOME A DEALER</div>\r\n<div class="information-text">Gentec dealers enjoy access to a wide range of top-tier brands spanning the imaging, electronics, wireless, audio, sporting goods, sporting goods, electronics, wireless, and mobile electronics markets.</div>\r\n<div class="information-link"><a data-toggle="modal" data-target="#myModal" class="arrow-link">Write to us</a></div>\r\n</div>\r\n</div>\r\n</div>\r\n</section>', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio_category`
--

CREATE TABLE `portfolio_category` (
  `id` int(11) NOT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_title` longtext COLLATE utf8_unicode_ci,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `meta_tag_robots` longtext COLLATE utf8_unicode_ci,
  `meta_tag_author` longtext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `portfolio_category`
--

INSERT INTO `portfolio_category` (`id`, `locale_id`, `sortorder`, `name`, `title`, `description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `meta_tag_robots`, `meta_tag_author`) VALUES
(1, 5, 1, 'Svadebnye-bukety', 'Свадебные букеты', 'Свадебные букеты', 'Свадебные букеты', 'Свадебные букеты', 'Свадебные букеты', NULL, NULL),
(2, 5, 2, 'Bukety-na-yubiley', 'Букеты на юбилей', 'Букеты на юбилей', 'Букеты на юбилей', 'Букеты на юбилей', 'Букеты на юбилей', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio_image`
--

CREATE TABLE `portfolio_image` (
  `id` int(11) NOT NULL,
  `portfolio_id` int(11) DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `alt` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `style` varchar(512) COLLATE utf8_unicode_ci DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `portfolio_image`
--

INSERT INTO `portfolio_image` (`id`, `portfolio_id`, `sortorder`, `image`, `alt`, `title`, `style`) VALUES
(1, 1, 2, '14585.jpg', NULL, NULL, 'right:0;width:57%;top:0;z-index:1;'),
(2, 1, 1, '47681.jpg', NULL, NULL, 'left:0;width:40%;top:0;');

-- --------------------------------------------------------

--
-- Структура таблицы `portfolio_item`
--

CREATE TABLE `portfolio_item` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `sortorder` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_title` longtext COLLATE utf8_unicode_ci,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `meta_tag_robots` longtext COLLATE utf8_unicode_ci,
  `meta_tag_author` longtext COLLATE utf8_unicode_ci,
  `date_added` datetime NOT NULL,
  `style` varchar(512) COLLATE utf8_unicode_ci DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `portfolio_item`
--

INSERT INTO `portfolio_item` (`id`, `category_id`, `locale_id`, `sortorder`, `name`, `title`, `description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `meta_tag_robots`, `meta_tag_author`, `date_added`, `style`) VALUES
(1, 1, 5, 1, 'Svadebnye-bukety', 'Свадебные букеты', NULL, 'Свадебные букеты', 'Свадебные букеты', 'Свадебные букеты', NULL, NULL, '2018-10-05 16:27:43', 'left:0;width:40%;top:0;');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `name`, `role`) VALUES
(1, 'Administrator', 'ROLE_ADMIN'),
(2, 'User', 'ROLE_USER');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `locale_id` int(11) DEFAULT NULL,
  `site_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `settings_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `settings_phone` longtext COLLATE utf8_unicode_ci,
  `search_google` longtext COLLATE utf8_unicode_ci,
  `search_yandex` longtext COLLATE utf8_unicode_ci,
  `logotype` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `social_vk` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `social_youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `social_instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `copyright` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null',
  `social_facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'null'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `locale_id`, `site_name`, `settings_email`, `settings_phone`, `search_google`, `search_yandex`, `logotype`, `social_vk`, `social_youtube`, `social_instagram`, `copyright`, `social_facebook`) VALUES
(1, 1, '', '', '', NULL, NULL, '', '', '', '', '', ''),
(2, 5, 'Жизневская Юлия', 'Yuliya_Zhiznevskaya@tut.by', '+375 29 324 36 58', NULL, NULL, '50000000.png', NULL, NULL, NULL, NULL, NULL),
(3, 7, '', '', '', NULL, NULL, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `is_active`, `name`) VALUES
(1, 'buster', '$2y$10$QEt09dUIy9/Halt/NtO5Z.k7FG.hdey/o/vDYCoLQcGGLOpmvU.cC', 'buster@bootboard.by', 1, 'Buster');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C0155143E559DFD1` (`locale_id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `locale`
--
ALTER TABLE `locale`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_4180C69838248176` (`currency_id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7D053A93E559DFD1` (`locale_id`);

--
-- Индексы таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_70B2CA2AC4663E4` (`page_id`),
  ADD KEY `IDX_70B2CA2ACCD7E912` (`menu_id`);

--
-- Индексы таблицы `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_140AB620E559DFD1` (`locale_id`);

--
-- Индексы таблицы `page_block`
--
ALTER TABLE `page_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E59A68F4C4663E4` (`page_id`);

--
-- Индексы таблицы `portfolio_category`
--
ALTER TABLE `portfolio_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7AC64359E559DFD1` (`locale_id`);

--
-- Индексы таблицы `portfolio_image`
--
ALTER TABLE `portfolio_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_98652E1AB96B5643` (`portfolio_id`);

--
-- Индексы таблицы `portfolio_item`
--
ALTER TABLE `portfolio_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2F2A62E412469DE2` (`category_id`),
  ADD KEY `IDX_2F2A62E4E559DFD1` (`locale_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_57698A6A57698A6A` (`role`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_E545A0C5E559DFD1` (`locale_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `IDX_2DE8C6A3A76ED395` (`user_id`),
  ADD KEY `IDX_2DE8C6A3D60322AC` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `locale`
--
ALTER TABLE `locale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `page_block`
--
ALTER TABLE `page_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT для таблицы `portfolio_category`
--
ALTER TABLE `portfolio_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `portfolio_image`
--
ALTER TABLE `portfolio_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `portfolio_item`
--
ALTER TABLE `portfolio_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `blog`
--
ALTER TABLE `blog`
  ADD CONSTRAINT `FK_C0155143E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `locale`
--
ALTER TABLE `locale`
  ADD CONSTRAINT `FK_4180C69838248176` FOREIGN KEY (`currency_id`) REFERENCES `currency` (`id`);

--
-- Ограничения внешнего ключа таблицы `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `FK_7D053A93E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `FK_70B2CA2AC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`),
  ADD CONSTRAINT `FK_70B2CA2ACCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`);

--
-- Ограничения внешнего ключа таблицы `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB620E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `page_block`
--
ALTER TABLE `page_block`
  ADD CONSTRAINT `FK_E59A68F4C4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`);

--
-- Ограничения внешнего ключа таблицы `portfolio_category`
--
ALTER TABLE `portfolio_category`
  ADD CONSTRAINT `FK_7AC64359E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `portfolio_image`
--
ALTER TABLE `portfolio_image`
  ADD CONSTRAINT `FK_98652E1AB96B5643` FOREIGN KEY (`portfolio_id`) REFERENCES `portfolio_item` (`id`);

--
-- Ограничения внешнего ключа таблицы `portfolio_item`
--
ALTER TABLE `portfolio_item`
  ADD CONSTRAINT `FK_2F2A62E412469DE2` FOREIGN KEY (`category_id`) REFERENCES `portfolio_category` (`id`),
  ADD CONSTRAINT `FK_2F2A62E4E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `settings`
--
ALTER TABLE `settings`
  ADD CONSTRAINT `FK_E545A0C5E559DFD1` FOREIGN KEY (`locale_id`) REFERENCES `locale` (`id`);

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `FK_2DE8C6A3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2DE8C6A3D60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
