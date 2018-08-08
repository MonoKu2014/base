<div class="clearfix"></div>


<div class="col-lg-12 breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="<?= base_url();?>">Inicio</a></li>
      <li><a href="<?= base_url();?>rse/listado_empresas">Listado de Empresas Socialmente Responsables</a></li>
      <li>Detalle de <?= $empresa->nombre_empresa; ?> </li>
    </ul>
  </div>
</div>



<div class="container">
  <br>
  
  <div class="row">
  <div class="col-lg-9">
    <br>
    <br>
    <?php if ($empresa->imagen_header_empresa == ''): ?>
      <img src="<?= base_url();?>components/images/sin-imagen.jpg" alt="Perfil portada" class="img-responsive" style="height: 250px;">
    <?php else: ?>
      <img src="http://etoliving.com/rse/rse_components/empresas/perfiles/<?= $empresa->imagen_header_empresa;?>" alt="Perfil portada" class="img-responsive" style="height: 250px;">
    <?php endif ?>

    <br><br>


        <!-- DIV TRABAJADORES ESCONDIDO -->

        <div class="col-lg-12" id="trabajadores_<?= $empresa->id_empresa; ?>" style="display: none;">
          <h3 class="blue">Listado de Usuarios / Trabajadores</h3><br>
          <table class="table table-bordered table-hovered table-striped" style="font-size: 12px;">
            <thead>
              <th>Región</th>
              <th>Comuna</th>
              <th>Cantidad</th>
            </thead>
            <tbody>

              <?php foreach ($this->functions->usuarios_listado_slide($empresa->id_empresa) as $usuario): ?>
                <tr>
                  <td><?= $this->functions->nombre_region($usuario->region_usuario, 1); ?></td>
                  <td><?= $this->functions->nombre_comuna($usuario->comuna_usuario, 1); ?></td>
                  <td><?= $this->functions->contar_por_comuna($usuario->comuna_usuario, $empresa->id_empresa); ?></td>
                </tr>
              <?php endforeach ?>
              
            </tbody>
          </table>
        </div>

        <!--  FIN DIV TRABAJADORES ESCONDIDO -->


        <!-- DIV ALIANZAS ESCONDIDO -->

        <div class="col-lg-12" id="alianzas_<?= $empresa->id_empresa; ?>" style="display: none;">
          <h3 class="blue">Alianzas</h3><br>
          <table class="table table-bordered table-hovered table-striped" style="font-size: 12px;">
            <thead>
              <th>Microempresa</th>
              <th>Fecha</th>
              <th>Rubro</th>
            </thead>
            <tbody>

              <?php foreach ($this->functions->contar_convenios($empresa->id_empresa) as $convenio): ?>
                <tr>
                  <td><?= $this->functions->nombreEmpresa($convenio->id_empresa); ?></td>
                  <td><?= $convenio->fecha_solicitud_convenio; ?></td>
                  <td><?= $this->functions->categoriaEmpresa($convenio->id_empresa); ?></td>
                </tr>
              <?php endforeach ?>
              
            </tbody>
          </table>
        </div>

        <!--  FIN DIV ALIANZAS ESCONDIDO -->



        <!-- DIV ALIANZAS ESCONDIDO -->

        <div class="col-lg-12" id="cotizaciones_<?= $empresa->id_empresa; ?>" style="display: none;">
          <h3 class="blue">Solicitudes de Cotizaciones</h3><br>
          <table class="table table-bordered table-hovered table-striped" style="font-size: 12px;">
            <thead>
              <th>Fecha</th>
              <th>Sucursal</th>
              <th>Rubro</th>
              <th>Tipo</th>
              <th>Descripción</th>
              <th></th>
            </thead>
            <tbody>

              <?php foreach ($this->functions->listar_requerimientos($empresa->id_empresa) as $requerimiento): ?>
                <tr>
                  <td><?= $requerimiento->fecha_requerimiento; ?></td>
                  <td><?= $requerimiento->nombre_sucursal; ?></td>
                  <td><?= $this->functions->categoriaRequerimiento($requerimiento->id_empresa); ?></td>
                  <td><?= $this->functions->subcategoriaRequerimiento($requerimiento->id_empresa); ?></td>
                  <td><?= substr($requerimiento->descripcion_requerimiento, 0, 100); ?>...</td>
                  <td><a href="<?= base_url();?>rse/ofertar/<?= $requerimiento->id_requerimiento; ?>" class="btn btn-info extend-btn">Hacer una oferta</a></td>
                </tr>
              <?php endforeach ?>
              
            </tbody>
          </table>
        </div>

        <!--  FIN DIV ALIANZAS ESCONDIDO -->

  </div>

  <div class="col-md-3">
    <br>
    <br class="hidden-xs">
    <br class="hidden-xs">
    <br class="hidden-xs">
    <h4 class="blue">Sitio Web: <b><?= $empresa->web_empresa; ?></b></h4>
    <a <a href="#" class="acc_trab" data-id="<?= $empresa->id_empresa; ?>"><?= count($this->functions->contar_usuarios($empresa->id_empresa)); ?> Usuarios / Trabajadores</a><br>
    <a <a href="#" class="acc_alia" data-id="<?= $empresa->id_empresa; ?>"><?= count($this->functions->contar_convenios($empresa->id_empresa)); ?> Alianzas</a><br>
    <a <a href="#" class="acc_coti" data-id="<?= $empresa->id_empresa; ?>"><?= count($this->functions->contar_requerimientos($empresa->id_empresa)); ?> Solicitudes de Cotizaciones</a><br>
    <br><a href="<?= base_url();?>rse/ofrecer_convenio/<?= $empresa->id_empresa;?>" class="btn btn-info extend-btn">Ofrecer Alianza</a>
  </div>
  </div>


  <div class="row">
    <div class="col-md-3">
      <br>
      <h1 class="title_rse blue"><?= strtoupper($empresa->nombre_empresa); ?></h1>
      <hr>
    </div>

    <div class="col-md-9" style="margin-top:15px;">
      <br><br>
      <strong><?= $empresa->sector; ?></strong>
      <hr>

    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <?php if ($empresa->imagen_empresa == ''): ?>
        <img src="<?= base_url();?>components/images/sin-imagen.jpg" alt="Perfil portada" class="img-responsive">
      <?php else: ?>
        <img src="http://etoliving.com/rse/rse_components/empresas/perfiles/<?= $empresa->imagen_empresa;?>" alt="Perfil portada" class="img-responsive">
      <?php endif ?>
    </div>
    <div class="col-md-9">
      <p class="texto_interior"><?= $empresa->descripcion_empresa; ?></p>
      <br>
      <a href="<?= base_url();?>rse/ofrecer_convenio/<?= $empresa->id_empresa;?>" class="btn btn-default extend-btn ofrecer_alianza">Ofrecer Alianza</a>
      <!--<a href="#" class="btn btn-default extend-btn">Chatear con RSE</a>-->
    </div>
  </div>







</div>
<div class="clearfix"></div>

<br>
<br>
<br>



<script>
  
$('.acc_trab').on('click', function(event){
  event.preventDefault();
  let valor = $(this).data('id');

  $('#trabajadores_' + valor).slideToggle();

});


$('.acc_alia').on('click', function(event){
  event.preventDefault();
  let valor = $(this).data('id');

  $('#alianzas_' + valor).slideToggle();

});

$('.acc_coti').on('click', function(event){
  event.preventDefault();
  let valor = $(this).data('id');

  $('#cotizaciones_' + valor).slideToggle();

});


$('.ofrecer_alianza').on('click', function(){

});

</script>