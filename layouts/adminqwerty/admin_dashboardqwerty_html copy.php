
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page-admin</title>
</head>
<body>
    
    <div class="">
    <h2>Bienvenue sur la page des Admins</h2>
</div>
     <div class="container">
            <div class="header">
                
                <h1>Admin Dashboard</h1>
        </div>
        <form action="admin" class="form" id="form" method="post" enctype="multipart/form-data">

    <div class="form-control">
        <label for="titre">Titre</label>
        <input type="text" id="titre" placeholder="Titre" name="titre" autocomplete="off"
            value="<?= isset($_POST['titre']) ? $_POST['titre'] : '' ?>">
    </div>

    <div class="form-control">
        <label for="introduction">Introduction</label>
        <input type="text" id="introduction" placeholder="Introduction" name="introduction"
            value="<?= isset($_POST['introduction']) ? $_POST['introduction'] : '' ?>">
    </div>

    <div class="form-control">
        <label for="content">Contenu</label>
        <textarea id="content" name="content" placeholder="Contenu de l'article..." rows="8" cols="50"><?= isset($_POST['content']) ? $_POST['content'] : '' ?></textarea>
    </div>

    <button type="submit" name="register">Créer</button>
</form>
</div>
                <style>    
                       .containe{
                   max-width: 2050px;
                   margin-top: 20px;
                   background: #f1f1f1;
                   padding: 30px;
                   border-radius: 10px;
                   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);

               }
                    .conten{
                   max-width: 2000px;
                   margin-top: 20px;
                   background: #f1f1f1;
                   padding: 10px;
                   border-radius: 10px;
                   box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                   grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
                    display: grid;
                     gap: 20px;

               }
               
               h3, h4 {
                   color: #333;
                     text-align: center;
               }
               
               .article {
                   background:rgb(231, 225, 225);
                   padding: 20px;
                   border-radius: 8px;
                   margin-top: 20px;
               }
               
               .article h3 {
                   margin-top: 0;
                   color: #007BFF;
               }
               
               .article p {
                   margin: 10px 0;
                   color: #444;
               }
               
               .buttons {
                   margin-top: 15px;
               }
               
               .buttons a {
                   display: inline-block;
                   margin-right: 10px;
                   text-decoration: none;
                   color: white;
                   background-color: #28a745;
                   padding: 8px 12px;
                   border-radius: 5px;
                   font-size: 14px;
               }
               
               .buttons a:nth-child(2) {
                   background-color: #ffc107;
               }
               
               .buttons a:nth-child(3) {
                   background-color: #dc3545;
               }
               
               .buttons a:hover {
                   opacity: 0.8;
               }
               </style>
<div class="containe">
    <h3>Liste  des Articles:</h3>
    <div class="conten">

        <?php if (isset($_SESSION['articles']) && count($_SESSION['articles']) > 0): ?>
            <?php foreach ($_SESSION['articles'] as $index => $article): ?>
                <div class="article">
                    <h4><?= htmlspecialchars($article['titre']) ?></h4>
                    <p><strong>Introduction :</strong> <?= htmlspecialchars($article['introduction']) ?></p>
                    <p><strong>Date :</strong> <?= isset($article['date']) ? htmlspecialchars($article['date']) : '' ?></p>
                    
                    <div class="buttons">
                        <a href="article.php?index=<?= $index ?>">Voir</a>
                        <a href="edit-article.php?index=<?= $index ?>">Éditer</a>
                        <a href="delete_article.php?id=<?=($article['id']) ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">Supprimer</a>   
                    </div>
                </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <p>Aucun article ajouté pour l'instant.</p>
                    <?php endif; ?>
                    
                </div>

</div>

   
</body>
</html>




