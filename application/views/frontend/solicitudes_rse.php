<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active">Listado de Solicitudes de Alianzas para mí desde Portal RSE</li>
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
          Listado de Solicitudes de Alianzas para mí desde Portal RSE
        </h1>
        <br><br>


        <?php if(count($alianzas) == 0){ ?>
          <p>No tienes ninguna Solicitud de Cotizaciones</p>
        <?php } else { ?>

          <table class="table table-stripped">
            <thead>
              <th>ID</th>
              <th>Fecha Solicitud</th>
              <th>Empresa RSE</th>
              <th>Título Solicitud</th>
              <th>Detalle Solicitud</th>
              <th>Descuento</th>
              <th>Estado</th>
              <th>Acciones</th>
            </thead>
            <tbody>
            <?php foreach ($alianzas as $r) { ?>

              <tr>

                <td><?= $r->id_convenio;?></td>
                <td><?= $r->fecha_solicitud_convenio;?></td>
                <td><?= $this->functions->datoRSE($r->id_rse, 'nombre_empresa'); ?></td>
                <td><?= $r->titulo_convenio;?></td>
                <td><?= $r->descripcion_convenio;?></td>
                <td><?= $r->descuento_convenio;?></td>
                <td>
                  <?php 
                  if ($r->estado_convenio == 1){
                    echo 'Enviada';
                  } elseif ($r->estado_convenio == 2) {
                    echo 'Activa';
                  } elseif ($r->estado_convenio == 3) {
                    echo 'Rechazada';
                  } elseif ($r->estado_convenio == 4) {
                    echo 'Pregunta pendiente';
                  } else {
                    echo 'Respondida';
                  }

                  ?>
                </td>
                <td>
                    <a href="<?= base_url();?>rse/detalle_alianza/<?= $r->id_convenio;?>" class="btn btn-info poco-padding">Ver detalle</a>
                    <?php if ($r->estado_convenio == 1): ?>
                        <a href="#" class="btn btn-new poco-padding">Hacer Pregunta</a>
                    <?php endif ?>
                </td>

              </tr>


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



</script>
