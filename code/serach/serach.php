<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins or specify your domain
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");


require_once('../sql.php');
$search = $_GET['search'] ?? '';
function get_job_list($page = 1, $jobs_per_page = 20, $search = '') {
    global $conn;
    $offset = ($page - 1) * $jobs_per_page;

    // Prepare the base SQL query
    $sql = "SELECT * FROM jobpostings";

    // Add a WHERE clause if search is provided
    if (!empty($search)) {
        $search = $conn->real_escape_string($search); // Escape the search term to prevent SQL injection
        $sql .= " WHERE job_title LIKE '%$search%' OR description LIKE '%$search%' OR company_name LIKE '%$search%'";
    }

    // Add LIMIT and OFFSET for pagination
    $sql .= " LIMIT $jobs_per_page OFFSET $offset";

    // Execute the query
    $result = $conn->query($sql);
    if ($result === false) {
        return "Error: " . $conn->error;
    }

    // Fetch and return the results
    $rows = [];
    while ($r = $result->fetch_assoc()) {
        $rows[] = $r;
    }
    return $rows;
}
$listing =get_job_list($page = 1, $jobs_per_page = 20 , $search);
 foreach($listing as $list){
  $html =  html_lsit($list);
  echo $html;
 }
function html_lsit($list){
    $description = $list['description'];
    $description = strip_tags($description);

    $description = str_replace('<br>', ' ', $description);
    $description = str_replace('<br />', ' ', $description);
    
// Split the description into words
$words = explode(' ', $description);

// Limit to 50 words
$limited_description = implode(' ', array_slice($words, 0, 50));

// Append '...' if there are more than 50 words
if (count($words) > 50) {
    $limited_description .= '...';
}
        $html = '';
        $html = '
        <!DOCTYPE html>
        <html>
        <head>
        <style>
        .container {
        width: 80%;
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        }
        .info {
        color: #555;
        margin-bottom: 15px;
        }

        .description {
        color: #555;
        line-height: 1.6;
        }

        .buttons {
        display: flex;
        
        margin-top: 20px;
        }

        button {
        padding: 10px 20px;
        border: none;
        border-radius: 3px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        button:hover {
        opacity: 0.8;
        }

        .apply {
        background-color: #8EBF24;

        color: #fff;
        }

        .details {
        background-color: transparent;
        color: #8EBF24;
        margin-left:5px;
        border: 1px solid #8EBF24;
        }
        </style>
        </head>
        <body>

        <div style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; padding: 15px;" class="elementor-element elementor-element-edit-mode elementor-element-6666753 elementor-element--toggle-edit-tools elementor-widget elementor-widget-divider elementor-widget-divider--view-line ui-resizable">
        <div class="elementor-widget-container">
                            <h2 style="    color: var(--e-global-color-primary);
        " class="elementor-heading-title elementor-size-default elementor-inline-editing" data-elementor-setting-key="title">'.$list['job_title'].'</h2>				</div>
        <h5 class="info" style="color: #8EBF24;">
            '.$list['location'].' | Salary: '.$list['formatted_salary_to'].' | '.$list['company_name'].'
        </h5>
        <div class="description">
           '.$limited_description.'
           </div>
        <div class="buttons">
            <button class="apply ">Apply Now</button>
            <button class="details">Details</button>
        </div>
        </div>

        </body>
        </html>';
        echo $html;
}
?>

