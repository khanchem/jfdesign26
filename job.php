<?php

// Initialize cURL session
$curl = curl_init();
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$idToken = 'eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiM2N0eHNjaWRBdnE1TS0yVnZFTVpMdyIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY1MDU4MDYsImlhdCI6MTczNjUwMjIwNiwiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.g4LL0RkaK5S8f2eJasiEGh74ObzkWvVauKlXupwVrNgqs7uPqnoGG456UHaAZbJVmRjJ7w_Lc-tUtVaFl1L747ufBdY5g8YcOkMkWyVg5dIRUyAML6aXvGZjYCWSBG6TMz8mgJJ5PcjE6aRnYRFB46z4egAj90bkmPyDd7VzeQKA4LQ3Ol1Q3H3F5Ljd3dHXLRJDbFFblqX_kc40ukqv9h-XPvz3xfALcLulbByfmxZ7PJhuRpI8V7en914o3d5wTNWzeV2mMYMtR7Ib3PalWKTKcwqr7NS0PlHiHzjqXhhEZZZR4ngDTZrO07-gL6ryFsD9KaaFBAeIbxZIINDWGw';
$domain = 'infra-rec';
$idToken = 'eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiUld0ZU1lcExkVWpTblM2TnhlRGpuUSIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY1MDk3OTgsImlhdCI6MTczNjUwNjE5OCwiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.Ah-0xrDEtdWlV2fDdFNkmyOvg7907pFyaMSlHIo9p5HN9ZpHpIm86ZTORGa0QbBGYoyyKYnmgavDeCdAqu_RC_1U1EUrtTeAjHIwkLsEZ0o4Duz6xzX82NOg77w_nEqcvO-c3msvJrxCb6mB2Pw8rZPRua2ErhbuhSlp6tKXTUROwOcXY65wmYM80sBn7kpXJ4HiYxyHNpvbu-q5DjZ9gX9YcJev5a53_E1ybN3rjVlyepzImW-LuN1ECveld79qOTjiCrsiM8Xj7lraxFxrxvKW_kawg2tRtX6FkZ-mFPFt0mgifJiAPsRyUx-3BPY6wTEqLYEeB6dbDltFNJXhWg';

// Define the matrix_vars for the search
$matrixVars = 'sort=id desc';

// Define the search query (example: searching for jobs with title containing "developer")
$query = 'q=job_title:developer#';

// Define the start and limit ```php
// Define the start and limit for pagination
$start = 0; // Starting index
$limit = 25; // Number of records to return

// Construct the full URL fl%3Did%2Cjob_title%2Cpublic_description%2Cindustry%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc
//$url = "https://$domain.vincere.io/api/v2/position/search/$matrixVars";
//$url = "https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cjob_summary%2Ckeywords%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc";
$url ="https://$domain.vincere.io/api/v2/position/search/fl%3Did%3B?start=1&limit=100";

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