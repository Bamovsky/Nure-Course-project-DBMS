-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июн 22 2018 г., 10:33
-- Версия сервера: 5.7.21
-- Версия PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `trainstation`
--

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `myversion` ()  BEGIN 
SELECT VERSION();
END$$

--
-- Функции
--
CREATE DEFINER=`root`@`localhost` FUNCTION `rate` (`r` VARCHAR(25)) RETURNS FLOAT BEGIN
DECLARE rate FLOAT DEFAULT 0;
SELECT (SUM(quantity)/(SELECT SUM(quantity) FROM logorders))*100 into rate FROM logorders WHERE title=r;
RETURN rate;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(3, 'Колонки'),
(4, 'Наушники'),
(2, 'Планшеты'),
(1, 'Телефоны'),
(5, 'Часы');

-- --------------------------------------------------------

--
-- Структура таблицы `logorders`
--

CREATE TABLE `logorders` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `DataTime` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `logorders`
--

INSERT INTO `logorders` (`id`, `user`, `title`, `DataTime`, `price`, `quantity`) VALUES
(1, 'manager', 'Iphone 6', '2018-06-10 22:19:52', 7499, 1),
(2, 'manager', 'Iphone 7', '2018-06-10 22:19:52', 9999, 1),
(3, 'manager', 'Iphone 6', '2018-06-11 00:06:20', 7499, 1),
(4, 'test2', 'Iphone 7', '2018-06-12 14:39:40', 9999, 1),
(5, 'manager', 'Iphone 7', '2018-06-12 17:58:23', 9999, 1),
(7, 'test2', 'Iphone 8', '2018-06-18 12:37:03', 12999, 2),
(8, 'test2', 'Iphone 8', '2018-06-20 09:04:35', 12999, 1),
(9, 'test2', 'Iphone 8', '2018-06-20 11:50:37', 12999, 2),
(10, 'test2', 'Iphone X', '2018-06-20 11:50:59', 29999, 1),
(11, 'test2', 'Samsung Galaxy S9', '2018-06-20 11:50:59', 25999, 1),
(12, 'manager', 'Apple IPad 10.5', '2018-06-20 12:38:59', 23999, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `DateTime` datetime NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user`, `title`, `DateTime`, `price`, `quantity`) VALUES
(11, 'test2', 'Samsung Galaxy S9', '2018-06-20 11:50:59', 25999, 1),
(12, 'manager', 'Apple IPad 10.5', '2018-06-20 12:38:59', 23999, 1);

--
-- Триггеры `orders`
--
DELIMITER $$
CREATE TRIGGER `log` AFTER INSERT ON `orders` FOR EACH ROW BEGIN
DECLARE var1 int(11) DEFAULT 0;
SELECT quantity into var1 FROM products WHERE title=NEW.title;
IF var1>=NEW.quantity THEN
INSERT INTO logorders SELECT * FROM orders WHERE id=NEW.id;
UPDATE products SET products.quantity=products.quantity-NEW.quantity WHERE title=NEW.title;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `intro` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `CatName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `img`, `intro`, `price`, `quantity`, `CatName`) VALUES
(1, 'Iphone 6', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/iphone-6/apple-iphone-6-2016-ios-10-gallery-img-1-101016.jpg', 'Неповторимый дизайн, качество. Фирма не требующая представления', '7499', 0, 'Телефоны'),
(2, 'Iphone 7', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/iphone7/apple-iphone-7-gallery-img-1.jpg', 'Улучшенная камера, обновленный дизайн', '9999', 0, 'Телефоны'),
(3, 'Iphone 8', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/iphone8/apple-iphone-8-red-gallery1-090418.jpg', 'Двойная камера, 4К видео, замедленная съемка.', '12999', 48, 'Телефоны'),
(4, 'Iphone X', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/iphone-x/bau-35465-iphone-x-silver-gallery-master-01-130917.jpg', 'Разблокировка по лицу, переработанный дизайн, удобство', '29999', 99, 'Телефоны'),
(5, 'Samsung Galaxy S9', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/samsung/s9/new/samsung-galaxy-s9-gallery-img-1.jpg', 'Лучший экран, неповторимая цветопередача, сканер радужки глаза.', '25999', 99, 'Телефоны'),
(6, 'OnePlus 6', 'https://www.o2.co.uk/sites/default/files/oneplus-6-gallery1-020518.jpg', 'Китайский конкурент телефонам А класса. Все лучшее от А брендов.', '11500', 100, 'Телефоны'),
(7, 'Apple IPad 9.7', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/ipad-9_7-2018/gallery-images/ipad-2018-gallery-01-280318.jpg', 'Тонкий, легкий - создан для работы', '18000', 100, 'Планшеты'),
(8, 'Apple IPad 10.5', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/ipad-9_7-2018/gallery-images/ipad-2018-gallery-01-280318.jpg', 'Потрясающая цветопередача, лучшее решение для дизайнеров ', '23999', 99, 'Планшеты'),
(9, 'Samsung Galaxy Tab S3', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/samsung/tab-s3-9/bau-32845-samsung-galaxy-tab-s3-gallery-image-1-310517.jpg', 'Бюджетный вариант для несложных задач', '4500', 100, 'Планшеты'),
(10, 'Huawei MediaPad T3 8', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/huawei/mediapad_t3_8/bau-31951-huawei-mediapad-t3-build-gallery-master-1-280417.jpg', 'Двойная Sim, хорошая автономность.', '3999', 100, 'Планшеты'),
(11, 'Apple Ipad Pro 12.9', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/apple/ipad-pro-12-9-2015/ipad-pro-space-grey-gallery-img-1.jpg', 'Retina экран, отличный звук. Отличный вариант для мультимедиа ', '17300', 100, 'Планшеты'),
(12, 'Alcatel Plus 10', 'https://www.o2.co.uk/shop/homepage/images/shop15/brand/alcatel/plus-10/alcatel-10-plus-tablet-silver-gallery-img-1-030816.jpg', 'Топовое железо по антикризисной цене', '8700', 100, 'Планшеты');

-- --------------------------------------------------------

--
-- Структура таблицы `userinfo`
--

CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `MiddleName` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `cart` varchar(20) NOT NULL,
  `addr` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `userinfo`
--

INSERT INTO `userinfo` (`id`, `Name`, `LastName`, `MiddleName`, `phone`, `cart`, `addr`) VALUES
(1, '', '', '', '', '', ''),
(2, '', '', '', '', '', ''),
(3, 'Владимир', 'Черкашин', 'Андреевич', '', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `IsManager` tinyint(1) NOT NULL DEFAULT '0',
  `idInfo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`, `IsManager`, `idInfo`) VALUES
(1, 'test', '1234', 'test@mail.ru', 0, 1),
(2, 'test2', '81dc9bdb52d04dc20036dbd8313ed055', 'test2@mail.ru', 0, 2),
(3, 'manager', '4a7d1ed414474e4033ac29ccb8653d9b', 'manager@gmail.com', 1, 3),
(4, 'dek2', '81dc9bdb52d04dc20036dbd8313ed055', 'govno@mail.ru', 0, 1);

--
-- Триггеры `users`
--
DELIMITER $$
CREATE TRIGGER `PasToMd5` BEFORE INSERT ON `users` FOR EACH ROW SET NEW.password = md5(NEW.password)
$$
DELIMITER ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `title` (`title`);

--
-- Индексы таблицы `logorders`
--
ALTER TABLE `logorders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CatName` (`CatName`);

--
-- Индексы таблицы `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `idInfo` (`idInfo`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `logorders`
--
ALTER TABLE `logorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`CatName`) REFERENCES `categories` (`title`);

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`idInfo`) REFERENCES `userinfo` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
