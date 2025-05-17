<?php
require_once 'libraries/database.php';

$pdo = getpdo();

require 'vendor/autoload.php';

use JasonGrimes\Paginator;

//requete comptant le nombre d'articles
$totalQuery = $pdo->query("SELECT COUNT(*) FROM articles");
$totalItems = $totalQuery->fetchColumn();

$itemsPerPage = 5;
$currentPage = $_GET['page'] ?? 1;

//requete paginee(optimiser pour mysql)
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = 'SELECT * FROM articles 
ORDER BY created_at
DESC 
LIMIT :limit OFFSET :offset';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$articles = $stmt->fetchAll();
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

// 2-Debut du tampon de la page de sortie
 
ob_start();

// 3-inclure le layout de la page d' accueil
require_once 'layouts/articles/index_html.php';

//4-recuperation du contenu du tampon de la page d'accueil
$pageContent = ob_get_clean();

//5-Inclure le layout de la page de sortie
require_once 'layouts/layout_html.php';


