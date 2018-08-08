<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="./">Inicio</a></li>
        <li class="active">Publicar Microempresa(io)</li>
      </ol>
      <hr>
      <h1 class="gray titulo-int">Publicar Microempresa(rio)</h1>
      <div class="row"><br>
        <br>
        <form role="form" method="POST" action="<?= base_url();?>microempresarios/guardar_publica_tercero">
          <div class="clearfix"></div>
          <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
          <br>
          <div class="col-sm-12">
            <h2><strong>Datos de quien publica</strong></h2>
          </div>

          <?php if(count($cliente) > 0){ ?>
            <div class="col-lg-12"><p>Tus datos son pre cargados en el formulario de acuerdo a tu sesión activa.</p></div>
           <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Nombre(*)</strong></p>
            <input name="nombre" type="text" class="form-control" id="nombre" value="<?= $cliente[0]->nombre_cliente;?>" disabled />
          </div>
        
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde vives(*)</strong></p>
            <select class="form-control" name="region-vives" id="region-vives" disabled>
              <option value="<?= $cliente[0]->region_cliente;?>"><?= $cliente[0]->region_cliente;?></option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde vives(*)</strong></p>
            <select class="form-control" name="comuna-vives" id="comuna-vives" disabled>
              <option value="<?= $cliente[0]->comuna_cliente;?>"><?= $cliente[0]->comuna_cliente;?></option>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde trabajas(*)</strong></p>
            <select class="form-control" name="region" id="region" disabled>
              <option value="<?= $cliente[0]->region_trabajo_cliente;?>"><?= $cliente[0]->region_trabajo_cliente;?></option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde trabajas(*)</strong></p>
            <select class="form-control" name="comuna" id="comuna" disabled>
              <option value="<?= $cliente[0]->comuna_trabajo_cliente;?>"><?= $cliente[0]->comuna_trabajo_cliente;?></option>
            </select>
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Teléfono móvil o WhatsApp(*)</strong></p>
            <input name="fono" type="text" class="form-control" id="telefono" value="<?= $cliente[0]->fono_cliente;?>" disabled />
          </div>
         
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail(*)</strong></p>
            <input name="email" type="text" class="form-control" id="email" value="<?= $cliente[0]->email_cliente;?>" disabled />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar E-mail(*)</strong></p>
            <input name="email-dos" type="text" class="form-control" id="confirma-email" value="<?= $cliente[0]->email_cliente;?>" disabled />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Contraseña(*)</strong></p>
            <input name="password" type="password" class="form-control" id="email" value="<?= $cliente[0]->password_cliente;?>" disabled />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar Contraseña(*)</strong></p>
            <input name="password-dos" type="password" class="form-control" id="confirma-email" value="<?= $cliente[0]->password_cliente;?>" disabled />
          </div>
          <input type="hidden" name="debo_guardar" value="0">
          <?php } else { ?>

           <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Nombre(*)</strong></p>
            <input name="nombre" type="text" class="form-control" id="nombre" />
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Apellido(*)</strong></p>
            <input name="apellido" type="text" class="form-control" id="rut" placeholder="apellido" />
          </div>         
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde vives(*)</strong></p>
            <select class="form-control" name="region-vives" id="region-vives" required>
              <option value="">Seleccione..</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde vives(*)</strong></p>
            <select class="form-control" name="comuna-vives" id="comuna-vives" required>
              <option>Seleccione..</option>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?> donde trabajas(*)</strong></p>
            <select class="form-control" name="region" id="region" required>
              <option value="">Seleccione..</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?> donde trabajas(*)</strong></p>
            <select class="form-control" name="comuna" id="comuna" required>
              <option>Seleccione..</option>
            </select>
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Teléfono móvil o WhatsApp(*)</strong></p>
            <input name="fono" type="text" class="form-control" id="telefono"/>
          </div>
         
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail(*)</strong></p>
            <input name="email" type="text" class="form-control" id="email" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar E-mail(*)</strong></p>
            <input name="email-dos" type="text" class="form-control" id="confirma-email" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Contraseña(*)</strong></p>
            <input name="password" type="password" class="form-control" id="email" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar Contraseña(*)</strong></p>
            <input name="password-dos" type="password" class="form-control" id="confirma-email" />
          </div>
          <input type="hidden" name="debo_guardar" value="1">
          <?php } ?>


          <div class="clearfix"></div>
          <br>
          <br>
          <div class="col-sm-12">
            <h2><strong>Datos Microempresa(rio)</strong></h2>
          </div>
         <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <p><strong>Nombre de fantasía del negocio(*)</strong></p>
            <input name="nombre-fantasia" type="text" class="form-control" id="nombre-fantasia"/>
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Sector Negocios y Servicios(*)</strong></p>
            <select id="categoria" name="categoria" class="form-control" required>
              <option value="">Seleccione..</option>
              <?php foreach($categorias as $c){ ?>
                  <option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Tipos de Negocios y Servicios</strong></p>
              <div id="subcategorias"></div>
          </div>
          
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Productos y Servicios</strong></p>
            <div id="sub_subcategorias"></div>
          </div>
          
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(3);?>(*)(*)</strong></p>
            <select class="form-control" name="region-empresa" id="region-empresa" required>
              <option value="">Seleccione..</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong><?= $this->functions->texto_general(4);?>(*)(*)</strong></p>
            <select class="form-control" name="comuna-empresa" id="comuna-empresa" required>
              <option>Seleccione..</option>
            </select>
          </div>
          
           <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Avenida o calle(*)</strong></p>
            <input name="calle" type="text" class="form-control" id="Avenida"/>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Número(*)</strong></p>
            <input name="numero" type="text" class="form-control" id="numero"/>
          </div>
          
          <div class="clearfix"></div>
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Complemento</strong></p>
            <input name="complemento" type="text" class="form-control" id="complemento"/>
          </div>
          
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Teléfono Celular Microempresa(rio) (Sólo si tiene)</strong></p>
            <input name="celular" type="text" class="form-control" id="celular" />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Teléfono Fijo Microempresa(rio) (Sólo si tiene)</strong></p>
            <input name="fono-empresa" type="text" class="form-control" id="telefono"/>
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail Microempresa(rio) (Sólo si tiene)</strong></p>
            <input name="email-contacto" type="text" class="form-control" id="email" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar E-mail</strong></p>
            <input name="email-contacto-dos" type="text" class="form-control" id="confirma-email" />
          </div>
          
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Sitio Web (Sólo si tiene)</strong></p>
            <input name="sitio" type="text" class="form-control" id="sitioweb" placeholder="Sólo si tiene" />
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-4 col-sm-4 col-xs-12">
            <p><strong>Medios de pago</strong></p>
            <?php foreach($pagos as $p){ ?>
              <input type="checkbox" name="pagos[]" value="<?= $p->id_medio_pago;?>"> <?= $p->nombre_medio_pago;?><br>
            <?php } ?>
          </div>
          <div class="form-group col-lg-4 col-xs-12">
            <p><strong>Despacho a domicilio</strong></p>
            <input type="radio" name="despacho" id="si" value="Si">
            Si<br>
            <input type="radio" name="despacho" id="no" value="No" checked>
            No </div>
          <div class="form-group col-lg-12 col-xs-12">
            <p><strong>Descripción Microempresa(rio)</strong></p>
            <textarea name="descripcion" class="form-control" rows="6" id="Comentario"></textarea>
          </div>
          <div class="clearfix"></div>
          <br>

          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <input type="checkbox" aria-label="..." checked>
            Acepto Políticas y Términos del Sitio<br>
          </div>
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger col-sm-6" value="Publicar"  />
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

<!-- Fin Container -->

<script>
  $(document).ready(function(){
      

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

          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/sub_subcategoriasPorSubcategoria',
            data:{subcategorias:subcategorias},
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


    $(document).on('blur', function(){
        texto = $(this).val();
    });



  });
</script>