<div id="infoPhoto">
    <?php        
        if (isset($_GET['photo'])) {
            $imagePhoto = $_GET['photo'];


            $sql = "SELECT * FROM photo INNER JOIN article ON article.idarti = photo.idarti INNER JOIN type ON type.idtype=article.idtype WHERE photo.idphoto = ?";
            $stmt = $cnx->prepare($sql);
            $stmt->execute([$imagePhoto]);
            $lesPhotos = $stmt->fetch(PDO::FETCH_OBJ);
        }
    ?>
    <h1>Informations sur la photo</h1>
        <fieldset>
            <p>Détail de la photo</p>
            <table>
            <?php if ($lesPhotos):?>
            <tr>
                <th>Titre : </th>
                <td><!--Récupérer les titres-->
                <?php echo htmlspecialchars($lesPhotos->titrephoto); ?>
                </td>
            </tr>
            <tr>
                <th>Texte article : </th>
                <td><!--Récupérer les articles-->
                <?php echo htmlspecialchars($lesPhotos->textephoto); ?>
                </td>
            </tr>
            <tr>
                <th>Type de l'article : </th>
                <td><!--Récupérer les types d'article-->
                <?php echo htmlspecialchars($lesPhotos->nomtype); ?>
                </td>
            </tr>
            <tr>
                <th>Détail de l'article :</th>
                <td><!--Récupérer les types d'article-->
                <?php echo htmlspecialchars($lesPhotos->textearti); ?>
                </td>
            </tr>
            <tr>
                <th>Photo </th>
                <td><!--Récupérer les photos-->
                <img src="<?php echo htmlspecialchars($lesPhotos->imagephoto); ?>" alt="Photo" width=20%/>
            </td>
            </tr>
            <?php endif; ?>
        </table>
    </fieldset>
</div>