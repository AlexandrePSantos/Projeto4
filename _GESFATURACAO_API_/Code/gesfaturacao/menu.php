<!-- CUSTOM STYLES -->
<style type="text/css">
	.divider-custom { height: 3px; /* margin: 2px 0; */ overflow: hidden; background-color: #e5e5e5; }
	.divider-custom2 { height: 1px;  margin: 0px;  overflow: hidden; background-color: #e5e5e5; }
	img.logoimg { max-height: 100px !important; max-width: 100% !important; height: auto !important; width: auto   !important; }
	.nav-gesfaturacao { margin-left: 15px; margin-right: 15px; }
	.nav-gesfaturacao>li>a { padding-right: 10px; padding-left: 10px; }
</style>

<!-- HEADER AND STATS -->
<div class="col-md-12 mts" >
	<div class="row">
		<div class="col-md-2 text-center flt-left mtl no-padding">
			<a href="/gesfaturacao">
				<img class="logoimg" src="<?php echo '/uploads/faturacao/'.$_SESSION['logotipo_gesfaturacao']; ?>" alt="Logotipo">
			</a>
		</div>
		<div class="col-md-3 mtl" >
			<h4><?php echo $_SESSION["designacao_gesfaturacao"]; ?></h4>
			<p>Bem-vindo, <a data-hover="dropdown" href="/definicoes/dados_acesso" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['nome_utilizador']; ?></a><p>
			<p>
				<a class="options-link" href="/definicoes/"><i class="fa fa-cogs"></i> Definições</a> <a class="options-link text-red" href="/server/logout.php"><i class="fa fa-sign-out"></i> Sair</a>
			</p>
			<p>	Idioma &nbsp;
				<select class="lang-select-main">
					<option class="lang-pt lang-select" value="pt">Português</option>
					<option class="lang-en lang-select" value="en">Inglês</option>
					<option class="lang-fr lang-select" value="fr">Francês</option>
					<option class="lang-nl lang-select" value="nl">Holandês</option>
					<option class="lang-de lang-select" value="de">Alemão</option>
					<option class="lang-es lang-select" value="es">Espanhol</option>
				</select>
			</p>
		</div>

		<div class="col-md-7 flt-right no-padding">
			<div class="row">
				<div class="col-md-12" >
				<?php include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/quadro.php'; ?>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- NORMAL MENU BAR -->
<nav class="navbar navbar-custom navbar-gesfaturacao  hidden-xs hidden-sm" role="navigation">
	<div class="container-fluid">
		<div class="collapse navbar-collapse no-padding" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav nav-gesfaturacao">
				<li class="home">
					<a class="mnitemlnk" href="/gesfaturacao">Visão Global</a>
				</li>

				<li class="dropdown artigos clientes tabelas importacao integracao">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tabelas <span class="caret"></span></a>
					<ul class="dropdown-menu mainmenu-right">
						<li class="artigos_artigos">
							<a class="mnitemlnk" href="/gesfaturacao/artigos">Artigos</a>
						</li>

						<hr class="divider-custom2">

						<li class=" clientes_clientes">
							<a class="mnitemlnk" href="/gesfaturacao/clientes">Clientes</a>
						</li>
					</ul>
				</li>

				<li class="dropdown mapas">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mapas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown dropdown-submenu clientes_mapas">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mapas de Clientes</a>
							<ul class="dropdown-menu submenu-left">
								<li class=" clientes_mapas">
									<a class="mnitemlnk" href="/gesfaturacao/mapas/clientes">Mapa de Clientes</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>

<!-- MOBILE MENU -->
<div id="header-topbar-option-demo" class="page-header-topbar hidden-md hidden-lg mbl">
	<nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;" class="navbar navbar-custom navbar-gesfaturacao">
		<div class="navbar-header" style="width: 100%;">
			<button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
	</nav>

	<style type="text/css">
		#sidebar { background: #33485c; min-height: 0% !important; margin-left: 1px !important; margin-right: 1px !important;}
		#sidebar ul#side-menu li a { padding: 12px 15px !important; font-weight: bolder;}
		/*ul#side-menu li { min-height: 40px }*/
	</style>

	<nav id="sidebar" role="navigation" class="navbar-gesfaturacao navbar-static-side">
		<div class="sidebar-collapse menu-scroll collapse">
			<ul id="side-menu" class="nav nav-settings">
				<li class="home">
					<a class="mnitemlnk" href="/gesfaturacao">Visão Global</a>
				</li>

				<li class="dropdown artigos clientes tabelas importacao integracao">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tabelas <span class="caret"></span></a>
					<ul class="dropdown-menu mainmenu-right">
						<li class="artigos_artigos">
							<a class="mnitemlnk" href="/gesfaturacao/artigos">Artigos</a>
						</li>

						<hr class="divider-custom2">

						<li class=" clientes_clientes">
							<a class="mnitemlnk" href="/gesfaturacao/clientes">Clientes</a>
						</li>
					</ul>
				</li>

				<li class="dropdown mapas">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mapas <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li class="dropdown dropdown-submenu clientes_mapas">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Mapas de Clientes</a>
							<ul class="dropdown-menu submenu-left">
								<li class=" clientes_mapas">
									<a class="mnitemlnk" href="/gesfaturacao/mapas/clientes">Mapa de Clientes</a>
								</li>
							</ul>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</div>

<!-- LOADING -->
<div align="center" class="fullscreen"><i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw " style="margin-top: 20%"></i></div>
