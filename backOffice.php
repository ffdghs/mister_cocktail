<?php
    require 'lib/database.php';
    require 'models/cocktail.php';

    session_start();

    $msg = '';

    $listeFamille = listerFamille();

    $nbreCocktails = nbreCocktails();

    if (isset($_GET['action']) && !empty($_GET['id'])) {
        if ($_GET['action'] == 'supprimer') {
            supprimerCocktail($_GET['id']);
            $msg = '<div class="alert alert-success mb-3">Le cocktail numéro ' . $_GET['id'] . ' a bien été supprimé de la base de données</div>';
        }
    }

    if (isset($_GET['categorie'])) {
        $listeCocktailsBO = listerCocktailsCat($_GET['categorie']);
    }
    else {
        $listeCocktailsBO = listerCocktailsBO();
    }

    if (isset($_GET['recherche'])) {
        $argument = '%' . trim($_GET['recherche']) . '%';
        $listeCocktailsBO = searchCocktail($argument);
    }

    // else {
    //     $listeCocktailsBO = listerCocktailsBO();
    // }


    // $_SESSION['msg'] = '';
    
    
    include 'templates/backOffice.phtml';
?>