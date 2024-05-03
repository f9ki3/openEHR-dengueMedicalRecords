<?php
include '../config/config.php';

// Retrieve data sent via POST
$h_name = $_POST['h_name'];
$h_address = $_POST['h_address'];
$h_image_name = $_FILES['h_image']['name'];
$h_image_tmp = $_FILES['h_image']['tmp_name'];

// Move uploaded image to desired directory
$target_dir = "../uploads/"; // Replace with your desired directory
$h_image_path = $target_dir . basename($h_image_name);
move_uploaded_file($h_image_tmp, $h_image_path);

// Prepare SQL statement to insert data
$stmt = $conn->prepare("INSERT INTO `hospital` (`id`, `date`, `hospital_name`, `address`, `image`) VALUES (NULL, CURRENT_TIMESTAMP, ?, ?, ?)");
$stmt->bind_param("sss", $h_name, $h_address, $h_image_name);

// Execute the prepared statement
if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Hospital added successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
