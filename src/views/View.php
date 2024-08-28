<?php
namespace spl2024\views;

class View
{
    protected $params = []; 
    static $VIEW_DIR = "src/views/";

    static function setViewDir($dir)
    {
        self::$VIEW_DIR = $dir;
    }
    
    function render($tpl, $params=[])
    {
        ob_start();
        extract($params);
        include(self::$VIEW_DIR . 'pg_header.php');
        include(self::$VIEW_DIR . $tpl. '.php');
        include(self::$VIEW_DIR . 'pg_footer.php'); 
        ob_end_flush();
    }

    function redirect($url)
    {
        header("Location:{$url}");
    }
}
/*
class User extends View
{

}

class Program extends View
{

}
*/