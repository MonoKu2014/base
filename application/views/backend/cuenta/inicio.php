

<div id="main-content">
	

	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right hidden-lg hidden-md" id="content-button-menu-toggle">
		<a href="#" class="btn btn-default text-right" id="menu-toggle"><i class="fa fa-bars"></i></a>
	</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content-header">
			<h1>Cuenta</h1>
			<p>Datos personales de tu cuenta</p>
		</div>



		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 jumbotron">
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3 class="head">DATOS</h3>	
				<p><span class="data">Nombre:</span><?= $usuario[0]->nombre_usuario;?></p>
				<p><span class="data">Email:</span><?= $usuario[0]->email_usuario;?></p>
				<p><span class="data">Perfil:</span><?= $usuario[0]->perfil;?></p>
				<p><span class="data">Estado:</span><?= $usuario[0]->estado;?></p>
				<p>
					<span class="data">Password:</span>
					<span id="password" style="font-weight:normal;"><?= $usuario[0]->password_usuario;?></span>
				</p>
			</div>
			<div class="clearfix"></div>
			<br><br>
			<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<h3 class="head">CAMBIAR PASSWORD</h3>	
				<p><span class="data">Nuevo password:</span><input type="password" id="password_1" class="form-control"></p>
				<p><span class="data">Repetir password:</span><input type="password" id="password_2" class="form-control"></p>
				<p><button class="btn btn-primary" id="change-password"><i class="fa fa-key"></i> Cambiar password</button></p>
				<p id="mensaje"></p>
			</div>
		</div>


<script>
$('#change-password').on('click', function(){
	var newPassword = $('#password_1').val();
	var matchPassword = $('#password_2').val();
	var error = 0;

	if(newPassword.trim() == ''){
		error = 1;
		mensaje = '<i class="fa fa-remove"></i> Debes completar ambos campos de password';
	}

	if(matchPassword.trim() == ''){
		error = 1;
		mensaje = '<i class="fa fa-remove"></i> Debes completar ambos campos de password';
	}

	if(newPassword != matchPassword){
		error = 1;
		mensaje = '<i class="fa fa-remove"></i> Los passwords ingresados no coinciden';
	}



	if(error == 0){

		$.ajax({
			type: 'post',
			url: 'login/cambiar_password',
			data: {password_uno:newPassword, password_dos:matchPassword},
			dataType: 'json',
			success: function(response){
				if(response.estado == 0){
					$('#mensaje').html('<div class="alert alert-success"><i class="fa fa-check"></i> '+response.mensaje+'</div>');
					$('#password').html(newPassword);
					$('#password_1').val('');
					$('#password_2').val('');		
				} else {
					$('#mensaje').html('<div class="alert alert-danger"><i class="fa fa-remove"></i> '+response.mensaje+'</div>');
				}
			}
		});
		
	} else {
		$('#mensaje').html('<div class="alert alert-danger">'+mensaje+'</div>');
	}
});
</script>

</div>