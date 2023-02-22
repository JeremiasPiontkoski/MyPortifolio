<?php
var_dump($user);
?>

<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<a href="<?= url("app") ?>">Home</a>
<p>Nome: <?= $user->name ?></p>
<p>Email: <?= $user->email ?></p>
<img src="<?= url($user->photo) ?>" alt="" width="150px" height="150px"><br>
<a href="<?= url("app/perfil/editar") ?>">Editar</a>
</body>
</html>
