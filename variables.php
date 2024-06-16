<?php

// Récupération des variables à l'aide du client MySQL

//Récupération de tous les utilisateurs validés
$usersStatement = $mysqlClient->prepare('SELECT * FROM utilisateurs');
$usersStatement->execute();
$utilisateurs = $usersStatement->fetchAll();

//récupérations des articles validés
$sqlQuery = 'SELECT *, utilisateurs.nomUtilisateur,utilisateurs.administrateur  FROM articles JOIN utilisateurs ON
                 articles.idUtilisateur = utilisateurs.idUtilisateur WHERE valideArticle = :valideArticle';
//$sqlQuery = 'SELECT * FROM articles_valides_vw';

$articlesStatement = $mysqlClient->prepare($sqlQuery);
$articlesStatement->execute(['valideArticle'=>1,]);
$articles = $articlesStatement->fetchAll();


$reqSql=('SELECT * 
            FROM articles.comments
            WHERE  articles.comments.idArticle=:idArticle');
$sqlArticleComment=$mysqlClient->prepare($reqSql);

