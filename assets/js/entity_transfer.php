<script>
    $(function() {
        appValidateForm($('.movement-form'), {
            staff_members: 'required',
            branch_id: 'required',
            prefix: 'required',
            new_employee_id: 'required',
            type_of_change: 'required',
            department: 'required',
            job_position: 'required',
            reporting_to: 'required',
            effective_date: 'required',
            business_unit: 'required',
            division: 'required',
        });
    });

    function get_location() {
        var branch_id = $("#branch_id").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/branch_location'); ?>', // Replace with your server endpoint
            data: {
                branch_id: branch_id
            },
            dataType: 'json', // Expected data type from the server
            success: function(response) {
                $(".location").val(response.address);
                $("#prefix").val(response.branch_prefix);
                // Handle the response from the server
            },
            error: function(error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }

    function staff_info() {
        var staff_id = $("#staff_members").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/staff_info'); ?>', // Replace with your server endpoint
            data: {
                staff_id: staff_id
            },
            dataType: 'json', // Expected data type from the server
            success: function(response) {
                string_extract(response.staff_identifi);
                department(response.staffid);
                $('#branch_id').val(response.branch_id);

            },
            error: function(error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }

    function string_extract(str = '') {
        if (str != "") {
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('entity_transfer/digit_character_extract/'); ?>' + str, // Replace with your server endpoint
                data: {
                    str: str
                },
                dataType: 'json', // Expected data type from the server
                success: function(response) {
                    if (response != '') {
                        $("#prefix").val(response.character);
                        $("#new_employee_id").val(response.digits);
                    }

                },
                error: function(error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        }
    }

    function department(str = '') {
        // str is using for staff id
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/departments/'); ?>' + str, // Replace with your server endpoint
            data: {
                staff_id: str
            },
            dataType: 'json', // Expected data type from the server
            success: function(response) {
                if (response != '') {
                    $('#department').val(response.departmentid);
                    job_position(response.departmentid)
                }
            },
            error: function(error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }

    function job_position(department_id = '') {
        // str is using for staff id
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/job_position/'); ?>' + department_id,
            data: {
                department_id: department_id
            },
            dataType: 'json',
            success: function(response) {
                $('#job_position').empty();
                if (response !== null) {
                    $.each(response, function(index, item) {
                        $('#job_position').append($('<option>', {

                            value: item.id,
                            text: item.position_name
                        }));
                    });
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    $("#department").change(function() {
        let department_id = $(this).val();
        job_position(department_id);
    });

  
</script>