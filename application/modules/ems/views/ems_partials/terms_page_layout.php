<?php if(isset($first_time_message)) : ?>
    <?php if($first_time_message) : ?>
        <div class="row-fluid row-alert">
            <div class="span12">
                <div class="alert alert-block alert-error fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <h3 class="alert-heading"><i class="fa fa-user"></i> Welcome Daniel Mason!</h3>
                    <p>In an effort to make you access sections of the EMS that are most relevant to you in a faster and more convenient way we have created role-based view sessions. By default you have been logged in on the `Default View` session. To learn how to change your view session please click the button below.</p>
                    <p>
                        <a class="btn btn-danger" href="#">Learn More</a> <a class="btn" href="#">Dont show this again</a>
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<div class="row-fluid body">

    <div class="left_col span3">

        <div class="affix">

            <?php echo form_open(site_url('ems/search'), 'class="form-search"'); ?>
            <input name="search" type="text" placeholder="Search" class="span12 search-query"/>
            <?php echo form_close(); ?>

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

        </div>

    </div>

    <div class="right_col span9">
        <ul class="breadcrumb">
            <li><a href="summary.html">Home</a> <span class="divider">/</span></li>
            <li class="active">Terms &amp; Conditions</li>
        </ul>

        <div class="main_content">
            <h2>Terms &amp; Conditions</h2>

            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </p>

            <p>Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. </p>
            <p>Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. </p>
            <p>Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
            <p>Lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. </p>

            <p>Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.</p>
        </div>
    </div>
</div>