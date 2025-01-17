<?php

// Configuration
$clientId = '08f8124d-c77e-4b70-b531-3c7670cdbe91'; // Your Client ID
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$callbackUrl = 'https://infra-rec.com/vincere-callback/'; // Your Redirect URL
$domain = 'infra-rec'; // Your Tenant ID without the .vincere.io

// Step 1: Generate Authorization Code
function getAuthorizationCode($clientId, $callbackUrl) {
    $url = "https://id.vincere.io/oauth2/authorize?client_id=$clientId&state=STATE&redirect_uri=$callbackUrl&response_type=code";
    // header("Location: $url");
    // exit();
}

// Step 2: Exchange Authorization Code for ID Token
function getIdToken($clientId, $code) {
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

    return json_decode($response, true);
}

// Step 3: Get Job Details
function getJobDetails($idToken, $apiKey, $domain) {
    $url = "https://$domain.vincere.io/api/v2/job/";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "id-token: $idToken",
        "x-api-key: $apiKey",
        "Content-Type: application/json",
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Main Logic
if (isset($_GET['code'])) {
    // Step 2: Get ID Token using the authorization code
    $code = $_GET['code'];
    $tokenResponse = getIdToken($clientId, $code);
    
    if (isset($tokenResponse['id_token'])) {
        $idToken = $tokenResponse['id_token'];

        // Step 3: Get Job Details
        $jobDetails = getJobDetails($idToken, $apiKey, $domain);
        echo '<pre>';
        print_r($jobDetails); // Display job details
        echo '</pre>';
    } else {
        echo "Error retrieving ID token: " . json_encode($tokenResponse);
    }
} else {
    // Step 1: Redirect to get authorization code
    getAuthorizationCode($clientId, $callbackUrl);
}
?>