<?php
session_start(); //pour demarrer la session

// si l utilisateur clique sur se deconnecter alors on detruit la session et on efface la varible $_SESSION
if (isset($_GET['logout'])) {
    if ($_GET['logout'] == "1") {
        session_destroy();
        unset($_SESSION);
    }
}

// retour du formulaire avec un login renseigné 

if (isset($_POST['login']) && isset($_POST['mdp'])) { // retour du formulaire avec un login et mot de passe  
    // varible de connexion a la base à mettre à jour si nécessaire
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_database = "projet_transversal";
    $db_port = "3306";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_database, $db_port);
    if (!$conn) { //test de connexion à la base
        die("Erreur de connexion à la base de données");
    };

    if ($sql = "select * from administrateur where adm_email='" . $_POST['login'] . "' and adm_mdp='" . $_POST['mdp'] . "'"){ // requete pour chercher si on trouve le login et mdp dasn le étudiants
    $resultat = mysqli_query($conn, $sql);
        if ($resultat == FALSE) {
            die("<br>Echec d'execution de la requete : " . $sql);
        } else {
            if (mysqli_num_rows($resultat) == 1) { // si il y a un resultat dasn la réquete alors ok sinon on ne traite pas car le login doit être unique
                $row = mysqli_fetch_assoc($resultat);
                //on initialise les variables  de session
                $_SESSION['id_user'] = $row['adm_id'];
                $_SESSION['nom_user'] = $row['adm_name'];
                $_SESSION['prenom_user'] = $row['adm_fname'];
                $_SESSION['mail_user'] = $row['adm_email'];
                $_SESSION['type'] = "admin"; //$_SESSION['type'] = "etu" pour enregistrer si c'est un étudiant  ou un prof
                header('location: http://localhost/circuits/index.php?c=c');
                
            }
        }
    }

    if($sql = "select * from client where client_email='" . $_POST['login'] . "' and client_mdp='" . $_POST['mdp'] . "'"){
        $resultat = mysqli_query($conn, $sql);
        if ($resultat == FALSE) {
            die("<br>Echec d'execution de la requete : " . $sql);
        } else {
            if (mysqli_num_rows($resultat) == 1) { // si il y a un resultat dasn la réquete alors ok sinon on ne traite pas car le login doit être unique
                $row = mysqli_fetch_assoc($resultat);
                //on initialise les variables  de session
                $_SESSION['id_user'] = $row['id_client'];
                $_SESSION['nom_user'] = $row['client_nom'];
                $_SESSION['prenom_user'] = $row['client_prenom'];
                $_SESSION['mail_user'] = $row['client_email'];
                $_SESSION['type'] = "client"; //$_SESSION['type'] = "etu" pour enregistrer si c'est un étudiant  ou un prof
                header('location: http://localhost/circuits/index.php?c=c');
                
            }
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Expires" content="0">
</head>

<body>
    <?php
    if (isset($_SESSION['type'])) {

        echo 'Hello ' . (($_SESSION['type'] == "admin") ? "Administrateur " : "client ") . $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
        echo '<br><a href="./login.php?logout=1">Se deconnecter</a><br><br>';
    }

    ?>

    <form action="./login.php" method=post>
        <label for="login">login :</label>
        <input type="text" id="login" name="login"><br><br>

        <label for="mdp">Mot de passe :</label>
        <input type="password" id="mdp" name="mdp"><br><br>

        <input type="submit" value="Envoyer"><br/>
        <a href="./register.php">Cliquez ici pour vous enregistrer</a>
    </form>

    <br><br><br><br><br>

</body>

</html>