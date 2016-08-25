<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('diy', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=diy',
  'user' => 'root',
  'password' => 'wfBAT@gh',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
    'ATTR_TIMEOUT' => 30,
  ),
  'model_paths' =>
  array (
    0 => 'src',
    1 => 'vendor',
  ),
));
$manager->setName('diy');
$serviceContainer->setConnectionManager('diy', $manager);
$serviceContainer->setDefaultDatasource('diy');