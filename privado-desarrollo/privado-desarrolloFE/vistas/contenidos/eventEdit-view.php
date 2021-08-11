<?php require_once "./controladores/EventoControlador.php"; 
	$datos = new EventoControlador();
	$dato = $datos->seleccionarInformacionEventosControlador();//traemos los datos del evento
	$nombre = $datos->seleccionarNombreParticipanteControlador();
	$tipoEvento = $datos->seleccionarNombreTipoEventoControlador();

	$arrayParticipantes = explode('/',$nombre);
	$Ids = $arrayParticipantes[0];
	$nombres = $arrayParticipantes[1];



	$separador=',';
	$cadenaNombres = str_replace(' ,', $separador, $nombres);
	$cadenaIds = str_replace(' ','',$Ids);

	//tenemos una variable de tipo cadena
	//la cual convertiremos a array con explode()
	$id = explode(',',$cadenaIds);
	
	//recorremos el array para verificar si tiene 
	//valores vacios y eliminarlos
	foreach($id as $clave=>$valor){
	    if(empty($valor)){
	        unset($id[$clave]);
	    }
	}
	
	//creamos un nuevo array y le agregamos nuevas
	//clave  al mismo con array_merge
	$agentesIds = array_merge($id);

	/*INTENTALO CON UNA CADENA QUE TENGA COMAS AL INICIO 
	O AL FINAL */


	$agente = explode(',',$cadenaNombres);
	foreach($agente as $clave=>$valor){
	    if(empty($valor)){
	        unset($agente[$clave]);
	    }
	}
	$agentes = array_merge($agente);



?>

<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
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

<!-- Panel nueva prueba de confianza -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; ACTUALIZAR EVENTO:  <?php echo $dato['nombre'].' '.$dato['lugar'] ?> </h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="updateEvento">
				<input type="hidden" name="idEvento" value="<?php echo $dato['id'] ?>">
				<input type="hidden" name="agentes" value="<?php echo $nombres ?>">
				<input type="hidden" name="idAgentes" value="<?php echo $cadenaIds ?>">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información  evento</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombre del Evento *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}"  value="<?php echo $dato['nombre'] ?>" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Lugar del Evento *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $dato['lugar']?>" class="form-control" type="text" name="lugar-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">Tipo de Evento: *</label>
								  	<select class="form-control" name="tipoEvento-reg">
								  		<option value="<?php echo $tipoEvento[0];
								  		?>" selected="" ><?php echo $tipoEvento[1];
								  		?></option>
								  		<?php echo 
								  		$datos->seleccionarTipoEventoControlador(); ?>
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
								  	<input class="form-control" value="<?php echo $dato['hora_evento']?>" type="time"  name="hora-reg" required="" >
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Descripción</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}"  class="form-control" type="text" name="descripcion-reg" value="" maxlength="40"><?php echo $dato['descripcion']?></textarea>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
		    	<div class="panel-body">
								<div class="table-responsive">
									<table class="table table-striped table-bordered display" id="table_id">
										<thead>
											<tr>
												<th class="text-center">Participante</th>
												<th class="text-center">Punteo</th>
												<th class="text-center">Observaciones</th>
											</tr>
										</thead>
										<?php
										for($i=0;$i<count($agentes);$i++){ ?>
											<tr>
												<td><?php echo $agentes[$i]?></td>
												<td><input class="form-control" placeholder="punteo" type="Number" name="input<?php echo $agentesIds[$i]?>" require></td>
												<td><input class="form-control" placeholder="observaciones" type="text" name="observacion<?php echo $agentesIds[$i]?>" require></td>
											</tr>
											
											<?php
										}
										?>

									</table>
								</div>
							</div>
			    <p class="text-center" style="margin-top: 20px;">
			    	<button id="enviar" type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
			     <div class="RespuestaAjax"></div>
		    </form>
		</div>
	</div>
</div>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
<script type="text/javascript">
	 $(function() {
      $('#table_id').DataTable();
    });
</script>

  