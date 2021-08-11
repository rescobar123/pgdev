<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administración <small>PRUEBA DE CONFIANZA</small></h1>
	</div>
</div>
<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	    <li>
	  		<a href="<?php echo SERVERURL; ?>confidencetest/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVA PRUEBA DE CONFIANZA
	  		</a>
	  	</li>
	  	<li>
	  		<a href="<?php echo SERVERURL; ?>confidencetestlist/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PRUEBAS DE CONFIANZA
	  		</a>
	  	</li>
	</ul>
</div>
<!-- Panel nueva prueba de confianza -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; NUEVO PRUEBA DE CONFIANZA</h3>
		</div>
		<div class="panel-body">
			<form>
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment-o"></i> &nbsp; Información de la prueba</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">Agente: </label>
								  	<select class="form-control" name="sede-reg">
								  		<option value="1">Robin Eriberto Escobar</option>
								  		<option value="2">Juan Garcia</option>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">Tipo de Prueba: </label>
								  	<select class="form-control" name="sede-reg">
								  		<option value="1">Doping</option>
								  		<option value="2">Polígrafo</option>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Fecha de la prueba *</label>
								  	<input class="form-control"  type="date" value="<?php echo date("Y-m-d");?>" name="fecha-reg" required="" maxlength="30">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Justificación</label>
								  	<textarea pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="alergias-reg" maxlength="40"> </textarea>
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
			    <p class="text-center" style="margin-top: 20px;">
			    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
		    </form>
		</div>
	</div>
</div>