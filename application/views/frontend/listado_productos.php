<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>microempresarios/<?= $tipo;?>/<?= $madre;?>">Microempresa(rios)</a></li>
        <li><a href="<?= base_url();?>microempresarios/detalle/<?= $tipo;?>/<?= $id_empresa;?>/<?= $madre;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a></li>
        <li class="active">Listado de productos</li>
      </ol>
      <br>

      <div class="box-separator" style="min-height: 400px;">
          <h1>Listado de Productos de <span style="color: #0dcbab !important;"><?= $this->functions->nombreEmpresa($id_empresa);?></span></h1>


        <div class="divisor"></div>
        <div class="row">

          <?php foreach($productos as $p){ ?>
          <!--producto -->

          <div class="col-md-2 col-sm-3">
          <div class="col-lg-12 thumbnail">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>"><strong><?= $p->nombre_producto;?></strong></a></h3>
            <?php
            $imagen = $this->functions->ImagenPrincipalProducto($p->id_producto);
              if($imagen == ''){ ?>
                <a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= PRODUCTOS_EMPRESA_PATH.$imagen;?>" alt="">
                </a>
            <?php } ?>
            <p><strong>$<?= $this->functions->moneda($p->precio_producto);?></strong></p>
            <p><a href="<?= base_url();?>microempresarios/producto/<?= $tipo;?>/<?= $madre;?>/<?= $id_empresa;?>/<?= $p->id_producto;?>">Ver detalle</a></p>
          </div>
          </div>

          <!--fin producto -->
          <hr class="visible-xs">
          <?php } ?>

        </div>

      <!--fin seccion productos -->



        <div class="clearfix"></div>

        </div>

      <div class="col-sm-12 box-separator">
        <h2 class="orange">Otros microempresa(rios) de la zona</h2>
        <div class="divisor"></div>
        <div class="row">


          <?php foreach ($otras_empresas as $e){?>
          <!--microempresasio -->

          <div class="col-md-3 col-sm-3 psmall">
          <div class="col-lg-12 thumbnail">
            <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
              <?php if($e->imagen_empresa == ''){ ?>
                  <img class="img-responsive portfolio-item gris" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="">
              <?php } else { ?>
                  <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>" alt="">
              <?php } ?>
            </a>
            <p><small><?= $e->nombre_categoria;?></small></p>
            <h3 class="margin-title"><a class="orange" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <p>
              <?= $this->functions->texto_general(3);?> <?= $e->region_empresa;?>,
              <?= $this->functions->texto_general(4);?> de <?= $e->comuna_empresa;?>,
              <?= $e->calle_empresa;?>
              <?= $e->numero_calle_empresa;?>
            </p>
          </div>
          </div>

          <!--fin microempresario -->
          <hr class="visible-xs">
          <?php } ?>

        </div>
      </div>

    </div>
  </div>

  <!-- Fin Row -->

</div>
