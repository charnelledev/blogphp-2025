<?php
session_start();

// Vérifier que l'index est valide
if (!isset($_GET['index']) || !is_numeric($_GET['index'])) {
    die('Article invalide.');
}

$index = (int)$_GET['index'];

if (!isset($_SESSION['articles'][$index])) {
    die('Article non trouvé.');
}

$article = $_SESSION['articles'][$index];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir l'article</title>
</head>
<body>

<h1><?php echo $article['titre']; ?></h1>
<p><strong>Introduction :</strong> <?php echo $article['introduction']; ?></p>
<p><strong>Contenu :</strong> <?php echo nl2br($article['content']); ?></p>

<br>
<a href="admin_dashboardqwerty_html.php">← Retour au tableau de bord</a>

</body>
</html>
