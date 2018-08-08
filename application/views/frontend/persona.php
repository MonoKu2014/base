<div class="container">
  <div class="row">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Perfil Persona</li>
      </ol>
    <div class="clearfix"></div>
    <br>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12 row">
    <div class="row">
      <!-- columna izq -->
      <div class="col-sm-9">

      <br class="visible-xs">

        <div class="row">
        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
        </div>


        <div class="row box-separator">
        <div class="col-md-6">

          <!--foto pefil microempresario -->
          <?php if($persona[0]->imagen_cliente == ''){ ?>
            <img id="respuesta" src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive portfolio-item imagen_perfil" alt="perfil-microempresario">
          <?php } else { ?>
            <img id="respuesta" class="img-responsive portfolio-item imagen_perfil" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$persona[0]->imagen_cliente;?>">
          <?php } ?>
          <!--fin foto pefil microempresario -->
        </div>

        <div class="col-md-6">
          <h1 class=""><strong><?= $this->session->nombre;?></strong></h1>
          <?php if($persona[0]->imagen_cliente == ''){ ?>
          <p>
            <form method="post" id="formulario" enctype="multipart/form-data">
              <input id="upload" name="file" type="file" style="display:none;" />
              <a href="" id="upload_link">Agregar foto de perfil</a> <span style="color: #ff5800;">|</span>
              <a href="<?= base_url();?>editar_persona">Editar mis datos personales</a>
            </form>
          </p>
          <?php } else { ?>
          <p>
            <form method="post" id="formulario" enctype="multipart/form-data">
              <input id="upload" name="file" type="file" style="display:none;" />
              <a href="" id="upload_link">Editar foto de perfil</a> <span style="color: #ff5800;">|</span>
              <a href="<?= base_url();?>editar_persona">Editar mis datos personales</a>
            </form>
          </p>
          <?php } ?>

          <h3>Sector donde vives: <strong><?= $persona[0]->comuna_cliente;?>, <?= $persona[0]->region_cliente;?></strong></h3>

          <h3>Sector donde trabajas: <strong><?= $persona[0]->comuna_trabajo_cliente;?>, <?= $persona[0]->region_trabajo_cliente;?></strong></h3><br>

          <div class="row">
            <div class="col-lg-4" style="border-right: 1px solid #e8e8e8;border-bottom: 1px solid #e8e8e8;">
              <a href="#" class="btn btn-last text-center yo_recomiendo" style="width: 100%;font-size: 12px;padding: 5px;">
                Yo Recomiendo<br>
                <b style="font-size: 20px;" class="orange"><?= $this->functions->cantidadRecomendacionesPorPersona($this->session->id);?></b><br>
                Negocios
              </a>
            </div>

            <div class="col-lg-4" style="border-right: 1px solid #e8e8e8;border-bottom: 1px solid #e8e8e8;">
              <a href="#" class="btn btn-last text-center yo_sigo" style="width: 100%;font-size: 12px;padding: 5px;">
                Yo Sigo<br>
                <b style="font-size: 20px;" class="orange"><?= $this->functions->cantidadSeguidosPorPersona($this->session->id);?></b><br>
                Negocios y Personas
              </a>
            </div>

            <div class="col-lg-4" style="border-bottom: 1px solid #e8e8e8;">
              <a href="#" class="btn btn-last text-center me_siguen" style="width: 100%;font-size: 12px;padding: 5px;">
                Me Siguen<br>
                <b style="font-size: 20px;" class="orange"><?= $this->functions->cantidadSeguidoresPorPersona($this->session->id);?></b><br>
                Personas
              </a>
            </div>
          </div>

          <br>

        </div>


    <div class="row">
      <div class="clearfix"></div>
      <br><br>
      <div class="col-lg-6">
        <p>
          <b>SOLICITUDES DE ALIANZAS</b><br>

              <a href="<?= base_url();?>rse/listado_alianzas"><i class="fa fa-check"></i>
              Solicitudes de Alianzas enviadas por mí</a>
              <br>
              <a href="<?= base_url();?>rse/solicitudes_rse"><i class="fa fa-check"></i>
              Solicitudes de alianzas enviadas para mi desde Portal RSE</a>

        </p>
      </div>
      <div class="col-lg-6">
        <a href="<?= base_url();?>rse/listado_empresas" class="btn btn-new" style="font-weight: bold;text-align: center;font-size: 0.9em;width: 100%;">
        <i class="glyphicon glyphicon-folder-open"></i> &nbsp;Listado de Empresas RSE para Alianzas</a>
      </div>
      <div class="col-sm-12">
        <hr>
      </div>
    </div>

    <div class="row">

        <div class="col-lg-6">
          <p>
              <b>SOLICITUDES DE COTIZACIONES:</b><br>
              <a href="<?= base_url();?>mis_requerimientos"><i class="fa fa-check"></i>
              Ingresadas por mí para recibir Cotizaciones/Ofertas/Presupuestos</a>
              <br>
              <a href="<?= base_url();?>solicitudes"><i class="fa fa-check"></i>
              Recibidas y Sugeridas para enviar Cotización de mis Productos y/o Servicios</a>
          </p>
        </div>

        <div class="col-lg-6">
              <b>ESTADO DE COTIZACIONES/OFERTAS/PRESUPUESTOS:</b><br>
              <a href="<?= base_url();?>mis_ofertas"><i class="fa fa-check"></i>
              Enviadas (<?= $this->functions->contar_ofertas_cliente($this->session->id);?>)</a>
              <br>
              <a href="<?= base_url();?>ofertas_recibidas"><i class="fa fa-check"></i>
              Recibidas (<?= $this->functions->contar_ofertas_recibidas($this->session->id);?>)</a>
          </p>
        </div>
    </div>


        <div class="clearfix"></div>
        <div class="row">
        <div class="col-lg-6">
        <a href="<?= base_url();?>publicar_paso_uno" class="btn btn-new" style="font-weight: bold;text-align: center;font-size: 0.9em;width: 100%;">
        <i class="glyphicon glyphicon-home"></i> Registrar Negocio o Servicio</a>
        </div>

        <div class="col-lg-6">
        <a href="<?= base_url();?>agregar_requerimiento" class="btn btn-info" style="font-weight: bold;text-align: center;font-size: 0.9em;width: 100%;">+ Ingresar Solicitud de Cotizaciones</a>
        </div>

        </div>
        </div>

        <!--promociones -->




        <!-- <div class="clearfix"></div>
        <br>


         <div class="row box-separator">
         <br>
         <div class="col-sm-12"><h2><strong><span style="color: #333;">Muro de Noticias</span></strong>
            <a href="" class="btn btn-info pull-right">Cambiar preferencias del muro</a>
         </h2>
          
          <div class="clearfix"></div><br><br><br>

            <?php foreach ($muro as $key => $dato): ?>

              <?php if ($dato['tipo'] == 'negocio'): ?>
          
                  <div class="row" style="border: 1px solid #ccc;padding: 10px;margin-top: 5px;">
                    <span class="ribbon">Nuevo Microempresario</span>
                    <div class="col-md-2 col-sm-4 col-xs-12 text-center">
                      <?php if($dato['imagen'] == ''){ ?>
                        <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" alt="">
                      <?php } else { ?>
                        <img class="img-responsive" alt="" src="<?= CLIENTES_IMAGES_PATH.$dato['imagen'];?>">
                      <?php } ?>
                    </div>
                    
                    <div class="col-md-8 col-sm-6 col-xs-12">
                      <b><?= $dato['titulo']; ?></b><br>
                      <p>
                        Ubicación: <?= $dato['ubicacion']; ?><br>
                        <small style="font-size: 10px;color: #ccc;"><?= $dato['fecha_creacion']; ?></small>
                      </p>
                      <a href="#" class="btn btn-new label">Recomendar</a> <a href="#" class="btn btn-new label">Seguir</a>
                    </div>
                  </div>

              <?php endif ?>

            <?php endforeach ?>


         </div>


          </div>

        
        <div class="clearfix"></div>
        <br>-->





        <div class="clearfix"></div>
        <br>


         <div class="row box-separator">
         <br>
         <div class="col-sm-9"><h2><strong><span style="color: #333;">Promociones cercanas donde vives</span></strong></h2></div>

          <form id="ordenar-promo-uno-form" method="post">
            <div class="col-sm-3">
              <select id="ordenar-promo-uno" name="ordenar_uno" class="form-control selector opciones-ordenar-por">
              <option <?php if($uno == 4){echo 'selected'; }?> value="4">Todas</option>
              <option <?php if($uno == 1){echo 'selected'; }?> value="1">Descuentos</option>
              <option <?php if($uno == 2){echo 'selected'; }?> value="2">2x1</option>
              <option <?php if($uno == 3){echo 'selected'; }?> value="3">3x2</option>
              </select>
            </div>
          </form>

          <div class="clearfix"></div> <br><br>


          <?php foreach($promociones_vive as $pv) { ?>
          <!--promoción -->
          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="col-lg-12 thumbnail">
              <h3 class="margin-title"><a href="<?= $pv['href'];?>"><?= $pv['promocion'];?> en <?= $pv['nombre'];?></a></h3>

              <a href="<?= $pv['href'];?>">

                <?php
                  if($pv['imagen'] == ''){ ?>
                      <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                <?php } else { ?>
                      <img class="img-responsive portfolio-item" src="<?= $pv['imagen'];?>" alt="">
                <?php } ?>

              </a>
              <p> <br><a class="gray" href="<?= base_url();?>microempresarios/detalle/1/<?= $pv['id_empresa'];?>/<?= $pv['id_categoria'];?>"><strong><?= $pv['empresa'];?></strong></a></p>
            </div>
          <!--fin promoción -->
          </div>
          <hr class="visible-xs">
          <?php } ?>

        </div>

        <!--fin-promociones -->
        <div class="clearfix"></div>
        <br>


        <!--promociones donde trabajo -->

        <div class="row box-separator">

         <div class="col-sm-9"><h2><strong><span style="color: #333;">Promociones cercanas donde trabajas</span></strong></h2></div>

            <div class="col-sm-3">
              <select form="ordenar-promo-uno-form" id="ordenar-promo-dos" name="ordenar_dos" class="form-control selector opciones-ordenar-por">
              <option <?php if($dos == 4){echo 'selected'; }?> value="4">Todas</option>
              <option <?php if($dos == 1){echo 'selected'; }?> value="1">Descuentos</option>
              <option <?php if($dos == 2){echo 'selected'; }?> value="2">2x1</option>
              <option <?php if($dos == 3){echo 'selected'; }?> value="3">3x2</option>
              </select>
            </div>

          <div class="clearfix"></div> <br><br>

          <?php foreach($promociones_trabajo as $pt) { ?>
          <!--promoción -->
          <div class="col-lg-3 col-md-3 col-sm-3">
            <div class="col-lg-12 thumbnail">
              <h3 class="margin-title"><a href="<?= $pv['href'];?>"><?= $pt['promocion'];?> en <?= $pt['nombre'];?></a></h3>

              <a href="<?= $pv['href'];?>">

                <?php
                  if($pt['imagen'] == ''){ ?>
                      <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                <?php } else { ?>
                      <img class="img-responsive portfolio-item" src="<?= $pt['imagen'];?>" alt="">
                <?php } ?>

              </a>
              <p><br> <a class="gray" href="<?= base_url();?>microempresarios/detalle/1/<?= $pt['id_empresa'];?>/<?= $pv['id_categoria'];?>"><strong><?= $pt['empresa'];?></strong></a></p>
            </div>
          <!--fin promoción -->
          </div>
          <hr class="visible-xs">
          <?php } ?>

        </div>

        <!--fin promociones donde trabajo -->



      </div>
        <!--fin columna izq -->

      <!-- columna der -->
      <div class="col-sm-3">

        <div class="box-separator box-lateral" style="height: 600px;">


            <h2 style="color: #333;">Mis Negocios:</h2>
            <p>
            <?php foreach($publica_empresa as $pe){ ?>
                <a class="label label-success" style="color: #fff;background: #0dcbab;" href="<?= base_url();?>microempresario/<?= $pe->id_empresa;?>">
                    <?= $pe->nombre_empresa;?>
                </a>
            <br>
            <?php } ?>
            </p>

            <hr>



            <h2 style="font-size: 18px;color: #333;">Podrías querer seguir a:</h2>
            <br>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#negocios_tabs">Negocios</a></li>
              <li><a data-toggle="tab" href="#personas_tabs">Usuarios</a></li>
            </ul>

            <div class="tab-content">
              <div id="personas_tabs" class="tab-pane fade">

                <?php foreach($personas_sugeridas as $p){ ?>

                <?php if($p->id_cliente != $this->session->id){ ?>

                <?php if($this->functions->yaSeguido($p->id_cliente) == 0){ ?>

                  <div class="col-lg-12 thumbnail" id="persona_<?= $p->id_cliente;?>" style="border-top: none;border-left: none;border-right: none;font-size: 11px !important;">
                    <div class="col-lg-3" style="padding: 0;">
                    <?php
                      if($p->imagen_cliente == ''){ ?>
                        <a href="<?= base_url();?>perfil_persona/<?= $p->id_cliente;?>" style="cursor: pointer;">
                          <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>perfil.jpg" alt="Imagen promocion">
                        </a>
                        <br class="visible-xs">
                    <?php } else { ?>
                        <a href="<?= base_url();?>perfil_persona/<?= $p->id_cliente;?>" style="cursor: pointer;">
                          <img class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$p->imagen_cliente;?>">
                        </a>
                        <br class="visible-xs">
                    <?php } ?>
                    </div>
                    <div class="col-lg-9">
                    <p style="text-align: left;">
                    <b><a href="<?= base_url();?>perfil_persona/<?= $p->id_cliente;?>" style="cursor: pointer;"><?= $p->nombre_cliente;?></a></b><br>
                    <b><?= $p->region_cliente;?>, <?= $p->comuna_cliente;?></b><br>
                    <b><a href="#" class="seguir_recomendacion" data-id="<?= $p->id_cliente;?>" style="cursor: pointer;">+ Seguir Recomendaciones</a></b>
                    </p>
                    </div>
                  </div>

                  <?php } ?>

                  <?php } ?>

                <?php } ?>

              </div>
              <div id="negocios_tabs" class="tab-pane fade in active">
                <?php foreach($empresas_sugeridas as $e){ ?>

                <?php if($this->functions->yaSeguidoEmpresa($e->id_empresa) == 0){ ?>

                  <div class="col-lg-12 thumbnail" id="empresa_<?= $e->id_empresa;?>" style="border-top: none;border-left: none;border-right: none;font-size: 11px !important;">
                    <div class="col-lg-3" style="padding: 0;">
                    <?php
                      if($e->imagen_empresa == ''){ ?>
                        <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>" style="cursor: pointer;">
                          <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="Imagen promocion">
                        </a>
                        <br class="visible-xs">
                    <?php } else { ?>
                        <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>" style="cursor: pointer;">
                          <img class="img-responsive" alt="perfil-cliente" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>">
                        </a>
                        <br class="visible-xs">
                    <?php } ?>
                    </div>
                    <div class="col-lg-9">
                    <p style="text-align: left;">
                    <b><a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>" style="cursor: pointer;color:#0dcbab !important;">
                        <?= $e->nombre_empresa;?></a></b><br>
                    <b><?= $e->region_empresa;?>, <?= $e->comuna_empresa;?></b><br>
                    <b><a href="#" class="seguir_empresa" data-id="<?= $e->id_empresa;?>" data-persona="<?= $e->id_cliente;?>" style="cursor: pointer;">+ Seguir Promociones</a></b>
                    </p>
                    </div>
                  </div>

                  <?php } ?>

                <?php } ?>
              </div>
            </div>

        </div>

        <br>


        <div class="box-separator">

        <p><strong>Yo recomiendo a:</strong></p>
        <p>
        <?php foreach($recomendaciones as $r){ ?>
        <small>
            <a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $r->id_empresa;?>/<?= $r->id_categoria;?>"><?= $r->nombre_empresa;?></a>
        </small><br>
        <?php } ?>

        </p>

        <hr>

        <a href="<?= base_url();?>rse/validar_convenio" class="btn btn-new">Validar Alianzas</a>

        </div>


      </div>
      <!--fin columna der-->

      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>


