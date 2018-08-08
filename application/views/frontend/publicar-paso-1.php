
<div class="container">
<div class="clearfix"></div>


<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
  <li class="active">Publicar negocio (Paso 1)</li>
</ol>
<br>
</div>

<div class="clearfix=""></div><br><br>

<div class="box-separator">
<div class="col-md-12 col-sm-12">

<h1 class="text-center">Paso 1 de 4</h1><br />

</div>

      
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <input type="text" class="form-control" placeholder="Nombre de fantasia de negocio o servicio (*)" id="empresa"/>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
            <textarea class="form-control" rows="6" placeholder="Descripción negocio o servicio (*)" id="descripcion"></textarea>
      </div>
      
      <div class="clearfix"></div>
      <div class="col-md-6 col-md-push-3">
      <a href="<?= base_url();?>persona" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
      
       <a href="<?= base_url();?>publicar_paso_dos" id="registro" class="btn btn-danger pull-right">Siguiente >></a>
       <br />

       
       
      </div>
    
    <div class="clearfix"></div>
    <br /><br />
</div>

</div>


<script>
  

$(document).ready(function(){


  $(document).on('click', '#registro', function(event){

      localStorage.setItem('empresa', $('#empresa').val());
      localStorage.setItem('descripcion', $('#descripcion').val());

      if($('#empresa').val() == '' || $('#descripcion').val() == ''){
        event.preventDefault();
        swal({ 
           title: 'Complete los campos marcados con *'
          },
          function(){

          });
      }

  });


  if(localStorage.getItem('empresa') !== null){
    $('#empresa').val(localStorage.getItem('empresa'));
  }

  if(localStorage.getItem('descripcion') !== null){
    $('#descripcion').val(localStorage.getItem('descripcion'));
  }

});


</script>