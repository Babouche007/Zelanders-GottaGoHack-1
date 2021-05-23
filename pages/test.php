<?php
    session_start();
    global $db;
    echo 'NSM';
    $id = $_SESSION['id'];
    echo $id ;

    $db->query("UPDATE `activities` SET `member`= member + 1 WHERE `id`=='$id'");
    header('Location: ../index.php');
