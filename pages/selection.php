<?php
    include '../config.php';
    global $db;

    function select($tag)
    {
        global $db;
        if ($tag == 'Tous') {
          $sql = "SELECT a.title, a.info, a.description, a.member, a.maxmember, u.username FROM activities a, users u WHERE u.id = a.author_id " ;
        }
        else {
           $sql = "SELECT a.title, a.info, a.description, a.member, a.maxmember, u.username FROM activities a, users u WHERE a.tags = '$tag' AND u.id = a.author_id " ;
         }
        $query = $db->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
         
    }
    