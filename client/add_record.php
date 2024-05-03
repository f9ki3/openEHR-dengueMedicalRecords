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
                    $PatientName = $row['PatientName'];
                    $Age = $row['Age'];
                    $Height = $row['Height'];
                    $Weight = $row['Weight'];
                    $DateOfDiagnosis = $row['DateOfDiagnosis'];
                    $Symptoms = $row['Symptoms'];
                    $Diagnosis = $row['Diagnosis'];
                    $Treatment = $row['Treatment'];
                    $Status = $row['Status'];


                    // Use the fetched values as needed
                    // Example: echo $id, $date, $area, $lot_owner;

                } else {
                    // No rows found based on the provided $id
                    // Handle the case where no matching records are found
                    $row = $result->fetch_assoc();
                    $PatientName = "N/A";
                    $Sex = "N/A";
                    $PatientName = "N/A";
                    $Age = "N/A";
                    $Height = "N/A";
                    $Weight = "N/A";
                    $DateOfDiagnosis = "N/A";
                    $Symptoms = "N/A";
                    $Diagnosis = "N/A";
                    $Treatment = "N/A";
                    $Status = "N/A";
 
                }
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
    
    <div id="add_hospital_div" class="border rounded p-3 pb-5">
        <h5>Add Patient Record</h5>
        <hr>
        <div class="d-flex flex-rowalign-items-center">
            <div style="width: 49%">
                <p>Patient Name</p>
                <input value="<?php echo $PatientName?>" id="patient" type="text" class="form-control" placeholder="Enter Patient Name">
            </div>
            <div style="width: 49%" class="pl-3">
                <p>Date</p>
                <input value="<?php echo $DateOfDiagnosis?>" id="date" type="date" class="form-control" placeholder="Enter Hospital Name">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Sex</p>
                <select id="sex" class="form-control" name="sex">
                    <option value="M" <?php if ($Sex == "M") echo 'selected="selected"'; ?>>Male</option>
                    <option value="F" <?php if ($Sex == "F") echo 'selected="selected"'; ?>>Female</option>
                </select>

            </div>
            <div style="width: 49%" class="pl-3">
                <p>Age</p>
                <input value="<?php echo $Age?>" id="age" type="text" class="form-control" placeholder="Enter age">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Height</p>
                <input value="<?php echo $Height?>" id="height" type="text" class="form-control" placeholder="Enter height">
            </div>
            <div style="width: 49%" class="pl-3">
                <p>Weight</p>
                <input value="<?php echo $Weight?>" id="weight" type="text" class="form-control" placeholder="Enter weight">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Symptoms</p>
                <textarea placeholder="<?php echo $Symptoms?>" name="" id="symptoms" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
            <div style="width: 49%" class="ml-3">
                <p>Diagnosis</p>
                <textarea placeholder='<?php echo $Diagnosis?>' name="" id="diagnosis" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Treatment</p>
                <textarea placeholder='<?php echo $Treatment?>' name="" id="treatment" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
            <div style="width: 49%" class="ml-3">
                <p>Status</p>
                <select id="status" class="form-control" name="status">
                    <option value="Positive" <?php if ($Status == "Positive") echo 'selected="selected"'; ?>>Positive</option>
                    <option value="Negative" <?php if ($Status == "Negative") echo 'selected="selected"'; ?>>Negative</option>
                </select>
            </div>
        </div>
        
        <div class="d-flex flex-row mt-3 justify-content-end">
        <button class="btn btn-primary mr-2 btn-sm" id="save_add_hospital">Save</button>
        <button class="btn btn-danger btn-sm" id="cancel_add_hospital_div">Cancel</button>
        </div>
    </div>
</div>
    
</body>
</html>
