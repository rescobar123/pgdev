<?php
  require_once "./controladores/ProductoControlador.php"; 
  $contenido = new ProductoControlador();
  $url_actual = $_SERVER["REQUEST_URI"];
  $urlArray = explode("/",$url_actual);
  $idProducto = $urlArray[3];
  $prod = $contenido->obtenerProductoById($idProducto);
  $rebaja = $prod['ProductoPrecioUni'] * $prod['ProductoDescuento'] / 100;
  $rebaja = $prod['ProductoPrecioUni'] - $rebaja;
  $rebaja = round($rebaja,2);

  ?>

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
                                <li class="active">Detalles del producto</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end inner page banner -->
<div class="section padding_layout_1 product_detail">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-6 col-lg-12 col-md-12">
                        <div class="product_detail_feature_img hizoom hi2">
                            <div class='hizoom hi2'> <img src="<?php echo $prod['ProductoImagen'] ?>" alt="#" /> </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12 col-md-12 product_detail_side detail_style1">
                        <div class="product-heading">
                            <h2><?php echo $prod['ProductoNombre'] ?></h2>
                        </div>
                        <div class="product-detail-side">
                            <span><del>Q.<?php echo $prod['ProductoPrecioUni'] ?></del></span><span class="new-price">Q.
                                <?php echo $rebaja ?></span> <span class="rating"> <i class="fa fa-star"
                                    aria-hidden="true"></i> <i class="fa fa-star" aria-hidden="true"></i> <i
                                    class="fa fa-star" aria-hidden="true"></i> <i class="fa fa-star"
                                    aria-hidden="true"></i> <i class="fa fa-star-o" aria-hidden="true"></i> </span>
                            <span class="review">(Puntaje de clientes)</span> </div>
                        <div class="detail-contant">
                            <p><?php echo $prod['ProductoDescripcion'] ?>.<br>
                                <span class="stock"><?php echo $prod['ProductoExistencia'] ?> en Existencia</span>
                            </p>
                            <form class="cart" method="post" action="it_cart.html">
                                <div class="quantity">
                                    <input step="1" min="1" value="1" max="<?php echo $prod['ProductoExistencia'] ?>" name="cantidadPedido" title="Cantidad pedido"
                                        class="input-text qty text" size="4" type="number">
                                </div>
                                <button type="submit" class="btn sqaure_bt">Add to cart</button>
                            </form>
                        </div>
                        <div class="share-post"> <a href="#" class="share-text">Share</a>
                            <ul class="social_icons">
                                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section padding_layout_1 checkout_section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="full">
          <div class="tab-info login-section">
            <p>Ya tienes cuenta? <a href="#login" class="" data-toggle="collapse">Ingresa aqui</a></p>
          </div>
          <div id="login" class="collapse">
            <div class="login-form-checkout">
            
              <form action="#">
                <fieldset>
                <div class="row">
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="username">Username or email <span class="required">*</span></label>
                    <input class="input-text" name="username" id="username" required="" type="text">
                  </div>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <label for="password">Password <span class="required">*</span></label>
                    <input class="input-text" name="password" id="password" required="" type="password">
                  </div>
                  <div class="col-md-12 col-sm-12 col-xs-12 btn-login">
                    <button class="bt_main">Login</button>
                    <span class="remeber">
                    <input type="checkbox">
                    Remember me</span> </div>
                </div>
                </fieldset>
              </form>
            </div>
          </div>
          <div class="tab-info coupon-section">
            <p>Tienes un cupo de descuento? <a href="#cupon" class="" data-toggle="collapse">Click aca para ingresar tu cupon</a></p>
          </div>
          <div id="cupon" class="collapse">
            <div class="coupen-form">
              <form action="#">
                <fieldset>
                <div class="row">
                  <div class="col-md-8 col-sm-8 col-xs-12">
                    <input class="input-text" name="coupon" placeholder="Coupon code" id="coupon" required="" type="text">
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                    <button class="bt_main">Login</button>
                  </div>
                </div>
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8">
        <div class="checkout-form">
          <form action="#">
            <fieldset>
            <div class="row">
              <div class="col-md-6">
                <div class="form-field">
                  <label>Nombres <span class="red">*</span></label>
                  <input name="fn" type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Apellidos<span class="red">*</span></label>
                  <input name="ln" type="text">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-field">
                  <label>Departamento</label>
                  <select name="cn">
                    <option value="Gt">Guatemala</option>
                    <option value="SJP">San Jose Pinula</option>
                    <option value="VN">Villa Nueva</option>
                  </select>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-field">
                  <label>Direccion <span class="red">*</span></label>
                  <textarea cols="70" name="ad"></textarea>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-field">
                  <label>Codigo Postal<span class="red">*</span></label>
                  <input name="pz" type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Telefono <span class="red">*</span></label>
                  <input name="ph" type="text">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <label>Email <span class="red">*</span></label>
                  <input name="em" type="email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-field">
                  <input name="ck" type="checkbox">
                  <span class="crte-ac">Quieres crear una cuenta?</span> </div>
              </div>
            </div>
            </fieldset>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <div class="shopping-cart-cart">
          <table>
            <tbody>
              <tr class="head-table">
                <td><h5>Cart Totals</h5></td>
                <td class="text-right"></td>
              </tr>
              <tr>
                <td><h4>Subtotal</h4></td>
                <td class="text-right"><h4>Q.<?php echo $prod['ProductoPrecioUni'] ?></h4></td>
              </tr>
              <tr>
                <td><h5>Estimated shipping</h5></td>
                <td class="text-right"><h4>Q. 6</h4></td>
              </tr>
              <tr>
                <td><h3>Total</h3></td>
                <td class="text-right"><h4>Q.<?php echo $prod['ProductoPrecioUni']+6 ?></h4></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="payment-form">
          <div class="col-xs-12 col-md-12">
            <!-- CREDIT CARD FORM STARTS HERE -->
            <div class="panel panel-default credit-card-box">
              <div class="panel-heading display-table">
                <div class="display-tr">
                  <h3 class="panel-title display-td">Payment Details</h3>
                  <div class="display-td"> <img class="img-responsive pull-right" src="data:image/png;base64,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" alt="#"> </div>
                </div>
              </div>
              <div class="panel-body">
                <form id="payment-form" method="POST" action="index.html">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-field">
                        <label>Card Number</label>
                        <div class="form-field cardNumber">
                          <input name="cardNumber" placeholder="Valid Card Number" required="" type="tel">
                          <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-xs-12 col-md-7">
                      <div class="form-field">
                        <label><span class="hidden-xs">Expiration</span><span class="visible-xs-inline">EXP</span> Date</label>
                        <input name="cardExpiry" placeholder="MM / YY" required="" type="tel">
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-5 pull-right">
                      <div class="form-field">
                        <label>CV Code</label>
                        <input name="cardCVC" placeholder="CVC" required="" type="tel">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-field">
                        <label>Coupon Code</label>
                        <input name="couponCode" required="" type="text">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 payment-bt">
                      <div class="center">
                        <form>
                            <button class="bt_main">Iniciar Pedido</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <!-- CREDIT CARD FORM ENDS HERE -->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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

      