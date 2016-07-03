<?php

/**
 * Handle the connectionto db
 * Class Model
 */
class Model
{
    protected $db;

    /**
     * Iniciat mysql and check if table exists, if not create it
     */
    public function __construct()
    {
        $config = require '../app/config/database.php';
        $this->db = new MysqliDb($config);
        $this->checkForRawTable();
    }

    /**
     * check if table raw_table exists if not create it.
     */
    protected function checkForRawTable()
    {
         $this->db->rawQuery("
              CREATE TABLE IF NOT EXISTS raw_table (
                  id int(11) NOT NULL AUTO_INCREMENT,
                  title varchar(250) NOT NULL,
                  description text NOT NULL,
                  price double NOT NULL,
                  init_date datetime NOT NULL,
                  expiry_date datetime NOT NULL,
                  adress varchar(150) NOT NULL,
                  name varchar(100) NOT NULL,
                  PRIMARY KEY (id)
              ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8
        ");
    }
}