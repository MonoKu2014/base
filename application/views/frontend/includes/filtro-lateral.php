<div class="col-md-3" id="lateral-filter" style="padding-left: 0;">
<div class="box-separator">

        <p><strong style="color: #333;">Afina tu búsqueda:</strong></p>

        <?php
          foreach($filtros as $k => $f){
            if($f != ''){
            ?>
            <p class="etiqueta-filtro"><?= $f;?> <b><i style="cursor: pointer;" data-href="<?= str_replace($k, '', $url);?>" class="fa fa-remove delete-label"></i></b></p><br>
        <?php } } ?>

        <hr>


        <?php if($existe_filtro_r == 0){?>
            <p><strong><?= $this->functions->texto_general(3);?></strong></p>

            <select name="" id="region_selector" class="form-control filter">
              <option value="">Seleccione...</option>

            <?php foreach($this->functions->listarRegiones() as $r){
              $cantidad = $this->functions->cantidadEmpresasPorRegion($r->nombre_region, $id_categoria);
              if($cantidad > 0){
              ?>
                <option value="<?= $url;?>r=<?= $r->nombre_region;?>"><?= $r->nombre_region;?> (<?= $cantidad;?>)</option>
            <?php } } ?>

            </select>
            <br>

        <?php } ?>

      


        <?php if($existe_filtro_c == 0){?>
            <p><strong><?= $this->functions->texto_general(4);?></strong></p>

            <select name="" id="comuna_selector" class="form-control filter">
              <option value="">Seleccione...</option>
            <?php foreach($this->functions->listarComunasFiltroLateralRegion($nombre_region) as $c){
              $cantidad = $this->functions->cantidadEmpresasPorComuna($c->nombre_comuna, $id_categoria);
              if($cantidad > 0){
              ?>
                <option value="<?= $url;?>c=<?= $c->nombre_comuna;?>"><?= ucfirst($c->nombre_comuna);?> (<?= $cantidad;?>)</option>
            <?php } } ?>
            </select>
            <br>
        <?php } ?>


        <?php /*if($existe_sc_filtro == 0){?>
            <p><strong>Subcategorías</strong></p>
            <?php
            foreach($subcategorias as $s){
              $cantidad = $this->functions->cantidadEmpresasPorSubcategoria($s->id_subcategoria, $id_categoria);
              if($cantidad > 0){
              ?>
                <a style="font-size: 12px;" href="<?= base_url();?>microempresarios/2/<?= $s->id_subcategoria;?>"><?= $s->nombre_subcategoria;?> <span class="">(<?= $cantidad;?>)</span> </a><br>
            <?php } } ?>
            <br>
        <?php } ?>


        <?php if($existe_ssc_filtro == 0){?>
            <p><strong>Productos o Servicios</strong></p>
            <?php
            foreach($sub_subcategorias as $s){
              $cantidad = $this->functions->cantidadEmpresasPorSubsubcategoria($s->id_sub_subcategoria);
              if($cantidad > 0){
              ?>
                <a style="font-size: 12px;" href="<?= base_url();?>microempresarios/3/<?= $s->id_sub_subcategoria;?>"><?= $s->nombre_sub_subcategoria;?> <span class="">(<?= $cantidad;?>)</span> </a><br>
            <?php } } ?>
            <br>
        <?php }*/ ?>


        <?php if($existe_filtro_d == 0){?>
            <p><strong>Reparto a domicilio</strong></p>

            <select name="" id="comuna_selector" class="form-control filter">
            <option value="">Seleccione...</option>

            <?php
            $cantidad = $this->functions->cantidadEmpresasDespacho('Si', $id_categoria);
            if($cantidad > 0){
            ?>
            <option value="<?= $url;?>d=Si">Con reparto a domicilio (<?= $cantidad; ?>)</option>
            <?php } ?>

            <?php
            $cantidad = $this->functions->cantidadEmpresasDespacho('No', $id_categoria);
            if($cantidad > 0){
            ?>
                <option value="<?= $url;?>d=No">Sin reparto a domicilio (<?= $cantidad; ?>)</option>
            <?php } ?>
        <?php } ?>
            </select>
            <br>

        <a style="color: #fff !important;" href="<?= base_url();?>microempresarios/<?= $tipo;?>/<?= $madre;?>" class="btn btn-default">Reestablecer filtros</a>
        <br><br>

</div>
</div>


<script>

    var subcategorias = [];
    var regiones = [];

    $(document).on('click', '.subcategoria', function(){
      valor = $(this).val();
      if($(this).prop('checked')){
        subcategorias.push(valor);
      } else {
        var index = $.inArray(valor, subcategorias);
        if(index != -1){
          subcategorias.splice(index, 1);
        }
      }

      if(subcategorias.length > 0){
        cargarSub_Subcategorias(subcategorias);
      } else {
        subcategorias = [];
        $('#sub_subcategorias').empty();
      }

    });


    function cargarSub_Subcategorias(subcategorias)
    {

      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/sub_subcategoriasPorSubcategoria',
        data:{subcategorias:subcategorias},
        success: function(res){
          $('#sub_subcategorias').empty().html(res);
        }
      });

    }





    $(document).on('click', '.regiones', function(){
      valor = $(this).val();
      if($(this).prop('checked')){
        regiones.push(valor);
      } else {
        var index = $.inArray(valor, regiones);
        if(index != -1){
          regiones.splice(index, 1);
        }
      }

      if(regiones.length > 0){
        cargarComunas(regiones);
      } else {
        regiones = [];
        $('#carga_comunas').empty();
      }

    });


    function cargarComunas(regiones)
    {

      $.ajax({
        type: 'post',
        url: APP_URL + 'ajax/comunasPorRegionCheckbox',
        data:{regiones:regiones},
        success: function(res){
          $('#carga_comunas').empty().html(res);
        }
      });

    }


    $('.delete-label').on('click', function(){
        window.location.href = $(this).attr('data-href');
    });


    $('.filter').on('change', function(){
        window.location.href = $(this).val();
    });


</script>