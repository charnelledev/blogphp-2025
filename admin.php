<?php
require_once 'database/database.php';

// 1--On affiche le titre autre

$pageTitle ='Page Admin'; 

// 2-Debut du tampon de la page de sortie
 
ob_start();

// 3-inclure le layout de la page d' accueil
require_once 'layouts/adminqwerty/admin_dashboardqwerty_html.php';

//4-recuperation du contenu du tampon de la page d'accueil
$pageContent = ob_get_clean();

//5-Inclure le layout de la page de sortie
require_once 'layouts/layout_html.php';