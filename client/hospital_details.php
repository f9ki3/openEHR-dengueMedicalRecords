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
                    FROM hospital
                    WHERE id = ?";
            $stmt = $conn->prepare($sql);

            if ($stmt) {
                $stmt->bind_param("i", $id);
                $stmt->execute();

                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    // Fetch the first row only (assuming one row per $id)
                    $row = $result->fetch_assoc();
                    $hospital_name = $row['hospital_name'];
                    $address = $row['address'];


                    // Use the fetched values as needed
                    // Example: echo $id, $date, $area, $lot_owner;

                } else {
                    // No rows found based on the provided $id
                    // Handle the case where no matching records are found
                    $hospital_name = "N/A";
                    $address = "N/A";
 
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
    <div class="d-flex flex-row justify-content-between">
    <h4><?php echo $hospital_name?></h4>
    <div>
        <button id="view_record" class="btn btn-primary btn-sm me-3"> View Record</button>
        <button id="add_hospital" class="btn btn-primary btn-sm">+ Add Record</button>
    </div>
    </div>
    <div id="view_record_div">
        <table class="table table-hover">
            <thead>
                <tr>
                    <td style="font-size: 12px">Patient ID</td>
                    <td style="font-size: 12px">Patient Name</td>
                    <td style="font-size: 12px">Sex</td>
                    <td style="font-size: 12px">Age</td>
                    <td style="font-size: 12px">Height</td>
                    <td style="font-size: 12px">Weight</td>
                    <td style="font-size: 12px">Date of Diagnosis</td>
                    <td style="font-size: 12px">Symptoms</td>
                    <td style="font-size: 12px">Diagnosis</td>
                    <td style="font-size: 12px">Treatment</td>
                    <td style="font-size: 12px">Status</td>
                    <td style="font-size: 12px">Hospital</td>
                </tr>
            </thead>
            <tbody id="list">

            </tbody>
        </table>
    </div>
    <div id="add_hospital_div" style="display: none" class="border rounded p-3 pb-5">
        <h5>Add Patient Record</h5>
        <hr>
        <div class="d-flex flex-rowalign-items-center">
            <div style="width: 49%">
                <p>Patient Name</p>
                <input id="patient" type="text" class="form-control" placeholder="Enter Patient Name">
            </div>
            <div style="width: 49%" class="pl-3">
                <p>Date</p>
                <input id="date" type="date" class="form-control" placeholder="Enter Hospital Name">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Sex</p>
                <select id="sex" class="form-control" name="" id="">
                    <option value="">Male</option>
                    <option  value="">Female</option>
                </select>
            </div>
            <div style="width: 49%" class="pl-3">
                <p>Age</p>
                <input id="age" type="text" class="form-control" placeholder="Enter age">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Height</p>
                <input id="height" type="text" class="form-control" placeholder="Enter height">
            </div>
            <div style="width: 49%" class="pl-3">
                <p>Weight</p>
                <input id="weight" type="text" class="form-control" placeholder="Enter weight">
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Symptoms</p>
                <textarea name="" id="symptoms" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
            <div style="width: 49%" class="ml-3">
                <p>Diagnosis</p>
                <textarea name="" id="diagnosis" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
        </div>
        <div class="d-flex flex-rowalign-items-center mt-3">
            <div style="width: 49%">
                <p>Treatment</p>
                <textarea name="" id="treatment" style="width: 100%" class="border border-muted rounded" cols="30" rows="5"></textarea>
            </div>
            <div style="width: 49%" class="ml-3">
                <p>Status</p>
                <select id="status" class="form-control" name="" id="">
                    <option value="Positive">Positive</option>
                    <option  value="Negative">Negative</option>
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
<script>
    $(document).ready(function() {
        var id = <?php echo $id; ?>;
        $.ajax({
            url: '../php_backend/fetch_details.php',
            dataType: 'json',
            data: { id: id }, // Enclose key-value pair in curly braces
            success: function (data) {
                // Loop through each hospital in the data
                $.each(data.data, function (index, hospital) { // Accessing 'data' property to get the actual data
                    // Create a new HTML element for each hospital
                    var hospitalHTML = `
                        <tr class="clickable-id" data-id="${hospital.id}">
                            <td style="font-size: 12px">${hospital.id}</td>
                            <td style="font-size: 12px">${hospital.PatientName}</td>
                            <td style="font-size: 12px">${hospital.Sex}</td>
                            <td style="font-size: 12px">${hospital.Age}</td>
                            <td style="font-size: 12px">${hospital.Height}</td>
                            <td style="font-size: 12px">${hospital.Weight}</td>
                            <td style="font-size: 12px">${hospital.DateOfDiagnosis}</td>
                            <td style="font-size: 12px">${hospital.Symptoms}</td>
                            <td style="font-size: 12px">${hospital.Diagnosis}</td>
                            <td style="font-size: 12px">${hospital.Treatment}</td>
                            <td style="font-size: 12px">${hospital.Status}</td>
                            <td style="font-size: 12px">${hospital.hospital_name}</td>
                        </tr>`;
                    // Append the HTML element to the #list element
                    $('#list').append(hospitalHTML);
                });

                // Add click event listener to clickable IDs
                $('.clickable-id').click(function () {
                    var id = $(this).data('id');
                    window.location.href = 'add_record?id=' + id; // Replace 'your_link_here' with your actual link
                });
            },
            error: function (xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            }
        });


        $('#add_hospital').click(function() {
            $('#add_hospital_div').css('display', 'block');
            $('#view_record_div').css('display', 'none');
        });
        $('#cancel_add_hospital_div').click(function() {
            $('#add_hospital_div').css('display', 'none');
            $('#view_record_div').css('display', 'block');
        });
        $('#view_record').click(function() {
            $('#add_hospital_div').css('display', 'none');
            $('#view_record_div').css('display', 'block');
        });
        $('#save_add_hospital').click(function() {
            var patient = $('#patient').val();
            var date = $('#date').val();
            var sex = $('#sex').val();
            var age = $('#age').val();
            var height = $('#height').val();
            var weight = $('#weight').val();
            var symptoms = $('#symptoms').val();
            var diagnosis = $('#diagnosis').val();
            var treatment = $('#treatment').val();
            var status = $('#status').val();
            var id = <?PHP echo $id?>;


            var formData = new FormData();
            formData.append('patient', patient);
            formData.append('date', date);
            formData.append('sex', sex);
            formData.append('age', age);
            formData.append('height', height);
            formData.append('weight', weight);
            formData.append('symptoms', symptoms);
            formData.append('diagnosis', diagnosis);
            formData.append('treatment', treatment);
            formData.append('status', status);
            formData.append('id', id);
            

            console.log(formData);

            $.ajax({
                url: '../php_backend/add_record.php',
                type: 'POST',
                data: formData,
                processData: false, // Don't process the data
                contentType: false, // Don't set contentType
                success: function(response) {
                    // Handle successful response
                    console.log(response);
                    alertify.set('notifier', 'position', 'bottom-left');
                    alertify.success('Submitted Success');
                    $('#add_hospital_div').css('display', 'none');
                    $('#view_record_div').css('display', 'block');

                    // Clear input fields
                    $('#patient').val('');
                    $('#date').val('');
                    $('#sex').val('');
                    $('#age').val('');
                    $('#height').val('');
                    $('#weight').val('');
                    $('#symptoms').val('');
                    $('#diagnosis').val('');
                    $('#treatment').val('');
                    $('#status').val('');
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error(xhr.responseText);
                }
        });
});

    });
</script>
