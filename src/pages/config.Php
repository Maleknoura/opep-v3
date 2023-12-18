<?php
class Config
{
      private $host = "localhost";
      private $username = "root";
      private $password = "";
      private $dbname = "opepver2";
      protected $conn;

      public  function conn()
      {
            try {
                  $connect = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
                  $conn = new PDO($connect, $this->username, $this->password);
                  $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                  return $conn;
            } catch (PDOException $e) {
                  echo $e->getMessage();
            }
      }

}
