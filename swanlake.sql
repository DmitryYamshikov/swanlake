-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 29 2021 г., 07:34
-- Версия сервера: 5.6.41
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `swanlake`
--

-- --------------------------------------------------------

--
-- Структура таблицы `accordion`
--

CREATE TABLE `accordion` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `accordion_items`
--

CREATE TABLE `accordion_items` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `accordion_id` int(11) DEFAULT NULL,
  `accordion_order` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `login` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `preview_image` varchar(255) DEFAULT NULL,
  `preview_image_enable` tinyint(1) DEFAULT NULL,
  `preview_image_alt` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `sort` int(11) DEFAULT NULL,
  `intro` text,
  `text` longtext,
  `create_time` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `params` longtext,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `brand`
--

CREATE TABLE `brand` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `preview_text` text,
  `detail_text` text,
  `active` tinyint(1) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `update_time` timestamp NULL DEFAULT NULL,
  `description` longtext,
  `main_image` varchar(255) DEFAULT NULL,
  `main_image_alt` varchar(255) DEFAULT NULL,
  `main_image_enable` tinyint(1) DEFAULT NULL,
  `root` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `level` smallint(5) NOT NULL,
  `show_categories_mode` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `eav_attribute`
--

CREATE TABLE `eav_attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` smallint(6) DEFAULT NULL,
  `fixed` tinyint(1) NOT NULL DEFAULT '0',
  `filter` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `eav_value`
--

