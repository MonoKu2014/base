<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li class="active">Cerrar cuenta</li>
      </ol>
      <br>

      <div class="box-separator col-sm-12">
      <h1 class="gray titulo-int">Desactivar cuenta</h1>
      <br>
      <p>¿Seguro que quieres desactivar tu cuenta?
        <br>
        Al desactivar tu cuenta, se desactivará tu perfil y las cuentas de Microempresas
      </p>
      <div class="row"><br>

        <?= $this->session->flashdata('mensaje');?>

        <form method="POST" action="<?= base_url();?>registro/cierre_cuenta">

          <div class="form-group col-lg-12 col-sm-12 col-xs-12">

            <div class="form-group">
             <p><strong></strong></p>
             <input type="radio" name="tipo" value="1" checked> Desactivar cuenta (podrás volver a activar tu cuenta y tener tu perfil y Microempresas tal como las dejaste)<br>
             <input type="radio" name="tipo" value="2"> Eliminar cuenta (Eliminaremos tus datos para siempre, podrás crear una nueva cuenta desde cero siempre y cuando lo desees)
            </div>
            <div class="clearfix"></div>


            <div class="form-group">
             <p><strong>Motivo</strong></p>
             <textarea name="motivo" class="form-control" rows="6" placeholder="Escriba el motivo por el cual desactivará su cuenta"></textarea>
            </div>
            <div class="clearfix"></div>

          <div class="clearfix"></div>
          <div class="row">
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger" value="Enviar"  />
          </div>
          </div>
        </form>
        <br>

      </div>
      </div>
    </div>
  </div>

  <!-- Fin Row -->

</div>

<!-- Fin Container -->

</div>