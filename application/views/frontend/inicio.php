
<?php if(!$cliente = $this->session->id){ ?>


  <div class="bg-gray5">

    <!-- PARA DESKTOP -->
    <div id="myCarousel" class="carousel slide hidden-xs" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?= base_url();?>components/images/bg-artesanos.jpg" alt="Artensanos">
          <div class="carousel-caption">
            <h2 class="mensajes-home">
              <strong>Publica tu Negocio, Productos y Servicios Gratis!</strong>
            </h2>
            <p style="margin-top: 5px;color:#fff;">Únete a Portal Microempresarios y conecta con nuevos clientes</p>
            <a href="https://portalmicroempresarios.cl/registro_paso_uno" class="btn btn-new btn-extend" style="padding: 15px 20px;text-align: center;font-weight: bold;">Unirme Ahora</a>
          </div>
        </div>
        <div class="item">
          <img src="<?= base_url();?>components/images/bg-turismo.jpg" alt="Turismo">
          <div class="carousel-caption">
            <h2 class="mensajes-home">
              <strong>Únete a Portal Microempresarios y podrás!</strong>
            </h2>
            <p style="margin-top: 5px;color:#fff;">Registrar tus Negocios, hacer Recomendaciones, Comentar, suscribirte a Promociones de Microempresarios, suscribirte a Recomendaciones de otros Usuarios</p>
            <a href="https://portalmicroempresarios.cl/registro_paso_uno" class="btn btn-new btn-extend" style="padding: 15px 20px;text-align: center;font-weight: bold;">Unirme Ahora</a>
          </div>
        </div>
      </div>
    </div>


    <!-- PARA CELULARES -->
    <div id="myCarousel" class="carousel slide visible-xs" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="<?= base_url();?>components/images/bg-artesanos-mobile.jpg" alt="Artensanos">
          <div class="carousel-caption">
            <h2 class="mensajes-home">
              <strong>Publica tu Negocio, Productos y Servicios Gratis!</strong>
            </h2>
            <p style="margin-top: 5px;color:#fff;">Únete a Portal Microempresarios y conecta con nuevos clientes</p>
            <a href="https://portalmicroempresarios.cl/registro_paso_uno" class="btn btn-new btn-extend">Unirme Ahora</a>
          </div>
        </div>
        <div class="item">
          <img src="<?= base_url();?>components/images/bg-turismo-mobile.jpg" alt="Turismo">
          <div class="carousel-caption">
            <h2 class="mensajes-home">
              <strong>Únete a Portal Microempresarios y podrás!</strong>
            </h2>
            <p style="margin-top: 5px;color:#fff;">Registrar tus Negocios, hacer Recomendaciones, Comentar, suscribirte a Promociones de Microempresarios, suscribirte a Recomendaciones de otros Usuarios</p>
            <a href="https://portalmicroempresarios.cl/registro_paso_uno" class="btn btn-new btn-extend">Unirme Ahora</a>
          </div>
        </div>
      </div>
    </div>


</div>
<?php } ?>


