<div class="main_content">
    <h3>  <?php echo($language[$content_item_key]); ?></h3>

    <?php if(isset($content_partials["table"])) : ?>

        <?php echo $content_variables['content']; ?>

        <table style="border: 1px solid #000000;">
            <?php foreach($content_partials["table"] as $table_key => $table_value) : ?>
                <tr>
                    <td><?php echo $table_key; ?></td>
                    <td><?php echo $table_value; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else : ?>
        <?php echo $content_variables['content']; ?>
    <?php endif; ?>
</div>

<pagebreak />