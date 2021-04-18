<?php

    // index.php : appel de tous les cocktails avec le nom de leur famille

    //: REQUETE DE RECUPERATION DES COCKTAILS

    function listerCocktails() {
        
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT 
                Cocktail.id, 
                nom, 
                nomFamille, 
                description, 
                urlPhoto, 
                YEAR(dateConception) AS anneeConception, 
                prixMoyen
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            ORDER BY Cocktail.id;
        ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }
    
    //: REQUETE POUR FILTRER LES COCKTAILS

    function listerCocktailsCat($categorie) {
        
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT 
                Cocktail.id, 
                nom, 
                nomFamille, 
                description, 
                urlPhoto, 
                YEAR(dateConception) AS anneeConception, 
                prixMoyen
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            WHERE nomFamille = ?;
        ");

        $query->execute([ $categorie ]);

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    //: REQUETE POUR LISTER LES FAMILLES AYANT DES COCKTAILS ET LE NOMBRE DE COCKTAILS POUR LE MENU DEROULANT

    function listerFamille() {
        $pdo = connectToDatabase();
    
        $query = $pdo->prepare("
            SELECT idFamille, nomFamille, COUNT(idFamille) AS nbreParFamille
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            GROUP BY idFamille, nomFamille;
        ");
    
        $query->execute();
    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    //: REQUETE POUR OBTENIR LE NOMBRE TOTAL DE COCKTAILS DANS LA BDD

    function nbreCocktails() {
        $pdo = connectToDatabase();
    
        $query = $pdo->prepare("
            SELECT COUNT(nom) AS nbreCocktails
            FROM Cocktail;
        ");
    
        $query->execute();
    
        return $query->fetch(PDO::FETCH_ASSOC);
        
    }

    //: REQUETE POUR RECHERCHER UN COCKTAIL DANS LA NAVBAR
    
    function  searchCocktail($searchRequest) {
        $pdo = connectToDatabase();
    
        $query = $pdo->prepare("
            SELECT Cocktail.id, nom, nomFamille, description, urlPhoto, YEAR(dateConception) AS anneeConception, prixMoyen
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            WHERE nom LIKE ?;
        ");
    
        $query->execute([ $searchRequest ]);

    
        return $query->fetchAll(PDO::FETCH_ASSOC);
        

    };

    //: REQUETE POUR LISTER TOUTES LES CATEGORIE DE COCKTAILS DE LA BDD POUR LE SELECT DANS LA PAGE D'AJOUT

    function listeDesCat() {
        $pdo = connectToDatabase();
    
        $query = $pdo->prepare("
            SELECT *
            FROM Famille
            ORDER BY nomFamille;
        ");
    
        $query->execute();

    
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //: REQUETE POUR AJOUTER UN COCKTAIL A LA BDD

    function ajoutCocktail($nom,$desc,$prixMoyen,$idFamille,$anneeConception,$urlPhoto) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            INSERT INTO Cocktail
            (
                nom,
                description,
                urlPhoto,
                prixMoyen,
                idFamille,
                dateConception
            )
            VALUES 
            (
                ?,?,?,?,?,?
            );
        ");
        
        $query->execute(
            [ 
                $nom,
                $desc,
                $urlPhoto,
                $prixMoyen,
                $idFamille,
                $anneeConception 
            ]
        );

        return $query->errorInfo();

    }

    //: REQUETE DE RECUPERATION DE LA LISTE DES COCKTAILS POUR LE BACKOFFICE

    function listerCocktailsBO() {
    
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT 
                Cocktail.id, 
                nom, 
                nomFamille,  
                urlPhoto
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            ORDER BY Cocktail.id;
        ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);

    }

    //: REQUETTE POUR SUPPRIMER UN COCKTAIL

    function supprimerCocktail($id) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            DELETE
            FROM Cocktail
            WHERE id = ?;
        ");

        $query->execute([ $id ]);
    }


    //: REQUETE DE RECUPERATION DU COCKTAIL A MODIFIER

    function detailCocktailsBO($cocktail) {
    
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT 
                Cocktail.id, 
                nom,
                nomFamille,
                idFamille,
                description,
                YEAR(dateConception) AS anneeConception,
                prixMoyen,  
                urlPhoto
            FROM Cocktail
            INNER JOIN Famille ON idFamille = Famille.id
            WHERE Cocktail.id = ?;
        ");

        $query->execute([ $cocktail ]);

        return $query->fetch(PDO::FETCH_ASSOC);

    }

    //: REQUETE DE MODIFICATION D'UN COCKTAIL

    function modifCocktail($name,$famille,$desc,$date,$prix,$cocktail) {
    
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            UPDATE Cocktail
            SET 
                nom = ?,
                idFamille = ?,
                description = ?,
                dateConception = ?,
                prixMoyen = ?
            WHERE id = ?;
        ");

        $query->execute([ $name,$famille,$desc,$date,$prix,$cocktail ]);

    }

    //: REQUETE D'AJOUT D'UNE FAMILLE

    function ajoutFamille($famille) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            INSERT INTO Famille
            (
                nomFamille 

            )
            VALUES 
            (
                ?
            );
        ");
        
        $query->execute(
            [ 
                $famille,
  
            ]
        );

        return $query->errorInfo();

    }

    //: REQUETE DE VERIFICATION D'EXISTENCE DE FAMILLE

    function verifFamille($famille) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT *
            FROM famille
            WHERE nomFamille = ?;
        ");
        
        $query->execute([ $famille ]);

        return $query->rowCount();
    }

    //: REQUETE D'AJOUT D'UN INGREDIENT

    function ajoutIngredient($ingredient) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            INSERT INTO ingredient
            (
                nomIngredient

            )
            VALUES 
            (
                ?
            );
        ");
        
        $query->execute(
            [ 
                $ingredient
  
            ]
        );

        return $query->errorInfo();

    }

    //: REQUETE DE VERIFICATION D'EXISTENCE DE FAMILLE

    function verifIngredient($ingredient) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT *
            FROM ingredient
            WHERE nomIngredient = ?;
        ");
        
        $query->execute([ $ingredient ]);

        return $query->rowCount();
    }


    //: REQUETE POUR LISTER LES INGREDIENTS EXISTANTS

    function listeIngredient() {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT *
            FROM ingredient;
        ");

        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    //: REQUETE D'AJOUT D'UN INGREDIENT DANS UN COCKTAIL

    function ajoutRelation($idCocktail,$idIngredient) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            INSERT INTO relationCocktailIngredient
            (
                idCocktail,
                idIngredient
            )
            VALUES
            (
                ?,?
            )
        ");
        
        $query->execute(
            [ 
                $idCocktail,
                $idIngredient
  
            ]
        );

        return $query->errorInfo();

    }

    //: REQUETE DE VERIFICATION DE LA RELATION D'UN INGREDIENT AVEC UN COCKTAIL

    function verifRelation($idCocktail,$idIngredient) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT *
            FROM relationCocktailIngredient
            WHERE idIngredient = ? AND idCocktail = ?; 
        ");
        
        $query->execute(
            [ 
                $idCocktail,
                $idIngredient
  
            ]
        );

        return $query->rowCount();

    }


    function listeIngredientPourUnCocktail($idCocktail) {
        $pdo = connectToDatabase();

        $query = $pdo->prepare("
            SELECT nomIngredient
            FROM ingredient
            INNER JOIN relationCocktailIngredient ON id = idIngredient
            INNER JOIN Cocktail ON Cocktail.id = idCocktail
            WHERE Cocktail.id = ?;
        ");

        $query->execute([$idCocktail]);

        return $query->fetchAll(PDO::FETCH_ASSOC);



    }
    
    