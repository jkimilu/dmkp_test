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

<!-- row-fluid body -->
<div class="row-fluid body">
    <!-- .carousel -->
    <div id="homeCarousel" class="carousel slide">
        <div class="carousel-inner">
            <!-- .item -->
            <div class="item">
                <img src="<?php echo base_url('themes/dmkp/img/books/covers01.jpg'); ?>" alt="">
            </div>
            <!-- /.item -->

            <!-- .item -->
            <div class="item">
                <img src="<?php echo base_url('themes/dmkp/img/books/covers02.jpg'); ?>" alt="">
            </div>
            <!-- /.item -->

            <!-- .item -->
            <div class="item active">
                <img src="<?php echo base_url('themes/dmkp/img/books/covers03.jpg'); ?>" alt="">
            </div>
            <!-- /.item -->
        </div>
    </div>
    <!-- /.carousel -->
</div>
<!-- /row-fluid body -->

<!-- .row-fluid -->
<div class="row-fluid">

    <div class="span12 pane pane-intro">
        <p>Dear <?php echo $logged_in_user['first_name'].' '.$logged_in_user['last_name'] ?>,</p>

        <h2>All the standards, tools &amp; templates conveniently in one place.</h2>
        <p>We have taken time to pool all the resources you need for disaster management work into a single online experience that we have christened `Disaster Management Knowledge Portal`. In so doing it is our hope that you are better equipped to work more effectively. We have divided the resources into 5 broad categories as shown below.</p>
    </div>
</div>
<!-- .row-fluid -->


<!-- .row-fluid-icons -->
<div class="row-fluid row-fluid-icons">
    <div class="span2">
        <h1><i class="fa fa-newspaper-o"></i></h1>
        <a data-original-title="These are policies that govern all disaster management work at a global and national level." href="<?php echo site_url('dm_policies'); ?>" alt="">
            <h4>Disaster Management Policies</h4></a>
    </div>

    <div class="span3">
        <h1><i class="fa fa-list-ul"></i></h1>
        <a data-original-title="This is a list of standards and tools which World Vision uses to `do` disaster management." href="<?php echo site_url('dm_standards'); ?>" class="tipify" title=""><h4>Disaster Management Standards &amp; Guidance</h4></a>
    </div>

    <div class="span2">
        <h1><i class="fa fa-book"></i></h1>
        <a data-original-title="This is a simple approach to manage emergencies." href="<?php echo site_url('ems'); ?>" class="tipify" title=""><h4>Emergency Management System Manual</h4></a>
    </div>

    <div class="span3">
        <h1><i class="fa fa-umbrella"></i></h1>
        <a data-original-title="These are resources to help achieve preparedness in the wake of a disaster." href="<?php echo site_url('dm_preparedness'); ?>" class="tipify" title=""><h4>Disaster Management Preparedness</h4></a>
    </div>

    <div class="span2">
        <h1><i class="fa fa-graduation-cap"></i></h1>
        <a href="<?php echo site_url('capacity_building'); ?>"><h4>Capacity Building Resources</h4></a>
    </div>
</div>
<!-- /.row-fluid-icons -->