<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Gestão de Condomínios</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="description" content="Gestão de Condominios">
    <meta name="author" content="Diogo Machado e Rui Alves">

    <link rel="shortcut icon" href="{{ url('favicon.png') }}">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500' rel='stylesheet'>
    <link type='text/css'  href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet"> 

    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">        <!-- Font Awesome -->
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link href="assets/plugins/codeprettifier/prettify.css" type="text/css" rel="stylesheet">                <!-- Code Prettifier -->

    <link href="assets/plugins/dropdown.js/jquery.dropdown.css" type="text/css" rel="stylesheet">            <!-- iCheck -->
    <link href="assets/plugins/progress-skylo/skylo.css" type="text/css" rel="stylesheet">                   <!-- Skylo -->

    <!--[if lt IE 10]>
        <script src="assets/js/media.match.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <script src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <!-- The following CSS are included as plugins and can be removed if unused-->
    
    <link href="assets/plugins/form-daterangepicker/daterangepicker-bs3.css" type="text/css" rel="stylesheet">    <!-- DateRangePicker -->
    <link href="assets/plugins/fullcalendar/fullcalendar.css" type="text/css" rel="stylesheet">                   <!-- FullCalendar -->
    <link href="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css" type="text/css" rel="stylesheet">
    <link href="assets/less/card.less" type="text/css" rel="stylesheet"> 

    <link href="assets/plugins/chartist/dist/chartist.min.css" type="text/css" rel="stylesheet"> <!-- chartist -->

</head>
    <body class="animated-content infobar-overlay">
        @include('includes.topnav')
            <div id="wrapper">
                <div id="layout-static">
                    @include('includes_admin_cond.sidenav')
                    <div class="static-content-wrapper">
                        <div class="static-content">
                            <div class="page-content">
                                <ol class="breadcrumb">
                                    <li class=""><a href="#">Selecionar Condominio</a></li>
                                </ol>
                                <div class="page-heading">            
                                <h1>Selecionar Condominio</h1>
                                <div class="options"></div>
                            </div>
                            <div class="container" id="login-form">
                                    <div class="row">
                                        <div class="col-md-4 col-md-offset-4">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h2>Selecionar Condominio</h2>
                                                </div>
                                                <div class="panel-body">
                                                    <form method="POST" class="form-horizontal" id="validate-form" action="{{ route('confirmarSelecionarCondominio') }}">
                                                        @csrf
                                                        <div class="form-group mb-md">
                                                            <div class="col-xs-12">
                                                                <select name="condominio" class="select form-control">
                                                                    @foreach ($condominios as $condominio)
                                                                        @if ($condominio->id == Session::get('condominio'))    
                                                                            <option value="{{ $condominio->id }}" selected>{{ $condominio->nome }}</option>
                                                                        @else
                                                                            <option value="{{ $condominio->id }}">{{ $condominio->nome }}</option>
                                                                        @endif
                                                                        
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="panel-footer">
                                                            <div class="clearfix">
                                                                <center><button class="btn btn-primary btn-raised">Continuar</button></center>
                                                            </div>
                                                        </div>
                                                        
                                                    </form>
                                                    <hr>
                                                        <center><a href="/novoCondominio" class="btn btn-primary btn-raised">+ Novo Condominio</a></center>
                                                </div>	
                                            </div>
                                        </div>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Load site level scripts -->

        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

        <script src="assets/js/jquery-1.10.2.min.js"></script> 							<!-- Load jQuery -->
        <script src="assets/js/jqueryui-1.10.3.min.js"></script> 							<!-- Load jQueryUI -->
        <script src="assets/js/bootstrap.min.js"></script> 								<!-- Load Bootstrap -->
        <script src="assets/js/enquire.min.js"></script> 									<!-- Load Enquire -->

        <script src="assets/plugins/velocityjs/velocity.min.js"></script>					<!-- Load Velocity for Animated Content -->
        <script src="assets/plugins/velocityjs/velocity.ui.min.js"></script>

        <script src="assets/plugins/progress-skylo/skylo.js"></script> 		<!-- Skylo -->

        <script src="assets/plugins/wijets/wijets.js"></script>     						<!-- Wijet -->

        <script src="assets/plugins/sparklines/jquery.sparklines.min.js"></script> 			 <!-- Sparkline -->

        <script src="assets/plugins/codeprettifier/prettify.js"></script> 				<!-- Code Prettifier  -->

        <script src="assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js"></script>  <!-- Bootstrap Tabdrop -->

        <script src="assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js"></script> <!-- nano scroller -->

        <script src="assets/plugins/dropdown.js/jquery.dropdown.js"></script> <!-- Fancy Dropdowns -->
        <script src="assets/plugins/bootstrap-material-design/js/material.min.js"></script> <!-- Bootstrap Material -->
        <script src="assets/plugins/bootstrap-material-design/js/ripples.min.js"></script> <!-- Bootstrap Material -->

        <script src="assets/js/application.js"></script>

        <!-- End loading site level scripts -->
            
            <!-- Load page level scripts-->
            
        <!-- Charts -->
        <script src="assets/plugins/charts-flot/jquery.flot.min.js"></script>                 <!-- Flot Main File -->
        <script src="assets/plugins/charts-flot/jquery.flot.pie.min.js"></script>             <!-- Flot Pie Chart Plugin -->
        <script src="assets/plugins/charts-flot/jquery.flot.stack.min.js"></script>           <!-- Flot Stacked Charts Plugin -->
        <script src="assets/plugins/charts-flot/jquery.flot.resize.min.js"></script>          <!-- Flot Responsive -->
        <script src="assets/plugins/charts-flot/jquery.flot.tooltip.min.js"></script>         <!-- Flot Tooltips -->
        <script src="assets/plugins/charts-flot/jquery.flot.spline.js"></script>              <!-- Flot Curved Lines -->
        <script src="assets/plugins/easypiechart/jquery.easypiechart.min.js"></script>        <!-- EasyPieChart-->
        <script src="assets/plugins/curvedLines-master/curvedLines.js"></script>              <!-- marvinsplines -->

        <script src="assets/plugins/form-daterangepicker/moment.min.js"></script>             <!-- Moment.js for Date Range Picker -->

                        <!-- Date Range Picker -->
        <script src="assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js"></script>               <!-- Datepicker -->
        <!-- <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> --> <!-- DateTime Picker -->

        <!-- <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>   -->    <!-- jVectorMap -->
        <!-- <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>  --> <!--World Map-->
        <script src="assets/plugins/chartist/dist/chartist.min.js"></script> <!-- chartist -->

        <!-- End loading page level scripts-->

        <script src="assets/plugins/datatables/jquery.dataTables.js"></script>
        <script src="assets/plugins/datatables/dataTables.bootstrap.js"></script>
        <script src="assets/demo/demo-datatables.js"></script>

    </body>
</html>