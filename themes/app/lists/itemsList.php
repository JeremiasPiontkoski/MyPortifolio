<?php
 $this->layout("_theme");
?>

<section class="createItemList">
    <a href="<?= url("app/criarItemLista/" . $idList) ?>">
                Criar Item
                <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="icon" d="M28.3333 21.6667H21.6666V28.3333H18.3333V21.6667H11.6666V18.3333H18.3333V11.6667H21.6666V18.3333H28.3333M20 3.33334C17.8113 3.33334 15.644 3.76444 13.6219 4.60202C11.5998 5.4396 9.76251 6.66725 8.21487 8.2149C5.08926 11.3405 3.33331 15.5797 3.33331 20C3.33331 24.4203 5.08926 28.6595 8.21487 31.7851C9.76251 33.3328 11.5998 34.5604 13.6219 35.398C15.644 36.2356 17.8113 36.6667 20 36.6667C24.4203 36.6667 28.6595 34.9107 31.7851 31.7851C34.9107 28.6595 36.6666 24.4203 36.6666 20C36.6666 17.8113 36.2355 15.644 35.398 13.622C34.5604 11.5999 33.3327 9.76254 31.7851 8.2149C30.2374 6.66725 28.4001 5.4396 26.378 4.60202C24.3559 3.76444 22.1887 3.33334 20 3.33334Z" fill="#8D99AE"/>
                </svg>
            </a>
</section>

<?php
if($listItems){
    foreach($listItems as $list) {?>
    <section class="itemList">
    <a href="<?= url("app/itemLista/" . $list["id"]) ?>">
        <p><?= $list["name"] ?></p>
        <p><?= $list["email"] ?></p>
        <p><?= $list["phone"] ?></p>
    </a>
</section>
<?php
    }
}
?>

<!-- <a href="<?= url("app/criarItemLista/" . $idList) ?>">Criar Item</a><br>
<a href="<?= url("app") ?>">Home</a>
<hr>
<?php
if(!$listItems) {?>
    <p>Nao tem nada</p>
    <?php
}else{
    foreach ($listItems as $list){?>
        <a href="<?= url("app/itemLista/" . $list["id"]) ?>"><?= $list["name"] ?></a> --- <a href="<?= url("app/excluir/lista/" . $list["id"]) ?>">Remover</a><br>
        <?php
    }
}
?> -->

