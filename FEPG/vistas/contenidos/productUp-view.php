<?php require_once "./controladores/ProductoControlador.php";
  $producto = new ProductoControlador();
  ?>
  <div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-1">
        <div class="row">
          <div class="col-lg-12">
          <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Gestionar Inventario</h1>
              </div>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Listado de productos</h6>
              </div>
              <div id="table-regis" class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Precio Unitario</th>
                        <th>Agregar a Sucursal</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Act. Exist.</th>
                        <th>Eliminar</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Codigo</th>
                        <th>Nombre</th>
                        <th>Existencia</th>
                        <th>Precio Unitario</th>
                        <th>Agregar a Sucursal</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Act. Exist.</th>
                        <th>Eliminar</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                       echo $producto->seleccionarProductosControlador(); 
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </div>
  </div>
  
  
  