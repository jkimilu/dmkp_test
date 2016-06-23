<!-- .row-alert -->
<div class="row-fluid row-alert">
    <div class="span12">
        <!-- .alert -->
        <div class="alert alert-block alert-info fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <p><i class="fa fa-warning"></i> Regular alerts will go here. If any.</p>
        </div>
        <!-- /.alert -->
    </div>
</div>
<!-- /.row-alert -->

<!-- row-fluid -->
<div class="row-fluid row-fluid-into">
    <!-- left -->
    <div class="span10">

        <div class="dm_intro">
            <div class="img" style="background-image: url('<?php echo(base_url('themes/dmkp/img/hurricane.jpg')); ?>');">&nbsp;</div>

            <h2><i class="fa fa-umbrella"></i> Disaster Management Preparedness</h2>

            <p>World Vision defines preparedness as <span style="font-style:italic">"Achieving preparedness means organisational and community readiness systems, procedures and resources are available to provide timely assistance to those affected. Standards, tools, mechanisms and resources are in place. Disaster-management plans are in place which enable communities to identify areas of vulnerability to their immediate and long-term well-being; to mitigate risks; and to prepare for response in the case of risks which cannot be resolved."</span></p>

            <p>This section contains helpful resources to help achieve preparedness in the follow categories.</p>
        </div>
    </div>
    <!-- /left -->

    <!-- right -->
    <div class="span2">
        <div class="pane pane_insights">
            <h5><i class="fa fa-eye"></i> Key Insights</h5>

            <ul class="unstyled">
                <li><i class="fa fa-file"></i> 230 files</li>
                <li><i class="fa fa-file"></i> 42 links</li>
            </ul>

        </div>
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
        <form class="form-search form-search-mru pull-right" enctype="multipart/form-data" method="get" action="">
            <input name="search" type="text" placeholder="Search" class="search-query">
        </form>
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

<!-- .row-fluid footer -->
<div class="row-fluid footer">
    <hr>

    <ul class="unstyled inline pull-left">
        <li><a href="copyright.html">Copyright Notice</a></li>
        <li class="administrator"><a href="admin.html" target="_blank">Admin</a></li>
    </ul>

    <ul class="unstyled inline pull-right">
        <li>© World Vision International 2016 | All Rights Reserved</li>
    </ul>
</div>
<!-- /.row-fluid footer -->