<?php
$db_host = "localhost";
$db_user = "root";
$db_password = "";
$db_database = "Projet_transversal";
$db_port = "3306";

session_start();

if (!isset($_GET['c'])) {
     header('location: http://' . $_SERVER['HTTP_HOST'] .    $_SERVER['REQUEST_URI'] . 'index.php?c=c');
 }

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
</head>

<body>
    
<?php
if (isset($_SESSION['type'])) {

     echo 'Vous êtes connecté en tant que ' . (($_SESSION['type'] == "admin") ? "Administrateur " : "client ") . $_SESSION['nom_user'] . ' ' . $_SESSION['prenom_user'];
     echo '<br><a href="./login.php?logout=1">Se deconnecter</a><br><br>';
}else{
     header('Location: http://localhost/circuits/login.php');
}

$conn = mysqli_connect($db_host, $db_user, $db_password, $db_database, $db_port);
if (!$conn) {
     die("Erreur de connexion à la base de données");
};
?>

<table>
     <tr>
          <td><a href="./index.php?c=i">Les Circuits</a></td>
          <td><a href="./index.php?c=e">Les Etapes</a></td>
          <td><a href="./index.php?c=t">Les Lieux touristiques</a></td>
     </tr>
</table>

<?php

if (!isset($_GET['c'])){
     die();
}

