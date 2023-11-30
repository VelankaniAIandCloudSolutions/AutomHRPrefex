<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class='col-md-12'>
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-3">
                        <label><?php echo _l('filter');?></label>
                            <select name="status" data-width="100%" id="status" class="selectpicker">
                                <option value=''> <?php echo _l('all');?></option>
                                <option value='0'> <?php echo _l('pending');?></option>
                                <option value='2'> <?php echo _l('rejected');?></option>
                                <option value='1'> <?php echo _l('approved');?></option>
                            </select>
                        </div>
                        
                        <div class="col-md-3">
                        <label><?php echo _l('timesheet_start_date');?></label>
                            <?php echo render_date_input('startdate'); ?>
                        </div>
                        <div class="col-md-3">
                            <label><?php echo _l('timesheet_to_date');?></label>
                            <?php echo render_date_input('enddate'); ?>
                        </div>
                        <div class="col-md-3">
                        <label><?php echo _l('client');?></label>
                            <select id="clientid" name="timesheet_clientid" data-live-search="true" data-width="100%"
                                class="ajax-search" data-empty-title="<?php echo _l('client'); ?>"
                                data-none-selected-text="<?php echo _l('client'); ?>">
                            </select>
                        </div>
                        <hr />
                        <div class="clearfix"></div>

                        <div class="col-md-3">
                            <label><?php echo _l('project');?></label>
                            <div id="project_ajax_search_wrapper">
                                <select data-empty-title="<?php echo _l('project'); ?>" multiple="true"
                                    name="project_id[]" id="project_id" class="projects ajax-search"
                                    data-live-search="true" data-width="100%">
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                        <label><?php echo _l('all_staff_members');?></label>
                            <select name="timesheet_staff_id" id="timesheet_staff_id" class="selectpicker" data-width="100%">
                                <option value=""><?php echo _l('all_staff_members'); ?></option>
                                <?php foreach ($stafflist as $staff) { ?>
                                <option value="<?php echo $staff['staffid']; ?>">
                                    <?php echo get_staff_full_name($staff['staffid']); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        
                        

                        <div class="col-md-3" style='margin-top:20px;'>
                            <a href="#" id="filter"
                                class="btn btn-primary pull-left" title="<?php echo _l('filter'); ?>"><?php echo _l('filter'); ?></a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
        <!-- end - Time sheet approval  -->
    </div>
</div>
<?php init_tail(); ?>
<script>
var staff_member_select = $('select[name="staff_id"]');
$(function() {

    init_ajax_projects_search();

    var timesheetsTable = $('.table-timesheets-report');
    $('#apply_filters_timesheets').on('click', function(e) {
        e.preventDefault();
        timesheetsTable.DataTable().ajax.reload();
    });

    init_ajax_project_search_by_customer_id();

    $('#clientid').on('change', function() {
        var projectAjax = $('select#project_id');
        var clonedProjectsAjaxSearchSelect = projectAjax.html('').clone();
        var projectsWrapper = $('.projects-wrapper');
        projectAjax.selectpicker('destroy').remove();
        projectAjax = clonedProjectsAjaxSearchSelect;
        $('#project_ajax_search_wrapper').append(clonedProjectsAjaxSearchSelect);
        init_ajax_project_search_by_customer_id();
    });
});

// Timesheet send for approval manager 

$("#filter").on("click", function(){
    var status = $("#status").val();
    var period_from = $("#startdate").val();
    var period_to = $("#enddate").val();
    var clientid = $("#clientid").val();
    var project_id = $("#project_id").val();
    var timesheet_staff_id = $("#timesheet_staff_id").val();
   
    $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/reports/timesheet_approval_list_data');?>",
        data: {status:status,timesheet_staff_id:timesheet_staff_id,period_from:period_from, period_to:period_to, project_id:project_id, clientid:clientid},
        success: function(response) {
             console.log(response);
        }
    });

});

</script>

</body>

</html>