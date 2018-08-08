<div class="container">
  <div class="row"> <br>
    <div class="clearfix"></div>
    <div class="col-sm-12">
    <form id="ordenar-form" method="post"></form>

      <!-- lateral-->
      <div class="col-md-3 box-separator">
      <h1 class="visible-xs"><?= $cliente[0]->nombre_cliente; ?></h1><br class="visible-xs" />

      <?php if($cliente[0]->imagen_cliente == ''){ ?>
        <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />
      <?php } else { ?>
        <img class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$cliente[0]->imagen_cliente;?>">
      <?php } ?>

      <br />

        <!--filtro -->
        <p><strong style="color: #111;">Promociones que este usuario sigue</strong></p>

        <hr />

          <?php
          if(count($promociones) > 0){
          foreach ($promociones as $p) { ?>
          <!--promocion -->

              <div class="col-lg-12 thumbnail" style="border-top: none;border-left: none;border-right: none;font-size: 12px !important;">
                <div class="col-lg-5">
                <?php
                  if($p['imagen'] == ''){ ?>
                      <a href="<?= $p['href'];?>">
                        <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="Imagen promocion"><br class="visible-xs">
                      </a>
                <?php } else { ?>
                      <a href="<?= $p['href'];?>">
                        <img class="img-responsive portfolio-item" src="<?= $p['imagen'];?>" alt="Imagen promocion"><br class="visible-xs">
                      </a>
                <?php } ?>
                </div>
                <div class="col-lg-7">
                <p style="text-align: left;">
                <a href="<?= $p['href'];?>"><?= $p['nombre'];?></a><br><br>
                <a class="text-center promociones-pre" style="color:#fff !important;background: <?= $p['color'];?>" href="<?= $p['href'];?>">
                <?= $p['promocion'];?>
                </a>
                </p>
                </div>
              </div>

          <!--fin promocion -->
          <hr >
          <?php } } ?>

          <!--fin filtro -->

      </div>
      <!--FIN lateral-->

      <div class="col-md-9">
        <div class="box-separator">

          <div class="col-sm-9">
            <h1 class="hidden-xs"><?= $cliente[0]->nombre_cliente; ?></h1>

          </div>
          <div class="col-sm-3">

          <?php if($this->session->id != $cliente[0]->id_cliente){ ?>
              <?php if($this->functions->yaSeguido($cliente[0]->id_cliente) == 0){ ?>
                <a href="#" class="btn btn-default seguir" data-id="<?= $cliente[0]->id_cliente;?>">+ Seguir Recomendaciones</a>
              <?php } else { ?>
                <a href="#" class="btn btn-default no-seguir" data-id="<?= $cliente[0]->id_cliente;?>">No Seguir Recomendaciones</a>
              <?php } ?>
          <?php } ?>

          </div>



          <div class="clearfix"></div>

          <!-- tabs -->

          <div class="col-md-12"><br>
            <br>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                <a href="#requerimientos" aria-controls="home" role="tab" data-toggle="tab">Solicitudes de cotizaciones
                  (<?= $this->functions->cantidadRequerimientosPorPersona($cliente[0]->id_cliente);?>)</a>
                </li>
                <li role="presentation">
                <a href="#lorecomiendo" aria-controls="home" role="tab" data-toggle="tab">Lo Recomiendo
                  (<?= $this->functions->cantidadRecomendacionesPorPersona($cliente[0]->id_cliente);?>)</a>
                </li>
                <li role="presentation">
                <a href="#siguiendo" aria-controls="messages" role="tab" data-toggle="tab">Siguiendo
                  (<?= $this->functions->cantidadSeguidosPorPersona($cliente[0]->id_cliente);?>)</a>
                </li>
                <li role="presentation">
                <a href="#seguidores" aria-controls="messages" role="tab" data-toggle="tab">Seguidores
                  (<?= $this->functions->cantidadSeguidoresPorPersona($cliente[0]->id_cliente);?>)</a>
                </li>
                <li role="presentation">
                <a href="#ayudando" aria-controls="messages" role="tab" data-toggle="tab">Negocios
                (<?= $this->functions->cantidadAyudados($cliente[0]->id_cliente);?>)
                </a>
                </li>
            </ul>

            <div class="tab-content">






              <!--tab -->
              <div role="tabpanel" class="tab-pane fade in active" id="requerimientos">
              <br />
              <div class="col-sm-12">
                <h2>SOLICITUDES DE COTIZACIONES DE <?= strtoupper($cliente[0]->nombre_cliente); ?>:</h2>
              </div>

              <div class="clearfix"></div>
              <br class="hidden-xs" />


      <?php if(count($requerimientos) > 0){ ?>

          <div class="col-lg-12 table-responsive">
          <table class="table table-stripped table-condensed" style="font-size: 12px;">
            <thead>
              <th>Fecha publicación</th>
              <th>Sector</th>
              <th>Tipo de microempresario</th>
              <th>Solicitud</th>
              <th>Estado</th>
              <th>Ver</th>
            </thead>
            <tbody>
            <?php foreach ($requerimientos as $r) { ?>

              <tr style="font-size: 13px;">
                <td><?= $r->fecha_requerimiento;?></td>
                <td><?= $r->nombre_categoria;?></td>
                <td><?= $r->nombre_subcategoria;?></td>
                <td><?= substr($r->texto_requerimiento, 0, 200);?> ...</td>
                <td><?= ($r->estado_requerimiento == 1) ? '<span class="label label-success">Abierta</span>' : '<span class="label label-danger">Cerrada</span>';?></td>
                <td>
                 <a href="<?= base_url();?>detalle_requerimiento/<?= $r->id_requerimiento;?>"" class="delete eliminar_req" data-id="<?= $r->id_requerimiento;?>">Ver</a>
                </td>
              </tr>

            <?php } ?>
            </tbody>
          </table>
          </div>

        <?php } ?>


              </div><!--fin tab -->


              <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="lorecomiendo">
              <br />
              <div class="col-sm-9">
                <h2><?= strtoupper($cliente[0]->nombre_cliente); ?> RECOMIENDA:</h2>
              </div>
               <div class="col-sm-3 pull-right">
                <select form="ordenar-form" name="ordenar_uno" class="form-control selector">
                  <option <?php if($ordenar_uno == 0){echo 'selected'; }?> value="0">Ordenar por</option>
                  <option <?php if($ordenar_uno == 1){echo 'selected'; }?> value="1">Cantidad Recomendaciones</option>
                  <option <?php if($ordenar_uno == 2){echo 'selected'; }?> value="2">Cantidad Productos</option>
                  <option <?php if($ordenar_uno == 3){echo 'selected'; }?> value="3">Cantidad Servicios</option>
                  <option <?php if($ordenar_uno == 4){echo 'selected'; }?> value="4">Cantidad Promociones</option>
                </select>
              </div>
            <div class="clearfix"></div>
              <br class="hidden-xs" />


              <?php  foreach ($recomendaciones as $key => $m) { ?>
                <!--microempresario -->
                <div class="row">
                  <div class="col-sm-3">
                  <?php if($m->imagen_empresa == ''){ ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($m->id_categoria);?>" alt="">
                    </a>
                  <?php } else { ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$m->imagen_empresa;?>" alt="">
                    </a>
                  <?php } ?>
                  </div>
                  <div class="col-sm-6">
                    <h2><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>"><?= $m->nombre_empresa;?></a></h2>
                    <p><small><?= $this->functions->SCNombresPorEmpresa($m->id_empresa);?></small></p>
                    <h3><strong><?= $m->calle_empresa;?> <?= $m->numero_calle_empresa;?>, <?= $m->comuna_empresa;?>, <?= $m->region_empresa;?></strong></h3>
                    <br>
                    <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">Ver más</a></p>
                  </div>
                  <div class="col-sm-3 psmall">
                    <p>
                      <small>
                        <a href="#r-<?= $m->id_empresa;?>" data-toggle="modal"><?= $this->functions->cantidadRecomendaciones($m->id_empresa);?> Recomendacion(es) en total</a><br>
                        <span class="orange">
                          <a href="<?= base_url();?>microempresarios/listado_productos/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadProductos($m->id_empresa);?> Producto(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_servicios/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadServicios($m->id_empresa);?> Servicio(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_promociones/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadPromociones($m->id_empresa);?> Promocion(es)</a><br />
                          <a href="#seguir-<?= $m->id_empresa;?>" data-toggle="modal">
                          <?= $this->functions->cantidadSeguidores($m->id_empresa);?> Seguidor(es)
                          </a>
                        </span>
                      </small>
                    </p>
                  </div>
                </div>
                <!--fin microempresario -->

                <br /><div class="divisor"></div><br /><br />



          <div id="r-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de personas que recomiendan</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarRecomendacionesPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                        </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>



          <div id="seguir-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de seguidores</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                      </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>




              <?php } ?>

              </div><!--fin tab -->

              <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="siguiendo">
              <br />
                <div class="col-sm-12">
              <h2><?= strtoupper($cliente[0]->nombre_cliente); ?> SIGUE A:</h2>
              </div>

            <div class="clearfix"></div>
               <br class="hidden-xs" />

              <?php  foreach ($clienteSigueEmpresas as $key => $m) { ?>
                <!--microempresario -->
                <div class="row">
                  <div class="col-sm-3">
                  <?php if($m->imagen_empresa == ''){ ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($m->id_categoria);?>" alt="">
                    </a>
                  <?php } else { ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$m->imagen_empresa;?>" alt="">
                    </a>
                  <?php } ?>
                  </div>
                  <div class="col-sm-6">
                    <!--<h5>Cínica Dental</h5>-->
                    <h2><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>"><?= $m->nombre_empresa;?></a></h2>
                    <p><small><?= $this->functions->SCNombresPorEmpresa($m->id_empresa);?></small></p>
                    <h3><strong><?= $m->calle_empresa;?> <?= $m->numero_calle_empresa;?>, <?= $m->comuna_empresa;?>, <?= $m->region_empresa;?></strong></h3>
                    <br>
                    <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">Ver más</a></p>
                  </div>
                  <div class="col-sm-3 psmall">
                    <p>
                      <small>
                        <a href="#r-<?= $m->id_empresa;?>" data-toggle="modal"><?= $this->functions->cantidadRecomendaciones($m->id_empresa);?> Recomendacion(es) en total</a><br>
                        <span class="orange">
                          <a href="<?= base_url();?>microempresarios/listado_productos/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadProductos($m->id_empresa);?> Producto(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_servicios/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadServicios($m->id_empresa);?> Servicio(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_promociones/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadPromociones($m->id_empresa);?> Promocion(es)</a><br />
                          <a href="#seguir-<?= $m->id_empresa;?>" data-toggle="modal">
                          <?= $this->functions->cantidadSeguidores($m->id_empresa);?> Seguidor(es)
                          </a>
                        </span>
                      </small>
                    </p>
                  </div>
                </div>
                <!--fin microempresario -->

                <br /><div class="divisor"></div><br /><br />



          <div id="r-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de personas que recomiendan</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarRecomendacionesPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                        </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>



          <div id="seguir-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de seguidores</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                      </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>


              <?php } ?>



              <?php foreach($clienteSiguePersonas as $k => $s){ ?>

                 <!--microempresario -->
                <div class="row">
                  <div class="col-sm-3">
                    <?php if($s->imagen_cliente == ''){ ?>
                      <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />
                    <?php } else { ?>
                      <img class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$s->imagen_cliente;?>">
                    <?php } ?>
                  </div>
                  <div class="col-sm-6">
                    <h2><a  class="orange" href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $s->nombre_cliente;?></a></h2>
                    <p><small><strong>Ubicación:</strong>
                        <br>Lugar de Residencia: <?= $this->functions->texto_general(4);?> de <?= $s->comuna_cliente;?>, <?= $this->functions->texto_general(3);?> <?= $s->region_cliente;?>
                        <br>Lugar de Trabajo: <?= $this->functions->texto_general(4);?> de <?= $s->comuna_trabajo_cliente;?>, <?= $this->functions->texto_general(3);?> <?= $s->region_trabajo_cliente;?>
                        </small></p>
                    <br>
                    <p><a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>">Ver perfil</a></p>
                  </div>
                  <div class="col-sm-3 psmall">
                   <p>
                    <small>
                    <span class="orange">
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadRecomendacionesPorPersona($s->id_cliente);?> Lo recomiendo</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadSeguidosPorPersona($s->id_cliente);?> Siguiendo</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadSeguidoresPorPersona($s->id_cliente);?> Seguidores</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadAyudados($s->id_cliente);?> Negocios</a>
                    </span>
                    </small>
                    </p>
                  </div>
                </div>
                <!--fin microempresario -->

                <br /><div class="divisor"></div><br /><br />

              <?php } ?>



              </div><!--fin tab -->

               <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="seguidores">
              <br />
              <div class="col-sm-6">
                <h2>SIGUEN A <?= strtoupper($cliente[0]->nombre_cliente); ?>:</h2>
              </div>

              <div class="col-sm-3 pull-right">

              </div>

                <div class="clearfix"></div>
                <br class="hidden-xs" />


              <?php foreach($seguidores as $k => $s){ ?>

                 <!--microempresario -->
                <div class="row">
                  <div class="col-sm-3">
                    <?php if($s->imagen_cliente == ''){ ?>
                      <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />
                    <?php } else { ?>
                      <img class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$s->imagen_cliente;?>">
                    <?php } ?>
                  </div>
                  <div class="col-sm-6">
                    <h2><a  class="orange" href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $s->nombre_cliente;?></a></h2>
                    <p><small><strong>Ubicación:</strong>
                        <br>Lugar de Residencia: <?= $this->functions->texto_general(4);?> de <?= $s->comuna_cliente;?>, <?= $this->functions->texto_general(3);?> <?= $s->region_cliente;?>
                        <br>Lugar de Trabajo: <?= $this->functions->texto_general(4);?> de <?= $s->comuna_trabajo_cliente;?>, <?= $this->functions->texto_general(3);?> <?= $s->region_trabajo_cliente;?>
                        </small></p>
                    <br>
                    <p><a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>">Ver perfil</a></p>
                  </div>
                   <div class="col-sm-3 psmall">
                   <p>
                    <small>
                    <span class="orange">
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadRecomendacionesPorPersona($s->id_cliente);?> Lo recomiendo</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadSeguidosPorPersona($s->id_cliente);?> Siguiendo</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadSeguidoresPorPersona($s->id_cliente);?> Seguidores</a><br>
                      <a href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $this->functions->cantidadAyudados($s->id_cliente);?> Ayudando</a>
                    </span>
                    </small>
                    </p>
                  </div>
                </div>
                <!--fin microempresario -->

                <br /><div class="divisor"></div><br /><br />

              <?php } ?>

              </div><!--fin tab -->

               <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="ayudando">
              <br />
                <div class="col-sm-9">
              <h2>NEGOCIOS DE <?= strtoupper($cliente[0]->nombre_cliente); ?>:</h2>
              </div>
                <div class="col-sm-3 pull-right">
                <select form="ordenar-form" name="ordenar_cuatro" class="form-control selector">
                  <option <?php if($ordenar_cuatro == 0){echo 'selected'; }?> value="0">Ordenar por</option>
                  <option <?php if($ordenar_cuatro == 1){echo 'selected'; }?> value="1">Cantidad Recomendaciones</option>
                  <option <?php if($ordenar_cuatro == 2){echo 'selected'; }?> value="2">Cantidad Productos</option>
                  <option <?php if($ordenar_cuatro == 3){echo 'selected'; }?> value="3">Cantidad Servicios</option>
                  <option <?php if($ordenar_cuatro == 4){echo 'selected'; }?> value="4">Cantidad Promociones</option>
                </select>
                </div>
                <div class="clearfix"></div>
                <br class="hidden-xs" />

              <?php foreach($ayudados as $k => $m){ ?>
                <!--microempresario -->
                <div class="row">
                  <div class="col-sm-3">
                  <?php if($m->imagen_empresa == ''){ ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($m->id_categoria);?>" alt="">
                    </a>
                  <?php } else { ?>
                    <a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">
                      <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$m->imagen_empresa;?>" alt="">
                    </a>
                  <?php } ?>
                  </div>
                  <div class="col-sm-6">
                    <h2><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>"><?= $m->nombre_empresa;?></a></h2>
                    <p><small><?= $this->functions->SCNombresPorEmpresa($m->id_empresa);?></small></p>
                    <h3><strong><?= $m->calle_empresa;?> <?= $m->numero_calle_empresa;?></strong></h3>
                    <br>
                    <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">Ver más</a></p>
                  </div>
                  <div class="col-sm-3 psmall">
                    <p>
                      <small>
                        <a href="#ayuda-r-<?= $m->id_empresa;?>" data-toggle="modal"><?= $this->functions->cantidadRecomendaciones($m->id_empresa);?> Recomendacion(es) en total</a><br>
                        <span class="orange">
                          <a href="<?= base_url();?>microempresarios/listado_productos/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadProductos($m->id_empresa);?> Producto(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_servicios/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadServicios($m->id_empresa);?> Servicio(s)</a><br>
                          <a href="<?= base_url();?>microempresarios/listado_promociones/1/<?= $m->id_categoria;?>/<?= $m->id_empresa;?>"><?= $this->functions->cantidadPromociones($m->id_empresa);?> Promocion(es)</a><br />
                          <a href="#ayuda-seguir-<?= $m->id_empresa;?>" data-toggle="modal">
                          <?= $this->functions->cantidadSeguidores($m->id_empresa);?> Seguidor(es)
                          </a>
                        </span>
                      </small>
                    </p>
                  </div>
                </div>
                <!--fin microempresario -->





          <div id="ayuda-r-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de personas que recomiendan</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarRecomendacionesPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                        </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>



          <div id="ayuda-seguir-<?= $m->id_empresa;?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de seguidores</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($m->id_empresa) as $k => $r){ ?>
                      <p><?= $k + 1;?>.-
                        <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                          <?= $r->nombre_cliente;?>
                        </a>
                      </p>
                      <?php } ?>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>





                <br /><div class="divisor"></div><br /><br />
               <?php } ?>



              </div><!--fin tab -->

            </div>
          </div>
          <!--fin tabs -->



          <div class="clearfix"></div>
                    <br />
<br />
<br />



        </div>
      </div>
    </div>

    <!-- Fin Row -->

  </div>
</div>

<script>



$(document).on('click', '.seguir', function(event){
    event.preventDefault();
    var session = '<?php echo $this->session->id;?>';
    if(session == ''){
        $('#iniciar-sesion').modal();
    } else {
      var id_persona = $(this).data('id');
      $.ajax({
          type: 'post',
          url: APP_URL + 'ajax/comenzarSeguirPersona',
          data: {id_persona:id_persona},
          success: function(res){
            location.reload();
          }
      });
    }
});


$(document).on('click', '.no-seguir', function(event){
    event.preventDefault();
    var session = '<?php echo $this->session->id;?>';
    if(session == ''){
        $('#iniciar-sesion').modal();
    } else {
      var id_persona = $(this).data('id');
      $.ajax({
          type: 'post',
          url: APP_URL + 'ajax/dejarSeguirPersona',
          data: {id_persona:id_persona},
          success: function(res){
            location.reload();
          }
      });
    }
});

$('.selector').on('change', function(){
    $('#ordenar-form').submit();
});


</script>
