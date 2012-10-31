<?php
require_once 'handlers/base.php';
class NewHandler extends BaseHandler {
  function get() {
    if (!self::render('new')) {
      self::redirect('/error');
    }
  }

  function post() {
    self::redirect('/new');
  }
}
