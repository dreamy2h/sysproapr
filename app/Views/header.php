<?php 
	$sesión = session(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title>SISPRO APR</title>
  	<link rel="icon" href="<?php echo base_url(); ?>/imagenes/icono.png" type="image/png" />
  	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
  	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/jqvmap/jqvmap.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/summernote/summernote-bs4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-select/css/select.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/bootstrap-toaster/css/bootstrap-toaster.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/Date-Time-Picker-Bootstrap-4/build/css/bootstrap-datetimepicker.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/loader-screen-bar/css/JQLoader.css">
  	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  	<link rel="stylesheet" href="<?php echo base_url(); ?>/css/estilo_extra.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<input type="hidden" name="txt_base_url" id="txt_base_url" value="<?php echo base_url(); ?>">
	<div class="wrapper">
	  	<div class="preloader flex-column justify-content-center align-items-center">
	    	<img class="animation__shake" src="<?php echo base_url(); ?>/imagenes/icono.png" alt="AdminLTELogo" height="60" width="60">
	  	</div>
	  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
	    	<ul class="navbar-nav">
		      	<li class="nav-item">
		        	<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		      	</li>
	    	</ul>
	    	<ul class="navbar-nav ml-auto">
	      		<li class="nav-item">
	        		<a class="nav-link" data-widget="fullscreen" href="#" role="button">
	          			<i class="fas fa-expand-arrows-alt"></i>
	        		</a>
	      		</li>
	      		<li class="nav-item dropdown">
	        		<a class="nav-link dropdown-toggle" id="userDropdown" data-widget="control-sidebar" data-slide="true" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
		          		<i class="fas fa-users-cog"></i> Opciones
	        		</a>
        			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#" id="btn_actualizar_clave"><i class="fas fa-key"></i> Actualizar Clave</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>/index.php/Ctrl_login/logout"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                    </div>
	      		</li>
	    	</ul>
	  	</nav>
	  	<aside class="main-sidebar sidebar-dark-primary elevation-4">
		    <a href="<?php echo base_url(); ?>" class="brand-link">
	      		<img src="<?php echo base_url(); ?>/imagenes/icono.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
	      		<span class="brand-text font-weight-light">SISPRO APR</span>
	    	</a>
	    	<div class="sidebar">
	      		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
	        		<div class="image">
	          			<img src="<?php echo base_url(); ?>/dist/img/avatar5.png" class="img-circle elevation-2" alt="User Image">
	        		</div>
	        		<div class="info">
	          			<div class="d-block text-light"><?php echo $sesión->nombres_ses . " " . $sesión->ape_pat_ses; ?></div>
	          			<div class="d-block text-light"><?php echo $sesión->apr_ses ?></div>
	        		</div>
	      		</div>
	      		<nav class="mt-2">
	      			<ul id="menu_" class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
	      			</ul>
	      		</nav>
	    	</div>
	  	</aside>