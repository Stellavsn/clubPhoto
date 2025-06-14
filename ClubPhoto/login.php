<?php 
    require_once('config/connexion.php');
    $cnx=connexionPDO();

    if (isset($_POST['util'])){

        $sql='SELECT * FROM photographe WHERE username=?';
        $stmt=$cnx->prepare($sql);
        $stmt->bindValue(1,$_POST['util']);
        $stmt->execute();
        $lesEnregistrements = $stmt ->fetch(PDO::FETCH_OBJ);

        echo $lesEnregistrements->password;
        echo $_POST['mdp'];

            if (password_verify($_POST['mdp'],$lesEnregistrements->password)){
                $_SESSION['username']=$lesEnregistrements->username;
                header("Location: index.php?page=info_article");
                exit();
            }else{
                echo 'ERREUR';
            };
    }
    ?>

    <form action="" method="post" >
       <h1>Connexion</h1>
       <input type="text" name="util" placeholder="Nom d'utilisateur" />
       <input type="password" name="mdp" placeholder="Mot de passe" />
       <input type="submit" value="Connexion " name="submit" />
       <p>Vous êtes nouveau ici ? <a href="index.php?page=inscription">S'inscrire</a></p>
    </form>   
</body>
</html>


