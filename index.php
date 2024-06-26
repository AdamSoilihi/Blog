<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
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
                    <h1>Présentation</h1>
                    <p> </p>
                    <a href="contact.php" class="bouton">Nous contacter</a>
                </div>    
            </section>
            <section class="section-contact">
                <!-- Formulaire de connexion -->
    	        <?php require_once(__DIR__ . '/login.php'); ?>
            </section>
                
            <section class="catalogue">
                <?php if (isset($loggedUser)) : ?>
                    <h2>Les articles</h2>
                        <?php foreach (getArticles($articles) as $article) : ?>
                            <div class="ligne-catalogue">
                                <article>
                                    <h3><?php echo $article['titreArticle']; ?></h3>
                                    <div><?php echo $article['chapoArticle']; ?></div>
                                    <i><?php echo displayAuthor($article['nomUtilisateur'], $utilisateurs); ?></i>
                                </article>
                            </div> 
                        <?php endforeach ?>
                <?php endif; ?>                                          
                              
            </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>