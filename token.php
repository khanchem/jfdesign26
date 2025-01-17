<?php
$clientId = ''; // Your Client ID
$apiKey = ''; // Your API Key
$callbackUrl = ''; // Your Redirect URL
$domain = ''; // Your Tenant ID without the .vincere.io
$code = 'c4585344-d257-48d8-9884-f4168ef84826';
 $url = 'https://id.vincere.io/oauth2/token';
 $data = [
     'client_id' => $clientId,
     'grant_type' => 'authorization_code',
     'code' => $code,
 ];

 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POST, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
 curl_setopt($ch, CURLOPT_HTTPHEADER, [
     'Content-Type: application/x-www-form-urlencoded',
 ]);

 $response = curl_exec($ch);
 curl_close($ch);
echo $response;