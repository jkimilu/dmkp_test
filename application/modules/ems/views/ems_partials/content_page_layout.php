<div class="row-fluid body">

    <div class="left_col span3">

        <form class="form-search" enctype="multipart/form-data" method="get" action="">
            <input name="search" type="text" placeholder="Search" class="span12 search-query">
        </form>

        <div class="accordion" id="accordion_nav">

            <?php $tree_root_index = 0; ?>

            <?php foreach($tree_navigation->tree as $tree_array_item) : ?>

                <div class="accordion-group">
                    <div class="accordion-heading">
                        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapse_<?php echo $tree_root_index; ?>">
                            <i <?php echo(isset($tree_navigation->icons[$tree_root_index][0]) ? "class='{$tree_navigation->icons[$tree_root_index][0]}'" : ""); ?>></i> <?php echo $language[$tree_array_item[0]]; ?>
                        </a>
                    </div>

                    <?php $tree_sub_root_index = 1; ?>

                    <div id="collapse_<?php echo $tree_root_index; ?>" class="accordion-body <?php echo($section_key == $tree_array_item[0] ? "in" : ""); ?> collapse">
                        <div class="accordion-inner">
                            <ul class="nav nav-pills nav-stacked small_font">
                                <?php foreach($tree_array_item[1] as $tree_array_child) : ?>
                                    <li <?php echo($section_key == $tree_array_item[0] && $content_item_key == $tree_array_child ? 'class="active"' : ""); ?>>
                                        <?php $sub_root_index_url = $tree_sub_root_index - 1; ?>
                                        <a href="<?php echo site_url("ems/index/{$tree_array_item[0]}/{$tree_array_child}/{$tree_root_index}/{$sub_root_index_url}"); ?>">
                                            <?php echo (isset($tree_navigation->icons[$tree_root_index][$tree_sub_root_index]) ? "<i class='{$tree_navigation->icons[$tree_root_index][$tree_sub_root_index]}'></i> " : ''); ?><?php echo (isset($tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?><?php echo $language[$tree_array_child]; ?>
                                        </a>
                                    </li>

                                    <?php $tree_sub_root_index ++; ?>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <?php $tree_root_index ++; ?>

            <?php endforeach; ?>
        </div>
    </div>

    <div class="right_col span9">
        <?php echo $breadcrumb; ?>

        <!-- Content section -->

        <?php echo $page_content; ?>

        <div class="well overflow_auto">
            <?php if ($previous_link != null) : ?>
                <a href="<?php echo($previous_link); ?>" class="btn pull-left"><i class="fa fa-arrow-left"></i> <?php echo $language[$previous_node]; ?> </a>
            <?php endif; ?>

            <?php if ($next_link != null) : ?>
                <a href="<?php echo($next_link); ?>" class="btn pull-right"><?php echo $language[$next_node]; ?> <i class="fa fa-arrow-right"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>