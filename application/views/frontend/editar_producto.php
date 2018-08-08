<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>microempresario/<?= $producto[0]->id_empresa;?>">Mi Perfil</a></li>
        <li class="active">Editar Producto</li>
      </ol>
      <br>

      <div class="box-separator">
      <h1 class="gray titulo-int">Editar Producto</h1>
      <div class="row"><br>
        <br>
        <form method="POST" action="<?= base_url();?>microempresarios/guardar_edicion_producto" enctype="multipart/form-data">
          <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>
          <input type="hidden" name="id_producto" value="<?= $producto[0]->id_producto;?>" />
          <input type="hidden" name="id_empresa" value="<?= $producto[0]->id_empresa;?>" />

          <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p><strong>Nombre Producto</strong></p>
            <input name="nombre" type="text" class="form-control" required value="<?= $producto[0]->nombre_producto;?>" />
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Tipo de producto o servicio</strong></p>
             <select name="categoria" class="form-control" required>
                <option value="">Seleccione...</option>
                <?php foreach($sub_subcategorias as $sc){ ?>
                    <?php if ($producto[0]->id_sub_sub_categoria == $sc->id_sub_subcategoria){ ?>
                        <option selected value="<?= $sc->id_sub_subcategoria;?>"><?= $sc->nombre_sub_subcategoria;?></option>
                    <?php } else { ?>
                        <option value="<?= $sc->id_sub_subcategoria;?>"><?= $sc->nombre_sub_subcategoria;?></option>
                    <?php } ?>
                <?php } ?>
             </select>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-lg-2 col-sm-2 col-xs-8">
             <p><strong>Precio</strong></p>
            <input name="precio" type="text" class="form-control" required value="<?= $producto[0]->precio_producto;?>" />
            </div>
             <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Descripción</strong></p>
             <textarea name="descripcion" class="form-control" rows="6" placeholder="Describa su producto"><?= $producto[0]->descripcion_producto;?></textarea>
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Especificación</strong></p>
             <textarea name="especificacion" class="form-control" rows="6" placeholder="Especifique técnicamente su producto"><?= $producto[0]->especificacion_producto;?></textarea>
            </div>
            <div class="clearfix"></div>


            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
             <p><strong>Imágenes actuales</strong></p>
             <?php
              $imagenes = $this->functions->ImagenesProductos($producto[0]->id_producto);
              $resto = 8 - count($imagenes);
              foreach ($imagenes as $k => $v){ ?>
                  <div class="col-lg-2 col-md-3 col-sm-3 col-xs-3 text-center">
                    <img src="<?= PRODUCTOS_EMPRESA_PATH.$v->nombre_imagen;?>" class="img-responsive">
                    <a href="<?= base_url();?>eliminar_imagen_producto/<?= $v->id_producto_imagen;?>">ELIMINAR</a>
                  </div>
              <?php } ?>
            </div>
            <div class="clearfix"></div>



            <div class="form-group col-lg-6 col-sm-12 col-xs-12">
            <p class="help-block">Editar imágenes<br> (quedan un máximo de <?= $resto;?> imágenes para este producto, tamaño sugerido 500 x 300 px)</p>
            <label for="ejemplo_archivo_1">Adjuntar Imagen <i class="fa fa-question-circle" data-toggle="tooltip" title="<?= $help;?>" data-placement="right"></i></label>
            <input type="file" name="imagenes[]" class="multi" accept="gif|jpg|png" maxlength="<?= $resto;?>" title="Máximo <?= $resto;?> imágenes" />
            <br>
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