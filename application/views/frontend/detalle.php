<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>microempresarios/<?= $tipo;?>/<?= $madre;?>">Microempresa(rios)</a></li>
        <li class="active"><?= $microempresario[0]->nombre_empresa;?></li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12">
    <div class="row">


      <div class="col-md-10">
      <div class="row">
        <div class="box-separator col-md-11 fix-col">
        <div class="col-sm-4">
          <?php if($microempresario[0]->imagen_empresa == ''){ ?>
              <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($microempresario[0]->id_categoria);?>" alt="">
          <?php } else { ?>
              <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$microempresario[0]->imagen_empresa;?>" alt="">
          <?php } ?>

        </div>
        <div class="col-sm-6"><br class="visible-xs">
          <h5><?= $this->functions->nombreCategoria($microempresario[0]->id_categoria);?></h5>
          <h1 style="color: #0dcbab;"><?= $microempresario[0]->nombre_empresa;?></h1>
          <p><small><?= $this->functions->SCNombresPorEmpresa($microempresario[0]->id_empresa);?></small></p>
          <h3><strong><?= $microempresario[0]->calle_empresa;?> <?= $microempresario[0]->numero_calle_empresa;?>, <?= $microempresario[0]->comuna_empresa;?>, <?= $microempresario[0]->region_empresa;?></strong></h3>
          <br>
          <br>
          <p>
            <i class="fa fa-mobile-phone" aria-hidden="true"></i> &nbsp;<strong>Celular:</strong> <?= $this->functions->fono_empresa($microempresario[0]->celular_empresa);?><br>
            <i class="fa fa-phone" aria-hidden="true"></i> <strong>Teléfono:</strong> <?= $this->functions->fono_empresa($microempresario[0]->fono_empresa);?><br>
            <i class="fa fa-envelope" aria-hidden="true"></i> <strong>Email:</strong>
            <?= $this->functions->datoCliente($microempresario[0]->id_cliente, 'email_cliente');?>
            <br>
            <?php if($microempresario[0]->sitio_empresa != ''){ ?>
            <i class="fa fa-external-link" aria-hidden="true"></i> <strong>Sitio Web:</strong> <?= $microempresario[0]->sitio_empresa;?><br>
            <?php } ?>
            <br>
          </p>
          <?php if($this->session->perfil == 0){?>

            <?php if($this->functions->yaSeguidoEmpresa($microempresario[0]->id_empresa) == 0){ ?>
              <a class="btn btn-success col-sm-6" href="#" id="seguir" data-id="<?= $microempresario[0]->id_empresa;?>">+ Seguir Promociones</a>
              <div class="clearfix"></div>
            <?php } else { ?>
              <a class="btn btn-danger col-sm-6" href="#" id="no-seguir" data-id="<?= $microempresario[0]->id_empresa;?>">+ NO Seguir Promociones</a>
              <div class="clearfix"></div>
            <?php } ?>
          <?php } ?>


          <a class="btn btn-info col-sm-6" href="#contactar-modal" data-toggle="modal">Contactar</a>
          <div class="clearfix"></div>
          <?php if($this->functions->yaFueRecomendada($microempresario[0]->id_empresa) == 1){?>
                <a class="btn btn-warning col-sm-6" id="boton-quitar-recomendacion">Lo recomiendo <i class="fa fa-check"></i></a>
          <?php } else { ?>
                <a class="btn btn-default col-sm-6" id="boton-recomendar">Recomendar</a>
          <?php } ?>
        </div>
        </div>
        </div>
      </div>



      <div class="col-sm-2 psmall box-separator">
        <p>
        <small>
          <span class="orange">

          <a href="#recomendaciones-modal" data-toggle="modal"><?= $this->functions->cantidadRecomendaciones($microempresario[0]->id_empresa);?> Recomendacion(es) en total</a><br>

          <a href="<?= base_url();?>microempresarios/listado_productos/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>">
          <?= $this->functions->cantidadProductos($microempresario[0]->id_empresa);?> Productos
          </a>
          <br>

          <a href="<?= base_url();?>microempresarios/listado_servicios/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>">
          <?= $this->functions->cantidadServicios($microempresario[0]->id_empresa);?> Servicios
          </a>
          <br>

          <a href="<?= base_url();?>microempresarios/listado_promociones/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>">
          <?= $this->functions->cantidadPromociones($microempresario[0]->id_empresa);?> Promociones</a>

          <br>
          <a href="#seguidores-modal" data-toggle="modal">
          <?= $this->functions->cantidadSeguidores($microempresario[0]->id_empresa);?> Seguidor(es)
          </a>

          </span>
          </small>

          </p>
        <?php if(count($pagos) > 0){ ?>
        <hr>
        <p><strong>Medios de Pago</strong><br><br>
          <small>
            <?php
            $pago = '';
            foreach($pagos as $p){ $pago .= $p->nombre_medio_pago.', ';  }
            echo substr($pago, 0, -2);
            ?>.
          </small>
        </p>
        <?php } ?>
        <hr>

        <p><strong>Servicio a Domicilio</strong>
        <br><br>
          <?php if($microempresario[0]->despacho_empresa == 'Si'){ ?>
            <small>Incluido</small>
          <?php } else { ?>
            <small>No incluye</small>
          <?php } ?>
        </p>

      </div>




      <!-- tabs -->
      <div class="col-md-12 box-separator"><br><br>
      <p class="alert alert-info alerta-mensaje"></p>

     <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#descripcion" aria-controls="home" role="tab" data-toggle="tab">Descripción</a></li>
    <li role="presentation"><a href="#comentarios" aria-controls="messages" role="tab" data-toggle="tab">Comentarios</a></li>

  </ul>

  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade in active" id="descripcion">
      <p><?= $microempresario[0]->descripcion_empresa;?></p>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="comentarios">
    <h2 class="orange"><small>(Para Comentar debes estás registrado, si ya lo estás ingresa
      <a href="<?= base_url();?>registro/ingreso">aquí</a>. Si no, regístrate <a href="<?= base_url();?>registro">acá</a>)</small> </h2>

     <br>

      <div id="comentarios-content" data-id="<?= $microempresario[0]->id_empresa;?>" data-cliente="<?= $microempresario[0]->id_cliente;?>">
        <!-- CARGA CONTENIDO DE COMENTARIOS CON AJAX -->
      </div>

     <br><br>


        <form>

         <div class="col-sm-6 row">
         <p><i class="fa fa-user"></i> <?= $this->session->nombre;?>
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="El comentario quedará guardado con tu nombre de usuario registrado"></i>
            <span class="mensaje-comentario"></span>
         </p>
         <textarea name="Comentario" class="form-control" rows="3" id="comentario" placeholder="Comentarios"></textarea>
         </div>
         <div class="clearfix"></div><br>

          <?php if($cliente = $this->session->id){ ?>
              <input type="button" id="comentar" class="btn btn-primary" value="Comentar"  />
          <?php } else { ?>
              <p class="alert alert-info">Sólo puedes comentar iniciando tu sesión</p>
          <?php } ?>

        </form>
        <br>

    </div>

  </div>

