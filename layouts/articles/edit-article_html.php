<h1>Éditer un article</h1>
<?php
if (isset($error)) {
  echo "<p style='color: #fff;padding:20px; background:#FF6600; width:400px'>$error</p>";
}
?>
<form method="POST" action="edit-article.php">
  <input type="hidden" name="id" value="<?= $articleId; ?>">
  <label for="titre">Titre :</label>
  <input type="text" name="titre" id="titre" value="<?= $titre; ?>">


  <input type="hidden" type="text" name="slug" id="slug" value="<?= $slug; ?>">

  <br>

  <label for="introduction">Introduction :</label>
  <textarea name="introduction" id="introduction"><?= $introduction; ?></textarea>

  <br>

  <label for="content">Contenu :</label>
  <textarea name="content" id="content"><?= $content; ?></textarea>

  <br>

  <input type="submit" name='update' value="Éditer">

  <div class="article adm">
    <a href="admin.php">Retour à la page admin</a>
  </div>
</form>