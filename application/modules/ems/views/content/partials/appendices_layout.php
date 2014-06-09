<div class="main_content">
    <h2>  <?php echo($language[$content_item_key]); ?></h2>

    <?php if(isset($content_partials["table"])) : ?>
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