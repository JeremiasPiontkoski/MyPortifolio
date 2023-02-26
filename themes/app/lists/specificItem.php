<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/style/style.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
    <title>Item</title>
</head>
<body>

<section class="updateItemList">
    <h1 class="title">List<span>Maker</span></h1>
    <h3 class="title">Edição de Item</h3>

    <form id="form" class="updateItemList">
        <div class="container">
            <label for="name">Nome</label>
            <input type="text" name="name" id="name" value="<?= $item["name"] ?>">
        </div>

        <div class="container">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= $item["email"] ?>">
        </div>

        <div class="container">
            <label for="phone">Telefone</label>
            <input type="text" name="phone" id="phone" value="<?= $item["phone"] ?>">
        </div>

        <button type="submit" id="btnRemove">Excluir</button>
        <button type="submit" id="btnUpdate">Atualizar</button>
    </form>

    <div class="error-message">
        <p id="message">
        </p>
    </div>
</section>

<script type="text/javascript" async>
    const message = document.querySelector("#message");

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
        }else {
            message.innerHTML = item.message;
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
        }else {
            message.innerHTML = item.message;
        }
    });
</script>
</body>
</html>
