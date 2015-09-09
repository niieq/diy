<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */

require 'config.php';
require 'functions.php';
require_once LIBS . 'Autoload.php';

new Autoload(LIBS);

$app = new Bootstrap();