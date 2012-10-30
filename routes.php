<?php
/*
 * This file contains mappings between URLs and handlers.
 * Query strings and trailing slashes are ignored when matching.
 */

require_once 'handlers/home.php';
require_once 'handlers/error.php';

$routes = array(
  '/'     => 'HomeHandler',
  '/(.*)' => 'ErrorHandler'
);
