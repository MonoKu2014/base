<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                <i class="fa fa-exclamation-triangle"></i> Alerta
            </h1>
        </div>
    </div>
    <!-- /.row -->



    <div class="row">
        <div class="col-lg-12">
            <?= $this->session->flashdata('message');?>
            <h6>
                <a href="<?= base_url();?>panel">Volver al panel de control</a>
            </h6>
        </div>
    </div>

    </div>


</div>