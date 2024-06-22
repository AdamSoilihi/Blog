<?php

// Récupération des variables à l'aide du client MySQL

//Récupération de tous les utilisateurs validés
$usersStatement = $mysqlClient->prepare('SELECT * FROM utilisateurs');
$usersStatement->execute();
$utilisateurs = $usersStatement->fetchAll();

//Recupération des utilisateurs non validés
$usersNonValideStatement = $mysqlClient->prepare('SELECT * FROM utilisateurs WHERE valideUtilisateur=:valideUtilisateur');
$usersNonValideStatement->execute(['valideUtilisateur'=>0,]);
$utilisateursNonValides = $usersNonValideStatement->fetchAll();

//récupérations des articles validés
$sqlQuery = 'SELECT *, utilisateurs.nomUtilisateur,utilisateurs.administrateur  FROM articles JOIN utilisateurs ON
                 articles.idUtilisateur = utilisateurs.idUtilisateur WHERE valideArticle = :valideArticle';
$articlesStatement = $mysqlClient->prepare($sqlQuery);
$articlesStatement->execute(['valideArticle'=>1,]);
$articles = $articlesStatement->fetchAll();

//Articles non validés
$reqSql = 'SELECT *, utilisateurs.nomUtilisateur,utilisateurs.administrateur  FROM articles JOIN utilisateurs ON
                 articles.idUtilisateur = utilisateurs.idUtilisateur WHERE valideArticle = :valideArticle';
$ArticleNonValideStatement=$mysqlClient->prepare($reqSql);
$ArticleNonValideStatement->execute(['valideArticle'=>0,]);
$ArticleNonValides=$ArticleNonValideStatement->fetchAll();


