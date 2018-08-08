

</div> <!-- FIN DEL WRAPPER QUE EMPIEZA EN NAV.PHP -->


<script>
	$('#menu-toggle').on('click', function(e) {
	    e.preventDefault();
	    $('#wrapper').toggleClass('toggled');
	});




  function ConfirmAlert(id_delete, Url){
      $.confirm({
          title: 'Alerta!',
          confirmButton: 'Si',
          cancelButton: 'NO',
          confirmButtonClass: 'btn btn-info',
          cancelButtonClass: 'btn btn-danger',
          dialogClass: "modal-dialog modal-lg",
          content: 'Esta seguro que desea eliminar éste registro?',
          icon: 'fa fa-warning',
          confirm: function(){
            window.location = Url + '/' + id_delete;
          },
          cancel: function(){
            return;
          }
      });  
  }


  $(document).ready(function(){
      $('.table').DataTable();

      $(window).resize(function(){
            var ancho_ventana = $(window).width();
            if(ancho_ventana > 995){
              $('#wrapper').removeClass('toggled');
            }
      });


  });

</script>

</body>
</html>