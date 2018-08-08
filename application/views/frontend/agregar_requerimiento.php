<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active">Agregar Solicitud de Cotizaciones</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="row">
    <div class="clearfix"></div>
    <div class="col-sm-12">

      <div class="col-sm-9 box-separator">
        <h1>Agregar Solicitud de Cotizaciones</h1>
        <br>
        <p class="alert alert-info"><b>
            La Solicitud de Cotizaciones de uno o varios productos o servicios que estás a punto de enviar será publicado en Portal Microempresa(rios), para que todos aquellos Microempresarios inscritos en Portal Microempresa(rios) vean tu Solicitud de Cotizaciones y te envíen sus Ofertas. Luego tu podrás llegar a un acuerdo y quedarte con la oferta que más te guste o que más te convenga.</b>
        </p>
        <p>Para agregar una Solicitud de Cotizaciones debes seleccionar un sector, luego un tipo de Microempresario y luego los productos o servicios que estés buscando para tu necesidad. Podrás seleccionar 3 Microempresarios y enviarles una solicitud o mensaje para contactar directamente con ellos.</p>
        <br><br>
        <div class="row">
        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Sector Negocios y Servicios</strong></p>
            <select id="categoria" name="categoria" class="form-control" required>
              <option value="">Seleccione..</option>
              <?php foreach($this->functions->listarCategorias() as $c){ ?>
                  <option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Tipos de Negocios y Servicios</strong></p>
            <div id="subcategorias"></div>
          </div>


          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <p><strong>Productos y Servicios</strong></p>
            <div id="sub_subcategorias"></div>
          </div>

          <div class="clearfix"></div>
          <div class="col-lg-12">
              <img src="<?= IMAGES_PATH;?>divisor-puntos.jpg" class="img-responsive" alt="divisor">
            <br>
          </div>
        </div>

        <div class="row table-responsive">
          <div class="col-lg-12">
          <p><i class="fa fa-exclamation-circle"></i>
          Selecciona sólo 3 por favor</p>
          <button class="btn btn-default" id="req">Ingresar la Solicitud de Cotizaciones</button>
          <table class="table table-stripper">
            <thead>
              <th>Microempresario</th>
              <th>Producto o servicio</th>
              <th>Región</th>
              <th>Comuna</th>
              <th>Seleccionar</th>
            </thead>
            <tbody id="body_empresas">

            </tbody>
          </table>
          </div>
        </div>

      </div>

      <!-- columna der -->
      <div class="col-sm-3">
        <div class="box-separator">
          <div class="box-lateral">
            <h2 class="orange" style="font-size: 18px;">Podrías querer seguir a:</h2>
            <br>
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#personas_tabs">Personas</a></li>
              <li><a data-toggle="tab" href="#negocios_tabs">Negocios</a></li>
            </ul>

            <div class="tab-content">
              <div id="personas_tabs" class="tab-pane fade in active">

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
              <div id="negocios_tabs" class="tab-pane fade">
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
                    <b><a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>" style="cursor: pointer;"><?= $e->nombre_empresa;?></a></b><br>
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

        <hr>

        <p><strong>Invitar:</strong></p>
        <p>
        <small><a href="<?= base_url();?>invitar">Enviar invitaciones</a></small><br>

        </p>

        <!--<hr>

        <p><strong>Tickets de soporte:</strong></p>
        <p>
        <small><a href="<?= base_url();?>ingresar_ticket">Ingresar Ticket</a></small><br>
        <small><a href="<?= base_url();?>mis_tickets">Mis Tickets</a></small><br>
        </p>

        <hr>

        <p><strong>Mensajes:</strong></p>
        <p>
        <small><a href="<?= base_url();?>mis_mensajes">Mis mensajes</a></small><br>
        </p>-->

        <hr>

        <p><strong>Mis Solicitud de Cotizaciones:</strong></p>
        <p>
        <small><a href="<?= base_url();?>mis_requerimientos">Mis Solicitud de Cotizaciones</a></small><br>
        </p>

        </div>
      </div>
      <!--fin columna der-->

          <div class="clearfix"></div>
          <br />
          <br />
          <br />

    </div>
    <!-- Fin Row -->

  </div>
</div>



<!-- Modal -->
<div id="modal_requerimiento" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje</h4>
        <p>Enviaremos un correo a los microempresarios que seleccionaste con este mensaje.</p>
      </div>
      <div class="modal-body">
        <p><textarea id="mensaje_req" class="form-control" placeholder="Ingresa el mensaje"></textarea></p>
      </div>
      <div class="modal-footer">
        <button type="button" id="enviar_req" class="btn btn-default">Enviar Requerimiento</button>
      </div>
    </div>

  </div>
</div>


<script>



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

});


