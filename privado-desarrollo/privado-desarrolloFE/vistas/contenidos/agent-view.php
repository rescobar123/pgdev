<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Administración <small>AGENTE</small></h1>
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
<?php require_once "./controladores/AgenteControlador.php"; 
	$datos = new AgenteControlador();
?>
<!-- panel datos de la empresa -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS DEL AGENTE</h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="newAgent">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">DPI/NÚMERO DE IDENTIFICACIÓN PERSONAL</label>
								  	<input pattern="[0-9-]{1,30}" class="form-control" type="text" name="dpi-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombres del Agente *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Apellidos del Agente *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="apellido-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Fecha Nacimiento *</label>
								  	<input class="form-control"  type="date" value="<?php echo date("Y-m-d");?>" name="nacimiento-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Grado Académico *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="gradoAcademico-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Dirección *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="direccion-reg" required="" maxlength="100">
								</div>
		    				</div>
		    				<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">Adjuntar DPI ambos lados *</span>
									<input type="file" name="dpi"  accept=".jpg, .png, .jpeg .pdf">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija el documento...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG, JPG Y PDF</small></span>
								</div>
		    				</div>
		    				<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">Adjuntar LICENCIA ambos lados *</span>
									<input type="file" name="licencia"  accept=".jpg, .png, .jpeg .pdf">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija la documento...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG, JPG Y PDF</small></span>
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
						    			<option value="" selected="" disabled="">Seleccione una Sede</option>
								  		<?php echo $datos->seleccionarSedesControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="idPuesto-reg">Puesto: </label>
								  	<select required="" class="form-control" name="idPuesto-reg">
						    			<option value="" selected="" disabled="">Seleccione un Puesto</option>
								  		<?php echo $datos->seleccionarPuestosControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="estado-reg">Estado: </label>
								  	<select required="" class="form-control" name="estado-reg">
						    			<option value="" selected="" disabled="">Seleccione un Estado</option>
								  		<?php echo $datos->seleccionarEstadosControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-3">
								<div class="form-group">
									<label class="control-label">Grupo</label>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="grupo-reg" id="optionsRadios1" value="A" checked="">
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
											<input type="radio" name="turno-reg" id="turnosi" value="Si" checked="">
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
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Contacto de Emergencia *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="contactoEmergencia-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Contacto Personal *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="contactoPersonal-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Tiene Tatuajes *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="tatuajes-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12">
		    					<div class="form-group">
		    						<span class="control-label">Adjuntar CV*</span>
									<input type="file" name="cv"  accept=".pdf">
									<div class="input-group">
										<input type="text" readonly="" class="form-control" placeholder="Elija el documento...">
										<span class="input-group-btn input-group-sm">
											<button type="button" class="btn btn-fab btn-fab-mini">
												<i class="zmdi zmdi-attachment-alt"></i>
											</button>
										</span>
									</div>
									<span><small>Tamaño máximo de los archivos adjuntos 5MB. Tipos de archivos permitidos imágenes: PNG, JPEG, JPG Y PDF</small></span>
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
								  	<input step="0.01" class="form-control" type="number"  name="peso-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Estatura *</label>
								  	<input step="0.01" class="form-control" type="number"  name="estatura-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Peso Ideal *</label>
								  	<input step="0.01" class="form-control" type="number"  name="pesoIdeal-reg" required="">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="tipoSangre-reg">Tipo de Sangre: </label>
						    		<select required="" class="form-control" name="sede-reg">
						    			<option value="" selected="" disabled="">Seleccione un tipo de sangre</option>
								  		<?php echo $datos->seleccionarSangreControlador(); ?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Problemas Médicos</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="problemasMedicos-reg" maxlength="40"> </textarea>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Alergias</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="alergias-reg" maxlength="40"> </textarea>
								</div>
		    				</div>
		    				
		    				<div class="col-xs-12">
	    					<div class="form-group">
	    						<span class="control-label">Ficha Medica</span>
								<input type="file" required="" name="fichaMedica" accept=".jpg, .png, .jpeg, .pdf">
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
							<input type="file" name="foto"  accept=".jpg, .png, .jpeg">
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
			    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
			    <div class="RespuestaAjax"></div>
		    </form>
		</div>
	</div>
</div>