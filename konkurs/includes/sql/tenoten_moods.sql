CREATE TABLE `tenoten_moods`(
  `id` int NOT NULL primary key AUTO_INCREMENT,
  `mood` VARCHAR(255) UNIQUE NOT NULL,
  `severity` int UNIQUE NOT NULL
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;


INSERT INTO `tenoten_moods` (`mood`,`severity`)
VALUES
    ('Радостное',1),
    ('Позитивное',2),
    ('Нормальное',3),
    ('Грустное',4),
    ('Плохое',5)