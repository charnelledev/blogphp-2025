<?php
session_start();

require_once 'libraries/database.php';
require_once 'libraries/utils.php';

$pdo = getpdo();

$error = "";

// // Initialisation des variables pour éviter les erreurs "undefined variable"


// Récupération des infos en GET
if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    $articleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

    $sql = "SELECT * FROM articles WHERE id = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$articleId]);
    $article = $query->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        $titre = $article['titre'] ?? "";
        $slug = $article['slug'] ?? "";
        $introduction = $article['introduction'] ?? "";
        $content = $article['content'] ?? "";
    } else {
        $error = "Article introuvable.";
    }
}

function clean_input($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}


if (isset($_POST['update'])) {
  // Traitement POST (soumission du formulaire)
  $titre = clean_input(filter_input(INPUT_POST, 'titre', FILTER_DEFAULT));
  $slug = strtolower(str_replace(' ', '-', $titre));
  $introduction = clean_input(filter_input(INPUT_POST, 'introduction', FILTER_DEFAULT));
  $content = clean_input(filter_input(INPUT_POST, 'content', FILTER_DEFAULT));
  $articleId = clean_input(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT));

    if (empty($titre) || empty($slug) || empty($introduction) || empty($content)) {
        $error = "Veuillez remplir tous les champs du formulaire !";
    } else {
        $data = compact('titre', 'slug', 'introduction', 'content', 'articleId');
        $query = $pdo->prepare('UPDATE articles SET titre = :titre, slug = :slug, introduction = :introduction, content = :content WHERE id = :articleId');
        $query->execute($data);
        // header("Location: admin.php");
        redirect('admin.php');
        
    }
}

$pageTitle = 'Éditer un article';

render('articles/edit-article', compact('titre', 'slug', 'articleId', 'pageTitle', 'introduction', 'content', 'error'));

//redirection vers la pages des articles
