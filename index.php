﻿<!DOCTYPE html>

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
        <input type="search" id="search" placeholder="Rechercher un tag…" size="300">
        <button style="height: 30px">Rechercher</button>
         <p id="explication"><i>Entrer le nom d'une catégorie afin de pouvoir trouver l'activité dont vous avez envie </i></p></br>

         <div class="separation"> <h1>VOS ACTIVITÉES</h1> </div>
         <ul class="categorie">
            
           <a href="#"><li> Musique </li></a>
           <a href="#"><li> Jeux Vidéo </li></a>
           <a href="#"><li> Film / Série </li></a>
           <a href="#"><li> Sport </li></a>
           <a href="#"><li> Cuisine </li></a>
           <a href="#"><li> Aide / Service </li></a>
           <a href="#"><li> Autres </li></a>
           <a href="#"><li> Weekly </li></a>

         </ul>
        <div class="top">
        <a href="#top"><img src="res\img\top.png"></a>
    </div>
</body>
<footer>
    <i>by Les Zelanders &nbsp  &nbsp</i> <img src="res/img/zelanders.png" align="middle" class="logo2" />  &nbsp  &nbsp
    EPITA 2020/2021 <br>
</footer>
</html>
