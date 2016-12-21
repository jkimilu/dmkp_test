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
            <a class="brand" href="<?php echo site_url('/'); ?>"><span><i class="fa fa-bank"></i> DMK </span> <span class="hidden">DMK</span> Portal</a>
            <!-- .nav-collapse -->
            <div class="nav-collapse collapse">
                <!-- account -->
                <div class="btn-group pull-right account">
                    <button class="btn"><i class="fa fa-user"></i> <?php echo $logged_in_user['first_name'].' '.$logged_in_user['last_name'] ?></button>
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                    </button>

                    <!-- ul -->
                    <ul class="dropdown-menu">
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