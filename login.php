<?php
    session_start();
    require_once(__DIR__ . '/config/mysql.php');
    require_once(__DIR__ . '/databaseconnect.php');
    require_once(__DIR__ . '/variables.php');
    require_once(__DIR__ . '/functions.php');


    /**
     * On ne traite pas les super globales provenant de l'utilisateur directement,
     * ces données doivent être testées et vérifiées.
     */

    $postData = $_POST;


    // Validation du nom et du mot de passe saisis dans le formulaire
    if (isset($postData['nom']) &&  isset($postData['password'])) {
        
            foreach ($utilisateurs as $user) {
                if (
                    $user['nomUtilisateur'] === $postData['nom'] &&
                    $user['motDePasse'] === $postData['password']
                ) {
                    $_SESSION['loggedUser'] = [
                        'nom' => $user['nomUtilisateur'],
                        'idUtilisateur'=>$user['idUtilisateur'],
                    ];
                }
            }
            //fin foreach
    
            //test de loggedUser (utilisateur n'existe pas)
            if (!isset($_SESSION['loggedUser'])) {
                $errorMessage = sprintf(
                    'Vous n\'êtes pas identifié, Saisissez les bonnes informations'	);
            }
            //fin du test loggedUser
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

    <title>Blog - Login</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
            
        <section class="section-contact">
                <!--
                Si utilisateur/trice est non identifié(e), on affiche le formulaire
                -->
            <?php if (!isset($_SESSION['loggedUser'])) : ?>

                <form action="login.php" method="POST">
                    <!-- si message d'erreur on l'affiche -->
                    <?php if (isset($errorMessage)) : ?>
                        <div>
                            <?php echo $errorMessage; ?>
                        </div>
                    <?php endif; ?>
                        <div class="form-nom-email">
                            <div class="form-column">
                                <label for="nom">Nom complet</label>
                                <input type="text" name="nom" id="nom" placeholder="Ex: Adam Ibouroi">
                            </div>   
                        </div>
                        <div class="form-nom-email">
                            <div class="form-column">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" name="password">
                            </div>   
                        </div>
                        <input type="submit" value="SE CONNECTER" class="bouton" >
                </form>
                
                <!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
            <?php else : ?>
                <div>
                    <?php redirectToUrl("index.php");?>
                </div>
            <?php endif; ?>
        </section>
           
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>