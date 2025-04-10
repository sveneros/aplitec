
<?php
        include('../layout/header.php');
        ?>

      
            <div class="container-fluid">
                <!-- Breadcrumb start -->
                <div class="row m-1">
                    <div class="col-12 ">
                        <h4 class="main-title">Inicio</h4>
                        <ul class="app-line-breadcrumbs mb-3">
                            <li class="">
                                <a href="#" class="f-s-14 f-w-500">
                      <span>
                        <i class="ph-duotone  ph-newspaper f-s-16"></i> Aplitec
                      </span>
                                </a>
                            </li>
                            <li class="active">
                                <a href="#" class="f-s-14 f-w-500">Inicio</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Breadcrumb end -->

                <!-- Blank start -->
                <div class="row">
                    
                    <div class="col-md-7 col-lg-7 col-xxl-4 order--2-lg">
                        <div class="row">
                            <div class="col-6">
                                <div class="card courses-cards card-success">
                                <div class="card-body">
                                    <i class="ph-duotone  ph-calendar-check icon-bg"></i>
                                    <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                                    <i class="ph-duotone  ph-calendar-check text-success f-s-24"></i>
                                    </span>
                                    <div class="mt-5">
                                    <h4>2K+</h4>
                                    <p class="f-w-500 mb-0">Productos</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card courses-cards card-info">
                                <div class="card-body">
                                    <i class="ph-duotone  ph-projector-screen-chart icon-bg"></i>
                                    <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                                    <i class="ph-duotone  ph-projector-screen-chart text-info f-s-24"></i>
                                    </span>
                                    <div class="mt-5">
                                    <h4>38+</h4>
                                    <p class="f-w-500 mb-0">Categorías</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card courses-cards card-primary">
                                <div class="card-body">
                                    <i class="ph-duotone  ph-graduation-cap icon-bg"></i>
                                    <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                                    <i class="ph-duotone  ph-graduation-cap text-primary f-s-24"></i>
                                    </span>
                                    <div class="mt-5">
                                    <h4>16</h4>
                                    <p class="f-w-500 mb-0">Marcas</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card courses-cards card-warning">
                                <div class="card-body">
                                    <i class="ph-duotone  ph-pencil-line icon-bg"></i>
                                    <span class="bg-white h-50 w-50 d-flex-center b-r-15">
                                    <i class="ph-duotone  ph-pencil-line text-warning text-warning f-s-24"></i>
                                    </span>
                                    <div class="mt-5">
                                    <h4>1K</h4>
                                    <p class="f-w-500 mb-0">Clientes</p>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- order-3-lg -->
                    <div class="col-md-8 col-lg-8 order-2-lg">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="header-title-text">Productos Recomendados por el Algoritmo Genético</h5>
                            <div class="mt-3">
                            <div class="today-task-input">
                                <div class="input-group mb-3">
                                
                                <button class="btn btn-primary b-r-right" id="btnCargar">Generar Recomendados</button>
                                <span id="loading" class="loading" style="display:none;">Cargando...</span>
                                </div>
                            </div>
                           
    
                                <div id="resultado" class="table-responsive">
                                    <table id="productTable" class="table align-middle mb-0 style="display:none;">
                                        <thead>
                                            <tr>
                                                <th>Pos.</th>
                                                <th>Producto</th>
                                                <th>Solicitudes</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <div id="errorMessage" class="error" style="display:none;"></div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- order-1-lg -->
                    <div class="col-md-5 col-lg-4 order-1-lg">
                        <div class="card courses-progress-card">
                            <div class="card-body">
                                <div>
                                <h5 class="header-title-text">Cotizaciones vs Compras</h5>
                                </div>
                                <div class="d-flex justify-content-center align-items-center mt-3">
                                <div class="courses-progress-box">
                                    <div class="courses-progress-label">
                                    <h6 class="mb-0 text-dark"><i class="ph-fill  ph-circle f-s-14 text-secondary me-2"></i>Bs. 68,200</h6>
                                    <p class="text-secondary mb-0 ms-4">Cotizaciones</p>
                                    </div>
                                    <div class="courses-progress-label">
                                    <h6 class="mb-0 text-dark"><i class="ph-fill  ph-circle f-s-14 text-primary me-2"></i>Bs. 45,587</h6>
                                    <p class="text-secondary mb-0 ms-4">Compras</p>
                                    </div>
                                    <div class="courses-progress-label">
                                    <h6 class="mb-0 text-dark"><i class="ph-fill  ph-circle f-s-14 text-danger me-2"></i>Bs. 22,613</h6>
                                    <p class="text-secondary mb-0 ms-4">Diferencia</p>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div id="coursesProgress"></div>
                                </div>
                                </div>
                                <div class="mt-3">
                                <p class="f-s-16 text-secondary mb-0"><span class="text-success">86.90%<i
                                        class="ph-bold  ph-trend-up ms-2"></i></span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- order-4-lg -->
                    <div class="col-md-5 col-lg-3 col-xxl-4 order-4-lg">
                        <div class="card">
                        <div class="card-body">
                            <h5 class="header-title-text">Cotizaciones</h5>
                            <div class="mt-3">
                            <div id="activityHoursChart"></div>
                            </div>
                            <div class="spent-hours-content">
                            <div>
                                <h6 class="mb-0">20</h6>
                                <p class="text-secondary mb-0">Cantidad</p>
                            </div>
                            <div>
                                <h6 class="mb-0">45</h6>
                                <p class="text-secondary mb-0">Productos</p>
                            </div>
                            <div>
                                <h6 class="mb-0">200</h6>
                                <p class="text-secondary mb-0">Clientes</p>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    

                    <div class="col-lg-5 col-xxl-4 order--1-lg education-courses-card">
                        <div class="row">
                        <div class="col-6 col-lg-12">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="header-title-text">Ventas del mes</h5>
                                <p class="text-secondary mb-0">Última actualización</p>
                                <div class="d-flex justify-content-between mt-2">
                                <h3 class="text-dark mb-0">2K+</h3>
                                <div class="total-courses flex-grow-1">
                                    <div id="totalCourses"></div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-12">
                            <div class="card">
                            <div class="card-body">
                                <h5 class="header-title-text">Ganancias</h5>
                                <p class="text-secondary mb-0">Abril</p>
                                <div class="d-flex justify-content-between mt-2">
                                <h3 class="text-dark mb-0">29%</h3>
                                <div class="progress-user flex-grow-1">
                                    <div id="progressUser"></div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-4 col-xxl-3 order--3-lg">
                        <div class="card education-profile-card">
                            <div class="card-body">
                                <div class="profile-header">
                                <h5 class="header-title-text">Perfil</h5>
                                </div>
                                <div class="profile-top-content">
                                <div class="h-80 w-80 d-flex-center b-r-50 overflow-hidden">
                                    <img src="../assets/images/avtar/woman.jpg" alt="" class="img-fluid">
                                </div>
                                <h6 class="text-dark f-w-600 mb-0"><?php if (isset($_SESSION['sml2020_svenerossys_nombre_usuario_registrado'])) echo ($_SESSION['sml2020_svenerossys_nombre_usuario_registrado']);?></h6>
                                <p class="text-secondary f-s-13 mb-0"><?php if (isset($_SESSION['sml2020_svenerossys_nombre_usuario_registrado']))echo ($_SESSION['sml2020_svenerossys_email_usuario_registrado']);?></p>
                                <div>
                                    <button type="button" class="btn btn-primary">Cambiar password</button>
                                    
                                </div>
                                
                                </div>
                                <div class="profile-content-box">
                                <div class="profile-details">
                                    <p class="f-s-18 mb-0"><i class="ph-bold  ph-clock-countdown"></i></p>
                                    <span class="badge text-light-primary">45H</span>
                                </div>
                                <div class="profile-details">
                                    <p class="f-s-18 mb-0"><i class="ph-fill  ph-book-bookmark"></i></p>
                                    <span class="badge text-light-secondary">10</span>
                                </div>
                                <div class="profile-details">
                                    <p class="f-s-18 mb-0"><i class="ph-fill  ph-seal-check"></i></p>
                                    <span class="badge text-light-success">2K</span>
                                </div>
                                <div class="profile-details">
                                    <p class="f-s-18 mb-0"><i class="ph-fill  ph-user-circle"></i></p>
                                    <span class="badge text-light-info">34K</span>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- Blank end -->
            </div>
     
    <?php
    include('../layout/footer.php');
    ?>
