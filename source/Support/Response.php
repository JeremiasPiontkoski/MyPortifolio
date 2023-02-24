<?php

namespace Source\Support;

abstract class Response
{
    public static function is_empty(){
        $response = [
            "message" => "Preencha todos os campos",
            "code" => 400
        ];
        return $response;
    }

    public static function invalid_email(){
        $response = [
            "message" => "Você deve informar um email válido!",
            "code" => 400
        ];
        return $response;
    }

    public static function is_used_email(){
        $response = [
            "message" => "Email já cadastrado!",
            "code" => 400
        ];
        return $response;
    }

    public static function is_used_name() {
        $response = [
            "message" => "Este nome já está em uso!",
            "code" => 400
        ];
        return $response;
    }

    public static function short_password(){
        $response = [
            "message" => "A senha deve ter no mínimo oito caracteres!",
            "code"  => 400
        ];
        return $response;
    }

    public static function invalid_login(){
        $response = [
            "message" => "Usuário e/ou senha inválidos!",
            "code" => 401
        ];
        return $response;
    }

    public static function invalid_image(){
        $response = [
            "message" => "Imagem inválida, tente novamente!",
            "code" => 400
        ];
        return $response;
    }

    public static function success_login(){
        $response = [
            "message" => "Autenticação feita com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function success_register(){
        $response = [
            "message" => "Cadastro feito com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function success_createList(){
        $response = [
            "message" => "Lista criada com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function success_createListItem(){
        $response = [
            "message" => "Item criado com sucesso",
            "code" => 200
        ];
        return $response;
    }

    public static function success_removeItem(){
        $response = [
            "message" => "Item excluido com sucesso",
            "code" => 200
        ];
        return $response;
    }

    public static function success_deleteList(){
        $response = [
            "message" => "Lista excluída com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function success_editProfile(){
        $response = [
            "message" => "Perfil editado com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function success_updateItemList(){
        $response = [
            "message" => "Item da lista editado com sucesso!",
            "code" => 200
        ];
        return $response;
    }

    public static function server_error(){
        $response = [
            "message" => "Ocorreu um problema, tente novamente!",
            "code" => 500
        ];
        return $response;
    }

    public static function getUser($user){
        $response = [
            "message" => "Dados do usuário",
            "code" => 200,
            "id" => $user->id,
            "name" => $user->name,
            "email" => $user->email,
            "typeUser"=> $user->typeUser,
            "photo" => $user->photo
        ];
        return $response;
    }
    
    public static function getListsByUser($lists){
        $response = '';
        $arrayResponse = [];
        if(!$lists){
            $response = false;
            return $response;
        }
        foreach ($lists as $list) {
            $response = [
                "message" => "Dados da lista",
                "code" => 200,
                "id" => $list->id,
                "idUser" => $list->idUser,
                "name" => $list->name
            ];
            $arrayResponse[] = $response;
        }
        return $arrayResponse;
    }

    public static function getItemsListById($lists){
        $response = '';
        $arrayResponse = [];
        if(!$lists){
            $response = false;
            return $response;
        }
        foreach ($lists as $list) {
                $response = [
                "message" => "Item da lista",
                "code" => 200,
                "id" => $list->id,
                "idList" => $list->idList,
                "name" => $list->name,
                "email" => $list->email,
                "phone" => $list->phone
            ];
            $arrayResponse[] = $response;
        }
        return $arrayResponse;
    }

    public static function getItemListById($list) {
        $response = [
            "message" => "Item da lista",
            "code" => 200,
            "id" => $list->id,
            "idList" => $list->idList,
            "name" => $list->name,
            "email" => $list->email,
            "phone" => $list->phone
        ];
        return $response;
    }
}