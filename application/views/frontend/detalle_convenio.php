<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>mis_requerimientos">Mis Solicitudes de Cotizaciones y Convenios</a></li>
        <li class="active">Detalle de Convenio</li>
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
            <h1>Detalle de Convenio</h1>
            <br>
            <p>Título del Convenio: <?= $convenio->titulo_convenio;?></p>
            <p>Descripción del Convenio: <?= $convenio->descripcion_convenio;?></p>
            <p>Descuento del Convenio: <?= $convenio->descuento_convenio;?>% ofrecido</p>
        </div>
    </div>


    <div class="col-md-12">
        <div class="row">
            <h1>Detalle de Empresa RSE</h1>
            <br>
            <p>Empresa: <?= $convenio->nombre_empresa;?></p>
            <p>Sector: <?= $convenio->sector;?></p>
            <p>Descripción: <?= $convenio->descripcion_empresa;?></p>
            <p>Tamaño: <strong><?= $convenio->tamano_empresa;?></strong></p>
            <p>Tipo de Empresa: <strong><?= $convenio->tipo_empresa;?></strong></p>
            <br>
            <a data-id="<?= $convenio->id_empresa;?>" class="btn btn-new btn-extend chatearOnline">
            <i class="fa fa-comment"></i> Chatear con RSE
            </a>
        </div>
    </div>


      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>