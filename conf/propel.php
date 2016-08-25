<?php

require_once 'config.php';
$configVars = unserialize(DATABASE);

return [
    'propel' => [
        'paths' => [
            'schemaDir' => dirname(__FILE__) . "/../schema/",
            'outputDir' => dirname(__FILE__) . "/../libs/sqlobjects/",
            'phpDir' => dirname(__FILE__) . "/../libs/sqlobjects/generated-classes/",
            'phpConfDir' => dirname(__FILE__) . "/../libs/sqlobjects/generated-conf/",
            'migrationDir' => dirname(__FILE__) . "/../libs/sqlobjects/generated-migrations/",
            'sqlDir' => dirname(__FILE__) . "/../libs/sqlobjects/generated-sql/",
            'composerDir' => dirname(__FILE__) . "/composer.json"
        ],
        'database' => [
            'connections' => [
                APP_NAME => [
                    'adapter'    => "{$configVars['type']}",
                    'classname'  => 'Propel\Runtime\Connection\ConnectionWrapper',
                    'dsn'        => "{$configVars['type']}:host={$configVars['host']};dbname={$configVars['name']}",
                    'user'       => $configVars['user'],
                    'password'   => $configVars['passwd'],
                    'attributes' => []
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => APP_NAME,
            'connections' => [APP_NAME]
        ],
        'generator' => [
            'defaultConnection' => APP_NAME,
            'connections' => [APP_NAME]
        ]
    ]
];