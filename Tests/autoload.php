<?php

spl_autoload_register(function($class){
    $path = 'src/' . substr(strrchr($class, '\\'), 1);
    if (file_exists($path . '.php')) {
        include($path . '.php');
    }
});
