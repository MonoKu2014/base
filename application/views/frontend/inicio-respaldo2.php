
<?php if(!$cliente = $this->session->id){ ?>

  <div class="bg-gray5">
  
  <div class="container">

  <br />
<br />
  <div class="clearfix"></div>
    
     <!--mensajes y buscador -->
    <div class="col-md-6 col-sm-12">
      <h2 class="orange mensajes-home"><strong>+ Fácil</strong></h2> <br class="hidden-xs" />
      <h2 class="orange mensajes-home"><strong>+ Productos y Servicios</strong></h2> <br class="hidden-xs" />
      <h2 class="orange mensajes-home"><strong>+ Promociones</strong></h2>
      <br class="hidden-xs" />
      <br class="hidden-xs" />

      
      <div class="form-group buscador">
        <input class="form-control col-md-8 col-sm-10 col-xs-10" id="search-input" placeholder="¿Qué Buscas?" type="text">
        <a href="#" class="lupa-buscador-button"><span class="glyphicon glyphicon-search lupa-buscador"></span></a> </div>
     <br class="visible-xs" /><br class="visible-xs" />
    </div>
     <!--fin mensajes y buscador -->
     
     <div class="col-md-1 visible-md visible-lg"><img src="<?= IMAGES_PATH;?>divi-vertical.png" class="img-responsive" alt="portal"/></div>
    
    <!--formulario -->
    <div class="col-md-5 col-sm-12">
      <div class="col-md-12"><h2><strong>Regístrarte es Gratis!</strong></h2></div>
      
      <div class="form-group col-md-8 col-sm-12 col-xs-12">
          <input name="nombre" type="text" class="form-control" placeholder="Nombre Completo" id="nombre"/>
      </div>
       <div class="clearfix"></div>
      <div class="form-group col-md-8 col-sm-12 col-xs-12">
           <input name="email" type="text" class="form-control" placeholder="Correo Electrónico" id="email" onfocus="this.removeAttribute('readonly');" readonly/>
      </div>
      <div class="clearfix"></div>
      <div class="form-group col-md-8 col-sm-12 col-xs-12">
           <input name="password" type="password" class="form-control" placeholder="Contraseña" id="password" onfocus="this.removeAttribute('readonly');" readonly />
      </div>
      <div class="clearfix"></div>
      <div class="col-md-8">
       <a href="<?= base_url();?>registro_paso_dos" id="registro" class="btn btn-danger">Registrarte</a>
      </div>
    
    </div>
     <!--fin formulario -->
     <style type="text/css">
        input[readonly] {
            cursor: text !important;
            background-color: #fff !important;
        }
     </style>
    
    
  
  
  <div class="clearfix"></div><br />
<br />


</div></div>
<?php } ?>


<div style="background:#f2f2f2;">
  <div class="container">
  <br />
