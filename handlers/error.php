<?php
require_once 'handlers/base.php';
class ErrorHandler extends BaseHandler {
  function get() {
    header('HTTP/1.1 404 Not Found');
    self::render('error');
  }

  function post() {
    $func_args = func_get_arg(0);
    $url = $func_args[0];
    self::redirect('/' . $url);
  }
}
