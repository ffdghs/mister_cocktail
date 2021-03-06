<?php

    // Créer la fonction de connexion à la BDD
    // connectToDataBase()

    function connectToDatabase() {
        $dsn = 'mysql:dbname=MisterCocktails;host=localhost';
        $user = 'root';
        $password = '';
        $options = array (
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
        );
    
        $pdo = new PDO($dsn,$user,$password,$options);
        
        return $pdo;
    }
