<div class="main_content">

    <?php
    $contentTitle = null;

    if(isset($subContentEditedTitles[$content_item_key][$subContentItem->sub_content_index])) {
        $contentTitle = $subContentEditedTitles[$content_item_key][$subContentItem->sub_content_index];
    } else {
        $contentTitle = $language[$subTree[$contentItem->sub_content_index]];
    }
    ?>

    <h3><?php echo($contentTitle); ?></h3>
        <?php echo $subContentItem->content; ?>
    <hr/>
</div>