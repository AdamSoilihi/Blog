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

    <title>Blog - Les utilisateurs non validés</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
            <section class="presentation">
                <div>
                    <h1>Les utilisateurs non validés</h1>
                </div>    
            </section>
            
            <section class="catalogue">
                <h2>Les utilisateurs non validés</h2>
                    <?php foreach ($utilisateursNonValides as $utilisateur) : ?>
                        <div >
                            <h4>
                                <a href="read_user.php?id=<?php echo($utilisateur['idUtilisateur']); ?>" ><?php echo $utilisateur['nomUtilisateur']; ?></a>
                            </h4>
                                                      
                                <!-- Affichage d'option si l'utilisateur est identifié -->
                            <?php if(isset($_SESSION['loggedUser']) && $_SESSION['loggedUser']['administrateur']===1):?>
                                <a href="delete_user.php?id=<?php echo($utilisateur['idUtilisateur']); ?>">Supprimer l'utilisateur</a>
                                <a href="update_user_non_valide.php?id=<?php echo($utilisateur['idUtilisateur']); ?>">Valider l'utilisateur</a>
                            <?php endif;?>
                            <br><br>
                        </div> 
                    <?php endforeach ?>
                    
            </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>
