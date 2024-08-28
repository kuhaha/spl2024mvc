```php
<?php
namespace spl2024 {
    
session_start();

# 1. Router

 //URL(例)  'http://localhost/spl2024mvc/index.php?to=usr&do=login';
  $to = $_GET['to'] ?? 'prg' ;
  $do = $_GET['do'] ?? 'list';
  $params = $_GET;
  unset($params['to']);
  unset($params['do']);

  $_actions = ['list', 'detail', 'input', 'save', 'delete'];
  $routes = [
    'usr' => ['c'=>'User', 'a'=> array_merge($_actions, ['login', 'auth', 'logout', 'upass'])],
    'stu' => ['c'=>'Student', 'a'=> $_actions],
    'prg' => ['c'=>'Program', 'a'=> $_actions],
    'wsh' => ['c'=>'Wish', 'a'=> $_actions],    
  ];

  $mvcClass = $routes[$to]['c'];
  $action = in_array($do, $routes[$to]['a']) ? $do . 'Action': 'listAction'; 

# 2. Create Model
  $db_conf = ['host'=>'localhost', 'user'=>'root','pass'=>'','dbname'=>'spl2024db'];
  $modelClass = "spl2024\\models\\"  . $mvcClass;
  $modelClass::setDbConf($db_conf);
  $model = new $modelClass();

# 3. Create View
  $view_dir = "views/";
  $viewClass = "spl2024\\views\\"  . 'View';  //$mvcClass;
  $viewClass::setViewDir($view_dir);
  $view  = new $viewClass();

# 4. Create Controller
  $ctrlClass = "spl2024\\controllers\\" . $mvcClass;
  $controller = new $ctrlClass($model, $view);

# 5. Combine Model, View and Controller
  call_user_func_array([$controller, $action], $params);

} // End of namespace spl2024

```
