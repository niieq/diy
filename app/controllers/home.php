<?php

class Home extends Controller {
    public function __construct() {
        $this->addMenuItem('home', array('text' => 'Home', 'url' => 'home/index', 'icon' => 'home'));
        $this->addMenuItem('about', array('text' => 'About us', 'url' => 'home/another/Obed', 'icon' => 'info'));
        $this->setNavAttr('fixed', False);
        parent::__construct();
    }
    
    public function index() {
        $this->view->render('home/index');
    }

    public function another($name){
        $this->view->dexport('name', $name);
        $this->view->render('home/another');
    }
}
