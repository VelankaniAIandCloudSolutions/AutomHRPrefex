<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <?php echo form_open_multipart($this->uri->uri_string(), ['class' => 'movement-form', 'autocomplete' => 'off']); ?>
        <div class="panel_s">
            <div class="panel-body ">
                <div class="form-group">
                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('staff_members'); ?></label>
                                <small class='req text-danger'>*</small><select name="staff_members" id="staff_members" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>" onchange="staff_info(); return false;">
                                    <option value=""><?php echo _l('staff_members'); ?></option>
                                    <?php foreach ($staff_list as $staff_val) {
                                    ?>
                                        <option value="<?php echo $staff_val['staffid']; ?>">
                                            <?php echo ucfirst($staff_val['firstname'] . ' ' . $staff_val['middlename'] . '' . $staff_val['lastname']); ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group ">
                                <label class="control-label"><?php echo _l('branch'); ?></label>
                                <small class='req text-danger'>*</small><select name="branch_id" onchange="get_location(); return false;" id="branch_id" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('branches'); ?></option>
                                    <?php foreach ($branch_list as $branch_val) {
                                    ?>
                                        <option value="<?php echo $branch_val['id']; ?>">
                                            <?php echo ucfirst($branch_val['branch_name']); ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('prefix'); ?></label>
                                <small class='req text-danger'>*</small><input type='text' name='prefix' id='prefix' class="form-control" readonly />
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('new_employee_id'); ?></label>
                                <small class='req text-danger'>*</small><input type='text' name='new_employee_id' id='new_employee_id' class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('type_of_change'); ?></label>
                                <small class='req text-danger'>*</small><select name="type_of_change" id="type_of_change" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('type_of_change'); ?></option>
                                    <option value="1"><?php echo _l("internal_trasnfer"); ?></option>
                                    <option value="2"><?php echo _l("external_trasnfer"); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('department'); ?></label>
                                <small class='req text-danger'>*</small><select name="department" id="department" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('department'); ?></option>
                                    <?php
                                    if (!empty($departments)) {
                                        foreach ($departments as $departments_val) { ?>
                                            <option value="<?php echo $departments_val['departmentid']; ?>"><?php echo $departments_val['name']; ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('job_position'); ?></label>
                                <small class='req text-danger'>*</small><select name="job_position" id="job_position" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('job_position'); ?></option>
                                    <?php
                                    if (!empty($get_job_position)) {
                                        foreach ($get_job_position as $get_job_position_val) { ?>
                                            <option value="<?php echo $get_job_position_val['position_id']; ?>"><?php echo $get_job_position_val['position_name']; ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('reporting_to'); ?></label>
                                <small class='req text-danger'>*</small><select name="reporting_to" id="reporting_to" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('reporting_to'); ?></option>
                                    <?php foreach ($staff_list as $staff_val) {
                                    ?>
                                        <option value="<?php echo $staff_val['staffid']; ?>">
                                            <?php echo ucfirst($staff_val['firstname'] . ' ' . $staff_val['middlename'] . '' . $staff_val['lastname']); ?></option>
                                    <?php
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('effective_date'); ?></label>
                                <small class='req text-danger'>*</small><input type='text' name='effective_date' id='effective_date ' class="form-control datepicker" autocomplete="off" />
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('location'); ?></label>
                                <small class='req text-danger'>*</small><input type='text' name='location' id='location ' class="form-control location" readonly autocomplete="off" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('business_unit'); ?></label>
                                <small class='req text-danger'>*</small><select name="business_unit" id="business_unit" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('business_unit'); ?></option>
                                    <option value="1"><?php echo _l("manufacturing"); ?></option>
                                    <option value="2"><?php echo _l("precast"); ?></option>
                                    <option value="3"><?php echo _l("tower_building"); ?></option>
                                </select>
                            </div>
                        </div>

                        <div class='col-md-6'>
                            <div class="form-group">
                                <label class="control-label"><?php echo _l('division'); ?></label>
                                <small class='req text-danger'>*</small><select name="division" id="division" class="form-control" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('division'); ?></option>
                                    <option value="1"><?php echo _l("manufacturing"); ?></option>
                                    <option value="2"><?php echo _l("precast"); ?></option>
                                    <option value="3"><?php echo _l("tower_building"); ?></option>
                                </select>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
        <div class="btn-bottom-toolbar text-right">
            <button type="submit" class="btn btn-primary"><?php echo _l('submit'); ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php init_tail(); ?>
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
                // console.log(response);
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
                
                console.log(response);

                if(response != '')
                {
                    $('#department').val(response.departmentid);
                }
            },
            error: function(error) {
                // Handle errors
                console.error('Error:', error);
            }
        });
    }
</script>

</body>

</html>