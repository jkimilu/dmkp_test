<?php
function search_form($term = "")
{
?>
    <?php echo form_open(site_url('dmkp/search'), 'class="form-search form-search-nav pull-right" method="get"'); ?>
        <input name="search" placeholder="Search" class="search-query" type="text">
    <?php echo form_close(); ?>
<?php
}

function resource_item($resourceMainId, $submitUrl, $deleteUrl, $resourceCategory, $name = '', $type = '', $link = '', $resourceId = 0)
{
?>
    <?php echo form_open($submitUrl); ?>
        <input type="hidden" name="id" value="<?php echo $resourceId; ?>"/>
        <input type="hidden" name="resource_id" value="<?php echo $resourceMainId; ?>"/>
        <input type="hidden" name="category" value="<?php echo $resourceCategory; ?>"/>

        <div class="form-group">
            <label for="resource_name">Name</label>
            <input type="text" name="resource_name" value="<?php echo $name; ?>" class="form-control" id="resource_name" placeholder="Name">
        </div>

        <div class="form-group">
            <label for="resource_type">Category</label>
            <select name="resource_type" id="resource_type">
                <option value="document"<?php echo($type == 'document' ? ' selected': ''); ?>>Document</option>
                <option value="link"<?php echo($type == 'link' ? ' selected': ''); ?>>Link</option>
            </select>
        </div>

        <div class="form-group">
            <label for="resource_link">Link URL</label>
            <input type="text" name="resource_link" value="<?php echo $link; ?>" class="form-control" id="resource_link" placeholder="URL">
        </div>

        <div class="form-actions">
            <button type="submit" class="btn btn-primary"><?php echo($resourceId > 0 ? 'Update' : 'Add'); ?></button>

            <?php if($resourceId > 0) : ?>
                <a class="btn btn-danger" id="delete_<?php echo $resourceId; ?>" href="<?php echo $deleteUrl.'/'.$resourceId.'/'.$resourceMainId ?>">Delete</a>
            <?php endif; ?>
        </div>
    <?php echo form_close(); ?>
<?php
}

function sureToDelete($records) {
    $extraJS = '';
    if($records) {
        foreach ($records as $record) {
            $recordId = $record->id;
            $extraJS .=
                <<<JS
                				$('#delete_{$recordId}').click(function () {
                    return confirm("Sure you want to delete?");
                });
JS;
        }
    }

    return $extraJS;
}