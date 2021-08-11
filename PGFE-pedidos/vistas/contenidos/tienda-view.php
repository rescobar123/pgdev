<?php
$pagina = explode("/",$_GET['views'] );//views es el que esta en htacces
  require_once "./controladores/ProductoControlador.php"; 
  $contenido = new ProductoControlador();?>

<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Shop Page</h1>
              <ol class="breadcrumb">
                <li><a href="index.html">Home</a></li>
                <li class="active">Shop</li>
              </ol>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<!-- section -->
<div class="section padding_layout_1 product_list_main">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
        <?php echo $contenido->cargarProductosControlador(); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end section -->
<?php include "./vistas/modulos/contactFooter.php"; 
      

