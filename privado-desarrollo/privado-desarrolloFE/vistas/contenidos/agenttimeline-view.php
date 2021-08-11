<?php require_once "./controladores/AgenteControlador.php"; 
	$datos = new AgenteControlador();
	$datosAgente = new AgenteControlador();
	$infoAgente = $datosAgente->seleccionarInformacionAgenteControlador();

?>
<!-- Content page -->
<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Ficha del agente <small>AGENTE</small></h1>
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
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="zmdi zmdi-plus"></i> &nbsp; Linea de Tiempo de: <?php echo $infoAgente['AgenteNombre'].' '.$infoAgente['AgenteApellido']  ?> </h3>
		</div>
		<center><img width="300" class="img-circle" src="<?php echo SERVERURL.$infoAgente['AgenteFoto'] ?>"></center>
		<div class="container-fluid">
	<div class="page-header">
	  <h1 class="text-titles">Historial <small>Línea de Tiempo</small></h1>
	</div>
	<section id="cd-timeline" class="cd-container">
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL.$infoAgente['AgenteFoto'] ?>" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">1 - Robin Escobar (Instalaciones)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inició: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalizó: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2020</span>
            </div>
        </div>  
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL.$infoAgente['AgenteFoto'] ?>" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">2 - Robin Escobar (Instalaciones)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inició: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalizó: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2020</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL.$infoAgente['AgenteFoto'] ?>" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">3 - Robin Escobar (Instalaciones)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inició: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalizó: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2020</span>
            </div>
        </div>
        <div class="cd-timeline-block">
            <div class="cd-timeline-img">
                <img src="<?php echo SERVERURL.$infoAgente['AgenteFoto'] ?>" alt="user-picture">
            </div>
            <div class="cd-timeline-content">
                <h4 class="text-center text-titles">4 - Robin Escobar (Instalaciones)</h4>
                <p class="text-center">
                    <i class="zmdi zmdi-timer zmdi-hc-fw"></i> Inició: <em>7:00 AM</em> &nbsp;&nbsp;&nbsp; 
                    <i class="zmdi zmdi-time zmdi-hc-fw"></i> Finalizó: <em>7:17 AM</em>
                </p>
                <span class="cd-date"><i class="zmdi zmdi-calendar-note zmdi-hc-fw"></i> 07/07/2020</span>
            </div>
        </div>   
    </section>
</div>
	</div>
</div>