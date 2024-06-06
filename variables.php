<?php

// Récupération des variables à l'aide du client MySQL

//Récupération de tous les utilisateurs validés
$usersStatement = $mysqlClient->prepare('SELECT * FROM utilisateurs');
$usersStatement->execute();
$utilisateurs = $usersStatement->fetchAll();

//récupérations des articles validés
$sqlQuery = 'SELECT *, utilisateurs.nomUtilisateur FROM articles JOIN utilisateurs ON
                 articles.idUtilisateur = utilisateurs.idUtilisateur WHERE valideArticle = :valideArticle';

$articlesStatement = $mysqlClient->prepare($sqlQuery);
$articlesStatement->execute(['valideArticle'=>1,]);
$articles = $articlesStatement->fetchAll();
?>