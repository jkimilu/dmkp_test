<script type="text/javascript">
    /**
     * This function shows hidden blocks
     * @param block_id
     */
    function display_content_block(block_id)
    {
        content_button = 'c_bn_' + block_id;
        content_div = 'c_bl_' + block_id;

        document.getElementById(content_div).style.visibility = 'visible';
        document.getElementById(content_div).style.display = 'block';

        document.getElementById(content_button).remove();
    }
</script>

<?php if(isset($first_time_message)) : ?>
    <?php if($first_time_message) : ?>
        <div class="row-fluid row-alert">
            <div class="span12">
                <div class="alert alert-block alert-error fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h3 class="alert-heading"><i class="fa fa-user"></i> Welcome <?php echo $logged_in_user["first_name"]." ".$logged_in_user["last_name"]; ?>!</h3>
                    <p>In an effort to make you access sections of the EMS that are most relevant to you in a faster and more convenient way we have created role-based view sessions. By default you have been logged in on the `Default View` session. To learn how to change your view session please click the button below.</p>
                    <p>
                        <a class="btn btn-danger" href="<?php echo $learn_more_link; ?>">Learn More</a> <a class="btn" href="#">Dont show this again</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">

            <?php search_form(); ?>

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
                                        <?php $class_pre_pend = isset($tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]} " : ""; ?>
                                        <li <?php echo($section_key == $tree_array_item[0] && $content_item_key == $tree_array_child ? 'class="'.$class_pre_pend.'active"' : "class='{$class_pre_pend}'"); ?>>
                                            <?php $sub_root_index_url = $tree_sub_root_index - 1; ?>
                                            <a href="<?php echo site_url("ems/index/{$tree_array_item[0]}/{$tree_array_child}/{$tree_root_index}/{$sub_root_index_url}"); ?>">
                                                <?php echo (isset($tree_navigation->icons[$tree_root_index][$tree_sub_root_index]) ? "<i class='{$tree_navigation->icons[$tree_root_index][$tree_sub_root_index]}'></i> " : ''); ?><?php echo (isset($tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?><?php echo $language[$tree_array_child]; ?><?php echo (isset($tree_navigation->post_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->post_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?>
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

    </div>

    <div class="right_col <?php echo $right_column_mid_class; ?> span9">

        <?php if($is_admin) : ?>
            <a href="<?php echo $edit_content_link;?>" target="_blank" class="btn btn-warning edit tipify" data-original-title="Click to edit this page" data-placement="left"><i class="fa fa-edit"></i> Edit Page</a>
        <?php endif; ?>

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