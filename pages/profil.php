<!Doctype html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
<form>
    <link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <p id="label_avatar"> <b>Photo de profil </b></p>
    <img src="../res/img/invis-user.png" alt="avatar de base" width = "300px"></br>
    <p id="label_param_profil"> <b>Paramètres de profil </b></p>
</form>

<?php
    include('../config.php');
    global $db;
    $id = $_GET["id"];
    $query = $db->prepare("SELECT * FROM users WHERE id=:id");
    $query->bindParam("id",$id, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() == 0) {
        header('HTTP/1.0 404 Not Found');
        exit;
    }
    else{
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $username = $result["username"];
        echo 'Username: '. $username. '<br/>';
        $query = $db->prepare("SELECT * FROM activities WHERE author_id=:author_id");
        $query->bindParam("author_id",$id, PDO::PARAM_STR);
        $query->execute();
        if($query->rowCount() > 0)
            echo "Activités: <br/>";
        else
            echo "Aucune activité";
//        $result = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="dropdown">
  <?php
        while($activity = $query->fetch()){
            ?><span><i><?php echo $activity["title"] . '<br/>';?></i></span>
            <div class="dropdown-content">
                <p><?php echo $activity["description"] . '<br/>';?></p>
              </div>
            </div><br/><?php
        }
    }
?>
  

</body>
</html>
<form> </br><input type="button" onclick="location.href='../pages/activities.php';" value="Ajouter une activité "/></form>