CREATE TABLE `eav_value` (
  `id` int(11) NOT NULL,
  `id_attrs` int(11) DEFAULT NULL,
  `id_product` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `intro` text,
  `text` longtext,
  `preview` varchar(255) DEFAULT NULL,
  `enable_preview` tinyint(1) DEFAULT '1',
  `publish` tinyint(1) DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `event`
--

INSERT INTO `event` (`id`, `title`, `alias`, `intro`, `text`, `preview`, `enable_preview`, `publish`, `created`, `update_time`) VALUES
(1, 'Создали сайт', NULL, 'Мы создали сайт!', '<p>Мы создали сайт!</p>', NULL, 1, 1, '2021-04-28 10:49:22', '2021-04-28 03:49:22');

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `description` longtext,
  `ordering` int(11) DEFAULT NULL,
  `preview_id` varchar(255) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `gallery_img`
--

CREATE TABLE `gallery_img` (
  `id` int(11) NOT NULL,
  `image_order` int(11) DEFAULT '1',
  `gallery_id` int(11) NOT NULL,
  `title` varchar(500) DEFAULT NULL,
  `description` longtext,
  `image` varchar(255) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `image`
--

CREATE TABLE `image` (
  `id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `info_block`
--

CREATE TABLE `info_block` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '500',
  `active` tinyint(1) DEFAULT '1',
  `use_preview` tinyint(1) DEFAULT '1',
  `use_description` tinyint(1) DEFAULT '1',
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_block`
--

INSERT INTO `info_block` (`id`, `title`, `code`, `sort`, `active`, `use_preview`, `use_description`, `description`) VALUES
(1, 'Баннер на главной', '', 500, 1, 1, 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `info_block_element`
--

CREATE TABLE `info_block_element` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `title` varchar(255) NOT NULL,
  `preview` varchar(255) DEFAULT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '500',
  `info_block_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_block_element`
--

INSERT INTO `info_block_element` (`id`, `code`, `active`, `title`, `preview`, `description`, `created_at`, `updated_at`, `sort`, `info_block_id`) VALUES
(1, NULL, 1, 'Баннер на главной', '1_20c4864df85e.jpg', '', '2021-04-28 08:45:03', '2021-04-28 08:46:28', 500, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `info_block_element_prop`
--

CREATE TABLE `info_block_element_prop` (
  `id` int(11) NOT NULL,
  `element_id` int(11) NOT NULL,
  `prop_id` int(11) NOT NULL,
  `value` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_block_element_prop`
--

INSERT INTO `info_block_element_prop` (`id`, `element_id`, `prop_id`, `value`) VALUES
(1, 1, 1, 'Найдите мужчину вашей мечты в Китае!'),
(2, 1, 2, 'Наше агентство поможет легко выйти замуж за достойного, заботливого китайского мужчину');

-- --------------------------------------------------------

--
-- Структура таблицы `info_block_prop`
--

CREATE TABLE `info_block_prop` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  `type` char(1) NOT NULL,
  `multiple` tinyint(1) DEFAULT NULL,
  `code` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL DEFAULT '500',
  `info_block_id` int(11) NOT NULL,
  `default` varchar(255) DEFAULT NULL,
  `options` text,
  `required` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `info_block_prop`
--

INSERT INTO `info_block_prop` (`id`, `title`, `active`, `type`, `multiple`, `code`, `sort`, `info_block_id`, `default`, `options`, `required`) VALUES
(1, 'Заголовок', 1, 'S', NULL, 'title', 500, 1, '', NULL, NULL),
(2, 'Подзаголовок', 1, 'S', NULL, 'subtitle', 500, 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `info_block_prop_value`
--

CREATE TABLE `info_block_prop_value` (
  `id` int(11) NOT NULL,
  `prop_id` int(11) NOT NULL,
  `value_key` varchar(255) NOT NULL,
  `value_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `link`
--

CREATE TABLE `link` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'model',
  `options` varchar(255) DEFAULT NULL,
  `seo_a_title` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '1',
  `default` tinyint(1) NOT NULL DEFAULT '0',
  `hidden` tinyint(1) NOT NULL DEFAULT '0',
  `system` tinyint(1) NOT NULL DEFAULT '0',
  `parent_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `menu`
--

INSERT INTO `menu` (`id`, `title`, `type`, `options`, `seo_a_title`, `ordering`, `default`, `hidden`, `system`, `parent_id`) VALUES
(1, 'Главная', 'model', '{\"model\":\"page\",\"id\":\"1\"}', NULL, 1, 1, 0, 0, NULL),
(3, 'Отзывы', 'model', '{\"model\":\"reviews\"}', NULL, 2, 0, 0, 0, NULL),
(4, 'Статьи', 'model', '{\"model\":\"articles\"}', NULL, 3, 0, 0, 0, NULL),
(5, 'Услуги', 'model', '{\"model\":\"services\"}', NULL, 4, 0, 0, 0, NULL),
(6, 'О нас', 'model', '{\"model\":\"page\",\"id\":\"2\"}', NULL, 5, 0, 0, 0, NULL),
(7, 'Анкета', 'model', '{\"model\":\"page\",\"id\":\"3\"}', NULL, 6, 0, 0, 0, NULL),
(8, 'Контакты', 'model', '{\"model\":\"page\",\"id\":\"4\"}', NULL, 7, 0, 0, 0, NULL),
(9, 'Наши услуги', 'model', '{\"model\":\"page\",\"id\":\"5\"}', NULL, 8, 0, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `metadata`
--

CREATE TABLE `metadata` (
  `id` int(11) NOT NULL,
  `owner_name` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `meta_h1` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `a_title` varchar(255) DEFAULT NULL,
  `priority` float DEFAULT NULL,
  `lastmod` varchar(255) DEFAULT NULL,
  `changefreq` varchar(255) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `metadata`
--

INSERT INTO `metadata` (`id`, `owner_name`, `owner_id`, `meta_h1`, `meta_title`, `meta_key`, `meta_desc`, `a_title`, `priority`, `lastmod`, `changefreq`, `update_time`) VALUES
(1, 'page', 2, '', '', '', '', NULL, NULL, '2021-04-28', 'always', '2021-04-28 06:59:01'),
(2, 'page', 3, '', '', '', '', NULL, NULL, '2021-04-28', 'always', '2021-04-28 06:59:19'),
(3, 'page', 4, '', '', '', '', NULL, NULL, '2021-04-28', 'always', '2021-04-28 07:00:05'),
(4, 'page', 5, '', '', '', '', NULL, NULL, '2021-04-28', 'always', '2021-04-28 07:00:34'),
(5, 'page', 1, NULL, NULL, NULL, NULL, NULL, NULL, '2021-04-28', NULL, '2021-04-28 09:51:26');

-- --------------------------------------------------------

--
-- Структура таблицы `order_customer_fields`
--

CREATE TABLE `order_customer_fields` (
  `id` int(11) NOT NULL,
  `name` varchar(25) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `placeholder` varchar(50) DEFAULT NULL,
  `type` varchar(25) DEFAULT NULL,
  `required` tinyint(1) DEFAULT '0',
  `sort` tinyint(2) DEFAULT NULL,
  `default_value` varchar(255) DEFAULT NULL,
  `values` text,
  `mask` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `order_customer_fields`
--

INSERT INTO `order_customer_fields` (`id`, `name`, `label`, `placeholder`, `type`, `required`, `sort`, `default_value`, `values`, `mask`) VALUES
(1, 'name', 'Ваше имя', NULL, 'text', 1, 1, NULL, NULL, NULL),
(2, 'email', 'E-mail', NULL, 'email', 0, 2, NULL, NULL, NULL),
(3, 'phone', 'Телефон', NULL, 'phone', 1, 3, NULL, NULL, NULL),
(4, 'address', 'Адрес доставки', NULL, 'textarea', 0, 4, NULL, NULL, NULL),
(5, 'comment', 'Комментарий к заказу', NULL, 'textarea', 0, 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `page`
--

CREATE TABLE `page` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `blog_id` int(11) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `intro` text,
  `text` longtext,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT NULL,
  `view_template` varchar(255) DEFAULT NULL,
  `show_page_title` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `page`
--

INSERT INTO `page` (`id`, `parent_id`, `blog_id`, `alias`, `title`, `intro`, `text`, `created`, `modified`, `update_time`, `view_template`, `show_page_title`) VALUES
(1, NULL, NULL, 'index', 'Главная', '<p>Сайт находится в разработке</p>', '<h2>Брачное агентство &laquo;Лебединое озеро&raquo;</h2>\r\n<p>Эта страница создана для демонстрации блоков и элементов, которые используются на сайте, и служит руководством для всех, кто работает над ним. Дизайнеры и технологи отрабатывают здесь стили, чтобы добиться приемлемых результатов в различных сочетаниях блоков и элементов. Контент-менеджеры и редакторы используют страницу в качестве справочника по верстке типовых страниц. Здесь же рассказывается о некоторых общих правилах оформления контента.</p>', '2021-04-28 03:49:23', '2021-04-28 09:51:26', '2021-04-28 09:51:26', '', 0),
(2, NULL, NULL, 'o-nas', 'О нас', 'О нас', '<p>О нас</p>', '2021-04-28 06:59:01', NULL, '2021-04-28 06:59:01', '', 1),
(3, NULL, NULL, 'anketa', 'Анкета', 'Анкета', '<p>Анкета</p>', '2021-04-28 06:59:19', NULL, '2021-04-28 06:59:19', '', 1),
(4, NULL, NULL, 'kontakty', 'Контакты', 'о', '<p>о</p>', '2021-04-28 07:00:05', NULL, '2021-04-28 07:00:05', '', 1),
(5, NULL, NULL, 'services', 'Наши услуги', 'Наши услуги', '<p>Наши услуги</p>', '2021-04-28 07:00:34', NULL, '2021-04-28 07:00:34', '', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `old_price` decimal(15,2) DEFAULT NULL,
  `sale` tinyint(1) DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `hit` tinyint(1) DEFAULT NULL,
  `notexist` tinyint(1) DEFAULT NULL,
  `in_carousel` tinyint(1) DEFAULT NULL,
  `hidden` tinyint(1) DEFAULT NULL,
  `on_shop_index` tinyint(1) DEFAULT '1',
  `link_title` varchar(255) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `description` longtext,
  `main_image` varchar(255) DEFAULT NULL,
  `main_image_alt` varchar(255) DEFAULT NULL,
  `main_image_enable` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `mark` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `ip` int(11) DEFAULT NULL,
  `text` longtext,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `ts` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `question` longtext,
  `answer` longtext,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `related_category`
--

CREATE TABLE `related_category` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image_enable` tinyint(1) DEFAULT NULL,
  `preview_text` text,
  `detail_text` text,
  `publish_date` date DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `preview` varchar(32) DEFAULT NULL,
  `enable_preview` tinyint(1) DEFAULT NULL,
  `preview_text` text,
  `text` text,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `seo_seo`
--

CREATE TABLE `seo_seo` (
  `id` int(11) NOT NULL,
  `hash` bigint(20) DEFAULT NULL,
  `model_name` varchar(255) NOT NULL DEFAULT '',
  `model_id` int(11) NOT NULL DEFAULT '0',
  `h1` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_description` text,
  `link_title` varchar(255) DEFAULT NULL,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `services_pages`
--

CREATE TABLE `services_pages` (
  `id` int(11) NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `sef` varchar(255) NOT NULL DEFAULT '',
  `image_alt` varchar(255) NOT NULL DEFAULT '',
  `image` varchar(255) NOT NULL DEFAULT '',
  `text` longtext,
  `sort` int(11) NOT NULL DEFAULT '0',
  `preview_text` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL DEFAULT 'system',
  `key` varchar(255) DEFAULT NULL,
  `value` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `category`, `key`, `value`) VALUES
(1, 'cms_settings', 'hide_news', 'b:1;'),
(2, 'cms_settings', 'slogan', 's:40:\"<p>Брачное агентство</p>\";'),
(3, 'cms_settings', 'address', 's:0:\"\";'),
(4, 'cms_settings', 'sitename', 's:29:\"Лебединое озеро\";'),
(5, 'cms_settings', 'phone', 's:0:\"\";'),
(6, 'cms_settings', 'phone2', 's:0:\"\";'),
(7, 'cms_settings', 'email', 's:0:\"\";'),
(8, 'cms_settings', 'emailPublic', 's:0:\"\";'),
(9, 'cms_settings', 'firm_name', 's:29:\"Лебединое озеро\";'),
(10, 'cms_settings', 'counter', 's:0:\"\";'),
(11, 'cms_settings', 'menu_limit', 's:1:\"7\";'),
(12, 'cms_settings', 'cropImages', 'N;'),
(13, 'cms_settings', 'comments', 'N;'),
(14, 'cms_settings', 'meta_title', 's:0:\"\";'),
(15, 'cms_settings', 'meta_key', 's:0:\"\";'),
(16, 'cms_settings', 'meta_desc', 's:0:\"\";'),
(17, 'cms_settings', 'watermark', 'N;'),
(18, 'cms_settings', 'blog_show_created', 's:1:\"0\";'),
(19, 'cms_settings', 'copyright_city', 's:26:\"в Новосибирскe\";'),
(20, 'cms_settings', 'favicon', 'N;'),
(21, 'cms_settings', 'privacy_policy', 's:0:\"\";'),
(22, 'cms_settings', 'privacy_policy_text', 's:230:\"<p>info@swanlake-online.com &mdash; электронная почта для обращений с вопросом о своих персональных данных, в том числе об их удалении.</p>\r\n<p></p>\";'),
(23, 'cms_settings', 'ymap_apikey', 's:0:\"\";'),
(24, 'cms_settings', 'sitemap_priority', 's:1:\"1\";'),
(25, 'cms_settings', 'sitemap_changefreq', 's:6:\"weekly\";'),
(26, 'cms_settings', 'sitemap_auto', 's:0:\"\";'),
(27, 'cms_settings', 'sitemap_auto_generate', 'i:0;'),
(28, 'cms_settings', 'slider_many', 'N;'),
(29, 'cms_settings', 'treemenu_fixed_id', 's:0:\"\";'),
(30, 'cms_settings', 'treemenu_show_id', 's:1:\"0\";'),
(31, 'cms_settings', 'treemenu_show_breadcrumbs', 's:1:\"0\";'),
(32, 'cms_settings', 'treemenu_depth', 's:1:\"1\";'),
(33, 'cms_settings', 'question_collapsed', 'N;'),
(34, 'cms_settings', 'shop_title', 'N;'),
(35, 'cms_settings', 'shop_pos_description', 'N;'),
(36, 'cms_settings', 'shop_enable_attributes', 'N;'),
(37, 'cms_settings', 'shop_enable_reviews', 'N;'),
(38, 'cms_settings', 'shop_enable_carousel', 'N;'),
(39, 'cms_settings', 'shop_enable_hit_on_top', 'N;'),
(40, 'cms_settings', 'shop_category_descendants_level', 'N;'),
(41, 'cms_settings', 'shop_enable_brand', 'N;'),
(42, 'cms_settings', 'shop_enable_old_price', 'N;'),
(43, 'cms_settings', 'shop_product_page_size', 'N;'),
(44, 'cms_settings', 'shop_show_categories', 'N;'),
(45, 'cms_settings', 'shop_menu_enable', 'N;'),
(46, 'cms_settings', 'shop_menu_level', 'i:1;'),
(47, 'cms_settings', 'gallery_title', 'N;'),
(48, 'cms_settings', 'gallery_on_page', 'N;'),
(49, 'cms_settings', 'events_title', 's:14:\"Новости\";'),
(50, 'cms_settings', 'events_link_all_text', 's:21:\"Все новости\";'),
(51, 'cms_settings', 'events_list_image_preview', 's:1:\"0\";'),
(52, 'cms_settings', 'events_limit', 's:2:\"12\";'),
(53, 'cms_settings', 'sale_title', 'N;'),
(54, 'cms_settings', 'sale_link_all_text', 'N;'),
(55, 'cms_settings', 'sale_preview_width', 'N;'),
(56, 'cms_settings', 'sale_preview_height', 'N;'),
(57, 'cms_settings', 'sale_meta_h1', 'N;'),
(58, 'cms_settings', 'sale_meta_title', 'N;'),
(59, 'cms_settings', 'sale_meta_key', 'N;'),
(60, 'cms_settings', 'sale_meta_desc', 'N;'),
(61, 'cms_settings', 'tinymce_adaptivy', 's:1:\"0\";'),
(62, 'cms_settings', 'tinymce_full_toolbars', 's:1:\"0\";'),
(63, 'cms_settings', 'tinymce_allow_scripts', 's:1:\"0\";'),
(64, 'cms_settings', 'tinymce_allow_iframe', 's:1:\"1\";'),
(65, 'cms_settings', 'tinymce_allow_object', 's:1:\"1\";'),
(66, 'cms_settings', 'seo_yandex_verification', 's:0:\"\";'),
(67, 'cms_settings', 'system_admins', 's:1:\"0\";'),
(68, 'cms_settings', 'system_slick', 's:1:\"0\";'),
(69, 'cms_settings', 'system_lazyload', 's:1:\"0\";'),
(70, 'cms_settings', 'recaptcha3_sitekey', 'N;'),
(71, 'cms_settings', 'recaptcha3_secretkey', 'N;'),
(72, 'cms_settings', 'recaptcha3_score', 'd:0.9;'),
(73, 'cms_settings', 'dev_year', 's:0:\"\";'),
(74, 'cms_settings', 'dev_year_to', 's:0:\"\";'),
(75, 'cms_settings', 'logo_header', 'N;'),
(76, 'cms_settings', 'logo_footer', 'N;'),
(77, 'cms_settings', 'show_socials', 's:1:\"0\";'),
(78, 'cms_settings', 'vk', 'N;'),
(79, 'cms_settings', 'odnoklassniki', 'N;'),
(80, 'cms_settings', 'instagram', 'N;'),
(81, 'cms_settings', 'facebook', 'N;'),
(82, 'cms_settings', 'show_messengers', 's:1:\"0\";'),
(83, 'cms_settings', 'whatsapp', 'N;'),
(84, 'cms_settings', 'telegram', 'N;'),
(85, 'cms_settings', 'viber', 'N;'),
(86, 'cms_settings', 'additional_phones', 's:0:\"\";'),
(87, 'cms_settings', 'additional_emails', 's:0:\"\";'),
(88, 'cms_settings', 'additional_address', 's:0:\"\";'),
(89, 'cms_settings', 'sitemap', 's:0:\"\";');

-- --------------------------------------------------------

--
-- Структура таблицы `sort_category`
--

CREATE TABLE `sort_category` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `key` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `sort_data`
--

CREATE TABLE `sort_data` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `order_number` int(11) NOT NULL,
  `level` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE `tbl_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1619581761),
('m140101_000100_create_blog_table', 1619581762),
('m140101_000200_create_event_table', 1619581762),
('m140101_000300_create_file_table', 1619581762),
('m140101_000400_create_image_table', 1619581762),
('m140101_000500_create_link_table', 1619581763),
('m140101_000600_create_menu_table', 1619581763),
('m140101_000700_create_metadata_table', 1619581763),
('m140101_000800_create_page_table', 1619581763),
('m140101_000900_create_settings_table', 1619581763),
('m140101_001000_create_question_table', 1619581764),
('m140101_001200_create_category_table', 1619581764),
('m140101_001300_create_product_table', 1619581765),
('m140101_001400_create_related_category_table', 1619581765),
('m140101_001500_create_product_review_table', 1619581765),
('m140101_001600_create_eav_attribute_table', 1619581765),
('m140101_001700_create_eav_value_table', 1619581766),
('m140101_001800_create_gallery_table', 1619581766),
('m140101_001900_create_gallery_img_table', 1619581766),
('m140101_002000_create_sale_table', 1619581766),
('m140101_002100_create_accordion_tables', 1619581767),
('m140101_002200_create_sort_tables', 1619581767),
('m140101_002300_create_brand_table', 1619581767),
('m140101_002400_create_order_customer_fields_table', 1619581768),
('m140101_002500_create_iblock_tables', 1619581771),
('m160415_115947_create_reviews_table', 1619581776),
('m170130_042939_create_seo_table', 1619581775),
('m170920_073717_add_privacy_policy_page', 1619581771),
('m180418_030107_add_show_categories_mode_to_category_table', 1619581771),
('m200623_043554_create_indexes', 1619581774),
('m201202_083051_create_article_table', 1619581774),
('m201207_033520_add_h1_visible_property', 1619581774),
('m201210_051112_update_index_page_h1_visible', 1619581774),
('m210322_032510_add_description_to_infoblock', 1619581775);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accordion`
--
ALTER TABLE `accordion`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `accordion_items`
--
ALTER TABLE `accordion_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `accordion_id` (`accordion_id`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `root` (`root`),
  ADD KEY `lft` (`lft`),
  ADD KEY `rgt` (`rgt`),
  ADD KEY `level` (`level`),
  ADD KEY `alias` (`alias`);

--
-- Индексы таблицы `eav_attribute`
--
ALTER TABLE `eav_attribute`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `eav_value`
--
ALTER TABLE `eav_value`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_attrs` (`id_attrs`),
  ADD KEY `id_product` (`id_product`),
  ADD KEY `id_product_id_attrs` (`id_product`,`id_attrs`);

--
-- Индексы таблицы `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publish` (`publish`),
  ADD KEY `alias` (`alias`);

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `model_item_id` (`model`,`item_id`);

--
-- Индексы таблицы `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alias` (`alias`),
  ADD KEY `preview_id` (`preview_id`);

--
-- Индексы таблицы `gallery_img`
--
ALTER TABLE `gallery_img`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_id` (`gallery_id`);

--
-- Индексы таблицы `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `model_item_id` (`model`,`item_id`);

--
-- Индексы таблицы `info_block`
--
ALTER TABLE `info_block`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq` (`title`);

--
-- Индексы таблицы `info_block_element`
--
ALTER TABLE `info_block_element`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_element` (`info_block_id`);

--
-- Индексы таблицы `info_block_element_prop`
--
ALTER TABLE `info_block_element_prop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `element_property_property` (`prop_id`),
  ADD KEY `element_property_element` (`element_id`);

--
-- Индексы таблицы `info_block_prop`
--
ALTER TABLE `info_block_prop`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq` (`info_block_id`,`code`);

--
-- Индексы таблицы `info_block_prop_value`
--
ALTER TABLE `info_block_prop_value`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq` (`prop_id`,`value_key`);

--
-- Индексы таблицы `link`
--
ALTER TABLE `link`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `metadata`
--
ALTER TABLE `metadata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner_name_owner_id` (`owner_name`,`owner_id`);

--
-- Индексы таблицы `order_customer_fields`
--
ALTER TABLE `order_customer_fields`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alias` (`alias`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alias` (`alias`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `hidden_category_id` (`hidden`,`category_id`);

--
-- Индексы таблицы `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `related_category`
--
ALTER TABLE `related_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_cp` (`category_id`,`product_id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `published` (`published`);

--
-- Индексы таблицы `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`),
  ADD KEY `alias` (`alias`);

--
-- Индексы таблицы `seo_seo`
--
ALTER TABLE `seo_seo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hash` (`hash`),
  ADD KEY `model_name_model_id` (`model_name`,`model_id`);

--
-- Индексы таблицы `services_pages`
--
ALTER TABLE `services_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sort` (`sort`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ukey` (`category`,`key`);

--
-- Индексы таблицы `sort_category`
--
ALTER TABLE `sort_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`key`),
  ADD KEY `name_2` (`name`);

--
-- Индексы таблицы `sort_data`
--
ALTER TABLE `sort_data`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_id` (`category_id`,`model_id`),
  ADD KEY `category_id_2` (`category_id`);

--
-- Индексы таблицы `tbl_migration`
--
ALTER TABLE `tbl_migration`
  ADD PRIMARY KEY (`version`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accordion`
--
ALTER TABLE `accordion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `accordion_items`
--
ALTER TABLE `accordion_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `eav_attribute`
--
ALTER TABLE `eav_attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `eav_value`
--
ALTER TABLE `eav_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `gallery_img`
--
ALTER TABLE `gallery_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `image`
--
ALTER TABLE `image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `info_block`
--
ALTER TABLE `info_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `info_block_element`
--
ALTER TABLE `info_block_element`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `info_block_element_prop`
--
ALTER TABLE `info_block_element_prop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `info_block_prop`
--
ALTER TABLE `info_block_prop`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `info_block_prop_value`
--
ALTER TABLE `info_block_prop_value`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `link`
--
ALTER TABLE `link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `metadata`
--
ALTER TABLE `metadata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `order_customer_fields`
--
ALTER TABLE `order_customer_fields`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `page`
--
ALTER TABLE `page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `related_category`
--
ALTER TABLE `related_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seo_seo`
--
ALTER TABLE `seo_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `services_pages`
--
ALTER TABLE `services_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT для таблицы `sort_category`
--
ALTER TABLE `sort_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `sort_data`
--
ALTER TABLE `sort_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `info_block_element`
--
ALTER TABLE `info_block_element`
  ADD CONSTRAINT `block_element` FOREIGN KEY (`info_block_id`) REFERENCES `info_block` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `info_block_element_prop`
--
ALTER TABLE `info_block_element_prop`
  ADD CONSTRAINT `element_property_element` FOREIGN KEY (`element_id`) REFERENCES `info_block_element` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `element_property_property` FOREIGN KEY (`prop_id`) REFERENCES `info_block_prop` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `info_block_prop`
--
ALTER TABLE `info_block_prop`
  ADD CONSTRAINT `block_property` FOREIGN KEY (`info_block_id`) REFERENCES `info_block` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `sort_data`
--
ALTER TABLE `sort_data`
  ADD CONSTRAINT `sort_data_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `sort_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
