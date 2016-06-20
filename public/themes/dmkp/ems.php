<!DOCTYPE html>
<html lang="en">
    <?php echo theme_view('_header'); ?>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid max-width">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="brand" href="<?php echo site_url(); ?>"><span>Emergency Management System</span><span class="hidden">EMS</span> Manual</a>

                <div class="nav-collapse collapse">
                    <div class="btn-group pull-right account">
                        <button class="btn"><i class="fa fa-eye"></i> <?php echo $ems_tree_lang[$view_active_role]; ?></button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('dmkp/export_pdf'); ?>" target="_blank"><i class="fa fa-print"></i> Printer Friendly</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Views</li>

                            <?php foreach($view_roles as $role) : ?>
                                <li <?php echo $view_active_role == $role ? 'class="disabled"' : ""; ?>><a href="<?php echo site_url('dmkp/change_view_role/'.$role); ?>"><?php echo $view_active_role == $role ? '<i class="fa fa-check"></i>' : '<i class="fa fa-eye"></i>'; ?> <?php echo $ems_tree_lang[$role]; ?></a></li>
                            <?php endforeach; ?>

                            <li class="divider"></li>

                            <li><a href="#logoutModal" data-toggle="modal"><i class="icon-ban-circle"></i> Log Out</a></li>
                        </ul>
                    </div>

                    <?php if($is_admin) : ?>

                        <div class="btn-group pull-right admin">
                            <button class="btn btn-warning"><i class="fa fa-wrench"></i> Admin</button>
                            <button class="btn btn-warning dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>

                            <ul class="dropdown-menu">
                                <li><a href="<?php echo(site_url('admin/content/ems')); ?>" target="_blank"><i class="fa fa-edit"></i> Manage Content</a></li>
                                <li><a href="<?php echo(site_url('admin/settings/users')); ?>" target="_blank"><i class="fa fa-users"></i> Manage Users</a></li>
                                <li><a href="<?php echo(site_url('admin/settings/roles')); ?>" target="_blank"><i class="fa fa-key"></i> Manage Roles &amp; Permissions</a></li>
                                <li class="divider" role="presentation"></li>
                                <li><a href="<?php echo site_url('users/logout'); ?>"><i class="icon-ban-circle"></i> Logout</a></li>
                            </ul>
                        </div>

                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid max-width">

        <?php if(isset($global_alert)) : ?>
            <div class="row-fluid row-alert">
                <div class="span12">
                    <div class="alert alert-block alert-info fade in">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <p><i class="fa fa-warning"></i> <?php echo $global_alert; ?></p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

<?php
    echo Template::message();
    echo isset($content) ? $content : Template::content();
?>

    <?php echo theme_view('_footer'); ?>
</html>