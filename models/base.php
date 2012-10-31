<?php
date_default_timezone_set('UTC');

class Model {
  public static $DB;
}

Model::$DB = new PDO('sqlite:records.db');
Model::$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
