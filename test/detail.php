<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins or specify your domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

//require_once('sql.php'); // Include the database or any external script you need
$job = file_get_contents('json.json');
$job = json_decode($job, true);
// Simulate a dummy response based on the "id" parameter
if (isset($_GET['id'])) {
    $job_id = $_GET['id'];  // Ensure variable naming is consistent
   // $job = _get_job_details($job_id);  // Fetch job details using the job_id
    $job_title ='test';// $job['job_title'] ?? '';  // Get the job title from the response

    // Dummy data - You would typically fetch this from your database based on $job_id
    $dummyResponse = array(
        'title' => $job_title,  // Simulated title
        'html' => html2($job)  // Simulated HTML content
    );
    // Set the content type to JSON and return the response
    header('Content-Type: application/json');
    echo json_encode($dummyResponse);
} else {
    // If no 'id' is passed, return an error response
    echo json_encode(array('error' => 'No job ID found'));
}

// Function to get job details from an external API
function _get_job_details($job_id) {
    global $apiKey, $idToken, $domain;

    $url = "https://$domain.vincere.io/api/v2/position/$job_id";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
    $headers = [
        "accept: application/json",
        "x-api-key: $apiKey",
        "id-token: $idToken",  // Ensure the ID token is passed in headers
    ];
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
  echo  $response;
  exit;
    if (curl_errno($curl)) {
        echo "cURL Error: " . curl_error($curl);
        exit;  // Exit on error
    }

    // Decode the JSON response into an associative array
    $responseData = json_decode($response, true);
    curl_close($curl);

    // Return the response data (you can modify this based on what you want to send)
    return $responseData;
}
function html2($job) {
    // Decoding the note field from the job data
    $note = $job['note']; // This is the raw note string

    // Extract the JSON-like part from the note string
    preg_match('/Location: (\[.*\])/s', $note, $matches);
    
    // Default location value
    $location = '';

    if (isset($matches[1])) {
        // Replace single quotes with double quotes for proper JSON format
        $json_str = str_replace("'", '"', $matches[1]);

        // Fix any missing commas between JSON objects (if necessary)
        // This assumes a space is used between JSON objects where a comma is missing
        $json_str = preg_replace('/}\s*{/', '},{', $json_str);

        // Decode the JSON string to an array
        $location_data = json_decode($json_str, true);

        
        // Check if the location data is an array and has at least one item
        if (is_array($location_data) && count($location_data) > 0) {
            // Get the name of the first location
            $city = $location_data[0]['city'] ?? '';
            $state = $location_data[0]['state'] ?? '';
            $country = $location_data[0]['country'] ?? '';
            $zipcode = $location_data[0]['zipcode'] ?? '';

            // Format the full location (City, State, Country, Zipcode)
            $location = "$city, $state, $country, $zipcode";
        }
    }
    echo $location;
    exit;
    // Generating the HTML content
    $html = '';
    $html .= '
    <style>
        h1 { color: #136636; }
        h2 { color: #136636; }
        .job-details { margin-bottom: 20px; color: #136636; }
        .job-details p { line-height: 1.6; }
        .apply-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .apply-button:hover { background-color: #0056b3; }
        .location { margin: 10px 0; }
        .salary { font-weight: bold; color: #136636; }
        .employ-type { display: flex; justify-content: space-between; margin-bottom: 15px; }
    </style>

    <div class="container">
        <h1>Job Title: ' . htmlspecialchars($job['job_title']) . '</h1>
        <div class="job-details">
            <h2>' . htmlspecialchars($note['Department'] ?? '') . '</h2>
            <div class="employ-type">
                <div class="d">
                    <p><strong>Job Type:</strong> ' . htmlspecialchars($job['job_type']) . '</p>
                </div> 
                <div class="">
                    <p><strong>Employment Type:</strong> ' . htmlspecialchars($job['employment_type']) . '</p>
                </div>
            </div>
            <div class="employ-type">
                <div class="d">
                    <p><strong>Open Date:</strong> ' . date('F j, Y', strtotime($job['open_date'])) . '</p>
                </div> 
                <div class="">
                    <p><strong>Close Date:</strong> ' . date('F j, Y', strtotime($job['close_date'])) . '</p>
                </div>
            </div>
            <p class="salary"><strong>Salary:</strong> ' . htmlspecialchars($job['compensation']['formatted_salary_from']) . ' - ' . htmlspecialchars($job['compensation']['formatted_salary_to']) . ' per year</p>
            <p class="location"><strong>Location:</strong> ' . htmlspecialchars($location) . '</p>
            <h2>Job Description:</h2>
            <p>' . nl2br(htmlspecialchars($job['public_description'])) . '</p>
            
            <h2>Requirements:</h2>
            <ul>
                <li>Bachelors degree in Engineering or a related field.</li>
                <li>Minimum of 5 years of experience in project management.</li>
                <li>Ability to work independently and make decisions under pressure.</li>
            </ul>
        </div>
    </div>
    ';
    return $html;
}

function html($job) {

    // Ensure the data is properly sanitized to prevent XSS
    $job_title = htmlspecialchars($job['job_title'] ?? 'Unknown Job Title');
    $job_type = htmlspecialchars($job['job_type'] ?? 'N/A');
    $employment_type = htmlspecialchars($job['employment_type'] ?? 'N/A');
    $head_count = htmlspecialchars($job['head_count'] ?? '0');
    $open_date = htmlspecialchars($job['open_date'] ?? 'N/A');
    $close_date = htmlspecialchars($job['close_date'] ?? 'N/A');
    $salary_range = htmlspecialchars($job['compensation']['salary_range'] ?? 'N/A');
    $annual_salary = htmlspecialchars($job['compensation']['annual_salary'] ?? 'N/A');
    $job_description = $job['public_description'] ?? 'No description available';
    $apply_link = htmlspecialchars($job['live_list_url'] ?? '#');

    // HTML and CSS content
    $html = '
    <style>
       
        .job-container {
            background-color: #fff;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .job-title {
            font-size: 2rem;
            color: #2c3e50;
            margin-bottom: 10px;
        }
        .job-info, .salary-info, .job-description {
            margin-bottom: 30px;
        }
        .job-info p, .salary-info p, .job-description p {
            font-size: 1rem;
            line-height: 1.6;
            color: #555;
        }
        .salary-info h2, .job-description h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #3498db;
        }
        .apply-link {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            font-size: 1rem;
        }
        .apply-link:hover {
            background-color: #2980b9;
        }
    </style>
    <div class="job-container">
        <h1 class="job-title">' . $job_title . '</h1>
        <div class="job-info">
            <p><strong>Job Type:</strong> ' . $job_type . '</p>
            <p><strong>Employment Type:</strong> ' . $employment_type . '</p>
            <p><strong>Head Count:</strong> ' . $head_count . '</p>
            <p><strong>Open Date:</strong> ' . $open_date . '</p>
            <p><strong>Close Date:</strong> ' . $close_date . '</p>
        </div>
        <div class="salary-info">
            <h2>Compensation</h2>
            <p><strong>Salary Range:</strong> ' . $salary_range . '</p>
            <p><strong>Annual Salary:</strong> ' . $annual_salary . '</p>
        </div>
        <div class="job-description">
            <h2>Job Description</h2>
            <div class="description-content">
                <p>' . $job_description . '</p>

                <a href="' . $apply_link . '" class="apply-link">Apply Now</a>
            </div>
        </div>
    </div>';
    return $html;

}
?>
