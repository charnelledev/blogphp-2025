<?php
session_start();

// Vérifier si l'index de l'article est passé en URL
if (!isset($_GET['index']) || !isset($_SESSION['articles'][$_GET['index']])) {
    echo "Article non trouvé.";
    exit;
}

$index = (int)$_GET['index'];
$article = $_SESSION['articles'][$index];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir l'Article</title>
    <link rel="stylesheet" href="/blogphp-2025/style.css"> <!-- adapte ce chemin si besoin -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #eef2f3;
            margin: 0;
            padding: 20px;
        }

        .article-container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #222;
            margin-bottom: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        .section h2 {
            font-size: 24px;
            color: #444;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }

        .section p {
            font-size: 18px;
            color: #555;
            line-height: 1.6;
        }

        .btn-back {
            display: inline-block;
            margin-top: 30px;
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #45a049;
        }

    </style>
</head>
<body>

<div class="article-container">
    <h1><?php echo htmlspecialchars($article['titre']); ?></h1>

    <div class="section">
        <h2>Introduction</h2>
        <p><?php echo nl2br(htmlspecialchars($article['introduction'])); ?></p>
    </div>

    <div class="section">
        <h2>Contenu</h2>
        <p><?php
         echo nl2br(htmlspecialchars($article['content']));
         ?></p>
    </div>

    <a class="btn-back" href="../admin.php">← Retour au tableau de bord</a>
</div>

</body>
</html>
