<!Doctype html>
<html>
<head>
    <title>Profil</title>
</head>
<body>
<form>
    <link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <p id="label_avatar"> <b>Photo de profil </b></p>
    <img src="../res/img/invis-user.png" alt="avatar de base" width = "300px"></br>
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
    }else{echo '<p>TEST</p>';}



?>
</body>
</html>