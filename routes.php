<?php
/*
 * This file contains mappings between URLs and handlers.
 * Query strings and trailing slashes are ignored when matching.
 */

require_once 'handlers/heh.php';
require_once 'handlers/new.php';
require_once 'handlers/error.php';

$routes = array(
  '/(\d*)' => 'HehHandler',
  '/new'   => 'NewHandler',
  '/(.*)'  => 'ErrorHandler'
);
