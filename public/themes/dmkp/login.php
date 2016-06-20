<!DOCTYPE html>
<html lang="en">
<?php echo theme_view('_header_plain'); ?>

<style>body { background: #f5f5f5; }</style>

    <?php
        echo isset($content) ? $content : Template::content();
    ?>

<?php echo theme_view('_footer', array('show' => false)); ?>
</html>