<br />
  <div class="row">    
    <div class="col-sm-12">
      <h1 class="text-center titulo-principal">Encuentra tu Microempresa(rio)!</h1>
    </div>
    
    <!--categorias y sectores -->
    
    <div class="col-sm-3 col-xs-12 hidden-xs">
      <div class="menu-categorias">
        <div class="titulo-menu">Sectores</div>
        <ul class="flexy-menu">

          <?php foreach($categorias as $c){ ?>
            <li><a href="<?= base_url();?>microempresarios/1/<?= $c->id_categoria;?>"><?= $c->nombre_categoria;?></a></li>
          <?php } ?>
            <li><a href="<?= base_url();?>listado_categorias">Más sectores...</a></li>

        </ul>
      </div>
    </div>
    
    <!--categorias y sectores --> 


    
    <!--Microempresarios para Desk y Tablets-->
    
    <div class="col-sm-6 hidden-xs">
      <div class="menu-categorias">
        <div class="titulo-menu">Tipos de Microempresa(rios)</div>
        <div class="col-sm-6 col-xs-12">
          <ul class="flexy-menu">

          <?php foreach($subcategorias_uno as $sc){ ?>
            <li><a href="<?= base_url();?>microempresarios/2/<?= $sc->id_subcategoria;?>"><?= $sc->nombre_subcategoria;?></a></li>
          <?php } ?>

          </ul>
        </div>


        <div class="col-sm-6 col-xs-12">
          <ul class="flexy-menu">

          <?php foreach($subcategorias_dos as $sc){ ?>
            <li><a href="<?= base_url();?>microempresarios/2/<?= $sc->id_subcategoria;?>"><?= $sc->nombre_subcategoria;?></a></li>
          <?php } ?>
            <li><a href="<?= base_url();?>listado_categorias">Más tipos de microempresa(rios)...</a></li>

          </ul>
        </div>


      </div>
    </div>

  <!-- Fin Microempresarios para Desk y Tablets-->



  <!--Microempresarios para Celulares -->

    <div class="col-xs-12 visible-xs">
      <div class="menu-categorias">
        <div class="titulo-menu">Tipos de Microempresa(rios)</div>
        <div class="col-sm-6 col-xs-12">
          <ul class="flexy-menu">

          <?php foreach($subcategorias_mobile as $sc){ ?>
            <li><a href="<?= base_url();?>microempresarios/2/<?= $sc->id_subcategoria;?>"><?= $sc->nombre_subcategoria;?></a></li>
          <?php } ?>
            <li><a href="<?= base_url();?>listado_categorias">Más tipos de microempresa(rios)...</a></li>

          </ul>
        </div>
      </div>
    </div>

    
    <!-- Fin Microempresarios para Celulares -->


    
    <!--Microempresarios -->
    
    <div class="col-sm-3 col-xs-12 hidden-xs">
      <div class="menu-categorias">
        <div class="titulo-menu">Productos y Servicios</div>
        <ul class="flexy-menu">

          <?php foreach($sub_subcategorias as $ssc){ ?>
            <li><a href="<?= base_url();?>microempresarios/3/<?= $ssc->id_sub_subcategoria;?>"><?= $ssc->nombre_sub_subcategoria;?></a></li>
          <?php } ?>
            <li><a href="<?= base_url();?>listado_categorias">Más productos y servicios...</a></li>

        </ul>
      </div>
    </div>
    
    <!--fin microempresarios --> 
    
  </div>
  
  <!-- Fin Row --> 
  
</div>
</div>

<!-- Fin Container -->

<div class="row bg-gray">
  <div class="container">
    <div class="col-sm-4">
      <h2>Clientes</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>descuento.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>Inscríbete Gratis en el Portal y recibe Ofertas y Promociones de Microempresa(rios) del sector donde vives, tan seguido como desees. También podrás opinar y recomendar Microempresa(rios).<br>
            <br>
          </p>
        </div>
        <div class="col-sm-12"><a href="<?= base_url();?>registro" class="btn btn-info">Regístrate (Personas)</a></div>
      </div>
    </div>
    <hr class="visible-xs">
    <div class="col-sm-4">
      <h2>Juntos crecemos más</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>juntos.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>Ayuda a tus Microempresa(rios) favoritos publicando gratis sus Negocios, Productos y Servicios. Podrías ser recompensado con Productos y Servicios en Agradecimiento por tu gesto.<br>
            <br>
          </p>
        </div>
        <div class="col-sm-12"><a href="<?= base_url();?>publica" class="btn btn-success">Publicar Microempresa(rio) ES GRATIS!</a></div>
      </div>
    </div>
    <hr class="visible-xs">
    <div class="col-sm-4">
      <h2>Microempresa(rios)</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>microempresarios.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>Si eres Microempresario publica gratis tu Negocio, horarios, ubicación o cobertura, Productos y Servicios, y mantén a tus Vecinos y Clientes al tanto de tus precios, Ofertas y Promociones. Te ayudamos a AUMENTAR TUS VENTAS! </p>
        </div>
        <div class="col-sm-12"><a href="<?= base_url();?>publica" class="btn btn-success">Publicar Microempresa(rio) ES GRATIS!</a></div>
      </div>
    </div>
  </div>
