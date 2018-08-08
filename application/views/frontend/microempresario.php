<div class="container">
  <div class="row">
  <div class="col-md-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active"><?= $empresa[0]->nombre_empresa;?></li>
        <a href="<?= base_url();?>requerimientos" class="btn btn-linked pull-right" style="margin-right: 28px;height: auto;padding: 10px;width: auto;margin-top: -5px;"> Ver Solicitudes de Cotizaciones</a>
      </ol>
      <br>
  </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12 row eliminar_mensaje" id="<?= $this->session->flashdata('eliminar_mensaje');?>">
    <div class="row">
      <!-- columna izq -->
      <div class="col-sm-9">
        <br class="visible-xs">
        <div class="box-separator">
        <div class="row">
          <div class="col-lg-4 text-center">
            <h3>Bienvenido(a) <strong>
              <a href="<?= base_url();?>persona" style="color: #FF5800 !important;">
                <?= $this->functions->datoCliente($empresa[0]->id_cliente, 'nombre_cliente');?>
                </a></strong>
            </h3>
            <h1 style="color: #0dcbab;"><?= $empresa[0]->nombre_empresa;?></h1>
            <p class="text-center"><a href="<?= base_url();?>microempresarios/editar/<?= $empresa[0]->id_empresa;?>">Editar mi Negocio</a></p>
          </div>

            <div class="col-lg-4" style="border-right: 1px solid #e8e8e8;border-bottom: 1px solid #e8e8e8;">
              <a href="#personas-modal-content" data-toggle="modal" class="btn btn-last col-lg-4">Recomiendan mi negocio<br><b class="orange"><?= $this->functions->cantidadRecomendaciones($empresa[0]->id_empresa);?></b><br>Persona(s)</a>
            </div>
            <div class="col-lg-4" style="border-bottom: 1px solid #e8e8e8;">
              <a href="#seguidores" data-toggle="modal" class="btn btn-last col-lg-4">Siguen mis promociones<br><b class="orange"><?= $this->functions->cantidadSeguidores($empresa[0]->id_empresa);?></b><br>Persona(s)</a>
            </div>

        </div>
        <br>

        <?= $this->session->flashdata('mensaje');?>


        <div class="row">
        <div class=" col-sm-4 col-xs-12"><a href="<?= base_url();?>agregar_producto/<?= $empresa[0]->id_empresa;?>" class="btn btn-new col-md-12 col-xs-12">+ Agregar Producto Específico</a></div>
        <div class=" col-sm-4 col-xs-12"><a href="<?= base_url();?>agregar_servicio/<?= $empresa[0]->id_empresa;?>" class="btn btn-new col-md-12 col-xs-12"> + Agregar Servicio Específico</a></div>
        <div class=" col-sm-4 col-xs-12 crear_promo"><a href="<?= base_url();?>crear_promocion/<?= $empresa[0]->id_empresa;?>" class="btn btn-success col-md-12 col-xs-12 crear_promo" style="padding: 9px;">Crear Promoción</a></div>
        </div>
        </div>

        <div class="clearfix"></div>
        <br>
        <!--promociones -->
        <div class="box-separator">

        <h2 style="text-decoration: underline;"><b>Listado de Productos, Servicios y Promociones de
          <b style="color: #0dcbab;"><?= $empresa[0]->nombre_empresa;?></b>
        </h2>
        <br>
        <br>

        <h2>
          <span style="color: #666;">Actualmente tienes
            <span style="color: #111;">
              <b id="cantidad-promociones">
                <?= $this->functions->cantidadPromociones($empresa[0]->id_empresa);?> promocion(es)</b></span> vigentes
          </span>
          <a href="<?= base_url();?>crear_promocion/<?= $empresa[0]->id_empresa;?>" class="btn btn-info pull-right">Crear Promoción</a>
        </h2>
        <br>

