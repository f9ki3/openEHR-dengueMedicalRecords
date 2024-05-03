<?php
include '../config/config.php';

// Prepare SQL statement to select data
$stmt = $conn->prepare("SELECT * FROM hospital");

// Check if the statement preparation was successful
if (!$stmt) {
    $response = array("status" => "error", "message" => "Error: " . $conn->error);
} else {
    // Execute the prepared statement
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
        $response = array("status" => "error", "message" => "Error: " . $stmt->error);
    }
}

// Close statement and connection
$stmt->close();
$conn->close();

// Return JSON response
echo json_encode($response);
?>
