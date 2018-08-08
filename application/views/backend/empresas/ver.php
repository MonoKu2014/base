

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-primary text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Empresa: <?= $empresa[0]->nombre_empresa;?></h1>
			<p>Informe detallado de la empresa, sus publicaciones, etc.
				<a href="#" class="btn btn-primary pull-right"><i class="fa fa-globe"></i> Ver empresa en la web</a>
				<div class="clearfix"></div>
			</p>
		</div>



			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron">

				<div class="board">
					<div class="board-inner">
						<ul class="nav nav-tabs" id="myTab">
							<div class="liner"></div>

							<li class="active">
								<a href="#home" data-toggle="tab" title="Datos generales">
								<span class="round-tabs one">
									<i class="glyphicon glyphicon-home"></i>
								</span> 
								</a>
							</li>

							<li>
								<a href="#profile" data-toggle="tab" title="Publicaciones">
								<span class="round-tabs two">
									<i class="glyphicon glyphicon-tags"></i>
								</span> 
								</a>
							</li>

							<li>
								<a href="#messages" data-toggle="tab" title="Estadísticas">
								<span class="round-tabs three">
									<i class="fa fa-bar-chart"></i>
								</span>
								</a>
							</li>

							<li>
								<a href="#settings" data-toggle="tab" title="Vídeos">
								<span class="round-tabs four">
									<i class="fa fa-youtube-play"></i>
								</span> 
								</a>
							</li>

							<li>
								<a href="#doner" data-toggle="tab" title="completed">
								<span class="round-tabs five">
									<i class="glyphicon glyphicon-ok"></i>
								</span>
								</a>
							</li>

						</ul>
					</div>

				<div class="tab-content">

					<div class="tab-pane fade in active" id="home">
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="head">DATOS GENERALES DE LA EMPRESA</h3>	
							<p><span class="data">Empresa:</span><?= $empresa[0]->nombre_empresa;?></p>
							<p><span class="data">Propietario:</span><?= $empresa[0]->nombre_dueno_empresa.' '.$empresa[0]->apellido_dueno_empresa;?></p>
							<p><span class="data">Rut:</span><?= $empresa[0]->rut_empresa;?></p>
							<p><span class="data">Celular:</span><?= $empresa[0]->celular_empresa;?></p>
							<p><span class="data">Fono fijo:</span><?= $empresa[0]->fono_empresa;?></p>
							<p><span class="data">Descripción:</span><?= $empresa[0]->descripcion_empresa;?></p>
							<p>
								<span class="data">Sitio Web:</span>
								<a href="<?= $empresa[0]->sitio_empresa;?>" target="_blank"><?= $empresa[0]->sitio_empresa;?></a>
							</p>
							<p><span class="data">Despacho:</span><?= $empresa[0]->despacho_empresa;?></p>
							<p><span class="data">Estado:</span><?= $empresa[0]->estado;?></p>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="head">HORARIO PUBLICADO</h3>
							<?php foreach($horario as $h){ ?>
							<p><span class="data">Lunes:</span><?= $h->lunes;?></p>
							<p><span class="data">Martes:</span><?= $h->martes;?></p>
							<p><span class="data">Miércoles:</span><?= $h->miercoles;?></p>
							<p><span class="data">Jueves:</span><?= $h->jueves;?></p>
							<p><span class="data">Viernes:</span><?= $h->viernes;?></p>
							<p><span class="data">Sábado:</span><?= $h->sabado;?></p>
							<p><span class="data">Domingo:</span><?= $h->domingo;?></p>
							<?php } ?>
						</div>

						<div class="clearfix"></div>
						<br>
						<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
							<h3 class="head">MODALIDADES DE PAGO</h3>
							<?php foreach($pagos as $k => $p){ ?>
							<p><i class="fa fa-check"></i> <?= $p->nombre_medio_pago;?></p>
							<?php } ?>
						</div>
					</div>

					<div class="tab-pane fade" id="profile">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3 class="head">Productos Publicados</h3>
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
								        	<?php foreach($productos as $p){ ?>
								            <tr>
								            	<td><?= $p->id_producto;?></td>
								                <td><?= $p->nombre_producto;?></td>
								                <td><?= $p->estado;?></td>
								                <td>
								                <a data-toggle="modal" data-target="#detalle_producto" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="Ver Detalle" href="<?= base_url();?>empresas/detalle_producto/<?= $p->id_producto;?>"><i class="fa fa-eye"></i></a>
								                </td>
								            </tr>
								        	<?php } ?>
								        </tbody>
									</table>
								</div>
							</div>
					</div>

					<div class="tab-pane fade" id="messages">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<h3 class="head">EVALUACIONES RECIBIDAS</h3>
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
								        <thead>
								            <tr>
								            	<th>N°</th>
								                <th>Cliente/Usuario</th>
								                <th>Evaluación</th>
								                <th>Puntaje</th>
								                <th>Fecha</th>
								            </tr>
								        </thead>
								        <tbody>
								        	<?php foreach($evaluaciones as $e){ ?>
								            <tr>
								            	<td><?= $e->id_evaluacion;?></td>
								            	<td><?= $e->nombre_cliente;?></td>
								            	<td><?= $e->texto_evaluacion;?></td>
								            	<td><?= $e->puntaje_evaluacion;?></td>
								            	<td><?= $e->fecha_evaluacion;?></td>
								            </tr>
								        	<?php } ?>
								        </tbody>
									</table>
								</div>
						</div>
					</div>

					<div class="tab-pane fade" id="settings">
						<h3 class="head"></h3>
					</div>

					<div class="tab-pane fade" id="doner">
						<h3 class="head"></h3>
					</div>
					<div class="clearfix"></div>
				</div>

				</div>

			</div>

</div>

  <div class="modal fade" id="detalle_producto" role="dialog" style="width:100%;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

      </div>
    </div>
  </div>

<script>
$(function(){
	$('a[title]').tooltip();
});
</script>