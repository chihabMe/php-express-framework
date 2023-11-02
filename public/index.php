<?php

use app\controllers\BooksController;
use app\core\Application;

require_once __DIR__ . "./../vendor/autoload.php";

$app =  new Application(dirname(__DIR__));
$app->router->get(
    "/", "home.php");
$app->router->get("/books", [BooksController::class,'booksListPage']);
$app->router->post("/books", [BooksController::class,'createNewBook']);
$app->run();
