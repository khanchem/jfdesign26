<?php


// API URL for refreshing the token
$url = 'https://id.vincere.io/oauth2/token';

// Prepare the POST data
$data = [
    'client_id' => $clientId,
    'grant_type' => 'refresh_token',
    'refresh_token' => $refreshToken,
];

// Initialize cURL session
$curl = curl_init($url);

// Set the HTTP method to POST
curl_setopt($curl, CURLOPT_POST, true);

// Set the POST fields
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));

// Set the headers
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/x-www-form-urlencoded',
]);

// Return the response instead of outputting it
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    // Output the response
    echo "Response:\n" . $response;
}

// Close the cURL session
curl_close($curl);
?>