-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 18 2014 г., 00:03
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `awm_001`
--

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_alerts`
--

CREATE TABLE IF NOT EXISTS `pagen_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` varchar(255) NOT NULL,
  `ru` varchar(255) NOT NULL,
  `en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `pagen_alerts`
--

INSERT INTO `pagen_alerts` (`id`, `uk`, `ru`, `en`) VALUES
(1, 'Помилка при введенні e-mail', 'Ошибка при вводе e-mail', 'E-mail is not correct'),
(2, 'Паролі не співпадають', 'Пароли не совпадают', 'Password do not much'),
(3, 'Логін не може бути коротше 4-х символів', 'Логин не может быть короче 4-х символов', 'Login must contains more than 4 words'),
(4, 'Пароль не може бути коротше 6-ти символів', 'Пароль не может быть короче 6-ти символов', 'Pass must contains more than 6 words'),
(5, 'Ви успішно зареєстувались', 'Регистрация прошла успешно', 'Registration successfully'),
(6, 'Помилка системи', 'Ошибка системы', 'System error'),
(7, 'Користувач з таким логіном вже існує', 'Пользователь с таким логином уже существует', 'User with this login exist'),
(8, 'Невірна комбінація логіну та паролю', 'Неправильный логин или пароль', 'Wrong login/password'),
(9, 'Неіснуючий e-mail', 'Несуществующий e-mail', 'E-mail doesn''t exist'),
(10, 'Лист з паролем надіслано на вказаний e-mail', 'Письмо с паролем отправлено на указаный e-mail', 'Letter with password send to yours e-mail'),
(11, 'Помилка сервера при надсиланні провідомлення', 'Ошибка сервера при отправке сообщения', 'A server error occurred while sending a message'),
(12, 'Користувача з таким e-mail не існує', 'Пользователя с таким e-mail не существует', 'User with same name not exist'),
(13, 'Змінити реєстраційні дані', 'Изменить регистрационные данные', 'Change registration data'),
(14, 'Зміни успішно збережені', 'Изменения успешно сохранены', 'Changes successfully saved'),
(15, 'Змінити пароль', 'Изменить пароль', 'Change password'),
(16, 'Коректувати адреси і телефони', 'Изменить адреса и телефоны', 'Change adress and phone number'),
(17, 'Пароль успішно змінено', 'Пароль успешно изменен', 'Password successfully changed'),
(18, 'Помилка! Ви не авторизовані!', 'Ошибка! Вы не авторизированы!', 'Error! You are not logged in!'),
(19, 'Дані успішно збережені', 'Данные успешно сохранены', 'Data has been successfully saved'),
(20, 'Помилка при введенні старого паролю', 'Ошибка при введении старого пароля', 'Error with the introduction of the old password'),
(21, 'Помилка при введенні паролю', 'Ошибка при введении пароля', 'An error occurred while setting the password'),
(22, 'Невірний формат паролю', 'Неправильный формат пароля', 'Wrong password format'),
(23, 'Невірний формат логіну', 'Неправильный формат логина', 'Wrong login format'),
(24, 'Невірний формат даних', 'Неправильный формат данных', 'Wrong data format');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_blog`
--

CREATE TABLE IF NOT EXISTS `pagen_blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `pagen_blog`
--

INSERT INTO `pagen_blog` (`id`, `title`, `desc`, `text`) VALUES
(1, 'Article1', 'This is my test article', 'This is lorem ipsum for my first test article in PaGen'),
(2, 'My Article/ for Pagen', 'This is my test article...', 'This is lorem ipsum for my first test article in PaGen'),
(3, 'My Article/ for Pagen', '', 'Ha! It''s mine text'),
(4, 'My Article/ for Pagen', '', 'Ha! It''s mine text'),
(7, 'Add''s -> 50', '', 'Ha! It''s mine text'),
(8, 'Add''s -> 0', '', 'Ha! It''s mine text'),
(9, 'Add''s -> 48', '', 'Ha! It''s mine text'),
(10, 'Add''s -> 29', '', 'Ha! It''s mine text'),
(11, 'Add''s -> 28', '', 'Ha! It''s mine text');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_content`
--

CREATE TABLE IF NOT EXISTS `pagen_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pagen_content`
--

INSERT INTO `pagen_content` (`id`, `uk`, `ru`, `en`) VALUES
(0, 'Інформацію не знайдено!', 'Информация не найдена!', 'Content is not found!'),
(1, '<h1 class="h1">Головна</h1>\n<span class="h1_after"></span>\n<p>Pagen - це простий і елегантний каркас для сайту. Він допомагає спростити роботу над проектом, в якому необхідний функціонал потрібно писати "з нуля", за рахунок генерації сторінок з використанням ЧПУ, налаштування багатомовності за необхідності, а також за рахунок вже налаштованого механізму авторизації на основі сесій.</p>\n<p>Стандартний дизайн можна змінити, редагуючи файл з класом у папці template. Фреймворк написаний на PHP, для роботи з AJAX використовується бібліотека JSHttpRequest. Файли для AJAX-запитів міститися з папці backend. Змінювати класи можна редагуючи файли в папці class.</p>\n', '<h1 class="h1">Главная</h1><span class="h1_after"></span>\n<p>Pagen - это простой и элегантный каркас для сайта. Он помогает упростить работу над проектом, в котором необходимый функционал нужно писать "с нуля", за счет генерации страниц с использованием ЧПУ, настройки многоязычности при необходимости, а также за счет уже настроенного механизма авторизации на основе сессий.</p>\n<p>Стандартный дизайн можно изменить, редактируя файл с классом в папке template. Фреймворк написан на PHP, для работы с AJAX используется библиотека JSHttpRequest. Файлы для AJAX-запросов содержаться с папке backend. Изменять классы можно редактируя файлы в папке class.</p>', '<h1 class="h1">Home page</h1><span class="h1_after"></span>\n<p>Pagen - is a simple and elegant framework for the site. It helps simplify the work with project when  required functionality necessary to write from scratch, due to the generation of pages with userfriendly URL, settings multilingualism possibility, configured sessions authorization.</p>\n<p>Standard design can be changed by editing the file in the folder template with the needed class. Framework written in PHP, JSHttpRequest library is used for AJAX. A folder backend contain files with AJAX-requests. Also, you can change classes by editing the files in the folder class.</p>'),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', ''),
(5, 'second', 'second', 'second'),
(6, 'first', 'first', 'first');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_meta_d`
--

