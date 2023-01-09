<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Devlab-back/login</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="https://w7.pngwing.com/pngs/192/1000/png-transparent-graphic-film-roll-film-drawing-film-angle-photography-black.png" />
    <link rel="stylesheet" href="login.css">
</head>
<body>

<div class="container">
    <div class="login-container">
        <input id="item-1" type="radio" name="item" class="sign-in" checked><label for="item-1" class="item">Sign In</label>
        <input id="item-2" type="radio" name="item" class="sign-up"><label for="item-2" class="item">Sign Up</label>
        <div class="login-form">
            <form method="post">
                <div class="sign-in-htm">
                    <div class="group">
                        <input type="email" name="email" placeholder="E-mail" class="input"/>
                    </div>
                    <div class="group">
                        <input type="password" name="password1"  placeholder="mot de passe" class="input"/>
                    </div>

                    <div class="group">
                        <input name="login" type="submit" value="Se connecter" class="button"/>
                    </div>
                    <div class="hr"></div>

            </form>
            <div class="footer">

                <?php

                require_once 'user.php';
                require_once 'connection.php';
                require_once 'intruder.php';
                $connection = new Connection();
                session_start();



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
            </div>
        </div>


        <div class="sign-up-htm">
                <form method="post">
                    <div class="group">
                        <input type="text" name="pseudo" placeholder="pseudonyme" class="input"/>
                    </div>
                    <div class="group">
                        <input type="email" name="email" placeholder="E-mail" class="input"/>
                    </div>

                    <div class="group">
                        <input type="password" name="password1" placeholder="mot de passe" class="input"/>
                    </div>
                    <div class="group">
                        <input type="password" name="password2" placeholder="mot de passe vérif" class="input"/>
                    </div>

                    <div class="group">
                        <input name="signin" type="submit" value="S'enregistrer" class="button" />
                    </div>

                </form>
                <div class="hr"></div>

            </div>
        </div>
    </div>
</body>
</html>