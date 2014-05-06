<?php if($popups) : ?>
<?php else : ?>
    <div class='alert alert-info'><?php echo lang('ems_content_no_popups'); ?></div>
<?php endif; ?>

<div>
    <a class="btn btn-primary" href="<?php echo site_url("admin/content/ems/popup_edit/0"); ?>"><?php echo lang('ems_new_popup'); ?></a>
</div>