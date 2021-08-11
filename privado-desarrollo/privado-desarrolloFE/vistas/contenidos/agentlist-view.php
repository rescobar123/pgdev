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
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#fichaAgente">
  Ficha Médica
</button>

<!-- Modal -->
<div class="modal fade" id="fichaAgente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ficha Médica</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?php require_once "./controladores/AgenteControlador.php"; 
	$listaAgentes = new AgenteControlador();

	$pagina = explode("/",$_GET['views'] );//views es el que esta en htacces
	echo $listaAgentes->paginadorAgenteControlador($pagina['1'],10,$_SESSION['privilegio_sbp'], "");
?>
