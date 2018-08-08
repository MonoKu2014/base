

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-primary text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Categorías</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Provident neque sed eum.
				<a href="categorias/agregar" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Agregar Categoria</a>
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
				                <th>Nombre</th>
				                <th>Estado</th>
				                <th>Acciones</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php foreach($categorias as $c){ ?>
				            <tr>
				            	<td><?= $c->id_categoria;?></td>
				                <td><?= $c->nombre_categoria;?></td>
				                <td><?= $c->estado;?></td>
				                <td>
				                	<button class="btn btn-danger delete" data-toggle="tooltip" data-placement="top" title="Eliminar registro" data-id="<?= $c->id_categoria;?>"><i class="fa fa-trash"></i></button>
				                	<a class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Editar registro" href="categorias/editar/<?= $c->id_categoria;?>"><i class="fa fa-pencil"></i></a>
				                </td>
				            </tr>
				        	<?php } ?>
				        </tbody>
					</table>
				</div>
			</div>

</div>

<script>
$(document).ready(function(){
	$('.delete').on('click', function(){
		id_delete = $(this).attr('data-id');
		ConfirmAlert(id_delete, 'categorias/eliminar');
	});
});
</script>