<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Publique Microempresa</li>
      </ol>
      <hr>
      <h1 class="gray titulo-int">Publique su Microempresa</h1>
        <br>
        <form role="form" method="POST" action="<?= base_url();?>microempresarios/guarda_microempresario">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <p>
              <strong>Nombre de fantasía del negocio</strong>
              <span id="mensaje-empresa"></span>
            </p>
            <input name="nombre_fantasia" id="nombre_fantasia" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Tipo de Microempresa</strong></p>
            <select id="categoria" name="categoria" class="form-control" required>
              <option value="">Seleccione..</option>
              <?php foreach($categorias as $c){ ?>
                  <option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Subcategorías de su Microempresa</strong></p>
            <div id="subcategorias"></div>
          </div>
          
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Seleccione Productos y Servicios ofrecidos por su Microempresa </strong></p>           
            <div id="sub_subcategorias"></div>
          </div>
         
          <div class="clearfix"></div>
         <div class="col-lg-12">
         <br>
           <img src="<?= IMAGES_PATH;?>divisor-puntos.jpg" class="img-responsive" alt="divisor">
         <br>
         </div>


          <div class="form-group col-md-12 col-sm-12 col-xs-12">
           <p><strong>Días y horario de atención</strong></p>
           
<div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Lunes</div>
    <div class="col-md-4">
     <input name="lunes-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="lunes-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
    <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Martes</div>
    <div class="col-md-4">
     <input name="martes-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="martes-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
       <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Miércoles</div>
    <div class="col-md-4">
     <input name="miercoles-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="miercoles-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
       <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Jueves</div>
    <div class="col-md-4">
     <input name="jueves-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="jueves-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
       <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Viernes</div>
    <div class="col-md-4">
     <input name="viernes-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="viernes-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
       <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Sábado</div>
    <div class="col-md-4">
     <input name="sabado-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="sabado-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>
    
       <div class="col-md-5">
  <div class="col-md-4"><input type="checkbox"> Domingo</div>
    <div class="col-md-4">
     <input name="domingo-desde" type="time" class="form-control col-md-3" placeholder="Hora desde"/></div>
    <div class="col-md-4">
     <input name="domingo-hasta" type="time" class="form-control col-md-3" placeholder="Hora hasta"/>    </div>
  </div>
    <div class="clearfix"></div><br>          
           
        
          </div>
          
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Nombre Dueño</strong></p>
            <input name="nombre_dueno" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Apellido Dueño</strong></p>
            <input name="apellido_dueno" type="text" class="form-control" required />
          </div>
          
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>RUT Microempresa o RUT del Dueño</strong></p>
            <input name="rut" type="text" class="form-control" required placeholder="Uso interno para verificar la veracidad de la información" />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Región</strong></p>
            <select class="form-control" name="region" id="region" required>
              <option value="">Seleccione..</option>
              <?php foreach($regiones as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Comuna</strong></p>
            <select class="form-control" name="comuna" id="comuna" required>
              <option>Seleccione..</option>
            </select>
          </div>
          
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Avenida o calle</strong></p>
            <input name="avenida" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Número</strong></p>
            <input name="numero" type="text" class="form-control" required />
          </div>
          <div class="clearfix"></div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Complemento</strong></p>
            <input name="complemento" type="text" class="form-control" />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Celular</strong></p>
            <input name="celular" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-4 col-sm-12 col-xs-12">
            <p><strong>Teléfono fijo</strong></p>
            <input name="fono" type="text" class="form-control" />
          </div>
          
          <div class="clearfix"></div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>E-mail</strong></p>
            <input name="email" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar E-mail</strong></p>
            <input name="confirma_email" type="text" class="form-control" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Contraseña</strong></p>
            <input name="password" type="password" class="form-control" required />
          </div>
          <div class="form-group col-md-3 col-sm-12 col-xs-12">
            <p><strong>Confirmar Contraseña</strong></p>
            <input name="confirma_password" type="password" class="form-control" required />
          </div>
          <div class="form-group col-md-6 col-sm-12 col-xs-12">
            <p><strong>Sitio Web</strong></p>
            <input name="sitio" type="text" class="form-control" placeholder="Sólo si tiene" />
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
            <input type="radio" name="despacho" value="Si" checked>
            Si<br>
            <input type="radio" name="despacho" value="No">
            No </div>
          <div class="form-group col-lg-12 col-xs-12">
            <p><strong>Descripción Microempresa</strong></p>
            <textarea name="descripcion" class="form-control" rows="6"></textarea>
          </div>
          <div class="clearfix"></div>
          <br>
         
          <div class="clearfix"></div>
          <!--<div class="form-group col-md-2"> <a href="detalle-microempresario.php" class="btn btn-info  col-md-12">Vista Previa</a> </div>-->
          <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <input type="checkbox" name="terminos">
            Acepto Políticas y Términos del Sitio<br>
          </div>
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger col-sm-6" value="Publicar" />
          </div>
        </form>
        <br>
        <div class="clearfix"></div>
        <div class="col-sm-12">
          <p><small><a href="politicas">Ver Políticas de Privacidad y Confidencialidad de Información</a></small> y <small><a href="terminos">Términos y Condiciones de Uso del Sitio</a></small></small><br>
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
      


      $('#nombre_fantasia').on('blur', function(){
          nombre = $(this).val();
          if(nombre.trim() != ''){
            $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/empresaMismoNombre',
              data:{nombre:nombre},
              success: function(res){
                  if(res != 1){
                    swal(res);  
                  }                  
              }
            });            
          }

      });


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


    $(document).on('blur', function(){
        texto = $(this).val();
    });



  });
</script>