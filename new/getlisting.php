<?php
require_once('../code/sql.php');
 $url = "https://$domain.vincere.io/api/v2/position/search/fl%3Did%2Cjob_title%2Cpublic_description%2Cindustry%2Cformatted_salary_to%2Ccompany%2Cmonthly_pay_rate%2Clocation%3Bmlt.fl%2Cjob_summary%2Cjob_title%3Bsort%3Did%20desc%2Ccreated_date%20desc?start=0&limit=100";
  $curl = curl_init($url);
  $headers = [
      "accept: application/json",
      "x-api-key: $apiKey",
      "id-token: $idToken",
  ];
  curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
  $response = curl_exec($curl);
  echo $response;
