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
                            <div class="form-group select-placeholder">
                                <label class="control-label"><?php echo _l('staff_members'); ?></label>
                                <small class='req text-danger'>*</small><select name="staff_members" data-live-search="true" id="staff_members" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
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
                            <div class="form-group select-placeholder">
                                <label class="control-label"><?php echo _l('branch'); ?></label>
                                <small class='req text-danger'>*</small><select name="branch_id" data-live-search="true" id="branch_id" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                    <option value=""><?php echo _l('branches'); ?></option>
                                    <?php print_R($branch_list); ?>
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
            prefix: 'required'
        });
    });
</script>

</body>

</html>