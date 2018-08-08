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
	  <b><?= $rse->nombre_empresa;?>, tienes una respuesta a una de tus preguntas en una solicitud de alianzas:</b><br />
	</p>
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;">
		<b>Respuesta</b><br>

		<span style="font-size: 14px;"><?= $texto;?></span>
		<br>
		<span style="font-size: 14px;">Título de solicitud de alianza: <?= $convenio->titulo_convenio;?></span>
		<br>
		<span style="font-size: 14px;">Detalle de solicitud de alianza: <?= $convenio->descripcion_convenio;?></span>
		<br><br>

		Saludos!<br>
		Equipo Portal Microempresarios
	</p>
	</div>
</div>
</body>
</html>