<?php

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;

if (
    !isset($postData['email'])
    || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
    || empty($postData['message'])
    || trim($postData['message']) === ''
    || empty($postData['nom'])
    || trim($postData['nom']) === ''
    || empty($postData['objet'])
    || trim($postData['objet']) === ''
) {
    echo('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
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

    <title>Blog - Contact</title>
    
</head>
<body>

    <header>
        <?php require_once(__DIR__.'/header.php');?>
    </header>
    <main>
        <section class="section-contact">
                
            <h1>Message bien reçu !</h1>

                <div>
                    <h5>Rappel de vos informations</h5>
                    <p><b>Nom</b> : <?php echo(strip_tags($postData['nom'])); ?></p>
                    <p><b>Email</b> : <?php echo($postData['email']); ?></p>
                    <p><b>Objet</b> : <?php echo(strip_tags($postData['objet'])); ?></p>
                    <p><b>Message</b> : <?php echo(strip_tags($postData['message'])); ?></p>
                </div>
        </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>