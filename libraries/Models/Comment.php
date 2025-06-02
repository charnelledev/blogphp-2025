<?php
require_once 'libraries/database.php';
require_once 'libraries/Models/Model.php';
class Comments extends Model
{
    protected $table = 'comments';

    public function InsertComments($content, $article_id, $user_auth)
    {

 // 5Insertion du commentaire
    $query =  $this->pdo->prepare('INSERT INTO comments SET content = :content, article_id = :article_id,  user_id = :user_auth,created_at = NOW()');
  $query->execute(compact( 'content', 'article_id','user_auth'));
}

// public function find($id)
// {
    
// // Récupération des commentaires avec auteur
//     $sql = "SELECT comments.*, users.username
//         FROM comments
//         JOIN users ON comments.user_id = users.id
//         WHERE id = :id";
// $query =  $this->pdo->prepare($sql);
// $query->execute(compact('id'));
// $items = $query->fetchAll();
// return $items;

// }
}