<?php
require_once 'libraries/database.php';
require_once 'libraries/Models/Model.php';

class Articles extends Model
{

    protected $table = 'articles';
    
public function countArticles()
{
    
    //requete comptant le nombre d'articles
$totalQuery =  $this->pdo->query("SELECT COUNT(*) FROM articles");
$totalItems = $totalQuery->fetchColumn();
return $totalItems;
}


public function findArticles($article_id){
 
    $sql = "SELECT * FROM articles WHERE id = :article_id";
    $query = $this->pdo->prepare($sql);
    $query->execute(compact('article_id'));
    $article = $query->fetch();
    return $article;
}
public function findAllArticlesByPaginator(int $itemsPerPage, int $currentPage)
{
   


//requete paginee(optimiser pour mysql)
$offset = ($currentPage - 1) * $itemsPerPage;

$sql = 'SELECT * FROM articles 
ORDER BY created_at
DESC 
LIMIT :limit OFFSET :offset';
$stmt = $this->pdo->prepare($sql);
$stmt->bindParam(':limit', $itemsPerPage, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$articlesByPaginator = $stmt->fetchAll();
return $articlesByPaginator;
}
public function findAllArticles()
{

//recuperation des articles de la base de donnees
$query = "SELECT * FROM articles ORDER BY created_at DESC";
$resultats =  $this->pdo->prepare($query);
$resultats->execute();
$allArticles = $resultats->fetchAll();
return $allArticles;
}

public function findcreateArticle( $titre, $slug,  $introduction, $content, $imageName)
{
    //insertion du nouvelle article dans la base de donnee

        $query =  $this->pdo->prepare('INSERT INTO articles(titre,slug,introduction,content,created_at) VALUES(:titre, :slug, :introduction, :content, NOW())');
    $query->execute(compact('titre', 'slug', 'introduction', 'content'));
}

public function EXitArticle($article_id){
    
    // Vérification de l'existence de l'article
    $query =  $this->pdo->prepare('SELECT COUNT(*) FROM articles WHERE id = :article_id');
    $query->execute(['article_id' => $article_id]);
    $articleExists = $query->fetchColumn();
    return $articleExists;
}

   public function recupere(){
   
        $articleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM articles WHERE id = ?";
        $query = $this->pdo->prepare($sql);
        $query->execute([$articleId]);
        $article = $query->fetch(PDO::FETCH_ASSOC);
        return $article;
    }

    public function VerifeunderArticle($titre,$articleId,$slug, $introduction, $content){

    $data = compact('titre', 'slug', 'introduction', 'content', 'articleId');
    $query = $this->pdo->prepare('UPDATE articles SET titre = :titre, slug = :slug, introduction = :introduction, content = :content WHERE id = :articleId');
    $query->execute($data);
}
// function VerifinderById($id)
// {
   
//     $id = $_GET['id'];
//     $query = "SELECT * FROM users WHERE id = ?";
//     $req = $this->pdo->prepare($query);
//     $req->execute([$id]);
//     return $req->fetch();
// }
}


