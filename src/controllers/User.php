<?php
namespace spl2024\controllers;

class User extends Controller 
{
    public function loginAction()
    {
        return $this->view()->render('usr_login');
    }

    public function listAction()
    {
        $users = $this->model()->getList();
        return $this->view()->render("usr_list", ['users'=>$users]);
    }
    
    public function authAction($uid, $upass)
    {
        $user = $this->model()->auth($uid, $upass);
        if ($user){
            foreach(['uid', 'uname', 'urole'] as $k){
                $_SESSION[$k] = $user[$k];
            } 
            return $this->view()->render('login_success');
        }else{
           return $this->view()->render('login_fail'); 
        }
    }
}
