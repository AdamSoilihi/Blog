<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');


/**
 * Traitement des superglobales.
 */
$postData = $_POST;
$getData = $_GET;

if (
    !isset($postData['commentaire']) ||
    !isset($getData['id']) ||
    !is_numeric($getData['id'])
) {
    echo('Le commentaire est invalide.');
    
    return;
}

$comment = trim(strip_tags($postData['commentaire']));
$idArticle = (int)$postData['id'];

if ($comment === '') {
    echo 'Le commentaire ne peut pas être vide.';
    return;
}

$insertComment = $mysqlClient->prepare('INSERT INTO commentaires(contenuCommentaire, idArticle, idUtilisateur) 
VALUES (:contenuCommentaire, :idArticle, :idUtilisateur)');
$insertComment->execute([
    'contenuCommentaire' => $comment,
    'idArticle' => $idArticle,
    'idUtilisateur' => $_SESSION['loggedUser']['idUtilisateur'],
    'dateCreationCommentaire' => date("Y-m-d"),
    'valideCommentaire' => 0,
]);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/fpa-favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Work+Sans:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/style.css">

    <title>Blog - Création de commentaires</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
            <section class="presentation">
                <div>
                    <h1>Présentation</h1>
                    
                    <a href="contact.php" class="bouton">Nous contacter</a>
                </div>    
            </section>
                
            <section class="catalogue">
                <h2>Commentaire ajouté avec succès !</h2>
                <div>
                    <div>
                        <p><b>Votre commentaire</b> : <?php echo strip_tags($comment); ?></p>
                    </div>
                </div>
            </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>