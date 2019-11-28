<?php
//php function for autoloader

spl_autoload_register('autoLoader');
//my function for autoloader

function autoLoader($className)
{
    //path
    $path = "../control/$className.class.php";
    // $extension = '.class.php';
    // $fullPath = $path . $className . $extension; //control/Person.class.php

    if (file_exists($path)) {
      require_once  $path;
    }

    $path = "control/$className.class.php";
    if (file_exists($path)) {
      require_once  $path;
    }else {
      return false;
    }

}
