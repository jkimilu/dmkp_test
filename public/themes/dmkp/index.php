<!DOCTYPE html>
<html lang="en">
<?php echo theme_view('_header'); ?>

<?php
    echo Template::message();
    echo isset($content) ? $content : Template::content();
?>

<?php echo theme_view('_footer'); ?>
</html>