<section class="full-box cover dashboard-sideBar">
	<div class="full-box dashboard-sideBar-bg btn-menu-dashboard"></div>
	<div class="full-box dashboard-sideBar-ct">
		<!--SideBar Title -->
		<div class="full-box text-uppercase text-center text-titles dashboard-sideBar-title">
			<?php echo COMPANY; ?> <i class="zmdi zmdi-close btn-menu-dashboard visible-xs"></i>
		</div>
		<!-- SideBar User info -->
		<div class="full-box dashboard-sideBar-UserInfo">
			<figure class="full-box">
				<img src="<?php echo SERVERURL; ?>vistas/assets/avatars/<?php echo $_SESSION['CuentaFoto'] ?>" alt="UserIcon">
				<figcaption class="text-center text-titles"><?php echo $_SESSION['CuentaPrivilegio'] ?></figcaption>
			</figure>
			<ul class="full-box list-unstyled text-center">
				<li>
					<a href="<?php echo SERVERURL; ?>mydata//" title="Mis datos">
						<i class="zmdi zmdi-account-circle"></i>
					</a>
				</li>
				<li>
					<a href="<?php echo SERVERURL; ?>myaccount/" title="Mi cuenta">
						<i class="zmdi zmdi-settings"></i>
					</a>
				</li>
				<li>
					<a href="<?php echo $lc->encriptar($_SESSION['token_pg']);  ?>" title="Salir del sistema" class="btn-exit-system">
						<i class="zmdi zmdi-power"></i>
					</a>
				</li>
			</ul>
		</div>
		<!-- SideBar Menu -->
		<ul class="list-unstyled full-box dashboard-sideBar-Menu">
			<li>
				<a href="<?php echo SERVERURL; ?>home/">
					<i class="zmdi zmdi-view-dashboard zmdi-hc-fw"></i> Dashboard
				</a>
			</li>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-case zmdi-hc-fw"></i> Administración <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<?php 
						if($_SESSION['CuentaPrivilegio'] == 1){
					?>
					<li>
						<a href="<?php echo SERVERURL; ?>agent/"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Agentes</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>retinue/"><i class="zmdi zmdi-accounts-outline zmdi-hc-fw"></i> Comitivas</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>event/"><i class="zmdi zmdi-watch zmdi-hc-fw"></i> Eventos</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>confidencetest/"><i class="zmdi zmdi-alert-triangle zmdi-hc-fw"></i> Pruebas de Confianza</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-book zmdi-hc-fw"></i> Cursos</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-run zmdi-hc-fw"></i> Habilidades</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-tablet-android zmdi-hc-fw"></i> Equipo</a>
					</li>
					<?php 
						}elseif($_SESSION['CuentaPrivilegio'] == 2){
					?>
					<li>
						<a href="<?php echo SERVERURL; ?>agent/"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Agentes</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>event/"><i class="zmdi zmdi-watch zmdi-hc-fw"></i> Eventos</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-tablet-android zmdi-hc-fw"></i> Equipo</a>
					</li>
					<?php 
						}elseif($_SESSION['CuentaPrivilegio'] == 3){
					?>
					<li>
						<a href="<?php echo SERVERURL; ?>agent/"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Agentes</a>
					</li>
					<li>
						<a href="<?php echo SERVERURL; ?>book/"><i class="zmdi zmdi-tablet-android zmdi-hc-fw"></i> Equipo</a>
					</li>
					<?php 
						}
					?>
				</ul>
			</li>
			<?php 
				if($_SESSION['CuentaPrivilegio'] == 1){
			?>
			<li>
				<a href="#!" class="btn-sideBar-SubMenu">
					<i class="zmdi zmdi-account-add zmdi-hc-fw"></i> Usuarios <i class="zmdi zmdi-caret-down pull-right"></i>
				</a>
				<ul class="list-unstyled full-box">
					<li>
						<a href="<?php echo SERVERURL; ?>admin/"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Administradores</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="<?php echo SERVERURL; ?>catalog/">
					<i class="zmdi zmdi-download zmdi-hc-fw"></i> Backup y Restauración
				</a>
			</li>
			<?php 
				}
			?>
		</ul>
	</div>
</section>
