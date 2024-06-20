<?php

require_once(__DIR__ . '/config/mysql.php');
require_once(__DIR__ . '/databaseconnect.php');
require_once(__DIR__ . '/variables.php');
require_once(__DIR__ . '/functions.php');
require_once(__DIR__ . '/isConnect.php')
?>

<form action="comment_post_create.php" method="POST">
     <input  type="hidden" name="id" value="<?php echo($getData['id']); ?>" />
        
    <div class="form-nom-email">
        <div class="form-column">
            <label for="comment" class="form-label">Postez votre commentaire</label>
            <textarea class="form-label" id="commentaire" name="commentaire"></textarea>
        </div>   
    </div>
    <button type="submit" class="bouton" >Envoyer</button>
</form>