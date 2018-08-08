<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="./">Inicio</a></li>
        <li class="active">Editar datos personales</li>
      </ol>
      <br>

      <div class="box-separator">
      <h1 class="gray titulo-int">Editar datos personales</h1>
      <div class="row"><br>
        <br>
        <form role="form" method="POST" action="<?= base_url();?>guarda_edicion_persona">
          <div class="clearfix"></div>
          <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
          <br>
          <div class="col-sm-12">
            <h2><strong>Datos</strong></h2>
          </div>


            <div class="col-lg-12"><p>Tus datos son pre cargados en el formulario de acuerdo a tu sesión activa.</p></div>
           <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Nombre</strong></p>
            <input name="nombre" type="text" class="form-control" id="nombre" value="<?= $cliente[0]->nombre_cliente;?>" />
          </div>        
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde vives</strong></p>
            <select class="form-control" name="region-vives" id="region-vives">
              <option value="<?= $cliente[0]->region_cliente;?>"><?= $cliente[0]->region_cliente;?></option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde vives</strong></p>
            <select class="form-control" name="comuna-vives" id="comuna-vives">
              <option value="<?= $cliente[0]->comuna_cliente;?>"><?= $cliente[0]->comuna_cliente;?></option>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde trabajas</strong></p>
            <select class="form-control" name="region" id="region">
              <option value="<?= $cliente[0]->region_trabajo_cliente;?>"><?= $cliente[0]->region_trabajo_cliente;?></option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde trabajas</strong></p>
            <select class="form-control" name="comuna" id="comuna">
              <option value="<?= $cliente[0]->comuna_trabajo_cliente;?>"><?= $cliente[0]->comuna_trabajo_cliente;?></option>
            </select>
          </div>

          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail</strong></p>
            <input name="email" type="text" class="form-control" id="email" value="<?= $cliente[0]->email_cliente;?>" />
          </div>

          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Contraseña</strong></p>
            <input name="password" type="password" class="form-control" id="email" value="<?= $cliente[0]->password_cliente;?>" />
          </div>

          <div class="clearfix"></div>
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger col-sm-6" value="Guardar"  />
          </div>
        </form>
        <br>
        <div class="clearfix"></div>
      </div>
      </div>

    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>

<!-- Fin Container -->

<script>
  $(document).ready(function(){
      

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


    $('#region-empresa').on('change', function(){
      var region = $(this).find('option:selected').attr('data-id');
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegion',
        data:{region:region},
        success: function(res){
          $('#comuna-empresa').html(res);
        }
      });
    });



  });
</script>