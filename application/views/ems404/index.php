<div class="alert alert-block alert-danger fade in">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <p><i class="fa fa-warning"></i> Error 404: Sorry, the page you requested for could not be found.</p>
</div>

<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">

            <?php front_end_ems_tree($tree_navigation, $language); ?>

        </div>

    </div>

    <div class="right_col span9">
    	<!-- anchor -->
        <a name="anchor" class="anchor" style=""></a>
        <!-- /anchor -->
        
        <div class="main_content">
            <h1><i class="fa fa-exclamation-triangle"></i> Page not found.</h1>

            <img src="<?php echo base_url('assets/images/404.jpg'); ?>" style="border: 0px solid;" />

            <p class="well">The page you requested '<a href="#"><?php echo current_url(); ?></a>' cannot be found.
                You may have mis-typed the URL, so please check your spelling.
                It could also mean it doesn't exist, or may be it was moved.
                Please try again or search using the text box below. </p>

            <?php search_form(); ?>
        </div>
    </div>

</div>