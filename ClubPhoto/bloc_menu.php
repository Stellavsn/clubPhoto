
<a href="index.php" class="btn">Accueil</a>
<a href="index.php?page=liste_photo" class="btn">Les photos</a>

<?php if(!isset($_SESSION['username'])): ?>
    <a href="index.php?page=login" class="btn">Connexion</a>
<?php endif; ?>

<?php if(isset($_SESSION['username'])): ?>

    <a href="index.php?page=info_article" class="btn">Les articles</a>

    <?php if($_SESSION['username'] == "root"): ?>
        <a href="index.php?page=info_photographe" class="btn">Les photographes</a>
    <?php endif; ?>
    
    <a href="index.php?page=logout" class="btn">Déconnexion</a>

    <h3>Bonjour <?= $_SESSION['username']; ?> et bienvenue !</h3>

<?php endif; ?>

