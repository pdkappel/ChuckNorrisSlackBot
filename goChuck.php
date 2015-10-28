<?php

/*
 *  this file should be run using cron every x minutes
 *  posts a random fact only if the random int is a match
 *
 */

require 'norris.class.php';

if(!function_exists('curl_version')) exit('Chuck needs php curl installed on this server');

if( rand(1, 100) == 50 ) {

    $chuck = new norris();
    $chuck->postChuckFact();
}