<!DOCTYPE html>

<?php
    include 'selection.php';
 ?>

<html lang="fr">
<head>
    <link href="..\css\tableau.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <title>Activites</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/logo.png" />
</head>
<body>
<ul class="act">
<?php
    $result = select($_GET["query"]);

    foreach ($result as $line)
    {
        echo "<li><div class='username'><b>"."~"."&nbsp". $line['username'] ."&nbsp"."~"."</b>"."</div><div class='title'><b> ".  $line['title'] .":". "<button id='button'>Rejoindre</button>"."</b></div><div class='description'> " .  $line['description'] . "</div><div class='info'> " . $line['info'] . "</div></li>";
    }
?></ul>
</body>
</html>
