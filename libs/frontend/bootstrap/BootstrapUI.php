<?php

/**
 * Created by PhpStorm.
 * User: nene
 * Date: 12/14/15
 * Time: 3:20 PM
 */
class BootstrapUI extends Frontend {

    /**
     * BootstrapUI constructor.
     */
    public function __construct() {
        $cssPath = "public/static/vendor/bootstrap/dist/css/bootstrap.min.css";
        $fonts = "public/static/vendor/font-awesome/css/font-awesome.min.css";
        $jQuery = "public/static/vendor/jquery/dist/jquery.min.js";
        $jsPath = "public/static/vendor/bootstrap/dist/js/bootstrap.min.js";

        $this->setPathToStatics(array(
            'css' => array('bts' => $cssPath, 'fonts' => $fonts),
            'js' => array('jQuery' => $jQuery, 'bts' => $jsPath)
        ));
    }

    /**
     * @param array $items
     * @param array $attr
     * @return mixed|void
     *
     * @example $items = array(
     *              'home' => array('text' => 'Home', 'url' => 'home.php'),
     *              'profile' => array(
                        'changePasswd' => array('text' => 'Change Password', 'url' => 'change_password.php'),
     *                  'logout' => array('text' => 'Sign out', 'url' => 'logout.php')
     *              )
     *          )
     *
     * @options $attr = array(
     *              'fixed' => True | False,
     *              'contrast' => 'dark' | 'light',
     *              'brandName' => 'MyCompany' | '',
     *              'logoPath' => 'path/to/image' | '',
     *              'alignment' => 'left' | 'right',
     *              'search' => True | False,
     *              'searchAlignment' => 'right' | 'left',
     *              'searchTarget' => 'processUrl',
     *              'searchBtnClass' => 'any bootstrap button class',
     *              'centerContent' => True | False
     *          )
     */
    public function navigation($items = array(), $attr = array()) {
        $mainNav = "";
        $navCollapsible = "";
        $searchForm = "";

        $markUp = ($attr['fixed'] !== False) ? "<nav class='navbar navbar-fixed-{$attr['fixed']} " : "<nav class='navbar ";
        $markUp .= ($attr['contrast'] !== "dark") ? "navbar-default'>" : "navbar-inverse'>";

        $navCollapsible .= ($attr['centerContent'] === True) ? "<div class='container'><div class='navbar-header'>" : "<div class='container-fluid'><div class='navbar-header'>";
        $navCollapsible .= "<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navContent' aria-expanded='false'>";
        $navCollapsible .= "<span class='sr-only'>Toggle navigation</span><span class='icon-bar'></span><span class='icon-bar'></span><span class='icon-bar'></span></button>";
        $navCollapsible .= (count($attr['brandName']) !== 0) ? "<a class='navbar-brand' href='{$attr['brandName']['url']}'>{$attr['brandName']['name']}</a></div>" :
            "<a class='navbar-brand' href='/'><img src='{$attr['logoPath']}'></a></div>";

        $markUp .= $navCollapsible;
        $markUp .= "<div class='collapse navbar-collapse' id='navContent'>";
        $markUp .= "<ul class='nav navbar-nav navbar-{$attr['alignment']}'>";

        if(count($items) > 0) {
            foreach ($items as $key => $item) {
                if (DUtil::is_multiArray($item) === True) {
                    $elements = explode('/', $key);
                    $name = ucfirst($elements[0]);
                    $icon = (count($elements) > 1) ? $elements[1] : '';
                    $mainNav .= "<li class='dropdown'>";
                    $mainNav .= "<a class='dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>";
                    $mainNav .= ($icon !== '') ? "<i class='fa fa-{$icon}'></i> {$name} <span class='caret'></span></a>" : "{$name} <span class='caret'></span></a>";
                    $mainNav .= "<ul class='dropdown-menu'>";

                    foreach ($item as $subItem) {
                        if ($subItem === 'divider') {
                            $mainNav .= "<li role='separator' class='divider'></li>";
                        } else {
                            $mainNav .= "<li><a href='{$subItem['url']}'>";
                            $mainNav .= ($subItem['icon'] !== '') ? "<i class='fa fa-{$subItem['icon']}'></i> {$subItem['text']}" : "{$subItem['text']}";
                            $mainNav .= "</a></li>";
                        }
                    }
                    $mainNav .= "</ul></li>";
                } else {
                    $mainNav .= "<li><a href='{$item['url']}'>";
                    $mainNav .= ($item['icon'] !== '') ? "<i class='fa fa-{$item['icon']}'></i> {$item['text']}" : "{$item['text']}";
                    $mainNav .= "</a></li>";
                }
            }

            $markUp .= $mainNav;
        }

        $markUp .= "</ul>";

        if($attr['search'] == True){
            $searchForm .= "<form class='navbar-form navbar-{$attr['searchAlignment']}' action='{$attr['searchTarget']}' role='search'>";
            $searchForm .= "<div class='form-group'><input class='form-control' type='search' placeholder='Search'></div> &nbsp;";
            $searchForm .= "<button class='btn btn-{$attr['searchBtnClass']}' type='submit'>Search</button>";
            $searchForm .= "</form>";
            $markUp .= $searchForm . "</div></div></nav>";
        } else{
            $markUp .= "</div></div></nav>";
        }

        return $markUp;
    }

    public function footer($copyrightText, $navigation = false) {
        // TODO: Implement footer() method.
    }

//    public function table($cols, $class) {
//        $markup = "<table class='table {$class}'>";
//    }
}