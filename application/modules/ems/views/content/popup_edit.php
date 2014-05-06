<script src="<?php echo $script_path; ?>" type="text/javascript"></script>

<?php echo form_open('admin/content/ems/popup_save'); ?>
    <input type="hidden" name="popup_id" value="<?php echo $popup_id; ?>">
    <fieldset>
        <?php if($popup_id == 0) : ?>
            <legend><?php echo lang('ems_new_popup'); ?></legend>
        <?php else : ?>
            <legend><?php echo lang('ems_edit_popup'); ?></legend>
        <?php endif; ?>
        <p><input type="text" placeholder="<?php echo lang('ems_popup_title'); ?>"></p>
        <p>
            <textarea class='ckeditor' id='popup_content' name='popup_content'><?php echo isset($popup->popup_content) ?  $popup->popup_content : ''; ?></textarea>
        </p>
    </fieldset>
    <input type="submit" value="Save" class="btn btn-danger">&nbsp;<input type="submit" value="Discard" class="btn btn-primary">
<?php echo form_close(); ?>