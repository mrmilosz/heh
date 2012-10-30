<?php
require_once 'handlers/base.php';
class HomeHandler extends BaseHandler {
  function get() {
    if (!self::render('home')) {
      self::redirect('/error');
    }
  }
}
