<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Portal Microempresarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body>
<div style="border: 1px solid #eaeaea;background: #fbfbfb;display: inline-block;height: auto;padding: 20px;width: 80%;">

	<div style="width: 100%;">

	<img style="border: 0;" alt="#" src="<?= IMAGES_PATH;?>logo-email-portal-microempresarios.jpg">
	
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 18px;">
	  <b>Estimado <?= $nombre;?></b><br />
	</p> 
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;">
		<b>Requerimiento</b><br>

		<span style="font-size: 14px;">Nuestro cliente <?= $requeridor;?> ha ingresado un nuevo requerimiento para usted</span>
		<br>
		<span style="font-size: 14px;">El requerimiento es para tu negocio: <b><?= $empresa;?></b></span>
		<br>
		<span style="font-size: 14px;">Nombre cliente: <b><?= $requeridor;?></b></span>
		<br>
		<span style="font-size: 14px;">Email cliente: <b><?= $email;?></b></span>
		<br>
		<span style="font-size: 14px;">Requerimiento: <b><?= $mensaje;?></b></span>
		<br><br>

		Saludos!<br>
		Equipo Portal Microempresarios
	</p>
	</div>
</div>
</body>
</html>