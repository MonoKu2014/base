<div class="container">
<div class="row">

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>requerimientos_rse">Listado de requerimientos RSE</a></li>
  <li class="active">Detalle de requerimiento</li>
</ol>
<br>

<div class="col-sm-12 box-separator">
  <h1 class="gray titulo-int">DETALLE DE REQUERIMIENTO</h1>
  <br>

  <div class="divisor"></div>
  <div class="row">

    <div class="col-sm-12">

      <span class="alert alert-info" style="display: block;">
        <b>Este requerimiento ha recibido
        <?= $cantidad_ofertas; ?> oferta(s)</b>
      </span>
      <span><b>Empresa RSE:</b>
        <a href="<?= base_url();?>perfil_rse/<?= $requerimiento[0]->id_empresa;?>">
          <?= $requerimiento[0]->nombre_empresa;?>
        </a>
      </span>
      <br>
      <span><b>Fecha Ingreso:</b> <?= $requerimiento[0]->fecha_requerimiento;?></span>
      <br>
      <span><b>Sector:</b> <?= $requerimiento[0]->nombre_categoria;?></span>
      <br>
      <span><b>Microempresarios:</b> <?= $requerimiento[0]->nombre_subcategoria;?></span>
      <br>
      <span><b>Productos o Servicios: </b>
      <?php
          $sc = '';
          foreach ($sub_subc as $v) {
          $sc .= $v->nombre_sub_subcategoria.', ';
      } ?>

      <?= $this->functions->eliminar_ultima_coma($sc); ?>
      </span>
      <br>
      <span><b>Requerimiento:</b> <?= $requerimiento[0]->descripcion_requerimiento;?></span>



    </div>

  </div>
</div>


<?php if($existe_oferta > 0){ ?>

    <div class="col-sm-12 box-separator">
      <p style="font-style: italic;"><b>Ya enviaste una oferta para este requerimiento, ve a la sección de "mis ofertas" para revisar y editarla si es necesario.<br>
      <a href="<?= base_url();?>mis_ofertas">Ir a Mis ofertas</a>
      </b>
      </p>
    </div>

<?php } else { ?>


  <div class="col-sm-12 box-separator">
    <br><br>
    <h1 class="gray titulo-int">OFERTAR</h1>
    <?php if($this->session->id == ''){ ?>
      <p style="font-weight: bold;">
        <br>
        Debes iniciar sesión para realizar una oferta<br><br>
        <a href="#iniciar-sesion" data-toggle="modal" class="btn btn-success btn-large">Iniciar Sesión</a>
      </p>
    <?php } ?>
    <br>

    <div class="divisor"></div>
    <div class="row">

      <div class="col-sm-12">
        <form method="post" action="<?= base_url();?>rse/enviar_oferta">
          <?php if($this->session->id != ''){ ?>
              <p>Enviaremos tus datos a la Empresa RSE</p>
              <span><b>Nombre:</b> <?= $this->session->nombre;?></span>
              <br>
              <span><b>Fecha Oferta:</b> <?= date('Y-m-d');?></span>
              <br>
              <span><b>Ubicación:</b> <?= $this->session->region;?>, <?= $this->session->comuna;?></span>
              <br>
              <span><b>Selecciona tu Microempresa con la que vas a ofertar:</b>
              <div class="row">
              <div class="col-md-3">
              <select name="id_empresa" class="form-control">
                <?php foreach($publica_empresa as $pe){ ?>
                  <option value="<?= $pe->id_empresa;?>"><?= $pe->nombre_empresa;?></option>
                <?php } ?>
              </select>
              </div>
              </div>
              </span>
              <span>
                <p><b>Oferta:</b></p>
                <input type="hidden" name="id_requerimiento" value="<?= $requerimiento[0]->id_requerimiento;?>">
                <input type="hidden" name="id_cliente" value="<?= $requerimiento[0]->id_empresa;?>">
                <textarea name="oferta" required class="form-control" rows="4" placeholder="Ingresa tu oferta, se lo mas claro posible"></textarea>
              </span>
              <br>
              <span><input type="submit" value="Enviar Oferta" class="btn btn-success"></span>
          <?php } ?>
        </form>
      </div>

    </div>
  </div>


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