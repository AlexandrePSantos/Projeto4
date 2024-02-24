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
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="shortcut icon" href="{{ url('favicon.png') }}">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500' rel='stylesheet'>
    <link type='text/css'  href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet"> 

    <link href="{{ url('assets/fonts/font-awesome/css/font-awesome.min.css') }}" type="text/css" rel="stylesheet">        <!-- Font Awesome -->
    <link href="{{ url('assets/css/styles.css') }}" type="text/css" rel="stylesheet">                                     <!-- Core CSS with all styles -->

    <link href="{{ url('assets/plugins/codeprettifier/prettify.css') }}" type="text/css" rel="stylesheet">                <!-- Code Prettifier -->

    <link href="{{ url('assets/plugins/dropdown.js/jquery.dropdown.css') }}" type="text/css" rel="stylesheet">            <!-- iCheck -->
    <link href="{{ url('assets/plugins/progress-skylo/skylo.css') }}" type="text/css" rel="stylesheet">                   <!-- Skylo -->

    <!--[if lt IE 10]>
        <script src="assets/js/media.match.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <script src="assets/js/placeholder.min.js"></script>
    <![endif]-->
    <!-- The following CSS are included as plugins and can be removed if unused-->
    
    <link href="{{ url('assets/plugins/form-daterangepicker/daterangepicker-bs3.css') }}" type="text/css" rel="stylesheet">    <!-- DateRangePicker -->
    <link href="{{ url('assets/plugins/fullcalendar/fullcalendar.css') }}" type="text/css" rel="stylesheet">                   <!-- FullCalendar -->
    <link href="{{ url('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ url('assets/less/card.less') }}" type="text/css" rel="stylesheet"> 

    <link href="{{ url('assets/plugins/chartist/dist/chartist.min.css') }}" type="text/css" rel="stylesheet"> <!-- chartist -->

