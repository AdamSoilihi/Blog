<nav>
                
    <img src="#" alt="Logo de mon Blog" >
                
    <div>
        <a href="index.php" >Accueil</a>
        <a href="articles.php">Les articles</a>
        <a href="contact.php" >Contact</a>
      
        <?php if(isset($_SESSION['loggedUser'])):?>
            <a href="logout.php" >Se deconnecter</a>
            <a href="Create_article.php" >Créer un article</a>
        <?php else:?>
            <a href="login.php" >Se connecter</a>
            <a href="inscription.php" >Créer un compte</a>
        <?php endif;?>
    </div>
</nav>