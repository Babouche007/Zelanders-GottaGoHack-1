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
        while($activity = $query->fetch()){
            echo $activity["title"] . '<br/>';
        }
    }
?>


