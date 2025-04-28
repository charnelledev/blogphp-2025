<?php
session_start();
require_once 'database/database.php';

// 1. Initialiser les articles
if (!isset($_SESSION['articles'])) {
    $_SESSION['articles'] = [];
}

// 2. Ajouter un article si formulaire soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $new_article = [
        'titre' => htmlspecialchars($_POST['titre']),
        'introduction' => htmlspecialchars($_POST['introduction']),
        'content' => htmlspecialchars($_POST['content']),
        'date' => date('d/m/Y H:i'), // ajoute la date actuelle
];
    $_SESSION['articles'][] = $new_article;
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


