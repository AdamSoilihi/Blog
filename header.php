<nav>
                
    <img src="#" alt="Logo de mon Blog" >
                
    <div>
        <a href="index.php" >Accueil</a>
        <a href="articles.php">Les articles</a>
        <a href="contact.php" >Contact</a>
      
        <?php if(isset($_SESSION['loggedUser'])):?>            
            <a href="Create_article.php" >Créer un article</a>
            <a href="logout.php" >Se deconnecter</a>
            <?php if($_SESSION['loggedUser']['administrateur']===1):?>
                <a href="utilisateurs_non_valides.php" >Utilisateurs</a>
                <a href="articles_non_valides.php" >Articles non validés</a>
            <?php endif;?>
        <?php else:?>            
            <a href="inscription.php" >Créer un compte</a>
            <a href="login.php" >Se connecter</a>
        <?php endif;?>
    </div>
</nav>