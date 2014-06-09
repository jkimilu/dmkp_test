<script src="<?php echo $script_path; ?>" type="text/javascript"></script>

<?php if($validation_errors) : ?>
    <div class="alert alert-danger"><?php echo $validation_errors; ?></div>
<? endif; ?>

<?php echo form_open('admin/content/ems/definition_save'); ?>
<input type="hidden" name="definition_id" value="<?php echo $definition_id; ?>">
<fieldset>
    <?php if($definition_id == 0) : ?>
        <legend><?php echo lang('ems_new_definition'); ?></legend>
    <?php else : ?>
        <legend><?php echo lang('ems_edit_definition'); ?></legend>
    <?php endif; ?>
    <p><input type="text" placeholder="<?php echo lang('ems_definition_title'); ?>" name="definition" value="<?php echo isset($definition->title) ?  $definition->title : ''; ?>"></p>
    <p>
        <textarea class='ckeditor' id='content' name='content'><?php echo isset($definition->content) ?  $definition->content : ''; ?></textarea>
    </p>
</fieldset>
<input type="submit" name="submit" value="Save" class="btn btn-danger">&nbsp;<input type="submit" name="submit" value="Discard" class="btn btn-primary">
<?php echo form_close(); ?>