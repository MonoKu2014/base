<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>microempresarios/<?= $tipo;?>/<?= $madre;?>">Microempresa(rios)</a></li>
        <li><a href="<?= base_url();?>microempresarios/detalle/<?= $tipo;?>/<?= $id_empresa;?>/<?= $madre;?>"><?= $this->functions->nombreEmpresa($id_empresa);?></a></li>
        <li class="active">Listado de promociones</li>
      </ol>
      <br>

      <div class="box-separator" style="min-height: 400px;">

          <h1>Listado de Promociones de <span style="color: #0dcbab !important;"><?= $this->functions->nombreEmpresa($id_empresa);?></span></h1>


        <div class="divisor"></div>
        <div class="row">

          <?php foreach ($promociones as $p) { ?>
          <!--promocion -->

          <div class="col-md-2 col-sm-3">
              <div class="col-lg-12 thumbnail">
                <?php
                  if($p['imagen'] == ''){ ?>
                      <a href="<?= $p['href'];?>">
                        <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="Imagen promocion"><br class="visible-xs">
                      </a>
                <?php } else { ?>
                      <a href="<?= $p['href'];?>">
                        <img class="img-responsive portfolio-item" src="<?= $p['imagen'];?>" alt="Imagen promocion"><br class="visible-xs">
                      </a>
                <?php } ?>
                <br>
                <p>
                    <a href="<?= $p['href'];?>" class="orange"><?= $p['nombre'];?></a><br>
                </p>
                <p class="text-center">
                <a class="text-center promociones-pre" style="color:#fff !important;background: <?= $p['color'];?>" href="<?= $p['href'];?>"><?= $p['promocion'];?></a>
                </p>
              </div>
          </div>

          <!--fin promocion -->
          <hr class="visible-xs">
          <?php } ?>

        </div>

      <!--fin seccion servicios -->



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
