<!Doctype html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
<form method="POST" action="" enctype="multipart/form-data">
    <link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <br/><br/>
    <label>Avatar :</label>
    <input type="file" name="avatar" />
    
    <p id="label_param_profil"> <b>Paramètres de profil </b></p>

    <div class="form-element">
        <!--<label>Nom d'utilisateur</label>-->
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" placeholder="Nouveau nom ?" required />
        </div>
        <div class="form-element">
        <!-- <label>Email</label>-->
           
            <input type="email" name="email" placeholder="Nouvel email ?" required />
        </div>
        <div class="form-element">
            <!--<label>Mot de passe</label>-->
            <input type="password" name="password" id= "password" placeholder="Nouveau mot de passe?" required />
        </div>
        <button type="submit" name="register" value="register">Modifier</button>
        <form> </br> </br><input type="button" onclick="location.href='../index.php';" value="Retour au site "/></form>
</form>

<?php
    include('../config.php');
    global $db;

    if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name']))
    {
        $tailleMax = 2097152;
        $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
        if($_FILES['avatar']['size'] <= $tailleMax)
        {
            $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1)); 
            if(in_array($extensionUpload, $extensionsValides))
            {
                $chemin = "../res/img/avatar".$_SESSION['id'].".".$extensionUpload;
                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                if($resultat)
                {
                    $updateavatar = $bdd->prepare('UPDATE users SET avatar = :avatar WHERE id = :id');
                    $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                    ));
                }
                else{
                '<p class="error">Error</p>';
                }
            }
            else 
            {
                echo '<p class="error">Mauvais format de fichier</p>';
            }

        }
        else {
        echo '<p class="error">Fichier trop volumineux</p>';
    }}

    if (isset($_POST['register'])) {
        if (!empty($name)){$username = $_POST['username'];}
        if (!empty($email)){$email = $_POST['email'];
            $query = $db->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
        }
        if (!empty($password)){$password = $_POST['password'];
        $hash_psswd = password_hash($password, PASSWORD_BCRYPT);
        }
    
        
        if ($query->rowCount() > 0) {
            echo '<p class="error">Email déjà enregistré!</p>';
        }
        else {
	        if ($query->rowCount() == 0) {
                $id = $_GET["id"];
                $created_activities = "{}";
                $query = $db->prepare("INSERT INTO users(id, created_activities, hash_psswd, email, username) 
                VALUES (:id, :created_activities, :hash_psswd, :email, :username)");
                $query->bindParam("id", $id, PDO::PARAM_STR);
                $query->bindParam("created_activities", $created_activities, PDO::PARAM_STR);
                $query->bindParam("hash_psswd", $hash_psswd, PDO::PARAM_STR);
                $query->bindParam("email", $email, PDO::PARAM_STR);
                $query->bindParam("username", $username, PDO::PARAM_STR);
                $result = $query->execute();
                if ($result) {
                    echo '<p class="success">Enregistrement réussi!</p>';
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $username;
                    header("Location: /");
                } else {
                    echo '<p class="error">Erreur</p>';
                        }
            }
        }
    }



?>
</body>
</html>