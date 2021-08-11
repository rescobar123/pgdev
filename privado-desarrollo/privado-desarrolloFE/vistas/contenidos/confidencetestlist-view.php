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

<!-- Panel listado de proveedores -->
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE PRUEBAS DE CONFIANZA</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-hover text-center">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">AGENTE</th>
							<th class="text-center">TIPO DE PRUEBA:</th>
							<th class="text-center">FECHA DE LA PRUEBA</th>
							<th class="text-center">JUSTIFICACIÓN</th>
							<th class="text-center">ACTUALIZAR</th>
							<th class="text-center">ELIMINAR</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Robin Eriberto Escobar</td>
							<td>Polígrafo</td>
							<td>08/05/2020</td>
							<td>Prueba de protocolo</td>
							<td>
								<a href="#!" class="btn btn-success btn-raised btn-xs">
									<i class="zmdi zmdi-refresh"></i>
								</a>
							</td>
							<td>
								<form>
									<button type="submit" class="btn btn-danger btn-raised btn-xs">
										<i class="zmdi zmdi-delete"></i>
									</button>
								</form>
							</td>
						</tr>
						<tr>
							<td>2</td>
							<td>Juan Garcia</td>
							<td>Doping</td>
							<td>08/05/2020</td>
							<td>Prueba de protocolo</td>
							<td>
								<a href="#!" class="btn btn-success btn-raised btn-xs">
									<i class="zmdi zmdi-refresh"></i>
								</a>
							</td>
							<td>
								<form>
									<button type="submit" class="btn btn-danger btn-raised btn-xs">
										<i class="zmdi zmdi-delete"></i>
									</button>
								</form>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<nav class="text-center">
				<ul class="pagination pagination-sm">
					<li class="disabled"><a href="javascript:void(0)">«</a></li>
					<li class="active"><a href="javascript:void(0)">1</a></li>
					<li><a href="javascript:void(0)">2</a></li>
					<li><a href="javascript:void(0)">3</a></li>
					<li><a href="javascript:void(0)">4</a></li>
					<li><a href="javascript:void(0)">5</a></li>
					<li><a href="javascript:void(0)">»</a></li>
				</ul>
			</nav>
		</div>
	</div>
</div>