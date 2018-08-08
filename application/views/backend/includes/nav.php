<div id="wrapper">
	<div id="sidebar-wrapper">
	    <ul class="sidebar-nav">
	        <li class="sidebar-brand">
	            	<img src="<?= IMAGES_PATH;?>portal-microempresarios.svg" class="img-responsive">
	        </li>

			<li><a <?= $this->functions->activeNav('cuenta');?> href="<?= base_url();?>cuenta"><i class="fa fa-user"></i> Mi Cuenta</a></li>	        

	        <li><a <?= $this->functions->activeNav('main');?> href="<?= base_url();?>main"><i class="fa fa-dashboard"></i> Dashboard</a></li>
	        <li><a <?= $this->functions->activeNav('usuarios');?> href="<?= base_url();?>usuarios"><i class="fa fa-users"></i> Usuarios</a></li>
	        <li><a <?= $this->functions->activeNav('categorias');?> href="<?= base_url();?>categorias"><i class="fa fa-paperclip"></i> Categorías</a></li>
	        <li><a <?= $this->functions->activeNav('subcategorias');?> href="<?= base_url();?>subcategorias"><i class="fa fa-cog"></i> Subcategorías</a></li>
	        <li><a <?= $this->functions->activeNav('sub_subcategorias');?> href="<?= base_url();?>sub_subcategorias"><i class="fa fa-money"></i> Sub-Subcategorías</a></li>
	        <li><a <?= $this->functions->activeNav('empresas');?> href="<?= base_url();?>empresas"><i class="fa fa-flag"></i> Empresas</a></li>
	        <li><a <?= $this->functions->activeNav('clientes');?> href="<?= base_url();?>clientes"><i class="fa fa-users"></i> Clientes</a></li>
	        <li><a <?= $this->functions->activeNav('pagos');?> href="<?= base_url();?>pagos"><i class="fa fa-money"></i> Modalidades de pago</a></li>
	        <li><a <?= $this->functions->activeNav('config');?> href="<?= base_url();?>config"><i class="fa fa-cog"></i> Configuración</a></li>
	        <li><a <?= $this->functions->activeNav('cron');?> href="<?= base_url();?>cron"><i class="fa fa-envelope"></i> Correos/Suscriptores</a></li>

	        <li><a href="<?= base_url();?>login/cerrar_sesion"><i class="fa fa-remove"></i> Cerrar sesión</a></li>
	    </ul>
	</div>