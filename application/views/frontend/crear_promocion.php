<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li><a href="<?= base_url();?>microempresario/<?= $id_empresa;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a></li>
        <li class="active">Crear Promoción</li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12 row box-separator">
    <div class="row">
      <!-- columna izq -->
      <div class="col-sm-12"><br class="visible-xs">
        <h1 class="orange">Crear Promoción</h1>
        <a href="<?= base_url();?>persona" class="pull-right">Volver a mi perfil</a>
        <img src="<?= IMAGES_PATH;?>divisor-puntos2.jpg" class="img-responsive" alt="divisor">
        <h2>Tus <strong>Productos </strong>
          <span class="promocion"></span>
        </h2><br>



        <!--productos -->


<div class="table-responsive">
  <table class="table">
   <tr>
   <td><strong>N°</strong></td>
   <td><strong>Producto Asociado</strong></td>
   <td><strong>Tipo de Promoción</strong></td>
   <td></td>
   <td><strong>Duración</strong></td>
   <td><strong>Previsualización</strong></td>
   <td></td>
   <td>
   Vigencia
   <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Días restantes para el vencimiento de la promoción"></i>
   </td>
   </tr>

   <?php foreach($productos as $k => $p){ ?>
   <tr>
   <td><?= $k + 1;?></td>
   <td><?= $p->nombre_producto;?></td>
   <td>
   <select class="form-control selector opciones-ordenar-por TIPO" id="producto-tipo-<?= $p->id_producto;?>" data-id="<?= $p->id_producto;?>">
      <option value="" <?php if($p->id_tipo_promocion == ''){echo 'selected';}else{echo '';}?>>Seleccione</option>
      <option value="1" data-text="Descuento" <?php if($p->id_tipo_promocion == 1){echo 'selected';}else{echo '';}?>>Descuento</option>
      <option value="2" data-text="2x1" <?php if($p->id_tipo_promocion == 2){echo 'selected';}else{echo '';}?>>2x1</option>
      <option value="3" data-text="3x2" <?php if($p->id_tipo_promocion == 3){echo 'selected';}else{echo '';}?>>3x2</option>
   </select>
   </td>
  <td>
   <select class="form-control selector opciones-ordenar-por DESCUENTO" id="producto-descuento-<?= $p->id_producto;?>" data-id="<?= $p->id_producto;?>">
      <option <?php if($p->descuento_promocion == ''){echo 'selected';}else{echo '';}?> value="">Seleccione</option>
      <option <?php if($p->descuento_promocion == '10%'){echo 'selected';}else{echo '';}?> value="10%">10%</option>
      <option <?php if($p->descuento_promocion == '20%'){echo 'selected';}else{echo '';}?> value="20%">20%</option>
      <option <?php if($p->descuento_promocion == '30%'){echo 'selected';}else{echo '';}?> value="30%">30%</option>
      <option <?php if($p->descuento_promocion == '40%'){echo 'selected';}else{echo '';}?> value="40%">40%</option>
      <option <?php if($p->descuento_promocion == '50%'){echo 'selected';}else{echo '';}?> value="50%">50%</option>
      <option <?php if($p->descuento_promocion == '60%'){echo 'selected';}else{echo '';}?> value="60%">60%</option>
      <option <?php if($p->descuento_promocion == '70%'){echo 'selected';}else{echo '';}?> value="70%">70%</option>
      <option <?php if($p->descuento_promocion == '80%'){echo 'selected';}else{echo '';}?> value="80%">80%</option>
      <option <?php if($p->descuento_promocion == '90%'){echo 'selected';}else{echo '';}?> value="90%">90%</option>
   </select>
   </td>
   <td>
     <select class="form-control selector opciones-ordenar-por DURACION" id="producto-duracion-<?= $p->id_producto;?>" data-id="<?= $p->id_producto;?>">
       <option <?php if($p->dias_promocion == 0){echo 'selected';}else{echo '';}?> value="">Seleccione</option>
       <option <?php if($p->dias_promocion == 7){echo 'selected';}else{echo '';}?>>7 Días</option>
       <option <?php if($p->dias_promocion == 15){echo 'selected';}else{echo '';}?>>15 Días</option>
       <option <?php if($p->dias_promocion == 30){echo 'selected';}else{echo '';}?>>30 Días</option>
     </select>
   </td>
   <td> <p class="promociones-pre" style="background: #ed2a7b;"><i class="fa fa-percent white"></i>
    <small id="producto-prev-<?= $p->id_producto;?>"><?= $p->descuento_promocion.' '.$p->tipo_promocion;?></small></p></td>
    <?php if($p->id_tipo_promocion == ''){ ?>
      <td><a href="#" data-id="<?= $p->id_producto;?>" class="btn btn-primary crear-promo-producto" style="padding: 4px 8px;">Crear</a></td>
    <?php } else { ?>
      <td><a href="#" data-id="<?= $p->id_producto;?>" class="btn btn-primary editar-promo-producto" style="padding: 4px 8px;background:#27a9e1;">Actualizar</a></td>
    <?php } ?>
      <td><?= $this->functions->vigencia($p->fecha_promocion, $p->dias_promocion, $p->id_promocion, 1);?></td>
   </tr>
   <?php } ?>

  </table>
