<?php
namespace app\core;


class Router
{
    public const GET = "GET";
    public const POST = "POST";
    public const DELETE = "DELETE";
    public const PUT = "PUT";
    private $routes = [];
    private Request $request;
    private Response $response;

    public function __construct(Request $request,Response $response)
    {

        $this->request=$request;
        $this->response=$response;
      
    }
    private function normlizePath($path)
    {
        return rtrim($path, '/'); // Remove trailing slashes
    }
    public function get($path, $callback)
    {

        $path =  $this->normlizePath($path); // Remove trailing slashes

        $this->routes[self::GET][$path] = $callback;
    }

    public function post($path, $callback)
    {

        
        $path =  $this->normlizePath($path); // Remove trailing slashes
        $this->routes[self::POST][$path] = $callback;
    }

    public function delete($path, $callback)
    {

        $path =  $this->normlizePath($path); // Remove trailing slashes
        $this->routes[self::DELETE][$path] = $callback;
    }

    public function put($path, $callback)
    {


        $path =  $this->normlizePath($path); // Remove trailing slashes

        $this->routes[self::PUT][$path] = $callback;
    }
    public function resolve()
    {
        $path = $this->normlizePath($this->request->getPath()); // Remove trailing slashes
        $method = strtoupper($this->request->getMethod());
        $callback = $this->routes[$method][$path]   ?? false;
        if(!$callback) {
            $this->response->setStatusCode(404);
              return $this->response->renderView("_404.php");
              exit();
        }
        if(is_string($callback)) {
            return $this->response->renderView($callback);
        }

        return call_user_func_array($callback, [$this->request, $this->response]);
        // return call_user_func($callback, [$this->request,$this->response]);

    }
}
