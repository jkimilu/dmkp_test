<?php

function load_content_editors($section_key, $content_item_key, $section_id, $content_item_id, $content_variables)
{
    $language = lang("ems_tree");

    // Main content
    $main_content_variable = $content_variables["content"];
?>

    <?php echo form_open(site_url('admin/content/ems/content_save/')); ?>

        <input type="hidden" id="section_key" name="section_key" value="<?php echo($section_key); ?>">
        <input type="hidden" id="content_item_key" name="content_item_key" value="<?php echo($content_item_key); ?>">
        <input type="hidden" id="section_id" name="section_id" value="<?php echo($section_id); ?>">
        <input type="hidden" id="content_item_id" name="content_item_id" value="<?php echo($content_item_id); ?>">

        <div class='row'>
            <h5><?php echo $language['main_content'] ?></h5>
            <hr/>
            <textarea class='ckeditor' id='content' name='content'><?php echo $main_content_variable ?></textarea>
        </div>

<?php
    // Content blocks
    foreach($content_variables["chunks"] as $content_item_key => $content_item_value)
    {
?>
        <div class='row'>
            <h5> <?php echo $language[$content_item_key] ?></h5>
            <hr/>
            <textarea class='ckeditor' id='<?php echo $content_item_key; ?>' name='<?php echo $content_item_key; ?>'><?php echo $content_item_value; ?></textarea>
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