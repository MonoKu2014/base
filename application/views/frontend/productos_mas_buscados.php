<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Listado de productos mas buscados</li>
      </ol>
      <br>


        <div class="row box-separator">

        <div class="col-sm-12">
        <h1>Listado de Productos más buscados</h1>
        <br>
        </div>

          <?php foreach($productos as $p){ ?>
          <!--producto -->
          
          <div class="col-md-2 col-sm-3">
          <div class="col-lg-12 thumbnail">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria;?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>"><strong><?= $p->nombre_producto;?></strong></a></h3>
            <?php 
            $imagen = $this->functions->ImagenPrincipalProducto($p->id_producto);
              if($imagen == ''){ ?>
                <a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria;?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria;?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">
                  <img class="img-responsive portfolio-item" src="<?= PRODUCTOS_EMPRESA_PATH.$imagen;?>" alt="">
                </a>
            <?php } ?>
            <p><strong>$<?= $this->functions->moneda($p->precio_producto);?></strong></p>
            <p>
            <small><?= $p->cantidad_vistas;?> vistas</small><br>
            <a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria;?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">Ver detalle</a></p>
          </div>
          </div>
          
          <!--fin producto --> 
          <hr class="visible-xs">
          <?php } ?>
          
        </div>
      
      <!--fin seccion productos --> 



        <div class="clearfix"></div>

        <br><br><br><br>

    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>
