<?php
var_dump($item);
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

<form id="form">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name" value="<?= $item["name"] ?>"><br>

    <label for="email">Email</label>
    <input type="email" name="email" id="email" value="<?= $item["email"] ?>"><br>

    <label for="phone">Telefone</label>
    <input type="text" name="phone" id="phone" value="<?= $item["phone"] ?>">

    <button type="submit" id="btnRemove">Excluir</button>
    <button type="submit" id="btnUpdate">Atualizar</button>
</form>

<script type="text/javascript" async>
    const btnRemove = document.querySelector("#btnRemove");
    btnRemove.addEventListener("click", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/excluir/lista/item/" . $item["id"]); ?>",{
           method: "POST",
           body: dataUser,
        });
        const item = await data.json();
        console.log(item);
        if(item.code == 200) {
            window.location.href = "<?= url("app/lista/" . $item["idList"]); ?>";
        }
    });

    const btnUpdate = document.querySelector("#btnUpdate");
    btnUpdate.addEventListener("click", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/update/lista/item/" . $item["id"]); ?>",{
            method: "POST",
            body: dataUser,
        });
        const item = await data.json();
        console.log(item);
        if(item.code == 200) {
            window.location.href = "<?= url("app/lista/" . $item["idList"]); ?>";
        }
    });
</script>
</body>
</html>
