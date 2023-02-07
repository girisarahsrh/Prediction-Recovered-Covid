
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>COVID-19 REPORT</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="<?= base_url()."Assets"?>/graphicon.svg">
    <link rel="shortcut icon" href="<?= base_url()."Assets"?>/graphicon.svg">

    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="<?= base_url()."Assets"?>/vendors/jqvmap/dist/jqvmap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="<?= base_url()."Assets"?>/assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>


    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>CC/HomePage"><img src="<?= base_url()."Assets"?>/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand hidden" href="<?= base_url(); ?>CC/HomePage"><img src="<?= base_url()."Assets"?>/images/logo2.png" alt="Logo"></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="<?= base_url(); ?>CC/HomePage"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>
                    <h3 class="menu-title">Data</h3><!-- /.menu-title -->
                    <li>
                        <a href="<?= base_url(); ?>CC/MasterData"> <i class="menu-icon ti-desktop"></i>Master data </a>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-plus"></i>Input</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li hidden><i class="menu-icon fa fa-plus"></i><a href="<?= base_url(); ?>CC/InputForecast">Input Forecast</a></li>
                            <li><i class="menu-icon fa fa-plus"></i><a href="<?= base_url(); ?>CC/InputMaster">Input Master</a></li>
                        </ul>
                    </li>
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon ti-layout-column3"></i>Forecast</a>
                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="menu-icon fa fa-refresh"></i><a href="<?= base_url(); ?>CC/NormalisasiPage">Normalitation</a></li>
                            <li><i class="menu-icon fa fa-line-chart"></i><a href="<?= base_url(); ?>CC/ProcessPage">Process (Training)</a></li>
                            <li><i class="menu-icon fa fa-clipboard"></i><a href="<?= base_url(); ?>CC/FinalPage">Final (Testing)</a></li>
<!--                             <li><i class="menu-icon fa fa-calculator"></i><a href="<?= base_url(); ?>CC/AllAlgoritmaPage">ALL ALGORITHM</a></li> -->
                        </ul>
                    </li>

                    <li>
                        <a href="<?= base_url(); ?>CC/Report"> <i class="menu-icon ti-clipboard"></i>Report </a>
                    </li>
                    
                </ul>

            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-7">

                </div>

<!--                 <div class="col-sm-5">
                    <div class="user-area dropdown float-right">
                        <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
                    </div>

                </div> -->
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-10">
                <div class="page-header float-left">
                    <div class="page-title">
                        <b><h1>Prediction System For The Number of Patients Recovering From COVID-19 From Each Country</h1></b>
                    </div>
                </div>
            </div>

            <div class="col-sm-2">
                <div class="page-header float-left">
                    <div class="page-title">
                        <div class="user-area dropdown float-right">
                            <a class="nav-link" href="<?= base_url(); ?>CC/Logout"><i class="fa fa-power-off"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>