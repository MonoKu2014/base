
<div class="container box-separator">
<div class="clearfix"></div><br /><br />

<div class="col-md-12 col-sm-12">

<h1 class="text-center">Área donde trabajas</h1>
<p class="text-center">Para Recomendarte ofertas cerca de donde trabajas (opcional)</p><br />
</div>


      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <select class="form-control" id="region-trabajas">
             <option value="">Selecciona <?= $this->functions->texto_general(3);?> donde trabajas...</option>
              <?php foreach($this->functions->listarRegiones() as $r){ ?>
                <option data-id="<?= $r->id_region;?>" value="<?= $r->nombre_region;?>"><?= $r->nombre_region;?></option>
              <?php } ?>
            </select>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <select class="form-control" id="comuna-trabajas">
              <option value="">Selecciona <?= $this->functions->texto_general(4);?> donde trabajas</option>
            </select>
      </div>

      <div class="clearfix"></div>
      <div class="col-md-6 col-md-push-3">
      <a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>
       <a href="<?= base_url();?>registro_paso_cuatro" id="registro" class="btn btn-danger pull-right">Siguiente >></a><br />
       <a href="<?= base_url();?>registro_paso_cuatro" id="omitir" class="pull-right" style="margin-right:10px;">Omitir este paso</a>
      </div>

     <div class="clearfix"></div>
    <br class="hidden-xs" /><br /><br /></div>



<script>
  $(document).ready(function(){


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


        function cargar_comuna()
        {
          var region = $('#region-trabajas').find('option:selected').attr('data-id');
          $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/comunasPorRegion',
            data:{region:region},
            success: function(res){
              if(localStorage.getItem('region-trabajas') != ''){
                $('#comuna-trabajas').html(res);
                $('#comuna-trabajas').val(localStorage.getItem('comuna-trabajas'));
              }
            }
          });
        }


      $(document).on('click', '#registro', function(event){

          event.preventDefault();
          $(this).prop('disabled', true);
          localStorage.setItem('region-trabajas', $('#region-trabajas').val());
          localStorage.setItem('comuna-trabajas', $('#comuna-trabajas').val());
          localStorage.setItem('region-trabajas-id', $('#region-trabajas').find('option:selected').attr('data-id'));

          if($('#region-trabajas').val() == '' || $('#comuna-trabajas').val() == ''){
            simple_alert('Atención!', 'Completa los campos obligatorios', 'warning');
          } else {
            registrar_persona();
          }


      });


      $(document).on('click', '#omitir', function(event){

          event.preventDefault();

          registrar_persona();


      });


      if(localStorage.getItem('region-trabajas') !== null){
        $('#region-trabajas').val(localStorage.getItem('region-trabajas'));
        cargar_comuna();
      }


      function registrar_persona()
      {

          var nombre         = localStorage.getItem('nombre');
          var email          = localStorage.getItem('email');
          var password       = localStorage.getItem('password');
          var regionvives    = localStorage.getItem('region-vives');
          var comunavives    = localStorage.getItem('comuna-vives');
          var regiontrabajas = localStorage.getItem('region-trabajas');
          var comunatrabajas = localStorage.getItem('comuna-trabajas');

        $.ajax({
            type: 'post',
            url: APP_URL + 'registro/registro_e_inicio',
            data: {
                nombre:nombre,
                email:email,
                password:password,
                regionvives:regionvives,
                comunavives:comunavives,
                regiontrabajas:regiontrabajas,
                comunatrabajas:comunatrabajas
              },
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                  window.location = '<?= base_url();?>' + 'registro_paso_cuatro';
                } else {
                  simple_alert('Atención', res.mensaje, 'warning');
                }
            }
        });


      }



  });
</script>







