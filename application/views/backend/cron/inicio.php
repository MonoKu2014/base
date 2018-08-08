

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-primary text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Email de sugeridos</h1>
			<p>Ejecuta procesos de correos masivos
				<div class="clearfix"></div>
				<?= $this->session->flashdata('mensaje'); ?>
			</p>
		</div>

		<div class="col-lg-12 jumbotron">

			<div class="col-lg-6">
				<a href="<?= base_url();?>cron/email_sugeridos" class="btn btn-primary">Enviar Correos Sugeridos</a>
				<p>Intenta controlar este proceso, para una mayor eficacia puedes ejecutarlo los días en horarios de madrugada</p>
			</div>
		</div>


		<div class="col-lg-12 jumbotron">

			<div class="col-lg-6">
				<a href="<?= base_url();?>cron/suscriptores" class="btn btn-primary">Actualizar lista de suscriptores</a>
				<p>Actualiza la lista de suscriptores que existe en Mailchimp</p>
			</div>
		</div>


</div>