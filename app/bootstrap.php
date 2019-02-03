<?php

    require_once 'config/config.php';
    require_once 'helpers/console_log.php';
    require_once 'helpers/url_helper.php';
    require_once 'helpers/message_helper.php';


    // require_once 'libraries/core.php';
    // require_once 'libraries/controller.php';
    // require_once 'libraries/database.php';


    //Function which will require a class as soon as it has been invoked in a file
    spl_autoload_register(function($className) {
        require_once 'libraries/' . $className . '.php';
    });

?>