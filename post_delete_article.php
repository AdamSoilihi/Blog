<?php

session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/functions.php');

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (!isset($postData['id']) || !is_numeric($postData['id'])) {
    echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}

$deleteArticleStatement = $mysqlClient->prepare('DELETE FROM articles WHERE articles.idArticle = :id');
$deleteArticleStatement->execute([
    'id' => (int)$postData['id'],
]);

redirectToUrl('index.php');