CREATE TABLE `tenoten_calendar`(
  `id` int NOT NULL primary key AUTO_INCREMENT,
  `loginId` int NOT NULL,
  `moodId` int NOT NULL,
  `date` DATE NOT NULL,
  `dateInsert` DATE NOT NULL,
  `dateUpdate` DATE,
  `display` BOOLEAN,
  FOREIGN KEY (`loginId`) REFERENCES `tenoten_logins` (`id`),
  FOREIGN KEY (`moodId`) REFERENCES `tenoten_moods` (`id`)
) CHARACTER SET utf8 COLLATE utf8_unicode_ci;