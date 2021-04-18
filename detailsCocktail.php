<?php
    require 'lib/database.php';
    require 'models/cocktail.php';

    session_start();

    $detailsCocktail = detailCocktailsBO($_GET['id']);

    $listeCocktailsFam = listerCocktailsCat($detailsCocktail['nomFamille']);

    $listeIngredients = listeIngredientPourUnCocktail($_GET['id']);

    include 'templates/detailsCocktail.phtml';

?>