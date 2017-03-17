<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($contact_persons))
{
	$contact_persons = (array) $contact_persons;
}
$id = isset($contact_persons['id']) ? $contact_persons['id'] : '';

?>
<div class="admin-box">
	<h3>Contact Persons</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<fieldset>

			<div class="control-group <?php echo form_error('contact_person') ? 'error' : ''; ?>">
				<?php echo form_label('Contact Person'. lang('bf_form_label_required'), 'contact_persons_contact_person', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='contact_persons_contact_person' type='text' name='contact_persons_contact_person' maxlength="100" value="<?php echo set_value('contact_persons_contact_person', isset($contact_persons['contact_person']) ? $contact_persons['contact_person'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('contact_person'); ?></span>
				</div>
			</div>

			<div class="control-group <?php echo form_error('contact_person_link') ? 'error' : ''; ?>">
				<?php echo form_label('Contact Person Link'. lang('bf_form_label_required'), 'contact_persons_contact_person_link', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='contact_persons_contact_person_link' type='text' name='contact_persons_contact_person_link' maxlength="300" value="<?php echo set_value('contact_persons_contact_person_link', isset($contact_persons['contact_person_link']) ? $contact_persons['contact_person_link'] : ''); ?>" />
					<span class='help-inline'><?php echo form_error('contact_person_link'); ?></span>
				</div>
			</div>

			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('contact_persons_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor(SITE_AREA .'/settings/contact_persons', lang('contact_persons_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Contact_Persons.Settings.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('contact_persons_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('contact_persons_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>