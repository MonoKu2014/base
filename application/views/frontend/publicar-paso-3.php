
<div class="container box-separator">
<div class="clearfix"></div>



<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
  <li><a href="<?= base_url();?>publicar_paso_uno">Publicar negocio (Paso 1)</a></li>
  <li><a href="<?= base_url();?>publicar_paso_dos">Publicar negocio (Paso 2)</a></li>
  <li class="active">Publicar negocio (Paso 3)</li>
</ol>
<br>
</div>

<div class="clearfix=""></div><br><br>

<div class="box-separator">
<div class="col-md-12 col-sm-12">

<h1 class="text-center">Paso 3 de 4 | Dirección del Negocio o Servicio</h1><br />

</div>

      
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
           <select class="form-control" id="region">
             <option value="">Selecciona <?= $this->functions->texto_general(3);?> del negocio (*)...</option>
              <?php foreach($this->functions->listarRegiones() as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
            <select class="form-control" id="comuna">
                <option value="">Selecciona <?= $this->functions->texto_general(4);?> del negocio (*)...</option>
            </select>
      </div>
       <div class="clearfix"></div>
        <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <input name="Av" type="text" class="form-control" id="avenida" placeholder="Avenida o Calle (*)" id="calle"/>
        </div>
        <div class="clearfix"></div>
        <div class="form-group col-md-push-3 col-md-3 col-sm-4 col-xs-6">
          <input name="numero" type="number" min="0" class="form-control" placeholder="Número (*)" id="numero"/>
        </div>
        <div class="clearfix"></div>
      
      <div class="col-md-6 col-md-push-3"><br />
      <a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
      
       <a href="<?= base_url();?>publicar_paso_cuatro" id="registro" class="btn btn-danger pull-right">Siguiente >></a>
      </div>
    
    <div class="clearfix"></div>
    <br /><br />
</div>

</div>


<script>
  
        $(document).on('click', '#registro', function(event){

            localStorage.setItem('region', $('#region').val());
            localStorage.setItem('comuna', $('#comuna').val());
            localStorage.setItem('region-id', $('#region').find('option:selected').attr('data-id'));
            localStorage.setItem('avenida', $('#avenida').val());
            localStorage.setItem('numero', $('#numero').val());

            if($('#region').val() == '' || $('#comuna').val() == '' || $('#avenida').val() == '' || $('#numero').val() == ''){
              event.preventDefault();
              swal({ 
                 title: 'Complete los campos marcados con *'
                },
                function(){

                });
            }



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


        function cargar_comuna()
        {
          var region = $('#region').find('option:selected').attr('data-id');
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/comunasPorRegion',
            data:{region:region},
            success: function(res){
              if(localStorage.getItem('region') != ''){
                $('#comuna').html(res);
                $('#comuna').val(localStorage.getItem('comuna'));                
              }
            }
          });
        }

        if(localStorage.getItem('region') !== null){
          $('#region').val(localStorage.getItem('region'));
          cargar_comuna();
        }

        if(localStorage.getItem('avenida') !== null){
          $('#avenida').val(localStorage.getItem('avenida'));
        }

        if(localStorage.getItem('numero') !== null){
          $('#numero').val(localStorage.getItem('numero'));
        }


</script>