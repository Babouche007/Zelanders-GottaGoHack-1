<?php
    include '../config.php';
    global $db;

    $userquery = explode(' ', $_GET["query"]);
    $sql = 'SELECT * FROM activities WHERE tags IN (\'' . $_GET["query"] . '\'' ;

    foreach($userquery as $k){
        $sql .= ",'$k'";
    }
    $sql .= ')';
    $query = $db->prepare($sql);
    $query->execute();
    while ($result = $query->fetch(PDO::FETCH_ASSOC)){
        print_r($result);
        echo '<br/>';
    }
