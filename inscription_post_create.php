<?php
session_start();
require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');

/**
 * Traitement des superglobales soumis venant du formulaire
 */
$postData = $_POST;

// Vérification du formulaire soumis
if (
    empty($postData['nom'])
    || empty($postData['email'])
    || empty($postData['pwd'])
    || trim(strip_tags($postData['nom'])) === ''
    || trim(strip_tags($postData['email'])) === ''
    || trim(strip_tags($postData['pwd']))===''
) {
    echo 'Tous les champs sont obligatoires';
    return;
}else{
    foreach($utilisateurs as $users){
        if($users['email'] === $postData['email']){
            $messageError sprintf('email existant');
            
        }
    }
}

$nom = trim(strip_tags($postData['nom']));
$email = trim(strip_tags($postData['email']));
$pwd = trim(strip_tags($postData['pwd']));


// Faire l'insertion en base
$createUser = $mysqlClient->prepare('INSERT INTO utilisateurs(nomUtilisateur, email, motDePasse, administrateur, valideUtilisateur) VALUES (:nomUtilisateur, :email, :motDePasse, :administrateur, :valideUtilisateur)');
$createUser->execute([
    'nomUtilisateur' => $nom,
    'email' => $email,
    'motDePasse' => $pwd,
    'administrateur' => 0,
    'valideUtilisateur' => 0,
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
                    <h1>Présentation</h1>
                    <p> </p>
                    <a href="contact.php" class="bouton">Nous contacter</a>
                </div>    
            </section>
                
            <section class="catalogue">
                <!-- MESSAGE DE SUCCES -->
                <h1>Utilisateur ajouté et en attente de validation !</h1>
            </section>
    </main>
    <footer>
        <?php require_once(__DIR__.'/footer.php');?>
    </footer>
   
</body>
</html>