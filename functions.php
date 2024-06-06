<?php
//Afficher l'auteur à partir de son nom
function displayAuthor(string $nom, array $utilisateurs): string
{
    foreach ($utilisateurs as $utilisateur) {
        if ($nom === $utilisateur['nomUtilisateur']) {
            return $utilisateur['nomUtilisateur'];
        }
    }
    return 'Auteur inconnu';
}

//fonction pour trouver un article valide
function isValidArticles(array $article): bool
{
    if (array_key_exists('valideArticle', $article)) {
        $isValid = $article['valideArticle'];
    } else {
        $isValid = false;
    }


    return $isValid;
}

//fonction pour recuperer tous les articles valides
function getArticles(array $articles): array
{
    $valid_articles = [];
    foreach ($articles as $article) {
        if (isValidArticles($article)) {
            $valid_articles[] = $article;
        }
    }
    return $valid_articles;
}
//pour rediriger vers une page
function redirectToUrl(string $url): never
{
    header("Location: {$url}");//Pour charger une nouvelle page
    exit();//pour arreter l'execution de la suite des codes PHP
}
?>


?>