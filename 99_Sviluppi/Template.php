<?php

        if (file_exists('../../InfoGenerali.php')) {
            include('../../InfoGenerali.php');
        }else{
			$Cliente_Portale = '';
		}

		if(!isset($Cliente_Portale)){
			$Cliente_Portale="";
		}
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->
<style>
		.e-grid .e-rowcell {
			font-size: 10px !important;
			padding-left: 4px !important;
			padding-right: 4px !important;
		}
		.e-grid  .e-headercelldiv {
			font-size: 10px !important;
			padding-left: 4px !important;
			padding-right: 4px !important;
			margin: auto !important;
		}
		.e-grid  .e-headercell {
			padding:4px !important;
		}
</style>
<head>

	<!-- JQuery -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" type="text/javascript"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>

	<!-- Codice JavaScript -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">

<!-- SweetAlert2 -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="//cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.js"></script>

<script type="text/javascript">

	var Ditta=<?php if(isset($Ditta)){echo $Ditta;}else{echo -1;}?>		
	<!-- //questa riga apre il commento per HTML
	/* Carico la formattazione italiana */
	function loadCultureFiles(name) {
	var files = ['ca-gregorian.json', 'numbers.json', 'timeZoneNames.json', 'currencies.json'];
	var loadCulture = function(prop) {
	var val, ajax;
	ajax = new ej.base.Ajax('../../21_Syncfusion/_cldr-data/main/' + name + '/' + files[prop], 'GET', false);

	ajax.onSuccess = function(value) {
	val = value;
	};
	ajax.send();
	ej.base.loadCldr(JSON.parse(val));
	ej.base.setCulture('it');
	ej.base.setCurrencyCode('EUR');
	};
	for (var prop = 0; prop < files.length; prop++) {
	loadCulture(prop);
	}
	}


</script>

	
	<title class="traduzione">Portale <?php echo $Cliente_Portale; ?></title>
	<link rel="apple-touch-icon" href="../../10_Grafica/app-assets/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="../../10_Grafica/app-assets/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap" rel="stylesheet">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/vendors/css/vendors.min.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/vendors/css/charts/apexcharts.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/vendors/css/extensions/tether-theme-arrows.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/vendors/css/extensions/tether.min.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/vendors/css/extensions/shepherd-theme-default.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/colors.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/components.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/themes/semi-dark-layout.css">

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/core/colors/palette-gradient.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/pages/dashboard-analytics.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/pages/card-analytics.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/app-assets/css/plugins/tour/tour.css">
	<!-- END: Page CSS-->

	<!-- BEGIN: Custom CSS-->
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/assets/css/style-rebite.css">
	<link rel="stylesheet" type="text/css" href="../../10_Grafica/assets/css/style.css">


	<link rel="stylesheet" type="text/css" href="../../Css/PersRebite.css">
	<link rel="stylesheet" type="text/css" href="./CssProgetto/PersonalizzatoProgetto.css">
	<!-- END: Custom CSS-->

	<!-- Javascript personalizzato -->
	<!-- <script type="text/javascript" src="JS/Esempio.js"></script> -->
	<script type="module" src="JSProgetto/Esempio.js"></script>
	<!-- <script type="module" src="JSProgetto/Generali/"></script> -->
	<script type="module" src="JS/Generali/ClassiGenerali.js"></script>

	<!-- BEGIN: ../../21_Syncfusion -->
	<link href="../../21_Syncfusion/material.css" rel="stylesheet">
	
	<script src="../../21_Syncfusion/dist/ej2.min.js" type="text/javascript"></script>
	
	<!-- END: ../../21_Syncfusion -->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">


	<!-- <link rel="import" href="Header.php"> header -->
	<?php include '../../Header.php'; ?>


	<!-- BEGIN: Content-->
	<div class="app-content content">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper p-1">
			<div class="content-header row p-0">
				<div class="content-header-left col-md-9 col-12 mb-2 ml-2">
					<div class="row breadcrumbs-top">
						<div class="col-12">
							<h2 class="content-header-title float-left mb-0">Portale <?php echo $Cliente_Portale; ?></h2>
							<div class="breadcrumb-wrapper col-12">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a id="MenuHome">Home</a></li>
									<!-- <li class="breadcrumb-item"><a href="#">Configurazione importazione</a></li> -->
								</ol>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="content-body col-12 ">

				<section id="basic-horizontal-layouts">
					<div class="row match-height">
						<div class="col-md-12 col-12">
							<div class="card border-primary">
								<!--<div class="card-header">
                                    <h4 class="card-title" >Gestione scheda collaudo lavorazione</h4>
                                </div>-->
								<div class="card-content">
									<div class="card-body">
										<form class="form form-horizontal" id="myForm">
											<div class="form-body">
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>



				<div id="Loading" style="text-align: center;">
					<button class="btn btn-primary mb-1" type="button" disabled>
						<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
						Loading...
					</button>
				</div>



			</div>
		</div>
		<!-- END: Content-->

		<div class="modal-size-xl mr-1 mb-1 d-inline-block">
			<div class="modal fade text-left" id="LookupPopUpAttrEstesi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
				<div class="modal-dialog modal-dialog-scrollable modal-lg" role="document" style="width: 70%;">
					<div class="modal-content">
						<div class="modal-body">
							<div class="table-responsive">
								<div id="VisLookupAttrEstesi"></div>
							</div>
						</div>
						<div class="modal-footer">
							<button id="CloseLookupAttrEstesi" type="button" class="btn btn-primary" data-dismiss="modal">Chiudi</button>
						</div>
					</div>
				</div>
			</div>
		</div>



		




		<div class="sidenav-overlay"></div>
		<div class="drag-target"></div>

		<!-- BEGIN: Footer-->
		<footer class="footer footer-static footer-light" style="margin-left: 10px;">
			<p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">REbITe,</a>Tutti i diritti riservati</span><span class="float-md-right d-none d-md-block">Made with<i class="feather icon-cpu primary"></i></span>
				<button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
			</p>
		</footer>
		<!-- END: Footer-->


		<!-- BEGIN: Vendor JS-->
		<script src="../../10_Grafica/app-assets/vendors/js/vendors.min.js"></script>
		<!-- BEGIN Vendor JS-->

		<!-- BEGIN: Page Vendor JS-->
		<script src="../../10_Grafica/app-assets/vendors/js/charts/apexcharts.min.js"></script>
		<script src="../../10_Grafica/app-assets/vendors/js/extensions/tether.min.js"></script>
		<!-- <script src="../../10_Grafica/app-assets/vendors/js/extensions/shepherd.min.js"></script>  -->
		<!-- END: Page Vendor JS-->

		<!-- BEGIN: Theme JS-->
		<script src="../../10_Grafica/app-assets/js/core/app-menu.js"></script>
		<script src="../../10_Grafica/app-assets/js/core/app.js"></script>
		<script src="../../10_Grafica/app-assets/js/scripts/components.js"></script>
		<!-- END: Theme JS-->

		<!-- BEGIN: Page JS-->
		<script src="../../10_Grafica/app-assets/js/scripts/pages/dashboard-analytics.js"></script>
		<!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>
