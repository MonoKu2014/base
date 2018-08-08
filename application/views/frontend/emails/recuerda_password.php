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
	  <b>RECUERDA PASSWORD PORTAL MICROEMPRESARIO</b><br />
	</p> 
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;">

		<span style="font-size: 14px;">
			Nos pediste recuperar tu contraseña a través de nuestro portal, si no recuerdas haberlo hecho ponte en contacto con nosotros, alguien podría estar intentando acceder a tu cuenta.<br><br>
			La contraseña que mantienes en nuestra base de datos es: <b><?= $password;?></b>
		</span>
		<br><br>

		Saludos!<br>
		Equipo Portal Microempresarios
	</p>
	</div>
</div>
</body>
</html>