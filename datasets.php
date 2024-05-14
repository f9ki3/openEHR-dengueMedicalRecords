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

// Function to generate random 11-digit numbers starting at '09'
function random_contact() {
    return '09' . str_pad(mt_rand(0, 999999999), 9, '0', STR_PAD_LEFT);
}

// Function to generate email address based on first name
function generate_email($first_name) {
    return strtolower($first_name) . "@gmail.com";
}

// Function to generate random records
function generate_random_record($conn, $addresses, $filipino_names, $filipino_surnames, $id) {
    // Random values for fields
    $address = random_address($addresses);
    $nationality = "Filipino";
    $date_of_birth = random_dob('1970-01-01', '2010-01-01');
    $age = calculate_age($date_of_birth);
    $religions = ['Roman Catholic', 'Christianity', 'Islam'];
    $religion = $religions[array_rand($religions)];
    $mothers_name = random_filipino_name($filipino_names) . ' ' . random_filipino_surname($filipino_surnames);
    $fathers_name = random_filipino_name($filipino_names) . ' ' . random_filipino_surname($filipino_surnames);
    $temperature = round(mt_rand(350, 400) / 10, 2);
    $contact = random_contact();

    // Generate a random Filipino name and email address
    $first_name = random_filipino_name($filipino_names);
    $email = generate_email($first_name);

    // Retrieve diagnosis for the current record
    $diagnosis_query = "SELECT Diagnosis FROM patient_records WHERE id = $id";
    $diagnosis_result = mysqli_query($conn, $diagnosis_query);
    $diagnosis_row = mysqli_fetch_assoc($diagnosis_result);
    $diagnosis = $diagnosis_row['Diagnosis'];

    // Determine Status and set RespiratoryRate and BloodPressure accordingly
    if (in_array($diagnosis, ["Tuberculosis", "Pulmonary issues", "Pneumonia"])) {
        $status = (mt_rand(0, 1) === 0) ? 'Negative' : 'Positive';
        $respiratory_rate = $status === 'Negative' ? mt_rand(16, 20) : mt_rand(16, 23);
    } else {
        $status = 'Negative';
        $respiratory_rate = round(mt_rand(1600, 2300) / 100, 2);
    }

    if ($diagnosis === "Hypertension") {
        $blood_pressures = ["140/110", "130/90", "150/80", "160/100"];
    } else {
        $blood_pressures = ["120/80", "110/80", "110/70", "120/70"];
    }
    $blood_pressure = $blood_pressures[array_rand($blood_pressures)];

    // Set pulserate
    $pulserate = mt_rand(60, 100);

    // Update record with provided ID
    $update_query = "UPDATE patient_records SET nationality = '$nationality', address = '$address', date_of_birth = '$date_of_birth', age = $age, religion = '$religion', mothers_name = '$mothers_name', fathers_name = '$fathers_name', RespiratoryRate = $respiratory_rate, Temperature = $temperature, HeartRate = $pulserate, BloodPressure = '$blood_pressure', contact = '$contact', email = '$email', Status = '$status' WHERE id = $id";
    
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
