<?php
session_start();

require_once 'libraries/database.php';

$pdo = getpdo();
/**
 * CE FICHIER DOIT ENREGISTRER UN NOUVEAU COMMENTAIRE EST REDIRIGER SUR L'ARTICLE !
 * 
 * On doit d'abord vérifier que toutes les informations ont été entrées dans le formulaire
 * Si ce n'est pas le cas : un message d'erreur
 * Sinon, on va sauver les informations
 * 
 * Pour sauvegarder les informations, ce serait bien qu'on soit sûr que l'article qu'on essaye de commenter existe
 * Il faudra donc faire une première requête pour s'assurer que l'article existe
 * Ensuite on pourra intégrer le commentaire
 * 
 * Et enfin on pourra rediriger l'utilisateur vers l'article en question
 */

/**
 * 1. On vérifie que les données ont bien été envoyées en POST
 * D'abord, on récupère les informations à partir du POST
 * Ensuite, on vérifie qu'elles ne sont pas nulles
 */
// 6var_dump($_SESSION['auth']['id']);
// die();
if(!isset($_SESSION['auth']['id'])) {
  header("location: loging");
  exit;
}
$user_auth = $_SESSION['auth']['id'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $content =htmlspecialchars($_POST['content'] ?? null);
  $article_id = $_POST['article_id'] ?? null;

  
  // 4-Vérification de l'existence de l'article
  $query = $pdo->prepare('SELECT COUNT(*) FROM articles WHERE id = :article_id');
  $query->execute(['article_id' => $article_id]);
  $articleExists = $query->fetchColumn();

  // 5Insertion du commentaire
  $query = $pdo->prepare('INSERT INTO comments SET content = :content, article_id = :article_id,  user_id = :user_auth,created_at = NOW()');
  $query->execute(compact( 'content', 'article_id','user_auth'));

  // 6Rediriger vers la page de l'article après l'ajout du commentaire
  header("Location: article.php?id=" . $article_id);
  exit;
}

  
  // 4Vérification finale des infos envoyées dans le formulaire (donc dans le POST)
  // DSi il n'y a pas l'id de l'user  OU qu'il n'y a pas de contenu OU qu'il n'y a pas d'identifiant d'article
  // if (!$user_auth || !$article_id || !$content) {
  //   // var_dump($article_id );
  //   // die();
  //     die("Votre formulaire a été mal rempli !");
  // }
  
  // 4-On fait quand même gaffe à ce que le gars n'essaye pas des balises cheloues dans son commentaire
  // $content = htmlspecialchars($content);
  
  // var_dump($content);
  // die();
  
  
  // if (!$articleExists) {
  //     die("Ho ! L'article $article_id n'existe pas boloss !");
  // }
  

