<?php

/**
 * @property mixed _dbconfig
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */

use Propel\Runtime\Propel;

class Model {
    private $_dbConfig = [];

    /**
     * Model constructor.
     */
    public function __construct() {
        if(USE_ORM === true){
            $this->dbase = Propel::getConnection();
        } else{
            $this->_dbConfig = unserialize(DATABASE);
            $this->dbase = new Database($this->_dbConfig);
        }
    }

}
