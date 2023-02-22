<?php

namespace Source\App;
require "./source/autoload.php";

use League\Plates\Engine;
use mysql_xdevapi\Exception;
use Source\Models\Users\NormalUser;
use Source\Models\Users\TypeUser;
use Source\Models\Users\User;
use Source\Support\Response;
use Source\Support\Validate;

class Web {
    private $view;

    public function __construct() {
        $this->view = new Engine(CONF_VIEW_WEB,'php');
    }

    public function login(){
        echo $this->view->render("login");
    }

    public function postLogin(?array $data){
        if(!empty($data)){
            try{
                $user = new User();
                if(Validate::login($data, $user)){
                    echo json_encode(Response::success_login());
                    return;
                }
            }catch (Exception){
                echo json_encode(Response::server_error());
                return;
            }
        }
    }

    public function register(){
        echo $this->view->render("register");
    }

    public function postRegister(?array $data){
        if(!empty($data)){
            if(Validate::register($data)){
                $typeUser = new TypeUser();
                $typeUser = $typeUser->getUserPerson();

                try {
                    $upload = uploadImage($_FILES['image']);
                }catch (\Exception){
                    echo json_encode(Response::invalid_image());
                    return;
                }

                $user = new User(
                    null,
                    $data["name"],
                    $data["email"],
                    $data["password"],
                    $typeUser->id,
                    $upload
                );

                try {
                    $idUser = $user->insert();
                    $normalUser = new NormalUser();
                    $normalUser->setIdUser($idUser);
                    $normalUser->insert();
                    echo json_encode(Response::success_register());
                    return;
                }catch (\Exception){
                    echo json_encode(Response::server_error());
                    return;
                }
            }
        }
    }

    public function error(array $data) : void
    {
        echo $this->view->render("404");
    }
}