</div><!--fin tabs -->

      <div class="clearfix"></div>
      <br>




      <!--section productos -->

      <div class="col-sm-12 box-separator"><br>
        <br>
        <h2 class="orange" style="color: #111 !important;">Productos Microempresa(rio)
        <a href="<?= base_url();?>microempresarios/listado_productos/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>" class="pull-right">Ver listado completo</a>
        </h2>

        <div class="divisor"></div>
        <div class="row">

          <?php foreach($productos as $p){ ?>
          <!--producto -->

          <div class="col-md-2 col-sm-3">
          <div class="col-lg-12 thumbnail">
            <h3 class="margin-title"><a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $p->id_producto;?>"><strong><?= $p->nombre_producto;?></strong></a></h3>
            <a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $p->id_producto;?>">
            <?php
            $imagen = $this->functions->ImagenPrincipalProducto($p->id_producto);
              if($imagen == ''){ ?>
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
            <?php } else { ?>
                  <img class="img-responsive portfolio-item" src="<?= PRODUCTOS_EMPRESA_PATH.$imagen;?>" alt="">
            <?php } ?>
            </a>
            <p><strong>$<?= $this->functions->moneda($p->precio_producto);?></strong></p>
            <p><a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $p->id_producto;?>">Ver detalle</a></p>
          </div>
          </div>

          <!--fin producto -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion productos -->

      <!--section servicios -->

      <div class="col-sm-12 box-separator"><br>
        <br>
        <h2 class="orange" style="color: #111 !important;">Servicios Microempresa(rio)
        <a href="<?= base_url();?>microempresarios/listado_servicios/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>" class="pull-right">Ver listado completo</a>
        </h2>

        <div class="divisor"></div>
        <div class="row">

          <?php foreach($servicios as $s){ ?>
          <!--servicio -->

          <div class="col-md-2 col-sm-3">
          <div class="col-lg-12 thumbnail">
            <h3 class="margin-title"><a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $s->id_servicio;?>"><strong><?= $s->nombre_servicio;?></strong></a></h3>
            <a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $s->id_servicio;?>">
            <?php $imagen = $this->functions->ImagenPrincipalServicio($s->id_servicio);
              if($imagen == ''){ ?>
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
            <?php } else { ?>
                  <img class="img-responsive portfolio-item" src="<?= SERVICIOS_EMPRESA_PATH.$imagen;?>" alt="">
            <?php } ?>
            </a>
            <p><strong>Desde $<?= $this->functions->moneda($s->precio_servicio);?></strong></p>
            <p><a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>/<?= $s->id_servicio;?>">Ver detalle</a></p>
          </div>
          </div>

          <!--fin servicio -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion servicios -->

      <!-- Seccion promociones-->

      <div class="col-sm-12 box-separator"><br>
        <br>
        <h2 class="orange" style="color: #111 !important;">Promociones Microempresa(rio)
        <a href="<?= base_url();?>microempresarios/listado_promociones/<?= $tipo;?>/<?= $madre;?>/<?= $microempresario[0]->id_empresa;?>" class="pull-right">Ver listado completo</a>
        </h2>

        <div class="divisor"></div>
        <div class="row">


          <?php foreach ($promociones as $p) { ?>
          <!--promocion -->

          <div class="col-md-2 col-sm-3">
              <div class="col-lg-12 thumbnail">
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
                <br>
                <p class="text-center">
                <a class="text-center promociones-pre" style="color:#fff !important;background: <?= $p['color'];?>" href="<?= $p['href'];?>"><?= $p['promocion'];?></a>
                </p>
              </div>
          </div>

          <!--fin promocion -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion promociones -->



      <!--fin seccion video -->

      <!-- Seccion videos-->

      <div class="col-sm-12 box-separator"><br>
        <br>
        <h2 class="orange">Otros microempresa(rios) de la zona</h2>
        <div class="divisor"></div>
        <div class="row">


          <?php foreach ($otras_empresas as $e){?>
          <!--microempresasio -->

          <div class="col-md-3 col-sm-3 psmall">
          <div class="col-lg-12 thumbnail">
            <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
              <?php if($e->imagen_empresa == ''){ ?>
                  <img class="img-responsive portfolio-item gris" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="">
              <?php } else { ?>
                  <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>" alt="">
              <?php } ?>
            </a>
            <p><small><?= $e->nombre_categoria;?></small></p>
            <h3 class="margin-title"><a style="color: #0dcbab;" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <p>
              <?= $this->functions->texto_general(3);?> <?= $e->region_empresa;?>,
              <?= $this->functions->texto_general(4);?> de <?= $e->comuna_empresa;?>,
              <?= $e->calle_empresa;?>
              <?= $e->numero_calle_empresa;?>
            </p>
          </div>
          </div>

          <!--fin microempresario -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion video -->

      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>



          <div id="recomendaciones-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de personas que recomiendan
                        <span style="color: #0dcbab;"><?= $microempresario[0]->nombre_empresa;?></span></h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarRecomendacionesPorEmpresa($microempresario[0]->id_empresa) as $k => $r){ ?>
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



    <div id="contactar-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">Contactar a <b class="orange"><?= $microempresario[0]->nombre_empresa;?></b></h2>
                <p>Tus datos vienen cargados de acuerdo a nuestra base de datos</p>
            </div>
            <div class="modal-body" id="modal-body">
            <div class="clearfix"></div>
              <form id="contactar-formulario">
                  <div class="col-md-12">
                    <div id="aviso-proceso"></div>
                      <h5>Nombre</h5>
                      <p></p>
                      <input type="text" class="form-control" required id="nombre" placeholder="Ingresa tu nombre" value="<?= $this->session->nombre;?>" />
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="col-md-12">
                      <h5>E-mail</h5>
                      <p></p>
                      <input type="text" class="form-control" required id="email" placeholder="Ingresa tu email" value="<?= $this->session->email;?>" />
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="col-md-12">
                      <h5>Mensaje</h5>
                      <p></p>
                      <textarea class="form-control" placeholder="Ingrese su mensaje" id="mensaje" required rows="3"></textarea>
                  </div>
              </form>
              <div class="clearfix"></div>
            </div>
            <div class="modal-footer">
              <div class="clearfix"></div>
              <div class="col-md-12">
                  <br>
                  <input type="submit" value="Contactar" class="btn btn-primary" id="envia-contacto" form="contactar-formulario">
              </div>
            </div>
          </div>
        </div>
    </div>

          <div id="seguidores-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de seguidores de promociones de <span style="color: #0dcbab;"><?= $microempresario[0]->nombre_empresa;?></span></h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($microempresario[0]->id_empresa) as $k => $r){ ?>
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


<script>

$(document).ready(function(){

  var id_empresa = $('#comentarios-content').data('id');
  var id_cliente = $('#comentarios-content').data('cliente');

  $('#comentar').on('click', function(){
    guardarComentario();
  });

  comentarios(id_empresa);

  function comentarios(id_empresa){

    $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comentariosPorEmpresa',
        data: {id_empresa:id_empresa},
        success: function(res){
          $('#comentarios-content').html(res);
        }
    });

  }


  function guardarComentario(){
    var comentario = $('#comentario').val();
    $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/guardarComentario',
        data: {id_empresa:id_empresa,comentario:comentario, id_cliente:id_cliente},
        success: function(res){
          comentarios(id_empresa);
          if(res == 1){
            simple_alert('Perfecto!', 'Gracias por tu comentario', 'success');
          } else {
            simple_alert('Atención', 'No hemos podido guardar tu comentario', 'warning');
          }
          $('#comentario').val('');
        }
    });
  }


  $('#envia-contacto').on('click', function(event){
        event.preventDefault();
        nombre = $('#nombre').val();
        email = $('#email').val();
        mensaje = $('#mensaje').val();
        if(nombre.trim() == '' || email.trim() == '' || mensaje.trim() == ''){
              event.preventDefault();
              simple_alert('Atención', 'Ingresa tu nombre, correo y mensaje por favor', 'warning');
        } else {
            $('#aviso-proceso').addClass('alert alert-info').html('<i class=" fa fa-spinner fa-spin"></i> Enviando su mensaje...');
            $.ajax({
                type: 'post',
                url: APP_URL + 'ajax/contactar',
                data: {id_empresa:id_empresa, nombre:nombre, email:email, mensaje:mensaje, id_cliente:id_cliente},
                dataType: 'json',
                success: function(res){
                    if(res.estado == 0){
                        $('#aviso-proceso').empty().html(res.mensaje);
                        setTimeout(function(){
                            $('#contactar-modal').modal('hide');
                            $('#contactar-formulario').reset();
                         }, 2000);
                    }
                }
            });
        }

  });


  $(document).on('click', '#boton-quitar-recomendacion', function(){
      var session = '<?php echo $this->session->id;?>';
      if(session == ''){
          $('#iniciar-sesion').modal();
      } else {
          $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/borrar_recomendar',
              data: {id_empresa:id_empresa, id_cliente:id_cliente},
              success: function(res){
                  $('#boton-quitar-recomendacion').removeAttr('id').attr('id', 'boton-recomendar').html('Recomendar');
                  if(res == 1){
                  swal({
                     title: 'Perfecto!',
                     text: 'Ya no recomiendas a este Microempresario',
                     type: 'success'
                    },
                    function(){
                      location.reload();
                    });
                  } else {
                    simple_alert('Atención', 'Hubo un error', 'warning');
                  }
              }
          });
      }
  });

  $(document).on('click', '#boton-recomendar', function(){
      var session = '<?php echo $this->session->id;?>';
      if(session == ''){
          $('#iniciar-sesion').modal();
      } else {
          $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/recomendar',
              data: {id_empresa:id_empresa, id_cliente:id_cliente},
              success: function(res){
                  $('#boton-recomendar').removeAttr('id').attr('id', 'boton-quitar-recomendacion').html('Lo recomiendo <i class="fa fa-check"></i>');
                  if(res == 1){
                  swal({
                     title: 'Perfecto!',
                     text: 'Gracias por recomendar a este Microempresario',
                     type: 'success'
                    },
                    function(){
                      location.reload();
                    });
                  } else {
                    simple_alert('Atención', 'Hubo un error', 'warning');
                  }
              }
          });
      }
  });


    var url = window.location;
    $('.fb-share-button').attr('data-href', url);



    $('#seguir').on('click', function(event){
      event.preventDefault();
      var id_empresa = $(this).data('id');
      var session = '<?php echo $this->session->id;?>';
      if(session == ''){
          $('#iniciar-sesion').modal();
      } else {
          $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/comenzarSeguirEmpresa',
              data: {id_empresa:id_empresa, id_cliente:id_cliente},
              success: function(res){
                  swal({
                   title: 'Perfecto!',
                   text: 'Ya estas siguiendo a esta empresa',
                   type: 'success'
                  },
                  function(){
                    location.reload();
                  });
              }
          });
      }
    });


    $('#no-seguir').on('click', function(event){
      event.preventDefault();
      var id_empresa = $(this).data('id');
      var session = '<?php echo $this->session->id;?>';
      if(session == ''){
          $('#iniciar-sesion').modal();
      } else {
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/dejarSeguirEmpresa',
            data: {id_empresa:id_empresa, id_cliente:id_cliente},
            success: function(res){
                  swal({
                   title: 'Perfecto!',
                   text: 'Ya no estas siguiendo a esta empresa',
                   type: 'success'
                  },
                  function(){
                    location.reload();
                  });
            }
        });
      }
    });


});

</script>