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
        $this->setPathToStatics(
            array(
                'css' => 'public/static/vendor/bootstrap/dist/css/bootstrap.min.css',
                'js' => 'public/static/vendor/bootstrap/dist/js/bootstrap.min.js'
            )
        );
    }

    /**
     * @param $color
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
     *              'style' => 'background-color:#aacc99' | '',
     *              'alignment' => 'left' | 'right',
     *              'search' => True | False,
     *              'searchAlignment' => 'right' | 'left',
     *              'searchTarget' => 'processUrl',
     *              'searchBtnClass' => 'any bootstrap button class'
     *          )
     */
    public function navigation($color, $items = array(), $attr = array()) {
        $mainNav = "";
        $searchForm = "";
        $markUp = ($attr['fixed'] === True) ? "<nav class='navbar navbar-fixed-top " : "<nav class='navbar ";
        $markUp .= ($color !== "") ? "{$attr['contrast']} {$color}'>" : "{$attr['contrast']}' style='{$attr['style']}'>";

        $markUp .= ($attr['brandName'] !== "") ? "<a class='navbar-brand' href='/'>{$attr['brandName']}</a>" :
            "<a class='navbar-brand' href='/'><img src='{$attr['logoPath']}'></a>";

        $markUp .= "<ul class='nav navbar-nav pull-{$attr['alignment']}'>";

        foreach($items as $key => $item){
            if(DUtil::is_multiArray($item) == True) {
                $name = ucfirst($key);
                $mainNav .= "<li class='nav-item dropdown'>";
                $mainNav .= "<a class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>{$name}</a>";
                $mainNav .= "<div class='dropdown-menu' aria-labelledby='Preview'>";

                foreach($item as $subItem){
                    $mainNav .= "<a class='dropdown-item' href='{$subItem['url']}'>{$subItem['text']}</a>";
                }
                $mainNav .= "</div></li>";
            } else {
                $mainNav .= "<li class='nav-item'>";
                $mainNav .= "<a class='nav-link' href='{$item['url']}'>{$item['text']}</a>";
                $mainNav .= "</li>";
            }
        }

        $markUp .= $mainNav;
        $markUp .= "</ul>";

        if($attr['search'] == True){
            $searchForm .= "<form class='form-inline pull-xs-{$attr['searchAlignment']}' action='{$attr['searchTarget']}'>";
            $searchForm .= "<input class='form-control' type='search' placeholder='Search'>";
            $searchForm .= "<button class='btn btn-{$attr['searchBtnClass']}' type='submit'>Search</button>";
            $searchForm .= "</form>";
            $markUp .= $searchForm . "</nav>";
        } else{
            $markUp .= "</nav>";
        }



        return $markUp;

    }

    public function footer($copyrightText, $navigation = false) {
        // TODO: Implement footer() method.
    }

    public function table($numRows, $numCols, $class) {
        // TODO: Implement table() method.
    }
}