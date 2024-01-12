<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>

<style>
    .file_upload{
        min-height: 50px;
        border: 2px solid rgba(0,0,0,.3);
        background: #fff;
        padding: 20px 20px;
    }
</style>
<?php echo form_open_multipart(admin_url('projects/attendance_files/' . $project->id), ['id' => 'attendance-files-upload']); ?>


<div class="row">
    <div class="col-md-6">
        <div class="form-group" app-field-wrapper="startdate">
            <label for="startdate" class="control-label"> <small class="req text-danger">* </small><?php echo _l("attendance_start_date");?></label>
            <div class="input-group date">
                <input type="text" id="startdate" name="startdate" class="form-control datepicker required"  autocomplete="off" required />
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group" app-field-wrapper="duedate">
            <label for="duedate" class="control-label"><small class="req text-danger">* </small><?php echo _l("attendance_end_date");?></label>
            <div class="input-group date">
                <input type="text" id="duedate" name="enddate" class="form-control datepicker required" autocomplete="off" required />
                <div class="input-group-addon">
                    <i class="fa-regular fa-calendar calendar-icon"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
    <label for="duedate" class="control-label"><small class="req text-danger">* </small><?php echo _l("attendance_files");?></label>
        <input type="file" name="file" class="file_upload dz-clickable" required />
    </div>
    <div id="dropbox-chooser"></div>
</div>
<div class="clearfix"></div>
<div class="mtop20"></div>
<div class="row">
    <div class="col-md-12">
        <input type="submit" name="save_attendance" class="btn btn-primary" value="<?php echo _l('save');?>">
    </div>
</div>

<?php echo form_close(); ?>
<div class="clearfix"></div>