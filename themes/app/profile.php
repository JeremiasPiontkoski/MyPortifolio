
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

<section class="updateProfile">
    <h1 class="title">List<span>Maker</span></h1>
    <h3 class="title">Edição de Perfil</h3>

    <div class="container-image">
        <img src="<?= url($user["photo"]); ?>" id="photo" alt="..." width="100px" height="100px">
    </div>

    <form id="form" class="updateProfile">
        <div class="container">
            <label for="name">Nome:</label>
            <input type="text" name="name" id="name" value="<?= $user["name"] ?>">
        </div>

        <div class="container">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?= $user["email"] ?>">
        </div>

        <div class="container">
            <label for="image" class="image">Foto</label>
            <input type="file" name="image" id="image" class="image">
        </div>

        <button type="submit">Atualizar</button>
        <a href="<?= url("app/sair")?>" class="btn">Sair</a>
    </form>

    <div class="error-message">
        <p id="message">
        </p>
    </div>
</section>

<script type="text/javascript" async>
    const message = document.querySelector("#message");
    const form = document.querySelector("#form");
    const photo = document.querySelector("#photo");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const dataUser = new FormData(form);
        const data = await fetch("<?= url("app/perfil"); ?>",{
            method: "POST",
            body: dataUser,
        });
        const user = await data.json();
        console.log(user);

        if(user.code == 200) {
            window.location.href = "<?= url("app/perfil"); ?>";
        }else {
            message.innerHTML = user.message;
        }
    });
</script>

</body>
</html>
