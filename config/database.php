<?php
  class Database{
    //database parameters
    private $host="localhost";
    private $db_name="login_apidb";
    private $username="root";
    private $password="";
    public $conn;

    //connecting to the Database
    public function getconnection(){
      $this->conn=null;

      try {
             $this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
             //$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->conn->exec("set names utf8");
      } catch (PDOException $e) {
             echo 'connection error!'.$e->getMessage();
      }

      return $this->conn;
    }

  }
