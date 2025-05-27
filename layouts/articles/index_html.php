<h1>Listes des articles</h1>

<hr>
<div>
  <?php foreach ($articlesByPaginator as $article): 
    // var_dump($articles);
    ?>
  
  <h2> <?= $article['titre'] ?> </h2>

  <p> <?= $article['introduction']?> </p>

  <a href="article.php?id=<?= $article['id']?>">Voir plus</a>
  <?php endforeach; ?>
</div>
<nav class="pagination-wrapper">

  <?= $paginator ?>
</nav>