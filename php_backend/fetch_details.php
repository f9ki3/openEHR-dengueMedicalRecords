<?php
include '../config/config.php';

// Check if the 'id' parameter is set in the GET request
if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare SQL statement to select data
    $stmt = $conn->prepare("SELECT patient_records.*, hospital.hospital_name 
    FROM patient_records 
    JOIN hospital ON patient_records.hospital = hospital.id 
    WHERE hospital.id = ?");
    
    if ($stmt) {
        // Bind the parameter
        $stmt->bind_param("i", $id);

        // Check if the statement execution was successful
        if ($stmt->execute()) {
            // Fetch the result
            $result = $stmt->get_result();

            // Fetch all rows as an associative array
            $rows = array();
            while ($row = $result->fetch_assoc()) {
                $rows[] = $row;
            }

            // Free result set
            $result->free();

            // Prepare response
            $response = array("status" => "success", "data" => $rows);
        } else {
            // Handle execution error
            $response = array("status" => "error", "message" => "Execution Error: " . $stmt->error);
        }

        // Close statement
        $stmt->close();
    } else {
        // Handle statement preparation error
        $response = array("status" => "error", "message" => "Statement Preparation Error: " . $conn->error);
    }
} else {
    // Handle case where 'id' parameter is not set
    $response = array("status" => "error", "message" => "Error: 'id' parameter not set in the GET request.");
}

// Close connection
$conn->close();

// Return JSON response
echo json_encode($response);
?>
