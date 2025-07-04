
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page-admin</title>
</head>
<body>
<h1><u>Gestions des articles</u></h1>
<!-- Contenu spécifique à l'admin -->
<h3>Hello <?= isset($_SESSION["auth"]['username']) ? $_SESSION["auth"]['username'] : "" ?></h3>

<!-- <h3>
    <?php
    // if (isset($_SESSION["auth"]['username'])) {
    //     echo $_SESSION["auth"]['username'];
    // } else {
    //     echo "";
    // }
    ?>
</h3> -->

<div class="admin">

  <div class="article adm">
    <span style='color:#FF6600 ; font-size:4rem; text-align:center; font-weight: 700;'>Adminitrateur : </span>
  </div>

  <?php
  if (isset($error)) {
      echo "<p style='color: #fff;padding:10px; background:#FF6600; width:400px'>$error</p>";
  }
  ?>
  <h1>Ajouter un nouvel article</h1>

  <form class="form" id="form" method="post" enctype="multipart/form-data" action="admin">
  <div class="form-control">
      <label for="titre">Title:</label>
      <input type="text" name="titre" id="titre">
  </div>
    <div  class="form-control" hidden>
      <label for="slug">Slug:</label>
      <input type="text" name="slug" id="slug">
    </div>
    <div class="form-control">
      <label for="introduction">Introduction:</label>
      <textarea name="introduction" id="introduction"></textarea>
    </div>

    <div class="form-control">
      <label for="content">Content:</label>
      <textarea name="content" id="content"></textarea>
    </div>
    <div class="form-control">
      <button type="submit" name="add-article" value="add-article">Ajouter</button>
    </div>
  </form>
</div>



<h1>Nos articles</h1>

<p>il y a <?= count($allArticles); ?> articles</p>

<div class="article-grid">
    <?php foreach($allArticles as $article): 
      // var_dump($article);
      ?>
    <div class="article">
            <h2><?=$article['titre'] ?></h2>
            <p><?=$article['introduction'] ?></p>
            <small>Publié le <?= $article['created_at'] ?></small> <br>
            <a href="article.php?id=<?= urldecode($article['id']) ?>">Voir</a>
            <a href="edit-article.php?id=<?= urldecode($article['id']) ?>">Éditer</a>
            <a href="delete-article.php?id=<?= urldecode($article['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>      

            </div>
            <?php endforeach; ?>
    </div>
</div>

</body>
</html>




