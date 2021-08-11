<?php require_once "./controladores/AgenteControlador.php"; 
	$datos = new AgenteControlador();
	$datosAgente = new AgenteControlador();
	$infoAgente = $datosAgente->seleccionarInformacionAgenteControlador();

?>
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Administración <small>EDITAR AGENTE</small></h1>
	</div>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>agent/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO AGENTE
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>agentlist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE AGENTES
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL ?>agentsearch/" class="btn btn-primary">
	  			<i class="zmdi zmdi-search"></i> &nbsp; BUSCAR AGENTE
	  		</a>
	  	</li>
	</ul>
</div>
<div class="container-fluid">
	<div class="panel panel-warning">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS DE: <?php echo $infoAgente['AgenteNombre'].' '.$infoAgente['AgenteApellido'] ?> </h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="upAgent">
				<input type="hidden" name="idAgente" value="<?php echo $infoAgente['IdAgente'] ?>" >
				<input type="hidden" name="fotoVieja" value="<?php echo $infoAgente['AgenteFoto'] ?>" >
				<input type="hidden" name="fichaMedicaVieja" value="<?php echo $infoAgente['AntecedentesFichaMedica'] ?>">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">DPI/NÚMERO DE IDENTIFICACIÓN PERSONAL</label>
								  	<input pattern="[0-9-]{1,30}" value="<?php echo $infoAgente['AgenteDpi'] ?>" class="form-control" type="text" name="dpi-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombres del Agente *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $infoAgente['AgenteNombre'] ?>" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Apellidos del Agente *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $infoAgente['AgenteApellido'] ?>" class="form-control" type="text" name="apellido-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Fecha Nacimiento *</label>
								  	<input class="form-control"  type="date" value="<?php echo $infoAgente['AgenteNacimiento'] ?>" name="nacimiento-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Grado Académico *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $infoAgente['AgenteGradoAcademico'] ?>" class="form-control" type="text" name="gradoAcademico-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				
		    			</div>
		    		</div>
		    	</fieldset>
		    	<br>
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Otros datos</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">Sede: </label>
						    		<select required="" class="form-control" name="sede-reg">
						    			<option value="<?php echo $infoAgente['IdSede'] ?>" selected="" ><?php echo $infoAgente['SedeNombre'] ?></option>
								  		<?php echo $datos->seleccionarSedesControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="idPuesto-reg">Puesto: </label>
								  	<select required="" class="form-control" name="idPuesto-reg">
						    			<option value="<?php echo $infoAgente['IdPuesto'] ?>" selected="" ><?php echo $infoAgente['PuestoNombre'] ?></option>
								  		<?php echo $datos->seleccionarPuestosControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="estado-reg">Estado: </label>
								  	<select required="" class="form-control" name="estado-reg">
						    			<option value="<?php echo $infoAgente['IdEstado'] ?>" selected="" ><?php echo $infoAgente['EstadoNombre'] ?></option>
								  		<?php echo $datos->seleccionarEstadosControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label class="control-label">Grupo</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="grupo-reg" id="optionsRadios1" value="<?php echo $infoAgente['AgenteGrupo'] ?>" checked="">
											 &nbsp; <?php echo $infoAgente['AgenteGrupo'] ?>
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="grupo-reg" id="optionsRadios1" value="A" >
											 &nbsp; A
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="grupo-reg" id="optionsRadios2" value="B">
											 &nbsp; B
										</label>
									</div>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label class="control-label">Esta de Turno?</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="turno-reg" id="turnosi" value="<?php echo $infoAgente['AgenteTurno'] ?>"  checked="">
											 &nbsp; <?php echo $infoAgente['AgenteTurno'] ?>
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="turno-reg" id="turnosi" value="Si" >
											 &nbsp; Si
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="turno-reg" id="turnono" value="No">
											 &nbsp; No
										</label>
									</div>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-face"></i> &nbsp; Datos Médicos</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Peso *</label>
								  	<input step="0.01" class="form-control" value="<?php echo $infoAgente['AntecedentesPeso'] ?>"  type="number"  name="peso-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Estatura *</label>
								  	<input step="0.01" class="form-control" value="<?php echo $infoAgente['AntecedentesEstatura'] ?>" type="number"  name="estatura-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Peso Ideal *</label>
								  	<input step="0.01" class="form-control" value="<?php echo $infoAgente['AntecedentesPesoIdeal'] ?>" type="number"  name="pesoIdeal-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Problemas Médicos</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $infoAgente['AntecedentesProblemasMedicos'] ?>"  class="form-control" type="text" name="problemasMedicos-reg" maxlength="40"> </textarea>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Alergias</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" value="<?php echo $infoAgente['AntecedentesAlergias'] ?>" class="form-control" type="text" name="alergias-reg" maxlength="40"> </textarea>
								</div>
		    				</div>
		    				<div class="col-xs-12">
	    					<div class="form-group">
	    						<span class="control-label">Ficha Medica</span>
								<input type="file" required=""  name="fichaMedica" accept=".jpg, .png, .jpeg, .pdf">
								<div class="input-group">
									<input type="text" readonly="" class="form-control" placeholder="Elija el documento...">
									<span class="input-group-btn input-group-sm">
										<button type="button" class="btn btn-fab btn-fab-mini">
											<i class="zmdi zmdi-attachment-alt"></i>
										</button>
									</span>
								</div>
								<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG, JPG y PDF</small></span>
							</div>
	    				</div>
		    				
		    			</div>
		    		</div>
		    	</fieldset>
		    	<fieldset>
					<legend><i class="zmdi zmdi-attachment-alt"></i> &nbsp; Elegir Foto</legend>
					<div class="col-xs-12">
    					<div class="form-group">
    						<span class="control-label">Imágen</span>
							<input type="file" name="foto"  required="" accept=".jpg, .png, .jpeg">
							<div class="input-group">
								<input type="text" readonly="" class="form-control" placeholder="Elija la imágen...">
								<span class="input-group-btn input-group-sm">
									<button type="button" class="btn btn-fab btn-fab-mini">
										<i class="zmdi zmdi-attachment-alt"></i>
									</button>
								</span>
							</div>
							<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG y JPG</small></span>
						</div>
    				</div>
    			</fieldset>
		    	<br>
			    <p class="text-center" style="margin-top: 20px;">
			    	<button type="submit" class="btn btn-warning btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> ACTUALIZAR</button>
			    </p>
			    <div class="RespuestaAjax"></div>
		    </form>
		</div>
	</div>
</div>