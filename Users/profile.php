<?php

    //include database and object file
    include_once'../config/database.php';
    include_once'../objects/user.php';
    include'../objects/constants.php';

    //get database connection
    $database=new database();
    $db=$database->getconnection();

    //prepare user object
    $user= new user($db);


    try {

      $token=getBearerToken();
      /*$seg = explode('.', $token);
      list($headerB64, $payloadB64, $signatureB64) = $seg;
      $payload = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $payloadB64)));*/
      $payload_decode = decodeJWT($token);
      $user->id=$payload_decode->user_id;// extract the id string from $payload_decode and pass on to user

      $stmt=$user->profile();
      if ($stmt->rowCount()>0) {
        $row=$stmt->fetch(PDO::FETCH_ASSOC);
        $user_arr=array(
          "status" => true,
          "message" => "succesfully logged in",
          "id" => $row['id'],
          "username" => $row['username'],
          "email" => $row['email']
        );
      } else {
        $user_arr=array(
          "status" => false,
          "message" => "login attempt failed due to invalid email or password"
        );
      }
      print_r(json_encode($user_arr));


    }catch (Exception $e) {
    echo 'token mismatched: ',  $e->getMessage(), "\n";
    }


 ?>
