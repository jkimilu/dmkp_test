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

    function close_first_time()
    {
        // Cookie expires in 60 days (2 months)
        var d = new Date();
        var num_days = 60;
        d.setTime(d.getTime() + (num_days*24*60*60*1000));

        var expires = "expires="+d.toUTCString();

        $("#first_time_alert").alert('close');
        document.cookie = "show_first_page_alert=No; " + expires + ";";
    }
</script>

<?php if(isset($first_time_message)) : ?>
    <?php if($first_time_message) : ?>
        <div class="row-fluid row-alert">
            <div class="span12">
                <div class="alert alert-block alert-error fade in" id="first_time_alert">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h3 class="alert-heading"><i class="fa fa-user"></i> Welcome <?php echo $logged_in_user["first_name"]." ".$logged_in_user["last_name"]; ?>!</h3>
                    <p>To help you access the sections of the EMS Manual that are most relevant to you, we have created role-based views available on this site. By default you have been logged in to the `Default View`. To learn how to change your view, please click the button below.</p>
                    <p>
                        <a class="btn btn-danger" href="<?php echo $learn_more_link; ?>">Learn more</a> <a class="btn" href="javascript:close_first_time();">Don't show this again</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">

            <div class="accordion" id="accordion_nav">

                <?php $tree_root_index = 0; ?>

                <?php foreach($tree_navigation->tree as $tree_array_item) : ?>

<?php
                    /**
                     * Try check and see if the title has been edited before and fix it instead
                     */
                    $treeArrayItemText = null;

                    if(isset($edited_titles[$tree_array_item[0]])) {
                        if(trim($edited_titles[$tree_array_item[0]]) != '') {
                            $treeArrayItemText = $edited_titles[$tree_array_item[0]];
                        } else {
                            $treeArrayItemText = $language[$tree_array_item[0]];
                        }
                    } else {
                        $treeArrayItemText = $language[$tree_array_item[0]];
                    }
?>


                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion_nav" href="#collapse_<?php echo $tree_root_index; ?>">
                                <i <?php echo(isset($tree_navigation->icons[$tree_root_index][0]) ? "class='{$tree_navigation->icons[$tree_root_index][0]}'" : ""); ?>></i> <?php echo $treeArrayItemText; ?>
                            </a>
                        </div>

                        <?php $tree_sub_root_index = 1; ?>

                        <div id="collapse_<?php echo $tree_root_index; ?>" class="accordion-body <?php echo($section_key == $tree_array_item[0] ? "in" : ""); ?> collapse">
                            <div class="accordion-inner">
                                <ul class="nav nav-pills nav-stacked small_font">
                                    <?php foreach($tree_array_item[1] as $tree_array_child) : ?>
<?php
                                        /**
                                         * Try check and see if the title has been edited before and fix it instead
                                         */
                                        $treeArrayChildText = null;

                                        if(isset($edited_titles[$tree_array_child])) {
                                            if(trim($edited_titles[$tree_array_child]) != '') {
                                                $treeArrayChildText = $edited_titles[$tree_array_child];
                                            } else {
                                                $treeArrayChildText = $language[$tree_array_child];
                                            }
                                        } else {
                                            $treeArrayChildText = $language[$tree_array_child];
                                        }
