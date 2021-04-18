CREATE DATABASE `MisterCocktails`;

USE `MisterCocktails`;

DROP TABLE IF EXISTS `Famille`;

CREATE TABLE `Famille` (
    `id` INT(11),
    `nomFamille` VARCHAR(255) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `Cocktail`;

CREATE TABLE `Cocktail` (
    `id` INT(11),
    `nom` VARCHAR(255),
    `description` TEXT, 
    `urlPhoto` VARCHAR(255),
    `dateConception` DATE, 
    `prixMoyen` FLOAT, 
    `idFamille` INT(11)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `Famille`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `Cocktail`
    ADD PRIMARY KEY (`id`);

