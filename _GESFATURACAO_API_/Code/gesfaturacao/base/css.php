		<!-- BASE HEADER -->
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="robots" content="noindex"/>
		<link rel="shortcut icon" type="image/png" href="/img/favicon.png"/>
		<link rel="stylesheet" href="/css/bootstrap.min.css">

		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
		<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:400,700,300">

		<link rel="stylesheet" href="/css/font-awesome.min.css">

		<link href="/js/vendors/DataTables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
		<link href="/js/vendors/DataTables/media/css/dataTables.bootstrap.css" rel="stylesheet" type="text/css">

		<link type="text/css" rel="stylesheet" href="/css/style-responsive.css">
		<link type="text/css" rel="stylesheet" href="/css/orange-blue.css" >
		<link rel="stylesheet" type="text/css" href="/css/gesautarquia.css">
		<link rel="stylesheet" type="text/css" href="/css/gesfaturacao.css">

		<link type="text/css" rel="stylesheet" href="/js/vendors/iCheck/skins/all.css">
		<link type="text/css" rel="stylesheet" href="/js/vendors/sco.message/sco.message.css">

		<style type="text/css">
			.modal-wide-width{ width: 80vw !important; max-width: 1100px !important;}
			.portlet { min-height: 70px !important; }
			.container-fluid { padding-right: 0px !important; padding-left: 0px !important; }
			.emailSendedPlane { text-decoration: underline !important; color: #863430 !important; }
			.emailSendedPlane * { text-decoration: underline !important; color: #863430 !important; }
			.emailSendedPlaneBNT { background-color: #863430 !important; }
			.emailSendedPlaneBNT:hover, .emailSendedPlaneBNT:focus { background-color: #ab403b !important; }

			.trashLineIcone { font-size: 15px !important; }
			.commentLineIcone { font-size: 13px !important; padding-top: 4px !important; }
			#barcode_payshop { max-width: 100% !important; margin-left: -10px;}
			.RefDetailsWrapper p{ margin-bottom: 5px !important; }

			.badge-purple, .label-purple { background-color: #9351ad !important; }
			.text-purple { color: #9351ad !important; }
			.mainmenu-rightt, .dropdown-menu.mainmenu-right  { left: unset !important; right: 0 !important; }
			.submenu-right, .dropdown-menu.submenu-right  { left: unset !important; right: 100% !important; }
			.dropdown-submenu > .submenu-right { top: 0; left: 0; right: 0; margin-top: -6px; margin-left: -1px; }
		</style>

		<!-- SELECT2 STYLES -->
		<link href="/js/vendors/select2/css/select2.min.css" rel="stylesheet" />
		<style type="text/css">
			.select2 { width: 100%; height: 34px !important; }
			.select2 .select2-selection { height: 34px !important; border-radius: 0px !important; border: 1px solid #ddd !important; }

			.multipleselect2 > .select2 .select2-selection { min-height: 34px !important; height: auto !important; border-radius: 0px !important; border: 1px solid #ddd !important; }
			.multipleselect2 > .select2 { min-height: 34px !important; height: auto !important; }

			.select2 .select2-selection:hover, .select2 .select2-selection:focus { background-color: #eeeeee; }

			.select2 .select2-selection .select2-selection__rendered { color: #555 !important; }

			.select2 .select2-selection .select2-selection__rendered .select2-selection__clear{ color: #555 !important; }

			.select2-selection .select2-selection__arrow { height: 32px !important; }

			.select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 32px !important; }

			.select2-container--default .select2-selection--multiple .select2-selection__rendered { line-height: 30px !important; padding: 0 8px !important; }

			/* SELECTION LIST */
			.select2-container--default .select2-results__option--highlighted[aria-selected] {
				background-color: #96632F !important;
			}

			.select2-container--default .select2-results__option[aria-selected=true] {
				background-color: #AF7633 !important; color: #fff !important;
			}

			.select2-container .select2-search--inline .select2-search__field { margin-top: 0px !important; max-width: 96% !important;}

			.select2-container--default .select2-selection--multiple .select2-selection__choice { margin-top: 0px !important; border-radius: 0px !important;}

			.select2-container--open .select2-dropdown--below { min-width: 220px !important; }
			.select2-container--open .select2-dropdown--above { min-width: 220px !important; }

			.bancoSelectWrapper label { display: block; }
			.bancoSelectWrapper .select2-container { width: 100% !important; }

			.paisSelectWrapper label { display: block; }
			.paisSelectWrapper .select2-container { width: 100% !important; }

			#selectCidadeWrapper .select2-container,#editar_selectCidadeWrapper .select2-container { width: 100% !important; }
			#selectRegiaoWrapper .select2-container,#editar_selectRegiaoWrapper .select2-container { width: 100% !important; }

			#banco_select_fatura label { display: block; }
			#banco_select_fatura .select2-container { width: 100% !important; }

			.modal_select label { display: block; }
			.modal_select .select2-container { width: 100% !important; }

			.full-width-select .select2-container { width: 100% !important; }

			.customArticlesSelect .select2-dropdown--below { min-width: 80vh !important;}
			.customArticlesSelect .select2-dropdown--above { min-width: 80vh !important;}

			.customArticlesSelect .select2-dropdown--below .select2-results__options{ max-height: 500px !important;}
			.customArticlesSelect .select2-dropdown--above .select2-results__options{ max-height: 500px !important;}

			.label{display: block}
			.move.up, .move.down{ cursor: pointer; }

			.select2-container--default .select2-results__group { padding: 4px; }
			table.dataTable thead .sorting:not(.text-center), table.dataTable thead .sorting_desc:not(.text-center), table.dataTable thead .sorting_asc:not(.text-center) {
				padding-right: 20px;
			}
		</style>
