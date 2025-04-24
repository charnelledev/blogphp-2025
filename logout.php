<?php
session_start();
<<<<<<< HEAD
session_unset(); // Détruire toutes les variables de session
session_destroy(); // Détruire la session
header("Location: index.php"); // Rediriger vers la page de connexion
exit(); // Terminer le script
=======
require_once 'database/database.php';
>>>>>>> e685ac1b9b9bf43b19dcd44f58cc3a0a83d3074e
