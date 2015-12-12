<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 *
 */
class Bootstrap {
    private $_url = null;
    private $_controller = null;
    private $_method = null;
    
    private $_basePath = '';
    private $_controllerPath = 'controller/';
    private $_modelPath = 'model/';
    private $_defaultMethod = 'index';
    private $_defaultController = 'home';

    /**
     *
     */
    private function _parseUrl(){
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $this->_url = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
    }

    /**
     *
     */
    private function _loadDefaultController(){
        require_once trim($this->_basePath . $this->_controllerPath . $this->_defaultController . '.php', '/');
        $this->_controller = new $this->_defaultController();
        $this->_controller->{$this->_defaultMethod}();
    }

    /**
     *
     */
    private function _loadController(){
        $file = trim($this->_basePath . $this->_controllerPath . $this->_url[0] . '.php', '/');
        
        if (file_exists($file)) {
            require_once $file;
            $this->_controller = new $this->_url[0]();
            $this->_controller->loadModel($this->_url[0], $this->_basePath . $this->_modelPath);
        } else {
            $this->_error();
            die();
        }
    }

    /**
     *
     */
    private function _callControllerMethod(){
        $length = count($this->_url);
        if ($length > 1) {
            $this->_method = $this->_url[1];
            if (!method_exists($this->_controller, $this->_method)) {
                $this->_error();
                die();
            }
        }
        
        switch ($length){
            case 5:
                $this->_controller->{$this->_method}($this->_url[2], $this->_url[3], $this->_url[4]);
                break;
            case 4:
                $this->_controller->{$this->_method}($this->_url[2], $this->_url[3]);
                break;
            case 3:
                $this->_controller->{$this->_method}($this->_url[2]);
                break;
            case 2:
                $this->_controller->{$this->_method}();
                break;
            default:
                $this->_controller->{$this->_defaultMethod}();
        }
    }

    /**
     * @return bool
     */
    private function _error(){
        require_once 'utils/DError.php';
        $this->_controller = new DError();
        $this->_controller->error_code_404();
        return false;
    }

    /**
     * @return bool
     */
    public function init(){
        if($this->_basePath === '' || empty($this->_basePath)){
            die('You need to point baseDir to a valid path in your config file.');    
        }
        
        $this->_parseUrl();
        if (empty($this->_url[0])) {
            $this->_loadDefaultController();
            return false;
        }

        $this->_loadController();
        $this->_callControllerMethod();
    }

    /**
     * @param $path
     */
    public function setBasePath($path){
        $this->_basePath = trim($path, '/') . '/';
        //die($this->_basePath);
        if($path === ''){
            die("You need to set a base path for the main app!!!");
        }
    }

    /**
     * @param $path
     */
    public function setControllerPath($path){
        $this->_controllerPath = trim($path, '/') . '/';
    }

    /**
     * @param $path
     */
    public function setModelPath($path){
        $this->_modelPath = trim($path, '/') . '/';
    }

    /**
     * @param $controller_name
     */
    public function setDefaultController($controller_name){
        $this->_defaultController = trim($controller_name, '/');
    }

    /**
     * @param $method_name
     */
    public function setDefaultMethod($method_name){
        $this->_defaultMethod = trim($method_name, '/');
    }
}   
