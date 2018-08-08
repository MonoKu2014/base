

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-primary text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Empresas</h1>
			<p>Listado de empresas registradas, acá podrá revisar los datos, publicaciones, servicios y otros pertenecientes a cada microempresa(rio)
				<div class="clearfix"></div>
			</p>
		</div>



			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron">
				
				<?= $this->session->flashdata('mensaje'); ?>				

				<div class="clearfix"></div>

				<div class="table-responsive">
					<table class="table table-striped table-bordered">
				        <thead>
				            <tr>
				            	<th>ID</th>
				                <th>Empresa</th>
				                <th>Rut Empresa/dueño</th>
				                <th>Propietario</th>
				                <th>Estado</th>
				                <th>Acciones</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php foreach($empresas as $e){ ?>
				            <tr>
				            	<td><?= $e->id_empresa;?></td>
				            	<td><?= $e->nombre_empresa;?></td>
				            	<td><?= $e->rut_empresa;?></td>
				            	<td><?= $e->nombre_dueno_empresa.' '.$e->apellido_dueno_empresa;?></td>				                
				                <td><?= $e->estado;?></td>
				                <td>
				                	<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver data" href="empresas/ver/<?= $e->id_empresa;?>"><i class="fa fa-eye"></i></button>
				                </td>
				            </tr>
				        	<?php } ?>
				        </tbody>
					</table>
				</div>
			</div>

</div>