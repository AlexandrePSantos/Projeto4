<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">
	<!-- <div id="page-progress-loader" class="show"></div> -->

	<div class="logo-area">
		<a class="navbar-brand navbar-brand-primary" href="#">
			<img class="show-on-collapse img-logo-white" alt="Paper" src="favicon.png">
			<img class="show-on-collapse img-logo-dark" alt="Paper" src="favicon.png">
			<img class="img-white" alt="Paper" src="{{ url('favicon.png') }}">
			<img class="img-dark" alt="Paper" src="{{ url('favicon.png') }}">
		</a>

		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg stay-on-search">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
				<span class="icon-bg">
					<i class="material-icons">menu</i>
				</span>
			</a>
		</span>

	</div><!-- logo-area -->

	<ul class="nav navbar-nav toolbar pull-right">
		
		<li class="dropdown" style="height: 64px;transition-duration: 300ms;color:#757575">
			<a href="#" class="dropdown-toggle" data-toggle='dropdown'>{{ Auth::user()->nome }} <span class="icon-bg"><i class="material-icons">settings</i></span><span
			class="badge badge-info"></span></a>
			<div class="dropdown-menu animated notifications">
				<div class="topnav-dropdown-header">
					<span>Definições da Conta</span>
				</div>
				<div class="topnav-dropdown-footer">
					<a href="/forgot-password">Mudar Password</a>
				</div>
				<div class="topnav-dropdown-footer">
					<a style="color:red;" href="/signout">Sair da Conta</a>
				</div>
			</div>
		</li>
		
	</ul>

</header>