</div>

        <!--fin-promociones -->
         <div class="clearfix"></div>
        <img src="<?= IMAGES_PATH;?>divisor-puntos2.jpg" class="img-responsive" alt="divisor"><br>
        <h2>Tus <strong>Servicios </strong>
        <span class="servicio-promo"></span>
        </h2><br>

 <div class="table-responsive">
  <table class="table">
   <tr>
   <td><strong>N°</strong></td>
   <td><strong>Servicio Asociado</strong></td>
   <td><strong>Tipo de Promoción</strong></td>
   <td></td>
  <td><strong>Duración</strong></td>
   <td><strong>Previsualización</strong></td>

   <td></td>
   <td>
   Vigencia
   <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title="Días restantes para el vencimiento de la promoción"></i>
   </td>
   </tr>

   <?php foreach($servicios as $k => $p){ ?>
   <tr>
   <td><?= $k + 1;?></td>
   <td><?= $p->nombre_servicio;?></td>
   <td>
   <select class="form-control selector opciones-ordenar-por TIPO-S" id="servicio-tipo-<?= $p->id_servicio;?>" data-id="<?= $p->id_servicio;?>">
      <option value="" <?php if($p->id_tipo_promocion == ''){echo 'selected';}else{echo '';}?>>Seleccione</option>
      <option value="1" data-text="Descuento" <?php if($p->id_tipo_promocion == 1){echo 'selected';}else{echo '';}?>>Descuento</option>
      <option value="2" data-text="2x1" <?php if($p->id_tipo_promocion == 2){echo 'selected';}else{echo '';}?>>2x1</option>
      <option value="3" data-text="3x2" <?php if($p->id_tipo_promocion == 3){echo 'selected';}else{echo '';}?>>3x2</option>
   </select>
   </td>
  <td>
   <select class="form-control selector opciones-ordenar-por DESCUENTO-S" id="servicio-descuento-<?= $p->id_servicio;?>" data-id="<?= $p->id_servicio;?>">
      <option <?php if($p->descuento_promocion == ''){echo 'selected';}else{echo '';}?> value="">Seleccione</option>
      <option <?php if($p->descuento_promocion == '10%'){echo 'selected';}else{echo '';}?> value="10%">10%</option>
      <option <?php if($p->descuento_promocion == '20%'){echo 'selected';}else{echo '';}?> value="20%">20%</option>
      <option <?php if($p->descuento_promocion == '30%'){echo 'selected';}else{echo '';}?> value="30%">30%</option>
      <option <?php if($p->descuento_promocion == '40%'){echo 'selected';}else{echo '';}?> value="40%">40%</option>
      <option <?php if($p->descuento_promocion == '50%'){echo 'selected';}else{echo '';}?> value="50%">50%</option>
      <option <?php if($p->descuento_promocion == '60%'){echo 'selected';}else{echo '';}?> value="60%">60%</option>
      <option <?php if($p->descuento_promocion == '70%'){echo 'selected';}else{echo '';}?> value="70%">70%</option>
      <option <?php if($p->descuento_promocion == '80%'){echo 'selected';}else{echo '';}?> value="80%">80%</option>
      <option <?php if($p->descuento_promocion == '90%'){echo 'selected';}else{echo '';}?> value="90%">90%</option>
   </select>
   </td>
   <td>
     <select class="form-control selector opciones-ordenar-por DURACION" id="servicio-duracion-<?= $p->id_servicio;?>" data-id="<?= $p->id_servicio;?>">
       <option <?php if($p->dias_promocion == 0){echo 'selected';}else{echo '';}?> value="">Seleccione</option>
       <option <?php if($p->dias_promocion == 7){echo 'selected';}else{echo '';}?>>7 Días</option>
       <option <?php if($p->dias_promocion == 15){echo 'selected';}else{echo '';}?>>15 Días</option>
       <option <?php if($p->dias_promocion == 30){echo 'selected';}else{echo '';}?>>30 Días</option>
     </select>
   </td>

   <td> <p class="promociones-pre" style="background: #ed2a7b;"><i class="fa fa-percent white"></i>
    <small id="servicio-prev-<?= $p->id_servicio;?>"><?= $p->descuento_promocion.' '.$p->tipo_promocion;?></small></p></td>
    <?php if($p->id_tipo_promocion == ''){ ?>
      <td><a href="#" data-id="<?= $p->id_servicio;?>" class="btn btn-primary crear-promo-servicio" style="padding: 4px 8px;">Crear</a></td>
    <?php } else { ?>
      <td><a href="#" data-id="<?= $p->id_servicio;?>" class="btn btn-primary editar-promo-servicio" style="padding: 4px 8px;background:#27a9e1;">Actualizar</a></td>
    <?php } ?>
      <td><?= $this->functions->vigencia($p->fecha_promocion, $p->dias_promocion, $p->id_promocion, 2);?></td>
   </tr>
   <?php } ?>

  </table>
