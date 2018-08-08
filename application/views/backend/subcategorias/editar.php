

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-primary text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Editar Subcategoría</h1>
			<p>Los campos marcados con (*) son obligatorios
				<a href="<?= base_url();?>subcategorias" class="btn btn-default pull-right"><i class="fa fa-chevron-left"></i> Volver</a>
				<div class="clearfix"></div>
			</p>
		</div>



		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron">
			
			<?= $this->session->flashdata('mensaje');?>		

			<form id="add-user" method="post" action="<?= base_url();?>subcategorias/editar_subcategoria">
				<input type="hidden" name="id_subcategoria" value="<?= $subcategoria[0]->id_subcategoria;?>">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<span>Nombre(*):</span>
					<input type="text" id="nombre" name="nombre" class="form-control required" value="<?= $subcategoria[0]->nombre_subcategoria;?>">				
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<span>Categoría(*):</span>
					<select name="categoria" id="categoria" class="form-control required">
						<?php foreach($categorias as $c){ ?>
							<?php if($c->id_categoria == $subcategoria[0]->id_categoria){?>
									<option selected value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
							<?php } else { ?>
									<option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
							<?php } ?>
						<?php } ?>
					</select>				
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<span>Estado(*):</span>
					<select name="estado" id="estado" class="form-control required">
						<?php foreach($estados as $e){ ?>
							<?php if($e->id_estado == $categoria[0]->id_estado){?>
									<option selected value="<?= $e->id_estado;?>"><?= $e->estado;?></option>
							<?php } else { ?>
									<option value="<?= $e->id_estado;?>"><?= $e->estado;?></option>
							<?php } ?>
						<?php } ?>
					</select>				
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			      	<button type="submit" id="save-button" class="btn btn-success">Editar</button>
			        <a href="<?=base_url();?>subcategorias" type="button" class="btn btn-danger">Cancelar</a>		
				</div>

				<div class="clearfix"></div>
			</form>


		</div>

</div>