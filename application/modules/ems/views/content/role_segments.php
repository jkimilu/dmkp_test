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

<div class="tab-content">
    <div class="tab-pane active" id="main_content">
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
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
            </table>
        <?php endforeach; ?>
    </div>
    <?php foreach($chunk_text_segments as $chunk_key => $chunk_value) : ?>
        <div class="tab-pane" id="<?php echo $chunk_key; ?>">
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
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            <?php endforeach; ?>
        </div>
    <?php endforeach; ?>
</div>