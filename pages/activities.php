
<!Doctype html>
<html>
<head>
    <title>titre</title>
</head>
<body>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="title" placeholder="Title"><br/>
    <input type="text" name="description" placeholder="Description"><br/>
    <ul>
        <li><button type="submit" name="videoGame" value="videoGame">Jeux Vidéos</button></li>
        <li><button type="submit" name="music" value="music">Musique</button></li>
        <li><button type="submit" name="sport" value="sport">Sport</button></li>
        <li><button type="submit" name="discution" value="discution">Discussion</button></li>
        <li><button type="submit" name="boardGame" value="boardGame">Jeux de sociétés</button></li>
        <li><button type="submit" name="cinema" value="cinema">Cinéma</button></li>
    </ul>
    <button type="submit" name="create-activity" value="create-activity">Créer</button>
</form>
</body>
</html>

<?php
ob_start();
session_start();
include '../config.php';
global $db;

if(isset($_POST['create-activity'])){
    if (empty($_POST["title"])) {
        echo '<p class="error">Titre requis</p>';
    }
    elseif (empty($_POST["description"])){
        echo '<p class="error">Déscription requise</p>';
    }
    else{
        $title = $_POST['title'];
        $description = $_POST['description'];
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
            $query = $db->prepare("INSERT INTO activities(id,title,category,info,description) 
        VALUES (:id,:title,:info,:description)");
            $query->bindParam("id", $id, PDO::PARAM_STR);
            $query->bindParam("title", $title, PDO::PARAM_STR);
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
}

$query = $db->query("SELECT * FROM activities ");
while($activity = $query->fetch()){
    echo '<p class="separator">---------------------------------</p>';
    echo "Titre : " . $activity['title'] ?><br/><?php
    echo " Description : " . $activity['description'];?><br/><?php
}

?>
