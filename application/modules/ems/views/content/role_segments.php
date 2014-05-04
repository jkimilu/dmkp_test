<ul class="nav nav-tabs" id="content_tabs">
    <li class="active">
        <a href="#main_content" data-toggle="tab"><?php echo $language['main_content']; ?></a>
    </li>

    <?php foreach($chunk_text_segments as $chunk_key => $chunk_value) : ?>
        <li>
            <a href="#<?php echo $chunk_key; ?>" data-toggle="tab"><?php echo $language[$chunk_key]; ?></a>
        </li>
    <?php endforeach; ?>
</ul>

<?php echo form_open('admin/content/ems/role_segments_save'); ?>

    <input type="hidden" name="section_key" value="<?php echo $section_key;?>"/>
    <input type="hidden" name="content_item_key" value="<?php echo $content_item_key;?>"/>
    <input type="hidden" name="content_item_id" value="<?php echo $content_item_id;?>"/>

    <div class="tab-content">
        <div class="tab-pane active" id="main_content">
            <?php $segment_count = 1; ?>
            <?php foreach($content_text_segments as $segment) : ?>
                <table class="table table-bordered">
                    <tr>
                        <td style="width:60%;">
                            <?php echo $segment; ?>
                        </td>
                        <td>
                            <table class="table table-bordered table-striped">
                                <?php foreach($roles as $role) : ?>
                                    <tr>
                                        <td><?php echo($language[$role]); ?></td>
                                        <td>
                                            <?php echo form_dropdown("main_content_{$role}_{$segment_count}", $view_modes); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                </table>
                <?php $segment_count ++; ?>
            <?php endforeach; ?>

            <input type="hidden" name="main_content_segments" value="<?php echo ($segment_count - 1);?>"/>
        </div>

        <?php foreach($chunk_text_segments as $chunk_key => $chunk_value) : ?>
            <div class="tab-pane" id="<?php echo $chunk_key; ?>">
                <?php $segment_count = 1; ?>
                <?php foreach($chunk_value as $chunk_value_value): ?>
                    <table class="table table-bordered">
                        <tr>
                            <td style="width:60%;">
                                <?php echo $chunk_value_value; ?>
                            </td>
                            <td>
                                <table class="table table-bordered table-striped">
                                    <?php foreach($roles as $role) : ?>
                                        <tr>
                                            <td><?php echo($language[$role]); ?></td>
                                            <td>
                                                <?php echo form_dropdown("{$chunk_key}_{$role}_{$segment_count}", $view_modes); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                <?php endforeach; ?>
                <?php $segment_count ++; ?>
            </div>
            <input type="hidden" name="<?php echo $chunk_key;?>_segments" value="<?php echo ($segment_count - 1);?>"/>
        <?php endforeach; ?>
    </div>
    <div>
        <input type="submit" name="submit" class="btn btn-danger" value="Save"/>
        <input type="submit" name="submit" class="btn btn-primary" value="Discard"/>
    </div>
<?php echo form_close(); ?>