<!-- education js-->
<script src="../assets/js/education.js"></script>
<script>
        $(document).ready(function() {
            $('#btnCargar').click(function() {
                cargarProductos();
                $('#btnCargar').hide();
            });
            
            // Cargar automáticamente al inicio (opcional)
            // cargarProductos();
        });
        
        function cargarProductos() {
            $('#loading').show();
            $('#productTable').hide();
            $('#errorMessage').hide();
            
            $.ajax({
                url: '../controllers/algoritmo_genetico.php', // Reemplaza con la ruta correcta
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    $('#loading').hide();
                    
                    if (response.success) {
                        mostrarProductos(response.data);
                    } else {
                        mostrarError(response.message);
                    }
                    $('#btnCargar').show();
                },
                error: function(xhr, status, error) {
                    $('#loading').hide();
                    mostrarError('Error al conectar con el servidor: ' + error);
                    $('#btnCargar').show();
                }
            });
        }
        
        function mostrarProductos(productos) {
            var tbody = $('#productTable tbody');
            tbody.empty();
            
            $.each(productos, function(index, producto) {
                var row = $('<tr>');
                row.append($('<td>').text(producto.position));
                row.append($('<td>').text(producto.producto));
                row.append($('<td>').text(producto.solicitudes));
                tbody.append(row);
            });
            
            $('#productTable').show();
        }
        
        function mostrarError(mensaje) {
            $('#errorMessage').text(mensaje).show();
        }
    </script>
