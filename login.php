<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />
</head>
<body>

<h1>Page de connection</h1>

<h2>S'enregistrer</h2>
<form method="post">
    <input type="text" name="pseudo" placeholder="pseudonyme"/><br>
    <input type="email" name="email" placeholder="E-mail"/><br>
    <input type="password" name="password1" placeholder="mot de passe"/>
    <input type="password" name="password2" placeholder="mot de passe vérif"/><br>
    <input name="signin" type="submit" value="S'enregistrer" />
</form>

<h2>Se connecter</h2>
<form method="post">
    <input type="email" name="email" placeholder="E-mail"/><br>
    <input type="password" name="password1" placeholder="mot de passe"/><br>
    <input name="login" type="submit" value="Se connecter" />
</form>


<?php

require_once 'user.php';
require_once 'connection.php';
require_once 'intruder.php';
$connection = new Connection();
session_start();

var_dump($_SESSION);

if(isset($_POST['disconnect'])){
    unset($_SESSION['user']);
    header('Location: ./login.php');
}


if ($_POST){
    if(isset($_POST['signin'])){
        $user = new User(
            $_POST['email'],
            $_POST['password1'],
            $_POST['password2'],
            $_POST['pseudo'],
        );
        if ($user->verify()){
            if ($connection->antiDoppelganger($user->email)){
                //save to databse
                $result = $connection->insert($user);

                if ($result){
                    echo 'Vous avez créé votre compte avec succés !';

                } else {
                    echo 'L\'opération a échouée';
                }
            }else{
                echo 'Cette adresse email est déja utilisée';
            }

        } else {
            echo "Votre formulaire n'est pas valide";
        }

    }elseif (isset($_POST['login'])){
        $intruder = new Intruder(
            $_POST['password1'],
            $_POST['email'],
        );

        $oui =$connection->isExisting($intruder->password, $intruder->email);

        if(empty($oui[0])){
            echo "<br> Votre email et/ou votre mot de passe n'est pas valide";
        }else{
            $_SESSION['user']=$oui[0];

            //print_r($_SESSION['user']);

            header('Location: account.php');
        }

        


        


    }
}




?>
<form action="./login.php" method="post">
    <button name="disconnect" type="submit">Déconnexion</button>
</form>

</body>
</html>