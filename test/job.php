<?php
// API key
$apiKey = ''; // Your API Key
$idToken = '.iTI-oyiX5Y5LJ6PR5lbujcjfiZ3bqnr3GeW5yk0A6bTF0DVu304zO_IuyV-oblbdBth361aPvHFgNAkjyVxtLV4qfMdgWs9L2rl3yzULGNQM3lwpaAcNJKUprfiQ5d-JfL6SXLmmGl62FzbESLsZdppr459RYkEhY0ehNOJw2E1Wts3a46oyUs1FB_xGC3YBoKx5nIRyNPvgpPQX1kmEguAf8srB4f8xuMJ9lEX9b0ItFLwvIzaJ53TODXTQ28AWjseTAT9Uv0KD3-adXmm5jqkDY7CoDFIkqFH2SUE2qwAXFPiPxl2YVpQ3UnDHYN_KfCnjjMxHgWy7B5Z841ZTKQ';
$domain = '';

// Base URL
$baseUrl = "https://$domain.vincere.io/api/v2/position/search/";
$encodedQueryString = "fl%3Did%2Cjob_title%2Clocation%2Clive_list_url%2Cdescription%2Cformatted_pay_rate%2Ckeywords%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc";

// Query parameters as an array
$queryParams = [
    'fl' => 'id,job_title,keywords,open_date,closed_date,currency,salary_from,salary_to,employment_type,company',
    'mlt.fl' => 'job_title,keywords',
    'sort' => 'created_date desc',
    'q' => 'job_title:developer',
    'start' => 0,
    'limit' => 25,
];



// Build the query string
$queryString = http_build_query($queryParams);

// Construct the full URL
$url = $baseUrl . '?' . $encodedQueryString;

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
    "x-api-key: $apiKey",
    "id-token: $idToken",
]);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
} else {
    // Output the response
    echo $response;
}

// Close cURL
curl_close($ch);
