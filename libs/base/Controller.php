<?php

/**
 * @property  model
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */
class Controller {
    private $_message = null;
    public $title = "DIY Framework";

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
            $modelName = ucfirst($name) . '_Model';
            $this->model = new $modelName();
        }
    }

    /**
     * @param $message
     * @param $type
     */
    public function setMessage($type, $message){
        if(MSG_STORAGE === "session"){
            switch($type){
                case 'error':
                    $this->_message = "<div class='alert alert-danger' role='alert'>{$message}</div>";
                    Session::set('error', true);
                    Session::set('success', false);
                    Session::set('info', false);
                    Session::set('warning', false);
                    Session::set('errorMessage', $this->_message);
                    break;
                case 'warning':
                    $this->_message = "<div class='alert alert-warning' role='alert'>{$message}</div>";
                    Session::set('error', false);
                    Session::set('success', false);
                    Session::set('info', false);
                    Session::set('warning', true);
                    Session::set('warningMessage', $this->_message);
                    break;
                case 'success':
                    $this->_message = "<div class='alert alert-success' role='alert'>{$message}</div>";
                    Session::set('error', false);
                    Session::set('info', false);
                    Session::set('warning', false);
                    Session::set('success', true);
                    Session::set('successMessage', $this->_message);
                    break;
                case 'info':
                    $this->_message = "<div class='alert alert-info' role='alert'>{$message}</div>";
                    Session::set('error', false);
                    Session::set('success', false);
                    Session::set('info', true);
                    Session::set('warning', false);
                    Session::set('infoMessage', $this->_message);
                    break;
                default:
                    break;
            }
        } elseif(MSG_STORAGE === "apc"){
            switch($type){
                case 'error':
                    $this->_message = "<div class='alert alert-error' role='alert'>{$message}</div>";
                    Session::set('error', true);
                    apc_store('errorMessage', $this->_message);
                    break;
                case 'warning':
                    $this->_message = "<div class='alert alert-warning' role='alert'>{$message}</div>";
                    Session::set('warning', true);
                    apc_store('warningMessage', $this->_message);
                    break;
                case 'success':
                    $this->_message = "<div class='alert alert-success' role='alert'>{$message}</div>";
                    Session::set('success', true);
                    apc_store('successMessage', $this->_message);
                    break;
                case 'info':
                    $this->_message = "<div class='alert alert-info' role='alert'>{$message}</div>";
                    Session::set('info', true);
                    apc_store('infoMessage', $this->_message);
                    break;
                default:
                    break;
            }
        }
    }


    /**
     * return mixed
     */
    public function fetchMessage(){
        if(MSG_STORAGE === "session"){
            if(Session::get('success') === true){
                $message = Session::get('successMessage');
                Session::unsert('successMessage');
                Session::set('success', false);
                return $message;
            } elseif(Session::get('error') === true){
                $message = Session::get('errorMessage');
                Session::unsert('errorMessage');
                Session::set('error', false);
                return $message;
            } elseif(Session::get('warning') === true){
                $message = Session::get('warningMessage');
                Session::unsert('warningMessage');
                Session::set('warning', false);
                return $message;
            } elseif(Session::get('info') === true){
                $message = Session::get('infoMessage');
                Session::unsert('infoMessage');
                Session::set('info', false);
                return $message;
            }
        } elseif(MSG_STORAGE === "apc"){
            if(Session::get('success') === true){
                Session::set('success', false);
                return apc_fetch('successMessage');
            } elseif(Session::get('error') === true){
                Session::set('error', false);
                return apc_fetch('errorMessage');
            } elseif(Session::get('warning') === true){
                Session::set('warning', false);
                return apc_fetch('warningMessage');
            } elseif(Session::get('info') === true){
                Session::set('info', false);
                return apc_fetch('infoMessage');
            }
        }
    }
}
