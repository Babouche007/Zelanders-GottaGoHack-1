<!DOCTYPE html>

<?php
    include 'utils/utils.php';
    if (isset($_GET['logout']))
        utils::DeleteAllCookies();
?>

<html lang="fr">
<head>
    <link href="css\Accueil.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <title>Giwa</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/logo.png" />
    <script src="js/iframe.js"></script>
</head>
<body>
    <nav class="menu" style="height: 60px;">
        <div class="titre">
            <h1><img src="res\img\giwa.png" align="left"  class="logo">  &nbsp  Giwa</h1>
            
        </div>
        <?php
        session_start();
        if(!utils::IsConnected()){
            echo '<ul class="links">
            <li>
                <a href="pages/login.php">Connexion |</a>
            </li>
            <li>
                <a href="pages/register.php"> Inscription</a>
            </li>
            </ul>';

        }
        else{
            $profil_link = 'pages/profil.php?id='.$_SESSION["user_id"];
            echo '<ul class="links">
            <li>
                <a href='.$profil_link.' >'. $_SESSION["username"].' |</a>
            </li>
            <li>
                <a href= ?logout=true> Deconnexion </a>
            </li>
            </ul>';
        }
        ?>
    </nav>
        <p id="accroche"><i>Que voulez - vous faire aujourd'hui ? </i></p></br>
<!--        <input type="search" id="search" placeholder="Rechercher un tag…" size="300">-->
        <form method="post">
            <input type="txext" id="search" name="searchinput" placeholder="Rechercher un ou plusieurs tags..." size="300">
            <input style="height: 30px" id="searchinput" type="submit" name="searchbutton" value="Rechercher"/>
        </form>
         <p id="explication"><i>Entrez le nom d'une catégorie afin de pouvoir trouver l'activité dont vous avez envie! </i></p></br>

        <?php
            if(isset($_POST["searchbutton"]) or isset($_POST["searchinput"])) {
                header('Location: /pages/searchresult.php?query='.$_POST["searchinput"]);
            }
        ?>

        <div class="separation"> <h1>VOS ACTIVITÉS</h1> </div>

        <div id="global">
        <div id="gauche" style="width: 200px">
        
        <ul class="categorie">
            <li onclick="afficher(this)" active="true" style="cursor: pointer">Musique</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Jeux Vidéos</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Films/Séries</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Sport</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Cuisine</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Service</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Programmation</li>
            <li onclick="afficher(this)" active="false" style="cursor: pointer">Tous</li>
            </ul> </div>

           <div id="droit"><iframe id="change" title="Musique" width="1000" height="650" src="pages/liste.php?query=Musique">
           </iframe></div>

           </div>
        <div class="top">
        <a href="#top"><img src="res\img\top.png"></a>
    </div>
</body>
<footer>
    <i>by Les Zelanders &nbsp  &nbsp</i> <img src="res/img/zelanders.png" align="middle" class="logo2" />  &nbsp  &nbsp
    EPITA 2020/2021 <br>
</footer>
</html>
