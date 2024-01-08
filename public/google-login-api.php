<?php
//HAY QUE CAMBIAR LOS DATOS PQ LOS HE PUESTO EN UNA PAGINA DE PRUEBA ASI Q SE ME GUARDAN A MI (SERGIO) Y DEBERIAMOS HACERLO CON EL CORREO DE MUSIC LIFE ETC
/* Google App Client Id */
define('CLIENT_ID', '960764573173-dg7tc3ue39cpk16fu74qi2t5t2cgllqc.apps.googleusercontent.com');

/* Google App Client Secret */
define('CLIENT_SECRET', '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');

/* Google App Redirect Url */
define('CLIENT_REDIRECT_URL', 'http://recovery.es/public/code/login.php');

// $client_id, $redirect_uri & $client_secret come from the settings
// $code is the code passed to the redirect url
function GetAccessToken($client_id, $redirect_uri, $client_secret, $code) {
   $url = 'https://www.googleapis.com/oauth2/v4/token';           


   $curlPost = 'client_id=' . $client_id . '&redirect_uri=' . $redirect_uri . '&client_secret=' . $client_secret . '&code='. $code . '&grant_type=authorization_code';
   $ch = curl_init();     
   curl_setopt($ch, CURLOPT_URL, $url);       
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);       
   curl_setopt($ch, CURLOPT_POST, 1);     
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);   
   $data = json_decode(curl_exec($ch), true);
   $http_code = curl_getinfo($ch,CURLINFO_HTTP_CODE);     
   if($http_code != 200)
       throw new Exception('Error : Failed to receieve access token');
  
   return $data;
}

// $access_token is the access token you got earlier
function GetUserProfileInfo($access_token) {   
   $url = 'https://www.googleapis.com/oauth2/v2/userinfo?fields=name,email,gender,id,picture,verified_email'; 
  
   $ch = curl_init();     
   curl_setopt($ch, CURLOPT_URL, $url);       
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
   curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '. $access_token));
   $data = json_decode(curl_exec($ch), true);
   $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);    
   if($http_code != 200)
       throw new Exception('Error : Failed to get user information');
      
   return $data;
}
