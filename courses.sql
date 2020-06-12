-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 12 2020 г., 18:55
-- Версия сервера: 10.3.22-MariaDB
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `courses`
--

-- --------------------------------------------------------

--
-- Структура таблицы `course`
--

CREATE TABLE `course` (
  `course_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coursetype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `course`
--

INSERT INTO `course` (`course_id`, `name`, `coursetype_id`) VALUES
(1, 'Курс \"быстрый курс\"', 2),
(2, 'Курс \"углубленный\"', 2),
(3, 'Курс \"стандартный\"', 1),
(4, 'Курс \"Роботрон\"', 3),
(5, 'Курс \"webDee\"', 2),
(6, 'Курс \"гейм-дизайн\"', 4),
(7, 'Курс \"Астрофизика\"', 5),
(8, 'Курс \"ООП\"', 6),
(9, 'Курс \"Менеджер\"', 7);

-- --------------------------------------------------------

--
-- Структура таблицы `coursetypes`
--

CREATE TABLE `coursetypes` (
  `coursetype_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `coursetypes`
--

INSERT INTO `coursetypes` (`coursetype_id`, `name`) VALUES
(1, 'Программирование'),
(2, 'Веб-дизайн'),
(3, 'Мехатроника'),
(4, 'Веб-программирование'),
(5, 'Физика'),
(6, 'Информационные системы'),
(7, 'Менеджмент');

-- --------------------------------------------------------

--
-- Структура таблицы `dolzhnost`
--

CREATE TABLE `dolzhnost` (
  `dolzhnost_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `dolzhnost`
--

INSERT INTO `dolzhnost` (`dolzhnost_id`, `name`) VALUES
(1, 'Программист'),
(2, 'Врач'),
(3, 'Полицейский');

-- --------------------------------------------------------

--
-- Структура таблицы `genders`
--

CREATE TABLE `genders` (
  `gender_id` tinyint(4) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `genders`
--

INSERT INTO `genders` (`gender_id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский');

-- --------------------------------------------------------

--
-- Структура таблицы `organization`
--

CREATE TABLE `organization` (
  `organization_id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `organization`
--

INSERT INTO `organization` (`organization_id`, `name`, `address`, `phone`, `email`) VALUES
(1, 'SmartCourse', 'Бейбитшилик 39', '+770324892834', 'randomemail@email.com'),
(2, 'BrainExp', 'Чингиза Айтматова 38', '+7723402384982', 'emailemail@email.com'),
(3, 'AyBeeSee', 'Ботаническая 14', '+77394289230498', 'notanemail@email.com');

-- --------------------------------------------------------

--
-- Структура таблицы `pin`
--

CREATE TABLE `pin` (
  `pin_id` int(11) NOT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `datestart` date DEFAULT NULL,
  `dateend` date DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pin`
--

INSERT INTO `pin` (`pin_id`, `teacher_id`, `course_id`, `datestart`, `dateend`, `price`) VALUES
(1, 6, 1, '2020-06-09', '2020-06-16', 30000),
(2, 6, 3, '2020-07-01', '2020-07-15', 20000),
(3, 5, 2, '2020-08-09', '2020-09-03', 45000),
(4, 5, 4, '2020-09-15', '2020-10-13', 34000),
(5, 6, 5, '2020-10-18', '2020-11-08', 17800),
(6, 32, 6, '2021-01-01', '2021-01-17', 19000),
(7, 41, 7, '2020-06-13', '2020-06-20', 45000),
(8, 33, 8, '2020-08-15', '2020-08-20', 15000),
(9, 41, 9, '2020-12-25', '2021-01-14', 20000);

-- --------------------------------------------------------

--
-- Структура таблицы `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `student_secondary` int(11) NOT NULL,
  `dolzhnost_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student`
--

INSERT INTO `student` (`student_id`, `student_secondary`, `dolzhnost_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 3),
(4, 4, 2),
(7, 5, 1),
(8, 6, 2),
(34, 7, 2),
(35, 11, 1),
(36, 12, 2),
(38, 14, 3),
(39, 18, 3),
(40, 20, 3),
(43, 24, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `student_ticket`
--

CREATE TABLE `student_ticket` (
  `student_ticket_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `ticket_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `student_ticket`
--

INSERT INTO `student_ticket` (`student_ticket_id`, `student_id`, `ticket_id`) VALUES
(1, 1, 2),
(2, 3, 1),
(3, 4, 3),
(4, 2, 2),
(5, 7, 4),
(7, 2, 1),
(8, 8, 6),
(9, 4, 4),
(10, 36, 3),
(11, 2, 7),
(12, 40, 8),
(13, 3, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `teacher_secondary` int(11) NOT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `education` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `teacher_secondary`, `birthday`, `gender`, `education`, `category`) VALUES
(5, 1, '1975-05-25', 2, 'Магистратура МГУ - психология', 'первая'),
(6, 2, '1998-04-15', 1, 'Аграрный университет - программирование', 'высшая'),
(32, 3, '1937-10-19', 2, 'Карагандинский УПТ', 'высшая'),
(33, 7, '2002-08-15', 1, 'Астанинский УПТ-1', 'первая'),
(37, 8, '1970-02-21', 2, 'Алмата', 'вторая'),
(41, 10, '2013-06-08', 1, 'Лунная колония \"Горизонт\"', 'высшая'),
(42, 11, '2020-08-15', 1, 'АПК', 'высшая');

-- --------------------------------------------------------

--
-- Структура таблицы `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `pin_id` int(11) DEFAULT NULL,
  `organization_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `ticket`
--

INSERT INTO `ticket` (`ticket_id`, `pin_id`, `organization_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 4, 2),
(6, 5, 3),
(7, 6, 1),
(8, 7, 2),
(9, 8, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patronymic` varchar(40) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `patronymic`) VALUES
(1, 'Илья', 'Симон', 'Павлович'),
(2, 'Ернияз', 'Есенжолов', 'Сейтжанович'),
(3, 'Дмитрий', 'Боднарь', 'Максимович'),
(4, 'Александр', 'Цапков', 'Валерьевич'),
(5, 'Ирина', 'Голубовская', 'Ярославна'),
(6, 'Жан', 'Есенжолов', 'Арманович'),
(7, 'Андрей', 'Тарасов', 'Андреевич'),
(8, 'Лилия', 'Королева', 'Петрова'),
(9, 'Виталий', 'Бенкс', 'Гаврилович'),
(17, 'Андрей', 'Петров', 'Ульянович'),
(18, 'Жан', 'Есенжолов', 'Арманович'),
(32, 'Зулифа', 'Амренова', 'Муслимовна'),
(33, 'Teacher', 'Test', 'Testovich'),
(34, 'Наиль', 'Галяветдинов', 'Боровски'),
(35, 'Глеб', 'Гришин', 'Антонович'),
(36, 'Жаннур', 'Нурлан', 'Армановна'),
(37, 'Салтанат', 'Аманова', 'Советбеккызы'),
(38, 'Эльнара', 'Есенжолова', 'Армановна'),
(39, 'Болат', 'Габдуллин', 'Серикулы'),
(40, 'Олжас', 'Сулейменов', 'Омарулы'),
(41, 'Siebren', 'de Kuiper', 'Sigmovich'),
(42, '456', '123', '789'),
(43, 'СтуденИмя', 'СтуденФамилия', 'СтуденОтчество');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `FK_course_coursetypes_coursetype_id` (`coursetype_id`);

--
-- Индексы таблицы `coursetypes`
--
ALTER TABLE `coursetypes`
  ADD PRIMARY KEY (`coursetype_id`);

--
-- Индексы таблицы `dolzhnost`
--
ALTER TABLE `dolzhnost`
  ADD PRIMARY KEY (`dolzhnost_id`);

--
-- Индексы таблицы `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`gender_id`);

--
-- Индексы таблицы `organization`
--
ALTER TABLE `organization`
  ADD PRIMARY KEY (`organization_id`);

--
-- Индексы таблицы `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`pin_id`),
  ADD KEY `FK_pin_course_course_id` (`course_id`),
  ADD KEY `FK_pin_teacher_teacher_id` (`teacher_id`);

--
-- Индексы таблицы `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_secondary`),
  ADD KEY `FK_student_dolzhnost_dolzhnost_id` (`dolzhnost_id`),
  ADD KEY `FK_student_user_user_id` (`student_id`);

--
-- Индексы таблицы `student_ticket`
--
ALTER TABLE `student_ticket`
  ADD PRIMARY KEY (`student_ticket_id`),
  ADD KEY `FK_student_ticket_ticket_ticket_id` (`ticket_id`),
  ADD KEY `FK_student_ticket_student_student_id` (`student_id`);

--
-- Индексы таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_secondary`),
  ADD KEY `FK_teacher_genders_gender_id` (`gender`),
  ADD KEY `FK_teacher_pin_teacher_id` (`teacher_id`);

--
-- Индексы таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `FK_ticket_organization_organization_id` (`organization_id`),
  ADD KEY `FK_ticket_pin_pin_id` (`pin_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `coursetypes`
--
ALTER TABLE `coursetypes`
  MODIFY `coursetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `dolzhnost`
--
ALTER TABLE `dolzhnost`
  MODIFY `dolzhnost_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `organization`
--
ALTER TABLE `organization`
  MODIFY `organization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pin`
--
ALTER TABLE `pin`
  MODIFY `pin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `student`
--
ALTER TABLE `student`
  MODIFY `student_secondary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `student_ticket`
--
ALTER TABLE `student_ticket`
  MODIFY `student_ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_secondary` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `FK_course_coursetypes_coursetype_id` FOREIGN KEY (`coursetype_id`) REFERENCES `coursetypes` (`coursetype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `pin`
--
ALTER TABLE `pin`
  ADD CONSTRAINT `FK_pin_course_course_id` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_pin_teacher_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `FK_student_dolzhnost_dolzhnost_id` FOREIGN KEY (`dolzhnost_id`) REFERENCES `dolzhnost` (`dolzhnost_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_user_user_id` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `student_ticket`
--
ALTER TABLE `student_ticket`
  ADD CONSTRAINT `FK_student_ticket_student_student_id` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_student_ticket_ticket_ticket_id` FOREIGN KEY (`ticket_id`) REFERENCES `ticket` (`ticket_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `FK_teacher_genders_gender_id` FOREIGN KEY (`gender`) REFERENCES `genders` (`gender_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_teacher_user_user_id` FOREIGN KEY (`teacher_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Ограничения внешнего ключа таблицы `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `FK_ticket_organization_organization_id` FOREIGN KEY (`organization_id`) REFERENCES `organization` (`organization_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ticket_pin_pin_id` FOREIGN KEY (`pin_id`) REFERENCES `pin` (`pin_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
