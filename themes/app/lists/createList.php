<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/style/style.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/app/style/style.css") ?>">
    <title>Criar Lista</title>
</head>
<body>

<section class="registerList">
    <h1 class="title">List<span>Maker</span></h1>
    <h3 class="title">Cadastro de Lista</h3>

    <form id="form" class="registerList">
        <div class="container">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name">
        </div>

        <button type="submit" class="btn">Cadastrar</button>
    </form>

    <div class="error-message">
        <p id="message">
        </p>
    </div>
</section>

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
        }else {
            message.innerHTML = list.message;
        }
    });
</script>
</body>
</html>
