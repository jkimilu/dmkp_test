<!-- .row-alert -->
<div class="row-fluid row-alert">
    <div class="span12">
        <!-- .alert -->
        <?php if(isset($pageAlert)) : ?>
            <div class="alert alert-block alert-info fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p><i class="fa fa-warning"></i> <?php echo $pageAlert; ?></p>
            </div>
        <?php endif; ?>
        <!-- /.alert -->
    </div>
</div>
<!-- /.row-alert -->

<!-- row-fluid -->
<div class="row-fluid row-fluid-into">
    <!-- left -->
    <div class="span10">
        <div class="dm_intro">
            <div class="img" style="background-image: url('<?php echo(base_url('themes/dmkp/img/capacity_building.jpg')); ?>');">&nbsp;</div>
            <h2><i class="fa fa-graduation-cap"></i> Capacity Building</h2>
            <p>HEA focuses at both the organisational and individual staff levels to improve disaster management practice within World Vision. HEA seeks to strengthen the quality of our disaster management work by building capable staff, effective organisational systems and quality programming underpinned by the application of learning.  This page contains some links to relevant resources for response teams.</p>
        </div>
    </div>
    <!-- /left -->

    <!-- right -->
    <div class="span2">
        <?php echo $keyInsights; ?>
    </div>
    <!-- /right -->
</div>
<!-- /row-fluid -->
<!-- row-fluid -->

<div class="row-fluid">
    <!-- .overflow_auto_mru -->
    <div class="overflow_auto overflow_auto_mru">
        <ul class="nav nav-tabs ul_mru pull-left">
            <?php foreach($categories as $categoryKey => $categoryValue) : ?>
                <li <?php if(${"{$categoryKey}_active"}) { ?> class="active" <?php } ?>><a href="<?php echo $tabsUrl.'?category='.$categoryKey; ?>"><h4><?php echo $categoryValue; ?></h4></a></li>
            <?php endforeach; ?>
        </ul>
        <!-- search form -->
        <?php search_form('', true, 'capacity_building', true); ?>
        <!-- /search form -->
    </div>
    <!-- /.overflow_auto_mru -->

    <!-- mru -->
    <div class="mru">
        <?php echo $listView; ?>
    </div>
    <!-- mru -->

</div>
<!-- /row-fluid -->