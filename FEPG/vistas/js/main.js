$(document).ready(function(){
	$('.btn-sideBar-SubMenu').on('click', function(e){
		e.preventDefault();
		var SubMenu=$(this).next('ul');
		var iconBtn=$(this).children('.zmdi-caret-down');
		if(SubMenu.hasClass('show-sideBar-SubMenu')){
			iconBtn.removeClass('zmdi-hc-rotate-180');
			SubMenu.removeClass('show-sideBar-SubMenu');
		}else{
			iconBtn.addClass('zmdi-hc-rotate-180');
			SubMenu.addClass('show-sideBar-SubMenu');
		}
	});

	$('.btn-menu-dashboard').on('click', function(e){
		e.preventDefault();
		var body=$('.dashboard-contentPage');
		var sidebar=$('.dashboard-sideBar');
		if(sidebar.css('pointer-events')=='none'){
			body.removeClass('no-paddin-left');
			sidebar.removeClass('hide-sidebar').addClass('show-sidebar');
		}else{
			body.addClass('no-paddin-left');
			sidebar.addClass('hide-sidebar').removeClass('show-sidebar');
		}
	});
	

        $('.FormularioAjax').submit(function(e){
        e.preventDefault();

        var form=$(this);//Seleccionamos el formulario
        //que se esta seleccionando

        var tipo=form.attr('data-form');//esto viene en el formulario y representa el tipo de formulario que sera
        var accion=form.attr('action');
        var metodo=form.attr('method');
        var respuesta=form.children('.RespuestaAjax');

        var msjError="<script>alert('Ocurrió un error inesperado','Por favor recargue la página','error');</script>";
        var formdata = new FormData(this);//array de datos del formulario
 

        var textoAlerta;//texto que aparecera en la alerta
        if(tipo==="save"){
            textoAlerta="Los datos que enviaras quedaran almacenados en el sistema";
        }else if(tipo==="delete"){
            textoAlerta="Los datos serán eliminados completamente del sistema";
        }else if(tipo==="update"){
            textoAlerta="Los datos del sistema serán actualizados";
        }else{
            textoAlerta="Quieres realizar la operación solicitada";
        }

        if (confirm(textoAlerta)) {
        	//respuesta.html('<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div><div class="modal-body">Select "Logout" below if you are ready to end your current session.</div><div class="modal-footer"><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button><a class="btn btn-primary" href="login.html">Logout</a></div></div></div></div>');
        	$.ajax({
                type: metodo,//Metodo que viene en el form
                url: accion,//pagina a donde ira el form
                data: formdata ? formdata : form.serialize(),//form data trae el array de los datos
                cache: false,
                contentType: false,
                processData: false,//para enviar archivos aca esta deshabilitado con false
                xhr: function(){
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function(evt) {
                      if (evt.lengthComputable) {
                        var percentComplete = evt.loaded / evt.total;
                        percentComplete = parseInt(percentComplete * 100);
                        if(percentComplete<100){//Respuesta trae los hijos del formulario para un preload
                            respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>');
                        }else{
                            respuesta.html('<p class="text-center"></p>');
                        }
                      }
                    }, false);
                    return xhr;
                },
                success: function (data) {
                   
                    var message;
                    
                   if(data == 'OK'){
                     if(tipo==="save"){
                        message="<script>alert('Operacion exitosaaaaaaaaa'); $('.FormularioAjax')[0].reset(); </script>";
                        
                    }else if(tipo==="delete"){
                        message="<script>alert('Operacion exitosavv'); location.reload();</script>";
                    }else if(tipo==="update"){
                        message="<script>alert('Actualizado bien'); location.reload();</script>";
                    }else{
                        message="<script>alert('Operacion exitosann');</script>";
                    }
                     
                   }else{
                    if(tipo==="save"){
                        message="<script>alert('Guardado con error');</script>";
                    }else if(tipo==="delete"){
                        message="<script>alert('Borrado con error');</script>";
                    }else if(tipo==="update"){
                        message="<script>alert('Actualizacion con errorError');</script>";
                    }else{
                        message="<script>alert('Error general');</script>";
                    }
                    
                   }
                    respuesta.html(message);//Mandamamos la info que traimos a respuesta
                   // respuesta.html(tipoAlerta);
                    console.log(data);
                },
                error: function() {
                    respuesta.html(msjError);
                }
            });
        } else {
        	return false;
        }
    });
});
(function($){
    $(window).on("load",function(){
        $(".dashboard-sideBar-ct").mCustomScrollbar({
        	theme:"light-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
        $(".dashboard-contentPage, .Notifications-body").mCustomScrollbar({
        	theme:"dark-thin",
        	scrollbarPosition: "inside",
        	autoHideScrollbar: true,
        	scrollButtons: {enable: true}
        });
    });
})(jQuery);