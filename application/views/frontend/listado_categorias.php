<div class="container">
<div class="row">

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li class="active">listado de categorías</li>
</ol>
<br>

<div class="col-sm-12 box-separator">

  <div class="col-lg-12">
    <h1 class="gray titulo-int">Selecciona una categoría, y tipo de producto o servicio para ver el listado de Microempresarios que ofrece lo que buscas</h1>
  </div>
  <div class="clearfix"></div>
  <br><br>



  <?php foreach($categorias as $k => $c){ ?>
  <div class="row listado-de-categorias">


      <h3 class="c-listado">
          <i class="fa fa-plus down-up" style="cursor: pointer;" data-id="<?= $c->id_categoria;?>"></i>

          &nbsp;
          <a href="<?= base_url();?>microempresarios/1/<?= $c->id_categoria;?>">
            <?= $c->nombre_categoria;?>
          </a>
      </h3>

      <?php $subcategorias = $this->functions->subcategoriasPorCategoria($c->id_categoria);?>

      <div class="col-lg-12" style="display: none;" id="cat-<?= $c->id_categoria;?>">

        <?php foreach($subcategorias as $i => $sc){ ?>

        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 contenido-categorias">
            <span class="sc-listado"><a href="<?= base_url();?>microempresarios/2/<?= $sc->id_subcategoria;?>"><?= $sc->nombre_subcategoria;?></a></span>

            <?php $subsubcategorias = $this->functions->sub_subcategoriasPorSubcategoria($sc->id_subcategoria);?>

            <?php foreach($subsubcategorias as $ssc){ ?>
                <div class="col-lg-12 ssc-listado">
                  <a href="<?= base_url();?>microempresarios/3/<?= $ssc->id_sub_subcategoria;?>">
                    <?= $ssc->nombre_sub_subcategoria;?>
                  </a>
                </div>
            <?php } ?>

        </div>


<?php

if($i == 2 || $i == 5 || $i == 8 || $i == 11 || $i == 14 || $i == 17 || $i == 20){
  echo '<div class="col-lg-12 cat-'.$c->id_categoria.'" style="display:none;">
    </div>';
}

?>


        <?php } ?>
      </div>

  </div>
  <?php } ?>

</div>
<br><br>




<div class="clearfix"></div>
<br>
<br>
<br>


</div>

</div>
</div>



<script>

$('.down-up').on('click', function(){
  var ide = $(this).attr('data-id');
  $('#cat-'+ide).slideToggle();
  $('.cat-'+ide).slideToggle();
});










</script>