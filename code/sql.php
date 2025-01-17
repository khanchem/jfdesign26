<?php
$apiKey = 'f1ef9004-ebb1-42e2-9115-bf2d6f3fc793'; // Your API Key
$idToken = "eyJraWQiOiI5bHNyUXBsU1lXWDNXXC9CR0o1UjZWUzFKVmp3TjNMYUtyWjg5NTdMXC9UZlU9IiwiYWxnIjoiUlMyNTYifQ.eyJhdF9oYXNoIjoiQmxQejBKRW1CWkpiMV8tQmlpVnRFdyIsInN1YiI6IjM5MDNlNGMxLWQyNjItNDk4NC05MDVmLTlkYmUzMDI1ZGE0NCIsImVtYWlsX3ZlcmlmaWVkIjpmYWxzZSwiaXNzIjoiaHR0cHM6XC9cL2NvZ25pdG8taWRwLnVzLWVhc3QtMS5hbWF6b25hd3MuY29tXC91cy1lYXN0LTFfREZzUXA3bTdEIiwiY29nbml0bzp1c2VybmFtZSI6IkFjY2Vzc1ZpbmNlcmVfM2YwY2M5MzAtNGE4YS00NGU5LTljNmEtODM0NGUxNzkzZGMyIiwiYXVkIjoiN2JzODAwY2dnYmVsYzY4MXV1NTE3NW9rYm8iLCJpZGVudGl0aWVzIjpbeyJ1c2VySWQiOiIzZjBjYzkzMC00YThhLTQ0ZTktOWM2YS04MzQ0ZTE3OTNkYzIiLCJwcm92aWRlck5hbWUiOiJBY2Nlc3NWaW5jZXJlIiwicHJvdmlkZXJUeXBlIjoiT0lEQyIsImlzc3VlciI6bnVsbCwicHJpbWFyeSI6InRydWUiLCJkYXRlQ3JlYXRlZCI6IjE3MzYyMjk4MjQ3MTUifV0sInRva2VuX3VzZSI6ImlkIiwiYXV0aF90aW1lIjoxNzM2MzE3MjM4LCJleHAiOjE3MzcwMjQzMjMsImlhdCI6MTczNzAyMDcyMywiZW1haWwiOiJqYW1pZUB0aGVqZmRlc2lnbi5jby51ayJ9.ot1UgzRzZeWOIz0korCVorV3lhqBxk-BSX7Bn5cOr0YJc8S30hw1aKkfg8OOzTs5dKgOlp2jMp9gf4gCjNZ84IN5sOYTq4a086K_UItx-BhHRtyuvMEI1jBdYD0-xp8AUeRWSD8xAshs05E6udTqr5WePtridNYd6qAQdaseFqFBwCR_okIBWUG2-FDOcV4T85FwWXgGir_3ZK1yO8MRuhfuhUNHPcGaLvixiyR4WW44Rzk1ZeX2XkZM9Qk5EQxciIOD7A8M3hGfUSMkwhuiuI9zA3WwLMLFDJgrSaZrnTZNQyMCBUwAkuNYBlYN36p-z5X7PkPthomKAHJflnwCnw";
 $domain = 'infra-rec';


$host = 'localhost'; // Your database host
$user = 'root'; // Your database username
$password = ''; // Your database password
$database = 'JobListings'; // Your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function insertJobPosting($job_id, $job_title, $formatted_salary_to, $description, $company_id, $company_name, $location) {
    global $conn;

    // Sanitize inputs to prevent SQL injection
    $job_id = (int)$job_id; // Cast to integer for safety
    $job_title = $conn->real_escape_string($job_title);
    $formatted_salary_to = $conn->real_escape_string($formatted_salary_to);
    $description = $conn->real_escape_string($description);
    $company_id = (int)$company_id; // Cast to integer for safety
    $company_name = $conn->real_escape_string($company_name);
    $location = $conn->real_escape_string($location);

    // Check for duplicates based on job_id
    $duplicate_check_query = "SELECT COUNT(*) as count FROM jobpostings WHERE job_id = $job_id";
    $result = $conn->query($duplicate_check_query);
    $row = $result->fetch_assoc();

    if ($row['count'] > 0) {
        return "Duplicate entry found for job_id: $job_id.";
    }

    // Construct the insert statement
    $insert_query = "INSERT INTO jobpostings (job_id, job_title, formatted_salary_to, description, company_id, location, company_name) 
                     VALUES ($job_id, '$job_title', '$formatted_salary_to', '$description', $company_id, '$location', '$company_name')";

    // Execute the insert statement
    if ($conn->query($insert_query) === TRUE) {
        return "New job posting inserted successfully.";
    } else {
        return "Error: " . $conn->error;
    }
}

function updateJobPosting($job_id, $job_title = null, $formatted_salary_to = null, $description = null, $company_id = null, $company_name = null, $location = null) {
    global $conn;

    $job_id = (int)$job_id; // Cast to integer for safety

    // Array to store the fields that need updating
    $updates = [];

    if ($job_title !== null) {
        $job_title = $conn->real_escape_string($job_title);
        $updates[] = "job_title = '$job_title'";
    }
    if ($formatted_salary_to !== null) {
        $formatted_salary_to = $conn->real_escape_string($formatted_salary_to);
        $updates[] = "formatted_salary_to = '$formatted_salary_to'";
    }
    if ($description !== null) {
        $description = $conn->real_escape_string($description);
        $updates[] = "description = '$description'";
    }
    if ($company_id !== null) {
        $company_id = (int)$company_id; // Cast to integer for safety
        $updates[] = "company_id = $company_id";
    }
    if ($company_name !== null) {
        $company_name = $conn->real_escape_string($company_name);
        $updates[] = "company_name = '$company_name'";
    }
    if ($location !== null) {
        $location = $conn->real_escape_string($location);
        $updates[] = "location = '$location'";
    }

    // Check if there are fields to update
    if (empty($updates)) {
        return "No fields to update.";
    }
    $update_query = "UPDATE jobpostings SET " . implode(", ", $updates) . " WHERE job_id = $job_id";
    if ($conn->query($update_query) === TRUE) {
        return "Job posting updated successfully.";
    } else {
        return "Error updating job posting: " . $conn->error;
    }
}

function getAllJobs() {
    global $conn;
    $jobs = [];
    $query = "SELECT job_id FROM jobpostings";
    $result = $conn->query($query);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $jobs[] = $row['job_id'];  // Add job_id to the array
        }
    } else {
        return "No job postings found.";
    }

    return $jobs;  
}

?>