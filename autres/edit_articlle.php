<!-- <?php
// session_start();

// // Vérifier si l'index de l'article est passé en URL
// if (!isset($_GET['index']) || !isset($_SESSION['articles'][$_GET['index']])) {
//     echo "Article non trouvé.";
//     exit;
// }

// $index = (int)$_GET['index'];
// $article = $_SESSION['articles'][$index];

// // Traitement du formulaire pour sauvegarder l'édition
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $_SESSION['articles'][$index] = [
//         'titre' => htmlspecialchars($_POST['titre']),
//         'introduction' => htmlspecialchars($_POST['introduction']),
//         'content' => htmlspecialchars($_POST['content'])
//     ];
//     header('Location: ../admin.php');
//     exit;
// }
// ?>

// <!DOCTYPE html>
// <html lang="fr">
// <head>
//     <meta charset="UTF-8">
//     <title>Éditer l'Article</title>
//     <link rel="stylesheet" href="/blogphp-2025/style.css"> <!-- ajuste selon ton projet -->
//     <style>
//         body {
//             font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
//             background-color: #f4f4f4;
//             margin: 0;
//             padding: 20px;
//         }

//         .edit-container {
//             max-width: 600px;
//             margin: auto;
//             background: white;
//             padding: 30px;
//             border-radius: 12px;
//             box-shadow: 0 4px 8px rgba(0,0,0,0.1);
//         }

//         h1 {
//             text-align: center;
//             color: #333;
//             margin-bottom: 20px;
//         }

//         label {
//             font-weight: bold;
//             display: block;
//             margin: 15px 0 5px;
//         }

//         input[type="text"],
//         textarea {
//             width: 100%;
//             padding: 10px;
//             margin-top: 5px;
//             border: 1px solid #ccc;
//             border-radius: 8px;
//         }

//         textarea {
//             resize: vertical;
//             min-height: 150px;
//         }

//         .btn-submit {
//             display: block;
//             width: 100%;
//             background-color: #4CAF50;
//             color: white;
//             border: none;
//             padding: 12px;
//             margin-top: 20px;
//             font-size: 16px;
//             border-radius: 8px;
//             cursor: pointer;
//         }

//         .btn-submit:hover {
//             background-color: #45a049;
//         }

//         .btn-back {
//             display: inline-block;
//             margin-top: 20px;
//             text-decoration: none;
//             color: #555;
//             font-size: 14px;
//         }

//         .btn-back:hover {
//             text-decoration: underline;
//         }
//     </style>
// </head>
// <body>

// <div class="edit-container">
//     <h1>Éditer l'Article</h1>
//     <form method="POST">
//         <label for="titre">Titre</label>
//         <input type="text" id="titre" name="titre" value="<?php echo htmlspecialchars($article['titre']); ?>">

//         <label for="introduction">Introduction</label>
//         <input type="text" id="introduction" name="introduction" value="<?php echo htmlspecialchars($article['introduction']); ?>">

//         <label for="content">Contenu</label>
//         <textarea id="content" name="content"><?php echo htmlspecialchars($article['content']); ?></textarea>

//         <button type="submit" class="btn-submit">Sauvegarder</button>
//     </form>

//     <a class="btn-back" href="../admin.php">← Retour au tableau de bord</a>
// </div>

// </body>
// </html><?php

// // 1--Démarre une nouvelle session ou reprend une session existante
// session_start();

// // 2-Inclut le fichier de connexion à la base de données
// require_once 'libraries/database.php';
// require_once 'libraries/utils.php';

// $pdo = getpdo();

// $error = "";

// echo $error;
// /**
//  * -Éditer un article existant
//  */
// $error = '';


// // -Récupération des informations d'un article à modifier
// if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)) {

//   // -Récupération des informations de l'article à éditer
//   $sql = "SELECT * FROM articles WHERE id = ?";
//   $query = $pdo->prepare($sql);
//   $articleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
//   $query->execute([$articleId]);
//   $article = $query->fetch(PDO::FETCH_ASSOC);

//   // --Récupération des données
//   $titre = $article['titre'] ?? "";
//   $slug = $article['slug'] ?? "";
//   $introduction  = $article['introduction'] ?? "";
//   $content = $article['content'] ?? "";
// }

// // --Vérification et nettoyage des entrées
// function clean_input($data)
// {
//   return htmlspecialchars(stripslashes(trim($data)));
// }

// if (isset($_POST['update'])) {

//   // -Nettoyage des entrées
//   $titre = clean_input(filter_input(INPUT_POST, 'titre', FILTER_DEFAULT));
//   $slug = strtolower(str_replace(' ', '-', $titre)); // Mise à jour du slug à partir du titre
//   $introduction = clean_input(filter_input(INPUT_POST, 'introduction', FILTER_DEFAULT));
//   $content = clean_input(filter_input(INPUT_POST, 'content', FILTER_DEFAULT));
//   $articleId = clean_input(filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT));

//   // -Validation des données
//   if (empty($titre) || empty($slug) || empty($introduction) || empty($content)) {
//     $error = "Veuillez remplir tous les champs du formulaire !";
//   } else {


//     // -Mise à jour de l'article dans la base de données
//     $data = compact('titre', 'slug', 'introduction', 'content', 'articleId');
//     $query = $pdo->prepare('UPDATE articles SET titre = :titre, slug = :slug, introduction = :introduction, content = :content WHERE id = :articleId');
//     $query->execute($data);

//     // -Redirection vers la page d'adim
//     header("Location: admin.php");
//     exit();
//   }
// }
// $pageTitle = 'Éditer un article';
//  // Titre de la page pour le layout
// render('adminqwerty/admin_dashboardqwerty',compact('articleId','pageTitle'));


// 1-Démarre une nouvelle session ou reprend une session existante
// session_start();

// 2Inclut le fichier de connexion à la base de données
// require_once 'database/database.php';

// 3-Définit le titre de la page
// $pageTitle = "Éditer un article";

// 4-Démarre la mise en tampon de sortie pour capturer le contenu HTML
// ob_start();

// 5Inclut le fichier HTML pour éditer un article
// require 'templates/articles/edit-article_html.php';

// 6Récupère le contenu mis en tampon et le stocke dans la variable $pageContent
// $pageContent = ob_get_clean();

// 7Inclut le modèle de mise en page HTML qui affichera le contenu de la page
// require 'templates/layout_html.php';

// session_start();
// require_once 'database/database.php';

 -->
