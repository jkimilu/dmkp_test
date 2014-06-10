<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class My_Content
{
    public function load_content_editors($section_key, $content_item_key, $section_id, $content_item_id,
        $content_variables, $script_path, $content_rules = array())
    {
        $language = lang("ems_tree");

        $main_content_display = isset($content_rules["field_display"]["main_content"]) ?
            $content_rules["field_display"]["main_content"] : $language['main_content'];

        if(in_array("main_content", $content_rules["optionals"]))
            $main_content_display.=" - ({$language["optional"]})";

        // Main content
        $main_content_variable = $content_variables["content"];

        ob_start();
?>

        <script src="<?php echo $script_path; ?>" type="text/javascript"></script>

<?php echo form_open(site_url('admin/content/ems/content_save/')); ?>

        <input type="hidden" id="section_key" name="section_key" value="<?php echo($section_key); ?>">
        <input type="hidden" id="content_item_key" name="content_item_key" value="<?php echo($content_item_key); ?>">
        <input type="hidden" id="section_id" name="section_id" value="<?php echo($section_id); ?>">
        <input type="hidden" id="content_item_id" name="content_item_id" value="<?php echo($content_item_id); ?>">

        <?php if(!in_array('main_content', $content_rules["hidden"])) : ?>

            <div class='row'>
                <h5><?php echo $main_content_display ?></h5>
                <hr/>
                <textarea class='ckeditor' id='content' name='content'><?php echo $main_content_variable ?></textarea>
            </div>

        <?php endif; ?>

<?php
        // Content blocks
        if(is_array($content_variables["chunks"]))
        {
            foreach($content_variables["chunks"] as $content_item_key => $content_item_value)
            {
                $field_display = $language[$content_item_key];

                if(!in_array($content_item_key, $content_rules["hidden"]))
                {

                    if(in_array($content_item_key, $content_rules["optionals"]))
                        $field_display.=" - ({$language["optional"]})";
?>
                <div class='row'>
                    <h5> <?php echo $field_display; ?></h5>
                    <hr/>
                    <textarea class='ckeditor' id='<?php echo $content_item_key; ?>' name='<?php echo $content_item_key; ?>'><?php echo $content_item_value; ?></textarea>
                </div>
<?php
                }
            }
        }
?>
            <hr/>

            <span>
                <input type="submit" class="btn btn-primary" value="Save" name="submit_btn"/>
                <input type="submit" class="btn btn-danger" value="Discard" name="submit_btn"/>
            </span>
        <?php echo form_close(); ?>
<?php

        return ob_get_clean();
    }
}