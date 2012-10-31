<?php
require_once 'models/heh.php';

require_once 'handlers/base.php';
class HehHandler extends BaseHandler {
  public function get() {
    $templ_args = array();

    $func_args = func_get_arg(0);
    $heh_id = $func_args[0];
    if ($heh_id === '') {
      $templ_args['heh'] = new Heh('\heh');
    }
    else {
      $heh = Heh::by_id($heh_id);

      if ($heh !== null) {
        $templ_args['heh'] = $heh;
      }
      else {
        self::redirect('/new');
        return;
      }
    }

    if (!self::render('heh', $templ_args)) {
      self::redirect('/error');
    }
  }

  public function post() {
    $func_args = func_get_arg(0);
    $heh_id = $func_args[0];
    if ($heh_id === '' && isset($_POST['content'])) {
      $heh_content = $_POST['content'];
      $heh = new Heh($heh_content);
      $heh_id = $heh->save();
      self::redirect('/' . $heh_id);
      return;
    }
    else {
      self::redirect('/new');
    }
  }
}
