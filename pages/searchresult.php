
<?php
    include '../config.php';

    session_start();
    global $db;

    echo '<link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>';

    $userquery = explode(' ', $_GET["query"]);
    $sql = 'SELECT * FROM activities WHERE tags IN (\'' . $_GET["query"] . '\'' ;

    foreach($userquery as $k){
        $sql .= ",'$k'";
    }
    $sql .= ')';
    $query = $db->prepare($sql);
    $query->execute();
    $number = 1;
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        echo '<p> - ' . $number . ' -'. '<br/>'.' Titre : ' . $result['title'] . '<br/>' . 'Tags : ' . $result['tags'] .
            '<br/>' . 'Description : ' . $result['description'] . '<br/>' . 'Membres : ' . $result['member'] . '/'
            . $result['maxmember'] . '<p/>';
        $_SESSION['title'] = $result['title'];
        $_SESSION['id'] = $result['id'];
         ?><form> <br/><input type="button" onclick="location.href='test.php';" value= "Rejoindre" /></form>
        <?php
        $number += 1;
    }?>
    <form> <br/><input type="button" onclick="location.href='../index.php';" value="Retour au site "/></form>



