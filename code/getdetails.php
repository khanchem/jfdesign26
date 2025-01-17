<?php
require_once('sql.php');
function _get_job_details($job_id){
    global $apiKey, $idToken, $domain;
    $url = "https://$domain.vincere.io/api/v2/position/$job_id";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    $headers = [
        "accept: application/json",
        "x-api-key: $apiKey",
        "id-token: $idToken", // Use the ID token here
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
    } else {
        //echo $response;
        return json_decode($response,true);
    }
    curl_close($curl);
}

$job_ids = getAllJobs();
foreach($job_ids as $job_id){
  $job =  _get_job_details($job_id);
  $job_id =$job_id;
  $job_title = $job['job_title'] ?? '';
  $formatted_salary_to = $job['compensation']['formatted_pay_rate'] ?? '';
  $description = $job['public_description'] ?? '';
  $company_id = $job['company_id'] ?? '';
  $company_name =  '';
   $location =  '';
  echo   updateJobPosting($job_id, $job_title, $formatted_salary_to, $description, $company_id, $company_name, $location);

}
//updateJobPosting($job_id, $job_title, $formatted_salary_to, $description, $company_id, $company_name, $location);