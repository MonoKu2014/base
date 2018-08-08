<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <?php if ($alianza->tipo_solicitud == 0): ?>
          <li><a href="<?= base_url();?>rse/listado_alianzas">Mis Solicitudes de Alianzas</a></li>
        <?php else: ?>
          <li><a href="<?= base_url();?>rse/solicitudes_rse">Listado de Solicitudes de Alianzas para mí desde Portal RSE</a></li>  
        <?php endif ?>
        
        <li class="active">Detalle de Solicitud de Alianza</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12">
    <div class="row">


    <div class="col-md-12">
        <div class="row">
            <h1>Detalle de Solicitud de Alianza</h1>
            <br>
            <p>Título: <?= $alianza->titulo_convenio;?></p>
            <p>Descripción: <?= $alianza->descripcion_convenio;?></p>
            <p>Descuento: <?= $alianza->descuento_convenio;?>% ofrecido</p>
        </div>
    </div>


    <div class="col-md-12">
        <div class="row">
            <h1 class="blue">Detalle de Empresa RSE</h1>
            <br>
            <p>Empresa: <?= $alianza->nombre_empresa;?></p>
            <p>Sector: <?= $alianza->sector;?></p>
            <p>Descripción: <?= $alianza->descripcion_empresa;?></p>
            <p>Tamaño: <strong><?= $alianza->tamano_empresa;?></strong></p>
            <p>Tipo de Empresa: <strong><?= $alianza->tipo_empresa;?></strong></p>
            <br>
            </a>
        </div>
    </div>


    <?php if ($alianza->estado_convenio == 4 || $alianza->estado_convenio == 5 || $alianza->tipo_solicitud == 1): ?>
      
    <div class="col-md-12">
        <div class="row">
            <h1 class="blue">Preguntas/Respuestas de la Solicitud de Alianza</h1>
            <br>
            <form method="post" action="<?= base_url();?>rse/responder_pregunta_alianza">
              
                Preguntas/Respuestas Anteriores: <br><br>

                <?= $this->functions->preguntas_respuestas_alianza($alianza->id_convenio);?>


                <br>

                <?php if ($alianza->estado_convenio == 4 && $alianza->tipo_solicitud == 0 || $alianza->tipo_solicitud == 1): ?>


                <p>Responder última pregunta o Enviar una pregunta</p>
                <input type="hidden" name="id_convenio" value="<?= $alianza->id_convenio;?>">
                <textarea class="form-control" placeholder="Ingresa tu pregunta o respuesta" name="motivo"></textarea><br>
                <input type="submit" name="Enviar pregunta o respuesta" class="btn btn-info">

                <?php endif ?>

            </form>
            </a>
        </div>
    </div>
    <?php endif ?>


      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>