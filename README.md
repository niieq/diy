# DIY PHP Framework
A PHP minimal framework which allows you to control every bit of it.

# HOW TO USE
1. Clone the repository.
2. Install [composer](https://getcomposer.org/doc/00-intro.md) inside the root directory of the library or framework.
3. Run this command to install all dependencies: ``` php composer.phar install```
4. Edit __./config.php__ to correspnd to the app you are building.
5. Create a __cache__ dir inside the public folder
6. It is always recommended that you put your app files in a base directory.
6. After choosing a basePath make sure you make it writable 


# TODO
- Integrate an object relational mapper:
    - Doctrine
    - Propel
    - RedBeanPHP
- PDO exception and error handling
- Build a frontend(html, css, js) system to accomplish miniature frontend/client tasks
- Change config file to a .ini file and parse it into php
- PHPUnit tests to test components
- Karma tests for the frontend system