<!DOCTYPE html>
<html>
<head>
	<title>Soporte</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<script src="<?= base_url(); ?>assets/js/jquery.js"></script>
	<script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url(); ?>assets/sweetalert/dist/sweetalert.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/tooltipsy.min.js"></script>
	<script src="<?= base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
	<script src="<?= base_url(); ?>assets/data-tables/dataTables.bootstrap.js"></script>
    <script src="<?= base_url(); ?>assets/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?= base_url(); ?>assets/js/main.js"></script>

	<script>
		var _URL = '<?= base_url();?>';
	</script>

	<script src="<?= base_url(); ?>assets/js/validate.js"></script>


	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/main.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/font-awesome/css/font-awesome.min.css">

	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/sweetalert/dist/sweetalert.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/sweetalert/themes/google/google.css">

    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/data-tables/dataTables.bootstrap.css">

</head>
<body>



    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <i class="fa fa-align-justify"></i>
                </button>
                <a class="navbar-brand" href="<?= base_url(); ?>panel">
                	<em>SOPORTE</em>
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    	<i class="fa fa-user"></i> Bienvenido: <?= $this->session->nombre; ?>
                    	<b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= base_url(); ?>cuenta"><i class="fa fa-fw fa-user"></i> Mi cuenta</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?= base_url(); ?>login/salir"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">


                <li <?= active('panel')?>>
                    <a href="<?= base_url(); ?>panel">
                        <i class="fa fa-fw fa-dashboard"></i> Dashboard
                    </a>
                </li>

                <?php if($this->session->perfil == 1): ?>
                    <li <?= active('usuarios')?>>
                        <a href="<?= base_url(); ?>usuarios">
                            <i class="fa fa-fw fa-user"></i> Usuarios
                        </a>
                    </li>

                    <li <?= active('clientes')?>>
                        <a href="<?= base_url(); ?>clientes">
                            <i class="fa fa-fw fa-users"></i> Clientes
                        </a>
                    </li>

                <?php endif ?>



                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>