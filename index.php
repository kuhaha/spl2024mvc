<?php
require("vendor/autoload.php");

session_start();
date_default_timezone_set("Asia/Tokyo");

$view_dir = 'src/views/';
$db_conf = ['host'=>'localhost', 'user'=>'root','pass'=>'','dbname'=>'spl2024db'];
  
# 1. REQUEST_URI
// (例) $uri =  '/ksu/spl2024mvc/index.php?to=usr&do=login';

# 2. Request Routing

$params = $_GET;
$to = $params['to'] ?? '' ;
$do = $params['do'] ?? '';
unset($params['to']);
unset($params['do']);

$_actions = ['list', 'detail', 'input', 'save', 'delete'];
$routes = [
    'usr' => ['c'=>'User', 'a'=> array_merge($_actions, ['login', 'auth', 'logout', 'upass'])],
    'stu' => ['c'=>'Student', 'a'=> $_actions],
    'prg' => ['c'=>'Program', 'a'=> $_actions],
    'wsh' => ['c'=>'Wish', 'a'=> $_actions],    
];
$mvcClass = $routes[$to]['c'] ?? 'Program';
$action = in_array($do, $routes[$to]['a']??[]) ? $do . 'Action': 'listAction'; 

# 3. Model (namespace spl2024\models)

$namespace = "spl2024\\models\\"; 
$modelClass =  $namespace  . $mvcClass;
$modelClass::setDbConf($db_conf);
$model = new $modelClass();

# 4. View (namespace spl2024\views)

$namespace = "spl2024\\views\\"; 
$viewClass = $namespace  . 'View'; //$mvcClass;
$viewClass::setViewDir($view_dir);
$view = new $viewClass();

# 5. Coutroller (namespace spl2024\controllers)

$namespace = "spl2024\\controllers\\"; 
$ctrlClass = $namespace . $mvcClass;
$controller = new $ctrlClass($model, $view);

call_user_func_array([$controller, $action], $params);
