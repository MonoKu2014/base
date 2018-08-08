<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active">Mis notificaciones</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="row">

      <!-- lateral-->
      <div class="col-sm-2">
      <div class="box-separator">
      <h1 class="visible-xs"><?= $cliente[0]->nombre_cliente; ?></h1><br class="visible-xs" />

      <?php if($cliente[0]->imagen_cliente == ''){ ?>
        <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />
      <?php } else { ?>
        <img class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$cliente[0]->imagen_cliente;?>">
      <?php } ?>

      <br />

        <hr />

        <p><strong>Mis Negocios:</strong></p>
        <p>
        <?php foreach($publica_empresa as $pe){ ?>
        <small><a href="<?= base_url();?>microempresario/<?= $pe->id_empresa;?>"><?= $pe->nombre_empresa;?></a></small><br>
        <?php } ?>
        </p>


      </div>
      </div>
      <!--FIN lateral-->


      <div class="col-sm-7">
        <div class="box-separator">

            <h1>Mis notificaciones</h1>
            <br><br>

            <div class="table-responsive">
            <table class="table">
             <thead>
                 <th>Imagen</th>
                 <th>Fecha</th>
                 <th>Notificación</th>
                 <th>Estado</th>
             </thead>
             <tbody>
                <?php if(count($notificaciones) == 0){ ?>
                  <p>No tienes notificaciones</p>
                <?php } ?>

                <?php foreach ($notificaciones as $n) { ?>

                <?php

                ($n->estado_notificacion == 0) ? $clase = 'bg_orange' : $clase = '';
                $imagen = $this->functions->datoCliente($n->id_href, 'imagen_cliente');
                ?>
                <tr class="<?= $clase;?>" style="font-size: 12px;padding: 7px;">
                    <td>
                        <?php if($imagen == ''){ ?>
                          <a href="<?= base_url()?>perfil_persona/<?= $n->id_href;?>">
                            <img width="60" src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />
                          </a>
                        <?php } else { ?>
                          <a href="<?= base_url()?>perfil_persona/<?= $n->id_href;?>">
                            <img width="60" class="img-responsive" alt="perfil-cliente" src="<?= CLIENTES_IMAGES_PATH.$imagen;?>">
                          </a>
                        <?php } ?>
                    </td>
                    <td><?= $n->fecha_notificacion;?></td>
                    <td>

                        <?php if($n->tipo_notificacion == 1){ ?>
                            <a href="<?= base_url();?>detalle_requerimiento/<?= $n->id_requerimiento;?>">
                                <?= $n->texto_notificacion;?>
                            </a>
                        <?php } elseif ($n->tipo_notificacion == 2) { ?>
                            <a href="<?= base_url();?>ofertas_recibidas"><?= $n->texto_notificacion;?></a>
                        <?php } else { ?>
                            <a href="<?= base_url()?>perfil_persona/<?= $n->id_href;?>"><?= $n->texto_notificacion;?></a>
                        <?php } ?>


                    </td>
                    <td>
                        <?php if($n->estado_notificacion == 0){ ?>
                        <i class="fa fa-check-square-o marcar-leida btn btn-danger" data-id="<?= $n->id_notificacion;?>" style="cursor: pointer;padding: 2px;" data-toggle="tooltip" data-placement="top" title="Marcar como leída"></i>
                        <?php } else { ?>
                        <span class="label label-success">Leída</span>
                        <?php } ?>
                    </td>
                  <tr style="border-bottom: 1px solid #ccc;padding: 5px 0;"></tr>
                </tr>

                <?php } ?>
             </tbody>
            </table>
            </div>

            <hr>


            <h1>Solicitudes de Convenios RSE</h1>
            <br><br>

            <div class="table-responsive">
            <table class="table">
             <thead>
                 <th>Empresa RSE</th>
                 <th>Fecha</th>
                 <th>Convenio</th>
                 <th>Estado</th>
             </thead>
             <tbody>
                <?php if(count($convenios) == 0){ ?>
                  <p>No tienes convenios</p>
                <?php } ?>

                <?php foreach ($convenios as $n) { ?>

                <?php

                ($n->estado_notificacion == 0) ? $clase = 'bg_orange' : $clase = '';
                ?>
                <tr class="<?= $clase;?>" style="font-size: 12px;padding: 7px;">
                    <td>
                        <a href="<?= base_url()?>perfil_rse/<?= $n->id_href;?>">
                            <?= $this->functions->datoConvenioRSE($n->id_href, 'nombre_empresa'); ?>
                        </a>
                    </td>
                    <td><?= $n->fecha_notificacion;?></td>
                    <td>
                        <a href="<?= base_url()?>perfil_rse/<?= $n->id_href;?>"><?= $n->texto_notificacion;?></a>
                    </td>
                    <td>
                        <?php if($n->estado_notificacion == 0){ ?>
                        <i class="fa fa-check-square-o marcar-leida-rse btn btn-danger" data-id="<?= $n->id_notificacion;?>" style="cursor: pointer;padding: 2px;" data-toggle="tooltip" data-placement="top" title="Marcar como leída"></i>
                        <?php } else { ?>
                        <span class="label label-success">Leída</span>
                        <?php } ?>
                    </td>
                  <tr style="border-bottom: 1px solid #ccc;padding: 5px 0;"></tr>
                </tr>

                <?php } ?>
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

        <hr>

        <!--<p><strong>Tickets de soporte:</strong></p>
        <p>
        <small><a href="<?= base_url();?>ingresar_ticket">Ingresar Ticket</a></small><br>
        <small><a href="<?= base_url();?>mis_tickets">Mis Tickets</a></small><br>
        </p>

        <hr>

        <p><strong>Mensajes:</strong></p>
        <p>
        <small><a href="<?= base_url();?>mis_mensajes">Mis mensajes</a></small><br>
        </p>-->
      </div>
      </div>
      <!--fin columna der-->

          <div class="clearfix"></div>
          <br />
          <br />
          <br />


    <!-- Fin Row -->

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
           title: 'Perfecto!',
           text: 'La notificación ha sido marcada como leída',
           type: 'success'
          },
          function(){
            window.location = res.redirection;
        });
      }
    });
});


$('.marcar-leida-rse').on('click', function(){
    var ide_noti_convenio = [];
    ide_noti_convenio.push($(this).data('id'));
    $.ajax({
      type: 'post',
      url: APP_URL + 'ajax/marcar_leidas',
      data:{ide_noti_convenio, ide_noti_convenio},
      dataType: 'json',
      success: function(res){
        swal({
           title: 'Perfecto!',
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
