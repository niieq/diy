<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2011-12 Jesse Boyer
 * @license     GNU General Public License 3 (http://www.gnu.org/licenses/)
 *              Refer to the LICENSE file distributed within the package.
 *
 */
class View {

    function __construct() {
        Session::init();
    }

    public function render($name, $noInclude = false) {
        if ($noInclude) {
            require 'views/' . $name . '.php';
        } else {
            require 'views/header.php';
            require 'views/' . $name . '.php';
            require 'views/footer.php';
        }
    }

}