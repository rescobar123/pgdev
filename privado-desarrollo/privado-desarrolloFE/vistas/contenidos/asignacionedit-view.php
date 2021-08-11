<!-- Content page -->

<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.css">
</head>
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Administración <small>DATOS DE EQUIPOS ASIGNADOS</small></h1>
	</div>
</div>


<?php require_once "./controladores/InventarioEquipoControlador.php"; 
	$datos = new InventarioControlador();
	$dato = $datos->seleccionarInformacionAsignacionControlador();

	/*DATOS DEL AGENTE Y EQUIPO*/
	$nombreAgente = $datos->seleccionarNombreAgenteIdControlador($dato['id_agente']);
	
	$nombreEquipo = $datos->seleccionarNombreEquiposIdsControlador();
	$arrayEquipo = explode('/',$nombreEquipo);
	$ids = $arrayEquipo[0];
	$id = explode(',',$ids);
	foreach ($id as $key => $value) {
		if (empty($value)) {
			unset($id[$key]);
		}
	}
	$Id = array_merge($id);

	$nombresEquipos = $arrayEquipo[1];
	
	$nombre = explode(',',$nombresEquipos);
	foreach ($nombre as $k => $v) {
		if (empty($v)) {
			unset($nombre[$k]);
		}
	}
	$n = array_merge($nombre);//FIN DATOS AGENTE Y EQUIPO

	$datosIdAsignacion=$dato['id_asignacion'];
	$observacion = $dato['descripcion_asignacion'];
	
	var_dump($dato);

?>
<!-- panel datos de la empresa -->
<div class="container-fluid">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; DATOS DEL EQUIPO</h3>
		</div>
		<div class="panel-body">
			<form autocomplete="off" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
				<input type="hidden" name="tipoFormulario" value="updateasignacion">
				<input type="hidden" name="id_asignacion" value="<?php echo $datosIdAsignacion;?>">
				<input type="hidden" name="id_nombre-reg" value="<?php echo $dato['id_agente'];?>">
		    	<fieldset>
		    		<legend><i class="zmdi zmdi-assignment"></i> &nbsp; Datos generales</legend>
		    		<div class="container-fluid">
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-6">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Nombre Agente *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="nombre-reg" value="<?php echo $nombreAgente?>" required="" maxlength="50">
								</div>
		    				</div>
		    			</div>
		    			<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
						    		<label for="equipo-reg">ASIGNAR EQUIPO *</label>
								  	<select id="equipo-asignar-reg[]" data-placeholder="equipo-asignar" multiple class="standardSelect form-control" name="equipo-asignar-reg[]">
								  		<?php 
								  			for($i=0;$i<count($n);$i++){ ?>
								  				<option value="<?php echo $Id[$i]?>" selected="disabled"><?php echo $n[$i] ?></option>
								  				<?php
								  			}
								  		?>
								  		
								  		<?php echo $dato = $datos->seleccionarEquipoAgenteControlador();?>
								  	</select>
								</div>
							</div>
		    			<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
						    		<label for="sede-reg">ASIGNAR ARMA *</label>
								  	<select id="arma-asignar-reg[]" data-placeholder="arma-asignar" multiple class="standardSelect form-control" name="arma-asignar-reg[]">
								  		<?php 

								  		/*DATOS ARMA*/
										$datosArma = $datos->seleccionarNombreArmasIdsControlador();
										$arrayArma = explode('/',$datosArma);
										$idArma = $arrayArma[0];
										$idArmas = explode(',',$idArma);
										foreach ($idArmas as $clave => $valor) {
											if (empty($valor)) {
												unset($idArmas[$clave]);
											}
										}
										$armas = array_merge($idArmas);
										

										$nombreArmas = $arrayArma[1];
										$nameArmas = explode(',',$nombreArmas);
										foreach ($nameArmas as $n => $val) {
											if (empty($val)) {
												unset($nameArmas[$n]);
											}
										}
										$nArmas = array_merge($nameArmas);
								  			for($i=0;$i<count($nArmas);$i++){ ?>
								  				<option value="<?php echo $armas[$i]?>" selected="disabled"><?php echo $nArmas[$i] ?></option>
								  				<?php
								  			}

								  			
								  		?>
								  		
								  		<?php echo $dato = $datos->seleccionarArmasAgenteControlador();?>
								  	</select>
								</div>
		    			</div>
		    			<br>
		    			<br>
		    			<br>
		    			<div class="row">
		    				<div class="col-xs-12 col-sm-12">
						    	<div class="form-group label-floating">
								  	<label class="control-label">Observacion *</label>
								  	<input pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ ]{1,40}" class="form-control" type="text" name="observacion-reg" value="<?php echo $observacion?>" required="" maxlength="100">
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

<script  src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script type="text/javascript">
    $(function() {
      $(".standardSelect").chosen();
    });
  </script>

