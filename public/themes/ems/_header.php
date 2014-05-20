<head>
    <meta charset="utf-8">
    <title><?php echo isset($page_title) ? $page_title .' : ' : ''; ?> - Emergency Management System - World Vision</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/bootstrap.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/bootstrap-reset.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/site.css'); ?>"/>

    <style>
        body {
            padding-top: 55px; /* 55px to make the container go all the way to the bottom of the topbar */
        }
    </style>

    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/bootstrap-responsive.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/site-responsive.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('themes/ems/css/font-awesome.min.css'); ?>"/>

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="<?php echo base_url('themes/ems/js/html5shiv.js'); ?>"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('themes/ems/ico/apple-touch-icon-144-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('themes/ems/ico/apple-touch-icon-114-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('themes/ems/ico/apple-touch-icon-72-precomposed.png'); ?>">
    <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('themes/ems/ico/apple-touch-icon-57-precomposed.png'); ?>">
    <link rel="shortcut icon" href="<?php echo base_url('themes/ems/ico/favicon.png'); ?>">
</head>

<body>
    <!-- navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid max-width">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="brand" href="<?php echo site_url(); ?>">  Emergency Management System</a>

                <div class="nav-collapse collapse">
                    <div class="btn-group pull-right account">
                        <button class="btn"><i class="fa fa-eye"></i> Default</button>
                        <button class="btn dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>

                        <ul class="dropdown-menu">
                            <li><a href="#"><i class="fa fa-print"></i> Printer Friendly</a></li>
                            <li> <a href="account.html"><i class="fa fa-user"></i>  My Account</a></li>
                            <li class="divider"></li>
                            <li class="nav-header">Views</li>
                            <li class="disabled"><a href="#"><i class="fa fa-check"></i> Default</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Quick Read</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Response Manager</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Programmes Function Lead</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Operations Function Lead</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Support Services Function Lead</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Liaison Function Lead</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Security Function Lead</a></li>
                            <li><a href="#"><i class="fa fa-eye"></i> Senior Leadership</a></li>
                            <li class="divider"></li>
                            <li><a href="#logoutModal" data-toggle="modal"><i class="icon-ban-circle"></i> Log Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid max-width">