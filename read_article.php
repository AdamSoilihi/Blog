<?php
session_start();

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');

/**
 * Traitement des superglobales.
 */
$getData = $_GET;

if (!isset($getData['id']) || !is_numeric($getData['id'])) {
    echo('L\'article n\'existe pas');
    return;
}

// On récupère l'article
//r.*, c.comment_id, c.comment, c.user_id, u.full_name FROM recipes r 
//LEFT JOIN comments c on c.article_id = r.article_id
//LEFT JOIN users u ON u.user_id = c.user_id
//WHERE r.article_id = :id ');

$retrieveArticleWithCommentsStatement = $mysqlClient->prepare('SELECT * , commentaires.idCommentaire, commentaires.idUtilisateur, commentaires.contenuCommentaire, commentaires.dateCreationCommentaire 
FROM articles 
JOIN commentaires 
ON commentaires.idArticle=articles.idArticle 
JOIN utilisateurs 
ON utilisateurs.idUtilisateur=commentaires.idUtilisateur 
WHERE articles.valideArticle = 1 AND commentaires.valideCommentaire = 1 
AND utilisateurs.valideUtilisateur=1 AND articles.idArticle=:id;');
$retrieveArticleWithCommentsStatement ->execute([
    'id' => (int)$getData['id'],
]);
$artcileWithComments = $retrieveArticleWithCommentsStatement->fetchAll(PDO::FETCH_ASSOC);

if ($artcileWithComments === []) {
    echo('L\'article n\'existe pas');
    return;
}

$article = [
    'article_id' => $artcileWithComments[0]['idArticle'],
    'titreArticle' => $artcileWithComments[0]['titreArticle'],
    'contenuArticle' => $artcileWithComments[0]['contenuArticle'],
    'nomUtilisateur' => $artcileWithComments[0]['nomUtilisateur'],
    'comments' => [],
];

foreach ($artcileWithComments as $comment) {
    if (!is_null($comment['idCommentaire'])) {
        $article['comments'][] = [
            'comment_id' => $comment['idCommentaire'],
            'comment' => $comment['contenuCommentaire'],
            'user_id' => (int) $comment['idUtilisateur'],
            'full_name' => $comment['nomUtilisateur']
        ];
    }
}
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

    <title>Blog - <?php echo($article['titreArticle']); ?></title>
    
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
                <h1><?php echo($article['titreArticle']); ?></h1>
                    
                        <div class="ligne-catalogue">
                            <article>
                                <?php echo($article['contenuArticle']); ?>
                            </article>
                            <aside>
                                <p><i>Contribuée par <?php echo($article['nomUtilisateur']); ?></i></p>
                            </aside>
                        </div> 
                        <hr />
                        <h4>Commentaires</h4>
                        <?php if ($article['comments'] !== []) : ?>
                                
                                    <?php foreach ($article['comments'] as $comment) : ?>
                                        <div>
                                            <p><?php echo $comment['comment']; ?></p>
                                            <i>(<?php echo $comment['full_name']; ?>)</i>
                                        </div>
                                    <?php endforeach; ?>
                        <?php else : ?>
                            <div>
                                <p>Aucun commentaire</p>
                            </div>
                        <?php endif; ?>
                        <hr />
                        <?php if (isset($_SESSION['loggedUser'])) : ?>
                            <?php require_once(__DIR__ . '/create_comment.php'); ?>
                        <?php endif; ?>
                    
            </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>