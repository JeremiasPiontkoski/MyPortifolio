<?php
session_start();
ob_start();

require __DIR__ . "/vendor/autoload.php";
use CoffeeCode\Router\Router;

$route = new Router(CONF_URL_BASE, ":");

$route->namespace("Source\App");

// WEB ROUTES

$route->get("/", "Web:login");
$route->post("/", "Web:postLogin");

$route->get("/cadastro", "Web:register");
$route->post("/cadastro", "Web:postRegister");

// APP ROUTES

$route->group("/app");

$route->get("/", "App:home");
$route->get("/perfil", "App:profile");

$route->group(null);

// ADM ROUTES

$route->group("/admin");

$route->get("/", "Adm:home");
$route->get("/listas", "Adm:list");

$route->group(null);

// ERROR ROUTES

$route->group("error")->namespace("Source\App");
$route->get("/{errcode}", "Web:error");

$route->dispatch();

// ERROR REDIRECT

if ($route->error()) {
    $route->redirect("/error/{$route->error()}");
}

ob_end_flush();