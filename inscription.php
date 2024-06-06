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

    <title>Blog - Création d'un compte</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
        <section class="section-contact">
            <h2>Création d'un compte</h2>
            <form method="POST" action="inscription_post_create.php">
                <div class="form-nom-email">
                    <div class="form-column">
                        <label for="nom">Nom complet</label>
                        <input type="text" name="nom" id="nom" placeholder="Adam Soilihi">
                    </div>
                
                </div>
                <div class="form-nom-email">
                    <div class="form-column">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="exemple-email@gmail.com">
                    </div>
                </div>

                <div class="form-nom-email">
                    <div class="form-column">
                        <label for="pwd">Mot de passe</label>
                        <input type="password" name="pwd" id="pwd">
                    </div>
                </div>
            </div>
                <input type="submit" value="VALIDER" class="bouton" >
            </form>
        </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>