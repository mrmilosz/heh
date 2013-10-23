<?php
date_default_timezone_set('UTC');

class Model {
  public static $DB;
}

// SQLite and PDO must be installed and records.db must exist in the root of this project
Model::$DB = new PDO('sqlite:records.db');
Model::$DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
