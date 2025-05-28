<?php
class Articles 
{
public function countArticles()
{
    $pdo = getpdo();
    //requete comptant le nombre d'articles
$totalQuery = $pdo->query("SELECT COUNT(*) FROM articles");
$totalItems = $totalQuery->fetchColumn();
return $totalItems;
}


public function findAllArticlesByPaginator(int $itemsPerPage, int $currentPage)
{
    $pdo = getpdo();


//requete paginee(optimiser pour mysql)
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = 'SELECT * FROM articles 
ORDER BY created_at
DESC 
LIMIT :limit OFFSET :offset';
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$articlesByPaginator = $stmt->fetchAll();
return $articlesByPaginator;
}
}