<div id="cargar_modal"></div>


<!-- Fin Container -->

<script>

var id_session = <?php echo $this->session->id;?>;


$(function(){
  $("#upload_link").on('click', function(e){
      e.preventDefault();
      $("#upload:hidden").trigger('click');
  });
});



  $('input[name="file"]').on('change', function(){
  var formData = new FormData($('#formulario')[0]);
  var ruta = APP_URL + 'ajax/imagen_perfil_persona';
    $.ajax({
      url: ruta,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      dataType: 'json',
      success: function(datos){
        if(datos.estado == 1){

        } else {
          $('#respuesta').attr('src', datos.img);
        }
      }
    });
  });

$(document).on('change', '#ordenar-promo-uno', function(){
    $('#ordenar-promo-uno-form').trigger('submit');
});


$(document).on('change', '#ordenar-promo-dos', function(){
    $('#ordenar-promo-uno-form').trigger('submit');
});


$('.seguir_recomendacion').on('click', function(event){

    event.preventDefault();
    var id_persona = $(this).data('id');
    $.ajax({
      url: APP_URL + 'ajax/comenzarSeguirPersona',
      type: 'post',
      data: {id_persona:id_persona},
      success: function(res){
          $('#persona_' + id_persona).fadeOut();
      }
    });

});



