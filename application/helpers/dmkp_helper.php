<?php
function search_form($term = "")
{
?>
    <?php echo form_open(site_url('search'), 'class="form-search form-search-nav pull-right" method="get"'); ?>
        <input name="search" placeholder="Search" class="search-query" type="text">
    <?php echo form_close(); ?>
<?php
}