<div class="table-responsive">
  <table class="table">
   <tr>
   <td><strong>N°</strong></td>
   <td><strong>Promoción</strong></td>
   <td><strong>Producto o Servicio Asociado</strong></td>
   <td><strong>Vencimiento</strong></td>
   <td></td>
   <td></td>
   <td></td>
   </tr>

  <?php foreach($promociones as $k => $p){ ?>
     <tr>
     <td><?= $k+1;?></td>
     <td style="font-weight: normal;"><?= $p['promocion'];?></td>
     <td style="font-weight: normal;"><?= $p['nombre'];?></td>
     <td style="font-weight: normal;">en <?= $this->functions->vigencia($p['fecha'], $p['duracion']);?> días más</td>
      <?php if($p['estado'] == 1){?>
        <td id="button-promo-<?= $p['id'];?>-<?= $p['tipo'];?>"><a style="cursor: pointer;" class="red button-inactivate" data-type="3" data-r="<?= $p['tipo'];?>" data-id="<?= $p['id'];?>"><small>Desactivar</small></a></td>
      <?php } else { ?>
        <td id="button-promo-<?= $p['id'];?>-<?= $p['tipo'];?>"><a style="cursor: pointer;" class="green button-activate" data-type="3" data-r="<?= $p['tipo'];?>" data-id="<?= $p['id'];?>"><small>Activar</small></a></td>
      <?php } ?>

     <td><a class="celeste" href="<?= base_url();?>crear_promocion/<?= $empresa[0]->id_empresa;?>"><small>Editar</small></a></td>
     <td><a class="red delete" href="<?= base_url();?>eliminar_promocion/<?= $p['id'];?>"><small><strong>Eliminar</strong></small></a></td>
     </tr>
  <?php } ?>

  </table>
</div>

        <!--fin-promociones -->
         <div class="clearfix"></div>
        <br>
        <hr>


         <!--Servicios -->
        <h2><span style="color: #666;">Actualmente tienes <span style="color: #111;">
          <b id="cantidad-servicios"><?= $this->functions->cantidadServicios($empresa[0]->id_empresa);?> Servicio(s)</b>
          </span> activo(s) disponible(s)</span>
          <a href="<?= base_url();?>agregar_servicio/<?= $empresa[0]->id_empresa;?>" class="btn btn-info pull-right">+ Agregar Servicio</a>
        </h2><br>

<div class="table-responsive">
  <table class="table">
   <tr>
   <td><strong>N°</strong></td>
   <td><strong>Nombre Servicio</strong></td>
   <td><strong>Precio</strong></td>
   <td><strong>Servicio</strong></td>
   <td><strong>N° Visitas</strong></td>
   <td></td>
   <td></td>
   <td></td>
   </tr>

  <?php foreach($servicios as $s){ ?>
     <tr>
       <td><?= $s->id_servicio;?></td>
       <td style="font-weight: normal;"><?= $s->nombre_servicio;?></td>
       <td style="font-weight: normal;">$<?= $this->functions->moneda($s->precio_servicio);?></td>
       <td style="font-weight: normal;"><?= $this->functions->nombreSubsubcategoria($s->id_sub_sub_categoria);?></td>
       <td><?= $s->cantidad_vistas;?></td>
        <?php if($s->id_estado == 1){?>
          <td id="button-service-<?= $s->id_servicio;?>"><a style="cursor: pointer;" class="red button-inactivate" data-type="2" data-r="0" data-id="<?= $s->id_servicio;?>"><small>Desactivar</small></a></td>
        <?php } else { ?>
          <td id="button-service-<?= $s->id_servicio;?>"><a style="cursor: pointer;" class="green button-activate" data-type="2" data-r="0" data-id="<?= $s->id_servicio;?>"><small>Activar</small></a></td>
        <?php } ?>
       <td><a class="celeste" href="<?= base_url();?>editar_servicio/<?= $s->id_servicio;?>"><small>Editar</small></a></td>
       <td><a class="red delete" href="<?= base_url();?>eliminar_servicio/<?= $s->id_servicio;?>"><small><strong>Eliminar</strong></small></a></td>
     </tr>
  <?php } ?>
  </table>
