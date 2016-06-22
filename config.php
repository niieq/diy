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
                'baseDir' => '{{cookiecutter.base_directory}}/', # This can be anything. It should contain the controller and model folders ...
                'controllersDir' => '{{cookiecutter.controllers_directory}}/',
                'modelsDir' => '{{cookiecutter.models_directory}}/',
                'defaultController' => '{{cookiecutter.default_controller}}',
                'defaultMethod' => '{{cookiecutter.default_method}}'
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

    # Templates loader ...
    define('TEMPLATES',
        serialize(
            array(
                'templateDir' => 'public/templates',
                'cacheDir' => 'public/cache',
                'debug' => true,
                'autoescape' => false
            )
        )
    );

    define('MSG_STORAGE', "{{cookiecutter.messages_storage}}");

    # Secret key. Make sure you don't change this key whilst in production ....
    # Used mostly for hashing ...
    # You could add more hash keys by just defining one.
    define('SECRET_KEY', getenv('SECRET_KEY'));

    # Paths. Make sure you put a trailing slash(/) infront of all your paths!!!
    define('BASE_URL', '{{cookiecutter.base_url}}');