</div>
<div class="row bg-gray2">
  <div class="container"> 
    
    <!--productos mas buscados -->
    
    <div class="col-sm-12">
      <h2 class="orange">Productos más buscados</h2>
      <div class="divisor"></div>
      <div class="row"> 
        

        <?php foreach($productos as $p){ ?>
        <!--producto -->
        
        <div class="col-md-2 col-sm-3">
          <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>""><strong><?= $p->nombre_producto;?></strong></a></h3>
              <?php 
              $imagen = $this->functions->ImagenPrincipalProducto($p->id_producto);
                if($imagen == ''){ ?>
                  <a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">
                    <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                  </a>
              <?php } else { ?>
                  <a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">
                    <img class="img-responsive portfolio-item" src="<?= PRODUCTOS_EMPRESA_PATH.$imagen;?>" alt="">
                  </a>
              <?php } ?>
          <p><strong>$<?= $this->functions->moneda($p->precio_producto);?></strong></p>
          <p><a href="<?= base_url();?>microempresarios/producto/3/<?= $p->id_sub_sub_categoria?>/<?= $p->id_empresa;?>/<?= $p->id_producto;?>">Ver detalle</a></p>
        </div>
        
        <!--fin producto --> 
        <hr class="visible-xs">

        <?php } ?>
        
      </div>
    </div>
    
    <!--fin productos mas buscados --> 
    
  </div>
</div>
<div class="row bg-gray3">
  <div class="container"> 
    
    <!--servicios mas buscados -->
    
    <div class="col-sm-12">
      <h2 class="orange">Servicios más buscados</h2>
      <div class="divisor"></div>
      <div class="row"> 
        
                 <?php foreach($servicios as $s){ ?>
          <!--servicio -->
          
          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/servicio/3/<?= $s->id_sub_sub_categoria?>/<?= $s->id_empresa;?>/<?= $s->id_servicio;?>"><strong><?= $s->nombre_servicio;?></strong></a></h3>
            <?php 
            $imagen = $this->functions->ImagenPrincipalServicio($s->id_servicio);
              if($imagen == ''){ ?>
                <a href="<?= base_url();?>microempresarios/servicio/3/<?= $s->id_sub_sub_categoria?>/<?= $s->id_empresa;?>/<?= $s->id_servicio;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>sin-imagen.png" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/servicio/3/<?= $s->id_sub_sub_categoria?>/<?= $s->id_empresa;?>/<?= $s->id_servicio;?>">
                  <img class="img-responsive portfolio-item" src="<?= SERVICIOS_EMPRESA_PATH.$imagen;?>" alt="">
                </a>
            <?php } ?>
            <p><strong>Desde $<?= $this->functions->moneda($s->precio_servicio);?></strong></p>
            <p><a href="<?= base_url();?>microempresarios/servicio/3/<?= $s->id_sub_sub_categoria?>/<?= $s->id_empresa;?>/<?= $s->id_servicio;?>">Ver detalle</a></p>
          </div>
          
          <!--fin servicio --> 
          <hr class="visible-xs">
          <?php } ?>  
        
      </div>
    </div>
    
    <!--fin servicios mas buscados --> 
    
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-9"><br>
      <br>
      <h2 class="orange">Microempresa(rios) más recomendados</h2>
    </div>
    <div class="col-md-3"><br>
      
      <!-- Controls -->
      
      <div class="controls pull-right hidden-xs"> 
        <a class="left fa fa-chevron-left btn btn-success" href="#carousel-example" data-slide="prev" style="padding:5px 10px 4px 9px;;margin: 0 5px;"></a>
        <a class="right fa fa-chevron-right btn btn-success" href="#carousel-example" data-slide="next" style="padding:5px 10px 4px 9px;;margin: 0 5px;"></a>
      </div>
    </div>
  </div>

  <div id="carousel-example" class="carousel slide" data-ride="carousel"> 
    
    <!-- Wrapper for slides -->
    
    <div class="carousel-inner">
      <div class="item active">
        <div class="row"> 
          

          <?php 
          if(count($empresasUno) > 0){
          foreach($empresasUno as $e){ 
            if($e->cantidad > 0){
            ?>
          <!--microempresario -->
          
          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php 
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>perfil-micro.jpg" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>" alt="">
                </a>
            <?php } ?>
            <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">Ver más Información</a></p>
          </div>
          
          <!--fin microempresario --> 
          <hr class="visible-xs">
          <!--microempresario -->         
          <?php }  }  } ?>
          
        </div>
      </div>


      <div class="item">
        <div class="row"> 
          

          <?php 
          if(count($empresasDos) > 0){
          foreach($empresasDos as $e){ 
            if($e->cantidad > 0){
            ?>
          <!--microempresario -->
          
          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php 
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>perfil-micro.jpg" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>" alt="">
                </a>
            <?php } ?>
            <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">Ver más Información</a></p>
          </div>
          
          <!--fin microempresario --> 
          <hr class="visible-xs">
          <!--microempresario -->         
          <?php }  } } ?>
          
        </div>
      </div>



      <div class="item">
        <div class="row"> 
          

          <?php 
          if(count($empresasTres) > 0){
          foreach($empresasTres as $e){ 
            if($e->cantidad > 0){
            ?>
          <!--microempresario -->
          
          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a class="gray" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php 
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>perfil-micro.jpg" alt="">
                </a>
            <?php } else { ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>" alt="">
                </a>
            <?php } ?>
            <p><a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">Ver más Información</a></p>
          </div>
          
          <!--fin microempresario --> 
          <hr class="visible-xs">
          <!--microempresario -->         
          <?php }  } } ?>
          
        </div>
      </div>




    </div>

  </div>
  <br>
  <br>
