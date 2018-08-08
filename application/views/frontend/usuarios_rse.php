<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li><a href="<?= base_url();?>rse/listado_empresas">Listado Empresas RSE</a></li>
        <li><a href="<?= base_url();?>rse/perfil_rse/<?= $empresa->id_empresa;?>"><?= $empresa->nombre_empresa;?></a></li>
        <li class="active">Listado de Usuarios/Trabajadores <?= $empresa->nombre_empresa;?></li>
      </ol>
      <br>
    </div>
    <div class="clearfix"></div>
  </div>

  <!-- /.row -->

  <!-- Intro Content -->

  <div class="col-md-12">
    <div class="row">


      <div class="col-md-10">
        <div class="row">
          <div class="box-separator col-md-11 fix-col">

            <div class="col-sm-12"><br class="visible-xs">
              <h1 style="color: #0dcbab;">Listado de Usuarios/Trabajadores de <?= $empresa->nombre_empresa;?></h1>

              <br><br>

              <table class="table">
                <thead>
                  <th></th>
                  <th>Nombre</th>
                  <th>Cargo</th>
                  <th>Email</th>
                  <th>Región</th>
                  <th>Comuna</th>
                </thead>
                <tbody>
                  <?php foreach ($usuarios as $num => $usuario): ?>
                      <tr>
                        <td><?= $num + 1;?></td>
                        <td><?= $usuario->nombre_usuario;?></td>
                        <td><?= $usuario->cargo_usuario;?></td>
                        <td><?= $usuario->email_usuario;?></td>
                        <td><?= $this->functions->region($usuario->region_usuario);?></td>
                        <td><?= $this->functions->comuna($usuario->comuna_usuario);?></td>
                      </tr>  
                  <?php endforeach ?>
                </tbody>
              </table>

              <br><br>
              <a data-id="<?= $empresa->id_empresa;?>" class="btn btn-new btn-extend chatearOnline">
                <i class="fa fa-comment"></i> Chatear con RSE
              </a>
              <a href="<?= base_url();?>rse/ofrecer_convenio/<?= $empresa->id_empresa;?>" class="btn btn-new btn-extend"><i class="fa fa-tasks"></i> Ofrecer Alianza</a>
            </div>
          </div>
        </div>
      </div>



      <div class="col-sm-2 psmall box-separator">
        <p><strong>Web de la Empresa RSE</strong><br><br>
          <small>
            <?= $empresa->web_empresa; ?>
          </small>
        </p>
        <hr>

        <p>
          <small>
            <a href="<?= base_url();?>rse/usuarios_rse/<?= $empresa->id_empresa;?>"><?= count($usuarios); ?> Usuarios/Trabajadores</a>
          </small>
        </p>
        <p>
          <small>
            <a href="#alianzas" data-toggle="modal"><?= count($microempresarios_alianzas); ?> Alianzas</a>
          </small>
        </p>
        <p>
          <small>
            <a href="<?= base_url();?>rse/solicitudes_rse/<?= $empresa->id_empresa;?>"><?= count($solicitudes); ?> Solicitudes de Cotizaciones</a>
          </small>
        </p>
        <hr>

      </div>


      <div class="clearfix"></div>
      <br>
      <br>
    </div>
  </div>

  <!-- /.row -->

</div>



<div id="alianzas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h2 class="modal-title">Listado de alianzas con Microempresarios</h2>
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
          <div class="col-lg-12">
            <?php foreach ($microempresarios_alianzas as $num => $empresa): ?>
              <p><?= $num + 1;?>.-
                <a href="<?= base_url();?>microempresarios/detalle/1/<?= $empresa->id_empresa;?>/<?= $empresa->id_categoria;?>">
                  <?= $empresa->nombre_empresa;?>
                </a>
              </p>
            <?php endforeach ?>
          </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <div class="clearfix"></div>
          <div class="col-md-12">
              <br>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
</div>