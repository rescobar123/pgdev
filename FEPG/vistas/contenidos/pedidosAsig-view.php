<?php require_once "./controladores/PedidoControlador.php";
  $producto = new PedidoControlador();
  ?>
  <div class="container-fluid">
    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-1">
        <div class="row">
          <div class="col-lg-12">
          <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Pedidos Asignados</h1>
              </div>
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Pedidos Asignados</h6>
              </div>
              <div id="table-regis" class="card-body">
                <div class="table-responsive">
                  <table style="font-size: 12px;" class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Codigo de pedido</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Fecha hora Pedido</th>
                        <th>Estado</th>
                        <th>Direccion Envio</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                      <th>Codigo de pedido</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Producto</th>
                        <th>Fecha hora Pedido</th>
                        <th>Estado</th>
                        <th>Direccion Envio</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      if($_SESSION['s_privilegio'] == 'Repartidor'){
                          $estado = 'Enviado';
                      }else{
                          $estado = '';
                      }
                       echo $producto->seleccionarPedidosControlador($estado); 
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
  
  
  