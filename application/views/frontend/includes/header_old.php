<?php header('Cache-Control: no-cache'); ?>
<!DOCTYPE html>

<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Portal Microempresa(rios)</title>

    <script type="text/javascript" src="<?= JS_PATH;?>jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?= JQUERYUI_PATH;?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= BOOTSTRAP_NEWPATH;?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= JS_PATH;?>jquery-confirm.min.js"></script>
    <script type="text/javascript" src="<?= JS_PATH;?>flexy-menu.js"></script>
    <script src="<?= JS_PATH;?>bootstrap-hover-dropdown.js"></script>
    <script src="<?= JS_PATH;?>jquery-multifile.js"></script>
    <script src="<?= JS_PATH;?>scripts.js"></script>
    <script src="<?= JS_PATH;?>sweetalert.min.js"></script>

    <!-- ARCHIVOS DE CSS PARA PANEL DE CONTROL -->
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>normalize.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>base.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>base-ms.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>portal.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_PATH;?>font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>flexy-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= JQUERYUI_PATH;?>jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>sweetalert.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,700,800' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
  var APP_URL = '<?= base_url();?>';
</script>

<style>

@media (max-width: 768px) {
    .center-mobile {
        text-align: center !important;
    }
}

</style>
</head>

<body style="margin-top: 0;">
<header>


  <nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
    <div class="row">

      <div class="col-sm-4 col-xs-12 center-mobile"> <a href="<?= base_url();?>"><img src="<?= IMAGES_PATH;?>portal-microempresarios.svg" class="img-responsive" alt="portal microempresarios"/></a> </div>

      <?php if($cliente = $this->session->id){ ?>
      <div class="form-group col-sm-3 col-xs-12  buscador">
        <input style="padding: 3px 15px;" class="form-control col-md-10 col-sm-10 col-xs-10 ui-autocomplete-input" placeholder="¿Qué Buscas?" type="text" id="search-input" autocomplete="off">
        <a href="#" class="lupa-buscador-button"><span class="glyphicon glyphicon-search pull-right lupa-buscador col-md-2 col-sm-2 col-xs-2" style="padding: 6px 15px 4px 15px;"></span></a>
      </div>
      <?php } ?>

      <?php if(!$cliente = $this->session->id){ ?>
      <form method="post" action="<?= base_url();?>registro/ingresar_cuenta">
        <div class="form-group col-md-2 col-sm-3 col-xs-12">
           <input name="email" type="text" class="form-control form-head" placeholder="Correo Electrónico" id="correo"/>
        </div>

         <div class="form-group col-md-2 col-sm-3 col-xs-12">
           <input name="password" type="password" class="form-control form-head" placeholder="Contraseña" id="contraseña"/>
          <p style="margin:5px 0 0 0;"><small><a class="white" href="<?= base_url();?>registro/recuerda_password">¿Olvidaste tu contraseña?</a></small></p>
        </div>


       <div class="col-sm-1 col-xs-12 text-left">
          <input type="submit" class="btn btn-info" value="iniciar sesión" style="padding: 6px 10px;border: 1px solid #e6540e;">
       </div>
      </form>
      <?php } ?>




    <?php if($cliente = $this->session->id){ ?>
    <div class="col-sm-5" style="position: inherit;">
      <p class="center-mobile">
        <small class="white">Bienvenido,
        <strong><a class="white" href="<?= base_url();?>persona"><?= $this->session->nombre;?></a></strong></small>
        <span class="white">&nbsp;</span>

          <br class="visible-xs">
          <br class="visible-xs">
          <i id="badge-empresas" class="white glyphicon glyphicon-home" style="cursor: pointer;text-align: center;"><br><span style="font-size: 10px;">Microempresas</span></i>
          <span class="white">&nbsp;</span>

          <i class="white session-menu glyphicon glyphicon-user" id="perfil-session" style="cursor: pointer;text-align: center;"><br><span style="font-size: 10px;">Mi Cuenta</span></i>
          <span class="white">&nbsp;</span>

          <i id="badge-notificaciones" class="white glyphicon glyphicon-comment mensajes" style="cursor: pointer;text-align: center;"><br><span style="font-size: 10px;">Mensajes</span></i>

          <?php

          $notificaciones = $this->functions->notificaciones_persona($this->session->id, 0);
          $noti_convenio = $this->functions->notificaciones_convenio($this->session->id, 0);
          $total_notificaciones = count($notificaciones) + count($noti_convenio);
          ?>
          <i id="badge-notificaciones" class="white glyphicon glyphicon-bell notificaciones" style="cursor: pointer;text-align: center;"><br><span style="font-size: 10px;">Notificaciones</span></i>

          <?php if($total_notificaciones > 0){ ?>
            <span class="badge badge-notificaciones notificaciones"><?= $total_notificaciones;?></span>
          <?php }?>

           <ul class="menu-notificaciones">
            <li><a href="<?= base_url();?>persona"> Mi Perfil</a></li>
            <li><a href="<?= base_url();?>editar_persona"> Editar mis datos</a></li>
            <li><a href="<?= base_url();?>publicar_paso_uno"> Publicar Negocio o Servicio</a></li>
            <li><a href="<?= base_url();?>agregar_requerimiento"> Publicar un requerimiento</a></li>
            <li><a href="<?= base_url();?>registro/cerrar_sesion">Cerrar sesión</a></li>
            <li><a style="font-weight: bold;">Mis Negocios (<?= count($this->functions->empresasPublicadasPorCliente($this->session->id));?>)</a></li>

            <?php foreach($this->functions->empresasPublicadasPorCliente($this->session->id) as $pe){ ?>
            <li>
              <a href="<?= base_url();?>microempresario/<?= $pe->id_empresa;?>">
                <i class="fa fa-angle-right"></i> <?= $pe->nombre_empresa;?>
              </a>
            </li>
            <?php } ?>


           </ul>

           <ul class="menu-notificaciones-dos">
           <p class="text-right">
              <a href="#" style="font-size: 10px;padding: 0 5px;" id="marcar-leidos">Marcar como leídas</a>
              <a href="#" style="font-size: 10px;padding: 0 5px;" id="close_notificacion">Cerrar</a>
           </p>
           <?php if($total_notificaciones > 0){?>

                <?php if(count($notificaciones) > 0){ ?>
                    <li><a style="font-weight: bold;">Notificaciones</a></li>
                    <?php foreach($notificaciones as $n){ ?>
                      <li class="notificaciones_li text-center" data-id="<?= $n->id_notificacion;?>"><?= $n->texto_notificacion;?></li>
                    <?php } ?>
                <?php } ?>

                <?php if(count($noti_convenio) > 0){ ?>
                    <li><a style="font-weight: bold;">Solicitudes de Convenios RSE</a></li>
                    <?php foreach($noti_convenio as $n){ ?>
                      <li class="notificaciones_li_convenio text-center" data-id="<?= $n->id_notificacion;?>"><?= $n->texto_notificacion;?></li>
                    <?php } ?>
                <?php } ?>

            <?php } else { ?>
                  <li class="text-center">Perfecto, no tienes notificaciones pendientes</li>
            <?php } ?>


            <a href="<?= base_url();?>mis_notificaciones" style="display: inline-block;width: 100%;text-align: center;font-size: 12px;font-weight: bold;">Ver todas mis notificaciones</a>
           </ul>



           <ul class="menu-notificaciones-tres">
            <?php foreach($this->functions->empresasPublicadasPorCliente($this->session->id) as $pe){ ?>
            <li>
              <a href="<?= base_url();?>microempresario/<?= $pe->id_empresa;?>">
                <i class="fa fa-angle-right"></i> <?= $pe->nombre_empresa;?>
              </a>
            </li>
            <?php } ?>
           </ul>



      </p>
    </div>
    <?php } ?>

    <?php if(!$cliente = $this->session->id){ ?>

    <div class="visible-xs clearfix"></div>
    <br class="visible-xs">

    <div class="col-sm-1">
      <div class="dropdown" style="margin-top: -5px;">
        <button class="dropdown-toggle no_button" type="button" data-toggle="dropdown">
        <?= $this->pais->pais_actual($this->functions->texto_general(7));?>
        <span class="caret" style="margin-top: -10px;color: #fff;"></span></button>
        <ul class="dropdown-menu">
          <?= $this->pais->opciones_paises($this->functions->texto_general(7));?>
        </ul>
      </div>
    </div>

    <?php } ?>



      <div class="clearfix visible-xs"><br></div>
      <br class="visible-xs" />
    </div>
    </div>


  </nav>