</div>

        <!--fin-servicios -->
         <div class="clearfix"></div>
        <br>
        <hr>



<!--productos -->
<h2><span style="color: #666;">Actualmente tienes <span style="color: #111;">
  <b id="cantidad-productos"><?= $this->functions->cantidadProductos($empresa[0]->id_empresa);?> Producto(s)</b></span>
  activo(s) disponible(s)</span>
  <a href="<?= base_url();?>agregar_producto/<?= $empresa[0]->id_empresa;?>" class="btn btn-info pull-right">+ Agregar Producto</a>
  </h2><br>

<div class="table-responsive">
  <table class="table">
   <tr>
   <td><strong>N°</strong></td>
   <td><strong>Nombre Producto</strong></td>
   <td><strong>Precio</strong></td>
   <td><strong>Producto</strong></td>
   <td><strong>N° Visitas</strong></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   </tr>

   <?php foreach($productos as $p){ ?>
     <tr>
       <td><?= $p->id_producto;?></td>
       <td style="font-weight: normal;"><?= $p->nombre_producto;?></td>
       <td style="font-weight: normal;">$<?= $this->functions->moneda($p->precio_producto);?></td>
       <td style="font-weight: normal;"><?= $this->functions->nombreSubsubcategoria($p->id_sub_sub_categoria);?></td>
       <td><?= $p->cantidad_vistas;?></td>
        <?php if($p->id_estado == 1){?>
          <td id="button-producto-<?= $p->id_producto;?>"><a style="cursor: pointer;" class="red button-inactivate" data-type="1" data-r="0" data-id="<?= $p->id_producto;?>"><small>Desactivar</small></a></td>
        <?php } else { ?>
          <td id="button-producto-<?= $p->id_producto;?>"><a style="cursor: pointer;" class="green button-activate" data-type="1" data-r="0" data-id="<?= $p->id_producto;?>"><small>Activar</small></a></td>
        <?php } ?>
       <td><a class="celeste" href="<?= base_url();?>editar_producto/<?= $p->id_producto;?>"><small>Editar</small></a></td>
       <td><a class="red delete" href="<?= base_url();?>eliminar_producto/<?= $p->id_producto;?>"><small><strong>Eliminar</strong></small></a></td>
     </tr>
   <?php } ?>

  </table>
