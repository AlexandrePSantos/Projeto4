<style type="text/css">
	.divider-custom { height: 3px; /* margin: 2px 0; */ overflow: hidden; background-color: #e5e5e5; }
	.divider-custom2 { height: 1px;  margin: 0px;  overflow: hidden; background-color: #e5e5e5; }
	img.logoimg { max-height: 100px !important; max-width: 100% !important; height: auto !important; width: auto   !important; }
	.no-padding { padding: 0px !important;}
	.nav-settings > li > a { padding: 15px 10px !important; }

	.dropdown-submenu .dropdown-menu li a { color: #fff !important; background: #2C3E51 !important }

	.dropdown-submenu .dropdown-menu li a:hover, .dropdown-submenu .dropdown-menu li a:focus{ color: #fff !important; background: #0D1A27 !important; }

	.dropdown-submenu .dropdown-menu li.active a{ color: #fff !important; background: #337ab7 !important; }

	.dropdown-submenu > li > a:hover, .dropdown-submenu > li > a:focus{ color: #fff !important; background: #0D1A27 !important; }

	.dropdown-menu li.open > a { color: #fff !important; background: #0D1A27 !important; }

	.nav-settings { margin-left: 15px; margin-right: 15px; }
</style>

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
				<a href="/gesfaturacao" class="options-link" ><i class="fa fa-home" aria-hidden="true"></i> <b>GESFaturação</b></a></h4>
			</p>
			<p>
				<a class="options-link" href="/definicoes/"><i class="fa fa-cogs"></i> Definições</a> <a class="options-link text-red" href="/server/logout.php"><i class="fa fa-sign-out"></i> Sair</a>
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

<nav class="navbar navbar-custom">
	<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="padding-left: 0px;padding-right: 0px;">
			<ul class="nav nav-settings navbar-nav">
				<li class="home" >
					<a href="/definicoes/">Início</a>
				</li>
				<li class="dados_acesso">
					<a href="/definicoes/dados_acesso">Dados de Acesso</a>
				</li>
				<li class="formacao">
					<a href="/definicoes/formacao">Formação</a>
				</li>
			</ul>
		</div>
	</div>
</nav>

<div align="center" class="fullscreen">
	<i class="fa fa-circle-o-notch fa-spin fa-5x fa-fw " style="margin-top: 20%"></i>
</div>
