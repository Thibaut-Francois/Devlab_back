<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Single</title>
</head>
<body>
<a href="./account.php">RETOUR</a>
<h2>Un film</h2>

<script src="script/scriptSingle.js"></script>
<script>
    detaille(<?php echo $_GET['id'] ?>)
</script>


<div id="card"></div>

</body>
</html>