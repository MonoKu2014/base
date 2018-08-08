<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Portal Microempresa(rios)</title>

    <script type="text/javascript" src="<?= JS_PATH;?>jquery-1.10.1.min.js"></script>
    <script type="text/javascript" src="<?= JQUERYUI_PATH;?>jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= BOOTSTRAP_NEWPATH;?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?= JS_PATH;?>jquery-confirm.min.js"></script>
    <script type="text/javascript" src="<?= JS_PATH;?>flexy-menu.js"></script>
    <script src="<?= JS_PATH;?>bootstrap-hover-dropdown.js"></script>
    <script src="<?= JS_PATH;?>jquery-multifile.js"></script>
    <script src="<?= JS_PATH;?>scripts.js"></script>
    <script src="<?= JS_PATH;?>sweetalert.min.js"></script>

    <!-- ARCHIVOS DE CSS PARA PANEL DE CONTROL -->
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>normalize.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>base.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>base-ms.css">
    <link rel="stylesheet" type="text/css" href="<?= FONTAWESOME_PATH;?>font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>sweetalert.css">
    <link rel="stylesheet" type="text/css" href="<?= CSS_PATH;?>chat.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,600italic,700,800' rel='stylesheet' type='text/css'>

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>
  var APP_URL = '<?= base_url();?>';
</script>
</head>
<body onload="ajax();" data-session="<?= $this->session->id; ?>">

    <div id="contenedor" class="container">

        <div class="row">
            <div class="col-lg-12">
                <div id="caja-chat">
                    <div id="chat"></div>
                </div>
            </div>
        </div>

        <div class="row" id="send">
            <div class="col-lg-12">
                <form>
                    <textarea id="mensaje" placeholder="Ingresa tu mensaje"></textarea>
                    <input type="button" id="enviar" name="enviar" value="Enviar" class="btn btn-new btn-extend">
                </form>
            </div>
        </div>

    </div>


<script>

var id = '<?= $empresa->id_empresa; ?>';
var id_session = $('body').data('session');

function ajax(){

    $.ajax({
        type: 'post',
        url: APP_URL + 'rse/get_chat',
        data:{id:id, id_session:id_session},
        success: function(res){
            $('#chat').append(res);
        }
    });

}



$(document).ready(function(){

    $('#enviar').on('click', function(){
        var mensaje = $('#mensaje').val();
        var id = '<?= $empresa->id_empresa; ?>';
        if(mensaje.trim() != ''){
            $.ajax({
                type: 'post',
                url: APP_URL + 'rse/post_chat',
                data:{id:id, mensaje:mensaje},
                success: function(res){
                    $('#mensaje').val('');
                    ajax_dos();
                }
            });
        }
    });

    function ajax_dos(){
        var id = '<?= $empresa->id_empresa; ?>';
        var id_session = $('body').data('session');
        $.ajax({
            type: 'post',
            url: APP_URL + 'rse/get_chat_dos',
            data:{id:id, id_session:id_session},
            success: function(res){
                $('#chat').append(res);
            }
        });

    }

    setInterval(function(){ajax_dos();}, 1000);


});

</script>

</body>
</html>