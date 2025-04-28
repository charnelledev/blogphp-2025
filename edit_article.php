<?php
session_start();

// Vérifier si l'index de l'article est passé en URL
if (!isset($_GET['index']) || !isset($_SESSION['articles'][$_GET['index']])) {
    echo "Article non trouvé.";
    exit;
}

$index = (int)$_GET['index'];
$article = $_SESSION['articles'][$index];

// Traitement du formulaire pour sauvegarder l'édition
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['articles'][$index] = [
        'titre' => htmlspecialchars($_POST['titre']),
        'introduction' => htmlspecialchars($_POST['introduction']),
        'content' => htmlspecialchars($_POST['content'])
    ];
    header('Location: ../admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Éditer l'Article</title>
    <link rel="stylesheet" href="/blogphp-2025/style.css"> <!-- ajuste selon ton projet -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .edit-container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }

        textarea {
            resize: vertical;
            min-height: 150px;
        }

        .btn-submit {
            display: block;
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            margin-top: 20px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .btn-back {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #555;
            font-size: 14px;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="edit-container">
    <h1>Éditer l'Article</h1>
    <form method="POST">
        <label for="titre">Titre</label>
        <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($article['titre']); ?>">

        <label for="introduction">Introduction</label>
        <input type="text" id="introduction" name="introduction" value="<?php echo htmlspecialchars($article['introduction']); ?>">

        <label for="content">Contenu</label>
        <textarea id="content" name="content"><?php echo htmlspecialchars($article['content']); ?></textarea>

        <button type="submit" class="btn-submit">Sauvegarder</button>
    </form>

    <a class="btn-back" href="../admin.php">← Retour au tableau de bord</a>
</div>

</body>
</html>
