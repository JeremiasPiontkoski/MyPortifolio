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
<a href="<?= url("app/sair")?>">Sair</a>
<br>
<a href="<?= url("app/criarLista")?>">Criar Lista</a>
<br>
<a href="<?= url("app/perfil") ?>">Perfil</a>
<hr>
<?php
if(!$lists) {?>
<p>Nao tem nada</p>
<?php
}else{
foreach ($lists as $list){?>
    <a href="<?= url("app/lista/" . $list->id) ?>"><?= $list->name ?></a> --- <a href="<?= url("app/excluir/lista/$list->id") ?>">Remover</a><br>
    <?php
}
}
?>

</body>
</html>
