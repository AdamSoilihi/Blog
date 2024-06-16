<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$postData = $_POST;

if (
    !isset($postData['id'])
    || !is_numeric($postData['id'])
    || empty($postData['titreArticle'])
    || empty($postData['chapoArticle'])
    || empty($postData['contenuArticle'])
    || trim(strip_tags($postData['titreArticle'])) === ''
    || trim(strip_tags($postData['chapoArticle'])) === ''
    || trim(strip_tags($postData['contenuArticle'])) === ''

) {
    echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}

$idArticle = (int)$postData['id'];
$titreArticle = trim(strip_tags($postData['titreArticle']));
$chapoArticle = trim(strip_tags($postData['chapoArticle']));
$contenuArticle = trim(strip_tags($postData['contenuArticle']));

$insertArticleStatement = $mysqlClient->prepare('UPDATE articles SET titreArticle = :titreArticle, chapoArticle = :chapoArticle, contenuArticle = :contenuArticle, valideArticle = :valideArticle, dateModificationArticle = :dateModificationArticle WHERE idArticle = :idArticle');
$insertArticleStatement->execute([
    'titreArticle' => $titreArticle,
    'chapoArticle' => $chapoArticle,
    'contenuArticle' => $contenuArticle,
    'idArticle' => $idArticle,
    'valideArticle'=>1,
    'dateModificationArticle'=>date("Y-m-d"),
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

    <title>Blog - Accueil</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
            <section class="presentation">
                <div>
                    <p><?php echo($titreArticle); ?></p>                    
                    <p ><b>Chapo de l'article</b> : <?php echo $chapoArticle; ?></p>
                    <p ><b>Nom de l'auteur</b> : <?php echo $_SESSION['loggedUser']['nom']; ?></p>
                </div>
            </section>

    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>