<?php
namespace spl2024;

class Router
{
    private $base = null;
    const METHODS = ['GET','POST'];
    private $routes;
/*
$base = dirname($_SERVER['PHP_SELF']);
$routes = [
   //method, path, [(c)ontroller, (a)ction, [(p)arameters]]
    ['GET', '/', ['c'=>'User', 'a'=>'list']],
    ['GET', '/usr/login/?', ['c'=>'User', 'a'=>'login']],
    ['GET', '/usr/list/?', ['c'=>'User','a'=>'list']],
    ['GET', '/usr/([0-9]+)/detail', ['c'=>'User','a'=>'detail','p'=>['id']] ],
    ['GET', '/usr/([0-9]+)/modify', ['c'=>'User','a'=>'modify','p'=>['id']] ],
    ['GET', '/usr/input', ['c'=>'User','a'=>'input'] ],
    ['POST', '/usr/save', ['c'=>'User','a'=>'save'] ],
    ['GET', '/s/list', ['c'=>'User','a'=>'list']],
    ['GET', '/s/([a-z0-9]+)/detail', ['c'=>'Student','a'=>'detail','p'=>['sid']] ],
    ['GET', '/s/([a-z0-9]+)/modify', ['c'=>'Student','a'=>'modify','p'=>['sid']] ],
    ['GET', '/s/input', ['c'=>'Student','a'=>'input'] ],
    ['POST', '/s/save', ['c'=>'Student','a'=>'save'] ],
];
*/    
    public function __construct($base, $routes)
    {
        $this->base = $base;
        $this->routes = ['GET'=>[],'POST'=>[]];
        foreach ($routes as $route) {
            $method = strtoupper($route[0]);
            $rule = ['path'=>$route[1], 'def'=>$route[2]];
            array_push($this->routes[$method], $rule);
        }
    }

    public function __call($name, $args)
    {
        $method = strtoupper($name);
        if (in_array($method, self::METHODS)) {
            return $this->match($method, $args[0]);
        }
        return [];
    }
    
    public function match($method, $request)
    {
        $method = strtoupper($method);
        foreach ($this->routes[$method]??[] as $route) {
            $def = $route['def'];
            $params = [];
            $path = rtrim($this->base, '/') . $route['path'];
            if (preg_match("#^{$path}$#", $request, $matches)) {
                foreach ($def['p']??[] as $i=>$name){
                    $params[$name] = $matches[$i+1] ?? null;
                }
                $def['p'] = $params;
                return $def;
            }
        }
        return null;
    }
}
