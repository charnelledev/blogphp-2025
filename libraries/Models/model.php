<?php
require_once 'libraries/database.php';

class Model 
{
    protected $pdo;
    protected $table;
    public function __construct() {
        $this->pdo = getpdo();
    }

    public function find($id){
 
    $sql = "SELECT * FROM {$this->table} WHERE id = :id";
    $query = $this->pdo->prepare($sql);
    $query->execute(compact('id'));
    $items = $query->fetch();
    return $items;
}
}
?>