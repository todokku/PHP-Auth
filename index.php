<?php

require 'autoload.php';
require 'Core/bootstrap.php';
require 'Core/helpers.php';

// // get suspect IP then send to owner
// $_SERVER['HTTP_X_FORWARDED_FOR'];
// $_SERVER['REMOTE_ADDR'];
// $_SERVER['HTTP_CLIENT_IP'];
// $suspect = $_SERVER['HTTP_CLIENT_IP'] ?
//            $_SERVER['HTTP_CLIENT_IP'] :
//           ($_SERVER['HTTP_X_FORWARDED_FOR'] ?
//           $_SERVER['HTTP_X_FORWARDED_FOR'] :
          // $_SERVER['REMOTE_ADDR']);