switch ($_GET['c']) {

     case "i":

          switch ((isset($_GET['do']) ? $_GET['do'] : "list")) {

               case "create":
?>
                    <br><br>
                    <form action="index.php" method="get">
                         <label for="paysdepart"> Pays de Départ:</label>
                         <input type="text" id="paysdepart" name="paysdepart"><br><br>
                         <label for="villedepart">Ville de Départ :</label>
                         <input type="text" id="villedepart" name="villedepart"><br><br>
                         <label for="paysarrive"> Pays d'Arrivé:</label>
                         <input type="text" id="paysarrive" name="paysarrive"><br><br>
                         <label for="villearrive"> Ville d'Arrivé:</label>
                         <input type="text" id="villearrive" name="villearrive"><br><br>
                         <label for="date_circuit"> Date du circuit:</label>
                         <input type="text" id="date_circuit" name="date_circuit"><br><br>
                         <label for="dureecircuit"> Durée du circuit:</label>
                         <input type="text" id="dureecircuit" name="dureecircuit"><br><br>
                         <label for="placesdispo"> Nombre de places disponibles:</label>
                         <input type="text" id="placesdispo" name="placesdispo"><br><br>
                         <label for="prixcircuit"> Prix du Circuit:</label>
                         <input type="text" id="prixcircuit" name="prixcircuit"><br><br>
                         <label for="desccircuit"> Description du Circuit:</label>
                         <input type="text" id="desccircuit" name="desccircuit"><br><br>
                         <input type="hidden" name="c" value="i">
                         <input type="hidden" name="do" value="add">
                         <input type="submit" value="Envoyer">
                    </form>
                    <?php
                    break;
               
               case "add":
                    foreach ($_GET as $key => $Value){
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "INSERT INTO Circuit (PaysDepart, ville_depart, PaysArrive, ville_arriver, date_circuit, duree_circuit, Nbr_placesDispo, prix_inscription, desc_circuit) values ('" . $_GET['paysdepart'] . "','" . $_GET['villedepart'] . "','" . $_GET['paysarrive'] . "','" . $_GET['villearrive'] . "','" . $_GET['date_circuit'] . "','" . $_GET['dureecircuit'] . "','" . $_GET['placesdispo'] . "','" . $_GET['prixcircuit'] . "','" . $_GET['desccircuit'] . "')";
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                    echo "Ajout OK !";
                    }
                    break;

               case "read":
                    $sql = "SELECT * FROM Circuit WHERE Id_Circuit=" . $_GET['Id_Circuit'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } elseif (mysqli_num_rows($resultat) == 1) {
                         $row = mysqli_fetch_assoc($resultat);
                    ?>
                         <form action="index.php" method="get">
                              <label for="paysdepart"> Pays de Départ:</label>
                              <input type="text" id="paysdepart" name="paysdepart" value="<?php echo $row['PaysDepart'] ?>"><br><br>
                              <label for="villedepart">Ville de Départ :</label>
                              <input type="text" id="villedepart" name="villedepart" value="<?php echo $row['ville_depart'] ?>"><br><br>
                              <label for="paysarrive"> Pays d'Arrivé:</label>
                              <input type="text" id="paysarrive" name="paysarrive" value="<?php echo $row['PaysArrive'] ?>"><br><br>
                              <label for="villearrive"> Ville d'Arrivé:</label>
                              <input type="text" id="villearrive" name="villearrive" value="<?php echo $row['ville_arriver'] ?>"><br><br>
                              <label for="date_circuit"> Date du Circuit:</label>
                              <input type="text" id="date_circuit" name="date_circuit" value="<?php echo $row['date_circuit'] ?>"><br><br>
                              <label for="dureecircuit"> Durée du circuit:</label>
                              <input type="text" id="dureecircuit" name="dureecircuit" value="<?php echo $row['duree_circuit'] ?>"><br><br>
                              <label for="placesdispo"> Nombre de places disponibles:</label>
                              <input type="text" id="placesdispo" name="placesdispo" value="<?php echo $row['Nbr_placesDispo'] ?>"><br><br>
                              <label for="prixcircuit"> Prix du Circuit:</label>
                              <input type="text" id="prixcircuit" name="prixcircuit" value="<?php echo $row['prix_inscription'] ?>"><br><br>
                              <label for="desccircuit"> Description du Circuit:</label>
                              <input type="text" id="desccircuit" name="desccircuit" value="<?php echo $row['desc_circuit'] ?>"><br><br>
                              <input type="hidden" name="Id_Circuit" value="<?php echo $row['Id_Circuit'] ?>">
                              <input type="hidden" name="c" value="i">
                              <input type="hidden" name="do" value="update">
                              <input type="submit" value="Envoyer">
                         </form>
                    <?php
                    }else{
                         echo mysqli_num_rows($resultat);
                    }
                    break;

               case "update":
                    foreach ($_GET as $key => $Value) {
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "UPDATE Circuit SET PaysDepart='" . $_GET['paysdepart'] . "', ville_depart='" . $_GET['villedepart'] . "',PaysArrive='" . $_GET['paysarrive'] . "',ville_arriver='" . $_GET['villearrive'] . "',date_circuit='" . $_GET['date_circuit'] . "', duree_circuit='" . $_GET['dureecircuit'] . "',Nbr_placesDispo='" . $_GET['placesdispo'] . "',prix_inscription='" . $_GET['prixcircuit'] . "',desc_circuit='" . $_GET['desccircuit'] . "' where Id_Circuit=" . $_GET['Id_Circuit'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement mis à jour";
                    }
                    break;

               case "del":
                    $sql = "DELETE FROM Circuit where Id_Circuit=" . $_GET['Id_Circuit'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement supprimé";
                    }

                    break;
                    
               default:
                    echo "<br/> Voici la liste des Circuits : <br/>";
                    if ($_SESSION['type'] == "admin") {
                    echo "<br><a href='./index.php?c=i&do=create'>Ajouter un Circuit</a>";
                    }
                         $sql = 'SELECT * FROM Circuit ORDER BY PaysDepart';
                         $resultat = mysqli_query($conn, $sql);
                         if ($resultat == FALSE) {
                              die("<br>Echec d'execution de la requete : " . $sql);
                         } else {
                              ?>
                              <table border=1>
                                   <tr>
                                        <td>Id du circuit</td>
                                        <td>Pays de Départ</td>
                                        <td>Ville de départ</td>
                                        <td>Pays d'arrivé</td>
                                        <td>Ville d'arrivé</td>
                                        <td>Date de Départ</td>
                                        <td>Durée du Circuit (En jours)</td>
                                        <td>Nombre de places dispo</td>
                                        <td>Prix du circuit</td>
                                        <td>Description du Circuit</td>
                                   </tr>
                              <?php
                              while ($row = mysqli_fetch_assoc($resultat)) {
                                   echo "<tr>";
                                   echo "<td>" . $row['Id_Circuit'] . "</td>";
                                   echo "<td>" . $row['PaysDepart'] . "</td>";
                                   echo "<td>" . $row['ville_depart'] . "</td>";
                                   echo "<td>" . $row['PaysArrive'] . "</td>";
                                   echo "<td>" . $row['ville_arriver'] . "</td>";
                                   echo "<td>" . $row['date_circuit'] . "</td>";
                                   echo "<td>" . $row['duree_circuit'] . "</td>";
                                   echo "<td>" . $row['Nbr_placesDispo'] . "</td>";
                                   echo "<td>" . $row['prix_inscription'] . "</td>";
                                   echo "<td>" . $row['desc_circuit'] . "</td>";
                                   if ($_SESSION['type'] == "admin") {
                                   echo "<td><a href=./index.php?c=i&do=del&Id_Circuit=" . $row['Id_Circuit'] . ">supprimer</a></td>";
                                   echo "<td><a href=./index.php?c=i&do=read&Id_Circuit=" . $row['Id_Circuit'] . ">éditer</a></td>";
                                   }
                                   echo "</tr>";
                              }

                                   echo "</table>";
                              
                         }
                    break;
                    }
          default:
          break;
     case "e":

          switch ((isset($_GET['do']) ? $_GET['do'] : "list")){
          
               case "create":
                    ?>
                    <br><br>
                    <form action="index.php" method="get">
                         <label for="pays_etape"> Pays de l'étape:</label>
                         <input type="text" id="pays_etape" name="pays_etape"><br><br>
                         <label for="ville_etape">Ville de l'étape :</label>
                         <input type="text" id="ville_etape" name="ville_etape"><br><br>
                         <label for="date_etape"> Date de l'étape:</label>
                         <input type="text" id="date_etape" name="date_etape"><br><br>
                         <label for="duree_etape"> Durée de l'étape:</label>
                         <input type="text" id="duree_etape" name="duree_etape"><br><br>
                         <input type="hidden" name="c" value="e">
                         <input type="hidden" name="do" value="add">
                         <input type="submit" value="Envoyer">
                    </form>
                    <?php
                    break;
               
               case "add":
                    foreach ($_GET as $key => $Value){
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "INSERT INTO etape (pays_etape, ville_etape, date_etape, duree_etape) values ('" . $_GET['pays_etape'] . "','" . $_GET['ville_etape'] . "','" . $_GET['date_etape'] . "','" . $_GET['duree_etape'] . "')";
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                    echo "Ajout OK !";
                    }
                    break;
          
               case "read":
                    $sql = "SELECT * FROM etape WHERE id_etape=" . $_GET['id_etape'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } elseif (mysqli_num_rows($resultat) == 1) {
                         $row = mysqli_fetch_assoc($resultat);
                    ?>
                         <form action="index.php" method="get">
                              <label for="pays_etape"> Pays de l'étape:</label>
                              <input type="text" id="pays_etape" name="pays_etape" value="<?php echo $row['pays_etape'] ?>"><br><br>
                              <label for="ville_etape">Ville de l'étape :</label>
                              <input type="text" id="ville_etape" name="ville_etape" value="<?php echo $row['ville_etape'] ?>"><br><br>
                              <label for="date_etape"> Date de l'étape:</label>
                              <input type="text" id="date_etape" name="date_etape" value="<?php echo $row['date_etape'] ?>"><br><br>
                              <label for="duree_etape"> Durée de l'étape (en heures):</label>
                              <input type="text" id="duree_etape" name="duree_etape" value="<?php echo $row['duree_etape'] ?>"><br><br>
                              <input type="hidden" name="id_etape" value="<?php echo $row['id_etape'] ?>">
                              <input type="hidden" name="c" value="e">
                              <input type="hidden" name="do" value="update">
                              <input type="submit" value="Envoyer">
                         </form>
                    <?php
                    }else{
                         echo mysqli_num_rows($resultat);
                    }
                    break;
          
               case "update":
                    foreach ($_GET as $key => $Value) {
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "UPDATE etape SET pays_etape='" . $_GET['pays_etape'] . "', ville_etape='" . $_GET['ville_etape'] . "', date_etape='" . $_GET['date_etape'] . "',duree_etape='" . $_GET['duree_etape'] . "' where id_etape=" . $_GET['id_etape'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement mis à jour";
                    }
                    break;
          
               case "del":
                    $sql = "DELETE FROM etape where id_etape=" . $_GET['id_etape'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement supprimé";
                    }
          
                    break;
                    
               default:
                    echo "<br/> Voici la liste des Etapes : <br/>";
                    if ($_SESSION['type'] == "admin") {
                    echo "<br><a href='./index.php?c=e&do=create'>Ajouter une étape</a>";
                    }
                    $sql = 'SELECT * FROM etape ORDER BY pays_etape';
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         ?>
                         <table border=1>
                              <tr>
                                   <td>Id de l'étape</td>
                                   <td>Pays de l'étape</td>
                                   <td>Ville de l'étape</td>
                                   <td>Date de l'étape</td>
                                   <td>Durée du l'étape (en heures)</td>
                              </tr>
                         <?php
                         while ($row = mysqli_fetch_assoc($resultat)) {
                              echo "<tr>";
                              echo "<td>" . $row['id_etape'] . "</td>";
                              echo "<td>" . $row['pays_etape'] . "</td>";
                              echo "<td>" . $row['ville_etape'] . "</td>";
                              echo "<td>" . $row['date_etape'] . "</td>";
                              echo "<td>" . $row['duree_etape'] . "</td>";
                              if ($_SESSION['type'] == "admin") {
                              echo "<td><a href=./index.php?c=e&do=del&id_etape=" . $row['id_etape'] . ">supprimer</a></td>";
                              echo "<td><a href=./index.php?c=e&do=read&id_etape=" . $row['id_etape'] . ">éditer</a></td>";
                              }
                              echo "</tr>";
                         
                         }
     
                              echo "</table>";
                    }
          
               break;
          }
          break;
     
     
     case "t":

          switch ((isset($_GET['do']) ? $_GET['do'] : "list")){
          
               case "create":
                    ?>
                    <br><br>
                    <form action="index.php" method="get">
                              <label for="nom_lieu"> Nom du lieu:</label>
                         <input type="text" id="nom_lieu" name="nom_lieu"><br><br>
                         <label for="pays_lieu"> Pays du lieu:</label>
                         <input type="text" id="pays_lieu" name="pays_lieu"><br><br>
                         <label for="ville_lieu">Ville du lieu :</label>
                         <input type="text" id="ville_lieu" name="ville_lieu"><br><br>
                         <label for="prix_visite"> Prix de la visite (en euro):</label>
                         <input type="text" id="prix_visite" name="prix_visite"><br><br>
                         <label for="descriptif"> Descriptif :</label>
                         <input type="text" id="descriptif" name="descriptif"><br><br>
                         <input type="hidden" name="c" value="t">
                         <input type="hidden" name="do" value="add">
                         <input type="submit" value="Envoyer">
                    </form>
                    <?php
                    break;
               
               case "add":
                    foreach ($_GET as $key => $Value){
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "INSERT INTO lieu_a_visiter (nom_lieu, pays_lieu, ville_lieu, prix_visite, descriptif) values ('" . $_GET['nom_lieu'] . "','" . $_GET['pays_lieu'] . "','" . $_GET['ville_lieu'] . "','" . $_GET['prix_visite'] . "','" . $_GET['descriptif'] . "')";
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                    echo "Ajout OK !";
                    }
                    break;
          
               case "read":
                    $sql = "SELECT * FROM lieu_a_visiter WHERE id_lieu=" . $_GET['id_lieu'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                    die("<br>Echec d'execution de la requete : " . $sql);
                    } elseif (mysqli_num_rows($resultat) == 1) {
                         $row = mysqli_fetch_assoc($resultat);
                    ?>
                         <form action="index.php" method="get">
                              <label for="nom_lieu"> Nom du lieu:</label>
                              <input type="text" id="nom_lieu" name="nom_lieu" value="<?php echo $row['nom_lieu'] ?>"><br><br>
                              <label for="pays_lieu"> Pays du lieu:</label>
                              <input type="text" id="pays_lieu" name="pays_lieu" value="<?php echo $row['pays_lieu'] ?>"><br><br>
                              <label for="ville_lieu">Ville du lieu :</label>
                              <input type="text" id="ville_lieu" name="ville_lieu" value="<?php echo $row['ville_lieu'] ?>"><br><br>
                              <label for="prix_visite"> Prix d'entrée:</label>
                              <input type="text" id="prix_visite" name="prix_visite" value="<?php echo $row['prix_visite'] ?>"><br><br>
                              <label for="descriptif"> Descriptif :</label>
                              <input type="text" id="descriptif" name="descriptif"><br><br>
                              <input type="hidden" name="id_lieu" value="<?php echo $row['id_lieu'] ?>">
                              <input type="hidden" name="c" value="t">
                              <input type="hidden" name="do" value="update">
                              <input type="submit" value="Envoyer">
                         </form>
                    <?php
                    }else{
                         echo mysqli_num_rows($resultat);
                    }
                    break;
          
               case "update":
                    foreach ($_GET as $key => $Value) {
                         if (empty($Value)) {
                              $Value = "/";
                         }
                    }
                    $sql = "UPDATE lieu_a_visiter SET nom_lieu='" . $_GET['nom_lieu'] . "',pays_lieu='" . $_GET['pays_lieu'] . "',prix_visite='" . $_GET['prix_visite'] . "', descriptif='" . $_GET['descriptif'] . "' where id_lieu=" . $_GET['id_lieu'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement mis à jour";
                    }
                    break;
          
               case "del":
                    $sql = "DELETE FROM lieu_a_visiter where id_lieu=" . $_GET['id_lieu'];
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         echo "Enregistrement supprimé";
                    }
          
                    break;
                    
               default:
                    echo "<br/> Voici la liste des lieux touristiques : <br/>";
                    if ($_SESSION['type'] == "admin") {
                    echo "<br><a href='./index.php?c=t&do=create'>Ajouter une destination</a>";
                    }
                    $sql = 'SELECT * FROM lieu_a_visiter ORDER BY pays_lieu';
                    $resultat = mysqli_query($conn, $sql);
                    if ($resultat == FALSE) {
                         die("<br>Echec d'execution de la requete : " . $sql);
                    } else {
                         ?>
                         <table border=1>
                              <tr>
                                   <td>Id du lieu</td>
                                   <td>Nom du lieu</td>
                                   <td>Pays du lieu</td>
                                   <td>Ville du lieu</td>
                                   <td>Prix d'entrée</td>
                                   <td>Descriptif</td>
                              </tr>
                         <?php
                         while ($row = mysqli_fetch_assoc($resultat)) {
                              echo "<tr>";
                              echo "<td>" . $row['id_lieu'] . "</td>";
                              echo "<td>" . $row['nom_lieu'] . "</td>";
                              echo "<td>" . $row['pays_lieu'] . "</td>";
                              echo "<td>" . $row['ville_lieu'] . "</td>";
                              echo "<td>" . $row['prix_visite'] . "</td>";
                              echo "<td>" . $row['descriptif'] . "</td>";
                              if ($_SESSION['type'] == "admin") {
                              echo "<td><a href=./index.php?c=t&do=del&id_lieu=" . $row['id_lieu'] . ">supprimer</a></td>";
                              echo "<td><a href=./index.php?c=t&do=read&id_lieu=" . $row['id_lieu'] . ">éditer</a></td>";
                              }
                              echo "</tr>";
                         }
          
                              echo "</table>";
                    }
          
               break;
          }
          break;
}

                              ?>
</body>
</html>