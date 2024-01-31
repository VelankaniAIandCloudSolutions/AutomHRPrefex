<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">


<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <?php if (has_permission('entity_transfer', '', 'list')) { ?>
                    <div class="tw-mb-2 sm:tw-mb-4">
                        <a href="<?php echo admin_url('entity_transfer/add'); ?>" class="btn btn-primary">
                            <i class="fa-regular fa-plus tw-mr-1"></i>
                            <?php echo _l('movement_form'); ?>
                        </a>
                    </div>
                <?php } ?>
                <div class="panel_s">
                    <div class="panel-body panel-table-full" style="overflow-x: auto; width:100%">
                        <table id="entity_transfer" class="display responsive entity_transfer" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Entity Status</th>
                                    <th>Staff Name</th>
                                    <th>Type Change</th>
                                    <th>Department Name</th>
                                    <th>Designation Name</th>
                                    <th>Manager Name</th>
                                    <th>Effective Date</th>
                                    <th>Previous Employee Code</th>
                                    <th>Current Employee Code</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php init_tail(); ?>

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        entity_transfer_data();
    });

    function entity_transfer_data() {
        var table = $('#entity_transfer').DataTable({
            ordering: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "<?php echo admin_url('entity_transfer/list'); ?>",
                type: "POST"
            },
            columns: [{
                    data: 's_no'
                },
                {
                    data: 'status'
                },
                {
                    data: 'staff_name'
                },
                {
                    data: 'type_change'
                },
                {
                    data: 'department_name'
                },
                {
                    data: 'position_name'
                },
                {
                    data: 'manager_name'
                },
                {
                    data: 'effective_date'
                },
                {
                    data: 'previous_emp_code'
                },
                {
                    data: 'new_emp_code'
                },
                {
                    data: 'delete'
                }
            ]
        });
    }

    function entity_delete(id = '') {
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/entity_delete/'); ?>' + id,
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }

    function entity_transfer_confirm(id = '') {
        $.ajax({
            type: 'POST',
            url: '<?php echo admin_url('entity_transfer/entity_transfer_confirm/'); ?>' + id,
            data: {
                id: id
            },
            dataType: 'json',
            success: function(response) {
                if (response == 1) {
                    location.reload();
                }
            },
            error: function(error) {
                console.error('Error:', error);
            }
        });
    }
</script>

</body>

</html>