</div>


      </div>
        <!--fin columna izq -->

      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>

<!-- Fin Container -->

<script>


var id_empresa = <?= $id_empresa;?>;


</script>



<script>
//PARA PRODUCTOS

$(document).ready(function(){

  var id_sel;
  var tipo = '';
  var descuento = '';
  var color = '#ed2a7b';
  var texto = '';
  var tipo_seleccion = '';


  $('.TIPO').on('change', function(){
    tipo_seleccion = $(this).val();
    id_sel = $(this).attr('data-id');
    tipo = $('#producto-tipo-'+id_sel).find('option:selected').attr('data-text');
    descuento = $('#producto-descuento-'+id_sel).find('option:selected').val();
    previsualizacion(tipo, descuento, color, id_sel);
  });


  $('.DESCUENTO').on('change', function(){
    id_sel = $(this).attr('data-id');
    tipo = $('#producto-tipo-'+id_sel).find('option:selected').attr('data-text');
    descuento = $('#producto-descuento-'+id_sel).find('option:selected').val();
    previsualizacion(tipo, descuento, color, id_sel);
  });


  function previsualizacion(tipo, descuento, color, id_sel){
    if(tipo_seleccion == 1){
      texto = descuento + ' ' + tipo;
    } else {
      texto = tipo;
    }

    $('#producto-prev-'+id_sel).parent('.promociones-pre').css('background', color);
    if(typeof texto !== 'undefined'){
      $('#producto-prev-'+id_sel).text(texto);
    }
  }


    $(document).on('click', '.crear-promo-producto', function(event){
        event.preventDefault();
        var producto = $(this).attr('data-id');
        var tipo = $('#producto-tipo-' + producto).find('option:selected').val();
        var descuento = $('#producto-descuento-' + producto).find('option:selected').val();
        var duracion = $('#producto-duracion-' + producto).find('option:selected').val();
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/crear_promocion_producto',
            data: {producto:producto, tipo:tipo, descuento:descuento, color:color, duracion:duracion, id_empresa:id_empresa},
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                  location.reload();
                } else {
                  $('.promocion').addClass('alert alert-danger').text(res.mensaje).fadeIn('fast');
                }
                $('.promocion').delay(2000).fadeOut();
            }
        });
    });



    $(document).on('click', '.editar-promo-producto', function(event){
        event.preventDefault();
        var producto = $(this).attr('data-id');
        var tipo = $('#producto-tipo-' + producto).find('option:selected').val();
        var descuento = $('#producto-descuento-' + producto).find('option:selected').val();
        var duracion = $('#producto-duracion-' + producto).find('option:selected').val();
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/editar_promocion_producto',
            data: {producto:producto, tipo:tipo, descuento:descuento, color:color, duracion:duracion, id_empresa:id_empresa},
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                  location.reload();
                } else {
                  $('.promocion').addClass('alert alert-danger').text(res.mensaje).fadeIn('fast');
                }
                $('.promocion').delay(2000).fadeOut();
            }
        });
    });







});


