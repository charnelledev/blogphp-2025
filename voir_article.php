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
// var_dump($article);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Voir l'article</title>
    <link rel="stylesheet" href="/blogphp-2025/layouts/style.css">
    <style>
         <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(to right, #e0eafc, #cfdef3);
        margin: 0;
        padding: 20px;
        min-height: 100vh;
    }
    
    .article-container {
        max-width: 850px;
        margin: auto;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(8px);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        animation: fadeIn 0.6s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    h1 {
        text-align: center;
        color: #2c3e50;
        font-size: 36px;
        margin-bottom: 35px;
    }
    
    .image-article {
        width: 100%;
        max-height: 400px;
        object-fit: cover;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }
    
    .section {
        margin-bottom: 30px;
    }
    
    .section h2 {
        font-size: 26px;
        color: #2980b9;
        border-bottom: 2px solid #2980b9;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }
    
    .section p {
        font-size: 18px;
        color: #444;
        line-height: 1.7;
        white-space: pre-line;
    }
    
    .btn-back {
        display: inline-block;
        margin-top: 30px;
        text-decoration: none;
        background-color: #3498db;
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-size: 16px;
        /* transition: background 0.3s; */
    
    }
    </style>
</head>
<body>

<div class="article-container">
    <h1><?php echo htmlspecialchars($article['titre']); ?></h1>

    <?php if (!empty($article['image'])): ?>
        <img src="<?php echo htmlspecialchars($article['image']); ?>" alt="Image de l'article" class="image-article">
    <?php endif; ?>

    <div class="section">
        <h2>Introduction</h2>
        <p><?php echo nl2br(htmlspecialchars($article['introduction'])); ?></p>
    </div>

    <div class="section">
        <h2>Contenu</h2>
        <p><?php echo nl2br(htmlspecialchars($article['content'])); ?></p>
    </div>

    <div class="section">
        <h2>Date de publication</h2>
        <p><?php echo isset($article['date']) ? htmlspecialchars($article['date']) : 'Non spécifiée'; ?></p>
    </div>

    <a class="btn-back" href="admin.php">← Retour au tableau de bord</a>
</div>

</body>
</html>

