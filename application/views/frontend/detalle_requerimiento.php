<div class="container">
<div class="row">

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>requerimientos">Listado de Solicitudes de Cotizaciones</a></li>
  <li class="active">Detalle de la Solicitud de Cotizaciones N° <?= $requerimiento[0]->id_requerimiento;?></li>
</ol>
<br>

<div class="col-sm-12 box-separator">
  <h1 class="gray titulo-int">DETALLE DE LA SOLICITUD DE COTIZACIONES N° <?= $requerimiento[0]->id_requerimiento;?></h1>
  <br>

  <div class="divisor"></div>
  <div class="row">

    <div class="col-sm-12">

      <span class="alert alert-info" style="display: block;">
        <b>Esta solicitud de cotizaciones ha recibido
        <?= $this->functions->contar_ofertas($requerimiento[0]->id_requerimiento); ?> cotización(es)</b>
      </span>
      <span><b>Usuario:</b>
        <a href="<?= base_url();?>perfil_persona/<?= $requerimiento[0]->id_cliente;?>">
          <?= $requerimiento[0]->nombre_cliente;?>
        </a>
      </span>
      <br>
      <span><b>Ubicación del Usuario:</b> <?= $requerimiento[0]->region_cliente;?>, <?= $requerimiento[0]->comuna_cliente;?></span>
      <br>
      <span><b>Fecha Ingreso:</b> <?= $requerimiento[0]->fecha_requerimiento;?></span>
      <br>
      <span><b>Solicitud para:</b> <?= $requerimiento[0]->nombre_categoria;?>,
      <b>Tipo:</b> <?= $requerimiento[0]->nombre_subcategoria;?></span>
      <br>
      <span><b>Productos o Servicios solicitados: </b>
      <?php
          $sc = '';
          foreach ($this->functions->sc_requerimientos($requerimiento[0]->id_requerimiento) as $v) {
          $sc .= $v->nombre_sub_subcategoria.', ';
      } ?>

      <?= $this->functions->eliminar_ultima_coma($sc); ?>
      </span>
      <br>
      <span><b>Descripción de la Solicitud:</b> <?= $requerimiento[0]->texto_requerimiento;?></span>
    </div>

  </div>
</div>



<?php if($this->functions->existe_oferta($requerimiento[0]->id_requerimiento) > 0){ ?>

    <div class="col-sm-12 box-separator">
      <p style="font-style: italic;"><b>Ya enviaste una cotización para esta solicitud, ve a la sección de "mis cotizaciones" para revisar y editarla si es necesario.<br>
      <a href="<?= base_url();?>mis_ofertas">Ir a Mis cotizaciones</a>
      </b>
      </p>
    </div>

<?php } else { ?>

  <?php if($requerimiento[0]->id_cliente != $this->session->id){ ?>
  <div class="col-sm-12">
    <br><br>
    <?php if($this->session->id == ''){ ?>
      <p style="font-weight: bold;">
        <br>
        Debes iniciar sesión para realizar una cotización<br><br>
        <a href="#iniciar-sesion" data-toggle="modal" class="btn btn-success btn-large">Iniciar Sesión</a>
      </p>
    <?php } ?>

    <div class="divisor"></div>
    <div class="row">

      <div class="col-sm-12 box-separator">
        <form method="post" action="<?= base_url();?>welcome/enviar_oferta">
          <?php if($this->session->id != ''){ ?>
              <span>
                <input type="hidden" name="id_requerimiento" value="<?= $requerimiento[0]->id_requerimiento;?>">
                <input type="hidden" name="id_cliente" value="<?= $requerimiento[0]->id_cliente;?>">
                <input type="hidden" name="email_cliente" value="<?= $requerimiento[0]->email_cliente;?>">
                <input type="hidden" name="nombre_cliente" value="<?= $requerimiento[0]->nombre_cliente;?>">
                <textarea name="oferta" required class="form-control" rows="4" placeholder="Escribe tu cotización, sé lo mas claro posible"></textarea>
              </span>
              <br>
              <span><input type="submit" value="Enviar cotización ahora" class="btn btn-success"></span>
          <?php } ?>
        </form>
      </div>

    </div>
  </div>
  <?php } else { ?>

    <div class="col-sm-12 box-separator">
      <br><br>
      <p class="alert alert-danger">Lo sentimos, no puedes cotizar a una solicitud que te pertenece.</p>
    </div>

  <?php } ?>

<?php } ?>
    <!--fin requerimientos -->

</div>
<br><br>




<div class="clearfix"></div>
<br>
<br>
<br>


</div>

</div>
</div>