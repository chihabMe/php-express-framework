<?php

namespace app\core;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function renderView($view,$params=[])
    {
        $viewFile = Application::$ROOT_DIR."/views/$view";
        if(file_exists($viewFile)) {
            $layoutContent = $this->getLayoutContent();
            $viewContent = $this->renderOnlyView($viewFile,$params);
            return str_replace('{{content}}', $viewContent, $layoutContent);
        }else{
            return "page not found";
        }
    }

    public function getLayoutContent($layout="main.php")
    {

        $layoutFile = Application::$ROOT_DIR."/views/layouts/$layout";
        ob_start();
        include_once $layoutFile;
        return ob_get_clean();

    }
    public function renderOnlyView($viewFile,$params)
    {
        foreach($params as $key=>$value){
            $$key=$value;
        }

        ob_start();
        include_once $viewFile;
        return ob_get_clean();
    }
    public function redirect($path)
    {
        header("Location: $path");
        exit();
    }
}
