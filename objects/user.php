<?php
 class user{
   //Database parameters
   private $conn;
   private $table_name='users';

   //attributes
   public $id;
   public $email;
   public $password;
   public $username;

   //method for database connection
   public function __construct($db){
     $this->conn=$db;
   }



   //signup user
   function signup(){
     if ($this->isExisting()) {
       return false;
     }

     //query insert record
     else{
       $query="INSERT INTO ". $this->table_name . "
            SET
            email= :email,
            password= :password,
            username= :username";

        //prepare query
        $stmt=$this->conn->prepare($query);

        //sanitize
        $this->email=htmlspecialchars(strip_tags($this->email));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->username=htmlspecialchars(strip_tags($this->username));

        //bind parameters
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":username", $this->username);

        //execute query
        if($stmt->execute()){
          $this->id=$this->conn->lastInsertId();
          return true;
        }

     }

   }

   //JWT check
   function prepLogin(){
     //select all query
     $query="SELECT
                  id,email,password,username
              FROM ".$this->table_name."
               WHERE
                  email='".$this->email."'
                    AND password='".$this->password."'";

    //prepare query statement
    $stmt=$this->conn->prepare($query);
    if ($stmt->execute()) {
      return $stmt;
    } else {
      return null;
    }

   }

   //decode JWT
   function profile(){
     //select all query
     $query="SELECT
                  id,email,password,username
              FROM ".$this->table_name."
               WHERE
                  id='".$this->id."'";

    //prepare query statement
    $stmt=$this->conn->prepare($query);
    if ($stmt->execute()) {
      return $stmt;
    } else {
      return null;
    }

   }




   //login user
   function login(){
     //select all query


     $query="SELECT
                  id,email,password,username
              FROM ".$this->table_name."
               WHERE
                  email='".$this->email."'
                    AND password='".$this->password."'";

    //prepare query statement
    $stmt=$this->conn->prepare($query);
    if ($stmt->execute()) {
      return $stmt;
    } else {
      return null;
    }


   }

   //email id exist function
   //function isExisting(){
  //   $query="SELECT * FROM " .$this->table_name. " WHERE email=' " .$this->email. " ' ";
  //   $stmt=$this->conn->prepare($query);
  //   if ($stmt->execute()) {
  //     print_r (json_encode(array('message' => 'testing isExecute true' )));
  //     var_dump($stmt);
  //     if ($stmt->rowcount()>0) {
    //     print_r (json_encode(array('message' => 'exists' )));
  //       return true;
  //     } else {
  //      print_r (json_encode(array('message' => 'failed' )));
  //      return null;
  //     }
       //return true;
  //   } else {
    //   return null;
  //   }

  //email id exist function
  function isExisting(){
    $query="SELECT * FROM " .$this->table_name." WHERE email=' " .$this->email. " ' ";
    $stmt=$this->conn->prepare($query);
    $stmt->execute();
    //print_r json_encode(array('message' => 'testing isExecute success' ));
    if ($stmt->rowcount()>0) {
      return true;
    } else {
     return false;
    }
   }


 }


?>
