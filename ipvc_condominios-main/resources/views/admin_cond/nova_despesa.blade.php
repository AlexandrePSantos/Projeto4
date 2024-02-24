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
    
    <link href="{{ url('assets/plugins/gridforms/gridforms/gridforms.css') }}" type="text/css" rel="stylesheet"> 
    <link href="{{ url('assets/plugins/pines-notify/pnotify.css') }}" type="text/css" rel="stylesheet">									<!-- Gridforms -->

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
                                <li><a href="/despesas">Despesas</a></li>
                                <li class="active"><a href="#">Nova Despesa</a></li>
                            </ol>
                            <div class="page-heading">
                               <h1>Nova Despesa</h1>
                            </div>
                                <div class="container-fluid">
                                    <div data-widget-group="group1">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="panel panel-white" data-widget='{"draggable": "false"}'>
                                                    <div class="panel-heading">
                                                        <h2>Nova Despesa</h2>
                                                    </div>
                                                    <div class="panel-body">
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
                                                        <form method="POST" class="grid-form" action="{{ route('confirmarNovaDespesa') }}">    
                                                                @csrf	
                                                                <fieldset>
                                                                    <legend>Dados da Despesa</legend>
                                                                    <div data-row-span="2">
                                                                        <div data-field-span="1">   
                                                                            <label>Condominio</label> 
                                                                            <select name="condominio">
                                                                                @foreach ($condominios as $condominio)
                                                                                    @if ($condominio->id == Session::get('condominio'))    
                                                                                        <option value="{{ $condominio->id }}" selected>{{ $condominio->nome }}</option>
                                                                                    @else
                                                                                        <option value="{{ $condominio->id }}">{{ $condominio->nome }}</option>
                                                                                    @endif
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <div data-field-span="1">
                                                                            <label>Data</label>
                                                                            <input type="date" style="border:0" name="data" value="{{ date('Y-m-d') }}" required>
                                                                        </div>
                                                                    </div>

                                                                    <div data-row-span="2">
                                                                        <div data-field-span="1">
                                                                            <label>Descrição</label>
                                                                            <input type="text" name="descricao" required>
                                                                            </select>
                                                                        </div>

                                                                        <div data-field-span="1">
                                                                            <label>Valor</label>
                                                                            <input type="number" style="border:0" name="valor" required>€
                                                                        </div>
                                                                    </div>
                                                                </fieldset>

                                                                <div class="clearfix pt-md">
                                                                    <div class="pull-right">
                                                                        <button class="btn-raised btn-primary btn">Enviar</button>
                                                                        <a href="/despesas" class="btn-default btn">Cancelar</a>
                                                                    </div>
                                                                </div>
                                                            </form>
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
<script src="{{ url('assets/demo/demo.js') }}"></script>
<script src="{{ url('assets/demo/demo-switcher.js') }}"></script>

<!-- End loading site level scripts -->
    
    <!-- Load page level scripts-->
    
<script src="{{ url('assets/plugins/gridforms/gridforms/gridforms.js') }}"></script>  								<!-- Gridforms -->

    <!-- End loading page level scripts-->
    <script src="assets/plugins/bootbox/bootbox.js"></script>
    <script src="assets/plugins/pines-notify/pnotify.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/main/adm_cond.js"></script>
    </body>
</html>