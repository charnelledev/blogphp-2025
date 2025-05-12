<?php
session_start();
require_once 'database/database.php';

// require 'vendor/autoload.php';

// use JasonGrimes\Paginator;
// $totalQuery = $pdo->query("SELECT COUNT(*) FROM articles");
// $totalItems = $totalQuery->fetchColumn();

// $itemsPerPage = 5;
// $currentPage = $_GET['page'] ?? 1;


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
// $allArticles = $stmt->fetchAll();
// // var_dump($allArticles);
// var_dump($allArticles);
// $sql= $pdo->query("SELECT count(*) FROM articles");
// $totalItems = $sql->fetchColumn();

// $sql= $pdo->query("SELECT count(*) FROM articles");
// $totalItems = $sql->fetchColumn();


// $paginator = new Paginator(
//     $totalItems, 
//     $itemsPerPage,
//     $currentPage, 
//     '?page=(:num)'
// );


if($_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Rediriger vers la page d'accueil si l'utilisateur n'est pas admin
    exit;
}

//netoyage des entrer
function cleanInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
// Fonction pour générer un slug à partir du titre
function createSlug($title) {
    // Remplace les caractères accentués par leur équivalent sans accent
    $title = removeAccents($title);
    
    // Remplace les espaces par des tirets
    $slug = strtolower(str_replace(' ', '-', $title));
    
    // Supprime les caractères non alphanumériques et les tirets
    $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
    
    // Remplace les tirets multiples par un seul tiret
    $slug = preg_replace('/-+/', '-', $slug);
    
    // Supprime les tirets en début et fin de chaîne
    $slug = trim($slug, '-');
    
    return $slug;
  }
  function removeAccents($string) {
    $accents = [
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
        'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e',
        'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i',
        'ñ' => 'n',
        'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o',
        'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u',
        'ý' => 'y', 'ÿ' => 'y',
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
        'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E',
        'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I',
        'Ñ' => 'N',
        'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O',
        'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U',
        'Ý' => 'Y'
    ];
    return strtr($string, $accents);
  }

//recuperer les donnees entrees par l'utilisateur
if(isset($_POST['add-article'])) {
   $titre = cleanInput($_POST['titre']);
   $slug = createSlug($titre);
   $introduction = cleanInput($_POST['introduction']);
   $content = cleanInput($_POST['content']);

   if(empty($titre)|| empty($slug) || empty($introduction) || empty($content)) {
    $error = "veillez remplir tous les champs";
} else {
    //insertion du nouvelle article dans la base de donnee
    $query = $pdo->prepare('INSERT INTO articles(titre,slug,introduction,content,created_at) VALUE(:titre, :slug, :introduction, :content, NOW())');
    $query->execute(compact('titre', 'slug', 'introduction', 'content'));
}
    //redirection vers la page admin
    header('Location: admin.php');
    exit;
}

//recuperation de tous les articles
$query = "SELECT * FROM articles ORDER BY created_at DESC";
$resultats = $pdo->prepare($query);
$resultats->execute();
$allArticles = $resultats->fetchAll();
// 4. Variables de page
$pageTitle = 'Page Admin';

// 5. Début du tampon
ob_start();

// 6. Inclure layout
require_once 'layouts/adminqwerty/admin_dashboardqwerty_html.php';

// 7. Récupérer tampon
$pageContent = ob_get_clean();

// 8. Layout principal
require_once 'layouts/layout_html.php';
?>
