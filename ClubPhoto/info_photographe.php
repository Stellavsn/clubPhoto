<table>
    <?php
        $sql='SELECT * FROM photographe WHERE NOT nomphotographe="admin"';
        $stmt=$cnx->prepare($sql);
        $stmt->execute();
        $lesPhotographes=$stmt->fetchAll(PDO::FETCH_OBJ);
    ?>
<tr>
    <th>Liste des photographes</th>
    <th></th>
</tr>
<tr>
    <?php 
        foreach($lesPhotographes as $photographe):
    ?>
    <td><?php echo htmlspecialchars($photographe->nomphotographe);?> <?php echo htmlspecialchars($photographe->prenomphotographe);?></td>

    <td><a href="index.php?page=info_photographe&idphotographe=<?= htmlspecialchars($photographe->idphotographe) ?>"> Modifier </a></td>
</tr>

<?php endforeach; 
?>
</table>
<?php
    if (isset($_GET['idphotographe'])){
    $idphotographe=$_GET['idphotographe'];

    $sql="SELECT * FROM photographe WHERE idphotographe=?";
    $stmt=$cnx->prepare($sql);
    $stmt->execute([$idphotographe]);
    $photographe=$stmt->fetch(PDO::FETCH_OBJ);

?>
<h3>Modifier le photographe</h3>
<form action="" method="post">
        <input type="hidden" name="idphotographe" value="<?= htmlspecialchars($photographe->idphotographe) ?>">
        <input type="text" name="nom" value="<?= htmlspecialchars($photographe->nomphotographe) ?>">
        <input type="text" name="prenom" value="<?=htmlspecialchars($photographe->prenomphotographe) ?>">
        <input type="submit" value="Modifier" name="modifier">
</form>
<?php
    if (isset($_POST['modifier'])):
    $modifier="UPDATE photographe SET nomphotographe=?, prenomphotographe=? WHERE idphotographe=?";
    $stmt=$cnx->prepare($modifier);
    $stmt->bindValue(1,$_POST['nom']);
    $stmt->bindValue(2,$_POST['prenom']);
    $stmt->bindValue(3,$idphotographe);
    $stmt->execute();

header("Location: index.php?page=info_photographe");
    
endif;}
?>