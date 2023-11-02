<?php
namespace app\controllers;

use app\core\Request;
use app\core\Response;
class BooksController
{
    public  static function booksListPage(Request $req,Response $res )
    {
        global $books;

        $books = [
            [
              "title"=>"clean code",
              "author"=>"chihab",
              "email"=>"chihab@email.com"
            ],

            [
              "title"=>"php sucks!",
              "name"=>"massi",
              "email"=>"massi@email.com"
            ],
        ];
        $params = [
          "books"=>$books

        ];
        return $res->renderView("books.php", $params);
    }

    public  static function createNewBook(Request $req,Response $res )
    {
        $res->redirect("/");
    }

}