</div>
</div>

        <!--fin-productos -->

      </div>
        <!--fin columna izq -->

      <!-- columna der -->
      <div class="col-sm-3">
      <div class="box-separator">
      <!--foto pefil microempresario -->
      <?php if($empresa[0]->imagen_empresa == ''){ ?>
      <img id="respuesta" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($empresa[0]->id_categoria);?>" class="img-responsive" alt="perfil-microempresario">
      <p class="orange text-center">
        <form method="post" id="formulario" enctype="multipart/form-data" style="font-weight: normal;>
          <input type="hidden" name="id_empresa" value="<?= $empresa[0]->id_empresa;?>">
          <input id="upload" name="file" type="file" style="display:none;" />
          <a href="" id="upload_link">Agregar Foto</a>
          | <a href="<?= base_url();?>microempresarios/detalle/1/<?= $empresa[0]->id_empresa;?>/<?= $empresa[0]->id_categoria;?>">
            Ver mi perfil público</a>
        </form>

      </p><br>
      <?php } else { ?>
      <img id="respuesta" class="img-responsive" alt="perfil-microempresario" src="<?= PERFILES_EMPRESA_PATH.$empresa[0]->imagen_empresa;?>">
      <p class="orange text-center">
        <form method="post" id="formulario" enctype="multipart/form-data" style="font-weight: normal;>
          <input type="hidden" name="id_empresa" value="<?= $empresa[0]->id_empresa;?>">
          <input id="upload" name="file" type="file" style="display:none;" />
          <a href="" id="upload_link">Editar Foto</a>
          <span class="orange">| </span><a href="<?= base_url();?>microempresarios/detalle/1/<?= $empresa[0]->id_empresa;?>/<?= $empresa[0]->id_categoria;?>">Ver mi perfil público</a>
        </form>

      </p><br>
      <?php } ?>
      <!--fin foto pefil microempresario -->

  <p style="font-weight: normal;">
          <i class="fa fa-map-marker" aria-hidden="true"></i> <strong>Dirección:</strong><br>
          <?= $empresa[0]->calle_empresa.' '.$empresa[0]->numero_calle_empresa.', '.$empresa[0]->comuna_empresa.', '.$empresa[0]->region_empresa?><br><br>
          <i class="fa fa-mobile-phone" aria-hidden="true"></i> <strong>Celular:</strong><br> <?= $this->functions->fono_empresa($empresa[0]->celular_empresa);?> <br><br>
          <i class="fa fa-phone" aria-hidden="true"></i> <strong>Teléfono:</strong><br> <?= $this->functions->fono_empresa($empresa[0]->fono_empresa);?> <br><br>
          <i class="fa fa-envelope" aria-hidden="true"></i> <strong>E-mail:</strong><br>
          <?= $this->functions->datoCliente($empresa[0]->id_cliente, 'email_cliente');?>
          <br><br>
          <?php if($empresa[0]->sitio_empresa != ''){ ?>
          <i class="fa fa-external-link" aria-hidden="true"></i> <strong>Sitio Web:</strong><br> <?= $empresa[0]->sitio_empresa;?><br>
          <?php } ?>
          <br>
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
        <p><strong>¿Tienes Servicio a Domicilio?</strong><br>
          <?php if($empresa[0]->despacho_empresa == 'Si'){ ?>
            <small>Incluido</small>
          <?php } else { ?>
            <small>No incluye</small>
          <?php } ?>
        </p>
        <hr>


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

