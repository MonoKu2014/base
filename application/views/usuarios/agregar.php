<div class="container-fluid">


<ol class="breadcrumb">
  <li><a href="<?= base_url();?>panel">Dashboard</a></li>
  <li>Administración</li>
  <li><a href="<?= base_url();?>usuarios">Usuarios</a></li>
  <li class="active">Agregar</li>
</ol>


    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Agregar usuario
                <a href="<?= base_url(); ?>usuarios" class="btn btn-default pull-right">
                	<i class="fa fa-chevron-left"></i> Volver
                </a>
            </h2>
        </div>
    </div>


    <div class="row">
    	<div class="col-lg-12">
        <form method="post" action="<?= base_url(); ?>usuarios/guardar" class="form">

        <div class="row">
            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                <p><em>Todos los campos marcados con (*) son de caracter obligatorio</em></p>
                <p id="message"></p>
                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Nombre Completo (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="nombre" data-validate="string" class="form-control required" placeholder="Nombre" required>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Email (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="email" data-validate="email" class="form-control required" placeholder="Email" required>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Contraseña (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <input type="text" name="password" data-validate="string" class="form-control required" placeholder="Contraseña" required>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-6 col-md-3 bg-info information">
                    Perfil (*)
                </div>
                <div class="col-xs-12 col-sm-6 col-md-9">
                    <div class="form-group">
                        <select class="form-control required" name="perfil" required data-validate="number">
                        <?php foreach ($perfiles as $p): ?>
                            <option value="<?= $p->id_perfil; ?>"><?= $p->perfil; ?></option>
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
                            <option value="<?= $e->id_estado; ?>"><?= $e->estado; ?></option>
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