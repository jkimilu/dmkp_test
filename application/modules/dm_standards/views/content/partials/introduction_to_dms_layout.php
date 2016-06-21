<div class="main_content">
    <h2>  <?php echo($language[$content_item_key]); ?></h2>
    <?php echo $content_variables['content']; ?>
</div>

<?php if(isset($content_partials['image_popups'])) : $popup_helpers->diagram_popups($content_partials['image_popups']); endif; ?>
<?php if(isset($content_partials['popups'])) : $popup_helpers->popups($content_partials['popups']); endif; ?>