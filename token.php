<?php
$clientId = '08f8124d-c77e-4b70-b531-3c7670cdbe91'; // Your Client ID
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$callbackUrl = 'https://infra-rec.com/vincere-callback/'; // Your Redirect URL
$domain = 'infra-rec'; // Your Tenant ID without the .vincere.io
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