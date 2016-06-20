<?php

function front_end_dms_tree($tree_navigation, $language)
{
?>
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

                <div id="collapse_<?php echo $tree_root_index; ?>" class="accordion-body collapse">
                    <div class="accordion-inner">
                        <ul class="nav nav-pills nav-stacked small_font">
                            <?php foreach($tree_array_item[1] as $tree_array_child) : ?>
                                <?php $class_pre_pend = isset($tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]} " : ""; ?>
                                <li class='<?php echo $class_pre_pend; ?>'>
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
<?php
}

function search_form($term = "")
{
?>
    <?php echo form_open(site_url('ems/search'), 'class="form-search" method="get"'); ?>
        <input name="search" type="text" placeholder="Search" value="<?php echo $term; ?>" class="span12 search-query"/>
    <?php echo form_close(); ?>
<?php
}