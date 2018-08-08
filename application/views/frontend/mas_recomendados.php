<div class="container">
  <div class="row"> <br>
      <div class="col-md-12">
        <div class="row">
          
          <div class="col-sm-12">
            <ol class="breadcrumb">
              <li><a href="<?= base_url();?>">Inicio</a></li>
              <li class="active"><strong>Microempresarios más recomendados</strong></li>
            </ol>
            <br>
          </div>
          <div class="clearfix"></div><br>
          


          <div class="box-separator">
          <div class="col-sm-3 pull-right">
            <form method="post" id="ordenar-form">
            <select name="ordenar" id="ordenar" class="form-control selector opciones-ordenar-por">
              <option <?php if($ordenar == 0){echo 'selected'; }?> value="0">Ordenar registros por...</option>
              <option <?php if($ordenar == 1){echo 'selected'; }?> value="1">Cantidad Recomendaciones</option>
              <option <?php if($ordenar == 2){echo 'selected'; }?> value="2">Cantidad Productos</option>
              <option <?php if($ordenar == 3){echo 'selected'; }?> value="3">Cantidad Servicios</option>
              <option <?php if($ordenar == 4){echo 'selected'; }?> value="4">Cantidad Promociones</option>
            </select>
            </form>
            <hr>
          </div>

          <div class="clearfix"></div>
          <div class="row"> 
            

            <?php 
            if(count($microempresarios) > 0){

              foreach($microempresarios as $m){ 

            ?>
            <!--microempresario -->
            
            <div class="col-sm-12">

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
                <h2><a class="nacho-title" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>"><?= $m->nombre_empresa;?></a></h2>
                <p><small><?= $this->functions->SCNombresPorEmpresa($m->id_empresa);?></small></p>
                <h3><strong><?= $m->calle_empresa;?> <?= $m->numero_calle_empresa;?>, <?= $m->comuna_empresa;?>, <?= $m->region_empresa;?></strong></h3>
                <br>
                <p><a class="nacho-title" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>">Ver más</a></p>
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
            </div> <!-- fin col-sm-12 -->

            <!--divisor -->
            
            <div class="col-sm-12">
              <hr>
            </div>
            <div class="clearfix"></div>



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

            
            <!--divisor --> 

            <?php  } ?>

            <?php  } ?>        
            
          </div> <!-- fin row -->
        </div>
      </div>
    </div>

    
  </div>
</div>

<script>
  $('#ordenar').on('change', function(){
      $('#ordenar-form').submit();
  });
</script>