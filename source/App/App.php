<?php

namespace Source\App;
use CoffeeCode\Uploader\Media;
use JsonException;
use League\Plates\Engine;
use Source\Models\Lists\ItemList;
use Source\Models\Lists\Lists;
use Source\Models\Users\User;
use Source\Support\Response;
use Source\Support\Validate;

class App {
    private $view;

    public function __construct() {
        if(empty($_SESSION["user"])) {
            header("Location:" . CONF_URL_BASE);
        }

        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home(){
        $list = new Lists();
        $list->setIdUser($_SESSION['user']);
        $list = $list->getByIdUser();

        echo $this->view->render("home",
        [
            "lists" => Response::getListsByUser($list)
        ]);
    }

    public function profile(){
        $user = new User();
        $user->setId($_SESSION['user']);
        $user = $user->getAllById();
        echo $this->view->render("profile",
        [
            "user" => Response::getUser($user)
        ]);
    }

    public function postProfile(array $data) {
        if(!empty($data)){
            if(Validate::editProfile($data)){
                $user = new User();
                $user->setId($_SESSION["user"]);
                $dataUser = $user->getAllById();
                try {
                    if(!empty($_FILES['image']['tmp_name'])){
                        $upload = uploadImage($_FILES['image']);
                    }else {
                        $upload = $dataUser->photo;
                    }
                }catch (\Exception){
                    echo json_encode(Response::invalid_image());
                    return;
                }
                try{
                    $user->getId();
                    $user->setName($data["name"]);
                    $user->setEmail($data["email"]);
                    $user->setPhoto($upload);
                    $user->updateById();

                    echo json_encode(Response::success_edit_profile());
                    return;

                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function createList(){
        echo $this->view->render("lists/createList");
    }

    public function postCreateList(?array $data){
        if(!empty($data)){
            if(Validate::createList($data)){
                try{
                    $list = new Lists(
                        null,
                        $_SESSION["user"],
                        $data["name"],
                    );
                    $list->insert();
                    echo json_encode(Response::success_create_list());
                    return;
                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function renderList($data){
        $itemsList = new ItemList();
        $itemsList->setIdList($data["idList"]);
        $itemsList = $itemsList->getByIdList();
        echo $this->view->render("lists/itemsList",
        [
            "idList" => $data["idList"],
            "listItems" => Response::getItemsListById($itemsList)
        ]);
    }

    public function createItemList($data){
        echo $this->view->render("lists/createItemList",
        [
            "idList" => $data["idList"],
        ]);
    }

    public function postCreateItemList(?array $data){
        if(!empty($data)){
            if(Validate::createListItem($data)){
                try {
                    $itemList = new ItemList(
                        null,
                        $data["idList"],
                        $data['name'],
                        $data['email'],
                        $data['phone']
                    );

                    $itemList->insert();

                    echo json_encode(Response::success_create_item_list());
                    return;
                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function itemList(array $data) {
        $itemList = new ItemList();
        $itemList->setId($data["id"]);
        $itemList = $itemList->getById();
        echo $this->view->render("lists/specificItem",
        [
            "item" => Response::getItemListById($itemList)
        ]);
    }

    public function removeItemLIst(array $data) {
        $listItem = new ItemList();
        $listItem->setId($data["idItem"]);
        $listItem->deleteById();
        echo json_encode(Response::success_remove_item());
        return;
    }

    public function updateItemList(array $data){
        if(Validate::updateItemList($data)){
            try {
                $listItem = new ItemList(
                    $data["idItem"],
                    null,
                    $data["name"],
                    $data["email"],
                    $data["phone"]
                );
                $listItem->updateById();
               echo json_encode(Response::success_update_item_list());
                return;
            }catch (\Exception){
                echo json_encode(Response::server_error());
                return;
            }
        }
    }

    public function removeList(array $data){
        $list = new Lists();
        $list->setId($data['idList']);
        $list->deleteById();

        header("Location:" . CONF_URL_BASE . "/app");
    }

    public function logout(){
        session_destroy();
        header("Location:" . CONF_URL_BASE);
    }
}