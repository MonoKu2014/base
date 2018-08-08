<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>persona">Mi Perfil</a></li>
        <li><a href="<?= base_url();?>microempresario/<?= $id_empresa;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a>
        <li class="active">Agregar Servicio</li>
      </ol>
      <br>

      <div class="box-separator col-sm-12">
      <h1 class="gray titulo-int">Agregar Servicio</h1>
      <p>Los campos marcados con (*) son de caracter obligatorio</p>
      <div class="row"><br>
        <form method="POST" action="<?= base_url();?>microempresarios/guardar_servicio/<?= $id_empresa;?>" enctype="multipart/form-data">
           <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
          <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Nombre Servicio(*)</strong></p>
            <input name="nombre" type="text" class="form-control" id="nombre" required />
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
            <input name="precio" type="text" class="form-control" id="precio" required />
            </div>
             <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Descripción</strong></p>
             <textarea name="descripcion" class="form-control" rows="6" id="descripcion" placeholder="Describa su servicio"></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Especificación</strong></p>
             <textarea name="especificacion" class="form-control" rows="6" id="especificacion" placeholder="Especifique técnicamente su servicio"></textarea>
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