<div class="clearfix"></div>

<div class="container">
  <div class="col-md-12">

<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li class="active">Listado de Empresas Socialmente Responsables</li>
</ol>
<br>

    <br>
    <h1 class="title_rse blue">LISTADO EMPRESAS SOCIALMENTE RESPONSABLES</h1>
    <select name="" id="ordenar" class="pull-right filtro">
      <option value="">Ordenar por</option>
      <option value="<?= base_url();?>rse/listado_empresas?ordenar=1">Cantidad Usuarios/trabajadores</option>
      <option value="<?= base_url();?>rse/listado_empresas?ordenar=2">Cantidad Alianzas</option>
      <option value="<?= base_url();?>rse/listado_empresas?ordenar=3">Cantidad Solicitud de Cotiazaciones</option>
    </select>
  </div>



  <div class="col-md-3">
    <hr>
    <h4>Filtrar listado</h4>
    <br>
      <form method="post">
      <p><strong><?= $this->functions->texto_general(3);?></strong></p>
      <select class="form-control" name="region" id="region">
        <option value="">Seleccione...</option>
        <?php foreach($this->functions->listarRegiones() as $r){ ?>
          <option <?php if($region_seleccionada == $r->id_region){ echo 'selected'; }?> data-id="<?= $r->id_region;?>" value="<?= $r->id_region;?>"><?= $r->nombre_region;?></option>
        <?php } ?>
      </select>
      <br>
      <p><strong><?= $this->functions->texto_general(4);?></strong></p>
      <select class="form-control" name="comuna" id="comuna">
        <option>Seleccione...</option>
      </select>
      <p>
        <br>
        <input type="submit" class="btn btn-new" value="Filtrar">
      </p>
      </form>
  </div>

  <div class="col-md-9">
    <hr>
    <br>


    <?php if (count($empresas) == 0): ?>
      
      <div class="col-lg-12">
        <h2 class="blue">No hay registros de acuerdo a los filtros indicados</h2>
      </div>

    <?php else: ?>


    

    <?php foreach ($empresas as $empresa): ?>
      
    <div class="row">
      <div class="col-md-3">
        <a href="<?= base_url();?>perfil_rse/<?= $empresa->id_empresa; ?>">
          <img src="<?= base_url();?>components/images/perfil-micro.jpg" alt="Empresa" class="img-responsive">
        </a>
      </div>
      <div class="col-md-9">
        <h2 class="blue"><a href="<?= base_url();?>perfil_rse/<?= $empresa->id_empresa; ?>"><strong><?= $empresa->nombre_empresa; ?></strong></a></h2>
        <p class="texto_interior"><?= $empresa->descripcion_empresa; ?></p>
        <h5><strong><?= $empresa->sector; ?></strong></h5>
        <br>
        
        <a href="#" class="btn btn-default extend-btn acc_button acc_trab" data-id="<?= $empresa->id_empresa; ?>">
          <?= count($this->functions->contar_usuarios($empresa->id_empresa)); ?> Usuarios / Trabajadores <i class="fa fa-chevron-down"></i></a>
        
        <a href="#" class="btn btn-default extend-btn acc_button acc_alia" data-id="<?= $empresa->id_empresa; ?>">
          <?= count($this->functions->contar_convenios($empresa->id_empresa)); ?> Alianzas <i class="fa fa-chevron-down"></i></a>
        
        <a href="#" class="btn btn-default extend-btn acc_button acc_coti" data-id="<?= $empresa->id_empresa; ?>"><?= count($this->functions->contar_requerimientos($empresa->id_empresa)); ?> Solicitudes de Cotizaciones <i class="fa fa-chevron-down"></i></a>
        <br>
        <br>



        <!-- DIV TRABAJADORES ESCONDIDO -->

        <div class="col-lg-12" id="trabajadores_<?= $empresa->id_empresa; ?>" style="display: none;">
          <div class="row">
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
          <br>
          <a href="<?= base_url();?>rse/ofrecer_convenio/<?= $empresa->id_empresa;?>" class="btn btn-default extend-btn">Ofrecer Alianza</a>
          </div>
        </div>

        <!--  FIN DIV TRABAJADORES ESCONDIDO -->


        <!-- DIV ALIANZAS ESCONDIDO -->

        <div class="col-lg-12" id="alianzas_<?= $empresa->id_empresa; ?>" style="display: none;">
          <div class="row">
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
          <br>
          <a href="<?= base_url();?>rse/ofrecer_convenio/<?= $empresa->id_empresa;?>" class="btn btn-default extend-btn">Ofrecer Alianza</a>
          </div>
        </div>

        <!--  FIN DIV ALIANZAS ESCONDIDO -->



        <!-- DIV ALIANZAS ESCONDIDO -->

        <div class="col-lg-12" id="cotizaciones_<?= $empresa->id_empresa; ?>" style="display: none;">
          <div class="row">
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
                  <td><a href="<?= base_url();?>rse/ofertar/<?= $requerimiento->id_requerimiento;?>" class="btn btn-info extend-btn">Hacer una oferta</a></td>
                </tr>
              <?php endforeach ?>
              
            </tbody>
          </table>
          </div>
        </div>

        <!--  FIN DIV ALIANZAS ESCONDIDO -->




      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <hr>
      </div>
    </div>

    <?php endforeach ?>


          <!-- Paginador -->

          <?php if($total_registros > 0){ ?>
          <div class="col-lg-12">
          <ul class="pagination">
            <?php for ($x = 1; $x <= $total_registros; $x++) { ?>
              <li><a <?php if($pagina_actual == $x) { echo 'class="active"'; } ?> href="<?= $url.'p='.$x;?>"><?= $x;?></a></li>
            <?php } ?>
            <!--<li><a href="#"><strong>Última página <span class="glyphicon glyphicon-play"></span></strong></a></li>-->
          </ul>
          </div>
          <?php } ?>

          <!-- Fin Paginador -->
    
  </div>

<?php endif ?>

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

  $('#alianzas_' + valor).slideUp();
  $('#cotizaciones_' + valor).slideUp();

});


$('.acc_alia').on('click', function(event){
  event.preventDefault();
  let valor = $(this).data('id');

  $('#alianzas_' + valor).slideToggle();
  
  $('#trabajadores_' + valor).slideUp();
  $('#cotizaciones_' + valor).slideUp();

});

$('.acc_coti').on('click', function(event){
  event.preventDefault();
  let valor = $(this).data('id');

  $('#cotizaciones_' + valor).slideToggle();

  $('#alianzas_' + valor).slideUp();
  $('#trabajadores_' + valor).slideUp();

});


$('#ordenar').on('change', function(){

  let url_selected = $(this).val();

  window.location.href = url_selected;

});

</script>


<script>
  $(document).ready(function(){


    var region_seleccionada = '<?php echo $region_seleccionada; ?>';
    var comuna_seleccionada = '<?php echo $comuna_seleccionada; ?>';

    if(region_seleccionada != ''){
      cargar_comunas(region_seleccionada, comuna_seleccionada);      
    }

    $('#region').on('change', function(){
      var region = $(this).find('option:selected').attr('data-id');
      cargar_comunas(region, '');
    });


    function cargar_comunas(region, comuna)
    {
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegionRse',
        data:{region:region, comuna:comuna},
        success: function(res){
          $('#comuna').html(res);
        }
      });
    }

  });
</script>