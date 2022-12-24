<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devlab-back</title>

    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />

    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
session_start();
?>

<h1>DEVLAB BACK</h1>

<?php echo '<h1>Bienvenue '. $_SESSION['user']['pseudo'].'</h1>';
?>

<form action="./login.php" method="post">
    <button name="disconnect" type="submit">Déconnexion</button>
</form>

<a href="album.php">Creer un album</a>

<div class="btn">
    <form method="">
    <input id="searchbar" onkeyup="find()" type="text" placeholder="Search">
    <input type="submit" value="GO">
    </form>
    
    <button id="album">Découverte</button>
    <button id="album">Tendance</button>
</div>

<div id="card"></div>


    <script src="script.js"></script>
</body>
</html>
