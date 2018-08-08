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
    
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 18px;text-align: center;">
	  <b><?= strtoupper($nombre);?> PODRÍAS SEGUIR A:</b><br />
	</p> 
	<p style="margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;">

	<?php
	$x = 1;
	foreach($personas_sugeridas as $p){ ?>

    <?php if($this->functions->yaSeguido($p->id_cliente) == 0){ ?>

    <?php if($id_actual != $p->id_cliente){ ?>

		<div style="font-size: 12px;border:1px solid #ccc;margin-bottom: 10px;padding: 10px;border-radius: 4px;">
        <?php 
          if($p->imagen_cliente == ''){ ?>
              <img style="width: 22%;" src="<?= IMAGES_PATH;?>perfil.jpg" alt="Imagen promocion">
        <?php } else { ?>
              <img style="width: 22%;" src="<?= CLIENTES_IMAGES_PATH.$p->imagen_cliente;?>">
        <?php } ?>
        <p style="text-align: left;display: inline-block;margin-left: 10px;width: 50%;">
        <b><?= $p->nombre_cliente;?></b><br>
        <b><?= $p->region_cliente;?>, <?= $p->comuna_cliente;?></b><br>
        </p>
        <p style="width: 100%;display: inline-block;text-align:center;border: 1px solid #ff5601;border-radius: 4px;">
        <b><a target="_blank" style="color: #ff5601;display: block;padding: 5px;" href="<?= base_url();?>perfil_persona/<?= $p->id_cliente;?>" style="cursor: pointer;display: inline-block;">+ Seguir Recomendaciones</a></b>
        </p>
		</div>

	<?php } ?>

    <?php } ?>

	<?php $x++; if($x == 4){break;}  } ?>


	<?php
	$x = 1;
	foreach($empresas_sugeridas as $e){ ?>

    <?php if($this->functions->yaSeguidoEmpresa($e->id_empresa) == 0){ ?>

    <?php if($id_actual != $e->id_cliente){ ?>

		<div style="font-size: 12px;border:1px solid #ccc;margin-bottom: 10px;padding: 10px;border-radius: 4px;">
        <?php 
          if($e->imagen_empresa == ''){ ?>
              <img style="width: 22%;" src="<?= IMAGES_PATH;?>categorias/<?= $this->functions->imagen_categoria($e->id_categoria);?>">
        <?php } else { ?>
              <img style="width: 22%;" src="<?= PERFILES_EMPRESA_PATH.$e->imagen_empresa;?>">
        <?php } ?>
        <p style="text-align: left;display: inline-block;margin-left: 10px;width: 50%;">
        <b><?= $e->nombre_empresa;?></b><br>
        <b><?= $e->region_empresa;?>, <?= $e->comuna_empresa;?></b><br>
        </p>
        <p style="width: 100%;display: inline-block;text-align:center;border: 1px solid #ff5601;border-radius: 4px;">
        <b><a target="_blank" style="color: #ff5601;display: block;padding: 5px;" href="<?= base_url();?>microempresarios/detalle/1/<?= $e->id_empresa;?>/<?= $e->id_categoria;?>" style="cursor: pointer;display: inline-block;">+ Seguir Promociones</a></b>
        </p>
		</div>

	<?php } ?>

    <?php } ?>

	<?php $x++; if($x == 4){break;}  } ?>

		Saludos!<br>
		Equipo Portal Microempresarios
	</p>
	</div>
</div>
</body>
</html>