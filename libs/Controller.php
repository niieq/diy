<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 - 16 DAPQA, UCC
 * @license     GNU General Public License 3 (http://www.gnu.org/licenses/)
 *              Refer to the LICENSE file distributed within the package.
 *
 * 
 */
class Controller {
    private $_errorMessage = null;
    private $_successMessage = null;

    public function __construct() {
        Session::init(); //Begin session on every page ...
        $this->view = new View(); //Controls view processes ...
        $this->formData = new Form(); //Controls form data pasing ...
        $this->view->title = 'Quality Assurance System'; //Global default title ...
    }

    public function loadModel($name = NULL) {
        $path = (empty($name)) ? 'models/index_model.php' : 'models/' . $name . '_model.php';

        if (file_exists($path)) {
            require $path;
            $modelName = (empty($name)) ? 'Index_Model' : $name . '_Model';
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

    public function setErrorMessage($message){
        $this->_errorMessage = $message;
        apc_store('errorMessage', $this->_errorMessage);
    }

    public function fetchErrorMessage(){
        return apc_fetch('errorMessage');
    }

    public function setSuccessMessage($message){
        $this->_successMessage = $message;
        apc_store('successMessage', $this->_successMessage);
    }

    public function fetchSuccessMessage(){
        return apc_fetch('successMessage');
    }

    public function json($data){
        if(is_array($data)){
            return json_encode($data);
        }
    }

}