<script type="text/javascript">
    function alert_delete()
    {
        return confirm("<?php echo lang('dms_sure_you_want_to_delete'); ?>");
    }
</script>

<?php if($popups) : ?>
    <table class="table table-stripped">
        <thead>
            <tr>
                <td><?php echo lang('dms_popup_title'); ?></td>
                <td><?php echo lang('dms_popup_slug')." / ".lang('dms_popup_id')  ?></td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach($popups as $popup) : ?>
                <tr>
                    <td><?php echo $popup->title; ?></td>
                    <td><?php echo $popup->slug; ?></td>
                    <td>
                        <a href='<?php echo site_url('admin/content/dm_standards/popup_edit/'.$popup->id) ?>' class="btn btn-danger"><?php echo lang('dms_edit_popup'); ?></a>
                        <a href='<?php echo site_url('admin/content/dm_standards/popup_delete/'.$popup->id) ?>' class="btn btn-danger" onclick="return alert_delete();"><?php echo lang('dms_delete_popup'); ?></a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <div class='alert alert-info'><?php echo lang('dms_content_no_popups'); ?></div>
<?php endif; ?>

<div>
    <a class="btn btn-primary" href="<?php echo site_url("admin/content/dm_standards/popup_edit/0"); ?>"><?php echo lang('dms_new_popup'); ?></a>
</div>