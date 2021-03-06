<div class="main_content">

    <?php
    $contentTitle = null;

    if(isset($contentEditedTitles[$content_item_key])) {
        $contentTitle = $contentEditedTitles[$content_item_key];
    } else {
        $contentTitle = trim($content_variables['title']) == '' ? $language[$content_item_key] : $content_variables['title'] ;
    }
    ?>

    <?php if(isset($content_partials["tor_sog_link"])) : ?>

        <h3>  <i class="<?php echo $content_partials['icon']; ?>"></i> "<?php echo $content_partials['pre_append']; ?>" - <?php echo($contentTitle); ?></h3>
        <?php echo $content_variables['content']; ?>

        <hr/>

        <div class="row-fluid tor_sog">
            <a class="btn span6" href="<?php echo $content_partials["tor_sog_link"];?>">Terms Of Reference</a>
            <a class="btn span6" href="<?php echo $content_partials["tor_sog_link"];?>">Standard Operating Guidelines</a>
        </div>

    <?php else : ?>

        <h3>  <?php echo($contentTitle); ?></h3>
        <?php echo $content_variables['content']; ?>

    <?php endif; ?>
</div>