<!-- Fin Container -->

    <div id="personas-modal-content" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h2 class="modal-title">Listado de personas que te han recomendado</h2>
            </div>
            <div class="modal-body">
            <div class="clearfix"></div>
              <div class="col-lg-12">
                <?php foreach($recomendaciones as $k => $r){ ?>
                <p><?= $k + 1;?>.- <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>"><?= $r->nombre_cliente;?></a></p>
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



          <div id="seguidores" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Listado de seguidores</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <?php foreach($this->functions->listarSeguidoresPorEmpresa($empresa[0]->id_empresa) as $k => $r){ ?>
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


var cantidad_productos = '<?php echo count($productos);?>';
var cantidad_servicios = '<?php echo count($servicios);?>';

$('.crear_promo').on('click', function(event){



  if(cantidad_servicios == 0 && cantidad_productos == 0){
     event.preventDefault();
      swal({
        title: 'Atención!',
        text: 'Para Crear una Promoción primero debes agregar al menos 1 Producto o 1 Servicio presionando los botones "Agregar Producto" o "Agregar Servicio"',
        type: 'warning'
      },
      function(){

      });
  } else {
    window.location = '<?php echo base_url();?>crear_promocion'
  }

});



$(function(){
  $("#upload_link").on('click', function(e){
      e.preventDefault();
      $("#upload:hidden").trigger('click');
  });
});


$(function(){
    var eliminar_mensaje = $('.eliminar_mensaje').attr('id');
    if(eliminar_mensaje != ''){
        swal(eliminar_mensaje);
    }
});



  $('input[name="file"]').on('change', function(){
  var formData = new FormData($('#formulario')[0]);
  var id_empresa = <?php echo $empresa[0]->id_empresa;?>;
  var nombre_empresa = '<?php echo $empresa[0]->nombre_empresa;?>';
  formData.append('id_empresa', id_empresa);
  formData.append('nombre_empresa', nombre_empresa);
  var ruta = APP_URL + 'ajax/imagen_perfil';
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



  $('#personas-modal').on('click', function(envet){
      event.preventDefault();
  });


  $(document).on('click', '.button-activate', function(event){
      event.preventDefault();
      valor = $(this).attr('data-id');
      tipo = $(this).attr('data-type');
      ref = $(this).attr('data-r');
      activate(valor, tipo, ref);
  });


  $(document).on('click', '.button-inactivate', function(event){
      event.preventDefault();
      valor = $(this).attr('data-id');
      tipo = $(this).attr('data-type');
      ref = $(this).attr('data-r');
      inactivate(valor, tipo, ref);
  });


  function activate(id, tipo, ref)
  {

      $.ajax({
          type: 'get',
          url: APP_URL + 'ajax/activar_registro/' + id + '/' + tipo + '/' + ref,
          dataType: 'json',
          success: function(res){
            if(tipo == 1){;
              swal(res.mensaje);
              cantidad = $('#cantidad-productos').text();
              $('#cantidad-productos').html(parseInt(cantidad) + 1);
              $('#button-producto-'+id).html('<a style="cursor: pointer;" class="red button-inactivate" data-type="1" data-r="0" data-id="'+id+'"><small>Desactivar</small></a>');
            } else if(tipo == 2)  {
              swal(res.mensaje);
              cantidad = $('#cantidad-servicios').text();
              $('#cantidad-servicios').html(parseInt(cantidad) + 1);
              $('#button-service-'+id+'-'+ref).html('<a style="cursor: pointer;" class="red button-inactivate" data-type="2" data-r="0" data-id="'+id+'"><small>Desactivar</small></a>');
            } else {
              swal(res.mensaje);
              cantidad = $('#cantidad-promociones').text();
              $('#cantidad-promociones').html(parseInt(cantidad) + 1);
              $('#button-promo-'+id+'-'+ref).html('<a style="cursor: pointer;" class="red button-inactivate" data-type="3" data-r="'+ref+'" data-id="'+id+'"><small>Desactivar</small></a>');
            }
          }
      });

  }


  function inactivate(id, tipo, ref)
  {
        $.ajax({
            type: 'get',
            url: APP_URL + 'ajax/desactivar_registro/' + id + '/' + tipo + '/' + ref,
            dataType: 'json',
            success: function(res){
              if(tipo == 1){
                simple_alert('Perfecto!', res.mensaje, 'success');
                cantidad = $('#cantidad-productos').text();
                $('#cantidad-productos').html(parseInt(cantidad) - 1);
                $('#button-producto-'+id).html('<a style="cursor: pointer;" class="green button-activate" data-type="1" data-r="0" data-id="'+id+'"><small>Activar</small></a>');
              } else if(tipo == 2){
                simple_alert('Perfecto!', res.mensaje, 'success');
                cantidad = $('#cantidad-servicios').text();
                $('#cantidad-servicios').html(parseInt(cantidad) - 1);
                $('#button-service-'+id+'-'+ref).html('<a style="cursor: pointer;" class="green button-activate" data-type="2" data-r="0" data-id="'+id+'"><small>Activar</small></a>');
              } else {
                simple_alert('Perfecto!', res.mensaje, 'success');
                cantidad = $('#cantidad-promociones').text();
                $('#cantidad-promociones').html(parseInt(cantidad) - 1);
                $('#button-promo-'+id+'-'+ref).html('<a style="cursor: pointer;" class="green button-activate" data-type="3" data-r="'+ref+'" data-id="'+id+'"><small>Activar</small></a>');
              }
            }
        });

  }


  $('.delete').on('click', function(event){
      event.preventDefault();
      var hreferef = $(this).attr('href');
      swal({
              title: "Eliminar",
              text: "Estas seguro de eliminar este registro?",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Si",
              cancelButtonText: "No",
              closeOnConfirm: false,
              closeOnCancel: false
          },
          function(isConfirm) {
              if (isConfirm) {
                  window.location.href = hreferef;
              }
          }
      );
  });


    var url = window.location;
    $('.fb-share-button').attr('data-href', url);

</script>