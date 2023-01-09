<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single</title>
    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />

    <link rel="stylesheet" href="style.css">
</head>
<?php
require_once 'class/connection.php';
$connection = new Connection();
session_start();

if (empty($_SESSION)){
    header('Location: login.php');
}
?>

<body>
<a href="./account.php">RETOUR</a>
<h2>Un film</h2>

<form method="post">
    <select name="choiceAlbum">
        <?php
        $lol=$connection->getMyAlbums($_SESSION['user']['id']);
        foreach ($lol as $oui => $album) {
            echo "<option value=".$album["id"].">".$album["name"]."</option>";
            echo "<br>";
        }

        ?>
    </select>
    <input type="submit" />
</form>

<?php
if($_POST){
    var_dump($_POST["choiceAlbum"]);
    $connection->linkMovieAlbum($_GET['id'], $_POST["choiceAlbum"]);

}
?>


<script src="script/scriptSingle.js"></script>
<script>
    detaille(<?php echo $_GET['id'] ?>)
</script>


<div id="card"></div>

</body>
</html>