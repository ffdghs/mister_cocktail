<?php
    require 'lib/database.php';
    require 'models/cocktail.php';

    session_start();

    $_SESSION['msg'] = '';

    // unset() supprime l'indice d'un tableau ex : unset($_SESSION['msg'])

    $message = '';

    // Récupération du contenu de la page via la fonction définie dans Models/cocktail.php
    if (isset($_GET['categorie'])) {
        $listeCocktails = listerCocktailsCat($_GET['categorie']);
        //// echo print_r($_GET);
    }
    else {
        $listeCocktails = listerCocktails();
    }

    //// echo '<pre>';
    //// print_r($listeCocktails);
    //// echo '</pre>';

    if (isset($_GET['recherche'])) {
        $argument = '%' . trim($_GET['recherche']) . '%';
        $listeCocktails = searchCocktail($argument);

        if (empty($listeCocktails)) {
            $message = 'Cette recherche ne retourne pas de résultats';
        }
    }

    // Récupération de la liste des familles avec le nombre de cocktails dans chaque famille
    $listeFamille = listerFamille();

    // Récupération du nombre total de cocktails
    $nbreCocktails = nbreCocktails();

    include 'templates/index.phtml';

?>
