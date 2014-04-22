<?php

function load_content_editors($role, $section_key, $content_item_key, $content_variables)
{
    $language = lang("ems_tree");

    // Main content
    $main_content_variable = $content_variables["content"];
?>

    <?php echo form_open(site_url('admin/content/ems/content_save/')); ?>

        <input type="hidden" name="section_key" value="<?php echo($section_key); ?>">
        <input type="hidden" name="content_item_key" value="<?php echo($content_item_key); ?>">
        <input type="hidden" name="role" value="<?php echo($role); ?>">

        <div class='row'>
            <h5><?php echo $language['main_content'] ?></h5>
            <hr/>
            <textarea class='ckeditor' name='content'><?php echo $main_content_variable ?></textarea>
        </div>

<?php
    // Content blocks
    foreach($content_variables["chunks"] as $content_item_key => $content_item_value)
    {
?>
        <div class='row'>
            <h5> <?php echo $language[$content_item_key] ?></h5>
            <hr/>
            <textarea class='ckeditor' name='<?php echo $content_item_key; ?>'><?php echo $content_item_value; ?></textarea>
        </div>
<?php
    }
?>
        <hr/>
        <span><input type='submit' value='Save' class='btn btn-primary'/>&nbsp;<a href="<?php echo site_url('admin/content/ems'); ?>" class="btn btn-danger">Discard and Exit</a></span>
    <?php echo form_close(); ?>
<?php
}
?>