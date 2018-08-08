<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Regístrate</li>
      </ol>
      <hr>
      <h1 class="gray titulo-int">FORMULARIO DE REGISTRO <small>(Para Recibir Ofertas y Promociones, Comentar, Recomendar.)</small></h1>
      <p>Los campos marcados con (*) son de caracter obligatorio</p>
      <div class="row"><br>
        <br>
        <form role="form" method="POST" action="<?= base_url();?>registro/registrar_cuenta">

          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <?= $this->session->flashdata('mensaje');?>
          </div>

          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Nombre(*)</strong></p>
            <input name="nombre" type="text" class="form-control" id="nombre" required />
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Apellido(*)</strong></p>
            <input name="apellido" type="text" class="form-control" placeholder="apellido" required />
          </div>
         
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde vives(*)</strong></p>
            <select class="form-control" name="region" id="region-vives" required>
              <option value="">Seleccione...</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde vives(*)</strong></p>
            <select class="form-control" name="comuna" id="comuna-vives" required>
              <option>Seleccione...</option>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde trabajas</strong></p>
            <select class="form-control" name="region_trabajo" id="region-trabajas">
              <option>Seleccione...</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde trabajas</strong></p>
            <select class="form-control" name="comuna_trabajo" id="comuna-trabajas">
              <option>Seleccione...</option>
            </select>
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Teléfono móvil o WhatsApp(*)</strong></p>
            <input name="fono" type="text" class="form-control" id="telefono" required />
          </div>
         
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail(*)</strong></p>
            <input name="email" type="text" class="form-control" id="email" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar E-mail(*)</strong></p>
            <input name="confirma_email" type="text" class="form-control" id="confirma-email" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Contraseña(*)</strong></p>
            <input name="password" type="password" class="form-control" id="email" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar Contraseña(*)</strong></p>
            <input name="confirma_password" type="password" class="form-control" id="confirma-email" required />
          </div>
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <input name="politicas" id="politicas" type="checkbox" required checked>
            Acepto Políticas y Términos del Sitio<br>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger col-sm-6" value="Inscribirse"  />
          </div>
        </form>
        <br>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <p><small><a href="<?= base_url();?>politicas">Ver Políticas de Privacidad y Confidencialidad de Información</a></small> y <small><a href="<?= base_url();?>terminos">Términos y Condiciones de Uso del Sitio</a></small></small><br>
            <br>
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>
<script>
  $(document).ready(function(){
    $('#region-vives').on('change', function(){
      var region = $(this).find('option:selected').attr('data-id');
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegion',
        data:{region:region},
        success: function(res){
          $('#comuna-vives').html(res);
        }
      });
    });


    $('#region-trabajas').on('change', function(){
      var region = $(this).find('option:selected').attr('data-id');
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegion',
        data:{region:region},
        success: function(res){
          $('#comuna-trabajas').html(res);
        }
      });
    });


  });
</script>