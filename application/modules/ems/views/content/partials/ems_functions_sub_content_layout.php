<div class="main_content">
    <?php if(isset($content_partials["tor_sog_link"])) : ?>

        <?php $contentTitle = trim($content_variables['title']) == '' ? $language[$sub_tree[$section_id][$content_item_id + 1][$sub_key_item]] : $content_variables['title'] ; ?>

        <h2>  <i class="<?php echo $content_partials['icon']; ?>"></i> <?php echo strtoupper($contentTitle); ?> - '<?php echo ucwords(strtolower($content_partials['pre_append'])); ?>' </h2>
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