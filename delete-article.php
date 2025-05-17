<?php
session_start();
require_once 'libraries/database.php';

// require_once 'database/database.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
exit('ID manquant.');
}
$id = $_GET['id'];
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$id]);
// Redirection vers la page d'affichage
header("Location: index.php");
exit;
