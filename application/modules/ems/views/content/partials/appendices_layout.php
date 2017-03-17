<div class="main_content">
    <?php $contentTitle = trim($content_variables['title']) == '' ? $language[$content_item_key] : $content_variables['title'] ; ?>

    <h2>  <?php echo($contentTitle); ?></h2>

    <?php if(isset($content_partials["table"])) : ?>

        <?php echo $content_variables['content']; ?>

        <?php foreach($content_partials["table"] as $table_key => $table_value) : ?>
            <dl class="dl-horizontal dl-horizontal-big">
                <dt><?php echo $table_key; ?></dt>
                <dd><?php echo $table_value; ?></dd>
            </dl>
        <?php endforeach; ?>
    <?php else : ?>
        <?php echo $content_variables['content']; ?>
    <?php endif; ?>
</div>

<?php if(isset($content_partials['image_popups'])) : $popup_helpers->diagram_popups($content_partials['image_popups']); endif; ?>
<?php if(isset($content_partials['popups'])) : $popup_helpers->popups($content_partials['popups']); endif; ?>