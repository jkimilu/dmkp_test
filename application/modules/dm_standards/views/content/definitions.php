<script type="text/javascript">
    function alert_delete()
    {
        return confirm("<?php echo lang('dms_sure_you_want_to_delete'); ?>");
    }
</script>

<?php if($definitions) : ?>
    <table class="table table-stripped">
        <thead>
        <tr>
            <td><?php echo lang('dms_definition_title'); ?></td>
            <td><?php echo lang('dms_definition_slug')." / ".lang('dms_definition_id')  ?></td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <?php foreach($definitions as $definition) : ?>
            <tr>
                <td><?php echo $definition->title; ?></td>
                <td><?php echo $definition->slug; ?></td>
                <td>
                    <a href='<?php echo site_url('admin/content/dm_standards/definition_edit/'.$definition->id) ?>' class="btn btn-danger"><?php echo lang('dms_edit_definition'); ?></a>
                    <a href='<?php echo site_url('admin/content/dm_standards/definition_delete/'.$definition->id) ?>' class="btn btn-danger" onclick="return alert_delete();"><?php echo lang('dms_delete_definition'); ?></a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class='alert alert-info'><?php echo lang('dms_content_no_definitions'); ?></div>
<?php endif; ?>

<div>
    <a class="btn btn-primary" href="<?php echo site_url("admin/content/dm_standards/definition_edit/0"); ?>"><?php echo lang('dms_new_definition'); ?></a>
</div>