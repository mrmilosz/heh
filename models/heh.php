<?php
require_once 'models/base.php';
class Heh extends Model {
  function Heh($content) {
    $this->content = $content;
  }

  // Persist this heh and return its ID. (Does only inserts, not updates, because I don't need that functionality yet :)
  function save() {
    $id = null;

    $statement = self::$DB->prepare(
      'INSERT INTO heh
              (content)
       VALUES (:content)
       ;'
    );

    if ($statement) {
      $statement->bindValue('content', $this->content);
      if ($statement->execute()) {
        $id = self::$DB->lastInsertId();
      }
    }

    return $id;
  }

  // Grab a heh by ID.
  public static function by_id($id) {
    $heh = null;

    $statement = self::$DB->prepare('
      SELECT
         h.content AS content
      FROM
         heh h
      WHERE h.id = :id
      ;'
    );

    if ($statement) {
      $statement->bindValue('id', $id);
      if ($statement->execute()) {
        if ($row = $statement->fetch()) {
          $heh = new Heh($row['content']);
        }
        $statement->closeCursor();
      }
    }

    return $heh;
  }
}