?>

                                        <?php $class_pre_pend = isset($tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index]} " : ""; ?>
                                        <li <?php echo($section_key == $tree_array_item[0] && $content_item_key == $tree_array_child && $sub_item_key == -1 ? 'class="'.$class_pre_pend.'active"' : "class='{$class_pre_pend}'"); ?>>
                                            <?php $sub_root_index_url = $tree_sub_root_index - 1; ?>
                                            <a href="<?php echo site_url("ems/index/{$tree_array_item[0]}/{$tree_array_child}/{$tree_root_index}/{$sub_root_index_url}"); ?>">
                                                <?php echo (isset($tree_navigation->icons[$tree_root_index][$tree_sub_root_index]) ? "<i class='{$tree_navigation->icons[$tree_root_index][$tree_sub_root_index]}'></i> " : ''); ?><?php echo (isset($tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?><?php echo $treeArrayChildText; ?><?php echo (isset($tree_navigation->post_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_navigation->post_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?>
                                            </a>

                                            <?php if(isset($tree_sub_navigation->tree[$tree_root_index][$tree_sub_root_index])): ?>
                                                <ul class="nav nav-pills nav-stacked">
                                                <?php $sub_item_index = 0; ?>
                                                <?php foreach($tree_sub_navigation->tree[$tree_root_index][$tree_sub_root_index] as $tree_array_child_item) : ?>
<?php
                                                    /**
                                                     * Try check and see if the title has been edited before and fix it instead
                                                     */
                                                    $treeArrayChildItemText = null;

                                                    if(isset($sub_content_edited_titles[$tree_array_child][$sub_item_index])) {
                                                        if(trim($sub_content_edited_titles[$tree_array_child][$sub_item_index]) != '') {
                                                            $treeArrayChildItemText = $sub_content_edited_titles[$tree_array_child][$sub_item_index];
                                                        } else {
                                                            $treeArrayChildItemText = $language[$tree_array_child_item];
                                                        }
                                                    } else {
                                                        $treeArrayChildItemText = $language[$tree_array_child_item];
                                                    }
?>
                                                    <?php $class_pre_pend = isset($tree_sub_navigation->list_classes[$tree_root_index][$tree_sub_root_index][$sub_item_index]) ? "{$tree_navigation->list_classes[$tree_root_index][$tree_sub_root_index][$sub_item_index]} " : ""; ?>
                                                    <li <?php echo($section_key == $tree_array_item[0] && $content_item_key == $tree_array_child && $sub_item_key == $sub_item_index ? 'class="'.$class_pre_pend.'active"' : "class='{$class_pre_pend}'"); ?>>
                                                        <a href="<?php echo site_url("ems/index/{$tree_array_item[0]}/{$tree_array_child}/{$tree_root_index}/{$sub_root_index_url}/{$sub_item_index}"); ?>">
                                                            <?php echo(isset($tree_sub_navigation->icons[$tree_root_index][$tree_sub_root_index][$sub_item_index]) ? "<i class='{$tree_sub_navigation->icons[$tree_root_index][$tree_sub_root_index][$sub_item_index]}'></i> " : ''); ?><?php echo (isset($tree_sub_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_sub_navigation->pre_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?><?php echo $treeArrayChildItemText; ?><?php echo (isset($tree_sub_navigation->post_pends[$tree_root_index][$tree_sub_root_index]) ? "{$tree_sub_navigation->post_pends[$tree_root_index][$tree_sub_root_index]} " : ''); ?>
                                                        </a>
                                                    </li>
                                                    <?php $sub_item_index++; ?>
                                                <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
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
    	
        <!-- anchor -->
        <a name="anchor" class="anchor" style=""></a>
        <!-- /anchor -->

        <?php if($is_admin) : ?>
            <a href="<?php echo $edit_content_link;?>" target="_blank" class="btn btn-warning edit tipify" data-original-title="Click to edit this page" data-placement="left"><i class="fa fa-edit"></i> Edit Page</a>
        <?php endif; ?>

        <?php echo $breadcrumb; ?>

        <!-- Content section -->

        <?php echo $page_content; ?>

        <div id="desktop_links" style="visibility:hidden; display:none;">
            <div class="well overflow_auto">
                <?php
                /**
                 * Ensure that you set appropriate edited titles on previous and next links
                 */
                $previousText = null;
                $nextText = null;

                if($previous_node != null) {
                    if(!$previous_node['is_sub_tree']) {
                        if(isset($edited_titles[$previous_node['item']])) {
                            $previousText = $edited_titles[$previous_node['item']];
                        } else {
                            $previousText = $language[$previous_node['item']];
                        }
                    } else {
                        if(isset($sub_content_edited_titles[$previous_node['parent']][$previous_node['index']])) {
                            $previousText = $sub_content_edited_titles[$previous_node['parent']][$previous_node['index']];
                        } else {
                            $previousText = $language[$previous_node['item']];
                        }
                    }
                }

                if($next_node != null) {
                    if(!$next_node['is_sub_tree']) {
                        if(isset($edited_titles[$next_node['item']])) {
                            $nextText = $edited_titles[$next_node['item']];
                        } else {
                            $nextText = $language[$next_node['item']];
                        }
                    } else {
                        if(isset($sub_content_edited_titles[$next_node['parent']][$next_node['index']])) {
                            $nextText = $sub_content_edited_titles[$next_node['parent']][$next_node['index']];
                        } else {
                            $nextText = $language[$next_node['item']];
                        }
                    }
                }
                ?>

                <?php if ($previous_link != null) : ?>
                    <a href="<?php echo($previous_link); ?>" class="btn pull-left"><i class="fa fa-arrow-left"></i> <?php echo $previousText; ?> </a>
                <?php endif; ?>

                <?php if ($next_link != null) : ?>
                    <a href="<?php echo($next_link); ?>" class="btn pull-right"><?php echo $nextText; ?> <i class="fa fa-arrow-right"></i></a>
                <?php endif; ?>

                <a target="_blank" data-original-title="Download page as PDF" href="<?php echo($pdf_download_link); ?>" class="btn btn-download tipify" title=""><i class="fa fa-download"></i></a>
            </div>
        </div>

        <div id="mobile_links" style="visibility:hidden; display:none;">
            <div class="well overflow_auto">
                <?php if ($previous_link != null) : ?>
                    <a href="<?php echo($previous_link."#anchor"); ?>" class="btn pull-left"><i class="fa fa-arrow-left"></i> <?php echo $language[$previous_node]; ?> </a>
                <?php endif; ?>

                <?php if ($next_link != null) : ?>
                    <a href="<?php echo($next_link."#anchor"); ?>" class="btn pull-right"><?php echo $language[$next_node]; ?> <i class="fa fa-arrow-right"></i></a>
                <?php endif; ?>

                <a target="_blank" data-original-title="Download page as PDF" href="<?php echo($pdf_download_link); ?>" class="btn btn-download tipify" title=""><i class="fa fa-download"></i></a>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Note: Mobile dimensions <767px

    var MOBILE_SIZE = 767;

    function show_mobile_view()
    {
        document.getElementById("mobile_links").style.visibility = "visible";
        document.getElementById("mobile_links").style.display = "block";

        document.getElementById("desktop_links").style.visibility = "hidden";
        document.getElementById("desktop_links").style.display = "none";
    }

    function show_desktop_view()
    {
        document.getElementById("desktop_links").style.visibility = "visible";
        document.getElementById("desktop_links").style.display = "block";

        document.getElementById("mobile_links").style.visibility = "hidden";
        document.getElementById("mobile_links").style.display = "none";
    }

    $(window).resize(function () {
        // When the window is resized to and from mobile view

        var width = $(window).width();

        if(width >= MOBILE_SIZE)
            show_desktop_view();
        else
            show_mobile_view();
    });

    $(document).ready(function() {
        // Get the dimensions on load and put the stuff in

        var width = $(window).width();

        if(width >= MOBILE_SIZE)
            show_desktop_view();
        else
            show_mobile_view();
    });
</script>

