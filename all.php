<?php

// Initialize API credentials and domain
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$idToken = 'eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiM2N0eHNjaWRBdnE1TS0yVnZFTVpMdyIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY1MDU4MDYsImlhdCI6MTczNjUwMjIwNiwiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.g4LL0RkaK5S8f2eJasiEGh74ObzkWvVauKlXupwVrNgqs7uPqnoGG456UHaAZbJVmRjJ7w_Lc-tUtVaFl1L747ufBdY5g8YcOkMkWyVg5dIRUyAML6aXvGZjYCWSBG6TMz8mgJJ5PcjE6aRnYRFB46z4egAj90bkmPyDd7VzeQKA4LQ3Ol1Q3H3F5Ljd3dHXLRJDbFFblqX_kc40ukqv9h-XPvz3xfALcLulbByfmxZ7PJhuRpI8V7en914o3d5wTNWzeV2mMYMtR7Ib3PalWKTKcwqr7NS0PlHiHzjqXhhEZZZR4ngDTZrO07-gL6ryFsD9KaaFBAeIbxZIINDWGw';
$domain = 'infra-rec';
$idToken = 'eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiUld0ZU1lcExkVWpTblM2TnhlRGpuUSIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY1MDk3OTgsImlhdCI6MTczNjUwNjE5OCwiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.Ah-0xrDEtdWlV2fDdFNkmyOvg7907pFyaMSlHIo9p5HN9ZpHpIm86ZTORGa0QbBGYoyyKYnmgavDeCdAqu_RC_1U1EUrtTeAjHIwkLsEZ0o4Duz6xzX82NOg77w_nEqcvO-c3msvJrxCb6mB2Pw8rZPRua2ErhbuhSlp6tKXTUROwOcXY65wmYM80sBn7kpXJ4HiYxyHNpvbu-q5DjZ9gX9YcJev5a53_E1ybN3rjVlyepzImW-LuN1ECveld79qOTjiCrsiM8Xj7lraxFxrxvKW_kawg2tRtX6FkZ-mFPFt0mgifJiAPsRyUx-3BPY6wTEqLYEeB6dbDltFNJXhWg';

// Pagination settings
$limit = 25; // Number of records per page
$start = 0; // Starting index
$allJobs = []; // Array to store all jobs

do {
    // Construct the URL with pagination parameters
   // $url = "https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cpublic_description%2Cindustry%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?start=$start&limit=$limit";
    $url ="https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cdescription%2Cindustry%2Cformatted_salary_to%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?start=$start&limit=$limit";

    // Initialize cURL session
    $curl = curl_init($url);

    // Set the headers
    $headers = [
        "accept: application/json",
        "x-api-key: $apiKey",
        "id-token: $idToken",
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    // Set the cURL options
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");

    // Execute the request
    $response = curl_exec($curl);

    // Check for errors
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
        break;
    } else {
        // Decode the response JSON
        $data = json_decode($response, true);

        // Check if data exists
        if (!empty($data['result']['items'])) {
           foreach($data['result']['items'] as $job){

           }
            // Increment the start index for the next page
            $start += $limit;
        } else {
            // No more jobs
            break;
        }
    }

    // Close the cURL session
    curl_close($curl);
} while (true);

// Output all jobs
echo json_encode($allJobs, JSON_PRETTY_PRINT);
?>
