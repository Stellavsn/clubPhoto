<div id="photos">
    <h1>Nos photos : </h1>

    <form action="" method="post">
    <h5>Choix du type d'article</h5>
    
        <?php 
            
            $requete="SELECT * FROM type";
            $stmt=$cnx->prepare($requete);
            $stmt->execute();

            $lesTypes=$stmt->fetchAll(PDO::FETCH_OBJ);

            echo "<select name='listeType'>";
            foreach($lesTypes as $type){  
                echo "<option value='$type->idtype'>$type->nomtype</option>";
            }
            echo "</select>";
        ?>
    <input type="submit" name=Choisir value="Choisir"/>
    
    </form>
</div>

<div id="tableauArticle">
    <!--TABLEAU-->

    <?php     
    if (isset($_POST['listeType'])): 
        $typeSelectionne = $_POST['listeType'];
        

        $requete = "SELECT * FROM article INNER JOIN type ON type.idtype = article.idtype INNER JOIN photo ON article.idarti = photo.idarti WHERE type.idtype = ?";
        $stmt = $cnx->prepare($requete);
        $stmt->execute([$typeSelectionne]);
        $lesArticles = $stmt->fetchAll(PDO::FETCH_OBJ);

        
        // Récupération du nom du type sélectionné
        $requeteType = "SELECT nomtype FROM type WHERE idtype = ?";
        $stmtType = $cnx->prepare($requeteType);
        $stmtType->execute([$typeSelectionne]);
        $nomType = $stmtType->fetch(PDO::FETCH_OBJ)->nomtype;
    ?>
    <table> <!-- tableau pour afficher les photos choisies -->
        </br>Liste des photos de nos articles de type <?= htmlspecialchars($nomType) ?>
        
        <tr>
            <th>Nom de l'article</th>
            <th>Description</th>
            <th>Photo</th>
        </tr>

        <?php foreach ($lesArticles as $article): ?>
            <tr>
            <td>
                <!--Faire un lien vers l'article-->
                <a href="index.php?page=info_photo&photo=<?= htmlspecialchars($article->idphoto) ?>">                
                <?= htmlspecialchars($article->titrearti) ?>

            <td><?= htmlspecialchars($article->textearti) ?></td>
            <td>
                <?php if ($article->imagephoto): ?>
                    <img src="<?= htmlspecialchars($article->imagephoto) ?>" alt="Photo de l'article" width="100">
                <?php endif; ?>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>

        <?php endif; ?>
</div>