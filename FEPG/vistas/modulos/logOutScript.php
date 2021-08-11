    <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Si cierra cesión deberá ingresar de nuevo</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="<?php
          $token_encrip = MainModel::encriptar($_SESSION['s_token']);
           echo SERVERURL."ajax/loginAjax.php?Token=$token_encrip"?>" title="Salir del sistema" class="btn-exit-system">Logout
          </a>
        </div>
      </div>
    </div>
  </div>
