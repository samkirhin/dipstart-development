-- phpMyAdmin SQL Dump
-- version 3.3.7deb7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Сен 05 2015 г., 16:20
-- Версия сервера: 5.5.40
-- Версия PHP: 5.4.36-0+deb7u1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `1_Moderate`
--

CREATE TABLE IF NOT EXISTS `1_Moderate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL COMMENT 'имя класса модерируемой модели',
  `id_record` int(11) NOT NULL COMMENT 'ид записи в таблице',
  `attribute` varchar(255) NOT NULL COMMENT 'имя атррибута',
  `old_value` text COMMENT 'Старое значение',
  `new_value` text COMMENT 'Новое значение',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=115 ;

--
-- Дамп данных таблицы `1_Moderate`
--


-- --------------------------------------------------------

--
-- Структура таблицы `1_Payment`
--

CREATE TABLE IF NOT EXISTS `1_Payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `summ` float(10,2) DEFAULT NULL,
  `details_ya` varchar(255) DEFAULT NULL,
  `details_wm` varchar(255) DEFAULT NULL,
  `details_bank` text,
  `payment_type` tinyint(1) DEFAULT NULL,
  `approve` tinyint(1) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=106 ;

--
-- Дамп данных таблицы `1_Payment`
--

INSERT INTO `1_Payment` (`id`, `order_id`, `receive_date`, `pay_date`, `theme`, `manager`, `user`, `summ`, `details_ya`, `details_wm`, `details_bank`, `payment_type`, `approve`, `method`) VALUES
(1, 2, '2015-08-05', '2015-08-15', 'тест  тест тест тест тест тест тест тест тест тест тест тест ', 'webmaster@example.com', 'zak4test560105@mail.ru', 10000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(2, 2, '2015-08-07', '2015-08-07', 'тест  тест тест тест тест тест тест тест тест тест тест тест ', 'webmaster@example.com', 'zak4test560105@mail.ru', 500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(3, 3, '2015-08-09', '2015-08-09', 'Инвестиции на развитие шмитрикса 2.0', 'webmaster@example.com', 'zak4test560105@mail.ru', 7500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(4, 3, '2015-08-09', '2015-08-09', 'Инвестиции на развитие шмитрикса 2.0', 'webmaster@example.com', 'zak4test560105@mail.ru', 7500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(5, 3, '2015-08-09', '2015-08-09', 'Инвестиции на развитие шмитрикса 2.0', 'webmaster@example.com', 'coolfire@inbox.ru', 8000.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 1, 'Bank'),
(6, 2, '2015-08-11', '2015-08-28', 'тест  тест тест тест тест тест тест тест тест тест тест тест ', 'webmaster@example.com', 'zak4test560105@mail.ru', -10000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(7, 2, '2015-08-11', '2015-08-15', 'тест  тест тест тест тест тест тест тест тест тест тест тест ', 'webmaster@example.com', 'zak4test560105@mail.ru', -1000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(8, 6, '2015-08-12', '2015-08-28', 'Админтрикс система контроля', 'webmaster@example.com', 'zak4test560105@mail.ru', 5000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(9, 6, '2015-08-12', NULL, 'Админтрикс система контроля', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(10, 6, '2015-08-12', NULL, 'Админтрикс система контроля', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(11, 44, '2015-08-18', NULL, 'Заказ на сайт', 'webmaster@example.com', 'zak4test560105@mail.ru', 10.00, NULL, NULL, NULL, 0, 0, NULL),
(12, 45, '2015-08-18', NULL, 'Разработка сайта', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(13, 45, '2015-08-18', NULL, 'Разработка сайта', 'webmaster@example.com', 'zak4test560105@mail.ru', 2499.00, NULL, NULL, NULL, 0, 0, NULL),
(14, 53, '2015-08-19', NULL, 'Разработать план продвижения дипстарт', 'webmaster@example.com', 'zak4test560105@mail.ru', 5000.00, NULL, NULL, NULL, 0, 0, NULL),
(15, 53, '2015-08-19', '2015-08-23', 'Разработать план продвижения дипстарт', 'webmaster@example.com', 'zak4test560105@mail.ru', 5000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(16, 55, '2015-08-20', '2015-08-20', 'Перевести рассказ на английский', 'webmaster@example.com', 'mr.serpukhovskoy@mail.ru', 6000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(17, 55, '2015-08-20', '2015-08-20', 'Перевести рассказ на английский', 'webmaster@example.com', 'mr.serpukhovskoy@mail.ru', 6000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(18, 55, '2015-08-20', '2015-08-20', 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 4000.00, '2147483647', '456456456456', '', 1, 1, 'Ya.money'),
(19, 55, '2015-08-20', '2015-08-23', 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 4000.00, '2147483647', '456456456456', '', 1, 1, 'Cash'),
(20, 55, '2015-08-20', '2015-08-23', 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 4000.00, '2147483647', '456456456456', '', 1, 1, 'Cash'),
(21, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 4000.00, '2147483647', '456456456456', '', 1, 0, NULL),
(22, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 1.00, '2147483647', '456456456456', '', 1, 0, NULL),
(23, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 1.00, '2147483647', '456456456456', '', 1, 0, NULL),
(24, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 1.00, '2147483647', '456456456456', '', 1, 0, NULL),
(25, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 555.00, '2147483647', '456456456456', '', 1, 0, NULL),
(26, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 555.00, '2147483647', '456456456456', '', 1, 0, NULL),
(27, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 5000.00, '2147483647', '456456456456', '', 1, 0, NULL),
(28, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 4000.00, '2147483647', '456456456456', '', 1, 0, NULL),
(29, 55, '2015-08-20', NULL, 'Перевести рассказ на английский', 'webmaster@example.com', 'autobot509.63@gmail.com', 5000.00, '2147483647', '456456456456', '', 1, 0, NULL),
(30, 37, '2015-08-20', NULL, 'tyuiop', 'webmaster@example.com', 'zak4test560105@mail.ru', 50.00, NULL, NULL, NULL, 0, 0, NULL),
(31, 57, '2015-08-20', NULL, 'логистика', 'webmaster@example.com', 'velodov@mail.ru', 8500.00, NULL, NULL, NULL, 0, 0, NULL),
(32, 59, '2015-08-22', NULL, 'Оптимизация внутренних страниц (а так-же очистка от пере-спама)', 'webmaster@example.com', 'monty28.ua@mail.ru', 2000.00, NULL, NULL, NULL, 0, 0, NULL),
(33, 60, '2015-08-22', NULL, 'Помыть полы в квартире', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(34, 67, '2015-08-22', NULL, 'Реализовать систему оповещений о получении сообщения в чате.', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(35, 69, '2015-08-22', NULL, 'Исправить ошибку отправки сообщений в чате менеджером.', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(36, 71, '2015-08-22', NULL, 'Исправить баг с даблкликом', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(37, 73, '2015-08-22', NULL, 'Править таблицу информации о заказе, выдаваемую после регистрации заказа', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(38, 70, '2015-08-23', NULL, 'Заполнить интернет магазин товарами ', 'webmaster@example.com', 'rembrant122@gmail.com', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(39, 76, '2015-08-23', NULL, 'Разработать план продвижения дипстарт', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(40, 71, '2015-08-23', '2015-08-23', 'Исправить баг с даблкликом', 'webmaster@example.com', 'ako40ff@gmail.com', 1.00, '0', '', '', 1, 1, 'Cash'),
(41, 66, '2015-08-23', NULL, 'Анализ позиций по продвигаемым запросам', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(42, 65, '2015-08-23', NULL, 'Закупка ссылочной массы', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(43, 64, '2015-08-23', NULL, 'Проведение перелинковки страниц', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(44, 77, '2015-08-23', NULL, 'Реализовать многоязычность в админке', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(45, 78, '2015-08-23', NULL, 'Реализовать автоматизированную регистрацию компаний', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(46, 67, '2015-08-23', NULL, 'Реализовать систему оповещений о получении сообщения в чате.', 'webmaster@example.com', 'coolfire@inbox.ru', 50.00, '12345', '111111111', 'test_bank_acc', 1, 0, NULL),
(47, 79, '2015-08-24', NULL, 'Добавить галочку "Требуется тех. специалист"', 'webmaster@example.com', 'monty28.ua@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(48, 81, '2015-08-24', NULL, 'Тест', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(49, 82, '2015-08-24', NULL, 'Написать 3 текста на страницы сайта', 'webmaster@example.com', 'zak4test560105@mail.ru', 3000.00, NULL, NULL, NULL, 0, 0, NULL),
(50, 79, '2015-08-26', NULL, 'Добавить галочку "Требуется тех. специалист"', 'webmaster@example.com', NULL, 1000.00, NULL, NULL, NULL, 1, 0, NULL),
(51, 45, '2015-08-28', NULL, 'Разработка сайта', 'webmaster@example.com', 'zak4test560105@mail.ru', 2500.00, NULL, NULL, NULL, 0, 0, NULL),
(52, 88, '2015-08-29', NULL, 'Лендинг для сервиса Pesatu', 'webmaster@example.com', 'rembrant122@gmail.com', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(53, 88, '2015-08-29', NULL, 'Лендинг для сервиса Pesatu', 'webmaster@example.com', 'rembrant122@gmail.com', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(54, 90, '2015-08-29', NULL, 'Pesatu: на емаил пароль не приходит', 'webmaster@example.com', 'rembrant122@gmail.com', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(55, 87, '2015-08-30', NULL, 'Тестирование  проекта Pesatu', 'webmaster@example.com', 'rembrant122@gmail.com', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(56, 89, '2015-08-30', NULL, 'Страница для перехода по реф ссылке по проекту Pesatu', 'webmaster@example.com', 'rembrant122@gmail.com', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(57, 96, '2015-08-30', NULL, 'Сделать системные сообщения', 'webmaster@example.com', 'monty28.ua@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(58, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', NULL, 10000.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(59, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', NULL, 320000.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(60, 97, '2015-08-30', NULL, 'Крещение руси 882 года ', 'webmaster@example.com', NULL, 500.00, NULL, NULL, NULL, 1, 0, NULL),
(61, 97, '2015-08-30', NULL, 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 6500000.00, NULL, NULL, NULL, 0, 0, NULL),
(62, 97, '2015-08-30', NULL, 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 319500.00, '0', '12312355', '12312351', 1, 0, NULL),
(63, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 7500.00, '0', '12312355', '12312351', 1, 1, 'Cash'),
(64, 98, '2015-08-30', NULL, 'IRc', 'webmaster@example.com', 'Zakaz937@mail.ru', 9000.00, NULL, NULL, NULL, 0, 0, NULL),
(65, 98, '2015-08-30', NULL, 'IRc', 'webmaster@example.com', 'Zakaz937@mail.ru', 9000.00, NULL, NULL, NULL, 0, 0, NULL),
(66, 66, '2015-08-30', '2015-08-30', 'Анализ позиций по продвигаемым запросам', 'webmaster@example.com', 'monty28.ua@mail.ru', 400.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(67, 66, '2015-08-30', '2015-08-30', 'Анализ позиций по продвигаемым запросам', 'webmaster@example.com', 'monty28.ua@mail.ru', 500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(68, 66, '2015-08-30', '2015-08-30', 'Анализ позиций по продвигаемым запросам', 'webmaster@example.com', 'monty28.ua@mail.ru', 1000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(69, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 5000.00, '0', '12312355', '12312351', 1, 1, 'Cash'),
(70, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 9000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(71, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 5000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(72, 99, '2015-08-30', '2015-08-30', 'Починить бухгалтерию', 'webmaster@example.com', 'monty28.ua@mail.ru', 600.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(73, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 14000.00, '0', '12312355', '12312351', 1, 1, 'Cash'),
(74, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 14000.00, '0', '12312355', '12312351', 1, 1, 'Cash'),
(75, 98, '2015-08-30', '2015-08-30', 'IRc', 'webmaster@example.com', 'Zakaz937@mail.ru', 5000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(76, 70, '2015-08-30', '2015-08-30', 'Заполнить интернет магазин товарами ', 'webmaster@example.com', 'rembrant122@gmail.com', 750.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(77, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 10500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(78, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 5000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(79, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 5000.00, '0', '', '', 1, 1, 'Cash'),
(80, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 5000.00, '0', '', '', 1, 1, 'Cash'),
(81, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 500.00, '0', '', '', 1, 1, 'Cash'),
(82, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 14000.00, '0', '', '', 1, 1, 'Cash'),
(83, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 50000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(84, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 6579500.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(85, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', -13159000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(86, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 5000.00, '0', '', '', 1, 1, 'Cash'),
(87, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 2.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(88, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 937.00, '0', '', '', 1, 1, 'Cash'),
(89, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 3.00, '0', '', '', 1, 1, 'Cash'),
(90, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Zakaz937@mail.ru', 3.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(91, 97, '2015-08-30', '2015-08-30', 'Крещение руси 882 года ', 'webmaster@example.com', 'Ppbdsvs1@mail.ru', 3.00, '0', '', '', 1, 1, 'Cash'),
(92, 106, '2015-08-30', '2015-08-31', 'Исправить баги средней срочности #3', 'webmaster@example.com', 'monty28.ua@mail.ru', 750.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(93, 108, '2015-08-30', '2015-08-31', 'Исправить баги #2', 'webmaster@example.com', 'monty28.ua@mail.ru', 750.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(94, 109, '2015-08-30', '2015-08-31', 'Исправить баги #3', 'webmaster@example.com', 'monty28.ua@mail.ru', 375.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(95, 101, '2015-08-30', '2015-08-31', 'Исправить срочные баги', 'webmaster@example.com', 'monty28.ua@mail.ru', 750.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(96, 102, '2015-08-30', '2015-08-31', 'Исправить срочные баги', 'webmaster@example.com', 'monty28.ua@mail.ru', 1000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(97, 103, '2015-08-30', '2015-08-31', 'Исправить срочные баги #3', 'webmaster@example.com', 'monty28.ua@mail.ru', 600.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(98, 104, '2015-08-30', '2015-08-31', 'Исправить баги средней срочности #1', 'webmaster@example.com', 'monty28.ua@mail.ru', 1000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(99, 105, '2015-08-30', '2015-08-31', 'Исправить баги средней срочности #2', 'webmaster@example.com', 'monty28.ua@mail.ru', 750.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(100, 107, '2015-08-30', '2015-08-31', 'Исправить баги #1', 'webmaster@example.com', 'monty28.ua@mail.ru', 600.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(101, 110, '2015-08-30', '2015-08-31', 'Выполнить задачи по фронтенду', 'webmaster@example.com', 'monty28.ua@mail.ru', 1000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(102, 111, '2015-09-02', NULL, 'Верстка и программирование сайта ', 'webmaster@example.com', 'ast4@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(103, 113, '2015-09-03', NULL, 'Наладить вывод текстов через стандартный механизм "Yii::t()?"', 'webmaster@example.com', 'monty28.ua@mail.ru', 1250.00, NULL, NULL, NULL, 0, 0, NULL),
(104, 118, '2015-09-04', NULL, 'Выполнить задачи по фронтенду', 'webmaster@example.com', 'monty28.ua@mail.ru', 800.00, NULL, NULL, NULL, 0, 0, NULL),
(105, 70, '2015-09-04', NULL, 'Заполнить интернет магазин товарами ', 'webmaster@example.com', 'anton1996nk@gmail.com', 750.00, '0', '628598656063', '', 1, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `1_PaymentImage`
--

CREATE TABLE IF NOT EXISTS `1_PaymentImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `1_PaymentImage`
--

INSERT INTO `1_PaymentImage` (`id`, `project_id`, `image`, `approved`) VALUES
(3, 6, '007db803d094d10b5e67a1888a56bc3b.png', 1),
(4, 6, '279e0d813080ba18db11ba35c4894aa9.jpg', 1),
(8, 6, '0c2a54134e53c74d03539654c3917844.png', 1),
(9, 45, '620c160bfa6bee7da238e163b4879ef2.png', 1),
(10, 53, '4fe4cba64386556564494599c66023cb.png', 1),
(11, 53, '0196a07d829c5db0aa14749a95404793.png', 1),
(12, 55, '893b3cd6245cdd9abe5728516977b9db.jpeg', 1),
(13, 57, '04a713e1429f297aa1d72f86b6f631ba.jpg', 1),
(14, 62, '1e178dd096e0658854604bf5b9783eb0.jpg', 0),
(15, 79, '67c8c8f4a40e9d796a8f3743a30f6db3.JPG', 1),
(16, 82, '43ad0ee1fff3f164936f82d6da741811.JPG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `1_Profiles`
--

CREATE TABLE IF NOT EXISTS `1_Profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользовтеля',
  `skype` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `work_experience` varchar(20) NOT NULL DEFAULT '',
  `fl_acc` mediumtext NOT NULL,
  `mailing_list` int(10) NOT NULL DEFAULT '0',
  `wmr` varchar(13) NOT NULL DEFAULT '',
  `yandex` int(13) NOT NULL DEFAULT '0',
  `how_hear` varchar(255) NOT NULL DEFAULT '',
  `additional` varchar(255) NOT NULL DEFAULT '',
  `rating` int(3) DEFAULT NULL,
  `bank_account` varchar(255) NOT NULL DEFAULT '',
  `specials` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Профили пользователей' AUTO_INCREMENT=123 ;

--
-- Дамп данных таблицы `1_Profiles`
--

INSERT INTO `1_Profiles` (`user_id`, `skype`, `city`, `work_experience`, `fl_acc`, `mailing_list`, `wmr`, `yandex`, `how_hear`, `additional`, `rating`, `bank_account`, `specials`) VALUES
(1, '', 'Москва', '', '', 0, '', 0, 'mk.ru', '', NULL, '', ''),
(2, '', 'Москва', '', '', 0, '', 0, 'mk.ru', '', NULL, '', ''),
(3, '', 'Москва', '', '', 0, '', 0, 'google.com', '', NULL, '', ''),
(4, '', 'kiev', '', '', 0, '', 0, 'df', '', 86, '', ''),
(11, '', 'Москва', '', '', 0, '', 0, 'угадал', '', NULL, '', ''),
(12, '', 'Москва', '', '', 0, '', 0, 'ewewqewq', '', NULL, '', ''),
(14, 'coolfire126', 'Керчь', '', '', 0, '111111111', 12345, 'БСЭ', '', -2, 'test_bank_acc', '12,22'),
(15, '', 'Москва', '12', '0', 0, '', 0, 'ааа ', '', -8, '', ''),
(16, '', 'Москва', '5', '0', 0, '', 0, 'по телевизору', 'нечего', 5, '', ''),
(17, '', 'Москва', '', '', 0, '', 0, 'ewewqewq', '', NULL, '', ''),
(19, '', 'Москва', '', '', 0, '', 0, 'Нашла в интернете', '', NULL, '', ''),
(22, '3434', 'Москва', '', '', 0, '', 0, 'Дядя федя', '', NULL, '', ''),
(23, 'Moscow boy', 'Moscow', '', '', 0, '', 0, 'Test', '', NULL, '', ''),
(24, 'нет', 'Москва', '15 лет', '0', 0, '456456456456', 2147483647, 'Дипломные, курсовые работы и диссертации на заказ.', '', 12, '', ''),
(25, '', 'Орел', '11', '0', 0, '2342342423423', 2147483647, 'От верблюда', '', NULL, '231232323223767567567', ''),
(29, 'ekomixds2', 'ekomixds2', '', '0', 0, '4234234234', 234234, 'ekomixds2', 'ekomixds2', NULL, '324234', ''),
(31, 'akoch-ov', 'Москва', '15 лет', '0', 0, '', 0, 'от Алана', '', 17, '', '7,12,19,20,21,22,27'),
(32, 'нет', 'Авторитетинск', '44', '0', 0, '45345345345', 2147483647, 'сайт', 'нет', 4, '345345345345345345', '8,9,14'),
(36, '777', '777', '5 ', '0', 0, '345345353545', 2147483647, 'С сайта', 'нет', NULL, '345345345345', ''),
(37, 'alefaanti', 'Moscow', '', '', 0, '', 0, 'гугл', 'нет', NULL, '', ''),
(38, 'serpuh555', 'Msk', '', '', 0, '', 0, 'гугл', 'нет', NULL, '', ''),
(39, 'ekomixds3', 'ekomixds3', 'ekomixds3', '0', 0, '34534545345', 2147483647, 'ekomixds3', '5345', NULL, '345345345345', ''),
(41, 'alexeyvakarchuk', 'Днепропетровск', '2 года', '0', 0, '160908150835', 2147483647, 'Skype', '', 6, '', '6,7,8'),
(42, '', 'Korenovsk', '', '0', 0, '', 0, 'fl.ru', '', NULL, '', '7,8,9,10,12,13,16,17'),
(43, 'sheva1072', 'Москва', '', '', 0, '', 0, 'От Михаила', 'VIP клиент', NULL, '', ''),
(44, '', 'Москва', '', '', 0, '', 0, '000000000000', '', NULL, '', ''),
(45, 'mishel12300', 'Moskow', '', '', 0, '', 0, 'hz', '', NULL, '', ''),
(47, 'Москва', 'Большой', 'Да', '0', 0, '34983485794', 0, 'Апинтарореьеоьгп', 'Алащаоилапиллекиодумеокеилокезлиоапщиоапщзиокещ', 0, '', '17'),
(48, '', 'Москва', '', '', 0, '', 0, 'http://dipstart.ru/admin/zakaz/view', '', NULL, '', ''),
(49, '', 'Москва', '', '', 0, '', 0, 'http://dipstart.ru/admin/zakaz/view', '', NULL, '', ''),
(50, 'sheva1072', 'Симферополь', '1оо5оо', '0', 0, '0000000000', 2147483647, 'Создал', 'нет', NULL, '0000000000', '6,7,8,9,10,11,12,13,14,15,16,17,18'),
(51, '', 'Херсон', '', '0', 0, '', 0, 'http://artur.org', '', 3, '', '6,7,8,9,10,11,12,13,14,15,16,17,18,19'),
(52, '', 'Днепропетровск', '', '0', 0, '', 0, 'от Артура', '', 2, '', '22,26,27'),
(53, 'elrostov.ru', 'Ростов-на-Дону', '6 лет', '0', 0, '', 0, 'fl.ru', '', 0, '', '6,7,10,12'),
(54, 'sdfsf', 'sdfsdf', '', '', 0, '', 0, 'sdfssdfdsfsdfsdf', 'sdfsdf', NULL, '', ''),
(55, 'kompavel1', 'Kremenchug', '4', '0', 0, '', 0, 'скайп', '', NULL, '', '7,12,20'),
(56, 'JFallenAngel', 'Севастополь', '10 лет ', '0', 0, '', 0, 'Фриланс ', '', 1, '', '6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,26'),
(57, 'фывфв', 'Москва', '', '', 0, '', 0, 'йц', '', NULL, '', ''),
(58, '', '', '', '', 0, '', 0, 'https://freelancehunt.com/', '', NULL, '', ''),
(59, 'tokenize.red', 'Слободской', '', '1', 0, '', 2147483647, 'https://freelancehunt.com/', '', NULL, '', '12,17,23'),
(60, 'by_volk23', '', '3года', '0', 0, '', 0, '', '', NULL, '', '10'),
(61, 'druny19955', 'Мариуполь', '2 года', '0', 0, '', 0, 'ул. 9мая, д. 5/3, кв. 6', '', NULL, '', '7,8,9,10,12,13,17,21'),
(62, 'zhenatui_hlopec', 'Черкассы', '4', '0', 0, '293541048728', 0, 'freelancehunt.com', '', 1, '', '10'),
(63, 'Омск', '3г', 'бывает', '0', 0, '', 0, 'freelancehunt.com', '', NULL, '', '22'),
(64, 'dmitriy.xodenko', 'Омск г', '3г', '0', 0, '', 0, 'freelancehunt.com', '', NULL, '', '22'),
(65, '', '', '3 года', '0', 0, '', 0, 'workzilla', '', NULL, '', '6,7,8,9,10,17,19,20'),
(66, 'strad91', 'Москва', '3', '0', 0, '', 2147483647, 'https://freelance.ru', '', NULL, '', '10,17,18,19,20'),
(67, '', '', '+1', '1', 0, '', 0, '', '', NULL, '', '12,23'),
(68, '', '', '', '0', 0, '', 0, '', '', NULL, '', '6,7,12,19,20,21,23'),
(69, '', 'Киев', '3 года', '0', 0, '', 0, '', '', NULL, '', '7,8,9,10'),
(70, 'seocube.net', 'Севастополь', '', '', 0, '', 0, 'фриланс', '', NULL, '', ''),
(71, '', '', '', '0', 0, '244380449195', 0, 'freelancehunt.com', '', NULL, '', '23'),
(72, '', '', '', '0', 0, '', 0, '', '', NULL, '', '10'),
(73, 'kompavel1', '', '', '0', 0, '', 0, '', '', NULL, '', '7,12,19,20,22,27'),
(74, 'ahiles504', 'Харьков', 'более двух лет', '0', 0, '628598656063', 0, 'https://freelancehunt.com/project/srochno-nuzhno-protestirovat-bek-end/81831.html', '', 0, '', '8,9,10,12,13,16,17,23,26'),
(75, '', '', '', '0', 0, '', 0, '', '', NULL, '', '7'),
(76, 'mr.retuam', 'Vilnius', '', '', 0, '', 0, 'freelance', '', NULL, '', ''),
(77, 'aasuro', 'Архангельск', '5', '0', 0, '298963588113', 2147483647, 'freelance.ru', '', NULL, '', '6,7,20,21'),
(78, '', '', '', '', 0, '', 0, '', '', NULL, '', ''),
(79, 'vladarwise', '', '3 года', '0', 0, '', 0, '', '', NULL, '', '6,7,12,19,20,21'),
(80, 'yurawd', 'Николаев', '5 лет', '0', 0, '188366908794', 0, 'сообщил сотрудник по почте', '', NULL, '', '6,7,11,14,15,16,17,20'),
(81, 'evgeniy33077', 'Барнаул', '3 года', '0', 0, '208489498302', 2147483647, '', '', NULL, '5337360173431751', '7,20,21'),
(82, 'diusha82', 'Донецк', '', '', 0, '', 0, 'freelance.ru', 'Seo-оптимизация сайтов. Составления СЯ. Построение внутренне перелинковки.', NULL, '', ''),
(83, '', '', '', '0', 0, '', 0, '', '', NULL, '', '12'),
(84, 'angelina.alchieva', 'Киев', '3', '0', 0, '', 0, 'fl', '', NULL, '', '10,13,14,17'),
(85, 'cuborubo', 'Dnipropetrovsk', '', '', 0, '', 0, '', '', NULL, '', ''),
(86, 'evg-shaman', '', '', '0', 0, '255706228894', 0, '', '', NULL, '', '12'),
(87, 'bvblogic_o.kandiuk', 'Ивано-Франковск, Украина', '', '', 0, '', 0, 'https://freelancehunt.com/', 'В налиличие компании большой штат программистов, более 80-ти человек, с знаниями разных технологиях, таких как: PHP, Phyton, Java, Java Script, Ruby on Rails, а также мобильных IOS и Android. \r\nРабота с фреймворками: Yii, Node.js, Symphony, CodeIgniter, L', NULL, '', ''),
(88, 'efes63', 'Саратов ', '7 лет', '0', 0, '417228920354', 0, 'freelance.ru', '', NULL, '', '7,10,12,20'),
(89, 'alushchik', 'Черняховск', '', '', 0, '', 0, '', '', NULL, '', ''),
(90, '', '', '', '0', 0, '', 0, 'по почте', '', NULL, '', '7'),
(91, 'anvar_rahimov', 'Tashkent', '7', '0', 0, '', 0, 'Порекомендовал знакомый', '', NULL, '', '7,12,20'),
(92, 'netville_web', 'Odessa', '8', '0', 0, '414299574150', 0, 'freelancehunt.com', 'Создание качественных WEB-сайтов, индивидуальный дизайн, оптимизация и продвижение. Разработка корпоративного стиля и индивидуальных логотипов.\r\nТехническая поддержка веб-проектов, наполнение контентом.\r\n\r\nМы стремимся к тому, чтобы наши клиенты получали ', NULL, '', '6,7,10,12,20,21'),
(93, 'juni-b23', 'Екатеринбург', '', '', 0, '', 0, 'Миша Нонкоф', 'Ищу верстальщика ', NULL, '', ''),
(94, 'Oks812010', 'Кременчуг', '5 лет', '0', 0, '253268693439', 0, '', '', NULL, '', '8,9,13'),
(95, '', '', '', '', 0, '', 0, '', '', NULL, '', ''),
(96, 'chervonos.v', 'Запорожье', '3 года', '', 0, '', 0, 'http://freelance.ru/', '', NULL, '', '7'),
(97, 'NadezhdaBykova89', 'Санкт-Петербург', '', '', 0, '', 0, 'freelance.ru', '', NULL, '', ''),
(98, 'NadezhdaBykova89', 'Санкт-Петербург', '3 года', '', 0, '', 2147483647, 'freelance.ru', '', NULL, '', '8,10'),
(109, 'akoch-ov', 'Moscow', '', '', 0, '', 0, '', '', NULL, '', ''),
(121, 'romebio', 'Хмельницкий', '', '', 0, '', 0, 'freelancehunt.com', 'Верстка сайтов', NULL, '', ''),
(122, 'lsd-7d1', 'Серпухов', '10 лет +', '', 0, '', 0, '', '', NULL, '', '6,7,8,9,10,11,12');

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProfilesFields`
--

CREATE TABLE IF NOT EXISTS `1_ProfilesFields` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `varname` varchar(50) NOT NULL COMMENT 'Переменная',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `field_type` varchar(50) NOT NULL COMMENT 'Тип поля',
  `field_size` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Размер поля',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Мин размер поля',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT 'Требуемое',
  `match` varchar(255) NOT NULL DEFAULT '' COMMENT 'Рег выражение',
  `range` varchar(255) NOT NULL DEFAULT '' COMMENT 'Диапазон',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Сообщение об ощибке',
  `other_validator` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Прочая валидация',
  `default` varchar(255) NOT NULL DEFAULT '' COMMENT 'По умолчанию',
  `widget` varchar(255) NOT NULL DEFAULT '' COMMENT 'Виджет',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Параметры виджета',
  `position` int(3) NOT NULL DEFAULT '0' COMMENT 'Позиция',
  `visible` int(1) NOT NULL DEFAULT '0' COMMENT 'Видимое',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения полей профиля пользователя' AUTO_INCREMENT=25 ;

--
-- Дамп данных таблицы `1_ProfilesFields`
--

INSERT INTO `1_ProfilesFields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(7, 'skype', 'Skype', 'VARCHAR', '50', '3', 0, '', '', '', '', '', '', '', 5, 3),
(8, 'city', 'Город', 'VARCHAR', '50', '2', 0, '', '', '', '', '', '', '', 6, 3),
(10, 'work_experience', 'Опыт работы в данной сфере', 'VARCHAR', '20', '1', 2, '', '', '', '', '', '', '', 8, 2),
(14, 'fl_acc', 'Аккаунты на фрилансе', 'mediumtext', '65535', '0', 0, '', '', '', '', '', '', '', 11, 2),
(15, 'mailing_list', 'Рассылать сообщения', 'VARCHAR', '10', '0', 0, '', 'icq;sms;email', '', '', '0', '', '', 12, 0),
(16, 'wmr', 'Webmoney R', 'INTEGER', '13', '12', 0, '', '', '', '', '', '', '', 13, 2),
(18, 'yandex', 'Яндекс Д.', 'INTEGER', '13', '10', 0, '', '', '', '', '0', '', '', 15, 2),
(20, 'how_hear', 'Откуда Вы узнали о нас (адрес конкретного сайта)', 'VARCHAR', '255', '0', 0, '', '', '', '', '', '', '', 17, 3),
(21, 'additional', 'Дополнительно', 'TEXT', '255', '0', 0, '', '', '', '', '', '', '', 16, 3),
(22, 'bank_account', 'Банковский счет', 'VARCHAR', '255', '0', 0, '', '', '', '', '', '', '', 14, 2),
(24, 'specials', 'Специальность', 'LIST', '0', '0', 1, '', '', 'Укажите специальность', '', '', '', '', 0, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectChanges`
--

CREATE TABLE IF NOT EXISTS `1_ProjectChanges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file` varchar(350) DEFAULT NULL,
  `comment` varchar(450) NOT NULL DEFAULT '',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  `date_moderate` timestamp NULL DEFAULT NULL,
  `moderate` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `1_ProjectChanges`
--

INSERT INTO `1_ProjectChanges` (`id`, `user_id`, `project_id`, `file`, `comment`, `date_create`, `date_update`, `date_moderate`, `moderate`) VALUES
(8, 1, 1, '1eb57d1251b67216ddb1784367303bec.jpg', '321', '2015-08-06 20:03:59', '2015-08-06 20:05:40', '2015-08-06 20:05:40', '1'),
(20, 1, 1, '1eb57d1251b67216ddb1784367303bec(1).jpg', '555', '2015-08-06 19:49:09', '2015-08-06 19:55:02', '2015-08-06 19:55:02', '1'),
(21, 1, 1, '1eb57d1251b67216ddb1784367303bec(2).jpg', '777', '2015-08-06 19:58:36', '2015-08-06 19:58:59', '2015-08-06 19:58:59', '1'),
(22, 1, 1, '1eb57d1251b67216ddb1784367303bec(3).jpg', '333', '2015-08-06 19:19:50', '2015-08-06 20:06:13', '2015-08-06 20:06:13', '0'),
(23, 23, 2, '1eb57d1251b67216ddb1784367303bec(4).jpg', 'ziga', '2015-08-07 01:35:25', '2015-08-07 01:35:59', '2015-08-07 01:35:59', '1'),
(24, 23, 3, '1-Glava-65_6.doc', '', '2015-08-09 09:17:19', '2015-08-09 09:17:28', '2015-08-09 09:17:28', '1'),
(25, 23, 6, '1-Glava-65.doc', '', '2015-08-12 12:30:34', '2015-08-15 16:49:51', '2015-08-15 16:49:51', '1'),
(26, 38, 55, '1-Glava-65_6(1).doc', '', '2015-08-20 01:25:09', '2015-08-20 01:25:21', '2015-08-20 01:25:21', '1'),
(27, 22, 57, 'National-University-Islamabad-India.jpg', '', '2015-08-20 17:44:31', '2015-08-20 17:45:11', '2015-08-20 17:45:11', '1'),
(28, 22, 57, 'National-University-Islamabad-India(1).jpg', 'замечания', '2015-08-20 17:44:43', NULL, NULL, '0'),
(29, 22, 57, 'National-University-Islamabad-India(2).jpg', 'замечания', '2015-08-20 17:44:43', NULL, NULL, '0'),
(30, 1, 67, 'email_icon.png', 'Не работает', '2015-08-22 04:39:59', NULL, NULL, '1'),
(31, 1, 79, '1-Glava-65(1).doc', '', '2015-08-24 03:12:45', '2015-08-24 14:32:49', '2015-08-24 14:32:49', '1'),
(32, 45, 83, '207903__model_p.jpg', '', '2015-08-25 18:22:04', NULL, NULL, '0'),
(33, 45, 83, '207903__model_p(1).jpg', 'пнттпртптт', '2015-08-25 18:22:46', NULL, NULL, '0'),
(34, 45, 68, '207903__model_p(2).jpg', 'мвамвамвам', '2015-08-27 22:44:59', NULL, NULL, '0'),
(35, 23, 53, 'Terran.jpg', 'Terran', '2015-08-28 01:47:23', NULL, NULL, '0'),
(36, 45, 87, '207903__model_p(3).jpg', '', '2015-08-28 02:37:21', NULL, NULL, '0'),
(37, 1, 68, '1-Glava-65(2).doc', '', '2015-08-29 06:45:34', NULL, NULL, '1'),
(38, 57, 97, 'Dokument-Microsoft-Office-Word-(2).docx', '', '2015-08-30 17:33:31', '2015-08-30 17:33:52', '2015-08-30 17:33:52', '1'),
(39, 1, 102, 'Srok-vypolneniya.png', '', '2015-08-31 13:30:47', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectFields`
--

CREATE TABLE IF NOT EXISTS `1_ProjectFields` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `varname` varchar(50) NOT NULL COMMENT 'Переменная',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `field_type` varchar(50) NOT NULL COMMENT 'Тип поля',
  `field_size` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Размер поля',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT 'Требуемое',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Сообщение об ощибке',
  `default` varchar(255) NOT NULL DEFAULT '' COMMENT 'По умолчанию',
  `position` int(3) NOT NULL DEFAULT '0' COMMENT 'Позиция',
  `visible` int(1) NOT NULL DEFAULT '0' COMMENT 'Видимое',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения полей профиля пользователя' AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `1_ProjectFields`
--

INSERT INTO `1_ProjectFields` (`id`, `varname`, `title`, `field_type`, `field_size`, `required`, `error_message`, `default`, `position`, `visible`) VALUES
(1, 'title', 'Наименование', 'VARCHAR', '255', 1, 'Wrong title', '', 1, 1),
(2, 'description', 'Дополнительные требования или рекомендации', 'TEXT', '0', 0, '', '', 3, 1),
(5, 'soderjanie', 'План', 'TEXT', '0', 2, '', '', 1, 1),
(7, 'specials', 'Специальность', 'LIST', '0', 3, 'Укажите специальность', '', 0, 1),
(8, 'technicalspec', 'Необходимость тех. спец.', 'BOOL', '0', 0, '', '0', 5, 2),
(9, 'opisanie', 'Описание', 'TEXT', '0', 2, '', '', 2, 1),
(10, 'posting', 'Необходимость постинга', 'BOOL', '0', 0, 'Ошибка поля Необходимость постинга', '0', 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectMessages`
--

CREATE TABLE IF NOT EXISTS `1_ProjectMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `moderated` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=756 ;

--
-- Дамп данных таблицы `1_ProjectMessages`
--

INSERT INTO `1_ProjectMessages` (`id`, `message`, `sender`, `recipient`, `moderated`, `date`, `order`, `cost`) VALUES
(1, '123', 1, 23, 0, '2015-08-05 20:08:51', 1, NULL),
(2, '234', 1, 23, 0, '2015-08-05 20:56:33', 1, NULL),
(3, '432', 23, 1, 0, '2015-08-05 20:57:22', 1, NULL),
(5, '<p style="text-align: center;"><strong>Вот это да!</strong></p>', 1, 23, 0, '2015-08-07 18:50:38', 1, NULL),
(6, '<p>Ждем оплаты</p>', 1, 23, 0, '2015-08-09 08:09:49', 3, NULL),
(7, 'Здравствуйте, я оплатил 7500', 23, 1, 0, '2015-08-09 08:24:46', 3, NULL),
(8, 'Здравствуйте, я оплатил 7500', 23, 0, 0, '2015-08-09 08:24:52', 3, NULL),
(9, 'Здравствуйте, я смогу сделать ', 24, 1, 0, '2015-08-09 08:30:41', 3, 8000),
(10, 'Готов взяться ', 14, 1, 0, '2015-08-09 08:31:10', 3, 6000),
(11, 'Сделаю быстро и качественно 3000', 16, 1, 0, '2015-08-09 08:32:26', 3, 3000),
(12, '<p>Здравствуйте, оплату получили Автор приступил. Спасибо</p>', 1, 23, 0, '2015-08-09 08:35:02', 3, NULL),
(14, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Здравствуйте, назначаем Вас ждем в срок. Спасибо</span></p>', 1, 16, 0, '2015-08-09 08:47:20', 3, NULL),
(15, '<p>Уважаемый блять 12-е число, где работа ?</p>', 1, 16, 0, '2015-08-09 08:51:48', 3, NULL),
(16, 'Ну это... Как его... я не успеваю сорян', 16, 1, 0, '2015-08-09 08:52:20', 3, NULL),
(17, '<p><strong><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Здравствуйте, назначаем Вас ждем в срок. Спасибо</span></strong></p>', 1, 14, 0, '2015-08-09 08:58:29', 3, NULL),
(19, '<p>Отправить всем авторам</p>', 1, -1, 0, '2015-08-11 19:57:37', 3, NULL),
(27, '<p>333</p>', 1, 16, 0, '2015-08-11 20:20:39', 3, NULL),
(28, 'Здравствуйте, сколько будет стоить ?', 23, 0, 0, '2015-08-12 12:02:30', 6, NULL),
(29, '<p>Здравствуйте, оплачивайте 5000</p>', 1, 23, 0, '2015-08-12 12:06:52', 6, NULL),
(30, 'Хорошо', 23, 1, 0, '2015-08-12 12:08:11', 6, NULL),
(31, '<p>Плохо</p>', 1, 23, 0, '2015-08-12 12:08:27', 6, NULL),
(32, 'Здравствуйте. Давайте работать', 32, 23, 0, '2015-08-12 12:11:59', 6, NULL),
(33, '<p>Здравствуйте. Давайте</p>', 1, 32, 0, '2015-08-12 12:12:51', 6, NULL),
(34, 'Я заказчику пишу а не Вам!', 32, 1, 0, '2015-08-12 12:13:34', 6, NULL),
(35, '<p>Заказчик ожидает когда Вы начнете работу.</p>', 1, 32, 0, '2015-08-12 12:13:51', 6, NULL),
(36, '<p>Здравствуйте, Уважаемые Авторы</p>', 1, -1, 0, '2015-08-12 12:14:17', 6, NULL),
(37, 'Давайте сделаю за 2500', 32, 1, 0, '2015-08-12 12:17:29', 6, NULL),
(38, '<p>Назначены на заказ 6</p>', 1, 32, 0, '2015-08-12 12:18:14', 6, NULL),
(39, '<p>Работайте</p>', 1, 32, 0, '2015-08-12 12:21:07', 6, NULL),
(40, '<p>Оплатили Вам</p>', 1, 32, 0, '2015-08-15 16:38:13', 6, NULL),
(41, '<p>Спасибо за работу</p>\n<p>&nbsp;</p>', 1, 32, 0, '2015-08-15 16:44:16', 6, NULL),
(42, '<p>Бюджет 4500, срок неделя</p>', 1, -1, 0, '2015-08-15 17:49:52', 7, NULL),
(45, 'Здравствуйте оплачу завтра.', 23, 1, 0, '2015-08-18 17:54:32', 45, NULL),
(46, '<p>Приступили к работе</p>', 1, 23, 0, '2015-08-18 17:55:36', 45, NULL),
(47, 'Выполню', 24, 1, 0, '2015-08-18 17:59:39', 45, 1500),
(48, '<p>Работайте</p>', 1, 24, 0, '2015-08-18 18:02:07', 45, NULL),
(60, '<p>Здравствуйте ожидаем оплаты</p>', 1, 24, 0, '2015-08-20 12:31:25', 55, NULL),
(62, 'Здравствуйте', 24, 1, 0, '2015-08-20 12:36:27', 37, 600),
(67, 'хелоу менеджер', 22, 1, 0, '2015-08-20 16:44:52', 57, NULL),
(68, 'Готов начать работу', 14, 1, 0, '2015-08-20 16:47:50', 57, 4500),
(69, 'привет зак', 14, 22, 1, '2015-08-20 16:48:37', 57, 4500),
(70, 'ну и?', 14, 1, 0, '2015-08-20 17:07:28', 57, NULL),
(71, 'пишку заказчику', 14, 22, 1, '2015-08-20 17:10:22', 57, NULL),
(72, 'ау', 14, 22, 1, '2015-08-20 17:11:14', 57, NULL),
(73, 'приступаю', 14, 1, 0, '2015-08-20 17:18:55', 57, NULL),
(74, 'приступаю', 14, 22, 1, '2015-08-20 17:19:06', 57, NULL),
(75, 'Здравствуйте оплачу завтра.', 23, 24, 1, '2015-08-21 16:04:48', 45, NULL),
(76, '<p>098</p>', 1, 22, 0, '2015-08-21 17:14:30', 57, NULL),
(77, '<p>Здравствуйте! Готовы принять Ваш заказ. Стоимость будет 30 000р.&nbsp;</p>', 1, 44, 0, '2015-08-22 03:00:32', 61, NULL),
(78, '<p>Здравствуйте! Готовы принять Ваш заказ. Стоимость будет 30 000р.&nbsp;</p>', 1, 44, 0, '2015-08-22 03:00:45', 61, NULL),
(79, 'ку-ку !', 44, 0, 0, '2015-08-22 03:16:55', 61, NULL),
(80, '<p>Здравствуйте.</p>', 1, 44, 0, '2015-08-22 03:18:14', 61, NULL),
(81, '<p>Здравствуйте, заказ принят, lля того, чтобы Роман смог приступить к выполнению Вашего заказа, Вам необходимо внести аванс в размере 50% от стоимости работы.<br /><br />Это подтвердит серьезность намерений с Вашей стороны и мы будем уверены, что Автор выполнит действительно востребованную работу. Мы берем 50% аванс, в отличии от других компаний, берущих 100%, чтобы Вы были уверенны в нашей честности.<br /><br />У Вас в форме заказа появилась форма для загрузки чека. &nbsp;Спасибо за обращение.</p>\n<p>&nbsp;</p>\n<p style="color: #333333; font-family: sans-serif, Arial, Verdana, ''Trebuchet MS''; font-size: 13px; line-height: 20.7999992370605px;">&nbsp;</p>', 1, 45, 0, '2015-08-22 03:52:40', 62, NULL),
(82, '5 минут', 14, 1, 0, '2015-08-22 04:07:18', 67, NULL),
(83, '<p>Спасибо. Вы оправдываете свой рейтинг.Назначаем на заказ.</p>', 1, 14, 0, '2015-08-22 04:15:32', 67, NULL),
(85, '<p>Ожидаем результаты через 5 минут. Спасибо</p>', 1, 14, 0, '2015-08-22 04:18:47', 67, NULL),
(86, 'Готово', 14, 1, 0, '2015-08-22 04:21:41', 67, NULL),
(87, '<p>Готово</p>', 1, 43, 0, '2015-08-22 04:37:27', 67, NULL),
(88, 'Здравствуйте, Уважаемый программист. Менеджер мне отправил сообщение о том, что работа готова, но на почту я ничего не получил. Спасибо', 43, 14, 1, '2015-08-22 04:39:13', 67, NULL),
(89, '-', 14, 1, 0, '2015-08-22 05:04:44', 67, NULL),
(90, 'Но необходимо обсудить детали. по проекту', 42, 23, 0, '2015-08-22 14:00:43', 44, 10000),
(91, 'Данную услугу Вам сможет предоставить качественная уборщица, которую я вызову на ваш адрес после внесения 30% предоплаты.', 42, 43, 0, '2015-08-22 15:02:31', 60, 100000000),
(92, 'Данную услугу Вам сможет предоставить качественная уборщица, которую я вызову на ваш адрес после внесения 30% предоплаты.', 42, 43, 0, '2015-08-22 15:02:32', 60, 100000000),
(93, '<p>Спасибо :) Это задача для нашей домохозяйки&nbsp;</p>', 1, 42, 0, '2015-08-22 17:27:14', 60, NULL),
(94, '<p>Здравствуйте, должно работать.</p>', 1, 43, 0, '2015-08-22 18:17:16', 67, NULL),
(95, '<p>Здравствуйте.</p>', 1, 43, 0, '2015-08-22 19:02:52', 67, NULL),
(96, '<p>Здравствуйте. Проверка ошибки сообщений в чате. Не отвечайте</p>', 1, 14, 0, '2015-08-22 19:08:21', 67, NULL),
(97, 'Здравствуйте.', 43, 1, 0, '2015-08-22 19:12:22', 67, NULL),
(100, '<p>Здравствуйте, заказ принят.</p>', 1, 45, 0, '2015-08-22 19:14:08', 68, NULL),
(101, 'я прислал чек ', 45, 1, 0, '2015-08-22 20:22:35', 62, NULL),
(102, '<p>Чек принят. Оплата получена. Спасибо</p>', 1, 45, 0, '2015-08-22 20:41:09', 62, NULL),
(103, 'Уже сделал ёпт!', 31, 1, 0, '2015-08-22 23:01:27', 71, 1),
(104, '<p>Молодчик!</p>', 1, 31, 0, '2015-08-22 23:02:24', 71, NULL),
(105, 'Где, кроме списка заказов у менеджера, нужно исправить данный баг?', 31, 1, 0, '2015-08-22 23:26:24', 71, NULL),
(106, '<p>В списке заказов у Автора и Заказчика.</p>', 1, 31, 0, '2015-08-23 01:22:50', 71, NULL),
(107, '<p>Здравствуйте</p>', 1, 43, 0, '2015-08-23 01:23:32', 71, NULL),
(109, '<p>Не ну давайте дешевле. Мы рассчитываем на долгосрочное и взаимовыгодное сотрудничетво.</p>', 1, 47, 0, '2015-08-23 02:19:35', 70, NULL),
(110, 'Вам подходят мои условия?', 47, 1, 0, '2015-08-23 02:21:37', 70, 57000),
(111, 'Так? ', 47, 1, 0, '2015-08-23 02:21:55', 70, 3000),
(112, '<p>Назначили на заказ, можно приступать.&nbsp;</p>', 1, 47, 0, '2015-08-23 02:28:45', 70, NULL),
(113, 'готово', 31, 1, 0, '2015-08-23 17:19:57', 71, NULL),
(114, '<p>Спасибо. Заказ завершен</p>', 1, 31, 0, '2015-08-23 18:13:07', 71, NULL),
(115, '<p>Здравствуйте, срок сдачи инструкций 27.08.2015. Работа будет в срок.</p>', 1, 45, 0, '2015-08-23 18:40:42', 68, NULL),
(116, 'тут будет зависеть от количества запросов! ', 42, 43, 0, '2015-08-23 18:43:50', 66, NULL),
(117, 'как уже писал моя цена 30% от ссылочного бюджета', 42, 43, 0, '2015-08-23 18:44:24', 65, NULL),
(118, 'тут учитывать по цене только старые страницы или и новые так же?', 42, 43, 0, '2015-08-23 18:45:07', 64, NULL),
(119, 'Если смотреть на уже имеющиеся страницы цена указана выше. Если стоит учитывать и новые, тогда цену нужно обговаривать отдельно', 42, 43, 0, '2015-08-23 18:46:24', 59, 13000),
(120, '<p>Пока старые, а новые то-же будут по отдельной цене ? Там-е уже будет система готовая по которой они будут добавляться уже...</p>', 1, 42, 0, '2015-08-23 18:49:27', 64, NULL),
(121, '<p>Ну ориентировочно к примеру по 3-м запросам.</p>', 1, 42, 0, '2015-08-23 18:51:32', 66, NULL),
(122, 'Начало положено', 31, 1, 0, '2015-08-23 19:20:35', 77, 1),
(123, 'sql-файл есть, могу выложить\nСловесный скрипт ждёт тестирования, которое в свою очередь ждёт заполнения полей', 31, 1, 0, '2015-08-23 19:21:50', 78, 1),
(124, '<p>Загружайте в части.</p>', 1, 31, 0, '2015-08-23 19:25:52', 78, NULL),
(125, 'Залил sql, жду тестирования.', 31, 1, 0, '2015-08-23 19:34:44', 78, NULL),
(126, 'ориентировочно 10 запрос - 300р. будет стоить. при анализе учитывается обычно порядка 100-150 запросов.\nТак же цена указана примерная и будет зависеть от количества регионов', 42, 43, 0, '2015-08-23 19:34:57', 66, NULL),
(127, 'новые если будем писать тз, то информация будет в ТЗ.\nТакс по имеющимся цена будет 5000р за перелинковку', 42, 43, 0, '2015-08-23 19:36:11', 64, 5000),
(128, 'Сделал так что в зависимости от компании выбирается язык. Теперь нужно вылизывать весь сайт чтоб все строки брались из специального места и для каждой была как русская так и английская вариации.', 31, 1, 0, '2015-08-23 19:37:25', 77, NULL),
(142, '<p>А вот теперь работает</p>', 1, 14, 0, '2015-08-23 20:51:46', 67, NULL),
(143, '<p>А вот теперь работает</p>', 1, 14, 0, '2015-08-23 20:54:01', 67, NULL),
(144, '<p>Говорят работает</p>', 1, 43, 0, '2015-08-23 20:56:49', 67, NULL),
(145, '<p>Спасибо, заказ завершен , увеличиваем Вам рейтинг +1.</p>', 1, 14, 0, '2015-08-23 20:58:44', 67, NULL),
(149, '56757ргенгенпген', 23, 1, 0, '2015-08-24 14:38:16', 53, NULL),
(150, 'Здравствуйте.', 23, 1, 0, '2015-08-24 14:48:50', 82, NULL),
(151, 'Выполню', 32, 1, 0, '2015-08-24 14:53:42', 82, 1000),
(152, '<p>Здравствуйте</p>', 1, 32, 0, '2015-08-24 14:56:15', 82, NULL),
(153, 'Спасибо', 23, 1, 0, '2015-08-24 15:02:21', 82, NULL),
(154, 'Здравствуйте дайте телефон', 23, 32, 0, '2015-08-24 15:11:55', 82, NULL),
(155, 'Как содержание статьи поправить ?', 23, 1, 0, '2015-08-24 15:13:32', 82, NULL),
(156, 'Как содержание статьи поправить ?', 23, 32, 1, '2015-08-24 15:13:47', 82, NULL),
(157, 'Здравствуйте , готов выполнить', 32, 1, 0, '2015-08-24 18:26:08', 81, 3000),
(158, '<p>Хелоу</p>', 1, 43, 0, '2015-08-25 17:35:46', 65, NULL),
(159, '<p>Здравствуйте, инструкции готовы, ожидаем утверждения.&nbsp;<br />Видео инструкции можно просмотреть по данной ссылке :&nbsp;<br />https://drive.google.com/drive/folders/0BwQZWptl1Jx4fno0OGdUb2xSTnlwS2c5M0Y4eTJQUUhlSjV4X3VEX1RMNnRuRThoR1FkV0k</p>', 1, 45, 0, '2015-08-25 18:09:18', 68, NULL),
(160, 'Напишите пожалуйста url данной страницы', 31, 1, 0, '2015-08-25 18:23:34', 73, NULL),
(161, '<p>Здравствуйте, по какой причине не выполняете заказ ?</p>', 1, 47, 0, '2015-08-25 18:24:06', 70, NULL),
(162, '=)', 31, 1, 0, '2015-08-25 18:25:07', 73, 1),
(163, '<p>http://adco.obshya.com/project/zakaz/view/id/84 , где номер как Вы понимаете изменяется.</p>', 1, 31, 0, '2015-08-25 18:26:10', 73, NULL),
(164, '<p>Здравствуйте, есть специалист готовый приступить. Уточните пожалуйста Ваш бюджет на задачу.</p>', 1, 45, 0, '2015-08-25 18:29:30', 83, NULL),
(165, 'Готово', 31, 1, 0, '2015-08-25 18:30:13', 73, NULL),
(166, 'мне нужен результат в формате гугл докса', 45, 1, 0, '2015-08-25 18:30:39', 68, NULL),
(167, 'мне нужен результат в формате гугл докса\n', 45, 0, 0, '2015-08-25 18:30:44', 68, NULL),
(168, '<p>Пожалуйста не загружайте не актуальный материал в форму заказа, это будет отвлекать исполнителя. Спасибо за понимание. С уважением компания Админтрикс.</p>', 1, 45, 0, '2015-08-25 18:31:05', 83, NULL),
(169, '<p>Спасибо. Рейтинг повышен.</p>', 1, 31, 0, '2015-08-25 18:32:02', 73, NULL),
(170, '<p>Уважаемый Михаил, дело в том, что формата гугл докса не существует, уточните, Вам нужна ссылка на документы в гугл доксе ?</p>', 1, 45, 0, '2015-08-25 18:35:06', 68, NULL),
(171, '<p>Так-же просьба не дублировать заказы. Ваш заказ на макет всех страниц, уже принят.</p>', 1, 45, 0, '2015-08-25 19:24:34', 83, NULL),
(172, 'Сделал пока как текстовое поле где можно написать либо 0 либо 1.', 31, 1, 0, '2015-08-25 22:17:16', 79, NULL),
(173, 'Дорабатывать до чекбокса?', 31, 1, 0, '2015-08-25 22:17:26', 79, NULL),
(174, '<p>Здравствуйте. Ожидаем подтверждения Вами заказа и внесение предоплаты.&nbsp;</p>', 1, 45, 0, '2015-08-26 00:58:39', 62, NULL),
(175, '<p>Скажите пожалуйста,будет ли возможность продлить срок ? Актуален ли заказ.</p>', 1, 45, 0, '2015-08-26 00:59:48', 62, NULL),
(176, '<p>Здравствуйте, часть этого заказа дублирует Ваш заказ 83. Пожалуйста уточните как будем выполнять заказы. Спасибо</p>', 1, 45, 0, '2015-08-26 01:08:19', 74, NULL),
(177, '<p>Вы написали требуется список всех страниц, о каком ресурсе идет речь ? Предоставьте хоть ссылку</p>', 1, 45, 0, '2015-08-26 01:11:27', 74, NULL),
(178, '<p>Вы выполняете данный заказ ? Назначать Вас исполнителем ?</p>', 1, 31, 0, '2015-08-26 01:18:23', 77, NULL),
(179, '<p>Здравствуйте, сообщите о ходе выполнения заказа.</p>', 1, 31, 0, '2015-08-26 01:21:11', 78, NULL),
(180, '<p>Спасибо, пока что подойдет.</p>', 1, 31, 0, '2015-08-26 01:30:26', 79, NULL),
(181, '<p>Не сохраняется это поле</p>', 1, 31, 0, '2015-08-26 01:35:16', 79, NULL),
(182, 'нет! срок продлить невозможно! верните деньги! ', 45, 1, 0, '2015-08-26 01:38:44', 62, NULL),
(183, 'да, ', 45, 1, 0, '2015-08-26 01:39:05', 68, NULL),
(184, 'об этом! http://adco.obshya.com/\nсделать норм фронт енд заказчика', 45, 1, 0, '2015-08-26 01:40:20', 74, NULL),
(185, 'я пытался удалить - невышло! ', 45, 1, 0, '2015-08-26 01:41:24', 83, NULL),
(186, '<p>Исполнитель уже приступил к заказу, срок был задержан не по нашей вине, т.к мы ожидаем от Вас информации без которой нет возможности продолжать. Мы готовы продолжать работу, сообщите делатли и мы постараемся всё завершить максимально быстро.</p>', 1, 45, 0, '2015-08-26 01:49:46', 62, NULL),
(187, '<p>Менеджер&nbsp;<br />https://docs.google.com/document/d/1TLpqrAl9X7WYPtizZRG6f0KyxmheIzeRVtZChl2E49M/edit#</p>', 1, 45, 0, '2015-08-26 01:50:31', 68, NULL),
(192, '<p>https://drive.google.com/drive/folders/0BwQZWptl1Jx4fno0OGdUb2xSTnlwS2c5M0Y4eTJQUUhlSjV4X3VEX1RMNnRuRThoR1FkV0k</p>', 1, 45, 0, '2015-08-26 01:58:36', 68, NULL),
(193, '<p>Можно завершить заказ ?</p>', 1, 45, 0, '2015-08-26 01:59:05', 68, NULL),
(194, '<p>Уточните какой из заказов не актуален, наш менеджер завершит его.&nbsp;</p>', 1, 45, 0, '2015-08-26 02:02:53', 83, NULL),
(195, '<p>Хорошо. Уточните бюджет.</p>', 1, 45, 0, '2015-08-26 02:04:17', 74, NULL),
(196, 'Ждём тестирования perfect-paper.', 31, 1, 0, '2015-08-26 03:31:46', 78, NULL),
(197, 'Пока точно не знаю я это сделаю или ещё кто. В любом случае ждём полей на perfect-paper!', 31, 1, 0, '2015-08-26 03:34:11', 77, NULL),
(198, '<p>Здравствуйте, по Вашему заказу сейчас нет возможности составить Техническое задание, по техническим причинам. Срок сдачи ввиду этого задержан не будет.</p>', 1, 45, 0, '2015-08-26 04:06:26', 70, NULL),
(199, 'я хз какой. сами делайте', 45, 1, 0, '2015-08-26 05:22:23', 83, NULL),
(200, 'какой информации? вы ничего не спрашивали!!!!', 45, 1, 0, '2015-08-26 05:22:54', 62, NULL),
(201, 'да. спасибо', 45, 1, 0, '2015-08-26 05:23:54', 68, NULL),
(202, 'че за хрень? что за тех причины? ', 45, 1, 0, '2015-08-26 05:24:16', 70, NULL),
(203, '<p>Здравствуйте, заказ принят, сможем выполнить. Стоимость работы составит 1ооо5ооо.&nbsp;<br /><br />Вы не указали срок выполнения. Срок будем рассчитывать частями ?</p>', 1, 45, 0, '2015-08-26 06:33:55', 86, NULL),
(204, '<p>Проблемы у Вас на сервере, решите пожалуйста вопрос, после чего сообщите нам и мы все выполним. Спасибо<br /><br />Либо мы можем выполнить задачу за Вас. Нужно будет оформить заказ на устранение неполадок.</p>', 1, 45, 0, '2015-08-26 06:35:44', 70, NULL),
(205, '<p>Вы сообщили по телефону нашему менеджеру, что Вы пока думаете как лучше&nbsp;сделать Ваш проект. После чего проект был приостановлен, до дальнейших указаний.&nbsp;<br /><br />Вы можете оформить заказ на улучшение Вашего проекта и мы выполним его для Вас. С Ув Maxanix.com</p>', 1, 45, 0, '2015-08-26 06:39:36', 62, NULL),
(206, '<p>Хорошо, спасибо. Данный заказ завершен.</p>', 1, 45, 0, '2015-08-26 06:41:10', 83, NULL),
(207, '<p>Здравствуйте, ожидаем оплаты.</p>', 1, 23, 0, '2015-08-26 18:30:43', 45, NULL),
(208, '<p>Здравствуйте, ожидаем Вашего решения и ответа.</p>', 1, 45, 0, '2015-08-26 18:37:01', 62, NULL),
(209, '<p>Ждем Вашего ответа.</p>', 1, 45, 0, '2015-08-26 18:39:31', 70, NULL),
(210, '<p>Здравствуйте, уточните бюджет и внесите 50% предоплату, чтобы мы могли приступить.</p>', 1, 45, 0, '2015-08-26 18:41:23', 74, NULL),
(211, '<p>Все спасибо. Заказ завершен</p>', 1, 31, 0, '2015-08-26 18:44:54', 79, NULL),
(212, '<p>Здравствуйте, мы готовы приступить. Ожидаем Вашего подтверждения и внесение предоплаты.&nbsp;<br />Номер заказа : 86</p>', 1, 45, 0, '2015-08-26 18:47:46', 86, NULL),
(213, '<p>Здравствуйте, ожидаем Ваш ответ по заказам: 86, 74, 70. Процесс простаивает.</p>', 1, 45, 0, '2015-08-26 19:08:25', 86, NULL),
(214, 'пока приостановите проект', 45, 1, 0, '2015-08-26 21:38:11', 62, NULL),
(215, 'это вы мне уточните бюджет!!! сколько стоить то будет?', 45, 1, 0, '2015-08-27 02:05:27', 74, NULL),
(216, '<p>У нас в инструкции сказано, что Вы нам уточняете бюджет и мы должны в него уложиться.&nbsp;<br />Заказ номер : 74</p>', 1, 45, 0, '2015-08-27 02:57:25', 74, NULL),
(217, 'Добрый день! Готов взяться за проект.', 53, 43, 0, '2015-08-27 14:08:12', 59, 6000),
(218, 'Добрый день! Готов взяться за проект.', 53, 43, 0, '2015-08-27 14:11:29', 66, 1),
(219, '<p>Здравствуйте , Вы внесли оплату. Проект приостановлен. Возобновить проект ?&nbsp;<br />Заказ 62</p>', 1, 45, 0, '2015-08-28 02:23:02', 62, NULL),
(220, 'файл удалите)', 45, 1, 0, '2015-08-28 02:37:36', 87, NULL),
(233, 'Здравствуйте! цена указана за уникальный отрисованный дизайн+верстка', 42, 45, 0, '2015-08-28 17:06:45', 88, 15000),
(234, 'файл удалите)', 45, 0, 1, '2015-08-28 17:20:09', 87, NULL),
(235, 'за весь фронтэнд (лендинг + ЛК) - 10000 руб', 51, 45, 0, '2015-08-29 02:25:46', 88, 10000),
(236, '<p>Здравствуйте, стоимость проекта составит 25000 руб.</p>', 1, 45, 0, '2015-08-29 02:30:09', 88, NULL),
(237, '<p>Здравствуйте, получится ли сделать за 8 тыс ?</p>', 1, 51, 0, '2015-08-29 02:42:41', 88, NULL),
(238, 'большой объем работ. 10к это и так заниженная цена;)', 51, 45, 0, '2015-08-29 02:46:33', 88, NULL),
(239, '<p>Назначили Вас на проект. Бюджет составит 10000 руб., пожалуйста ознакомьтесь ещё раз со сроками и сдавайте части вовремя. Спасибо</p>', 1, 51, 0, '2015-08-29 03:57:42', 88, NULL),
(240, '<p>Здарава</p>', 1, 23, 0, '2015-08-29 06:32:25', 45, NULL),
(241, '<ol>\n<li>7777777</li>\n<li>7790-90-</li>\n<li>79-890-</li>\n</ol>', 1, 23, 0, '2015-08-29 06:32:43', 45, NULL),
(242, '<p>Тест</p>', 1, 45, 0, '2015-08-29 06:35:27', 68, NULL),
(243, '<p>Тест2</p>', 1, 0, 0, '2015-08-29 06:35:34', 68, NULL),
(244, '<p>Здравствуйте</p>', 1, 43, 0, '2015-08-29 06:50:28', 59, NULL),
(245, '<p>Здравствуйте уважаемый заказчик! Исполнитель просит отложить&nbsp;&nbsp;срок сдачи заказа на несколько дней, насколько максимально можно отсрочить?</p>', 1, 45, 0, '2015-08-29 16:36:30', 90, NULL),
(246, '<p>Здравствуйте уважаемый заказчик! Исполнитель просит&nbsp;отложить&nbsp;&nbsp;срок сдачи заказа на несколько дней, насколько максимально можно отсрочить?</p>', 1, 45, 0, '2015-08-29 16:39:29', 87, NULL),
(247, '<p>Здравствуйте, Михаил! Ждем Ваше решение по вышеуказанным заказам, мы готовы приступить</p>', 1, 45, 0, '2015-08-29 16:54:24', 86, NULL),
(248, '<p>Здравствуйте, уважаемый Михаил! Спасибо за заказ, хотелось бы узнать его актуальность и согласовать с Вами актуальные сроки выполнения</p>', 1, 45, 0, '2015-08-29 16:59:14', 80, NULL),
(249, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Здравствуйте Артур! ждем Ваш ответ после тестирования присоединенного&nbsp;&nbsp;sql файла, если потребуются корректировки- напишите исполнителю и он выполнит их бесплатно.</span></p>', 1, 43, 0, '2015-08-29 17:03:15', 78, NULL),
(250, '<p>В связи с тестированием части, просим продления срока сдачи заказа.</p>', 1, 43, 0, '2015-08-29 17:05:00', 78, NULL),
(251, '<p>Здравствуйте Артур, автор ждет поля на Perfесе paper,&nbsp;после этого станет возможным выполнить заказ. Ждем от Вас новостей! И большая просьба перенести срок сдачи заказа</p>', 1, 43, 0, '2015-08-29 17:10:33', 77, NULL),
(252, '<p>Здравствуйте Карен! Какой Ваш бюджет по данному заказу?</p>', 1, 53, 0, '2015-08-29 17:46:37', 66, NULL),
(253, 'Я не могу сказать бюджет, пока не узнаю количество ключевых запросов.', 53, 43, 0, '2015-08-29 19:07:31', 66, NULL),
(254, 'нет отложить невозможно мне срочно надо!', 45, 1, 0, '2015-08-29 20:35:14', 90, NULL),
(255, 'удалите этот заказ', 45, 1, 0, '2015-08-29 20:35:59', 62, NULL),
(256, '30.8 включительно максимум!!! ', 45, 1, 0, '2015-08-29 20:37:06', 87, NULL),
(257, 'УДАЛИТЕ ЭТОТ ЗАКАЗ', 45, 1, 0, '2015-08-29 20:41:41', 86, NULL),
(258, 'удалите этот заказ', 45, 1, 0, '2015-08-29 20:42:18', 80, NULL),
(259, 'Разбираюсь', 14, 1, 0, '2015-08-30 00:06:54', 90, NULL),
(260, 'Пароль пользователю приходит', 14, 1, 0, '2015-08-30 01:23:41', 90, NULL),
(261, '1. Сделать макет и согласовать его 2. сделать дизайн или найти типовой\n\nЭто либо один пункт либо под 1 подразумевается не макет, а прототип?\n\nцена указана за полный комплекс работ выше', 42, 45, 0, '2015-08-30 01:42:00', 88, NULL),
(262, '<p>Спасибо. Заказ завершен рейтинг повышен.&nbsp;<br />Номер заказа : 90</p>', 1, 14, 0, '2015-08-30 10:43:48', 90, NULL),
(263, '<p>Здравствуйте, закаp выполнен. За задержку бесплатно. с Ув админтрикс<br />Номер заказа : 90</p>', 1, 45, 0, '2015-08-30 10:44:29', 90, NULL),
(264, 'Приступлю с 12. Где-то час\n', 14, 1, 0, '2015-08-30 12:24:11', 96, NULL),
(265, '<p>Хорошо, Отлично. Назначаем Вас на заказ, срок сдачи не позднее 16:00 (согласно сроку). Бюджет 300 руб.</p>', 1, 14, 0, '2015-08-30 12:26:18', 96, NULL),
(266, 'Hello my frends, me need diplomate for my university', 57, 1, 0, '2015-08-30 13:27:52', 97, NULL),
(267, '<p>Good day , yes we explaince your work in twenty thiousand rubles&nbsp;</p>', 1, 57, 0, '2015-08-30 13:28:43', 97, NULL),
(275, 'Здравствуйте работу выполню ', 56, 1, 0, '2015-08-30 13:54:53', 97, 8000),
(276, '<p>Здравствуйте 7500&nbsp;</p>', 1, 56, 0, '2015-08-30 13:57:14', 97, NULL),
(277, 'Здравствуйте', 56, 57, 1, '2015-08-30 13:57:58', 97, NULL),
(278, 'Я выполню Вашу работу ', 56, 57, 1, '2015-08-30 13:59:32', 97, 5000),
(279, 'алвабвабвла ', 56, 57, 1, '2015-08-30 14:00:20', 97, 5000),
(280, 'ячсячсяс', 56, 57, 1, '2015-08-30 14:00:42', 97, NULL),
(281, 'фывфыв', 56, 1, 0, '2015-08-30 14:01:05', 97, 10000),
(282, 'фывфыв', 56, 57, 1, '2015-08-30 14:01:11', 97, 10000),
(283, 'Часть ', 56, 57, 1, '2015-08-30 14:03:40', 97, 10000),
(284, 'ваываыва', 56, 57, 1, '2015-08-30 14:04:10', 97, NULL),
(285, 'д', 56, 1, 0, '2015-08-30 14:10:50', 97, NULL),
(286, 'Все спс ', 57, 1, 0, '2015-08-30 14:21:59', 97, NULL),
(287, 'Здравствуйте. Сможете выполнить мою работу ? ', 57, 1, 0, '2015-08-30 14:35:55', 98, NULL),
(288, '<p>Здравствуйте , ДА сможем цена данной работы 18000 рублей&nbsp;</p>', 1, 57, 0, '2015-08-30 14:36:16', 98, NULL),
(289, 'Выполню срок 1 неделя', 56, 1, 0, '2015-08-30 14:39:31', 98, 6000),
(291, '<p>Здравствуйте Вы назначены автором</p>', 1, 56, 0, '2015-08-30 14:40:36', 98, NULL),
(292, 'Выполню за 5000', 24, 1, 0, '2015-08-30 14:42:22', 98, NULL),
(293, 'Здравствуйте Вы работаете?', 57, 0, 0, '2015-08-30 14:42:53', 98, NULL),
(294, 'Здравствуйте Вы работаете?', 57, 0, 0, '2015-08-30 14:43:43', 98, NULL),
(295, 'Здравствуйте', 57, 24, 1, '2015-08-30 14:45:09', 98, NULL),
(296, '<p>Здравствуйте .. работа была выслана если необходимы будут доработи автор выполнит их . С Ув..&nbsp;</p>', 1, 57, 0, '2015-08-30 15:00:13', 98, NULL),
(297, 'Здравствуйте все подошло спасибо', 57, 1, 0, '2015-08-30 15:00:44', 98, NULL),
(298, 'здравствуйте', 57, 1, 0, '2015-08-30 15:32:28', 97, NULL),
(299, '<p>Уважаемый срочно продлите срок. Заказ 70.&nbsp;<br /><br /></p>', 1, 45, 0, '2015-08-30 15:43:52', 70, NULL),
(300, 'А так-же просмотреть систему оплат.\nЭто где?', 31, 1, 0, '2015-08-30 15:44:09', 99, NULL),
(301, 'Здравствуйте могу выполнить данную работу ', 56, 1, 0, '2015-08-30 15:44:54', 70, 500),
(302, 'у менеджера в редактировании заказа?', 31, 1, 0, '2015-08-30 15:45:06', 99, NULL),
(303, 'Допустим сделаю это за 2 часа. =)', 31, 1, 0, '2015-08-30 15:46:08', 99, 600),
(304, '<p>"Систему оплат", имеетсяввиду логика. Там значение непонятным образом устанавливаются. оплата заказчику никак не должна влиять на оплату Автору, а у нас сейчас как-то влияет...</p>', 1, 31, 0, '2015-08-30 15:49:50', 99, NULL),
(305, '<p>Назначили Вас исполнителем. Срок указан в форме заказа. Успешной работы</p>', 1, 31, 0, '2015-08-30 15:51:44', 99, NULL),
(306, 'на какой странице находятся действия?', 31, 1, 0, '2015-08-30 15:51:44', 99, NULL),
(307, 'у менеджера в редактировании заказа?', 31, 1, 0, '2015-08-30 15:53:21', 99, NULL),
(308, '<p>http://adco.obshya.com/project/payment/view</p>', 1, 31, 0, '2015-08-30 15:55:05', 99, NULL),
(309, '<p>А блок оплат находится у менеджера, верно.</p>', 1, 0, 0, '2015-08-30 15:55:38', 99, NULL),
(310, '<p>А блок оплат находится у менеджера, верно.</p>', 1, 0, 0, '2015-08-30 15:56:08', 99, NULL),
(312, 'Добрый день . По техническим причинам в данный момент заказ выполнить не могу , в связи с ошибкой сервера на Вашем сайте, исправьте ошибку и сразу же приступлю к работу . ', 56, 45, 1, '2015-08-30 16:04:24', 70, NULL),
(313, '<p>Стоимость заказа составит 1500 руб.</p>', 1, 45, 0, '2015-08-30 16:11:39', 70, NULL),
(314, 'Здравствуйте Это тест ', 57, 56, 1, '2015-08-30 16:41:30', 97, NULL),
(315, 'Проверяйте', 31, 1, 0, '2015-08-30 16:46:08', 99, NULL),
(316, 'Здравствуйте Да я знаю . ', 56, 57, 1, '2015-08-30 16:53:55', 97, NULL),
(317, '<p>здравствуйте</p>', 1, 57, 0, '2015-08-30 17:01:13', 97, NULL),
(318, '<p>Здравствуйте Да я знаю .</p>', 1, 57, 0, '2015-08-30 17:02:40', 97, NULL),
(319, '<p>Здравствуйте, срок сдачи подошел. Если в течение 5 минут работа не будет готова, будем вынуждены снять Вас с заказа.&nbsp;</p>', 1, 14, 0, '2015-08-30 17:02:51', 96, NULL),
(320, '<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Здравствуйте %Дмитрий%.</span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы нарушили срок сдачи части "Вся работа" по заказу 96 </span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">В связи с этим, согласно нашему соглашению, Вы были сняты с заказа без последующей оплаты с понижением рейтинга.</span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вас вернут в заказ, если Вы прикрепите необходимую часть работы до назначения на заказ другого исполнителя, поторопитесь пожалуйста!</span></p>\n<p><span id="docs-internal-guid-82b045d5-7ebc-dc94-ce8b-eddc10955a61"><span style="font-size: 14.6666666666667px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Просьба отнестись с ответственностью к работе.</span></span></p>', 1, 14, 0, '2015-08-30 17:13:18', 96, NULL),
(321, '<p>Работает, спасибо. Вы прямо БОГ &nbsp;+3 к карме.</p>', 1, 31, 0, '2015-08-30 17:15:02', 99, NULL),
(322, 'срок 18 00???', 45, 1, 0, '2015-08-30 17:18:20', 70, NULL),
(323, 'сроки продлил. пока приостановите - там опять проблемы на серв', 45, 1, 0, '2015-08-30 17:23:28', 70, NULL),
(324, '<p>Хорошо, Ждем Вашего ответа .</p>', 1, 45, 0, '2015-08-30 17:33:00', 70, NULL),
(325, 'Здравствуйте выполню ', 24, 1, 0, '2015-08-30 17:47:49', 97, 3458),
(326, 'НЕ РАБОТАЕТ!!!', 45, 1, 0, '2015-08-30 18:02:37', 90, NULL),
(327, '<p>Выполняем корректировки.</p>', 1, 45, 0, '2015-08-30 18:07:25', 90, NULL),
(328, 'и?', 45, 1, 0, '2015-08-30 18:56:36', 100, NULL),
(329, '<p>Мы делаем все возможное, чтобы уложиться в данный Вами срок, но, скорее всего, работа займет больше времени. Подтвердите, пожалуйста, возможность сдать работу через день</p>', 1, 45, 0, '2015-08-30 19:28:16', 87, NULL),
(330, '<p>Здравствуйте! Благодарим за заказ,&nbsp;стоимость данной работы составляет 500 р. Исполнитель приступит к выполнению после предплаты 50% от суммы</p>', 1, 45, 0, '2015-08-30 19:42:26', 100, NULL),
(331, '<p>Вам выписан счет на оплату</p>', 1, 45, 0, '2015-08-30 19:43:08', 100, NULL),
(332, 'В срок уложиться не получится', 31, 1, 0, '2015-08-30 20:37:54', 101, NULL),
(333, '<p>Сегодня успеете ?</p>', 1, 31, 0, '2015-08-30 20:39:02', 101, NULL),
(334, 'Нет', 31, 1, 0, '2015-08-30 20:50:08', 101, NULL),
(335, '<p>Назначили исполнителем, срок смотрите в форме заказа. Удалось кое-как продлить с заказчиком.</p>\n<p>&nbsp;</p>', 1, 31, 0, '2015-08-30 20:52:14', 101, NULL),
(336, '<p>Подтвердите срок выполнения</p>', 1, 31, 0, '2015-08-30 21:03:17', 101, NULL),
(337, 'Думаю за завтрашний день успею', 31, 1, 0, '2015-08-30 21:08:01', 101, NULL),
(338, '<p>Уважаемый заказчик! В связи с загруженностью специалиста, выполнить работу в указанный в заказе срок не представляется возможным, просим перенести дату сдачи заказа.</p>', 1, 43, 0, '2015-08-30 21:09:59', 106, NULL),
(339, '<p>Уважаемый заказчик! В связи с загруженностью специалиста, выполнить работу в указанный в заказе срок не представляется возможным, просим перенести дату сдачи заказа.</p>', 1, 43, 0, '2015-08-30 21:11:19', 109, NULL),
(340, '<p>Уважаемый заказчик! В связи с загруженностью специалиста, выполнить работу в указанный в заказе срок не представляется возможным, просим перенести дату сдачи заказа.</p>', 1, 43, 0, '2015-08-30 21:11:54', 108, NULL),
(341, '<p>Уважаемый заказчик! В связи с загруженностью специалиста, выполнить работу в указанный в заказе срок не представляется возможным, просим перенести дату сдачи заказа.</p>', 1, 43, 0, '2015-08-30 21:14:13', 107, NULL),
(344, 'Что у Вас за компания ? У Вас что один специалист ?', 43, 1, 0, '2015-08-30 21:23:39', 109, NULL),
(345, '<p>Нам доверяют свои заказы множество клиентов, в связи с этим штат специалистов загружен заказами. В ближайшее время эта проблема будет устранена)</p>', 1, 43, 0, '2015-08-30 21:29:51', 109, NULL),
(346, 'Детальнее опишите ', 61, 43, 1, '2015-08-30 21:30:16', 65, NULL),
(347, 'Интересует формат взаимодействия бэкенда и фронтенда, если это REST API (или иное api) то протестирую с помощью самописного клиента, если же это монолитное приложение, то могу написать тесты для Yii.', 59, 45, 0, '2015-08-30 21:35:10', 87, 3000),
(348, 'Извините, можно ли узнать по подробнее о админке, самое главное - на чем написана?', 59, 43, 1, '2015-08-30 21:38:33', 77, NULL),
(349, 'Доброго времени суток! Готов качественно, честно, с полной самоотдачей и в поставленные сроки выполнить работу!', 62, 43, 0, '2015-08-30 21:38:43', 59, 3000),
(350, 'Готов выполнить ', 61, 43, 0, '2015-08-30 21:41:40', 59, 4000),
(351, '<p>Стоимость работы уточнена и она составит 9000 р, подтвердите пожалуйста бюджет</p>', 1, 45, 0, '2015-08-30 21:46:32', 87, NULL),
(352, '<p>Здравствуйте! В связи непредвиденной сложностью проекта, вынуждены поднять стоимость работы до 7000 р, подтвердите пожалуйста бюджет</p>', 1, 43, 0, '2015-08-30 21:51:07', 59, NULL),
(353, '<p>проект тестировать ещё рано!!</p>', 1, 45, 0, '2015-08-30 21:52:29', 87, NULL),
(354, '<p>(Артём)</p>', 1, 45, 0, '2015-08-30 21:52:48', 87, NULL),
(355, 'Здравствуйте, по всем моим заказам СЕО, мне сначала нужен План продвижения.  \nНадеюсь Вы сможете мне предоставить его без оплаты. И по нему будем работать с Вами.', 43, 1, 0, '2015-08-30 22:03:02', 59, NULL),
(356, 'Готов выполнить за сегодня-завтра(так долго потому что отъехать на пол-дня надо будет). Что по цене?', 41, 43, 0, '2015-08-30 22:09:52', 110, 1200),
(357, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Здравствуйте, по всем &nbsp;заказам СЕО сначала нужен План продвижения. Надеюсь Вы сможете мне предоставить его без оплаты. И по нему будем работать с Вами.</span></p>', 1, 62, 0, '2015-08-30 22:16:45', 59, NULL),
(358, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Здравствуйте, по всем &nbsp;заказам СЕО сначала нужен План продвижения. Надеюсь Вы сможете мне предоставить его без оплаты. И по нему будем работать с Вами.</span></p>', 1, 61, 0, '2015-08-30 22:17:07', 59, NULL),
(359, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Здравствуйте, по всем &nbsp;заказам СЕО сначала нужен План продвижения. Надеюсь Вы сможете мне предоставить его без оплаты. И по нему будем работать с Вами.</span></p>', 1, 53, 0, '2015-08-30 22:17:32', 59, NULL),
(360, '<p>Здравствуйте! В связи с непредвиденной сложностью Вашего заказа вынуждены поднять его бюджет до 3000 р , подтвердите пожалуйста бюджет</p>', 1, 43, 0, '2015-08-30 22:19:50', 110, NULL),
(361, '<p>Здравствуйте, может будет возможность выполнить за 1000 руб ?</p>', 1, 41, 0, '2015-08-30 22:20:31', 110, NULL),
(362, 'Да, давайте так.', 41, 43, 0, '2015-08-30 22:21:36', 110, NULL),
(363, '<p>Хорошо спасибо. Ввиду Вашего рейтинга назначаем Вас.</p>', 1, 41, 0, '2015-08-30 22:22:24', 110, NULL),
(364, 'Дайте ваш мейл, я вам скину на почту план', 61, 43, 1, '2015-08-30 22:25:33', 59, NULL),
(365, 'Хорошо)).. Давайте fpt от сайта тогда', 41, 43, 0, '2015-08-30 22:25:59', 110, NULL),
(366, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Предоставьте, пожалуйста,&nbsp;&nbsp;fpt от сайта&nbsp;</span></p>', 1, 43, 0, '2015-08-30 22:27:12', 110, NULL),
(367, '<p>Вы его можете загрузить прямо в заказ</p>', 1, -1, 0, '2015-08-30 22:31:33', 59, NULL),
(369, 'Кто такой Артем?? но согласен с Вам кто бы Вы не были... Пока приостановите проект', 45, 1, 0, '2015-08-31 00:34:58', 87, NULL),
(370, 'а как это сделать? просто так не прикрепляется ', 61, 43, 0, '2015-08-31 00:48:39', 59, NULL),
(371, '<p>Можно прикрепить файл в часть которая называется "План". Жмете по названию и загружаете в окошко файл.</p>', 1, 61, 0, '2015-08-31 01:17:17', 59, NULL),
(372, 'http://joxi.ru/1A5b1PpcwJvbrE - уже пытался\n', 61, 43, 0, '2015-08-31 01:35:55', 59, NULL),
(373, '<p>Что именно не получилось у Вас ?</p>', 1, 61, 0, '2015-08-31 02:10:12', 59, NULL),
(375, '<p>Дело в том, что Вы пытаетесь засунуть файл в комментарий. Нажмите кнопочку для загрузки файлаЮ или переместите файл в специальную область.</p>', 1, 61, 0, '2015-08-31 02:12:57', 59, NULL),
(376, 'так я и переместил в спец область, а не в чат, кнопки нет у меня\n', 61, 43, 0, '2015-08-31 02:37:37', 59, NULL),
(377, 'http://joxi.ru/nAyzQ48tkb4lrZ\n', 61, 43, 0, '2015-08-31 02:38:29', 59, NULL),
(378, '<p>Да извините, сейчас решим вопрос, это технический какой-то прикол.</p>', 1, 61, 0, '2015-08-31 02:58:55', 59, NULL),
(379, '<p>Загружайте</p>', 1, 61, 0, '2015-08-31 03:03:54', 59, NULL),
(380, 'о есть', 61, 43, 0, '2015-08-31 03:05:47', 59, NULL),
(381, '<p>Здравствуйте! План продвижения готов, ждем его утверждения!</p>', 1, 43, 0, '2015-08-31 10:30:58', 59, NULL),
(382, '<p>Андрей, просмотрите пожалуйста свободные заказы по СЕО, может еще возьмете</p>', 1, 61, 0, '2015-08-31 10:35:36', 59, NULL),
(383, '<p>Здравствуйте! Уточните, пожалуйста, объем работ</p>', 1, 43, 0, '2015-08-31 10:53:53', 65, NULL),
(384, '<p>Уважаемый заказчик! Ввиду занятости специалистов, сдать проект в указанный в заказе срок не представляется возможным. Просим Ваше добро на перенос сроков. Спасибо</p>', 1, 45, 0, '2015-08-31 11:19:09', 89, NULL),
(385, 'сделаю', 52, 43, 0, '2015-08-31 11:35:28', 102, 300);
INSERT INTO `1_ProjectMessages` (`id`, `message`, `sender`, `recipient`, `moderated`, `date`, `order`, `cost`) VALUES
(386, 'Качественно, честно и в поставленные сроки выполню работу.', 62, 43, 0, '2015-08-31 11:56:30', 65, 2000),
(387, '<p>Вы назначены в проект. Ваш бюджет 300. Ознакомьтесь, пожалуйста. со сроками сдачи частей</p>', 1, 52, 0, '2015-08-31 12:00:56', 102, NULL),
(388, '<p>бюджет этой работы 900 р, возьмете?</p>', 1, 62, 0, '2015-08-31 12:02:46', 65, NULL),
(389, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Ну ориентировочно к примеру по 3-м запросам.</span></p>', 1, 53, 0, '2015-08-31 12:09:43', 66, NULL),
(390, 'Здравствуйте.\nПримерно 300$ (250$ при добавлении проекта в портфолио, положительных отзывах и обратной ссылке). Сроки около недели.\nhttp://lsoft.io/promo', 68, 45, 0, '2015-08-31 12:11:22', 88, 300),
(391, 'Нужно уточнить следующие моменты:\n1) Регион продвижения\n2) Какие именно ключевые запросы (частотность)\n3) Посмотреть на сайт (если он кривой, то нужно начать с редактирования)\n\nВот тогда я смогу сказать стоимость работ.', 53, 43, 1, '2015-08-31 12:26:01', 66, NULL),
(392, '<p>Дороговато</p>', 1, 68, 0, '2015-08-31 12:58:48', 88, NULL),
(393, '<p>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</p>', 1, 43, 0, '2015-08-31 13:09:26', 108, NULL),
(394, 'готово', 52, 43, 0, '2015-08-31 13:18:46', 102, NULL),
(395, '<p>Хорошо, спасибо. Повысили Вам рейтинг.</p>', 1, 52, 0, '2015-08-31 13:24:53', 102, NULL),
(396, '<p>Отписывайтесь и в другие проекты, будем рады.</p>', 1, 52, 0, '2015-08-31 13:25:26', 102, NULL),
(397, '<p>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</p>', 1, 43, 0, '2015-08-31 13:27:14', 107, NULL),
(398, '<ul>\n<li>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</li>\n</ul>', 1, 43, 0, '2015-08-31 13:28:29', 106, NULL),
(399, '<p>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</p>', 1, 43, 0, '2015-08-31 13:29:36', 105, NULL),
(400, '<p>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</p>', 1, 43, 0, '2015-08-31 13:30:27', 104, NULL),
(401, '<p>Задача 23. Поле так и не изменилось...</p>', 1, 52, 0, '2015-08-31 13:31:07', 102, NULL),
(403, '<p>Здравствуйте! Возможен ли перенос сроков? ждем Ваше решение</p>', 1, 43, 0, '2015-08-31 13:38:38', 103, NULL),
(404, 'Добрый день.\nПлан продвижения уже составлен? Ключевые слова подобраны? Перелинковка осуществляется для создания пирамидальной структуры сайта.', 66, 43, 1, '2015-08-31 13:52:48', 64, NULL),
(405, '<p>Здравствуйте, Артем. Приближается срок сдачи задачи.</p>', 1, 31, 0, '2015-08-31 14:01:02', 101, NULL),
(406, 'Какой сайт. Скиньте сем ядро, по которому продвижение', 61, 43, 1, '2015-08-31 14:03:24', 66, NULL),
(407, 'Програмирую на Java, можно ТЗ дл я подробностей', 67, 43, 0, '2015-08-31 14:05:28', 77, 1000),
(408, 'Вам нужно перелинковать все кроме главной, Новости и статьи. Но сами новости и статьи, на который идет переход, вот их бы нужно.', 61, 43, 0, '2015-08-31 14:08:48', 64, 5000),
(409, 'После аудита вашего сайта были обнаружены следующие оишибки:\n1. 51 страница была проиндексирована - не прописан тег title на 26 страницах.\n2. 35 страниц не прописаны ключевые слова.\n3. 35 страниц отсутствует тег description\nИсправить можно, не проблема.\n\n4. 50 страниц отсувствует заголовок H1', 69, 43, 1, '2015-08-31 14:38:55', 64, 50),
(410, '<p>Вы готовы взяться за заказ? Какой Ваш бюджет?</p>', 1, 69, 0, '2015-08-31 15:01:52', 64, NULL),
(411, '<p>Какой реальный бюджет? 5000 р - это сильно высокая цена для подобной работы</p>', 1, 61, 0, '2015-08-31 15:03:52', 64, NULL),
(412, 'Если не перелинковать статьи новости, их там около сотни страниц, тогда 1500р', 61, 43, 0, '2015-08-31 15:07:09', 64, NULL),
(416, 'Сегодня с Артуром решим как точно нужно сделать. Возможно за сегодня успею.', 31, 1, 0, '2015-08-31 15:15:16', 101, NULL),
(417, '<p>Постарайтесь решить оперативнее. Сроки сдачи горят</p>', 1, 31, 0, '2015-08-31 15:21:04', 101, NULL),
(418, '<p>На Yii (На php)</p>', 1, 59, 0, '2015-08-31 15:29:59', 77, NULL),
(419, 'п.23 я менял имя  поля тут http://adco.obshya.com/project/zakaz/create', 52, 43, 1, '2015-08-31 15:40:09', 102, NULL),
(421, 'За все, все сделаем быстро и без задержек!', 69, 43, 0, '2015-08-31 15:51:16', 64, NULL),
(422, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">В ходе&nbsp;аудита вашего сайта были обнаружены следующие оишибки: 1. 51 страница была проиндексирована - не прописан тег title на 26 страницах. 2. 35 страниц не прописаны ключевые слова. 3. 35 страниц отсутствует тег description Исправить можно, не проблема. 4. 50 страниц отсувствует заголовок H1</span></p>\n<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">С учетом их устранения,&nbsp;&nbsp;стоимость заказа&nbsp;составит 3500 р, &nbsp;подтвердите, пожалуйста, бюджет</span></p>', 1, 43, 0, '2015-08-31 15:58:08', 64, NULL),
(424, '<p>Извините, сообщение с ценой было отправлено ошибочно, бюджет этого заказа намного меньше, напишите Ваш бюджет и обсудим.</p>', 1, 69, 0, '2015-08-31 16:00:31', 64, NULL),
(425, 'Хорошо, там работы не особо много, 500р вполне нормальная цена?!', 69, 43, 0, '2015-08-31 16:07:59', 64, NULL),
(426, 'Так вы готовы к сотрудничеству?Оплата будет по факту работы.', 69, 43, 0, '2015-08-31 16:59:23', 64, NULL),
(427, 'Готов выполнить ', 73, 43, 0, '2015-08-31 17:00:05', 109, NULL),
(428, '<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;">&nbsp;</p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы назначены Исполнителем заказа </span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ваш бюджет составит 500 рублей.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Еще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. Работу необходимо сдавать по частям, соблюдая сроки сдачи каждой части </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #434343; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">указанные в заказе</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Пожалуйста, проверяйте Вашу почту и чат </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">не реже одного раза в день</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заранее. За </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">нарушение сроков сдачи</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> без уважительной причины применяются штрафные санкции!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Если Вы не сдаете вовремя работу, не оповестив нас об этом заранее, и при этом не выходите на связь мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля и прекратить с Вами сотрудничество.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Надеемся на Ваше понимание ответственности перед Заказчиком!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">После успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Исполнителя. Чем выше рейтинг &ndash; тем чаще Вас будут назначать исполнителем на &nbsp;заказы. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Исполнителями</span></p>\n<p style="color: #333333; font-family: sans-serif, Arial, Verdana, ''Trebuchet MS''; font-size: 13px; line-height: 20.7999992370605px;"><strong id="docs-internal-guid-bf514a73-83d6-e876-841b-5f0f1f16ca7b" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!</span></p>\n<p style="color: #333333; font-family: sans-serif, Arial, Verdana, ''Trebuchet MS''; font-size: 13px; line-height: 20.7999992370605px;">&nbsp;</p>', 1, 69, 0, '2015-08-31 17:00:16', 64, NULL),
(429, 'готов выполнить', 73, 1, 0, '2015-08-31 17:03:16', 107, NULL),
(430, 'готов выполнить', 73, 43, 0, '2015-08-31 17:03:47', 108, NULL),
(431, 'Заказ принял, приступаю к работе!', 69, 43, 0, '2015-08-31 17:04:42', 64, NULL),
(432, '<p>Отпишитесь по остальным сеошным заказам, может, еще возьмете</p>', 1, 69, 0, '2015-08-31 17:05:28', 64, NULL),
(433, '<p>Успешной работы!</p>', 1, 69, 0, '2015-08-31 17:05:39', 64, NULL),
(434, 'Что именно входит в этот бюджет? Покупка площадок под ссылки? Написание статей? Работа?', 62, 43, 1, '2015-08-31 17:07:12', 65, NULL),
(435, 'Будьте добры доступ к сервису?!', 69, 43, 1, '2015-08-31 17:07:46', 64, NULL),
(436, '<p>Давайт обсудим бюджет</p>', 1, 73, 0, '2015-08-31 17:09:19', 109, NULL),
(437, 'Админ доступ пожалуйста????', 69, 43, 1, '2015-08-31 17:11:48', 64, NULL),
(438, '<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;">&nbsp;</p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы назначены Исполнителем заказа </span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ваш бюджет составит 400 рублей.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Еще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. Работу необходимо сдавать по частям, соблюдая сроки сдачи каждой части </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #434343; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">указанные в заказе</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Пожалуйста, проверяйте Вашу почту и чат </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">не реже одного раза в день</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заранее. За </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">нарушение сроков сдачи</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> без уважительной причины применяются штрафные санкции!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Если Вы не сдаете вовремя работу, не оповестив нас об этом заранее, и при этом не выходите на связь мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля и прекратить с Вами сотрудничество.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Надеемся на Ваше понимание ответственности перед Заказчиком!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">После успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Исполнителя. Чем выше рейтинг &ndash; тем чаще Вас будут назначать исполнителем на &nbsp;заказы. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Исполнителями</span></p>\n<p><strong id="docs-internal-guid-bf514a73-83e2-1ef8-20f3-a0afc7ee4234" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!</span></p>\n<p>&nbsp;</p>', 1, 73, 0, '2015-08-31 17:11:49', 107, NULL),
(439, 'номера заданий этот столбец http://c2n.me/3mQqUM3?\n', 73, 1, 0, '2015-08-31 17:11:55', 109, NULL),
(440, 'уточните пожалуйста "Номера :" это столбец http://clip2net.com/s/3mQqUM3 этот?', 73, 1, 0, '2015-08-31 17:13:53', 107, NULL),
(441, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">уточните пожалуйста "Номера :" это столбец http://clip2net.com/s/3mQqUM3 этот?</span></p>', 1, 43, 0, '2015-08-31 17:14:25', 107, NULL),
(442, 'Готов сделать и эту часть работы, после этой!\nБюджет обсудим!', 69, 43, 0, '2015-08-31 17:16:04', 76, NULL),
(443, '<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;">&nbsp;</p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы назначены Исполнителем заказа </span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ваш бюджет составит 400 рублей.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Еще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. Работу необходимо сдавать по частям, соблюдая сроки сдачи каждой части </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #434343; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">указанные в заказе</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Пожалуйста, проверяйте Вашу почту и чат </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">не реже одного раза в день</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заранее. За </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">нарушение сроков сдачи</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> без уважительной причины применяются штрафные санкции!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Если Вы не сдаете вовремя работу, не оповестив нас об этом заранее, и при этом не выходите на связь мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля и прекратить с Вами сотрудничество.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Надеемся на Ваше понимание ответственности перед Заказчиком!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">После успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Исполнителя. Чем выше рейтинг &ndash; тем чаще Вас будут назначать исполнителем на &nbsp;заказы. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Исполнителями</span></p>\n<p><strong id="docs-internal-guid-bf514a73-83e9-1f4e-9890-2f6cf612613f" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!</span></p>\n<p>&nbsp;</p>', 1, 73, 0, '2015-08-31 17:19:39', 108, NULL),
(444, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">номера заданий этот столбец http://c2n.me/3mQqUM3?</span></p>', 1, 43, 0, '2015-08-31 17:25:56', 109, NULL),
(446, '<p>Давайте обсудим, какой Ваш желаемый бюджет по этому заказу?</p>', 1, 69, 0, '2015-08-31 17:28:10', 76, NULL),
(447, '<p>Уважаемый заказчик, просьба перенести сроки выполнения заказа и уточнить бюджет</p>', 1, 43, 0, '2015-08-31 17:29:23', 76, NULL),
(448, 'Подскажите плиз, 34 нет в док-те И мне 2 заказа одновременно дали.', 73, 43, 1, '2015-08-31 17:37:33', 107, NULL),
(449, 'http://adco.obshya.com/project/zakaz/create - это форма заказа?\n', 73, 1, 0, '2015-08-31 17:41:02', 107, NULL),
(450, '<p>да</p>', 1, 73, 0, '2015-08-31 17:45:13', 107, NULL),
(451, '28 - отсутствует в документе\n29 - возьмусь\n30 - не совсем понятно задание\n38 - возьмусь\n41 - возьмусь, но следует сделать уточнения\n\nЗаймусь сегодня же, если получиться хорошая обратная связь - думаю завтра будет сделанно', 74, 43, 0, '2015-08-31 17:45:33', 109, 800),
(452, '<p>Вы можете одновременно выполнять сколько угодно заказов, лишь бы в сроки вписывались</p>', 1, 73, 0, '2015-08-31 17:46:26', 107, NULL),
(453, 'Не могу найти "Заметки для автора"', 73, 1, 0, '2015-08-31 17:46:30', 107, NULL),
(454, '<p>Максимальный бюжет по этому заказу 370 р</p>', 1, 74, 0, '2015-08-31 17:47:44', 109, NULL),
(455, 'Хорошо, всё-равно возьмусь. Но ножны уточнения, в предыдущем сообщении я указал какие', 74, 43, 0, '2015-08-31 17:50:36', 109, NULL),
(456, 'Ну и собственно где исправлять', 74, 43, 0, '2015-08-31 17:51:15', 109, NULL),
(457, '<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;">&nbsp;</p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы назначены Исполнителем заказа</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ваш бюджет составит 370 рублей.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Еще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. Работу необходимо сдавать по частям, соблюдая сроки сдачи каждой части </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #434343; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">указанные в заказе</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Пожалуйста, проверяйте Вашу почту и чат </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">не реже одного раза в день</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заранее. За </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">нарушение сроков сдачи</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> без уважительной причины применяются штрафные санкции!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Если Вы не сдаете вовремя работу, не оповестив нас об этом заранее, и при этом не выходите на связь мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля и прекратить с Вами сотрудничество.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Надеемся на Ваше понимание ответственности перед Заказчиком!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">После успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Исполнителя. Чем выше рейтинг &ndash; тем чаще Вас будут назначать исполнителем на &nbsp;заказы. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Исполнителями</span></p>\n<p><strong id="docs-internal-guid-bf514a73-8406-d083-78bb-c0fa7468a28e" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!</span></p>\n<p>&nbsp;</p>', 1, 0, 0, '2015-08-31 17:51:50', 109, NULL),
(462, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Просьба уточнить задание: 28 - отсутствует в документе 29 - возьмусь 30 - не совсем понятно задание 38 - возьмусь 41 - возьмусь, но следует сделать уточнения Займусь сегодня же, если получиться хорошая обратная связь - думаю завтра будет сделанно</span></p>', 1, 43, 0, '2015-08-31 17:55:03', 109, NULL),
(463, '<p>В ерхнем левом углу в примечаниях по заказу</p>', 1, 73, 0, '2015-08-31 17:57:45', 107, NULL),
(464, '28 - отсутствует в документе\n29 - возьмусь \n30 - не совсем понятно задание \n38 - возьмусь \n41 - возьмусь, но следует сделать уточнения \n\nЭто моя первая работа с вашей компанией, и я не совсем понял, где мне исправлять ошибки. Запрашиваю более подробную информацию', 74, 1, 0, '2015-08-31 17:58:51', 109, 370),
(465, 'Возможен, завтра крайний.', 43, 1, 0, '2015-08-31 18:01:47', 108, NULL),
(467, 'Мне дадут еще какие-то материалы, кроме того, что есть в баг трекере?', 74, 43, 0, '2015-08-31 18:07:37', 109, NULL),
(468, '<p>Здравствуйте, а что Вам необходимо ? Инструкция есть исходя из неё можно работать.</p>', 1, 74, 0, '2015-08-31 18:10:19', 109, NULL),
(469, '<p>28 -Выполена, ну нужно делать. 30 задача, увеличить лимит заказов на одну страницу, а лучше вообещ убрать. Т.е сейчас на стр 10 заказов помещается. Чтобы не серфать по страницам сделать чтоыб все заказы были на одной.&nbsp;</p>\n<p>&nbsp;</p>', 1, 74, 0, '2015-08-31 18:11:39', 109, NULL),
(470, '<p>Простите, а что значит, цитируем : "<span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Это моя первая работа с вашей компанией, и я не совсем понял, где мне исправлять ошибки. Запрашиваю более подробную информацию" &nbsp; Вы читали инструкцию ?</span></p>', 1, 74, 0, '2015-08-31 18:15:20', 109, NULL),
(471, 'Вот мы с вами и пришли к причине непонимания. Нет, я не видел никакой инструкции, только багтрекер', 74, 43, 0, '2015-08-31 18:16:12', 109, NULL),
(472, 'Можно поинтересоваться, где мне найти эту инструкцию?', 74, 43, 0, '2015-08-31 18:18:39', 109, NULL),
(473, '<p>Да конечно, сейчас разберемся, скажите нам пожалуйста как Вы тогда попали в данный заказ ? Его специальность "админтрикс"</p>', 1, 74, 0, '2015-08-31 18:19:37', 109, NULL),
(474, 'На самом деле, я специализируюсь на автоматизированном тестировании. Но и с бек-эндом немного работал. Я регистрировался для определенного заказа (нашел на сайте для фрилансеров). Но после регистрации, по моим навыкам такого не было. И я выделил все навыки, чтобы посмотреть больше заказов. Увидел этот заказ (решил, что работы не много и не сложная). Решил взяться. \nПохожие баги правил на сайтах.\nА то, что это админтрикс, я даже не знал (в информации о заказе это не отображается) - Вот вам идея по улучшению.\n\nИзвините, что потратил ваше время. Но если я всё-таки получу заветную инструкцию, то готов продолжить работу с заказом (если это возможно)', 74, 43, 0, '2015-08-31 18:24:46', 109, NULL),
(475, '<p>Ответьте тогда на последний вопрос пожалуйста, у Вас имеются знания yii 1.16 ? &nbsp;Ваш ответ будет ответом на то, сможете Вы продолжать или нет.</p>', 1, 74, 0, '2015-08-31 18:28:33', 109, NULL),
(476, 'Отвечу вам честно, нет я не работал с php раньше. Но я хорошо знаком с c# (около двух лет), и уверен, что разберусь. В конце концов мне нужно исправить в основном мелкие дефекты (пара строчек кода). ', 74, 43, 0, '2015-08-31 18:32:19', 109, NULL),
(477, '<p>В таком случае извините, мы ценим Ваше желание. Проект по тестированию Бэкенда вероятно будет ещё актуален. Вам придет уведомление на почту.</p>', 1, 74, 0, '2015-08-31 18:35:08', 109, NULL),
(478, 'Хорошо, большое спасибо. И вы тоже извините, мы с вами просто недопоняли друг-друга. Я всё-таки поставлю фреймворк, посмотрю, что да как. Хорошего вам дня.', 74, 43, 0, '2015-08-31 18:40:22', 109, NULL),
(479, '<p>Здравствуйте, можно выполнять. Если готовы</p>', 1, 73, 0, '2015-08-31 18:48:45', 109, NULL),
(480, '<p>Здравствуйте, нам требуется комплексное продвижение, по плану который нужно подготовить. Вы сможете таким образом сотрудничать ?</p>', 1, 69, 0, '2015-08-31 19:42:20', 64, NULL),
(481, '<p>Здравствуйте. Вы указали Вашу цену 2 000. Это за что ? В месяц ?</p>', 1, 62, 0, '2015-08-31 19:46:27', 65, NULL),
(482, 'замечания будут?', 52, 43, 1, '2015-08-31 19:55:43', 102, NULL),
(483, '<p>Здравствуйте, нам нужен план работы, после чего по нему будем работать.</p>', 1, 69, 0, '2015-08-31 19:58:01', 76, NULL),
(484, '<p>Здравствуйте, продлите пожалуйста срок, задача довольно объемная.</p>', 1, 45, 0, '2015-08-31 20:19:05', 88, NULL),
(485, 'Беру на исполнение. ', 64, 1, 0, '2015-08-31 22:01:26', 96, 2);
INSERT INTO `1_ProjectMessages` (`id`, `message`, `sender`, `recipient`, `moderated`, `date`, `order`, `cost`) VALUES
(486, '<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Здравствуйте Дмитрий</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы назначены Исполнителем заказа </span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Ваш бюджет составит 300 рублей.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Еще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. Работу необходимо сдавать по частям, соблюдая сроки сдачи каждой части </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #434343; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">указанные в заказе</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Пожалуйста, проверяйте Вашу почту и чат </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">не реже одного раза в день</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заранее. За </span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #333333; background-color: #ffffff; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">нарушение сроков сдачи</span><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> без уважительной причины применяются штрафные санкции!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Если Вы не сдаете вовремя работу, не оповестив нас об этом заранее, и при этом не выходите на связь мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля и прекратить с Вами сотрудничество.</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Надеемся на Ваше понимание ответственности перед Заказчиком!</span></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">После успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Исполнителя. Чем выше рейтинг &ndash; тем чаще Вас будут назначать исполнителем на &nbsp;заказы. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Исполнителями</span></p>\n<p><strong id="docs-internal-guid-bf514a73-84fb-1678-7c03-3cb938cf9c47" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.8719999313354452; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;"> Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!</span></p>\n<p>&nbsp;</p>', 1, 64, 0, '2015-08-31 22:18:56', 96, NULL),
(487, '<p>Уважаемый заказчик! Просим Вае добро на продление сроков сдачи работы до завтра</p>', 1, 43, 0, '2015-08-31 22:22:12', 96, NULL),
(488, 'Выполнил', 31, 1, 0, '2015-08-31 22:28:41', 100, NULL),
(490, '<p>Ок, спасибо!</p>', 1, 31, 0, '2015-08-31 22:30:38', 100, NULL),
(491, '<p>Заказ выполнен, Вам выписан счет на оплату</p>', 1, 45, 0, '2015-08-31 22:32:50', 100, NULL),
(492, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Здравствуйте! Автор просит предоставить fpt от сайта и перенести срок сдачи</span></p>', 1, 43, 0, '2015-08-31 22:39:48', 110, NULL),
(493, '<p>Здравствуйте! Вы приступил к проекту?</p>', 1, 73, 0, '2015-08-31 22:51:31', 109, NULL),
(494, '<p>Вы приступили к проекту?</p>', 1, 73, 0, '2015-08-31 22:53:27', 108, NULL),
(495, '<p>Нашли? Выполняете?</p>', 1, 73, 0, '2015-08-31 22:54:23', 107, NULL),
(496, '<p>Просим перенести срок сдачи заказа ввиду непредвиденного увеличения объема работ</p>', 1, 43, 0, '2015-08-31 22:55:17', 107, NULL),
(497, 'Администратор, тут?', 41, 1, 0, '2015-09-01 00:23:23', 110, NULL),
(498, 'В моём понимании 2000 - это за работу! А сам бюджет на закупку ссылок и написание статей - дополнительные траты!', 62, 43, 0, '2015-09-01 09:06:44', 65, NULL),
(499, '<p>Здравствуйте! Вы приступили к выполнению? Если есть какие-нибудь вопросы или замечания- пишите. все обсуждаемо</p>', 1, 64, 0, '2015-09-01 10:06:57', 96, NULL),
(500, '<p>Какой бюджет составит закупка ссылок и написание статей?</p>', 1, 62, 0, '2015-09-01 10:10:09', 65, NULL),
(501, '<p>Артем, здравствуйте! Во сколько сегодня ждать работу?</p>', 1, 31, 0, '2015-09-01 10:12:06', 101, NULL),
(502, '<p>Почему на остальные заказы по сео не заходите? Много же свободных, а нам интересно было бы все комплексно сдать</p>', 1, 61, 0, '2015-09-01 10:17:31', 59, NULL),
(503, '<p>Уважаемый заказчик, актуален ли заказ? Можно ли срок передвинуть?&nbsp;</p>', 1, 43, 0, '2015-09-01 10:19:56', 106, NULL),
(504, 'Для этого мне нужно понимать сколько ключевых слов мы будем продвигать!', 62, 43, 0, '2015-09-01 10:31:03', 65, NULL),
(505, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Здравствуйте! Автор интересуется, сколько ключевых слов необходимо продвигать?</span></p>', 1, 43, 0, '2015-09-01 11:22:06', 65, NULL),
(506, '<p>Павел, отпишитесь пожалуйста, время не ждет. Вы будете выполнять или нет. Проект то срочный</p>', 1, 73, 0, '2015-09-01 12:05:50', 109, NULL),
(507, '<p>Уважаемый заказчик! Просьба по всем заказам уточнить актуальность и перенести сроки. Спасибо</p>', 1, 43, 0, '2015-09-01 12:07:40', 109, NULL),
(508, '<p>Вы план делаете? Не пропадайте, пожалуйста, выходите на связь</p>', 1, 69, 0, '2015-09-01 12:09:09', 76, NULL),
(509, '<p>Здравствуйте. Автор ждет информацию.</p>', 1, 43, 0, '2015-09-01 12:23:59', 66, NULL),
(510, '<p>Уважаемый заказчик! В связи с значительным объемом заказа, выполнить его в указанный срок не представляется возможным. Просьба продлить срок. Ждем Ваше решение</p>', 1, 45, 0, '2015-09-01 12:27:11', 88, NULL),
(511, 'Ok', 45, 1, 0, '2015-09-01 12:29:07', 88, NULL),
(512, '<p>Спасибо. Срок выполнения Вашего заказа продлен на неделю</p>', 1, 45, 0, '2015-09-01 12:44:06', 88, NULL),
(513, '<p>Павел, просьба почаще&nbsp;проверять чат по взятым заказам&nbsp;и вовремя отвечать на сообщения, чтобы была понятна ситуация по заказу. Это не займет много времени. Спасибо</p>', 1, 73, 0, '2015-09-01 12:46:33', 107, NULL),
(514, 'Связывайтесь с заказчиком, мне нужно работать, доступ?!', 69, 43, 1, '2015-09-01 12:53:44', 64, NULL),
(515, 'Добрый день. Нашел в разных местах. Просьба бы уточнить. Странно выходить, что на выполнение 1 час (я бы и за 10 мин сделал если бы понял), а ответ ваш приходит через 5 часов', 73, 1, 0, '2015-09-01 13:35:17', 107, NULL),
(516, 'и чат надо сменить миниатюры. Визуально не удобно, понять кто кому пишет', 73, 1, 0, '2015-09-01 13:36:19', 107, NULL),
(517, '<p>Сроки обсуждаемы и конечно будут переноситься, в случае задержки ответа от заказчика. Павел, поставьте нас пожалуйста в известность, выполняется ли заказ. Ваши пожелания учтем.</p>', 1, 73, 0, '2015-09-01 13:39:11', 107, NULL),
(518, 'Если вы мне покажите ссылку и где что надо сделать, тогда сделаю. ', 73, 1, 0, '2015-09-01 13:46:36', 107, NULL),
(519, '<p>тз в информации о заказе (внизу страницы по стрелочке): https://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0</p>\n<p>Номера : 33, 34, 35, 36</p>', 1, 73, 0, '2015-09-01 13:50:51', 107, NULL),
(520, '<p>Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 64 и 65, ищем на них исполнителя</p>', 1, 69, 0, '2015-09-01 13:53:12', 76, NULL),
(521, '<p>Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 64 и 76, ищем на них исполнителя!</p>', 1, 62, 0, '2015-09-01 13:54:00', 65, NULL),
(522, '<p>Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 65 и 76, ищем на них исполнителя!</p>', 1, 42, 0, '2015-09-01 13:54:48', 64, NULL),
(523, '<p>Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 65 и 76, ищем на них исполнителя!</p>', 1, 66, 0, '2015-09-01 13:55:05', 64, NULL),
(524, 'нет 34', 73, 1, 0, '2015-09-01 13:55:52', 107, NULL),
(525, '<p>Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 65 и 76, ищем на них исполнителя!</p>', 1, 61, 0, '2015-09-01 13:56:43', 64, NULL),
(526, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px;">Посмотрите, пожалуйста, остальные заказы по СЕО, а именно: 65 и 76, ищем на них исполнителя!</span></p>', 1, 69, 0, '2015-09-01 13:58:35', 64, NULL),
(527, '<p>Павел, выйдите, пожалуйста, на связь, срок сдачи уже подходит!</p>', 1, 73, 0, '2015-09-01 14:03:00', 108, NULL),
(528, '<p>Да, готовы ответить на все Ваши вопросы, с&nbsp;<span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">&nbsp;</span><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">fpt от сайта</span><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">&nbsp;уточняем у заказчика.</span></p>', 1, 41, 0, '2015-09-01 14:16:49', 110, NULL),
(529, '<p>если нет- значит, он уже не актуален. Делайте те, что есть в документе</p>', 1, 73, 0, '2015-09-01 14:27:09', 107, NULL),
(530, '64-го заказа нет! Скорее всего уже поручили кому-то! На счёт 76-го пункта - могу взяться!', 62, 43, 0, '2015-09-01 15:05:08', 65, NULL),
(531, '<p>ок, давайте обсудим бюджет</p>', 1, 62, 0, '2015-09-01 15:24:17', 65, NULL),
(532, 'здрасте; ваш сайт на Modx ?\n', 86, 43, 1, '2015-09-01 15:37:59', 77, NULL),
(533, 'Добрый день, не могу ответить в прошлом проекте. Я так понимаю Вам комплексное продвижение необходимо? \nОбычно, за такую работу в месяц беру 13 000 рублей, без учета бюджета на закупку ссылок и оплаты работы копирайтера.', 66, 43, 0, '2015-09-01 15:49:58', 76, NULL),
(534, 'Сделал 2 сообщения. "Восстановление пароля" и "Заказчику после регистрации." Во втором сообщении не получится отправить заказчику пароль, т.к. он уже зашифрован.', 64, 1, 0, '2015-09-01 15:56:59', 96, NULL),
(535, 'Бюджет за эту работу абсолютно нереален.', 64, 1, 0, '2015-09-01 15:57:39', 96, NULL),
(536, 'Сделал 2 сообщения. "Восстановление пароля" и "Заказчику после регистрации." Во втором сообщении не получится отправить заказчику пароль, т.к. он уже зашифрован.', 64, 43, 1, '2015-09-01 15:58:53', 96, NULL),
(537, 'Бюджет за эту работу абсолютно нереален.', 64, 43, 0, '2015-09-01 15:59:02', 96, NULL),
(538, 'Я вчера целый день потратил на ваш проект. Но никто не постарался мне обьяснить задания. Где что  менять. Общаться через этот чат, так уж лучше через почту - гараздо удобней. В скайп стучался ко всем. Отвечали это не мне вопрос задавай другому. Ответов я не получил. Я хотел быть полезен вашему проекту, но если вам трудно ответить на мои вопросы так чего тогда от меня ждать)', 73, 1, 0, '2015-09-01 15:59:34', 107, NULL),
(539, 'Если вам понятно задание которое описано в одном предложение, то мне как новому не понятно где что находиться. Делать задание, которое я не понял смысла нет. ', 73, 1, 0, '2015-09-01 16:01:34', 107, NULL),
(541, 'дата сдачи через час. А вы отвечаете через день)))) Где логика?', 73, 1, 0, '2015-09-01 16:06:59', 107, NULL),
(542, '<p>Какие услуги входят в комплексное продвижение?</p>', 1, 66, 0, '2015-09-01 16:15:03', 76, NULL),
(543, '<p>Во сколько Вы оцениваете бюджет по этой работе? Давайте обсуждать</p>', 1, 64, 0, '2015-09-01 16:16:11', 96, NULL),
(544, '600 р вполне реально, думаю завтра закончу. ', 64, 43, 0, '2015-09-01 16:21:42', 96, NULL),
(545, '<p>дата сдачи переносится, если задержка обусловлена не по Вашей вине. Что именно Вам не понятно? Вроде на все Ваши вопросы ответили, если еще остались - задавайте, постараемся помочь.</p>', 1, 73, 0, '2015-09-01 16:23:22', 107, NULL),
(546, 'И вопрос: сообщения ведь нужно переводить на английский? И использовать translate?', 64, 43, 1, '2015-09-01 16:24:53', 96, NULL),
(547, '<p>не влазим в бюджет, как насчет 450?</p>', 1, 64, 0, '2015-09-01 16:25:09', 96, NULL),
(548, 'Ладно. Вопрос выше читали?', 64, 43, 1, '2015-09-01 16:28:10', 96, NULL),
(549, 'переводы нужны или лепить сразу по русски?', 64, 43, 1, '2015-09-01 16:28:47', 96, NULL),
(550, 'На английский я перевожу гуглом', 64, 43, 1, '2015-09-01 16:52:04', 96, NULL),
(551, 'Опишите подробнее', 61, 43, 0, '2015-09-01 17:07:44', 65, NULL),
(552, 'Вам только план? или сразу с ценами на продвижение?', 61, 43, 0, '2015-09-01 17:08:17', 76, NULL),
(553, '<p>Уточняем с заказчиком по поводу английского</p>', 1, 64, 0, '2015-09-01 17:21:47', 96, NULL),
(554, '<p>Какие именно подробности нужны?</p>', 1, 61, 0, '2015-09-01 17:22:48', 65, NULL),
(555, '<p>Озвучте расценки на&nbsp;оба варианта</p>', 1, 61, 0, '2015-09-01 17:23:59', 76, NULL),
(556, 'Я готов выполнить этот проэкт.\nДавайте обсудим?!', 69, 43, 0, '2015-09-01 17:39:12', 65, NULL),
(557, '<p>Давайте. Вам тз понятно? В срок уложитесь? Какой бюджет?</p>', 1, 69, 0, '2015-09-01 17:44:29', 65, NULL),
(558, 'Закупка ссылочной массы с ссылочных бирж, понятно!\nДо 26.09. уложусь вполне.\nВаше предложение по бюджету?', 69, 43, 0, '2015-09-01 17:49:49', 65, NULL),
(559, 'Говорю сразу закупка ссылок это платная вещь, самая нормальная стоит порядка от 50-200р.за розмещение на сайте с хорошей поисковой выдачей PR от.50.', 69, 43, 0, '2015-09-01 18:00:32', 65, NULL),
(560, 'Можно делать бесплатный обмен вечными ссылками, тоже не плохо, но дольше по времени!', 69, 43, 1, '2015-09-01 18:02:27', 65, NULL),
(561, 'перевод там сделан на других сообщениях, я спросил только потому, что не владею английским в должной степени и использую гугл переводчик', 64, 43, 1, '2015-09-01 18:04:31', 96, NULL),
(562, 'Если брать сугубо закупка ссылок, тогда:\n1. Написание статей - 1500 руб. (20 статей по 75 рублей каждая).\n2. Размещение статей на площадке miralinks.ru (закупка ссылок). Статьи будут равномерно размещаться на весь месяц, чтобы не было ссылочного взрыва, что не есть хорошо для сайта. В среднем одна статья на хорошем ресурсе стоит от 3$ до 4$. Дальше простая арифметика для 20 статей в месяц. Почему именно 20? Думаю, что сайт никто не продвигал, поэтому для начала думаю, что 20 вполне будет достаточно. Со временем, когда сайт выйдет на определённый уровень, можно будет меньше статей размещать для поддержания позиций.\n3. Работа - 2000 руб. (как уже и говорил).\n\nP.S. Опять же таки повторюсь - мне нужен изначальный список ключевых слов, которые нужно продвигать.', 62, 43, 0, '2015-09-01 19:49:19', 65, NULL),
(563, '<p>Ключевые слова давайте обсудим с Вами. Сколько их должно быть оптимально? И для начала сделаем&nbsp;план. И из него частями задачи. Напишите, сколько Вы за месяц&nbsp;за месяц планируете закупить и сколько это будет стоить.</p>', 1, 62, 0, '2015-09-01 22:20:32', 65, NULL),
(564, '<p>Давайте для начала сделаем&nbsp;план. И из него частями задачи.&nbsp;Напишите, сколько Вы за месяц&nbsp;за месяц планируете закупить и сколько это будет стоить</p>', 1, 69, 0, '2015-09-01 22:20:57', 65, NULL),
(565, '<p>Ждем расценки и уже нужно начинать</p>', 1, 61, 0, '2015-09-01 22:32:25', 76, NULL),
(566, 'План я составлю просто так', 61, 43, 0, '2015-09-01 22:34:44', 76, NULL),
(567, '<p>Артем, ну как работа, идет, когда ждать? Все сроки уже пропустили</p>', 1, 31, 0, '2015-09-01 22:36:28', 101, NULL),
(568, 'Опять не получается загрузить план', 61, 43, 0, '2015-09-01 22:36:38', 76, NULL),
(569, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Нам нужно на &nbsp;Yii (На php)</span></p>', 1, 67, 0, '2015-09-01 22:39:36', 77, NULL),
(570, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">На Yii (На php)</span></p>', 1, 86, 0, '2015-09-01 22:40:11', 77, NULL),
(571, 'не могу вам помочь', 86, 43, 0, '2015-09-01 22:46:52', 77, NULL),
(572, '<p>информация о заказе- заметки для автора и под ними есть поле, куда моно загрузить либо перетащить файлы</p>', 1, 61, 0, '2015-09-01 22:51:33', 76, NULL),
(573, 'http://joxi.ru/brRDjW6c83ON21', 61, 43, 0, '2015-09-01 22:54:36', 76, NULL),
(574, '<p>И что, не получается загрузить план в поле : "сюда загрузить план"?</p>', 1, 61, 0, '2015-09-01 22:57:19', 76, NULL),
(575, 'Если на меня ложится и семантическое ядро (список ключевых слов), то и работа будет объёмнее! Вы уж простите за меркантильные ноты, но на это нужно время! Я могу составить Вам семантическое ядро, но на это нужно время!', 62, 43, 1, '2015-09-01 23:33:25', 65, NULL),
(576, 'НЕТ', 61, 43, 0, '2015-09-01 23:35:59', 76, NULL),
(577, 'Простите за некий каламбур! Ещё один тонкий момент! Сколько Вы рассчитываете на проект? Я же не знаю Ваших финансовых возможностей! Из этого нужно исходить и составлять какой-то план действий и из этого и нужно мне понимать то, на сколько можно и мне рассчитывать за работу (опять же такие, простите за меркантильность)!', 62, 43, 1, '2015-09-01 23:36:20', 65, NULL),
(578, '<p>что ж, скиньте его нам на поту с пометкой "76" и мы его сюда прикрепим</p>', 1, 61, 0, '2015-09-01 23:43:33', 76, NULL),
(579, 'Хочу Вам ещё кое-что подсказать! У Вас с главной страницы очень много текста перезалито на других сайтах! То есть, некие "умные" ребята, чтобы не писать свой уникальный текст, просто взяли и скопировали его с Вашего сайта! У Вас хоть кто-нибудь следить за этим или нет? Простите!', 62, 43, 1, '2015-09-01 23:51:46', 65, NULL),
(580, 'Сколько запросов? Есть ли шаблон отчета?', 65, 43, 1, '2015-09-01 23:52:14', 66, NULL),
(581, 'скинул', 61, 43, 0, '2015-09-01 23:55:40', 76, NULL),
(582, 'баги устранены. возобновите проект! ', 45, 1, 0, '2015-09-02 04:49:53', 70, NULL),
(583, 'сроки немного продлил ', 45, 1, 0, '2015-09-02 04:50:24', 70, NULL),
(584, '<p>Составьте пожалуйста примерный оптимальный план раскрутки на месяц в средней ценовой категриии и обсудим.</p>', 1, 62, 0, '2015-09-02 10:09:22', 65, NULL),
(587, 'Нужно уточнение по задаче. Сообщение "Заку об оплате когда выставлен счет". Насколько понял, счет заку выставляется менеджером, когда он в оплатах заполняет поле "Выписать счет:" и жмет кнопку сохранить. Правильно?', 64, 43, 1, '2015-09-02 10:20:30', 96, NULL),
(588, '<p>А на какую почту? Скиньте, плз на&nbsp;<span style="font-family: arial, sans, sans-serif; font-size: 100%; text-align: center;">ekomixds@mail.ru</span></p>', 1, 61, 0, '2015-09-02 10:30:42', 76, NULL),
(589, '<p>Ок, проект возобновлен!</p>', 1, 45, 0, '2015-09-02 10:32:53', 70, NULL),
(590, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Здравствуйте Евгений! Баги устранены. возобновите пожалуйста работу над проектом! Сроки передвинули. Подтвердите продолжение работы.&nbsp;</span></p>', 1, 56, 0, '2015-09-02 10:34:37', 70, NULL),
(591, '<p>Да, все верно</p>', 1, 64, 0, '2015-09-02 10:36:17', 96, NULL),
(592, '<p>Здравствуйте Артур! Утвержден ли план, можнно ли продолжать работу дальше или нужны корректировки?</p>', 1, 43, 0, '2015-09-02 10:45:59', 59, NULL),
(593, 'нужна ссылка на страницу оплаты, подскажите', 64, 43, 1, '2015-09-02 11:06:06', 96, NULL),
(594, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Артур, убедительно просим предоставить&nbsp;&nbsp; fpt от сайта, без этой информации невозможно начать работу.</span></p>', 1, 43, 0, '2015-09-02 11:33:41', 110, NULL),
(595, 'Добрый день!\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=184454896\nГотовы все задачи кроме 4: для неё программист должен сначала сделать вывод модулей туда, а я подверстаю.', 41, 43, 0, '2015-09-02 12:24:09', 110, NULL),
(596, '<p>да, ок, спасибо! Ждем программиста!</p>', 1, 41, 0, '2015-09-02 12:30:38', 110, NULL),
(597, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Готовы все задачи кроме 4: для неё программист должен сначала сделать вывод модулей туда, а исполнитель подверстает.</span></p>', 1, 43, 0, '2015-09-02 12:31:12', 110, NULL),
(598, 'Отлично, я вчера уже отписал Артему.', 41, 43, 1, '2015-09-02 12:33:05', 110, NULL),
(599, '<p>Здравствуйте! Вам доступ дали? Настал срок сдачи части работы!</p>', 1, 69, 0, '2015-09-02 16:08:48', 64, NULL),
(600, 'Извините', 67, 43, 0, '2015-09-02 16:12:09', 77, NULL),
(601, 'Добрый день!\nУточните детали по заданию....\nКакая админка? \nСколько языков необходимо?', 92, 43, 1, '2015-09-02 16:41:43', 77, NULL),
(602, 'Здравствуйте, менеджер, просьба завершить этот заказ, т.к он не актуален, по этому вопросу требуется только перевод админки, без функционала.', 43, 1, 0, '2015-09-02 17:15:21', 77, NULL),
(603, '<p>Ок, спасибо за заказ, будем рады сотрудничеству с Вами в дальнейшем!</p>', 1, 43, 0, '2015-09-02 18:01:18', 77, NULL),
(604, 'Вам необходим компьютер макбук - это обязательно?', 61, 93, 1, '2015-09-02 18:17:34', 111, NULL),
(605, 'Давайте хоть отчёт сделаю цена 300р.', 69, 43, 0, '2015-09-02 18:18:26', 66, NULL),
(606, 'Очень желательно! ', 93, 0, 0, '2015-09-02 18:32:17', 111, NULL),
(607, 'Потому как на макбуке получится полное соответствие макету \n', 93, 0, 0, '2015-09-02 18:32:41', 111, NULL),
(608, '<p>Очень желательно!</p>', 1, 61, 0, '2015-09-02 18:33:52', 111, NULL),
(609, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Потому как на макбуке получится полное соответствие макету</span></p>', 1, 61, 0, '2015-09-02 18:34:07', 111, NULL),
(610, '<p>Хорошо, работу выполним в срок. Исполнитель оценивает работу, мы сразу же Вам сообщим цену. С уважением компания админтрикс.</p>', 1, 93, 0, '2015-09-02 18:35:57', 111, NULL),
(611, 'отлично', 93, 0, 0, '2015-09-02 18:37:28', 111, NULL),
(612, '<p>Скажите пожалуйста, картинки которые будут в зависимости от города и выбраной кнопки Вы предоставите ?</p>', 1, 93, 0, '2015-09-02 18:54:38', 111, NULL),
(613, 'конечно, весь контент будет предоставлен ', 93, 0, 0, '2015-09-02 19:00:52', 111, NULL),
(614, '<p>Хорошо, смотрите, мы разобьем Ваш заказ на 2 части, т.е часть программирования будет создана отдельным заказом и будет отображаться в разделе "Мои заказы" в Вашем в личном кабинете. Вы не против ?</p>', 1, 93, 0, '2015-09-02 19:02:56', 111, NULL),
(615, 'в чем разница? ', 93, 0, 0, '2015-09-02 19:54:01', 111, NULL),
(616, 'Качественно ', 75, 93, 0, '2015-09-02 20:10:31', 111, 5000),
(617, '<p>Для Вас никакой, мы оповещаем Вас чтобы Вам было понятно, что это за заказ появился у Вас в разделе "мои заказы".</p>', 1, 93, 0, '2015-09-02 21:16:33', 111, NULL),
(618, '<p>Мы оценили стоимость работы в полном объеме, она составит 18000 руб., это с учетом срочности (т.к срок довольно сжатый) а так-же с учетом программной части. Вам готовы сделать скидку по знакомству, в размере ~ 20%.&nbsp;<br />В целом окончательная стоимость с учетом скидки составит 15000 руб.&nbsp;<br />Все замечания в рамках первоначального задания (если они будут), мы исправим бесплатно.</p>', 1, 93, 0, '2015-09-02 21:23:06', 111, NULL),
(619, 'Сколько, сколько?????? 15000 за верстку и программирование?????', 93, 0, 0, '2015-09-02 21:36:26', 111, NULL),
(620, 'пишите в скайп al.rout', 75, 93, 0, '2015-09-02 21:41:38', 111, NULL),
(621, '<p>Цена установлена с учетом срочности выполнения, если есть возможность продлить срок - стоимость будет намного ниже.</p>', 1, 93, 0, '2015-09-02 21:49:45', 111, NULL),
(622, '<p>Вы выполняете, нам ждать заказ или снимать Вас с работы?</p>', 1, 69, 0, '2015-09-02 21:52:39', 64, NULL),
(623, 'Хорошо, сколько нужно времени исполнителю, чтобы уложиться в бюджет 5000? ', 93, 0, 0, '2015-09-02 21:53:37', 111, NULL),
(624, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px;">Составьте пожалуйста примерный оптимальный план раскрутки на месяц в средней ценовой категриии и обсудим.</span></p>', 1, 69, 0, '2015-09-02 21:57:52', 65, NULL),
(625, '<p>План продвижения готов и находится в заказе, просьба ознакомиться с ним</p>', 1, 43, 0, '2015-09-02 22:17:25', 76, NULL),
(626, '<p>Нам нужно выполнить заказ в полном объеме, а н один отчет. Напишите, пожалуйста, желаемый бюджет</p>', 1, 69, 0, '2015-09-02 22:33:02', 66, NULL),
(627, '<p>За 10 дней стоимость составит 10000 р, это самый минимум.</p>', 1, 93, 0, '2015-09-02 22:43:52', 111, NULL),
(628, '<p>Автор, Вы выполняете или снимать Вас с заказа? Просьба отписаться в чат!</p>', 1, 56, 0, '2015-09-02 22:49:12', 70, NULL),
(629, '<p>Уважаемый заказчик, дайте пожалуйста, ссылку на стр оплаты</p>', 1, 43, 0, '2015-09-02 22:59:15', 96, NULL),
(630, 'Возьмусь, только логин и пароль от админки - не подходят, уточните данные и свяжитесь со мной.', 74, 45, 1, '2015-09-03 01:46:26', 70, 800),
(631, '32 сделал 30 мин', 14, 1, 0, '2015-09-03 02:23:16', 103, NULL),
(632, '37: 5 мин', 14, 1, 0, '2015-09-03 01:37:38', 103, NULL),
(633, '1 не могу - админа пароль опять не подходит', 14, 1, 0, '2015-09-03 03:28:07', 103, NULL),
(634, 'в смысле 1 не могу доделать\n', 14, 1, 0, '2015-09-03 03:28:41', 103, NULL),
(635, 'Почему вы меня сняли с заказа, я же не виноват что мне доступ не предоставили?!\nКак вы так сотрудничаете?', 69, 43, 0, '2015-09-03 10:03:19', 64, NULL),
(636, '<p>Вы назначены на проект, логин и пароль заказчик уточнит</p>', 1, 74, 0, '2015-09-03 10:06:15', 70, NULL),
(637, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Уважаемый заказчик! Указанный Вами &nbsp;логин и пароль от админки - не подходят, уточните пожалуйста, эти данные исполнителю.</span></p>', 1, 45, 0, '2015-09-03 10:07:11', 70, NULL),
(638, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Уважаемый заказчик! Указанный Вами пароль не подходит, уточните пожалуйста, эти данные исполнителю.</span></p>', 1, 43, 0, '2015-09-03 10:11:41', 103, NULL),
(639, '<p>Вам до сих пор не дали доступ? Вернули Вас в заказ, запросили доступ у заказчика</p>', 1, 69, 0, '2015-09-03 10:13:44', 64, NULL),
(640, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Уважаемый заказчик! Для Выполнения работы по заказу предоставьте, пожалуйста,&nbsp;исполнителю доступ.</span></p>', 1, 43, 0, '2015-09-03 10:14:32', 64, NULL),
(641, 'Не дали, я же вам о чем и говорю!\nЯ ожидаю только доступ!', 69, 43, 1, '2015-09-03 10:55:06', 64, NULL),
(642, 'Немного видоизменил предыдущее своё предложение.\n\n1. Составление семантического ядра (подбор ключевых слов).\n2. Утверждение списка ключевых слов.\n3. Написание статей - 1500 руб. (20 статей по 75 рублей каждая).\n4. Размещение статей на площадке miralinks.ru (закупка ссылок). Статьи будут равномерно размещаться на весь месяц, чтобы не было ссылочного взрыва, что не есть хорошо для сайта. В среднем одна статья на хорошем ресурсе стоит от 3$ до 4$. Дальше простая арифметика для 20 статей в месяц. Почему именно 20? Думаю, что сайт никто не продвигал, поэтому для начала думаю, что 20 вполне будет достаточно. Со временем, когда сайт выйдет на определённый уровень, можно будет меньше статей размещать для поддержания позиций. 4$ = 266 руб. (округляем до 300 руб.)\n5. Работа - 3000 руб.\nОбязательна внутренняя оптимизация сайта. Если этим уже кто-нибудь занимается - очень хорошо!\n\nИтого: 1500 + 6000 + 3000 = 10500 руб.', 62, 43, 0, '2015-09-03 10:57:09', 65, NULL),
(643, '<p>Вы же несколькими сообщениями выше за работу 2000 считали, или ставки растут?</p>', 1, 62, 0, '2015-09-03 11:01:48', 65, NULL),
(644, 'Цена была без учёта семантического ядра. Если у Вас есть список ключевых слов - тогда 2000 руб. Если нет, тогда нужно составлять СЯ. Поэтому 3000 руб.', 62, 43, 0, '2015-09-03 11:20:27', 65, NULL),
(645, 'Жду уточнения логина и пароля, чтобы начать.', 74, 45, 0, '2015-09-03 11:23:42', 70, NULL),
(647, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Изменили в информации о заказе</span></p>', 1, 74, 0, '2015-09-03 15:58:33', 70, NULL),
(648, '<p>т.е. 10500 р - это бюджет в месяц?</p>', 1, 62, 0, '2015-09-03 16:00:39', 65, NULL),
(649, 'Так точно! Далее будем смотреть по позициям!', 62, 43, 0, '2015-09-03 16:02:39', 65, NULL),
(650, '<p>Внесите пожалуйста, логин в профиль</p>', 1, 51, 0, '2015-09-03 16:19:36', 88, NULL),
(651, '<p>и подтвердите сроки выполения</p>', 1, 0, 0, '2015-09-03 16:21:28', 88, NULL),
(654, 'Внесите пожалуйста, логин в профиль - а это в каком смысле?', 51, 45, 0, '2015-09-03 16:22:40', 88, NULL),
(655, 'До какого числа/времени задача? Если я начну вечером и ночью/утром сдам работу, будет нормально?', 74, 45, 0, '2015-09-03 16:24:07', 70, NULL),
(656, 'все, не в дел сбоку время, разобрался. Можете не отвечать', 74, 45, 0, '2015-09-03 16:25:07', 70, NULL),
(657, '<p>Здравствуйте! Автор составил оптимальный план раскрутки Вашего сайта на первый месяц. В него входит:<span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">&nbsp;</span><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">1. Составление семантического ядра (подбор ключевых слов). 2. Утверждение списка ключевых слов. 3. Написание статей - &nbsp;4. Размещение статей на площадке miralinks.ru (закупка ссылок). Статьи будут равномерно размещаться на весь месяц, чтобы не было ссылочного взрыва, что не есть хорошо для сайта. Автор рекомендует в первый месяц разместить 20 статей.Со временем, когда сайт выйдет на определённый уровень, можно будет меньше статей размещать для поддержания позиций. &nbsp;Стоимость такого пакета услуг на месяц составит 30000 р. Для того, чтобы автор приступил, ждем аванс в размере 50% от стоимости заказа.</span></p>', 1, 43, 0, '2015-09-03 16:28:28', 65, NULL),
(658, '<p>Здравствуйте! Заказ актуален?</p>', 1, 43, 0, '2015-09-03 16:36:52', 109, NULL),
(660, '<p>Павел, Вы выполняете заказ или нет?</p>', 1, 73, 0, '2015-09-03 16:43:09', 107, NULL),
(662, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px;">Уважаемый заказчик, актуален ли заказ?&nbsp;</span></p>', 1, 43, 0, '2015-09-03 16:44:18', 106, NULL),
(663, 'Здравствуйте. Какую страницу оплаты ? Блок оплаты у менеджера находится в форме заказа. У клиента блок для загрузки чека появляется когда ему выставлен счет.', 43, 1, 0, '2015-09-03 17:08:50', 96, NULL),
(664, '<p>Здравствуйте. Вы ещё не назначены исполнителем данного заказа. Почему Вы выполняете его ?</p>', 1, 14, 0, '2015-09-03 17:29:50', 103, NULL),
(665, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px; background-color: #f7f7f7;">Здравствуйте. Какую страницу оплаты ? Блок оплаты у менеджера находится в форме заказа. У клиента блок для загрузки чека появляется когда ему выставлен счет.</span></p>', 1, 64, 0, '2015-09-03 17:31:46', 96, NULL),
(666, '<p>Как там успехи у программиста? Хочеться доделать уже, ведь почти готово и так.</p>', 2, 41, 0, '2015-09-03 18:51:20', 110, NULL),
(667, '<p>Ваш профиль сейчас без логина, безымянный, установите логин</p>', 1, 51, 0, '2015-09-03 19:11:30', 88, NULL),
(668, '<p>Вам выписан счет на 600 р, просьба оплатить его</p>', 1, 43, 0, '2015-09-03 19:13:22', 102, NULL),
(669, 'У меня в профиле прописан логин', 51, 45, 0, '2015-09-03 20:28:52', 88, NULL),
(670, '<p>странно, логина не видно</p>', 1, 51, 0, '2015-09-03 20:35:08', 88, NULL),
(671, '<p>проставьте инициалы</p>', 1, 0, 0, '2015-09-03 20:35:19', 88, NULL),
(673, 'Здравствуйте. Уже выяснил у akoch-ov', 64, 43, 1, '2015-09-03 21:25:30', 96, NULL),
(674, 'Готов выполнить', 73, 1, 0, '2015-09-03 21:34:16', 113, NULL),
(675, '<p>Бюджет 1000 руб. подтверждете ? Срок в форме заказа.</p>', 1, 73, 0, '2015-09-03 21:36:01', 113, NULL),
(676, 'подтверждаю) ', 73, 1, 0, '2015-09-03 21:39:45', 113, NULL),
(677, '<p>Назначили на заказ, ждем готовую работу в указаный срок.</p>', 1, 73, 0, '2015-09-03 21:43:22', 113, NULL),
(678, 'Практически закончил половину, хотелось бы получить половину оплаты, чтобы дальше спокойно продолжать. Это возможно? http://ano-po.ru/ ссылка, чтобы проверять добавленные товары.', 74, 45, 1, '2015-09-03 21:52:43', 70, NULL),
(679, '<p>Михаил, пожалуйста, проверьте половину проделанной работы, исполнитель просит половину гонорара</p>', 1, 45, 0, '2015-09-03 22:06:37', 70, NULL),
(680, '<p>Да, это возможно. Оплата будет произведена после проверки части работы заказчиком</p>', 1, 74, 0, '2015-09-03 22:07:08', 70, NULL),
(681, 'Хорошо, продолжаю работу, ожидаю оплату. Пусть автор свяжется, если что-то не так.', 74, 45, 1, '2015-09-03 22:09:58', 70, NULL);
INSERT INTO `1_ProjectMessages` (`id`, `message`, `sender`, `recipient`, `moderated`, `date`, `order`, `cost`) VALUES
(682, 'Не автор, а заказчик. Путаюсь в вашей терминологии)', 74, 45, 1, '2015-09-03 22:12:14', 70, NULL),
(683, '<p>Добрый вечер! Спасибо за доверие к нашему сайту, будем рады помочь Вам с версткой! Пожалуйста, уточните тз и актуальные сроки выполнения заказа. Спасибо</p>', 1, 102, 0, '2015-09-03 22:44:40', 114, NULL),
(684, '<p>Здравствуйте! Исполнитель готов начать работу, Вы приняли решение?</p>', 1, 93, 0, '2015-09-03 22:46:12', 111, NULL),
(685, 'Информация/текст будет предоставлен? Какое количество городов планируется задействовать? Какие нибудь дополнительные требования будут? Анимация? Мобильная версия?', 103, 93, 1, '2015-09-03 23:09:51', 111, NULL),
(686, 'Добавил 29 + (2 уже были на сайте) товаров, на сегодня закончил. В прайсах дошел до пельменей, и если делать по 2 продукта в каждой категории то выйдет гораздо больше 50 товаров. Не считая бакалеи осталось 15 категорий (30 товаров это пельмени+Молочная продукция "Савушкин-Продукт" ). Итого уже около 60 товаров. С бакалеей - еще +30 (там будет 15 категорий). Жду оплаты за половину работы. Завтра смогу заполнить всё до бакалеи и дальше (но цену нужно пересмотреть, т.к. товаров далеко не 50). (Без бакалеи будет около 60 товаров, но если не понадобятся правки, то делаем по оговоренной цене). Если нужно добавить еще и бакалею, то прошу увеличить оплату (до 1100)', 74, 45, 0, '2015-09-04 01:59:28', 70, NULL),
(687, 'отправил макет со стилистикой лендингов. Утвердите стилистику, чтобы я мог привести к одному стилю все макеты и начал верстать (если стиль подходит)', 51, 45, 1, '2015-09-04 03:46:33', 88, NULL),
(688, 'Насчет профиля - система не дает редактировать профиль (точнее не сохраняет результаты)', 51, 45, 1, '2015-09-04 03:47:37', 88, NULL),
(689, 'Сделал сообщения, перечисленные по пунктам 1-7', 64, 43, 1, '2015-09-04 08:06:55', 96, NULL),
(690, 'Готов качественно и в поставленные сроки выполнить задание. Имею опыт работы.', 62, 43, 0, '2015-09-04 10:08:49', 66, 1000),
(692, '<p>просто сообщение еще не прошло модерацию) сейчас изменения внесены, спасибо</p>', 1, 51, 0, '2015-09-04 10:34:26', 88, NULL),
(693, '<p>Ждем утверждения поовины работы</p>', 1, 43, 0, '2015-09-04 10:34:59', 96, NULL),
(694, '<p>Бюджет данного проекта 600 р, возьметесь?</p>', 1, 62, 0, '2015-09-04 10:36:22', 66, NULL),
(695, '<p>Ждем Ваш ответ)</p>', 1, 102, 0, '2015-09-04 10:38:45', 114, NULL),
(696, '<p>Здравствуйте! Вам дали доступ?</p>', 1, 69, 0, '2015-09-04 11:09:53', 64, NULL),
(697, 'Доброе времени суток, готов взяться за данный проект, отчетность буду вести либо в Google Docs, либо просто в документе и отсылать на почту. Анализ позиций буду составлять, как с помощью софта, так и просто ручками.', 111, 43, 0, '2015-09-04 12:06:58', 66, 3000),
(698, '<p>Ждем Ваш ответ</p>', 1, 43, 0, '2015-09-04 12:29:51', 59, NULL),
(699, 'Что насчёт стиля лендинга? Делаем все в таком стиле?', 51, 45, 1, '2015-09-04 12:30:51', 88, NULL),
(700, 'Здравствуйте. Мне нужен список ключевых слов. Скажите, пожалуйста, сколько хотя бы ключевых слов предусматривается.', 62, 43, 1, '2015-09-04 12:37:41', 66, NULL),
(701, '<p>Здравствуйте! Что входит в стоимость 3000 р?&nbsp;</p>', 1, 111, 0, '2015-09-04 13:18:21', 66, NULL),
(703, '<p>Ждем от Вас обратной связи</p>', 1, 43, 0, '2015-09-04 14:25:34', 76, NULL),
(704, '<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Здравствуйте </span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вы нарушили срок сдачи заказа </span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">В связи с этим, согласно нашему соглашению, Вы были сняты с заказа без последующей оплаты с понижением рейтинга.</span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Вас вернут в заказ, если Вы прикрепите необходимую часть работы до назначения на заказ другого исполнителя, поторопитесь пожалуйста!</span></p>\n<p><span id="docs-internal-guid-bf514a73-97e5-8775-9a14-6b346c72bbba"><span style="font-size: 14.6666666666667px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Просьба отнестись с ответственностью к работе.</span></span></p>', 1, 73, 0, '2015-09-04 14:27:46', 113, NULL),
(705, '1. Составление аудита сайта.\n2. Мониторинг изменений поисковой выдачи, анализ основных конкурентов.\n3. Проверка позиций сайта по семантическому ядру.  \n4. Анализ посещаемости сайта в отчетном периоде. \n', 111, 43, 0, '2015-09-04 15:31:13', 66, NULL),
(706, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Здравствуйте! Стоимость Вашего заказа автор оценил в 9000 р В эту сумму входит: 1. Составление аудита сайта. 2. Мониторинг изменений поисковой выдачи, анализ основных конкурентов. 3. Проверка позиций сайта по семантическому ядру. 4. Анализ посещаемости сайта в отчетном периоде.</span></p>', 1, 43, 0, '2015-09-04 15:34:41', 66, NULL),
(707, '<p>Здравствуйте. Видим работа пошла, несколько вопросов, первый: языковя часть, что с ней, часть на англ часть на русском... &nbsp;Второй будет освещен позже</p>', 1, 31, 0, '2015-09-04 15:56:52', 101, NULL),
(708, 'Менеджер?', 41, 1, 0, '2015-09-04 15:57:35', 110, NULL),
(709, '<p>Чем могу помочь?</p>', 1, 41, 0, '2015-09-04 16:02:59', 110, NULL),
(710, '<p>Ещё обращаем Ваше внимание на то, что профил отваливается даже при обычной регистрации через почту.</p>', 1, 31, 0, '2015-09-04 16:11:30', 101, NULL),
(711, '<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Здравствуйте. Ваш заказ успешно зарегистрирован на сайте </span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Спасибо за регистрацию, Ваш заказ очень важен для нас.</span></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;">&nbsp;</p>\n<p><strong id="docs-internal-guid-bf514a73-984c-f00c-8bd9-466007a3b9c6" style="font-weight: normal;">&nbsp;</strong></p>\n<p dir="ltr" style="line-height: 1.38; margin-top: 0pt; margin-bottom: 0pt;"><span style="font-size: 14.666666666666666px; font-family: Arial; color: #000000; background-color: transparent; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Заказ располагается в разделе &ldquo;Мои заказы&rdquo; в Вашем личном кабинете</span></p>\n<p><span style="font-size: 14.6666666666667px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;">Номер Вашего заказа 115</span><span style="font-size: 14.6666666666667px; font-family: Arial; vertical-align: baseline; white-space: pre-wrap; background-color: transparent;"><br class="kix-line-break" /></span></p>', 1, 119, 0, '2015-09-04 16:20:48', 115, NULL),
(713, '<p><span style="color: #333333; font-family: Roboto; font-size: 13px; line-height: 18.5714282989502px; background-color: #f7f7f7;">Уважаемый заказчик, просьба уточнить ТЗ по этому заказу</span></p>', 1, 119, 0, '2015-09-04 16:35:48', 115, NULL),
(714, 'Добрый день!\nСкиньте ТЗ по проекту, обсудим детальнее \nОбращайтесь, будем рады сотрудничать с Вами.\nПортфолио: https://www.behance.net/netville\nС уважением, \nАлексей.	\nweb@netville.com.ua\nSkype: netville_web \nwww.netville.com.ua\n', 92, 119, 0, '2015-09-04 16:49:15', 115, 0),
(715, 'Что мы решаем с 4 пунктом? Я почти доделал все задание, а стоит оно только из-за прогера.. Хотелось бы уже получить оплату и приступать к следующему.', 41, 1, 0, '2015-09-04 17:01:30', 110, NULL),
(716, 'Не понял суть вопроса про языковую часть.\n', 31, 1, 0, '2015-09-04 17:14:13', 101, NULL),
(717, '<p>Здравствуйте! Исполнитель почти выполнил задание, осталась только часть, выполнить которую можно после вывода модулей программистом. Просьба поторопить его!</p>', 1, 43, 0, '2015-09-04 17:27:51', 110, NULL),
(718, 'Пока приостановил выполнение, жду отзывов и оплаты, по поводу половины работы. ', 74, 1, 0, '2015-09-04 18:32:22', 70, 800),
(719, 'можно меня описать от рассылки', 86, 45, 0, '2015-09-04 19:09:00', 112, NULL),
(720, 'Практически закончил половину, хотелось бы получить половину оплаты, чтобы дальше спокойно продолжать. Это возможно? http://ano-po.ru/ ссылка, чтобы проверять добавленные товары.\n----------\nа  я то тут причем?', 45, 1, 0, '2015-09-04 20:02:37', 70, NULL),
(721, 'Готово.', 31, 1, 0, '2015-09-04 20:17:34', 101, NULL),
(722, '<p>Здравствуйте, ожидаем вторую часть оплаты, чтобы исполнитель мог прододжить.</p>', 1, 45, 0, '2015-09-04 21:15:25', 70, NULL),
(723, '<p>В случае задержки с оплатой, срок может быть увеличен. Надеемся на понимание.</p>', 1, 45, 0, '2015-09-04 21:18:27', 70, NULL),
(724, 'В указанное время не успел сдать. Потратил часов 5. Надо еще время что бы проверить все. ', 73, 1, 0, '2015-09-04 21:30:21', 113, NULL),
(725, 'нужно описание товара !!! ', 45, 1, 0, '2015-09-04 21:38:48', 70, NULL),
(726, 'объем и производитель!', 45, 1, 0, '2015-09-04 21:39:02', 70, NULL),
(727, '<p>Здравствуйте, т.к нового исполнителя на проект ещё&nbsp;не назначили, вернули Вам заказ. Просьба оповещать заранее, если задача оказалась сложнее. Спасибо</p>', 1, 73, 0, '2015-09-04 21:39:06', 113, NULL),
(728, '\nнужно описание товара !!!\n\nобъем и производитель!', 45, 74, 1, '2015-09-04 21:39:13', 70, NULL),
(729, 'исполнитель сделал не то что надо', 45, 1, 0, '2015-09-04 21:40:22', 70, NULL),
(730, 'потраченное время учитывается? Я не знаю сколько точно надо еще на него времени, но могу информировать что сделал каджый час.  как быть в данной ситуации?', 73, 1, 0, '2015-09-04 22:03:23', 113, NULL),
(731, '<p><span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Вы сделали не совсем то, что требовалось, нужно описание товара, объем и производитель. Работа нуждается в корректировке</span></p>', 1, 74, 0, '2015-09-04 23:39:13', 70, NULL),
(732, '<p>Каждый час не обязательно, но пару раз в сутки просим выходить на связь Спасибо.</p>', 1, 73, 0, '2015-09-04 23:41:25', 113, NULL),
(733, 'Хочу уточнить конкретнее, чтобы в будущем корректировки не потребовались. Просто в описании товара есть и объем и производитель, всё как в ТЗ.\nВ таком виде. Уточните корректировки. (Куда мне писать этот объем и производителя, если не в описание?) В описании есть, в любом товаре, в таком формате: "Зразы с яйцом и зеленым луком,1 кг, фасованные. ИП Суханов. От Суханова еда — по домашнему вкусна!"\nhttp://link.ac/4ZqL33', 74, 45, 1, '2015-09-04 23:42:56', 70, NULL),
(734, 'Вы хотите объём и производителя в названии товара? Тогда каждое название будет строки по 2-4, могу исправить. Укажите пожалуйста товар, в котором в описании не указан объем и производитель в описании к товару. ', 74, 45, 1, '2015-09-04 23:49:16', 70, NULL),
(735, 'Возможно вы просто не долистали до описания товара?', 74, 45, 1, '2015-09-04 23:50:12', 70, NULL),
(736, 'Или вы хотите изменений в описании в формате: \n"Объем хххх гр", "Производитель ИП хххх" ? ', 74, 45, 1, '2015-09-04 23:54:53', 70, NULL),
(737, '???', 51, 45, 1, '2015-09-05 00:51:04', 88, NULL),
(738, 'Готов выполнить', 41, 43, 0, '2015-09-05 00:58:12', 118, 1000),
(739, '<p>Здравствуйте! Максимальный бюджет по этому заказу 800 р, сойдемся?</p>', 1, 41, 0, '2015-09-05 01:02:58', 118, NULL),
(740, 'Ну тут задачи чуть "интереснее", ладно, договорились.', 41, 43, 0, '2015-09-05 01:23:56', 118, NULL),
(741, '<p>Назначили исполнителем, срок указан в форме заказа, просьба отнестись ответственно.</p>', 1, 41, 0, '2015-09-05 09:20:17', 118, NULL),
(742, '<p>Здравствуйте, мы не можем утвердить данный план. Нам необходим план продвижения нашего проекта, по шагам (1...2...3... и т.д.), а Вы выслали какую-то общую инструкцию для СЕО специалистов.</p>', 1, 61, 0, '2015-09-05 09:34:56', 59, NULL),
(744, '<p>Уточните пожалуйста, готовы ли Вы прислать план продвижения реально относящийся к проекту dipstart.ru</p>', 1, 61, 0, '2015-09-05 09:36:12', 59, NULL),
(745, '<p>Здравствуйте, проект актуален, нам сначала необходим полный план продвижения dipstart.ru и по нему уже будем выполнять задачи конкретные. Сможете сделать ?</p>', 1, 62, 0, '2015-09-05 09:39:27', 59, NULL),
(746, '<p>Здравствуйте. Можно посмотреть Вашу ссылку на фл ? &nbsp;+&nbsp;"<span style="color: #333333; font-family: Roboto; font-size: 12px; line-height: 17.142858505249px;">Со временем, когда сайт выйдет на определённый уровень", сайт находится в топе по запросу заказать диплом, регион Москва.</span></p>', 1, 62, 0, '2015-09-05 09:47:51', 65, NULL),
(747, '<p>Здравствуйте, как готово ? Что с задачей 25 ?&nbsp;</p>', 1, 31, 0, '2015-09-05 10:06:32', 101, NULL),
(748, 'Подтвердите насчет стиля лендинга. Работа стоит.', 51, 45, 0, '2015-09-05 10:06:42', 88, NULL),
(749, 'Что-то не так?', 31, 1, 0, '2015-09-05 12:31:20', 101, NULL),
(750, '<p>При переходе в заказ, который не одобрен контроллер тупит.&nbsp;(/var/www/akoch-ov/data/www/akoch.dipstart.ru/protected/modules/rights/components/RController.php:62)</p>', 1, 31, 0, '2015-09-05 12:55:40', 101, NULL),
(751, 'Хорошо, постараюсь сегодня сделать.', 41, 43, 0, '2015-09-05 13:02:27', 118, NULL),
(752, 'под кем? под заказчиком у меня вчера работало...', 31, 1, 0, '2015-09-05 14:02:54', 101, NULL),
(753, 'при описании бага нужно ВСЕГДА писать под кем это происходит и давать ссылку', 31, 1, 0, '2015-09-05 14:17:05', 101, NULL),
(754, '<p>Под заказчиком, заказ уже появляется у него в Моих заказах до одобрения, но в заказ зайти не дает.</p>', 1, 31, 0, '2015-09-05 14:58:07', 101, NULL),
(755, 'Поправил', 31, 1, 0, '2015-09-05 16:11:01', 101, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectPayments`
--

CREATE TABLE IF NOT EXISTS `1_ProjectPayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `project_price` float(10,2) DEFAULT NULL,
  `work_price` float(10,2) DEFAULT NULL,
  `received` float(10,2) DEFAULT NULL,
  `approved_in` float(10,2) DEFAULT NULL,
  `approved_out` float(10,2) DEFAULT NULL,
  `to_receive` float(10,2) DEFAULT NULL,
  `to_pay` float(10,2) DEFAULT NULL,
  `payed` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Дамп данных таблицы `1_ProjectPayments`
--

INSERT INTO `1_ProjectPayments` (`id`, `order_id`, `project_price`, `work_price`, `received`, `approved_in`, `approved_out`, `to_receive`, `to_pay`, `payed`) VALUES
(1, 2, 0.00, 0.00, 0.00, NULL, NULL, 0.00, 21000.00, -20500.00),
(2, 3, 15000.00, 6000.00, 15000.00, NULL, NULL, 0.00, 8000.00, 23000.00),
(3, 6, 10000.00, 2500.00, 5002.00, NULL, NULL, 0.00, -10000.00, 10000.00),
(4, 18, 70000.00, NULL, 0.00, NULL, NULL, 35000.00, 0.00, NULL),
(5, 42, 0.00, NULL, 0.00, NULL, NULL, 0.00, 0.00, NULL),
(6, 44, 10.00, NULL, 10.00, NULL, NULL, 0.00, 0.00, NULL),
(7, 45, 5000.00, 1500.00, 5000.00, NULL, NULL, 0.00, 0.00, NULL),
(8, 53, 10000.00, 3000.00, 10000.00, NULL, NULL, 0.00, -30000.00, 30000.00),
(9, 55, 12000.00, 4000.00, 12000.00, NULL, NULL, 1.00, -888.00, 32000.00),
(10, 37, 200.00, NULL, 50.00, NULL, NULL, 0.00, 0.00, NULL),
(11, 57, 17000.00, NULL, 8500.00, NULL, NULL, 0.00, 0.00, NULL),
(12, 59, 4000.00, 1.00, 2000.00, NULL, NULL, 0.00, 0.00, NULL),
(13, 60, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(14, 62, 2000.00, NULL, 0.00, NULL, NULL, 1000.00, 0.00, NULL),
(15, 67, 1.00, 50.00, 1.00, NULL, NULL, 0.00, 50.00, NULL),
(16, 69, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(17, 71, 1.00, 1.00, 1.00, NULL, NULL, 0.00, 0.00, 1.00),
(18, 73, 1.00, 1.00, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(19, 70, 1500.00, 750.00, 751.00, NULL, NULL, 749.00, 0.00, 750.00),
(20, 76, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(21, 66, 1000.00, NULL, 1901.00, NULL, NULL, 0.00, -61900.00, 61900.00),
(22, 65, 1000.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(23, 64, 1000.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(24, 77, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(25, 78, 1.00, 1.00, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(26, 79, 10000.00, 1.00, 10000.00, NULL, NULL, 0.00, 1000.00, NULL),
(27, 81, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(28, 82, 6000.00, 0.00, 3000.00, NULL, NULL, 0.00, 0.00, NULL),
(29, 86, 10005000.00, NULL, 0.00, NULL, NULL, 5002500.00, 0.00, NULL),
(30, 88, 15000.00, 0.00, 7501.00, NULL, NULL, 0.00, 0.00, NULL),
(31, 90, 1.00, 10.00, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(32, 87, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(33, 89, 1.00, NULL, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(34, 96, 600.00, 300.00, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(35, 97, 6500000.00, 5000.00, 5.00, NULL, NULL, 0.00, 0.00, 720943.00),
(36, 98, 18000.00, 5000.00, 23000.00, NULL, NULL, 0.00, -55000.00, 55000.00),
(37, 99, 1200.00, 600.00, 600.00, NULL, NULL, 0.00, -600.00, 600.00),
(38, 100, 500.00, NULL, 0.00, NULL, NULL, 250.00, 0.00, NULL),
(39, 106, 1500.00, NULL, 750.00, NULL, NULL, 0.00, 0.00, NULL),
(40, 108, 1500.00, NULL, 750.00, NULL, NULL, 0.00, 0.00, NULL),
(41, 109, 750.00, NULL, 375.00, NULL, NULL, 0.00, 0.00, NULL),
(42, 101, 1500.00, 700.00, 750.00, NULL, NULL, 0.00, 0.00, NULL),
(43, 102, 1600.00, NULL, 1000.00, NULL, NULL, 0.00, 0.00, NULL),
(44, 103, 1200.00, NULL, 600.00, NULL, NULL, 0.00, 0.00, NULL),
(45, 104, 2000.00, NULL, 1000.00, NULL, NULL, 0.00, 0.00, NULL),
(46, 105, 1500.00, NULL, 750.00, NULL, NULL, 0.00, 0.00, NULL),
(47, 107, 1200.00, NULL, 600.00, NULL, NULL, 0.00, 0.00, NULL),
(48, 110, 2000.00, 1000.00, 1000.00, NULL, NULL, 0.00, 0.00, NULL),
(49, 111, 15000.00, 0.00, 1.00, NULL, NULL, 0.00, 0.00, NULL),
(50, 113, 2500.00, 1000.00, 1250.00, NULL, NULL, 0.00, 0.00, NULL),
(51, 118, 1600.00, 800.00, 800.00, NULL, NULL, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `1_Projects`
--

CREATE TABLE IF NOT EXISTS `1_Projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ID пользователя',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `add_demands` text COMMENT 'Доп. требования',
  `status` tinyint(4) DEFAULT '0' COMMENT 'Статус проекта',
  `executor` int(10) unsigned DEFAULT '0' COMMENT 'ID исполнителя',
  `notes` text NOT NULL COMMENT 'Заметки',
  `date` timestamp NULL DEFAULT NULL,
  `max_exec_date` timestamp NULL DEFAULT NULL,
  `manager_informed` timestamp NULL DEFAULT NULL,
  `author_informed` timestamp NULL DEFAULT NULL,
  `author_notes` text,
  `description` text NOT NULL,
  `old_status` tinyint(4) NOT NULL,
  `soderjanie` text NOT NULL,
  `specials` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `technicalspec` tinyint(1) NOT NULL DEFAULT '0',
  `opisanie` text NOT NULL,
  `posting` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения проектов (заказов)' AUTO_INCREMENT=121 ;

--
-- Дамп данных таблицы `1_Projects`
--

INSERT INTO `1_Projects` (`id`, `user_id`, `title`, `add_demands`, `status`, `executor`, `notes`, `date`, `max_exec_date`, `manager_informed`, `author_informed`, `author_notes`, `description`, `old_status`, `soderjanie`, `specials`, `is_active`, `technicalspec`, `opisanie`, `posting`) VALUES
(1, 23, 'Сбор инвестиций на админку', NULL, 5, 0, '', '2015-08-05 02:35:42', '2015-08-20 02:34:42', '2015-08-05 02:35:42', '2015-08-12 02:35:42', NULL, '321', 0, '', '', 1, 0, '', 0),
(2, 23, 'тест  тест тест тест тест тест тест тест тест тест тест тест ', 'тест ', 5, 0, '', '2015-08-05 19:44:17', '2015-01-01 00:00:44', '2015-01-01 00:00:44', '2015-01-01 00:00:44', '', '', 0, '', '', 1, 0, '', 0),
(3, 23, 'Инвестиции на развитие шмитрикса 2.0', 'нет', 5, 0, '9.08 -  10.08 Оплатит в офисе', '2015-08-09 08:08:51', '2015-08-28 08:06:11', '2015-08-15 08:08:11', '2015-08-20 08:08:11', NULL, '', 0, '', '', 1, 0, '', 0),
(44, 23, 'Заказ на сайт', NULL, 5, 0, 'Примечания по заказу для менеджера.\n1 2 3...', '2015-08-17 23:41:53', '2015-09-10 23:40:34', '2015-08-18 23:41:34', '2015-08-28 23:41:34', 'Примечания по заказу для Автора.\n1 2 3...', 'Нету', 3, 'Требуется продающий сайт, для продад бытовой техники. В стиле минимализма', '', 1, 0, '', 0),
(53, 23, 'Разработать план продвижения дипстарт', NULL, 5, 0, '', '2015-08-19 17:16:39', '2015-09-24 17:14:05', '2015-08-23 17:16:10', '2015-08-23 20:00:10', NULL, '', 3, 'Обсудим план и выявим фронт работ', '10', 1, 0, '', 0),
(59, 43, 'Оптимизация внутренних страниц (а так-же очистка от пере-спама)', NULL, 3, 0, '05.09 - План не утвержден, это не план для dipstart ! Автор снят, если что восстановить.\n31.08 ждем утверждения плана\n29.08 нужно постить', '2015-08-22 00:46:47', '2015-09-05 00:41:44', '2015-09-05 12:46:44', '2015-09-05 14:46:44', NULL, 'Нет', 0, 'Оптимизировать страницы на dipstart.ru и очистить от пере-спама.', '10', 1, 0, '', 0),
(60, 43, 'Помыть полы в квартире', NULL, 5, 0, '22.08 - Ожидаем как проснется исполнитель.', '2015-08-22 02:41:25', '2015-08-24 23:59:28', '2015-08-23 02:41:28', '2015-08-23 16:00:28', NULL, 'Выполнять в хорошем настроении .', 3, 'Требуется взять ведро, налить в него воду и помыть полы.', '17', 1, 0, '', 0),
(61, 44, 'проект   сайт -блог-интернет -магазин ', NULL, 5, 0, '', '2015-08-22 02:49:20', '2015-08-22 01:47:20', '2015-08-22 02:49:20', '2015-08-22 02:49:20', NULL, 'эээмммм  -  хз пока не еще не знаю  - думаю что в поле бизнес под ключ должны быть поля с приблизительными вариантами что делать ', 1, 'не понятное поле  - что это значит  ? ', '18', 1, 0, '', 0),
(62, 45, 'Макет скидочного проекта', NULL, 5, 0, 'Ждем заказчика. Продлить сроки ', '2015-08-22 02:50:27', '2015-08-24 15:00:47', '2015-08-27 02:50:47', '2015-08-23 02:50:47', NULL, '', 2, '', '6', 1, 0, '', 0),
(64, 43, 'Проведение перелинковки страниц', NULL, 4, 69, 'Требуется искать исполнителя на все заказы раздела СЕО\n03.09 ждем доступ\n31.08 рассылка, общаемся с автором зак 59\n02.09 снят исполнитель', '2015-08-22 03:37:57', '2015-09-10 03:36:58', '2015-09-05 19:37:58', '2015-09-05 23:37:58', NULL, '', 0, 'Какие стр. нуждаются в перелинковке см на dipstart.ru \r\nВам как специалисту виднее', '10', 1, 0, '', 1),
(65, 43, 'Закупка ссылочной массы', NULL, 3, 0, 'Бюджет 30% от стоимости ссылок. Уточнить', '2015-08-22 03:40:16', '2015-11-01 03:39:10', '2015-09-05 21:40:10', '2015-09-26 03:40:10', NULL, 'Вечные ссылки (постовые, статьи).', 0, 'Закупка вечных ссылок', '10', 1, 1, '', 0),
(66, 43, 'Анализ позиций по продвигаемым запросам', NULL, 3, 0, '', '2015-08-22 03:42:54', '2015-11-30 03:40:23', '2015-09-05 23:42:23', '2015-10-10 03:42:23', NULL, 'Выполнение задачи ежемесячно.', 0, 'Требуется смотреть позиции по продвигаемым запросам, создавать отчет и анализировать его', '10', 1, 0, '', 1),
(67, 43, 'Реализовать систему оповещений о получении сообщения в чате.', NULL, 5, 14, '', '2015-08-22 04:05:11', '2015-08-23 04:03:55', '2015-08-23 04:05:55', '2015-08-22 14:00:55', 'Сообщить точное время', 'Оценить время выполнения и сразу сообщить.', 4, 'Пользователи (заказчик\\исполнитель), должны получать уведомление на почту, о том, что пришло сообщение в чат. ', '12', 1, 0, '', 0),
(68, 45, 'Сделать инструкции к данной админке', NULL, 5, 0, '', '2015-08-22 18:15:39', '2015-08-27 18:00:13', '2015-08-26 18:15:13', '2015-08-24 18:15:13', NULL, '', 1, 'Для трех пользователей:\r\nа) менеджер\r\nб) клиент\r\nв) автор\r\n\r\nНужно сделать текст и видео инструкцию ( скрин кастами), затем проверить её на юзерах', '17', 1, 0, '', 0),
(69, 43, 'Исправить ошибку отправки сообщений в чате менеджером.', NULL, 5, 0, 'Закрыть заказ 26.08\nЕсли Дима не отпишет дело его\nЗаказ был выполнен благотворительно святым духом', '2015-08-22 19:17:31', '2015-08-23 19:15:05', '2015-08-26 19:17:05', '2015-08-22 22:00:05', 'Не забыть уточнить необходимое время.', '', 3, 'Ошибка при отправке сообщения в чате менеджером, как заказчику так и Автору \r\nhttp://shot.qip.ru/00LfpV-53pgxjydM/ \r\nСообщения при этом отправляется.\r\nКогда заказчик отправляет у него ошибки нет. (Только у менеджера)', '12', 1, 0, '', 0),
(70, 45, 'Заполнить интернет магазин товарами ', NULL, 4, 74, '04.09 коректировки\n02.09 автор снят - не выходит на свя\n03.09 уточняем парол\nВыполняем', '2015-08-22 19:21:34', '2015-09-11 00:00:51', '2015-09-05 20:21:51', '2015-09-05 18:00:51', NULL, 'http://ano-po.ru/wp-admin/ login: admin password: admin\r\n\r\nСсылка на список товаров (прайс) : \r\nhttps://drive.google.com/drive/folders/0BwGypp3npIYYfmpJSzFnd3lvZlZlNWtlaWNpWUhnYUhEdXNNVjlrYUswaUJaUjRRaUdqMWc\r\n\r\nнужно по каждой категории по 2 товара - один качественный второй дешевый. Всего в сумме ~50 товаров', 0, '', '17', 1, 0, 'Цены на 20% выше, чем в прайсе.\r\n1. Выбираем в меню Товар - Добавить товар\r\n2. Пишем название\r\n3. Указываем Артикул и цену (руб)\r\n4. В правой колонке, в категории товаров выбираем соответствующую категорию.\r\n4.1 Если её нет нужно создать\r\n5. Так-же в правой колонке, в блоке миниатюра записи, загружаем фото товара. (Фото найти в инете!)\r\n* В описаниях товара загружаем ту-же фотку\r\n* Не забываем указывать производителя\r\n* Не забываем указывать объем\r\n', 0),
(71, 43, 'Исправить баг с даблкликом', NULL, 5, 31, 'Выполнен', '2015-08-22 19:27:55', '2015-08-24 19:27:18', '2015-08-23 19:27:18', '2015-08-23 15:00:18', 'Время выполнения', '', 4, 'При попытке перейти в любой заказ с помощью даблклика выбивает ошибки.\r\nhttp://shot.qip.ru/00LfpV-63pgxjydN/\r\n', '12', 1, 0, '', 0),
(73, 43, 'Править таблицу информации о заказе, выдаваемую после регистрации заказа', NULL, 5, 31, '', '2015-08-22 19:38:56', '2015-08-25 18:00:48', '2015-08-25 19:38:48', '2015-08-25 18:00:48', 'Время на задачу 10 минут.', '', 4, 'В таблице информации о заказе, сразу после его оформления заказчиком. \r\nУбрать поле “Срок для Автора”, поле временный номер не трогать.\r\nhttp://shot.qip.ru/00LfpV-63pgxjydO/', '12', 1, 0, '', 0),
(76, 43, 'Разработать план продвижения дипстарт ру', NULL, 3, 0, 'Найти исполнителя на все СЕО заказы..\n29.08 рассылка и постить надо', '2015-08-23 15:49:48', '2015-09-05 20:00:36', '2015-09-05 08:00:36', '2015-09-04 17:00:36', NULL, '', 0, 'Обсудим план и выявим фронт работ. Сайт: dipstart.ru', '10', 1, 0, '', 1),
(77, 43, 'Реализовать многоязычность в админке', NULL, 5, 0, 'Нужна помощь тех спеца. И нужно найти исполнителя.\n29.08 ждем поля на Перф пап', '2015-08-23 19:13:22', '2015-09-05 19:07:26', '2015-09-02 18:13:26', '2015-09-02 23:13:26', NULL, '', 3, 'Сделать темы и всё что нужно , для того чтобы админка была на разных языках. ', '12', 1, 1, '', 0),
(78, 43, 'Реализовать автоматизированную регистрацию компаний', NULL, 4, 31, 'Отложена', '2015-08-23 19:18:17', '2015-09-10 19:14:46', '2015-09-05 19:18:46', '2015-09-06 19:18:46', NULL, 'Отписать срок выполнения.', 0, 'Разбиваем на части. \r\n1. Набросать словесный скрипт + sql файл \r\n2. ***', '12', 1, 1, '', 0),
(79, 43, 'Добавить галочку "Требуется тех. специалист"', NULL, 5, 31, '', '2015-08-23 20:21:01', '2015-08-24 19:19:47', '2015-08-26 20:21:47', '2015-08-23 20:21:47', NULL, '', 4, 'Просто в форму заказа, пока без всякого функционала. \r\nПод статус предлагаю вынести. В виде иконки чек-бокса, как и Заверить заказ кнопка.', '12', 1, 0, '', 0),
(80, 45, 'Поля на perfect-paper', NULL, 5, 0, '29.08 выясняем у Артура поля, а у Миши - сроки выполн\nзаказ выполнен, завершаем', '2015-08-24 02:15:36', '2015-08-24 02:15:42', '2015-08-31 16:55:42', '2015-08-24 02:15:42', NULL, 'Состав полей и их детали выяснять у Артура.', 0, 'Нужно наполнить полями (для заказов и для пользователей) http://perfect-paper.obshya.com/', '17', 1, 0, '', 0),
(83, 45, 'Улучшить фронт-энд формы Заказчика', NULL, 5, 0, 'Ожидаем заказчика.', '2015-08-25 17:31:35', '2015-09-04 17:25:33', '2015-08-26 17:31:33', '2015-08-29 17:31:33', NULL, '', 1, '1. Регистрация\r\n2. Инструкция\r\n3. Авторизация\r\n4. ЛК', '6', 1, 0, '', 0),
(87, 45, 'Тестирование  проекта Pesatu', NULL, 5, 0, 'ПРИОСТАНОВЛЕН\n29.08 рассылка\n30.08 рас, фл https://www.weblancer.net/projects/707947.html\nhttps://freelancehunt.com/project/srochno-nuzhno-protestirovat-bek-end/81831.html', '2015-08-27 02:03:55', '2015-08-30 22:00:54', '2015-08-31 02:03:54', '2015-08-31 08:00:54', NULL, '', 3, 'Протестировать бек енд на соотвествиие тз  \r\nвыявить ошибки и нереализованные компоненты\r\nзаписать ошибки в бак треккер', '17', 1, 1, 'https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit#', 1),
(88, 45, 'Лендинг для сервиса Pesatu', NULL, 4, 51, '31.08 рассылка спецам по лендингу из дока\n04.09 утверждаем стилистику с заком', '2015-08-28 02:01:11', '2015-09-08 16:00:00', '2015-09-05 19:01:00', '2015-09-05 23:00:00', NULL, '', 0, '1. Сделать прототип  (макет) и согласовать его\r\n2. сделать дизайн или найти типовой\r\n3. сверстать ', '7', 1, 0, 'описание проекта: https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit#\r\nсамо задание: https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit#heading=h.jm7jyhbmvksd\r\n', 0),
(89, 45, 'Страница для перехода по реф ссылке по проекту Pesatu', NULL, 3, 0, 'Ждем ответ заказчика и действуем исходя их этого\n29.08 рассылка', '2015-08-28 02:24:10', '2015-09-05 23:10:27', '2015-09-05 20:24:27', '2015-09-05 13:45:27', NULL, '', 0, '', '7', 1, 0, 'общее описание проекта https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit#heading=h.h9vmskb6zsjw\r\n\r\nПокупатель, переходя по рефелеальной ссылке должен попадать на наш страницу где будет текст и поле для тел или емаила, ниже фреймом ему выдается страница инет-магаза. Так же должно открываться окно поп-ап с гс сайта. \r\n\r\nсделать нужно что бы было так: http://shot.qip.ru/00KqGn-514a5VJoK5/\r\n\r\n', 0),
(90, 45, 'Pesatu: на емаил пароль не приходит', NULL, 5, 14, '', '2015-08-28 02:34:59', '2015-08-30 18:00:40', '2015-08-30 01:00:40', '2015-08-30 08:00:40', NULL, 'сделать что бы приходил\r\nпри регистрации	у Покупателя\r\n', 4, '', '12', 1, 0, 'https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit#heading=h.rnse51ikhya8\r\n', 0),
(96, 43, 'Сделать системные сообщения', NULL, 4, 64, '30.08 рассылка, общаемся с Костей, Димой, Артем\n04.09 ждем утверждения половины работы', '2015-08-30 11:52:03', '2015-09-05 23:00:48', '2015-09-05 16:00:48', '2015-09-05 15:00:48', NULL, 'нет', 0, 'https://docs.google.com/document/d/1TJhuxhfDH-Oqm3NXkA6dOG1SKNcvrVT3zOnCZLpJY6Q/edit#', '22', 1, 0, '', 0),
(97, 57, 'Крещение руси 988 года ', NULL, 5, 56, '', '2015-08-30 13:24:03', '2015-09-25 13:21:05', '2015-08-01 13:24:05', '2015-09-11 13:24:05', NULL, 'ТЕСТ', 4, 'тестовый ', '17', 1, 0, '', 0),
(98, 57, 'IRc', NULL, 5, 56, '', '2015-08-30 14:34:17', '2015-09-19 14:33:33', '2015-08-30 14:34:17', '2015-09-08 14:34:17', NULL, 'Согласование с научным руководитлем ( частями) ', 4, 'авпвываыа', '12', 1, 0, '', 0),
(99, 43, 'Починить бухгалтерию', NULL, 5, 31, '', '2015-08-30 15:30:55', '2015-08-30 22:00:51', '2015-08-30 18:00:51', '2015-08-30 18:00:51', NULL, 'А так-же просмотреть систему оплат. Там очень криво, при подтверждении платежа от заказчика, т.е входящего платежа. Платеж фиксируется как оплаченный Автору каким-то образом.', 4, 'На усмотрение специалиста', '22', 1, 0, 'После выполнения фильтров в БГ, сломалось подтверждение заказов. \r\nКнопки подтвердить стали работать криво, обновляются только после обновления страницы. \r\nИ суммы определяются не понятно, какие-то кривые, там минуса откуда-то берутся.', 0),
(100, 45, 'Исправить ano-po.ru', NULL, 5, 31, '30.08 рассылка, общаемся с Костей, Димой, Артемом\n31.08 выполнено', '2015-08-30 17:25:45', '2015-08-30 19:00:12', '2015-09-01 17:25:12', '2015-08-30 17:25:12', NULL, '', 4, '', '27', 1, 1, 'пишет serv error', 0),
(101, 43, 'Исправить срочные баги', NULL, 4, 31, '', '2015-08-30 18:50:03', '2015-09-05 20:00:13', '2015-09-05 02:00:13', '2015-09-04 23:00:13', NULL, 'Группа "100', 0, 'Правим конкретные номера из документа.\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 19, 25.', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(102, 43, 'Исправить срочные баги', NULL, 4, 52, '30.08 рассылка, общаемся с Артемом', '2015-08-30 18:54:58', '2015-09-04 18:50:31', '2015-09-06 12:54:31', '2015-08-31 13:00:31', NULL, 'Группа "55', 0, 'Править конкретные номера из документа.\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 20, 23, 24.\r\n', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(103, 43, 'Исправить срочные баги #3', NULL, 3, 0, '30.08 рассылка, пишем спецам по админтриксу', '2015-08-30 19:00:16', '2015-09-05 18:55:29', '2015-09-05 10:00:29', '2015-09-05 23:00:29', NULL, 'Группа "310\r\nХотелось бы чтобы выполнял хороший специалист, т.к нужно будет затронуть принцип модерации заказа на этапе оформления.', 0, 'Исправить конкретные номера из документа.\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 1, 32, 37.', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(104, 43, 'Исправить баги средней срочности #1', NULL, 3, 0, '', '2015-08-30 19:04:36', '2015-09-06 23:00:19', '2015-09-05 19:04:19', '2015-09-05 22:00:19', NULL, 'Группа "44', 0, 'Править конкретные номера из документа.\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 9, 13, 27.\r\n', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 1),
(105, 43, 'Исправить баги средней срочности #2', NULL, 3, 0, 'Уточняем бюджет', '2015-08-30 19:06:13', '2015-09-06 20:00:41', '2015-09-05 18:00:41', '2015-09-05 23:00:41', NULL, 'Группа "88', 0, 'Исправляем конкретные номера из документа\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 21, 22', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(106, 43, 'Исправить баги средней срочности #3', NULL, 3, 0, 'рассылк', '2015-08-30 19:07:12', '2015-09-05 18:00:58', '2015-09-05 09:00:58', '2015-09-05 03:00:58', NULL, 'Группа "22', 0, 'Исправляем конкретные номера их документа\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 11, 12, 14\r\n', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(107, 43, 'Исправить баги #1', NULL, 3, 0, 'автор снят, рассылка', '2015-08-30 19:23:11', '2015-09-06 23:00:19', '2015-09-05 20:23:19', '2015-09-05 23:00:19', NULL, 'Группа " 85', 0, 'Исправить баги из документа\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 33, 34, 35, 36', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(108, 43, 'Исправить баги #2', NULL, 3, 0, '01.09 автор морозится- снят, рассылка\n02.09 эх, постим на yii...', '2015-08-30 19:24:41', '2015-09-05 15:00:50', '2015-09-05 07:24:50', '2015-09-05 12:24:50', NULL, 'Группа "00', 0, 'Исправить конкретные задачи из документа\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 10, 15, 39', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 0),
(109, 43, 'Исправить баги #3', NULL, 3, 0, '', '2015-08-30 19:30:02', '2015-09-05 22:00:44', '2015-09-05 11:30:44', '2015-09-05 15:00:44', NULL, 'Группа "19\r\nМожно и даже лучше, передать начинающему.', 0, 'Правим конкретные задачи из документа\r\nhttps://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=0\r\nНомера : 28, 29, 30, 38, 41.', '22', 1, 0, 'https://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#', 1),
(110, 43, 'Выполнить задачи по фронтенду', NULL, 4, 41, '02.09 -готовы все задачи кроме 4: для неё программист должен сначала сделать вывод модулей ', '2015-08-30 21:39:20', '2015-09-04 23:00:51', '2015-09-05 09:00:51', '2015-09-04 23:00:51', NULL, '', 0, 'Выполнить конкретные задачи из документа', '7', 1, 0, 'https://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=184454896\r\nНомера задач : 1 - 7', 0),
(111, 93, 'Верстка и программирование сайта ', NULL, 5, 0, 'Определить бюджет исходя из исполнителей', '2015-09-02 18:05:32', '2015-09-06 18:04:23', '2015-09-04 22:05:23', '2015-09-04 23:00:23', NULL, '', 3, '1. Сверстать лендинг\r\n2. Выполнить программную часть', '7', 1, 0, 'ТЗ верстка и программирование лендинга! \r\nНеобходимо сверстать лендинг! Вам необходим компьютер макбук \r\nИсходный файл вот: \r\nhttps://dl.dropboxusercontent.com/u/64731889/SRO_10.sketch\r\nhttps://dl.dropboxusercontent.com/u/64731889/Main%20Screen%20Calc.png\r\nЧто необходимо сделать: \r\nВозможность насильно включать первые 3 кнопки! \r\nhttp://joxi.ru/EA4vxv7hQD1Kmb\r\nПосмотреть примеры табов можно здесь: \r\nhttp://vstupit-v-sro-segodnya.ru/ \r\nhttp://vstupit-v-sro-segodnya.ru/?utm_source=yandex&utm_medium=cpc&utm_term=%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C+%D0%B4%D0%BE%D0%BF%D1%83%D1%81%D0%BA+%D1%81%D1%80%D0%BE+%D0%B8%D0%B7%D1%8B%D1%81%D0%BA%D0%B0%D1%82%D0%B5%D0%BB%D0%B5%D0%B9&utm_campaign=%D0%B3%D0%BE%D1%80%D1%8F%D1%87%D0%B8%D0%B5_%D1%80%D0%B5%D0%B3%D0%B8%D0%BE%D0%BD%D1%8B&group=2&tab=3\r\nhttp://vstupit-v-sro-segodnya.ru/?utm_source=yandex&utm_medium=cpc&utm_term=%D0%BF%D0%BE%D0%BB%D1%83%D1%87%D0%B8%D1%82%D1%8C+%D0%B4%D0%BE%D0%BF%D1%83%D1%81%D0%BA+%D1%81%D1%80%D0%BE+%D0%B8%D0%B7%D1%8B%D1%81%D0%BA%D0%B0%D1%82%D0%B5%D0%BB%D0%B5%D0%B9&utm_campaign=%D0%B3%D0%BE%D1%80%D1%8F%D1%87%D0%B8%D0%B5_%D1%80%D0%B5%D0%B3%D0%B8%D0%BE%D0%BD%D1%8B&group=2&tab=1\r\nМеханизм переключения табов должен быть реализован как здесь \r\nВ зависимости от кнопки будут картинки!\r\nОпределение города с помощью ip, подстановка картинки в соответсвии с городом и подстановка компаний в этом городе http://joxi.ru/GrqgkgOtPN9e2z', 0),
(112, 45, 'Сделать личные кабинеты по проекту Pesatu ', NULL, 1, 0, 'рассылка', '2015-09-03 01:27:27', '2015-09-17 01:07:40', '2015-09-05 12:27:40', '2015-09-09 01:27:40', NULL, 'https://github.com/akoch-ov/skidos - создавайте свой форк и делайте на своем сервере и покажите результат на своем сервере ', 0, 'Лк Админа\r\nЛк покупателя - Главная \r\nЛк покупат - Транзакции (у покупателя)\r\n', '12', 1, 0, 'общее описание проекта: https://docs.google.com/document/d/1Ax0DZHKRbhyyH9dv5Jd_TZOLi7yKmqnBhFMXJ9b9OeY/edit?usp=sharing\r\n', 0),
(113, 43, 'Наладить вывод текстов через стандартный механизм "Yii::t()?"', NULL, 4, 73, '04.09 автор снят', '2015-09-03 21:26:26', '2015-09-05 22:00:36', '2015-09-05 15:00:36', '2015-09-05 10:00:36', NULL, '', 0, '', '12', 1, 0, 'Описание проекта по ссылке \r\nhttps://docs.google.com/document/d/1EWjAigYxOcdczexkT7hRzyi-t65hEIgV1uXc7YMqz6o/edit#heading=h.jet93ehogn21\r\nДля задачи не обязательно изучать описание, в файле есть доступы', 0),
(114, 102, 'Вёрстка', NULL, 5, 0, '04.09 рассылка, ждем уточнения ', '2015-09-03 22:32:14', '2015-09-04 22:31:49', '2015-09-04 17:32:49', '2015-09-04 17:32:49', NULL, '', 1, '', '7', 1, 0, '', 0),
(115, 119, 'сайт "Бюро информационных услуг"', NULL, 1, 0, '', '2015-09-04 16:11:54', '2015-09-25 16:06:03', '2015-09-05 21:11:03', '2015-09-14 16:11:03', NULL, '', 0, '', '7', 1, 0, '', 0),
(118, 43, 'Выполнить задачи по фронтенду', NULL, 4, 41, '', '2015-09-04 20:35:27', '2015-09-06 20:34:48', '2015-09-05 15:00:48', '2015-09-05 20:35:48', NULL, '', 0, 'Выполнить конкретные задачи из документа', '7', 1, 0, 'https://docs.google.com/spreadsheets/d/1Iewd1UEuvDczfFMl4nhZ4tXEELhQ_DX5FsNz2lW3O38/edit#gid=184454896\r\nНомера задач : 9 - 15 \\ кроме 12', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectsEvents`
--

CREATE TABLE IF NOT EXISTS `1_ProjectsEvents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `description` text,
  `timestamp` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=654 ;

--
-- Дамп данных таблицы `1_ProjectsEvents`
--

INSERT INTO `1_ProjectsEvents` (`id`, `type`, `event_id`, `description`, `timestamp`, `status`) VALUES
(646, '5', 88, 'Пользователь Rihard оставил сообщение: "Подтвердите насчет стиля лендинга. Работа стоит."', 1441433202, 0),
(653, '5', 101, 'Пользователь akoch-ov оставил сообщение: "Поправил"', 1441455061, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ProjectsParts`
--

CREATE TABLE IF NOT EXISTS `1_ProjectsParts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `proj_id` int(11) unsigned NOT NULL COMMENT 'ID проекта',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `file` varchar(255) DEFAULT NULL COMMENT 'Вложенный файл',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `show` tinyint(1) DEFAULT '0',
  `author_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Дополнительные части (этапы) проекта' AUTO_INCREMENT=103 ;

--
-- Дамп данных таблицы `1_ProjectsParts`
--

INSERT INTO `1_ProjectsParts` (`id`, `proj_id`, `title`, `file`, `date`, `payment`, `comment`, `show`, `author_id`) VALUES
(2, 1, 'Внимание', NULL, '2015-08-05 22:51:20', NULL, 'Хватай баблос', 0, '0'),
(3, 1, 'Оооп', NULL, '2015-08-06 01:50:16', NULL, NULL, 0, '0'),
(4, 1, 'Новая Часть', NULL, '2015-08-06 01:50:19', NULL, NULL, 0, '0'),
(6, 3, '1-я Часть', NULL, '2015-08-14 08:25:50', NULL, NULL, 0, '0'),
(7, 3, '2-я Часть', NULL, '2015-08-17 08:25:00', NULL, NULL, 0, '0'),
(8, 3, 'Вся работа', NULL, '2015-08-20 08:27:01', NULL, NULL, 0, '0'),
(9, 6, 'Половина работы', NULL, '2015-08-12 12:22:44', NULL, NULL, 0, '32'),
(10, 6, 'Вся работа', NULL, '2015-08-22 12:22:05', NULL, NULL, 0, '32'),
(11, 8, '1-я Глава', NULL, '2015-08-15 19:06:29', NULL, NULL, 0, '0'),
(12, 6, 'презентация', NULL, '2015-08-24 16:46:22', NULL, NULL, 0, '32'),
(13, 6, 'Речь', NULL, '2015-08-27 16:47:09', NULL, NULL, 0, '32'),
(27, 45, '1-я часть', NULL, '2015-08-20 15:55:51', NULL, NULL, 0, '0'),
(28, 45, '2-я часть', NULL, '2015-08-25 15:55:27', NULL, NULL, 0, '0'),
(30, 45, 'Вся работа', NULL, '2015-08-28 16:10:20', NULL, NULL, 0, '0'),
(31, 53, 'План работ', NULL, '2015-08-22 17:37:10', NULL, NULL, 0, '24'),
(34, 55, 'Вся работа', NULL, '2015-08-24 01:21:20', NULL, NULL, 0, '24'),
(35, 55, 'Корректировки', NULL, '2015-08-26 01:25:37', NULL, NULL, 0, '24'),
(36, 37, '1 я часть ', NULL, '2015-08-25 12:41:44', NULL, NULL, 0, '24'),
(37, 57, 'Новая Часть', NULL, '2015-08-27 17:21:42', NULL, NULL, 0, '14'),
(38, 57, 'Новая Часть', NULL, '2015-08-30 17:21:52', NULL, NULL, 0, '14'),
(39, 57, 'Новая Часть', NULL, '2015-08-31 17:21:19', NULL, NULL, 0, '14'),
(40, 57, 'Новая Часть', NULL, '2015-09-03 17:21:26', NULL, NULL, 0, '14'),
(41, 60, 'Вся работа', NULL, '2015-08-22 02:44:48', NULL, NULL, 0, '0'),
(42, 76, 'План продвижения', NULL, '2015-08-23 21:00:25', NULL, 'Сюда загрузить план', 0, '0'),
(43, 78, '1-й этап', NULL, '2015-08-23 19:25:05', NULL, 'Sql скрипт ', 0, '0'),
(46, 79, '1-я часть', NULL, '2015-08-25 14:23:37', NULL, NULL, 0, '0'),
(47, 79, '5-я часть', NULL, '2015-08-24 14:25:18', NULL, NULL, 0, '0'),
(51, 82, '1-я часть', NULL, '2015-08-25 18:28:03', NULL, NULL, 0, '32'),
(52, 82, '2-я часть', NULL, '2015-08-27 18:29:13', NULL, NULL, 0, '32'),
(53, 82, '3-я часть', NULL, '2015-08-29 18:29:26', NULL, NULL, 0, '32'),
(54, 68, 'Менеджеры', NULL, '2015-08-25 18:04:27', NULL, NULL, 0, '0'),
(55, 68, 'Исполнители', NULL, '2015-08-25 18:04:10', NULL, NULL, 0, '0'),
(56, 45, 'Новая Часть', NULL, '2015-08-28 05:00:43', NULL, NULL, 0, '24'),
(57, 45, 'Новая Часть', NULL, '2015-08-28 05:00:47', NULL, NULL, 0, '24'),
(58, 59, 'План', NULL, '2015-08-31 05:07:29', NULL, NULL, 0, '0'),
(59, 88, 'Макет', NULL, '2015-09-03 17:00:10', NULL, NULL, 0, '0'),
(60, 88, 'Дизайн', NULL, '2015-09-05 14:00:20', NULL, NULL, 0, '0'),
(61, 88, 'Сверстать', NULL, '2015-08-05 20:00:51', NULL, NULL, 0, '0'),
(63, 87, 'половина', NULL, '2015-08-29 16:46:52', NULL, NULL, 0, '0'),
(64, 87, 'вся', NULL, '2015-08-29 16:47:21', NULL, NULL, 0, '0'),
(65, 96, 'Половина', NULL, '2015-08-31 23:00:27', NULL, NULL, 0, '0'),
(70, 98, 'Новая Часть', NULL, '2015-09-01 14:51:55', NULL, NULL, 0, '56'),
(71, 108, 'задача 10 из ТЗ', NULL, '2015-08-31 17:25:37', NULL, NULL, 0, '0'),
(72, 110, 'Задачи 5, 6, 7 ', NULL, '2015-08-30 22:30:02', NULL, NULL, 0, '41'),
(73, 110, 'Задача 2 ', NULL, '2015-08-30 23:50:02', NULL, NULL, 0, '41'),
(74, 110, 'Задачи 1, 3, 4', NULL, '2015-08-02 14:00:44', NULL, NULL, 0, '41'),
(75, 102, 'Задачи 20 и 23', NULL, '2015-08-31 11:58:58', NULL, NULL, 0, '52'),
(76, 102, 'Задача 24', NULL, '2015-08-31 12:59:17', NULL, NULL, 0, '52'),
(78, 97, '1-я ', NULL, '2015-08-27 07:52:01', NULL, NULL, 0, '56'),
(79, 97, '2', NULL, '2015-08-20 12:53:10', NULL, NULL, 0, '56'),
(80, 64, 'Половина работы', NULL, '2015-09-02 05:02:44', NULL, NULL, 0, '69'),
(81, 64, 'Вся', NULL, '2015-09-04 03:02:24', NULL, NULL, 0, '69'),
(82, 107, '33,34', NULL, '2015-09-01 14:30:40', NULL, NULL, 0, '73'),
(83, 107, '35,36', NULL, '2015-09-01 16:00:30', NULL, NULL, 0, '73'),
(84, 108, 'задачи № 15,39 из ТЗ', NULL, '2015-08-31 18:24:18', NULL, NULL, 0, '73'),
(85, 109, '28,29', NULL, '2015-08-31 17:55:18', NULL, NULL, 0, '74'),
(86, 109, '30,38', NULL, '2015-08-31 17:55:39', NULL, NULL, 0, '74'),
(87, 109, '41', NULL, '2015-08-31 17:55:59', NULL, NULL, 0, '74'),
(88, 96, 'Вся', NULL, '2015-09-01 09:19:53', NULL, NULL, 0, '64'),
(89, 106, 'Задача 11', NULL, '2015-09-01 12:20:16', NULL, NULL, 0, '0'),
(90, 106, 'Задача 12', NULL, '2015-09-01 13:20:23', NULL, NULL, 0, '0'),
(91, 106, 'Задача 14', NULL, '2015-09-01 21:20:29', NULL, NULL, 0, '0'),
(92, 104, '9', NULL, '2015-09-02 14:57:26', NULL, NULL, 0, '0'),
(93, 104, '13', NULL, '2015-09-02 21:57:31', NULL, NULL, 0, '0'),
(94, 104, '27', NULL, '2015-09-02 10:57:37', NULL, NULL, 0, '0'),
(95, 103, '32', NULL, '2015-09-03 00:09:44', NULL, NULL, 0, '0'),
(96, 103, '37', NULL, '2015-09-03 05:09:48', NULL, NULL, 0, '0'),
(97, 103, '1', NULL, '2015-09-03 22:10:36', NULL, NULL, 0, '0'),
(98, 70, 'Половина', NULL, '2015-09-03 23:01:11', NULL, NULL, 0, '74'),
(99, 70, 'вся', NULL, '2015-09-04 16:01:30', NULL, NULL, 0, '74'),
(100, 113, 'Готовая работа', NULL, '2015-09-04 10:00:44', NULL, NULL, 0, '73'),
(101, 118, 'Задачи 9,10', NULL, '2015-09-05 14:00:35', NULL, NULL, 0, '0'),
(102, 118, 'Задачи 11, 13, 14, 15', NULL, '2015-09-05 20:00:38', NULL, NULL, 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `1_Templates`
--

CREATE TABLE IF NOT EXISTS `1_Templates` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `type_id` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `1_Templates`
--

INSERT INTO `1_Templates` (`id`, `name`, `title`, `text`, `type_id`) VALUES
(2, 'Заказчику', 'когда не можем дозвониться', 'К сожалению, не можем дозвониться на указанный в заказе телефон, пожалуйста, оставьте актуальный номер телефона в чате заказа или наберите нас + 7 (495) 504 37 19, необходимо обсудить детали Вашего заказа. Спасибо за доверие к нашей компании!', 1),
(3, 'Заказчику', 'если не оставил телефон', 'Здравствуйте!\r\n\r\nВы оформили заявку на сайте http://adco.obshya.com/\r\n\r\nСпасибо за проявленный интерес к нашей компании!\r\n\r\nРаботу по Вашему заказу выполним! \r\n\r\nОриентировочная цена такой работы: от …\r\n\r\nВы можете задать свой вопрос в Чате Вашего заказа (предварительно авторизовавшись на сайте) или перезвонить нам по телефону: +7(495) 504-37-19.\r\n\r\nТакже, для уточнения подробностей, Вы можете оставить свой контактный телефон - и мы с удовольствием Вам перезвоним и проконсультируем Вас по всем вопросам :).', 1),
(4, 'Заказчику', 'спрашивает, что с работой', 'Здравствуйте!\r\n\r\nС Вашим заказом все в порядке. Исполнитель работает.\r\n\r\nРабота будет выполнена в срок, указанный в заявке (сроки сдачи частей работы остаются на усмотрение исполнителя)\r\n\r\n', 1),
(5, 'Исполнителю', 'просьба зайти в чат', 'Просьба почаще проверять чат по взятым заказам и вовремя отвечать на сообщения, чтобы была понятна ситуация по заказу. Это не займет много времени. Спасибо', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `1_UpdateProfile`
--

CREATE TABLE IF NOT EXISTS `1_UpdateProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'Пользователь',
  `attribute` varchar(255) NOT NULL COMMENT 'Атрибут',
  `from_data` text COMMENT 'Старое значение',
  `to_data` text COMMENT 'Новое значение',
  `status` tinyint(1) DEFAULT NULL COMMENT 'Статус',
  `date_update` int(11) NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Дамп данных таблицы `1_UpdateProfile`
--

INSERT INTO `1_UpdateProfile` (`id`, `user`, `attribute`, `from_data`, `to_data`, `status`, `date_update`) VALUES
(1, 23, 'mob_tel', '+7-978-7540970', '+7-978-7540971', 1, 1439258310),
(2, 23, 'how_hear', 'От Димы прогера', 'От ', 1, 1439258310),
(3, 23, 'lastname', 'Голодрыга', 'Николаев', 1, 1439258311),
(4, 23, 'firstname', 'Артур', 'Николай', 1, 1439258312),
(5, 23, 'mob_tel', '+7-978-7540970', '+7-955-7550575', 1, 1439258313),
(6, 23, 'skype', 'sheva1*72', 'Moscow boy', 1, 1439258314),
(7, 23, 'city', 'Симферополь', 'Moscow', 1, 1439258315),
(8, 23, 'how_hear', 'От Димы прогера', 'Test', 1, 1439258317),
(9, 32, 'city', 'Авторитетный', 'Авторитетинск', 1, 1439366505),
(10, 32, 'mob_tel', '+7-000-0000000', '+7-985-9613321', 1, 1439366744),
(11, 14, 'skype', '', 'ФЦсафа', 1, 1439641299),
(12, 14, 'skype', '', 'dfhdfh', 1, 1439641296),
(13, 38, 'mob_tel', '+7-555-5555555', '+7-555-5555559', 1, 1440014965),
(14, 32, 'language', '6,7', '7,8,9,10,11,12', 0, 1440071795),
(15, 32, 'language', '6,7', '8,9,10,11,12,13', 0, 1440071795),
(16, 32, 'language', '6,7', '6,7,8,9,10,11', 1, 1440071793),
(17, 32, 'specials', '', '8,9,14', 1, 1440167166),
(18, 32, 'specials', '', '7', 0, 1440167167),
(19, 32, 'specials', '', '8', 0, 1440167168),
(20, 32, 'specials', '', '8', 0, 1440167169),
(21, 42, 'specials', '7,8,9,10,13,16,17', '7,8,9,10,12,13,16,17', 1, 1440196914),
(22, 42, 'specials', '7,8,9,10,13,16,17', '7,8,9,10,12,13,16,17', 1, 1440196917),
(23, 42, 'specials', '7,8,9,10,13,16,17', '7,8,9,10,12,13,16,17', 1, 1440196918),
(24, 42, 'specials', '7,8,9,10,13,16,17', '7,8,9,10,12,13,16,17', 1, 1440196918),
(25, 42, 'specials', '7,8,9,10,13,16,17', '7,8,9,10,12,13,16,17', 1, 1440196919),
(26, 14, 'mob_tel', '+7-000-0000000', '+7-978-0116403', 1, 1440201922),
(27, 14, 'skype', 'ФЦсафа', 'coolfire126', 1, 1440201927),
(28, 14, 'city', 'Москва', 'Керчь', 1, 1440201928),
(29, 14, 'wmr', 'wmr_test_avto', '111111111', 1, 1440201929),
(30, 14, 'specials', '', '12', 1, 1440201930),
(31, 31, 'lastname', '', 'Кочанов', 1, 1440267883),
(32, 31, 'firstname', '', 'Артём', 1, 1440267885),
(33, 31, 'mob_tel', '+7-000-0000000', '+7-903-7874655', 1, 1440267887),
(34, 31, 'skype', '', 'akoch-ov', 1, 1440267889),
(35, 31, 'city', 'msc', 'Москва', 1, 1440267891),
(36, 31, 'work_experience', '', '15 лет', 1, 1440267895),
(37, 31, 'how_hear', 'opaopa', 'от Алана', 1, 1440267896),
(38, 31, 'specials', '', '12', 1, 1440267897),
(39, 31, 'specials', '12', '7,12', 1, 1440268773),
(40, 47, 'specials', '10', '17', 1, 1440281808),
(41, 23, 'lastname', 'Николаев', 'Николаев1', 0, 1440338967);

-- --------------------------------------------------------

--
-- Структура таблицы `1_ZakazPartsFiles`
--

CREATE TABLE IF NOT EXISTS `1_ZakazPartsFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `orig_name` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=58 ;

--
-- Дамп данных таблицы `1_ZakazPartsFiles`
--

INSERT INTO `1_ZakazPartsFiles` (`id`, `part_id`, `orig_name`, `file_name`, `comment`) VALUES
(40, 6, '1 Глава 65.doc', '87BA2EBB-31F8-682B-0E9F-70113BB0406C.doc', ''),
(37, 2, '1eb57d1251b67216ddb1784367303bec.jpg', '1B822177-2754-31E7-B3A1-2599CFEFEBB1.jpg', ''),
(39, 5, '1eb57d1251b67216ddb1784367303bec.jpg', '110984D6-F809-0904-B80A-D86E13DECB67.jpg', ''),
(43, 9, 'DSC_0001[1].JPG', 'A18C1F3D-1E4F-CDBE-5D54-2E264755075A.JPG', ''),
(44, 12, ' (2).JPG', '84E2F1C3-8E62-A875-1D35-860BFC65C4C7.JPG', ''),
(46, 27, '1 Глава 65.doc', 'A3239104-DD37-AB70-FE36-A085FFA0D5D7.doc', ''),
(57, 70, ' Microsoft Office Word (2).docx', '3FB91750-78CB-9FC7-57D2-32484C711A69.docx', ''),
(48, 34, '1 Глава 65.doc', '9E8C13C8-1EAC-5391-C78C-7731EF1D8C5C.doc', ''),
(51, 48, '1 Глава 65.doc', '94AB6ED8-8A6D-C7DA-DB88-63DEEAC6B230.doc', ''),
(52, 54, ' менеджеров.docx', 'BDA341E2-52BC-1D6A-90DB-3B949ECF354E.docx', ''),
(53, 55, ' исполнители.docx', '4616F259-0EDC-B014-F9A6-6BF644792DDB.docx', '');

-- --------------------------------------------------------

--
-- Структура таблицы `1_Сatalog`
--

CREATE TABLE IF NOT EXISTS `1_Сatalog` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `field_varname` varchar(50) NOT NULL,
  `cat_name` varchar(255) NOT NULL COMMENT 'Наименование категории',
  `parent_id` int(6) NOT NULL DEFAULT '0' COMMENT 'Номер родителькой категории',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица ктегорий проекта, имеет древовидную структуру' AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `1_Сatalog`
--

INSERT INTO `1_Сatalog` (`id`, `field_varname`, `cat_name`, `parent_id`) VALUES
(5, 'specials', 'Все', 0),
(6, 'specials', 'Дизайн сайта ', 5),
(7, 'specials', 'Верстка сайта ', 5),
(8, 'specials', 'Копирайтинг', 5),
(9, 'specials', 'Рерайтинг', 5),
(10, 'specials', 'Оптимизация (СЕО)', 5),
(11, 'specials', 'Видео', 5),
(12, 'specials', 'Программирование', 5),
(13, 'specials', 'Постинг', 5),
(14, 'specials', 'Презентации', 5),
(15, 'specials', 'Диктор', 5),
(16, 'specials', 'Перевод с Рус на Eng', 5),
(17, 'specials', 'Другое', 5),
(18, 'specials', 'Бизнес под ключ', 5),
(19, 'specials', 'Проект под ключ', 5),
(20, 'specials', 'Сайт под ключ', 5),
(21, 'specials', 'Лендинг под ключ', 5),
(22, 'specials', 'Админтрикс специалист', 5),
(23, 'specials', 'Тестирование', 5),
(25, 'specials', 'Admintrix', 0),
(26, 'specials', 'Тестирование Admintrix', 5),
(27, 'specials', 'Admintrix back end', 25);

-- --------------------------------------------------------

--
-- Структура таблицы `2_Moderate`
--

CREATE TABLE IF NOT EXISTS `2_Moderate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL COMMENT 'имя класса модерируемой модели',
  `id_record` int(11) NOT NULL COMMENT 'ид записи в таблице',
  `attribute` varchar(255) NOT NULL COMMENT 'имя атррибута',
  `old_value` text COMMENT 'Старое значение',
  `new_value` text COMMENT 'Новое значение',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `2_Moderate`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_Payment`
--

CREATE TABLE IF NOT EXISTS `2_Payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `summ` float(10,2) DEFAULT NULL,
  `details_ya` varchar(255) DEFAULT NULL,
  `details_wm` varchar(255) DEFAULT NULL,
  `details_bank` text,
  `payment_type` tinyint(1) DEFAULT NULL,
  `approve` tinyint(1) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_Payment`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_PaymentImage`
--

CREATE TABLE IF NOT EXISTS `2_PaymentImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_PaymentImage`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_Profiles`
--

CREATE TABLE IF NOT EXISTS `2_Profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `rating` int(3) DEFAULT NULL,
  `firstname` varchar(50) NOT NULL DEFAULT '',
  `lastname` varchar(50) NOT NULL DEFAULT '',
  `country` varchar(30) NOT NULL DEFAULT '',
  `Cellphone` varchar(25) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_Profiles`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ProfilesFields`
--

CREATE TABLE IF NOT EXISTS `2_ProfilesFields` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `varname` varchar(50) NOT NULL COMMENT 'Variable',
  `title` varchar(255) NOT NULL COMMENT 'Title',
  `field_type` varchar(50) NOT NULL COMMENT 'Field type',
  `field_size` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Field size',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Min. field size',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT 'Required',
  `match` varchar(255) NOT NULL DEFAULT '' COMMENT 'Reg. expression',
  `range` varchar(255) NOT NULL DEFAULT '' COMMENT 'Range',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Error message',
  `other_validator` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Other validation',
  `default` varchar(255) NOT NULL DEFAULT '' COMMENT 'Default value',
  `widget` varchar(255) NOT NULL DEFAULT '' COMMENT 'Widget',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Widget parameters',
  `position` int(3) NOT NULL DEFAULT '0' COMMENT 'Positon',
  `visible` int(1) NOT NULL DEFAULT '0' COMMENT 'Visible',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table for user profiles' AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `2_ProfilesFields`
--

INSERT INTO `2_ProfilesFields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'firstname', 'First Name', 'VARCHAR', '50', '2', 0, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'lastname', 'Last Name', 'VARCHAR', '50', '2', 0, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 2, 3),
(3, 'country', 'Country', 'VARCHAR', '30', '2', 0, '', '', 'Incorrect Country (length between 2 and 30 characters).', '', '', '', '', 3, 3),
(4, 'Cellphone', 'Cell phone', 'VARCHAR', '25', '3', 1, '', '', 'Incorrect Cell phone (length between 3 and 25 characters).', '', '', '', '', 4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectChanges`
--

CREATE TABLE IF NOT EXISTS `2_ProjectChanges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file` varchar(350) DEFAULT NULL,
  `comment` varchar(450) NOT NULL DEFAULT '',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  `date_moderate` timestamp NULL DEFAULT NULL,
  `moderate` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ProjectChanges`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectFields`
--

CREATE TABLE IF NOT EXISTS `2_ProjectFields` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `varname` varchar(50) NOT NULL COMMENT 'Variable',
  `title` varchar(255) NOT NULL COMMENT 'Title',
  `field_type` varchar(50) NOT NULL COMMENT 'Field type',
  `field_size` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Field size',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT 'Required',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Error message',
  `default` varchar(255) NOT NULL DEFAULT '' COMMENT 'Default value',
  `position` int(3) NOT NULL DEFAULT '0' COMMENT 'Position',
  `visible` int(1) NOT NULL DEFAULT '0' COMMENT 'Visible',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Table for user profile fields' AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `2_ProjectFields`
--

INSERT INTO `2_ProjectFields` (`id`, `varname`, `title`, `field_type`, `field_size`, `required`, `error_message`, `default`, `position`, `visible`) VALUES
(1, 'Typeofpaper', 'Type of paper', 'LIST', '0', 1, 'Incorrect Type of paper', '', 1, 1),
(2, 'Subject', 'Subject', 'LIST', '0', 1, 'Incorrect Subject', '', 2, 1),
(3, 'Paperformat', 'Paper format', 'LIST', '0', 2, 'Incorrect Paper format', '', 3, 1),
(4, 'abstractpage', 'Add an Abstract page to my paper', 'BOOL', '0', 2, '', '0', 4, 1),
(5, 'Sources', 'Sources', 'INTEGER', '10', 2, '', '0', 5, 1),
(6, 'Topic', 'Topic', 'VARCHAR', '255', 1, '', '', 6, 1),
(7, 'Paperdetails', 'Paper details', 'TEXT', '0', 2, '', '', 7, 1),
(8, 'Additionalmaterials', 'Additional Materials', 'LIST', '0', 2, 'Additional Materials', '', 8, 1),
(9, 'Typeofservice', 'Type of service', 'LIST', '0', 2, 'Type of service', '', 9, 1),
(10, 'AcademicLevel', 'Academic Level', 'LIST', '0', 2, 'Academic Level', '', 10, 1),
(11, 'VIPcustomer', 'I want to order VIP customer service', 'BOOL', '0', 2, 'I want to order VIP customer service', '0', 11, 1),
(12, 'Numberofpages', 'Number of pages', 'INTEGER', '10', 1, 'Number of pages', '0', 12, 1),
(13, 'Numberofslides', 'Number of slides', 'INTEGER', '10', 2, 'Number of slides', '0', 13, 1),
(14, 'FirstDraftDeadline', 'First Draft Deadline', 'LIST', '0', 1, 'First Draft Deadline', '', 14, 1),
(15, 'Preferredwriter', 'Preferred writer', 'LIST', '0', 2, 'Preferred writer', '', 15, 1),
(16, 'Preferredpaymentsystem', 'Preferred payment system', 'LIST', '0', 1, 'Preferred payment system', '', 16, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectMessages`
--

CREATE TABLE IF NOT EXISTS `2_ProjectMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `moderated` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ProjectMessages`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectPayments`
--

CREATE TABLE IF NOT EXISTS `2_ProjectPayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `project_price` float(10,2) DEFAULT NULL,
  `work_price` float(10,2) DEFAULT NULL,
  `received` float(10,2) DEFAULT NULL,
  `approved_in` float(10,2) DEFAULT NULL,
  `approved_out` float(10,2) DEFAULT NULL,
  `to_receive` float(10,2) DEFAULT NULL,
  `to_pay` float(10,2) DEFAULT NULL,
  `payed` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ProjectPayments`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_Projects`
--

CREATE TABLE IF NOT EXISTS `2_Projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `add_demands` text,
  `status` tinyint(4) DEFAULT '0',
  `executor` int(10) unsigned DEFAULT '0',
  `notes` text NOT NULL,
  `date` timestamp NULL DEFAULT NULL,
  `max_exec_date` timestamp NULL DEFAULT NULL,
  `manager_informed` timestamp NULL DEFAULT NULL,
  `author_informed` timestamp NULL DEFAULT NULL,
  `author_notes` text,
  `old_status` tinyint(4) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  `Typeofpaper` text NOT NULL,
  `Subject` text NOT NULL,
  `Paperformat` text NOT NULL,
  `abstractpage` tinyint(1) NOT NULL DEFAULT '0',
  `Sources` int(10) NOT NULL DEFAULT '0',
  `Topic` varchar(255) NOT NULL DEFAULT '',
  `Paperdetails` text NOT NULL,
  `Additionalmaterials` text NOT NULL,
  `Typeofservice` text NOT NULL,
  `AcademicLevel` text NOT NULL,
  `VIPcustomer` tinyint(1) NOT NULL DEFAULT '0',
  `Numberofpages` int(10) NOT NULL DEFAULT '0',
  `Numberofslides` int(10) NOT NULL DEFAULT '0',
  `FirstDraftDeadline` text NOT NULL,
  `Preferredwriter` text NOT NULL,
  `Preferredpaymentsystem` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_Projects`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectsEvents`
--

CREATE TABLE IF NOT EXISTS `2_ProjectsEvents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `description` text,
  `timestamp` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ProjectsEvents`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ProjectsParts`
--

CREATE TABLE IF NOT EXISTS `2_ProjectsParts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `proj_id` int(11) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `show` tinyint(1) DEFAULT '0',
  `author_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ProjectsParts`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_Templates`
--

CREATE TABLE IF NOT EXISTS `2_Templates` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `type_id` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_Templates`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_UpdateProfile`
--

CREATE TABLE IF NOT EXISTS `2_UpdateProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `attribute` varchar(255) NOT NULL,
  `from_data` text,
  `to_data` text,
  `status` tinyint(1) DEFAULT NULL,
  `date_update` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_UpdateProfile`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_ZakazPartsFiles`
--

CREATE TABLE IF NOT EXISTS `2_ZakazPartsFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `orig_name` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Дамп данных таблицы `2_ZakazPartsFiles`
--


-- --------------------------------------------------------

--
-- Структура таблицы `2_Сatalog`
--

CREATE TABLE IF NOT EXISTS `2_Сatalog` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `field_varname` varchar(50) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `parent_id` int(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `2_Сatalog`
--

INSERT INTO `2_Сatalog` (`id`, `field_varname`, `cat_name`, `parent_id`) VALUES
(1, 'Typeofpaper', 'Essays', 0),
(2, 'Typeofpaper', 'Essay ', 1),
(3, 'Typeofpaper', 'Presentation ', 1),
(4, 'Typeofpaper', 'Report ', 1),
(5, 'Typeofpaper', 'Research paper', 1),
(6, 'Typeofpaper', 'Term paper', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `AuthAssignment`
--

CREATE TABLE IF NOT EXISTS `AuthAssignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AuthAssignment`
--

INSERT INTO `AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('Admin', '1', NULL, 'N;'),
('Admin', '49', NULL, 'N;'),
('Author', '103', NULL, NULL),
('Author', '104', NULL, NULL),
('Author', '106', NULL, NULL),
('Author', '110', NULL, NULL),
('Author', '111', NULL, NULL),
('Author', '115', NULL, NULL),
('Author', '117', NULL, NULL),
('Author', '118', NULL, NULL),
('Author', '122', NULL, NULL),
('Author', '14', NULL, NULL),
('Author', '15', NULL, NULL),
('Author', '16', NULL, NULL),
('Author', '24', NULL, NULL),
('Author', '25', NULL, NULL),
('Author', '29', NULL, NULL),
('Author', '30', NULL, NULL),
('Author', '31', NULL, NULL),
('Author', '32', NULL, NULL),
('Author', '35', NULL, NULL),
('Author', '36', NULL, NULL),
('Author', '39', NULL, NULL),
('Author', '4', NULL, NULL),
('Author', '40', NULL, NULL),
('Author', '41', NULL, NULL),
('Author', '42', NULL, NULL),
('Author', '47', NULL, NULL),
('Author', '50', NULL, NULL),
('Author', '51', NULL, NULL),
('Author', '52', NULL, NULL),
('Author', '53', NULL, NULL),
('Author', '55', NULL, NULL),
('Author', '56', NULL, NULL),
('Author', '59', NULL, NULL),
('Author', '60', NULL, NULL),
('Author', '61', NULL, NULL),
('Author', '62', NULL, NULL),
('Author', '63', NULL, NULL),
('Author', '64', NULL, NULL),
('Author', '65', NULL, NULL),
('Author', '66', NULL, NULL),
('Author', '67', NULL, NULL),
('Author', '68', NULL, NULL),
('Author', '69', NULL, NULL),
('Author', '71', NULL, NULL),
('Author', '72', NULL, NULL),
('Author', '73', NULL, NULL),
('Author', '74', NULL, NULL),
('Author', '75', NULL, NULL),
('Author', '77', NULL, NULL),
('Author', '79', NULL, NULL),
('Author', '80', NULL, NULL),
('Author', '81', NULL, NULL),
('Author', '83', NULL, NULL),
('Author', '84', NULL, NULL),
('Author', '86', NULL, NULL),
('Author', '88', NULL, NULL),
('Author', '90', NULL, NULL),
('Author', '91', NULL, NULL),
('Author', '92', NULL, NULL),
('Author', '94', NULL, NULL),
('Author', '96', NULL, NULL),
('Author', '98', NULL, NULL),
('Customer', '102', NULL, NULL),
('Customer', '109', NULL, NULL),
('Customer', '11', NULL, NULL),
('Customer', '112', NULL, NULL),
('Customer', '113', NULL, NULL),
('Customer', '114', NULL, NULL),
('Customer', '116', NULL, NULL),
('Customer', '119', NULL, NULL),
('Customer', '12', NULL, NULL),
('Customer', '120', NULL, NULL),
('Customer', '121', NULL, NULL),
('Customer', '123', NULL, NULL),
('Customer', '17', NULL, NULL),
('Customer', '19', NULL, NULL),
('Customer', '21', NULL, NULL),
('Customer', '22', NULL, NULL),
('Customer', '23', NULL, NULL),
('Customer', '3', NULL, 'N;'),
('Customer', '31', NULL, NULL),
('Customer', '37', NULL, NULL),
('Customer', '38', NULL, NULL),
('Customer', '43', NULL, NULL),
('Customer', '44', NULL, NULL),
('Customer', '45', NULL, NULL),
('Customer', '48', NULL, NULL),
('Customer', '54', NULL, NULL),
('Customer', '57', NULL, NULL),
('Customer', '58', NULL, NULL),
('Customer', '70', NULL, NULL),
('Customer', '76', NULL, NULL),
('Customer', '78', NULL, NULL),
('Customer', '81', NULL, NULL),
('Customer', '82', NULL, NULL),
('Customer', '85', NULL, NULL),
('Customer', '87', NULL, NULL),
('Customer', '89', NULL, NULL),
('Customer', '93', NULL, NULL),
('Customer', '95', NULL, NULL),
('Customer', '97', NULL, NULL),
('Manager', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItem`
--

CREATE TABLE IF NOT EXISTS `AuthItem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AuthItem`
--

INSERT INTO `AuthItem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('account', 0, 'account', NULL, 'N;'),
('activation', 0, 'activation', NULL, 'N;'),
('Admin', 2, 'Администратор', NULL, 'N;'),
('apiFindAuthor', 0, 'ManagerChat apiFindAuthor', NULL, 'N;'),
('Author', 2, 'Автор', NULL, 'N;'),
('captcha', 0, 'captcha', NULL, 'N;'),
('chat', 0, 'Customer and Author project form', NULL, 'N;'),
('create', 0, 'Добавление', NULL, 'N;'),
('Customer', 2, 'Заказчик', NULL, 'N;'),
('customerOrderList', 0, 'customerOrderList', NULL, 'N;'),
('delete', 0, 'Удаление', NULL, 'N;'),
('edit', 0, 'Редактирование', NULL, 'N;'),
('error', 0, 'error', NULL, 'N;'),
('Guest', 2, 'Гость', NULL, 'N;'),
('index', 0, 'index', NULL, 'N;'),
('list', 0, 'list', NULL, 'N;'),
('login', 0, 'login', NULL, 'N;'),
('logout', 0, 'logout', NULL, 'N;'),
('Manager', 2, 'Менеджер', NULL, 'N;'),
('message', 0, 'message', NULL, 'N;'),
('ownList', 0, 'ownList', NULL, 'N;'),
('page', 0, 'page', NULL, 'N;'),
('profile', 0, 'profile', NULL, 'N;'),
('rating', 0, 'ManagerChat rating', NULL, 'N;'),
('recovery', 0, 'recovery', NULL, 'N;'),
('registration', 0, 'registration', NULL, 'N;'),
('update', 0, 'Zakaz update', NULL, 'N;'),
('uploadPayment', 0, 'uploadPayment', NULL, 'N;'),
('view', 0, 'Просмотр', NULL, 'N;'),
('yiichat', 0, 'ManagerChat yiichat', NULL, 'N;'),
('zakaz', 0, 'zakaz', NULL, 'N;');

-- --------------------------------------------------------

--
-- Структура таблицы `AuthItemChild`
--

CREATE TABLE IF NOT EXISTS `AuthItemChild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AuthItemChild`
--

INSERT INTO `AuthItemChild` (`parent`, `child`) VALUES
('Author', 'account'),
('Customer', 'account'),
('Guest', 'activation'),
('Manager', 'apiFindAuthor'),
('Author', 'captcha'),
('Customer', 'captcha'),
('Guest', 'captcha'),
('Manager', 'captcha'),
('Author', 'chat'),
('Customer', 'chat'),
('Author', 'create'),
('Customer', 'create'),
('Manager', 'create'),
('Customer', 'customerOrderList'),
('Author', 'delete'),
('Customer', 'delete'),
('Author', 'edit'),
('Customer', 'edit'),
('Author', 'error'),
('Customer', 'error'),
('Manager', 'error'),
('Author', 'index'),
('Customer', 'index'),
('Guest', 'index'),
('Manager', 'index'),
('Author', 'list'),
('Author', 'login'),
('Customer', 'login'),
('Guest', 'login'),
('Author', 'logout'),
('Customer', 'logout'),
('Guest', 'logout'),
('Manager', 'logout'),
('Author', 'message'),
('Customer', 'message'),
('Guest', 'message'),
('Author', 'ownList'),
('Author', 'page'),
('Customer', 'page'),
('Guest', 'page'),
('Manager', 'page'),
('Author', 'profile'),
('Customer', 'profile'),
('Manager', 'rating'),
('Author', 'recovery'),
('Customer', 'recovery'),
('Guest', 'recovery'),
('Manager', 'recovery'),
('Guest', 'registration'),
('Manager', 'update'),
('Customer', 'uploadPayment'),
('Author', 'view'),
('Customer', 'view'),
('Manager', 'view'),
('Manager', 'yiichat');

-- --------------------------------------------------------

--
-- Структура таблицы `campaign`
--

CREATE TABLE IF NOT EXISTS `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` int(11) NOT NULL COMMENT 'Принадлежность к организации',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL COMMENT 'Название кампании',
  `domains` varchar(255) CHARACTER SET utf8 NOT NULL,
  `language` varchar(2) CHARACTER SET utf8 NOT NULL DEFAULT 'en',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `campaign`
--

INSERT INTO `campaign` (`id`, `organization`, `name`, `domains`, `language`) VALUES
(1, 1, 'Первая тестовая компания', 'adco.obshya.com,www.adco.obshya.com, coolfire.su', 'ru'),
(2, 1, 'Perfect paper', 'perfect-paper.obshya.com', 'en');

-- --------------------------------------------------------

--
-- Структура таблицы `Categories`
--

CREATE TABLE IF NOT EXISTS `Categories` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `cat_name` varchar(255) NOT NULL COMMENT 'Наименование категории',
  `parent_id` int(6) NOT NULL DEFAULT '0' COMMENT 'Номер родителькой категории',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица ктегорий проекта, имеет древовидную структуру' AUTO_INCREMENT=192 ;

--
-- Дамп данных таблицы `Categories`
--

INSERT INTO `Categories` (`id`, `cat_name`, `parent_id`) VALUES
(4, 'Экономические дисциплины', 0),
(26, 'АХД, экпред, финансы', 4),
(27, 'Банковское дело', 4),
(28, 'Бизнес-план', 4),
(29, 'Бухучет, управленч.учет', 4),
(30, 'Госслужба', 4),
(31, 'Делопроизводство', 4),
(32, 'Дистанционное образование', 4),
(33, 'Инвестиции', 4),
(34, 'Инновационный менеджмент', 4),
(35, 'История экономики, эк-ских учений', 4),
(36, 'Качество, упр-е качеством', 4),
(37, 'Коммерческое дело, торговля', 4),
(38, 'Логистика', 4),
(39, 'Макроэкономика', 4),
(40, 'Маркетинг', 4),
(41, 'Матметоды в эк-ке', 4),
(42, 'Менеджмент', 4),
(43, 'Микроэкономика', 4),
(44, 'Мировая экономика, МЭО', 4),
(45, 'Налоги', 4),
(46, 'Недвижимость, оценка', 4),
(47, 'Планирование, прогнозирование', 4),
(48, 'Потребкооперация', 4),
(49, 'Предпринимательство', 4),
(50, 'Региональная экономика', 4),
(51, 'Реклама и PR', 4),
(52, 'РЦБ, ценные бумаги', 4),
(53, 'Сельское хозяйство', 4),
(54, 'Статистика', 4),
(55, 'Стратегический менеджмент', 4),
(56, 'Страхование', 4),
(57, 'Строительство', 4),
(58, 'Туризм', 4),
(59, 'Управление персоналом', 4),
(60, 'Финансы, деньги, кредит', 4),
(61, 'Ценообразование', 4),
(62, 'Эконометрика', 4),
(63, 'Экономика отраслей', 4),
(64, 'Эктеория', 4),
(65, 'Финансовый менеджмент, финансовая математика', 4),
(66, 'Товароведение', 4),
(67, 'Ресторанно-гостиничный бизнес, бытовое обслуживан.', 4),
(68, 'Теория организации', 4),
(69, 'Внешнеэкономическая деятельность', 4),
(70, 'Управление проектами', 4),
(71, 'Гуманитарные', 0),
(73, 'Английский', 71),
(74, 'Немецкий', 71),
(75, 'Французский', 71),
(76, 'История', 71),
(77, 'Культурология', 71),
(78, 'Литература', 71),
(79, 'Педагогика', 71),
(80, 'Политология', 71),
(81, 'Психология', 71),
(82, 'Социология', 71),
(83, 'Философия', 71),
(84, 'Этика, эстетика', 71),
(85, 'Журналистика', 71),
(86, 'Русский язык культура речи', 71),
(87, 'Лингвистика', 71),
(88, 'Филология', 71),
(89, 'Юридические', 0),
(90, 'Административное право', 89),
(91, 'Арбитражный процесс', 89),
(92, 'Гражданский процесс', 89),
(93, 'Гражданское право', 89),
(94, 'Земельное право', 89),
(95, 'ИГП', 89),
(96, 'Конституционное право', 89),
(97, 'Криминалистика', 89),
(98, 'Логика', 89),
(99, 'Международное право', 89),
(100, 'Муниципальное право', 89),
(101, 'Основы права', 89),
(102, 'Правоохранительные органы', 89),
(103, 'Римское право', 89),
(104, 'Семейное право', 89),
(105, 'Соцобеспечение', 89),
(106, 'Страховое право', 89),
(107, 'Судебная медицина', 89),
(108, 'Судебная психиатрия', 89),
(109, 'Судебная статистика', 89),
(110, 'Таможенное право', 89),
(111, 'ТГП', 89),
(112, 'Трудовое право', 89),
(113, 'Уголовное право', 89),
(114, 'Уголовный процесс', 89),
(115, 'УИП', 89),
(116, 'Экологическое право', 89),
(117, 'Юрид.психология', 89),
(118, 'Криминология', 89),
(119, 'Акционерное право', 89),
(120, 'Жилищное право', 89),
(121, 'Налоговое право', 89),
(122, 'Финансовое право', 89),
(123, 'Cудебная бухгалтерия', 89),
(124, 'Естественно-научные', 0),
(125, 'Биология', 124),
(126, 'География, экономическая география', 124),
(127, 'КСЕ', 124),
(128, 'Математика', 124),
(129, 'Медицина, физкультура, здравоохранение', 124),
(130, 'Физика', 124),
(131, 'Химия', 124),
(132, 'Экология', 124),
(133, 'Другое', 124),
(134, 'Теория вероятностей', 124),
(135, 'Технические', 0),
(136, 'Авиация и космонавтика', 135),
(137, 'Автомобильное хозяйство', 135),
(138, 'Автотранспорт', 135),
(139, 'Архитектура', 135),
(140, 'Безопасность жизнедеятельности', 135),
(141, 'Вентиляция и отопление', 135),
(142, 'Водоснабжение и водоотведение', 135),
(143, 'Военная кафедра', 135),
(144, 'Геодезия', 135),
(145, 'Геология', 135),
(146, 'Гидравлика', 135),
(147, 'Детали машин', 135),
(148, 'Инженерная графика', 135),
(149, 'Информатика, ВТ, телекоммуникации', 135),
(150, 'Информационная безопасность', 135),
(151, 'Информационное обеспечение, программирование', 135),
(152, 'Информационные технологии', 135),
(153, 'История техники', 135),
(154, 'Материаловедение', 135),
(155, 'Метрология', 135),
(156, 'Радиоэлектроника', 135),
(157, 'Режущий инструмент', 135),
(158, 'САПР', 135),
(159, 'Сопромат', 135),
(160, 'Станки', 135),
(161, 'Схемотехника', 135),
(162, 'ТАУ', 135),
(163, 'Теоретическая механика', 135),
(164, 'Теория резания', 135),
(165, 'Теплотехника', 135),
(166, 'Технология машиностроения', 135),
(167, 'ТММ', 135),
(168, 'ТОЭ', 135),
(169, 'Транспорт, грузоперевозки', 135),
(170, 'Чертежи', 135),
(171, 'Электротехника', 135),
(189, 'Аудит', 4),
(190, 'Антикризисный менеджмент', 4),
(191, '222', 71);

-- --------------------------------------------------------

--
-- Структура таблицы `Jobs`
--

CREATE TABLE IF NOT EXISTS `Jobs` (
  `id` int(6) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `job_name` varchar(255) NOT NULL COMMENT 'Наименование вида работ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица видов работ, привязана к категориям' AUTO_INCREMENT=21 ;

--
-- Дамп данных таблицы `Jobs`
--

INSERT INTO `Jobs` (`id`, `job_name`) VALUES
(1, 'Дизайн'),
(2, 'Верстка'),
(3, 'Копирайтинг'),
(4, 'СЕО'),
(5, 'Видео'),
(6, 'Программирование'),
(7, 'Презентации'),
(8, 'Постинг'),
(9, 'Маркетинг'),
(10, 'Эссе'),
(11, 'Защитная речь'),
(12, 'Кандидатская диссертация'),
(13, 'Тесты'),
(14, 'Задачи'),
(15, 'Диплом технический'),
(16, 'Диплом'),
(17, 'Магистерская диссертация'),
(18, 'Докторская диссертация'),
(19, 'Аудит'),
(20, 'Антикризисный менеджмент');

-- --------------------------------------------------------

--
-- Структура таблицы `Moderate`
--

CREATE TABLE IF NOT EXISTS `Moderate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `class_name` varchar(100) NOT NULL COMMENT 'имя класса модерируемой модели',
  `id_record` int(11) NOT NULL COMMENT 'ид записи в таблице',
  `attribute` varchar(255) NOT NULL COMMENT 'имя атррибута',
  `old_value` text COMMENT 'Старое значение',
  `new_value` text COMMENT 'Новое значение',
  `date_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Дамп данных таблицы `Moderate`
--


-- --------------------------------------------------------

--
-- Структура таблицы `Payment`
--

CREATE TABLE IF NOT EXISTS `Payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `receive_date` date DEFAULT NULL,
  `pay_date` date DEFAULT NULL,
  `theme` varchar(255) DEFAULT NULL,
  `manager` varchar(100) DEFAULT NULL,
  `user` varchar(100) DEFAULT NULL,
  `summ` float(10,2) DEFAULT NULL,
  `details_ya` varchar(255) DEFAULT NULL,
  `details_wm` varchar(255) DEFAULT NULL,
  `details_bank` text,
  `payment_type` tinyint(1) DEFAULT NULL,
  `approve` tinyint(1) DEFAULT NULL,
  `method` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=319 ;

--
-- Дамп данных таблицы `Payment`
--

INSERT INTO `Payment` (`id`, `order_id`, `receive_date`, `pay_date`, `theme`, `manager`, `user`, `summ`, `details_ya`, `details_wm`, `details_bank`, `payment_type`, `approve`, `method`) VALUES
(1, 1, '0000-00-00', '2015-08-20', NULL, 'webmaster@example.com', 'customer@dipstart.ru', 145.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(2, 1, '0000-00-00', '2015-01-03', NULL, 'webmaster@example.com', 'author@dipstart.ru', 1000.00, '12341234', '43214312', '2343123', 1, 1, 'Ya.money'),
(3, 1, '2014-12-25', '2015-01-16', 'Тестовый', 'webmaster@example.com', 'customer@dipstart.ru', 395.00, '12341234', '43214123', '5457568', 1, 1, 'Ya.money'),
(4, 1, '2014-12-25', '2015-08-20', 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 780.00, '12341234', '4324532', '3456345634', 1, 1, 'Cash'),
(5, 1, '2014-12-25', NULL, 'Тестовый', 'webmaster@example.com', 'customer@dipstart.ru', 243.00, '12341234', '43214312', '3412234123', 1, 0, NULL),
(6, 1, '2014-12-25', '2015-01-03', 'Тестовый', 'webmaster@example.com', 'customer@dipstart.ru', 500.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(7, 1, '2014-12-29', '2015-01-03', 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 2000.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(8, 1, '2014-12-29', '2015-01-02', 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 500.00, NULL, NULL, NULL, 1, 1, NULL),
(9, 1, '2014-12-29', '2015-01-03', 'Тестовый', 'webmaster@example.com', 'customer@dipstart.ru', 200.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(10, 1, '2014-12-29', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 123.00, NULL, NULL, NULL, 1, 0, NULL),
(11, 1, '2014-12-29', '2015-01-02', 'Тестовый', 'demo@example.com', 'customer@dipstart.ru', 415654.00, NULL, NULL, NULL, 1, 1, NULL),
(12, 1, '2014-12-29', '2015-01-03', 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 2300.00, '234235', '234234', '12342', 1, 1, 'WebMoney'),
(13, 1, '2014-12-29', NULL, 'Тестовый', 'webmaster@example.com', 'customer@dipstart.ru', 500000.00, NULL, NULL, NULL, 1, 0, NULL),
(14, 1, '2014-12-29', '2015-01-03', 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 5000.00, NULL, NULL, NULL, 1, 1, NULL),
(22, 1, '2015-01-10', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(23, 1, '2015-01-10', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(27, 3, '2015-01-27', NULL, 'Рефер', 'webmaster@example.com', 'dipstartru@mail.ru', 1250.00, NULL, NULL, NULL, 0, 0, NULL),
(67, 5, '2015-02-09', NULL, 'Исторические факторы, как цель исследования. ', 'webmaster@example.com', NULL, 10.00, NULL, NULL, NULL, 1, 0, NULL),
(79, 3, '2015-02-11', NULL, 'Рефер', 'webmaster@example.com', 'dipstartru@mail.ru', -1250.00, NULL, NULL, NULL, 0, 0, NULL),
(109, 3, '2015-02-11', NULL, 'Рефер', 'webmaster@example.com', 'dipstartru@mail.ru', 7000.00, NULL, NULL, NULL, 0, 0, NULL),
(119, 6, '2015-02-13', NULL, 'Предварительная подготовка к зимней спячке у медведей среднего возраста.', 'webmaster@example.com', 'monty28.ua@mail.ru', 25000.00, NULL, NULL, NULL, 0, 0, NULL),
(123, 5, '2015-02-13', NULL, 'Исторические факторы, как цель исследования. ', 'webmaster@example.com', 'monty28.ua@mail.ru', 500.00, NULL, NULL, NULL, 0, 0, NULL),
(133, 9, '2015-02-20', NULL, 'Home work', 'webmaster@example.com', 'dshelp@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(135, 9, '2015-02-28', '2015-02-28', 'Home work', 'webmaster@example.com', 'twin.ua@mail.ru', 4000.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(318, 84, '2015-08-16', NULL, 'Тестовый Тестовый Тестовый Тестовый Тестовый ', 'webmaster@example.com', 'zak4test560105@mail.ru', 5000.00, NULL, NULL, NULL, 0, 0, NULL),
(139, 10, '2015-03-02', NULL, 'Подсчет средств в банках, посредством их траты.', 'webmaster@example.com', 'dshelp@mail.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(317, 85, '2015-08-13', '2015-08-16', 'Написать тексты для сайта', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(316, 84, '2015-08-08', NULL, 'Тестовый Тестовый Тестовый Тестовый Тестовый ', 'webmaster@example.com', 'zak4test560105@mail.ru', 5000.00, NULL, NULL, NULL, 0, 0, NULL),
(315, 82, '2015-08-05', '2015-08-05', 'Сбор инвестиций на админку', 'webmaster@example.com', 'autobot509.63@gmail.com', 3000.00, '2147483647', '456456456456', '', 1, 1, 'Ya.money'),
(143, 10, '2015-03-02', NULL, 'Подсчет средств в банках, посредством их траты.', 'webmaster@example.com', 'dshelp@mail.ru', -7500.00, NULL, NULL, NULL, 0, 0, NULL),
(314, 82, '2015-08-05', NULL, 'Сбор инвестиций на админку', 'webmaster@example.com', 'zak4test560105@mail.ru', 7498.00, NULL, NULL, NULL, 0, 0, NULL),
(145, 10, '2015-03-02', NULL, 'Подсчет средств в банках, посредством их траты.', 'webmaster@example.com', 'twin.ua@mail.ru', 2000.00, NULL, NULL, NULL, 1, 0, NULL),
(146, 10, '2015-03-02', NULL, 'Подсчет средств в банках, посредством их траты.', 'webmaster@example.com', 'twin.ua@mail.ru', 2000.00, NULL, NULL, NULL, 1, 0, NULL),
(147, 11, '2015-03-06', '2015-03-06', '321', 'webmaster@example.com', NULL, 10.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(148, 7, '2015-03-08', '2015-03-08', 'Обычная простая работа', 'webmaster@example.com', 'coolfire@inbox.ru', 10.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(149, 7, '2015-03-08', '2015-03-08', 'Обычная простая работа', 'webmaster@example.com', 'coolfire@inbox.ru', 10.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(150, 7, '2015-03-08', '2015-03-08', 'Обычная простая работа', 'webmaster@example.com', 'coolfire@inbox.ru', 10.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(151, 2, '2015-03-08', '2015-03-08', 'kj', 'webmaster@example.com', 'author@dipstart.ru', 10.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(313, 82, '2015-08-05', NULL, 'Сбор инвестиций на админку', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(312, 82, '2015-08-05', NULL, 'Сбор инвестиций на админку', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(311, 82, '2015-08-05', NULL, 'Сбор инвестиций на админку', 'webmaster@example.com', 'zak4test560105@mail.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(310, 81, '2015-08-04', NULL, '1234567', 'webmaster@example.com', 'velodov@mail.ru', 1500.00, NULL, NULL, NULL, 0, 0, NULL),
(309, 81, '2015-08-04', NULL, '1234567', 'webmaster@example.com', 'velodov@mail.ru', 1000.00, NULL, NULL, NULL, 0, 0, NULL),
(308, 71, '2015-08-04', NULL, 'Система по сокращению рабоыт менджеров в 5 раз', 'webmaster@example.com', 'zak4test560105@mail.ru', 1000.00, NULL, NULL, NULL, 0, 0, NULL),
(307, 71, '2015-08-04', NULL, 'Система по сокращению рабоыт менджеров в 5 раз', 'webmaster@example.com', 'zak4test560105@mail.ru', 9999.00, NULL, NULL, NULL, 0, 0, NULL),
(306, 71, '2015-08-04', '2015-08-05', 'Система по сокращению рабоыт менджеров в 5 раз', 'webmaster@example.com', 'coolfire@inbox.ru', 555.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 1, 'Ya.money'),
(304, 32, '2015-08-02', NULL, '345345435345', 'webmaster@example.com', 'velodov@mail.ru', 100.00, NULL, NULL, NULL, 0, 0, NULL),
(305, 71, '2015-08-04', NULL, 'Система по сокращению рабоыт менджеров в 5 раз', 'webmaster@example.com', 'zak4test560105@mail.ru', 10001.00, NULL, NULL, NULL, 0, 0, NULL),
(303, 2, '2015-08-02', NULL, 'kj', 'webmaster@example.com', 'webmaster@example.com', 1000.00, NULL, NULL, NULL, 0, 0, NULL),
(167, 10, '2015-03-18', NULL, 'Подсчет средств в банках, посредством их траты.', 'webmaster@example.com', 'dshelp@mail.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(302, 2, '2015-08-02', NULL, 'kj', 'webmaster@example.com', 'author@dipstart.ru', 200.00, '0', '', '', 1, 0, NULL),
(301, 68, '2015-08-02', '2015-08-02', 'Историчские факты экономических исследований', 'webmaster@example.com', 'zak4test560105@mail.ru', 7000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(171, 13, '2015-03-19', NULL, 'Основа тестирования админки.', 'webmaster@example.com', 'dshelp@mail.ru', 15000.00, NULL, NULL, NULL, 0, 0, NULL),
(172, 13, '2015-04-01', NULL, 'Основа тестирования админки.', 'webmaster@example.com', 'twin.ua@mail.ru', 5000.00, NULL, NULL, NULL, 1, 0, NULL),
(300, 67, '2015-08-01', '2015-08-02', 'Налоговые обложения как метод борьбы с коррупцией.', 'webmaster@example.com', 'zak4test560105@mail.ru', 1.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(299, 67, '2015-07-31', '2015-08-03', 'Налоговые обложения как метод борьбы с коррупцией.', 'webmaster@example.com', 'zak4test560105@mail.ru', 25000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(178, 8, '2015-06-09', NULL, 'test', 'webmaster@example.com', 'customer@dipstart.ru', 350345.00, NULL, NULL, NULL, 0, 0, NULL),
(298, 63, '2015-07-29', '2015-08-16', 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 1.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 1, 'WebMoney'),
(297, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 1.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(296, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 4.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(184, 15, '2015-06-10', NULL, 'Решение проблем лингвистических способностей у детей младше 14 лет.', 'webmaster@example.com', 'velodov@mail.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(295, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 1.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(294, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 1.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(293, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 111.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(292, 63, '2015-07-29', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 567.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(190, 16, '2015-06-10', NULL, 'Налоги и их зависимость в странах Евросоюза', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(291, 2, '2015-07-29', NULL, 'kj', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(290, 1, '2015-07-29', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(289, 1, '2015-07-29', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(288, 63, '2015-07-28', NULL, 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 1.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(287, 63, '2015-07-28', NULL, 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 5.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(286, 63, '2015-07-28', NULL, 'Маркетинг в сфере услуг', 'demo@example.com', 'coolfire@inbox.ru', 5.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(285, 63, '2015-07-28', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 50.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(200, 46, '2015-06-17', NULL, 'Налоговый оборот при смене политики в стране ', 'webmaster@example.com', NULL, 5000.00, NULL, NULL, NULL, 1, 0, NULL),
(283, 1, '2015-07-28', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(284, 63, '2015-07-28', NULL, 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 100.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 0, NULL),
(282, 1, '2015-07-28', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(281, 1, '2015-07-28', NULL, 'Тестовый', 'demo@example.com', 'author@dipstart.ru', 1.00, '0', '', '', 1, 0, NULL),
(204, 47, '2015-06-19', NULL, 'Маркетинг и его роль в жизни продавцов консультантов', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(205, 4, '2015-06-21', NULL, '', 'webmaster@example.com', 'customer@dipstart.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(280, 64, '2015-07-27', NULL, 'Тестирование подходит к концу', 'demo@example.com', NULL, 5.00, NULL, NULL, NULL, 1, 0, NULL),
(279, 63, '2015-07-24', '2015-07-24', 'Маркетинг в сфере услуг', 'webmaster@example.com', 'coolfire@inbox.ru', 100.00, '12345', 'wmr_test_avto', 'test_bank_acc', 1, 1, 'Ya.money'),
(278, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(210, 48, '2015-06-22', NULL, 'Логистика в мире', 'webmaster@example.com', 'velodov@mail.ru', 8000.00, NULL, NULL, NULL, 0, 0, NULL),
(277, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 10000.00, NULL, NULL, NULL, 1, 0, NULL),
(276, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 350.00, NULL, NULL, NULL, 1, 0, NULL),
(275, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 350.00, NULL, NULL, NULL, 1, 0, NULL),
(214, 49, '2015-06-22', NULL, 'Диплом по менеджементу', 'webmaster@example.com', 'velodov@mail.ru', 7000.00, NULL, NULL, NULL, 0, 0, NULL),
(274, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 303.00, NULL, NULL, NULL, 1, 0, NULL),
(217, 49, '2015-06-22', NULL, 'Диплом по менеджементу', 'webmaster@example.com', 'velodov@mail.ru', 7000.00, NULL, NULL, NULL, 0, 0, NULL),
(273, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 101.00, NULL, NULL, NULL, 1, 0, NULL),
(219, 49, '2015-06-22', NULL, 'Диплом по менеджементу', 'webmaster@example.com', 'velodov@mail.ru', -14000.00, NULL, NULL, NULL, 0, 0, NULL),
(220, 49, '2015-06-22', NULL, 'Диплом по менеджементу', 'webmaster@example.com', 'coolfire@inbox.ru', 5000.00, NULL, NULL, NULL, 1, 0, NULL),
(221, 16, '2015-06-25', '2015-06-25', 'Налоги и их зависимость в странах Евросоюза', 'webmaster@example.com', 'coolfire@coolfire.pp.ua', 1.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(272, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(223, 46, '2015-06-25', '2015-06-25', 'Налоговый оборот при смене политики в стране ', 'webmaster@example.com', 'velodov@mail.ru', 15000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(271, 66, '2015-07-23', NULL, 'Управление персоналом в условиях конкурентной среды', 'webmaster@example.com', NULL, 50.00, NULL, NULL, NULL, 1, 0, NULL),
(225, 16, '2015-06-25', NULL, 'Налоги и их зависимость в странах Евросоюза', 'webmaster@example.com', 'coolfire@coolfire.pp.ua', 1.00, NULL, NULL, NULL, 0, 0, NULL),
(270, 66, '2015-07-23', NULL, 'Управление персоналом в условиях конкурентной среды', 'webmaster@example.com', NULL, 50.00, NULL, NULL, NULL, 1, 0, NULL),
(269, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(267, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 20.00, NULL, NULL, NULL, 1, 0, NULL),
(268, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 4.00, NULL, NULL, NULL, 1, 0, NULL),
(229, 16, '2015-06-26', NULL, 'Налоги и их зависимость в странах Евросоюза', 'webmaster@example.com', 'coolfire@coolfire.pp.ua', 4.00, NULL, NULL, NULL, 0, 0, NULL),
(266, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 10.00, NULL, NULL, NULL, 1, 0, NULL),
(265, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(264, 66, '2015-07-23', NULL, 'Управление персоналом в условиях конкурентной среды', 'webmaster@example.com', 'zak4test560105@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(263, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(234, 51, '2015-06-26', NULL, 'Станочные установки МЕ-56 ', 'webmaster@example.com', 'velodov@mail.ru', 7000.00, NULL, NULL, NULL, 0, 0, NULL),
(235, 52, '2015-07-01', NULL, 'Налогообложение и степень налогов в зависимости от ситуации', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(236, 53, '2015-07-03', NULL, 'Реклама образовательных учреждений', 'webmaster@example.com', 'velodov@mail.ru', 12500.00, NULL, NULL, NULL, 0, 0, NULL),
(262, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 1.00, NULL, NULL, NULL, 1, 0, NULL),
(238, 54, '2015-07-08', NULL, 'Ритка улитка', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(261, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(260, 1, '2015-07-23', NULL, 'Тестовый', 'webmaster@example.com', 'author@dipstart.ru', 100.00, NULL, NULL, NULL, 1, 0, NULL),
(242, 61, '2015-07-10', NULL, 'Самый дипломный диплом', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 0, NULL),
(259, 65, '2015-07-20', '2015-07-20', 'Коленчатый вал автомобиля Зил130', 'webmaster@example.com', 'autobot509.63@gmail.com', 10000.00, NULL, NULL, NULL, 1, 1, 'Cash'),
(258, 65, '2015-07-20', NULL, 'Коленчатый вал автомобиля Зил130', 'webmaster@example.com', 'zak4test560105@mail.ru', 15000.00, NULL, NULL, NULL, 0, 0, NULL),
(257, 65, '2015-07-20', NULL, 'Коленчатый вал автомобиля Зил130', 'webmaster@example.com', 'zak4test560105@mail.ru', 15000.00, NULL, NULL, NULL, 0, 0, NULL),
(256, 64, '2015-07-18', NULL, 'Тестирование подходит к концу', 'webmaster@example.com', 'velodov@mail.ru', 7500.00, NULL, NULL, NULL, 0, 0, NULL),
(255, 62, '2015-07-15', NULL, 'Аудит инвестиционных процессов', 'webmaster@example.com', 'coolfire@coolfire.pp.ua', 55.00, NULL, NULL, NULL, 0, 0, NULL),
(254, 63, '2015-07-15', '2015-07-15', 'Маркетинг в сфере услуг', 'webmaster@example.com', 'velodov@mail.ru', 10000.00, NULL, NULL, NULL, 0, 1, 'Cash'),
(253, 62, '2015-07-11', NULL, 'Аудит инвестиционных процессов', 'webmaster@example.com', 'coolfire@coolfire.pp.ua', 144.00, NULL, NULL, NULL, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `PaymentImage`
--

CREATE TABLE IF NOT EXISTS `PaymentImage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `PaymentImage`
--

INSERT INTO `PaymentImage` (`id`, `project_id`, `image`, `approved`) VALUES
(1, 85, '97ccd9c00d0445419d94bdd7040d373a.JPG', 0),
(2, 84, '8b5e15d5841a640befa9ed0836aa39c3.JPG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `paypal_setting`
--

CREATE TABLE IF NOT EXISTS `paypal_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_email` varchar(128) DEFAULT NULL,
  `sandbox` enum('0','1') DEFAULT '1',
  `return_url` varchar(256) DEFAULT NULL,
  `cancel_url` varchar(256) DEFAULT NULL,
  `notify_url` varchar(256) DEFAULT NULL,
  `currency` varchar(128) DEFAULT NULL,
  `updated_at` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `paypal_setting`
--

INSERT INTO `paypal_setting` (`id`, `business_email`, `sandbox`, `return_url`, `cancel_url`, `notify_url`, `currency`, `updated_at`) VALUES
(1, NULL, '1', NULL, NULL, NULL, 'USD', '1427449965');

-- --------------------------------------------------------

--
-- Структура таблицы `Profiles`
--

CREATE TABLE IF NOT EXISTS `Profiles` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID пользовтеля',
  `lastname` varchar(50) NOT NULL DEFAULT '' COMMENT 'Фамилия',
  `firstname` varchar(50) NOT NULL DEFAULT '' COMMENT 'Отчество',
  `mob_tel` varchar(15) NOT NULL DEFAULT '+7-000-0000000',
  `icq` varchar(10) NOT NULL DEFAULT '',
  `skype` varchar(50) NOT NULL DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `education` text NOT NULL,
  `work_experience` varchar(20) NOT NULL DEFAULT '',
  `discipline` text NOT NULL,
  `job_type` text NOT NULL,
  `urgent_job` varchar(255) NOT NULL DEFAULT '',
  `mailing_list` int(10) NOT NULL DEFAULT '0',
  `wmr` varchar(13) NOT NULL DEFAULT '',
  `wmz` varchar(13) NOT NULL DEFAULT '',
  `yandex` int(13) NOT NULL DEFAULT '0',
  `how_hear` varchar(255) NOT NULL DEFAULT '',
  `additional` varchar(255) NOT NULL DEFAULT '',
  `rating` int(3) DEFAULT NULL,
  `bank_account` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Профили пользователей' AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `Profiles`
--

INSERT INTO `Profiles` (`user_id`, `lastname`, `firstname`, `mob_tel`, `icq`, `skype`, `city`, `education`, `work_experience`, `discipline`, `job_type`, `urgent_job`, `mailing_list`, `wmr`, `wmz`, `yandex`, `how_hear`, `additional`, `rating`, `bank_account`) VALUES
(1, 'Admin', 'Administrator', '+7-000-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'mk.ru', '', NULL, ''),
(2, 'Manager', 'Manager', '+7-000-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'mk.ru', '', NULL, ''),
(3, 'Customer', 'Customer', '+7-000-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'google.com', '', NULL, ''),
(4, 'Author', 'Author', '+7-000-0000000', '', '', 'kiev', '', '', '', '', '', 0, '', '', 0, 'df', '', 85, ''),
(11, 'Прокопенко', 'Влад', '+7-852-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'угадал', '', NULL, ''),
(12, 'zakaz', 'zakaz', '+7-000-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'ewewqewq', '', NULL, ''),
(14, 'avtor', 'test', '+7-978-0116403', '', '', 'Москва', 'Professor', '', '12,13,165', '1,2,3,4', '0', 0, 'wmr_test_avto', 'wmz_test_avto', 12345, 'БСЭ', '', 0, 'test_bank_acc'),
(15, 'Волков', 'Геннадий', '+7-955-0000000', '', '', 'Москва', 'Высшее', '12', '8,9', '2', '0', 0, '', '', 0, 'ааа ', '', NULL, ''),
(16, 'Автор', 'Главный', '+7-444-0000000', '', '', 'Москва', 'Школьник', '5', '8', '2', '0', 0, '', '', 0, 'по телевизору', 'нечего', NULL, ''),
(17, 'zakaz', 'test', '+7-000-0000000', '', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'ewewqewq', '', NULL, ''),
(19, 'Поварай', 'Лариса', '+7-000-000-00-0', '55555', '', 'Москва', '', '', '', '', '', 0, '', '', 0, 'Нашла в интернете', '', NULL, ''),
(22, 'Веловодов', 'Макар', '+7-978-7540970', '33344', '3434', 'Москва', '', '', '', '', '', 0, '', '', 0, 'Дядя федя', '', NULL, ''),
(23, 'Николай', 'Гаврилов', '+7-978-*******', '437758373', 'sheva1**2', 'Москва', '', '', '', '', '', 0, '', '', 0, 'С сайта', '', NULL, ''),
(24, 'Марковский', 'Михаил', '+7-978-7540969', '', 'нет', 'Москва', 'Кандидат и доктор колбасных наук', '15 лет', '26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,189,190,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,125,126,127,128,129,130,131,132,133,134,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20', '0', 0, '456456456456', '456456456456', 2147483647, 'Дипломные, курсовые работы и диссертации на заказ.', '', NULL, ''),
(25, 'Панкратов', 'Павел', '+7-000-0000000', '', '', 'Орел', 'КМС по написанию дипломов', '11', ',26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,189,190,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,125,126,127,128,129,130,131,132,133,134,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171', ',1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20', '0', 0, '2342342423423', '', 2147483647, 'От верблюда', '', NULL, '231232323223767567567'),
(29, 'ekomixds2', 'ekomixds2', '+7-000-0000000', 'ekomixds2', 'ekomixds2', 'ekomixds2', 'ekomixds2', '', '26,27,28,29,30,31,32,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49', '3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19', '0', 0, '4234234234', '', 234234, 'ekomixds2', 'ekomixds2', NULL, '324234'),
(35, 'Sudakova', 'Alesya', '22222222222222', '', '', 'Moskva', 'Два высших образования \r\nТретья степень бакалавра \r\n', 'Лпопажрлоаплиоплиоеп', '27', '1', '0', 0, '34834857498', '', 0, 'Makaki.com', '', NULL, '43534646577');

-- --------------------------------------------------------

--
-- Структура таблицы `ProfilesFields`
--

CREATE TABLE IF NOT EXISTS `ProfilesFields` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `varname` varchar(50) NOT NULL COMMENT 'Переменная',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `field_type` varchar(50) NOT NULL COMMENT 'Тип поля',
  `field_size` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Размер поля',
  `field_size_min` varchar(15) NOT NULL DEFAULT '0' COMMENT 'Мин размер поля',
  `required` int(1) NOT NULL DEFAULT '0' COMMENT 'Требуемое',
  `match` varchar(255) NOT NULL DEFAULT '' COMMENT 'Рег выражение',
  `range` varchar(255) NOT NULL DEFAULT '' COMMENT 'Диапазон',
  `error_message` varchar(255) NOT NULL DEFAULT '' COMMENT 'Сообщение об ощибке',
  `other_validator` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Прочая валидация',
  `default` varchar(255) NOT NULL DEFAULT '' COMMENT 'По умолчанию',
  `widget` varchar(255) NOT NULL DEFAULT '' COMMENT 'Виджет',
  `widgetparams` varchar(5000) NOT NULL DEFAULT '' COMMENT 'Параметры виджета',
  `position` int(3) NOT NULL DEFAULT '0' COMMENT 'Позиция',
  `visible` int(1) NOT NULL DEFAULT '0' COMMENT 'Видимое',
  PRIMARY KEY (`id`),
  KEY `varname` (`varname`,`widget`,`visible`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения полей профиля пользователя' AUTO_INCREMENT=24 ;

--
-- Дамп данных таблицы `ProfilesFields`
--

INSERT INTO `ProfilesFields` (`id`, `varname`, `title`, `field_type`, `field_size`, `field_size_min`, `required`, `match`, `range`, `error_message`, `other_validator`, `default`, `widget`, `widgetparams`, `position`, `visible`) VALUES
(1, 'lastname', 'Last Name', 'VARCHAR', '50', '3', 0, '', '', 'Incorrect Last Name (length between 3 and 50 characters).', '', '', '', '', 1, 3),
(2, 'firstname', 'First Name', 'VARCHAR', '50', '3', 0, '', '', 'Incorrect First Name (length between 3 and 50 characters).', '', '', '', '', 2, 3),
(5, 'mob_tel', 'Мобильный телефон', 'VARCHAR', '15', '14', 1, '', '', '', '', '+7-000-0000000', '', '', 3, 3),
(6, 'icq', 'ICQ', 'VARCHAR', '10', '5', 0, '', '', '', '', '', '', '', 4, 3),
(7, 'skype', 'Skype', 'VARCHAR', '50', '3', 0, '', '', '', '', '', '', '', 5, 3),
(8, 'city', 'Город', 'VARCHAR', '50', '2', 1, '', '', '', '', '', '', '', 6, 3),
(9, 'education', 'Образование, научные степени, звания', 'TEXT', '255', '0', 1, '', '', '', '', '', '', '', 7, 2),
(10, 'work_experience', 'Опыт работы в данной сфере', 'VARCHAR', '20', '1', 2, '', '', '', '', '', '', '', 8, 2),
(12, 'discipline', 'Учебная дисциплина', 'Text', '255', '0', 1, '', '', '', '', '', '', '', 9, 2),
(13, 'job_type', 'Работы, которые можете выполнять', 'Text', '255', '0', 1, '', '', '', '', '', '', '', 10, 2),
(14, 'fl_acc', 'Аккаунты на фрилансе', 'VARCHAR', '65535', '0', 0, '', '', '', '', '', '', '', 14, 2),
(15, 'mailing_list', 'Рассылать сообщения', 'VARCHAR', '10', '0', 0, '', 'icq;sms;email', '', '', '0', '', '', 12, 0),
(16, 'wmr', 'Webmoney R', 'INTEGER', '13', '12', 0, '', '', '', '', '', '', '', 13, 2),
(17, 'wmz', 'Webmoney Z', 'INTEGER', '13', '12', 0, '', '', '', '', '', '', '', 140, 0),
(18, 'yandex', 'Яндекс Д.', 'INTEGER', '13', '10', 0, '', '', '', '', '0', '', '', 15, 2),
(20, 'how_hear', 'Откуда Вы узнали о нас (адрес конкретного сайта)', 'VARCHAR', '255', '0', 1, '', '', '', '', '', '', '', 17, 3),
(21, 'additional', 'Дополнительно', 'TEXT', '255', '0', 0, '', '', '', '', '', '', '', 16, 3),
(22, 'bank_account', 'Банковский счет', 'VARCHAR', '255', '0', 0, '', '', '', '', '', '', '', 14, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectChanges`
--

CREATE TABLE IF NOT EXISTS `ProjectChanges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `file` varchar(350) DEFAULT NULL,
  `comment` varchar(450) NOT NULL DEFAULT '',
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `date_update` timestamp NULL DEFAULT NULL,
  `date_moderate` timestamp NULL DEFAULT NULL,
  `moderate` varchar(45) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=171 ;

--
-- Дамп данных таблицы `ProjectChanges`
--

INSERT INTO `ProjectChanges` (`id`, `user_id`, `project_id`, `file`, `comment`, `date_create`, `date_update`, `date_moderate`, `moderate`) VALUES
(62, 3, 4, 'audi_s5_1.jpg', '999', '2015-02-03 18:37:12', '2015-02-19 08:35:59', '2015-02-19 08:35:59', '1'),
(63, 1, 4, '1glava.docx', 'Нужно исправить сноски', '2015-02-06 14:51:15', '2015-02-19 08:32:02', '2015-02-19 08:32:02', '1'),
(64, 1, 4, '1glava.docx', 'Нужно исправить сноски', '2015-02-06 14:51:20', NULL, NULL, '1'),
(65, 1, 4, '111.docx', 'Нужно исправить сноски', '2015-02-06 14:51:27', NULL, NULL, '1'),
(82, 18, 5, '1glava.docx', 'Все замечания руководитель отметил красным. ', '2015-02-13 02:38:35', '2015-06-09 19:51:52', '2015-06-09 19:51:52', '1'),
(87, 1, 6, '_DSC0020.jpg', '', '2015-02-17 20:02:59', NULL, NULL, '1'),
(88, 18, 5, 'image11.jpg', '11 картинка', '2015-02-18 17:15:30', NULL, NULL, '0'),
(107, 1, 1, 'Plan.docx', 'ааа', '2015-02-19 02:21:31', NULL, NULL, '1'),
(109, 19, 9, '!!!!.jpg', 'Dsgjkybnnmm  ', '2015-02-20 14:12:20', NULL, NULL, '0'),
(117, 19, 7, '3G-RC22LED.pdf', 'test comment 3', '2015-02-21 01:25:13', NULL, NULL, '0'),
(118, 1, 9, 'mobile-app-screen-1.png', '', '2015-02-21 10:29:16', '2015-02-21 10:29:34', '2015-02-21 10:29:34', ''),
(121, 19, 7, '414116_426277.jpg', '', '2015-03-18 21:05:19', NULL, NULL, '0'),
(122, 19, 7, '414116_426277(1).jpg', '', '2015-03-18 21:07:34', NULL, NULL, '0'),
(123, 19, 7, '414116_426277(2).jpg', '', '2015-03-19 00:10:42', NULL, NULL, '0'),
(124, 19, 10, 'Description_MiniPro_TL866CS_USB.docx', '', '2015-05-28 17:45:22', '2015-06-16 18:53:33', '2015-06-16 18:53:33', '1'),
(127, 19, 10, 'images.jpeg', '2', '2015-06-09 04:08:57', '2015-06-16 18:53:34', '2015-06-16 18:53:34', '1'),
(128, 19, 10, 'images(1).jpeg', '321', '2015-06-16 19:19:36', NULL, NULL, '0'),
(129, 19, 10, 'images(2).jpeg', '321', '2015-06-16 19:28:36', NULL, NULL, '0'),
(130, 19, 10, 'images(3).jpeg', 'jkl', '2015-06-16 19:29:08', NULL, NULL, '0'),
(131, 19, 10, 'images(4).jpeg', '765', '2015-06-16 19:29:52', NULL, NULL, '0'),
(132, 19, 10, 'images(5).jpeg', 'kjh', '2015-06-16 19:33:10', NULL, NULL, '0'),
(133, 19, 10, 'images(6).jpeg', 'kjh', '2015-06-16 19:33:44', NULL, NULL, '0'),
(134, 1, 10, 'images(7).jpeg', '543', '2015-06-16 20:36:18', NULL, NULL, '1'),
(137, 1, 10, 'images(8).jpeg', '2', '2015-06-17 00:18:59', NULL, NULL, '1'),
(138, 1, 10, 'images(9).jpeg', '3', '2015-06-17 00:24:07', NULL, NULL, '1'),
(139, 22, 51, '2-ya-glava-grazhd-prava.doc', '', '2015-07-01 19:51:42', '2015-08-03 17:33:10', '2015-08-03 17:33:10', ''),
(140, 17, 11, 'Vybor-pischi---vybor-sud`by.doc', 'Коммент', '2015-07-10 20:29:51', NULL, NULL, '0'),
(141, 17, 11, 'Andreev-Oleg.-Uchimsya-chitat`-bystro.doc', 'Коммент 2', '2015-07-10 20:30:09', NULL, NULL, '0'),
(142, 22, 61, '1667-Analiz-i-sovershenstvovanie-sovremennyh-form-oplaty-truda-na-primere-Makdonal`dsa.doc', 'Замечания в файле', '2015-07-10 21:57:37', '2015-07-10 21:58:10', '2015-07-10 21:58:10', '1'),
(143, 17, 16, 'Piter-Kelder.-Oko-vozrozhdenia.pdf', 'угсиугисшуцкгстц', '2015-07-11 14:52:44', NULL, NULL, '0'),
(144, 17, 62, '9wxukH0eAJQ.jpg', 'Коммент', '2015-07-11 20:35:11', NULL, NULL, '0'),
(145, 17, 62, '9wxukH0eAJQ(1).jpg', 'Коммент', '2015-07-11 20:35:19', NULL, NULL, '0'),
(146, 17, 62, '50000_rubles-(1995)_back.jpg', '', '2015-07-12 17:24:32', NULL, NULL, '0'),
(147, 1, 0, 'Test-Tomasa-Kilmana.doc', 'nuchnuehncuehdncuhenduce комментарий', '2015-07-13 21:00:55', NULL, NULL, '1'),
(148, 1, 0, 'Test-Tomasa-Kilmana(1).doc', 'nuchnuehncuehdncuhenduce комментарий', '2015-07-13 21:00:57', NULL, NULL, '1'),
(149, 1, 0, 'Test-Tomasa-Kilmana(2).doc', 'nuchnuehncuehdncuhenduce комментарий', '2015-07-13 21:01:12', NULL, NULL, '1'),
(150, 1, 0, 'Vybor-pischi---vybor-sud`by.doc', 'baeraergqregwrgerg', '2015-07-13 21:02:07', NULL, NULL, '1'),
(151, 1, 0, 'Hill-Napoleon.-Dumay-i-bogatey!.doc', '3423423423434224234235345345', '2015-07-13 21:03:35', NULL, NULL, '1'),
(152, 1, 0, 'astral1024.jpg', '=)', '2015-07-13 21:05:58', NULL, NULL, '1'),
(153, 1, 0, 'fs_430.jpg', '123', '2015-07-13 21:25:38', NULL, NULL, '1'),
(154, 1, 0, 'fs_449.jpg', '321', '2015-07-13 21:26:09', NULL, NULL, '1'),
(155, 1, 0, 'fs_449(1).jpg', '456', '2015-07-13 21:41:23', NULL, NULL, '1'),
(156, 1, 62, 'fs_437.jpg', '=)', '2015-07-13 21:47:51', NULL, NULL, '1'),
(157, 1, 62, 'fs_430(1).jpg', '123', '2015-07-13 21:49:09', NULL, NULL, '1'),
(158, 1, 61, 'Test-Tomasa-Kilmana(3).doc', 'ygbybyb', '2015-07-13 21:49:58', NULL, NULL, '1'),
(159, 1, 61, 'Hachison-Maykl.-Himicheskie-veschestva,-uluchshayuschie-umstvennye-sposobnosti.pdf', 'ygbybyb', '2015-07-13 21:50:22', NULL, NULL, '1'),
(160, 22, 64, '10159-Diplom-2.3.doc', 'Замеаания в фалйе красным цветом', '2015-07-19 15:03:05', '2015-07-19 15:05:18', '2015-07-19 15:05:18', '1'),
(161, 23, 65, '1-Glava-65.doc', 'необходимо исправить то тот ото то то то то то тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото тото то', '2015-07-20 16:07:51', '2015-07-20 16:11:50', '2015-07-20 16:11:50', '1'),
(162, 23, 68, '1-Glava-65(1).doc', 'План изменен', '2015-08-02 15:34:41', '2015-08-02 15:35:28', '2015-08-02 15:35:28', '1'),
(163, 22, 22, '1700-Politika-glasnosti-v-oblasti-kul`tury-(1).doc', '', '2015-08-02 18:25:34', NULL, NULL, '0'),
(164, 22, 22, '1700-Politika-glasnosti-v-oblasti-kul`tury-(1)(1).doc', '', '2015-08-02 18:25:35', NULL, NULL, '0'),
(165, 22, 15, NULL, 'sdf', '2015-08-03 17:13:18', NULL, NULL, '0'),
(166, 22, 81, 'Ekaterina-Li-CV-(2).pdf', 'все плохо', '2015-08-04 18:11:12', '2015-08-04 18:11:40', '2015-08-04 18:11:40', '1'),
(167, 22, 81, 'Ekaterina-Li-CV-(2)(1).pdf', 'все плохо', '2015-08-04 18:11:16', '2015-08-04 18:11:43', '2015-08-04 18:11:43', '1'),
(168, 23, 82, '1-Glava-65(2).doc', 'Не верно расставлены ссылки \r\nНет актуалmyjcnb \r\nВведение поправить\r\nСделать сноски\r\nПереформулировать 2-ю главу', '2015-08-05 03:25:16', '2015-08-05 03:26:04', '2015-08-05 03:26:04', '1'),
(169, 23, 85, '1-Glava-65(3).doc', '', '2015-08-13 17:50:04', NULL, NULL, '0'),
(170, 1, 84, '1-Glava-65(4).doc', '', '2015-08-16 17:21:30', NULL, NULL, '1');

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectMessages`
--

CREATE TABLE IF NOT EXISTS `ProjectMessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `sender` int(11) NOT NULL,
  `recipient` int(11) NOT NULL,
  `moderated` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  `order` int(11) NOT NULL,
  `cost` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=524 ;

--
-- Дамп данных таблицы `ProjectMessages`
--

INSERT INTO `ProjectMessages` (`id`, `message`, `sender`, `recipient`, `moderated`, `date`, `order`, `cost`) VALUES
(60, 'Здравствуйт', 1, 0, 0, '2015-02-07 15:40:06', 4, NULL),
(62, 'Здравствуйте, хочу выполнить. ', 16, 0, 0, '2015-02-07 15:42:58', 3, NULL),
(67, 'аа', 16, 0, 0, '2015-02-09 02:34:35', 3, 5777),
(68, 'Здравствуйте Выполню. ', 16, 0, 0, '2015-02-09 02:34:56', 3, 5000),
(77, 'csdcdscsdc', 16, 0, 0, '2015-02-10 14:18:35', 3, NULL),
(78, 'Здравствуйте', 1, 0, 0, '2015-02-10 14:19:22', 3, NULL),
(79, 'eqweweqw', 16, 0, 0, '2015-02-10 14:19:24', 3, 4234),
(80, 'eqweweqw', 16, 0, 0, '2015-02-10 14:19:33', 3, 4234),
(108, 'jhgfjhgf', 14, 0, 0, '2015-02-11 17:28:13', 3, 654),
(109, 'тест', 14, 11, 0, '2015-02-11 20:08:37', 3, NULL),
(118, 'bbb', 14, 0, 0, '2015-02-13 04:22:27', 3, NULL),
(119, 'bbb', 14, 0, 0, '2015-02-13 04:24:24', 3, NULL),
(120, 'bbb', 14, 0, 0, '2015-02-13 04:24:30', 3, NULL),
(121, 'привет', 3, 1, 0, '2015-02-18 18:18:59', 4, NULL),
(127, 'FKFKFKFK', 1, 0, 0, '2015-02-18 20:31:00', 7, NULL),
(128, 'fnfnfnfn', 1, 19, 0, '2015-02-18 20:31:49', 7, NULL),
(129, 'fnfnfn', 1, 0, 0, '2015-02-18 20:33:47', 7, NULL),
(130, 'иии', 1, 19, 0, '2015-02-18 20:34:39', 7, NULL),
(131, 'азазазаз', 1, 19, 0, '2015-02-18 20:35:51', 7, NULL),
(132, '1', 1, 19, 0, '2015-02-18 20:49:33', 7, NULL),
(133, '2', 1, 19, 0, '2015-02-18 20:49:57', 7, NULL),
(138, '3', 1, 19, 0, '2015-02-18 21:10:50', 7, NULL),
(139, '3', 1, 19, 0, '2015-02-18 21:11:48', 7, NULL),
(142, '4', 1, 19, 0, '2015-02-18 21:13:07', 7, NULL),
(154, '0', 1, 19, 0, '2015-02-19 00:44:51', 7, NULL),
(155, '1', 1, 19, 0, '2015-02-19 00:50:55', 7, NULL),
(160, '11111', 1, 19, 0, '2015-02-19 00:51:59', 7, NULL),
(180, '13', 1, 0, 0, '2015-02-19 01:10:52', 7, NULL),
(184, '/htsbuybe6byu6e', 19, 1, 0, '2015-02-19 01:53:59', 7, NULL),
(185, 'fgsdjhfgshjd', 14, 1, 0, '2015-02-19 02:03:16', 7, NULL),
(186, 'fgsdjhfgshjd', 14, 1, 0, '2015-02-19 02:10:02', 7, NULL),
(189, 'Здравствуйте. Когда мне назначат Автора ?', 19, 1, 0, '2015-02-20 10:44:34', 9, NULL),
(191, 'Привет', 19, 0, 0, '2015-02-20 10:50:04', 9, NULL),
(193, 'Сделаю за 4', 16, 1, 0, '2015-02-20 11:39:37', 9, 4000),
(196, 'Здравствуйте, окей выполняйте за 4 тыс.', 1, 16, 0, '2015-02-20 17:34:00', 9, NULL),
(197, 'Добрый день. Ну что', 19, 1, 0, '2015-02-20 17:36:29', 9, NULL),
(198, 'Всё хорошо. Автор работает', 1, 19, 0, '2015-02-20 17:43:54', 9, NULL),
(199, 'Автор назначил 20 к', 1, 19, 0, '2015-02-20 17:44:30', 9, NULL),
(205, 'Здравствуйте, смогу выполнить.', 16, 0, 0, '2015-03-19 16:15:29', 13, 10000),
(208, 'ddd', 3, 0, 0, '2015-03-19 18:45:48', 8, NULL),
(209, 'Здравствуйте!\n\nВы назначены Автором этого заказа.\n\nВаш бюджет составит 10000 рублей.\n\nЕще раз внимательно изучите форму заказа и сообщите менеджеру, что Вы приступаете к написанию работы. План+введение необходимо выслать до 10.10.2014 . Далее, выслать Главу 1 до 10.10 2014. Вся работа должна быть выслана хх.хх.2014.\n\nПеред тем, как отправлять работу, ее нужно самостоятельно проверять на antiplagiat.ru или аналогичных системах (exbt.ru и тд), оригинальность работы должна быть не менее 80%. После того, как Вы выслали клиенту часть работы и перед тем, как приступать к написанию следующей части проекта, получите подтверждение от менеджера о том, что клиент одобрил написанную часть работы.\n\nПожалуйста, проверяйте Вашу почту и чат раз в день, чтобы оперативно отвечать на сообщения от клиента и менеджера. Если Вы по каким-либо причинам не можете закончить работу или задерживаете со сроками - уведомите об этом менеджера заренее. За просрочку работ, без уважительной причины штрафные санкции!\n\nЕсли Вы задержали работу и не сообщили об этом заранее, и не выходите на связь, мы будем вынуждены снять Вас с этого и остальных заказов, снизить Вам рейтинг ниже нуля, прекратить с Вами сотрудничество и поставить Вас в Единую Базу (к которой имеют доступ все аналогичные компании) черного списка Авторов по написанию научно-образовательных работ!\n\nНадеемся на Ваше понимание отвественности перед Заказчиком!\n\nПосле утверждния всей работы, оплата будет произведена оплата за заказ на кошельки (WMR и Яндекс .деньги) , указанные Вами в личном кабинете на сайте dipstart.ru.\n\nПосле успешной сдачи каждого заказа, у Вас повышается персональной рейтинг Автора. Чем выше рейтинг – тем чаще Вас будут назначать автором работ. Обладателям высокого рейтинга выплачиваются премии. Мы дорожим нашими Авторами с высоким рейтингом! Пожалуйста, ОБЯЗАТЕЛЬНО ПОДТВЕРДИТЕ ВЫПОЛНЕНИЕ ЗАКАЗА В ТЕЧЕНИЕ СУТОК!', 1, 16, 0, '2015-03-19 21:14:49', 13, NULL),
(210, 'Здравствуйте, Автор работает не волнуйтесь.', 1, 19, 0, '2015-03-19 21:15:23', 13, NULL),
(211, 'Спасибо', 19, 1, 0, '2015-03-19 21:15:37', 13, NULL),
(212, 'Принял', 16, 1, 0, '2015-03-19 21:16:42', 13, NULL),
(213, 'Здравствуйте, дайте тел.', 16, 19, 1, '2015-03-19 21:17:28', 13, NULL),
(215, 'nhdgh', 1, 14, 0, '2015-06-04 20:28:20', 7, NULL),
(216, 'sghfgh', 1, 19, 0, '2015-06-04 20:28:24', 7, NULL),
(217, 'ghnfgsfh', 17, 0, 0, '2015-06-09 17:05:55', 11, NULL),
(218, 'trhfdhgtf', 17, 0, 0, '2015-06-09 17:06:12', 11, NULL),
(220, 'Привет', 1, 17, 0, '2015-06-09 19:16:33', 11, NULL),
(221, ' чимтист', 17, 1, 0, '2015-06-09 19:17:38', 11, NULL),
(222, 'Здравствуйте, дайте Ваш телефон.', 22, 2, 0, '2015-06-10 05:10:17', 16, NULL),
(223, 'Здравствуйте, беру 5000', 14, 1, 0, '2015-06-10 05:12:05', 16, 5000),
(228, 'Новый заказ о внесении предоплаты.', 1, 3, 0, '2015-06-17 13:23:29', 46, NULL),
(229, 'Здравствуйте. готов выполнить.', 14, 3, 1, '2015-06-18 17:52:01', 46, NULL),
(230, 'Здравствуйте, есть план ?', 14, 3, 1, '2015-06-18 18:02:26', 46, NULL),
(231, 'Здравствйуте. работайте', 1, 2, 0, '2015-06-18 18:03:35', 46, NULL),
(232, 'Здравствуйте все ок', 1, 3, 0, '2015-06-18 18:03:42', 46, NULL),
(233, 'Где мой файл ?', 14, 1, 0, '2015-06-18 18:15:21', 46, NULL),
(240, '2', 1, 0, 1, '2015-06-19 12:56:40', 16, NULL),
(241, 'answer1', 1, 0, 1, '2015-06-19 01:42:03', 16, NULL),
(242, 'О внесении предоплаты', 1, 3, 0, '2015-06-19 19:15:44', 47, NULL),
(243, 'На банк', 22, 1, 0, '2015-06-19 19:16:03', 47, NULL),
(244, 'Давайте выполню ', 14, 1, 0, '2015-06-19 19:41:10', 47, 5000),
(245, 'Цена 5000', 14, 3, 1, '2015-06-19 19:41:17', 47, 5000),
(246, 'Автор приступил, работает.', 1, 3, 0, '2015-06-19 19:44:11', 47, NULL),
(247, 'nbn', 1, 0, 0, '2015-06-19 21:13:56', 16, NULL),
(248, 'nb vnbv', 1, 2, 0, '2015-06-19 21:13:59', 16, NULL),
(249, 'bbn v', 1, 3, 0, '2015-06-19 21:14:02', 16, NULL),
(250, 'vfdsvfdvs', 14, 3, 0, '2015-06-19 21:21:08', 16, NULL),
(251, 'vfdvs', 14, 1, 0, '2015-06-19 21:21:11', 16, NULL),
(252, 'vfdvs000', 1, 0, 0, '2015-06-25 20:36:11', 16, NULL),
(253, 'Здравствуйте, дайте Ваш тел', 14, 3, 0, '2015-06-22 00:15:39', 48, NULL),
(254, 'Здравствуйте.', 22, 2, 0, '2015-06-22 00:18:30', 48, NULL),
(255, 'Автор назначен', 1, 0, 0, '2015-06-22 00:21:29', 48, 5000),
(256, 'Здравствуйте.', 22, 2, 0, '2015-06-22 09:24:51', 49, NULL),
(257, 'О внесении предоплаты', 1, 3, 0, '2015-06-22 09:26:59', 49, NULL),
(258, 'Ок внесу сегодня', 22, 1, 0, '2015-06-22 09:31:03', 49, NULL),
(259, 'Оплатил', 22, 1, 0, '2015-06-22 09:42:15', 49, NULL),
(260, 'Здравствуйте, выполню.', 14, 1, 0, '2015-06-22 09:42:51', 49, NULL),
(261, 'Есть план или материалы ?', 14, 1, 0, '2015-06-22 09:42:59', 49, NULL),
(262, 'Здравствуйте, оплату получили Автор приступил.', 1, 0, 0, '2015-06-22 09:47:41', 49, NULL),
(263, 'Выполню', 1, 0, 0, '2015-06-22 09:56:04', 49, 4000),
(264, 'Назначен Автором. 1-я часть необходима 25.06.', 1, 2, 0, '2015-06-22 10:02:41', 49, NULL),
(265, 'Выполню за 1', 14, 1, 0, '2015-06-22 10:03:37', 49, 1000),
(266, 'Есть материалы ?', 14, 3, 1, '2015-06-22 10:07:08', 49, NULL),
(267, 'Все скинул Вам', 22, 2, 1, '2015-06-22 10:07:29', 49, NULL),
(268, 'Спасибо', 14, 3, 0, '2015-06-22 11:52:53', 49, NULL),
(325, 'Здрасте', 22, 1, 0, '2015-06-30 00:36:21', 49, NULL),
(326, 'О внесении предоплаты.', 1, 3, 0, '2015-07-03 11:22:31', 53, NULL),
(327, 'Ок завтра', 22, 1, 0, '2015-07-03 11:35:44', 53, NULL),
(328, 'Здравствуйте, могу выполнить такую работу.', 14, 1, 0, '2015-07-05 09:39:08', 53, NULL),
(329, 'Здравствуйте, работа кипит.', 1, 3, 0, '2015-07-05 09:52:40', 53, NULL),
(330, 'Здравствуйте уважаемая. Оплату получили', 1, 3, 0, '2015-07-08 21:01:36', 54, NULL),
(331, 'Здравствуйте.', 1, 2, 0, '2015-07-08 21:01:49', 54, NULL),
(332, 'Готов выполнить.', 14, 1, 0, '2015-07-08 21:03:18', 54, NULL),
(333, 'За 5 тыщ', 14, 3, 0, '2015-07-08 21:09:09', 54, NULL),
(334, 'шьушсоьшуосу', 17, 1, 0, '2015-07-10 20:29:07', 11, NULL),
(335, 'ацмуечцуч', 17, 2, 0, '2015-07-10 20:29:12', 11, NULL),
(336, 'Здравствуйте, сделаю', 14, 1, 0, '2015-07-10 20:58:12', 61, 5000),
(337, 'Оплату получили', 1, 3, 0, '2015-07-10 20:58:58', 61, NULL),
(338, 'Спасибо', 22, 1, 0, '2015-07-10 20:59:19', 61, NULL),
(339, 'Как дела', 22, 2, 1, '2015-07-10 20:59:34', 61, NULL),
(340, 'тгкртмгкрм', 1, 2, 0, '2015-07-11 16:44:19', 62, NULL),
(343, '=)', 14, 1, 0, '2015-07-11 22:55:12', 62, NULL),
(344, 'mm?', 14, 1, 0, '2015-07-11 22:55:48', 62, 555),
(346, 'Сообщение автору', 17, 2, 1, '2015-07-12 14:12:54', 62, NULL),
(347, 'Яя зер гуд', 14, 3, 1, '2015-07-12 18:12:25', 62, NULL),
(348, 'Зига чувак!', 14, 3, 0, '2015-07-14 16:12:21', 62, NULL),
(353, 'unrivnrovn fijneicniernv rivnierfnviernivn rfivnerinvienrvirneiv eivnceirnviernviernv euvneirnvceirnvciern einerinviermnoicumroivur riveirnvirnveirnvoierntv rvovinowrnvorintvrv rvnrivnirnvnwoviwjrnovinrwovnerouiv rvinroivnwrojvnowinvuiwrycwbr wwrvnwurinvowr', 1, 2, 0, '2015-07-15 14:57:05', 62, NULL),
(357, 'Оплатил чек прикрепляю', 22, 1, 0, '2015-07-18 13:48:13', 64, NULL),
(358, 'Оплатил чек прикрепляю', 22, 2, 0, '2015-07-18 13:48:15', 64, NULL),
(359, 'sdfsdfdsf', 14, 3, 1, '2015-07-18 14:00:24', 64, NULL),
(363, 'пагпаропно', 1, 14, 0, '2015-07-19 16:28:58', 64, NULL),
(373, 'Здравствуйте,  Ваш проект готов.', 1, 22, 0, '2015-07-19 20:21:19', 64, NULL),
(374, 'Оплатил чек прикрепляю', 22, 14, 1, '2015-07-19 20:26:27', 64, NULL),
(375, 'Оплачивайте', 1, 23, 0, '2015-07-20 13:47:36', 65, NULL),
(376, 'Да, можно платить', 1, 23, 0, '2015-07-20 13:49:16', 65, NULL),
(377, 'Можно платить', 1, 23, 0, '2015-07-20 13:50:07', 65, NULL),
(381, 'Здравствуйте. Стоимость работы (30000) рублей.\n\nДля того, чтобы наш Автор смог приступить к выполнению Вашего заказа, Вам необходимо внести аванс в размере 50% от стоимости работы.\n\nЭто подтвердит серьезность намерений с Вашей стороны и мы будем уверены, что Автор выполнит действительно востребованную работу. Мы берем 50% аванс, в отличии от других компаний, берущих 100%, чтобы Вы были уверенны в нашей честности. Вы не оплачиваете вторые 50% за работу до тех пор, пока Вы не будете удовлетворены качеством ее выполнения! Кроме того, все доработки, которые будет необходимо произвести после проверки преподавателем, мы выполняем бесплатно!', 1, 23, 0, '2015-07-20 13:52:08', 65, NULL),
(382, 'Оплату получили. Автор работает', 1, 23, 0, '2015-07-20 14:05:32', 65, NULL),
(383, 'Здравствуйте, смогу сделать за 10000 руб.', 24, 1, 0, '2015-07-20 14:13:14', 65, 10000),
(384, 'ййй', 1, 17, 1, '2015-07-20 21:45:04', 62, NULL),
(385, 'Приветствую', 1, 22, 0, '2015-07-22 16:10:40', 64, NULL),
(386, 'Оплату получили', 1, 23, 0, '2015-07-23 14:01:31', 66, NULL),
(387, 'Спасибо', 23, 1, 0, '2015-07-23 14:01:52', 66, NULL),
(388, 'Выполню', 24, 1, 0, '2015-07-23 14:02:58', 66, NULL),
(389, 'В какую цену', 1, 0, 0, '2015-07-23 14:09:56', 66, NULL),
(390, 'Оплатил чек прикрепляю', 22, 0, 1, '2015-07-27 21:49:09', 64, NULL),
(391, 'гпргпрг', 24, 22, 0, '2015-07-31 18:44:15', 51, NULL),
(392, 'Здравствуйте, к оплате 25000', 1, 23, 0, '2015-08-01 16:43:42', 67, NULL),
(393, 'Оплатил', 23, 1, 0, '2015-08-01 16:52:16', 67, NULL),
(394, 'Здравствуйте. Стоимость работы (14000) рублей.\n\nДля того, чтобы наш Автор смог приступить к выполнению Вашего заказа, Вам необходимо внести аванс в размере 50% от стоимости работы.\n\nЭто подтвердит серьезность намерений с Вашей стороны и мы будем уверены, что Автор выполнит действительно востребованную работу. Мы берем 50% аванс, в отличии от других компаний, берущих 100%, чтобы Вы были уверенны в нашей честности. Вы не оплачиваете вторые 50% за работу до тех пор, пока Вы не будете удовлетворены качеством ее выполнения! Кроме того, все доработки, которые будет необходимо произвести после проверки преподавателем, мы выполняем бесплатно!\n\nОплата производится любым удобным для Вас способом, исключительно на реквизиты, указанные в этой ссылке "Реквизиты"\n\n\n\n(Внимание! Реквизиты были изменены! Перед оплатой проверьте реквизиты!)\n\nСообщите, пожалуйста, каким способом Вы хотите оплатить работу?', 1, 23, 0, '2015-08-02 14:10:17', 68, NULL),
(395, 'Здравствуйте, оплатил в офисе 7000 р.', 23, 1, 0, '2015-08-02 14:15:48', 68, NULL),
(396, 'Здравствуйте!\n\nОплату получили. Приступаем к работе.\n\nВся работа будет сделана в срок, указанный в Форме Заказа и выслана Вам в Чат; сроки сдачи частей остаются на усмотрение Автора, если другое не было оговорено в заказе.\n\nЕсли у Вас появятся дополнительные материалы по работе, Вам нужно прикрепить их к заявке. В случае возникновения вопросов по работе, Вы можете написать сообщение через данный Чат, адресуя Автору: Автор отвечает в течении суток (по рабочим дням).\n\nТак же, если автор не ответил Вам в течении суток, или у Вас есть вопросы по оплате, Вы можете адресовать вопросы Менеджеру: Менеджер отвечает в течении 5 часов (не забудьте просматривать почту, на которую Вам будет приходит уведомление о новом сообщении в Чате). В связи с высокой загруженностью менеджеров, и стремлением фиксировать все вопросы по заказу, всё общение происходит исключительно через форму Чата. Надеемся на Ваше понимание.\n\nСпасибо, что воспользовались услугами нашей компании! :)', 1, 23, 0, '2015-08-02 14:19:16', 68, NULL),
(405, '123', 1, 14, 0, '2015-08-02 16:52:26', 64, NULL),
(410, 'пролруд', 22, 0, 0, '2015-08-02 18:25:07', 22, NULL),
(411, '321', 1, 22, 0, '2015-08-02 19:11:03', 64, NULL),
(412, '321', 1, 22, 0, '2015-08-02 19:13:02', 64, NULL),
(413, 'Ну Макар Макарыч', 1, 22, 0, '2015-08-02 19:13:28', 64, NULL),
(414, 'А ты че?', 1, 14, 0, '2015-08-02 19:13:56', 64, NULL),
(429, 'в', 1, 22, 0, '2015-08-03 16:41:31', 15, NULL),
(430, 'смогу выполнить', 14, 1, 0, '2015-08-03 17:17:47', 51, 1000),
(431, 'ррроо', 1, 1, 0, '2015-08-03 17:26:52', 51, 1000),
(432, 'ррроо', 1, 1, 0, '2015-08-03 17:26:53', 51, 1000),
(433, 'ррроо', 1, 1, 0, '2015-08-03 17:26:53', 51, 1000),
(434, 'ррроо', 1, 1, 0, '2015-08-03 17:26:54', 51, 1000),
(435, 'ррроо', 1, 1, 0, '2015-08-03 17:26:54', 51, 1000),
(436, 'ррроо', 1, 1, 0, '2015-08-03 17:26:55', 51, 1000),
(437, 'ррроо', 1, 1, 0, '2015-08-03 17:27:07', 51, 1000),
(438, 'ррроо', 1, 1, 0, '2015-08-03 17:27:07', 51, 1000),
(439, 'ррроо', 1, 1, 0, '2015-08-03 17:27:08', 51, 1000),
(440, 'ррроо', 1, 1, 0, '2015-08-03 17:27:11', 51, 1000),
(441, 'ррроо', 1, 1, 0, '2015-08-03 17:27:11', 51, 1000),
(442, 'ррроо', 1, 1, 0, '2015-08-03 17:27:11', 51, 1000),
(443, 'ррроо', 1, 1, 0, '2015-08-03 17:27:12', 51, 1000),
(444, 'ррроо', 1, 1, 0, '2015-08-03 17:27:12', 51, 1000),
(445, 'ррроо', 1, 1, 0, '2015-08-03 17:27:14', 51, 1000),
(446, 'ррроо', 1, 1, 0, '2015-08-03 17:27:24', 51, 1000),
(447, 'ррроо', 1, 1, 0, '2015-08-03 17:27:25', 51, 1000),
(448, 'ррроо', 1, 1, 0, '2015-08-03 17:27:25', 51, 1000),
(449, 'ррроо', 1, 1, 0, '2015-08-03 17:27:25', 51, 1000),
(450, 'ррроо', 1, 1, 0, '2015-08-03 17:27:26', 51, 1000),
(451, 'ррроо', 1, 1, 0, '2015-08-03 17:27:34', 51, 1000),
(452, 'ррроо', 1, 1, 0, '2015-08-03 17:27:39', 51, 1000),
(453, 'павапвап', 1, 0, 0, '2015-08-03 17:33:56', 15, NULL),
(454, 'павапвап', 1, 22, 0, '2015-08-03 17:34:02', 15, NULL),
(455, 'вап', 1, 0, 0, '2015-08-03 17:34:08', 15, NULL),
(456, 'готов и за 4500', 14, 1, 0, '2015-08-03 17:55:54', 47, 4500),
(457, 'rrgrgr', 22, 0, 0, '2015-08-03 18:21:43', 15, NULL),
(458, 'Здравствуйте, где моя работа ?', 23, 1, 0, '2015-08-04 01:20:37', 71, NULL),
(459, 'Здравствуйте', 23, 0, 0, '2015-08-04 01:20:45', 71, NULL),
(460, 'Здравствуйте, Вы только оформили заказ. Готовы выполнить', 1, 23, 0, '2015-08-04 01:23:54', 71, NULL),
(461, 'Здраствуйте', 1, -1, 0, '2015-08-04 01:26:25', 71, NULL),
(464, 'Здравствуйте.', 14, 23, 0, '2015-08-04 01:47:16', 71, NULL),
(465, 'Здравствйуте  111', 14, 23, 1, '2015-08-04 01:48:53', 71, NULL),
(466, 'Здравствуйте.', 1, 0, 0, '2015-08-04 02:13:43', 71, NULL),
(467, '4500!!!!!', 14, 1, 0, '2015-08-04 17:47:49', 47, NULL),
(468, 'лорюлр', 14, 1, 0, '2015-08-04 17:50:41', 47, NULL),
(469, 'здравствуйте', 14, 1, 0, '2015-08-04 17:55:43', 71, NULL),
(470, 'мм', 14, 1, 0, '2015-08-04 17:55:55', 71, NULL),
(471, 'ллою', 14, 1, 0, '2015-08-04 17:57:21', 71, NULL),
(472, 'привет', 22, 1, 0, '2015-08-04 18:05:56', 81, NULL),
(473, 'арлоа', 22, 0, 0, '2015-08-04 18:14:47', 81, NULL),
(474, 'откройте заказ', 22, 1, 0, '2015-08-04 18:17:03', 81, NULL),
(475, 'Здравствуйте. менеджер ', 23, 1, 0, '2015-08-04 19:20:41', 71, NULL),
(476, 'Здравствуйте.', 1, 14, 0, '2015-08-04 19:24:05', 71, NULL),
(477, 'Здравствуйте зак', 1, 23, 0, '2015-08-04 19:24:13', 71, NULL),
(478, 'Здравствуйте, сколько будет стоить', 23, 1, 0, '2015-08-05 02:46:09', 82, NULL),
(479, 'Здравствуйте, цена составит 15 тыс. Предоплата 50% .', 1, 23, 0, '2015-08-05 02:47:29', 82, NULL),
(480, 'Ок, оплачу завтра чрез банк', 23, 1, 0, '2015-08-05 02:49:15', 82, NULL),
(481, 'Я прикрепил план. Пусть Автор учтет', 23, 1, 0, '2015-08-05 02:52:54', 82, NULL),
(482, 'Посмотрите я план загрузил. Спасибо', 23, 0, 0, '2015-08-05 02:53:12', 82, NULL),
(483, 'Здравствуйте , как работа идет ?', 23, 0, 0, '2015-08-05 02:58:45', 82, NULL),
(484, 'Здравствуйте.', 23, 1, 0, '2015-08-05 03:00:21', 82, NULL),
(485, 'Здравствуйте, интересная работа. Готов выполнить ', 24, 1, 0, '2015-08-05 03:03:12', 82, 3000),
(486, 'Есть скайп ?', 24, 23, 1, '2015-08-05 03:03:18', 82, NULL),
(487, 'Хорошо, назначим Вас.', 1, 0, 0, '2015-08-05 03:05:50', 82, NULL),
(488, 'Здравствуйте, приступайте ждем в срок', 1, 24, 0, '2015-08-05 03:07:29', 82, NULL),
(489, 'Здравствуйте, как дела ?', 23, 24, 1, '2015-08-05 03:08:14', 82, NULL),
(490, 'Здравствуйте. работаю.', 24, 23, 1, '2015-08-05 03:08:35', 82, NULL),
(491, '11111', 1, 24, 0, '2015-08-05 03:11:13', 82, NULL),
(492, '11111', 1, 23, 0, '2015-08-05 03:11:15', 82, NULL),
(493, '22222', 24, 23, 1, '2015-08-05 03:11:42', 82, NULL),
(494, '22222', 24, 1, 0, '2015-08-05 03:11:45', 82, NULL),
(495, '3333', 23, 24, 1, '2015-08-05 03:11:48', 82, NULL),
(496, '3333', 23, 1, 0, '2015-08-05 03:11:51', 82, NULL),
(497, '22222222222222222222222222222222222222222222222222222222222222222222222222222222222222222?', 23, 1, 0, '2015-08-05 03:12:13', 82, NULL),
(498, 'На проверке, спасибо.', 23, 24, 1, '2015-08-05 03:23:41', 82, NULL),
(499, 'На проверке, спасибо.', 23, 1, 0, '2015-08-05 03:23:42', 82, NULL),
(500, 'Преподаватель внес замечания', 23, 1, 0, '2015-08-05 03:24:28', 82, NULL),
(510, 'Test', 1, 22, 0, '2015-08-06 15:56:51', 51, NULL),
(513, 'sfsdfdsd', 1, 14, 0, '2015-08-08 16:35:10', 63, NULL),
(514, '<p>Здравствуйте!<br />Хотелось бы уточнить цену и сроки.</p>', 1, 4, 0, '2015-08-13 15:36:06', 1, NULL),
(515, '<p>Добрый вечер!<br />Все как договаривались. Давайте обсудим подробности в скайпе?</p>', 1, 4, 0, '2015-08-13 15:36:51', 1, NULL),
(516, '<p>Да, конечно. Добавляйте.</p>', 1, 4, 0, '2015-08-13 15:37:08', 1, NULL),
(517, '4', 23, 0, 0, '2015-08-13 17:29:22', 85, NULL),
(518, 'Здравствуйте, оплатил.', 23, 1, 0, '2015-08-13 17:36:21', 85, NULL),
(519, 'Здравствуйте.', 24, 1, 0, '2015-08-13 17:46:44', 8, NULL),
(520, 'Готов выполнить', 24, 3, 0, '2015-08-13 17:46:52', 8, NULL),
(521, 'Здравствуйте', 23, 0, 0, '2015-08-16 17:31:47', 84, NULL),
(522, '<p>11</p>', 1, 14, 0, '2015-08-18 11:14:41', 71, NULL),
(523, '<p>11</p>', 1, 14, 0, '2015-08-18 11:15:01', 71, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectPayments`
--

CREATE TABLE IF NOT EXISTS `ProjectPayments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `project_price` float(10,2) DEFAULT NULL,
  `work_price` float(10,2) DEFAULT NULL,
  `received` float(10,2) DEFAULT NULL,
  `approved_in` float(10,2) DEFAULT NULL,
  `approved_out` float(10,2) DEFAULT NULL,
  `to_receive` float(10,2) DEFAULT NULL,
  `to_pay` float(10,2) DEFAULT NULL,
  `payed` float(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=345 ;

--
-- Дамп данных таблицы `ProjectPayments`
--

INSERT INTO `ProjectPayments` (`id`, `order_id`, `project_price`, `work_price`, `received`, `approved_in`, `approved_out`, `to_receive`, `to_pay`, `payed`) VALUES
(1, 1, 5000.00, 48000.00, 916992.00, NULL, NULL, 0.00, 20522.00, 925.00),
(98, 2, 10000.00, 2000.00, 1000.00, NULL, NULL, 0.00, 211.00, 10.00),
(111, 3, 14000.00, 4000.00, 7000.00, NULL, NULL, 0.00, 0.00, NULL),
(216, 4, 15000.00, 5000.00, 7500.00, NULL, NULL, 1.00, 0.00, NULL),
(344, 85, 56.00, NULL, 1.00, NULL, NULL, 1.00, -1.00, 1.00),
(343, 84, 10000.00, NULL, 10000.00, NULL, NULL, 0.00, 0.00, NULL),
(342, 82, 15000.00, 3000.00, 15000.00, NULL, NULL, 0.00, 3000.00, 3000.00),
(341, 81, 12000.00, NULL, 2500.00, NULL, NULL, 0.00, 0.00, NULL),
(340, 71, 30000.00, 555.00, 21000.00, NULL, NULL, 9000.00, 555.00, 555.00),
(339, 22, 10000.00, 5000.00, 0.00, NULL, NULL, 4002.00, 0.00, NULL),
(338, 32, 10000.00, NULL, 100.00, NULL, NULL, 0.00, 0.00, NULL),
(337, 68, 14000.00, 5000.00, 7000.00, NULL, NULL, 1.00, 0.00, 7000.00),
(336, 67, 50000.00, NULL, 25001.00, NULL, NULL, 0.00, 0.00, 25001.00),
(335, 66, 20000.00, 666.00, 10000.00, NULL, NULL, 0.00, 100.00, NULL),
(334, 65, 30000.00, 10000.00, 30000.00, NULL, NULL, 0.00, 10000.00, 10000.00),
(333, 64, 15000.00, 0.00, 7500.00, NULL, NULL, 0.00, 5.00, NULL),
(332, 63, 20000.00, 5000.00, 10000.00, NULL, NULL, 0.00, 946.00, 10101.00),
(331, 62, 777.00, NULL, 199.00, NULL, NULL, 21.00, 0.00, NULL),
(292, 6, 50000.00, NULL, 25000.00, NULL, NULL, 0.00, 0.00, NULL),
(293, 5, 1000.00, NULL, 500.00, NULL, NULL, 0.00, 0.00, NULL),
(294, 8, 53454.00, 5435345.00, 350345.00, NULL, NULL, 0.00, 0.00, NULL),
(295, 9, 20000.00, 4000.00, 10000.00, NULL, NULL, 0.00, 4000.00, NULL),
(297, 10, 15000.00, 6000.00, 7500.00, NULL, NULL, 33799.00, 2000.00, NULL),
(298, 11, NULL, NULL, 0.00, NULL, NULL, 0.00, 10.00, NULL),
(300, 7, NULL, NULL, 0.00, NULL, NULL, 0.00, 20.00, 30.00),
(301, 12, 15000.00, NULL, 0.00, NULL, NULL, 7500.00, 0.00, NULL),
(302, 13, 30000.00, NULL, 15000.00, NULL, NULL, 0.00, 5000.00, NULL),
(303, 15, 15000.00, NULL, 7500.00, NULL, NULL, 0.00, 0.00, NULL),
(304, 16, 20000.00, 5000.00, 10006.00, NULL, NULL, 1.00, 0.00, 1.00),
(305, 23, 14000.00, NULL, 0.00, NULL, NULL, 7000.00, 0.00, NULL),
(306, 46, 15000.00, 5000.00, 15000.00, NULL, NULL, 0.00, 5000.00, 15000.00),
(308, 47, 20000.00, NULL, 10000.00, NULL, NULL, 15000.00, 0.00, NULL),
(309, 48, 16000.00, 5000.00, 8000.00, NULL, NULL, 0.00, 0.00, 0.00),
(311, 49, 14000.00, 4000.00, 0.00, NULL, NULL, 0.00, 5000.00, 0.00),
(313, 51, 14000.00, NULL, 7000.00, NULL, NULL, 0.00, 0.00, NULL),
(314, 52, 20000.00, NULL, 10000.00, NULL, NULL, 0.00, 0.00, NULL),
(315, 53, 25000.00, NULL, 12500.00, NULL, NULL, 0.00, 0.00, NULL),
(317, 54, 20000.00, NULL, 10000.00, NULL, NULL, 0.00, 0.00, NULL),
(321, 61, 20000.00, 5000.00, 10000.00, NULL, NULL, 0.00, 0.00, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `Projects`
--

CREATE TABLE IF NOT EXISTS `Projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `user_id` int(11) unsigned NOT NULL COMMENT 'ID пользователя',
  `category_id` smallint(6) unsigned NOT NULL COMMENT 'ID категории',
  `job_id` tinyint(3) unsigned DEFAULT NULL COMMENT 'ID вида работ',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `text` text NOT NULL COMMENT 'Текст',
  `pages` varchar(30) DEFAULT NULL COMMENT 'Страниц',
  `add_demands` text COMMENT 'Доп. требования',
  `status` tinyint(4) DEFAULT '0' COMMENT 'Статус проекта',
  `executor` int(10) unsigned DEFAULT '0' COMMENT 'ID исполнителя',
  `notes` text NOT NULL COMMENT 'Заметки',
  `date` timestamp NULL DEFAULT NULL,
  `date_finish` timestamp NULL DEFAULT NULL,
  `max_exec_date` timestamp NULL DEFAULT NULL,
  `manager_informed` timestamp NULL DEFAULT NULL,
  `author_informed` timestamp NULL DEFAULT NULL,
  `author_notes` text,
  `user_notes` text,
  `user_notes_show` text,
  `time_for_call` varchar(255) DEFAULT NULL,
  `edu_dep` varchar(255) DEFAULT NULL,
  `payment_image` varchar(255) DEFAULT NULL,
  `old_status` tinyint(4) NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица для хранения проектов (заказов)' AUTO_INCREMENT=86 ;

--
-- Дамп данных таблицы `Projects`
--

INSERT INTO `Projects` (`id`, `user_id`, `category_id`, `job_id`, `title`, `text`, `pages`, `add_demands`, `status`, `executor`, `notes`, `date`, `date_finish`, `max_exec_date`, `manager_informed`, `author_informed`, `author_notes`, `user_notes`, `user_notes_show`, `time_for_call`, `edu_dep`, `payment_image`, `old_status`, `is_active`) VALUES
(1, 3, 2, NULL, 'Тестовый', 'Это тестовый заказик Вносим правки', '10', 'Нет', 4, 4, 'Заметка 1', '2015-06-01 01:00:00', '2015-06-07 01:00:00', '2015-06-08 01:00:10', '2015-06-01 01:00:10', '2015-06-07 01:00:10', 'Заметка 2', 'Здрасте нужны срочно источники. ', '0', NULL, NULL, NULL, 0, 1),
(2, 1, 3, 3, 'kj', 'jk', '0', 'kjk', 2, 4, '', '2015-06-02 01:00:00', '2015-06-08 01:00:00', '2015-06-09 01:00:00', '2015-06-02 01:00:00', '2015-06-07 01:00:00', '', '', '0', NULL, NULL, NULL, 0, 1),
(3, 11, 2, 2, 'Рефер', 'Реферест', '23', 'нет', 5, 14, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 18:22:31', '2015-06-20 18:22:31', '2015-06-20 18:22:31', 'test message', 'нет', '0', '', '', NULL, 0, 1),
(4, 3, 3, 2, '', '34343434', '3434', '434', 0, 0, 'jhg', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:40', '2015-06-20 01:00:40', '2015-06-16 01:00:12', '', '343434', NULL, NULL, NULL, NULL, 0, 1),
(5, 18, 9, 1, 'Исторические факторы, как цель исследования. ', '', '60', 'Оригинальность 70%+ \r\n3 Главы ', 3, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', NULL, '', NULL, NULL, NULL, NULL, 0, 1),
(6, 18, 4, 2, 'Предварительная подготовка к зимней спячке у медведей среднего возраста.', 'Ничего сложного. ', '60', '', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', '', '0', '', '', NULL, 0, 1),
(7, 19, 29, 2, 'Обычная простая работа', 'Всё просто', '50', 'Есть методичка. ', 5, 14, 'уеоа', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', '', '0', '15:00 и позже', 'МГИТУРКО', NULL, 0, 1),
(8, 3, 2, 1, 'test', 'test', NULL, '', 4, 24, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', 'test', '0', '', '', '9168bd4f0e6d11df3fc1d1fbb419b79a.jpeg', 0, 1),
(9, 19, 7, 2, 'Home work', 'Its my home work', '5', '', 4, 16, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', '', '0', '15:00', 'Hogvards', 'dac542abc06df773fef12d8cc64c5e96.png', 0, 1),
(10, 19, 0, 4, 'Подсчет средств в банках, посредством их траты.', 'Стандартный диплом. ', '65', 'Нету', 4, 0, '', '2015-06-12 14:39:22', '2015-06-12 14:39:22', '2015-06-11 01:00:00', '2015-06-11 01:00:00', '2015-06-25 01:00:00', 'Сделайте хорошо.', '', '0', '15-20', '', '11477d03cfb892b507f8f165fb57f5e4.jpg', 0, 1),
(11, 17, 28, 3, '321мпчттимт', '132миимтсимтимт', '6546', 'аиапапвттв', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', NULL, '', NULL, 'ичси', 'пвоапо', NULL, 0, 1),
(12, 19, 4, 4, 'Строение многоклеточной ткани', 'Оригинальность 80%', '80', 'нет', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', NULL, NULL, '', 'МГУ', NULL, 0, 1),
(13, 19, 165, 4, 'Основа тестирования админки.', 'Главный проверочный', '90', 'Стандарт', 5, 16, 'Зак оплатит завтра 20.03. ', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', NULL, NULL, '14:00 - 22:00', 'МГТИ', '89651aafce0528f245dedd1e0c547787.jpg', 0, 1),
(14, 1, 0, NULL, '', '', NULL, '', 1, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '', NULL, NULL, '', '', NULL, 0, 1),
(15, 22, 88, 16, 'Решение проблем лингвистических способностей у детей младше 14 лет.', 'Содержания прикреплено', '70', 'Нету', 5, 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', '2015-06-20 01:00:00', NULL, NULL, NULL, 'Любое', 'МГУСИ', NULL, 0, 1),
(16, 17, 45, 16, 'Налоги и их зависимость в странах Евросоюза', 'Стандарт диплом ', '80', 'Нет', 5, 14, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2015-06-19 01:00:00', '2015-06-19 01:00:00', '2015-06-19 01:00:00', NULL, NULL, NULL, '', 'МГУГУ', '5e6dc5e5dddf4ee0f0edbd5a7fba1a77.jpg', 0, 1),
(22, 22, 42, 16, 'Управление проектом нефити и газа', 'Стандарт', '60', 'Нету', 2, 0, '', '0000-00-00 00:00:00', NULL, '2015-06-15 01:00:00', NULL, NULL, NULL, NULL, NULL, '15', 'МИСТиК', NULL, 0, 1),
(23, 22, 42, 16, 'Диплом на тему иноваций в спорте', 'бла бла', '65', 'Нет', 2, 0, '654', '0000-00-00 00:00:00', NULL, '2015-07-16 01:00:00', '2015-06-16 01:00:00', '2015-06-16 01:00:00', '', NULL, NULL, '12', 'МИСТиК', NULL, 0, 1),
(27, 17, 0, NULL, '', '', NULL, '', 1, 0, '', '0000-00-00 00:00:00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, 0, 1),
(31, 17, 0, NULL, '', '', NULL, '', 1, 0, '', '0000-00-00 00:00:00', '2015-06-16 04:03:13', '2015-06-23 04:03:13', '2015-06-16 04:03:13', '2015-06-21 01:00:13', NULL, NULL, NULL, '', '', NULL, 0, 1),
(32, 22, 33, 16, '345345435345', '345345345435435', '60', 'fgfg', 2, 0, 'план одобрен 123', '0000-00-00 00:00:00', '2015-07-16 04:09:27', '2015-07-18 04:09:29', '2015-06-17 04:09:29', '2015-07-14 01:00:29', '678', NULL, NULL, '55', '55', NULL, 0, 1),
(33, 22, 36, 16, '34234234234234', '234234234', '44', '44', 1, 0, '', '0000-00-00 00:00:00', '2015-08-16 05:03:10', '2015-08-16 05:03:10', '2015-06-16 05:04:10', '2015-08-14 01:00:10', NULL, NULL, NULL, '44', '44', NULL, 0, 1),
(34, 22, 33, 16, 'Инвестиции', 'Инвестиции', '90', 'Инвестиции', 1, 0, '', '0000-00-00 00:00:00', '2015-08-16 05:06:52', '2015-08-16 05:06:52', '2015-06-16 05:06:52', '2015-08-14 01:00:52', NULL, NULL, NULL, 'Инвестиции', 'Инвестиции', NULL, 0, 1),
(45, 17, 0, NULL, '', '', NULL, '', 1, 0, '', '0000-00-00 00:00:00', '2015-06-16 07:24:18', '2015-06-23 07:24:18', '2015-06-16 07:24:18', '2015-06-19 07:24:18', NULL, NULL, NULL, '', '', NULL, 0, 1),
(46, 22, 45, 16, 'Налоговый оборот при смене политики в стране ', '', '70', 'стандарт', 4, 0, '17.06 - Внесет предоплату 18.06 в офисе.', '0000-00-00 00:00:00', '2015-07-20 14:16:15', '2015-07-20 14:16:48', '2015-06-18 18:40:48', '2015-07-01 14:18:48', '', NULL, NULL, '', '', '59d138d5ad7598b33528d5fb0ff92125.jpg', 0, 1),
(47, 22, 40, 16, 'Маркетинг и его роль в жизни продавцов консультантов', 'Бла бла', '70', 'нет', 4, 14, '19.06 - Оплатит 20.06 на банк', '0000-00-00 00:00:00', '2015-08-20 20:11:16', '2015-07-20 20:11:42', '2015-06-19 20:12:42', '2015-07-03 20:12:42', '', NULL, NULL, '15 до 20', '', 'fef784396171fc3ea10fe572f792db5e.jpg', 0, 1),
(48, 22, 38, 16, 'Логистика в мире', '', '70', 'нет', 4, 14, '456', '0000-00-00 00:00:00', '2015-08-26 00:55:00', '2015-08-21 00:55:55', '2015-06-22 01:16:55', '2015-07-20 01:16:55', '', NULL, NULL, '', '', '63a52634e2f6c9a98fe0b1e23d864783.jpg', 0, 1),
(49, 22, 42, 16, 'Диплом по менеджементу', 'Глава 1\r\nГлава 2\r\nГлава 3', '70', 'нет', 4, 14, '22.06 - Внесет предоплату сегодня (22.06)', '0000-00-00 00:00:00', '2015-07-22 10:10:52', '2015-07-22 10:10:20', '2015-06-22 10:17:33', '2015-07-22 10:17:33', '', NULL, NULL, '18', 'МИМИ', '46ecaeb7500d329ddff68e62e91cd244.jpg', 0, 1),
(51, 22, 160, 15, 'Станочные установки МЕ-56 ', '', '70', 'Нет', 3, 0, '26.06 - Оплатит в офисе завтра', '0000-00-00 00:00:00', '2015-07-26 13:47:03', '2015-07-28 13:47:52', '2015-08-03 13:48:52', '2015-07-12 13:48:52', '', NULL, NULL, '22', '', 'aa0ae30f03e79c8ae0337773f2d962ae.jpg', 0, 1),
(52, 22, 45, 9, 'Налогообложение и степень налогов в зависимости от ситуации', '', '70', 'нет', 2, 0, '', '0000-00-00 00:00:00', '2015-08-05 19:09:32', '2015-07-30 19:09:34', '2015-07-01 19:11:34', '2015-07-15 19:11:34', NULL, NULL, NULL, '18', 'МИА', NULL, 0, 1),
(53, 22, 51, 16, 'Реклама образовательных учреждений', '3 Главы', '75', '1 глава до 12.07', 4, 14, '03.07 - Завтра внесет предоплату.', '0000-00-00 00:00:00', '2015-08-20 12:16:29', '2015-08-08 12:16:12', '2015-07-03 12:19:12', '2015-07-20 12:19:12', 'Заказ крайне важный, отнеситесь внимательно!', NULL, NULL, '18:00', '', 'f5df5f5c349f3888b3003a12cd0a5e66.jpg', 0, 1),
(54, 22, 42, 16, 'Ритка улитка', 'Ритка улитка обыкновенная ', '73', 'Список использованной литературы', 5, 14, 'Оплата внесена', '0000-00-00 00:00:00', '2015-07-07 01:00:00', '2035-07-08 01:00:08', '2015-07-08 21:53:08', '2025-07-08 01:00:00', '', NULL, NULL, 'Только после 2:00', 'КНЭУ', 'bb44f79d043fad02159ad448b2d59300.jpg', 0, 1),
(55, 0, 4, NULL, '', '', NULL, '', 5, 0, '', '2015-07-10 17:49:09', NULL, '2015-08-10 17:41:34', '2015-07-19 17:49:34', '2015-07-29 17:49:34', NULL, NULL, NULL, '', '', NULL, 0, 1),
(60, 17, 38, 16, 'Пвапвпа', '', '66', '', 1, 0, '', '2015-07-10 19:50:31', '2015-07-24 19:50:31', '2015-07-10 19:50:31', '2015-07-10 19:50:31', '2015-07-10 19:50:31', NULL, NULL, NULL, '88', '', NULL, 0, 1),
(61, 22, 38, 16, 'Самый дипломный диплом', '', '50', '', 4, 14, '10.07 - Внесет оплату завтра 11.07', '2015-07-10 20:11:44', '2015-07-25 20:10:44', '2015-07-24 20:10:19', '2015-07-14 20:11:19', '2015-07-16 20:11:19', '', NULL, NULL, '22', 'МПИ', '8ff6485909b079eb01ff23f885ad286e.jpg', 0, 1),
(62, 17, 33, 19, 'Аудит инвестиционных процессов', 'Описание заказа аудита инвестиционных процессов', '3', 'Дополнительные требования к заказу инвестиционных процессов', 3, 14, '', '2015-07-11 15:01:01', '2015-08-01 14:57:01', '2015-07-31 14:57:01', '2015-07-11 15:01:01', '2015-07-20 15:01:01', NULL, NULL, NULL, '20:00', 'ВУЗ', 'e7a7e6aff19cb6e7897cfd731d65fb66.jpg', 0, 1),
(63, 22, 40, 16, 'Маркетинг в сфере услуг', 'Стандарт', '60', 'нет', 4, 14, '14.07 - Внесет предоплату завтра 15.07', '2015-07-14 19:29:36', '2015-07-31 19:29:36', '2015-07-30 19:29:25', '2015-07-15 19:29:25', '2015-07-21 19:29:25', '', NULL, NULL, '12-22', 'МИС', 'c51f3c90ee9f9f9bcb5e429b7a3df5e7.jpg', 0, 1),
(64, 22, 42, 16, 'Тестирование подходит к концу', 'Я так думаю', '70', 'Нет', 4, 14, '18.07 - Оплатит завтра 19.07 на ВМ', '2015-07-18 13:33:22', '2015-07-31 13:31:22', '2015-07-30 13:31:22', '2015-07-18 13:33:22', '2015-07-23 13:33:22', '', NULL, NULL, '22', 'пп', NULL, 0, 1),
(65, 23, 166, 15, 'Коленчатый вал автомобиля Зил130', '4-5 чертежей А1', '80', 'Оригинальность ', 5, 24, 'Внесет предоплату в фоисе седня', '2015-07-20 12:39:09', '2015-08-25 12:32:09', '2015-08-20 12:32:15', '2015-07-22 12:39:15', '2015-08-04 12:39:15', '', NULL, NULL, 'любое', 'САТТ', NULL, 0, 1),
(66, 23, 42, 16, 'Управление персоналом в условиях конкурентной среды', '3 главы', '80-100', 'Оригинальность 80% +', 5, 0, '23.07 - Оплатит завтра 2', '2015-07-23 13:25:03', '2015-08-30 13:20:03', '2015-08-25 13:20:04', '2015-07-24 13:25:04', '2015-08-08 13:25:04', NULL, NULL, NULL, '22', 'АПП', NULL, 0, 1),
(67, 23, 45, 16, 'Налоговые обложения как метод борьбы с коррупцией.', '3 Главы ', '60-80', 'Стандарт', 5, 0, '31.07 - Внесет предоплату завтра 1.08', '2015-07-31 18:17:07', '2015-10-01 18:15:07', '2015-09-20 18:15:15', '2015-08-01 00:00:00', '2015-08-25 18:17:15', NULL, NULL, NULL, '', '', NULL, 0, 1),
(68, 23, 35, 15, 'Историчские факт', '1 Глава Виды экономических исследований\r\n2 ', '60', 'пкемеенме', 4, 14, '03.08 - Оплатил в офисе 7000\r\n02.08 - Внесет завтра 03.08 в офисе.', '2015-08-27 14:06:46', '2015-08-30 14:05:46', '2015-08-28 14:05:05', '2015-08-06 14:06:05', '2015-08-14 14:06:05', '', NULL, NULL, '55', '59789', NULL, 0, 1),
(69, 22, 42, 16, 'бла бла бла', 'очень важно', '12', '', 1, 0, '', '2015-08-03 18:02:01', NULL, '2015-08-20 12:00:19', '2015-08-03 18:02:19', '2015-08-11 18:02:19', NULL, NULL, NULL, '', '', NULL, 0, 1),
(70, 22, 38, 12, 'выбор места проживания', '', '', '', 1, 0, '', '2015-08-03 18:07:38', NULL, '2015-08-31 18:04:32', '2015-08-03 18:07:32', '2015-08-16 18:07:32', '', NULL, NULL, '', '', NULL, 0, 1),
(71, 23, 59, 16, 'Система по сокращению рабоыт менджеров в 5 раз', '', '100', 'Презентация + Речь', 4, 14, '', '2015-08-04 01:09:16', '2015-08-28 01:08:16', '2015-08-04 01:08:30', '2015-08-04 01:09:51', '2015-08-15 01:09:51', NULL, NULL, NULL, '22-23', 'МЫС КИРОВ', 'b5042e6bce98ece3e8bd1857627f797b.JPG', 0, 1),
(81, 22, 41, 7, '1234567', '', '30', '', 4, 0, '', '2015-08-04 18:03:43', '2015-08-30 18:03:43', '2015-08-30 18:03:17', '2015-08-04 18:03:17', '2015-08-15 18:03:17', NULL, NULL, NULL, '', '', NULL, 0, 1),
(82, 23, 33, 16, 'Сбор инвестиций на админку', 'Презентация\r\nЛендинг\r\n', '50', 'Нет', 4, 24, '05.08 - Оплатит завтра 06.08', '2015-08-05 02:45:59', '2015-08-22 02:44:59', '2015-08-22 02:44:49', '2015-08-13 02:45:49', '2015-08-12 02:45:49', 'Работа очень важна, сделать качественно! ', NULL, NULL, '23', '', NULL, 0, 1),
(84, 23, 33, 5, 'Тестовый Тестовый Тестовый Тестовый Тестовый ', 'Тестовый Тестовый Тестовый Тестовый Тестовый Тестовый ', 'Тестовый', 'Тестовый', 3, 0, 'Заметки для менеджеров. \nО нестандартных ситуациях в заказе.', '2015-08-08 16:51:05', '2015-08-22 16:50:05', '2015-08-23 16:50:46', '2015-08-08 16:51:46', '2015-08-14 16:51:46', 'Заметки для исполнителей, например о качестве выполнения работы и т.п.', NULL, NULL, 'Тестовый', 'Тестовый', NULL, 0, 1),
(85, 23, 133, 3, 'Написать тексты для сайта', '', '5', '', 3, 0, '', '2015-08-13 17:18:08', '2015-08-28 17:17:08', '2015-08-28 17:17:08', '2015-08-13 17:18:08', '2015-08-20 17:18:08', NULL, NULL, NULL, '', '', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectsEvents`
--

CREATE TABLE IF NOT EXISTS `ProjectsEvents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  `description` text,
  `timestamp` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Дамп данных таблицы `ProjectsEvents`
--

INSERT INTO `ProjectsEvents` (`id`, `type`, `event_id`, `description`, `timestamp`, `status`) VALUES
(36, '3', 84, 'Пользователь admin прикрепил замечания', 1439731291, 0),
(37, '5', 84, 'Пользователь zak4test оставил сообщение: "Здравствуйте"', 1439731907, 0),
(31, '5', 85, 'Пользователь zak4test оставил сообщение: "Здравствуйте, оплатил."', 1439472981, 0),
(32, '5', 8, 'Пользователь autobot оставил сообщение: "Здравствуйте."', 1439473604, 0),
(33, '5', 8, 'Пользователь autobot оставил сообщение: "Готов выполнить"', 1439473612, 0),
(34, '3', 85, 'Пользователь zak4test прикрепил замечания', 1439473805, 0),
(38, '7', 84, 'Пользователь zak4test загрузил чек', 1439732085, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectsParts`
--

CREATE TABLE IF NOT EXISTS `ProjectsParts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `proj_id` int(11) unsigned NOT NULL COMMENT 'ID проекта',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `file` varchar(255) DEFAULT NULL COMMENT 'Вложенный файл',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `show` tinyint(1) DEFAULT '0',
  `author_id` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Дополнительные части (этапы) проекта' AUTO_INCREMENT=99 ;

--
-- Дамп данных таблицы `ProjectsParts`
--

INSERT INTO `ProjectsParts` (`id`, `proj_id`, `title`, `file`, `date`, `payment`, `comment`, `show`, `author_id`) VALUES
(15, 4, '1 Глава ', NULL, '0000-00-00 00:00:00', NULL, NULL, 1, NULL),
(18, 7, 'пнор', NULL, '0000-00-00 00:00:00', NULL, '', 1, '14'),
(20, 1, 'Rjfgdfgdfg', NULL, '0000-00-00 00:00:00', NULL, '', 0, '0'),
(21, 9, 'План работы', NULL, '2015-02-20 01:00:00', NULL, 'Ждем план', 0, '16'),
(22, 10, 'План работы', NULL, '2015-03-20 01:00:00', NULL, 'Ждем план 42342\n', 1, '16'),
(23, 7, 'test', NULL, '0000-00-00 00:00:00', NULL, '', 1, '14'),
(27, 13, '1 Главаrthstrhtrh', NULL, '2015-03-30 01:00:00', NULL, '', 0, '16'),
(31, 5, 'Новая Часть', NULL, '2015-06-19 07:25:38', NULL, 'Сделать быстро зак спешит', 0, '16'),
(33, 10, 'Новая 44', NULL, '2015-06-07 19:22:00', NULL, 'апрпврапр', 0, '14'),
(34, 11, 'Нормальное наз', NULL, '2015-06-09 19:20:15', NULL, 'Еще один проверочный', 0, NULL),
(35, 5, 'Новая Часть', NULL, '2015-06-09 19:56:56', NULL, NULL, 0, '16'),
(37, 10, 'Новая Часть', NULL, '2015-06-09 20:37:24', NULL, NULL, 0, '14'),
(39, 16, 'План', NULL, '2015-06-25 06:16:32', NULL, 'Ждем план работы.', 0, '14'),
(40, 16, 'Новая Часть', NULL, '2015-06-17 06:16:40', NULL, NULL, 0, '14'),
(41, 1, 'Новая Часть', NULL, '2015-06-14 23:47:42', NULL, NULL, 0, '4'),
(42, 1, 'Новая Часть', NULL, '2015-06-14 23:47:58', NULL, NULL, 0, '4'),
(43, 23, 'Новая Часть', NULL, '2015-06-15 23:46:02', NULL, 'Комментарии добавляются', 0, NULL),
(44, 46, 'План', NULL, '2015-06-20 14:45:39', NULL, NULL, 0, NULL),
(46, 13, 'Новая Часть', NULL, '2015-06-19 22:05:11', NULL, 'vfdfvdfvsdfvdfsv', 0, '16'),
(48, 3, 'Новая Часть', NULL, '2015-06-19 23:22:43', NULL, NULL, 0, '14'),
(49, 3, 'Новая Часть', NULL, '2015-06-19 23:23:05', NULL, NULL, 0, '14'),
(50, 49, 'План работы', NULL, '2015-06-25 11:08:14', NULL, 'План из 3-глав', 0, '14'),
(52, 51, 'План работы', NULL, '2015-07-08 19:41:27', NULL, NULL, 0, '0'),
(53, 53, 'План работы', NULL, '2015-07-07 10:41:35', NULL, 'План из 3-х глав', 0, '0'),
(54, 54, 'План', NULL, '2015-07-22 22:56:38', NULL, NULL, 0, '14'),
(58, 54, '1 Глава ', NULL, '2015-08-12 23:05:07', NULL, NULL, 0, '14'),
(59, 54, '2 Глава ', NULL, '2015-08-26 23:06:50', NULL, NULL, 0, '14'),
(61, 61, 'План работы 2', NULL, '2015-07-12 21:02:36', NULL, 'gtr', 0, '14'),
(62, 61, 'Глава 1', NULL, '2015-07-15 21:02:47', NULL, NULL, 0, '14'),
(63, 61, 'Вся работа', NULL, '2015-07-16 21:02:07', NULL, NULL, 0, '14'),
(65, 63, 'План работы', NULL, '2015-07-18 17:37:05', NULL, 'sdfsdfsdfdf', 0, '14'),
(66, 64, 'План ', NULL, '2015-07-18 14:23:47', NULL, NULL, 0, '0'),
(67, 64, '1 Глава', NULL, '2015-07-20 15:39:06', NULL, 'Ква-ква!', 0, '14'),
(68, 65, 'План работы', NULL, '2015-07-21 14:23:53', NULL, 'План из 5 глав.', 0, '24'),
(69, 65, '1 Глава', NULL, '2015-07-24 14:24:29', NULL, NULL, 0, '24'),
(70, 65, '2 Глава ', NULL, '2015-07-27 14:26:54', NULL, NULL, 0, '24'),
(71, 65, '3 Глава', NULL, '2015-07-30 14:26:46', NULL, NULL, 0, '24'),
(72, 66, 'План', NULL, '2015-07-25 13:36:41', NULL, 'План из 3-х глав', 0, '0'),
(73, 62, 'Новая Часть', NULL, '2015-07-29 11:43:59', NULL, NULL, 0, '14'),
(74, 68, 'План работы', NULL, '2015-08-05 14:32:42', NULL, NULL, 0, '14'),
(75, 68, '1 Глава', NULL, '2015-08-08 14:32:09', NULL, NULL, 0, '14'),
(76, 68, '2 Глава', NULL, '2015-08-11 14:33:23', NULL, NULL, 0, '14'),
(77, 68, '3 Глава', NULL, '2015-08-14 14:33:09', NULL, NULL, 0, '14'),
(78, 10, 'Новая Часть', NULL, '2015-08-02 17:36:04', NULL, NULL, 0, '0'),
(79, 2, 'Новая Часть', NULL, '2015-08-02 17:48:15', NULL, NULL, 0, '4'),
(80, 32, 'Новая Часть', NULL, '2015-08-02 17:56:39', NULL, NULL, 0, '0'),
(88, 15, 'Работа', NULL, '2015-08-03 17:10:56', NULL, NULL, 0, '0'),
(89, 51, 'Новая Часть', NULL, '2015-08-03 17:33:16', NULL, NULL, 0, '0'),
(90, 51, 'Новая Часть', NULL, '2015-08-03 17:33:22', NULL, NULL, 0, '0'),
(91, 70, 'Новая Часть', NULL, '2015-08-09 18:09:08', NULL, NULL, 0, '0'),
(92, 70, 'Новая Часть', NULL, '2015-08-03 18:09:59', NULL, NULL, 0, '0'),
(93, 71, 'План работы', NULL, '2015-08-05 02:43:30', NULL, NULL, 0, '14'),
(94, 71, '1 Глава', NULL, '2015-08-10 02:43:55', NULL, 'Раз роах', 0, '14'),
(95, 82, 'Вся работа', NULL, '2015-08-12 03:18:34', NULL, NULL, 0, '24'),
(96, 82, 'Корректировки работы', NULL, '2015-08-14 03:26:27', NULL, 'Исправить все замечания в блоке доработки', 0, '24'),
(97, 8, '1-я Часть', NULL, '2015-08-13 17:51:19', NULL, NULL, 0, '24'),
(98, 84, '1-я глава', NULL, '2015-08-22 17:20:25', NULL, NULL, 0, '0');

-- --------------------------------------------------------

--
-- Структура таблицы `ProjectStatus`
--

CREATE TABLE IF NOT EXISTS `ProjectStatus` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `status` varchar(255) NOT NULL COMMENT 'Наименование статуса',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Справочник статусов проектов' AUTO_INCREMENT=6 ;

--
-- Дамп данных таблицы `ProjectStatus`
--

INSERT INTO `ProjectStatus` (`id`, `status`) VALUES
(1, 'Новый заказ'),
(2, 'Ждем решен. клиента'),
(3, 'Поиск Автора'),
(4, 'Автор работает'),
(5, 'Завершен');

-- --------------------------------------------------------

--
-- Структура таблицы `raboti`
--

CREATE TABLE IF NOT EXISTS `raboti` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) COLLATE utf8_bin NOT NULL,
  `cat` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=191 ;

--
-- Дамп данных таблицы `raboti`
--

INSERT INTO `raboti` (`id`, `title`, `cat`) VALUES
(4, 'Экономические дисциплины', 0),
(26, 'АХД, экпред, финансы', 4),
(27, 'Банковское дело', 4),
(28, 'Бизнес-план', 4),
(29, 'Бухучет, управленч.учет', 4),
(30, 'Госслужба---', 4),
(31, 'Делопроизводство', 4),
(32, 'Дистанционное образование', 4),
(33, 'Инвестиции', 4),
(34, 'Инновационный менеджмент', 4),
(35, 'История экономики, эк-ских учений', 4),
(36, 'Качество, упр-е качеством', 4),
(37, 'Коммерческое дело, торговля', 4),
(38, 'Логистика', 4),
(39, 'Макроэкономика', 4),
(40, 'Маркетинг', 4),
(41, 'Матметоды в эк-ке', 4),
(42, 'Менеджмент', 4),
(43, 'Микроэкономика', 4),
(44, 'Мировая экономика, МЭО', 4),
(45, 'Налоги', 4),
(46, 'Недвижимость, оценка', 4),
(47, 'Планирование, прогнозирование', 4),
(48, 'Потребкооперация', 4),
(49, 'Предпринимательство', 4),
(50, 'Региональная экономика', 4),
(51, 'Реклама и PR', 4),
(52, 'РЦБ, ценные бумаги', 4),
(53, 'Сельское хозяйство', 4),
(54, 'Статистика', 4),
(55, 'Стратегический менеджмент', 4),
(56, 'Страхование', 4),
(57, 'Строительство', 4),
(58, 'Туризм', 4),
(59, 'Управление персоналом', 4),
(60, 'Финансы, деньги, кредит', 4),
(61, 'Ценообразование', 4),
(62, 'Эконометрика', 4),
(63, 'Экономика отраслей', 4),
(64, 'Эктеория', 4),
(65, 'Финансовый менеджмент, финансовая математика', 4),
(66, 'Товароведение', 4),
(67, 'Ресторанно-гостиничный бизнес, бытовое обслуживан.', 4),
(68, 'Теория организации', 4),
(69, 'Внешнеэкономическая деятельность', 4),
(70, 'Управление проектами', 4),
(71, 'Гуманитарные', 0),
(73, 'Английский', 71),
(74, 'Немецкий', 71),
(75, 'Французский', 71),
(76, 'История', 71),
(77, 'Культурология', 71),
(78, 'Литература', 71),
(79, 'Педагогика', 71),
(80, 'Политология', 71),
(81, 'Психология', 71),
(82, 'Социология', 71),
(83, 'Философия', 71),
(84, 'Этика, эстетика', 71),
(85, 'Журналистика', 71),
(86, 'Русский язык культура речи', 71),
(87, 'Лингвистика', 71),
(88, 'Филология', 71),
(89, 'Юридические', 0),
(90, 'Административное право', 89),
(91, 'Арбитражный процесс', 89),
(92, 'Гражданский процесс', 89),
(93, 'Гражданское право', 89),
(94, 'Земельное право', 89),
(95, 'ИГП', 89),
(96, 'Конституционное право', 89),
(97, 'Криминалистика', 89),
(98, 'Логика', 89),
(99, 'Международное право', 89),
(100, 'Муниципальное право', 89),
(101, 'Основы права', 89),
(102, 'Правоохранительные органы', 89),
(103, 'Римское право', 89),
(104, 'Семейное право', 89),
(105, 'Соцобеспечение', 89),
(106, 'Страховое право', 89),
(107, 'Судебная медицина', 89),
(108, 'Судебная психиатрия', 89),
(109, 'Судебная статистика', 89),
(110, 'Таможенное право', 89),
(111, 'ТГП', 89),
(112, 'Трудовое право', 89),
(113, 'Уголовное право', 89),
(114, 'Уголовный процесс', 89),
(115, 'УИП', 89),
(116, 'Экологическое право', 89),
(117, 'Юрид.психология', 89),
(118, 'Криминология', 89),
(119, 'Акционерное право', 89),
(120, 'Жилищное право', 89),
(121, 'Налоговое право', 89),
(122, 'Финансовое право', 89),
(123, 'Cудебная бухгалтерия', 89),
(124, 'Естественно-научные', 0),
(125, 'Биология', 124),
(126, 'География, экономическая география', 124),
(127, 'КСЕ', 124),
(128, 'Математика', 124),
(129, 'Медицина, физкультура, здравоохранение', 124),
(130, 'Физика', 124),
(131, 'Химия', 124),
(132, 'Экология', 124),
(133, 'Другое', 124),
(134, 'Теория вероятностей', 124),
(135, 'Технические', 0),
(136, 'Авиация и космонавтика', 135),
(137, 'Автомобильное хозяйство', 135),
(138, 'Автотранспорт', 135),
(139, 'Архитектура', 135),
(140, 'Безопасность жизнедеятельности', 135),
(141, 'Вентиляция и отопление', 135),
(142, 'Водоснабжение и водоотведение', 135),
(143, 'Военная кафедра', 135),
(144, 'Геодезия', 135),
(145, 'Геология', 135),
(146, 'Гидравлика', 135),
(147, 'Детали машин', 135),
(148, 'Инженерная графика', 135),
(149, 'Информатика, ВТ, телекоммуникации', 135),
(150, 'Информационная безопасность', 135),
(151, 'Информационное обеспечение, программирование', 135),
(152, 'Информационные технологии', 135),
(153, 'История техники', 135),
(154, 'Материаловедение', 135),
(155, 'Метрология', 135),
(156, 'Радиоэлектроника', 135),
(157, 'Режущий инструмент', 135),
(158, 'САПР', 135),
(159, 'Сопромат', 135),
(160, 'Станки', 135),
(161, 'Схемотехника', 135),
(162, 'ТАУ', 135),
(163, 'Теоретическая механика', 135),
(164, 'Теория резания', 135),
(165, 'Теплотехника', 135),
(166, 'Технология машиностроения', 135),
(167, 'ТММ', 135),
(168, 'ТОЭ', 135),
(169, 'Транспорт, грузоперевозки', 135),
(170, 'Чертежи', 135),
(171, 'Электротехника', 135),
(189, 'Аудит', 4),
(190, 'Антикризисный менеджмент', 4);

-- --------------------------------------------------------

--
-- Структура таблицы `Rights`
--

CREATE TABLE IF NOT EXISTS `Rights` (
  `itemname` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `weight` int(11) NOT NULL,
  PRIMARY KEY (`itemname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `Rights`
--


-- --------------------------------------------------------

--
-- Структура таблицы `tbl_migration`
--

CREATE TABLE IF NOT EXISTS `tbl_migration` (
  `version` varchar(255) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tbl_migration`
--

INSERT INTO `tbl_migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1418559910),
('m141212_144500_add_chat_author_cost', 1418559913),
('m141217_230916_change_table_for_zakazparts', 1418996432),
('m141219_101325_add_changes', 1418996432),
('m141219_203355_create_payment_system', 1419030810),
('m141223_101610_addPaymentSystemToOrders', 1419341743),
('m141225_231021_files_to_zakazParts', 1419556919),
('m150103_183620_change_timestamp_type', 1420409549),
('m150108_091546_create_orders_moderation_table', 1420770049),
('m150211_121753_update_profile', 1423665134),
('m150212_093451_mod_projects', 1423754426),
('m150217_152100_add_two_column_to_zakaz', 1424351176),
('m150219_001906_add_rating_field_in_table_profiles', 1424351177),
('m150218_192633_update_table_projects', 1424352014),
('m150220_173850_update_profile', 1424539624),
('m150227_160214_delete_column_table_project', 1425056064);

-- --------------------------------------------------------

--
-- Структура таблицы `Templates`
--

CREATE TABLE IF NOT EXISTS `Templates` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Индекс',
  `name` varchar(255) NOT NULL COMMENT 'Переменная',
  `title` varchar(255) NOT NULL COMMENT 'Наименование',
  `text` text NOT NULL COMMENT 'Текст шаблона',
  `type_id` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Тип сообщения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Шаблоны ответов в сообщениях' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `Templates`
--

INSERT INTO `Templates` (`id`, `name`, `title`, `text`, `type_id`) VALUES
(1, 'Шаблон ', 'Оплата автору', 'Оплатили Вам', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `UpdateProfile`
--

CREATE TABLE IF NOT EXISTS `UpdateProfile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL COMMENT 'Пользователь',
  `attribute` varchar(255) NOT NULL COMMENT 'Атрибут',
  `from_data` text COMMENT 'Старое значение',
  `to_data` text COMMENT 'Новое значение',
  `status` tinyint(1) DEFAULT NULL COMMENT 'Статус',
  `date_update` int(11) NOT NULL COMMENT 'Дата изменения',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `UpdateProfile`
--

INSERT INTO `UpdateProfile` (`id`, `user`, `attribute`, `from_data`, `to_data`, `status`, `date_update`) VALUES
(1, 3, 'lastname', 'Customer', 'Customer1', 0, 1424592516),
(2, 3, 'mailing_list', '0', 'icq', 1, 1424592321),
(3, 3, 'lastname', 'Customer', 'Customer2', 0, 1424594472),
(4, 3, 'mailing_list', '0', 'icq', 1, 1424592496),
(5, 19, 'mob_tel', '+7-777-7777777', '+7-777-0000000', 1, 1425114325),
(6, 19, 'mailing_list', '0', 'icq', 1, 1425094686),
(7, 3, 'lastname', 'Customer', 'Customer2', 1, 1425129418),
(8, 3, 'firstname', 'Customer', 'Customer3', 1, 1425129417),
(9, 3, 'mailing_list', '0', 'icq', 1, 1425129410),
(10, 3, 'lastname', 'Customer2', 'Customer', 1, 1425129477),
(11, 3, 'firstname', 'Customer3', 'Customer', 1, 1425129478),
(12, 3, 'mailing_list', '0', 'icq', 1, 1425129481),
(13, 19, 'mob_tel', '+7-777-0000000', '+7-777-7777777', 1, 1425256853),
(14, 19, 'mailing_list', '0', 'icq', 0, 1425256863),
(15, 19, 'mailing_list', '0', 'email', 1, 1425256950),
(16, 16, 'lastname', 'Авторов', 'Автор', 1, 1425257734),
(17, 16, 'firstname', 'Сухой', 'Главный', 1, 1425257736),
(18, 16, 'mailing_list', '0', 'icq', 1, 1425257724),
(19, 16, 'how_hear', 'мама сказала', 'по телевизору', 1, 1425257721),
(20, 17, 'lastname', 'Аверьянов', 'Аверьянов1', 0, 1425349528),
(21, 17, 'firstname', 'Дмитрий', 'Дмитрий1', 1, 1425349527),
(22, 17, 'mailing_list', '0', 'icq', 1, 1425349519),
(23, 17, 'firstname', 'Дмитрий1', 'Дмитрий', 1, 1425349610),
(24, 17, 'mailing_list', '0', 'icq', 1, 1425349595),
(25, 17, 'lastname', 'Аверьянов', 'Аверьянов0', 1, 1425349672),
(26, 17, 'firstname', 'Дмитрий', 'Дмитрий0', 1, 1425349671),
(27, 17, 'mailing_list', '0', 'icq', 1, 1425349667),
(28, 17, 'lastname', 'Аверьянов0', 'Аверьянов', 1, 1425349754),
(29, 17, 'firstname', 'Дмитрий0', 'Дмитрий', 1, 1425349754),
(30, 17, 'mailing_list', '0', 'icq', 1, 1425349755),
(31, 19, 'mob_tel', '+7-777-7777777', '+7-000-000-00-0', 1, 1426770256),
(32, 19, 'mailing_list', '0', 'icq', 0, 1426770310),
(33, 14, 'lastname', 'Аверьянов', 'avtor', 1, 1434644571),
(34, 14, 'firstname', 'Дмитрий', 'test', 1, 1434644570),
(35, 17, 'lastname', 'Аверьянов', 'zakaz', 1, 1434644557),
(36, 17, 'firstname', 'Дмитрий', 'test', 1, 1434644560),
(37, 23, 'mob_tel', '+7-978-7540970', '+7-978-7540972', 1, 1438635421),
(38, 23, 'mob_tel', '+7-978-7540972', '+7-978-7540970', 1, 1438635446),
(39, 23, 'lastname', 'Голодрыга', 'Николай', 1, 1439039012),
(40, 23, 'firstname', 'Артур', 'Гаврилов', 1, 1439039013),
(41, 23, 'mob_tel', '+7-978-7540970', '+7-978-*******', 1, 1439471764),
(42, 23, 'skype', 'sheva1*72', 'sheva1**2', 1, 1439471765),
(43, 23, 'city', 'Симферополь', 'Москва', 1, 1439471766),
(44, 23, 'how_hear', 'От Димы прогера', 'С сайта', 1, 1439471767),
(45, 14, 'mob_tel', '+7-000-0000000', '+7-978-0116403', 1, 1439882066),
(46, 14, 'mob_tel', '+7-000-0000000', '+7-978-0116403', 1, 1439882064);

-- --------------------------------------------------------

--
-- Структура таблицы `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `username` varchar(20) DEFAULT NULL COMMENT 'Логин',
  `password` varchar(128) NOT NULL COMMENT 'Пароль',
  `email` varchar(128) NOT NULL COMMENT 'Email',
  `activkey` varchar(128) NOT NULL DEFAULT '' COMMENT 'Ключ активации',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Создан',
  `lastvisit_at` timestamp NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Последний визит',
  `superuser` int(1) NOT NULL DEFAULT '0' COMMENT 'Суперадмин',
  `status` int(1) unsigned NOT NULL DEFAULT '0' COMMENT 'Статус (1 - активен, 0 - нет)',
  `identity` varchar(255) NOT NULL,
  `network` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `phone_number` varchar(22) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `status` (`status`),
  KEY `superuser` (`superuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей' AUTO_INCREMENT=124 ;

--
-- Дамп данных таблицы `Users`
--

INSERT INTO `Users` (`id`, `username`, `password`, `email`, `activkey`, `create_at`, `lastvisit_at`, `superuser`, `status`, `identity`, `network`, `full_name`, `state`, `phone_number`) VALUES
(1, 'admin', '8394c97731e0b8e877d10aadaa90a238', 'webmaster@example.com', '5851dad0a2440b787819a8d3ef18e197', '2014-11-16 10:19:59', '2015-09-05 15:48:58', 1, 1, '', '', '', 0, ''),
(2, 'manager', '1d0258c2440a8d19e716292b231e3190', 'demo@example.com', '75a4545eff36b65386935e294c71e5cc', '2014-11-16 10:19:59', '2015-09-05 01:03:12', 0, 1, '', '', '', 0, ''),
(3, 'customer', '91ec1f9324753048c0096d036a694f86', 'customer@dipstart.ru', '456fdaa956f22c6d9c127cee18def17d', '2014-11-28 16:48:18', '2015-09-04 18:36:00', 0, 1, '', '', '', 0, ''),
(4, 'author', '02bd92faa38aaa6cc0ea75e59937a1ef', 'author@dipstart.ru', '7616c7b3d9e8fa3ad62b342734b15737', '2014-11-28 16:48:46', '2015-09-04 18:35:47', 0, 1, '', '', '', 0, ''),
(11, 'artur', 'c9b5ecdf0b853aab02103542187ea208', 'dipstartru@mail.ru', '7080f5e4304c2168c7d304038e1034f6', '2015-01-18 00:10:29', '2015-02-11 17:52:47', 0, 1, '', '', '', 0, ''),
(12, 'zakaz', '7336437ab65c148e9e582430565f6d09', 'coolfirework@yandex.ru', '795ec57eeef07e2d4d9ab5f27ec78553', '2015-01-18 19:42:17', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(14, 'testavtor', 'c47031d6e0d8ca5d6863a7be9c8c37c3', 'coolfire@inbox.ru', '09f9f88187088c41f5d3732a9ce8b1bc', '2015-01-21 22:53:09', '2015-09-04 16:03:54', 0, 1, '', '', '', 0, ''),
(15, 'avtor', '5a1470d0e76c83b1d6093701819b7494', 'work4home4you@gmail.com', '697375dff4448eb8582d9d67228b6015', '2015-01-25 19:02:01', '2015-08-20 12:36:41', 0, 1, '', '', '', 0, ''),
(16, 'avtor2', '28d4b33e28a5b3fdac7d78acd73c5408', 'twin.ua@mail.ru', 'e4aded4d4a35a0123a7df9f26fdedc28', '2015-01-25 19:08:05', '2015-08-20 12:37:07', 0, 1, '', '', '', 0, ''),
(17, 'testzakaz', '0c811ba0c49c3214e8e3d2cb90b20ae2', 'coolfire@coolfire.pp.ua', 'efc0c51f1de52a7201a487339281714d', '2015-01-31 18:11:50', '2015-08-21 14:28:49', 0, 1, '', '', '', 0, ''),
(19, 'zakaz4ik', 'c0ca4207bd9505e1e409b4b1b676f80e', 'dshelp@mail.ru', 'eedf508ac6ef8694fe09966249420104', '2015-02-17 18:09:19', '2015-04-16 00:34:15', 0, 1, '', '', '', 0, ''),
(22, 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'velodov@mail.ru', '520d7b49442f3db6feb9841aedd5e600', '2015-06-09 22:30:21', '2015-09-02 04:39:24', 0, 1, '', '', '', 0, ''),
(23, 'zak4test', 'd4b9f6e678eb13b839e06f6f8d198c22', 'zak4test560105@mail.ru', '3b135e40f08cc2c47ebd2cc467c3ea9d', '2015-07-20 12:16:29', '2015-09-04 16:58:04', 0, 1, '', '', '', 0, ''),
(24, 'autobot', 'db150c4ece5c57bf984f835b25b7fa43', 'autobot509.63@gmail.com', '39fcd21411b9fab63d6a30441ced01d2', '2015-07-20 12:22:25', '2015-09-02 04:49:36', 0, 1, '', '', '', 0, ''),
(25, 'authorfilog', 'd8c2a3a1b89c5a07bcf6f64021a61cad', 'authorfilog@mail.ru', '9416814ac882442b928ed4a5a2136438', '2015-08-03 13:55:03', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(29, 'ekomixds2', '4f4459f48762b445cce5145fea127d93', 'ekomixds2@mail.ru', 'd73038643ffcfa46e03703e558bd5d6f', '2015-08-04 04:56:55', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(31, 'akoch-ov', '32ea4adfe0cdb11a818271e1f9c6db4b', 'ako40ff@gmail.com', '9fd02bdac4e0fb58b998ca0361e9b39d', '2015-08-10 01:15:47', '2015-09-05 16:10:43', 0, 1, 'https://www.facebook.com/app_scoped_user_id/741902639288831/', 'facebook', 'Artyom Kochanov', 0, ''),
(32, 'avtoritet', 'fd5d391b77f0317960e26b65013baaef', 'technobogds@mail.ru', '502d3793297540a112d88cf2368fa9a8', '2015-08-12 11:57:32', '2015-08-24 14:01:42', 0, 1, '', '', '', 0, ''),
(35, 'alesiya', '00a51ceb923d32df7b61a79da0d92fcd', 'Alesikla@gmail.com', '71376d37b4484e8efb340450f41d7dab', '2015-08-18 23:06:13', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(36, 'technobogds3', 'cd57c3c10c0673d0b3cd6c6e5c6c74cc', 'technobogds3@mail.ru', 'a3a4b2bbb69564029f888636539042f1', '2015-08-19 16:40:25', '2015-08-19 17:01:09', 0, 1, '', '', '', 0, ''),
(37, 'aleftin', '8c1058f085192463b8d765b41cdcb06b', 'golavskoy@mail.ru', 'c57f9953f25cc98feb8a587925984ef1', '2015-08-19 23:43:31', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(38, 'zakazik', 'fe2cb788fb598e88490ddba64cf58411', 'mr.serpukhovskoy@mail.ru', 'a6bc89369974c8183ab469f62e44d266', '2015-08-19 23:55:46', '2015-09-02 02:19:33', 0, 1, '', '', '', 0, ''),
(39, 'ekomixds3', '6af38209f0b2dc25be18624c78e7f6b4', 'ekomixds3@mail.ru', '65cd7665b31c36ec48fbe1a44f943b8c', '2015-08-20 01:12:42', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(41, 'alexeyvakarchuk', '149891464a8be93fff5e87aa4a86b227', 'alexeyvakarchuk@yandex.ru', '0cdf6d7ee2d0472b3a1686b38aeaac5e', '2015-08-21 22:12:47', '2015-09-05 15:41:33', 0, 1, '', '', '', 0, ''),
(42, 'refer9', 'da0f023c9475587bedf03afa8d5f49ae', 'referalbux@yandex.ru', '595b753f05750243c08fb240eb7bbce7', '2015-08-22 00:00:15', '2015-09-01 19:56:48', 0, 1, '', '', '', 0, ''),
(43, 'monty28', '0e5e2c89067c03f79e44dce250d646aa', 'monty28.ua@mail.ru', 'de8fccb1dab9a36b0e23d811e304edb1', '2015-08-22 00:40:49', '2015-09-04 20:34:20', 0, 1, '', '', '', 0, ''),
(44, 'TOR', '70bf8d3ca4d46344c09b007ad82d0a34', '2858331@gmail.com', '876154238484976676f0009386c743a4', '2015-08-22 02:33:07', '2015-08-22 02:35:45', 0, 1, '', '', '', 0, ''),
(45, 'Meik', '124bd1296bec0d9d93c7b52a71ad8d5b', 'rembrant122@gmail.com', 'e7498e0210c7ed869ac0f002e708b92a', '2015-08-22 02:36:15', '2015-09-04 20:01:57', 0, 1, 'https://www.facebook.com/app_scoped_user_id/689471937850834/', 'facebook', 'Meikel Nonkof', 0, ''),
(47, 'Alesika', 'f0b444c04a575c16ba0a0e0ef6c398ea', 'Kokilo.k@yandex.ru', 'd9b1597c65c5072c485ba22f4ebc7666', '2015-08-23 01:59:43', '2015-08-23 02:03:34', 0, 1, '', '', '', 0, ''),
(48, 'glodikov', 'd8510ca6999aa29e68c9331797bc8a9a', 'author250@gmail.com', '3b5aa872d61a3bc84e3cd508ea02962f', '2015-08-23 15:56:00', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(49, 'baskinav', '054c8de136662eac8922e9f97248dfa5', 'al206825@gmail.com', '62d5f276bd870d040eb4d59091aa49e2', '2015-08-23 16:21:56', '0000-00-00 00:00:00', 1, 1, '', '', '', 0, ''),
(50, 'moonty28', '0e5e2c89067c03f79e44dce250d646aa', 'artur13.ua@mail.ru', '246f19d30619f1cbcd8ef9842171176d', '2015-08-23 23:18:27', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(51, 'Rihard', '10b01316b189966ce1c5a1c2c52b6b82', 'optobeats@gmail.com', '0ed5850b4e86e76a7f4dade2cd768088', '2015-08-24 00:52:28', '2015-09-05 00:50:53', 0, 1, '', '', '', 0, ''),
(52, 'konst_dp', 'efd4fe02227bcf99ae1c06eec2ee7a9f', 'webdvlp@ya.ru', '5d97d00c77fa7e3c7d2df0f2be13b024', '2015-08-24 12:20:48', '2015-09-04 20:44:29', 0, 1, '', '', '', 0, ''),
(53, 'karen_rnd', 'c227ec5bb0865737fdd58f9ec03951ea', 'karen_dov@mail.ru', '1a93e21c44f2b7a24996f3b2670accfe', '2015-08-27 13:58:45', '2015-08-31 12:24:17', 0, 1, '', '', '', 0, ''),
(54, 'Pav', '2ee2c6a793241b1df677a2a37b048787', 'kompave2@yandex.ru', '55e75951d67fc162cf2a60fd46ee5356', '2015-08-29 19:09:01', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(55, 'Pavel', 'cc251e2f1bcfb13a79f53636bde351d1', 'pavelkomwork2@gmail.com', '65de54ba1c199ea592fa959a1a695a6d', '2015-08-29 19:16:46', '2015-08-30 13:13:27', 0, 1, '', '', '', 0, ''),
(56, 'siriys123', '31bd18a58ec0f9e80a94fadf9283fda6', 'Ppbdsvs1@mail.ru', 'c7afd8d7b7cbe95fd6af0957a8938f09', '2015-08-30 13:08:27', '2015-08-30 15:25:30', 0, 1, '', '', '', 0, ''),
(57, 'siriy321', '31bd18a58ec0f9e80a94fadf9283fda6', 'Zakaz937@mail.ru', '243881ed48c8176864e12d87aec03732', '2015-08-30 13:17:31', '2015-08-30 16:58:05', 0, 1, '', '', '', 0, ''),
(58, 'bubo4ka', 'f247bbbe6b8d6f953176f23334d62551', 'katrin010109@yandex.ru', '32419e43e3af6b9ef167ad4ddb806712', '2015-08-30 21:08:51', '2015-08-31 16:19:33', 0, 1, '', '', '', 0, ''),
(59, 't0pep0', '7847b7f8a74168021a7c1bdd0324f171', 'ivan@anfilatov.tk', 'f5b7ccf39cb0a251ac16975a8603f4ed', '2015-08-30 21:13:44', '2015-09-03 18:14:34', 0, 1, '', '', '', 0, ''),
(60, 'volk23', 'baa7b4871bf0f2a694d72505962d915e', 'bvolk23@mail.ru', '309afc997c2335ecbbbad378a937ae1f', '2015-08-30 21:13:48', '2015-08-31 20:52:28', 0, 1, '', '', '', 0, ''),
(61, 'druny', 'f85f79f55544290662aa0d395ce4a9e6', 'druny195@rambler.ru', '9304760237f365bdf1a3c76cebd5746d', '2015-08-30 21:26:01', '2015-09-04 16:54:01', 0, 1, '', '', '', 0, ''),
(62, 'NickoF84', '3625cfb29bf3c8c5bf40f1f4a6e9cf66', 'NickoF84@gmail.com', '0cb6c8db302cd6734208e3ce5f966f9b', '2015-08-30 21:33:33', '2015-09-04 10:06:53', 0, 1, '', '', '', 0, ''),
(63, 'xdv', 'b5845eb437b2c63c006a81fa03eb77a8', '241340@gmail.com', '393ff34c2d8de0bc72f583572be50f4b', '2015-08-30 22:42:02', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(64, 'xdv63', '6713d1301abbea83ae7554d563ff48d6', 'dhodenko@mail.ru', 'cae23551adc97344eac4a823b125cf3e', '2015-08-30 22:55:55', '2015-09-05 08:22:23', 0, 1, '', '', '', 0, ''),
(65, 'clausweb', '96102578859ae8018a7a498ff322456c', 'clausweb@yandex.ru', '0b94651b92b85cbd030253c47000aab8', '2015-08-30 23:26:29', '2015-09-02 18:40:20', 0, 1, '', '', '', 0, ''),
(66, 'vskrobov', '5605746adb64428379f70d57727b3353', 'vskrobov@gmail.com', '6444f7e122177acf097af2ea031a4d4d', '2015-08-31 11:49:59', '2015-09-02 18:04:32', 0, 1, '', '', '', 0, ''),
(67, 'sferubko', 'c523d72432fa99e58bc3cedb994ec0e3', 'sferubko@gmail.com', '939cb437aadd8629ab0534993bfdc94f', '2015-08-31 11:51:25', '2015-09-04 16:26:06', 0, 1, '', '', '', 0, ''),
(68, 'mnenepofig', '2e771fe4f4354532dbc49c9c9a45e81f', 'mnenepofig@rambler.ru', '763b78be5c9ca8a5f69c5db5eef6eee8', '2015-08-31 12:07:41', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(69, 'vovan16loce', '87c4cca241497b151cd21c5d92418e60', 'glamur4ikov_net@mail.ru', 'f2c6af041a441513577ddc001dd2c55e', '2015-08-31 12:27:09', '2015-09-04 09:47:05', 0, 1, '', '', '', 0, ''),
(70, 'eklips', 'e8cfe64e75b0b0963d652f6709e02a7e', 'bla-eklips@ya.ru', '61f4babadfecfafffb8f1f66a36ffdac', '2015-08-31 13:54:01', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(71, 'shteprospirator', '75f991cacf64b8c854a16bb26a6b879b', 'shteprospirator@gmail.com', 'c38c02ed8e7feef47c9fba2fa85d1370', '2015-08-31 14:32:24', '2015-09-01 14:32:15', 0, 1, '', '', '', 0, ''),
(72, 'BrainStorming', '7c67ce8b9e0a38b89741baf73e57d85f', 'seomaster66@gmail.com', '4bc35f013f6b08b9ad179f485d4d620c', '2015-08-31 16:28:55', '2015-09-04 08:05:16', 0, 1, '', '', '', 0, ''),
(73, 'Pavel2', 'cc251e2f1bcfb13a79f53636bde351d1', 'pavel.kom.work@yandex.ru', 'a0531fc52322096a838e1dbe27cc536a', '2015-08-31 16:30:06', '2015-09-04 20:05:38', 0, 1, '', '', '', 0, ''),
(74, 'ahiles', '881c78025b7d03d16925204c6e3d81dd', 'anton1996nk@gmail.com', 'da1c0b817b59c4ea5916f1af6d662399', '2015-08-31 17:11:59', '2015-09-05 11:18:48', 0, 1, '', '', '', 0, ''),
(75, 'Amazin', '0c15150fb0e9ac71adf44733c5c62d43', 'al.rout@Yandex.ru', 'd765d4d6c6e1af07126370b67f77d835', '2015-08-31 20:26:51', '2015-09-02 20:08:13', 0, 1, '', '', '', 0, ''),
(76, 'retuam', 'f7ce3d5624bc6778744891165f715744', 'retuam@gmail.com', '00f76a022f9e304c507dcb5f2e13954e', '2015-09-01 00:58:04', '2015-09-01 00:58:29', 0, 1, '', '', '', 0, ''),
(77, 'extatic', '71aa4460b2db0378938c91b5105e0bd2', 'info@web-molot.ru', 'a01ba42c0d30c2598f90dc9047de9639', '2015-09-01 11:28:59', '2015-09-03 19:49:14', 0, 1, '', '', '', 0, ''),
(78, 'asdasdsadasd', '7b8b2f694135e2a4cf5515175c4bfe51', 'head123455@yandex.ru', '35c62fc857957fb312bf72036abffbb9', '2015-09-01 11:41:37', '2015-09-01 11:46:54', 0, 1, '', '', '', 0, ''),
(79, 'vladarwise', '5a69a715bc24ea6bc83b7db40a7e414e', 'vladarwise@gmail.com', '4820a6806f2ca2824a3bf5872c02ea63', '2015-09-01 12:12:55', '2015-09-03 22:11:49', 0, 1, '', '', '', 0, ''),
(80, 'yurawd', '05702b25aa36635f468d58caa5b5e369', 'yurawd@hotmail.com', 'cba8ec4d9c9475873531c56931e5ce8d', '2015-09-01 12:28:22', '0000-00-00 00:00:00', 0, 0, '', '', '', 0, ''),
(81, 'evgeniy3', 'e01ac9baccf7f3da863f5c6fb1d47409', 'evgenij.kropachev@yandex.ru', 'fbe7a020791d3b851575447e8191e9c4', '2015-09-01 12:43:53', '2015-09-03 18:38:57', 0, 1, 'http://vk.com/id177571989', 'vkontakte', 'Евгений Кропачев', 0, ''),
(82, 'diusha', '7e5a8130e1505bcd2534d70ad32671d7', 'andriusis82@yandex.ru', '74383b567f7566b08df83a6a9f110b35', '2015-09-01 12:59:14', '2015-09-03 22:36:07', 0, 1, '', '', '', 0, ''),
(83, 'cort', 'e9481f43eb809a0aee40d3f46ba71516', 'slip_3@mail.ru', 'cdb1661abc867878b7217d48613246b7', '2015-09-01 13:02:58', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, ''),
(84, 'angelina_s', '9a5deaee64aace47d425364bf5250565', 'angelina1891@mail.ru', '5eca52ef21538401de20472ce2a9d949', '2015-09-01 13:03:55', '2015-09-02 01:49:28', 0, 1, '', '', '', 0, ''),
(85, 'cuborubo', '48474f975022f960bc2afbe49be581e8', 'hello@cuborubo.com', '5a2d8994465a3cd14aa0af837856606b', '2015-09-01 13:19:04', '2015-09-01 13:21:18', 0, 1, '', '', '', 0, ''),
(86, 'doc777', 'f379eaf3c831b04de153469d1bec345e', 'e.gribkov@mail.ru', 'c93f9da6ccf99704bcbf51cf308696e7', '2015-09-01 14:16:51', '2015-09-04 19:08:37', 0, 1, '', '', '', 0, ''),
(87, 'kandiuk', '6fb184822c89e61b480b88e5fd00a696', 'o.kandiuk@bvblogic.com', 'd55bbefb02ea2356e8a8dd361bb42e5e', '2015-09-01 14:57:42', '2015-09-01 14:59:11', 0, 1, '', '', '', 0, ''),
(88, 'efess', 'bd0c2127f7ed0dde7a9379ab2a26e215', 'e.repin@ya.ru', 'e5795b2d44cc1234fbeaaac2d477da6e', '2015-09-01 20:58:47', '2015-09-01 20:59:30', 0, 1, '', '', '', 0, ''),
(89, 'alushchik', 'eed4a5fe6a4e8309bf706f32b9146bba', 'alushchik@mail.ru', '42b1154f13db0c7e7456ec25085e1b2c', '2015-09-01 22:17:32', '2015-09-02 22:34:08', 0, 1, '', '', '', 0, ''),
(90, 'xabi1989', '9942a65827b9708540b6feaa469a07ca', 'juve892010@gmail.com', '9dcf7656a3aa4c45ad583665accdcdb2', '2015-09-01 22:49:13', '2015-09-02 22:53:20', 0, 1, '', '', '', 0, ''),
(91, 'alexqwert', 'e26e3ed424a7783ff67b3053b575adf5', 'alexqwert@gmail.com', 'b8567326ac83b11c765d54d67460f229', '2015-09-02 04:59:52', '2015-09-02 05:01:32', 0, 1, '', '', '', 0, ''),
(92, 'Netville', '0e5eebf219feebe90f0d5c6021fa7094', 'web@netville.com.ua', '41e8dbf3533f0da8c6eed92bb745b136', '2015-09-02 14:04:12', '2015-09-04 14:12:19', 0, 1, '', '', '', 0, ''),
(93, 'sertgarant', '7cb4e0af0036ae1aeb1281aa1b1f6062', 'ast4@mail.ru', 'c5397200941eb864c9602e06541dba07', '2015-09-02 18:03:03', '2015-09-02 18:04:38', 0, 1, '', '', '', 0, ''),
(94, 'Kseniyar', 'a8e71977780317a74d067d3bba4a022e', 'richksena@yandex.ru', '87d29f845e474502d5f106e510004ba6', '2015-09-02 19:11:52', '2015-09-02 19:12:44', 0, 1, '', '', '', 0, ''),
(95, 'Erry20', '93987482e81190488859039c059f54a2', 'erryk20@gmail.com', 'd0b8641dcf7c0aac5e51ed508fec05de', '2015-09-03 08:47:13', '2015-09-03 08:47:55', 0, 1, '', '', '', 0, ''),
(96, 'slavikzp', '2b1e3fe848a13917b90ac705aed24957', 'chervonos.v.s@gmail.com', '805c5475346b9c8f9bd42bc66e686551', '2015-09-03 17:57:37', '2015-09-04 17:05:08', 0, 1, '', '', '', 0, ''),
(97, 'Nadeika07', 'e5481be96f1290dec02417d09c8f3551', 'nadeika07@mail.ru', '5d25fe8aec64df83ab32ed40446ed922', '2015-09-03 18:03:00', '2015-09-03 18:03:39', 0, 1, '', '', '', 0, ''),
(98, 'NadinKo', 'e5481be96f1290dec02417d09c8f3551', 'bykova.nadenka89@yandex.ru', '4dec4821e62dc9d911c69f78c0b0855c', '2015-09-03 18:07:45', '2015-09-05 00:23:48', 0, 1, '', '', '', 0, ''),
(102, 'hello@indiweb.co', '9b43afdbb24f73bf01d5efc5f2603f74', 'hello@indiweb.co', '', '2015-09-03 22:29:45', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '+79217501097'),
(103, 'andriusis82@mail.ru', 'a14944c8b61329bfebd190d445a38cf7', 'andriusis82@mail.ru', '', '2015-09-03 22:41:49', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '+380954648457'),
(104, 'rr890@yandex.ru', '4b0a8ea11ea01ad26bdbb51567a2f436', 'rr890@yandex.ru', '', '2015-09-03 23:20:59', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '89050591416'),
(106, 'andriymitskevic@gmai', 'e831b414372af70a0a21bbe5a6f43979', 'andriymitskevic@gmail.com', '', '2015-09-04 00:07:06', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '1212133424'),
(109, 'akoch', '', 'akoch-ov@mail.ru', '', '2015-09-04 00:28:26', '0000-00-00 00:00:00', 0, 1, 'http://vk.com/id903586', 'vkontakte', 'Артём Кочанов', 0, ''),
(110, 'wholegroup@gmail.com', '80c274c280cecea0696183a486da807c', 'wholegroup@gmail.com', '', '2015-09-04 02:05:02', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '+79127415923'),
(111, 'dauzer@yandex.ru', '8250947917c4b2fd10f6a9f881bb2feb', 'dauzer@yandex.ru', '', '2015-09-04 12:02:09', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '89119122236'),
(112, 'ustimov.v@gmail.com', '67bf12246c6763176e5ac234a8231262', 'ustimov.v@gmail.com', '', '2015-09-04 12:04:40', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '89119122236'),
(113, NULL, '', 'skvorzof.d@yandex.ru', '', '2015-09-04 12:57:47', '0000-00-00 00:00:00', 0, 1, 'http://vk.com/id230727326', 'vkontakte', 'Артём Крашаков', 0, ''),
(114, NULL, '', 'malish-slava@yandex.ru', '', '2015-09-04 13:54:27', '0000-00-00 00:00:00', 0, 1, 'http://vk.com/id30312522', 'vkontakte', 'Слава Гусев', 0, ''),
(115, NULL, '', 'dmitrii8891@gmail.com', '', '2015-09-04 15:19:46', '0000-00-00 00:00:00', 0, 1, 'https://plus.google.com/u/0/111249438562953622680/', 'google', 'Дмитрий Головань', 0, ''),
(116, 'ekomixds@mail.ru', 'be06eca50669e373702226e6c2f32f95', 'ekomixds@mail.ru', '', '2015-09-04 15:53:17', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '+79850000000'),
(117, 'alexandrr.naumenko@g', '7bec8b1bac5ec1571a37bc8dbdebfbac', 'alexandrr.naumenko@gmail.com', '', '2015-09-04 15:58:57', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '0937202604'),
(118, 'numibu@mail.ru', '82f6beab16e345b5d88dfee26c7176fe', 'numibu@mail.ru', '', '2015-09-04 16:03:16', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '0937202604'),
(119, 'ntv179@mail.ru', 'b370ce57dcfad82a51e3d012ad17121a', 'ntv179@mail.ru', '', '2015-09-04 16:06:01', '0000-00-00 00:00:00', 0, 1, '', '', '', 0, '89645195845'),
(120, NULL, '', 'xavi892008@rambler.ru', '', '2015-09-04 17:36:56', '0000-00-00 00:00:00', 0, 1, 'http://vk.com/id22018027', 'vkontakte', 'Михаил Гришин', 0, ''),
(121, 'romebio3', '', 'solenetua@gmail.com', '', '2015-09-04 19:18:17', '0000-00-00 00:00:00', 0, 1, 'http://vk.com/id228223783', 'vkontakte', 'Sole Generetion', 0, ''),
(122, 'alex1900', 'ffff6aba4f22a4b4ebc1b46a84ace0b1', 'lsd-7d@yandex.ru', '', '2015-09-04 21:40:25', '2015-09-05 00:43:10', 0, 1, '', '', '', 0, '89030361336'),
(123, NULL, '', 'order.ilumio@yandex.ua', '', '2015-09-05 13:44:08', '0000-00-00 00:00:00', 0, 1, 'http://openid.yandex.ru/order.ilumio/', 'yandex', 'Виталий Мельничук', 0, '');

-- --------------------------------------------------------

--
-- Структура таблицы `ZakazPartsFiles`
--

CREATE TABLE IF NOT EXISTS `ZakazPartsFiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `part_id` int(11) DEFAULT NULL,
  `orig_name` varchar(100) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `ZakazPartsFiles`
--

INSERT INTO `ZakazPartsFiles` (`id`, `part_id`, `orig_name`, `file_name`, `comment`) VALUES
(1, 1, '114-fz.doc', '8631FFE8-96F3-6634-64CD-2C6B0B55351D.doc', ''),
(2, 1, 'f-110.doc', '8636FAA2-4124-B0E6-0077-EDF62CC8A295.doc', ''),
(3, 1, '114-fz.doc', '7AF178C1-E136-F179-7036-88B96671E5ED.doc', ''),
(4, 1, '114-fz.doc', '50518CA2-0321-AACD-27CB-9B819BAE8858.doc', ''),
(5, 1, '114-fz.doc', 'A9377013-2AD4-643A-3547-9C7AD7F73C8B.doc', ''),
(6, 7, 'f-110.doc', '9C437358-9D74-F10D-1400-D8459DC03474.doc', 'asdfasdgasdg'),
(7, 7, '114-fz.doc', 'E305FE8C-45B9-B60C-A8CB-A0B8F10C1C47.doc', ''),
(8, 10, '114-fz.doc', '6508E364-3D4C-42D1-119D-2E96487827A1.doc', 'чыфчфычф'),
(9, 10, 'f-110.doc', '4FBD98CE-0850-3E75-F021-B81F27F45526.doc', ''),
(10, 13, 'Урок 20 elementary.docx', 'CA67354C-5791-E723-7F6C-C8243A894243.docx', ''),
(11, 14, 'Урок 20 elementary.docx', '02CDD490-84F7-32B7-B5D5-DBF12589B32D.docx', ''),
(12, 24, '414116_426275.jpg', '788F55B6-9479-F6E0-E517-367CF8126D0B.jpg', ''),
(13, 18, '414116_426275.jpg', '12DEBC87-7651-3419-1F31-1E0B913B64FF.jpg', ''),
(14, 18, '1416751035-6727.jpg', 'C9DFE005-BAD2-68CE-4A8F-18F1DF8F37BC.jpg', ''),
(15, 22, '!!!.docx', '2C531A89-5BFD-6C44-4341-ACD3E979CC88.docx', ''),
(16, 22, '.doc', '1C341DC4-6D9D-8F07-4E49-5D11AF9863AF.doc', ''),
(17, 39, 'images.jpeg', '67B4C6FB-FB25-AECC-6B66-ED79A08CB0A7.jpeg', ''),
(18, 39, '2-я глава гражд права.doc', '0D00FAFD-4132-3B4C-B1A2-3A6537BF6914.doc', ''),
(19, 39, '10138.doc', '20950286-3546-EE8B-8D09-39627CD33F2D.doc', ''),
(20, 50, ' (3).doc', '063FA48A-A2E2-70D6-4BF5-8BBF9884F43E.doc', ''),
(21, 54, '1667 Анализ и совершенствование современных форм оплаты труда на примере Макдональдса.doc', '6E9D844C-4359-9684-7A31-99F08C8D32FA.doc', ''),
(22, 61, '1667 Анализ и совершенствование современных форм оплаты труда на примере Макдональдса.doc', '9A20B433-5E98-84EE-F229-7DDCC093AB4D.doc', ''),
(23, 66, '10159 Диплом 2.3.doc', '42B5CB75-E325-9F0B-5F5E-DE760E5DC5FA.3', ''),
(24, 66, '2luv155.jpg', '3A74479F-1729-43D1-5443-D5422424C958.', ''),
(25, 66, 'astral1024.jpg', '82A25B33-EEF4-3784-29DD-206FB914D465.', ''),
(26, 68, '414116_426275_.jpg', 'A830060A-46C1-6B0A-8244-03B80C0E57BC.', ''),
(27, 68, ' заказ 65.doc', '6847AA70-7784-836D-2CF9-CA73BB21FFC4.', ''),
(28, 69, '1 Глава 65.doc', '71015E74-A357-70FF-74AE-BE3882BA4708.', ''),
(29, 74, '1 Глава 65.doc', '2C427A32-212C-283E-B844-7803E224A505.', ''),
(30, 88, '1 Глава 65.doc', '2661CF28-6BCF-FFAC-A11B-3039071ADB02.', ''),
(31, 93, 'email_icon.png', 'F57E7BE8-E522-6319-69BD-9AE86ADF9088.', ''),
(32, 94, '10159 Диплом 2.3 (1).doc', 'AC032AF1-141F-8F12-FFC5-A18022A49CE4.3 (1)', ''),
(33, 95, '1 Глава 65.doc', 'DA30E8E3-12BB-DDD2-08CD-4CDA772E39AB.', ''),
(34, 97, 'fs_430.jpg', 'AA28BEF4-822D-CBF3-1B0E-67FFCF9F412A.jpg', ''),
(35, 98, '1 Глава 65.doc', '3F214182-8F52-7BED-9781-A55E1F1B5D61.doc', '');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `AuthAssignment`
--
ALTER TABLE `AuthAssignment`
  ADD CONSTRAINT `authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `AuthItemChild`
--
ALTER TABLE `AuthItemChild`
  ADD CONSTRAINT `authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Profiles`
--
ALTER TABLE `Profiles`
  ADD CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `Rights`
--
ALTER TABLE `Rights`
  ADD CONSTRAINT `rights_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `AuthItem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
