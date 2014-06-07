<head>
    <meta charset="utf-8">
    <title><?php echo isset($page_title) ? $page_title. ' : ' : ''; ?>Emergency Management System - World Vision</title>
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
        </div>
    </div>
</div>

<div class="container-fluid max-width">

    <div class="row-fluid row-alert">

        <div class="span12">
            <div class="alert alert-block alert-info fade in">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <p><i class="fa fa-warning"></i> Regular alerts will go here. If any.</p>
            </div>
        </div>
    </div>