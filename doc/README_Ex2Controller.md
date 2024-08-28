##  Coutroller

```php
namespace spl2024\controllers{

 abstract class Controller 
 {
    protected $model;
    protected $view;
    public function __construct($model, $view)
    {
        $this->model = $model;
        $this->view = $view;
    }
    public function model()
    {
        return $this->model;
    }
    public function view()
    {
        return $this->view;
    }
 } 
    
 class User extends Controller 
 {
    public function loginAction()
    {
        return $this->view()->render('usr_login');
    }

    public function logoutAction()
    {
        unset($_SESSION);
        session_destroy();
        return $this->view()->render('usr_login');
    }

    public function listAction()
    {
        $users = $this->model()->getList();
        return $this->view()->render("usr_list", ['users'=>$users]);
    }
    
    public function authAction()
    {
        $uid = htmlspecialchars($_POST['uid']);
        $upass = htmlspecialchars($_POST['upass']);
        $user = $this->model()->auth($uid, $upass);
        
        if ($user){
            foreach(['uid', 'uname', 'urole'] as $k){
                $_SESSION[$k] = $user[$k];
            } 
            return $this->view()->redirect('?to=prg&do=list');
        }else{
            return $this->view()->redirect('?to=usr&do=login'); 
        }
    }
}

class Program extends Controller
{
   public function listAction()
   {
      return $this->view()->render('prg_list');
   }
}   

} // End of namespace spl2024\controllers

```
