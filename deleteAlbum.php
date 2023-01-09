<?php


if (isset($_GET['id'])){
    require_once 'class/connection.php';
    $connection = new Connection();
    $connection->followYourMasterInTheGrave($_GET['id']);
    $connection->deleteAlbum($_GET['id']);

    header('Location: album.php');
}
