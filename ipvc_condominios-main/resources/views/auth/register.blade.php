<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>Gestão de Condomínios</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="author" content="Diogo Machado e Rui Alves">

    <link rel="shortcut icon" href="{{ url('favicon.png') }}">

    <link type='text/css' href='http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500' rel='stylesheet'>
    <link type='text/css'  href="https://fonts.googleapis.com/icon?family=Material+Icons"  rel="stylesheet"> 
    <link href="assets/plugins/progress-skylo/skylo.css" type="text/css" rel="stylesheet">                   <!-- Skylo -->

    <link href="assets/fonts/font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet">
    <link href="assets/css/styles.css" type="text/css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
        <link href="assets/css/ie8.css" type="text/css" rel="stylesheet">
        <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->
    
    </head>

    <body class="focused-form animated-content">
        
        
<div class="container" id="registration-form">
	<a href="#" class="login-logo"><img width="15%" src="favicon.png"></a>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
            @foreach ($errors->all() as $error)
                    <div class="alert alert-dismissable alert-danger">
                        <i class="fa fa-close"></i>&nbsp; {{ $error }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
            @endforeach
			<div class="panel panel-default">
				<div class="panel-heading">
					<h2>Criar Conta</h2>
				</div>
				<div class="panel-body">
                    <form method="POST" class="form-horizontal" id="validate-form" action="{{ route('confirmarRegistro') }}">    
                        @csrf
						<div class="form-group mb-md">
	                        <div class="col-xs-8 col-xs-offset-2">
	                        	<input type="text" class="form-control" name="name" id="FulltName" placeholder="Nome" required>
	                        </div>
	                       
						</div>
						<div class="form-group mb-md">
	                        <div class="col-xs-8 col-xs-offset-2">
	                        	<input type="email" class="form-control" name="email" id="Email" placeholder="Email" required>
	                        </div>
						</div>
						<div class="form-group mb-md">
	                        <div class="col-xs-8 col-xs-offset-2">
	                        	<input type="password" class="form-control" name="password" id="Password" placeholder="Password" required>
	                        </div>
						</div>
						<div class="form-group mb-md">
	                        <div class="col-xs-8 col-xs-offset-2">
	                        	<input type="password" class="form-control" name="password_confirmation" id="ConfirmPassword" placeholder="Confirmar Password" required>
	                        </div>
						</div>
						<div class="panel-footer">
                            <div class="clearfix">
                                <a href="/login" class="btn btn-default pull-left">Já tem conta? Login</a>
                                <button class="btn btn-primary btn-raised pull-right">Guardar</button>
                            </div>
                        </div>
					</form>
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
    
    <!-- End loading page level scripts-->
    </body>
</html>