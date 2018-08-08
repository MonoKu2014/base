
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
        <div class="col-md-2 col-xs-12 logo-footer">
        <img src="<?= RSE_IMAGES_PATH;?>portal-microempresarios.svg" class="img-responsive" alt="Portal">
        </div>

        <div class="col-md-2 col-xs-12">
            <p><strong>Acerca de:</strong></p>
            <p>
            <small>
                <a class="white" href="<?= base_url();?>acerca_de">a. Portal Microempresa(rios)</a><br />
                <a class="white" href="<?= base_url();?>listado_categorias">b. Mapa del Sitio</a><br />
                <a class="white" href="<?= base_url();?>contactenos">c. Contáctenos</a><br />
                <a class="white" href="<?= base_url();?>beneficios">d. Beneficios para Microempresa(rios)</a><br />
                <a class="white" href="<?= base_url();?>beneficios_inscritos">e. Beneficios para Clientes Inscritos</a><br>
                <a class="white" href="<?= base_url();?>preguntas_frecuentes">f. Preguntas Frecuentes</a>
                
            </small>
            </p>
        </div>

        <div class="col-md-2 col-xs-12">
            <p><strong>Ayuda:</strong></p>
            <p>
            <small>
                <a class="white" href="<?= base_url();?>publicar_microempresario">a. Publicar Microempresa(rio)</a><br />
                <a class="white" href="<?= base_url();?>ayuda">b. Inscripción</a><br />
                <a class="white" href="<?= base_url();?>recomendar">c. Recomendar</a><br />
                <a class="white" href="<?= base_url();?>seguir_promociones">d. Seguir Promociones</a><br />
                <a class="white" href="<?= base_url();?>seguir_recomendaciones">e. Seguir Recomendaciones</a><br />
            </small>
            </p>
        </div>

        <div class="col-md-2 col-xs-12">
            <p><strong>Microempresas:</strong></p>
            <p>
            <small>
                <a class="white" href="<?= base_url();?>">a. Publicar Microempresa(rio)</a><br />
                <a class="white" href="<?= base_url();?>agregar_producto">b. Publicar Producto</a><br />
                <a class="white" href="<?= base_url();?>agregar_servicio">c. Publicar Servicio</a><br />
                <a class="white" href="<?= base_url();?>crear_promocion">d. Publicar Promoción</a>
            </small>
            </p>
        </div>

        <div class="col-md-2 col-xs-12">
            <p><strong>Usuarios Clientes:</strong></p>
            <p>
            <small>
                <a class="white" href="<?= base_url();?>registro">a. Recibir Promociones por E-mail</a><br />
                <a class="white" href="<?= base_url();?>">b. Buscar Microempresa(rio)</a><br />
                <a class="white" href="<?= base_url();?>">c. Buscar Producto</a><br />
                <a class="white" href="<?= base_url();?>">d. Buscar Servicio</a><br />
            </small>
            </p>
        </div>

        <div class="col-md-2 col-xs-12">
            <p><strong>Redes Sociales:</strong></p>
            <p>
            <small>
                <a class="white" href="https://www.facebook.com/PortalMicroempresarios/?fref=ts" target="_blank"><i class="fa fa-facebook-square white" aria-hidden="true"></i> Facebook</a><br />
                <a class="white" href="https://twitter.com/PortalMicroem" target="_blank"><i class="fa fa-twitter-square white" aria-hidden="true"></i> Twitter</a><br />
                <a class="white" href="https://www.linkedin.com/company/17880257?trk=tyah&trkInfo=clickedVertical%3Acompany%2CclickedEntityId%3A17880257%2Cidx%3A1-1-1%2CtarId%3A1482209186237%2Ctas%3Aportal-microemp" target="_blank"><i class="fa fa-linkedin-square white" aria-hidden="true"></i> Linkedin</a>
            </small>
            </p>
        </div>
                
                
        </div>
    </div>