</header>


<script>

$(document).ready(function(){


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



    $('#perfil-session').on('click', function(){
        $('.menu-notificaciones').fadeToggle('fast');
        $('.menu-notificaciones-dos').fadeOut();
        $('.menu-notificaciones-tres').fadeOut();
    });

    $('#badge-notificaciones, .badge-notificaciones, #close_notificacion').on('click', function(e){
        e.preventDefault();
        $('.menu-notificaciones-dos').fadeToggle('fast');
        $('.menu-notificaciones').fadeOut();
        $('.menu-notificaciones-tres').fadeOut();
    });

    $('#badge-empresas').on('click', function(e){
        e.preventDefault();
        $('.menu-notificaciones-tres').fadeToggle('fast');
        $('.menu-notificaciones').fadeOut();
        $('.menu-notificaciones-dos').fadeOut();
    });


    $('#marcar-leidos').on('click', function(event){
        event.preventDefault();
        var ide_noti = [];
        var ide_noti_convenio = [];

        $('.marcar_leida').each(function(){
            ide_noti.push($(this).data('id'));
        });

        $('.marcar_leida_convenio').each(function(){
            ide_noti_convenio.push($(this).data('id'));
        });

        $.ajax({
          type: 'post',
          url: APP_URL + 'ajax/marcar_leidas',
          data:{ide_noti, ide_noti, ide_noti_convenio:ide_noti_convenio},
          dataType: 'json',
          success: function(res){
            swal({
               title: 'Perfecto!',
               text: 'Las notificaciones han sido marcadas como leídas',
               type:'success'
              },
              function(){
                window.location = res.redirection;
            });
          }
        });
    });



    var error = '<?= $this->session->flashdata('error');?>';

    if(error == 1){
        swal({
          title: 'Atención',
          text: '<?= $this->session->flashdata('mensaje');?>',
          type: 'error'
        });
    }

    $('.notificaciones_li').on('click', function(){
        $(this).toggleClass('marcar_leida');
    });

    $('.notificaciones_li_convenio').on('click', function(){
        $(this).toggleClass('marcar_leida_convenio');
    });


});

</script>