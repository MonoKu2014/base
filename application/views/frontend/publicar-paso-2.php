
<div class="container box-separator">
<div class="clearfix"></div>

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
  <li><a href="<?= base_url();?>publicar_paso_uno">Publicar negocio (Paso 1)</a></li>
  <li class="active">Publicar negocio (Paso 2)</li>
</ol>
<br>
</div>

<div class="clearfix=""></div><br><br>

<div class="box-separator">
<div class="col-md-12 col-sm-12">

<h1 class="text-center">Paso 2 de 4 | Clasificación de tu Negocio</h1><br />

</div>


      <div class="clearfix"></div><br>
      
      <div class="form-group col-md-4 col-sm-12 col-xs-12">
      <p><strong>Selecciona un Tipo de Negocio (*)</strong></p>
          <select class="form-control" id="categoria">
            <option value="">Seleccione..</option>
            <?php foreach($this->functions->listarCategorias() as $c){ ?>
                <option value="<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></option>
            <?php } ?>
          </select>
      </div>
      
      <div class="form-group col-md-4 col-sm-12 col-xs-12">
      <p><strong>Selecciona un o más sector</strong></p>
        <div id="subcategorias"></div>
      </div>

      <div class="form-group col-md-4 col-sm-12 col-xs-12">
      <p><strong>Selecciona uno o más tipos de Productos y Servicios</strong></p>
        <div id="sub_subcategorias"></div>
      </div>
      
      
      <div class="clearfix"></div>
      <br>
      <div class="form-group col-md-4 col-sm-12 col-xs-12">
      <p><strong>Selecciona con o sin despacho a domicilio (*)</strong></p>
          <select class="form-control" id="despacho">
              <option value="">Seleccione..</option>
              <option value="Si">Si</option>
              <option value="No">No</option>

            </select>
      </div>
       <div class="clearfix"></div>
      
      <div class="col-md-6 col-md-push-4"><br />
      <a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
      
       <a href="<?= base_url();?>publicar_paso_tres" id="registro" class="btn btn-danger pull-right">Siguiente >></a>
      </div>
    
    <div class="clearfix"></div>
    <br /><br />
</div>

</div>


<script>
  

      var subcatsIDs = [];
      var sub_subcatsIDs = [];
      var subcategorias = [];

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
              if(localStorage.getItem('sub_subcategorias') != ''){
                sub_subcats = localStorage.getItem('sub_subcategorias');
                sub_splits = sub_subcats.split(',');
                for(x = 0; x < sub_splits.length; x++){
                  $('#sub_subcat-' + sub_splits[x]).prop('checked', 'checked');
                }
              }
            }
          });
      
      }



$(document).ready(function(){


    $(document).on('click', '#registro', function(event){

        localStorage.setItem('categoria', $('#categoria').find('option:selected').val());
        localStorage.setItem('despacho', $('#despacho').find('option:selected').val());

        var subcatsIDs = $('.subcategoria:checkbox:checked').map(function(){
            return this.value;
        }).toArray();

        localStorage.setItem('subcategorias', subcatsIDs);

        var sub_subcatsIDs = $('.sub_subcategoria:checkbox:checked').map(function(){
            return this.value;
        }).toArray();

        localStorage.setItem('sub_subcategorias', sub_subcatsIDs);

        if($('#categoria').val() == '' || $('#despacho').val() == ''){
          event.preventDefault();
          swal({ 
             title: 'Complete los campos marcados con *'
            },
            function(){

            });
        }


    });




  if(localStorage.getItem('categoria') !== null){
    $('#categoria').val(localStorage.getItem('categoria'));
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/subcategoriasPorCategoria',
        data:{categoria:localStorage.getItem('categoria')},
        success: function(res){
          $('#subcategorias').empty().html(res);


          if(localStorage.getItem('subcategorias') != ''){
            subcats = localStorage.getItem('subcategorias');
            splits = subcats.split(',');
            for(x = 0; x < splits.length; x++){
              $('#subcat-' + splits[x]).prop('checked', 'checked');
            }
            subcategorias = splits;
            cargarSub_Subcategorias(splits);
          }

        }
      });


  }


  if(localStorage.getItem('despacho') !== null){
    $('#despacho').val(localStorage.getItem('despacho'));
  }


});




</script>