</footer>

    <script type="text/javascript" src="<?= RSE_PUSH_PATH;?>push.min.js"></script>
    <script>
    $('.carousel').carousel({
        interval: 5000
    });
    </script>

        <script>
            $(document).ready(function(){
                $(".panel a").click(function(e){
                    e.preventDefault();
                    var style = $(this).attr("class");
                    var menustyle = $(".flexy-menu").attr("class");
                    if(menustyle.indexOf("light") > -1){
                        $(".flexy-menu").removeAttr("class").addClass("flexy-menu vertical light").addClass(style);
                    }
                    else{
                        $(".flexy-menu").removeAttr("class").addClass("flexy-menu vertical").addClass(style);
                    }
                });
            });
        </script>

        
<script>
    
var id_session_client = '<?php echo $this->session->id;?>';    


if(id_session_client != ''){


    setInterval(function(){ 


        $.ajax({
          type: 'post',
          url: APP_URL + 'ajax/mostrar_notificacion',
          dataType: 'json',
          success: function(res){

                if(res.state == 0){

                    $.ajax({
                      type: 'post',
                      url: APP_URL + 'ajax/marcar_leidas_push',
                      data: {id_notificacion:res.id_notificacion}
                    });

                    Push.create(res.title, {
                        body: res.message,
                        icon: '<?php echo base_url();?>rse_components/images/push.jpg',
                        timeout: 9000,
                        onClick: function () {
                            this.close();
                            window.location = res.url_destiny;
                        }
                    });

                }

          }
        });

         
    }, 10000);

}


</script>

<!-- INICIAR SESIÓN MODAL -->
<div id="iniciar-sesion" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <br>            
        </div>
        <div class="modal-body">
        <div class="clearfix"></div>
          <div class="col-lg-12">

        <div class="col-sm-12">
          <h1>Ingresar</h1><br>
          <p id="mensaje-modal-iniciar-sesion"></p>
        </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Email</strong></p>
            <input name="email" type="text" class="form-control datos" id="usuario-modal" placeholder="Ingrese su correo" required />
          </div>
          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <p class="p-formulario"><strong>Contraseña</strong></p>
            <input name="password" type="password" class="form-control datos" id="password-modal" placeholder="Ingrese su contraseña" required />
          </div>
          <div class="form-group col-lg-6">
            <input type="submit" class="btn btn-info col-xs-12" value="Ingresar" id="button-modal" />
          </div>
        <div class="clearfix"></div>
        <div class="col-xs-12">
        <p><small>¿Olvidaste tu contraseña? <a href="<?= base_url();?>registro/recuerda_password">Recupérala aquí</a></small></p>
        <br>
        <h2>¿No estás registrado?, <a class="orange" href="<?= base_url();?>registro_paso_uno">Incríbete Aquí</a></h2>
        </div>

          </div>
        <div class="clearfix"></div>
        </div>
        <div class="modal-footer">
          <div class="clearfix"></div>
          <div class="col-md-12">
              <button class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
</div>

<script>

var url_destination = '';

$('.iniciar-sesion-link').on('click', function(){

    url_destination = $(this).data('url');

});


    $('#password-modal').on('keypress', function(e){
         var code = e.keyCode || e.which;
         if(code == 13) {
            iniciar_sesion_modal();
         }
    });


$('#button-modal').on('click', function(){   
    iniciar_sesion_modal();
});


function iniciar_sesion_modal(){
    var password = $('#password-modal').val();
    var usuario  = $('#usuario-modal').val();

    if(password.trim() == '' || usuario.trim() == ''){
        $('#mensaje-modal-iniciar-sesion').empty()
        .html('<span class="red">Ingresa tus datos para iniciar sesión</span>');
    } else {
        $.ajax({
            type: 'post',
            url: APP_URL + 'ajax/iniciar_sesion',
            data: { password:password, usuario:usuario, url:url_destination },
            dataType: 'json',
            success: function(res){
                if(res.estado == 1){
        $('#mensaje-modal-iniciar-sesion').empty()
        .html('<span class="red">Usuario o contraseña inválidos</span>');
                } else {
                    window.location = res.url;
                }
            }
        });
    }
}



</script>

</body>
</html>
