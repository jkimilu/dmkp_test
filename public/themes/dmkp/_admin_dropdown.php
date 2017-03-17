<?php if($is_admin) : ?>
    <!-- admin -->
    <div class="btn-group pull-right admin">
        <button class="btn btn-warning"><i class="fa fa-cogs"></i> Admin</button>
        <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>
        <!-- ul -->
        <ul class="dropdown-menu">
            <li><a href="<?php echo(site_url('admin')); ?>" target="_blank"><i class="fa fa-edit"></i> Manage Content</a></li>
            <li><a href="<?php echo(site_url('admin/settings/users')); ?>" target="_blank"><i class="fa fa-users"></i> Manage Users</a></li>
            <li><a href="<?php echo(site_url('admin/settings/roles')); ?>" target="_blank"><i class="fa fa-key"></i> Manage Roles &amp; Permissions</a></li>
            <li class="divider"></li>
            <li><a href="<?php echo(site_url('logout')); ?>"><i class="icon-ban-circle"></i> Log Out</a></li>
        </ul>
        <!-- ul -->
    </div>
    <!-- /admin -->
<?php endif; ?>