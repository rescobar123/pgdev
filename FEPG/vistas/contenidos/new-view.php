<?php require_once "./controladores/ContenidoControlador.php"; ?>

  <div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-12">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-12">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Agregar Noticia</h1>
              </div>
              <form autocomplete="off" id="frm-test" class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/AdministradorAjax.php" enctype="multipart/form-data" method="POST" data-form="save">
                <input type="hidden" name="tipoFormulario" value="newNoticia">
                <div class="form-group row">
                  <input type="hidden" value="<?php echo $_SESSION['nombre_user_bm'] ?>" name="usuario-reg">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" required="" name="noticiaTitulo-reg"  placeholder="Título">
                  </div>
                  <div class="col-sm-6">
                   <select name="noticiaTipo-reg" class="browser-default custom-select">
                      <option selected="">Tipo de noticia</option>
                       <?php  $contenido = new ContenidoControlador();
                              echo $contenido->seleccionarTipoArticuloControlador(); ?>
                    </select>
                  </div>
                </div>
                <textarea class="content" id="noticiaDescripcion-reg" name="noticiaDescripcion-reg"></textarea>
                  <script>
                      $(document).ready(function() {
                          $('.content').richText();
                      });

                  </script>
                <br>


                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Actualizar</span>
                  </div>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby name="noticiaImagen-reg">
                    <label class="custom-file-label" for="inputGroupFile01">Elije una imagen</label>
                  </div>
                </div>
                <button type="submit" id="btn-enviar" class="btn btn-success btn-user btn-block">
                  Crear noticia
                </button>
                 <div class="RespuestaAjax"></div>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<br>
   <div class="container-fluid">
          <!-- DataTales Noticias -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Noticias</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Titulo</th>
                      <th>Fecha </th>
                      <th>Tipo</th>
                      <th>Usuario Creo</th>
                      <th>Publicar</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Titulo</th>
                      <th>Fecha </th>
                      <th>Tipo</th>
                      <th>Usuario Creo</th>
                      <th>Publicar</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php  echo $contenido->seleccionarNoticiasControlador(); ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

