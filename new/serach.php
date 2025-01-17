<?php
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$idToken = "eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoienFMN2J0d0dyRElnV0daSUkxSEVIUSIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzY4NzU5NDMsImlhdCI6MTczNjg3MjM0MywiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.MM41gE1utNu1X9mknu4k_lEKObhTbhQe7UoaEmaoYnuQdK0Sof7h-RqyKtPsdsE6Xwqte9iXBT3Oob5mc7FtmMiEt4F4vI0AxGMcqBETuX0jMU5oXQekYQn_MGRg2iedR1PV0CtVZVyaGQPkSEqdE3-OOkDN-ZHO6xwQw_IIYnD0zxBsTYxxSeNyNeqL2CfskahaoMly2z7us6010sgImxn9-nyxEcNiI86oalVIUk7DpO2BmaZJJgvzBNSgcM-EvUIxsvducnvPXRAWivj9gDJcrLyIyLOfn5QVEjHCsSAtDxBKocuMlGDRe6peEHA956jRRdEt8ub0eaCxlCkhYg";
$domain = 'infra-rec';


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