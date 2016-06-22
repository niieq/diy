<?php

class Home extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function {{cookiecutter.default_method}}() {
        $this->view->dexport("message", "It works");
        $this->view->render('home/index');
    }
}
