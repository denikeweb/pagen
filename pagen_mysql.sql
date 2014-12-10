SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
SET NAMES utf8;

--
-- Структура таблицы `pagen_blog`
--

CREATE TABLE IF NOT EXISTS `pagen_blog` (
  `blog_id` int(11) NOT NULL AUTO_INCREMENT,
  `blog_url` varchar(50) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_desc` text NOT NULL,
  `blog_text` text NOT NULL,
  PRIMARY KEY (`blog_id`),
  UNIQUE KEY `blog_url` (`blog_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Дамп данных таблицы `pagen_blog`
--

INSERT INTO `pagen_blog` (`blog_id`, `blog_title`, `blog_desc`, `blog_text`, `blog_url`) VALUES
(1,  'Demo note', 'This is my test article', 'This is lorem ipsum for my first test article in PaGen. This is lorem ipsum for my first test article in PaGen. This is lorem ipsum for my first test article in PaGen. This is lorem ipsum for my first test article in PaGen.', 'demo-note'),
(2,  'Note2',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note2'),
(3,  'Note3',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note3'),
(4,  'Note4',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note4'),
(5,  'Note5',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note5'),
(6,  'Note6',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note6'),
(7,  'Note7',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note7'),
(8,  'Note8',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note8'),
(9,  'Note9',  'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note9'),
(10, 'Note10', 'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note10'),
(11, 'Note11', 'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note11'),
(12, 'Note12', 'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note12'),
(13, 'Note13', 'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note13'),
(14, 'Note14', 'Lorem ipsum for note description', 'This is lorem ipsum for my test article in PaGen', 'note14');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages`
--

CREATE TABLE IF NOT EXISTS `pagen_pages` (
  `pages_id` int(5) NOT NULL AUTO_INCREMENT,
  `pages_url` varchar(100) NOT NULL,
  `pages_child` int(5) DEFAULT NULL,
  PRIMARY KEY (`pages_id`),
  UNIQUE KEY `pages_url` (`pages_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pagen_pages`
--

INSERT INTO `pagen_pages` (`pages_id`, `pages_url`, `pages_child`) VALUES
(1, 'page1', 0),
(2, 'page2', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages_content`
--

CREATE TABLE IF NOT EXISTS `pagen_pages_content` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pagen_pages_content`
--

INSERT INTO `pagen_pages_content` (`pages_id`, `uk`, `ru`, `en`) VALUES
(1, 'Текст сторінки 1', 'Текст страницы 1', 'Page 1 contents'),
(2, 'Текст сторінки 2', 'Текст страницы 2', 'Page 2 contents');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages_meta_d`
--

CREATE TABLE IF NOT EXISTS `pagen_pages_meta_d` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pagen_pages_meta_d`
--

INSERT INTO `pagen_pages_meta_d` (`pages_id`, `uk`, `ru`, `en`) VALUES
(1, 'Мета-теги сторінки 1', 'Мета-теги страницы 1', 'Page 1 meta tag'),
(2, 'Мета-теги сторінки 2', 'Мета-теги страницы 2', 'Page 2 meta tag');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages_meta_k`
--

CREATE TABLE IF NOT EXISTS `pagen_pages_meta_k` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pagen_pages_meta_k`
--

INSERT INTO `pagen_pages_meta_k` (`pages_id`, `uk`, `ru`, `en`) VALUES
(1, 'СТорінка 1, мета-тег', 'Страница 1, мета-тег', 'Page 1, meta tag'),
(2, 'СТорінка 2, мета-тег', 'Страница 2, мета-тег', 'Page 2, meta tag');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages_titles`
--

CREATE TABLE IF NOT EXISTS `pagen_pages_titles` (
  `pages_id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` varchar(255) NOT NULL,
  `ru` varchar(255) NOT NULL,
  `en` varchar(255) NOT NULL,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `pagen_pages_titles`
--

INSERT INTO `pagen_pages_titles` (`pages_id`, `uk`, `ru`, `en`) VALUES
(1, 'Сторінка 1', 'Страница 1', 'Page 1'),
(2, 'Сторінка 2', 'Страница 2', 'Page 2');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_users`
--

CREATE TABLE IF NOT EXISTS `pagen_users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_url` varchar(50) NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `users_url` (`users_url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pagen_users`
--

INSERT INTO `pagen_users` (`users_id`, `users_url`) VALUES
(1, 'admin'),
(2, 'ant'),
(3, 'user1'),
(4, 'user2'),
(5, 'user3');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_users_data`
--

CREATE TABLE IF NOT EXISTS `pagen_users_data` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_email` varchar(50) NOT NULL,
  `users_pass` varchar(255) NOT NULL,
  `users_rights` tinyint(4) NOT NULL,
  `users_name` varchar(50) NOT NULL,
  PRIMARY KEY (`users_id`),
  UNIQUE KEY `users_email` (`users_email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `pagen_users_data`
--

INSERT INTO `pagen_users_data` (`users_id`, `users_email`, `users_pass`, `users_rights`, `users_name`) VALUES
(1, 'admin@mysite.com', 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s=', 6, 'Administator'),
(2, 'ant@mysite.com', 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s=', 1, 'Antella Johnson'),
(3, 'user1@mysite.com', 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s=', 1, 'User1'),
(4, 'user2@mysite.com', 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s=', 1, 'User2'),
(5, 'user3@mysite.com', 'w9Kec/J4OmCehhZYpu7iNKnHScVgaWmdAIJiPJF9h6s=', 1, 'User3');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `pagen_pages`
--
ALTER TABLE `pagen_pages`
  ADD CONSTRAINT `pagen_pages_ibfk_1` FOREIGN KEY (`pages_id`) REFERENCES `pagen_pages_titles` (`pages_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagen_pages_ibfk_2` FOREIGN KEY (`pages_id`) REFERENCES `pagen_pages_content` (`pages_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagen_pages_ibfk_3` FOREIGN KEY (`pages_id`) REFERENCES `pagen_pages_meta_k` (`pages_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pagen_pages_ibfk_4` FOREIGN KEY (`pages_id`) REFERENCES `pagen_pages_meta_d` (`pages_id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pagen_users`
--
ALTER TABLE `pagen_users`
  ADD CONSTRAINT `pagen_users_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `pagen_users_data` (`users_id`) ON UPDATE CASCADE;
