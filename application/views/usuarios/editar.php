<div class="container-fluid">


<ol class="breadcrumb">
  <li><a href="<?= base_url();?>panel">Dashboard</a></li>
  <li>Administración</li>
  <li><a href="<?= base_url();?>usuarios">Usuarios</a></li>
  <li class="active">Editar</li>
</ol>


    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Editar usuario
                <a href="<?= base_url(); ?>usuarios" class="btn btn-default pull-right">
                	<i class="fa fa-chevron-left"></i> Volver
                </a>
            </h2>
        </div>
    </div>


    <div class="row">
    	<div class="col-lg-12">
        <form method="post" action="<?= base_url(); ?>usuarios/guardar_edicion" class="form">

        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <p><em>Todos los campos marcados con (*) son de caracter obligatorio</em></p>
                <p id="message"></p>
                <input type="hidden" name="usuario_id" value="<?= $usuario->id_usuario; ?>">
                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Nombre Completo (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="nombre" data-validate="string" class="form-control required" placeholder="Nombre" required value="<?= $usuario->nombre_usuario; ?>">
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Email (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="email" data-validate="email" class="form-control required" placeholder="Email" required value="<?= $usuario->email_usuario; ?>">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Contraseña (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="password" data-validate="string" class="form-control required" placeholder="Contraseña" required value="<?= $usuario->password_usuario; ?>">
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Perfil (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <select class="form-control required" name="perfil" required data-validate="number">
                        <?php foreach ($perfiles as $p): ?>
                            <option <?php if($usuario->perfil_fk == $p->id_perfil){ echo 'selected'; } ?> value="<?= $p->id_perfil; ?>"><?= $p->perfil; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Estado (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <select class="form-control required" name="estado" required data-validate="number">
                        <?php foreach ($estados as $e): ?>
                            <option <?php if($usuario->estado_fk == $e->id_estado){ echo 'selected'; } ?> value="<?= $e->id_estado; ?>"><?= $e->estado; ?></option>
                        <?php endforeach ?>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-12">
                        <button type="submit" class="btn btn-success save">Guardar</button>
                        <a href="<?= base_url(); ?>usuarios" class="btn btn-default">Cancelar</a>
                    </div>
                </div>


            </div>
        </div>


        </form>
    	</div>
    </div>

</div>