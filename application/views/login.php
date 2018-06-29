<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Soporte <?= date('Y'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/css/animate.css">

    <script src="<?= base_url(); ?>assets/js/jquery.js"></script>

</head>
<body>

<div class="container">
    <div class="card card-container text-center animated fadeIn" id="login">
        <img class="img-responsive" src="<?= base_url(); ?>assets/images/logo.png" />
        <br>
        <h4>Iniciar Sesión</h4>
        <p>
        	<?= $this->session->flashdata('message');?>
        </p>

        <form class="form-signin" method="post" action="<?= base_url(); ?>login/access">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Acceder</button>
        </form>

        <a href="#" class="forgot-password">
            Olvidó su contraseña?
        </a>

    </div>


    <div class="card card-container text-center" id="remember" style="display: none;">
        <img class="img-responsive" src="<?= base_url(); ?>assets/images/logo.png" />
        <br>
        <h4>Ingresa Email</h4>
        <p class="message"></p>

        <form class="form-signin" method="post" action="<?= base_url(); ?>login/access">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required autofocus>
            <button class="btn btn-lg btn-primary btn-block btn-signin" type="submit">Recuperar</button>
        </form>

        <a href="#" class="back-login">
            Volver
        </a>

    </div>


</div>

<script>
    $('.forgot-password').on('click', function(event){
        event.preventDefault();
        $('#login').hide();
        $('#remember').fadeIn('fast');
    });

    $('.back-login').on('click', function(event){
        event.preventDefault();
        $('#remember').hide();
        $('#login').fadeIn('fast');
    });

</script>

</body>
</html>