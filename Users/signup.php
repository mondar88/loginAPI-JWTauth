<?php
    //include database and object file
    include_once'../config/database.php';
    include_once'../objects/user.php';

    //prepare database object
    $database= new Database();
    $db=$database->getconnection();

    $user= new user($db);

    //setting user property values
    $user->email = isset($_POST['email']) ? $_POST['email'] : die();
    $user->password = isset($_POST['password']) ? $_POST['password'] : die();
    $user->username = isset($_POST['username']) ? $_POST['username'] : die();

    //creating the user
    if ($user->signup()) {
      $user_arr=array(
        "status" => true,
        "message" => "Sign up complete",
        "id" => $user->id,
        "username" => $user->username
      );
    }else{
      $user_arr=array(
        "status" => false,
        "message" => "email id in use"
      );
    }
    print_r(json_encode($user_arr));
 ?>
