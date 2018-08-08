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
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>/flexy-menu.css">
    <link rel="stylesheet" type="text/css" href="<?= JQUERYUI_PATH;?>/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>/sweetalert.css">

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

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

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

      <div class="col-lg-4 hidden-sm"></div>
      <div class="col-sm-4 col-xs-12 text-center">
      <a href="<?= base_url();?>"><img src="<?= IMAGES_PATH;?>portal-microempresarios.svg" class="img-responsive" alt="portal microempresarios"/></a>
      <div class="clearfix"></div><br>
      </div>




      <div class="clearfix visible-xs"><br></div>
      <br class="visible-xs" />

    </div>


  </nav>


</header>
<div class="clearfix"><br></div>