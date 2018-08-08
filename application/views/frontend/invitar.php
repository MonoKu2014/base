<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi perfil</a></li>
        <li class="active">Invitar</li>
      </ol>
      <br>

      <div class="box-separator col-lg-12 row">
      <div class="col-sm-6 col-sm-push-3">
        <div class="col-sm-12">
          <h1>Formulario de Invitación</h1>
        </div>
        <form method="POST" action="<?= base_url();?>welcome/enviar_invitaciones">

          <div class="clearfix"></div><br>

        <div class="col-md-12"><?= $this->session->flashdata('mensaje');?></div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p>Use este formulario para ingresar invitaciones que serán enviadas por correo electrónico.<br>
            Puede ingresar máximo 10 correos. si ingresa más de 10, sólo serán enviados hasta llegar a la cantidad máxima, en orden de aparición.
            </p>
          </div>


          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Ingrese los e-mails (debe separarlos por comas, por ejemplo: uno@ejemplo.cl, dos@ejemplo.cl, etc...)</strong></p>
            <div class="clearfix"></div><br>
            <textarea rows="10" name="correos" class="form-control"></textarea>
          </div>

          <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-info col-xs-12" value="Enviar invitaciones" />
          </div>
        </form>
        <div class="clearfix"></div>

      </div>
      </div>

        <div class="clearfix"></div>

    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>
