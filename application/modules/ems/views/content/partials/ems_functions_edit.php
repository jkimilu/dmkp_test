<?php if(!$is_ajax) : ?>
    <script src="<?php echo $ckeditor_path; ?>" type="text/javascript"></script>
<?php endif; ?>
<?php echo load_content_editors($role, $section_key, $content_item_key, $section_id, $content_item_id, $content, $options, $is_ajax); ?>