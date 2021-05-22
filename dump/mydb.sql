-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 22 2021 г., 18:37
-- Версия сервера: 8.0.23
-- Версия PHP: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `mydb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `ID` int NOT NULL,
  `Customer_id` int NOT NULL COMMENT 'Заказчик',
  `Work_list` text COMMENT 'Список работ',
  `Date_from` datetime NOT NULL COMMENT 'Дата начала работ',
  `Date_to` datetime DEFAULT NULL COMMENT 'Дата окончания работ',
  `Price` decimal(12,2) DEFAULT NULL COMMENT 'Стоимость работ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Заказы';

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`ID`, `Customer_id`, `Work_list`, `Date_from`, `Date_to`, `Price`) VALUES
(1, 2, 'Демонтаж стен', '2020-01-31 00:00:00', '2020-02-05 00:00:00', '5245.64'),
(2, 2, 'Покраска потолка (красный)', '2020-02-01 00:00:00', '2020-04-01 00:00:00', '1000.00'),
(3, 2, 'Установка сантехники, демонтаж и вынос старой кухни', '2020-11-30 00:00:00', NULL, '80000.00'),
(4, 2, 'Переделка пола (ламинат на паркет)', '2021-01-13 12:00:00', '2021-01-13 20:00:00', NULL),
(5, 2, 'Монтаж окон', '2021-02-02 00:00:00', NULL, '5155.55'),
(6, 3, 'Монтаж кухни', '2020-02-04 13:00:00', '2020-02-05 06:00:00', '14235.50'),
(7, 3, 'Вынос строительного мусора', '2020-02-05 00:00:00', '2020-02-06 00:00:00', '100.00'),
(8, 3, 'Поклейка обоев (5 стен)', '2021-01-01 15:33:10', '2021-01-14 20:15:00', '71233.00'),
(9, 3, 'Снос пристройки', '2021-01-30 00:00:00', NULL, '213123.00'),
(10, 2, 'Установка дверей входных (металл)', '2021-04-01 00:00:00', NULL, NULL),
(11, 7, 'Сколотить стул', '2021-03-19 00:00:00', '2021-03-31 00:00:00', '1000.00'),
(12, 7, 'Построить дом', '2021-03-01 00:00:00', '2021-07-15 00:00:00', '100000.00'),
(13, 3, 'Демотаж здания', '2021-03-03 00:00:00', '2021-03-28 00:00:00', '70346.00'),
(14, 7, 'Установить рамы', '2021-03-01 00:00:00', '2021-04-29 00:00:00', '2346.00'),
(15, 3, 'Организовать парковку', '2021-03-31 00:00:00', '2021-06-30 00:00:00', '234000.00'),
(16, 2, 'Сбор мусора', '2021-05-05 00:00:00', '2021-07-07 00:00:00', '267900.00'),
(17, 3, 'Демонтаж стен', '2021-03-28 00:00:00', '2021-04-01 00:00:00', '78864.00'),
(19, 3, 'Разобрать пристройку', '2021-03-01 00:00:00', '2021-05-03 00:00:00', '23000.00'),
(20, 3, 'Построить школу', '2010-05-01 00:00:00', '2011-03-10 00:00:00', '2000000.00'),
(21, 3, 'Вырыть шахту', '2021-03-04 00:00:00', '2023-03-01 00:00:00', '15000.00'),
(22, 3, 'Сделать ремонт', '2021-03-02 00:00:00', '2021-03-31 00:00:00', '2000.00'),
(23, 3, 'ремонт дома', '2021-01-01 00:00:00', '2023-12-04 00:00:00', '2345678.00'),
(24, 3, 'построить дом на ул.Ленина', '2021-04-01 00:00:00', '2023-04-04 00:00:00', '1000000.00');

-- --------------------------------------------------------

--
-- Структура таблицы `performer`
--

CREATE TABLE `performer` (
  `ID` int NOT NULL,
  `Order` int NOT NULL,
  `User_id` int NOT NULL,
  `Date_appointment` datetime NOT NULL,
  `Reason` text CHARACTER SET utf8 COLLATE utf8_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `performer`
--

INSERT INTO `performer` (`ID`, `Order`, `User_id`, `Date_appointment`, `Reason`) VALUES
(28, 4, 6, '2021-03-26 12:36:12', 'Срыв срока'),
(29, 13, 4, '2021-03-26 12:36:12', ''),
(30, 10, 9, '2021-03-26 12:56:13', 'Некачественно работает'),
(31, 4, 4, '2021-03-26 12:57:54', ''),
(32, 10, 6, '2021-03-26 12:58:41', 'Ужас'),
(33, 10, 4, '2021-03-26 12:59:04', ''),
(34, 9, 5, '2021-03-26 15:06:30', ''),
(35, 8, 9, '2021-03-26 15:06:30', ''),
(36, 8, 4, '2021-03-26 15:06:30', ''),
(37, 12, 6, '2021-03-26 15:07:17', 'Ужас * 2'),
(38, 7, 9, '2021-03-26 15:48:27', 'Ну вообще!!'),
(39, 8, 4, '2021-03-27 06:36:46', ''),
(40, 22, 8, '2021-03-27 06:37:17', ''),
(41, 12, 6, '2021-03-27 09:37:31', ''),
(42, 7, 5, '2021-03-27 09:37:53', ''),
(43, 19, 4, '2021-03-27 20:16:25', ''),
(44, 6, 9, '2021-03-27 20:16:35', ''),
(45, 3, 4, '2021-03-28 07:57:37', ''),
(46, 20, 8, '2021-03-28 08:01:36', ''),
(47, 5, 5, '2021-03-28 08:02:20', ''),
(48, 6, 6, '2021-03-28 19:30:32', ''),
(49, 24, 5, '2021-04-04 14:46:13', ''),
(50, 23, 9, '2021-04-04 14:47:59', ''),
(51, 1, 5, '2021-04-04 14:54:59', ''),
(52, 21, 6, '2021-04-13 16:23:20', ''),
(53, 6, 5, '2021-05-22 18:22:22', '');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `ID` int NOT NULL,
  `Name` varchar(255) NOT NULL COMMENT 'Машинное имя роли',
  `Title` varchar(255) NOT NULL COMMENT 'Наименование роли'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Роли';

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`ID`, `Name`, `Title`) VALUES
(1, 'admin', 'Администратор'),
(2, 'customer', 'Заказчик'),
(3, 'contractor', 'Исполнитель');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `ID` int NOT NULL,
  `Fullname` varchar(1024) NOT NULL COMMENT 'ФИО',
  `Role_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Пользователи';

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`ID`, `Fullname`, `Role_id`) VALUES
(1, 'Админ', 1),
(2, 'Андреев Алексей Александрович', 2),
(3, 'Боев Борис Борисович', 2),
(4, 'Волейнов Владимир Владиславович', 3),
(5, 'Голубь Геннадий Григорьевич', 3),
(6, 'Долгих Денис Дмитриевич', 3),
(7, 'Петров Петр Петрович', 2),
(8, 'Федоров Федор Федорович', 3),
(9, 'Иванов Иван Иванович', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk-Order-customer_id_idx` (`Customer_id`);

--
-- Индексы таблицы `performer`
--
ALTER TABLE `performer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Order` (`Order`),
  ADD KEY `User_id` (`User_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk-User-role_id_idx` (`Role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `performer`
--
ALTER TABLE `performer`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk-Order-customer_id` FOREIGN KEY (`Customer_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `performer`
--
ALTER TABLE `performer`
  ADD CONSTRAINT `performer_ibfk_1` FOREIGN KEY (`Order`) REFERENCES `order` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `performer_ibfk_2` FOREIGN KEY (`User_id`) REFERENCES `user` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-User-role_id` FOREIGN KEY (`Role_id`) REFERENCES `role` (`ID`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
