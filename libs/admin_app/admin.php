<?php

class Admin extends Controller{
    public function __construct(){
        parent::__construct();
        $this->title = "DIY Framework Admin";
        $this->view->dexport("title", $this->title);
    }

    private function _controlAccess(){
        if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
            DUtil::redirect(BASE_URL . "admin/login");
        }
    }

    public function index(){
        $this->_controlAccess();

        $this->view->dexport("title", $this->title);
        $this->view->dexport("message", "This is the admin dashboard");
        $this->view->dexport("user", Session::get("admin"));
        $this->view->render('admin/index');
    }

    public function login(){
        $this->title .= " | Login";
        $this->view->dexport("title", $this->title);
        $this->view->dexport("message", $this->fetchMessage());
        $this->view->render('admin/login');
    }

    public function signin(){
        try{
            $this->formData ->post("username", true)
                            ->post("password", true);
            $this->formData->submit();
            Session::unsert("formErrors");
        } catch(Exception $e) {
            Session::set('formErrors', $this->formData->fetchErrors());
        }

        if(!isset($_SESSION['formErrors'])){
            $username = $this->formData->fetch("username");
            $password = $this->formData->fetch("password");

            $user = Authentication::login($username, $password);

            if($user === false){
                $this->setMessage('error', "Username/Password mismatch!!!");
                DUtil::redirect(BASE_URL . 'admin/login');
            } else{
                $user_data = $user->toArray();
                unset($user_data["Password"]);
                unset($user_data["CreatedAt"]);
                unset($user_data["ModifiedAt"]);
                unset($user_data["FirstName"]);
                unset($user_data["LastName"]);

                Session::set("admin", $user_data);
                DUtil::redirect(BASE_URL . 'admin');
            }
        } else{
            $message = "<ul>";
            foreach(Session::get('formErrors') as $key => $value){
                $message .= "<li><b>{$key}:</b> {$value}</li>";
            }
            $message .= "</ul>";

            $this->setMessage('error',  $message);
            DUtil::redirect(BASE_URL . 'admin/login');
        }
    }

    public function signout(){
        Authentication::logout();
        DUtil::redirect(BASE_URL . "admin/login");
    }
}