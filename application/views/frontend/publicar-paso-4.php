<div class="container box-separator">
<div class="clearfix"></div>


<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
  <li><a href="<?= base_url();?>publicar_paso_uno">Publicar negocio (Paso 1)</a></li>
  <li><a href="<?= base_url();?>publicar_paso_dos">Publicar negocio (Paso 2)</a></li>
  <li><a href="<?= base_url();?>publicar_paso_tres">Publicar negocio (Paso 3)</a></li>
  <li class="active">Publicar negocio (Paso 4)</li>
</ol>
<br>
</div>

<div class="clearfix=""></div><br><br>

<div class="box-separator">
<div class="col-md-12 col-sm-12">

<h1 class="text-center">Paso 4 de 4 | Datos de Contacto del Negocio o Servicio</h1><br />

</div>

<div class="form-group col-md-push-4 col-md-4 col-sm-4 col-xs-12">
          <input name="celular" type="number" min="0" data-large="<?= $this->functions->texto_general(6);?>" class="form-control" placeholder="Número Celular (*)" id="celular"/>
        </div>
        <div class="clearfix"></div>

        <div class="form-group col-md-push-4 col-md-4 col-sm-12 col-xs-12">
          <input name="telefono" type="number" min="0" class="form-control" placeholder="Teléfono fijo (opcional)" id="fono"/>
        </div>
        <div class="clearfix"></div>


      <div class="col-md-4 col-md-push-4"><br />
      <a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>

       <a href="#" id="registro" class="btn btn-danger pull-right">Publicar</a>
      </div>

    <div class="clearfix"></div><br />
<br />


    <h2 class="text-center"><strong>Aquí comienza a crecer tu Microempresa!</strong></h2>
    <div class="clearfix"></div><br><br>
</div>


</div>

<script>


$(document).ready(function(){

  var largo = $('#celular').data('large');


  $(document).on('click', '#registro', function(event){

      event.preventDefault();

      localStorage.setItem('fono', $('#fono').val());
      localStorage.setItem('celular', $('#celular').val());

      if($('#celular').val().length != largo){
        swal({
           title: 'Atención!',
           text: 'El número de celular debe tener un largo de ' + largo + ' dígitos',
           type: 'warning'
          },
          function(){

          });
      } else {

          $.ajax({
              type: 'post',
              url: APP_URL + 'ajax/yaExisteEmpresa',
              data: {
                  empresa:localStorage.getItem('empresa'),
                  region:localStorage.getItem('region'),
                  comuna:localStorage.getItem('comuna')
                },
              dataType: 'json',
              success: function(res){
                if(res == 1){
                  swal({
                     title: 'Atención!',
                     text: 'La empresa ingresada ya existe',
                     type: 'warning'
                    },
                    function(){

                    });
                } else {
                  registrar_negocio();
                }
              }
          });
      }

  });


  if(localStorage.getItem('fono') !== null){
    $('#fono').val(localStorage.getItem('fono'));
  }

  if(localStorage.getItem('celular') !== null){
    $('#celular').val(localStorage.getItem('celular'));
  }

      function registrar_negocio()
      {

          var empresa           = localStorage.getItem('empresa');
          var descripcion       = localStorage.getItem('descripcion');
          var categoria         = localStorage.getItem('categoria');
          var subcategorias     = localStorage.getItem('subcategorias');
          var sub_subcategorias = localStorage.getItem('sub_subcategorias');
          var despacho          = localStorage.getItem('despacho');
          var region            = localStorage.getItem('region');
          var comuna            = localStorage.getItem('comuna');
          var avenida           = localStorage.getItem('avenida');
          var numero            = localStorage.getItem('numero');
          var fono              = localStorage.getItem('fono');
          var celular           = localStorage.getItem('celular');

        $.ajax({
            type: 'post',
            url: APP_URL + 'microempresarios/guarda_microempresario',
            data: {
                empresa:empresa,
                descripcion:descripcion,
                categoria:categoria,
                subcategorias:subcategorias,
                sub_subcategorias:sub_subcategorias,
                despacho:despacho,
                region:region,
                comuna:comuna,
                avenida:avenida,
                numero:numero,
                fono:fono,
                celular:celular
              },
            dataType: 'json',
            success: function(res){
                if(res.estado == 0){
                    swal({
                       title: 'Perfecto!',
                       text: res.mensaje,
                       type:'success'
                      },
                      function(){
                        localStorage.clear();
                        window.location = '<?= base_url();?>' + 'persona';
                    });

                } else {
                  simple_alert('Atención!', res.mensaje, 'warning');
                }
            }
        });


      }




});


</script>