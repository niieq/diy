<?php

/**
 * @author      Obed Ademang <kizit2012@gmail.com>
 * @copyright   Copyright (C), 2015 Obed Ademang
 * @license     MIT LICENSE (https://opensource.org/licenses/MIT)
 *              Refer to the LICENSE file distributed within the package.
 *
 */

require_once 'vendor/autoload.php';
require_once 'conf/config.php';
require_once 'libs/sqlobjects/generated-conf/config.php';
require_once 'libs/Autoload.php';

new Autoload('libs/base/');

// use Monolog\Logger;
// use Monolog\Handler\StreamHandler;

// $defaultLogger = new Logger('defaultLogger');
// $defaultLogger->pushHandler(new StreamHandler('/var/log/propel.log', Logger::WARNING));

// $serviceContainer->setLogger('defaultLogger', $defaultLogger);

$appConfig = unserialize(APP_CONFIG);

$app = new Bootstrap();
$app->setBasePath($appConfig['baseDir']);

if($appConfig['baseDir'] === '' || empty($appConfig['baseDir'])){
    die('You need to point baseDir to a valid path in your config file.');
}

$app->setControllerPath($appConfig['controllersDir']);
$app->setModelPath($appConfig['modelsDir']);
$app->setDefaultController($appConfig['defaultController']);
$app->setDefaultMethod($appConfig['defaultMethod']);
$app->setIfDefaultModel(false);
$app->init();