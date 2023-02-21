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
<form id="form">
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name" value="<?= $user->name ?>"><br>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" value="<?= $user->email ?>"><br>

    <button type="submit">Atualizar</button>
</form>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/perfil/editar"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        console.log(user.message);
    });
</script>

</body>
</html>
