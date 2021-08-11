<!-- Content page -->
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
</head>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Administración <small>INVENTARIO DE ARMAS</small></h1>
	</div>
</div>

<div class="container-fluid">
	<ul class="breadcrumb breadcrumb-tabs">
	  	<li>
	  		<a style="border: 1px solid #5bc0de" href="<?php echo SERVERURL; ?>book/" class="btn btn-info">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVO EQUIPO
	  		</a>
	  	</li>
	  	
	  	<li>
	  		<a style="border: 1px solid #6cc070" href="<?php echo SERVERURL; ?>asignarequipo/" class="btn btn-success">
	  			<i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; ASIGNAR  EQUIPOS
	  		</a>
	  	</li>
	  	
	</ul>
</div>
<?php require_once "./controladores/InventarioEquipoControlador.php"; 
	$datos = new InventarioControlador();
?>
<!-- panel datos de la empresa -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS DEL ARMA</h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="newarma">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombre del equipo *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" required="" maxlength="50">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">No. registro *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="numero-reg" required="" maxlength="50">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Municiones Asignadas *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="Number" name="municiones-reg" required="" maxlength="50">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Cargadores Asignados *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="Number" name="cargadores-reg" required="" maxlength="50">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Marca *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="marca-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Calibre *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ-0-9 ]{1,40}" class="form-control" type="text" name="calibre-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-4">
						    	<div class="form-group label-floating">
								  	<select id="sede-reg" class="form-control" name="sede-reg" >
								  		<option value="" selected="" disabled="">Seleccione una sede</option>
								  		<?php echo $dato = $datos->seleccionarSedeInventarioControlador();?>
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-4">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Cantidad *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="Number" name="cantidad-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-4">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Entidad a la que pertenece *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="entidad-reg" required="" maxlength="40">
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Descripcion *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,80}" class="form-control" type="text" name="descripcion-reg" required="" maxlength="500">
								</div>
		    				</div>
		    			</div>
		    		</div>
		    	</fieldset>
			    <p class="text-center" style="margin-top: 20px;">
			    	<button type="submit" class="btn btn-info btn-raised btn-sm"><i class="zmdi zmdi-floppy"></i> Guardar</button>
			    </p>
			    <div class="RespuestaAjax"></div>
		    </form>
		</div>
	</div>
</div>
<br>
<br>
<br>
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EQUIPOS SEGURIDAD</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered display" id="table_id">
					<?php echo $dato = $datos-> seleccionarArmasControlador();?>
				</table>
			</div>
		</div>
	</div>
</div>
<br>
<br><br>

<br>
<br>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
<script type="text/javascript">
	 $(function() {
      $('#table_id').DataTable();
    });
</script>


