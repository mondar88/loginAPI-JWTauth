<?php

//constants
define('SECRET_KEY', 'abC123!');

//JWT generation
function getJWT($jwtbody)
{


  // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

    // Create token payload as a JSON string
    $payload = json_encode(['user_id' => $jwtbody]);

    // Encode Header to Base64Url String
    $base64UrlHeader = str_replace(['+','/','='], ['-','_',''], base64_encode($header));

    // Encode Payload to Base64Url String
    $base64UrlPayload = str_replace(['+','/','='], ['-','_',''], base64_encode($payload));

    // Create Signature Hash
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, SECRET_KEY, true);

    // Encode Signature to Base64Url String
    $base64UrlSignature = str_replace(['+','/','='], ['-','_',''], base64_encode($signature));

    // Create JWT
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

  return $jwt;
}

/**
 * Get header Authorization
 * */
function getAuthorizationHeader(){
        $headers = null;
        if (isset($_SERVER['Authorization'])) {
            $headers = trim($_SERVER["Authorization"]);
        }
        else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
            $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        } elseif (function_exists('apache_request_headers')) {
            $requestHeaders = apache_request_headers();
            // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
            $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
            //print_r($requestHeaders);
            if (isset($requestHeaders['Authorization'])) {
                $headers = trim($requestHeaders['Authorization']);
            }
        }
        return $headers;
    }
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getAuthorizationHeader();
    // HEADER: Get the access token from the header
    if (!empty($headers)) {
        if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
            return $matches[1];
        }
    }
    return null;
}
/* source [https://stackoverflow.com/questions/40582161/how-to-properly-use-bearer-tokens] */

//JWT decoding
//function decodeJWT($token, $key)
function decodeJWT($token)
{
  $seg = explode('.', $token);
  if(count($seg)!=3){
        throw new \Exception("improper structure of token");

  }
  list($headerB64, $payloadB64, $signatureB64) = $seg;

  //testing validity of header
  $header = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $headerB64)));
  if (null===$header) {
    throw new \Exception("invalid header");
  }

  //testing validity of payload
  $payload = json_decode(base64_decode(str_replace(['-','_'], ['+','/'], $payloadB64)));
  if (null===$payload) {
    throw new \Exception("invalid payload");
  }


  $signature = hash_hmac('sha256', $headerB64 . "." . $payloadB64, SECRET_KEY, true);
  // Encode Signature to Base64Url String
  $base64UrlSignature = str_replace(['+','/','='], ['-','_',''], base64_encode($signature));
  if ($base64UrlSignature!==$signatureB64) {
    throw new \Exception("mismatching signature or SECRET_KEY");

  }
  return $payload;
}

 ?>
