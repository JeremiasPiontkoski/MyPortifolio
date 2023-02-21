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
    <label for="name">Nome:</label>
    <input type="text" name="name" id="name">

    <button type="submit">Enviar</button>
</form>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/criarLista"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const list = await data.json();
        console.log(list);

        if(list.code == 200) {
            window.location.href = "<?= url("app"); ?>";
        }
    });
</script>
</body>
</html>
