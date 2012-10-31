PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS heh;

CREATE TABLE heh (
   id                   INTEGER                                          PRIMARY KEY
  ,content              TEXT        NOT NULL
  ,creation_date        TIMESTAMP   NOT NULL  DEFAULT CURRENT_TIMESTAMP
);
