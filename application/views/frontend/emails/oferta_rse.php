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
	  <b><?= $requerimiento->nombre_usuario;?> tienes una oferta a una de tus solicitudes de cotizaciones:</b><br />
	</p>
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;">
		<b>Oferta</b><br>

		<span style="font-size: 14px;">Nuestro cliente: <?= $ofertador;?> a través de su Microempresa: <?= $empresa_portal->nombre_empresa; ?>te sugiere lo siguiente:</span>
		<br>
		<span style="font-size: 14px;"><?= $texto_oferta;?></span>
		<br><br>

		Saludos!<br>
		Equipo Portal Microempresarios
	</p>
	</div>
</div>
</body>
</html>