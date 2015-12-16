<?php

class Home extends Controller {
    public function __construct(){
        parent::__construct();
    }
    
    public function index(){
//        $menu = array(
//            'home' => array('text' => 'Home', 'url' => '../home/index', 'icon' => 'home'),
//            'about' => array('text' => 'About us', 'url' => '../home/another/Obed', 'icon' => 'info'),
//            'contact' => array('text' => 'Contact us', 'url' => '#', 'icon' => 'phone'),
//            'profile/user' => array(
//                'changePasswd' => array('text' => 'Change Password', 'url' => '#', 'icon' => 'suitcase'),
//                'divider',
//                'logout' => array('text' => 'Logout', 'url' => '#', 'icon' => 'lock'),
//            )
//        );
//
//
//        $attr = array(
//            'fixed' => False,
//            'contrast' => 'dark',
//            'brandName' => array('name' => 'Framework', 'url' => '../home/index'),
//            'centerContent' => False,
//            'search' => False,
//            'alignment' => 'right',
//            'searchAlignment' => 'left',
//            'searchTarget' => '#',
//            'searchBtnClass' => 'default',
//            'logoPath' => ''
//        );

         $this->view->render('home/index');
    }

    public function another($name){
        $this->view->dexport('name', $name);
        $this->view->render('home/another');
    }
}
