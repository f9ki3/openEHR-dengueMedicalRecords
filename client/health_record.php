<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cobo Labs</title>
    <?php 
    include 'header_links.php';
    ?>

</head>
<body>
<?php include 'navbar.php'; ?>
<div class='container pt-3'>
    <div class="d-flex flex-row justify-content-between">
    <h4>Region V Health Records</h4>
    <div>
        <button id="view_record" class="btn btn-primary btn-sm me-3"> View Record</button>
        <button id="add_hospital" class="btn btn-primary btn-sm">+ Add Hospital</button>
    </div>
    </div>
    <div id="view_record_div">
        <div id="list" class="row p-2">
        </div>
    </div>
    <div id="add_hospital_div" style="display: none" class="border rounded p-3 pb-5">
        <h5>Add Hospital</h5>
        <hr>
        <p>Hospital Name</p>
        <input id="h_name" type="text" class="form-control" placeholder="Enter Hospital Name">
        <p class="mt-3">Hospital Address</p>
        <input id="h_address" type="text" class="form-control" placeholder="Enter Hospital Address">
        <p class="mt-3">Hospital Image</p>
        <input id="h_image" type="file" >
        <div class="d-flex flex-row mt-3 justify-content-end">
        <button class="btn btn-primary mr-2 btn-sm" id="save_add_hospital">Save</button>
        <button class="btn btn-danger btn-sm" id="cancel_add_hospital_div">Cancel</button>
        </div>
    </div>
</div>
    
</body>
</html>
<script src="../javascript/health_record.js"></script>