<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?= url("assets/style/style.css") ?>">
    <link rel="stylesheet" href="<?= url("assets/web/style/style.css") ?>">
    <title>Document</title>
</head>
<body>

<section class="register">
    <h1 class="title">List<span>Maker</span></h1>
    <h3 class="title">Cadastro</h3>

    <form id="form" class="register">
        <div class="container">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name">
        </div>

        <div class="container">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="container">
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="container">
            <label for="image" class="image">Imagem</label>
            <input type="file" name="image" id="image">
        </div>
        <button type="submit">Cadastrar</button>
    </form>

    <div class="error-message">
        <p id="message">
        </p>
    </div>

    <div class="account">
        <p>Já possui conta ?
            <a href="<?= url(""); ?>">Faça o login!</a>
        </p>
    </div>
</section>

<script type="text/javascript" async>
    const form = document.querySelector("#form");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("/cadastro"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        if(user.code == 200) {
            window.location.href = "<?= url(""); ?>";
        }else {
            message.innerHTML = user.message;
        }
    });
</script>

</body>
</html>