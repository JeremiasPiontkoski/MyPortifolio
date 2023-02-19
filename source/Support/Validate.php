<?php

namespace Source\Support;

use Source\Models\Users\User;

abstract class Validate
{
    public static function login(array $data, User $user){
        if(in_array("", $data)){
            echo json_encode(Response::is_empty());
            return false;
        }

        if(!$user->validade($data["email"], $data["password"])){
            echo json_encode(Response::invalid_login());
            return false;
        }
        return true;
    }

    public static function register(array $data) {
        if(in_array("", $data)){
            echo json_encode(Response::is_empty());
            return false;
        }

        if(!is_email($data["email"])){
            echo json_encode(Response::invalid_email());
            return false;
        }

        if(User::isRegisteredEmail($data['email'])){
            echo json_encode(Response::is_used_email());
            return false;
        }

        if(strlen($data["password"]) < 8) {
            echo json_encode(Response::short_password());
            return false;
        }

        return true;
    }
}