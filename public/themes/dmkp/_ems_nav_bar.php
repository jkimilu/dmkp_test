<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- .navbar-inner -->
    <div class="navbar-inner">
        <!-- .container-fluid max-width -->
        <div class="container-fluid max-width">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="brand" href="home.html"><span><i class="fa fa-bank"></i> DMK </span> <span class="hidden">DMK</span> Portal</a>
            <!-- .nav-collapse -->
            <div class="nav-collapse collapse">
                <!-- account -->
                <div class="btn-group pull-right account">
                    <button class="btn"><i class="fa fa-eye"></i> Default</button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>

                    <!-- ul -->
                    <ul class="dropdown-menu">
                        <li><a href="print.html"><i class="fa fa-print"></i> Print</a></li>
                        <li class="divider"></li>
                        <li class="nav-header">Views</li>
                        <?php foreach($view_roles as $role) : ?>
                            <li <?php echo $view_active_role == $role ? 'class="disabled"' : ""; ?>><a href="<?php echo site_url('ems/change_view_role/'.$role); ?>"><?php echo $view_active_role == $role ? '<i class="fa fa-check"></i>' : '<i class="fa fa-eye"></i>'; ?> <?php echo $ems_tree_lang[$role]; ?></a></li>
                        <?php endforeach; ?>
                        <li><a href="#logoutModal" data-toggle="modal"><i class="icon-ban-circle"></i> Log Out</a></li>
                    </ul>
                    <!-- ./ul -->
                </div>
                <!-- /account -->
                <?php echo theme_view('_admin_dropdown'); ?>
                <!-- search form -->
                <?php search_form(); ?>
                <!-- /search form -->
            </div>
            <!-- /.nav-collapse -->
        </div>
        <!-- /.container-fluid max-width -->
    </div>
    <!-- /.navbar-inner -->
</div>