<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     GNU General Public License 3 (http://www.gnu.org/licenses/)
 *              Refer to the LICENSE file distributed within the package.
 *
 * 
 */
class Hash {
    /*
     *
     * @param string $algo The hashing algorithm eg(md5, sha256 etc)
     * @param string $data The data that is going to be encoded
     * @param string $salt The key used as salt
     * @return string The hashed/salted data
     */

    public static function create($algo, $data, $salt) {
        $context = hash_init($algo, HASH_HMAC, $salt);
        hash_update($context, $data);
        return hash_final($context);
    }

}
