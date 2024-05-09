<?php
// Connect to MySQL
$host = "localhost";
$user = "root";
$password = "";
$database = "dengue";

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Array of possible addresses
$addresses = [
    'Legazpi City, Albay',
    'Naga City, Camarines Sur',
    'Tabaco City, Albay',
    'Iriga City, Camarines Sur',
    'Ligao City, Albay',
    'Sorsogon City, Sorsogon',
    'Masbate City, Masbate',
    'Daraga, Albay',
    'Libmanan, Camarines Sur',
    'Polangui, Albay'
];

// Array of Filipino surnames
$filipino_surnames = [
    'Santos', 'Reyes', 'Cruz', 'Bautista', 'Ocampo', 'Garcia', 'Torres', 'Ramos', 'Fernandez', 'Rivera', 'Villanueva', 'Mendoza', 'Dela Cruz', 'Gonzales', 'Aquino', 'Lopez', 'Santiago', 'Martinez', 'Castillo', 'Perez'
];

// Array of Filipino names
$filipino_names = [
    'Juan', 'Maria', 'Pedro', 'Luz', 'Jose', 'Anna', 'Ramon', 'Carmen', 'Manuel', 'Sofia', 'Luis', 'Angela', 'Antonio', 'Teresa', 'Francisco', 'Nenita', 'Carlos', 'Gloria', 'Miguel', 'Elena'
];

// Function to generate random date of birth
function random_dob($start_date, $end_date) {
    $start_timestamp = strtotime($start_date);
    $end_timestamp = strtotime($end_date);
    $random_timestamp = mt_rand($start_timestamp, $end_timestamp);
    return date("Y-m-d", $random_timestamp);
}

// Function to generate random age from date of birth
function calculate_age($dob) {
    $dob_timestamp = strtotime($dob);
    $now_timestamp = time();
    $age_seconds = $now_timestamp - $dob_timestamp;
    $age_years = floor($age_seconds / (365 * 24 * 60 * 60));
    return $age_years;
}

// Function to generate random Filipino name
function random_filipino_name($filipino_names) {
    return $filipino_names[array_rand($filipino_names)];
}

// Function to generate random Filipino surname
function random_filipino_surname($filipino_surnames) {
    return $filipino_surnames[array_rand($filipino_surnames)];
}

// Function to generate random address
function random_address($addresses) {
    return $addresses[array_rand($addresses)];
}

// Function to generate random records
function generate_random_record($conn, $addresses, $filipino_names, $filipino_surnames, $id) {
    // Random values for fields
    $address = random_address($addresses);
    $nationality = "Filipino";
    $date_of_birth = random_dob('1970-01-01', '2010-01-01');
    $age = calculate_age($date_of_birth);
    $religions = ['Christianity', 'Catholicism', 'Islam', 'Hinduism', 'Buddhism', 'Judaism', 'Others'];
    $religion = $religions[array_rand($religions)];
    $mothers_name = random_filipino_name($filipino_names) . ' ' . random_filipino_surname($filipino_surnames);
    $fathers_name = random_filipino_name($filipino_names) . ' ' . random_filipino_surname($filipino_surnames);
    $respiratory_rate = round(mt_rand(1000, 3000) / 100, 2);
    $temperature = round(mt_rand(350, 400) / 10, 2);
    $heart_rate = mt_rand(600, 1000) / 10;
    $blood_pressure = mt_rand(90, 140) . "/" . mt_rand(60, 90);

    // Update record with provided ID
    $update_query = "UPDATE patient_records SET nationality = '$nationality', address = '$address', date_of_birth = '$date_of_birth', age = $age, religion = '$religion', mothers_name = '$mothers_name', fathers_name = '$fathers_name', RespiratoryRate = $respiratory_rate, Temperature = $temperature, HeartRate = $heart_rate, BloodPressure = '$blood_pressure' WHERE id = $id";
    if (mysqli_query($conn, $update_query)) {
        echo "Record with ID $id updated successfully<br>";
    } else {
        echo "Error updating record with ID $id: " . mysqli_error($conn);
    }
}

// Update records with IDs from 1 to 629
for ($id = 1; $id <= 629; $id++) {
    generate_random_record($conn, $addresses, $filipino_names, $filipino_surnames, $id);
}

// Close the connection
mysqli_close($conn);
?>
