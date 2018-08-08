<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Editar datos</li>
      </ol>
      <br>
      <div class="box-separator">
      <h1 class="gray titulo-int" id="id_empresa" data-id="<?= $empresa[0]->id_empresa;?>">Edite sus datos</h1>
        <p>Los campos marcados con (*) son de caracter obligatorio</p>
        <br>
        <form role="form" method="POST" action="<?= base_url();?>microempresarios/guarda_edicion_microempresario">
        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
        <input type="hidden" name="id_empresa" value="<?= $empresa[0]->id_empresa;?>">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <p><strong>Nombre de fantasía del negocio(*)</strong></p>
            <input name="nombre_fantasia" type="text" class="form-control" required value="<?= $empresa[0]->nombre_empresa;?>" />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Sector Negocios y Servicios(*)</strong></p>
            <select id="categoria" name="categoria" class="form-control" required>
              <option value="<?= $empresa[0]->id_categoria;?>"><?= $this->functions->nombreCategoria($empresa[0]->id_categoria);?></option>
              <?php foreach($categorias as $c){ ?>
                  <option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Tipos de Negocios y Servicios</strong></p>
            <?php
              $ssc = [];
              foreach($this->functions->subcategoriasPorCategoria($empresa[0]->id_categoria) as $k => $v){
              $tiene = $this->functions->tieneSubcategoria($v->id_subcategoria, $empresa[0]->id_empresa);
              if($tiene == 0){
                  $checked = '';
              } else {
                $checked = 'checked';
                  array_push($ssc, $v->id_subcategoria);
              }
            ?>
            <span id="subcategorias">
                <input class="subcategoria" <?= $checked;?> type="checkbox" name="subcategorias[]" value="<?= $v->id_subcategoria;?>">
                <?= $v->nombre_subcategoria;?><br>
            <?php } ?>
            </span>
          </div>


          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Productos y Servicios</strong></p>
              <div id="sub_subcategorias">
            <?php
            if(count($ssc) > 0){
            foreach($this->functions->sub_subcategoriasPorSubcategoria($ssc) as $k => $v){
              $tiene = $this->functions->tieneSubsubcategoria($v->id_sub_subcategoria, $empresa[0]->id_empresa);
              if($tiene == 0){ $checked = ''; } else { $checked = 'checked'; }
              ?>
                <input class="sub_subcategoria" <?= $checked;?> type="checkbox" name="sub_subcategorias[]" value="<?= $v->id_sub_subcategoria;?>">
                <?= $v->nombre_sub_subcategoria;?><br>
            <?php } } ?>
              </div>
          </div>

          <div class="clearfix"></div>
         <div class="col-lg-12">
         <br>
           <hr>
         <br>
         </div>

          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?>(*)</strong></p>
            <select class="form-control" name="region" id="region" required>
              <option value="">Seleccione..</option>
              <?php foreach($regiones as $r){ ?>
                <?php if($r->nombre_region == $empresa[0]->region_empresa){?>
                  <option selected data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
                <?php } else { ?>
                  <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
                <?php } ?>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?>(*)</strong></p>
            <select class="form-control" name="comuna" id="comuna" required>
              <option value="<?= $empresa[0]->comuna_empresa;?>"><?= $empresa[0]->comuna_empresa;?></option>
            </select>
          </div>

          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Avenida o calle(*)</strong></p>
            <input name="avenida" type="text" class="form-control" required value="<?= $empresa[0]->calle_empresa;?>" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Número(*)</strong></p>
            <input name="numero" type="text" class="form-control" required value="<?= $empresa[0]->numero_calle_empresa;?>" />
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Celular(*)</strong></p>
            <input name="celular" type="text" class="form-control" required value="<?= $empresa[0]->celular_empresa;?>" />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Teléfono fijo</strong></p>
            <input name="fono" type="text" class="form-control" value="<?= $empresa[0]->fono_empresa;?>" />
          </div>

          <div class="clearfix"></div>

          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Sitio Web</strong></p>
            <input name="sitio" type="text" class="form-control" placeholder="Sólo si tiene" value="<?= $empresa[0]->sitio_empresa;?>" />
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-4 col-sm-4 col-xs-12">
            <p><strong>Medios de pago</strong></p>
            <?php foreach($pagos as $p){
              $tiene = $this->functions->tienePago($p->id_medio_pago, $empresa[0]->id_empresa);
              if($tiene == 0){ $checked = ''; } else { $checked = 'checked'; }
              ?>
              <input type="checkbox" <?= $checked;?> name="pagos[]" value="<?= $p->id_medio_pago;?>"> <?= $p->nombre_medio_pago;?><br>
            <?php } ?>
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <p><strong>Despacho a domicilio(*)</strong></p>
            <input type="radio" name="despacho" value="Si" checked>
            Si<br>
            <input type="radio" name="despacho" value="No">
            No </div>
          <div class="form-group col-lg-12 col-xs-12">
            <p><strong>Descripción Microempresa</strong></p>
            <textarea name="descripcion" class="form-control" rows="6"><?= $empresa[0]->descripcion_empresa;?></textarea>
          </div>
          <div class="clearfix"></div>
          <br>

          <div class="clearfix"></div>
          <!--<div class="form-group col-md-2"> <a href="detalle-microempresario.php" class="btn btn-info  col-md-12">Vista Previa</a> </div>-->
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <input type="checkbox" name="terminos" checked>
            Acepto Políticas y Términos del Sitio<br>
          </div>
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger col-sm-6" value="Guardar" />
          </div>
        </form>
        <br>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <p><small><a href="<?= base_url();?>politicas">Ver Políticas de Privacidad y Confidencialidad de Información</a></small> y <small><a href="<?= base_url();?>terminos">Términos y Condiciones de Uso del Sitio</a></small></small><br>
            <br>
          </p>
        </div>
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

      subcategorias = [];


      $('#categoria').on('change', function(){
          subcategorias = [];
          var categoria = $(this).find('option:selected').val();
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/subcategoriasPorCategoria',
            data:{categoria:categoria},
            success: function(res){
              $('#subcategorias').empty().html(res);
              $('#sub_subcategorias').empty();
            }
          });
      });


      $('input.subcategoria:checkbox:checked').each(function(){
          subcategorias.push($(this).val());
      });

      $(document).on('click', '.subcategoria', function(){
          valor = $(this).val();
          if($(this).prop('checked')){
            subcategorias.push(valor);
          } else {
            var index = $.inArray(valor, subcategorias);
            if(index != -1){
              subcategorias.splice(index, 1);
            }
          }

          if(subcategorias.length > 0){
            cargarSub_Subcategorias(subcategorias);
          } else {
            subcategorias = [];
            $('#sub_subcategorias').empty();
          }


      });


      function cargarSub_Subcategorias(subcategorias)
      {
          id_empresa = $('#id_empresa').attr('data-id');
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/sub_subcategoriasPorSubcategoria_edicion',
            data:{subcategorias:subcategorias, id_empresa:id_empresa},
            success: function(res){
              $('#sub_subcategorias').empty().html(res);
            }
          });

      }

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


  });
</script>