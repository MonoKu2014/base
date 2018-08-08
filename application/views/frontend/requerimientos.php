<div class="container">
<div class="row">

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li class="active">Listado de Solicitudes de cotizaciones</li>
</ol>
<br>

<div class="col-sm-12 box-separator">
  <h1 class="gray titulo-int">LISTADO DE SOLICITUDES DE COTIZACIONES</h1>
  <br>

      <div class="row visible-xs" id="filter-xs">
        <div class="col-lg-12">
          <button id="show-filter" class="btn btn-primary">Mostrar/Ocultar filtros</button>
        </div>
      </div>


      <div class="row" id="filter">
        <form method="post">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" id="categoria" name="categoria">
              <option value="">Sector</option>
              <?php foreach($categorias as $c){ ?>
                  <option <?php if($categoria == $c->id_categoria){ echo 'selected'; } ?> value="<?= $c->id_categoria;?>">
                    <?= $c->nombre_categoria;?>
                  </option>
              <?php } ?>
            </select>
          </div>
          <br class="visible-xs">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" id="subcategoria" name="subcategoria">
              <option value="">Tipo de microempresario</option>
            </select>
          </div>
          <br class="visible-xs">

          <div class="clearfix visible-sm"></div><br class="visible-sm">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" name="region" id="region">
                <option value=""><?= $this->functions->texto_general(3);?></option>
              <?php foreach($this->functions->listarRegiones() as $r){ ?>
                <option <?php if($region == $r->nombre_region){ echo 'selected'; } ?> data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>">
                  <?= $r->nombre_region;?>
                </option>
              <?php } ?>
            </select>
          </div>
          <br class="visible-xs">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" name="comuna" id="comuna">
              <option value="">Comuna</option>
            </select>
          </div>
          <br class="visible-xs">

          <div class="clearfix"></div><br class="hidden-xs">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" name="fecha">
              <option value="" <?php if($fecha == ''){ echo 'selected'; } ?>>Fecha</option>
              <option value="hoy" <?php if($fecha == 'hoy'){ echo 'selected'; } ?>>Hoy</option>
              <option value="semana" <?php if($fecha == 'semana'){ echo 'selected'; } ?>>Última semana</option>
              <option value="mes" <?php if($fecha == 'mes'){ echo 'selected'; } ?>>Último mes</option>
              <option value="todas" <?php if($fecha == 'todas'){ echo 'selected'; } ?>>Todos</option>
            </select>
          </div>
          <br class="visible-xs">

          <div class="col-lg-3 col-md-3 col-sm-6 filter-input">
            <select class="form-control" name="estado">
              <option value="1" <?php if($estado == 1){ echo 'selected';} ?>>Abiertas</option>
              <option value="0" <?php if($estado == 0){ echo 'selected';} ?>>Cerradas</option>
              <option value="2" <?php if($estado == 2){ echo 'selected';} ?>>Todas</option>
            </select>
          </div>
          <br class="visible-xs">

          <div class="col-lg-3 col-md-2 col-sm-6 filter-input">
            <input type="submit" class="btn btn-req" value="Aplicar filtros" style="width: 100%;">
          </div>
          <div class="col-lg-3 col-md-2 col-sm-6">
            <a href="<?= base_url();?>requerimientos" class="btn btn-danger" style="width: 100%;">Eliminar filtros</a>
          </div>
        </form>
      </div>

      <?php if(count($requerimientos) > 0){ ?>
      <div class="clearfix"></div><br>
      <div class="divisor"></div>
      <div class="clearfix"></div><br>
      <div class="row">

          <div class="col-lg-12 table-responsive">
          <table class="table table-stripped table-condensed" style="font-size: 12px;">
            <thead>
              <th>Fecha publicación</th>
              <th>Publicado por</th>
              <th>Sector</th>
              <th>Tipo de microempresario</th>
              <th>Solicitud</th>
              <th>Estado</th>
              <th>Ver</th>
            </thead>
            <tbody>
            <?php foreach ($requerimientos as $r) { ?>

              <tr style="font-size: 13px;">
                <td><?= $r->fecha_requerimiento;?></td>
                <td>
                  <a href="<?= base_url();?>perfil_persona/<?= $r->id_cliente;?>">
                    <?= $r->nombre_cliente;?>
                  </a>
                </td>
                <td><?= $r->nombre_categoria;?></td>
                <td><?= $r->nombre_subcategoria;?></td>
                <td><?= substr($r->texto_requerimiento, 0, 200);?> ...</td>
                <td><?= ($r->estado_requerimiento == 1) ? '<span class="label label-success">Abierta</span>' : '<span class="label label-danger">Cerrada</span>';?></td>
                <td>
                 <a href="<?= base_url();?>detalle_requerimiento/<?= $r->id_requerimiento;?>"" class="delete eliminar_req" data-id="<?= $r->id_requerimiento;?>">Ver</a>
                </td>
              </tr>

            <?php } ?>
            </tbody>
          </table>
          </div>

        <?php } else { echo '<p class="alert alert-danger">La búsqueda no arrojó resultados</p>'; } ?>

      </div>
    </div>

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


<script>

var categoria_selected = '<?php echo $categoria;?>';
var subcategoria_selected = '<?php echo $subcategoria;?>';
var region_selected = '<?php echo $region;?>';
var comuna_selected = '<?php echo $comuna;?>';

  if($(window).width() > 768){
    $('#filter-xs').fadeOut();
  } else {
    $('#filter-xs').fadeIn();
  }

  $(window).resize(function(){
      if($(window).width() < 768){
        $('#filter').fadeOut();
        $('#filter-xs').fadeIn();
        $('.filter-input').css('margin-top', '20px');
      } else {
        $('#filter').fadeIn();
        $('#filter-xs').fadeOut();
      }
  });


  $('#categoria').on('change', function(){
      var categoria = $(this).find('option:selected').val();
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/subcategoriasPorCategoriaComboBox',
        data:{categoria:categoria},
        success: function(res){
          $('#subcategoria').html(res);
        }
      });
  });

$('#region').on('change', function(){
  var region = $(this).find('option:selected').attr('data-id');
  $.ajax({
    type: 'post',
    url: APP_URL + 'ajax/comunasPorRegion',
    data:{region:region},
    success: function(res){
      $('#comuna').html(res);
    }
  });
});

$('#show-filter').on('click', function(){
  $('#filter').fadeToggle();
});


function cargar_comuna()
{
  var region = $('#region').find('option:selected').attr('data-id');
  $.ajax({
    type: 'post',
    url: APP_URL + 'ajax/comunasPorRegion',
    data:{region:region},
    success: function(res){
      $('#comuna').html(res);
      $('#comuna').val(comuna_selected);
    }
  });
}


function cargar_subcategoria()
{
      var categoria = $('#categoria').find('option:selected').val();
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/subcategoriasPorCategoriaComboBox',
        data:{categoria:categoria},
        success: function(res){
          $('#subcategoria').html(res);
          $('#subcategoria').val(subcategoria_selected);
        }
      });
}

if(categoria_selected != ''){
  cargar_subcategoria();
}

if(region_selected != ''){
  cargar_comuna();
}


</script>