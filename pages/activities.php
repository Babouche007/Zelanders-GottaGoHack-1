<?php ob_start();
        session_start();
        include '../config.php';
        include '../utils/utils.php';
        include '../utils/tagselection.php';?>
<!Doctype html>
<html lang="">
<head>
    <title>Création Activités</title>
</head>
<body>
<form id="form" method="post" action="" name="login-form">
    <link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <div class="box">
        <input type="text" name="title" placeholder="Titre"><br/><br/>
        <input type="text" name="description" placeholder="Description"><br/><br/>
        <?php
        global $db;
        $tags = "";
        $query = $db->query("SELECT * FROM tags ");
        echo '<form method="POST" action="fenetre.php">';
        while ($tag = $query->fetch()){
                echo'
                    <input type="checkbox" name= '.$tag["name"].' value="on">
                    <label for= '. $tag["name"] .' > '. $tag["name"] .' </label>';
        }
        echo'<input type="checkbox"  name="Autres" value="on">
             <input type="text" name="others" placeholder="Autres">';
        echo'</form>';
        $query = $db->query("SELECT * FROM tags ");
        while ($tag = $query->fetch()){
            if(isset($_POST[$tag["name"]])){
                $tags .= $tag['name'].' ';
            }
        }
        if(isset($_POST['Autres']) and isset($_POST['others'])){
            $response = $db->prepare("SELECT * FROM tags WHERE name=:name");
            $response->bindParam("name", $str, PDO::PARAM_STR);
            $response->execute();
            $tags .= $_POST['others'];
            if ($response->rowCount() == 0) {
                $str = $_POST['others'];
                $res = $db->prepare("INSERT INTO tags (name) VALUES (:name)");
                $res->bindParam("name", $str, PDO::PARAM_STR);
                $res->execute();
                header('Location: ./activities.php');
            }

        }
        $_SESSION['tags'] = $tags;

        ?>
        </br><br/>
        <button type="submit" name="create-activity" value="create-activity">Créer</button>
        <form> </br><br/><input type="button" onclick="location.href='../index.php';" value="Retour au site "/></form>
    </div>
</form>
</body>
</html>

<?php
global $db;

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
            $tags = $_SESSION['tags'];
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
                echo '<p class="separator">---------------------------------</p>';
                echo "Titre : " . $title ?><br/><?php
                echo " Description : " . $description;?><br/><?php
                echo '<p class="separator">---------------------------------</p>';
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
elseif (!utils::IsConnected()){
    echo '<p class="error">Vous devez vous connecter avant de pouvoir créer des activités</p>';
}
?>
