<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/style/style.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
    <title>Document</title>
</head>
<body>

<section class="registerItemList">
    <h1 class="title">List<span>Maker</span></h1>
    <h3 class="title">Cadastro de Item</h3>

    <form id="form" class="registerItemList">
        <div class="container">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name">
        </div>

        <div class="container">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="container">
            <label for="phone">Telefone:</label>
            <input type="text" name="phone" id="phone">

            <input type="text" name="idList" id="idList" value="<?= $idList ?>" hidden>
        </div>

        <button type="submit">Cadastrar</button>
    </form>

    
</section>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/criarItemLista"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const list = await data.json();
        console.log(list);

        if(list.code == 200){
            window.location.href = "<?= url("app/lista/$idList ?>"); ?>";
        }else {
            message.innerHTML = list.message
        }
    });
</script>
</body>
</html>

