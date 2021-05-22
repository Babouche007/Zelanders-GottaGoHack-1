<?php
ob_start();
session_start();
include '../config.php';
include '../utils/utils.php';
global $db;

function create(){
    echo'<p>Salut<p/>';
    global $db;
    $query = $db->query("SELECT * FROM tags ");
    while ($tag = $query->fetch()){
        echo '<option value="'.$tag['name'].'">'. $tag['name'].'</option>';
    }
}

if(isset($_POST['create-activity']) and utils::IsConnected()){
    if (empty($_POST["title"])) {
        echo '<p class="error">Titre requis</p>';
    }
    elseif (empty($_POST["description"])){
        echo '<p class="error">Déscription requise</p>';
    }
    else{
        $author_id = $_SESSION['user_id'];
        if($author_id){
            $title = $_POST['title'];
            $description = $_POST['description'];
            $tags = $_POST['choice'];
            $idNotFound = true;
            while($idNotFound){
                $idNotFound = false;
                $id = md5(random_bytes(10));
                $query = $db->prepare("SELECT * FROM activities WHERE id=:id");
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->execute();
                if ($query->rowCount() > 0) {
                    $idFound = true;
                }
            }
            $info = "" ;
            $query = $db->prepare("SELECT * FROM activities WHERE title=:title");
            $query->bindParam("title", $title, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                echo '<p class="error">Activité déjà créée</p>';
            }
            if ($query->rowCount() == 0){
                $query = $db->prepare("INSERT INTO activities(id,author_id,title,tags,info,description) 
        VALUES (:id,:author_id,:title,:tags,:info,:description)");
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->bindParam("author_id", $author_id, PDO::PARAM_STR);
                $query->bindParam("title", $title, PDO::PARAM_STR);
                $query->bindParam("tags",$tags);
                $query->bindParam("info", $info, PDO::PARAM_STR);
                $query->bindParam("description", $description, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    echo '<p class="success">Activité créée avec succés</p>';
                } else {
                    echo '<p class="error">Quelque chose n&apos;a pas foncionné</p>';
                }
            }
        }
        else{
            echo "Voulez vous vous connecter?";
        }
    }
}
$query = $db->query("SELECT * FROM activities ");
while($activity = $query->fetch()){
    echo '<p class="separator">---------------------------------</p>';
    echo "Titre : " . $activity['title'] ?><br/><?php
    echo " Description : " . $activity['description'];?><br/><?php
    $q = $db->prepare("SELECT * FROM users WHERE id=:id");
    $q->bindParam("id", $activity['author_id'], PDO::PARAM_STR);
    $q->execute();
    $result = $q->fetch(PDO::FETCH_ASSOC);
    echo "Author : " .$result['username']; ?><br/><?php
}


?>


<!Doctype html>
<html>
<head>
    <title>titre</title>
</head>
<body>
<form id="form" method="post" action="" name="login-form">
<link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <div class="box">
        <input type="text" name="title" placeholder="Titre"><br/>
        <input type="text" name="description" placeholder="Description"><br/>
        <select type="submit" name="choice" value="choice" onclick="create()">
            <?php
            echo'<p>Salut<p/>';
            global $db;
            $query = $db->query("SELECT * FROM tags ");
            while ($tag = $query->fetch()){
                echo '<option value="'.$tag['name'].'">'. $tag['name'].'</option>';
            } ?>
            <option value="Autres">Autres</option>
        </select><br/>
        <button type="submit" name="create-activity" value="create-activity">Créer</button>
        <form> </br><input type="button" onclick="location.href='../index.php';" value="Retour au site "/></form>
    </div>
</form>
</body>
</html>