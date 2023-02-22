<?php

namespace Source\App;
use CoffeeCode\Uploader\Media;
use League\Plates\Engine;
use Source\Models\Lists\ListItem;
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

        echo $this->view->render("home",
        [
            "lists" => $list->getByIdUser()
        ]);
    }

    public function profile(){
        $user = new User();
        $user->setId($_SESSION['user']);
        echo $this->view->render("profile",
            [
                "user" => $user->getAllById()
            ]);
    }

    public function editProfile(){
        $user = new User();
        $user->setId($_SESSION['user']);
        echo $this->view->render("editProfile",
        [
            "user" => $user->getAllById()
        ]);
    }

    public function postEditProfile(array $data) {
        if(!empty($data)){
            if(Validate::editProfile($data)){
                try {
                    $upload = uploadImage($_FILES['image']);
                }catch (\Exception){
                    echo json_encode(Response::invalid_image());
                    return;
                }
                try{
                    $user = new User();
                    $user->setId($_SESSION['user']);
                    $user->setName($data["name"]);
                    $user->setEmail($data["email"]);
                    $user->setPhoto($upload);
                    $user->updateById();
                    $response = [
                        "message" => "Dados alterados com sucesso",
                        "code" => 200,
                        "image" => url($user->getPhoto())
                    ];
                    echo json_encode($response);
                    return;
//                    echo json_encode(Response::success_editProfile());
//                    return;

                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function createList(){
        echo $this->view->render("createList");
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
                    echo json_encode(Response::success_createList());
                    return;
                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function renderList($data){
        $itemsList = new ListItem();
        $itemsList->setIdList($data["idList"]);
        echo $this->view->render("listItems",
        [
            "idList" => $data["idList"],
            "listItems" => $itemsList->getByIdList()
        ]);
    }

    public function createListItem($data){
        echo $this->view->render("createListItem",
        [
            "idList" => $data["idList"],
        ]);
    }

    public function postCreateListItem(?array $data){
        if(!empty($data)){
            if(Validate::createListItem($data)){
                try {
                    $itemList = new ListItem(
                        null,
                        $data["idList"],
                        $data['name'],
                        $data['email'],
                        $data['phone']
                    );

                    $itemList->insert();

                    echo json_encode(Response::success_createListItem());
                    return;
                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function itemList(array $data) {
        var_dump($data);
        $itemList = new ListItem();
        $itemList->setId($data["id"]);
        echo $this->view->render("specificItem",
        [
            "item" => $itemList->getById()
        ]);
    }

    public function removeListItem(array $data) {
        $listItem = new ListItem();
        $listItem->setId($data["idItem"]);
        $listItem->deleteById();
        echo json_encode(Response::success_removeItem());
        return;
    }

    public function updateListItem(array $data){
        $listItem = new ListItem(
            $data["idItem"],
            null,
            $data["name"],
            $data["email"],
            $data["phone"]
        );
        $listItem->updateById();
        $response = [
            "code" => 200
        ];
        echo json_encode($response);
        return;
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