</script>

<script>
//PARA SERVICIOS

$(document).ready(function(){

  var id_selS = '';
  var tipoS = '';
  var descuentoS = '';
  var colorS = '#ed2a7b';
  var textoS = '';
  var tipo_seleccion_s = '';


  $('.TIPO-S').on('change', function(){
    tipo_seleccion_s = $(this).val();
    id_selS = $(this).attr('data-id');
    tipoS = $('#servicio-tipo-'+id_selS).find('option:selected').attr('data-text');
    descuentoS = $('#servicio-descuento-'+id_selS).find('option:selected').val();
    previsualizacionServicio(tipoS, descuentoS, colorS, id_selS);
  });


  $('.DESCUENTO-S').on('change', function(){
    id_selS = $(this).attr('data-id');
    tipoS = $('#servicio-tipo-'+id_selS).find('option:selected').attr('data-text');
    descuentoS = $('#servicio-descuento-'+id_selS).find('option:selected').val();
    previsualizacionServicio(tipoS, descuentoS, colorS, id_selS);
  });


  function previsualizacionServicio(tipoS, descuentoS, colorS, id_selS){
    if(tipo_seleccion_s == 1){
      textoS = descuentoS + ' ' + tipoS;
    } else {
      textoS = tipoS;
    }


    $('#servicio-prev-'+id_selS).parent('.promociones-pre').css('background', colorS);
    if(typeof textoS !== 'undefined'){
      $('#servicio-prev-'+id_selS).text(textoS);
    }
  }



    $(document).on('click', '.crear-promo-servicio', function(event){
        event.preventDefault();
        var servicio = $(this).attr('data-id');
        var tipo = $('#servicio-tipo-' + servicio).find('option:selected').val();
        var descuento = $('#servicio-descuento-' + servicio).find('option:selected').val();
        var duracion = $('#servicio-duracion-' + servicio).find('option:selected').val();
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/crear_promocion_servicio',
            data: {servicio:servicio, tipo:tipo, descuento:descuento, color:colorS, duracion:duracion, id_empresa:id_empresa},
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                  location.reload();
                } else {
                  $('.servicio-promo').addClass('alert alert-danger').text(res.mensaje).fadeIn('fast');
                }
                $('.servicio-promo').delay(2000).fadeOut();
            }
        })
    });



    $(document).on('click', '.editar-promo-servicio', function(event){
        event.preventDefault();
        var servicio = $(this).attr('data-id');
        var tipo = $('#servicio-tipo-' + servicio).find('option:selected').val();
        var descuento = $('#servicio-descuento-' + servicio).find('option:selected').val();
        var duracion = $('#servicio-duracion-' + servicio).find('option:selected').val();
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/editar_promocion_servicio',
            data: {servicio:servicio, tipo:tipo, descuento:descuento, color:colorS, duracion:duracion, id_empresa:id_empresa},
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                  location.reload();
                } else {
                  $('.servicio-promo').addClass('alert alert-danger').text(res.mensaje).fadeIn('fast');
                }
                $('.servicio-promo').delay(2000).fadeOut();
            }
        });
    });


});


</script>