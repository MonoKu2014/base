
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
	<h4 class="modal-title">Detalle producto</h4>
</div>

<div class="modal-body">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h2></h2>
				<p><span class="data">ID producto:</span><?= $producto[0]->id_producto;?></p>
				<p><span class="data">Nombre:</span><?= $producto[0]->nombre_producto;?></p>
				<p><span class="data">Precio:</span><?= $producto[0]->precio_producto;?></p>
				<p><span class="data">Descripción:</span><?= $producto[0]->descripcion_producto;?></p>
				<p><span class="data">Especificaciones:</span><?= $producto[0]->especificacion_producto;?></p>

		</div>

		<div class="clearfix"></div>
		<br><br>



	</div>
</div>

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
</div>