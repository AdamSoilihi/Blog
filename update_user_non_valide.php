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
$getData = $_GET;

if (
    !isset($getData['id'])
    || !is_numeric($getData['id'])
    

) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$idUtilisateur = (int)$getData['id'];

$valideUserStatement = $mysqlClient->prepare('UPDATE utilisateurs SET valideUtilisateur = :valideUtilisateur WHERE idUtilisateur = :idUtilisateur');
$valideUserStatement->execute([
    'valideUtilisateur'=>1,    
    'idUtilisateur' => $idUtilisateur,   
    
]);

redirectToUrl("utilisateurs_non_valides.php");
?>

