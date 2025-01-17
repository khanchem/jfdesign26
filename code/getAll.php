<?php
require_once('sql.php');

// Initialize API credentials and domain

// Pagination settings
$limit = 25; // Number of records per page
$start = 0; // Starting index
$allJobs = []; // Array to store all jobs

do {
    // Construct the URL with pagination parameters
    $url = "https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Clive_list_url%2Cpublic_description%2Cindustry%2Cformatted_salary_to%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%2Cjob_summary%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?start=$start&limit=$limit";
  //  $url ="https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cdescription%2Cindustry%2Cformatted_salary_to%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%3Dkeywords%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20asc?start=$start&limit=$limit";
    //$url ="https://$domain.vincere.io/api/v2/position/search/fl%3Did%3B?start=$start&limit=$limit";
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
echo $response;
exit;
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
            $description = $job['public_description'] ?? '';
            $description = strip_tags($description); // This removes all HTML tags
            // Optional: Remove content between <style> tags to remove CSS definitions
            $description = preg_replace('/<style.*?<\/style>/is', '', $description);
            $job_id = $job['id']; // Example job_id
            $job_title = $job['job_title'] ?? '';
            $formatted_salary_to = $job['formatted_salary_to'] ?? '';
           
            $company_id = $job['company']['id'] ?? '';
            $company_name = $job['company']['name'] ?? '';
            $location = $job['location']['city'] ?? '';
            $url = $job['location']['city'] ?? '';
            $result = insertJobPosting($job_id, $job_title, $formatted_salary_to, $description, $company_id, $company_name, $location);
            echo $result;
      
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
