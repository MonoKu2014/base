<div class="container box-separator">
<div class="clearfix"></div><br /><br />

<div class="col-md-12 col-sm-12">

<h1 class="text-center">Área donde Vives</h1>
<p class="text-center">Para Recomendarte ofertas cerca de donde Vives</p><br />
</div>


      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <select class="form-control" id="region-vives">
             <option value="">Selecciona tu <?= $this->functions->texto_general(3);?>...</option>
              <?php foreach($this->functions->listarRegiones() as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <select class="form-control" id="comuna-vives">
              <option value="">Selecciona tu <?= $this->functions->texto_general(4);?>...</option>
            </select>
      </div>

      <div class="clearfix"></div>
      <div class="col-md-6 col-md-push-3"><br />
<a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>

       <a href="<?= base_url();?>registro_paso_tres" id="registro" class="btn btn-danger pull-right">Siguiente >></a>
      </div>

     <div class="clearfix"></div>
    <br class="hidden-xs" /><br><br>
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


    function cargar_comuna()
    {
      var region = $('#region-vives').find('option:selected').attr('data-id');
      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegion',
        data:{region:region},
        success: function(res){
          $('#comuna-vives').html(res);
          $('#comuna-vives').val(localStorage.getItem('comuna-vives'));
        }
      });
    }


  $(document).on('click', '#registro', function(){

      localStorage.setItem('region-vives', $('#region-vives').val());
      localStorage.setItem('comuna-vives', $('#comuna-vives').val());
      localStorage.setItem('region-vives-id', $('#region-vives').find('option:selected').attr('data-id'));

      if($('#region-vives').val() == '' || $('#comuna-vives').val() == ''){
        event.preventDefault();
        simple_alert('Atención', 'Complete todos los campos del formulario de registro', 'warning');
      }


  });


  if(localStorage.getItem('region-vives') !== null){
    $('#region-vives').val(localStorage.getItem('region-vives'));
    cargar_comuna();
  }




  });
</script>