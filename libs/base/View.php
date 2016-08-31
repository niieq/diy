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
    public $templateData = [];


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
                'debug' => $this->_viewConfig['debug'],
                'autoescape' => $this->_viewConfig['autoescape'],
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
        $templateFiles = [];

        foreach($this->_loader->getPaths() as $path){
            if(file_exists("{$path}/{$templateName}.twig")){
                echo $this->_twig->render("{$templateName}.twig", $this->templateData);
                return true;
            }
        }

        $this->templateData = [];
        die("Template does not exist. Please make sure you have specified the template file correctly.");

    }
}
