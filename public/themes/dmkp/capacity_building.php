<!DOCTYPE html>
<html lang="en">
    <?php echo theme_view('_header'); ?>
    <?php echo theme_view('_standard_nav_bar'); ?>
    <?php echo theme_view('_nav_bar_2'); ?>

    <div class="container-fluid max-width">
<?php
        echo Template::message();
        echo isset($content) ? $content : Template::content();
?>

      <?php echo theme_view('_footer'); ?>
    </div>
</html>