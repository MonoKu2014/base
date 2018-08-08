<?php
//SUMAR VISTAS AL PRODUCTO
$this->functions->sumarVistas($producto[0]->id_producto);
?>

<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>microempresarios/<?= $tipo;?>/<?= $madre;?>">Microempresarios</a></li>
        <li><a href="<?= base_url();?>microempresarios/detalle/<?= $tipo;?>/<?= $id_empresa;?>/<?= $madre;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a></li>
        <li class="active">Detalle producto</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12 row">
    <div class="row">


      <div class="col-lg-10 box-separator">
      <div class="row">
      <div class="col-sm-6">
        <div id="carousel" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <?php
            if(count($imagenes) == 0){ ?>
                <div class="item active">
                    <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="Sin Imagen">
                </div>
            <?php } else {
            foreach($imagenes as $k => $i){
                if($k == 0){ $class = 'active'; } else { $class = ''; } ?>
                <div class="item <?= $class;?>">
                    <img src="<?= PRODUCTOS_EMPRESA_PATH.$i->nombre_imagen;?>" alt="Producto <?= $k;?>">
                </div>
            <?php } } ?>
          </div>
        </div>
        <div class="clearfix"></div>
        <div id="thumbcarousel" class="carousel slide" data-interval="false">
          <div class="carousel-inner">

                <div class="item active">
                  <?php
                  foreach($imagenes as $k => $i){ ?>
                      <div data-target="#carousel" data-slide-to="<?= $k;?>" class="thumb">
                        <img src="<?= PRODUCTOS_EMPRESA_PATH.$i->nombre_imagen;?>" class="img-responsive" alt="Producto <?= $k;?>">
                      </div>
                  <?php if($k == 3){break;} } ?>
                </div>


                <?php if(count($imagenes) > 4){?>
                <div class="item">
                  <?php
                  foreach($imagenes as $k => $i){
                    if($k > 3){ ?>
                      <div data-target="#carousel" data-slide-to="<?= $k;?>" class="thumb">
                        <img src="<?= PRODUCTOS_EMPRESA_PATH.$i->nombre_imagen;?>" class="img-responsive" alt="Producto <?= $k;?>">
                      </div>
                  <?php } } ?>
                </div>
                <?php } ?>

          </div>
          <!-- /carousel-inner -->
              <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"></span></a>
              <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
          </div>
      </div>
      <div class="col-sm-6"><br class="visible-xs">
        <h5><strong>
            <a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/<?= $tipo;?>/<?= $id_empresa;?>/<?= $madre;?>">
            <?= $empresa[0]->nombre_empresa;?>
            </a>
        </strong></h5>
        <p><small><?= $this->functions->SCNombresPorEmpresa($empresa[0]->id_empresa);?></small></p>
        <h1 class="orange"><?= $producto[0]->nombre_producto;?></h1>

        <?php $descuento = $this->functions->precioDescuento($producto[0]->id_producto); ?>
        <?php $tipo_promocion = $this->functions->tipoPromocion($producto[0]->id_producto); ?>

        <h3 class="precio">
          <?php if($descuento != '' && $tipo_promocion == 1){ ?>
            <small>$<?= $this->functions->moneda($producto[0]->precio_producto);?></small>
            <strong>$<?= $descuento;?></strong>
          <?php } else { ?>
            <strong>$<?= $this->functions->moneda($producto[0]->precio_producto);?></strong>
          <?php } ?>
        </h3>
        <br>
        <br>
        <p>
          <i class="fa fa-mobile-phone" aria-hidden="true"></i> &nbsp;<strong>Celular:</strong> <?= $this->functions->fono_empresa($empresa[0]->celular_empresa);?><br>
          <i class="fa fa-phone" aria-hidden="true"></i> <strong>Teléfono:</strong> <?= $this->functions->fono_empresa($empresa[0]->fono_empresa);?><br>
          <i class="fa fa-envelope" aria-hidden="true"></i> <strong>Email:</strong>
          <?= $this->functions->datoCliente($empresa[0]->id_cliente, 'email_cliente');?>
          <br>
          <?php if($empresa[0]->sitio_empresa != ''){ ?>
          <i class="fa fa-external-link" aria-hidden="true"></i> <strong>Sitio Web:</strong> <?= $empresa[0]->sitio_empresa;?><br>
          <?php } ?>
          <br>
          <br>
        </p>
        <a class="btn btn-info col-sm-6" href="#contactar-modal" data-toggle="modal">Contactar</a>
        <div class="clearfix"></div>
        <?php if($this->functions->yaFueRecomendada($producto[0]->id_empresa) == 1){?>
              <a class="btn btn-warning col-sm-6" id="boton-quitar-recomendacion">Lo recomiendo <i class="fa fa-check"></i></a>
        <?php } else { ?>
              <a class="btn btn-warning col-sm-6" id="boton-recomendar">Recomendar</a>
        <?php } ?>
      </div>
      </div>
      </div>




      <div class="col-sm-2 psmall">
      <div class="box-separator">
        <!--promociones -->
        <?php foreach($promocion as $p){
          if($p->id_tipo_promocion > 1){ $texto = 'Promoción'; } else { $texto = ''; }
          ?>
            <p class="promociones text-center" style="background:<?= $p->color_promocion;?>"> <?= $texto.' '.$p->descuento_promocion.' '.$p->tipo_promocion;?></p>
        <?php } ?>

        <!--fin promociones -->


        <p>
        <small>
          <span class="orange">

          <a href="#recomendaciones-modal" data-toggle="modal"><?= $this->functions->cantidadRecomendaciones($id_empresa);?> Recomendacion(es) en total</a><br>

          <a href="<?= base_url();?>microempresarios/listado_productos/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>">
          <?= $this->functions->cantidadProductos($id_empresa);?> Productos
          </a>
          <br>

          <a href="<?= base_url();?>microempresarios/listado_servicios/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>">
          <?= $this->functions->cantidadServicios($id_empresa);?> Servicios
          </a>
          <br>

          <a href="<?= base_url();?>microempresarios/listado_promociones/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>">
          <?= $this->functions->cantidadPromociones($id_empresa);?> Promociones</a>

          <br>
          <a href="#seguidores-modal" data-toggle="modal">
          <?= $this->functions->cantidadSeguidores($id_empresa);?> Seguidor(es)
          </a>

          </span>
          </small>

          </p>
        <?php if(count($pagos) > 0){ ?>
        <hr>
        <p><strong>Medios de Pago</strong><br>
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
        <p><strong>Servicio a Domicilio</strong><br>
          <?php if($empresa[0]->despacho_empresa == 'Si'){ ?>
            <small>Incluido</small>
          <?php } else { ?>
            <small>No incluye</small>
          <?php } ?>
        <hr>
        <p><strong>Compartir</strong><br>
          <div class="fb-share-button" data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank">Compartir</a></div>
          <br><br>
          <a href="https://twitter.com/share" class="twitter-share-button" data-via="username" data-lang="es" data-size="large">Twittear</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </p>
      </div>
      </div>


      <div class="clearfix"></div>
      <div class="box-separator">
      <div class="col-md-6 col-sm-12"><br>
        <h2 class="orange">Descripción Producto</h2>
        <p class="text-justify"><?= $producto[0]->descripcion_producto;?></p>
      </div>
      <div class="col-md-6 col-sm-12"><br>
        <h2 class="orange">Especificaciones</h2>
        <p class="text-justify"><?= $producto[0]->especificacion_producto;?></p>
      </div>
      <div class="clearfix"></div>
      </div>

      <div class="clearfix"></div>

      <!--section productos -->

      <div class="col-sm-12 box-separator">
        <h2 class="orange">Otros Productos de <?= $empresa[0]->nombre_empresa;?></h2>
        <div class="divisor"></div>
        <div class="row">

          <?php foreach($productos as $p){ ?>
          <!--producto -->

          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>"><strong><?= $p->nombre_producto;?></strong></a></h3>
            <?php
            $imagen = $this->functions->ImagenPrincipalProducto($p->id_producto);
              if($imagen == ''){ ?>
                <a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= PRODUCTOS_EMPRESA_PATH.$imagen;?>" alt="">
                </a>
            <?php } ?>
            <p><strong>$<?= $this->functions->moneda($p->precio_producto);?></strong></p>
            <p><a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">Ver detalle</a></p>
          </div>

          <!--fin producto -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion productos -->

      <!--section servicios -->

      <div class="col-sm-12 box-separator">
        <h2 class="orange">Servicios Microempresa(rio)</h2>
        <div class="divisor"></div>
        <div class="row">

          <?php foreach($servicios as $s){ ?>
          <!--servicio -->

          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $s->id_servicio;?>"><strong><?= $s->nombre_servicio;?></strong></a></h3>
            <?php
            $imagen = $this->functions->ImagenPrincipalServicio($s->id_servicio);
              if($imagen == ''){ ?>
                <a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $s->id_servicio;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $s->id_servicio;?>">
                  <img class="img-responsive portfolio-item" src="<?= SERVICIOS_EMPRESA_PATH.$imagen;?>" alt="">
                </a>
            <?php } ?>
            <p><small>Desde $<?= $this->functions->moneda($s->precio_servicio);?></small></p>
            <p><a href="<?= base_url();?>microempresarios/servicio/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $s->id_servicio;?>">Ver detalle</a></p>
          </div>

          <!--fin servicio -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

      <!--fin seccion servicios -->

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
                      <h2 class="modal-title">Listado de personas que recomiendan</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarRecomendacionesPorEmpresa($producto[0]->id_empresa) as $k => $r){ ?>
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
                <h2 class="modal-title">Contactar por <b class="orange"><?= $producto[0]->nombre_producto;?></b></h2>
                <p>Tus datos vienen cargados de acuerdo a nuestra base de datos</p>
            </div>
            <div class="modal-body" id="modal-body" data-id="<?= $producto[0]->id_empresa;?>" data-cliente="<?= $empresa[0]->id_cliente;?>">
            <div class="clearfix"></div>
              <form id="contactar-formulario">
                  <div class="col-md-12">
                    <div id="aviso-proceso"></div>
                      <h5>Producto</h5>
                      <p></p>
                      <input type="text" class="form-control" required id="producto"  value="<?= $producto[0]->nombre_producto;?>" />
                  </div>
                  <div class="clearfix"></div><br>
                  <div class="col-md-12">
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
                      <textarea class="form-control" placeholder="Ingrese su mensaje" id="mensaje" required rows="10"></textarea>
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
                      <h2 class="modal-title">Listado de seguidores</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($id_empresa) as $k => $r){ ?>
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

  var id_empresa = $('#modal-body').data('id');
  var id_cliente = $('#modal-body').data('cliente');


  $('#envia-contacto').on('click', function(event){
        event.preventDefault();
        producto = $('#producto').val();
        nombre = $('#nombre').val();
        email = $('#email').val();
        mensaje = $('#mensaje').val();
        if(nombre.trim() == '' || email.trim() == '' || mensaje.trim() == ''){
              simple_alert('Atención!', 'Completa nombre, email y mensaje para enviar tu mensaje por favor', 'warning');
              event.preventDefault();
        } else {
              $('#aviso-proceso').addClass('alert alert-info').html('<i class=" fa fa-spinner fa-spin"></i> Enviando su mensaje...');
              $.ajax({
                  type: 'post',
                  url: APP_URL + 'ajax/contactar_servicio',
                  data: {id_empresa:id_empresa, producto:producto, nombre:nombre, email:email, mensaje:mensaje, id_cliente:id_cliente},
                  dataType: 'json',
                  success: function(res){
                      $('#aviso-proceso').html(res.mensaje);
                      if(res.estado == 0){
                          setTimeout(function(){
                              $('#contactar-modal').modal('hide');
                              $('#contactar-formulario').reset();
                           }, 2000);
                      }
                  }
              });
        }

  });


    var url = window.location;
    $('.fb-share-button').attr('data-href', url);

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
                    simple_alert('Atención!', 'Hubo un error', 'warning');
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
                  $('#boton-recomendar').removeAttr('id').attr('id', 'boton-quitar-recomendacion').html('Recomendada <i class="fa fa-check"></i>');
                  if(res == 1){
                    swal({
                     title: 'Perfecto!',
                     text: 'Gracias por recomendar este Microempresario',
                     type: 'success'
                    },
                    function(){
                      location.reload();
                    });
                  } else {
                    simple_alert('Atención!', 'Hubo un error', 'warning');
                  }
              }
          });
      }
  });



});

</script>