$('.seguir_empresa').on('click', function(event){

    event.preventDefault();
    var id_empresa = $(this).data('id');
    var id_persona = $(this).data('persona');
    $.ajax({
      url: APP_URL + 'ajax/comenzarSeguirEmpresa',
      type: 'post',
      data: {id_empresa:id_empresa, id_persona:id_persona},
      success: function(res){
          $('#empresa_' + id_empresa).fadeOut();
      }
    });

})


    $('.yo_recomiendo').on('click', function(e){
        e.preventDefault();
        $.ajax({
          url: APP_URL + 'ajax/cargarModal',
          type: 'post',
          data: {accion:1},
          success: function(res){
            $('#cargar_modal').html(res);
            $('.modal_ajax').modal();
          }
        });
    });


    $('.yo_sigo').on('click', function(e){
        e.preventDefault();
        $.ajax({
          url: APP_URL + 'ajax/cargarModal',
          type: 'post',
          data: {accion:2},
          success: function(res){
            $('#cargar_modal').html(res);
            $('.modal_ajax').modal();
          }
        });
    });


    $('.me_siguen').on('click', function(e){
        e.preventDefault();
        $.ajax({
          url: APP_URL + 'ajax/cargarModal',
          type: 'post',
          data: {accion:3},
          success: function(res){
            $('#cargar_modal').html(res);
            $('.modal_ajax').modal();
          }
        });
    });


</script>
