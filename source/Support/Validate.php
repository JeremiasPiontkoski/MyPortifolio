<?php

namespace Source\Support;

use Source\Models\Lists\ItemList;
use Source\Models\Users\User;

abstract class Validate
{
    public static function login(array $data, User $user){
        if(in_array("", $data)){
            echo json_encode(Response::is_empty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(!$user->validade($data["email"], $data["password"])){
            echo json_encode(Response::invalid_login(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }
        return true;
    }

    public static function register(array $data) {
        if(in_array("", $data)){
            echo json_encode(Response::is_empty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(!is_email($data["email"])){
            echo json_encode(Response::invalid_email(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(User::isRegisteredEmail($data['email'])){
            echo json_encode(Response::is_used_email(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(strlen($data["password"]) < 8) {
            echo json_encode(Response::short_password(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }
        return true;
    }

    public static function createList(array $data){
        if(in_array("", $data)){
            echo json_encode(Response::is_empty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }
        return true;
    }

    public static function createListItem(array $data){
        if(in_array("", $data)){
            echo json_encode(Response::is_empty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(!is_email($data["email"])){
            echo json_encode(Response::invalid_email(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return true;
        }

        if(ItemList::isRegisteredName($data["name"])){
            echo json_encode(Response::is_used_name(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }
        return true;
    }

    public static function editProfile(array $data){
        if(in_array("", $data)){
            echo json_encode(Response::is_empty(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }

        if(!is_email($data["email"])) {
            echo json_encode(Response::invalid_email(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return false;
        }
        return true;
    }

    public static function updateItemList(array $data) {
        if(in_array("", $data)) {
            echo json_encode(Response::is_empty());
            return false;
        }

        if(!is_email($data["email"])) {
            echo json_encode(Response::invalid_email());
            return false;
        }

        return true;
    }
}