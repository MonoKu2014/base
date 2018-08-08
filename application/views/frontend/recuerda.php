<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Recuerda tu contraseña</li>
      </ol>
      <hr>

      <div class="col-sm-6 col-sm-push-3">
        <div class="col-sm-12">
          <h1>Formulario para recordar contraseña</h1>
        </div>
        <form method="POST" action="<?= base_url();?>registro/envia_password">

          <div class="clearfix"></div><br>

        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>Si no recuerdas tu clave, ingresa tu correo electrónico registrado y te enviaremos un correo con la contraseña que tienes registrada.
            </p>
          </div>


          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Ingresa tu correo</strong></p>
            <input type="email" name="email" required class="form-control">
          </div>

          <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-info col-xs-12" value="Enviar" />
          </div>
        </form>
        <div class="clearfix"></div>

      </div>

        <div class="clearfix"></div>

        <br><br><br><br>

    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>
