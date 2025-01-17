<?php

// Initialize cURL session
$curl = curl_init();


// Define the matrix_vars for the search
$matrixVars = 'sort=id desc';

// Define the search query (example: searching for jobs with title containing "developer")
$query = 'q=job_title:developer#';

// Define the start and limit ```php
// Define the start and limit for pagination
$start = 0; // Starting index
$limit = 25; // Number of records to return

// Construct the full URL
$url = "https://$domain.vincere.io/api/v2/position/search/$matrixVars";
$url = "https://$domain.vincere.io/api/v2/position/32771";

// Initialize cURL session
$curl = curl_init($url);

// Set the HTTP method to GET
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

// Set the headers
$headers = [
    "accept: application/json",
    "x-api-key: $apiKey",
    "id-token: $idToken", // Use the ID token here
];
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

// Return the response instead of outputting it
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute the request and capture the response
$response = curl_exec($curl);

// Check for errors
if (curl_errno($curl)) {
    echo "cURL Error: " . curl_error($curl);
} else {
    // Output the response
    echo  $response;
}

// Close the cURL session
curl_close($curl);
?>