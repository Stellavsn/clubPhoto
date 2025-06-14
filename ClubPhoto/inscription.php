<!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Club Photo</title>
        <link rel="stylesheet" type="text/css" href="config/style.css?v=1.0" />
    </head>
    <body>
        <?php
        if (isset($_POST['nom'], $_POST['prenom'], $_POST['username'], $_POST['mdp'])){

        $pass=$_POST['mdp'];
        $hash = password_hash($pass, PASSWORD_BCRYPT);

        $sql = 'INSERT INTO photographe VALUES (NULL, ?, ?, ?, ?)';
        $stmt=$cnx->prepare($sql);
        $stmt->bindValue(1,$_POST['nom']);
        $stmt->bindValue(2,$_POST['prenom']);
        $stmt->bindValue(3,$_POST['username']);
        $stmt->bindValue(4,$hash);

        $stmt->execute();

        if($stmt){
            echo "<h3>Vous êtes inscrit avec succès.</h3>
            <p>Cliquez ici pour vous <a href='index.php?page=login'>connecter</a></p>";
        }
        }else{?>

    <form action="" method="post">
        <h1>S'inscrire</h1>
        <input type="text" name="nom" placeholder="Nom de l'utilisateur" required />
        <input type="text" name="prenom" placeholder="Prénom de l'utilisateur" required />
        <input type="text" name="username" placeholder="Nom d'utilisateur" required />
        <input type="password" name="mdp" placeholder="Mot de passe" required />
        

        <input type="submit" name="submit" value="S'inscrire" />

        <p>Déjà inscrit ? <a href="index.php?page=login">Connectez-vous ici</a></p>

    </form>

        <?php } ?>

    </body>
    </html>

