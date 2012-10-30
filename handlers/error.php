<?php
require_once 'handlers/base.php';
class ErrorHandler extends BaseHandler {
  function get() {
    header('HTTP/1.1 404 Not Found');
    self::render('error');
  }
}
