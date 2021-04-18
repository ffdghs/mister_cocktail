<?php
    require 'lib/database.php';
    require 'models/cocktail.php';

    session_start();

    $msg = '';

    $_SESSION['msg'] = '';

    // On vérifie l'url
    if (!isset($_GET['id'])) {
        header('location:index.php');
        exit(); // cette fonction permet de bloquer le reste de l'exécution du code (par défaut on redirige mais le reste du code php s'exécute)
    }

    $cocktailModif = detailCocktailsBO($_GET['id']);

    if (!$cocktailModif) {
        header('location:index.php');
        exit();
    }
    
    $listeDesCategories = listeDesCat();

    if (isset($_POST['nom']) 
        && isset ($_POST['idFamille'])
        && isset ($_POST['desc'])
        && isset ($_POST['date'])
        && isset ($_POST['prix'])
    ) {
        $date = $_POST['date'] . '-01-01';
        modifCocktail($_POST['nom'],$_POST['idFamille'],$_POST['desc'],$date,$_POST['prix'],$_POST['id']);
        $_SESSION['msg'] = '<div class="alert alert-success mb-3">Le cocktail <strong>' . $_POST['nom'] .'</strong> a bien été modifié dans la base de données</div>';
        header('location:backOffice.php');
    }

    include 'templates/editionCocktail.phtml';

    // :FINIR LES CONTROLES
?>

 