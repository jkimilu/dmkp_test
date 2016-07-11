<div class="main_content">
    <?php
    $contentTitle = null;

    if(isset($contentEditedTitles[$content_item_key])) {
        $contentTitle = $contentEditedTitles[$content_item_key];
    } else {
        $contentTitle = trim($content_variables['title']) == '' ? $language[$content_item_key] : $content_variables['title'] ;
    }
    ?>

    <h3>  <?php echo($contentTitle); ?></h3>
    <?php echo $content_variables['content']; ?>
</div>