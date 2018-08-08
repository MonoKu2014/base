
<div class="container box-separator">
<div class="clearfix"></div><br /><br />

<div class="col-md-12 col-sm-12">

<h1 class="text-center">Únete hoy al Portal Microempresarios</h1><br />
</div>


      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
          <input name="Nombre" type="text" class="form-control" placeholder="Tu Nombre Completo" id="nombre"/>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
           <input name="correo" type="text" class="form-control" onfocus="this.removeAttribute('readonly');" readonly placeholder="Correo Electrónico" id="email"/>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-push-3 col-md-6 col-sm-12 col-xs-12">
           <input name="Contrasena" type="password" class="form-control" onfocus="this.removeAttribute('readonly');" readonly placeholder="Elige una contraseña" id="password"/>
      </div>
      <div class="clearfix"></div>
      <div class="col-md-6 col-md-push-3">

     <br />
<a href="javascript:history.back()" class="pull-left"><i class="fa fa-chevron-left" aria-hidden="true"></i> Volver</a>

       <a href="<?= base_url();?>registro_paso_dos" id="registro" class="btn btn-danger pull-right">Siguiente >></a>
      </div>

    <div class="clearfix"></div>
    <br class="hidden-xs" />
    <br><br>
</div>
     <style type="text/css">
        input[readonly] {
            cursor: text !important;
            background-color: #fff !important;
        }
     </style>


<script>


$(document).ready(function(){


  $(document).on('click', '#registro', function(event){

      event.preventDefault();

      localStorage.setItem('nombre', $('#nombre').val());
      localStorage.setItem('email', $('#email').val());
      localStorage.setItem('password', $('#password').val());

      if($('#nombre').val() == '' || $('#email').val() == '' || $('#password').val() == ''){
        simple_alert('Atención!', 'Complete todos los campos del formulario de registro', 'warning');
      } else {
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/yaExisteEmail',
            data: {
                email:$('#email').val()
              },
            dataType: 'json',
            success: function(res){
              if(res == 1){
                swal({
                   title: 'El correo ingresado ya tiene una cuenta registrada'
                  },
                  function(){

                  });
              } else {
                window.location = '<?= base_url();?>registro_paso_dos';
              }
            }
        });

      }

  });


  if(localStorage.getItem('nombre') !== null){
    $('#nombre').val(localStorage.getItem('nombre'));
  }

  if(localStorage.getItem('email') !== null){
    $('#email').val(localStorage.getItem('email'));
  }

  if(localStorage.getItem('password') !== null){
    $('#password').val(localStorage.getItem('password'));
  }


});


</script>