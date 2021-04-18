<?php
    require 'lib/database.php';
    require 'models/cocktail.php';

    session_start();

    $msg       = '';  // Variable nous permettant d'afficher un message d'erreur utilisateur dans le .phtml
    $msgFam    = '';
    $msgValide = '';
    $errorSQL2 = 1;

    $nom             = '';
    $desc            = '';
    $prixMoyen       = '';
    $idFamille       = '';
    $anneeConception = '';
    $doublon         = false;

    $msgRelation = '';


    //! Ajout cocktail v1
    // if (isset($_POST['nom'])
    // && isset($_POST['description'])
    // && isset($_POST['prixMoyen'])
    // && isset($_POST['idFamille'])
    // && isset($_POST['anneeConception'])
    // && isset($_FILES['urlPhoto']['name'])
    // ) {
    //     $nom = trim($_POST['nom']);
    //     $desc = trim($_POST['description']);
    //     $prixMoyen = trim($_POST['prixMoyen']);
    //     $idFamille = trim($_POST['idFamille']);
    //     $anneeConception = trim($_POST['anneeConception']) . '-01-01';
    //     $urlPhoto = trim($_FILES['urlPhoto']['name']);

    //     ajoutCocktail($nom,$desc,$prixMoyen,$idFamille,$anneeConception,$urlPhoto);
    // }

    //: Fonction d'ajout d'une relation entre un cocktail et un ingrédient

    if (isset($_POST['listeCocktail']) && isset($_POST['listeIngredient'])) {
        $verifRelation = verifRelation($_POST['listeCocktail'],$_POST['listeIngredient']);
        if (!$verifRelation) {
            $relation = ajoutRelation($_POST['listeCocktail'],$_POST['listeIngredient']);
            $msgRelation .= '<div class="alert alert-success mb-3">L\'ingredient a bien été ajouté au cocktail</div>';
        }
        else {
            $msgRelation .= '<div class="alert alert-danger mb-3">Cette relation existe déjà</div>';
        }
    }

    //: Fonction d'ajout d'une famille dans la BDD

    if (isset($_POST['nomFamille'])) {
        $_POST['nomFamille'] = trim($_POST['nomFamille']);
        $verifFamille = verifFamille($_POST['nomFamille']);

        if ($verifFamille > 0) {
            $msgFam .= '<div class="alert alert-danger mb-3">La catégorie ' . $_POST['nomFamille'] . ' existe déjà dans la base de données</div>';
        }

        else {
            ajoutFamille($_POST['nomFamille']); 
        }
    }

    //: Fonction d'ajout d'un ingredient dans la BDD

    if (isset($_POST['nomIngredient'])) {
        $_POST['nomIngredient'] = trim($_POST['nomIngredient']);
        $verifIngredient = verifIngredient($_POST['nomIngredient']);

        if ($verifIngredient > 0) {
            $msgIng .= '<div class="alert alert-danger mb-3">L\'ingredient ' . $_POST['nomIngredient'] . ' existe déjà dans la base de données</div>';
        }

        else {
            ajoutIngredient($_POST['nomIngredient']); 
        }
    }

    //: Fonction d'ajout d'un cocktail dans la BDD
    
    if (isset($_POST['nom'])
    && isset($_POST['description'])
    && isset($_POST['prixMoyen'])
    && isset($_POST['anneeConception'])
    ) {

        // On applique un trim sur toutes les valeurs dans $POST
        foreach($_POST AS $indice => $valeur) {
            $_POST[$indice] = trim($valeur);
        }

        $erreur = false; //? Variable de contrôle des erreurs

        if (empty($_POST['idFamille'])) {
            $msg .= '<div class="alert alert-danger mb-3">Attention vous devez choisir une catégorie de cocktail</div>';
            $erreur = true;
        }

        //! 1ere partie gestion de l'image

        $urlPhoto = ''; // On crée une variable vide pour la requête SQL et si une photo a été chargée, on remplacera le contenu de la variable


        // On vérifie si une photo a bien été chargée
        // if($_FILES['urlPhoto']['error'] == UPLOAD_ERR_OK) {}

        if(!empty($_FILES['urlPhoto']['name'])) {
            // on récupère l'extension de la photo pour pouvoir contrôler le format
            // strrchr() // fonction prédéfinie permettant de découper une chaîne de caractères en partant de la fin selon un caractère fourni en argument
            $extension = strrchr($_FILES['urlPhoto']['name'],'.');

            // On enlève le point '.' de l'extension
            $extension = substr($extension,1);
            // On force la chaîne à être en minuscule
            $extension = strtolower($extension);

            // On crée un tableau array contenant les extensions acceptées
            $extensionValide = array('jpg','jpeg','webp','png','gif');
            
            // in_array permet de vérifier si le premier argument fait partie du tableau fourni en deuxième argument
            if(in_array($extension,$extensionValide)) {
                // extension OK on peut enregistrer l'image
                // On renomme l'image car si on enregistre une image du même nom qu'une image déjà présente la nouvelle image va écraser l'ancienne
                // uniqid fonction prédéfinie nous renvoyant un chiffre basé sur les microsecondes
                $urlPhoto = uniqid() . '-' . $_FILES['urlPhoto']['name'];


                // __DIR__ est une constante magique renvoyant le chemin complet jusqu'au répertoire contenant le fichier sur lequel on travaille
                $dir = __DIR__ . '/assets/images/cocktails/' . $urlPhoto;
                
                // move_uploaded_file() permet d'enregistrer un fichier depuis un emplacement vers un autre
                move_uploaded_file($_FILES['urlPhoto']['tmp_name'],$dir);
            
            }
            else {
                $msg .= '<div class="alert alert-danger mb-3">Attention l\'extension de l\'image n\'est pas valide.<br>Extensions autorisées : jpg / jpeg / webp / png / gif</div>';
                $erreur = true;
            } //* Fin de vérif de l'extension
        } //* Fin photo chargée


        
        
        //! 2eme partie 
        
        $nom = $_POST['nom'];
        $desc = $_POST['description'];
        $prixMoyen = str_replace(',','.',$_POST['prixMoyen']);
        $idFamille = $_POST['idFamille'];
        $anneeConception = $_POST['anneeConception'] . '-01-01';

        
        //? Vérification du format de prix

        if(!is_numeric($prixMoyen)) {
            $msg .= '<div class="alert alert-danger mb-3">Attention le prix doit être une valeur numérique</div>';
            $erreur = true;
        }

        //? Vérification du format de date

        if(!is_numeric($_POST['anneeConception']) || iconv_strlen($_POST['anneeConception']) != 4) {
            $msg .= '<div class="alert alert-danger mb-3">Attention la date doit être au format AAAA</div>';
            $erreur = true;
        }

        //? Vérification du format de nom

        if(empty($_POST['nom'])) {
            $msg .= '<div class="alert alert-danger mb-3">Attention le nom du cocktail est obligatoire</div>';
            $erreur = true;
        }

        // Vérification s'il n'y a pas d'erreurs
        if ($erreur == false) {

            $errorSQL = ajoutCocktail($nom,$desc,$prixMoyen,$idFamille,$anneeConception,$urlPhoto);
            $errorSQL2 = $errorSQL[0];

            $cocktailAjoute = searchCocktail($nom);

            if ($errorSQL2 == 0) {
                $msgValide = '<div class="alert alert-success mb-3">Le cocktail ' . $nom .' a bien été ajouté à la base de données</div>';
                $nom = '';
                $desc = '';
                $prixMoyen = '';
                $idFamille = '';
                $anneeConception = '';
            }

            else {
                $msg .= '<div class="alert alert-danger mb-3">Le cocktail ' . $nom .' n\'a pas pu être ajouté à la base de données</div>';
            }

        }






    } //* Fin des issets POST

    $listeIngredients = listeIngredient();

    $listeDesCategories = listeDesCat();

    $listeCocktails = listerCocktailsBO();

    include 'templates/ajoutCocktail.phtml';
?>