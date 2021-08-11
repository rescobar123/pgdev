<!-- Content page -->
<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">

</head>

<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> ASIGNACION <small>INVENTARIO DE EQUIPOS VARIOS</small></h1>
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
	  		<a style="border: 1px solid #6cc070" href="<?php echo SERVERURL; ?>bookarma/" class="btn btn-success">
	  			<i class="zmdi zmdi-plus"></i> &nbsp; NUEVA ARMA
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
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; ASIGNAR EQUIPO </h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="newasignacion">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-4">
						    	<div class="form-group label-floating">
								  	<select id="persona-reg" class="form-control" name="persona-reg" >
								  		<option value="" selected="" disabled="">Asignar a:</option>
								  		<?php echo $dato = $datos->seleccionarPersonalDivisionControlador();?>
								  		
								  	</select>
								</div>
		    				</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
						    		<label for="equipo-reg">ASIGNAR EQUIPO *</label>
								  	<select id="equipo-asignar-reg[]" data-placeholder="equipo-asignar" multiple class="standardSelect form-control" name="equipo-asignar-reg[]">
								  		<option value="" selected="disabled"></option>
								  		<?php echo $dato = $datos->seleccionarEquipoAgenteControlador();?>
								  	</select>
								</div>
							</div>
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">ASIGNAR ARMA *</label>
								  	<select id="arma-asignar-reg[]" data-placeholder="arma-asignar" multiple class="standardSelect form-control" name="arma-asignar-reg[]">
								  		<option value="" selected="disabled"></option>
								  		<?php echo $dato = $datos->seleccionarArmasAgenteControlador();?>
								  	</select>
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
					<?php echo $dato = $datos->seleccinarEquiposDosControlador();?>
				</table>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script type="text/javascript">
	 $(function() {
      $('#table_id').DataTable();
    });
</script>

 <script type="text/javascript">
    $(function() {
      $(".standardSelect").chosen();
    });
  </script>


