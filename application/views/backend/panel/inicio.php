<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
    <title>Panel de control</title>
    <script type="text/javascript" src="<?= JS_PATH;?>jquery.js"></script>
    <script type="text/javascript" src="<?= BOOTSTRAP_NEWPATH;?>js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>normalize.css">
    <link rel="stylesheet" type="text/css" href="<?= BOOTSTRAP_NEWPATH;?>css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>main.css">
    <link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_PATH;?>css/font-awesome.min.css">
</head>
<body id="login-bg">

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="container text-center">
            <form method="post" action="login">
                    <div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
                    <div class="col-lg-6 col-md-6 col-sm-10 col-xs-12" id="login-box">
                        <h1 style="background:#FF5800;"><img src="<?= IMAGES_PATH;?>portal-microempresarios.svg"></h1>
                        <br>
                        <input type="text" placeholder="Ingrese su E-mail" name="email" class="form-control" autocomplete="off">
                        <br>
                        <input type="password" placeholder="Ingrese su contraseña" name="password" class="form-control" autocomplete="off">
                        <br>
                        <input type="submit" value="Acceder" class="btn btn-success">
                        <div class="clearfix"></div>  
                        <br>
                        <p class="remember_password">Olvido su contraseña? Ingrese <a href="recuperar">Aquí</a></p>
                        <p></p>
                        <?= $this->session->flashdata('mensaje'); ?>
                    </div>    
                    <div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
            </form>
        </div>
    </div>

</body>
</html>