<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<?php init_head(); ?>

<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <table id="resumesTable" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Candidate Code</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Skills</th>
                                        <th>Resume</th>
                                        <th>Save</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php 
                                    if(count($import_resume) > 0)
                                    {
                                        $j=0;
                                        foreach($import_resume as $import_resume)
                                        {
                                            $j++;
                                            ?>
                                            <tr>
                                                <td><?php echo $j;?></td>
                                                <td contenteditable="true"><?php echo $import_resume["name"];?></td>
                                                <td contenteditable="true"></td>
                                                <td contenteditable="true"><?php echo $import_resume["email"];?></td>
                                                <td contenteditable="true"><?php echo $import_resume["mobile_number"];?></td>
                                                <td contenteditable="true"><?php echo $import_resume["skills"];?></td>
                                                <td ><a href='<?php echo $import_resume["get_resume"];?>' target ='_blank'><?php echo _l('resume_downlaod');?></a></td>
                                                <td ><button class="save-row btn btn-primary" id="saveButton_<?php echo $j; ?>">Save</button></td>
                                                <td ><button class="delete-row btn btn-danger" id="deleteButton_<?php echo $j; ?>">Delete</button></td>
                                                
                                            </tr>
                                        <?php }
                                    }
                                    else{?>
                                            <tr>
                                                <td colspan="8"><?php echo _l("no_data_found");?></td>
                                            </tr>
                                    <?php }
                                    ?>
                                    
                                </tbody>
                            </table>
                            <div class="submit-section">
                                <a id='saveButton' class="btn btn-primary submit-btn btn-md">Save</a>
                                <a href="<?php echo admin_url('recruitment/candidate_profile'); ?>" class="btn btn-danger submit-btn btn-md"><?php echo lang('cancel');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<script src="<?php echo base_url('assets/plugins/jquery-validation/additional-methods.min.js'); ?>"></script>


<script>
    $(document).ready(function() {
        
        //  Delete resume row form table.
        
        $('[id^="deleteButton_"]').on('click',function() {
            var rowId = $(this).attr('id').split('_')[1]; 
            var $row = $(this).closest('tr');
            var confirmed = confirm('Are you sure you want to delete this row?');
            if (confirmed) {
                row.remove();
            }
        });


        // Save row resumes

        $('[id^="saveButton_"]').on('click',function() {
            editedData = []
            var rowId = $(this).attr('id').split('_')[1]; 
            var row = $(this).closest('tr');
            var rowData = {};
            row.find('td').each(function(cellIndex) {
               
                var columnName = $('#resumesTable thead th').eq(cellIndex).text();
                var cellContent = $(this).text();

                if (columnName === "Save" || columnName === "Delete") {
                        
                }
                else if (columnName === 'Resume') {
                    cellContent = $(this).find('a').attr('href');
                    rowData[columnName] = cellContent;
                }
                else {
                    rowData[columnName] = cellContent;
                }
            });

            if (rowData['Name'] === '' || rowData['Candidate Code'] === '' || rowData['Email'] === '' || rowData['Mobile'] === '' || rowData['Skills'] === '') {
                alert('Please fill in all the required fields of row number: ' + rowData['S.No.']);
                return; 
            }

            editedData.push(rowData);
            var $saveButton = $(this);
            var $deleteButton = row.find('.delete-row');
            $.ajax({
                url: '<?php echo admin_url("recruitment/save_parsed_resumes")?>',
                type: 'POST',
                data: { editedData: editedData },
                success: function(response) {
                    console.log(response);
                    var json_obj = JSON.parse(response);
                    if(json_obj.status === "1")
                    {
                       window.location.href = "<?php echo admin_url('recruitment/candidate_profile');?>";
                    }
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });
</script>

</body>

</html>
