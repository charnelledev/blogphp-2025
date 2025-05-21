<?php
session_start();

session_unset(); // Détruire toutes les variables de session
session_destroy(); // Détruire la session
// Rediriger vers la page d'accueil
redirect('index.php');
// header("Location: index.php"); 
// Rediriger vers la page de connexion
// exit(); 
// Terminer le script

require_once 'libraries/database.php';
require_once 'libraries/utils.php';

$pdo = getpdo();