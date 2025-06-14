<?php
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit(); 
    }
?>

<div id="infoArticle">
    <?php
        $sql="SELECT*FROM article INNER JOIN type ON type.idtype=article.idtype INNER JOIN photographe ON photographe.idphotographe = article.idphotographe WHERE photographe.username=? ORDER BY  datearti ASC";
        $stmt=$cnx->prepare($sql);
        $stmt->bindValue(1,$_SESSION['username']);
        $stmt->execute();
        $lesArticles=$stmt->fetchAll(PDO::FETCH_OBJ);

        if ($_SESSION['username']=="root"){
            $sql="SELECT*FROM article INNER JOIN type ON type.idtype=article.idtype INNER JOIN photographe ON photographe.idphotographe = article.idphotographe ORDER BY  datearti ASC";
            $stmt=$cnx->prepare($sql);
            $stmt->execute();
            $lesArticles=$stmt->fetchAll(PDO::FETCH_OBJ);
        }
    ?>
    
    <fieldset>
        <legend><h3>Liste des articles</h3></legend>
    <table>
        <tr>
            <th>Dates</th>
            <th>Les titres</th>
            <th>Détails</th>
            <th>Les Types</th>
            <th>Les photographes</th>
            <th>Les photos</th>
        </tr>

    <?php foreach($lesArticles as $article):?>
        <tr>    
            <td>
                <?php echo htmlspecialchars($article->datearti);?>
            </td>
            <td>
                <?php echo htmlspecialchars($article->titrearti);?>
            </td>
            <td>
                <?php echo htmlspecialchars($article->textearti);?>
            </td>
            <td>
                <?php echo htmlspecialchars($article->nomtype);?>
            </td>
            <td>
                <?php echo htmlspecialchars($article->nomphotographe);?>
                <?php echo htmlspecialchars($article->prenomphotographe);?>
            </td>
            <td>
                <!--Lien "voir les photos"-->
                <a href="index.php?page=info_article&article=<?= htmlspecialchars($article->idarti) ?>"> Voir les photos </a>
            </td>
        </tr>
        <?php endforeach ?>
    </table>
    </fieldset>

<?php
        if (isset($_GET['article'])):
            $idArticle=$_GET['article'];

            $sql="SELECT * FROM article INNER JOIN photo ON photo.idarti = article.idarti WHERE article.idarti=?";
            $stmt=$cnx->prepare($sql);
            $stmt->execute([$idArticle]);
            $lesArticles=$stmt->fetchAll(PDO::FETCH_OBJ);

            
            $requete="SELECT * FROM photo WHERE idarti=?";
            $stmt=$cnx->prepare($requete);
            $stmt->execute([$idArticle]);
            $lesTitres=$stmt->fetch(PDO::FETCH_OBJ);
            
            if (isset($_POST['ajouter'])){

                $file_name = basename($_FILES["fichier"]["name"]);
                $upload_dir = "images/";
                $upload_path = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES["fichier"]["tmp_name"], $upload_path)) {
                    
                $sql="INSERT INTO photo (titrephoto, textephoto, imagephoto, idarti) VALUES (?,?,?,?)";
                $stmt=$cnx->prepare($sql);
                $stmt->bindValue(1,$_POST['legende']);
                $stmt->bindValue(2,$_POST['description']);
                $stmt->bindValue(3,$upload_path);
                $stmt->bindValue(4,$idArticle);
                $stmt->execute();
                }
            } 
            ?>
    <div style="display: flex; justify-content: space-between;">
        <fieldset style="width: 48%;">
            <legend><h3>Les photos</h3></legend>
            <table>
                <tr>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Photo</th>
                </tr>
                <?php foreach($lesArticles as $article):?>
                <tr>
                    <td>
                        <?php echo htmlspecialchars($article->titrephoto) ?>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($article->textephoto) ?>
                    </td>
                    <td> 
                        <?php if ($article->imagephoto): ?>
                            <img src="<?= htmlspecialchars($article->imagephoto) ?>" alt="Photo de l'article" width="100"> <!-- A MODIFIER -->
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach ?>
            </table>
        </fieldset>

        <fieldset style="width: 48%;">
            <legend><h3>Ajouter une photo</h3></legend>
            <form method="post" enctype="multipart/form-data" style="display: flex; flex-direction: column; align-items: center; width: 80%; margin: auto;">
                <input type="text" name="legende" value="" placeholder="Nom de l'article" style="width: 100%; margin-bottom: 10px;"> </br>
                <textarea id="description" name="description" rows="5" cols="40" placeholder="Description photo" style="width: 100%; margin-bottom: 10px;"></textarea></br>
                <input type="file" id="fichier" name="fichier" required style="width: 100%; margin-bottom: 10px;">
                <button type="submit" name="ajouter" value="Ajouter" style="width: 100%;"> Ajouter
            </form>
        </fieldset>

    </div>
    <?php endif; ?>

</div>