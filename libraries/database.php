
<?php

/**
 * retourne la connexion de la base de données
 * 
 * @return PDO

 */


function getpdo(): PDO
{

    if(!defined( 'DB_SERVERNAME')) 
    {
        define('DB_SERVERNAME','127.0.0.1');
    }

    if(!defined( 'DB_USERNAME')) 
    {
        define('DB_USERNAME','root');
    }

    if(!defined( 'DB_PASSWORD')) 
    {
        define('DB_PASSWORD','');
    }

    if(!defined( 'DB_DATABASE')) 
    {
        define('DB_DATABASE','blogphp-2025');
    }
    

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


function countArticles()
{
    $pdo = getpdo();
    //requete comptant le nombre d'articles
$totalQuery = $pdo->query("SELECT COUNT(*) FROM articles");
$totalItems = $totalQuery->fetchColumn();
return $totalItems;
}

function findAllArticlesByPaginator(int $itemsPerPage, int $currentPage)
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

function findAllArticles()
{
$pdo = getpdo();
//recuperation des articles de la base de donnees
$query = "SELECT * FROM articles ORDER BY created_at DESC";
$resultats = $pdo->prepare($query);
$resultats->execute();
$allArticles = $resultats->fetchAll();
return $allArticles;
}

function findcreateArticle( $titre, $slug,  $introduction, $content, $imageName)
{
    //insertion du nouvelle article dans la base de donnee
    $pdo = getpdo();
        $query = $pdo->prepare('INSERT INTO articles(titre,slug,introduction,content,created_at) VALUES(:titre, :slug, :introduction, :content, NOW())');
    $query->execute(compact('titre', 'slug', 'introduction', 'content'));
}
//traiter la requete d'ajout d'article
function handleAddArticleRequest()
{
// if(isset($_POST['add-article'])) {
//    $titre = cleanInput($_POST['titre']);
//    $slug = createSlug($titre);
//    $introduction = cleanInput($_POST['introduction']);
//    $content = cleanInput($_POST['content']);
// }
}
 ?>

