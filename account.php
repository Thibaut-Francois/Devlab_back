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
require_once 'class/connection.php';
$connection = new Connection();
session_start();
var_dump($_SESSION);
?>

<h1>DEVLAB BACK</h1>

<?php echo '<h1>Bienvenue '. $_SESSION['user']['pseudo'].'</h1>';
?>

<form action="./login.php" method="post">
    <button name="disconnect" type="submit">Déconnexion</button>
</form>

<a href="album.php">Creer un album</a>

<div class="btn">
    <form method="post">
    <input id="searchbar" onkeyup="find()" type="text" placeholder="Search">
    </form>
    <div><ul id="submenu"></ul></div>
    
    <button id="decouverte">Découverte</button>
    <button id="tendance">Tendance</button>
    <button id="albumsPubliques">Albums Publiques</button>
</div>

<div id="card"></div>

<div id="discover"></div>

<div id="tendances"></div>

<div id="publiqueAlbum">
    <?php
    $allAlbums = $connection->getPublicAlbum();

    foreach ($allAlbums as $value){


        echo "<div>";
            echo $value['name']." possède ".$value['like']." like(s)" ;
        echo "</div>";

    }
    ?>
</div>

<script src="script/script.js"></script>



<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    
    //const axios = require('axios');

    find()

    function find(){
        // Requêter un utilisateur avec un ID donné.

        let str = document.querySelector("#searchbar");
        let propositions = document.querySelector("#submenu");

        if (str.value !== ""){
            axios.get(/* '/user?ID=2' */ 'https://api.themoviedb.org/3/search/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&query='+str.value)

                .then(function (response) {
                    // en cas de réussite de la requête
                    console.log(response.data.results);
                    let movie = response.data.results

                    propositions.innerHTML = "";

                    for (let i = 0; i <= 4; i++) {
                        let result = document.createElement("li");
                        let myLink = "single.php?id="+movie[i].id
                        result.innerHTML = "<p><a href="+myLink+">"+movie[i].original_title+"</a></p>"
                        propositions.appendChild(result);
                    }
                })

                .catch(function (error) {
                    // en cas d’échec de la requête
                    console.log(error);
                })

                .then(function () {
                    // dans tous les cas
                    console.log("AAAAAAAAA");
                });
        }else{
            propositions.innerHTML = "";
        }

    }



</script>

</body>
</html>
