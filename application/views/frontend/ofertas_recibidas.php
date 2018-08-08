<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active">Cotizaciones recibidas en respuesta a Solicitudes de Cotizaciones publicadas por mí</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <div class="row"> <br>
    <div class="clearfix"></div>
    <div class="col-sm-12">

      <div class="col-sm-9 box-separator">
        <h1>
          Cotizaciones recibidas en respuesta a Solicitudes de Cotizaciones publicadas por mí
        </h1>
        <br><br>

        <?php if(count($ofertas) == 0){ ?>
          <p>No tienes ninguna Solicitud de Cotizaciones</p>
        <?php } else { ?>

          <table class="table table-stripped">
            <thead>
              <th>Fecha Solicitud</th>
              <th>Cliente</th>
              <th>Detalle Solicitud</th>
              <th>Estado</th>
              <th>Acciones</th>
            </thead>
            <tbody>
            <?php foreach ($ofertas as $r) { ?>

              <tr>

                <td><?= $r->fecha_requerimiento;?></td>
                <td><a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>"><?= $r->nombre_cliente;?></a></td>
                <td><?= $r->texto_requerimiento;?></td>
                <td><?= ($r->estado_requerimiento == 1) ? '<span class="label label-success">Abierta</span>' : '<span class="label label-danger">Cerrada</span>';?></td>
                <td>
                  <a href="#v_<?= $r->id_oferta;?>" data-toggle="modal" class="delete">Ver cotización</a>
                  <?php if($r->estado_requerimiento == 1){ ?>
                  <br>
                  <a href="#c_<?= $r->id_oferta;?>" data-cliente="<?= $r->id_cliente;?>" data-toggle="modal" class="delete">Aceptar oferta</a>
                  <?php } ?>
                </td>

              </tr>



          <div id="c_<?= $r->id_oferta;?>" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Aceptar cotización</h2>
                      <p>Al aceptar la cotización se enviará un email directo al cotizante y tu solicitud de cotizaciones será cerrada automaticamente, una vez cerrada no podrás volver a editar tu solicitud de cotizaciones y aceptarás un compromiso con el cotizante.</p>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <textarea rows="15" id="text_<?= $r->id_oferta;?>" class="form-control"></textarea>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="clearfix"></div>
                    <div class="col-md-12">
                        <br>
                        <button type="button" data-id="<?= $r->id_oferta;?>" data-req="<?= $r->id_requerimiento;?>" class="btn btn-default save_edicion">Enviar y Aceptar</button>
                    </div>
                  </div>
                </div>
              </div>
          </div>



          <div id="v_<?= $r->id_oferta;?>" class="modal fade" tabindex="-1" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h2 class="modal-title">Detalle cotización</h2>
                  </div>
                  <div class="modal-body">
                  <div class="clearfix"></div>
                    <div class="col-lg-12">
                      <p><b><a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>"><?= $r->nombre_cliente;?></a></b> tiene la siguiente cotización para ti a esta solicitud de cotizaciones:</p>
                      <p>Detalle: <b><?= $r->texto_oferta;?></b></p>
                    </div>
                  <div class="clearfix"></div>
                  </div>
                  <div class="modal-footer">
                    <div class="col-lg-12">
                    <p style="font-style: italic;text-align: left;">Nota: Para aceptar la cotización es necesario presionar el enlace de "Aceptar cotización" y completar los campos que se solicitan.</p>
                    </div>
                  </div>
                </div>
              </div>
          </div>



            <?php } ?>
            </tbody>
          </table>

        <?php } ?>

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

        <p><strong>Mis solicitudes de cotizaciones:</strong></p>
        <p>
        <small><a href="<?= base_url();?>mis_requerimientos">Mis solicitudes de cotizaciones</a></small><br>
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

<script>

$('.save_edicion').on('click', function(){

  var valor = $(this).data('id');
  var id_requerimiento = $(this).data('req');
  var id_cliente = '<?php echo $this->session->id;?>';
  var mensaje = $('#text_' + valor).val();
    $.ajax({
      type: 'post',
      url: APP_URL + 'ajax/aceptar_oferta',
      data:{valor:valor, mensaje:mensaje, id_requerimiento:id_requerimiento, id_cliente:id_cliente},
      success: function(res){
        swal({
           title: 'Perfecto',
           text: 'Aceptaste la oferta, tu requerimiento será cerrado',
           type: 'success'
          },
          function(){
            location.reload();
        });
      }
    });

});

</script>
