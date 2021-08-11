<head>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
</head>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Eventos <small>Administración</small></h1>
	</div>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	    <li>
	  		<a href="<?php echo SERVERURL; ?>event/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO EVENTO
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>eventlist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EVENTOS
	  		</a>
	  	</li>
	</ul>
</div>
<?php require_once "./controladores/EventoControlador.php"; 
	$datos = new EventoControlador();
?>
<!-- Panel nueva prueba de confianza -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO EVENTO</h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="newevent">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información del evento</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombre del Evento *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Lugar del Evento *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="lugar-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="tipoEvento-reg">Tipo de Evento: *</label>
								  	<select id="tipoEvento-reg" class="form-control" name="tipoEvento-reg" >
								  		<option value="" selected="" disabled="">Seleccione el tipo de Evento</option>
								  		<?php echo 
								  		$datos->seleccionarTipoEventoControlador(); ?>
								  	</select>
								</div>
		    				</div>
						
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">Participantes: *</label>
								  	<select id="participantes-reg[]" data-placeholder="Participantes" multiple class="standardSelect form-control" name="participantes-reg[]">
								  		<option value="" selected="disabled"></option>
								  		<?php echo 
								  		$datos->selectParticipanteEventoControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Fecha del evento *</label>
								  	<input class="form-control"  type="date" value="<?php echo date("Y-m-d");?>" name="fecha-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				
							
							
							<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Hora del Evento *</label>
								  	<input class="form-control"  type="time"  name="hora-reg" required="" >
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Descripción</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,100}" class="form-control" type="text" name="descripcion-reg" maxlength="100"> </textarea>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
			    <p class="text-center" style="margin-top: 20px;">
			    	<button id="dato" type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
			     <div class="RespuestaAjax"></div>
		    </form>
		</div>
	</div>
</div>
 <script  src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
 <script type="text/javascript">
    $(function() {
      $(".standardSelect").chosen();
    });
  </script>


  
 
