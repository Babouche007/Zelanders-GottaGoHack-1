<?php


class tagselection
{
    public static function add():string
    {
        $arr = array();
        echo '<select type="submit" name="choice" value="choice" onclick="create()">
                        <option value="Aucun">Aucun</option>';
        global $db;
        $query = $db->query("SELECT * FROM tags ");
        while ($tag = $query->fetch()){
            echo '<option value="'.$tag['name'].'">'. $tag['name'].'</option>';
        }
        echo '<option value="Autres">Autres</option> 
                    </select><button type="submit" name="select" value="select">Séléctionner</button><br/><br/>';
        if($_POST['choice'] == "Autres"){
            echo '<script>alert("aled")</script>';
        }
        if($_POST['choice'] != "Aucun"){
            $arr[] = $_POST['choice'];
            $_POST['choice'] = "Aucun";
        }


        return serialize($arr);
    }
}