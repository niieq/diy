<?php

/**
 * @property mixed _dbconfig
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */
class Model {
    private $_dbConfig = [];

    /**
     * Model constructor.
     */
    public function __construct() {
        $this->_dbconfig = unserialize(DATABASE);
        $this->dbase = new Database($this->_dbConfig);
    }

}
