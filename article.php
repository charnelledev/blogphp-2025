<?php
session_start();
require_once 'libraries/database.php';
require_once 'libraries/utils.php';
require_once 'libraries/Models/Article.php';
require_once 'libraries/Models/Comment.php';
$modelComment = new Comments();
$modelArticle = new Articles();

// $pdo = getpdo();

$error = [];

$article_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($article_id === NULL || $article_id === false) {  
    $error['article_id'] = "Le paramètre id est invalide.";
}

// Récupération de l'article
// $sql = "SELECT * FROM articles WHERE id = :article_id";
// $query = $pdo->prepare($sql);
// $query->execute(compact('article_id'));
// $article = $query->fetch();
$article = $modelArticle->find($article_id);

// Récupération des commentaires avec auteur
// $sql = "SELECT comments.*, users.username
//         FROM comments
//         JOIN users ON comments.user_id = users.id
//         WHERE article_id = :article_id";
// $query = $pdo->prepare($sql);
// $query->execute(compact('article_id'));
// $commentaires = $query->fetchAll();
$commentaires = $modelComment->find($article_id);

// Titre de la page
$pageTitle = 'Détail de l’article'; 

// Affichage avec render
render('articles/show', compact('article', 'commentaires', 'article_id'));

// render('articles/show', compact('article', 'commentaires', 'pageTitle'));
