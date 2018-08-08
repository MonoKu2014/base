<div class="container">
  <div class="col-md-12">

<ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>rse/listado_empresas">Listado Empresa RSE</a></li>
        <li><a href="<?= base_url();?>rse/perfil_rse/<?= $empresa->id_empresa;?>">Perfil RSE <?= $empresa->nombre_empresa;?></a></li>
        <li class="active">Solicitud de Alianza</li>
</ol>
<br>


      <div class="box-separator col-sm-12">
      <h1 class="gray titulo-int">Solicitud de Alianza para RSE <?= $empresa->nombre_empresa;?></h1>
      <p>Los campos marcados con (*) son de caracter obligatorio</p>
      <div class="row"><br>

        <div class="col-lg-12">
        <?= $this->session->flashdata('mensaje');?>
        </div>

        <?php if (! $this->session->id): ?>
            <div class="col-lg-12">
            <div class="col-lg-12 alert alert-info">
                Inicia sesión para poder enviar una solicitud de alianza
            </div>
            </div>
        <?php endif ?>

        <form method="POST" action="<?= base_url();?>rse/guardar_convenio" enctype="multipart/form-data">

        <input type="hidden" name="id_empresa" value="<?= $empresa->id_empresa;?>">

        <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Selecciona tu empresa para la alianza (*)</strong></p>
            <select class="form-control" name="empresa" required>
            <?php foreach ($mis_empresas as $e): ?>
              <option value="<?= $e->id_empresa;?>"><?= $e->nombre_empresa;?></option>
            <?php endforeach ?>
            </select>
        </div>


        <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Título de la Alianza (*)</strong></p>
            <input name="titulo" type="text" class="form-control" required />
        </div>

        <div class="clearfix"></div>

        <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Descuento ofrecido para la Alianza (*)</strong></p>
            <select name="descuento" required class="form-control">
                <option value="">Selecciona...</option>
                <option value="10">10%</option>
                <option value="20">20%</option>
                <option value="30">30%</option>
                <option value="40">40%</option>
                <option value="50">50%</option>
                <option value="60">60%</option>
                <option value="70">70%</option>
                <option value="80">80%</option>
                <option value="90">90%</option>
            </select>
        </div>

        <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Descripción de la Alianza (*)</strong></p>
            <textarea class="form-control" required name="descripcion"></textarea>
        </div>

        <div class="clearfix"></div>

        <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger" value="Enviar Ofrecimiento de Alianza"  />
        </div>

        </form>
        <br>

      </div>
      </div>
  </div>

  <!-- Fin Row -->

</div>

<!-- Fin Container -->

</div>