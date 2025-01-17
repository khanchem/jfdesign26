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
    echo $response;
    exit;
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
    } else {
        //echo $response;
        return json_decode($response,true);
    }
    curl_close($curl);
}
$jobs = [];
$listing =getAllJobs($page = 1, $jobs_per_page = 20);
 foreach($listing as $list){

  $job_id =  $list;
  $jobs[] = _get_job_details($job_id);
  exit;
 }

 print_r($jobs);