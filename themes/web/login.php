<?php
    if(!empty($_SESSION['user'])){
        header("Location:" . CONF_URL_BASE . "/app");
    }
?>

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

<section class="login">
    <h1 class="title">List<span>Maker</span>
    </h1>
    <h3 class="title">Login</h3>
        <form id="form" class="login">
            <div class="container">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </div>

            <div class="container">
                <label for="password">Senha:</label>
                <input type="password" name="password" id="password">
            </div>

            <button type="submit" class="btn">Login</button>
    </form>

    <div class="error-message">
        <p id="message">
        </p>
    </div>

    <div class="account">
        <p>Não possui conta ?
            <a href="<?= url("cadastro"); ?>">Crie Uma!</a>
        </p>
    </div>
</section>


<script type="text/javascript" async>
    const form = document.querySelector("#form");
    const message = document.querySelector("#message");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("/"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);
        if(user.code == 200) {
            window.location.href = "<?= url("app"); ?>";
        }else {
            message.innerHTML = user.message
        }
    });
</script>
</body>
</html>