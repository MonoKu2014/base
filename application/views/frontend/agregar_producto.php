<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li><a href="<?= base_url();?>microempresario/<?= $id_empresa;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a></li>
        <li class="active">Agregar Producto</li>
      </ol>
      <br>

      <div class="box-separator col-sm-12">
      <h1 class="gray titulo-int">Agregar Producto</h1>
      <p>Los campos marcados con (*) son de caracter obligatorio</p>
      <div class="row"><br>

        <?= $this->session->flashdata('mensaje');?>

        <form method="POST" action="<?= base_url();?>microempresarios/guardar_producto/<?= $id_empresa;?>" enctype="multipart/form-data">

          <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Nombre Producto(*)</strong></p>
            <input name="nombre" type="text" class="form-control" required />
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Categoría(*)</strong></p>
             <select name="categoria" class="form-control" required>
                <option value="">Seleccione...</option>
                <?php foreach($sub_subcategorias as $sc){ ?>
                    <option value="<?= $sc->id_sub_subcategoria;?>"><?= $sc->nombre_sub_subcategoria;?></option>
                <?php } ?>
             </select>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-lg-2 col-sm-2 col-xs-8">
             <p><strong>Precio(*)</strong></p>
            <input name="precio" type="text" class="form-control" required />
            </div>
             <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Descripción</strong></p>
             <textarea name="descripcion" class="form-control" rows="6" placeholder="Describa su producto"></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Especificación</strong></p>
             <textarea name="especificacion" class="form-control" rows="6" placeholder="Especifique técnicamente su producto"></textarea>
            </div>
                <div class="clearfix"></div>

            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p class="help-block">Primera imagen será la principal<br> (máximo 8 imágenes por producto, tamaño sugerido 500 x 300 px)(* Mínimo una imagen)</p>
            <label for="ejemplo_archivo_1">Adjuntar Imagen <i class="fa fa-question-circle" data-toggle="tooltip" title="<?= $help;?>" data-placement="right"></i></label>
            <input type="file" name="imagenes[]" class="multi" accept="gif|jpg|png|jpeg" maxlength="8" title="Máximo 8 imágenes" />
            <br>
          <div class="clearfix"></div>
          <br>
          <div class="col-sm-12">
            <hr>
          </div>
          <div class="clearfix"></div>
          <div class="row">
          <div class="form-group col-md-4">
            <input type="submit" class="btn btn-danger" value="Guardar"  />
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