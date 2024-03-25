<html lang="pt">
<head>
	<title>GESFaturação | Software de Faturação Online</title>
	<meta charset="utf-8">
	<link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="noindex"/>

	<link rel="stylesheet" href="/css/font-awesome.min.css">
	<link type="text/css" rel="stylesheet" href="/fonts/opensans.css">
	<link type="text/css" rel="stylesheet" href="/fonts/oswald.css">
	<link type="text/css" rel="stylesheet" href="css/jquery-ui-1.10.4.custom.min.css">
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css">
	<link type="text/css" rel="stylesheet" href="css/sco.message.css">
	<link type="text/css" rel="stylesheet" href="css/style-responsive.css">
	<link rel="stylesheet" href="/js/vendors/bootstrap-select/bootstrap-select.min.css">

	<link type="text/css" rel="stylesheet" href="css/orange-blue.css" >
	<link type="text/css" rel="stylesheet" href="css/gesautarquia.css" >
	<link type="text/css" rel="stylesheet" href="/css/gesfaturacao.css" >

	<link rel="stylesheet" type="text/css" href="css/jquery.ml-keyboard.css"/>
	<style>
		/*virtual keyboard*/
		@media screen and (min-width: 700px) {
			.keyboard-corner {
				bottom: 315px;
				right: 500px;
			}

			div#mlkeyboard ul li.active {
				background-color: #5F8C46;
				border-color: #6FDA54;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul {
				width: 1000px;
				height: 346px;
				margin:0 auto;
				padding:0px;
				border-radius:5px 5px 0 0
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul li {
				width:60px;
				height:60px;
				line-height:60px;
				margin:2.5px
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-backspace {
				width: 93px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-tab {
				width: 93.5px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-capslock {
				width: 110.5px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-return {
				width: 112px;
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-space {
				width: 990px;
			}
		}

		@media screen and (min-width: 540px) {
			div#mlkeyboard ul #mlkeyboard-right-shift {
				width: 147px;
				margin-right:0
			}
		}

		@media screen and (min-width: 700px) {
			div#mlkeyboard ul #mlkeyboard-left-shift {
				width: 144px;
			}
		}

		div#mlkeyboard ul li {
			border: 2px solid #e86646;
			color: #333;
			font-size: 25px;
			font-weight: bold;
			border-radius: 0px;
		}

		#mlkeyboard{
			z-index:250000;
		}

		div#mlkeyboard ul {
			margin-bottom: 5px !important;
			border-radius: 5px;
		}

		div#mlkeyboard ul.mlkeyboard-modifications{
			height:69px
		}

		.keyboard-corner {
			bottom: 375px !important;
			left: 955px !important;
			position: relative !important;
		}

		.circle {
			background: white;
			width: 40px;
			height: 40px;
			/* background: transparent;*/
			border: 4px solid #cd0c0d;
			-moz-border-radius: 50%;
			-webkit-border-radius: 50%;
			border-radius: 50%;
			position: relative;
			cursor: pointer;
			display: inline-block;
			margin: 10px 20px;
		}
		.circle:after {
			width: 24px;
			height: 4px;
			background-color: #cd0c0d;
			content: "";
			left: 50%;
			top: 50%;
			margin-left: -12px;
			margin-top: -2px;
			position: absolute;
			-moz-transform: rotate(-45deg);
			-ms-transform: rotate(-45deg);
			-webkit-transform: rotate(-45deg);
			transform: rotate(-45deg);
			/*@include transform-origin(100%,100%);*/
		}
		.circle:before {
			left: 50%;
			top: 50%;
			margin-left: -12px;
			margin-top: -2px;
			width: 24px;
			height: 4px;
			background-color: #cd0c0d;
			content: "";
			position: absolute;
			-moz-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			-webkit-transform: rotate(45deg);
			transform: rotate(45deg);
			/*@include transform-origin(0%,0%);*/
		}
	</style>
    </head>

    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <!--loading bootstrap js-->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <!-- <script src="js/sco.message.js"></script> -->
    <script src="/js/vendors/sco.message/sco.message.js"></script>

    <script src="/js/vendors/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="/js/vendors/bootstrap-select/defaults-pt_BR.min.js"></script>

    <script type="text/javascript" src="/js/jquery.ml-keyboard.min.js"></script>
    </html>
