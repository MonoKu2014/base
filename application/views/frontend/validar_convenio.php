<div class="clearfix"></div>


<div class="col-lg-12 breadcrumb">
  <div class="container">
    <ul class="breadcrumb">
      <li><a href="<?= base_url();?>">Inicio</a></li>
      <li>Validar Alianza</li>
    </ul>
  </div>
</div>



<div class="container">
  <br>
  <br><br>
  <div class="row">
    <div class="col-lg-12">

      <h2 class="blue">Validar Alianzas</h2>


      <br><br>
    
      <div class="row">
        <div class="col-md-3">
          <input type="text" name="rut" id="rut" placeholder="Ingresar rut para validar" class="form-control">
        </div>

        <div class="col-md-3">
          <input type="submit" value="Buscar Alianzas" id="buscarConvenios" class="btn btn-new">
        </div>
      </div>


      <div class="clearfix"></div><br><br><br>

      <div class="row">
        <div class="col-lg-12">
          <table class="table table-bordered table-striped table-hovered">
              <thead>
                  <th>Microempresario</th>
                  <th>Alianzas</th>
                  <th>Estado</th>
              </thead>
              <tbody id="body_convenio">

              </tbody>
          </table>
        </div>
      </div>


    </div>

  </div>
</div>
<div class="clearfix"></div>

<br>
<br>
<br>

<?php
$id_pais = $this->functions->id_pais($this->functions->texto_general(7));
?>


<script>


$(document).on('click', '#buscarConvenios', function(event){
    event.preventDefault();
    rut = $('#rut').val();
    pais = <?php echo $id_pais; ?>;

    if(rut != '' && pais != ''){
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/datos_validacion_facil',
            data:{ rut:rut, pais:pais },
            success: function(res){
                $('#body_convenio').html(res);
            }
        });
    } else {
        swal('Atención', 'Debe ingresar Rut para realizar una búsqueda', 'warning');
    }

});

</script>