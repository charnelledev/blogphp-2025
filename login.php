<?php
session_start();
require_once 'libraries/database.php';
require_once 'libraries/utils.php';
require_once 'libraries/Models/User.php';
$modelUser = new Users();

$pdo = getpdo();


// $article_id = null;
// $user = $user ?? null; // si $user n'existe pas, met null

if (isset($_POST['login'])) {
  $errors = []; 
  if (!empty($_POST['email']) && !empty($_POST['password'])) {

      // Vérification des informations de connexion
    //   $query = "SELECT * FROM users
    //   WHERE (email = :email OR username =:email)";
    //   $query = $pdo->prepare($query);
    //   $query->execute([
    //       'email' => $_POST['email'], 
    //       'password' => $_POST['password']
    //   ]);
    //   $user = $query->fetch();
    $user = $modelUser->VerifindINformationConnect();
      // Si les informations de connexion sont correctes, on crée une session et on redirige vers la page d'accueil de l'admin ou l'utilisateur

      if ($user && password_verify($_POST['password'], $user['password'])) {
          $_SESSION['role'] = $user['role'];
          $_SESSION['auth'] = $user;
         

          // Redirection en fonction du rôle
          switch ($user['role']) {
              case 'admin':
                //   header("Location: admin.php");
                    redirect('admin.php');
                  break;

              default:
                //   header("Location: user.php");
                    redirect('user.php');
                  break;
          }
      } else {
          $errors['email']= "Email ou mot de passe incorrect.";
      }
  }else{
      $errors['login'] = "Tous les champs doivent être remplis.";
  }
}



// 1-On affiche le titre

$pageTitle ="Se connecter dans le Blog"; 

// render('articles/login', compact('errors'));
render('articles/login');

// render('articles/login',compact('article_id','user'));

