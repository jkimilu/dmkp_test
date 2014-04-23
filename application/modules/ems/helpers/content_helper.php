<?php

function load_content_editors($role, $section_key, $content_item_key, $section_id, $content_item_id, $content_variables, $options, $is_ajax)
{
    $language = lang("ems_tree");

    // Main content
    $main_content_variable = $content_variables["content"];
?>

<?php if(!$is_ajax) : ?>

    <script type="text/javascript">
        function change_role()
        {
            role = document.getElementById("role_dropdown").value;

            $.getJSON('<?php echo site_url("admin/content/ems/ajax_role_content_edit_view"); ?>/'+ role +'/<?php echo "{$section_key}/{$content_item_key}/{$section_id}/{$content_item_id}/1"; ?>', function(data) {
                document.getElementById("role").value = role;
                document.getElementById("content").value = data.content.content;
                CKEDITOR.instances.content.setData(data.content.content);

                $.each(data.content.partials, function(index, value) {
                    partial_value = data.content.chunks[value];
                    CKEDITOR.instances[value].setData(partial_value);
                });
            });

            return false;
        }
    </script>

    <div class="row" style="padding-bottom:10px;">
        <h5>Role:</h5>
        <hr/>
        <p><?php echo form_dropdown('role_dropdown', $options, array(), '', 'id="role_dropdown" onchange="change_role();"') ?></p>
        <hr/>
    </div>

    <div id="content_div">
<?php endif; ?>

    <?php echo form_open(site_url('admin/content/ems/content_save/')); ?>

        <input type="hidden" id="section_key" name="section_key" value="<?php echo($section_key); ?>">
        <input type="hidden" id="content_item_key" name="content_item_key" value="<?php echo($content_item_key); ?>">
        <input type="hidden" id="role" name="role" value="<?php echo($role); ?>">

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

<?php if(!$is_ajax) : ?>
    </div>
<?php endif; ?>

    <?php echo form_close(); ?>
<?php
}
?>