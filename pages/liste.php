<!DOCTYPE html>

<?php
    include 'selection.php';
 ?>

<html lang="fr">
<head>
    <link href="css\Accueil.css" rel="stylesheet" type="text/css" />
    <meta charset="utf-8" />
    <title>Activites</title>
    <link rel="shortcut icon" type="image/x-icon" href="res/img/logo.png" />
</head>
<body>
<?php
    $result = select($_GET["query"]);

    foreach ($result as $line)
    {
        echo "<li>" . $line['username'] . ", " .  $line['title'] . ", " .  $line['description'] . ", " . $line['info'] . "</li>";
    }
?>
</body>
</html>
