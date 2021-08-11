<div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  	<form action="" method="POST" autocomplete="off"  class="logInForm">
          						<p class="text-center text-muted"><i class="zmdi zmdi-account-circle zmdi-hc-5x"></i></p>
          						<p class="text-center text-muted text-uppercase">Inicia sesión con tu cuenta</p>
          						<div class="form-group label-floating">
          						  <input id="UserName"  name="usuario" type="text" class="form-control form-control-user"   placeholder="Enter username...">
          						</div>
          						<div class="form-group label-floating">
          						  <input  class="form-control form-control-user" id="clave" name="clave" type="password" placeholder="Password" >
          						</div>
                      <div class="RespuestaAjax"></div>
          						<div class="form-group text-center">
          							<input class="btn btn-primary btn-user btn-block" type="submit" value="Iniciar sesión" class="btn btn-info" style="color: #FFF;">
          						</div>
          					</form>
      				    <form action="" method="POST" autocomplete="off"  class="logInForm">
                      <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                          <input name="clave" type="checkbox" class="custom-control-input" id="customCheck">
                          <label class="custom-control-label" for="customCheck">Remember Me</label>
                        </div>
                      </div>
                      <hr>
                        <a href="index.html" class="btn btn-google btn-user btn-block">
                          <i class="fab fa-google fa-fw"></i> Login with Google
                        </a>
                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                          <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                        </a>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.html">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>
<?php 
	if (isset($_POST['usuario']) && isset($_POST['clave'])) {
		require_once "./controladores/LoginControlador.php";

		$login=new LoginControlador();
		echo $login->iniciarSesionControlador();
	}else{
    
  }
 ?>