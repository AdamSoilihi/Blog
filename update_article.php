<?php
session_start();

require_once(__DIR__ . '/isConnect.php');
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */
$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('Il faut un identifiant de l\'article pour la modifier.');
    return;
}

$retrieveArticleStatement = $mysqlClient->prepare('SELECT * FROM articles WHERE articles.idArticle = :id');
$retrieveArticleStatement->execute([
    'id' => (int)$getData['id'],
]);
$article = $retrieveArticleStatement->fetch(PDO::FETCH_ASSOC);

// si l'article n'est pas trouvé, renvoyer un message d'erreur
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

    <title>Blog - Modifications</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    
    <main>
        <section class="section-contact">
        <h1>Mettre à jour <?php echo($article['titreArticle']); ?></h1>

            <form action="post_update_article.php" method="POST">

                <div class="form-nom-email">
                    <div class="form-column">
                        
                        <input type="hidden" name="id" id="id" value="<?php echo($getData['id']); ?>">
                    </div>                
                </div>

                <div class="form-nom-email">
                    <div class="form-column">
                        <label for="titreArticle">Titre de l'article</label>
                        <input type="text" name="titreArticle" id="titreArticle" value="<?php echo($article['titreArticle']); ?>">
                    </div>                
                </div>
                
                <div class="form-nom-email">
                    <div class="form-column">               
                        <label for="chapoArticle">Chapo de l'article</label>
                        <textarea name="chapoArticle" id="chapoArticle" rows="8"><?php echo $article['chapoArticle']; ?></textarea>
                    </div>
                </div>

                <div class="form-nom-email">
                    <div class="form-column">
                    <label for="contenuArticle">Contenu de l'article</label>
                    <textarea name="contenuArticle" id="contenuArticle" rows="12"><?php echo $article['contenuArticle']; ?></textarea>
                </div>
            </div>
                <input type="submit" class="btn btn-primary" value="Envoyer">
            </form>
        </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>
