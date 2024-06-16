<?php
require_once(__DIR__ . '/isConnect.php');
?>

<form action="comment_post_create.php" method="POST">
    
    <div class="form-nom-email">
        <div class="form-column">
            <label for="comment" class="form-label">Postez votre commentaire</label>
            <textarea class="form-label" id="commentaire" name="commentaire"></textarea>
        </div>   
    </div>
    <button type="submit" class="bouton" >Envoyer</button>
</form>