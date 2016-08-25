<?php

class Admin extends Controller{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->view->dexport("message", "This is the admin dashboard");
        $this->view->render('admin/indexqwerty');
    }
}