CREATE TABLE IF NOT EXISTS `pagen_meta_d` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pagen_meta_d`
--

INSERT INTO `pagen_meta_d` (`id`, `uk`, `ru`, `en`) VALUES
(0, 'Інформацію не знайдено!', 'Информация не найдена!', 'Content is not found!'),
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_meta_k`
--

CREATE TABLE IF NOT EXISTS `pagen_meta_k` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` text NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `pagen_meta_k`
--

INSERT INTO `pagen_meta_k` (`id`, `uk`, `ru`, `en`) VALUES
(0, 'Інформацію не знайдено!', 'Информация не найдена!', 'Content is not found!'),
(1, '', '', ''),
(2, '', '', ''),
(3, '', '', ''),
(4, '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_pages`
--

CREATE TABLE IF NOT EXISTS `pagen_pages` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `cpurl` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `hor_menu` int(5) NOT NULL DEFAULT '0',
  `show` int(2) NOT NULL,
  `static` int(1) NOT NULL DEFAULT '1',
  `template` varchar(255) NOT NULL DEFAULT 'index',
  `child` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`,`title`),
  UNIQUE KEY `url_2` (`url`),
  KEY `url_3` (`url`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `pagen_pages`
--

INSERT INTO `pagen_pages` (`id`, `url`, `cpurl`, `title`, `hor_menu`, `show`, `static`, `template`, `child`) VALUES
(0, '404.php', '404', '2', 0, 0, 1, 'index', ''),
(1, 'index.php', '/', '1', 1, 1, 1, 'index', ''),
(2, 'sign_up.php', 'sign_up', '3', 3, 0, 0, 'index', ''),
(3, 'remind.php', 'remind', '8', 4, 1, 0, 'index', ''),
(4, 'cabinet.php', 'cabinet', '9', 2, 2, 0, 'index', ''),
(5, '1', 'second', '1', 1, 1, 1, 'index', ''),
(6, 'first.php', 'first', '1', 1, 1, 1, 'index', 'second');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_titles`
--

CREATE TABLE IF NOT EXISTS `pagen_titles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uk` varchar(255) NOT NULL,
  `ru` varchar(255) NOT NULL,
  `en` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `pagen_titles`
--

INSERT INTO `pagen_titles` (`id`, `uk`, `ru`, `en`) VALUES
(0, '© 2013 розробка Драгомирика Дениса, студія <a href="//web-mount.com" title="Web-Mount">Web-Mount</a>. Всі права захищені. PaGen доступний для використання та модифікації під ліцензією MIT.', '© 2013 разработал Драгомирик Денис, студия <a href="//web-mount.com" title="Web-Mount">Web-Mount</a>. Все права защищены. PaGen доступен для использования и модификации под лицензией MIT.', '© 2013 developed by Denis Dragomiric, <a href="//web-mount.com" title="Web-Mount">Web-Mount</a> Studio. All rights reserved. PaGen allowed for using and modification by MIT license.'),
(1, 'Головна', 'Главная', 'Home'),
(2, '404', '404', '404'),
(3, 'Реєстрація', 'Регистрация', 'Registration'),
(4, 'Вхід', 'Вход', 'Sign in'),
(5, 'Логін', 'Логин', 'Login'),
(6, 'Пароль', 'Пароль', 'Password'),
(7, 'Повторити пароль', 'Повторите пароль', 'Repeat Password'),
(8, 'Нагадати пароль', 'Восстановить пароль', 'Recover password'),
(9, 'Кабінет', 'Кабинет', 'Account'),
(10, 'Ви увійшли як', 'Вы вошли как', 'You are logged in as'),
(11, 'Надіслати', 'Отправить', 'Send'),
(12, 'Вийти', 'Выйти', 'Log out'),
(13, 'Ви не можете переглядати дану сторінку - авторизуйтесь, будь ласка.', 'Для просмотра страницы нужна авторизация', 'Authorisation is nessesary to view this page'),
(14, 'Зберегти', 'Сохранить', 'Save'),
(15, 'Старий пароль', 'Старый пароль', 'Old password'),
(16, 'Новий пароль', 'Новый пароль', 'New password'),
(17, 'Форма входу', 'Форма входа', 'Entering form'),
(18, 'Змінити реєстраційні дані', 'Изменить регистрационные данные', 'Change registration data'),
(19, 'Змінити пароль', 'Изменить пароль', 'Change password');

-- --------------------------------------------------------

--
-- Структура таблицы `pagen_users`
--

CREATE TABLE IF NOT EXISTS `pagen_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pass` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `rights` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `pagen_users`
--

INSERT INTO `pagen_users` (`id`, `login`, `pass`, `email`, `rights`) VALUES
(1, 'admin', '9GGm6GmcSGaHXiGD8dNuG44R21eRYtiqRhDJ46PBSJCZY', 'admin@mysite.org', 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
