<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <ol class="breadcrumb">
        <li><a href="<?= base_url();?>">Inicio</a></li>
        <li class="active">Contáctenos</li>
      </ol>
      <hr>

      <div class="col-sm-6 col-sm-push-3">
        <div class="col-sm-12">
          <h1>Contáctenos</h1>
        </div>
        <form method="POST" action="<?= base_url();?>welcome/contactar">

          <div class="clearfix"></div><br>

        <div class="com-md-12"><?= $this->session->flashdata('mensaje');?></div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Nombre</strong></p>
            <input name="nombre" type="text" class="form-control datos" id="nombre" placeholder="Ingrese su nombre completo" required />
          </div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Email</strong></p>
            <input name="email" type="text" class="form-control datos" id="nombre" placeholder="Ingrese su email" required />
          </div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Asunto</strong></p>
            <select name="asunto" class="form-control" required>
              <option value="">Seleccione el motivo de su contacto</option>
              <option value="Ayuda">Ayuda</option>
              <option value="Sugerencia">Sugerencia</option>
            </select>
          </div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Fono</strong></p>
            <input name="fono" type="text" class="form-control datos" id="fono" placeholder="Ingrese su fono" required />
          </div>

          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Comentarios</strong></p>
            <textarea rows="10" name="comentarios" class="form-control"></textarea>
          </div>

          <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-info col-xs-12" value="Contactar"  />
          </div>
        </form>
        <div class="clearfix"></div>

      </div>

        <div class="clearfix"></div>

        <br><br><br><br>

    </div>
  </div>
  
  <!-- Fin Row --> 
  
</div>
