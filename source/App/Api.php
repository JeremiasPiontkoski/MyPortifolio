<?php

namespace Source\App;

use http\Env\Response;
use Source\Models\Lists\ItemList;
use Source\Models\Lists\Lists;
use Source\Models\Users\NormalUser;
use Source\Models\Users\TypeUser;
use Source\Models\Users\User;
use Source\Support\Validate;

class Api
{
    private $headers;
    private $user;
    private $arrayVerify;
    private $typeUser;
    private $normalUser;
    private $list;
    private $itemList;

    public function __construct()
    {
        header('Content-Type: application/json; charset=UTF-8');
        $this->headers = getallheaders();
        $this->user = new User();
        $this->typeUser = new TypeUser();
        $this->normalUser = new NormalUser();
        $this->list = new Lists();
        $this->itemList = new ItemList();

        if($this->headers["Rule"] == "N"){
            return;
        }

        $this->arrayVerify = [
            "email" => $this->headers["Email"],
            "password" => $this->headers["Password"],
            "rule" => $this->headers["Rule"]
        ];

//        if(empty($this->headers["Email"]) || empty($this->headers["Password"]) || empty($this->headers["Rule"])){
//            $response = [
//                "code" => 400,
//                "type" => "bad_request",
//                "message" => "Por favor, informe Email e Senha"
//            ];
//            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
//            return;
//        }
    }

    public function getUser(){
        if(Validate::login($this->arrayVerify, $this->user)){
            $response = \Source\Support\Response::getUser($this->user->getAllById());
            echo json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }
    }

    public function createUser(array $data){
        if(Validate::register($data)){
            $typeUser = $this->typeUser->getUserPerson();
            $this->user->setName($data["name"]);
            $this->user->setEmail($data["email"]);
            $this->user->setPassword($data["password"]);
            $this->user->setTypeUser($typeUser->id);

            try {
                $idUser = $this->user->insert();
                $this->normalUser->setIdUser($idUser);
                $this->normalUser->insert();
                echo json_encode(\Source\Support\Response::success_register());
                return;
            }catch (\Exception){
                echo json_encode(\Source\Support\Response::server_error());
                return;
            }
        }
    }

    public function createList(array $data){
        if(Validate::login($this->arrayVerify, $this->user)){
            if(Validate::createList($data)){
                $this->list->setIdUser($this->user->getId());
                $this->list->setName($data["name"]);
                try {
                    $this->list->insert();
                    echo json_encode(\Source\Support\Response::success_create_list());
                    return;
                }catch (\Exception){
                    echo json_encode(\Source\Support\Response::server_error());
                    return;
                }
            }
        }
    }

    public function getLists(){
        if(Validate::login($this->arrayVerify, $this->user)){
            $this->list->setIdUser($this->user->getId());
            $response = \Source\Support\Response::getListsByUser($this->list->getByIdUser());
            if($response == false){
                $response = [
                    "message" => "Este usuário não possui listas!",
                    "code" => 400
                ];
                echo json_encode($response);
                return;
            }
            echo json_encode($response);
            return;
        }
    }

    public function getItemsList(array $data){
        if(Validate::login($this->arrayVerify, $this->user)){
            $this->itemList->setIdList($data["idList"]);
            $response = \Source\Support\Response::getItemsListById($this->itemList->getByIdList());
            if($response == false){
                $response = [
                    "message" => "Este usuário não possui listas!",
                    "code" => 400
                ];
                echo json_encode($response);
                return;
            }
            echo json_encode($response);
            return;
        }
    }

    public function getItemList(array $data){
        if(Validate::login($this->arrayVerify, $this->user)){
            $this->itemList->setId($data["idItem"]);
            if(!$this->itemList->getById()) {
                $response = [
                    "message" => "Esta lista não foi encontrada!",
                    "code" => 400
                ];
                echo json_encode($response);
                return;
            }
            $response = \Source\Support\Response::getItemListById($this->itemList->getById());
            echo json_encode($response);
            return;
        }
    }

    public function createItemList(array $data) {
        if(Validate::login($this->arrayVerify, $this->user)){
            if(Validate::createListItem($data)){
                try {
                    $this->itemList->setIdList($data["idList"]);
                    $this->itemList->setName($data["name"]);
                    $this->itemList->setEmail($data["email"]);
                    $this->itemList->setPhone($data["phone"]);

                    $this->itemList->insert();

                    echo json_encode(\Source\Support\Response::success_create_item_list());
                    return;
                }catch (\Exception){
                    echo json_encode(\Source\Support\Response::server_error());
                    return;
                }
            }
        }
    }

    public function updateUser(array $data) {
        if(Validate::login($this->arrayVerify, $this->user)){
            if(Validate::editProfile($data)){
                try {
                    $this->user->setName($data["name"]);
                    $this->user->setEmail($data["email"]);

                    $this->user->updateById();
                    echo json_encode(\Source\Support\Response::success_edit_profile());
                    return;
                }catch (\Exception){
                    echo json_encode(\Source\Support\Response::server_error());
                    return;
                }
            }
        }
    }

    public function updateItemList(array $data) {
        if(Validate::login($this->arrayVerify, $this->user)){
            if(Validate::updateItemList($data)){
                try {
                    $this->itemList->setId($data["idItem"]);
                    $this->itemList->setName($data["name"]);
                    $this->itemList->setEmail($data["email"]);
                    $this->itemList->setPhone($data["phone"]);
                    $this->itemList->updateById();
                    echo json_encode(\Source\Support\Response::success_update_item_list());
                    return;
                }catch (\Exception) {
                    echo json_encode(\Source\Support\Response::server_error());
                    return;
                }
            }
        }
    }

    public function deleteList(array $data){
        if(Validate::login($this->arrayVerify, $this->user)){
            $this->list->setId($data["idList"]);
            try {
                $this->list->deleteById();
                echo json_encode(\Source\Support\Response::success_delete_list());
                return;
            }catch (\Exception){
                echo json_encode(\Source\Support\Response::server_error());
                return;
            }
        }
    }

    public function deleteItemList(array $data) {
        if(Validate::login($this->arrayVerify, $this->user)) {
            $this->itemList->setId($data["idItem"]);
            try {
                $this->itemList->deleteById();
                echo json_encode(\Source\Support\Response::success_remove_item());
                return;
            }catch (\Exception){
                echo json_encode(\Source\Support\Response::server_error());
                return;
            }
        }
    }
}