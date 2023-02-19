CREATE DATABASE IF NOT EXISTS `bd-list`;
USE `bd-list`;

CREATE TABLE IF NOT EXISTS `type-users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`id`)
);
INSERT INTO `type-users` (`type`) VALUES ("normal-user"), ("admin");

CREATE TABLE IF NOT EXISTS `users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(200) NOT NULL,
    `password` VARCHAR(250) NOT NULL,
    `typeUser` int(11) NOT NULL,
    `photo` VARCHAR(250),
    PRIMARY KEY (`id`)
);
ALTER TABLE `users` ADD CONSTRAINT fk_idTypeUser FOREIGN KEY (`typeUser`)
    REFERENCES `type-users` (`id`) ON DELETE  NO ACTION  ON UPDATE  NO ACTION;

CREATE TABLE IF NOT EXISTS `normal-users`(
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `idUser` int(11) NOT NULL,
    PRIMARY KEY (`id`)
);
ALTER TABLE `normal-users` ADD CONSTRAINT fk_idUser FOREIGN KEY (`idUser`)
REFERENCES `users` (`id`) ON DELETE  NO ACTION  ON UPDATE  NO ACTION;