<?php

namespace Source\App;
use League\Plates\Engine;

class App {
    private $view;

    public function __construct() {
        if(empty($_SESSION["user"])) {
            header("Location:http://www.localhost/list/");
        }

        $this->view = new Engine(CONF_VIEW_APP,'php');
    }

    public function home(){
        echo $this->view->render("home");
    }

    public function profile(){
        echo $this->view->render("profile");
    }
}