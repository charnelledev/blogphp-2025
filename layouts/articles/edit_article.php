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

// Modifier l'article
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_article'])) {
    $_SESSION['articles'][$index] = [
        'titre' => htmlspecialchars($_POST['titre']),
        'introduction' => htmlspecialchars($_POST['introduction']),
        'content' => htmlspecialchars($_POST['content'])
    ];
    // Rediriger vers dashboard
    header('Location: admin_dashboardqwerty_html.php');
    exit;
}

$article = $_SESSION['articles'][$index];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Éditer l'article</title>
</head>
<body>

<h1>Éditer l'article</h1>

<form method="post" action="">
    <label>Titre:</label><br>
    <input type="text" name="titre" value="<?php echo $article['titre']; ?>" required><br><br>

    <label>Introduction:</label><br>
    <textarea name="introduction" required><?php echo $article['introduction']; ?></textarea><br><br>

    <label>Contenu:</label><br>
    <textarea name="content" required><?php echo $article['content']; ?></textarea><br><br>

    <button type="submit" name="edit_article">Enregistrer les modifications</button>
</form>

<br>
<a href="admin_dashboardqwerty_html.php">← Annuler et retourner</a>

</body>
</html>
