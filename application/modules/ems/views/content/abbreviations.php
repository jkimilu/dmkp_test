<script type="text/javascript">
    function alert_delete()
    {
        return confirm("<?php echo lang('ems_sure_you_want_to_delete'); ?>");
    }
</script>

<?php if($abbreviations) : ?>
    <table class="table table-stripped">
        <thead>
            <tr>
                <td><?php echo lang('ems_abbreviation_title'); ?></td>
                <td><?php echo lang('ems_abbreviation_slug')." / ".lang('ems_abbreviation_id')  ?></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($abbreviations as $abbreviation) : ?>
                <tr>
                    <td><?php echo $abbreviation->title; ?></td>
                    <td><?php echo $abbreviation->slug; ?></td>
                    <td>
                        <a href='<?php echo site_url('admin/content/ems/abbreviation_edit/'.$abbreviation->id) ?>' class="btn btn-danger"><?php echo lang('ems_edit_abbreviation'); ?></a>
                        <a href='<?php echo site_url('admin/content/ems/abbreviation_delete/'.$abbreviation->id) ?>' class="btn btn-danger" onclick="return alert_delete();"><?php echo lang('ems_delete_abbreviation'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class='alert alert-info'><?php echo lang('ems_content_no_abbreviations'); ?></div>
<?php endif; ?>

<div>
    <a class="btn btn-primary" href="<?php echo site_url("admin/content/ems/abbreviation_edit/0"); ?>"><?php echo lang('ems_new_abbreviation'); ?></a>
</div>