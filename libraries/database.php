
<?php

/**
 * retourne la connexion de la base de données
 * 
 * @return PDO

 */


function getpdo(): PDO
{

// 5-Connexion à la base de données avec PDO
// $pdo = new PDO('mysql:host=localhost;dbname=blogphp-2025;charset=utf8', 'root', '');

define('DB_SERVERNAME','127.0.0.1');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_DATABASE','blogphp-2025');

try {
     $pdo= new PDO("mysql:host=" .DB_SERVERNAME . ";dbname=" .DB_DATABASE . ";charset=utf8", DB_USERNAME, DB_PASSWORD);
     // 2-Configurer le mode d'erreur pour lancer des exceptions
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     echo "<div style='background-color:#3c763d; color:white;'>Connexion à la base de donnée réussie</div>";
     
 } catch(PDOException $e) {
     echo "<div style='color:red;'>La connexion à la base de données a échoué :</div> " . $e->getMessage();
 }
 return $pdo;
}

 ?>

