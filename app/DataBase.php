<?php

  namespace App\Controllers;
  namespace App\Services;
  use PDO;


  class DataBase {

    private $dbHost ='localhost';
    private $dbUser = 'root';
    private $dbPass = 'root';
    private $dbName = '0220_aerobot_academy';

    //public function __construct() {}

    //conection
    public function conectDB() {

      $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
      $dbConnecion = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
      $dbConnecion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $dbConnecion;
    }

  }