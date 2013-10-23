<?php
require_once 'models/heh.php';

require_once 'handlers/base.php';
class HehHandler extends BaseHandler {
  public function get() {
    $templ_args = array();

    $func_args = func_get_arg(0);
    $heh_id = $func_args[0];

    // If no ID was provided, use a default heh with the contents "\heh"
    if ($heh_id === '') {
      $templ_args['heh'] = new Heh('\heh');
    }

    // If an ID was provided in the URL, fetch the corresponding heh
    else {
      $heh = Heh::by_id($heh_id);

      if ($heh !== null) {
        $templ_args['heh'] = $heh;
      }
      // If it is not actually a heh, redirect to heh creation
      else {
        self::redirect('/new');
        return;
      }
    }

    // If rendering fails (as may happen if, for example, the ID was malformed)
    if (!self::render('heh', $templ_args)) {
      self::redirect('/error');
    }
  }

  public function post() {
    $func_args = func_get_arg(0);
    $heh_id = $func_args[0];

    // A correctly formed POST request has no ID and has a body
    if ($heh_id === '' && isset($_POST['content'])) {
      $heh_content = $_POST['content'];
      $heh = new Heh($heh_content);
      $heh_id = $heh->save();
      self::redirect('/' . $heh_id);
      return;
    }

    // Redirect to heh creation on malformed POST requests
    else {
      self::redirect('/new');
    }
  }
}
