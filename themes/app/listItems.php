<?php
    foreach ($listItems as $item) {
        var_dump($item);
    }
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
<a href="<?= url("app/criarItemLista/" . $idList) ?>">Criar Item</a><br>
<a href="<?= url("app") ?>">Home</a>
<hr>
<?php
foreach ($listItems as $item){?>
    <a href="<?= url("app/itemLista/$item->id") ?>"><?= $item->name ?></a><br>
<?php
}
?>
</body>
</html>
