<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>

    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="./login.php" method="post">
    <button name="disconnect" type="submit">Déconnexion</button>
</form>

<a href="./account.php">RETOUR</a>

<?php
require_once 'class/connection.php';
require_once 'class/myAlbum.php';
$connection = new Connection();
session_start();

if (empty($_SESSION)){
    header('Location: login.php');
}

var_dump($_SESSION);
echo '<h1>Bienvenue '. $_SESSION['user']['pseudo'].'</h1>';

?>
<h2>Ajouter un album</h2>
<form method="post">
    <input type="text" name="name" placeholder="nom de l'album"/><br>
    <div>
        <select name="public">
            <option value="privé">Privé</option>
            <option value="publique">Publique</option>
        </select>
    </div>
    <input name="" type="submit" value="Creer" />
</form>

<?php


$id = $_SESSION['user']['id'];

if($_POST){

    if($_POST['public'] == "publique"){
        $plc=true;
    }else{
        $plc=false;
    }
    
    $album = new album(
        $_POST['name'],
        $plc,
    );

    $result = $connection->insertAlbum($album);
    $oui =  $connection->linkUserAlbum($result[0]['id'], $id);
    
    if($oui){
        echo 'Vous avez ajouté votre album avec succés !';
    } else {
        echo 'L\'opération a échouée';
    }

}

?>



<h2>Vos albums :</h2>
<?php
$myAlbum = $connection->getMyAlbums($_SESSION['user']['id']);

foreach ($myAlbum as $value){

    echo'<ul>';
    ?>
    <li class="point">
        <!--
        <script>
            myLi = document.querySelectorAll(".point")
            console.log("myLi")
            myLi.innerHTML= "AA2"
        </script>

        <ul>
            <?php /* <?php echo $value['name']; ?>
            foreach(as){

            }*/
            ?>
        </ul>
        -->
        <?php
            print_r($value['name']);
            if ($value['isPublic'] === 0 ){
                var_dump($value['id']);
                echo '<br> <a href="deleteAlbum.php?id='. $value['id'].'">supprimer cet album</a>';
            }

        ?>
    </li> <?php

    echo'</ul>';
}
//print_r($myAlbum);


$oui = $connection->getPublicAlbum();

?>

    
</body>
</html>