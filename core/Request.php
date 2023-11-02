<?php

namespace app\core;

class Request
{

    public function getPath()
    {
        $pathname = $_SERVER["REQUEST_URI"]??"/";
        $parmterPostion =  strpos($pathname, "?");
        if(! $parmterPostion) {
            return $pathname;
        }
        return substr($pathname, 0, $parmterPostion);
    }
    public function getMethod()
    {
        return  $_SERVER["REQUEST_METHOD"];
    }
    // public  function getQuery()
    // {
    //     $fullPath = $_SERVER["REQUEST_URI"];
    //     $query = [];
    //     $firstQueryPosition = strpos($fullPath, "?");
    //     if(!$firstQueryPosition) {
    //         return $query;
    //     }
    //     $queryString = trim(urldecode(substr($fullPath, $firstQueryPosition+1, mb_strlen($fullPath))));
    //     $queries = mb_split("&", $queryString);
    //     foreach ($queries as $q) {
    //         [$key,$value] = mb_split("=", $q);
    //         $query[$key]=$value;
    //     }
    //     return $query;
    // }
    public function getBody()
    {
        $body = [];
        if($this->getMethod()=="GET") {
            foreach($_GET as $key=>$value){
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        elseif($this->getMethod()=="POST") {
            foreach($_POST as $key=>$value){
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }

}
