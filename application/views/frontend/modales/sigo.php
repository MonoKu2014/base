<div class="modal_ajax modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h2 class="modal-title">Yo Sigo</h2>
      </div>
      <div class="modal-body">
      <div class="clearfix"></div>
        <div class="col-lg-12">
          <h2>Microempresa(rios)</h2>
          <?php foreach($clienteSigueEmpresas as $k => $m){ ?>
          <p><?= $k + 1;?>.-
            <a style="color: #0dcbab !important;" href="<?= base_url();?>microempresarios/detalle/1/<?= $m->id_empresa;?>/<?= $m->id_categoria;?>"><?= $m->nombre_empresa;?></a>
            </p>
          <?php } ?>
        </div>
        <div class="clearfix"></div>
        <br>
        <div class="col-lg-12">
          <h2>Personas</h2>
          <?php foreach($clienteSiguePersonas as $k => $s){ ?>
          <p><?= $k + 1;?>.-
            <a  class="orange" href="<?= base_url();?>perfil_persona/<?= $s->id_cliente;?>"><?= $s->nombre_cliente;?></a>
            </p>
          <?php } ?>
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