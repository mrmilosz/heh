<?php
/*
 * This file makes the whole framework run. Hopefully there is no need to edit it.
 * I tried to make it as generic as possible.
 */

abstract class ApplicationHandler {
  public function get() {
		header('HTTP/1.1 404 Not Found'); 
	}
  public function post() {
		header('HTTP/1.1 404 Not Found'); 
	}
  public function put() {
		header('HTTP/1.1 404 Not Found'); 
	}
  public function delete() {
		header('HTTP/1.1 404 Not Found'); 
	}

  protected static function render($template, $args=array(), $use_browser_cache=true, $layout='main') {
    if (file_exists('timestamp') && $use_browser_cache) {
      $last_modified_time = filemtime('timestamp'); 
      header('Last-Modified: ' . gmdate('D, d M Y H:i:s', $last_modified_time) . ' GMT'); 
      if (@strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) === $last_modified_time) {
        header('HTTP/1.1 304 Not Modified'); 
        exit; 
      } 
    }

    if (file_exists("markup/pages/$template.html.php")) {
      include_once 'helpers.php';
      include "markup/layouts/$layout.html.php";
      return true;
    }
    else {
      return false;
    }
  }

  protected static function redirect($uri) {
    $web_root = self::web_root();
    header("Location: $web_root$uri");
  }

  /*
    Determine the base directory of the site.

    Source: http://www.webcheatsheet.com/PHP/get_current_page_url.php
  */
  protected static function web_root() {
    $page_url = 'http';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
      $page_url .= 's';
    }
    $page_url .= '://' . $_SERVER['SERVER_NAME'];
    if ($_SERVER['SERVER_PORT'] !== '80') {
      $page_url .= ':' . $_SERVER['SERVER_PORT'];
    }
    return $page_url;
  }
}

include 'routes.php';

$request_uri = $_SERVER['REQUEST_URI'];

foreach ($routes as $pattern => $handler_class) {
  if (preg_match("|^$pattern/?(?:\?.*)?$|", $request_uri, $matches)) {
    $params = array_slice($matches, 1);
    $handler = new $handler_class;
    break;
  }
}

$method = strtolower($_SERVER['REQUEST_METHOD']);

call_user_func(array($handler, $method), $params);
