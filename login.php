<?php

/**
 * On ne traite pas les super globales provenant de l'utilisateur directement,
 * ces données doivent être testées et vérifiées.
 */

$postData = $_POST;


// Validation du formulaire
if (isset($postData['nom']) &&  isset($postData['password'])) {
	//foreach
        foreach ($utilisateurs as $user) {
        	if (
            	$user['nomUtilisateur'] === $postData['nom'] &&
            	$user['motDePasse'] === $postData['password']
        	) {
            	$loggedUser = [
                	'nom' => $user['nomUtilisateur'],
            	];
        	}
    	}
        //fin foreach

        //test de loggedUser
    	if (!isset($loggedUser)) {
        	$errorMessage = sprintf(
            	'Vous n\'êtes pas identifié, Saisissez les bonnes informations'	);
    	}
        //fin du test loggedUser
	}


?>

	<!--
   	Si utilisateur/trice est non identifié(e), on affiche le formulaire
	-->
<?php if (!isset($loggedUser)) : ?>

	<form action="index.php" method="POST">
    	<!-- si message d'erreur on l'affiche -->
    	<?php if (isset($errorMessage)) : ?>
        	<div class="alert alert-danger" role="alert">
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
			<input type="submit" value="CONNEXION" class="bouton" >
	</form>
    
	<!-- Si utilisateur/trice bien connectée on affiche un message de succès -->
<?php else : ?>
	<div role="alert">
    	<P>Bonjour <?php echo $loggedUser['nom']; ?> et bienvenue sur le site !</P>
	</div>
<?php endif; ?>