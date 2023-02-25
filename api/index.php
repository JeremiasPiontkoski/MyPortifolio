<?php

ob_start();

require __DIR__ . "/../vendor/autoload.php";

use CoffeeCode\Router\Router;

$route = new Router(url(), ":");

$route->namespace("Source\App");

$route->get("/user", "Api:getUser");
$route->post("/user/name/{name}/email/{email}/password/{password}", "Api:createUser");

$route->post("/list/name/{name}", "Api:createList");

$route->get("/lists", "Api:getLists");

$route->get("/items/list/{idList}", "Api:getItemsList");

$route->get("/list/item/{idItem}", "Api:getItemList");

$route->post("/list/item/idList/{idList}/name/{name}/email/{email}/phone/{phone}", "Api:createItemList");

$route->put("/user/update/name/{name}/email/{email}", "Api:updateUser");

$route->put("/list/item/update/idItem/{idItem}/name/{name}/email/{email}/phone/{phone}", "Api:updateItemList");

$route->delete("/list/delete/{idList}", "Api:deleteList");

$route->delete("/list/item/delete/{idItem}", "Api:deleteItemList");

$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    header('Content-Type: application/json; charset=UTF-8');
    http_response_code(404);

    echo json_encode([
        "errors" => [
            "type " => "endpoint_not_found",
            "message" => "Não foi possível processar a requisição"
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}
ob_end_flush();
