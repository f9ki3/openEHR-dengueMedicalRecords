<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cobo Labs</title>
    <?php 
    include 'header_links.php';
    include '../config/config.php';
    $id = $_GET['id'];

            $sql = "SELECT *
                    FROM patient_records
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Fetch the first row only (assuming one row per $id)
                    $row = $result->fetch_assoc();
                    $PatientName = $row['PatientName'];
                    $Sex = $row['Sex'];
                    $Age = $row['age'];
                    $Height = $row['Height'];
                    $Weight = $row['Weight'];
                    $DateOfDiagnosis = $row['DateOfDiagnosis'];
                    $Symptoms = $row['Symptoms'];
                    $Diagnosis = $row['Diagnosis'];
                    $Treatment = $row['Treatment'];
                    $Status = $row['Status'];
                    $Nationality = $row['Nationality'];
                    $Date_of_birth = $row['date_of_birth'];
                    $address = $row['address'];
                    $religion = $row['religion'];
                    $contact = $row['contact'];
                    $email = $row['email'];
                    $m_name = $row['mothers_name'];
                    $f_name = $row['fathers_name'];
                    $r_rate = $row['RespiratoryRate'];
                    $temp = $row['Temperature'];
                    $h_rate = $row['HeartRate'];
                    $b_press = $row['BloodPressure'];
                    $m_name = $row['mothers_name'];
                    $m_name = $row['mothers_name'];


                    // Use the fetched values as needed
                    // Example: echo $id, $date, $area, $lot_owner;

                } 
                // else {
                //     // No rows found based on the provided $id
                //     // Handle the case where no matching records are found
                //     $row = $result->fetch_assoc();
                //     $PatientName = "N/A";
                //     $Sex = "N/A";
                //     $PatientName = "N/A";
                //     $Age = "N/A";
                //     $Height = "N/A";
                //     $Weight = "N/A";
                //     $DateOfDiagnosis = "N/A";
                //     $Symptoms = "N/A";
                //     $Diagnosis = "N/A";
                //     $Treatment = "N/A";
                //     $Status = "N/A";
 
                // }
            } else {
                echo "Error in preparing SQL statement: " . $conn->error;
            }

            // Close the prepared statement
            $stmt->close();
            ?>
    

</head>
<body>
<?php include 'navbar.php'; ?>
<div class='container pt-3'>
    <div class="d-flex flex-row justify-content-between mb-3">
    <h4></h4>
    <div>
        <button id="view_record" class="btn btn-primary btn-sm me-3"> View Record</button>
        <button id="add_hospital" class="btn btn-primary btn-sm">+ Add Record</button>
    </div>
    </div>
    
    <div id="add_hospital_div" class="border rounded pb-5">

        <div class="border-bottom p-3">
            <h3>Patient Information</h3>
        </div>
        <div class="d-flex ">
            <div class="border-bottom p-3 w-50">
            <h5 >Personal Information</h5>
            <hr>
                <p class="m-0 p-0 pb-2">Patient Name: <?php echo $PatientName?></p>
                <p class="m-0 p-0 pb-2">Birth Date: <?php echo $Date_of_birth?></p>
                <p class="m-0 p-0 pb-2">Height: <?php echo $Height?>cm</p>
                <p class="m-0 p-0 pb-2">Contact No: <?php echo $contact?></p>
                <p class="m-0 p-0 pb-2">Address: <?php echo $address?></p>
            </div>
            <div class="border-bottom p-3 w-50">
                <p class="m-0 p-0 pt-1 pb-2 mt-5">Sex: <?php echo $Sex?></p>
                <p class="m-0 p-0 pb-2">Age: <?php echo $Date_of_birth?></p>
                <p class="m-0 p-0 pb-2">Weight: <?php echo $Weight?>kg</p>
                <p class="m-0 p-0 pb-2">Email Address: <?php echo $email?></p>
            </div>
        </div>
        <div class="d-flex ">
            <div class="border-bottom p-3 w-50">
                <h5>Other Information</h5>
                <hr>
                <p class="m-0 p-0 pb-2">Nationality: <?php echo $Nationality?></p>
                <p class="m-0 p-0 pb-2">Religion: <?php echo $religion?></p>
                <p class="m-0 p-0 pb-2">Mothers Name: <?php echo $m_name?></p>
                <p class="m-0 p-0 pb-2">Fathers Name: <?php echo $f_name?></p>
            </div>
            <div class="border-bottom p-3 w-50">
                <h5>Vital Signs</h5>
                <hr>
                <p class="m-0 p-0 pb-2">Respiratory Rate: <?php echo $r_rate?></p>
                <p class="m-0 p-0 pb-2">Temparature: <?php echo $temp?></p>
                <p class="m-0 p-0 pb-2">Heart Rate: <?php echo $h_rate?></p>
                <p class="m-0 p-0 pb-2">Blood Pressure: <?php echo $b_press?></p>
            </div>
        </div>
        <div class="d-flex ">
            <div class="border-bottom p-3 w-100">
                <h5>Diagnosis Report</h5>
                <hr>
                <p class="m-0 p-0 pb-2">Date of Diagnosis: <?php echo $DateOfDiagnosis?></p>
                <p class="m-0 p-0 pb-2">Symptoms: <?php echo $Symptoms?></p>
                <p class="m-0 p-0 pb-2">Diagnosis: <?php echo $Diagnosis?></p>
                <p class="m-0 p-0 pb-2">Status: <?php echo $Status?></p>
                <p class="m-0 p-0 pb-2">Treatment: <?php echo $Treatment?></p>
            </div>
        </div>
    </div>
</div>
    
</body>
</html>
