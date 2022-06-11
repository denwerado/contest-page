CREATE TABLE `tenoten_logins`(
  `id` int NOT NULL primary key AUTO_INCREMENT,
  `login` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(255),
  `check_test` BOOLEAN
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;