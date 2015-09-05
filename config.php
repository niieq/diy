<?php

    //  All configurations can be found in here.
    // Database constants
    define('DB_TYPE', 'mysql');
    define('DB_HOST', 'localhost');
    define('DB_NAME', 'qasla');
    define('DB_USER', 'administrator');
    define('DB_PASS', 'wfBAT@gh');


    // Paths. Make sure you put a trailing slash(/) infront of all your paths!!!
    define('BASE_URL', 'http://localhost:8080/diy/');
    define('LIBS', 'libs/');

    // Hash. Constants that control security issues.
    /* Make sure you don't change this key whilst in production.
     * To change it in development, comment it out and create a new replica.
     * Make sure you undo this action before deploying it or pushing it.
     */
    define('HASH_PASSWORD_KEY', 'f686505c2f813f91e7fe871fdc127ece');
    define('HASH_SESSION_KEY', '0Y7kG2YtaBDErR02h2pGORwItS2njHIJ');