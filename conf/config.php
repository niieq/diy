<?php
    # All configurations can be found in here.

    # Load sensitive data
    $dotenv = new Dotenv\Dotenv(__DIR__);
    $dotenv->load();

    $dbopts = parse_url(getenv('DATABASE_URL'));

    # Application directories ...
    # This is just an example. In your own app the values might change ...
    define('APP_CONFIG',
        serialize(
            array(
                # This can be anything. It should contain the controller and model folders ...
                'baseDir' => 'app/',
                'controllersDir' => 'controllers/',
                'modelsDir' => 'models/',
                'defaultController' => 'home',
                'defaultMethod' => 'index'
            )
        )
    );

    # Database constants ...
    define('DATABASE',
        serialize(
            array(
                'type' => $dbopts['scheme'],
                'host' => $dbopts['host'],
                'name' => ltrim($dbopts['path'], '/'),
                'user' => $dbopts['user'],
                'passwd' => $dbopts['pass'],
                'persistent' => false
            )
        )
    );

    # Either use the propelorm or not ...
    # This will be changed very soon to include other orms ...
    define('USE_ORM', true);

    # Templates loader ...
    define('TEMPLATES',
        serialize(
            array(
                'templateDir' => 'public/templates/',
                'cacheDir' => 'public/cache/',
                'debug' => true,
                'autoescape' => false
            )
        )
    );

    define('MSG_STORAGE', "session");

    define('APP_NAME', "diy");

    define('ADMIN_APP_NAME', "admin");

    # Secret key. Make sure you don't change this key whilst in production ....
    # Used mostly for hashing ...
    # You could add more hash keys by just defining one.
    define('SECRET_KEY', getenv('SECRET_KEY'));

    # Paths. Make sure you put a trailing slash(/) infront of all your paths!!!
    define('BASE_URL', 'http://localhost/~nene/' . APP_NAME . '/');
