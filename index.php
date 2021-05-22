﻿<!DOCTYPE html>

<html lang="fr">
<head>
    <link href="css\Accueil.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <title>Giwa</title>
</head>
<body>
    <nav class="menu" style="height: 60px;">
        <div class="titre">
            <h1><img src="res\img\giwa.png" align="left"  class="logo">  &nbsp  Giwa</h1>
            
        </div>
        <?php
        include 'utils/utils.php';
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
            echo '<a href='.$profil_link.' >'. $_SESSION["username"].'</a>';
        }
        ?>
<!--        <ul class="links">-->
<!--            <li>-->
<!--                <a href="pages/login.php">Connexion /</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="pages/register.php"> Inscription</a>-->
<!--            </li>-->
<!--        </ul>-->
    </nav>
    <div>
        <input type="search" id="search" placeholder="Rechercher un tag…" size="300">
        <button style="height: 30px">Rechercher</button>
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