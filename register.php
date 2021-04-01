<?php
session_start();

if (isset($_GET['logout'])) {
    if ($_GET['logout'] == "1") {
        session_destroy();
        unset($_SESSION);
    }
}

if (isset($_POST['client_email']) && isset($_POST['client_email'])) {
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_database = "Projet_transversal";
    $db_port = "3306";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_database, $db_port);
    if (!$conn) {
        die("Erreur de connexion à la base de données");
    };

    $sql = "SELECT * FROM client where client_email='" . $_POST['client_email'] . "'";
    $resultat = mysqli_query($conn, $sql);
    if ($resultat == FALSE) {
        die("<br>Echec d'execution de la requete : " . $sql);
    } elseif (mysqli_num_rows($resultat) == 1) {
            echo'cet email est déjà pris';
        }else{
            $sql = "INSERT INTO client (client_nom, client_prenom, client_email, client_mdp) values ('" . $_POST['client_nom'] . "','" . $_POST['client_prenom'] . "','" . $_POST['client_email'] . "','" . $_POST['client_mdp'] . "')";
            $resultat = mysqli_query($conn, $sql);
            if ($resultat == FALSE) {
                die("<br>Echec d'execution de la requete : " . $sql);
            } else {
                session_destroy();
                unset($_SESSION);
                echo 'Inscription réussie, vous allez être redirigé vers notre site sans quelques instants :';
                header('location: http://localhost/circuits/index.php?c=c');
            }
        }   
}
?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
</head>

<body>
                    <br><br>
                    <form action="register.php" method="post">
                         <label for="client_nom"> Nom :</label>
                         <input type="text" id="client_nom" name="client_nom"><br><br>
                         <label for="client_prenom">Prenom :</label>
                         <input type="text" id="client_prenom" name="client_prenom"><br><br>
                         <label for="client_email">Email :</label>
                         <input type="text" id="client_email" name="client_email"><br><br>
                         <label for="client_mdp"> MDP :</label>
                         <input type="password" id="client_mdp" name="client_mdp"><br><br>
                         <input type="submit" value="Envoyer">
                    </form>
</body>
</html>