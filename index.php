<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @license     GNU General Public License 3 (http://www.gnu.org/licenses/)
 *              Refer to the LICENSE file distributed within the package.
 *
 */

require 'config.php';
require 'functions.php';
require_once LIBS . 'Autoload.php';

new Autoload(LIBS);

$app = new Bootstrap();