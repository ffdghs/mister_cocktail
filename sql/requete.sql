-- Faire une requête pour récupérer les champs suivants :
-- id du cocktail
-- nom
-- nomFamille
-- description
-- urlPhoto
-- YEAR(dateConception) -- pour obtenir l'année uniquement
-- prixMoyen

SELECT Cocktail.id, nom, nomFamille, description, urlPhoto, YEAR(dateConception) AS anneeConception, prixMoyen
FROM Cocktail
INNER JOIN Famille ON idFamille = Famille.id;

SELECT idFamille, nomFamille, COUNT(idFamille) AS nbreParFamille
FROM Cocktail
INNER JOIN Famille ON idFamille = Famille.id
GROUP BY idFamille, nomFamille;

SELECT COUNT(nom)
FROM Cocktail;

SELECT Cocktail.id, nom, nomFamille, description, urlPhoto, YEAR(dateConception) AS anneeConception, prixMoyen
FROM Cocktail
INNER JOIN Famille ON idFamille = Famille.id
WHERE nom LIKE ?;

SELECT *
FROM Famille
ORDER BY nomFamille;

DESC cocktail;

INSERT INTO `Cocktail` (`id`,`nom`,`description`,`urlPhoto`,`prixMoyen`,`idFamille`,`dateConception`)
VALUES (NULL,'test','test','test','2','1','2020-01-01');


SELECT 
                Cocktail.id, 
                nom, 
                nomFamille,
                description,
                dateConception,
                prixMoyen,  
                urlPhoto
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            WHERE Cocktail.id = 1;