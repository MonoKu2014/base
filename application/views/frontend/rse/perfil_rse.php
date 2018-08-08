<div class="container">
  <div class="row">

<div class="col-sm-12">
<ol class="breadcrumb">
  <li><a href="<?= base_url();?>">Inicio</a></li>
  <li class="active">Perfil RSE <?= $mis_datos[0]->nombre_empresa;?></li>
</ol>
  <br>

    <div class="clearfix"></div>

    <form id="ordenar-form" method="post"></form>

      <!-- lateral-->
      <div class="col-md-3 box-separator">
      <h1 class="visible-xs"><?= $mis_datos[0]->nombre_empresa;?></h1><br class="visible-xs" />

        <img src="<?= IMAGES_PATH;?>perfil.jpg" class="img-responsive" />

      <br />

        <!--filtro -->
        <p><strong class="orange">Promociones que este usuario sigue</strong></p>

        <hr />


      </div>
      <!--FIN lateral-->

      <div class="col-md-9">
        <div class="box-separator">

          <div class="col-sm-9">
            <h1 class="hidden-xs"><?= $mis_datos[0]->nombre_empresa;?></h1>

          </div>
          <div class="col-sm-3">
            <a href="#" class="btn btn-default seguir" data-id="">+ Seguir Requerimientos</a>
          </div>



          <div class="clearfix"></div>

          <!-- tabs -->

          <div class="col-md-12"><br>
            <br>
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                <a href="#requerimientos" aria-controls="home" role="tab" data-toggle="tab">Requerimientos
                  (<?= count($mis_requerimientos);?>)</a>
                </li>
                <li role="presentation">
                <a href="#lorecomiendo" aria-controls="home" role="tab" data-toggle="tab">Sobre Nosotros
                  </a>
                </li>
                <li role="presentation">
                <a href="#siguiendo" aria-controls="messages" role="tab" data-toggle="tab">
                  Detalles de la Empresa</a>
                </li>
                <li role="presentation">
                <a href="#seguidores" aria-controls="messages" role="tab" data-toggle="tab">Mas RSE</a>
                </li>

            </ul>

            <div class="tab-content">






              <!--tab -->
              <div role="tabpanel" class="tab-pane fade in active" id="requerimientos">
              <br />
              <div class="col-sm-6">
                <h2>REQUERIMIENTOS</h2>
              </div>

              <div class="clearfix"></div>
              <br class="hidden-xs" />

              <div class="col-lg-12 table-responsive">
              <table class="table table-stripped table-condensed" style="font-size: 12px;">
                <thead>
                  <th>Fecha publicación</th>
                  <th>Sucursal</th>
                  <th>Requerimiento</th>
                  <th>Descripción</th>
                  <th>Estado</th>
                  <th>Ver</th>
                </thead>
                <tbody>
                <?php foreach ($mis_requerimientos as $r) { ?>

                  <tr style="font-size: 13px;">
                    <td><?= $r->fecha_requerimiento;?></td>
                    <td><?= $r->nombre_empresa;?></td>
                    <td><?= $r->titulo_requerimiento;?></td>
                    <td><?= substr($r->descripcion_requerimiento, 0, 200);?> ...</td>
                    <td><?= ($r->id_estado == 1) ? '<span class="label label-success">Abierto</span>' : '<span class="label label-danger">Cerrado</span>';?></td>
                    <td>
                     <a href="<?= base_url();?>detalle_requerimiento_rse/<?= $r->id_requerimiento;?>"" class="delete eliminar_req" data-id="<?= $r->id_requerimiento;?>">Ver</a>
                    </td>
                  </tr>

                <?php } ?>
                </tbody>
              </table>
              </div>



              </div><!--fin tab -->


              <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="lorecomiendo">
              <br />
              <div class="col-sm-12">
                <h2>SOBRE NOSOTROS</h2>
              </div>
            <div class="clearfix"></div>
              <br class="hidden-xs" />

                  Empresa: <b><?= $mis_datos[0]->nombre_empresa;?></b><br>
                  Sitio Web: <b><?= $mis_datos[0]->web_empresa;?></b><br>
                  Tipo: <b><?= $mis_datos[0]->tipo_empresa;?></b><br>
                  Descripción: <b><?= $mis_datos[0]->descripcion_empresa;?></b><br>
                  tamaño: <b><?= $mis_datos[0]->tamano_empresa;?></b><br>
                  Sector: <b><?= $mis_datos[0]->sector;?></b><br>
                  País(es): <b><?= $paises;?></b>

              </div><!--fin tab -->

              <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="siguiendo">
              <br />
                <div class="col-sm-12">
              <h2>DETALLES DE LA EMPRESA </h2>
              </div>




              </div><!--fin tab -->

               <!--tab -->
              <div role="tabpanel" class="tab-pane fade" id="seguidores">
              <br />
              <div class="col-sm-6">
                <h2>MAS RSE</h2>
              </div>




              </div><!--fin tab -->

            </div>
          </div>
          <!--fin tabs -->



          <div class="clearfix"></div>
                    <br />
<br />
<br />



        </div>
      </div>


    <!-- Fin Row -->

  </div>
</div>
</div>