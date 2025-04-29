<?php
session_start();
require_once 'database/database.php';

// Fonction pour générer un slug à partir du titre
function generateSlug($title) {
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    return $slug;
}

// 1. Initialiser les articles en session
if (!isset($_SESSION['articles'])) {
    $_SESSION['articles'] = [];
}

// 2. Ajouter un article si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $new_article = [
        'titre' => htmlspecialchars($_POST['titre']),
        'introduction' => htmlspecialchars($_POST['introduction']),
        'content' => htmlspecialchars($_POST['content']),
        'date' => date('Y-m-d H:i:s'),
        'slug' => generateSlug($_POST['titre']) // ajout du slug
    ];

    $_SESSION['articles'][] = $new_article;

    // Insertion dans la base de données
    $sql = "INSERT INTO articles (titre, introduction, content, slug, created_at) 
            VALUES (:titre, :introduction, :content, :slug, :created_at)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'titre' => $new_article['titre'],
        'introduction' => $new_article['introduction'],
        'content' => $new_article['content'],
        'slug' => $new_article['slug'],
        'created_at' => $new_article['date']
    ]);

    // Redirection pour éviter la soumission multiple
    header('Location: admin.php');
    exit;
}

// 3. Supprimer un article
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $index = (int)$_GET['delete'];
    if (isset($_SESSION['articles'][$index])) {
        unset($_SESSION['articles'][$index]);
        $_SESSION['articles'] = array_values($_SESSION['articles']);
    }
}

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
