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
<?php
	if (isset($_POST['busqueda_inicial_admin'])) {
		$_SESSION['busqueda_admin']=$_POST['busqueda_inicial_admin'];
	}
	if (isset($_POST['eliminar_busqueda_admin'])) {
		unset($_SESSION['busqueda_admin']);
	}
	if (!isset($_SESSION['busqueda_admin']) && empty($_SESSION['busqueda_admin'])):
?>

<div class="container-fluid">
	<form class="well" method="POST" action="">
		<div class="row">
			<div class="col-xs-12 col-md-8 col-md-offset-2">
				<div class="form-group label-floating">
					<span class="control-label">¿A quién estas buscando?</span>
					<input class="form-control" type="text" name="busqueda_inicial_admin" required="" value="">
				</div>
			</div>
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="zmdi zmdi-search"></i> &nbsp; Buscar</button>
				</p>
			</div>
		</div>
	</form>
</div>
<?php else: ?>
<div class="container-fluid">
	<form class="well" method="POST" action="">
		<p class="lead text-center">Su última búsqueda  fue <strong>"<?php echo $_SESSION['busqueda_admin'] ?>"</strong></p>
		<div class="row">
			<input class="form-control" type="hidden" name="eliminar_busqueda_admin" value="1">
			<div class="col-xs-12">
				<p class="text-center">
					<button type="submit" class="btn btn-danger btn-raised btn-sm"><i class="zmdi zmdi-delete"></i> &nbsp; Eliminar búsqueda</button>
				</p>
			</div>
		</div>
	</form>
</div>

<?php require_once "./controladores/AgenteControlador.php"; 
	$listaAgentes = new AgenteControlador();

	$pagina = explode("/",$_GET['views'] );//views es el que esta en htacces
	echo $listaAgentes->paginadorAgenteControlador($pagina['1'],10,$_SESSION['privilegio_sbp'], $_SESSION['busqueda_admin']);
?>
<?php endif ?>