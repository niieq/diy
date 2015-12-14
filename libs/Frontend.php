<?php

/**
 * Created by PhpStorm.
 * User: nene
 * Date: 12/13/15
 * Time: 7:45 PM
 */
abstract class Frontend {

    private $_pathToStatics;

    /**
     * Frontend constructor.
     * Should basically return the url path to the UI library CSS and JS files
     * by setting $_pathToStatics as an array
     */
    abstract public function __construct();

    /**
     * @param $color
     * @param array $items
     * @param array $attr
     * @return mixed
     * @internal param bool|false|string $logoPath
     * @internal param bool|false|string $brandName
     * @internal param bool $searchBar
     */
    abstract public function navigation($color, $items = array(), $attr = array());

    /**
     * @param $copyrightText
     * @param bool|false|mixed $navigation
     * @return mixed
     */
    abstract public function footer($copyrightText, $navigation = false);

    /**
     * @return mixed
     */
    # abstract public function carousel();

    /**
     * @param $numRows
     * @param $numCols
     * @param $class
     * @return mixed
     */
    abstract public function table($numRows, $numCols, $class);

    /**
     * @return mixed
     */
    public function getPathToStatics() {
        return $this->_pathToStatics;
    }

    /**
     * @param mixed $pathToStatics
     */
    public function setPathToStatics($pathToStatics) {
        $this->_pathToStatics = $pathToStatics;
    }
}