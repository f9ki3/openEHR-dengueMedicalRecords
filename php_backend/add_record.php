<?php
include '../config/config.php';

// Retrieve data sent via POST
$patient = $_POST['patient'];
$date = $_POST['date'];
$sex = $_POST['sex'];
$age = $_POST['age'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$symptoms = $_POST['symptoms'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$status = $_POST['status'];
$hospital = $_POST['id'];

// You might also need to retrieve h_name, h_address, and h_image_name from POST data

// Prepare SQL statement to insert data
$stmt = $conn->prepare("INSERT INTO `patient_records` (
    PatientName,
    Sex,
    Age,
    Height,
    Weight,
    DateOfDiagnosis,
    Symptoms,
    Diagnosis,
    hospital,
    Treatment,
    Status
    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssssss", $patient, $sex, $age, $height, $weight, $date, $symptoms, $diagnosis, $hospital, $treatment, $status);

// Execute the prepared statement
if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Patient record added successfully"));
} else {
    echo json_encode(array("status" => "error", "message" => "Error: " . $stmt->error));
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
