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

        <div class="separation"> <h1>VOS ACTIVITÉES</h1> </div>

        <div id="global">
        <div id="gauche"><ul class="categorie" id="gauche">
          
           <li> <a href="#"> Musique </a></li>
           <li> <a href="#"> Jeux Vidéo </a> </li>
           <li> <a href="#"> Film / Série </a> </li>
           <li><a href="#"> Sport </a> </li>
           <li><a href="#"> Cuisine </a> </li>
           <li> <a href="#">Aide / Service </a> </li>
           <li><a href="#"> Autres </a> </li>
           <li><a href="#"> Weekly </a> </li>
            </ul> </div>

           <!--<div id="droit"><iframe id="droite" title="Inline Frame Example" width="300" height="200" src="https://www.openstreetmap.org/export/embed.html?bbox=-0.004017949104309083%2C51.47612752641776%2C0.00030577182769775396%2C51.478569861898606&layer=mapnik">
           </iframe></div>-->
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
