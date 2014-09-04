<div class="main_content">
    <?php if(isset($content_partials["tor_sog_link"])) : ?>

        <h2>  <i class="<?php echo $content_partials['icon']; ?>"></i> '<?php echo $content_partials['pre_append']; ?>' - <?php echo($language[$content_item_key]); ?></h2>
        <?php echo $content_variables['content']; ?>

        <hr/>

        <div class="row-fluid tor_sog">
            <a class="btn span6" href="<?php echo $content_partials["tor_sog_link"];?>">Terms Of Reference</a>
            <a class="btn span6" href="<?php echo $content_partials["tor_sog_link"];?>">Standard Operating Guidelines</a>
        </div>

    <?php else : ?>

        <h2>  <?php echo($language[$content_item_key]); ?></h2>
        <?php echo $content_variables['content']; ?>

    <?php endif; ?>
</div>

<?php if(isset($content_partials['image_popups'])) : $popup_helpers->diagram_popups($content_partials['image_popups']); endif; ?>
<?php if(isset($content_partials['popups'])) : $popup_helpers->popups($content_partials['popups']); endif; ?>