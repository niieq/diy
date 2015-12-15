<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */
class View {
    
    private $_viewConfig = [];
    private $_loader;
    private $_twig;
    private $_frontend;
    public $templateData = array("baseUrl" => BASE_URL);


    /**
     * View constructor.
     */
    public function __construct() {
        Session::init();
        $this->_viewConfig = unserialize(TEMPLATES);
        
        if(isset($this->_viewConfig['templateDir'])){
            $this->_loader = new Twig_Loader_Filesystem($this->_viewConfig['templateDir']);
            $this->_twig = new Twig_Environment($this->_loader, array(
                'cache' => $this->_viewConfig['cacheDir'],
                'debug' => true,
                'autoescape' => false,
                'auto_reload' => true
            ));
        } else {
            die("Please set the path to your templates");
        }
    }

    /**
     * @param $name
     * @param $value
     */
    public function dexport($name, $value){
        $this->templateData[$name] = $value;
    }

    /**
     * @param $templateName
     */
    public function render($templateName) {
        $templateFile = $templateName . '.twig';
        
        if(file_exists($this->_viewConfig['templateDir'] . '/' . $templateFile)){
            echo $this->_twig->render($templateFile, $this->templateData);
        } else {
            die("Template does not exist. TemplateDir = {$this->_viewConfig['templateDir']}{$templateFile}");
        }
        
        $this->templateData = array("baseUrl" => BASE_URL);
    }

    /**
     * @param $type
     * @return BootstrapUI
     */
    public function frontend($type) {
        if($type === 'bootstrap'){
            $this->_frontend = new BootstrapUI();
        } elseif($type === 'jquery'){
            die('Has not set it yet');
        } else{
            $class = ucfirst($type) . "UI";
            $this->_frontend = new $class();
        }

        return $this->_frontend;
    }
}
