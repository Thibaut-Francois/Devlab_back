<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
    <title>Album</title>

    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />
    <link rel="stylesheet" href="album.css">
</head>
<body>

<main>
    <?php
    require_once 'connection.php';
    require_once 'myAlbum.php';
    $connection = new Connection();
    session_start();

    ?>


<a href="./account.php"><iconify-icon icon="material-symbols:arrow-back"></iconify-icon></a>
    <h2>Ajouter un album</h2>
    <div class="container">
        <div div-contain>
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
        </div>
        <div>
            <h2>Vos albums :</h2>
            <?php
            $myAlbum = $connection->getMyAlbums($_SESSION['user']['id']);

            foreach ($myAlbum as $value){

                echo'<ul>';
                ?>
                <li>
                    <?php
                    print_r($value['name']);
                    //echo '<br><a href="deletePet.php?id='. $value['id'].'">supprimer cet animal</a>';
                    ?>
                </li> <?php

                echo'</ul>';
            }
            //print_r($myAlbum);
            ?>
        </div>
    </div>



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


</main>

</body>
</html>