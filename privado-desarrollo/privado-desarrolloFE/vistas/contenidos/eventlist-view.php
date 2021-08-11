<head>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.css"/>
</head>
<?php require_once "./controladores/EventoControlador.php"; 
	$datos = new EventoControlador();
?>

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
<div class="container-fluid">
	<div class="panel panel-success">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-format-list-bulleted"></i> &nbsp; LISTA DE EVENTOS</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-striped table-bordered display" id="table_id">
							<?php echo $datos->seleccionarEventosControlador(); ?>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.23/b-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/sb-1.0.1/sp-1.2.2/datatables.min.js"></script>
<script type="text/javascript">
	 $(function() {
      $('#table_id').DataTable();
    });
</script>