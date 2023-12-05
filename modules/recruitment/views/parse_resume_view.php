<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<?php init_head(); ?>
<div id="wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
               
                <div class="panel_s">
                    <div class="panel-body">
                    <div class="row">
                            <div class="col-md-4">
                                <label><?php echo _l("resume_parse");?></label>
                                
                                <?php echo form_open_multipart(admin_url("recruitment/resume_submit"), ['id' => 'import_form']) ; ?>
                                <?php echo form_hidden('items_import', 'true'); ?>
                                <?php echo render_input('import_resume[]', 'file_upload', '', 'file',['multiple' => 'multiple']); ?>
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-primary import btn-import-submit"><?php echo _l('import'); ?></button>
                                </div>
                                <?php echo form_close(); ?>
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
$(function() {
    appValidateForm($('#import_form'), {
        'import_resume[]': {
            required: true,
            extension: "docx|rtf|doc|pdf"
        }
    });
});
</script>
</body>

</html>
