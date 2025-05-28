<?php
use JasonGrimes\Paginator;
require_once 'libraries/database.php';
require_once 'libraries/utils.php';
require_once 'vendor/autoload.php';
require_once 'libraries/Models/Article.php';
$modelArticle = new Articles();
//instence de la classe $modelArticle

$itemsPerPage = 5;
$currentPage = $_GET['page'] ?? 1;


//requete comptant le nombre d'articles
// $totalQuery = $pdo->query("SELECT COUNT(*) FROM articles");
// $totalItems = $totalQuery->fetchColumn();
$totalItems = $modelArticle->countArticles();

$articlesByPaginator = $modelArticle->findAllArticlesByPaginator($currentPage,$itemsPerPage);



// //requete paginee(optimiser pour mysql)
// $offset = ($currentPage - 1) * $itemsPerPage;

// $sql = 'SELECT * FROM articles 
// ORDER BY created_at
// DESC 
// LIMIT :limit OFFSET :offset';
// $stmt = $pdo->prepare($sql);
// $stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
// $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
// $stmt->execute();
// $articles = $stmt->fetchAll();
// var_dump($articles);
// $sql= $pdo->query("SELECT count(*) FROM articles");
// $totalItems = $sql->fetchColumn();

$paginator = new Paginator(
    $totalItems, 
    $itemsPerPage,
    $currentPage, 
    '?page=(:num)'
);

//recuperation des articles de la base de donnees
// $resultats = $pdo->query("SELECT * FROM articles ORDER BY created_at DESC");
// $articles = $resultats->fetchAll();

// 1--On affiche le titre autre

$pageTitle ='Accueil du Blog'; 

render('articles/index',compact('articlesByPaginator','paginator', 'pageTitle'));

// render('articles/index',[
//     'pagetitle' => $pageTitle,
//     'articles' => $articles,
//     'paginator' => $paginator,
// ]);

