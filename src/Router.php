<?php
namespace spl2024;

class Router
{
    private $base = null;
    private $routes = ['GET'=>[],'POST'=>[]];

    public function __construct($base, $routes)
    {
        $this->base = $base;
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