<div class="navbar2">
    <!-- .max-width -->
    <div class="max-width">
        <ul class="unstyled inline ul_navbar2">
            <li <?php echo(isset($dm_policies_active) ? 'class="active"' : ''); ?>><a data-original-title="Disaster Management Policies" href="<?php echo site_url('dm_policies'); ?>" class="tipify" title="" data-placement="bottom"><i class="fa fa-newspaper-o"></i> DM Policies</a></li>
            <li <?php echo(isset($dm_standards_active) ? 'class="active"' : ''); ?>><a data-original-title="Disaster Management Standards" href="<?php echo site_url('dm_standards'); ?>" class="tipify" title="" data-placement="bottom"><i class="fa fa-list-ul"></i> DM Standards</a></li>
            <li <?php echo(isset($ems_active) ? 'class="active"' : ''); ?>><a data-original-title="Emergence Management Manual" href="<?php echo site_url('ems'); ?>" class="tipify" title="" data-placement="bottom"><i class="fa fa-book"></i> EMS Manual</a></li>
            <li <?php echo(isset($dm_prepare_active) ? 'class="active"' : ''); ?>><a data-original-title="Disaster Management Preparedness" href="<?php echo site_url('dm_prepare'); ?>" class="tipify" title="" data-placement="bottom"><i class="fa fa-umbrella"></i> DM Preparedness</a></li>
            <li <?php echo(isset($capacity_building_active) ? 'class="active"' : ''); ?>><a data-original-title="Capacity Building" href="<?php echo site_url('capacity_building'); ?>" class="tipify" title="" data-placement="bottom"><i class="fa fa-graduation-cap"></i> Capacity Building</a></li>
        </ul>
    </div>
    <!-- /.max-width -->
</div>