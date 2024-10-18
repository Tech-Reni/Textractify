<?php
function verifyEmail($email) {
    $apiKey = '06ba3e63-b604-44d2-b3b2-b31b8b7e96af';
    $url = 'https://api.mails.so/v1/validate?email=' . urlencode($email); // Use urlencode to handle special characters in the email

    $options = [
        'http' => [
            'header' => "x-mails-api-key: $apiKey\r\n" . "Content-Type: application/json\r\n", // Adding Content-Type header
            'method' => 'GET',
            'timeout' => 10 // Optional: Set a timeout for the request
        ]
    ];
  
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context); // Use @ to suppress warnings

    if ($response === FALSE) {
        die('Error: Unable to connect to the API or invalid response');
    }
  
    $data = json_decode($response, true);
    
    // Check for any error messages in the response
    if (isset($data['error'])) {
        echo "Error: " . htmlspecialchars($data['error']); // Print API error if present
        return; // Exit function if there's an error in the response
    }
    
    // Check if 'data' exists and has the 'result' key
    if (isset($data['data']) && isset($data['data']['result'])) {
        // Access the 'result' key
        if ($data['data']['result'] === 'deliverable') {
            return true;
        } else {
            return false;
        }
    } else {
        // Handle the case where 'result' is not set
        echo "The response does not contain a validation result.";
    }
}