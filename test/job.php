<?php
// API key
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$idToken = 'eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiWGttM0QxTlVnX0dZY2pYYWhoWlJIQSIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY2MTQwNjIsImlhdCI6MTczNjYxMDQ2MiwiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.iTI-oyiX5Y5LJ6PR5lbujcjfiZ3bqnr3GeW5yk0A6bTF0DVu304zO_IuyV-oblbdBth361aPvHFgNAkjyVxtLV4qfMdgWs9L2rl3yzULGNQM3lwpaAcNJKUprfiQ5d-JfL6SXLmmGl62FzbESLsZdppr459RYkEhY0ehNOJw2E1Wts3a46oyUs1FB_xGC3YBoKx5nIRyNPvgpPQX1kmEguAf8srB4f8xuMJ9lEX9b0ItFLwvIzaJ53TODXTQ28AWjseTAT9Uv0KD3-adXmm5jqkDY7CoDFIkqFH2SUE2qwAXFPiPxl2YVpQ3UnDHYN_KfCnjjMxHgWy7B5Z841ZTKQ';
$domain = 'infra-rec';

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
