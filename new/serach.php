<?php


// Define the API endpoint and parameters
$apiUrl = "https://$domain.vincere.io/api/v2/position/search/l%3Did%2Cjob_title%2Ckeywords%2Ctext%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?q=text%3Aproject%23";
$searchQuery = "text:developer#"; // Replace with your actual search query
$url = "https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cpublic_description%2Cindustry%2Cformatted_salary_to%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%2Cjob_summary%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?start=0&limit=20";
 
// Initialize cURL session
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url .'&q='.urlencode($searchQuery));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "accept: application/json",
 "x-api-key: $apiKey",
"id-token: $idToken", 
]);

// Execute the cURL request
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
} else {
    // Decode the JSON response
  echo $response;
}
// Close the cURL session
curl_close($ch);
?>