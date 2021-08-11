<?php require_once "./controladores/UsuarioControlador.php";
  $user = new UsuarioControlador();
  ?>
<div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-1">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-1">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Gestion de usuarios</h1>
                        </div>
                        <form autocomplete="off" id="frm-test" class="FormularioAjax"
                            action="<?php echo URL_WEB_SERVICE."p=usuario&a=insertar"; ?>" enctype="multipart/form-data"
                            method="POST" data-form="save">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" required class="form-control form-control-user"
                                        name="nombreCompleto" placeholder="Nombre completo">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" required class="form-control form-control-user" name="usuario"
                                        placeholder="Nombre de usuario">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Email">
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" value="" required class="form-control form-control-user"
                                        name="clave" placeholder="Contrasenia">
                                </div>

                            </div>
                            <h5 class="">Genero</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="genero" id="19" value="M">
                                <label class="form-check-label" for="19">M</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="F" name="genero" id="29">
                                <label class="form-check-label" for="29">F</label>
                            </div>
                            <br><br>

                            <h5 class="">Privilegio</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="privilegio" id="1"
                                    value="Administrador">
                                <label class="form-check-label" for="1">Administrador</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="Sucursal" name="privilegio" id="2">
                                <label class="form-check-label" for="2">Sucursal</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="Vendedor" name="privilegio" id="3">
                                <label class="form-check-label" for="3">Vendedor</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="Cliente" name="privilegio" id="4">
                                <label class="form-check-label" for="4">Cliente</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="Repartidor" name="privilegio" id="5">
                                <label class="form-check-label" for="5">Repartidor</label>
                            </div>
                            <br><br>
                            <h5 class="">Sucursal</h5>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="marca" id="51" value="1">
                                <label class="form-check-label" for="51">Zona 4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" value="HP" name="marca" id="2">
                                <label class="form-check-label" for="52">Zona 9</label>
                            </div>
                            <br>
                            <div class="form-group row">
                                <div class="col-sm-12 mb-6 mb-sm-3">
                                    <div class="custom-file">
                                        <input required name="imagen" type="file" class="custom-file-input form-control"
                                            id="file">
                                        <label class="custom-file-label" for="imagen">Imagen del producto</label>
                                    </div>
                                    <br>
                                    <br>
                                    <div id="preview">
                                    </div>
                                </div>
                            </div>
                            <div id="contenedor"></div>
                            <button id="btn-enviar" type="submit" class="btn btn-primary btn-user btn-block">Registrar
                                Usuario</button>
                            <div class="RespuestaAjax"></div>
                        </form>



                    </div>

                </div>
            </div>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Listado de usuarios</h6>
                </div>
                <div id="table-regis" class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre </th>
                                    <th>Privilegio</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Acciones</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Nombre </th>
                                    <th>Privilegio</th>
                                    <th>Email</th>
                                    <th>Foto</th>
                                    <th>Acciones</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                       echo $user->seleccionarUsuariosControlador(); 
                      ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
document.getElementById("file").onchange = function(e) {
    // Creamos el objeto de la clase FileReader
    let reader = new FileReader();
    // Leemos el archivo subido y se lo pasamos a nuestro fileReader
    reader.readAsDataURL(e.target.files[0]);
    // Le decimos que cuando este listo ejecute el código interno
    reader.onload = function() {
        var preview = document.getElementById('preview'),
            image = document.createElement('img');
        image.style.width = '300px';
        image.src = reader.result;
        console.log(image.src);
        var contenedor = document.getElementById('contenedor');
        contenedor.innerHTML = '<input type="text" value="' + image.src + '" name="foto" />';
        preview.innerHTML = '';
        preview.append(image);
    };
}
</script>
<!-- Begin Page Content -->