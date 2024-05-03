$(document).ready(function() {
    $.ajax({
            url: '../php_backend/fetch_hospitals.php',
            dataType: 'json',
            success: function(data){
                // Loop through each hospital in the data
                $.each(data.data, function(index, hospital){ // Accessing 'data' property to get the actual data
                    // Create a new HTML element for each hospital
                    var hospitalHTML = `
                        <div class="col-12 col-md-4 p-2">
                            <a href="hospital_details.php?id=${hospital.id}" style="text-decoration: none; color: black">
                                <div class="rounded border card_fyke p-3">
                                    <div style="width: 100%; height: 50%; border-radius: 100%">
                                        <img style="object-fit: cover; width: 100%; height: 100%;" class="rounded" src="../uploads/${hospital.image}" alt="">
                                    </div>
                                    <h5 class="mt-3">${hospital.hospital_name}</h5> <!-- Corrected property name -->
                                    <hr>
                                    <p>${hospital.address}</p>
                                </div>
                            </a>
                        </div>
                    `;
                    // Append the HTML element to the #list element
                    $('#list').append(hospitalHTML);
                });
            },
            error: function(xhr, status, error) {
                // Handle errors here
                console.error(xhr, status, error);
            }
        });
    
    
    $('#add_hospital').click(function() {
        $('#add_hospital_div').css('display', 'block')
        $('#view_record_div').css('display', 'none')
    });
    $('#cancel_add_hospital_div').click(function() {
        $('#add_hospital_div').css('display', 'none')
        $('#view_record_div').css('display', 'block')
    });
    $('#view_record').click(function() {
        $('#add_hospital_div').css('display', 'none')
        $('#view_record_div').css('display', 'block')
    });
    $('#save_add_hospital').click(function() {
        var h_name = $('#h_name').val();
        var h_address = $('#h_address').val();
        var h_image = $('#h_image')[0].files[0]; // Get the first selected file
    
        // Check if any of the required fields are empty
        if (h_name.trim() === '' || h_address.trim() === '' || !h_image) {
            alertify.set('notifier','position', 'bottom-left');
            alertify.error('Empty Fields!');
            return; // Prevent form submission
        }
    
        var formData = new FormData();
        formData.append('h_name', h_name);
        formData.append('h_address', h_address);
        formData.append('h_image', h_image);
    
        $.ajax({
            url: '../php_backend/add_hospital.php',
            type: 'POST',
            data: formData,
            processData: false, // Don't process the data
            contentType: false, // Don't set contentType
            success: function(response) {
                // Handle successful response
                console.log(response);
                alertify.set('notifier','position', 'bottom-left');
                alertify.success('Submitted Success');
                $('#add_hospital_div').css('display', 'none')
                $('#view_record_div').css('display', 'block')
    
                $('#h_name').val('');
                $('#h_address').val('');
                $('#h_image').val('');
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });
    
    
});

