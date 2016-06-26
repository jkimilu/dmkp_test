<?php
function search_form($term = "")
{
?>
    <?php echo form_open(site_url('search'), 'class="form-search form-search-nav pull-right" method="get"'); ?>
        <input name="search" placeholder="Search" class="search-query" type="text">
    <?php echo form_close(); ?>
<?php
}

function resource_item($submitUrl, $deleteUrl, $resourceCategory, $name = '', $category = '', $link = '', $resourceId = 0)
{
?>
    <?php echo form_open($submitUrl, array('class' => 'form-inline')); ?>
        <input type="hidden" name="id" value="<?php echo $resourceId; ?>"/>
        <input type="hidden" name="category" value="<?php echo $resourceCategory; ?>"/>

        <div class="form-group">
            <label for="resource_name">Name</label>
            <input type="text" name="resource_name" value="<?php echo $name; ?>" class="form-control" id="resource_name" placeholder="Jane Doe">
        </div>

        <div class="form-group">
            <label for="resource_category">Category</label>
            <select name="resource_category" id="resource_category">
                <option value="document"<?php echo($category == ' document' ? 'selected': ''); ?>>Document</option>
                <option value="link"<?php echo($category == ' link' ? 'selected': ''); ?>>Link</option>
            </select>
        </div>

        <div class="form-group">
            <label for="resource_link">Link URL</label>
            <input type="text" name="resource_link" value="<?php echo $link; ?>" class="form-control" id="resource_link" placeholder="Jane Doe">
        </div>

        <button type="submit" class="btn btn-primary"><?php echo($resourceId > 0 ? 'Edit' : 'Add'); ?></button>

        <?php if($resourceId > 0) : ?>
            <a class="btn btn-danger" id="delete_<?php echo $resourceId; ?>" href="<?php echo $deleteUrl.'/'.$resourceId ?>">Delete</a>
        <?php endif; ?>
    <?php echo form_close(); ?>
<?php
}