<script src="<?php echo $script_path; ?>" type="text/javascript"></script>

<?php if($validation_errors) : ?>
    <div class="alert alert-danger"><?php echo $validation_errors; ?></div>
<? endif; ?>

<?php echo form_open('admin/content/ems/abbreviation_save'); ?>
    <input type="hidden" name="abbreviation_id" value="<?php echo $abbreviation_id; ?>">
    <fieldset>
        <?php if($abbreviation_id == 0) : ?>
            <legend><?php echo lang('ems_new_abbreviation'); ?></legend>
        <?php else : ?>
            <legend><?php echo lang('ems_edit_abbreviation'); ?></legend>
        <?php endif; ?>
        <p><input type="text" placeholder="<?php echo lang('ems_abbreviation_title'); ?>" name="abbreviation" value="<?php echo isset($abbreviation->title) ?  $abbreviation->title : ''; ?>"></p>
        <p>
            <textarea class='ckeditor' id='content' name='content'><?php echo isset($abbreviation->content) ?  $abbreviation->content : ''; ?></textarea>
        </p>
    </fieldset>
    <input type="submit" name="submit" value="Save" class="btn btn-danger">&nbsp;<input type="submit" name="submit" value="Discard" class="btn btn-primary">
<?php echo form_close(); ?>