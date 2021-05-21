
<!Doctype html>
<html>
<head>
    <title>titre</title>
</head>
<body>

<form method="post">
    <input type="text" name="title" placeholder="Title"><br/>
    <input type="text" name="description" placeholder="Description"><br/>
    <button type="submit" name="create-activity" value="create-activity">Cr&eacute;er</button>
</form>
</body>
</html>

<?php
ob_start();
include '../config.php';
global $db;

if(isset($_POST['create-activity'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $info = "" ;
    $query = $db->prepare("SELECT * FROM activities WHERE title=:title");
    $query->bindParam("title", $title, PDO::PARAM_STR);
    $query->execute();
    if ($query->rowCount() > 0) {
        echo '<p class="error">Activite deja cree</p>';
    }
    if ($query->rowCount() == 0){
        $query = $db->prepare("INSERT INTO activities(title,info,description) 
        VALUES (:title,:info,:description)");
        $query->bindParam("title", $title, PDO::PARAM_STR);
        $query->bindParam("info", $info, PDO::PARAM_STR);
        $query->bindParam("description", $description, PDO::PARAM_STR);
        $result = $query->execute();
        if ($result) {
            echo '<p class="success">Activit&eacute; cr&eacute;e avec succ&eacute;s</p>';
        } else {
            echo '<p class="error">Quelque chose n&apos;a pas foncionn&eacute;</p>';
        }
    }
}

$query = $db->query("SELECT * FROM activities ");
while($activity = $query->fetch()){
    echo "Titre : " . $activity['title'] .  " Description : " . $activity['description'];?><br/><?php
}

?>
