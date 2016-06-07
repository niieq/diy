<?php

class Home extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->view->dexport("message", "It works");
        $this->view->render('home/index');
    }
}
