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

            <div class="well well-small">
                Your search for "<?php echo $term; ?>" yielded <?php echo number_format($pagination->total_rows, 0); ?> results ({elapsed_time} seconds)
            </div>

            <?php search_form($term); ?>

            <h2><i class="fa fa-search"></i> Search Results</h2>

            <hr />

            <?php if($results) : ?>

            <ul class="unstyled search_ul">
                <?php foreach($results as $result) : ?>
                    <li>
                        <a href="<?php echo $result->link; ?>"><h3><?php echo $result->content_title; ?></h3></a>
                        <p style="padding-top:10px;">
                            <ul class="breadcrumb">
                                <li>Home <span class="divider">/</span></li>
                                <li><?php echo $language[$result->content_section]; ?> <span class="divider">/</span></li>
                                <li class="active"><?php echo $language[$result->content_slug]; ?></li>
                            </ul>
                        </p>
                        <p class="search_p"><?php echo $result->brief_text; ?>...</p>
                    </li>
                <?php endforeach; ?>
            </ul>

            <?php else : ?>

                <div class="alert alert-danger">There are no search results</div>

            <?php endif; ?>

        </div>

        <?php echo $links; ?>
    </div>

</div>