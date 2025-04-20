<?php
include('../layout/head.php');
include('../layout/css.php');
?>


<body text="medium-text">

<div class="app-wrapper">
    <!-- app loader -->
    <div class="loader-wrapper">
        <div class="loader_16"></div>
    </div>

    <?php
    include('../layout/sidebar_clientes.php');
    ?>

    <div class="app-content">
        
<!-- Header Section starts -->
<header class="header-main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-sm-4 d-flex align-items-center header-left p-0">
                <span class="header-toggle me-3">
                  <i class="ph ph-circles-four"></i>
                </span>
            </div>

            <div class="col-6 col-sm-8 d-flex align-items-center justify-content-end header-right p-0">

                <ul class="d-flex align-items-center">
                    <!-- Enlace a la tienda -->
                    <li class="header-cart">
                    <a href="#" class="d-block head-icon position-relative" role="button" data-bs-toggle="offcanvas"
                       data-bs-target="#cartcanvasRight" aria-controls="cartcanvasRight">
                      <i class="ph ph-shopping-cart-simple"></i>
                      <span
                              class="position-absolute translate-middle badge rounded-pill bg-danger badge-notification">4</span>
                    </a>
                    <div class="offcanvas offcanvas-end header-cart-canvas" tabindex="-1" id="cartcanvasRight"
                         aria-labelledby="cartcanvasRightLabel">
                      <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="cartcanvasRightLabel">Cart</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                      </div>
                      <div class="offcanvas-body app-scroll p-0">
                        <div class="head-container">
                          <div class="head-box">
                            <img src="../assets/images/ecommerce/19.jpg" alt="cart" class="h-50 me-3 b-r-10">
                            <div class="flex-grow-1">
                              <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank"> Backpacks
                              </a>
                              <div>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled  f-s-12  star-filled"></i>
                                <i class="ti ti-star-filled  f-s-12  star-filled"></i>
                              </div>
                              <span class="text-secondary"><span class="text-dark f-w-400">size</span> : medium</span>
                              <span class="text-secondary ms-2"><span class="text-dark f-w-400">Color</span> :
                                Pink</span>
                            </div>
                            <div class="text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                              <p class="text-muted f-w-500 mb-0">$600.50 x 1</p>
                            </div>
                          </div>
                          <div class="head-box">
                            <img src="../assets/images/ecommerce/13.jpg" alt="cart"
                                 class="h-50 object-fit-cover me-3 b-r-10">
                            <div class="flex-grow-1">
                              <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank"> Women's Watch</a>
                              <div>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled  f-s-12  star-filled"></i>
                              </div>
                              <span class="text-secondary"><span class="text-dark f-w-400">size</span> : small</span>
                              <span class="text-secondary ms-2"><span class="text-dark f-w-400">Color</span> : Rose
                                Gold</span>
                            </div>
                            <div class="text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                              <p class="text-muted f-w-500 mb-0">$519.10 x 2</p>
                            </div>
                          </div>
                          <div class="head-box">
                            <img src="../assets/images/ecommerce/09.jpg" alt="cart"
                                 class="h-50 object-fit-cover me-3 b-r-10">
                            <div class="flex-grow-1">
                              <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank">Sandals</a>
                              <div>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                              </div>
                              <span class="text-secondary"><span class="text-dark f-w-400">size</span> : 8</span>
                              <span class="text-secondary ms-2"><span class="text-dark f-w-400">Color</span> :
                                White</span>
                            </div>
                            <div class="text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                              <p class="text-muted f-w-500 mb-0">$390 x 2</p>
                            </div>
                          </div>
                          <div class="head-box ">
                            <img src="../assets/images/ecommerce/23.jpg" alt="cart"
                                 class="h-50 object-fit-cover me-3 b-r-10">
                            <div class="flex-grow-1">
                              <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank"> Jackets</a>
                              <div>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled star-filled f-s-12"></i>
                                <i class="ti ti-star-filled star-filled f-s-12"></i>
                              </div>
                              <span class="text-secondary"><span class="text-dark f-w-400">size</span> : XL</span>
                              <span class="text-secondary ms-2"><span class="text-dark f-w-400">Color</span> :
                                Blue</span>
                            </div>
                            <div class="text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                              <p class="text-muted f-w-500 mb-0">$300.00 x 2</p>
                            </div>
                          </div>
                          <div class="head-box ">
                            <img src="../assets/images/ecommerce/11.jpg" alt="cart"
                                 class="h-50 object-fit-cover me-3 b-r-10">
                            <div class="flex-grow-1">
                              <a class="mb-0 f-w-600 f-s-16" href="product_details.html" target="_blank"> Shoes</a>
                              <div>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled text-warning f-s-12"></i>
                                <i class="ti ti-star-filled star-filled f-s-12"></i>
                                <i class="ti ti-star-filled star-filled f-s-12"></i>
                              </div>
                              <span class="text-secondary"><span class="text-dark f-w-400">size</span> : 9</span>
                              <span class="text-secondary ms-2"><span class="text-dark f-w-400">Color</span> :
                                White</span>
                            </div>
                            <div class="text-end">
                              <i class="ph ph-trash f-s-18 text-danger close-btn"></i>
                              <p class="text-muted f-w-500 mb-0">$450.00 x 1</p>
                            </div>
                          </div>
                          <div class="hidden-massage py-4 px-3">
                            <img src="../assets/images/icons/cart.png" alt="cart" class="w-50 h-50 mb-3">
                            <div>
                              <h6 class="mb-0">Your Cart is Empty</h6>
                              <p class="text-secondary mb-0">Add some items :)</p>
                              <a class="btn btn-light-primary btn-xs mt-2" href="product_details.html">Shop
                                Now</a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="offcanvas-footer">
                        <div class="head-box-footer p-3">
                          <div class="mb-4">
                            <h6 class="text-muted f-w-600">Total <span class="float-end">$3,468.00
                              </span></h6>
                          </div>
                          <div class="header-cart-btn">
                            <a href="./cart.html" target="_blank" role="button" class="btn btn-light-primary">
                              <i class="ti ti-eye"></i> View Cart</a>
                            <a href="./checkout.html" target="_blank" role="button" class="btn btn-light-success">
                              Checkout <i class="ti ti-shopping-cart"></i></a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>

                    <li class="header-dark">
                        <div class="sun-logo head-icon">
                            <!-- <i class="ph ph-moon-stars"></i> -->
                        </div>
                        <div class="moon-logo head-icon">
                            <!-- <i class="ph ph-sun-dim"></i> -->
                        </div>
                    </li>

                    <li class="header-profile">
                        <a href="#" class="d-block head-icon" role="button" data-bs-toggle="offcanvas"
                           data-bs-target="#profilecanvasRight" aria-controls="profilecanvasRight">
                            <img src="../assets/images/avtar/woman.jpg" alt="avtar"
                                 class="b-r-10 h-35 w-35">
                        </a>

                        <div class="offcanvas offcanvas-end header-profile-canvas" tabindex="-1"
                             id="profilecanvasRight" aria-labelledby="profilecanvasRight">
                            <div class="offcanvas-body app-scroll">
                                <ul class="">
                                    <li>
                                        <div class="d-flex-center">
                              <span
                                      class="h-45 w-45 d-flex-center b-r-10 position-relative">
                                <img src="../assets/images/avtar/woman.jpg" alt=""
                                     class="img-fluid b-r-10">
                              </span>
                                        </div>
                                        <div class="text-center mt-2">
                                            <h6 class="mb-0"> <?php if (isset($_SESSION['sml2020_svenerossys_nombre_usuario_registrado'])) echo ($_SESSION['sml2020_svenerossys_nombre_usuario_registrado']);?></h6>
                                            <p class="f-s-12 mb-0 text-secondary"><?php if (isset($_SESSION['sml2020_svenerossys_nombre_usuario_registrado']))echo ($_SESSION['sml2020_svenerossys_email_usuario_registrado']);?>
                                            </p>
                                        </div>
                                    </li>

                                    <li class="app-divider-v dotted py-1"></li>
                                    <li>
                                        <a class="f-w-500" href="./profile.php" target="_self">
                                            <i class="ph-duotone  ph-user-circle pe-1 f-s-20"></i>
                                            Perfil de usuario
                                        </a>
                                    </li>
                                    <li>
                                        <a class="f-w-500" href="./logout.php" target="_self">
                                            <i class="ph-bold  ph-lock-open pe-1 f-s-20"></i> Cerrar Sesión
                                        </a>
                                    </li>
                                   
                                    <li class="app-divider-v dotted py-1"></li>
                                    <!-- <li>
                                        <a class="f-w-500" href="./faq.php" target="_self">
                                            <i class="ph-duotone  ph-question pe-1 f-s-20"></i> Help
                                        </a>
                                    </li> -->
                                    
                                    
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>



<!-- main section -->
<main>