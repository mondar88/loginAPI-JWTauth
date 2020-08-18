
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

    $user->email=isset($_GET['email'])?$_GET['email']:die();
    $user->password=isset($_GET['password']) ? $_GET['password'] : die();


    $stmt=$user->prepLogin();
    if ($stmt->rowCount()>0) {
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      $jwtbody = $row['id'];
      $token = getJWT($jwtbody);
      print_r("login succesfull \n");
      $user_arr=array(
        "username" => $row['username'],
        "token" => $token
      );
      function readprofile($token)
      {
        try {
          echo $jwtoken = $this->getBearerToken();
        } catch (\Exception $e) {
          echo 'Token failed to catch: ',  $e->getMessage(), "\n";
        }

      }
    } else {
      $user_arr=array(
        "status" => false,
        "message" => "login attempt failed due to invalid email or password"
      );
    }
    print_r(json_encode($user_arr));



 ?>
