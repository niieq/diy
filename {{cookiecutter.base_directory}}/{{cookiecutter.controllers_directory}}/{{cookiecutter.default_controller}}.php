<?php

class {{ cookiecutter.default_controller|capitalize }} extends Controller {
    public function __construct() {
        parent::__construct();
    }

    public function {{ cookiecutter.default_method }}() {
        $this->view->dexport("message", "It works");
        $this->view->render('{{ cookiecutter.default_controller }}/{{ cookiecutter.default_method }}');
    }
}
