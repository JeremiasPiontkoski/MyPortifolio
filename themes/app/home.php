<?php
 $this->layout("_theme");
?>
<section class="itemsList">
<?php        
    if($lists) {
        foreach($lists as $list) {?>

        <div class="lists">
            <a href="<?= url("app/lista/" . $list["id"]) ?>"><?= $list["name"] ?></a>
            <div>
                <a href="<?= url("app/excluir/lista/" . $list["id"]) ?>">
                    Remover
                    <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.5 2.5C24.4125 2.5 30 8.0875 30 15C30 21.9125 24.4125 27.5 17.5 27.5C10.5875 27.5 5 21.9125 5 15C5 8.0875 10.5875 2.5 17.5 2.5ZM23.75 8.75H20.625L19.375 7.5H15.625L14.375 8.75H11.25V11.25H23.75V8.75ZM13.75 22.5H21.25C21.5815 22.5 21.8995 22.3683 22.1339 22.1339C22.3683 21.8995 22.5 21.5815 22.5 21.25V12.5H12.5V21.25C12.5 21.5815 12.6317 21.8995 12.8661 22.1339C13.1005 22.3683 13.4185 22.5 13.75 22.5Z" fill="#2B2D42"/>
                    </svg>
                </a>
            </div>
        </div>
<?php
    }
    }
?>
</section>



<!-- <a href="<?= url("app/sair")?>">Sair</a>
<br>
<a href="<?= url("app/criarLista")?>">Criar Lista</a>
<br>
<a href="<?= url("app/perfil") ?>">Perfil</a>
<hr>
<?php
if(!$lists) {?>
    <p>Nao tem nada</p>
    <?php
}else{
    foreach ($lists as $list){?>
        <a href="<?= url("app/lista/" . $list["id"]) ?>"><?= $list["name"] ?></a> --- <a href="<?= url("app/excluir/lista/" . $list["id"]) ?>">Remover</a><br>
        <?php
    }
}
?> -->

</body>
</html>