</head>
    <body class="animated-content infobar-overlay">
        @include('includes.topnav')
            <div id="wrapper">
                <div id="layout-static">
                    @include('includes.sidenav')
                    <div class="static-content-wrapper">
                        <div class="static-content">
                            <div class="page-content">
                                <ol class="breadcrumb">
                                    <li class=""><a href="#">Pagamentos</a></li>
                                </ol>
                                <div class="page-heading">            
                                <h1>Pagamentos - {{ $habitacaoAtual->portaria }} ({{ $habitacaoAtual->tipo }})</h1><br><br>
                                <div class="options"></div>
                            </div>
                            <div class="container-fluid">
                                    <div data-widget-group="group1">                                   
                                        <div class="row">
                                            <div class="col-md-12">
                                            @foreach ($errors->all() as $error)
                                                <div class="alert alert-dismissable alert-danger">
                                                    <i class="fa fa-close"></i>&nbsp; {{ $error }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                </div>
                                            @endforeach
                                            @if (Session::has('success'))
                                                <div class="alert alert-dismissable alert-success">
                                                    <i class="fa fa-close"></i>&nbsp; {{ Session::get('success') }}
                                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                                </div>
                                            @endif
                                            <div class="panel panel-primary" data-widget='{"draggable": "false"}'>
                <div class="panel-heading">
                    <h2>Pagamentos</h2>
                    <!-- <div class="panel-ctrls" data-actions-container="" data-action-collapse='{"target": ".panel-body, .panel-footer"}'></div> -->
                    <div class="options">
                        <ul class="nav nav-tabs">
                        <li><a class="atualizarTabela" data-id="todos" data-toggle="tab">Todos</a></li>
                        <li><a class="atualizarTabela" data-id="pago" data-toggle="tab">Pago</a></li>
                        <li class="active"><a class="atualizarTabela" data-id="por_pagar" data-toggle="tab">Por Pagar</a></li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="por_pagar">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h2>Pagamentos</h2>
                                            <div class="panel-ctrls"></div>
                                        </div>
                                        <div class="panel-body no-padding">
                                            <table class="table table-striped table-bordered" id="tablePagamentos" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Data</th>
                                                        <th>Valor</th>
                                                        <th>Estado</th>
                                                        <th>Proprietário</th>
                                                        <th>Ações</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="panel-footer"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
                                            </div>
                                        </div>

                                    </div>
                                </div> <!-- .container-fluid -->
                            </div> <!-- #page-content -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Load site level scripts -->

        <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> -->

        <script src="{{ url('assets/js/jquery-1.10.2.min.js') }}"></script> 							<!-- Load jQuery -->
        <script src="{{ url('assets/js/jqueryui-1.10.3.min.js') }}"></script> 							<!-- Load jQueryUI -->
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script> 								<!-- Load Bootstrap -->
        <script src="{{ url('assets/js/enquire.min.js') }}"></script> 									<!-- Load Enquire -->

        <script src="{{ url('assets/plugins/velocityjs/velocity.min.js') }}"></script>					<!-- Load Velocity for Animated Content -->
        <script src="{{ url('assets/plugins/velocityjs/velocity.ui.min.js') }}"></script>

        <script src="{{ url('assets/plugins/progress-skylo/skylo.js') }}"></script> 		<!-- Skylo -->

        <script src="{{ url('assets/plugins/wijets/wijets.js') }}"></script>     						<!-- Wijet -->

        <script src="{{ url('assets/plugins/sparklines/jquery.sparklines.min.js') }}"></script> 			 <!-- Sparkline -->

        <script src="{{ url('assets/plugins/codeprettifier/prettify.js') }}"></script> 				<!-- Code Prettifier  -->

        <script src="{{ url('assets/plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js') }}"></script>  <!-- Bootstrap Tabdrop -->

        <script src="{{ url('assets/plugins/nanoScroller/js/jquery.nanoscroller.min.js') }}"></script> <!-- nano scroller -->

        <script src="{{ url('assets/plugins/dropdown.js/jquery.dropdown.js') }}"></script> <!-- Fancy Dropdowns -->
        <script src="{{ url('assets/plugins/bootstrap-material-design/js/material.min.js') }}"></script> <!-- Bootstrap Material -->
        <script src="{{ url('assets/plugins/bootstrap-material-design/js/ripples.min.js') }}"></script> <!-- Bootstrap Material -->

        <script src="{{ url('assets/js/application.js') }}"></script>

        <!-- End loading site level scripts -->
            
            <!-- Load page level scripts-->
            
        <!-- Charts -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.min.js') }}"></script>                 <!-- Flot Main File -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.pie.min.js') }}"></script>             <!-- Flot Pie Chart Plugin -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.stack.min.js') }}"></script>           <!-- Flot Stacked Charts Plugin -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.resize.min.js') }}"></script>          <!-- Flot Responsive -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.tooltip.min.js') }}"></script>         <!-- Flot Tooltips -->
        <script src="{{ url('assets/plugins/charts-flot/jquery.flot.spline.js') }}"></script>              <!-- Flot Curved Lines -->
        <script src="{{ url('assets/plugins/easypiechart/jquery.easypiechart.min.js') }}"></script>        <!-- EasyPieChart-->
        <script src="{{ url('assets/plugins/curvedLines-master/curvedLines.js') }}"></script>              <!-- marvinsplines -->

        <script src="{{ url('assets/plugins/form-daterangepicker/moment.min.js') }}"></script>             <!-- Moment.js for Date Range Picker -->

                        <!-- Date Range Picker -->
        <script src="{{ url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>               <!-- Datepicker -->
        <!-- <script src="assets/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script> --> <!-- DateTime Picker -->

        <!-- <script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>   -->    <!-- jVectorMap -->
        <!-- <script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>  --> <!--World Map-->
        <script src="{{ url('assets/plugins/chartist/dist/chartist.min.js') }}"></script> <!-- chartist -->

        <!-- End loading page level scripts-->

        <script src="{{ url('assets/plugins/bootbox/bootbox.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/jquery.dataTables.js') }}"></script>
        <script src="{{ url('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="{{ url('assets/js/main/prop.js') }}"></script>

    </body>
</html>