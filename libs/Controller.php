<?php

/**
 * @property  model
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 * 
 */
class Controller {
    private $_errorMessage = null;
    private $_successMessage = null;

    /**
     * Controller constructor.
     */
    public function __construct() {
        Session::init(); //Begin session on every page ...
        $this->view = new View(); //Controls view processes ...
        $this->formData = new Form(); //Controls form data passing ...
        $this->view->dexport('base_url', BASE_URL);
    }

    /**
     * @param $name
     * @param string $modelPath
     */
    public function loadModel($name, $modelPath = 'model/') {
        (empty($name)) ? die("Expects a name of a model to load!!") : $path = $modelPath . $name . '_model.php';
        if (file_exists($path)) {
            require $path;
            $modelName = $name . '_Model';
            $this->model = new $modelName();
        }
    }

    /**
     * location - Shortcut for a page redirect
     *
     * @param string $url 
     */
    public function location($url) {
        header("Location: $url");
        exit(0);
    }

    /**
     * @param $message
     */
    public function setErrorMessage($message){
        $this->_errorMessage = $message;
        apc_store('errorMessage', $this->_errorMessage);
    }

    /**
     * @return mixed
     */
    public function fetchErrorMessage(){
        return apc_fetch('errorMessage');
    }

    /**
     * @param $message
     */
    public function setSuccessMessage($message){
        $this->_successMessage = $message;
        apc_store('successMessage', $this->_successMessage);
    }

    /**
     * @return mixed
     */
    public function fetchSuccessMessage(){
        return apc_fetch('successMessage');
    }
}
