<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Login</li>
      </ol>
      <br>

      <div class="box-separator">
      <div class="col-sm-4 col-sm-push-4">
        <div class="col-sm-12">
          <h1>Ingresar</h1>
        </div>
        <form method="POST" action="<?= base_url();?>registro/ingresar_cuenta">

          <div class="clearfix"></div><br>

        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Email</strong></p>
            <input name="email" type="text" class="form-control datos" id="usuario" placeholder="Ingrese su correo" required />
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Contraseña</strong></p>
            <input name="password" type="password" class="form-control datos" id="contraseña" placeholder="Ingrese su contraseña" required />
          </div>
          <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-info col-xs-12" value="Ingresar"  />
          </div>
        </form>
        <div class="clearfix"></div>
        <p><small>¿Olvidaste tu contraseña? <a href="<?= base_url();?>registro/recuerda_password">Recupérala aquí</a></small></p>
        <br>
        <h2>¿No estás registrado?, <a class="orange" href="<?= base_url();?>registro_paso_uno">Incríbete Aquí</a></h2>
        <br>
      </div>

        <div class="clearfix"></div>
        </div>

    </div>
  </div>

  <!-- Fin Row -->

</div>
