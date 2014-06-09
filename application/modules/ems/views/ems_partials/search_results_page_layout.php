<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">
            <?php search_form(); ?>
            <?php front_end_ems_tree($tree_navigation, $language); ?>
        </div>

    </div>

    <div class="right_col span9">
        <div class="main_content">
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

            <?php endif; ?>
        </div>
    </div>

</div>