</div>



<!-- Fin Container -->

<script>
  

$(document).ready(function(){


  $(document).on('click', '#registro', function(event){

      event.preventDefault();

      localStorage.setItem('nombre', $('#nombre').val());
      localStorage.setItem('email', $('#email').val());
      localStorage.setItem('password', $('#password').val());

      if($('#nombre').val() == '' || $('#email').val() == '' || $('#password').val() == ''){
        swal({ 
          title: "Error",
           text: 'Complete todos los campos del formulario de registro',
            type: "error" 
          },
          function(){

          });
      } else {

        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/yaExisteEmail',
            data: {
                email:$('#email').val()
              },
            dataType: 'json',
            success: function(res){
              if(res == 1){
                swal({ 
                  title: "Error",
                   text: 'El correo ingresado ya tiene una cuenta registrada',
                    type: "error" 
                  },
                  function(){

                  });
              } else {
                window.location = '<?= base_url();?>registro_paso_dos';
              }
            }
        });

      }  

  });


  if(localStorage.getItem('nombre') !== null){
    $('#nombre').val(localStorage.getItem('nombre'));
  }

  if(localStorage.getItem('email') !== null){
    $('#email').val(localStorage.getItem('email'));
  }

  if(localStorage.getItem('password') !== null){
    $('#password').val(localStorage.getItem('password'));
  }


});



    $('#search-input').autocomplete({
      source: APP_URL + 'ajax/buscar',
      minLength: 3,
      select: function(event, ui) {
        $(this).val(ui.item.value);
      }
    });

    $('.lupa-buscador-button').on('click', function(event){
        event.preventDefault();
        termino = $('#search-input').val();
        termino = termino.trim();
        if(termino == ''){
          $('#search-input').attr('placeholder', 'Ingrese un término para buscar');
        } else {
          window.location = APP_URL + 'microempresarios/busqueda/' + termino;
        }
    });

    $('#search-input').on('keypress', function(e){
         var code = e.keyCode || e.which;
         if(code == 13) {
            termino = $('#search-input').val();
            termino = termino.trim();
            if(termino == ''){
              $('#search-input').attr('placeholder', 'Ingrese un término para buscar');
            } else {
              window.location = APP_URL + 'microempresarios/busqueda/' + termino;
            }
         }
    });




</script>