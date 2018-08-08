<div class="container">
  <div class="col-md-12">

<ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>rse/listado_empresas">Listado Empresa RSE</a></li>
        <li><a href="<?= base_url();?>rse/perfil_rse/<?= $empresa->id_empresa;?>">Perfil RSE <?= $empresa->nombre_empresa;?></a></li>
        <li class="active">Ofertar</li>
</ol>
<br>


      <div class="col-sm-12">
      <h1 class="gray titulo-int">Ofertar a Solicitud de Cotizaciones de <?= $empresa->nombre_empresa;?></h1>
      <p>Los campos marcados con (*) son de caracter obligatorio</p>
      <div class="row"><br>

        <div class="col-lg-12">
        <?= $this->session->flashdata('mensaje');?>
        </div>

        <form method="POST" action="<?= base_url();?>rse/guardar_oferta" enctype="multipart/form-data">

        <input type="hidden" name="id_empresa" value="<?= $empresa->id_empresa;?>">
        <input type="hidden" name="id_requerimiento" value="<?= $requerimiento->id_requerimiento;?>">

        <div class="col-sm-12">

          <span class="alert alert-info" style="display: block;">
            <b>Esta solicitud de cotizaciones ha recibido
            <?= $this->functions->contar_ofertas_rse($requerimiento->id_requerimiento); ?> oferta(s)</b>
          </span>
          <br>
          <span><b>Título de la Solicitud:</b> <?= $requerimiento->titulo_requerimiento;?></span>
          <br>
          <span><b>Descripción de la Solicitud:</b> <?= $requerimiento->descripcion_requerimiento;?></span>
          <br>
          <span><b>Sucursal:</b> <?= $requerimiento->nombre_sucursal;?></span>
          <br>
          <span><b>Dirección Sucursal:</b> <?= $requerimiento->direccion_sucursal;?></span>
          <br>
          <span><b>Fono Sucursal:</b> <?= $requerimiento->fono_sucursal;?></span>
          <br>
          <span><b>Usuario Rse publicador:</b> <?= $requerimiento->nombre_usuario;?></span>
          <br>
          <span><b>Email usuario:</b> <?= $requerimiento->email_usuario;?></span>
          <br>
          <span><b>Rango del presupuesto:</b> 
            <?php if ($requerimiento->desde_requerimiento == ''): ?>
                No informado
            <?php else: ?>
                Desde <?= number_format($requerimiento->desde_requerimiento);?> hasta <?= number_format($requerimiento->hasta_requerimiento);?> Pesos</span>            
            <?php endif ?>

        </div>


<?php if($this->functions->existe_oferta_rse($requerimiento->id_requerimiento) > 0){ ?>

    <div class="col-sm-12">
      <p style="font-style: italic;"><b>Ya enviaste una oferta para esta solicitud, ve a la sección de "mis ofertas" para revisar y editarla si es necesario.<br>
      <a href="<?= base_url();?>mis_ofertas">Ir a Mis ofertas</a>
      </b>
      </p>
    </div>

<?php } else { ?>

  <div class="col-sm-12">
    <br><br>
    <?php if($this->session->id == ''){ ?>
      <p style="font-weight: bold;">
        <br>
        Debes iniciar sesión para realizar una oferta<br><br>
        <a href="#iniciar-sesion" data-toggle="modal" class="btn btn-success btn-large">Iniciar Sesión</a>
      </p>

    <div class="divisor"></div>

  <?php } else { ?>

    <div class="row">
      <div class="col-md-6">
        Selecciona la empresa con la que quieres ofertar y detalle tu oferta<br>
        <p></p>
        <select class="form-control" name="empresa">
          <?php foreach ($mis_empresas as $e): ?>
              <option value="<?= $e->id_empresa;?>"><?= $e->nombre_empresa;?></option>
          <?php endforeach ?>
        </select>
      </div>
    </div>

    <br>

    <div class="row">

      <div class="col-sm-12">
          
              <span>
                <textarea name="oferta" required class="form-control" rows="4" placeholder="Escribe tu oferta, sé lo mas claro posible"></textarea>
              </span>
              <br>
              <span><input type="submit" value="Enviar oferta ahora" class="btn btn-success"></span>
          
      </div>

    </div>
    <?php } ?>
  </div>



<?php } ?>
    <!--fin requerimientos -->

        </form>
        <br>

      </div>
      </div>
  </div>

  <!-- Fin Row -->

</div>

<!-- Fin Container -->

</div>

<div class="clearfix"></div><br>