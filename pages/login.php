<form id="form" method="post" action="" name="login-form">
<link href="..\css\Accueil.css" rel="stylesheet" type="text/css"/>
    <div class="box">
        <div class="form-element">
            <label>Username</label>
            <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
        </div>
        <div class="form-element">
            <label>Password</label>
            <input type="password" name="password" required />
        </div>
        <button type="submit" name="login" value="login">Login</button>
        <form> </br><input type="button" onclick="location.href='../index.php';" value="Retour au site "/></form>
    </div>
</form>

<?php
session_start();
include('../config.php');
global $db;
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $db->prepare("SELECT * FROM users WHERE username=:username");
    $query->bindParam("username", $username, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);
    if (!$result) {
        echo '<p class="error">Nom d\'utilisateur introuvable!</p>';
    } else {
        if (password_verify($password, $result['hash_psswd'])) {
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            echo '<p class="success">Vous êtes connecté!</p>';
            header("Location: /");
        } else {
            echo '<p class="error">Mauvaise combinaison!</p>';
        }
    }
}
?>


