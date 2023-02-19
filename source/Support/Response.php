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

    public static function server_error(){
        $response = [
            "message" => "Ocorreu um problema, tente novamente!",
            "code" => 500
        ];
        return $response;
    }
}