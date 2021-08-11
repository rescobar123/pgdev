<script>
$(document).ready(function(){//.bt-exit-system es la clase del boton
	    $('.btn-exit-system').on('click', function(e){
        e.preventDefault();
        var Token=$(this).attr('href');//queremos recuperar el valor que viene en el href
        swal({
            title: 'Estás seguro?',
            text: "La sesión actual se cerrará y deberás iniciar sesión nuevamente",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#03A9F4',
            cancelButtonColor: '#F44336',
            confirmButtonText: '<i class="zmdi zmdi-run"></i> Si, Cerrar!',
            cancelButtonText: '<i class="zmdi zmdi-close-circle"></i> No, Cancelar!'
        }).then(function () {//Cuando el usuario de click en el boton
            $.ajax({
                url: '<?php echo SERVERURL ?>ajax/loginAjax.php?Token='+Token,//token viene de var Token
                success: function(data){
                    if (data=="true") {
                        window.location.href="<?php echo SERVERURL ?>login/";
                    }else{
                        swal(
                            "Ocurrio un error",
                            "No se puedo cerrar la sesion",
                            "error"
                            );
                    }
                }
            });
        });
    });
});
</script>