$('.marcar-leida').on('click', function(){
    var ide_noti = [];
    ide_noti.push($(this).data('id'));
    $.ajax({
      type: 'post',
      url: APP_URL + 'ajax/marcar_leidas',
      data:{ide_noti, ide_noti},
      dataType: 'json',
      success: function(res){
        swal({
          title:'Perfecto!',
          text: 'La notificación ha sido marcada como leída',
          type: 'success'
        },
        function(){
            window.location = res.redirection;
        });
      }
    });
});



</script>


<script>
  $(document).ready(function(){

var categoria = '';
var subcategoria = '';
var sub_subcategorias = [];
var microempresarios  = [];

      $('#categoria').on('change', function(){
          categoria = $(this).find('option:selected').val();
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/subcategoriasPorCategoriaReq',
            data:{categoria:categoria},
            success: function(res){
              $('#subcategorias').empty().html(res);
              $('#sub_subcategorias').empty();
              $('#body_empresas').empty();
            }
          });
      });

      $(document).on('click', '.subcategoria', function(){
          valor = $(this).val();
          subcategoria = valor;
          subcategorias = [];
          subcategorias.push(valor);
          cargarSub_Subcategorias(subcategorias);
          $('#body_empresas').empty();
      });


      function cargarSub_Subcategorias(subcategorias)
      {

          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/sub_subcategoriasPorSubcategoriaReq',
            data:{subcategorias:subcategorias},
            success: function(res){
              $('#body_empresas').empty();
              $('#sub_subcategorias').empty().html(res);
            }
          });

      }


      $(document).on('click', '.sub_subcategoria', function(){
          valor = $(this).val();
          if($(this).prop('checked')){
            sub_subcategorias.push(valor);
          } else {
            var index = $.inArray(valor, sub_subcategorias);
            if(index != -1){
              sub_subcategorias.splice(index, 1);
            }
          }

          if(sub_subcategorias.length == 0){
            $('#body_empresas').empty();
          } else {
            $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/busqueda_empresas',
              data:{sub_subcategorias:sub_subcategorias},
              success: function(res){
                $('#body_empresas').empty().html(res);
              }
            });
          }
      });

      $(document).on('click', '.micro_check', function(){
          valor = $(this).val();
          if($(this).prop('checked')){
            microempresarios.push(valor);
          } else {
            var index = $.inArray(valor, microempresarios);
            if(index != -1){
              microempresarios.splice(index, 1);
            }
          }
      });


      $('#req').on('click', function(e){

        if(microempresarios.length > 3){
          simple_alert('Atención!', 'No puedes seleccionar más de 3 microempresarios', 'warning');
        } else {
          if(microempresarios.length == 0){
            simple_alert('Atención!', 'Debes seleccionar mínimo un microempresario', 'warning');
          } else {
            $('#modal_requerimiento').modal();
          }
        }

      });


      $('#enviar_req').on('click', function(){
        var mensaje = $('#mensaje_req').val();
        if(mensaje.trim() == ''){
          $('#mensaje_req').attr('placeholder', 'ingresa tu solicitud de cotizaciones por favor');
        } else {
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/enviar_requerimiento',
            data:{microempresarios:microempresarios, mensaje:mensaje, categoria:categoria, subcategoria:subcategoria, sub_subcategorias:sub_subcategorias},
            success: function(res){
                swal({
                  title: 'Perfecto!',
                  text: 'Hemos ingresado y enviado tu solicitud de cotizaciones, gracias por confiar',
                  type: 'success'
                }, function(){
                    location.reload();
                });
            }
          });
        }
      });


  });
</script>