<?php if(count($requerimientos) > 0){ ?>
<div class="bg-gray2">
  <div class="container">

    <!--requerimientos -->

    <div class="col-sm-12">
      <h2 class="titulo-principal">Últimas solicitudes de cotizaciones ingresadas
      <a href="<?= base_url();?>requerimientos" class="btn btn-info pull-right hidden-xs" style="color: #fff;">
        Ver todas las solicitudes de cotizaciones
      </a>
      </h2>
      <div class="divisor"></div>
      <div class="row">

          <div class="col-lg-12 table-responsive">
          <table class="table table-condensed" style="font-size: 12px;">
            <thead>
              <th>Fecha publicación</th>
              <th>Sector</th>
              <th>Tipo de Microempresario</th>
              <th>Detalle de solicitud de cotizaciones</th>
              <th>Estado</th>
              <th></th>
            </thead>
            <tbody>
            <?php foreach ($requerimientos as $r) { ?>

              <tr>
                <td><?= $r->fecha_requerimiento;?></td>
                <td><?= $r->nombre_categoria;?></td>
                <td><?= $r->nombre_subcategoria;?></td>
                <td><?= substr($r->texto_requerimiento, 0, 100);?> ...</td>
                <td><?= ($r->estado_requerimiento == 1) ? '<span class="label label-success">Abierta</span>' : '<span class="label label-danger">Cerrada</span>';?></td>
                <td>
                 <a href="<?= base_url();?>detalle_requerimiento/<?= $r->id_requerimiento;?>" class="delete eliminar_req" data-id="<?= $r->id_requerimiento;?>">Ver</a>
                </td>
              </tr>

            <?php } ?>
            </tbody>
          </table>
          </div>

          <a href="<?= base_url();?>requerimientos" class="btn btn-info col-xs-12 visible-xs" style="color: #fff;">Ver todos las solicitudes de cotizaciones</a>

      </div>
    </div>

    <!--fin requerimientos -->

  </div>
</div>
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

<div class="bg-gray">
  <div class="container">
    <div class="col-sm-4">
      <h2>+ Promociones</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>descuento.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>Regístrate gratis en el Portal Microempresarios y recibe Ofertas y Promociones. También podrás ver lo que otros Recomiendan, Suscribirte a nuevas Promociones, Recomendar y Comentar.<br>
            <br>
          </p>
        </div>
        <?php if(!$cliente = $this->session->id){ ?>
        <div class="col-sm-12"><a href="<?= base_url();?>registro_paso_uno" class="btn btn-new">Unirme ahora</a></div>
        <?php } ?>
      </div>
    </div>
    <hr class="visible-xs">
    <div class="col-sm-4">
      <h2>+ Negocios</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>juntos.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>Luego de Registrarte en el Portal Microempresarios, puedes publicar gratis tus Negocios, publicar gratis todos tus Productos y Servicios, y crear Promociones para aumentar tus Ventas.<br>
            <br>
          </p>
        </div>
        <?php if(!$cliente = $this->session->id){ ?>
        <div class="col-sm-12"><a href="<?= base_url();?>registro_paso_uno" class="btn btn-new">Unirme ahora</a></div>
        <?php } ?>
      </div>
    </div>
    <hr class="visible-xs">
    <div class="col-sm-4">
      <h2>+ Fácil</h2>
      <div class="row">
        <div class="col-sm-4 col-xs-4"><img src="<?= IMAGES_PATH;?>microempresarios.jpg" class="img-responsive" alt="portal microempresarios"></div>
        <div class="col-sm-8 col-xs-8">
          <p>En el Portal Microempresarios puedes encontrar y publicar Negocios, Productos, Servicios, y estar al tanto de nuevas Promociones fácilmente y GRATIS, sin cobros de mensualidad ni comisiones. <br>
          <br>
          </p>
        </div>
        <?php if(!$cliente = $this->session->id){ ?>
        <div class="col-sm-12"><a href="<?= base_url();?>registro_paso_uno" class="btn btn-new">Unirme ahora</a></div>
        <?php } ?>
      </div>
    </div>
  </div>
</div>


<div class="bg-gray2">
  <div class="container">

    <!--productos mas buscados -->

    <div class="col-sm-12">
      <h2 class="">Productos más buscados
      <span class="pull-right small"><a href="<?= base_url();?>productos_mas_buscados">Ver todos</a></span>
      </h2>
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
<div class="bg-gray3">
  <div class="container">

    <!--servicios mas buscados -->

    <div class="col-sm-12">
      <h2 class="">Servicios más buscados
      <span class="pull-right small"><a href="<?= base_url();?>servicios_mas_buscados">Ver todos</a></span>
      </h2>
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


<div class="bg-white">
<div class="container">
  <div class="row">
    <div class="col-md-12"><br>
      <br>
      <h2 class="">Microempresa(rios) más recomendados
      <span class="pull-right small"><a href="<?= base_url();?>mas_recomendados">Ver todos</a></span>
      </h2>
      <div class="divisor"></div>
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
            <h3 class="margin-title"><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="">
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


      <?php if(count($empresasDos) > 0){ ?>
      <div class="item">
        <div class="row">


          <?php
          foreach($empresasDos as $e){
            if($e->cantidad > 0){
            ?>
          <!--microempresario -->

          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="">
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
          <?php }  } ?>

        </div>
      </div>
      <?php } ?>


    <?php if(count($empresasTres) > 0){ ?>
      <div class="item">
        <div class="row">


          <?php
          foreach($empresasTres as $e){
            if($e->cantidad > 0){
            ?>
          <!--microempresario -->

          <div class="col-md-2 col-sm-3">
            <h3 class="margin-title"><a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>"><strong><?= $e->nombre_empresa;?></strong></a></h3>
            <?php
            if($e->imagen_empresa == ''){ ?>
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>">
                  <img class="img-responsive portfolio-item" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>" alt="">
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
          <?php }  } ?>

        </div>
      </div>
      <?php } ?>



    </div>

  </div>
      <div class="col-md-12"><br>
      <div class="controls pull-right hidden-xs">
        <a class="left fa fa-chevron-left btn btn-danger" href="#carousel-example" data-slide="prev" style="padding:5px 10px 4px 9px;;margin: 0 5px;"></a>
        <a class="right fa fa-chevron-right btn btn-danger" href="#carousel-example" data-slide="next" style="padding:5px 10px 4px 9px;;margin: 0 5px;"></a>
      </div>
    </div>
    <div class="clearfix"></div>
  <br>
  <br>
</div>
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
        simple_alert("Atención!", "Complete todos los campos del formulario de registro", "warning");
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
                simple_alert('Atención!', 'El correo ingresado ya tiene una cuenta registrada', 'warning');
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


    $('#imagen2').hide();
    $('#imagen3').hide();
    $('#imagen4').hide();
    $('#imagen5').hide();
    $('#imagen6').hide();


    var number = 1;
    function changeImage()
    {

        if(number == 6){
            number = 1;
        } else {
            number++;
        }
        $('.fadeImage').fadeOut(3000);
        $('#imagen'+number).fadeIn(1000);

    }

    var existe_sesion = '<?php echo $this->session->id; ?>';

    if(existe_sesion == ''){
        setInterval(function(){
            changeImage();
        }, 9000);
    }

</script>