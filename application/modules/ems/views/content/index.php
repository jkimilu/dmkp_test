<h3><?php echo lang('ems_sections'); ?></h3>

<div class="accordion" id="sections_accordion">
    <div class="accordion-group">
        <?php foreach($content_tree as $tree_item_key => $tree_item_value) : ?>
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse_<?php echo $tree_item_key; ?>">
                    <strong><?php echo $lang_items[$tree_item_value[0]]; ?></strong>
                </a>

                <div id="collapse_<?php echo $tree_item_key; ?>" class="accordion-body collapse in">
                    <div class="accordion-inner">
                        <?php foreach($tree_item_value[1] as $tree_sub_item_key => $tree_sub_item_value) : ?>
                            <?php if(!is_array($tree_sub_item_value[1])) : ?>
                                <div><a href="<?php echo site_url('admin/content/ems/content_edit/'.$tree_item_value[0].'/'.$tree_sub_item_value); ?>"><?php echo $lang_items[$tree_sub_item_value]; ?></a></div>
                            <?php else : ?>
                                <div><a href="<?php echo site_url('admin/content/ems/content_edit/'.$tree_item_value[0].'/'.$tree_sub_item_value[0]); ?>"><?php echo $lang_items[$tree_sub_item_value[0]]; ?></a></div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
